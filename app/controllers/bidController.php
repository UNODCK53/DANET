<?php

class bidController extends BaseController {
	

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de edicion
	public function cargapublic_ini(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->get();

		$valor = DB::table('MODBID_VALORVA')
							->select(DB::RAW('id,nombre'))	
							->get();

		$organizaciones=DB::table('MODBID_BIDPUBLIC')
						->join('MODBID_ORGANIZACION','MODBID_BIDPUBLIC.nit','=','MODBID_ORGANIZACION.nit')
						->join('DEPARTAMENTOS','DEPARTAMENTOS.COD_DPTO','=','MODBID_ORGANIZACION.cod_depto')
						->select(DB::RAW('NOM_DPTO,MODBID_BIDPUBLIC.nit, acronim, nombre'))	
						->get();

		$array=[$valor,$organizaciones];

		return View::make('modulobid/cargaorganizacion', array('departamentos' => $departamentos), array('array' => $array));
	}

	public function postOrganizaciones(){
		$depto=Input::get('depto');
		$organizaciones = DB::table('MODBID_ORGANIZACION')
						->select(DB::RAW('nit, acronim'))
						->where('cod_depto','=',$depto)
						->orderby('acronim')
						->get();
		return $organizaciones;
	}

	public function postCargar(){
		$nit=Input::get('organizaciones');
		//Insertar inrformacion inicial
		DB::table('MODBID_BIDPUBLIC')->insert(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'nit' => Input::get('organizaciones'),		    		
		    		'descripcion' => Input::get('descripcion'),		    		
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);
		//Insertar el banner personalizado
		if(Input::get('optionsRadios')==1){
			$banner=$nit.'_banner.jpg';
			DB::table('MODBID_BIDPUBLIC')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'banner' =>  $banner,		    				    				    		
		    	)
			);
			$path_banner = public_path().'\assets\bid\banner';
			Input::file('bannerjpg')->move($path_banner,$banner);			
		}
		//Insertar el logo de la organizacion
		if(Input::get('optionsRadios_logo')==1){
			$logo=$nit.'_logo.jpg';
			DB::table('MODBID_BIDPUBLIC')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'logo' =>  $logo,		    				    				    		
		    	)
			);
			$path_logo = public_path().'\assets\bid\logo';
			Input::file('logojpg')->move($path_logo,$logo);			
		}
		//Aca inicia el insert de líneas productivas y de información de valor agregado
		//Insertar el logo de la organizacion
		if(Input::get('optionsRadios_lpva')==1){
			DB::table('MODBID_LINEAPRODORG')->insert(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'nit' => $nit,		    		
		    		'linea_prod' => Input::get('linea_prod'),		    		
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
			);			
		}
		//Insertar el logo de la linea productiva
		if(Input::get('optionsRadios_imagen_lp')==1){
			$logo_lp=$nit.'_linea_prod_'.Input::get('linea_prod').'_logo_lp.jpg';
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'logo_lp' =>  $logo_lp,		    				    				    		
		    	)
			);
			$path_logo_lp = public_path().'\assets\bid\logo_lp';
			Input::file('logo_lp')->move($path_logo_lp,$logo_lp);			
		}
		//Insertar la descripcion de la linea productiva
		if(Input::get('optionsRadios_descripcion_lp')==1){			
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'desc_lp' =>  Input::get('descr_lp'),		    				    				    		
		    	)
			);					
		}
		//Insertar valor agregado
		if(Input::get('optionsRadios_lpva')==1){
			DB::table('MODBID_BIDPUBLICVA')->insert(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'nit' => $nit,		    		
		    		'id_val' => Input::get('valoragregado'),
		    		'descripcion' => Input::get('va')
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
			);			
		}
		return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus'); 
	}

	public function postEditar(){
		$organizacion=Input::get('organizacion');
		$editar = DB::table('MODBID_ORGANIZACION')					  
					  ->select(db::raw('acronim'))
					  ->where('nit','=',$organizacion)
					  ->get();

		$lp = DB::table('MODBID_LINEAPRODORG')					  
			  ->select(db::raw('nit, linea_prod, desc_lp, id'))
			  ->where('nit','=',$organizacion)
			  ->get();

		$array=[$editar, $lp];	

		return $array;
	}

	public function postEditBanner(){
		$nit=Input::get('id_editar_banner');
		$banner=$nit.'_banner.jpg';
		DB::table('MODBID_BIDPUBLIC')->where('nit',$nit)->update(
	    	array(		    				    		
	    		'banner' =>  $banner,		    				    				    		
	    	)
		);
		$path_banner = public_path().'\assets\bid\banner';
		Input::file('bannerjpg_edit')->move($path_banner,$banner);
		
		return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus');
	}

	public function postEditLogo(){
		$nit=Input::get('id_editar_logo');
		$logo=$nit.'_logo.jpg';
		DB::table('MODBID_BIDPUBLIC')->where('nit',$nit)->update(
	    	array(		    				    		
	    		'logo' =>  $logo,		    				    				    		
	    	)
		);
		$path_logo = public_path().'\assets\bid\logo';
		Input::file('logojpg_edit')->move($path_logo,$logo);
		
		return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus');
	}

	public function postAdicionarLinea(){
		//Insertar la línea productiva
		$nit=Input::get('id_adicionar_linea');		
		DB::table('MODBID_LINEAPRODORG')->insert(
	    	array(
	    		//'id_usuario' => Auth::user()->id,		    		
	    		'nit' => $nit,		    		
	    		'linea_prod' => Input::get('linea_prod_add'),		    		
	    		//'created_at' => $fecha,
    			//'updated_at' => $fecha
	    	)
		);			
		
		//Insertar el logo de la linea productiva
		if(Input::get('optionsRadios_imagen_lp_edit')==1){
			$logo_lp=$nit.'_linea_prod_'.Input::get('linea_prod_add').'_logo_lp.jpg';
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'logo_lp' =>  $logo_lp,		    				    				    		
		    	)
			);
			$path_logo_lp = public_path().'\assets\bid\logo_lp';
			Input::file('logo_lp')->move($path_logo_lp,$logo_lp);			
		}
		//Insertar la descripcion de la linea productiva
		if(Input::get('optionsRadios_descripcion_lp_add')==1){			
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->update(
		    	array(		    				    		
		    		'desc_lp' =>  Input::get('descr_lp_add'),		    				    				    		
		    	)
			);					
		}

		return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus');
	}

	public function postConsultaBorrarLp(){
		$id_registro=Input::get('lineaproductiva');
		$lp = DB::table('MODBID_LINEAPRODORG')					  
				  ->select(db::raw('linea_prod'))
				  ->where('id','=',$id_registro)
				  ->get();

		return $lp;
	}

	public function postBorrarLp(){
		$id_registro=Input::get('id_borrar');
		DB::table('MODBID_LINEAPRODORG')->where('id',$id_registro)->update(
		    	array(		    				    		
		    		'borrado' =>  1,		    				    				    		
		    	)
		);

		return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus');
	}

}
?>