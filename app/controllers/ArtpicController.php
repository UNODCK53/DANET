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
		    		'ranking'=>Input::get('checkranking'),
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

		    	if (count(Input::get('nom_terr')>0)){
			    	for ($i = 0; $i < count(Input::get('nom_terr')); $i++) {
					    $insert2=DB::table('MODART_PIC_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => $idmaximo,
					    		'id_terr' => Input::get('nom_terr')[$i],
					    		'tipo_terr'=> Input::get('tipoterr_comple')[$i]

					    		)
					    	);
					}
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
			if (Input::get('tipoterr')[$i]==1){
				$Resguardo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();
				foreach($Resguardo as $pro)
				{
					  $arrares[$pro->nom_terr] = $pro->cod_vda;
				}
				if (empty($Resguardo)) {
				}else{
					array_push($arratodoterr, $arrares);
					array_push($arratodoterrtipo, "Resguardos indígenas:");
				}
			}else if (Input::get('tipoterr')[$i]==2){
				$concejo = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();
				foreach($concejo as $pro)
				{
					 $arraccj[$pro->nom_terr] = $pro->cod_vda;
				}
				if (empty($concejo)) {
				}else{
					array_push($arratodoterr, $arraccj);
					array_push($arratodoterrtipo, "Consejos cumunitarios:");
				}
			}else{
				$veredas = DB::table('MODART_PIC_VEREDAS')
				->select('cod_vda','nom_terr')
				->where('cod_nucleo','=',Input::get('nucleo'))
				->orderby('nom_terr','asc')
				->get();

				foreach($veredas as $pro)
				{
					  $arravds[$pro->nom_terr] = $pro->cod_vda;
				}

				if (empty($veredas)) {
				}else{
				array_push($arratodoterr, $arravds);
				array_push($arratodoterrtipo, "Veredas:");
				}
			}

			

		}
		
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


		return  array('arrayproy' => $arrayproy,'arraytipoterr'=>$arraytipoter,'arraysubsubcate'=>$arraysubsubcate,'arraysocio'=>$arraysocio,'arraysociootro'=>$arraysociootro,'arraynomter'=>$nomter,'arratodoterredi'=>$arratodoterredi,'arratodoterrtipoedi'=>$arratodoterrtipoedi,'arrayrankingedi'=>$arrayranking);	

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

		    	if (count(Input::get('nom_terredi'))>0){
			    	for ($i = 0; $i < count(Input::get('nom_terredi')); $i++) {
					    $insert2=DB::table('MODART_PIC_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => Input::get('ediidproy'),
					    		'id_terr' => Input::get('nom_terredi')[$i],
					    		'tipo_terr'=> Input::get('tipoterredi_comple')[$i]

					    		)
					    	);
					}
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
				$results = DB::select("select auto,ID,Nombre_iniciativa,Alcance,Categoria,Subcategoria,Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,Responsable,Departamento,Municipio,nucleo_veredal, Resguardos_Indigenas,Consejo_Comunitario,Veredas 
from(select auto,ID,Nombre_iniciativa,Alcance,Categoria,Subcategoria,Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,Responsable,Departamento,Municipio,nucleo_veredal, Resguardos_Indigenas,Consejo_Comunitario from(

select 
	tabla3.id_proy as auto,ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal, Resguardos_Indigenas
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
				MODART_PIC_PROYPRIORIZ inner join MUNICIPIOS on MUNICIPIOS.COD_DANE = MODART_PIC_PROYPRIORIZ.cod_mpio inner join users on users.id = MODART_PIC_PROYPRIORIZ.id_usuario inner join MODART_PIC_SUBCATEGORIA on MODART_PIC_SUBCATEGORIA.id = MODART_PIC_PROYPRIORIZ.id_subcat inner join MODART_PIC_NUCLEOS on MODART_PIC_NUCLEOS.id_nucleo = MODART_PIC_PROYPRIORIZ.cod_nucleo inner join MODART_PIC_ESTADOPROY on MODART_PIC_ESTADOPROY.id = MODART_PIC_PROYPRIORIZ.estado_proy and MODART_PIC_PROYPRIORIZ.id_usuario=".Auth::user()->id.") as proy 
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
				(Select t3.id_proy,
				   Left(t3.t2,Len(t3.t2)-1) As 'Resguardos_Indigenas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=1) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t3) as t4 on t4.id_proy=tabla3.id_proy)as t5
			left join 
				(Select t7.id_proy,
				   Left(t7.t6,Len(t7.t6)-1) As 'Consejo_Comunitario'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=2) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t6
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t7) as t7 on t7.id_proy=t5.auto) as t8
			left join 
				(Select t10.id_proy,
				   Left(t10.t9,Len(t10.t9)-1) As 'Veredas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=3) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t9
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t10) as t11 on t11.id_proy=t8.auto order by auto desc");


				foreach ($results as $result) {
					$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:U1', function($cells) {
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

			$nomter = DB::select("Select 
				   Left(t3.t2,Len(t3.t2)-1) As 'nom_terr'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where id_proy=". Input::get('proy').") ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where id_proy=". Input::get('proy').") ST2
					) as t3");
			$nomterr=array_map(create_function('$item','return $item->nom_terr;'),$nomter);//extract value from object query		

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



			


		return  array('arrayprio' => $arrayproy,'arraysubsubcate'=>$arraysubsubcate,'arraytipoterr'=>$arraytipoter,'cate'=>$cate,'url'=>$url,'nom_crite'=>$nom_crite,'nomter'=>$nomter);		
    }


    public function Excelpic()
	{	
		


		Excel::create('PIC',function($excel)
		{
			$excel->sheet('Fichas de iniciativas',function($sheet)
			{
				$data = array();
				$results = DB::select(
					"select top 2000 auto,ID,Nombre_iniciativa,Alcance,Categoria,Subcategoria,Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,Responsable,Departamento,Municipio,nucleo_veredal, Resguardos_Indigenas,Consejo_Comunitario,Veredas 
from(select auto,ID,Nombre_iniciativa,Alcance,Categoria,Subcategoria,Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,Responsable,Departamento,Municipio,nucleo_veredal, Resguardos_Indigenas,Consejo_Comunitario from(

select 
	tabla3.id_proy as auto,ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,Estado_validacion,Observaciones,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal, Resguardos_Indigenas
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
				(Select t3.id_proy,
				   Left(t3.t2,Len(t3.t2)-1) As 'Resguardos_Indigenas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=1) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t3) as t4 on t4.id_proy=tabla3.id_proy)as t5
			left join 
				(Select t7.id_proy,
				   Left(t7.t6,Len(t7.t6)-1) As 'Consejo_Comunitario'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=2) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t6
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t7) as t7 on t7.id_proy=t5.auto) as t8
			left join 
				(Select t10.id_proy,
				   Left(t10.t9,Len(t10.t9)-1) As 'Veredas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=3) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t9
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t10) as t11 on t11.id_proy=t8.auto order by auto desc");


				foreach ($results as $result) {
					$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:U1', function($cells) {
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

		$tipoterr = DB::table('MODART_PIC_TIPOTERRPASO')
				->select('id_tipterr')
				->where('id_tipterr','<',3)
				->where('id_proy','=',Input::get('proy'))
				->get();

		if(empty($tipoterr)){
			$tipo=1;
		}else{
			$tipo=3;
		}
				


		$id_viabi = DB::table('MODART_PIC_VIABILIZACION')
			->join('MODART_PIC_CRITERIOS','MODART_PIC_CRITERIOS.id','=','MODART_PIC_VIABILIZACION.id_crite')
			->select('MODART_PIC_VIABILIZACION.id','MODART_PIC_CRITERIOS.nombre','id_crite','info')
			->where('id_subcat','=',$sub_cate)
			->orWhere('id_estad','=',$estado)
			->orWhere('id_terr','=',$tipo)
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
			
		}elseif($crea>count($array_viable))
		{
			DB::table('MODART_PIC_CRITERIOSTODOS')->where('id_proy','=',Input::get('proy'))->where('id_crittod','=',89)->delete();
		}elseif ($crea<count($array_viable)) {
			DB::table('MODART_PIC_CRITERIOSTODOS')->insert(
			    	array(
			    		'id_proy' => Input::get('proy'),
			    		'id_crittod' => 89
			    	)
		    	);
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
		    				'estado' => 'No aplica',
			    			'obs' => Input::get('obs_input')
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
		$departamentos = DB::table('MUNICIPIOS')
							->select(DB::RAW('COD_DPTO,NOM_DPTO'))
							->where('PDET','=',1)
							->orWhere('ZVTN','=',1)
							->groupby('COD_DPTO','NOM_DPTO')
							->orderby('NOM_DPTO','asc')
							->get();
		/*Consulta de los proyectos existentes en la base de datos*/
		$proyectos =DB::table('MODART_PIC_P5150_GEO')
					  ->join('DEPARTAMENTOS','MODART_PIC_P5150_GEO.cod_depto','=','DEPARTAMENTOS.COD_DPTO')
					  ->join('MUNICIPIOS','MODART_PIC_P5150_GEO.cod_mpio','=','MUNICIPIOS.COD_DANE')	
					  ->select(db::raw("OBJECTID,concat('P5150_',MODART_PIC_P5150_GEO.cod_nucleo,OBJECTID) as IDs, DEPARTAMENTOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO,cod_nucleo,nom_proy,est_proy"))
					  ->where('MODART_PIC_P5150_GEO.id_usuario','=',Auth::user()->id)
					  ->get();
		$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->orderby('nombre','asc')
			->get();
			$arraynucleos['']='Seleccione uno';
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}			  

		$TIPOTERR = DB::table('MODART_PIC_TIPOTERR')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			foreach($TIPOTERR as $pro)
			{
				$arraytipoterr[$pro->id] = $pro->nombre;
			}			  
		return View::make('moduloart/ivplan50cargaproy', array('departamentos' => $departamentos,'proyectos' => $proyectos,'arraytipoterr'=>$arraytipoterr,'arraynucleos'=>$arraynucleos));
	}

	public function postMunicipiosPlan50()
	{
		$depto=Input::get('depto');
		$municipios = DB::select('SELECT COD_DANE, NOM_MPIO_1 FROM MUNICIPIOS where (PDET=1 or ZVTN=1) and COD_DPTO='.$depto.'order by NOM_MPIO_1 asc');
		return $municipios;
	}

	public function postCargarProyectoPlan50(){

		if (empty(Input::get('ava_product'))) {
			$ava_product=null;
		}else {
			$ava_product=Input::get('ava_product');
		}

		if (empty(Input::get('long'))) {
			$long=null;
		}else {
			$long=Input::get('long');
		}

		if (empty(Input::get('cost_esti'))) {
			$cost_esti=null;
		}else {
			$cost_esti=Input::get('cost_esti');
		}

		if (empty(Input::get('cost_proy'))) {
			$cost_proy=null;
		}else {
			$cost_proy=Input::get('cost_proy');
		}
		if (empty(Input::get('pob_bene_ter'))) {
			$sum_pobla=null;
		}else {
			$sum_pobla=array_sum(Input::get('pob_bene_ter'));
		}
		

		if(Input::get('estado')=="Ejecución"){
			$fecha1=Input::get('fecha_inicio2');
			$fecha2=Input::get('fecha_final2');
			$costo= $cost_proy;
			$alcance=Input::get('alcance3');
		}else if(Input::get('estado')=="Estructuración"){
			$fecha1=Input::get('fecha_inicio');
			$fecha2=Input::get('fecha_final');
			$costo= $cost_esti;
			$alcance=Input::get('alcance2');
		}else{
			$fecha1=Input::get('fecha_inicio');
			$fecha2=Input::get('fecha_final');
			$costo= $cost_esti;
			$alcance=Input::get('alcance');
		}

		if(Input::get('coorde')==1){
				if(Input::get('lat_gra_ini')>0){
					$Latitud=(Input::get('lat_gra_ini')+Input::get('lat_min_ini')/60+Input::get('lat_seg_ini')/3600);
				}else{
					$Latitud=(Input::get('lat_gra_ini')-Input::get('lat_min_ini')/60-Input::get('lat_seg_ini')/3600);
				}

				$longitud=(Input::get('long_gra_ini')-Input::get('long_min_ini')/60-Input::get('long_seg_ini')/3600);
				$coor_ini=$longitud." ".$Latitud;
					
				
			}else{
				$Latitud=null;
				$longitud=null;
				$coor_ini=$longitud." ".$Latitud;
			}

		if(Input::get('coorde_fin')==1){
				if(Input::get('lat_gra_fin')>0){
					$Latitud_fin=(Input::get('lat_gra_fin')+Input::get('lat_min_fin')/60+Input::get('lat_seg_fin')/3600);
				}else{
					$Latitud_fin=(Input::get('lat_gra_fin')-Input::get('lat_min_fin')/60-Input::get('lat_seg_fin')/3600);
				}

				$longitud_fin=(Input::get('long_gra_fin')-Input::get('long_min_fin')/60-Input::get('long_seg_fin')/3600);
				$coor_fin=$longitud_fin." ".$Latitud_fin;
				
			}else{
				$Latitud_fin=null;
				$longitud_fin=null;
				$coor_fin=$longitud_fin." ".$Latitud_fin;
			}	


		DB::table('MODART_PIC_P5150_GEO')->insert(
		    	array(
		    		'id_usuario' => Auth::user()->id,
		    		'cod_depto' => Input::get('depto'),
		    		'cod_mpio' => Input::get('municipios'),
		    		'cod_nucleo' => Input::get('nucleo'),
		    		'nom_proy' => Input::get('nombre'),
		    		'nom_proy_2' => Input::get('nombre'),
		    		'nom_proy_3' => Input::get('nombre'),
		    		'enti_lider' =>  Input::get('entidad'),
		    		'linea_proy' => Input::get('linea'),
		    		'alcance' => $alcance,
		    		'est_proy' =>  Input::get('estado'),
		    		'fecha_inicio' => $fecha1,
		    		'fecha_fin' => $fecha2,
		    		'fecha_inicio_2' => $fecha1,
		    		'fecha_fin_2' =>  $fecha2,
		    		'avance_pres' =>  Input::get('ava_presu'),
		    		'alcance_2' => $alcance,
		    		'alcance_3' => $alcance,
		    		'pob_bene' => $sum_pobla ,
		    		'avance_prod' => $ava_product,
		    		'longitud' => $long,
		    		'costo_estim' =>preg_replace("/[. $]/","",$costo),
		    		'costo_ejec' =>preg_replace("/[. $]/","",$costo),
		    		'coord_ini' =>$coor_ini,
		    		'coord_fin' =>$coor_fin,
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);

		$idmaximo =  DB::table('MODART_PIC_P5150_GEO')->max('OBJECTID');
		    	foreach (Input::get('tipoterr') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_P5150_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => $idmaximo,
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}

		    	if (count(Input::get('nom_terr')>0)){
			    	for ($i = 0; $i < count(Input::get('nom_terr')); $i++) {
					    $insert2=DB::table('MODART_PIC_P5150_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => $idmaximo,
					    		'id_terr' => Input::get('nom_terr')[$i],
					    		'tipo_terr'=> Input::get('tipoterr_comple')[$i],
					    		'pobla'=> Input::get('pob_bene_ter')[$i]


					    		)
					    	);
					}
				}

		if (Input::get('coorde')==1 && Input::get('coorde_fin')==1){

				$insert=DB::statement("UPDATE MODART_PIC_P5150_GEO SET Shape = (geometry::STGeomFromText('LINESTRING('+convert(varchar(20),coord_ini)+', '+convert(varchar(20),coord_fin)+')',4326) ) WHERE OBJECTID =". $idmaximo);
			}		



		$path = public_path().'\art\pic_51_50\\'.Input::get('nucleo').'\\'.Input::get('nucleo').$idmaximo;
		$path_insert='\art\pic_51_50\\'.Input::get('nucleo').'\\'.Input::get('nucleo').$idmaximo;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){			
		}
		else{
			File::makeDirectory($path,  0777, true);	

		}
		if(Input::hasFile('doc')) {

				Input::file('doc')->move($path,'Act5150_'.Input::get('nucleo').$idmaximo.'.'.Input::file('doc')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID', '=', $idmaximo)->update(
	    			array(
	    				'documento' => $path_insert.'\\'.'Act5150_'.Input::get('nucleo').$idmaximo.'.'.Input::file('doc')->getClientOriginalExtension()
	    				)
	    			);
	    }	




		return Redirect::to('plan50cargaproy')->with('status', 'ok_estatus'); 
	}

	public function postEditarPlan50(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$arrayproy = DB::table('MODART_PIC_P5150_GEO')
		->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_PIC_P5150_GEO.cod_mpio')
		->join('MODART_PIC_NUCLEOS','MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_P5150_GEO.cod_nucleo')	
		->select(DB::raw("concat('P5150_',MODART_PIC_P5150_GEO.cod_nucleo,OBJECTID) as ID"),'OBJECTID',DB::raw("MUNICIPIOS.NOM_DPTO as cod_depto"),DB::raw("MUNICIPIOS.NOM_MPIO as cod_mpio"),DB::raw("MODART_PIC_NUCLEOS.nombre as nom_nucleo"),'cod_nucleo','id_usuario','nom_proy','nom_proy_2','nom_proy_3','alcance','est_proy',DB::raw("CONVERT(VARCHAR(10),fecha_inicio,103) as fecha_inicio,CONVERT(VARCHAR(10),fecha_inicio_2,103) as fecha_inicio_2,CONVERT(VARCHAR(10),fecha_fin,103) as fecha_fin,CONVERT(VARCHAR(10),fecha_fin_2,103) as fecha_fin_2"),'avance_pres','avance_prod','costo_estim','costo_ejec','longitud','coord_ini','coord_fin','pob_bene','documento','alcance_2','alcance_3','enti_lider','linea_proy') 
		->where('MODART_PIC_P5150_GEO.OBJECTID','=', Input::get('proy')) 
		->where('id_usuario','=',Auth::user()->id)
		->get();

		foreach($arrayproy as $pro)
			{
				 $nucl = $pro->cod_nucleo;
			}

		$tipoter = DB::table('MODART_PIC_P5150_TIPOTERRPASO')
			->select('id_proy','id_tipterr')
			->where('id_proy','=', Input::get('proy'))
			->get();
			
			foreach($tipoter as $pro)
			{
				 $arraytipoter[$pro->id_tipterr] = $pro->id_tipterr;
			}	
			$terr=array_map(create_function('$item','return $item->id_tipterr;'),$tipoter);//extract value from object query	

		$nomter = DB::table('MODART_PIC_P5150_PROYECTOTERRI')
			->select('id_proy','id_terr','tipo_terr','pobla')
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
		


		

		return array('arrayproy'=>$arrayproy,'terr'=>$terr,'arratodoterredi'=>$arratodoterredi,'arratodoterrtipoedi'=>$arratodoterrtipoedi,'arraynomter'=>$nomter);
	}

	public function postEdiProyP50Iden(){
		$id=Input::get('ediidproyediiden');

		$edit=DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID',$id)->update(
		    	array(	    		
		    		'alcance' =>  Input::get('alcanceediiden'),
		    		'nom_proy' =>  Input::get('nombreediiden'),	
		    		'nom_proy_2' =>  Input::get('nombreediiden'),	
		    		'nom_proy_3' =>  Input::get('nombreediiden'),		    		
		    		'alcance_2' =>  Input::get('alcanceediiden'),
		    		'alcance_3' =>  Input::get('alcanceediiden'),
		    		'enti_lider' =>  Input::get('entidadediiden'),
		    		'linea_proy' =>  Input::get('lineaediiden'),
		    		'est_proy' =>  Input::get('estadoediiden'),
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);

		DB::table('MODART_PIC_P5150_TIPOTERRPASO')->where('id_proy',$id)->delete();
		
		    	foreach (Input::get('tipoterrediiden') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_P5150_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => $id,
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}

		    	DB::table('MODART_PIC_P5150_PROYECTOTERRI')->where('id_proy',$id)->delete();

		    	if (count(Input::get('nom_terrediiden'))>0){
			    	for ($i = 0; $i < count(Input::get('nom_terrediiden')); $i++) {
					    $insert2=DB::table('MODART_PIC_P5150_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => $id,
					    		'id_terr' => Input::get('nom_terrediiden')[$i],
					    		'tipo_terr'=> Input::get('tipoterredi_comple')[$i]

					    		)
					    	);
					}
				}

		$path = public_path().'\art\pic_51_50\\'.Input::get('nucleoediiden2').'\\'.Input::get('nucleoediiden2').$id;
		$path_insert='\art\pic_51_50\\'.Input::get('nucleoediiden2').'\\'.Input::get('nucleoediiden2').$id;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){			
		}
		else{
			File::makeDirectory($path,  0777, true);	

		}
		if(Input::hasFile('docide')) {

				Input::file('docide')->move($path,'Act5150_'.Input::get('nucleoediiden2').$id.'.'.Input::file('docide')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID', '=', $id)->update(
	    			array(
	    				'documento' => $path_insert.'\\'.'Act5150_'.Input::get('nucleoediiden2').$id.'.'.Input::file('docide')->getClientOriginalExtension()
	    				)
	    			);
	    }		

		if($edit>0){
			return Redirect::to('plan50cargaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('plan50cargaproy')->with('status', 'error_estatus_editar'); 
		}
		
	}

	public function postEdiProyP50Estr(){
		$id=Input::get('ediidproyediestr');

		$edit=DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID',$id)->update(
		    	array(	    		
		    		'alcance_2' =>  Input::get('alcanceediestr'),
		    		'nom_proy_2' =>  Input::get('nombreediestr'),	
		    		'nom_proy_3' =>  Input::get('nombreediestr'),
		    		'alcance_3' =>  Input::get('alcanceediestr'),
		    		'enti_lider' =>  Input::get('entidadediestr'),
		    		'linea_proy' =>  Input::get('lineaediestr'),
		    		'est_proy' =>  Input::get('estadoediestr'),
		    		'costo_estim' => preg_replace("/[. $]/","",Input::get('cost_proyediestr')),
		    		'costo_ejec' => preg_replace("/[. $]/","",Input::get('cost_proyediestr')),
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);

		DB::table('MODART_PIC_P5150_TIPOTERRPASO')->where('id_proy',$id)->delete();
		
		    	foreach (Input::get('tipoterrediestr') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_P5150_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => $id,
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}

		    	DB::table('MODART_PIC_P5150_PROYECTOTERRI')->where('id_proy',$id)->delete();

		    	if (count(Input::get('nom_terrediestr'))>0){
			    	for ($i = 0; $i < count(Input::get('nom_terrediestr')); $i++) {
					    $insert2=DB::table('MODART_PIC_P5150_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => $id,
					    		'id_terr' => Input::get('nom_terrediestr')[$i],
					    		'tipo_terr'=> Input::get('tipoterredi_comple')[$i]

					    		)
					    	);
					}
				}

		$path = public_path().'\art\pic_51_50\\'.Input::get('nucleoediestr2').'\\'.Input::get('nucleoediestr2').$id;
		$path_insert='\art\pic_51_50\\'.Input::get('nucleoediestr2').'\\'.Input::get('nucleoediestr2').$id;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){			
		}
		else{
			File::makeDirectory($path,  0777, true);	

		}
		if(Input::hasFile('docest')) {

				Input::file('docest')->move($path,'Act5150_'.Input::get('nucleoediestr2').$id.'.'.Input::file('docest')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID', '=', $id)->update(
	    			array(
	    				'documento' => $path_insert.'\\'.'Act5150_'.Input::get('nucleoediestr2').$id.'.'.Input::file('docest')->getClientOriginalExtension()
	    				)
	    			);
	    }			

		if($edit>0){
			return Redirect::to('plan50cargaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('plan50cargaproy')->with('status', 'error_estatus_editar'); 
		}
		
	}

	public function postEdiProyP50Eje(){
		$id=Input::get('ediidproyedieje');
		if(Input::get('coordeedieje')==1){
				if(Input::get('lat_gra_iniedieje')>0){
					$Latitud=(Input::get('lat_gra_iniedieje')+Input::get('lat_min_iniedieje')/60+Input::get('lat_seg_iniedieje')/3600);
				}else{
					$Latitud=(Input::get('lat_gra_iniedieje')-Input::get('lat_min_iniedieje')/60-Input::get('lat_seg_iniedieje')/3600);
				}

				$longitud=(Input::get('long_gra_iniedieje')-Input::get('long_min_iniedieje')/60-Input::get('long_seg_iniedieje')/3600);
				$coor_ini=$longitud." ".$Latitud;
					
				
			}else{
				$Latitud=null;
				$longitud=null;
				$coor_ini=$longitud." ".$Latitud;
			}

		if(Input::get('coorde_finedieje')==1){
				if(Input::get('lat_gra_finedieje')>0){
					$Latitud_fin=(Input::get('lat_gra_finedieje')+Input::get('lat_min_finedieje')/60+Input::get('lat_seg_finedieje')/3600);
				}else{
					$Latitud_fin=(Input::get('lat_gra_finedieje')-Input::get('lat_min_finedieje')/60-Input::get('lat_seg_finedieje')/3600);
				}

				$longitud_fin=(Input::get('long_gra_finedieje')-Input::get('long_min_finedieje')/60-Input::get('long_seg_finedieje')/3600);
				$coor_fin=$longitud_fin." ".$Latitud_fin;
				
			}else{
				$Latitud_fin=null;
				$longitud_fin=null;
				$coor_fin=$longitud_fin." ".$Latitud_fin;
			}	
		$edit=DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID',$id)->update(
		    	array(	  
		    		'nom_proy_3' =>  Input::get('nombreedieje'),  		
		    		'alcance_3' =>  Input::get('alcanceedieje'),
		    		'enti_lider' =>  Input::get('entidadedieje'),
		    		'linea_proy' =>  Input::get('lineaedieje'),
		    		'est_proy' =>  Input::get('estadoedieje'),
		    		'costo_ejec' => preg_replace("/[. $]/","",Input::get('cost_proyedieje')),
		    		'pob_bene' =>  array_sum(Input::get('pob_bene_ter')),
		    		'avance_pres' =>  Input::get('ava_presuedieje'),
		    		'avance_prod' =>  Input::get('ava_productedieje'),
		    		'longitud' =>  Input::get('longedieje'),
		    		'fecha_inicio_2' =>  Input::get('fecha_inicio2edieje'),
		    		'fecha_fin_2' =>  Input::get('fecha_final2edieje'),
		    		'coord_ini' => $coor_ini,
		    		'coord_fin' => $coor_fin,
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha
		    	)
		);

		DB::table('MODART_PIC_P5150_TIPOTERRPASO')->where('id_proy',$id)->delete();
		
		    	foreach (Input::get('tipoterredieje') as $key => $value) {
		    		$insert2=DB::table('MODART_PIC_P5150_TIPOTERRPASO')->insert(
				    	array(
				    		'id_proy' => $id,
				    		'id_tipterr' => $value
				    		)
				    	);
		    	}

		    	DB::table('MODART_PIC_P5150_PROYECTOTERRI')->where('id_proy',$id)->delete();

		    	if (count(Input::get('nom_terredieje'))>0){
			    	for ($i = 0; $i < count(Input::get('nom_terredieje')); $i++) {
					    $insert2=DB::table('MODART_PIC_P5150_PROYECTOTERRI')->insert(
					    	array(
					    		'id_proy' => $id,
					    		'id_terr' => Input::get('nom_terredieje')[$i],
					    		'tipo_terr'=> Input::get('tipoterredi_comple')[$i],
					    		'pobla'=> Input::get('pob_bene_ter')[$i]

					    		)
					    	);
					}
				}

		$path = public_path().'\art\pic_51_50\\'.Input::get('nucleoedieje2').'\\'.Input::get('nucleoedieje2').$id;
		$path_insert='\art\pic_51_50\\'.Input::get('nucleoedieje2').'\\'.Input::get('nucleoedieje2').$id;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){			
		}
		else{
			File::makeDirectory($path,  0777, true);	

		}
		if(Input::hasFile('doceje')) {

				Input::file('doceje')->move($path,'Act5150_'.Input::get('nucleoedieje2').$id.'.'.Input::file('doceje')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID', '=', $id)->update(
	    			array(
	    				'documento' => $path_insert.'\\'.'Act5150_'.Input::get('nucleoedieje2').$id.'.'.Input::file('doceje')->getClientOriginalExtension()
	    				)
	    			);
	    }		

		if($edit>0){
			return Redirect::to('plan50cargaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('plan50cargaproy')->with('status', 'error_estatus_editar'); 
		}
		
	}
	public function postBorrarProyectoPlan50(){
		$borrar=DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID',Input::get('deleteproy'))->delete();
		
		if($borrar>0){
			return Redirect::to('plan50cargaproy')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('plan50cargaproy')->with('status', 'error_estatus_borrar'); 
		}
	}

	 public function postBorrarDocPlan50()//funcion que recupera un proyecto
	{

		$insert=DB::table('MODART_PIC_P5150_GEO')->where('OBJECTID', '=', Input::get('proy'))->update(
	    			array(
	    				'documento' =>'',
	    				)
	    			);
		return $insert;
		
	
    }

	//-------------------------------------------------------------------------------------
	//Controladores para la vista de consulta

	public function plan50_ini_consulta()
	{		
		/*Consulta de los proyectos existentes en la base de datos*/

		$proyectos = DB::table('MODART_PIC_P5150_GEO')
		->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_PIC_P5150_GEO.cod_mpio')
		->join('MODART_PIC_NUCLEOS','MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_P5150_GEO.cod_nucleo')	
		->select(DB::raw("concat('P5150_',MODART_PIC_P5150_GEO.cod_nucleo,OBJECTID) as ID"),'OBJECTID',DB::raw("MUNICIPIOS.NOM_DPTO as cod_depto"),DB::raw("MUNICIPIOS.NOM_MPIO as cod_mpio"),DB::raw("MODART_PIC_NUCLEOS.nombre as nom_nucleo"),'cod_nucleo','id_usuario','nom_proy','nom_proy_2','nom_proy_3','alcance','est_proy',DB::raw("CONVERT(VARCHAR(10),fecha_inicio,103) as fecha_inicio,CONVERT(VARCHAR(10),fecha_inicio_2,103) as fecha_inicio_2,CONVERT(VARCHAR(10),fecha_fin,103) as fecha_fin,CONVERT(VARCHAR(10),fecha_fin_2,103) as fecha_fin_2"),'avance_pres','avance_prod','costo_estim','costo_ejec','longitud','coord_ini','coord_fin','pob_bene','documento','alcance_2','alcance_3','enti_lider','linea_proy') 
		->get();
		
		return View::make('moduloart/ivplan50consulproy', array('proyectos' => $proyectos));
	}

	public function postConsultarPlan50(){
		//THIS CONTROLLER LOAD THE INFORMATION TO EDIT MODAL 
		$proyecto=Input::get('proyecto');
		$editar = DB::table('MODART_PIC_P5150_GEO')
			->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_PIC_P5150_GEO.cod_mpio')
			->join('MODART_PIC_NUCLEOS','MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_P5150_GEO.cod_nucleo')	
			->select(DB::raw("concat('P5150_',MODART_PIC_P5150_GEO.cod_nucleo,OBJECTID) as ID"),'OBJECTID',DB::raw("MUNICIPIOS.NOM_DPTO as cod_depto"),DB::raw("MUNICIPIOS.NOM_MPIO as cod_mpio"),DB::raw("MODART_PIC_NUCLEOS.nombre as nom_nucleo"),'cod_nucleo','id_usuario','nom_proy','nom_proy_2','nom_proy_3','alcance','est_proy',DB::raw("CONVERT(VARCHAR(10),fecha_inicio,103) as fecha_inicio,CONVERT(VARCHAR(10),fecha_inicio_2,103) as fecha_inicio_2,CONVERT(VARCHAR(10),fecha_fin,103) as fecha_fin,CONVERT(VARCHAR(10),fecha_fin_2,103) as fecha_fin_2"),'avance_pres','avance_prod','costo_estim','costo_ejec','longitud','coord_ini','coord_fin','pob_bene','documento','alcance_2','alcance_3','enti_lider','linea_proy') 
		   ->where('OBJECTID','=',$proyecto)
		   ->get();	

	$tipoter = DB::table('MODART_PIC_P5150_TIPOTERRPASO')
		 	
			->select('MODART_PIC_TIPOTERR.nombre')
			->join('MODART_PIC_TIPOTERR','MODART_PIC_TIPOTERR.id','=','MODART_PIC_P5150_TIPOTERRPASO.id_tipterr')
			->where('id_proy','=', $proyecto)
			->get();
			$terr=array_map(create_function('$item','return $item->nombre;'),$tipoter);//extract value from object query	

		
	$nomter = DB::select("Select 
				   Left(t3.t2,Len(t3.t2)-1) As 'nom_terr'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr + ',' AS [text()]
								From (SELECT id_proy,nom_terr,tipo_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where id_proy=". $proyecto.") ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t3");
			$nomterr=array_map(create_function('$item','return $item->nom_terr;'),$nomter);//extract value from object query	

	$bene = DB::select("Select 
				   Left(t3.t2,Len(t3.t2)-1) As 'nom_terr'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr +' ('AS [text()],ST1.pobla AS [text()],' beneficiarios), ' as [text()]
								From (SELECT id_proy,nom_terr,tipo_terr,pobla
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where id_proy=". $proyecto.") ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t3");
			$pobla_bene=array_map(create_function('$item','return $item->nom_terr;'),$bene);//extract value from object query			

		return array('todo'=>$editar,'tipoterr'=>$terr,'arraynomter'=>$nomterr,'pobla_bene'=>$pobla_bene);
	}


	public function Excelpic50()
	{	
		


		Excel::create('P5150_',function($excel)
		{
			$excel->sheet('Proyectos',function($sheet)
			{
				$data = array();
				$results = DB::select(
					"select auto,ID,Departamento,Municipios,COD_DANE,Usuario,Nucleo_veredal,Resguardos_Indigenas,Consejo_Comunitario,Veredas,Poblacion_beneficiada,Nom_proy_identi,Nom_proy_estruct,Nom_proy_ejecuci,Actores_para_implementacion,Linea_del_proyecto,Alcance_en_identi,Alcance_en_estruct,Alcance_en_ejecuci,Estado_actual,Fecha_estimada_ejecucion,Fecha_estimada_finalizacion,Fecha_de_ejecucion,Fecha_finalizacion,Avance_presupuestal,Avance_del_producto,Costo_estimado,Costo_final,Longitud_tramo,coord_ini,coord_fin
from 
	(select auto,ID,Departamento,Municipios,COD_DANE,usuario as Usuario,nucleo_veredal as Nucleo_veredal,Nom_proy_identi,Nom_proy_estruct,Nom_proy_ejecuci,Actores_para_implementacion,Linea_del_proyecto,Alcance_en_identi,Alcance_en_estruct,Alcance_en_ejecuci,Estado_actual,Fecha_estimada_ejecucion,Fecha_estimada_finalizacion,Fecha_de_ejecucion,Fecha_finalizacion,Avance_presupuestal,Avance_del_producto,Costo_estimado,Costo_final,Longitud_tramo,coord_ini,coord_fin,Poblacion_beneficiada,Resguardos_Indigenas,Consejo_Comunitario
		from (select auto,ID,Departamento,Municipios,COD_DANE,usuario,nucleo_veredal,Nom_proy_identi,Nom_proy_estruct,Nom_proy_ejecuci,Actores_para_implementacion,Linea_del_proyecto,Alcance_en_identi,Alcance_en_estruct,Alcance_en_ejecuci,Estado_actual,Fecha_estimada_ejecucion,Fecha_estimada_finalizacion,Fecha_de_ejecucion,Fecha_finalizacion,Avance_presupuestal,Avance_del_producto,Costo_estimado,Costo_final,Longitud_tramo,coord_ini,coord_fin,Poblacion_beneficiada,Resguardos_Indigenas
			from (select 
				OBJECTID as auto,concat('P5150_',MODART_PIC_P5150_GEO.cod_nucleo,OBJECTID) as ID,MUNICIPIOS.NOM_DPTO  as Departamento,MUNICIPIOS.NOM_MPIO_1 as Municipios,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario ,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nom_proy_identi,nom_proy_2 as Nom_proy_estruct,nom_proy_3 as Nom_proy_ejecuci,enti_lider as Actores_para_implementacion,linea_proy as Linea_del_proyecto,alcance as Alcance_en_identi,alcance_2 as Alcance_en_estruct,alcance_3 as Alcance_en_ejecuci,est_proy as Estado_actual,CONVERT(VARCHAR,fecha_inicio,103) as Fecha_estimada_ejecucion,CONVERT(VARCHAR,fecha_fin,103) as Fecha_estimada_finalizacion,CONVERT(VARCHAR,fecha_inicio_2,103) as Fecha_de_ejecucion,CONVERT(VARCHAR,fecha_fin_2,103) as Fecha_finalizacion,avance_pres as Avance_presupuestal,avance_prod as Avance_del_producto,costo_estim as Costo_estimado,costo_ejec as Costo_final,longitud as Longitud_tramo,coord_ini,coord_fin,pob_bene as Poblacion_beneficiada 
			from MODART_PIC_P5150_GEO 
			inner join 
				MUNICIPIOS on MUNICIPIOS.COD_DANE = MODART_PIC_P5150_GEO.cod_mpio 
			inner join 
				users on users.id = MODART_PIC_P5150_GEO.id_usuario 
			inner join 
				MODART_PIC_NUCLEOS on MODART_PIC_NUCLEOS.id_nucleo = MODART_PIC_P5150_GEO.cod_nucleo)as t1

			left join 
				(Select t3.id_proy,
				   Left(t3.t2,Len(t3.t2)-1) As 'Resguardos_Indigenas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr +' ('AS [text()],ST1.pobla AS [text()],' beneficiarios), ' as [text()]
								From (SELECT id_proy,nom_terr,tipo_terr,pobla
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=1) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t2
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t3) as t4 on t4.id_proy=t1.auto)as t5
			left join 
				(Select t7.id_proy,
				   Left(t7.t6,Len(t7.t6)-1) As 'Consejo_Comunitario'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr +' ('AS [text()],ST1.pobla AS [text()],' beneficiarios), ' as [text()]
								From (SELECT id_proy,nom_terr,tipo_terr,pobla
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=2) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t6
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t7) as t7 on t7.id_proy=t5.auto) as t8
			left join 
				(Select t10.id_proy,
				   Left(t10.t9,Len(t10.t9)-1) As 'Veredas'
				From
					(
						Select distinct ST2.id_proy, 
							(
								Select ST1.nom_terr +' ('AS [text()],ST1.pobla AS [text()],' beneficiarios), ' as [text()]
								From (SELECT id_proy,nom_terr,tipo_terr,pobla
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda where tipo_terr=3) ST1
								Where ST1.id_proy = ST2.id_proy
								ORDER BY ST1.tipo_terr,ST1.nom_terr
								For XML PATH ('')
							) as t9
						From (SELECT id_proy,nom_terr
									FROM MODART_PIC_P5150_PROYECTOTERRI 
									join MODART_PIC_VEREDAS 
									on MODART_PIC_P5150_PROYECTOTERRI.id_terr=MODART_PIC_VEREDAS.cod_vda) ST2
					) as t10) as t11 on t11.id_proy=t8.auto order by auto desc ");


				foreach ($results as $result) {
					$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:AE1', function($cells) {
		    	$cells->setBackground('#dadae3');
				});

			
			})->download('xlsx');
		});
    }


}
?>