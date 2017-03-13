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
			->select(DB::raw("concat('PIC_',cod_mpio,id_proy) as ID, id_proy,cod_depto,cod_mpio,id_usuario,cod_nucleo,id_subcat,nom_proy,alcance,estado_proy,prec_estim,cofinanc,fecha_ingreso"))
			->where('id_usuario','=',Auth::user()->id)
			->orderby('id_proy','desc')
			->get();	


			

		return View::make('moduloart.ivsocifichapriorizadaproy', array('arraydepto' => $arraydepto,'arraytipoterr' => $arraytipoterr,'arraynucleos' => $arraynucleos,'arraycate' => $result_cate,'arraymuni' => $arraymuni,'arraysubcate' => $SUBCATEGORIA,'arrayfocali'=>$arrayfocali,'arrayestado' => $arrayestado,'arrayindipic' => $arrayindipic,'arraysubsubcate' => $arraysubsubcate,'arraysocio'=>$arraysocio));		
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

	public function postTablaproy()//funcion que precarga los datos de indicadores para su edicion
	{    
		$arrayproy = DB::table('MODART_PIC_PROYPRIORIZ')
		->join('MUNICIPIOS','MUNICIPIOS.COD_DANE','=','MODART_PIC_PROYPRIORIZ.cod_mpio')
		->join('MODART_PIC_NUCLEOS','MODART_PIC_NUCLEOS.id_nucleo','=','MODART_PIC_PROYPRIORIZ.cod_nucleo')	
		->select(DB::raw("concat('PIC_',MODART_PIC_PROYPRIORIZ.cod_mpio,id_proy) as ID"),'id_proy',DB::raw("MUNICIPIOS.NOM_DPTO as cod_depto"),DB::raw("MUNICIPIOS.NOM_MPIO_1 as cod_mpio"),DB::raw("MODART_PIC_NUCLEOS.nombre as cod_nucleo"),'id_subcat','id_usuario','nom_proy','alcance','estado_proy','prec_estim','cofinanc',DB::raw("CONVERT(VARCHAR(10),fecha_ingreso,103) as fecha_ingreso,ranking"),'MUNICIPIOS.COD_DPTO as depto','MUNICIPIOS.COD_DANE as muni','MODART_PIC_NUCLEOS.id_nucleo as nucleo','acta')
		->where('MODART_PIC_PROYPRIORIZ.id_proy','=', Input::get('proy'))
		->where('id_usuario','=',Auth::user()->id)
		->get();	

		$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','nombre')
			->orderby('nombre','asc')
			->get();
			
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}	

		$tipoter = DB::table('MODART_PIC_TIPOTERRPASO')
			->select('id_proy','id_tipterr')
			->where('id_proy','=', Input::get('proy'))
			->get();
			
			foreach($tipoter as $pro)
			{
				 $arraytipoter[$pro->id_tipterr] = $pro->id_tipterr;
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


		return  array('arrayproy' => $arrayproy,'arraynucleos' => $arraynucleos,'arraytipoterr'=>$arraytipoter,'arraysubsubcate'=>$arraysubsubcate,'arraysocio'=>$arraysocio,'arraysociootro'=>$arraysociootro);	

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
	ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal,terr.[Resguardo Indígena] as Resguardo_Indigena ,terr.[Concejo Comunitario] as Concejo_Comunitario,terr.Vereda
from 
	(select
		intervencion,cate.nombre as cate,tabla1.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal 
	from 
		(select 
			subcate.nombre as intervencion,proy.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal 
		from 
			(select 
				MODART_PIC_PROYPRIORIZ.id_proy ,concat('PIC_',MUNICIPIOS.COD_DANE,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta 
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
		on tabla3.id_proy=terr.id_proy");


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
			->select(DB::raw("concat('PIC_',cod_mpio,id_proy) as ID, id_proy,cod_depto,cod_mpio,cod_nucleo,nom_proy,ranking,id_viabi"))
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
				->select(DB::raw("concat('PIC_',MUNICIPIOS.COD_DANE,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta,id_viabi"))
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


			


		return  array('arrayprio' => $arrayproy,'arraysubsubcate'=>$arraysubsubcate,'arraytipoterr'=>$arraytipoter,'cate'=>$cate);		
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
	tabla3.id_proy as auto,ID,Nombre_iniciativa,Alcance,cate as Categoria,subcategoria as Subcategoria,intervencion as Intervencion,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking as Ranking,Fecha_priorizacion,usuario as Responsable,NOM_DPTO as Departamento,NOM_MPIO_1 as Municipio,nucleo_veredal,terr.[Resguardo Indígena] as Resguardo_Indigena ,terr.[Concejo Comunitario] as Concejo_Comunitario,terr.Vereda
from 
	(select
		intervencion,cate.nombre as cate,tabla1.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal 
	from 
		(select 
			subcate.nombre as intervencion,proy.id_proy,ID,Nombre_iniciativa,Alcance,usuario,subcategoria,Estado_iniciativa,Precio_Estimado,Valor_cofinanciado,ranking,Fecha_priorizacion,NOM_DPTO,NOM_MPIO_1,nucleo_veredal 
		from 
			(select 
				MODART_PIC_PROYPRIORIZ.id_proy ,concat('PIC_',MUNICIPIOS.COD_DANE,MODART_PIC_PROYPRIORIZ.id_proy)as ID,MUNICIPIOS.NOM_DPTO,MUNICIPIOS.NOM_MPIO_1,MUNICIPIOS.COD_DANE,concat(users.name,'',users.last_name)as usuario,MODART_PIC_SUBCATEGORIA.nombre as subcategoria,MODART_PIC_NUCLEOS.nombre as nucleo_veredal,nom_proy as Nombre_iniciativa, alcance as Alcance,MODART_PIC_ESTADOPROY.nombre as Estado_iniciativa,prec_estim as Precio_Estimado, CONVERT(VARCHAR,fecha_ingreso,103) as Fecha_priorizacion, ranking,cofinanc as Valor_cofinanciado,acta 
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
			->select(DB::raw("concat('PIC_',cod_mpio,id_proy) as ID, id_proy,cod_depto,cod_mpio,cod_nucleo,nom_proy,ranking,id_viabi"))
			->where('id_viabi','=',1)
			->orderby('id_proy','desc')
			->get();	


			

		return View::make('moduloart.ivsociseguimientopic', array('arraydepto' => $arraydepto,'arraynucleos' => $arraynucleos,'arraymuni' => $arraymuni,'arrayindipic' => $arrayindipic));		
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
			->select('id')
			->where('id_subcat','=',$sub_cate)
			->orWhere('id_estad','=',$estado)
			->get();

			
		$array_viable=array_map(create_function('$item','return $item->id;'),$id_viabi);//extract value from object query	


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

		
		return  array('array_viable' => $array_viable);			
    }

    public function postCargarCriterio()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
		
		$path = public_path().'\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');
		$path_insert='\art\pic\\'.Input::get('nucleo').'\\'.Input::get('nucleo').Input::get('proy');
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){
						
		}
		else{
			File::makeDirectory($path,  $mode = 0777, $recursive = true);	
		}

	
		if(Input::hasFile('acta')) {

				Input::file('acta')->move($path,'PIC_'.Input::get('nucleo').Input::get('proy').'_Cri_.'.Input::file('acta')->getClientOriginalExtension());

	    		DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', '=', Input::get('proy'))->update(
	    			array(
	    				'acta' => $path_insert.'\\'.'PIC_'.Input::get('nucleo').Input::get('proy').'.'.Input::file('acta')->getClientOriginalExtension()
	    				)
	    			);
	    }

      
			return Redirect::to('ivsociseguimientopic')->with('status', 'ok_estatus'); 
		
	}

}
?>