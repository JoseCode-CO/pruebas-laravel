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

//Forma de proteger rutas con middleware
Route::get('user/{name?}', function ($name) {
    return $name;
})->middleware('auth');


//Rutas resource
 Route::resource('pages', 'PagesController')->names('crud'); 

 //Validar string
 Route::get('formulario', 'FormController@index');
 Route::post('formulario', 'FormController@store')->name('guardar');

 //Validar number
 Route::get('formulario2', 'PruebaController@index');
 Route::post('formulario2', 'PruebaController@store')->name('guardar2');

 //Puebas eloquent

 use App\Post;
 Route::get('eloquent', function () {
 
    //Sirve para mostrar todos los datos
    // $post = Post::all();

    // foreach($post as $post){
    //     echo"$post->id $post->titulo  <br> $post->descripcion <br>";
    // }

    //Mostrará los datos que cumplan esa condicion, y los ordena de mayor a menor
    $dato = 30;
    $post = Post::where('id', '<', $dato)->orderBy('id', 'desc')->get();

    foreach($post as $post){
        echo"$post->id $post->titulo  <br> $post->descripcion <br>";
    }
    
});
