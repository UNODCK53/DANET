<?php

class ArtpicController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function piccreaproyectos()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		
			//retornamos las categorias apenas entramos a la vista de cargue documentos
			$DEPARTAMENTOS = DB::table('DEPARTAMENTOS')
			->select('COD_DPTO','NOM_DPTO')
			->orderby('NOM_DPTO','asc')
			->get();
			$arraydepto['']='Seleccione uno';
			foreach($DEPARTAMENTOS as $pro)
			{
				$arraydepto[$pro->COD_DPTO] = $pro->NOM_DPTO;
			}

			$TIPOTERR = DB::table('MODART_PIC_TIPOTERR')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			foreach($TIPOTERR as $pro)
			{
				$arraytipoterr[$pro->id] = $pro->nombre;
			}

            $CATEGORIA = DB::table('MODART_PIC_CATEGORIA')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$result_cate = array();
			foreach($CATEGORIA as $pro)
			{
				 $result_cate[$pro->id][] = $pro->nombre;
			}

			$SUBCATEGORIA = DB::table('MODART_PIC_SUBCATEGORIA')
			->select('id','id_categ','nombre')
			->orderby('nombre','asc')
			->get();

			$MUNICIPIOS = DB::table('MUNICIPIOS')
			->select('COD_DPTO','COD_DANE','NOM_MPIO_1')
			->orderby('NOM_MPIO_1','asc')
			->get();
			$arraymuni['']='Seleccione uno';
			foreach($MUNICIPIOS as $pro)
			{
				$arraymuni[$pro->COD_DANE] = $pro->NOM_MPIO_1;
			}

			$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->orderby('nombre','asc')
			->get();
			$arraynucleos['']='Seleccione uno';
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}				

			$FOCALIZACION = DB::table('MODART_PIC_FOCALIZACION')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			foreach($FOCALIZACION as $pro)
			{
				$arrayfocali[$pro->id] = $pro->nombre;
			}

			$ESTADOPROY = DB::table('MODART_PIC_ESTADOPROY')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$arrayestado['']='Seleccione uno';
			foreach($ESTADOPROY as $pro)
			{
				$arrayestado[$pro->id] = $pro->nombre;
			}



			$subsubcate = DB::table('MODART_PIC_SUBSUBCATEGORIA')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$arraysubsubcate['']='Seleccione uno';
			foreach($subsubcate as $pro)
			{
				$arraysubsubcate[$pro->id] = $pro->nombre;
			}

			$socio = DB::table('MODART_PIC_SOCIOS')
			->select('id','nombre')
			->orderby('nombre','asc')
			->where('id','!=',1)
			->get();
			foreach($socio as $pro)
			{
				$arraysocio[$pro->id] = $pro->nombre;
			}


			$arrayindipic = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select(DB::raw("concat('PIC_',cod_nucleo,id_proy) as ID, id_proy,cod_depto,cod_mpio,id_usuario,cod_nucleo,id_subcat,nom_proy,alcance,estado_proy,prec_estim,cofinanc,fecha_ingreso"))
			->where('id_usuario','=',Auth::user()->id)
			->orderby('id_proy','desc')
			->get();	


			

		return View::make('moduloart.ivsocifichapriorizadaproy', array('arraydepto' => $arraydepto,'arraytipoterr' => $arraytipoterr,'arraynucleos' => $arraynucleos,'arraycate' => $result_cate,'arraymuni' => $arraymuni,'arraysubcate' => $SUBCATEGORIA,'arrayfocali'=>$arrayfocali,'arrayestado' => $arrayestado,'arrayindipic' => $arrayindipic,'arraysubsubcate' => $arraysubsubcate,'arraysocio'=>$arraysocio));		
	}	

	public function postRanking()//funcion que precarga los datos de los indicadores  veredales y las categorias
		{    
			$ranking = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select('ranking')
			->where('cod_nucleo','=',Input::get('nucleo'))
			->get();

			for ($i = 0; $i <20; $i++) {
			    $arrayranking[$i] = $i+1;
			}

		if (empty($ranking)) {
			
		}else{
			foreach($ranking as $pro)
			{
				$arrayranking2[$pro->ranking] = $pro->ranking;
			}
			$array =  (array) $arrayranking2;
			$arrayranking=array_diff($arrayranking,$array);

		}
	return  $arrayranking;
			
	}

	public function postCrearProyecto()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
			$fecha = date("d-m-Y H:i:s");
			$insert=DB::table('MODART_PIC_PROYPRIORIZ')->insert(
		    	array(
		    		'nom_proy' => Input::get('nomproy'),
		    		'alcance' => Input::get('alcance'),	  
		    		'cod_depto' => Input::get('depto'),
		    		'cod_mpio' => Input::get('mpios'),
		    		'cod_nucleo' => Input::get('nucleo'),
		    		'id_subcat' => Input::get('nom_supcate'),
		    		'prec_estim' => preg_replace("/[. $]/","",Input::get('precio')),
		    		'estado_proy' => Input::get('estado'),
		    		'cofinanc' => Input::get('cofinan'),
		    		'fecha_ingreso' => Input::get('fecha'),
		    		'id_usuario' => Auth::user()->id,
		    		'ranking'=>Input::get('ranking'),
		    		'created_at' => $fecha,
		    		'updated_at' => $fecha
		    	)
		    );

		    	$idmaximo =  DB::table('MODART_PIC_PROYPRIORIZ')->max('id_proy');
		    	foreach (Input::get('tipoterr') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => $idmaximo,
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}


		    	for ($i = 0; $i < count(Input::get('nom_terr')); $i++) {
				    $insert2=DB::table('MODART_PIC_PROYECTOTERRI')->insert(
				    	array(
				    		'id_proy' => $idmaximo,
				    		'id_terr' => Input::get('nom_terr')[$i],
				    		'tipo_terr'=> Input::get('tipoterr')[$i]

				    		)
				    	);
				}
		    	

		    	foreach (Input::get('subsubcate') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_SUBSUBCATPASO')->insert(
				    	array(
				    		'id_proy'=>$idmaximo,
				    		'id_subcat' => Input::get('nom_supcate'),
				    		'id_subsub' => $value
				    		)
				    	);
		    	}
		    	if ( Input::get('radiocofin')==1 ){		    	
			    	foreach (Input::get('socio') as $key => $value) {
			    		if ($value==25){
			    			$insert2=DB::table('MODART_PIC_SOCIOSPASO')->insert(
					    	array(
					    		'id_proy'=>$idmaximo,
					    		'id_socio' => $value,
					    		'valor' => preg_replace("/[. $]/","",Input::get('s-'.$value)),
					    		'otro'=> Input::get('otro')
					    		)
					    	);
			    		}else{
			    			$insert2=DB::table('MODART_PIC_SOCIOSPASO')->insert(
					    	array(
					    		'id_proy'=>$idmaximo,
					    		'id_socio' => $value,
					    		'valor' => preg_replace("/[. $]/","",Input::get('s-'.$value)),
					    		'otro'=> null
					    		)
					    	);
			    		}
			    	}
		    	}
		    	
	
		$path = public_path().'\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').$idmaximo;
		$path_insert='\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').$idmaximo;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){
						
		}
		else{
			File::makeDirectory($path,  0777, true);	

		}

	
		if(Input::hasFile('acta')) {

				Input::file('acta')->move($path,'PIC_'.Input::get('nucleo').$idmaximo.'.'.Input::file('acta')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', $idmaximo)->update(
	    			array(
	    				'acta' => $path_insert.'\\'.'PIC_'.Input::get('nucleo').$idmaximo.'.'.Input::file('acta')->getClientOriginalExtension()
	    				)
	    			);
	    }		
       	if($insert>0){
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'error_estatus'); 
		}
	}

	public function postMpios()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{

			$MUNICIPIOS = DB::table('MUNICIPIOS')
			->select('COD_DPTO','COD_DANE','NOM_MPIO_1')
			->where('COD_DPTO','=',Input::get('depto'))
			->orderby('NOM_MPIO_1','asc')
			->get();

			foreach($MUNICIPIOS as $pro)
			{
				$arraympios[$pro->NOM_MPIO_1] = $pro->COD_DANE;
			}
			return Response::json(array('arraympios'=>$arraympios));
		
	}

	public function postNucleo()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{

			$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->where(DB::raw('SUBSTRING(id_nucleo, 0, 6)'),'=',Input::get('mpio'))
			->orderby('nombre','asc')
			->get();
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->nombre] = $pro->id_nucleo;
			}	


			
			return array('arraynucleos'=>$arraynucleos);
		
	}

	
	public function postAdmiTerr()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
		 $arratodoterr=array();
		 $arratodoterrtipo=array();

		for ($i=0; $i < count(Input::get('tipoterr')) ; $i++) { 
			if (Input::get('tipoterr')[$i]==3){
				$veredas = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();
				foreach($veredas as $pro)
				{
					  $arravds[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterr, $arravds);
				array_push($arratodoterrtipo, "Veredas:");
		
			}else if (Input::get('tipoterr')[$i]==2){
				$concejo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();
				foreach($concejo as $pro)
				{
					 $arraccj[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterr, $arraccj);
				array_push($arratodoterrtipo, "Consejos cumunitarios:");
			}else{
				$Resguardo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();
				foreach($Resguardo as $pro)
				{
					  $arrares[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterr, $arrares);
				array_push($arratodoterrtipo, "Resguardos indígenas:");
			}

			

		}
		
		array_multisort($arratodoterr,SORT_ASC);
		return array('arraynom_terri'=>$arratodoterr,'arratodoterrtipo'=>$arratodoterrtipo);
		
	}

	public function postTablaproy()//funcion que precarga los datos de indicadores para su edicion
	{    
		$arrayproy = DB::table('MODART_PIC_PROYPRIORIZ')
		->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_PIC_PROYPRIORIZ.cod_mpio')
		->join('MODART_PIC_NUCLEOS','MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_PROYPRIORIZ.cod_nucleo')	
		->select(DB::raw("concat('PIC_',MODART_PIC_PROYPRIORIZ.cod_nucleo,id_proy) as ID"),'id_proy',DB::raw("MUNICIPIOS.NOM_DPTO as cod_depto"),DB::raw("MUNICIPIOS.NOM_MPIO_1 as cod_mpio"),DB::raw("MODART_PIC_NUCLEOS.nombre as cod_nucleo"),'id_subcat','id_usuario','nom_proy','alcance','estado_proy','prec_estim','cofinanc',DB::raw("CONVERT(VARCHAR(10),fecha_ingreso,103) as fecha_ingreso,ranking"),'MUNICIPIOS.COD_DPTO as depto','MUNICIPIOS.COD_DANE as muni','MODART_PIC_NUCLEOS.id_nucleo as nucleo','acta')
		->where('MODART_PIC_PROYPRIORIZ.id_proy','=', Input::get('proy'))
		->where('id_usuario','=',Auth::user()->id)
		->get();

		foreach($arrayproy as $pro)
			{
				 $nucl = $pro->nucleo;
			}

		$tipoter = DB::table('MODART_PIC_TIPOTERRPASO')
			->select('id_proy','id_tipterr')
			->where('id_proy','=', Input::get('proy'))
			->get();
			
			foreach($tipoter as $pro)
			{
				 $arraytipoter[$pro->id_tipterr] = $pro->id_tipterr;
			}	
			$terr=array_map(create_function('$item','return $item->id_tipterr;'),$tipoter);//extract value from object query	

		$nomter = DB::table('MODART_PIC_PROYECTOTERRI')
			->select('id_proy','id_terr','tipo_terr')
			->where('id_proy','=', Input::get('proy'))
			->get();
			
			foreach($nomter as $pro)
			{
				 $arraynomter[$pro->id_terr] = $pro->tipo_terr;
			}

			if (empty($arraynomter)) {
			   $arraynomter="";
			}


		$arratodoterredi=array();
		$arratodoterrtipoedi=array();

		for ($i=0; $i < count($terr) ; $i++) { 
			if ($terr[$i]==3){
				$veredas = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',$nucl)
				->orderby('nom_terr','asc')
				->get();
				foreach($veredas as $pro)
				{
					  $arravds[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterredi, $arravds);
				array_push($arratodoterrtipoedi, "Veredas:");
		
			}else if ($terr[$i]==2){
				$concejo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',$nucl)
				->orderby('nom_terr','asc')
				->get();
				foreach($concejo as $pro)
				{
					 $arraccj[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterredi, $arraccj);
				array_push($arratodoterrtipoedi, "Consejos cumunitarios:");
			}else{
				$Resguardo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',$nucl)
				->orderby('nom_terr','asc')
				->get();
				foreach($Resguardo as $pro)
				{
					  $arrares[$pro->cod_vda] = $pro->nom_terr;
				}
				array_push($arratodoterredi, $arrares);
				array_push($arratodoterrtipoedi, "Resguardos indígenas:");
			}
		}
		
		array_multisort($arratodoterredi,SORT_ASC);

		$subsubcate = DB::table('MODART_PIC_SUBSUBCATPASO')
			->select('id_proy','id_subcat','id_subsub')
			->where('id_proy','=', Input::get('proy'))
			->get();

			foreach($subsubcate as $pro)
			{
				$arraysubsubcate[$pro->id_subsub] = $pro->id_subsub;
			}	

		$socio = DB::table('MODART_PIC_SOCIOSPASO')
			->select('id_proy','id_socio','valor','otro')
			->where('id_proy','=', Input::get('proy'))
			->get();

			
			if(empty($socio)){
				$arraysocio["0"]=0;
				$arraysociootro="";
				
			} else {
				foreach($socio as $pro)
				{
					$arraysocio[$pro->id_socio] = $pro->valor;
					$arraysociootro= $pro->otro;
				}
			}	

		$ranking = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select('ranking')
			->where('cod_nucleo','=',$nucl)
			->get();

			for ($i = 0; $i <20; $i++) {
			    $arrayranking[$i] = $i+1;
			}

		if (empty($ranking)) {
			
		}else{
			foreach($ranking as $pro)
			{
				$arrayranking2[$pro->ranking] = $pro->ranking;
			}
			$array =  (array) $arrayranking2;
			$arrayranking=array_diff($arrayranking,$array);

		}		


		return  array('arrayproy' => $arrayproy,'arraytipoterr'=>$arraytipoter,'arraysubsubcate'=>$arraysubsubcate,'arraysocio'=>$arraysocio,'arraysociootro'=>$arraysociootro,'arraynomter'=>$arraynomter,'arratodoterredi'=>$arratodoterredi,'arratodoterrtipoedi'=>$arratodoterrtipoedi,'arrayrankingedi'=>$arrayranking);	

	}


	public function postEditarProyecto()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
			$fecha = date("d-m-Y H:i:s");
			$edit=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', Input::get('ediidproy'))->update(
		    	array(
		    		'nom_proy' => Input::get('edinomproy'),
		    		'alcance' => Input::get('edialcance'),	  
		    		'cod_depto' => Input::get('edidepto2'),
		    		'cod_mpio' => Input::get('edimpios2'),
		    		'cod_nucleo' => Input::get('edinucleo2'),
		    		'id_subcat' => Input::get('edinom_supcate'),
		    		'prec_estim' => preg_replace("/[. $]/","",Input::get('ediprecio')),
		    		'estado_proy' => Input::get('ediestado'),
		    		'cofinanc' => Input::get('edicofinan'),
		    		'fecha_ingreso' => Input::get('edifecha'),
		    		'ranking'=>Input::get('edicheckranking'),
		    		//'created_at' => $fecha,
		    		'updated_at' => $fecha
		    	)
			);

		// creacion de carpeta dependiendo del nombre del proceso

			if(Input::get('ediacta')==1){
				$path = public_path().'\art\pic\\'.Input::get('edinucleo2').'\\'.Input::get('edinucleo2').Input::get('ediidproy');
					$path_insert='\art\pic\\'.Input::get('edinucleo2').'\\'.Input::get('edinucleo2').Input::get('ediidproy');
					// creacion de carpeta dependiendo del nombre del proceso
					if (File::exists($path)){
									
					}
					else{
						File::makeDirectory($path,  $mode = 0777, $recursive = true);	
					}

				
					if(Input::hasFile('actaedi')) {

							Input::file('actaedi')->move($path,'PIC_'.Input::get('edinucleo2').Input::get('ediidproy').'.'.Input::file('actaedi')->getClientOriginalExtension());

				    		DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', Input::get('ediidproy'))->update(
				    			array(
				    				'acta' => $path_insert.'\\'.'PIC_'.Input::get('edinucleo2').Input::get('ediidproy').'.'.Input::file('actaedi')->getClientOriginalExtension()
				    				)
				    			);
				    }		
			       
				}


				DB::table('MODART_PIC_TIPOTERRPASO')->where('id_proy',Input::get('ediidproy'))->delete();
		
		    	foreach (Input::get('editipoterr') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => Input::get('ediidproy'),
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}

		    	DB::table('MODART_PIC_PROYECTOTERRI')->where('id_proy',Input::get('ediidproy'))->delete();

		    	for ($i = 0; $i < count(Input::get('nom_terredi')); $i++) {
				    $insert2=DB::table('MODART_PIC_PROYECTOTERRI')->insert(
				    	array(
				    		'id_proy' => Input::get('ediidproy'),
				    		'id_terr' => Input::get('nom_terredi')[$i],
				    		'tipo_terr'=> Input::get('editipoterr')[$i]

				    		)
				    	);
				}

		    	DB::table('MODART_PIC_SUBSUBCATPASO')->where('id_proy',Input::get('ediidproy'))->delete();
		
		    	foreach (Input::get('edisubsubcate') as $key => $value) {
		    		$insert3=DB::table('MODART_PIC_SUBSUBCATPASO')->insert(
				    	array(
				    		'id_proy'=>Input::get('ediidproy'),
				    		'id_subcat' => Input::get('edinom_supcate'),
				    		'id_subsub' => $value
				    		)
				    	);
		    	}

		    	DB::table('MODART_PIC_SOCIOSPASO')->where('id_proy',Input::get('ediidproy'))->delete();
		    	if ( Input::get('ediradiocofin')==1 ){		    	
			    	foreach (Input::get('edisocio') as $key => $value) {
			    		$insert2=DB::table('MODART_PIC_SOCIOSPASO')->insert(
					    	array(
					    		'id_proy'=>Input::get('ediidproy'),
					    		'id_socio' => $value,
					    		'valor' => preg_replace("/[. $]/","",Input::get('edis-'.$value)),
					    		'otro'=> Input::get('ediotro')
					    		)
					    	);
			    	}
		    	}

       	if($edit>0){
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'error_estatus_editar'); 
		}
	}



	public function postDeleteProyecto(){
		$borrar=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy',Input::get('deleteproy'))->delete();
		
		if($borrar>0){
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'error_estatus_borrar'); 
		}
	}

	public function Excelpic_uno()
	{	
		


		Excel::create('PIC',function($excel)
		{
			$excel->sheet('Fichas de iniciativas',function($sheet)
			{
				$data = array();
				$results = DB::select(
					"select 
	tabla3.id_proy as auto,ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal,terr.[Resguardo Indígena] as Resguardo_Indigena ,terr.[Concejo Comunitario] as Consejo_Comunitario,terr.Vereda
from 
	(select
		intervencion,cate.nombre as cate,tabla1.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal,Estado_validacion,Observaciones
	from 
		(select 
			subcate.nombre as intervencion,proy.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal,Estado_validacion,Observaciones
		from 
			(select 
				MODART_PIC_PROYPRIORIZ.id_proy ,concat('PIC_',MODART_PIC_PROYPRIORIZ.cod_nucleo,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta,case when id_viabi=1 then 'En estudio' else case when id_viabi=2 then 'Válido' else 'No válido' end end as Estado_validacion,obs as Observaciones
			from 
				MODART_PIC_PROYPRIORIZ inner join MUNICIPIOS on MUNICIPIOS.COD_DANE = MODART_PIC_PROYPRIORIZ.cod_mpio inner join users on users.id = MODART_PIC_PROYPRIORIZ.id_usuario inner join MODART_PIC_SUBCATEGORIA on MODART_PIC_SUBCATEGORIA.id = MODART_PIC_PROYPRIORIZ.id_subcat inner join MODART_PIC_NUCLEOS on MODART_PIC_NUCLEOS.id_nucleo = MODART_PIC_PROYPRIORIZ.cod_nucleo inner join MODART_PIC_ESTADOPROY on MODART_PIC_ESTADOPROY.id = MODART_PIC_PROYPRIORIZ.estado_proy where MODART_PIC_PROYPRIORIZ.id_usuario=".Auth::user()->id.") as proy 
		left join 
		(select 
			MODART_PIC_SUBSUBCATEGORIA.nombre, MODART_PIC_SUBSUBCATPASO.id_proy 
		from 
			MODART_PIC_SUBSUBCATPASO inner join MODART_PIC_SUBSUBCATEGORIA on MODART_PIC_SUBSUBCATEGORIA.id = MODART_PIC_SUBSUBCATPASO.id_subsub)as subcate 
		on proy.id_proy=subcate.id_proy) as tabla1 
		left join 
		(select 
			MODART_PIC_PROYPRIORIZ.id_proy,MODART_PIC_CATEGORIA.nombre 
		from 
			MODART_PIC_SUBCATEGORIA inner join MODART_PIC_PROYPRIORIZ on MODART_PIC_PROYPRIORIZ.id_subcat = MODART_PIC_SUBCATEGORIA.id inner join MODART_PIC_CATEGORIA on MODART_PIC_CATEGORIA.id = MODART_PIC_SUBCATEGORIA.id_categ) as cate
		on tabla1.id_proy=cate.id_proy) as tabla3 
		left join 
		(select 
			id_proy,[Resguardo Indígena],[Concejo Comunitario],[Vereda] 
		from  
			(select MODART_PIC_TIPOTERRPASO.id_proy, MODART_PIC_TIPOTERR.id,MODART_PIC_TIPOTERR.nombre from MODART_PIC_TIPOTERRPASO inner join MODART_PIC_TIPOTERR on MODART_PIC_TIPOTERR.id = MODART_PIC_TIPOTERRPASO.id_tipterr)as tabla1
		pivot (count(id)  FOR nombre in ([Resguardo Indígena],[Concejo Comunitario],[Vereda]))as d) as terr 
		on tabla3.id_proy=terr.id_proy order by auto desc");


				foreach ($results as $result) {
					$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:R1', function($cells) {
		    	$cells->setBackground('#dadae3');
				});

			
			})->download('xlsx');
		});
    }
    
    public function consultapic()
	{	
		//retornamos las categorias apenas entramos a la vista de cargue documentos
			$DEPARTAMENTOS = DB::table('DEPARTAMENTOS')
			->select('COD_DPTO','NOM_DPTO')
			->orderby('NOM_DPTO','asc')
			->get();
			$arraydepto['']='Seleccione uno';
			foreach($DEPARTAMENTOS as $pro)
			{
				$arraydepto[$pro->COD_DPTO] = $pro->NOM_DPTO;
			}

			
			$MUNICIPIOS = DB::table('MUNICIPIOS')
			->select('COD_DPTO','COD_DANE','NOM_MPIO_1')
			->orderby('NOM_MPIO_1','asc')
			->get();
			$arraymuni['']='Seleccione uno';
			foreach($MUNICIPIOS as $pro)
			{
				$arraymuni[$pro->COD_DANE] = $pro->NOM_MPIO_1;
			}

			$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->orderby('nombre','asc')
			->get();
			$arraynucleos['']='Seleccione uno';
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}				



			$arrayindipic = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select(DB::raw("concat('PIC_',cod_nucleo,id_proy) as ID, id_proy,cod_depto,cod_mpio,cod_nucleo,nom_proy,ranking,id_viabi"))
			->orderby('id_proy','desc')
			->get();	


			

		return View::make('moduloart.ivsociconsultapic', array('arraydepto' => $arraydepto,'arraynucleos' => $arraynucleos,'arraymuni' => $arraymuni,'arrayindipic' => $arrayindipic));		
    }


    public function postSelectConsultaPic()
	{	
			$arrayproy = DB::table('MODART_PIC_PROYPRIORIZ')
				->join('MUNICIPIOS' , 'MUNICIPIOS.COD_DANE','=','MODART_PIC_PROYPRIORIZ.cod_mpio')
				->join('users' , 'users.id','=','MODART_PIC_PROYPRIORIZ.id_usuario')
				->join('MODART_PIC_SUBCATEGORIA' , 'MODART_PIC_SUBCATEGORIA.id','=','MODART_PIC_PROYPRIORIZ.id_subcat')
				->join('MODART_PIC_NUCLEOS' , 'MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_PROYPRIORIZ.cod_nucleo')
				->join('MODART_PIC_ESTADOPROY' , 'MODART_PIC_ESTADOPROY.id','=','MODART_PIC_PROYPRIORIZ.estado_proy')
				->select(DB::raw("concat('PIC_',MODART_PIC_PROYPRIORIZ.cod_nucleo,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta,id_viabi,obs"))
				->where('MODART_PIC_PROYPRIORIZ.id_proy','=', Input::get('proy'))
				->get();

	
			$arraysubsubcate = DB::table('MODART_PIC_SUBSUBCATPASO')
				->join('MODART_PIC_SUBSUBCATEGORIA' , 'MODART_PIC_SUBSUBCATEGORIA.id','=','MODART_PIC_SUBSUBCATPASO.id_subsub')
				->select('MODART_PIC_SUBSUBCATEGORIA.nombre')
				->where('MODART_PIC_SUBSUBCATPASO.id_proy','=',Input::get('proy'))
				->get();

			$tipoterr = DB::table('MODART_PIC_TIPOTERRPASO')
				->join('MODART_PIC_TIPOTERR' , 'MODART_PIC_TIPOTERR.id','=','MODART_PIC_TIPOTERRPASO.id_tipterr')
				->select('MODART_PIC_TIPOTERR.nombre')
				->where('MODART_PIC_TIPOTERRPASO.id_proy','=',Input::get('proy'))
				->get();

				$arraytipoterr=array_map(create_function('$item','return $item->nombre;'),$tipoterr);
				$arraytipoter = implode(",", $arraytipoterr);

			$cate = DB::table('MODART_PIC_SUBCATEGORIA')
				->join('MODART_PIC_PROYPRIORIZ' , 'MODART_PIC_PROYPRIORIZ.id_subcat','=','MODART_PIC_SUBCATEGORIA.id')
				->join('MODART_PIC_CATEGORIA' , 'MODART_PIC_CATEGORIA.id','=','MODART_PIC_SUBCATEGORIA.id_categ')
				->select('MODART_PIC_CATEGORIA.nombre')
				->where('MODART_PIC_PROYPRIORIZ.id_proy','=',Input::get('proy'))
				->get();

			$url = DB::table('MODART_PIC_CRITERIOSTODOS')
			->join('MODART_PIC_VIABILIZACION','MODART_PIC_VIABILIZACION.id','=','MODART_PIC_CRITERIOSTODOS.id_crittod')
			->select('id_crite','url')
		    ->where('id_proy','=',Input::get('proy'))
		    ->orderby('id_crite','asc')
		    ->get();

		    $nom_crite = DB::table('MODART_PIC_VIABILIZACION')
		      ->join('MODART_PIC_CRITERIOS','MODART_PIC_CRITERIOS.id','=','MODART_PIC_VIABILIZACION.id_crite')
		      ->select('id_crite','nombre')
		      ->orderby('id_crite','asc')
		      ->get();



			


		return  array('arrayprio' => $arrayproy,'arraysubsubcate'=>$arraysubsubcate,'arraytipoterr'=>$arraytipoter,'cate'=>$cate,'url'=>$url,'nom_crite'=>$nom_crite);		
    }


    public function Excelpic()
	{	
		


		Excel::create('PIC',function($excel)
		{
			$excel->sheet('Fichas de iniciativas',function($sheet)
			{
				$data = array();
				$results = DB::select(
					"select TOP 2000
	tabla3.id_proy as auto,ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal,terr.[Resguardo Indígena] as Resguardo_Indigena ,terr.[Concejo Comunitario] as Consejo_Comunitario,terr.Vereda
from 
	(select
		intervencion,cate.nombre as cate,tabla1.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal,Estado_validacion,Observaciones
	from 
		(select 
			subcate.nombre as intervencion,proy.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal,Estado_validacion,Observaciones
		from 
			(select 
				MODART_PIC_PROYPRIORIZ.id_proy ,concat('PIC_',MODART_PIC_PROYPRIORIZ.cod_nucleo,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta,case when id_viabi=1 then 'En estudio' else case when id_viabi=2 then 'Válido' else 'No válido' end end as Estado_validacion,obs as Observaciones
			from 
				MODART_PIC_PROYPRIORIZ inner join MUNICIPIOS on MUNICIPIOS.COD_DANE = MODART_PIC_PROYPRIORIZ.cod_mpio inner join users on users.id = MODART_PIC_PROYPRIORIZ.id_usuario inner join MODART_PIC_SUBCATEGORIA on MODART_PIC_SUBCATEGORIA.id = MODART_PIC_PROYPRIORIZ.id_subcat inner join MODART_PIC_NUCLEOS on MODART_PIC_NUCLEOS.id_nucleo = MODART_PIC_PROYPRIORIZ.cod_nucleo inner join MODART_PIC_ESTADOPROY on MODART_PIC_ESTADOPROY.id = MODART_PIC_PROYPRIORIZ.estado_proy) as proy 
		left join 
		(select 
			MODART_PIC_SUBSUBCATEGORIA.nombre, MODART_PIC_SUBSUBCATPASO.id_proy 
		from 
			MODART_PIC_SUBSUBCATPASO inner join MODART_PIC_SUBSUBCATEGORIA on MODART_PIC_SUBSUBCATEGORIA.id = MODART_PIC_SUBSUBCATPASO.id_subsub)as subcate 
		on proy.id_proy=subcate.id_proy) as tabla1 
		left join 
		(select 
			MODART_PIC_PROYPRIORIZ.id_proy,MODART_PIC_CATEGORIA.nombre 
		from 
			MODART_PIC_SUBCATEGORIA inner join MODART_PIC_PROYPRIORIZ on MODART_PIC_PROYPRIORIZ.id_subcat = MODART_PIC_SUBCATEGORIA.id inner join MODART_PIC_CATEGORIA on MODART_PIC_CATEGORIA.id = MODART_PIC_SUBCATEGORIA.id_categ) as cate
		on tabla1.id_proy=cate.id_proy) as tabla3 
		left join 
		(select 
			id_proy,[Resguardo Indígena],[Concejo Comunitario],[Vereda] 
		from  
			(select MODART_PIC_TIPOTERRPASO.id_proy, MODART_PIC_TIPOTERR.id,MODART_PIC_TIPOTERR.nombre from MODART_PIC_TIPOTERRPASO inner join MODART_PIC_TIPOTERR on MODART_PIC_TIPOTERR.id = MODART_PIC_TIPOTERRPASO.id_tipterr)as tabla1
		pivot (count(id)  FOR nombre in ([Resguardo Indígena],[Concejo Comunitario],[Vereda]))as d) as terr 
		on tabla3.id_proy=terr.id_proy order by auto desc ");


				foreach ($results as $result) {
					$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:R1', function($cells) {
		    	$cells->setBackground('#dadae3');
				});

			
			})->download('xlsx');
		});
    }

public function seguimiento()
	{	
		//retornamos las categorias apenas entramos a la vista de cargue documentos
			$DEPARTAMENTOS = DB::table('DEPARTAMENTOS')
			->select('COD_DPTO','NOM_DPTO')
			->orderby('NOM_DPTO','asc')
			->get();
			$arraydepto['']='Seleccione uno';
			foreach($DEPARTAMENTOS as $pro)
			{
				$arraydepto[$pro->COD_DPTO] = $pro->NOM_DPTO;
			}

			
			$MUNICIPIOS = DB::table('MUNICIPIOS')
			->select('COD_DPTO','COD_DANE','NOM_MPIO_1')
			->orderby('NOM_MPIO_1','asc')
			->get();
			$arraymuni['']='Seleccione uno';
			foreach($MUNICIPIOS as $pro)
			{
				$arraymuni[$pro->COD_DANE] = $pro->NOM_MPIO_1;
			}

			$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->orderby('nombre','asc')
			->get();
			$arraynucleos['']='Seleccione uno';
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}				



			$arrayindipic = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select(DB::raw("concat('PIC_',cod_nucleo,id_proy) as ID, id_proy,cod_depto,cod_mpio,cod_nucleo,nom_proy,ranking,id_viabi"))
			->where('id_viabi','=',1)
			->where('id_usuario','=',Auth::user()->id)
			->orderby('id_proy','desc')

			->get();	

			$arrayindipic_recupe = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select(DB::raw("concat('PIC_',cod_nucleo,id_proy) as ID, id_proy,cod_depto,cod_mpio,cod_nucleo,nom_proy,ranking,id_viabi,obs"))
			->where('id_viabi','!=',1)
			->where('id_usuario','=',Auth::user()->id)
			->orderby('id_proy','desc')
			->get();	


			$change_viable = DB::table('MODART_PIC_CRITERIOSTODOS')
			->select(DB::raw('count(id_proy)as num'),'id_proy')
			->groupby('id_proy')
			->get();

			$change_viable_file= DB::table('MODART_PIC_CRITERIOSTODOS')
			->select(DB::raw('count(id_proy)as num'),'id_proy')
			->groupby('id_proy')
			->where('estado','!=','No tiene')
			->get();
			if($change_viable==0){
					$change_viabl=0; 
				} 
			if($change_viable_file==0){
					$change_viable_file=0; 
				} 	
		return View::make('moduloart.ivsociseguimientopic', array('arraydepto' => $arraydepto,'arraynucleos' => $arraynucleos,'arraymuni' => $arraymuni,'arrayindipic' => $arrayindipic,'arrayindipic_recupe'=>$arrayindipic_recupe,'change_viable'=>$change_viable,'change_viable_file'=>$change_viable_file));		
    }


    public function postCriterios()
	{	
		$sub_cate = DB::table('MODART_PIC_PROYPRIORIZ')
			->select('id_subcat')
			->where('id_proy','=',Input::get('proy'))
			->sum('id_subcat');

		$estado = DB::table('MODART_PIC_PROYPRIORIZ')
			->select('estado_proy')
			->where('id_proy','=',Input::get('proy'))
			->sum('estado_proy');

		$id_viabi = DB::table('MODART_PIC_VIABILIZACION')
			->join('MODART_PIC_CRITERIOS','MODART_PIC_CRITERIOS.id','=','MODART_PIC_VIABILIZACION.id_crite')
			->select('MODART_PIC_VIABILIZACION.id','MODART_PIC_CRITERIOS.nombre','id_crite','info')
			->where('id_subcat','=',$sub_cate)
			->orWhere('id_estad','=',$estado)
			->get();

			
		$array_viable=array_map(create_function('$item','return $item->nombre;'),$id_viabi);//extract value from object query	
		$array_viable_id=array_map(create_function('$item','return $item->id;'),$id_viabi);//extract value from object query	
		$array_viable_id2=array_map(create_function('$item','return $item->id_crite;'),$id_viabi);//extract value from object query	
		$array_viable_info=array_map(create_function('$item','return $item->info;'),$id_viabi);//extract value from object query	


		//valida si ya se crearon los criterios del proyetco o no, y los crea
		$crea = DB::table('MODART_PIC_CRITERIOSTODOS')
			->where('id_proy','=',Input::get('proy'))
			->count();

		if($crea==0){
			foreach($id_viabi as $pro)
			{
				DB::table('MODART_PIC_CRITERIOSTODOS')->insert(
			    	array(
			    		'id_proy' => Input::get('proy'),
			    		'id_crittod' => $pro->id
			    	)
		    	);
			}
			
		}

		$file = DB::table('MODART_PIC_CRITERIOSTODOS')
		->select('url','estado','obs')
		->where('id_proy','=',Input::get('proy'))
		->get();
		$array_viable_file=array_map(create_function('$item','return $item->url;'),$file);//extract value from object query	
		$array_viable_estado=array_map(create_function('$item','return $item->estado;'),$file);//extract value from object query	
		$array_viable_obs=array_map(create_function('$item','return $item->obs;'),$file);//extract value from object query	
		
			
		return  array('array_viable' => $array_viable,'array_viable_id'=>$array_viable_id,'array_viable_file'=>$array_viable_file,'array_viable_id2'=>$array_viable_id2,'array_viable_info'=>$array_viable_info,'array_viable_estado'=>$array_viable_estado,'array_viable_obs'=>$array_viable_obs);			
    }

    public function postCargarCriterio()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
		
		for ($i=0; $i < count(Input::get('doc')); $i++) { 
			if (Input::get('id_viable2')[$i]==1){
				if(Input::get('r-'.$i)==3){
					$insert=DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy', '=', Input::get('proy'))->where('id_crittod','=',Input::get('id_viable')[$i])->update(
		    			array(
		    				'url' => 'No aplica',
		    				'estado' => 'No aplica'
		    				)
		    			);
				}else{
					$path = public_path().'\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');
					$path_insert='\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');

					// creacion de carpeta dependiendo del nombre del proceso
					if (File::exists($path)){
									
					}
					else{
						File::makeDirectory($path,  $mode = 0777, $recursive = true);	
					}

					
					if(Input::hasFile('f-'.$i)) {
						
							Input::file('f-'.$i)->move($path,'PIC_'.Input::get('nucleo').Input::get('proy').'_Cri_'.Input::get('id_viable2')[$i].'.'.Input::file('f-'.$i)->getClientOriginalExtension());

				    		$insert=DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy', '=', Input::get('proy'))->where('id_crittod','=',Input::get('id_viable')[$i])->update(
				    			array(
				    				'estado' => 'Tiene',
				    				'url' => $path_insert.'\\'.'PIC_'.Input::get('nucleo').Input::get('proy').'_Cri_'.Input::get('id_viable2')[$i].'.'.Input::file('f-'.$i)->getClientOriginalExtension()
				    				
				    				)
				    			);
				    }
				}
			}else{
				if(Input::get('r-'.$i)==1){
					$path = public_path().'\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');
					$path_insert='\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');

					// creacion de carpeta dependiendo del nombre del proceso
					if (File::exists($path)){
									
					}
					else{
						File::makeDirectory($path,  $mode = 0777, $recursive = true);	
					}

					
					if(Input::hasFile('f-'.$i)) {
						
							Input::file('f-'.$i)->move($path,'PIC_'.Input::get('nucleo').Input::get('proy').'_Cri_'.Input::get('id_viable2')[$i].'.'.Input::file('f-'.$i)->getClientOriginalExtension());

				    		$insert=DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy', '=', Input::get('proy'))->where('id_crittod','=',Input::get('id_viable')[$i])->update(
				    			array(
				    				'url' => $path_insert.'\\'.'PIC_'.Input::get('nucleo').Input::get('proy').'_Cri_'.Input::get('id_viable2')[$i].'.'.Input::file('f-'.$i)->getClientOriginalExtension(),
				    				'estado' => 'Tiene'
				    				)
				    			);
				    }
				}else{
					DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy', '=', Input::get('proy'))->where('id_crittod','=',Input::get('id_viable')[$i])->update(
				    			array(
				    				'estado' => 'No tiene'
				    				)
				    			);
				}    
			}

     	}

     	try {
		    if($insert>0){
					return Redirect::to('ivsociseguimientopic')->with('status', 'ok_estatus'); 
				} else {
					return Redirect::to('ivsociseguimientopic')->with('status', 'error_estatus'); 
				}
				throw new Exception(' Upps !!');
		} catch (Exception $e){
		    return Redirect::to('ivsociseguimientopic');
		}
			
		
		
	}

	 public function postProyectoParaViavilizar()//funcion que que habilita la opcion viablizar
	{

		$change_viable = DB::table('MODART_PIC_CRITERIOSTODOS')
			->select('id')
			->where('id_proy','=',Input::get('proy'))
			->count();

		$change_viable_file= DB::table('MODART_PIC_CRITERIOSTODOS')
			->select('id')
			->where('id_proy','=',Input::get('proy'))
			->where('estado','!=','No tiene')
			->count();	

		$precio= DB::table('MODART_PIC_PROYPRIORIZ')
			->select('prec_estim')
			->where('id_proy','=',Input::get('proy'))
			->sum('prec_estim');	

		$precio= DB::table('MODART_PIC_PROYPRIORIZ')
			->select('prec_estim')
			->where('id_proy','=',Input::get('proy'))
			->sum('prec_estim');

		$precio_nucleo= DB::table('MODART_PIC_PROYPRIORIZ')
			->select(DB::raw('sum(prec_estim)as prec_estim,count(prec_estim) as cuenta'))
			->where('cod_nucleo','=',Input::get('nucleo'))
			->get();

		$precio_nucleo_viablilizados= DB::table('MODART_PIC_PROYPRIORIZ')
			->select(DB::raw('sum(prec_estim)as prec_estim,count(prec_estim) as cuenta'))
			->where('cod_nucleo','=',Input::get('nucleo'))
			->where('id_viabi','=',2)
			->get();	


		if ($change_viable==$change_viable_file) { 
			return  array('numero' => $change_viable,'precio'=>$precio,'precio_nucleo'=>$precio_nucleo,'precio_nucleo_viablilizados'=>$precio_nucleo_viablilizados);
		}else{
			return array('numero' => null,'precio'=>$precio,'precio_nucleo'=>$precio_nucleo,'precio_nucleo_viablilizados'=>$precio_nucleo_viablilizados);
		}
	
    }

    public function postProyectoViavilizado()//funcion que viabiliza un proyecto
	{

		$insert=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', Input::get('id_proy_viab'))->update(
	    			array(
	    				'id_viabi' =>2,
	    				'obs' =>Input::get('obs_viabl')
	    				)
	    			);
		
		if($insert>0){
			return Redirect::to('ivsociseguimientopic')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('ivsociseguimientopic')->with('status', 'error_estatus'); 
		}
    }

