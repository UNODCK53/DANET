<?php

class TierrasController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}

	//despues de la funcion se pone el verbo por ejemplo getIndex
	public function ListadoProini()
	{
		$arrayproini = DB::table('Vista pro_ini_con_datgeo')->get();
		$arrayconcepto = DB::table('MODTIERRAS_CONCEPTO')->get();
		$arrayrespgeografico = DB::table('users')->where('grupo','=',3)->where('level','=',3)->select('id','name','last_name','grupo','level')->get();
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico);		
		return View::make('modulotierras.cargainicial', array('arrayproini' => $arrayproini), array('arraydombobox' => $arraydombobox));
	}

	public function postListadoproinimodal()
	{
		$arrayproini = DB::table('Vista pro_ini_con_datgeo')->where('id_proceso','=',Input::get('numerpro'))->get();
		$arraydpto = DB::table('MODTIERRAS_VEREDAS')
		->select('nom_dpto','cod_dpto')
		->groupBy('nom_dpto','cod_dpto')
		->orderBy('nom_dpto', 'asc')
		->get();
		$arraymod = array($arrayproini, $arraydpto);
		return Response::json($arraymod);
	}

	public function getCrearProceso()
	{
		//consulta a la tabla de MODTIERRAS_PROCESO
		$idmaximo =  DB::table('MODTIERRAS_PROCESO')->max('OBJECTID');
		$fecha = date("Y-m-d H:i:s");
		$reqresgeo=Input::get('modradiorespogeo');
		$respgeografico = Input::get('modrepogeo');
		if($reqresgeo == 2){
			$respgeografico = 0;
		}

  		// insertar campos a la tabla
	    DB::table('MODTIERRAS_PROCESO')->insert(
		    array(
		    		'OBJECTID'  => ($idmaximo+1),
		    		'id_proceso' => Input::get('modnp'),
		    		'conceptojuridico' => Input::get('modconcpjuri'),
		    		'obsconceptojuridico' => Input::get('modobsconcjuri'),
		    	  	'areapredioformalizada' => Input::get('modareafor'),
		    	  	'unidadareaprediofor' => Input::get('modradiounidadfor'),    	  	
		    	  	'longitud' => Input::get('modlong'),
		    	  	'latitud' => Input::get('modlat'),
		    	  	'requierevisinsp' => Input::get('modradiovisinsp'), 
	    			'viabilidad' => Input::get('modviable'),
	    			'obsviabilidad' => Input::get('modobsviab'),
	    			'respjuridico' => Auth::user()->id,
	    			'requiererespgeo' => $reqresgeo,
	    			'respgeografico' => $respgeografico,	    			
	    			'created_at' => $fecha,
	    			'updated_at' => $fecha,
	    			'vereda' => Input::get('modvereda'),
	    			'nombrepredio' => Input::get('modnompred'),
	    			'direccionnotificacion' => Input::get('moddirnoti'),
	    			'nombre' => Input::get('modnombre'),
	    			'cedula' => Input::get('modcedula'),
	    			'genero' => Input::get('modgenero'),
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
		if (Input::get('modradiorespogeo')=='2'){
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

	public function postEditarprocesodatgeo()
	{
		$arrayproini = DB::table('Vista_proceso_con_datgeo')->where('id_proceso','=',Input::get('numerpro'))->get();
		$arraydpto = DB::table('MODTIERRAS_VEREDAS')
		->select('nom_dpto','cod_dpto')
		->groupBy('nom_dpto','cod_dpto')
		->orderBy('nom_dpto', 'asc')
		->get();
		$areapreliminar=DB::table('MODTIERRAS_PROCESOINICIAL')->where('id_proceso','=',Input::get('numerpro'))->select('areaprediopreliminar','unidadesarea')->get();
		$arraymod = array($arrayproini, $arraydpto, $areapreliminar);
		return Response::json($arraymod);
	}

	public function getEditarProceso()
	{
		$fecha = date("Y-m-d H:i:s");
		$procesiid = Input::get('modnp');
		$reqresgeo = Input::get('modradiorespogeo');
		$respgeografico = Input::get('modrepogeo');
		if($reqresgeo == 2){
			$respgeografico = 0;
		}
  		// insertar campos a la tabla
	    DB::table('MODTIERRAS_PROCESO')->where('id_proceso', Input::get('modnp'))->update(	    	
		    array(
		    		'id_proceso' => Input::get('modnp'),
		    		'conceptojuridico' => Input::get('modconcpjuri'),
		    		'obsconceptojuridico' => Input::get('modobsconcjuri'),
		    	  	'areapredioformalizada' => Input::get('modareafor'),
		    	  	'unidadareaprediofor' => Input::get('modradiounidadfor'),
		    	  	'longitud' => Input::get('modlong'),
		    	  	'latitud' => Input::get('modlat'),
	    			'viabilidad' => Input::get('modviable'),
	    			'obsviabilidad' => Input::get('modobsviab'),
	    			'respjuridico' => Auth::user()->id,
	    			'requiererespgeo' => $reqresgeo,
	    			'respgeografico' => $respgeografico,
	    			'updated_at' => $fecha,
	    			'vereda' => Input::get('modvereda'),
	    			'nombrepredio' => Input::get('modnompred'),
	    			'direccionnotificacion' => Input::get('moddirnoti'),
	    			'nombre' => Input::get('modnombre'),
	    			'cedula' => Input::get('modcedula'),
	    			'genero' => Input::get('modgenero'),
	    			'telefono' => Input::get('modtelefono')	    			
		    )					
		);
	    if($reqresgeo == '2'){
	    	DB::table('MODTIERRAS_PROCESTADO')->where('id_proceso', '=', $procesiid)->where('id_estado','=','2')->delete();
	    	DB::table('MODTIERRAS_PROCESTADO')->insert(array(
			    		'id_proceso' => Input::get('modnp'),
			    		'id_estado' => 2,
			    		'created_at' => $fecha,
		    			'updated_at' => $fecha
			    	)
				);
	    	DB::table('MODTIERRAS_PROCDOCUMENTOS')->where('id_proceso', '=', $procesiid)->where('id_documento','=','2')->delete();
	    	$pathshp = public_path().'\procesos\\'.$procesiid.'\\'.$procesiid.'_LT_SHP.rar';
	    	$pathmapa = public_path().'\procesos\\'.$procesiid.'\\'.$procesiid.'_LT_MAPA.pdf';
	    	$pathxls = public_path().'\procesos\\'.$procesiid.'\\'.$procesiid.'_LT_TABLA.xls';
	    	$pathxlsx = public_path().'\procesos\\'.$procesiid.'\\'.$procesiid.'_LT_TABLA.xlsx';
			if (File::exists($pathshp)){
				File::delete($pathshp);
			}
			if (File::exists($pathmapa)){
				File::delete($pathmapa);
			}
			if (File::exists($pathxls)){
				File::delete($pathxls);
			}
			if (File::exists($pathxlsx)){
				File::delete($pathxlsx);
			}
	    }
	    else{
	    	DB::table('MODTIERRAS_PROCESTADO')->where('id_proceso', '=', $procesiid)->where('id_estado','=','2')->delete();
	    }

		return Redirect::to('procesos_adjudicados')->with('actualizar', $procesiid);
	}

	public function ListadoProceso()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT final.id_proceso,Sum(CASE WHEN final.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN final.id_estado = '2' AND final.levtopo != '2' THEN (CASE WHEN final.levtopo = '3' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN final.id_estado = '3' OR final.id_estado = '4' THEN 1 ELSE 0 END) as radicado, Sum(CASE WHEN final.id_estado = '5' AND final.fechainspeccionocular2 != '2' THEN (CASE WHEN final.fechainspeccionocular2 = '3' THEN 2 ELSE 1 END) ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN final.id_estado = '6' OR final.id_estado = '7' OR final.id_estado = '8' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN final.id_estado = '9' THEN 1 ELSE 0 END) as registroorip	 FROM (SELECT proce.id_proceso, procesta.id_estado,proce.respjuridico,proce.fechainspeccionocular2,proce.levtopo FROM( SELECT pro.id_proceso,pro.respjuridico	,Sum(CASE WHEN pro.requierevisinsp = '1' THEN (CASE WHEN pro.fechainspeccionocular != '' THEN 1 ELSE 2 END) ELSE 3 END) as fechainspeccionocular2,Sum(CASE WHEN pro.requiererespgeo = '1' THEN (CASE WHEN pro.docutopo = '1' THEN 1 ELSE 2 END) ELSE 3 END) as levtopo FROM( SELECT proceso.id_proceso ,proceso.respjuridico ,proceso.requierevisinsp ,proceso.fechainspeccionocular ,proceso.requiererespgeo,Sum(CASE WHEN prodocu.id_documento = '2' THEN 1 ELSE 0 END) as docutopo FROM (SELECT id_proceso ,id_documento FROM MODTIERRAS_PROCDOCUMENTOS where id_documento=2)as prodocu RIGHT JOIN MODTIERRAS_PROCESO as proceso ON prodocu.id_proceso=proceso.id_proceso group by proceso.id_proceso,proceso.respjuridico,proceso.requierevisinsp,proceso.fechainspeccionocular,proceso.requiererespgeo) as pro group by pro.id_proceso,pro.respjuridico) as proce JOIN MODTIERRAS_PROCESTADO as procesta ON procesta.id_proceso=proce.id_proceso) as final where final.respjuridico = ".Auth::user()->id." group by final.id_proceso");		
		$arrayconcepto = DB::select('select * from MODTIERRAS_CONCEPTO');
		//return $arrayproceso;
		return View::make('modulotierras.procesosadjudicados', array('arrayproceso' => $arrayproceso), array('arrayconcepto' => $arrayconcepto));
	}

	public function ListadoProcesogral()
	{
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT final.id_proceso,Sum(CASE WHEN final.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN final.id_estado = '2' AND final.levtopo != '2' THEN (CASE WHEN final.levtopo = '3' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN final.id_estado = '3' OR final.id_estado = '4' THEN 1 ELSE 0 END) as radicado, Sum(CASE WHEN final.id_estado = '5' AND final.fechainspeccionocular2 != '2' THEN (CASE WHEN final.fechainspeccionocular2 = '3' THEN 2 ELSE 1 END) ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN final.id_estado = '6' OR final.id_estado = '7' OR final.id_estado = '8' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN final.id_estado = '9' THEN 1 ELSE 0 END) as registroorip	 FROM (SELECT proce.id_proceso, procesta.id_estado,proce.respjuridico,proce.fechainspeccionocular2,proce.levtopo FROM( SELECT pro.id_proceso,pro.respjuridico	,Sum(CASE WHEN pro.requierevisinsp = '1' THEN (CASE WHEN pro.fechainspeccionocular != '' THEN 1 ELSE 2 END) ELSE 3 END) as fechainspeccionocular2,Sum(CASE WHEN pro.requiererespgeo = '1' THEN (CASE WHEN pro.docutopo = '1' THEN 1 ELSE 2 END) ELSE 3 END) as levtopo FROM( SELECT proceso.id_proceso ,proceso.respjuridico ,proceso.requierevisinsp ,proceso.fechainspeccionocular ,proceso.requiererespgeo,Sum(CASE WHEN prodocu.id_documento = '2' THEN 1 ELSE 0 END) as docutopo FROM (SELECT id_proceso ,id_documento FROM MODTIERRAS_PROCDOCUMENTOS where id_documento=2)as prodocu RIGHT JOIN MODTIERRAS_PROCESO as proceso ON prodocu.id_proceso=proceso.id_proceso group by proceso.id_proceso,proceso.respjuridico,proceso.requierevisinsp,proceso.fechainspeccionocular,proceso.requiererespgeo) as pro group by pro.id_proceso,pro.respjuridico) as proce JOIN MODTIERRAS_PROCESTADO as procesta ON procesta.id_proceso=proce.id_proceso) as final group by final.id_proceso");
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
		if(Input::get('modconcep')!="6"){
			if((Input::hasFile('modmapa')) and (Input::hasFile('modshp')) and (Input::hasFile('modtabla'))) {

				Input::file('modmapa')->move($path,Input::get('modnp').'_LT_MAPA.'.Input::file('modmapa')->getClientOriginalExtension());
	    		Input::file('modshp')->move($path,Input::get('modnp').'_LT_SHP.'.Input::file('modshp')->getClientOriginalExtension());
	    		Input::file('modtabla')->move($path,Input::get('modnp').'_LT_TABLA.'.Input::file('modtabla')->getClientOriginalExtension());
	    		DB::table('MODTIERRAS_PROCESTADO')->where('id_proceso', '=', Input::get('modnp'))->where('id_estado','=','2')->delete();
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
	    else{
	    	if((Input::hasFile('modmapa')) or (Input::hasFile('modshp')) or (Input::hasFile('modtabla'))) {

				Input::file('modmapa')->move($path,Input::get('modnp').'_LT_MAPA.'.Input::file('modmapa')->getClientOriginalExtension());
				if(Input::hasFile('modshp')){
					Input::file('modshp')->move($path,Input::get('modnp').'_LT_SHP.'.Input::file('modshp')->getClientOriginalExtension());
				}
				if(Input::hasFile('modtabla')){
					Input::file('modtabla')->move($path,Input::get('modnp').'_LT_TABLA.'.Input::file('modtabla')->getClientOriginalExtension());
				}
				$fecha = date("Y-m-d H:i:s");
	    		DB::table('MODTIERRAS_PROCESTADO')->insert(
			    	array(
			    		'id_proceso' => Input::get('modnp'),
			    		'id_estado' => 2,
			    		'created_at' => $fecha,
		    			'updated_at' => $fecha
			    	)
				);
				if(Input::hasFile('modtabla')){
			    	$ruta = $path.'\\'.Input::get('modnp').'_LT_TABLA.'.Input::file('modtabla')->getClientOriginalExtension();
			    }
			    else{
			    	$ruta = $path.'\\'.Input::get('modnp').'_LT_MAPA.'.Input::file('modmapa')->getClientOriginalExtension();
			    }
				DB::table('MODTIERRAS_PROCDOCUMENTOS')->insert(
			    	array(
			    		'id_proceso' => Input::get('modnp'),
			    		'id_documento' => 2,
			    		'rutadocu' => $ruta,
			    		'created_at' => $fecha,
		    			'updated_at' => $fecha
			    	)
				);	
	       		return Redirect::to('levantamiento_topografico')->with('status', 'ok_estatus');
	    	}
	    	return Redirect::to('levantamiento_topografico')->with('status', 'error_estatus');
	    }    	
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
		
		$arrayproceso = DB::table('MODTIERRAS_PROCESO')->where('id_proceso','=',$idpro)->get();

		$arrayrespgeografico = DB::select('SELECT id,name,last_name,grupo,level FROM users WHERE grupo=3 and level=3');
		$arrayconcepto = DB::select('SELECT * FROM MODTIERRAS_CONCEPTO');
		$arrayestado = DB::select('SELECT * FROM MODTIERRAS_ESTADO');
		$arrayprocestado = DB::select('SELECT * FROM MODTIERRAS_PROCESTADO WHERE id_proceso = '.$idpro);
		$arrayprocdocu = DB::select('select PROCDOCUMENTOS.id_proceso as id_proceso, PROCDOCUMENTOS.id_documento as id_documento,MODTIERRAS_DOCUMENTOS.concepto as concepto from ( SELECT id_proceso,id_documento FROM MODTIERRAS_PROCDOCUMENTOS where id_proceso= '.$idpro.') as PROCDOCUMENTOS Inner join MODTIERRAS_DOCUMENTOS on PROCDOCUMENTOS.id_documento=MODTIERRAS_DOCUMENTOS.id_documento');
		$arraydocumento = DB::table('MODTIERRAS_CONCEPDOCUMENTO')
		->where ('MODTIERRAS_CONCEPDOCUMENTO.id_concepto','=', $arrayproceso[0]->conceptojuridico)
		->where ('MODTIERRAS_CONCEPDOCUMENTO.requieredocu','=','1')
		->join('MODTIERRAS_DOCUMENTOS', 'MODTIERRAS_DOCUMENTOS.id_documento','=','MODTIERRAS_CONCEPDOCUMENTO.id_documento')
		->select('MODTIERRAS_DOCUMENTOS.id_documento', 'MODTIERRAS_DOCUMENTOS.concepto','MODTIERRAS_DOCUMENTOS.avredocu')
		->get();
		
		$path = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_SHP.rar';
		if (File::exists($path)){
			$shp=true;
		}
		else{
			$shp=false;
		}
		
		$arraydocuruta = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_TABLA.xlsx';
		$arraydocuruta1 = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_TABLA.xls';

        if( (File::exists($arraydocuruta)) || (File::exists($arraydocuruta1)) ){
        	$tabla=true;
        }
        else{
			$tabla=false;
    	}
    	$path1 = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_MAPA.pdf';
		if (File::exists($path1)){
			$mapa=true;
		}
		else{
			$mapa=false;
		}
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico, $arraydocumento, $arrayestado, $arrayprocestado, $arrayprocdocu, $shp, $tabla, $mapa);
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
		    		'fechainspeccionocular' => Input::get('modfechaocular'),
		    		'requierevisinsp'=>Input::get('modradiovisinsp')
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

		$arrayapp1 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('unidadesarea','=',1)->sum('areaprediopreliminar');
		$arrayapp2 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('unidadesarea','=',2)->sum('areaprediopreliminar');
		$arrayapp3 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('unidadesarea','=',3)->sum('areaprediopreliminar');
		$arrayapp=$arrayapp1+($arrayapp2*0.644)+($arrayapp3*0.0001);

		$arrayapf1 = DB::table('MODTIERRAS_PROCESO')->where('unidadareaprediofor','=',1)->sum('areapredioformalizada');
		$arrayapf2 = DB::table('MODTIERRAS_PROCESO')->where('unidadareaprediofor','=',2)->sum('areapredioformalizada');
		$arrayapf3 = DB::table('MODTIERRAS_PROCESO')->where('unidadareaprediofor','=',3)->sum('areapredioformalizada');
		$arrayapf=$arrayapf1+($arrayapf2*0.644)+($arrayapf3*0.0001);

		
		$arraytotal = array($arrayapp,$arrayapf);
		//return $arrayapp;
		return View::make('modulotierras.reporareareportada', array('arraydpto' => $arraydpto), array('arraytotal' => $arraytotal));
	}

	public function postReporarealevantadampio()
	{
		$arrayapp1 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('dpto').'%')->where('unidadesarea','=',1)->sum('areaprediopreliminar');
		$arrayapp2 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('dpto').'%')->where('unidadesarea','=',2)->sum('areaprediopreliminar');
		$arrayapp3 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('dpto').'%')->where('unidadesarea','=',2)->sum('areaprediopreliminar');
		$arrayapp=$arrayapp1+($arrayapp2*0.644)+($arrayapp3*0.0001);

		$arrayapf1 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('dpto').'%')->where('unidadareaprediofor','=',1)->sum('areapredioformalizada');
		$arrayapf2 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('dpto').'%')->where('unidadareaprediofor','=',2)->sum('areapredioformalizada');
		$arrayapf3 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('dpto').'%')->where('unidadareaprediofor','=',3)->sum('areapredioformalizada');
		$arrayapf=$arrayapf1+($arrayapf2*0.644)+($arrayapf3*0.0001);

		$arraympio= DB::table('MODTIERRAS_VEREDAS')->where('cod_dpto','=',Input::get('dpto'))->select('nom_mpio','cod_mpio')->groupBy('nom_mpio','cod_mpio')->orderBy('nom_mpio','asc')->get();
		$arrayt=array($arraympio, $arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function postReporarealevantadavda()
	{
		$arrayapp1 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('mpio').'%')->where('unidadesarea','=',1)->sum('areaprediopreliminar');
		$arrayapp2 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('mpio').'%')->where('unidadesarea','=',2)->sum('areaprediopreliminar');
		$arrayapp3 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','like',Input::get('mpio').'%')->where('unidadesarea','=',3)->sum('areaprediopreliminar');
		$arrayapp=$arrayapp1+($arrayapp2*0.644)+($arrayapp3*0.0001);

		$arrayapf1 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('mpio').'%')->where('unidadareaprediofor','=',1)->sum('areapredioformalizada');
		$arrayapf2 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('mpio').'%')->where('unidadareaprediofor','=',2)->sum('areapredioformalizada');
		$arrayapf3 = DB::table('MODTIERRAS_PROCESO')->where('vereda','like',Input::get('mpio').'%')->where('unidadareaprediofor','=',3)->sum('areapredioformalizada');
		$arrayapf=$arrayapf1+($arrayapf2*0.644)+($arrayapf3*0.0001);

		$arrayvda=DB::table('MODTIERRAS_VEREDAS')->where('cod_mpio','=',Input::get('mpio'))->select('nombre1','cod_unodc')->orderBy('nombre1','asc')->get();
		$arrayt=array($arrayvda, $arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function postReporarealevantadavdadet()
	{
		$arrayapp1 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','=',Input::get('vda'))->where('unidadesarea','=',1)->sum('areaprediopreliminar');
		$arrayapp2 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','=',Input::get('vda'))->where('unidadesarea','=',2)->sum('areaprediopreliminar');
		$arrayapp3 = DB::table('MODTIERRAS_PROCESOINICIAL')->where('vereda','=',Input::get('vda'))->where('unidadesarea','=',3)->sum('areaprediopreliminar');
		$arrayapp=$arrayapp1+($arrayapp2*0.644)+($arrayapp3*0.0001);

		$arrayapf1 = DB::table('MODTIERRAS_PROCESO')->where('vereda','=',Input::get('vda'))->where('unidadareaprediofor','=',1)->sum('areapredioformalizada');
		$arrayapf2 = DB::table('MODTIERRAS_PROCESO')->where('vereda','=',Input::get('vda'))->where('unidadareaprediofor','=',2)->sum('areapredioformalizada');
		$arrayapf3 = DB::table('MODTIERRAS_PROCESO')->where('vereda','=',Input::get('vda'))->where('unidadareaprediofor','=',3)->sum('areapredioformalizada');
		$arrayapf=$arrayapf1+($arrayapf2*0.644)+($arrayapf3*0.0001);

		$arrayt=array($arrayapp, $arrayapf);
		return Response::json($arrayt);
	}

	public function ReporEstado()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM MODTIERRAS_ESTADO) as rep
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
		//return $arrayvial;
		return View::make('modulotierras.reporestado',array('arraydpto' => $arraydpto),array('arrayvial' => $arrayvial));
	}

	public function postReporestadompio()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$arraestadosorder= DB::select('SELECT estado FROM
										(SELECT id_estado, estado, ROW_NUMBER() OVER( PARTITION BY estado ORDER BY Id_estado) as rn
										FROM MODTIERRAS_ESTADO) as rep
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
										FROM MODTIERRAS_ESTADO) as rep
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

	public function getDownloadfile()
	{
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
    	return View::make('pdf',array('arraytp' => $arraytp));
    }

    public function postConsultaProceso()
	{
		Session::put('procesoi',Input::get('proceso'));
		return Redirect::to('consultar_proceso');
	}

    public function ConsultaDetallada()
	{
		$idpro=(Session::get('procesoi'));
		if($idpro==''){
			return Redirect::to('consulta_general_tierras');
		}
		$arrayproceso = DB::table('MODTIERRAS_PROCESO')
		->where ('id_proceso','=',$idpro)
		->select('OBJECTID','id_proceso','conceptojuridico','obsconceptojuridico','areapredioformalizada','unidadareaprediofor','longitud','latitud','fechainspeccionocular','viabilidad','obsviabilidad','requierevisinsp','respjuridico','requiererespgeo','respgeografico','created_at','updated_at','vereda','nombrepredio','direccionnotificacion','nombre','cedula','telefono','Shape')
		->get();
		
		$arrayrespgeografico = DB::table('users')->where('grupo','=','3')->where('level','=','3')->select('id','name','last_name','grupo','level')->get();
		$arrayconcepto = DB::select('SELECT * FROM MODTIERRAS_CONCEPTO');
		$arrayestado = DB::select('SELECT * FROM MODTIERRAS_ESTADO');
		$arrayprocestado = DB::select('SELECT * FROM MODTIERRAS_PROCESTADO WHERE id_proceso = '.$idpro);
		$arrayprocdocu = DB::select('select PROCDOCUMENTOS.id_proceso as id_proceso, PROCDOCUMENTOS.id_documento as id_documento,MODTIERRAS_DOCUMENTOS.concepto as concepto from ( SELECT id_proceso, id_documento FROM MODTIERRAS_PROCDOCUMENTOS where id_proceso= '.$idpro.') as PROCDOCUMENTOS Inner join MODTIERRAS_DOCUMENTOS on PROCDOCUMENTOS.id_documento=MODTIERRAS_DOCUMENTOS.id_documento');
		$arraydocumento = DB::table('MODTIERRAS_CONCEPDOCUMENTO')
		->where ('MODTIERRAS_CONCEPDOCUMENTO.id_concepto','=', $arrayproceso[0]->conceptojuridico)
		->where ('MODTIERRAS_CONCEPDOCUMENTO.requieredocu','=','1')
		->join('MODTIERRAS_DOCUMENTOS', 'MODTIERRAS_DOCUMENTOS.id_documento','=','MODTIERRAS_CONCEPDOCUMENTO.id_documento')
		->select('MODTIERRAS_DOCUMENTOS.id_documento', 'MODTIERRAS_DOCUMENTOS.concepto','MODTIERRAS_DOCUMENTOS.avredocu')		
		->get();
		$areapreliminar=DB::table('MODTIERRAS_PROCESOINICIAL')->where('id_proceso','=',$idpro)->select('areaprediopreliminar','unidadesarea')->get();
		$path = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_SHP.rar';
		if (File::exists($path)){
			$shp=true;
		}
		else{
			$shp=false;
		}
		
		$arraydocuruta = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_TABLA.xlsx';
		$arraydocuruta1 = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_TABLA.xls';

        if( (File::exists($arraydocuruta)) || (File::exists($arraydocuruta1)) ){
        	$tabla=true;
        }
        else{
			$tabla=false;
    	}
    	$path1 = public_path().'\procesos\\'.$idpro.'\\'.$idpro.'_LT_MAPA.pdf';
		if (File::exists($path1)){
			$mapa=true;
		}
		else{
			$mapa=false;
		}
		$arraydombobox= array($arrayconcepto, $arrayrespgeografico, $arraydocumento, $arrayestado, $arrayprocestado, $arrayprocdocu, $shp, $tabla, $areapreliminar,$mapa);
		
		Session::forget('procesoi');
		return View::make('modulotierras.consultarproceso', array('arrayproceso' => $arrayproceso), array('arraydombobox' => $arraydombobox));
	}
	//funcion que toca borrar es solo de pruebas
	public function PruebaPro()
	{
		//return 'Aqui podemos listar a los usuarios de la Base de Datos:';
		$arrayproini = DB::select('SELECT DISTINCT * FROM MODTIERRAS_PROCESOINICIAL WHERE NOT EXISTS (SELECT * FROM MODTIERRAS_PROCESO WHERE MODTIERRAS_PROCESOINICIAL.id_proceso = MODTIERRAS_PROCESO.id_proceso)');
		return View::make('vista3', array('arrayproini' => $arrayproini));
	}
	//funcion que toca borrar es solo de pruebas
	public function UpdateProcesogeo()
	{
		//MODTIERRAS_PROCESONOVEDAD
		//$arraytecnicos = DB::select("SELECT cedula,nombre,estado,catastral FROM MODTIERRAS_TECNICOS where catastral=".Auth::user()->id);
		$arrayprocesos = DB::select("SELECT MODTIERRAS_PROCESONOVEDAD.id_proceso FROM MODTIERRAS_PROCESONOVEDAD INNER JOIN MODTIERRAS_TECNICOS ON MODTIERRAS_PROCESONOVEDAD.id_tecnico=MODTIERRAS_TECNICOS.cedula WHERE MODTIERRAS_TECNICOS.catastral=".Auth::user()->id." group by MODTIERRAS_PROCESONOVEDAD.id_proceso");
		$arraynombnovedad = DB::select("SELECT id,descripcion FROM MODTIERRAS_NOVEDADES");
		$arrayproccoord = DB::select("SELECT id_proceso, IsNull([1],0) as nov1, IsNull([2],0) as nov2, IsNull([3],0) as nov3, IsNull([4],0) as nov4, IsNull([5],0) as nov5 FROM (SELECT MODTIERRAS_PROCESONOVEDAD.id_proceso, MODTIERRAS_PROCESONOVEDAD.novedad, MODTIERRAS_PROCESONOVEDAD.validado FROM MODTIERRAS_PROCESONOVEDAD INNER JOIN MODTIERRAS_TECNICOS ON MODTIERRAS_PROCESONOVEDAD.id_tecnico=MODTIERRAS_TECNICOS.cedula WHERE MODTIERRAS_PROCESONOVEDAD.validado=1 AND MODTIERRAS_TECNICOS.catastral=".Auth::user()->id.") as src pivot (sum(validado) FOR novedad in ([1], [2], [3], [4], [5])) as result");
		$arraydombobox= array($arrayprocesos,$arraynombnovedad);
		
		//return $arrayproccoord;		
		return View::make('modulotierras.coordenadas', array('arrayproccoord' => $arrayproccoord), array('arraydombobox' => $arraydombobox));
	}
	public function postCoordenadasEdicion()
	{
		Session::put('procesoi',Input::get('proceso'));		
		return Redirect::to('edit_novedad');
	}
	public function EditCoordenadas()
	{
		$idpro=(Session::get('procesoi'));
		if($idpro==''){
			return Redirect::to('novedadesodk');
		}

		$arraydomtecnicos = DB::table('MODTIERRAS_TECNICOS')
			->where('catastral','=',Auth::user()->id)
			->select('cedula','nombre','estado','catastral')
			->get();
		$arrayprocesos = DB::table('MODTIERRAS_PROCESONOVEDAD')
			->where('id_proceso','=',$idpro)
			->select('llave','id_proceso','novedad','longitud','latitud','validado','id_tecnico')
			->orderBy('llave', 'asc')
			->get();

		$arrayprocesoscant=DB::table('MODTIERRAS_PROCESONOVEDAD')
		->select('llave')
		->where('id_proceso','=',$idpro)
		->groupBy('llave')
		->get();
		$arraydomvalidacion = DB::table('MODTIERRAS_VALIDACION')			
			->select('id','descripcion')
			->get();

		$arrayeditcoordenainsumos= array($arrayprocesos,$arrayprocesoscant,$arraydomtecnicos,$arraydomvalidacion);	
		
		$arrayapp = DB::table('MODTIERRAS_PROCESO')->where('id_proceso','=',$idpro)->select('id_proceso','longitud', 'latitud')->get();				
		Session::forget('procesoi');
		//return $arrayeditcoordenainsumos;
		return View::make('modulotierras.coordenadasedit', array('arrayapp' => $arrayapp), array('arrayeditcoordenainsumos' => $arrayeditcoordenainsumos));
	}
	public function postGuardarCoordenadas()
	{			
		$odkkey = Input::get('keyodk');	

		$arraygetcoord = DB::table('MODTIERRAS_PROCESONOVEDAD')
			->where('llave','=',$odkkey)
			->select('id_proceso','longitud','latitud')
			->groupBy('llave','id_proceso','longitud','latitud')
			->get();

		DB::table('MODTIERRAS_PROCESO')
            ->where('id_proceso', $arraygetcoord[0]->id_proceso)            
            ->update(array('longitud'=>$arraygetcoord[0]->longitud, 'latitud'=>$arraygetcoord[0]->latitud,'updatedcoord'=>date("Y-m-d H:i:s"), 'respcoordmodif'=>Auth::user()->id));

		//return $arraygetcoord;
		$dat[0]=$arraygetcoord[0]->id_proceso;
		DB::table('MODTIERRAS_PROCESONOVEDAD')
            ->where('id_proceso','=', $arraygetcoord[0]->id_proceso)            
            ->update(['validado'=>3]);
        DB::table('MODTIERRAS_PROCESONOVEDAD')
            ->where('llave','=', $odkkey)            
            ->update(['validado'=>2]);

		/*USP_TIERRAS_UPDATEPROCESOGEO*/		
		$arrayclallprocedimiento = DB::statement("DECLARE @return_value int EXEC	@return_value = [USP_TIERRAS_UPDATEPROCESOGEO]	@id_proceso = N'$dat[0]' SELECT	'Return Value' = @return_value");
		if((int)$arrayclallprocedimiento==1){
			$status='true';
		}
		else{
			$status='false';
		}
		return Redirect::to('novedadesodk')->with('status',$status);		
		
		
	}
	public function Reporgenero()
	{		
		$arraygen=DB::table('MODTIERRAS_PROCESO')
		->select('genero',DB::raw('count(*) as y, genero'))
		->groupBy('genero')
		->get();
		return View::make('modulotierras.reporgenero', array('arraygen' => $arraygen));
	}
	public function Reportiempo()
	{		
		$arraytiempo=DB::table('MODTIERRAS_PROCESO')
		->select('genero',DB::raw('count(*) as y, genero'))
		->groupBy('genero')
		->get();
		return View::make('modulotierras.reportiempo', array('arraygen' => $arraytiempo));
		//consulta para retornar los procesos por abogado
		$arrayproceso = DB::select("SELECT final.id_proceso,Sum(CASE WHEN final.id_estado = '1' THEN 1 ELSE 0 END) as estudiojuridico, Sum(CASE WHEN final.id_estado = '2' AND final.levtopo != '2' THEN (CASE WHEN final.levtopo = '3' THEN 2 ELSE 1 END) ELSE 0 END) as levantamientotopografico, Sum(CASE WHEN final.id_estado = '3' OR final.id_estado = '4' THEN 1 ELSE 0 END) as radicado, Sum(CASE WHEN final.id_estado = '5' AND final.fechainspeccionocular2 != '2' THEN (CASE WHEN final.fechainspeccionocular2 = '3' THEN 2 ELSE 1 END) ELSE 0 END) as visitainspeccionocular, Sum(CASE WHEN final.id_estado = '6' OR final.id_estado = '7' OR final.id_estado = '8' THEN 1 ELSE 0 END) as resultadoprocesal, Sum(CASE WHEN final.id_estado = '9' THEN 1 ELSE 0 END) as registroorip	 FROM (SELECT proce.id_proceso, procesta.id_estado,proce.respjuridico,proce.fechainspeccionocular2,proce.levtopo FROM( SELECT pro.id_proceso,pro.respjuridico	,Sum(CASE WHEN pro.requierevisinsp = '1' THEN (CASE WHEN pro.fechainspeccionocular != '' THEN 1 ELSE 2 END) ELSE 3 END) as fechainspeccionocular2,Sum(CASE WHEN pro.requiererespgeo = '1' THEN (CASE WHEN pro.docutopo = '1' THEN 1 ELSE 2 END) ELSE 3 END) as levtopo FROM( SELECT proceso.id_proceso ,proceso.respjuridico ,proceso.requierevisinsp ,proceso.fechainspeccionocular ,proceso.requiererespgeo,Sum(CASE WHEN prodocu.id_documento = '2' THEN 1 ELSE 0 END) as docutopo FROM (SELECT id_proceso ,id_documento FROM MODTIERRAS_PROCDOCUMENTOS where id_documento=2)as prodocu RIGHT JOIN MODTIERRAS_PROCESO as proceso ON prodocu.id_proceso=proceso.id_proceso group by proceso.id_proceso,proceso.respjuridico,proceso.requierevisinsp,proceso.fechainspeccionocular,proceso.requiererespgeo) as pro group by pro.id_proceso,pro.respjuridico) as proce JOIN MODTIERRAS_PROCESTADO as procesta ON procesta.id_proceso=proce.id_proceso) as final group by final.id_proceso");
		
		
	}
	
	public function Diferenciafechas()
	{
		
		$datetime1 = date_create('2016-01-01');
		$datetime2 = date_create();
		$diferencia = date_diff($datetime1, $datetime2);

		$resul=$diferencia->format('%y años, %m meses, %d días, %r%a total días');

		return $resul;		
	}
}
?>