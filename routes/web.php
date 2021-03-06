<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//ruta para mostrar la página Principal
Route::get('/', 'InicioController@index')->name('inicio.index');

//con el index se trabaja para mostrar la ruta de vista principal al usuario logueado
Route::get('/recetas', 'RecetaController@index')->name('recetas.index');
//con el create se busca mostrar la ruta de donde esta el formulario de recetas
Route::get('/recetas/create', 'RecetaController@create')->name('recetas.create');
//con el store es para cuando se quiere guardar los datos del formulario
Route::post('/recetas', 'RecetaController@store')->name('recetas.store');
//con el show es para cuando se quiere mostrar datos ya almacenados
Route::get('/recetas/{receta}', 'RecetaController@show')->name('recetas.show');
//con el edit es para cuando se quiere editar registros almacenados en la DB
Route::get('/recetas/{receta}/edit', 'RecetaController@edit')->name('recetas.edit');
//con el update se puede actualizar de manera parcial o totalitaria los datos de registro
Route::put('/recetas/{receta}', 'RecetaController@update')->name('recetas.update');
//con el destroy se puede eliminar de manera totalitaria los datos de registro de la base de datos
Route::delete('/recetas/{receta}', 'RecetaController@destroy')->name('recetas.destroy');

Route::get('/categoria/{categoriaReceta}', 'CategoriasController@show')->name('categorias.show');

//Buscador de recetas
Route::get('/buscar', 'RecetaController@search')->name('buscar.show');
/* con esta linea se reemplaza todas las rutas anteriores y va a funcionar de igual manera.
Route::resource('recetas', 'RecetaController'); */

//mostrar perfiles
Route::get('/perfiles/{perfil}', 'PerfilController@show')->name('perfiles.show');
//con el edit es para cuando se quiere editar registros almacenados en la DB
Route::get('/perfiles/{perfil}/edit', 'PerfilController@edit')->name('perfiles.edit');
//con el update se puede actualizar de manera parcial o totalitaria los datos de registro
Route::put('/perfiles/{perfil}', 'PerfilController@update')->name('perfiles.update');
Auth::routes();

//almacena los likes de la receta
//con el store es para cuando se quiere guardar los datos del formulario
Route::post('/recetas/{receta}', 'LikesController@update')->name('likes.update');
//Route::get('/home', 'HomeController@index')->name('home');
