<?php

class ArtnormatividadController extends BaseController {
	
	//-------------------------------------------------------------------------------------
	//Controlador para la carga inicial de la vista
	public function carganorma(){
		$responsable = DB::table('MODART_NORM_RESPONSABLE')
							->select(DB::RAW('id,nombre'))
							->orderby('nombre')	
							->get();

		$tipo = DB::table('MODART_NORM_TIPO')
							->select(DB::RAW('id,nombre'))
							->orderby('nombre')	
							->get();

		$semaforo = DB::table('MODART_NORM_SEMAFORO')
							->select(DB::RAW('id,nombre'))							
							->get();

		$normas = DB::table('MODART_NORM_NORMAS')
							->join('MODART_NORM_RESPONSABLE','MODART_NORM_RESPONSABLE.id','=','MODART_NORM_NORMAS.id_res')
							->join('MODART_NORM_TIPO','MODART_NORM_TIPO.id','=','MODART_NORM_NORMAS.id_tipo')
							->join('MODART_NORM_CONSULTAPREV','MODART_NORM_CONSULTAPREV.id','=','MODART_NORM_NORMAS.id_consprev')
							->select(DB::RAW('MODART_NORM_NORMAS.id,pto_acu,norma, MODART_NORM_RESPONSABLE.nombre as responsable, MODART_NORM_TIPO.nombre as tipo,id_semafo,LEFT(fecha_gob,11) as fecha_gob, MODART_NORM_CONSULTAPREV.nombre as id_consprev,obs'))
							->where('borrado','=','0')							
							->get();

		$array = [$responsable,$tipo,$semaforo,$normas];

		return View::make('moduloart/normcarganorma', array('array' => $array));
	}

