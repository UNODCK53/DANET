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
    //Ruta del home si se encuentra autenticado
    Route::get('principal', function(){return View::make('principal');});
    Route::post('cambiopass','UserLogin@cambiar');

  Route::group(array('before'=>'cargainicial'), function(){
    // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproini
    Route::get('carga_inicial','TierrasController@ListadoProini');
    //Controlador para exportar a excel la tabla de procesos iniciales
    Route::get('excelcar','TierrasController@Excelcarini');
    // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproceso
    Route::get('procesos_adjudicados','TierrasController@ListadoProceso');
    //ruta controlador consulta datos para procesoso adjudicados edicion
    Route::get('procesos_adjudicados_editar','TierrasController@Datosprocesos');

  });

  Route::group(array('before'=>'accesogen'), function(){
    //melleva a la vista de consulta general de tierras
    Route::get('consulta_general_tierras','TierrasController@ListadoProcesogral');
    //Ruta para elaborar grafica de reporte juridico
    Route::get('reporte_responsable_juridico', 'TierrasController@ResponsableJuridico');
    //Ruta para elaborar grafica de levantamiento topograficos requeridos
    Route::get('reporte_lavantamiento_topografico', 'TierrasController@RLevantamientoTopogragfico');
    //Ruta para el visor de mapas
    Route::get('mapas', function(){return View::make('modulotierras/mapas');});
    
  });

  Route::group(array('before'=>'levgeografico'), function(){
    //melleva a la vista de levantamiento topografico
    Route::get('levantamiento_topografico','TierrasController@ListadoLevtopo');
      
  });    
    	
});

// ruta al controlador restfull donde esta toda la informacion de tierras
//Route::get('vista3','TierrasController@Listado');
//Route::get('vista3',function(){return View::make('vista3');});
    Route::get('vista3','TierrasController@PruebaPro');
  Route::group(array('before' => 'grupo1'), function()
  {
    //solo puede ingresar el level 1 a la vista 1
    Route::group(array('before' => 'level1'), function()
      {
        Route::get('/vista1',function(){return View::make('vista1');});
      });
       
  });
