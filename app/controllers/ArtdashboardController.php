<?php

class ArtdashboardController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function postNuevaAlerta()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		
			$fecha = date("d-m-Y H:i:s");

			$SUBCATEGORIA = DB::table('MODART_ALERTAS_SUBCATEGORIA')
			->select('id_cat')
			->orderby('nombre','asc')
			->where('id','=', Input::get('nom_subcate'))
			->get();
			foreach($SUBCATEGORIA as $pro)
			{
				 $result_cate = $pro->id_cat;
			}
			if(Input::get('subsubcate')==''){
				$subsubcate=null;
			}else{
				$subsubcate=Input::get('subsubcate');
			}
			$insert=DB::table('MODART_ALERTAS_ALERTA')->insert(
		    	array(
		    		'categoria' => $result_cate,
		    		'subcategoria' => Input::get('nom_subcate'),	  
		    		'subsubcateg' => $subsubcate,
		    		'descripcion' => Input::get('descripcion'),
		    		'USUARIO' => Auth::user()->id,
		    		'SEMAFORO' => Input::get('semaforo'),
		    		'created_at' => $fecha,
		    	)
		    );
			


		return View::make('ivsocidashboard');		
	}	

	public function Preload()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		

		$CATEGORIA = DB::table('MODART_ALERTAS_CATEGORIA')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$result_cate = array();
			foreach($CATEGORIA as $pro)
			{
				 $result_cate[$pro->id][] = $pro->nombre;
			}	

		$SUBCATEGORIA = DB::table('MODART_ALERTAS_SUBCATEGORIA')
			->select('id','id_cat','nombre')
			->orderby('nombre','asc')
			->get();

		$subsubcate = DB::table('MODART_ALERTAS_SUBSUBCATE')
			->select('id','nombre')
			->orderby('nombre','asc')
			->get();
			$arraysubsubcate['']='Seleccione uno';
			foreach($subsubcate as $pro)
			{
				$arraysubsubcate[$pro->id] = $pro->nombre;
			}	

		return View::make('moduloart.ivsocidashboard', array('arraycate' => $result_cate,'arraysubcate' => $SUBCATEGORIA,'arraysubsubcate'=>$arraysubsubcate));		
	}
	



}
?>