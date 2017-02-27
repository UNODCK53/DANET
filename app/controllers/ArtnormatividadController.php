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
			$insert=DB::statement("INSERT INTO MODART_NORM_NORMASCORTE SELECT [id],[pto_acu],[norma],[id_res],[id_tipo],[tab_encons],[tab_prodjud],[tab_ajus],[tab_ultrev],[tab_hacie],[tab_expe],[tab_congre],[tab_firma],[tab_sancpres],[id_semafo],[fecha_gob],[id_consprev],[id_social],[fecha_soci],[id_hacien],[id_avalfis],[obs],[borrado],[tab_csivi],[tab_inte],[fecha_corte] FROM MODART_NORM_NORMAS");			
		}

		if($insert>0){
			return Redirect::to('normcarganorma')->with('status', 'ok_estatus_corte'); 
		} else {
			return Redirect::to('normcarganorma')->with('status', 'error_estatus_corte'); 
		}
	}
}
?>