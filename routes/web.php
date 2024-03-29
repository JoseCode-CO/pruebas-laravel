<?php

use Illuminate\Support\Facades\Route;
use App\Post;
use App\User;

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


    //Mostrará los post del usuario numero 4
    $dato = 4;
    $post = Post::where('user_id', '=', $dato)->orderBy('id', 'desc')->get();

    foreach($post as $post){
        echo"$post->id $post->titulo  <br> $post->descripcion <br>";
    }
    
});


Route::get('usuario', function () {

    $usuario = User::all();

    foreach($usuario as $usuarios){
        //$usuarios->posts->count() para contar todos los post que van relacionado a ese usuario
        echo"$usuarios->id $usuarios->name {$usuarios->posts->count()} <br>";
    }
    
});


Route::get('coleccion', function () {

    $usuario = User::all();

   //todo los usuarios
   //dd($usuario->all());

   //Comprueba si se tiene un elemento en x posicion, devuelve un true si lo encuentra y un false si no lo encuentra
   //dd($usuario->contains(5));

   //Muestra un array con todos los elementos menos el que esté en la posicion que se defina
   //dd($usuario->except([1,2]));

   //Solo el elemento que se defina
   //dd($usuario->only([1,2]));

   //Buscar por id
   //dd($usuario->find(2));

   //Buscar los elementos que estan relacionados con el id seleccionado, le pasamos el nombre del modelo que tiene la relacion
   dd($usuario->load('posts'));
    
});


Route::get('serializacion', function () {

    $usuario = User::all();

   //Los datos en formato array
   //dd($usuario->load('posts')->toArray());

   //Los datos en formato json
   dd($usuario->load('posts')->toJson());


    
});

