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
Route::controller('password', 'RemindersController');
Route::get('forgotpassword', 'RemindersController@getRemind');

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
Route::controller('siscadi','SiscadiController'); 

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
    //Ruta para solicitar el cambio de password

   

  });

  Route::group(array('before'=>'accesogen'), function(){
    //melleva a la vista de consulta general de tierras
    Route::get('consulta_general_tierras','TierrasController@ListadoProcesogral');
    //Ruta para elaborar grafica de reporte juridico
    Route::get('reporte_responsable_juridico', 'TierrasController@ResponsableJuridico');
    //Ruta para elaborar grafica de levantamiento topograficos requeridos
    Route::get('reporte_lavantamiento_topografico', 'TierrasController@RLevantamientoTopogragfico');
    //Ruta para elaborar grafica de area levantada
    Route::get('reporte_area_levantada', 'TierrasController@ReporAreaLevantada');
    //Ruta para elaborar grafica de reporte por estado
    Route::get('reporte_estado', 'TierrasController@ReporEstado');
    //Ruta para elaborar reporte por numero de proceso
    Route::get('reporte_numero_proceso', 'TierrasController@ReporNumPro');
    //Ruta para el visor de mapas
    Route::get('mapas', function(){return View::make('modulotierras/mapas');});
    //Ruta para generar pdf
    Route::get('despdf','TierrasController@Generarpfd');
    //Ruta para consulta por proceso
    Route::get('consultar_proceso', 'TierrasController@ConsultaDetallada');
    
    
  });

  Route::group(array('before'=>'levgeografico'), function(){
    //melleva a la vista de levantamiento topografico
    Route::get('levantamiento_topografico','TierrasController@ListadoLevtopo');
      
  });
  
  Route::group(array('before'=>'accesogme'), function(){
   //rutas para modulo de GME accesogme
    Route::get('validacion_certificacion', function(){return View::make('modulogme/validacionycertificacionemf');});  
    Route::get('metodologia_gme', function(){return View::make('modulogme/metodologiavalidacioncertificacionemf');});
    Route::get('distribucion_gme', function(){return View::make('modulogme/distribucionemf');});
    Route::get('informes_gme', function(){return View::make('modulogme/informestrimestralesemf');});
  //termina rutas para modulo de GME
  });

    //rutas para modulo de SISCADI 

  Route::post('depto', 'SiscadiController@showDepto');
  Route::post('muni', 'SiscadiController@showMuni');
  Route::post('monit', 'SiscadiController@showMonitor');

  Route::get('reporte', 'SiscadiController@reporte_encuesta');
  Route::post('pdfa', 'SiscadiController@repote_mision');
  Route::post('general', 'SiscadiController@repote_general');
  Route::post('monitor', 'SiscadiController@repote_monitor');
  Route::get('siscadi_indicadores', 'SiscadiController@siscadi_indicadores');
  //termina rutas para modulo de SISCADI    


});

// ruta al controlador restfull donde esta toda la informacion de tierras
//Route::get('vista3','TierrasController@Listado');
//Route::get('vista3',function(){return View::make('vista3');});
  Route::get('vista3','TierrasController@PruebaPro');

  Route::get('coordenadas_edicion','TierrasController@UpdateProcesogeo');

//permite acceso a las vistas del modulo de documentos
  Route::get('carge_docu', function(){return View::make('modulodocumentos/carguedocumentos');});
  Route::get('consulta_docu', function(){return View::make('modulodocumentos/consultadocumentos');});
  
  Route::group(array('before' => 'grupo1'), function()
  {
    //solo puede ingresar el level 1 a la vista 1
    Route::group(array('before' => 'level1'), function()
      {
        Route::get('/vista1',function(){return View::make('vista1');});
      });
       
  });
