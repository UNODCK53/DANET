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


Route::get('municipios_concentracion',function(){return View::make('access_outside/visor_acuerdo');});

//----------------------------------------------------------------------------------------------------------------------------------------------
//Modulo GIZ 
Route::get('Cooperacion_GIZ',function(){return View::make('access_outside/giz');});
//Route::get('Cooperacion_GIZ_datosrelevantes',function(){return View::make('access_outside/giz/gizdatrelev');});
//Route::get('Cooperacion_GIZ_datosrelevantes', array('uses' => 'gizController@DistribGIZdepartamental'));
Route::get('Cooperacion_GIZ_datosrelevantes','gizController@DistribGIZdepartamental');
Route::get('Cooperacion_GIZ_visorgeo','gizController@mapGIZ');
//Route::get('Cooperacion_GIZ_visorgeo',function(){return View::make('access_outside/giz/gizvisor');});
Route::get('Cooperacion_GIZ_documentos',function(){return View::make('access_outside/giz/gizdocu');});
//-----------------------------------------------------------------------------------------------------------------------------------------------


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
	Session::forget('acc');
  Auth::logout();
	return Redirect::to('/'); 
});

//Rutas para activar los controladores
Route::controller('admin','AdminController');
Route::controller('tierras','TierrasController');
Route::controller('siscadi','SiscadiController');
Route::controller('documentos','DocumentosController');
Route::controller('geoapi','GeoapiController');
Route::controller('giz','gizController');
Route::controller('artzvtn','ArtzvtnController');
Route::controller('artplan100','Artplan100Controller');    
Route::controller('password', 'RemindersController');
Route::get('forgotpassword', 'RemindersController@getRemind');
//para ingresar a las siguientes rutas se tiene que estar autenticado:
Route::group(array('before' => 'auth'), function()
{
  //Ruta del home si se encuentra autenticado
  Route::get('principal', function(){return View::make('principal');});
  Route::post('cambiopass','UserLogin@cambiar');
  //--------------------------------------------------------------------------------------------------------------------------
  //Rutas módulo de tierras
  Route::group(array('before'=>'consulgentierras'), function(){
    //melleva a la vista de consulta general de tierras
    Route::get('consulta_general_tierras','TierrasController@ListadoProcesogral');
    //Ruta para consulta por proceso
    Route::get('consultar_proceso', 'TierrasController@ConsultaDetallada');
  });  
  Route::get('reporte_estado', array('before' => 'reporestadotierras', 'uses' => 'TierrasController@ReporEstado'));
  Route::group(array('before'=>'repornumtierras'), function(){
    //Ruta para elaborar reporte por numero de proceso
    Route::get('reporte_numero_proceso', 'TierrasController@ReporNumPro');
    //Ruta para generar pdf
    Route::get('despdf','TierrasController@Generarpfd');
  });
  Route::get('reporte_lavantamiento_topografico', array('before' => 'reporlevtopotierras', 'uses' => 'TierrasController@RLevantamientoTopogragfico'));
  Route::get('reporte_area_levantada', array('before' => 'reporarealevtierras', 'uses' => 'TierrasController@ReporAreaLevantada'));
  Route::get('reporte_responsable_juridico', array('before' => 'consulresjuritierras', 'uses' => 'TierrasController@ResponsableJuridico'));
  Route::get('reporte_genero', array('before' => 'reporgenero', 'uses' => 'TierrasController@Reporgenero'));
  Route::get('reporte_tiempo', array('before' => 'reportiempo', 'uses' => 'TierrasController@Reportiempo'));
  Route::group(array('before'=>'cargainicialtierras'), function(){
    // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproini
    Route::get('carga_inicial','TierrasController@ListadoProini');
    //Controlador para exportar a excel la tabla de procesos iniciales
    Route::get('excelcar','TierrasController@Excelcarini');
  });
  Route::group(array('before'=>'procesosadjudicadostierras'), function(){
    // ruta al controlador restfull donde esta toda la informacion de tierras ro al metodo listadoproceso
    Route::get('procesos_adjudicados','TierrasController@ListadoProceso');
    //ruta controlador consulta datos para procesoso adjudicados edicion
    Route::get('procesos_adjudicados_editar','TierrasController@Datosprocesos');
    //Ruta para solicitar el cambio de password
  });
  Route::get('levantamiento_topografico', array('before' => 'levgeograficotierras', 'uses' => 'TierrasController@ListadoLevtopo'));
  //Ruta para edición de coordenadas
  Route::get('coordenadas_edicion', array('before' => 'editcoortierras', 'uses' => 'TierrasController@UpdateProcesogeo'));
  Route::get('mod_coordenadas', array('before' => 'editcoortierras', 'uses' => 'TierrasController@EditCoordenadas'));
  
  //Ruta para el visor de mapas
  Route::get('mapas', array('before'=>'consmapfierras', function(){return View::make('modulotierras/mapas');}));
  //Termina Rutas módulo tierras
  //--------------------------------------------------------------------------------------------------------------------------
  //Rutas módulo GME
  //Rutas para Validación de certificación
  Route::get('validacion_certificacion', array('before'=>'valcertGME', function(){return View::make('modulogme/validacionycertificacionemf');}));
  //Ruta Metodología GME
  Route::get('metodologia_gme', array('before'=>'metodologiaGME', function(){return View::make('modulogme/metodologiavalidacioncertificacionemf');}));
  //Ruta Distribución GME
  Route::get('distribucion_gme', array('before'=>'distGME', function(){return View::make('modulogme/distribucionemf');}));
  //Ruta Informes GME
  Route::get('informes_gme', array('before'=>'informesGME', function(){return View::make('modulogme/informestrimestralesemf');}));
  //termina rutas para módulo de GME
  //--------------------------------------------------------------------------------------------------------------------------
  //rutas para modulo de SISCADI
  Route::get('siscadi_encuentas', array('before' => 'ConsencSISCADI', 'uses' => 'SiscadiController@reporte_encuesta'));
  Route::get('siscadi_indicadores', array('before' => 'indicarecoSISCADI', 'uses' => 'SiscadiController@siscadi_indicadores'));
  Route::get('siscadi_estadisticas', array('before' => 'EstadisticaSISCADI', 'uses' => 'SiscadiController@siscadi_repestadistic'));
  //Route::get('siscadi_estadisticas',function(){return View::make('modulosiscadi/diagnosticoterritorial');});
  //termina rutas para modulo de SISCADI 
  //--------------------------------------------------------------------------------------------------------------------------
  //Rutas para módulo de Docuementos
  Route::get('cargue_docu', array('before' => 'cargueDOCUMENTOS', 'uses' => 'DocumentosController@CarguedocuInicio'));
  Route::get('consulta_docu', array('before' => 'consulDOCUMENTOS', 'uses' => 'DocumentosController@Consultadocumentos'));
  //Route::get('consulta_docu', array('before'=>'consulDOCUMENTOS', function(){return View::make('modulodocumentos/consultadocumentos');}));
  Route::get('repor_docu', array('before'=>'reporDOCUMENTOS', function(){return View::make('modulodocumentos/reportedocumentos');}));
  //Termina rutas para el módulo de Documentos
  //--------------------------------------------------------------------------------------------------------------------------
  //Rutas para módulo de Geoapi  
  Route::get('tecnicosaf', array('before'=>'tecsafGEOAPI', function(){return View::make('modulogeoapi/tecnicosaf');}));  
  Route::get('distribucion_organizacion', array('before' => 'repordistorgGEOAPI', 'uses' => 'GeoapiController@DistribOrganiz'));
  //Termina rutas para el módulo de Geoapi
  //--------------------------------------------------------------------------------------------------------------------------

  //Rutas para módulo de ART
    //Inversion Social    
  Route::get('ivsocidashboard', array('before'=>'MenuARTDashBoard', function(){return View::make('moduloart/ivsocidashboard');}));
  Route::get('ivsocicensofamilias', array('before'=>'MenuARTCensoFamilias', function(){return View::make('moduloart/ivsocicensofamilias');}));
  Route::get('ivsocidiagnosticofamiliar', array('before'=>'MenuARTDiagnosticoFamiliar', function(){return View::make('moduloart/ivsocidiagnosticofamiliar');}));
  Route::get('ivsociconsultapic', array('before'=>'MenuARTConsultaPIC', function(){return View::make('moduloart/ivsociconsultapic');}));
  Route::get('ivsocicarguefamilias', array('before'=>'MenuARTCargueFamilias', function(){return View::make('moduloart/ivsocicarguefamilias');}));
  Route::get('ivsocifichapriorizadaproy', array('before'=>'MenuARTFichaPriorizacionProy', function(){return View::make('moduloart/ivsocifichapriorizadaproy');}));
  Route::get('ivsociseguimientopic', array('before'=>'MenuARTSeguimientoPIC', function(){return View::make('moduloart/ivsociseguimientopic');}));
    //Zona Veredal
  Route::get('zvtabpresidente', array('before'=>'MenuARTTableroPresidente', function(){return View::make('moduloart/zvtabpresidente');}));
  Route::get('zvtabgeneral', array('before'=>'MenuARTTableroGeneral', function(){return View::make('moduloart/zvtabgeneral');}));
  Route::get('zvtabdetallado', array('before'=>'MenuARTTableroDetallado', function(){return View::make('moduloart/zvtabdetallado');}));
  Route::get('zvcargaindicador', array('before'=>'MenuARTCargaIndicador', 'uses' => 'ArtzvtnController@zvtn_indicadores'));
  Route::get('zvsegindicador', array('before'=>'MenuARTSeguimientoIndicador', 'uses' => 'ArtzvtnController@zvtn_seguimiento'));
    //Normatividad  
  Route::get('normtabindicador', array('before'=>'MenuARTTableroNorma', function(){return View::make('moduloart/normtabindicador');}));
  Route::get('normcarganorma', array('before'=>'MenuARTCargaEditarNorma', function(){return View::make('moduloart/normcarganorma');}));
  //Plan 100 dias y Respuesta Rapida
  Route::get('plancienrrconsulproy', 'Artplan100Controller@plan100_ini_consulta');
  Route::get('plancienrrcargaproy', 'Artplan100Controller@plan100_ini');

  //Termina rutas para el módulo de ART
  //--------------------------------------------------------------------------------------------------------------------------
  //Rutas para módulo de GUARDAUN  
  Route::get('guardaun', array('before'=>'guardaUN', function(){return View::make('guardaun');}));
  //Termina rutas para el módulo de GUARDAUN
  //--------------------------------------------------------------------------------------------------------------------------

//rutas de prueba despues de pruebas se pueden borrar
  Route::group(array('before' => 'grupo1|level1'), function()
  {
    //solo puede ingresar el level 1 a la vista 1  
    Route::get('accvistas',function(){return View::make('admin/accesovistas');});
    Route::get('diferencia','TierrasController@Diferenciafechas');
    
  });
});//Cierra rutas para usuarios autenticados

// ruta al controlador restfull donde esta toda la informacion de tierras
//Route::get('vista3','TierrasController@Listado');
  
Route::get('vista3','TierrasController@PruebaPro');
Route::get('vista1',function(){return View::make('vista1');});  
Route::get('master_docu','DocumentosController@Masterdocu');
Route::get('error', function(){return View::make('error');});
  
//permite acceso a las vistas del modulo de documentos
  
//Route::get('carge_docu', function(){return View::make('modulodocumentos/carguedocumentos');});

