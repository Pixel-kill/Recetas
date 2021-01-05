<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','InicioController@index')->name('inicio.index');


/* Todo recetas se puede resumir con eso  NOTA:INVESTIGAR MAS

Route::resource('recetas','RecetaController');
*/
Route::get('/recetas', 'RecetaController@index')->name('receta.index');
Route::get('/recetas/create','RecetaController@create')->name('receta.create');
Route::post('/recetas','RecetaController@store')->name('receta.store');
Route::get('/recetas/{receta}','RecetaController@show')->name('receta.show');
Route::get('/recetas/{receta}/edit','RecetaController@edit')->name('receta.edit');
Route::put('/recetas/{receta}','RecetaController@update')->name('receta.update');
Route::delete('/recetas/{receta}','RecetaController@destroy')->name('recetas.destroy');



Route::get('/categoria/{categoriaReceta}','CategoriasController@show')->name('categorias.show');

//Buscador de receta
Route::get('/buscar','RecetaController@search')->name('buscar.show');




//rutas de perfiles
Route::get('/perfiles/{perfil}','PerfilController@show')->name('perfil.show');
Route::get('/perfiles/{perfil}/edit','PerfilController@edit')->name('perfil.edit');
Route::put('/perfiles/{perfil}','PerfilController@update')->name('perfil.update');


//almacena los likes de la receta pivot
Route::post('/recetas/{receta}','LikesController@update')->name('likes.update');






Auth::routes();

/* Route::get('/home', 'HomeController@index')->name('home'); */
