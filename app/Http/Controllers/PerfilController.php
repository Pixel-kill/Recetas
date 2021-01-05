<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>'show']);
    }


    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Perfil $perfil)
    {
        $recetas=Receta::where('user_id',$perfil->user_id)->paginate(3);
        return view('perfiles.show',compact('perfil','recetas'));

    }


    public function edit(Perfil $perfil)
    {
        $this->authorize('view',$perfil);
        return view('perfiles.edit',compact('perfil'));
    }


    public function update(Request $request, Perfil $perfil)
    {
        $this->authorize('update',$perfil);


        $data=request()->validate([
            'nombre'=>'required',
            'url'=>'required',
            'biografia'=>'required'
        ]);

        //Si el usuario sube una imagen
        if($request['imagen']){
            //obtener la ruta de imagen
            $ruta_imagen=$request['imagen']->store('upload-perfiles','public');
            //Rezise de la imagen
            $img=Image::make(public_path("storage/{$ruta_imagen}"))->fit(600,600);
            $img->save();
            //crear un arreglo de imagen
            $array_imagen=['imagen'=>$ruta_imagen];
        }
        //Asignar nombre y URL
        auth()->user()->name = $data['nombre'];
        auth()->user()->url = $data['url'];
        auth()->user()->save();

        //Eliminar url y name de $data
        unset($data['url']);
        unset($data['nombre']);

        //guardar informacion
        //Asignar  Biografia e imagen
        auth()->user()->perfil()->update(array_merge(
            $data, $array_imagen ?? []
        ));

        return redirect()->action('RecetaController@index');
    }


    public function destroy(Perfil $perfil)
    {
        //
    }
}
