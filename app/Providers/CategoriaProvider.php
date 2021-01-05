<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App\CategoriaReceta;

class CategoriaProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    //Se ejecuta cuando la aplicacion esta lista
    public function boot()
    {
        //El * es para decir que en todos lo view se pueda usar categorias
        View::composer('*' , function($view){
            $categorias=CategoriaReceta::all();
            $view->with('categorias',$categorias);
        });
    }
}
