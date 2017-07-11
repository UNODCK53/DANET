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
						->where('borrado','=',0)	
						->get();

		$lpe = DB::table('MODBID_LINEAPRODEXP')
							->select(DB::RAW('id_lipex,nombre'))
							->orderby('nombre')	
							->get();

		$array=[$valor,$organizaciones,$lpe];

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
		    		'id_lipex' => Input::get('linea_prod_ext'),		    		
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
			  ->where('borrado','=',0)
			  ->get();

		$va = DB::table('MODBID_BIDPUBLICVA')
			  ->join('MODBID_VALORVA','MODBID_BIDPUBLICVA.id_val','=','MODBID_VALORVA.id')					  
			  ->select(db::raw('nit, MODBID_VALORVA.nombre as id_val, descripcion, MODBID_BIDPUBLICVA.id'))
			  ->where('nit','=',$organizacion)
			  ->where('borrado','=',0)
			  ->get();

		$array=[$editar, $lp, $va];	

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
	    		'id_lipex' => Input::get('linea_prod_ext_edit'),
	    		'linea_prod' => Input::get('linea_prod_add'),		    		
	    		//'created_at' => $fecha,
    			//'updated_at' => $fecha
	    	)
		);			
		
		$id = DB::table('MODBID_LINEAPRODORG')				  
				  ->select(db::raw('id'))
				  ->where('MODBID_LINEAPRODORG.nit','=',$nit)
				  ->where('MODBID_LINEAPRODORG.linea_prod','=',Input::get('linea_prod_add'))
				  ->where('MODBID_LINEAPRODORG.id_lipex','=',Input::get('linea_prod_ext_edit'))
				  ->where('MODBID_LINEAPRODORG.borrado','=',0)
				  ->get();		
		//Insertar el logo de la linea productiva
		if(Input::get('optionsRadios_imagen_lp_edit')==1){
			$logo_lp=$nit.'_linea_prod_'.str_replace('"','',json_encode($id[0] -> id)).'_logo_lp.jpg';
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->where('id',str_replace('"','',json_encode($id[0] -> id)))->update(
		    	array(		    				    		
		    		'logo_lp' =>  $logo_lp,		    				    				    		
		    	)
			);
			$path_logo_lp = public_path().'\assets\bid\logo_lp';
			Input::file('logo_lp')->move($path_logo_lp,$logo_lp);			
		}
		//Insertar la descripcion de la linea productiva
		if(Input::get('optionsRadios_descripcion_lp_add')==1){			
			DB::table('MODBID_LINEAPRODORG')->where('nit',$nit)->where('id',str_replace('"','',json_encode($id[0] -> id)))->update(
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
		$insert=DB::table('MODBID_LINEAPRODORG')->where('id',$id_registro)->update(
		    	array(		    				    		
		    		'borrado' =>  1,		    				    				    		
		    	)
		);
		if($insert>0){
			return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus_borrar_lp');	
		} else {
			return Redirect::to('cargaorganizacion')->with('status', 'error_estatus_borrar_lp');	
		}
	}

	public function postAdicionarVa(){
		//Insertar el valor agregado
		$nit=Input::get('id_adicionar_va');		
		$insert=DB::table('MODBID_BIDPUBLICVA')->insert(
			    	array(
			    		//'id_usuario' => Auth::user()->id,		    		
			    		'nit' => $nit,		    		
			    		'id_val' => Input::get('valoragregado_adicionar'),
			    		'descripcion' => Input::get('va_adicionar'),
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);			
		
		if($insert>0){
			return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus_va');	
		} else {
			return Redirect::to('cargaorganizacion')->with('status', 'error_estatus_va');	
		}
	}
	
	public function postConsultaBorrarVa(){
		$id_registro=Input::get('registro');
		$va = DB::table('MODBID_BIDPUBLICVA')
				  ->join('MODBID_VALORVA','MODBID_BIDPUBLICVA.id_val','=','MODBID_VALORVA.id')					  
				  ->select(db::raw('MODBID_VALORVA.nombre as id_val'))
				  ->where('MODBID_BIDPUBLICVA.id','=',$id_registro)
				  ->get();
		return $va;
	}

	public function postBorrarVa(){
		$id_registro=Input::get('id_borrar_registro_va');

		$insert=DB::table('MODBID_BIDPUBLICVA')->where('id',$id_registro)->update(
			    	array(		    				    		
			    		'borrado' =>  1,		    				    				    		
			    	)
				);
		if($insert>0){
			return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus_borrar_va');	
		} else {
			return Redirect::to('cargaorganizacion')->with('status', 'error_estatus_borrar_va');	
		}		
	}

	public function postBorrarOrganizacion(){
		$id_registro=Input::get('id_borrar_organizacion');

		$insert=DB::table('MODBID_BIDPUBLIC')->where('nit',$id_registro)->update(
			    	array(		    				    		
			    		'borrado' =>  1,		    				    				    		
			    	)
				);
		if($insert>0){
			return Redirect::to('cargaorganizacion')->with('status', 'ok_estatus_borrar_organizacion');	
		} else {
			return Redirect::to('cargaorganizacion')->with('status', 'error_estatus_borrar_organizacion');	
		}
	}

	public function public_ini(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
							->join('MODBID_BIDPUBLIC','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->groupby('COD_DPTO','NOM_DPTO')	
							->get();

		$organizaciones = DB::table('MODBID_BIDPUBLIC')		
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('MODBID_BIDPUBLIC.nit,MODBID_ORGANIZACION.acronim,MODBID_ORGANIZACION.cod_depto'))
							->orderby('acronim')
							->get();

		$lineasproductivas = DB::table('MODBID_LINEAPRODORG')		
							->join('MODBID_LINEAPRODEXP','MODBID_LINEAPRODEXP.id_lipex','=','MODBID_LINEAPRODORG.id_lipex')
							->select(DB::RAW('MODBID_LINEAPRODORG.id_lipex, MODBID_LINEAPRODEXP.nombre'))
							->where('MODBID_LINEAPRODORG.id_lipex','!=','NULL')
							->groupby('MODBID_LINEAPRODORG.id_lipex','MODBID_LINEAPRODEXP.nombre')
							->get();

		$actividades = DB::table('MODBID_INFORMACIONPUBLIC')
							->select(DB::RAW('TOP 8 id,titulo,texto,foto,tipo,created_at,updated_at,id_usuario,fecha_noticia,borrado'))
							->where('borrado','=',0)
							->orderby('created_at','DESC')
							->get();

		$array = array($departamentos,json_encode($organizaciones), $lineasproductivas, $actividades);

		return View::make('access_outside/bid/bid_home_public', array('array' =>$array));
	}

	public function public_organizacion(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
							->join('MODBID_BIDPUBLIC','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->groupby('COD_DPTO','NOM_DPTO')	
							->get();

		$organizaciones = DB::table('MODBID_BIDPUBLIC')		
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('MODBID_BIDPUBLIC.nit,MODBID_ORGANIZACION.acronim,MODBID_ORGANIZACION.cod_depto'))
							->orderby('acronim')
							->get();

		$lineasproductivas = DB::table('MODBID_LINEAPRODORG')		
							->join('MODBID_LINEAPRODEXP','MODBID_LINEAPRODEXP.id_lipex','=','MODBID_LINEAPRODORG.id_lipex')
							->select(DB::RAW('MODBID_LINEAPRODORG.id_lipex, MODBID_LINEAPRODEXP.nombre'))
							->where('MODBID_LINEAPRODORG.id_lipex','!=','NULL')
							->groupby('MODBID_LINEAPRODORG.id_lipex','MODBID_LINEAPRODEXP.nombre')
							->get();

		$nit=Input::get('id');

		$organizacion = DB::table('MODBID_ORGANIZACION')
						  ->select(DB::RAW('nombre,acronim'))
						  ->where('nit',$nit)
						  ->get();

		$organizacion_des = DB::table('MODBID_BIDPUBLIC')
						  ->select(DB::RAW('logo,descripcion'))
						  ->where('nit',$nit)
						  ->where('borrado','=',0)
						  ->get();

		$organizacion_lp = DB::table('MODBID_LINEAPRODORG')
						  ->select(DB::RAW('linea_prod,logo_lp,desc_lp'))
						  ->where('nit',$nit)
						  ->where('borrado','=',0)
						  ->get();

		$organizacion_va = DB::table('MODBID_BIDPUBLICVA')
						  ->join('MODBID_VALORVA','MODBID_VALORVA.id','=','MODBID_BIDPUBLICVA.id_val')
						  ->select(DB::RAW('nombre as va,id_val,descripcion'))
						  ->where('nit',$nit)
						  ->where('borrado','=',0)
						  ->get();

		$array = array($departamentos,json_encode($organizaciones), $lineasproductivas,$organizacion, $organizacion_des, $organizacion_lp, $organizacion_va);

		return View::make('access_outside/bid/bid_organizacion_public', array('array' =>$array));
	}

	public function public_productos_terminados(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
							->join('MODBID_BIDPUBLIC','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->groupby('COD_DPTO','NOM_DPTO')	
							->get();

		$organizaciones = DB::table('MODBID_BIDPUBLIC')		
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('MODBID_BIDPUBLIC.nit,MODBID_ORGANIZACION.acronim,MODBID_ORGANIZACION.cod_depto'))
							->orderby('acronim')
							->get();

		$lineasproductivas = DB::table('MODBID_LINEAPRODORG')		
							->join('MODBID_LINEAPRODEXP','MODBID_LINEAPRODEXP.id_lipex','=','MODBID_LINEAPRODORG.id_lipex')
							->select(DB::RAW('MODBID_LINEAPRODORG.id_lipex, MODBID_LINEAPRODEXP.nombre'))
							->where('MODBID_LINEAPRODORG.id_lipex','!=','NULL')
							->groupby('MODBID_LINEAPRODORG.id_lipex','MODBID_LINEAPRODEXP.nombre')
							->get();

		$array = array($departamentos,json_encode($organizaciones), $lineasproductivas);

		return View::make('access_outside/bid/bid_productos_terminados_public', array('array' =>$array));
		
	}

	public function public_linea_productiva(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
							->join('MODBID_BIDPUBLIC','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->groupby('COD_DPTO','NOM_DPTO')	
							->get();

		$organizaciones = DB::table('MODBID_BIDPUBLIC')		
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('MODBID_BIDPUBLIC.nit,MODBID_ORGANIZACION.acronim,MODBID_ORGANIZACION.cod_depto'))
							->orderby('acronim')
							->get();

		$lineasproductivas = DB::table('MODBID_LINEAPRODORG')		
							->join('MODBID_LINEAPRODEXP','MODBID_LINEAPRODEXP.id_lipex','=','MODBID_LINEAPRODORG.id_lipex')
							->select(DB::RAW('MODBID_LINEAPRODORG.id_lipex, MODBID_LINEAPRODEXP.nombre'))
							->where('MODBID_LINEAPRODORG.id_lipex','!=','NULL')
							->groupby('MODBID_LINEAPRODORG.id_lipex','MODBID_LINEAPRODEXP.nombre')
							->get();
		$lp=Input::get('lp');

		$deptos_lp = DB::table('MODBID_ORGANIZACION')
					 ->join('MODBID_LINEAPRODORG','MODBID_LINEAPRODORG.nit','=','MODBID_ORGANIZACION.nit')
					 ->join('DEPARTAMENTOS','DEPARTAMENTOS.COD_DPTO','=','MODBID_ORGANIZACION.cod_depto')
					 ->select(DB::raw('cod_depto,NOM_DPTO'))
					 ->where('MODBID_LINEAPRODORG.id_lipex','=',$lp)
					 ->where('MODBID_LINEAPRODORG.borrado','=',0)
					 ->groupby('cod_depto','NOM_DPTO')
					 ->orderby('NOM_DPTO')
					 ->get();

		$org_lp = DB::table('MODBID_ORGANIZACION')
					 ->join('MODBID_LINEAPRODORG','MODBID_LINEAPRODORG.nit','=','MODBID_ORGANIZACION.nit')
					 ->select(DB::raw('MODBID_LINEAPRODORG.nit,cod_depto,acronim,MODBID_LINEAPRODORG.id_lipex'))
					 ->where('MODBID_LINEAPRODORG.id_lipex','=',$lp)
					 ->where('MODBID_LINEAPRODORG.borrado','=',0)
					 ->groupby('MODBID_LINEAPRODORG.nit','cod_depto','acronim','id_lipex')
					 ->orderby('acronim')
					 ->get();


		$lp_name=DB::table('MODBID_LINEAPRODEXP')
				->select(DB::RAW('MODBID_LINEAPRODEXP.nombre,id_lipex'))
				->where('MODBID_LINEAPRODEXP.id_lipex','=',$lp)
				->get();


		$array = array($departamentos,json_encode($organizaciones),$lineasproductivas,$lp_name,$deptos_lp,$org_lp);

		return View::make('access_outside/bid/bid_linea_productiva', array('array' =>$array));
		
	}
	//-------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------
	//Esta seccion indluye los controladores de la seccion de carga de informacion
	//-------------------------------------------------------------------------------------
	//Controladores para cargar la vista de carga de informacion
	public function carganoticiaspublic_ini(){
		$informacion=DB::table('MODBID_INFORMACIONPUBLIC')						
						->select(DB::RAW('id,titulo,texto,foto,tipo,created_at,updated_at,id_usuario,fecha_noticia'))
						->where('borrado','=',0)
						->orderby('fecha_noticia')
						->get();

		return View::make('modulobid/vista1',array('informacion'=>$informacion));
	}
	//Controlador para cargar los datos de la informacion
	public function postCargarInformacion(){
		$fecha = date("Y-d-m H:i:s");
		$registro = DB::SELECT("SELECT  ident_current('MODBID_INFORMACIONPUBLIC') AS [LastID_1]");		
		$id_foto = (($registro[0]->LastID_1)+1).".jpg";
				
		DB::table('MODBID_INFORMACIONPUBLIC')->insert(
		    	array(
		    		'id_usuario' => Auth::user()->id,		    		
		    		'titulo' => Input::get('titulo'),
		    		'foto' => $id_foto,
		    		'tipo' => Input::get('tipo'),
		    		'texto' => Input::get('texto'),			    		
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha,
	    			'fecha_noticia' => Input::get('fecha_info')

		    	)
		);

		$path_foto = public_path().'/assets/bid/informacion/'.(($registro[0]->LastID_1)+1)."/";
		Input::file('foto')->move($path_foto,$id_foto);
		return Redirect::to('vista1_bid')->with('status', 'ok_estatus');
	}
	
	//Cargar seccion 
	public function postCargarSeccion(){
		$id_info = Input::get('id_cargar_seccion');	
		$fecha = date("Y-d-m H:i:s");
		$registro = DB::SELECT("SELECT  ident_current('MODBID_INFORMACIONSECCION') AS [LastID_1]");
		$foto=Input::get('foto_seccion');
		
		if (empty(Input::file('foto_seccion'))){
			$id_foto=NULL;
			//return $id_foto;
		} else {
			$id_foto = $id_info.'_'.(($registro[0]->LastID_1)+1).".jpg";
			$path_foto = public_path().'/assets/bid/informacion/'.$id_info."/";
			Input::file('foto_seccion')->move($path_foto,$id_foto);			
		}	
		
		DB::table('MODBID_INFORMACIONSECCION')->insert(
		    	array(		    		
		    		'id_info' => $id_info,
		    		'id_usuario' => Auth::user()->id,		    		
		    		'titulo' => Input::get('titulo_seccion'),
		    		'texto' => Input::get('texto_seccion'),			    		
		    		'created_at' => $fecha,
	    			'updated_at' => $fecha,
	    			'foto' => $id_foto,
	    			'fecha_noticia'=>$fecha
		    	)
		);
		return Redirect::to('vista1_bid')->with('status', 'ok_estatus_seccion');
	}

	//listado de secciones por noticia
	public function postListaSecciones(){
		$id=Input::get('id');
		$lista=DB::table('MODBID_INFORMACIONSECCION')						
						->select(DB::RAW('id,id_info,titulo,texto'))
						->where('borrado','=',0)
						->where('id_info','=',$id)
						->orderby('fecha_noticia')
						->get();
		return $lista;
	}

	//controlador para borrar una seccion
	public function postBorrarSeccion(){
		$id=Input::get('id_borrar_seccion');
		$insert=DB::table('MODBID_INFORMACIONSECCION')->where('id',$id)->update(
			    	array(		    				    		
			    		'borrado' =>  1,		    				    				    		
			    	)
				);
		return Redirect::to('vista1_bid')->with('status', 'ok_estatus_delete_seccion');
	}

	//Controlador para borrar informacion
	public function postBorrarInformacion(){
		$id=Input::get('id_borrar_informacion');

		$insert=DB::table('MODBID_INFORMACIONSECCION')->where('id_info',$id)->update(
			    	array(		    				    		
			    		'borrado' =>  1,		    				    				    		
			    	)
				);

		$insert2=DB::table('MODBID_INFORMACIONPUBLIC')->where('id',$id)->update(
			    	array(		    				    		
			    		'borrado' =>  1,		    				    				    		
			    	)
				);

		return Redirect::to('vista1_bid')->with('status', 'ok_estatus_delete_informacion');
	}

	//-------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------
	//Esta seccion indluye los controladores de la seccion de visualizacón de informacion
	//-------------------------------------------------------------------------------------

	public function public_informacion(){
		$departamentos = DB::table('DEPARTAMENTOS')
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
							->join('MODBID_BIDPUBLIC','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->groupby('COD_DPTO','NOM_DPTO')	
							->get();

		$organizaciones = DB::table('MODBID_BIDPUBLIC')		
							->join('MODBID_ORGANIZACION','MODBID_ORGANIZACION.nit','=','MODBID_BIDPUBLIC.nit')
							->select(DB::RAW('MODBID_BIDPUBLIC.nit,MODBID_ORGANIZACION.acronim,MODBID_ORGANIZACION.cod_depto'))
							->orderby('acronim')
							->get();

		$lineasproductivas = DB::table('MODBID_LINEAPRODORG')		
							->join('MODBID_LINEAPRODEXP','MODBID_LINEAPRODEXP.id_lipex','=','MODBID_LINEAPRODORG.id_lipex')
							->select(DB::RAW('MODBID_LINEAPRODORG.id_lipex, MODBID_LINEAPRODEXP.nombre'))
							->where('MODBID_LINEAPRODORG.id_lipex','!=','NULL')
							->groupby('MODBID_LINEAPRODORG.id_lipex','MODBID_LINEAPRODEXP.nombre')
							->get();

		$informacion = DB::table('MODBID_INFORMACIONPUBLIC')
							->select(DB::RAW('TOP 8 id,titulo,texto,foto,tipo,created_at,updated_at,id_usuario,fecha_noticia,borrado'))
							->where('id','=',Input::get('id1'))
							->get();

		$array = array($departamentos,json_encode($organizaciones), $lineasproductivas, $informacion);

		return View::make('access_outside/bid/bid_informacion', array('array' =>$array));
	}
}
?>