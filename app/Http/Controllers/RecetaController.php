<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;



class RecetaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['show' ,'search']]);
    }

    public function index()
    {
        //el usuario logueado
        $usuario=auth()->user();


        //Recetas con paginacion
        $recetas=Receta::where('user_id',$usuario->id)->paginate(4);


        return view('recetas.index')
        ->with('recetas',$recetas)
        ->with('usuario',$usuario);

    }


    public function create()
    {
        /* DB::table('categoria_receta')->get()->dd(); */

        //OBTENER RECETA SIN MODELO
        /*
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre', 'id');
        */


        //CON MODELO
        $categorias=CategoriaReceta::all(['id','nombre']);

        return view('recetas.create')->with('categorias', $categorias);
    }


    public function store(Request $request)
    {
        //VALIDACION DE DATOS
        $data = request()->validate(
            [
                'titulo' => 'required|min:6',
                'preparacion' => 'required',
                'ingredientes' => 'required',
                'imagen' => 'required|image',
                'categoria' => 'required',
            ]
        );

        //OBTENER LA RUTA DE LA IMAGEN
        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //REZISE DE LA IMAGEN
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();


        //Almacenar en la base de datos sin modelo
    /*     DB::table('recetas')->insert([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'user_id' => Auth::user()->id,
            'categoria_id' => $data['categoria'],
        ]);
 */

    //Almacenar con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'preparacion' => $data['preparacion'],
            'ingredientes' => $data['ingredientes'],
            'imagen' => $ruta_imagen,
            'categoria_id' => $data['categoria'],
        ]);


        return redirect()->action('RecetaController@index');

    }




    public function show(Receta $receta)
    {
        //si el usuario esta logeado es false
        //constains = si las recetas tienen like , caso contrario nos muestra false
        $like=(auth()->user())  ?  auth()->user()->meGusta->contains($receta->id)
                                : false ;

        //contar la  cantidad de likes

        $likes=$receta->likes->count();

        return view('recetas.show', compact('receta','like','likes'));
    }



    public function edit(Receta $receta)
    {
        $this->authorize('view',$receta);

        $categorias=CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit',compact('categorias','receta'));
    }



    public function update(Request $request, Receta $receta)
    {

        $this->authorize('update',$receta);

        //DATOS A REQUERIR
        $data = request()->validate(
            [
                'titulo' => 'required|min:6',
                'preparacion' => 'required',
                'ingredientes' => 'required',
                'categoria' => 'required',
            ]
        );

        //ASIGNAR VALORES
        $receta->titulo=$data['titulo'];
        $receta->preparacion=$data['preparacion'];
        $receta->ingredientes=$data['ingredientes'];
        $receta->categoria_id=$data['categoria'];

        //Si el usuario sube una nueva imagen
        if(request('imagen')){

            //Obtener la ruta de la imagen
            $ruta_imagen=$request['imagen']->store('upload-recetas','public');

            //rezise a la imagen
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 500);

            $img->save();

            //Asignar al objeto
            $receta->imagen=$ruta_imagen;
        }

        $receta->save();
        //Redireccionar
        return redirect()->action('RecetaController@index');
    }


    public function destroy(Receta $receta)
    {
        //Ejecutar el policy
        $this->authorize('delete',$receta);


        //eliminar la receta
        $receta->delete();


        return redirect()->action('RecetaController@index');
    }

    public function search(Request $request){

        /* $busqueda= $request['buscar']; */
        $busqueda=$request->get('buscar');


        //select * from recetas where titulo LIKE $busqueda
        $recetas=Receta::where('titulo','like','%'.$busqueda.'%')->paginate(3);

        //conservar el query en el url par evitar paginacion erronea
        $recetas->appends(['buscar' => $busqueda]);
        return view('busquedas.show',compact('recetas','busqueda'));
    }

}
