<?php

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

Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas protegidas

Route::group(['middleware'=>['auth','verified']], function(){
    //Rutas de vacantes protegidas
    Route::get('/vacantes', 'VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes','VacanteController@store')->name('vacantes.store');

    //Subir Imagenes

    Route::post('/vacantes/imagen','VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen', 'VacanteController@borrarimagen')->name('vacantes.borrar');
});

//Rutas Vacantes sin proteger, Muestra los trabajos en el fron end sin autetificacion
Route::get('/vacantes/{vacante}', 'VacanteController@show')->name('vacantes.show');

