<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

Auth::routes();

#Auth::routes(['register' => false]);

Route::get('/home', 'HomeController@index')->name('home');
#Vendedor
Route::resource('cliente', 'ClienteController')->middleware('auth');
Route::resource('aprobarcliente', 'AprobarclienteController')->middleware('auth');

#Cotización
Route::resource('cotizacion', 'CotizacionController')->middleware('auth');
Route::get('/cotizacion/{id}', 'CotizacionController@show')->middleware('auth');;

#Diseño
Route::resource('diseno', 'DisenoController')->middleware('auth');
Route::resource('archivodiseno', 'ArchivodisenoController')->middleware('auth');

#Taller
Route::resource('taller', 'TallerController')->middleware('auth');
Route::resource('finalizarpedido', 'FinalizarpedidoController')->middleware('auth');

#Pedidos
Route::resource('pedidos', 'PedidoController')->middleware('auth');

#Reportes
Route::resource('reportes', 'ReporteController')->middleware('auth');
Route::get('reporte/bfecha', 'ReporteController@bfecha')->name('reporte.busqueda')->middleware('auth');

#Mantenedor
Route::resource('mantenedorusuario', 'MantenedorusuarioController')->middleware('auth');
Route::resource('registrousuario', 'registrousuarioController')->middleware('auth');
Route::resource('registroimpresora', 'RegistroimpresoraController')->middleware('auth');

#Archivos
Route::get('archivos',function(){


    return view('template');

})->name('archivos')->middleware('auth');


#Archivos
Route::post('archivos/upload',function(Request $request){

    $file  = $request->file('archivo');
    //$path  = Storage::disk('public')->put('txt', $file);
    $path = Storage::disk('public')->putFileAs('photos', $file , 'data.txt');
  
    return asset('storage/'.$path);

})->name('archivos.upload')->middleware('auth');

