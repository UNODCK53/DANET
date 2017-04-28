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
			if(Input::get('coorde')==1){
				if(Input::get('lat_gra')>0){
					$Latitud=(Input::get('lat_gra')+Input::get('lat_min')/60+Input::get('lat_seg')/3600);
				}else{
					$Latitud=(Input::get('lat_gra')-Input::get('lat_min')/60-Input::get('lat_seg')/3600);
				}

				$longitud=(Input::get('long_gra')-Input::get('long_min')/60-Input::get('long_seg')/3600);
					
				
			}else{
				$Latitud=null;
				$longitud=null;
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
		    		'latitud' =>$Latitud,
		    		'longitud' =>$longitud
		    	)
		    );
			if (Input::get('coorde')==1){
				$id=DB::table('MODART_ALERTAS_ALERTA')->max('OBJECTID');

				$insert=DB::statement("UPDATE MODART_ALERTAS_ALERTA  SET Shape = (geometry::STGeomFromText(((('POINT('+CONVERT([varchar](20), longitud,(0)))+' ')+CONVERT([varchar](20), latitud,(0)))+')',(4326))) WHERE OBJECTID =". $id);
			}		


		return Redirect::to('ivsocidashboard');		
	}	

	public function Preload()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		
		//LOAD ALERTAS

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


		$alerta = DB::table('MODART_ALERTAS_ALERTA')
			
			->select('MODART_ALERTAS_CATEGORIA.nombre as categoria','MODART_ALERTAS_SUBCATEGORIA.nombre as subcategoria','MODART_ALERTAS_SUBSUBCATE.nombre as subsubcateg','descripcion',DB::raw("CONVERT(VARCHAR,MODART_ALERTAS_ALERTA.created_at,120) as created_at"),DB::raw("concat(users.name,' ',users.last_name)as USUARIO"),'SEMAFORO')
			->join('MODART_ALERTAS_CATEGORIA','MODART_ALERTAS_CATEGORIA.id','=','MODART_ALERTAS_ALERTA.categoria')
			->join('MODART_ALERTAS_SUBCATEGORIA','MODART_ALERTAS_SUBCATEGORIA.id','=','MODART_ALERTAS_ALERTA.subcategoria')
			->leftJoin('MODART_ALERTAS_SUBSUBCATE','MODART_ALERTAS_SUBSUBCATE.id','=','MODART_ALERTAS_ALERTA.subsubcateg') 
			->join('users','users.id','=','MODART_ALERTAS_ALERTA.USUARIO')	
			->where ('users.id','!=',1)
			->orderby('created_at','desc')
			->take(100)
			->get();

		//LOAD INFO PIC

		$obra_priori=DB::table('MODART_PIC_PROYPRIORIZ')
			->count();
			
			

		// LOAD INFO CULTIVOS ILICITOS
		$coca_simci=DB::table('MUNICIPIOS')
			->select(DB::raw('round(C_2015,2)as C_2015'))			
			->sum('C_2015');

		//LOAD INFO PARA MUNICIPIOS

		$datos_muni=DB::table('MUNICIPIOS')
			->select('PDET','ZVTN','DAILCD','COD_DANE')
			->where('PDET','!=',0)
			->orWhere('ZVTN', '!=',0)
			->orWhere('DAILCD', '!=',0)
			->get();	

			$categoria=array_map(create_function('$item','return $item->categoria;'),$alerta);//extract value from object query
			$subcategoria=array_map(create_function('$item','return $item->subcategoria;'),$alerta);//extract value from object query
			$subsubcateg=array_map(create_function('$item','return $item->subsubcateg;'),$alerta);//extract value from object query
			$descripcion=array_map(create_function('$item','return $item->descripcion;'),$alerta);//extract value from object query
			$created_at=array_map(create_function('$item','return $item->created_at;'),$alerta);//extract value from object query
			$USUARIO=array_map(create_function('$item','return $item->USUARIO;'),$alerta);//extract value from object query
			$SEMAFORO=array_map(create_function('$item','return $item->SEMAFORO;'),$alerta);//extract value from object query
			$array_alerta=array($categoria,$subcategoria,$subsubcateg,$descripcion,$created_at,$USUARIO,$SEMAFORO);

			$num_alerta = DB::table('MODART_ALERTAS_ALERTA')->where ('usuario','!=',1)->count();

		return View::make('moduloart.ivsocidashboard', array('arraycate' => $result_cate,'arraysubcate' => $SUBCATEGORIA,'arraysubsubcate'=>$arraysubsubcate,'array_alerta'=>$array_alerta,'num_alerta'=>$num_alerta,'datos_muni'=>$datos_muni,'obra_priori'=>$obra_priori,'coca_simci'=>$coca_simci));		
	}
	

public function postPic()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		$obra_priori=DB::table('MODART_PIC_PROYPRIORIZ')
			->where('cod_mpio','=',Input::get('indi'))
			->count();

		$coca_simci=DB::table('MUNICIPIOS')
			->select(DB::raw('round(C_2015,2)as C_2015'))
			->where('COD_DANE','=',Input::get('indi'))
			->sum('C_2015');

		return array('obra_priori'=>$obra_priori,'coca_simci'=>$coca_simci);
			
	}	

public function DiagFamiPreload()
	{
		
		return View::make('moduloart/ivsocicensofamilias');
	}

public function DiagFamiReporte()
	{
			
		//$ruta="W:\\WEBS\\danet\\public\\RPortable";
		$ruta="C:\\xampp\\htdocs\\DANET\\public\\RPortable";
		$rstudio = $ruta.'\\App\\R-Portable\\bin\\x64\\Rscript.exe '.$ruta.'\\prog_correr\\art\\encuestas\\knit_R_encuetas.R ';
		$shellresult = shell_exec($rstudio);

		

	
		
	}

}
?>