	public function postCargarNorma(){		
		
		$fecha = date("Y-d-m H:i:s");		
		if(Input::get('id_consprev')=='1'){
			$cv=2;
		} elseif(Input::get('id_consprev')=='2'){
			$cv=2;
		} elseif(Input::get('id_consprev')=='3'){
			$cv=1;
		} else {
			$cv=3;
		}
		//Insertar inrformacion inicial		
		$insert= DB::table('MODART_NORM_NORMAS')->insert(
		    	array(
		    		'id_uscrea' => Auth::user()->id,
		    		'id_usedita' => Auth::user()->id,		    		
		    		'pto_acu' => Input::get('pto_acu'),		    		
		    		'norma' => Input::get('norma'),
		    		'id_res' => Input::get('id_res'),
		    		'id_tipo' => Input::get('id_tipo'),
		    		'id_semafo' => Input::get('id_semafo'),
		    		'fecha_gob' => Input::get('fecha_gob'),
		    		'id_consprev' => Input::get('id_consprev'),
		    		'tab_encons' => "1",
		    		'tab_inte' => $cv,
		    		'obs' => Input::get('obs'),
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha
		    	)
		);

		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_borrar'); 
		}
		
	}

	public function postConsultaEditar(){

		$norma = DB::table('MODART_NORM_NORMAS')							
							->select(DB::RAW('id,pto_acu,norma, id_res, id_tipo,id_semafo,id_consprev,obs,tab_encons,tab_prodjud,tab_ajus,tab_ultrev,tab_defexp,tab_csivi,tab_hacie,tab_social,tab_inte,tab_expe,tab_congre,tab_firma,tab_sancpres'))
							->where('id','=',Input::get('norma'))							
							->get();

		return $norma;
	}

	public function postEditarNorma(){
		
		$fecha = date("Y-d-m H:i:s");
		$id=1;

		if(Input::get('id_consprev_edit')=='1'){
			$cv=2;
		} elseif(Input::get('id_consprev_edit')=='2'){
			$cv=2;
		} elseif(Input::get('id_consprev_edit')=='3'){
			$cv=1;
		} else {
			$cv=3;
		}		
		$insert=DB::table('MODART_NORM_NORMAS')->where('id',Input::get('id_editar'))->update(
	    	array(
	    		'id_usedita' => Auth::user()->id,
	    		'pto_acu' =>  Input::get('pto_acu-edit'),
	    		'norma' =>  Input::get('norma-edit'),
	    		'id_res' =>  Input::get('id_res_edit'),
	    		'id_tipo' =>  Input::get('id_tipo_edit'),
	    		'id_semafo' =>  Input::get('id_semafo_edit'),
	    		'id_consprev' => Input::get('id_consprev_edit'),
	    		'tab_inte' => $cv,
	    		'obs' =>  Input::get('obs_edit'),
	    		'updated_at' => $fecha	    		
	    	)
		);
		
		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_editar'); 
		}
	}

	public function postEditarTablero(){

		$fecha = date("Y-d-m H:i:s");

		$insert=DB::table('MODART_NORM_NORMAS')->where('id',Input::get('id_editar_tablero'))->update(
		    	array(		    				    		
		    		'tab_encons' =>  "1",
		    		'tab_prodjud' =>  Input::get('tab_prodjud'),
		    		'tab_ajus' =>  Input::get('tab_ajus'),
		    		'tab_ultrev' =>  Input::get('tab_ultrev'),
		    		'tab_defexp' =>  Input::get('tab_defexp'),
		    		'tab_csivi' =>  Input::get('tab_csivi'),
		    		'tab_hacie' =>  Input::get('tab_hacie'),
		    		'tab_social' =>  Input::get('tab_social'),		    		
		    		'tab_expe' =>  Input::get('tab_expe'),
		    		'tab_congre' =>  Input::get('tab_congre'),
		    		'tab_firma' =>  Input::get('tab_firma'),
		    		'tab_sancpres' =>  Input::get('tab_sancpres'),
		    		'updated_at' => $fecha		    		
		    	)
			);		

		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_editar'); 
		}
	}

	public function postBorrarNorma(){

		$fecha = date("Y-m-d H:i:s");

		$insert=DB::table('MODART_NORM_NORMAS')->where('id',Input::get('id_borrar'))->update(
		    	array(		    				    		
		    		'borrado' =>  1,
		    		'updated_at' => $fecha			    		
		    	)
			);		

		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_borrar'); 
		}
	}

	//Controlador para la carga inicial de la vista
	public function consultanorma(){
		
		$normas = DB::table('MODART_NORM_NORMAS')							
							->select(DB::RAW('id,norma, tab_encons, tab_prodjud, tab_ajus, tab_ultrev,tab_defexp, tab_csivi,tab_hacie,tab_social,tab_inte,tab_expe,tab_congre,tab_firma,tab_sancpres '))
							->where('borrado','=','0')							
							->get();

		return View::make('moduloart/normtabindicador', array('array' => $normas));
	}

	public function postConsultar(){
		$norma = DB::table('MODART_NORM_NORMAS')
					->join('MODART_NORM_RESPONSABLE','MODART_NORM_RESPONSABLE.id','=','MODART_NORM_NORMAS.id_res')
					->join('MODART_NORM_TIPO','MODART_NORM_TIPO.id','=','MODART_NORM_NORMAS.id_tipo')
					->join('MODART_NORM_CONSULTAPREV','MODART_NORM_CONSULTAPREV.id','=','MODART_NORM_NORMAS.id_consprev')
					->select(DB::RAW('MODART_NORM_NORMAS.id,pto_acu,norma, MODART_NORM_RESPONSABLE.nombre as responsable, MODART_NORM_TIPO.nombre as tipo,id_semafo,LEFT(fecha_gob,11) as fecha_gob, MODART_NORM_CONSULTAPREV.nombre as id_consprev,obs'))
					->where('MODART_NORM_NORMAS.id','=',Input::get('norma'))							
					->get();
		return $norma;
	}

	public function postCorte(){

		$update=DB::table('MODART_NORM_NORMAS')->update(
		    	array(		    				    		
		    		'fecha_corte' => Input::get('fecha_corte'),		    		
		    		)
				);

		$consulta = DB::table('MODART_NORM_NORMASCORTE')					
					->select(DB::RAW('fecha_corte'))
					->where('fecha_corte','=',Input::get('fecha_corte_consulta'))							
					->get();		

		if(count($consulta)>0){
			$insert=0;
		} else {
			$insert=DB::statement("INSERT INTO MODART_NORM_NORMASCORTE SELECT [id],[pto_acu],[norma],[id_res],[id_tipo],[tab_encons],[tab_prodjud],[tab_ajus],[tab_ultrev],[tab_hacie],[tab_expe],[tab_congre],[tab_firma],[tab_sancpres],[id_semafo],[fecha_gob],[id_consprev],[tab_social],[fecha_soci],[id_hacien],[id_avalfis],[obs],[borrado],[tab_csivi],[tab_inte],[fecha_corte],[tab_defexp],[id_uscrea],[id_usedita],[created_at],[updated_at] FROM MODART_NORM_NORMAS");			
		}

		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus_corte'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_corte'); 
		}
	}

	public function reportes(){
		$fecha_corte = DB::table('MODART_NORM_NORMASCORTE')							
							->select(DB::RAW('convert(varchar(10), fecha_corte, 112) as fecha_corte'))
							->groupby('fecha_corte')							
							->get();

		$ultimo_corte = DB::select("SELECT convert(varchar(10),  MAX(fecha_corte), 112) as fecha_corte FROM DABASE.sde.MODART_NORM_NORMASCORTE"); 

		$a_hoy = DB::select("SELECT   (SELECT COUNT(*) AS encons FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_encons=1)) encons   , (SELECT COUNT(*) AS prodjud FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_prodjud=1)) prodjud   , (SELECT COUNT(*) AS tab_ajus FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_ajus=1)) ajust   , (SELECT COUNT(*) AS tab_ultrev FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_ultrev=1)) revis   , (SELECT COUNT(*) AS tab_expe FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_expe=1)) exped   , (SELECT COUNT(*) AS tab_csivi FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_csivi=1)) csivi   , (SELECT COUNT(*) AS tab_hacie FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_hacie=1)) haciend   , (SELECT COUNT(*) AS tab_social FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_social=1)) sociali   , (SELECT COUNT(*) AS id_consprev FROM DABASE.sde.MODART_NORM_NORMAS WHERE (id_consprev=3)) consprev   , (SELECT COUNT(*) AS tab_defexp FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_defexp=1)) expedi   , (SELECT COUNT(*) AS tab_congrefir FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_congre=1 or tab_firma=1)) congrefir   , (SELECT COUNT(*) AS tab_sancpres FROM DABASE.sde.MODART_NORM_NORMAS WHERE (tab_sancpres=1)) tab_sancpres");

		$a_corte = DB::select("SELECT   (SELECT COUNT(*) AS encons FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_encons=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) encons   , (SELECT COUNT(*) AS prodjud FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_prodjud=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) prodjud   , (SELECT COUNT(*) AS tab_ajus FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_ajus=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) ajust   , (SELECT COUNT(*) AS tab_ultrev FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_ultrev=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) revis   , (SELECT COUNT(*) AS tab_expe FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_expe=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) exped   , (SELECT COUNT(*) AS tab_csivi FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_csivi=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) csivi   , (SELECT COUNT(*) AS tab_hacie FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_hacie=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) haciend   , (SELECT COUNT(*) AS tab_social FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_social=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) sociali   , (SELECT COUNT(*) AS id_consprev FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (id_consprev=3 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) consprev   , (SELECT COUNT(*) AS tab_defexp FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_defexp=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) expedi   , (SELECT COUNT(*) AS tab_congrefir FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE ((tab_congre=1 or tab_firma=1) AND fecha_corte='".$ultimo_corte[0]->fecha_corte."')) congrefir   , (SELECT COUNT(*) AS tab_sancpres FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_sancpres=1 and fecha_corte='".$ultimo_corte[0]->fecha_corte."')) tab_sancpres");

		$reporte_tipo = DB::table('MODART_NORM_NORMAS')							
					   ->join('MODART_NORM_TIPO','MODART_NORM_NORMAS.id_tipo','=','MODART_NORM_TIPO.id')
					   ->select(DB::RAW('MODART_NORM_TIPO.nombre,count([id_tipo]) as suma'))
					   ->groupby('id_tipo','MODART_NORM_TIPO.nombre')							
					   ->get();

		$num_registros = DB::table('MODART_NORM_NORMAS')
					   ->select(DB::RAW('count([id_tipo]) as suma'))
					   ->get();

		return View::make('moduloart/normreportnorma', array('array' => $fecha_corte,'consulta' => $a_hoy, 'consulta2' => $a_corte, 'ultimo_corte' => $ultimo_corte,'reporte_tipo'=>$reporte_tipo, 'num_registros'=>$num_registros));
	}

	public function postReporteCorte(){
		
		$fecha_corte = DB::table('MODART_NORM_NORMASCORTE')							
						->select(DB::RAW('convert(varchar(10), fecha_corte, 112) as fecha_corte'))
						->groupby('fecha_corte')
						->get();

		$fecha_corte = strval(Input::get('fecha')); 

		$a_corte = DB::select("SELECT   (SELECT COUNT(*) AS encons FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_encons=1 and fecha_corte='".$fecha_corte."')) encons   , (SELECT COUNT(*) AS prodjud FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_prodjud=1 and fecha_corte='".$fecha_corte."')) prodjud   , (SELECT COUNT(*) AS tab_ajus FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_ajus=1 and fecha_corte='".$fecha_corte."')) ajust   , (SELECT COUNT(*) AS tab_ultrev FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_ultrev=1 and fecha_corte='".$fecha_corte."')) revis   , (SELECT COUNT(*) AS tab_expe FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_expe=1 and fecha_corte='".$fecha_corte."')) exped   , (SELECT COUNT(*) AS tab_csivi FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_csivi=1 and fecha_corte='".$fecha_corte."')) csivi   , (SELECT COUNT(*) AS tab_hacie FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_hacie=1 and fecha_corte='".$fecha_corte."')) haciend   , (SELECT COUNT(*) AS tab_social FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_social=1 and fecha_corte='".$fecha_corte."')) sociali   , (SELECT COUNT(*) AS id_consprev FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (id_consprev=3 and fecha_corte='".$fecha_corte."')) consprev   , (SELECT COUNT(*) AS tab_defexp FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_defexp=1 and fecha_corte='".$fecha_corte."')) expedi   , (SELECT COUNT(*) AS tab_congrefir FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE ((tab_congre=1 or tab_firma=1) AND fecha_corte='".$fecha_corte."')) congrefir   , (SELECT COUNT(*) AS tab_sancpres FROM DABASE.sde.MODART_NORM_NORMASCORTE WHERE (tab_sancpres=1 and fecha_corte='".$fecha_corte."')) tab_sancpres");

		return array('array' => $fecha_corte, 'consulta2' => $a_corte, 'ultimo_corte' => json_encode($fecha_corte));
	}
}
?>