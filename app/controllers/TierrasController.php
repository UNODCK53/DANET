<?php

class TierrasController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}

	//despues de la funcion se pone el verbo por ejemplo getIndex
	public function ListadoProini()
	{
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arrayproini = DB::select('SELECT DISTINCT * FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		//return View::make('modulotierras.consultageneral')->with('arrayproini',$arrayproini, 'arrayconcepto',$arrayconcepto);
		//return View::make('modulotierras.consultageneral')->with('resultado', $resultado);
		return View::make('modulotierras.cargainicial', array('arrayproini' => $arrayproini), array('arrayconcepto' => $arrayconcepto));
	}
	public function getCrearProceso()
	{
		//consulta a la tabla de MODTIERRAS_PROCESO
		$idmaximo =  DB::table('MODTIERRAS_PROCESO')->max('OBJECTID');
  		// insertar campos a la tabla
	    DB::table('MODTIERRAS_PROCESO')->insert(
		    array(
		    		'OBJECTID'  => ($idmaximo+1),
		    		'id_proceso' => Input::get('modnp'),
		    		'conceptojuridico' => Input::get('modconcpjuri'),
		    		'obsconceptojuridico' => Input::get('modobsconcjuri'),
		    	  	'areapredioformalizada' => Input::get('modarea'),
		    	  	'longitud' => Input::get('modlong'),
		    	  	'latitud' => Input::get('modlat'),
	    			'fechainspeccionocular' => Input::get('modfechaocular'),
	    			'viabilidad' => Input::get('modviable'),
	    			'obsviabilidad' => Input::get('modobsviab'),
	    			'respjuridico' => Auth::user()->id,
	    			'requiererespgeo' => Input::get('modradiorespogeo'),
	    			'respgeografico' => Input::get('modrepogeo'),
	    			'created_at' => date("Y-m-d H:i:s"),
	    			'updated_at' => date("Y-m-d H:i:s"),
	    			'vereda' => Input::get('modvereda'),
	    			'nombrepredio' => Input::get('modnompred'),
	    			'direccionnotificacion' => Input::get('moddirnoti'),
	    			'nombre' => Input::get('modnombre'),
	    			'cedula' => Input::get('modcedula'),
	    			'telefono' => Input::get('modtelefono')
		    )
		);
		
		//ruta donde se va a crear los procesos
		$path = public_path() . '/procesos/'.Input::get('modnp').'/';
		// creacion de carpeta dependiendo del nombre del proceso
		File::makeDirectory($path,  $mode = 0777, $recursive = false);
		//consulta a la tabla de MODTIERRAS_PROCESO
		
		$idmaximo2 =  DB::table('MODTIERRAS_PROCESO')->max('OBJECTID');
		//compara si efectivamente ingreso el registro a la tabla MODTIERRAS_PROCESO y retorna una variable a la vista
	 		if ($idmaximo < $idmaximo2){
				return Redirect::to('carga_inicial')->with('status', 'ok_estatus');		
			}
			else{
	          	return Redirect::to('carga_inicial')->with('status', 'error_estatus');
	      	}
	    

	}
	public function ListadoProceso()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select('SELECT * FROM [DABASE].[sde].[MODTIERRAS_PROCESO] where respjuridico = '.Auth::user()->id);
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		
		//return $arrayproceso;
		return View::make('modulotierras.estudiojuridico', array('arrayproceso' => $arrayproceso), array('arrayconcepto' => $arrayconcepto));
	}	
}

?>