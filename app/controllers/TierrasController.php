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
		$fecha = date("Y-m-d H:i:s");
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
	    			'viabilidad' => Input::get('modviable'),
	    			'obsviabilidad' => Input::get('modobsviab'),
	    			'respjuridico' => Auth::user()->id,
	    			'requiererespgeo' => Input::get('modradiorespogeo'),
	    			'respgeografico' => Input::get('modrepogeo'),
	    			'created_at' => $fecha,
	    			'updated_at' => $fecha,
	    			'vereda' => Input::get('modvereda'),
	    			'nombrepredio' => Input::get('modnompred'),
	    			'direccionnotificacion' => Input::get('moddirnoti'),
	    			'nombre' => Input::get('modnombre'),
	    			'cedula' => Input::get('modcedula'),
	    			'telefono' => Input::get('modtelefono')
		    )
		);
		
		//ruta donde se va a crear los procesos
		$path = public_path().'/procesos/'.Input::get('modnp').'/';
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){
						
		}
		else{
			File::makeDirectory($path,  $mode = 0777, $recursive = false);	
		}

		
		//consulta a la tabla de MODTIERRAS_PROCESO
		$idmaximo2 =  DB::table('MODTIERRAS_PROCESO')->max('OBJECTID');
		DB::table('MODTIERRAS_PROCESTADO')->insert(
		    array(
		    		'id_proceso' => Input::get('modnp'),
		    		'id_estado' => 1,
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha
		    )
		);
		if (Input::get('modconcpjuri')>= 7) {
			DB::table('MODTIERRAS_PROCESTADO')->insert(
		    	array(
		    		'id_proceso' => Input::get('modnp'),
		    		'id_estado' => 2,
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha
		    	)
			);
		}
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
		$arrayproceso = DB::select("SELECT t.id_proceso, Sum(CASE WHEN t.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN t.id_estado = '2' THEN (CASE WHEN t.conceptojuridico >= '7' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN t.id_estado = '3' THEN 1 ELSE 0 END) as radicado,	Sum(CASE WHEN t.id_estado = '4' THEN 1 ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN t.id_estado = '5' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN t.id_estado = '6' THEN 1 ELSE 0 END) as registroorip FROM (SELECT MODTIERRAS_PROCESTADO.id_proceso, MODTIERRAS_PROCESTADO.id_estado, MODTIERRAS_PROCESO.conceptojuridico, MODTIERRAS_PROCESO.respjuridico FROM [MODTIERRAS_PROCESTADO] JOIN [MODTIERRAS_PROCESO] ON MODTIERRAS_PROCESTADO.id_proceso=MODTIERRAS_PROCESO.id_proceso) as t where t.respjuridico = ".Auth::user()->id." group by t.id_proceso");
		
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		
		//return $arrayproceso;
		return View::make('modulotierras.procesosadjudicados', array('arrayproceso' => $arrayproceso), array('arrayconcepto' => $arrayconcepto));
	}
	public function getEditarProceso()
	{
		   
	    return Input::get('proceso');
	    //View::make('modulotierras.cargainicial', array('arrayproini' => $arrayproini), array('arrayconcepto' => $arrayconcepto));

	}	
	Public function ListadoProcesogral()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT t.id_proceso, Sum(CASE WHEN t.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN t.id_estado = '2' THEN (CASE WHEN t.conceptojuridico >= '7' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN t.id_estado = '3' THEN 1 ELSE 0 END) as radicado,	Sum(CASE WHEN t.id_estado = '4' THEN 1 ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN t.id_estado = '5' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN t.id_estado = '6' THEN 1 ELSE 0 END) as registroorip FROM (SELECT MODTIERRAS_PROCESTADO.id_proceso, MODTIERRAS_PROCESTADO.id_estado, MODTIERRAS_PROCESO.conceptojuridico, MODTIERRAS_PROCESO.respjuridico FROM [MODTIERRAS_PROCESTADO] JOIN [MODTIERRAS_PROCESO] ON MODTIERRAS_PROCESTADO.id_proceso=MODTIERRAS_PROCESO.id_proceso) as t group by t.id_proceso");
				//return $arrayproceso;
		return View::make('modulotierras.consultageneral', array('arrayproceso' => $arrayproceso));
	}
}

?>