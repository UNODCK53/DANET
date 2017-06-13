<?php

class Artplan100Controller extends BaseController {
	

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de edicion

	public function plan100_ini()
	{
		$departamentos = DB::table('DEPARTAMENTOS')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->get();
		/*Consulta de los proyectos existentes en la base de datos*/
		$proyectos =DB::table('MODART_P100DIAS')
					  ->join('DEPARTAMENTOS','MODART_P100DIAS.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
					  ->join('MUNICIPIOS','MODART_P100DIAS.cod_mpio','=','MUNICIPIOS.COD_DANE')	
					  ->select(db::raw('id, DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda,nom_proy,mod_foca,avance_prod,contactoterr,tel_contactoterr'))
					  ->where('reg_eliminado','=','0')
					  ->get();
		return View::make('moduloart/plancienrrcargaproy', array('departamentos' => $departamentos), array('proyectos' => $proyectos));
	}

	public function postMunicipios()
	{
		$depto=Input::get('depto');
		$municipios = DB::table('MUNICIPIOS')
						->select(DB::RAW('COD_DANE, NOM_MPIO_1'))
						->where('COD_DPTO','=',$depto)
						->orderby('NOM_MPIO_1')
						->get();
		return $municipios;
	}

	public function postCargarProyecto(){
		$id=1;
		/*Congigurar el campo Avance_pres como lo recibe la base de datos*/ 
		$avan_pre=Input::get('avance_presupuestal');		
		$avan_pre = explode(" ",$avan_pre);
		$avan_pre = explode(".",$avan_pre[1]);
		$var_1="";
		foreach ($avan_pre as $var_tem) {
			$var_1=$var_1.$var_tem;
		}
		/*Congigurar el campo costo_estim como lo recibe la base de datos*/ 
		$costo_estim=Input::get('costo_estimado');		
		$costo_estim = explode(" ",$costo_estim);
		$costo_estim = explode(".",$costo_estim[1]);
		$var_2="";
		foreach ($costo_estim as $var_tem2) {
			$var_2=$var_2.$var_tem2;
		}
		/*Congigurar el campo costo_estim como lo recibe la base de datos*/ 
		$costo_ejec=Input::get('costo_ejecutado');		
		$costo_ejec = explode(" ",$costo_ejec);
		$costo_ejec = explode(".",$costo_ejec[1]);
		$var_3="";
		foreach ($costo_ejec as $var_tem3) {
			$var_3=$var_3.$var_tem3;
		}

		DB::table('MODART_P100DIAS')->insert(
		    	array(
		    		//'id_usuario' => Auth::user()->id,
		    		'id_usuario' => $id,
		    		'cod_depto' => Input::get('depto'),
		    		'cod_mpio' => Input::get('municipios'),
		    		'vereda' => Input::get('veredas'),
		    		'nom_proy' => Input::get('nombre'),
		    		'mod_foca' => Input::get('modalidad'),
		    		'enti_lider' =>  Input::get('entidad'),
		    		'linea_proy' => Input::get('linea'),
		    		'alcance' => Input::get('alcance'),
		    		'pob_bene' => Input::get('poblacion'),
		    		'est_proy' =>  Input::get('estado'),
		    		'fecha_inicio' => Input::get('fecha_inicio'),
		    		'fecha_fin' =>  Input::get('fecha_final'),
		    		'avance_pres' => $var_1,
		    		'avance_prod' =>  Input::get('avance_producto'),
		    		'costo_estim' =>  $var_2,
		    		'costo_ejec' =>  $var_3
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);

		return Redirect::to('plancienrrcargaproy')->with('status', 'ok_estatus'); 
	}

	public function postEditar(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$editar =DB::table('MODART_P100DIAS')					  
					  ->select(db::raw('id, nom_proy,est_proy, fecha_fin,avance_pres, avance_prod, costo_ejec'))
					  ->where('id','=',$proyecto)
					  ->get();	

		return $editar;
	}

	public function postEditarProyecto(){
		$id=intval(Input::get('id_editar'));
		/*Congigurar el campo Avance_pres como lo recibe la base de datos*/ 
		$avan_pre=Input::get('avance_presupuestal_editar');		
		$avan_pre = explode(" ",$avan_pre);
		$avan_pre = explode(".",$avan_pre[1]);
		$var_1="";		
		foreach ($avan_pre as $var_tem) {
			$var_1=$var_1.$var_tem;
		}
		/*Congigurar el campo costo_estim como lo recibe la base de datos*/ 
		$costo_ejec=Input::get('costo_ejecutado_editar');		
		$costo_ejec = explode(" ",$costo_ejec);
		$costo_ejec = explode(".",$costo_ejec[1]);
		$var_3="";
		foreach ($costo_ejec as $var_tem3) {
			$var_3=$var_3.$var_tem3;
		}

		$edit=DB::table('MODART_P100DIAS')->where('id',$id)->update(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'est_proy' =>  Input::get('estado_editar'),		    		
		    		'fecha_fin' =>  Input::get('fecha_final_editar'),
		    		'avance_pres' => $var_1,
		    		'avance_prod' =>  Input::get('avance_producto_editar'),		    		
		    		'costo_ejec' =>  $var_3
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);
		if($edit>0){
			return Redirect::to('plancienrrcargaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('plancienrrcargaproy')->with('status', 'error_estatus_editar'); 
		}
		
	}

	public function postBorrarProyecto(){
		$id=intval(Input::get('id_borrar'));
		$borrar=DB::table('MODART_P100DIAS')->where('id',$id)->update(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'reg_eliminado' =>  1,		    				    		
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);
		if($borrar>0){
			return Redirect::to('plancienrrcargaproy')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('plancienrrcargaproy')->with('status', 'error_estatus_borrar'); 
		}
	}

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de consulta

	public function plan100_ini_consulta()
	{		
		/*Consulta de los proyectos existentes en la base de datos*/
		$proyectos =DB::table('MODART_P100DIAS')
			->join('DEPARTAMENTOS','MODART_P100DIAS.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
			->join('MUNICIPIOS','MODART_P100DIAS.cod_mpio','=','MUNICIPIOS.COD_DANE')	
			->select(db::raw('id, DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda,nom_proy,mod_foca,avance_prod,contactoterr,tel_contactoterr'))
			->where('reg_eliminado','=','0')
			->get();				
		
		$departamentos =DB::table('MODART_P100DIAS')
		 	->join('DEPARTAMENTOS','MODART_P100DIAS.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
		 	->join('MUNICIPIOS','MODART_P100DIAS.cod_mpio','=','MUNICIPIOS.COD_DANE')	
		 	->select('DEPARTAMENTOS.NOM_DPTO','DEPARTAMENTOS.COD_DPTO')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('DEPARTAMENTOS.NOM_DPTO','DEPARTAMENTOS.COD_DPTO')
		  	->orderBy('DEPARTAMENTOS.NOM_DPTO')
		  	->get();
		$avance =DB::table('MODART_P100DIAS')		 		
		 	->select('avance_prod')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('avance_prod')
		  	->orderBy('avance_prod')
		  	->get();
		$modalidad =DB::table('MODART_P100DIAS')		 		
		 	->select('mod_foca')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('mod_foca')
		  	->get();
		$estado =DB::table('MODART_P100DIAS')		 		
		 	->select('est_proy')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('est_proy')
		  	->get();
		$entilider =DB::table('MODART_P100DIAS')		 		
		 	->select('enti_lider')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('enti_lider')
		  	->get();
		$lineaproy =DB::table('MODART_P100DIAS')		 		
		 	->select('linea_proy')
		 	->where('reg_eliminado','=','0')
		  	->groupBy('linea_proy')
		  	->get();

		$arraydombobox= array($departamentos, $avance, $modalidad, $estado, $entilider, $lineaproy);		
		return View::make('moduloart.plancienrrconsulproy', array('proyectos' => $proyectos), array('arraydombobox' => $arraydombobox));

		//return View::make('moduloart/plancienrrconsulproy', array('departamentos' => $departamentos), array('proyectos' => $proyectos));
	}
	public function postMunicipiostabla()
	{
		$depto=Input::get('depto');		
		$municipios =DB::table('MODART_P100DIAS')		 	
		 	->join('MUNICIPIOS','MODART_P100DIAS.cod_mpio','=','MUNICIPIOS.COD_DANE')	
		 	->select('MUNICIPIOS.COD_DANE','MUNICIPIOS.NOM_MPIO_1')
		 	->where('reg_eliminado','=','0')
		 	->where('COD_DPTO','=',$depto)
		  	->groupBy('MUNICIPIOS.COD_DANE','MUNICIPIOS.NOM_MPIO_1')
		  	->get();
		return $municipios;
	}
	public function postFiltrarplan(){	

		$info=Input::get('info');
		$contador=0;		
		$ms=[];
		$filtrosplan = array("avance_prod=", "mod_foca='", "est_proy='", "enti_lider='", "linea_proy='", "cod_depto=", "cod_mpio=");
		for ($i=0; $i < count($info); $i++) { 
			if ($info[$i] !='') {
				$ms[$contador]=	$filtrosplan[$i].$info[$i];				
				if ($filtrosplan[$i] =="mod_foca='" OR $filtrosplan[$i] =="est_proy='" OR $filtrosplan[$i] =="enti_lider='" OR $filtrosplan[$i] =="linea_proy='") {
					$ms[$contador]=	$filtrosplan[$i].$info[$i]."'";				
				}
				$contador=$contador+1;
			}
				
		}
		$ms1='';
		for ($i=0; $i < count($ms); $i++) { 
			$ms1=$ms1.$ms[$i];			
			if ($i<>count($ms)-1) {
				$ms1=$ms1.' AND ';
			}
		}
		$editartabla =DB::table('MODART_P100DIAS')	
			->join('DPTOS_SIMPLIFY','MODART_P100DIAS.cod_depto','=','DPTOS_SIMPLIFY.COD_DPTO')
			->join('MPIOS_SIMPLIFY','MODART_P100DIAS.cod_mpio','=','MPIOS_SIMPLIFY.COD_DANE')					  
			->select(db::raw('id, DPTOS_SIMPLIFY.NOM_DPTO, MPIOS_SIMPLIFY.NOM_MPIO, vereda, nom_proy, mod_foca, enti_lider, linea_proy, alcance, pob_bene, est_proy, fecha_inicio, fecha_fin,avance_pres,contactoterr,tel_contactoterr,avance_prod, costo_ejec, cod_depto, cod_mpio'))
			->whereRaw($ms1)
			->get();
		
		
		
		
		return  Response::json($editartabla);
		//return  Response::json(array('grafica'=>$grafica,'nombre'=>$label,'arrayvda'=>$arrayvda,'arraymonitor'=>$arraymonitor,'arraydpto'=>$arraydpto,'arraymuni'=>$arraymuni));
	}
	public function postConsultar(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$editar =DB::table('MODART_P100DIAS')	
			->join('DEPARTAMENTOS','MODART_P100DIAS.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
			->join('MUNICIPIOS','MODART_P100DIAS.cod_mpio','=','MUNICIPIOS.COD_DANE')					  
			->select(db::raw('id,DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda, nom_proy,mod_foca,enti_lider,linea_proy,alcance,pob_bene,est_proy,fecha_inicio, fecha_fin,avance_pres, avance_prod, costo_ejec,descripcion,descr_avance_prod,inver_estim,observaciones,observaciones2,inf_alcanceproyc,contactoterr,tel_contactoterr,admon_municipal,evidencia_terr,verificacion'))
			->where('id','=',$proyecto)
			->get();
		return $editar;
	}
}
?>