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

Route::get('/', function () {
    return view('welcome');
});

//con el index se trabaja para mostrar la ruta de vista principal
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
Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
