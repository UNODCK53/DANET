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
		$arrayrespgeografico = DB::select('SELECT id,name,last_name,grupo,level FROM users where grupo=3 and level=3');
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico);

		return View::make('modulotierras.cargainicial', array('arrayproini' => $arrayproini), array('arraydombobox' => $arraydombobox));
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
		$path = public_path().'\procesos\\'.Input::get('modnp');
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
	public function getEditarProceso()
	{
		$fecha = date("Y-m-d H:i:s");
		$procesiid = Input::get('modnp');
		
  		// insertar campos a la tabla
	    DB::table('MODTIERRAS_PROCESO')->where('id_proceso', Input::get('modnp'))->update(	    	
		    array(
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
	    			'updated_at' => $fecha,
	    			'vereda' => Input::get('modvereda'),
	    			'nombrepredio' => Input::get('modnompred'),
	    			'direccionnotificacion' => Input::get('moddirnoti'),
	    			'nombre' => Input::get('modnombre'),
	    			'cedula' => Input::get('modcedula'),
	    			'telefono' => Input::get('modtelefono')	    			
		    )					
		);
		return Redirect::to('procesos_adjudicados')->with('actualizar', $procesiid);
	      	
	}
	public function ListadoProceso()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT t.id_proceso, Sum(CASE WHEN t.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN t.id_estado = '2' THEN (CASE WHEN t.conceptojuridico >= '7' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN t.id_estado = '3' OR t.id_estado = '4' THEN 1 ELSE 0 END) as radicado,	Sum(CASE WHEN t.id_estado = '5' THEN 1 ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN t.id_estado = '6' OR t.id_estado = '7' OR t.id_estado = '8' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN t.id_estado = '9' THEN 1 ELSE 0 END) as registroorip	FROM (SELECT MODTIERRAS_PROCESTADO.id_proceso, MODTIERRAS_PROCESTADO.id_estado, MODTIERRAS_PROCESO.conceptojuridico, MODTIERRAS_PROCESO.respjuridico FROM [MODTIERRAS_PROCESTADO] JOIN [MODTIERRAS_PROCESO] ON MODTIERRAS_PROCESTADO.id_proceso=MODTIERRAS_PROCESO.id_proceso) as t where t.respjuridico = ".Auth::user()->id." group by t.id_proceso");
		
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		
		//return $arrayproceso;
		return View::make('modulotierras.procesosadjudicados', array('arrayproceso' => $arrayproceso), array('arrayconcepto' => $arrayconcepto));
	}
	public function ListadoProcesogral()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT t.id_proceso, Sum(CASE WHEN t.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN t.id_estado = '2' THEN (CASE WHEN t.conceptojuridico >= '7' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN t.id_estado = '3' THEN 1 ELSE 0 END) as radicado,	Sum(CASE WHEN t.id_estado = '4' THEN 1 ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN t.id_estado = '5' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN t.id_estado = '6' THEN 1 ELSE 0 END) as registroorip FROM (SELECT MODTIERRAS_PROCESTADO.id_proceso, MODTIERRAS_PROCESTADO.id_estado, MODTIERRAS_PROCESO.conceptojuridico, MODTIERRAS_PROCESO.respjuridico FROM [MODTIERRAS_PROCESTADO] JOIN [MODTIERRAS_PROCESO] ON MODTIERRAS_PROCESTADO.id_proceso=MODTIERRAS_PROCESO.id_proceso) as t group by t.id_proceso");
				//return $arrayproceso;
		return View::make('modulotierras.consultageneral', array('arrayproceso' => $arrayproceso));
	}
	public function ListadoLevtopo()
	{
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arraylevtopo = DB::select('SELECT * FROM MODTIERRAS_PROCESO WHERE requiererespgeo=1 and respgeografico ='.Auth::user()->id.' AND NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESTADO WHERE MODTIERRAS_PROCESO.id_proceso=MODTIERRAS_PROCESTADO.id_proceso AND MODTIERRAS_PROCESTADO.id_estado=2)' );
		
		//return $arraylevtopo;
		return View::make('modulotierras.levantamientotopografico', array('arraylevtopo' => $arraylevtopo));
	}
	public function postAdjuntarLevtopo()
	{		
		$path = public_path().'\procesos\\'.Input::get('modnp');
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){
						
		}
		else{
			File::makeDirectory($path,  $mode = 0777, $recursive = false);	
		}

		if((Input::hasFile('modmapa')) and (Input::hasFile('modshp')) and (Input::hasFile('modtabla'))) {

			Input::file('modmapa')->move($path,Input::get('modnp').'_LT_MAPA.'.Input::file('modmapa')->getClientOriginalExtension());
    		Input::file('modshp')->move($path,Input::get('modnp').'_LT_SHP.'.Input::file('modshp')->getClientOriginalExtension());
    		Input::file('modtabla')->move($path,Input::get('modnp').'_LT_TABLA.'.Input::file('modtabla')->getClientOriginalExtension());

    		$fecha = date("Y-m-d H:i:s");
    		DB::table('MODTIERRAS_PROCESTADO')->insert(
		    	array(
		    		'id_proceso' => Input::get('modnp'),
		    		'id_estado' => 2,
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha
		    	)
			);
			DB::table('MODTIERRAS_PROCDOCUMENTOS')->insert(
		    	array(
		    		'id_proceso' => Input::get('modnp'),
		    		'id_documento' => 2,
		    		'rutadocu' => $path.'\\'.Input::get('modnp').'_LT_TABLA.'.Input::file('modtabla')->getClientOriginalExtension(),
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha
		    	)
			);	
       		return Redirect::to('levantamiento_topografico')->with('status', 'ok_estatus');
    	}
    	return Redirect::to('levantamiento_topografico')->with('status', 'error_estatus');
    }
    public function Excelcarini()
	{	
		Excel::create('Procesos iniciales',function($excel)
		{
			$excel->sheet('Tierras',function($sheet)
			{
				$data = array();
				$results = DB::select('SELECT DISTINCT id_proceso, vereda, nombrepredio, direccionnotificacion, nombre, cedula, telefono, areaprediopreliminar FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
				foreach ($results as $result) {
				$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:H1', function($cells) {
			    	$cells->setBackground('#dadae3');
				});
			})->download('xlsx');
		});
    }
    public function postEditarProceso()
	{
		Session::put('procesoi',Input::get('proceso'));
		return Redirect::to('procesos_adjudicados_editar');
	}

	public function Datosprocesos()
	{
		$idpro=(Session::get('procesoi'));
		if($idpro==''){
			return Redirect::to('procesos_adjudicados');
		}
		$arrayproceso = DB::select('SELECT * FROM MODTIERRAS_PROCESO WHERE id_proceso='.$idpro);
		$arrayrespgeografico = DB::select('SELECT id,name,last_name,grupo,level FROM users WHERE grupo=3 and level=3');
		$arrayconcepto = DB::select('SELECT * FROM MODTIERRAS_CONCEPTO');
		$arrayestado = DB::select('SELECT * FROM MODTIERRAS_ESTADO');
		$arrayprocestado = DB::select('SELECT * FROM MODTIERRAS_PROCESTADO WHERE id_proceso = '.$idpro);
		$arrayprocdocu = DB::select('SELECT * FROM MODTIERRAS_PROCDOCUMENTOS WHERE id_proceso = '.$idpro);
		
		
		$arraydocumento = DB::table('MODTIERRAS_CONCEPDOCUMENTO')
		->where ('MODTIERRAS_CONCEPDOCUMENTO.id_concepto','=', $arrayproceso[0]->conceptojuridico)
		->where ('MODTIERRAS_CONCEPDOCUMENTO.requieredocu','=','1')
		->join('MODTIERRAS_DOCUMENTOS', 'MODTIERRAS_DOCUMENTOS.id_documento','=','MODTIERRAS_CONCEPDOCUMENTO.id_documento')
		->select('MODTIERRAS_DOCUMENTOS.id_documento', 'MODTIERRAS_DOCUMENTOS.concepto','MODTIERRAS_DOCUMENTOS.avredocu')		
		->get();

		
		
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico, $arraydocumento, $arrayestado, $arrayprocestado, $arrayprocdocu);		
		Session::forget('procesoi');

		return View::make('modulotierras.procesosadjudicadosedicion', array('arrayproceso' => $arrayproceso), array('arraydombobox' => $arraydombobox));
	}
	public function postAdjuntarDocu()
	{		
		$path = public_path().'\procesos\\'.Input::get('modnp');
		$arrayprocdocu = DB::select('SELECT avredocu FROM MODTIERRAS_DOCUMENTOS WHERE id_documento ='.Input::get('modocu'));
		$procesiid = Input::get('modnp');
		// creacion de carpeta dependiendo del nombre del proceso
		
		if (File::exists($path)){
						
		}
		else{
			File::makeDirectory($path,  $mode = 0777, $recursive = false);	
		}

		//aca comienza los controladores para adjuntar documentos		
		$arraydocurevision = DB::select('SELECT * FROM MODTIERRAS_PROCDOCUMENTOS WHERE id_documento ='.Input::get('modocu').' AND id_proceso ='.Input::get('modnp'));
		
		
		if (empty($arraydocurevision)) {
			if (Input::get('modsubestado') != 0) {
			    if(Input::hasFile('modpdf')) {
			    	Input::file('modpdf')->move($path,Input::get('modnp').'_'.$arrayprocdocu[0]->avredocu.'.'.Input::file('modpdf')->getClientOriginalExtension());

					$fecha = date("Y-m-d H:i:s");
		    		DB::table('MODTIERRAS_PROCESTADO')->insert(
				    	array(
				    		'id_proceso' => Input::get('modnp'),
				    		'id_estado' => Input::get('modsubestado'),
				    		'created_at' => $fecha,
			    			'updated_at' => $fecha
				    	)
					);
					DB::table('MODTIERRAS_PROCDOCUMENTOS')->insert(
				    	array(
				    		'id_proceso' => Input::get('modnp'),
				    		'id_documento' => Input::get('modocu'),
				    		'rutadocu' => $path.'\\'.Input::get('modnp').'_'.$arrayprocdocu[0]->avredocu.'.'.Input::file('modpdf')->getClientOriginalExtension(),
				    		'created_at' => $fecha,
			    			'updated_at' => $fecha
				    	)
					);
					return Redirect::to('procesos_adjudicados')->with('documentosanexos', $procesiid);
				}			
				return Redirect::to('procesos_adjudicados')->with('documentosanexos', 'error_estatus');
			}
			elseif (Input::get('modsubestado') == 0) {
				if(Input::hasFile('modpdf')) {
			    	Input::file('modpdf')->move($path,Input::get('modnp').'_'.$arrayprocdocu[0]->avredocu.'.'.Input::file('modpdf')->getClientOriginalExtension());

					$fecha = date("Y-m-d H:i:s");

					DB::table('MODTIERRAS_PROCDOCUMENTOS')->insert(
				    	array(
				    		'id_proceso' => Input::get('modnp'),
				    		'id_documento' => Input::get('modocu'),
				    		'rutadocu' => $path.'\\'.Input::get('modnp').'_'.$arrayprocdocu[0]->avredocu.'.'.Input::file('modpdf')->getClientOriginalExtension(),
				    		'created_at' => $fecha,
			    			'updated_at' => $fecha
				    	)
					);
					return Redirect::to('procesos_adjudicados')->with('documentosanexos', $procesiid);
				}			
				return Redirect::to('procesos_adjudicados')->with('documentosanexos', 'error_doc');	
			}
			else {
			    return Redirect::to('procesos_adjudicados')->with('documentosanexos', 'error_doc');	
			}
		} else {			

			if(Input::hasFile('modpdf')) {
			    	Input::file('modpdf')->move($path,Input::get('modnp').'_'.$arrayprocdocu[0]->avredocu.'.'.Input::file('modpdf')->getClientOriginalExtension());
			    	$fecha = date("Y-m-d H:i:s");
					if (Input::get('modocu')==23) {
						DB::table('MODTIERRAS_PROCESTADO')
				            ->where('id_proceso', '=', Input::get('modnp'))
				            ->where(function($query)
				            {
				                $query->orWhere('id_estado', '=', 3)
				                      ->orWhere('id_estado', '=', 4);
				            })
			            ->update(array('id_estado'=>Input::get('modsubestado'), 'updated_at'=>$fecha));
					}
					elseif(Input::get('modocu')==24) {
						DB::table('MODTIERRAS_PROCESTADO')
				            ->where('id_proceso', '=', Input::get('modnp'))
				            ->where(function($query)
				            {
				                $query->orWhere('id_estado', '=', 6)
				                      ->orWhere('id_estado', '=', 7)
				                      ->orWhere('id_estado', '=', 8);
				            })
			            ->update(array('id_estado'=>Input::get('modsubestado'), 'updated_at'=>$fecha));
					}
					elseif(Input::get('modocu')==25) {
						DB::table('MODTIERRAS_PROCESTADO')
				            ->where('id_proceso', '=', Input::get('modnp'))
				            ->where('id_estado', '=', 9)
			            ->update(array('id_estado'=>Input::get('modsubestado'), 'updated_at'=>$fecha));
					}
					DB::table('MODTIERRAS_PROCDOCUMENTOS')
				            ->where('id_proceso', '=', Input::get('modnp'))
				            ->where('id_documento', '=', Input::get('modocu'))
			            ->update(array('updated_at'=>$fecha));

		    		return Redirect::to('procesos_adjudicados')->with('documentosanexos', $procesiid);
				}
				return Redirect::to('procesos_adjudicados')->with('documentosanexos', 'error_estatus');
		}			
    }
    public function getEditarProceso2()
	{
		$fecha = date("Y-m-d H:i:s");
		$procesiid = Input::get('modnp');
		
  		// insertar campos a la tabla
	    DB::table('MODTIERRAS_PROCESO')->where('id_proceso', Input::get('modnp'))->update(	    	
		    array(
		    		'fechainspeccionocular' => Input::get('modfechaocular')	    			
		    )					
		);
		DB::table('MODTIERRAS_PROCESTADO')->insert(
			    	array(
			    		'id_proceso' => Input::get('modnp'),
			    		'id_estado' => 5,
			    		'created_at' => $fecha,
		    			'updated_at' => $fecha
			    	)
		);
		return Redirect::to('procesos_adjudicados')->with('actualizar', $procesiid);
	      	
	}    
	public function PruebaPro()
	{
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arrayproini = DB::select('SELECT DISTINCT * FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
		
		return View::make('vista3', array('arrayproini' => $arrayproini));
	}
	public function postProgramajax()
	{
		$id=(Input::get('valor'));
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arrayproini = DB::select('SELECT * FROM MODTIERRAS_PROCESOINICIAL WHERE id_proceso='.Input::get('valor'));
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		$arrayconsul=array($arrayproini,$arrayconcepto);
		return Response::json($arrayconsul);

	}

	public function ResponsableJuridico()
	{
		$arrayrj = DB::table('MODTIERRAS_PROCESO')
		->join('users', 'users.id','=','MODTIERRAS_PROCESO.respjuridico')
		->where('users.level','=',2)
		->where('users.grupo','=',3)
		->select('users.name',DB::raw('count(*) as y, users.name'))
		->groupBy('users.name')
		->get();
		return View::make('modulotierras.reporresponsablejuridico', array('arrayrj' => $arrayrj));
	}

	public function RLevantamientoTopogragfico()
	{
		$arraylt = DB::table('MODTIERRAS_PROCESO')
		->select('requiererespgeo',DB::raw('count(*) as y, requiererespgeo'))
		->groupBy('requiererespgeo')
		->get();
		//return $arraylt;
		return View::make('modulotierras.reporlevantamientotopografico', array('arraylt' => $arraylt));
	}

	public function ReporAreaLevantada()
	{
		$arrayal = DB::table('MODTIERRAS_PROCESO')
		->select('requiererespgeo',DB::raw('count(*) as y, requiererespgeo'))
		->groupBy('requiererespgeo')
		->get();
		//return $arraylt;
		return View::make('modulotierras.reporarealevan', array('arraylt' => $arrayal));
	}

	public function getDownloadfile(){
        //PDF file is stored under project/public/download/info.pdf
        $path = public_path().'\procesos\\'.Input::get('modnp').'\\';
        if ((Input::get('moddownload')=='_LT_MAPA.pdf') OR (Input::get('moddownload')=='_LT_SHP.rar')) {
        	$file = $path.Input::get('modnp').Input::get('moddownload');        	
        	return Response::download($file);
        } 
        else {
        	$arraydocuruta = DB::select('SELECT rutadocu FROM MODTIERRAS_PROCDOCUMENTOS WHERE id_proceso = '.Input::get('modnp').'AND id_documento = '.Input::get('moddownload'));        	
        	$file = $arraydocuruta[0]->rutadocu;
        	return Response::download($file);
        }       
    }

}

?>