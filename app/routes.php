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

//nos dirige a al contlevelador encargado de hacer la verificacion del login
Route::post('login','UserLogin@user');


//ruta para cerrar sesión y nos redirige a la portada
Route::get('logout', function()
{ 
	Auth::logout();
	return Redirect::to('/');
 
});

//Rutas para activar los controladores
Route::controller('tierras','TierrasController');

//para ingresar a las siguientes rutas se tiene que estar autenticado:
Route::group(array('before' => 'auth'), function()
{
	//solo pueden acceder los miembros del grupo uno a las siguientes vistas:
	Route::group(array('before' => 'grupo1'), function()
     {
     	//solo puede ingresar el level 1 a la vista 1
     	Route::group(array('before' => 'level1'), function()
     	{
     		Route::get('/vista1',function(){return View::make('vista1');});
     	});
     	//solo pueden ingresar los leveles 1 y 2 a la vista 2
		Route::group(array('before' => 'level2'), function()
     	{
     		Route::get('/vista2',function(){return View::make('vista2');});
    });
  });

  //solo pueden acceder los miembros del grupo dos a las siguientes vistas:
  Route::group(array('before' => 'grupo3' || 'grupo1'), function(){
    //solo acceden los q tienen permiso level 1 dentro del grupo 1 y 3
    Route::group(array('before' => 'level1'), function(){
      //melleva a la vista de consulta general de tierras
      Route::get('consulta_general_tierras','TierrasController@ListadoProcesogral');
      //melleva a la vista de consulta por proceso de tierras
      Route::get('consulta_por_proceso',function(){return View::make('modulotierras/consultaporproceso');});
      // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproini
      Route::get('carga_inicial','TierrasController@ListadoProini');
      // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproceso
      Route::get('procesos_adjudicados','TierrasController@ListadoProceso');
      //melleva a la vista de edicion del proceso seleccionado
      Route::get('procesos_adjudicados_edicion',function(){return View::make('modulotierras/procesosadjudicadosedicion');});
      //melleva a la vista de levantamiento topografico
      Route::get('levantamiento_topografico','TierrasController@ListadoLevtopo');
    });

  });

	//Ruta del home si se encuentra autenticado
	Route::get('principal', function(){return View::make('principal');});
  Route::post('cambiopass','UserLogin@cambiar');
});

// ruta al controlador restfull donde esta toda la informacion de tierras
//Route::get('vista3','TierrasController@Listado');
Route::get('vista3',function(){return View::make('vista3');});