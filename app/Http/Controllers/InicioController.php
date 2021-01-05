<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class InicioController extends Controller
{
    public function index(){

        //Mostrar las recetas por cantidad de botos
       /*  $votadas =Receta::has('likes','>',1)->get(); */

        $votadas=Receta::withCount('likes')->orderBy('likes_count','desc')
                                            ->take(3)->get();




        //con latest recuperamos las mas recientes recetas y con take ponemos el limite
        //oldest para los mas viejos
        $nuevas=Receta::latest()->take(5)->get();


        //obtener todas las categorias
        $categorias=CategoriaReceta::all();


        //Agrupar las recetas por categoria
        $recetas=[];
        foreach($categorias as $categoria){

            $recetas[Str::slug($categoria->nombre)][]=Receta::where('categoria_id',$categoria->id)->take(6)->get();
        }

        return view('inicio.index',compact('nuevas','recetas','votadas'));
    }
}
