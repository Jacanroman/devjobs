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


Auth::routes(['verify'=>true]);




//Rutas protegidas

Route::group(['middleware'=>['auth','verified']], function(){
    //Rutas de vacantes protegidas
    Route::get('/vacantes', 'VacanteController@index')->name('vacantes.index');
    Route::get('/vacantes/create', 'VacanteController@create')->name('vacantes.create');
    Route::post('/vacantes','VacanteController@store')->name('vacantes.store');
    Route::delete('/vacantes/{vacante}', 'VacanteController@destroy')->name('vacantes.destroy');
    Route::get('/vacantes/{vacante}/edit', 'VacanteController@edit')->name('vacantes.edit');
    Route::put('/vacantes/{vacante}', 'VacanteController@update')->name('vacantes.update');

    //Subir Imagenes

    Route::post('/vacantes/imagen','VacanteController@imagen')->name('vacantes.imagen');
    Route::post('/vacantes/borrarimagen', 'VacanteController@borrarimagen')->name('vacantes.borrar');

    //Cambiar el estado de la vacante
    Route::post('/vacantes/{vacante}', 'VacanteController@estado')->name('vacates.estado');


    //Notificaciones

    Route::get('/notificaciones','NotificacionesController')->name('notificaciones');
});

//PAGINA DE INICIO
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/','InicioController')->name('inicio');

//Categorias
Route::get('/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');

//Enviar datos para una vacante

Route::post('/candidatos/store', 'CandidatoController@store')->name('candidatos.store');
Route::get('/candidatos/{id}','CandidatoController@index')->name('candidatos.index');

//Rutas Vacantes sin proteger, Muestra los trabajos en el fron end sin autetificacion
Route::get('/vacantesbusqueda/buscar', 'VacanteController@resultados')->name('vacantes.resultados');
Route::post('/vacantesbusqueda/buscar', 'VacanteController@buscar')->name('vacantes.buscar');
Route::get('/vacantes/{vacante}', 'VacanteController@show')->name('vacantes.show');

