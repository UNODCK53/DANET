<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Ruta del index
Route::get('/', function()
{
	return View::make('portada');
});

//nos dirige a al controlador encargado de hacer la verificacion del login
Route::post('login','UserLogin@user');

//ruta para cerrar sesión y nos redirige a la portada
Route::get('logout', function()
{ 
	Auth::logout();
	return Redirect::to('/');
 
});



//para ingresar a las siguientes rutas se tiene que estar autenticado:
Route::group(array('before' => 'auth'), function()
{
	//solo pueden acceder los miembros del grupo uno a las siguientes vistas:
	Route::group(array('before' => 'group1'), function()
     {
     	//solo puede ingresar el rol 1 a la vista 1
     	Route::group(array('before' => 'rol1'), function()
     	{
     		Route::get('/vista1',function(){return View::make('vista1');});
     	});
     	//solo pueden ingresar los roles 1 y 2 a la vista 2
		Route::group(array('before' => 'rol2' && 'rol1'), function()
     	{
     		Route::get('/vista2',function(){return View::make('vista2');});
     	});

     });
	//Ruta del home si se encuentra autenticado
	Route::get('principal', function(){return View::make('principal');});
});