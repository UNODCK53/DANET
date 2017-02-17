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
			$arraytipoterr['']='Seleccione uno';
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
			->select('id_nucleo','COD_DANE','nombre')
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
			$arrayfocali['']='Seleccione uno';
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

			
			$TIPOTERR = DB::table('MODART_PIC_TIPOTERR')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$arraytipoter['']='Seleccione uno';
			foreach($ESTADOPROY as $pro)
			{
				$arrayestado[$pro->id] = $pro->nombre;
			}


			$arrayindipic = DB::table('MODART_PIC_PROYPRIORIZ')	
			->select(DB::raw("id_proy,cod_depto,cod_mpio,id_usuario,id_tipoterr,cod_nucleo,id_subcat,id_focal,nom_proy,alcance,estado_proy,prec_estim,cofinanc,fecha_ingreso"))
			
			->get();	


			

		return View::make('moduloart.ivsocifichapriorizadaproy', array('arraydepto' => $arraydepto,'arraytipoterr' => $arraytipoterr,'arraynucleos' => $arraynucleos,'arraycate' => $result_cate,'arraytipoter' => $arraytipoter,'arraymuni' => $arraymuni,'arraysubcate' => $SUBCATEGORIA,'arrayfocali'=>$arrayfocali,'arrayestado' => $arrayestado,'arrayindipic' => $arrayindipic));		
	}	


	public function postCrearProyecto()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
			$fecha = date("Y-m-d H:i:s");
			$insert=DB::table('MODART_PIC_PROYPRIORIZ')->insert(
		    	array(
		    		'nom_proy' => Input::get('nomproy'),
		    		'alcance' => Input::get('alcance'),	  
		    		'cod_depto' => Input::get('depto'),
		    		'cod_mpio' => Input::get('mpios'),
		    		'cod_nucleo' => Input::get('nucleo'),
		    		'id_subcat' => Input::get('nom_supcate'),
		    		'prec_estim' => Input::get('precio'),
		    		'id_focal' => Input::get('focal'),
		    		'estado_proy' => Input::get('estado'),
		    		'cofinanc' => Input::get('cofina'),
		    		'fecha_ingreso' => Input::get('fecha'),
		    		'id_tipoterr' => Input::get('tipoterr'),
		    		'id_usuario' => Auth::user()->id,
		    		//'created_at' => $fecha,
		    		//'updated_at' => $fecha
		    	)
			);

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

	public function postTablaproy()//funcion que precarga los datos de indicadores para su edicion
	{    
		$arrayproy = DB::table('MODART_PIC_PROYPRIORIZ')	
		->select('id_proy','cod_depto','cod_mpio','id_usuario','id_tipoterr','id_subcat','id_focal','cod_nucleo','nom_proy','alcance','estado_proy','prec_estim','cofinanc',DB::raw("CONVERT(VARCHAR(10),fecha_ingreso,103) as fecha_ingreso"))
		->where('MODART_PIC_PROYPRIORIZ.id_proy','=', Input::get('proy'))
		->get();	

		foreach($arrayproy as $pro)
			{
				$MUNICIPIOS = DB::table('MUNICIPIOS')
				->select('COD_DPTO','COD_DANE','NOM_MPIO_1')
				->where('COD_DPTO','=',$pro->cod_depto)
				->orderby('NOM_MPIO_1','asc')
				->get();
				foreach($MUNICIPIOS as $pro)
				{
					$arraympios[$pro->NOM_MPIO_1] = $pro->COD_DANE;
				}
			}

		$NUCLEOS = DB::table('MODART_PIC_NUCLEOS')
			->select('id_nucleo','COD_DANE','nombre')
			->orderby('nombre','asc')
			->get();
			
			foreach($NUCLEOS as $pro)
			{
				 $arraynucleos[$pro->id_nucleo] = $pro->nombre;
			}		


		return  array('arrayproy' => $arrayproy,'arraympios' => $arraympios,'arraynucleos' => $arraynucleos);	

	}


	public function postEditarProyecto()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{
			$fecha = date("Y-m-d H:i:s");
			$edit=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy', Input::get('ediidproy'))->update(
		    	array(
		    		'nom_proy' => Input::get('edinomproy'),
		    		'alcance' => Input::get('edialcance'),	  
		    		'cod_depto' => Input::get('edidepto'),
		    		'cod_mpio' => Input::get('edimpios'),
		    		'cod_nucleo' => Input::get('edinucleo'),
		    		'id_subcat' => Input::get('edinom_supcate'),
		    		'prec_estim' => Input::get('ediprecio'),
		    		'id_focal' => Input::get('edifocal'),
		    		'estado_proy' => Input::get('ediestado'),
		    		'cofinanc' => Input::get('edicofina'),
		    		'fecha_ingreso' => Input::get('edifecha'),
		    		'id_tipoterr' => Input::get('editipoterr')
		    		//'created_at' => $fecha,
		    		//'updated_at' => $fecha
		    	)
			);

       	if($edit>0){
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('ivsocifichapriorizadaproy')->with('status', 'error_estatus_editar'); 
		}
	}



	public function postDeleteProyecto(){
		$borrar=DB::table('MODART_PIC_PROYPRIORIZ')->where('id_proy',Input::get('deleteproy'))->delete();
		
		if($borrar>0){
			return Redirect::to('plancienrrcargaproy')->with('status', 'ok_estatus_borrar'); 
		} else {
			return Redirect::to('plancienrrcargaproy')->with('status', 'error_estatus_borrar'); 
		}
	}

			
	

}
?>