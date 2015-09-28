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
		$arrayproceso = DB::select("SELECT t.id_proceso, Sum(CASE WHEN t.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN t.id_estado = '2' THEN (CASE WHEN t.conceptojuridico >= '7' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN t.id_estado = '3' OR t.id_estado = '4' THEN 1 ELSE 0 END) as radicado,	Sum(CASE WHEN t.id_estado = '5' THEN 1 ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN t.id_estado = '6' OR t.id_estado = '7' OR t.id_estado = '8' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN t.id_estado = '9' THEN 1 ELSE 0 END) as registroorip FROM (SELECT MODTIERRAS_PROCESTADO.id_proceso, MODTIERRAS_PROCESTADO.id_estado, MODTIERRAS_PROCESO.conceptojuridico, MODTIERRAS_PROCESO.respjuridico FROM [MODTIERRAS_PROCESTADO] JOIN [MODTIERRAS_PROCESO] ON MODTIERRAS_PROCESTADO.id_proceso=MODTIERRAS_PROCESO.id_proceso) as t group by t.id_proceso");
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
		$arrayprocdocu = DB::select('select PROCDOCUMENTOS.id_proceso as id_proceso, PROCDOCUMENTOS.id_documento as id_documento,MODTIERRAS_DOCUMENTOS.concepto as concepto from ( SELECT [id_proceso],[id_documento] FROM [DABASE].[sde].[MODTIERRAS_PROCDOCUMENTOS] where id_proceso= '.$idpro.') as PROCDOCUMENTOS Inner join MODTIERRAS_DOCUMENTOS on PROCDOCUMENTOS.id_documento=MODTIERRAS_DOCUMENTOS.id_documento');
		
		
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
		$estadocambio = DB::select('SELECT * FROM MODTIERRAS_PROCESTADO where id_proceso ='.Input::get('modnp').' and id_estado = 5' );
		if (empty($estadocambio)) {
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
		else {
			DB::table('MODTIERRAS_PROCESTADO')
				            ->where('id_proceso', '=', Input::get('modnp'))
				            ->where('id_estado', '=', 5)
			            ->update(array('updated_at'=>$fecha));
			return Redirect::to('procesos_adjudicados')->with('actualizar', $procesiid);
		}
		return "ERROR";
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
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arraydpto = DB::table('MODTIERRAS_VEREDAS')
		->select('nom_dpto','cod_dpto')
		->groupBy('nom_dpto','cod_dpto')
		->get();
		$arrayapp = DB::table('MODTIERRAS_PROCESOINICIAL')->sum('areaprediopreliminar');
		$arrayapf = DB::table('MODTIERRAS_PROCESO')->sum('areapredioformalizada');
		$arraytotal = array($arrayapp,$arrayapf);
		//return $arraytotal;
		return View::make('modulotierras.reporareareportada', array('arraydpto' => $arraydpto), array('arraytotal' => $arraytotal));
	}

	public function postReporarealevantadampio()
	{
		$arrayapp = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('dpto').'%')->sum('areaprediopreliminar');
		$arrayapf = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('dpto').'%')->sum('areapredioformalizada');
		$arraympio= DB::table('MODTIERRAS_VEREDAS')->where('cod_dpto','=',Input::get('dpto'))->select('nom_mpio','cod_mpio')->groupBy('nom_mpio','cod_mpio')->get();
		$arrayt=array($arraympio, $arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function postReporarealevantadavda()
	{
		$arrayapp = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('mpio').'%')->sum('areaprediopreliminar');
		$arrayapf = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('mpio').'%')->sum('areapredioformalizada');
		$arrayvda=DB::table('MODTIERRAS_VEREDAS')->where('cod_mpio','=',Input::get('mpio'))->select('nombre1','cod_unodc')->get();
		$arrayt=array($arrayvda, $arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function postReporarealevantadavdadet()
	{
		$arrayapp = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','=',Input::get('vda'))->sum('areaprediopreliminar');
		$arrayapf = DB::table('MODTIERRAS_PROCESO')->where('vereda','=',Input::get('vda'))->sum('areapredioformalizada');
		$arrayt=array($arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function ReporEstado()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM [DABASE].[sde].[MODTIERRAS_ESTADO]) as rep
										WHERE rn = 1
										order by id_estado asc');
		for($i=0; $i<count($arraestadosorder); $i++){
			$arraypro1[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso

										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 1  GROUP BY estado, viabilidad");
			if(empty($arraypro1[$i])){$arrayvial1[$i] = "0";}
				else{$arrayvial1[$i]=$arraypro1[$i][0]->total;}
			$arraypro2[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 2  GROUP BY estado, viabilidad");
			if(empty($arraypro2[$i])){$arrayvial2[$i] = "0";}
				else{$arrayvial2[$i]=$arraypro2[$i][0]->total;}
		}
		$arraydpto = DB::table('MODTIERRAS_VEREDAS')
		->select('nom_dpto','cod_dpto')
		->groupBy('nom_dpto','cod_dpto')
		->get();
		$arrayvial=array($arrayvial1,$arrayvial2,$arraestadosorder);
		return View::make('modulotierras.reporestado',array('arraydpto' => $arraydpto),array('arrayvial' => $arrayvial));
	}

	public function postReporestadompio()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM [DABASE].[sde].[MODTIERRAS_ESTADO]) as rep
										WHERE rn = 1
										order by id_estado asc');
		for($i=0; $i<count($arraestadosorder); $i++){
			$arraypro1[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('dpto')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 1  GROUP BY estado, viabilidad");
			if(empty($arraypro1[$i])){$arrayvial1[$i] = 0;}
				else{$arrayvial1[$i]=(int)$arraypro1[$i][0]->total;}
			$arraypro2[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('dpto')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 2  GROUP BY estado, viabilidad");
			if(empty($arraypro2[$i])){$arrayvial2[$i] = 0;}
				else{$arrayvial2[$i]=(int)$arraypro2[$i][0]->total;}
		}
		$arraympio= DB::table('MODTIERRAS_VEREDAS')->where('cod_dpto','=',Input::get('dpto'))->select('nom_mpio','cod_mpio')->groupBy('nom_mpio','cod_mpio')->get();
		$arrayvial=array($arraympio,$arrayvial1,$arrayvial2);
		return Response::json($arrayvial);
	}

	public function postReporestadovda()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM [DABASE].[sde].[MODTIERRAS_ESTADO]) as rep
										WHERE rn = 1
										order by id_estado asc');
		for($i=0; $i<count($arraestadosorder); $i++){
			$arraypro1[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('mpio')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 1  GROUP BY estado, viabilidad");
			if(empty($arraypro1[$i])){$arrayvial1[$i] = 0;}
				else{$arrayvial1[$i]=(int)$arraypro1[$i][0]->total;}
			$arraypro2[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('mpio')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 2  GROUP BY estado, viabilidad");
			if(empty($arraypro2[$i])){$arrayvial2[$i] = 0;}
				else{$arrayvial2[$i]=(int)$arraypro2[$i][0]->total;}
		}
		$arrayvda=DB::table('MODTIERRAS_VEREDAS')->where('cod_mpio','=',Input::get('mpio'))->select('nombre1','cod_unodc')->get();
		$arrayvial=array($arrayvda,$arrayvial1,$arrayvial2);
		return Response::json($arrayvial);
	}

	public function postReporestadovdadet()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM [DABASE].[sde].[MODTIERRAS_ESTADO]) as rep
										WHERE rn = 1
										order by id_estado asc');
		for($i=0; $i<count($arraestadosorder); $i++){
			$arraypro1[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('vda')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 1  GROUP BY estado, viabilidad");
			if(empty($arraypro1[$i])){$arrayvial1[$i] = 0;}
				else{$arrayvial1[$i]=(int)$arraypro1[$i][0]->total;}
			$arraypro2[$i] = DB::select("SELECT count(estado.id_estado)as total, MODTIERRAS_ESTADO.estado as estado, estado.viabilidad as viabilidad FROM(
									select CASE WHEN estadosunidos.id_estado = 2 and MODTIERRAS_PROCESO.conceptojuridico >= 7 THEN 1 ELSE estadosunidos.id_estado END AS id_estado,
									estadosunidos.proceso as proceso, MODTIERRAS_PROCESO.viabilidad, MODTIERRAS_PROCESO.vereda, MODTIERRAS_PROCESO.conceptojuridico
									from(select distinct id_proceso as proceso, max(id_estado) as id_estado from MODTIERRAS_PROCESTADO group by id_proceso) as estadosunidos
										 inner join MODTIERRAS_PROCESO on estadosunidos.proceso = MODTIERRAS_PROCESO.id_proceso
										 where MODTIERRAS_PROCESO.vereda like '".Input::get('vda')."%'
										)as estado
									inner join MODTIERRAS_ESTADO on estado.id_estado = MODTIERRAS_ESTADO.id_estado
									WHERE MODTIERRAS_ESTADO.estado ='".$arraestadosorder[$i]->estado."' and estado.viabilidad = 2  GROUP BY estado, viabilidad");
			if(empty($arraypro2[$i])){$arrayvial2[$i] = 0;}
				else{$arrayvial2[$i]=(int)$arraypro2[$i][0]->total;}
		}
		$arrayvial=array($arrayvial1,$arrayvial2);
		return Response::json($arrayvial);
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

    public function ReporNumPro()
	{
		$arraynumpro= DB::table('MODTIERRAS_PROCESO')
		->join('MODTIERRAS_CONCEPTO', 'MODTIERRAS_CONCEPTO.id_concepto','=','MODTIERRAS_PROCESO.conceptojuridico')
		->select('MODTIERRAS_CONCEPTO.subconcepto as name',DB::raw('count(MODTIERRAS_PROCESO.conceptojuridico) as y'))
		->groupBy('MODTIERRAS_CONCEPTO.subconcepto')
		->get();
		$numpro = DB::table('MODTIERRAS_PROCESO')->count('conceptojuridico');
		//return $numpro;
		return View::make('modulotierras.repornumproc', array('arraynumpro' => $arraynumpro),array('numpro' => $numpro));
	}

    public function Generarpfd()
    {
    	$arraytp = DB::table('MODTIERRAS_PROCESO')->count();
    	$fecha = date("Y/m/d");
    	$hora = date("H:i");
    	//PDF file is stored under project/public/download/info.pdf
        Fpdf::AddPage();
        Fpdf::SetFont('Arial', 'B', 16);
		//inserto la cabecera poniendo una imagen dentro de una celda
		Fpdf::Cell(100,10,Fpdf::Image('./assets/img/unodc.png',30,10,50),0,0,'C');
		//Fpdf::Line(35,64,190,64);
		Fpdf::Ln(7);
		//Fpdf::Write(5,"To find out what's new in this tutorial, click ");
		Fpdf::Cell(100,30,"La Unidad de Informacion certifica el siguiente numero de procesos");//.$campodb['nombre']);
		//Fpdf::Line(35,74,190,74);
		Fpdf::Ln(7);
		Fpdf::Cell(100,40,"Numero de procesos: ".$arraytp);//. $campodb['direccion']);
		//Fpdf::Line(35,84,190,84);
		Fpdf::Ln(7);
		Fpdf::Cell(90,50,"Fecha de elaboracion de Informe: ".$fecha);//.$campodb['telefono']));
		//Fpdf::Line(35,94,190,94);
		Fpdf::Ln(7);
		Fpdf::Cell(100,60,"Hora de elaboracion de Informe: ".$hora);//.$campodb['ordenador']);
		//Fpdf::Line(35,104,190,104);
		Fpdf::Ln(9);
		Fpdf::SetFont('Arial','B',10);
	 	Fpdf::Ln(2);

		Fpdf::SetFont('Arial','',8);
        Fpdf::Output();
        exit;
    }
     public function postConsultaProceso()
	{
		return 'Controller consultar proceso vista: http://localhost/DANET/public/consultar_proceso';
		
	}
}

?>