public function postProyectoNoViavilizado()//funcion que no viabiliza un proyecto
	{

		$insert=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', Input::get('id_proy_no_viab'))->update(
	    			array(
	    				'id_viabi' =>3,
	    				'obs' =>Input::get('obs_no_viabl')
	    				)
	    			);
		if($insert>0){
			return Redirect::to('ivsociseguimientopic')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('ivsociseguimientopic')->with('status', 'error_estatus'); 
		}

	
	
    }


 public function postProyectoRecuperado()//funcion que recupera un proyecto
	{

		$insert=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', Input::get('id_proy_recu'))->update(
	    			array(
	    				'id_viabi' =>1
	    				)
	    			);
		if($insert>0){
			return Redirect::to('ivsociseguimientopic')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('ivsociseguimientopic')->with('status', 'error_estatus'); 
		}

	
	
    }

    public function postBorrarDocCriterios()//funcion que recupera un proyecto
	{

		$insert=DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy', '=', Input::get('proy'))->where('id_crittod', '=', Input::get('crite'))->update(
	    			array(
	    				'url' =>"No tiene",
	    				'estado' =>"No tiene"
	    				)
	    			);
		return $insert;
		
	
    }

   

//////////////////////#################################    plan 51/50    ##########################///////////////////////

    public function plan50_ini()
	{
		$departamentos = DB::table('DEPARTAMENTOS')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))	
							->get();
		/*Consulta de los proyectos existentes en la base de datos*/
		$proyectos =DB::table('MODART_PIC_P5150')
					  ->join('DEPARTAMENTOS','MODART_PIC_P5150.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
					  ->join('MUNICIPIOS','MODART_PIC_P5150.cod_mpio','=','MUNICIPIOS.COD_DANE')	
					  ->select(db::raw('id, DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda,nom_proy,mod_foca,avance_prod'))
					  ->where('reg_eliminado','=','0')
					  ->get();
		return View::make('moduloart/ivplan50cargaproy', array('departamentos' => $departamentos), array('proyectos' => $proyectos));
	}

	public function postMunicipiosPlan50()
	{
		$depto=Input::get('depto');
		$municipios = DB::table('MUNICIPIOS')
						->select(DB::RAW('COD_DANE, NOM_MPIO_1'))
						->where('COD_DPTO','=',$depto)
						->orderby('NOM_MPIO_1')
						->get();
		return $municipios;
	}

	public function postCargarProyectoPlan50(){
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

		DB::table('MODART_PIC_P5150')->insert(
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

		return Redirect::to('plan50rrcargaproy')->with('status', 'ok_estatus'); 
	}

	public function postEditarPlan50(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$editar =DB::table('MODART_PIC_P5150')					  
					  ->select(db::raw('id, nom_proy,est_proy, CONVERT(VARCHAR(10),fecha_fin,103) as fecha_fin,avance_pres, avance_prod, costo_ejec'))
					  ->where('id','=',$proyecto)
					  ->get();	

		return $editar;
	}

	public function postEditarProyectoPlan50(){
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

		$edit=DB::table('MODART_PIC_P5150')->where('id',$id)->update(
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
			return Redirect::to('plan50rrcargaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('plan50rrcargaproy')->with('status', 'error_estatus_editar'); 
		}
		
	}

	public function postBorrarProyectoPlan50(){
		$id=intval(Input::get('id_borrar'));
		$borrar=DB::table('MODART_PIC_P5150')->where('id',$id)->update(
		    	array(
		    		//'id_usuario' => Auth::user()->id,		    		
		    		'reg_eliminado' =>  1,		    				    		
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);
		if($borrar>0){
			return Redirect::to('plan50rrcargaproy')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('plan50rrcargaproy')->with('status', 'error_estatus_borrar'); 
		}
	}

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de consulta

	public function plan50_ini_consulta()
	{		
		/*Consulta de los proyectos existentes en la base de datos*/
		$proyectos =DB::table('MODART_PIC_P5150')
					  ->join('DEPARTAMENTOS','MODART_PIC_P5150.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
					  ->join('MUNICIPIOS','MODART_PIC_P5150.cod_mpio','=','MUNICIPIOS.COD_DANE')	
					  ->select(db::raw('id, DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda,nom_proy,mod_foca,avance_prod'))
					  ->where('reg_eliminado','=','0')
					  ->get();	
		
		return View::make('moduloart/ivplan50consulproy', array('proyectos' => $proyectos));
	}

	public function postConsultarPlan50(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$editar =DB::table('MODART_PIC_P5150')	
					  ->join('DEPARTAMENTOS','MODART_PIC_P5150.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
					  ->join('MUNICIPIOS','MODART_PIC_P5150.cod_mpio','=','MUNICIPIOS.COD_DANE')					  
					  ->select(db::raw('id,DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,vereda, nom_proy,mod_foca,enti_lider,linea_proy,alcance,pob_bene,est_proy,fecha_inicio, fecha_fin,avance_pres, avance_prod,costo_estim, costo_ejec'))
					  ->where('id','=',$proyecto)
					  ->get();	

		return $editar;
	}


}
?>