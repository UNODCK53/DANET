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

		$arraydaild = DB::table('MODART_DAILD_ACUERDOSCOLEC')	
			->select(DB::raw("ISNULL(sum(familias),0) AS familias,ISNULL(sum(hectareas),0) AS has"))
			->where('mpio','=',Input::get('indi'))
			->get();

		$arraydash1 = DB::table('MODART_DASHBOARD')	
			->select('id_dash','valor')
			->where('cod_dane','=',Input::get('indi'))
			->get();

		return array('obra_priori'=>$obra_priori,'coca_simci'=>$coca_simci,'arraydaild'=>$arraydaild,'arraydash1'=>$arraydash1);
			
	}	

public function DiagFamiPreload()
	{
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);

		$nacional=array( count($jsonarray_diag2), count($jsonarray_anexo2));

		$array_usuario=array();
		//almacena del json  los datos de depto para buscarlos y agruparlos
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			//array_push ( $deptosencu[$i] , $jsonarray2[$i]['Cod_Dpto'] );
			$deptosencu[substr($jsonarray_diag2[$i]['Cod_dane'], 0, 2)] = $jsonarray_diag2[$i]['Departamento'];
			$usuarisencu[$jsonarray_diag2[$i]['Usuario']] = $jsonarray_diag2[$i]['Usuario'];			
			array_push($array_usuario ,$jsonarray_diag2[$i]['Usuario']);
		}
		asort($deptosencu);
		asort($usuarisencu);

		$usuarisencusuma=array_count_values($array_usuario);
		asort($usuarisencusuma);
		$usuario=array();
		

		 foreach ($usuarisencusuma as $key => $value) {
		 	$usu=array($key,$value);
		 	array_push ($usuario,$usu);
		 }



		return View::make('moduloart/ivsocicensofamilias',array('nacional' => $nacional,'depto'=>$deptosencu,'usuario'=>$usuarisencu,'usuario_datos'=>json_encode($usuario)));
	}
//inicio Funciones de graficas general
public function postDiagFamiGeneDepto()
	{	
		$depto=Input::get('depto') ;
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if(substr($jsonarray_diag2[$i]['Cod_dane'], 0, 2) ==$depto){
				$deptosencu[$jsonarray_diag2[$i]['Cod_dane']] = $jsonarray_diag2[$i]['Municipio'];
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}
		asort($deptosencu);

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_dane']!='NULL'){
				if(substr($jsonarray_anexo2[$j]['Cod_dane'], 0, 2) ==$depto){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('muni'=>$deptosencu,'depto_val'=>$deptos);
	}

public function postDiagFamiGeneMuni()
	{	
		$depto=Input::get('depto') ;
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if($jsonarray_diag2[$i]['Cod_dane'] ==$depto){
				$deptosencu[$jsonarray_diag2[$i]['Cod_vda']] = $jsonarray_diag2[$i]['Vereda'];
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}
		asort($deptosencu);

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_vda']!='NULL'){
				if($jsonarray_anexo2[$j]['Cod_dane'] ==$depto){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('muni'=>$deptosencu,'depto_val'=>$deptos);
	}	

public function postDiagFamiGeneVda()
	{	
		$depto=Input::get('depto') ;
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if($jsonarray_diag2[$i]['Cod_vda'] ==$depto){
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_vda']!='NULL'){
				if($jsonarray_anexo2[$j]['Cod_vda'] ==$depto){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('depto_val'=>$deptos);
	}
	//fin Funciones de graficas general

//inicio Funciones de graficas usuario

public function postDiagFamiUsuaUsua()
	{	
		$usuario=Input::get('usuario');
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de usuario para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if($jsonarray_diag2[$i]['Usuario']==$usuario){
				$deptosencu[substr($jsonarray_diag2[$i]['Cod_dane'], 0, 2)] = $jsonarray_diag2[$i]['Departamento'];
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}
		asort($deptosencu);

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 
			if($jsonarray_anexo2[$j]['Cod_dane']!='NULL'){
				if($jsonarray_anexo2[$j]['Usuario']==$usuario){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}	
		}

		$deptos=array($num_diagn_depto, $num_anexo_depto);
		return array('depto'=>$deptosencu,'depto_val'=>$deptos);
	}

public function postDiagFamiUsuaDepto()
	{	
		$depto=Input::get('depto') ;
		$usuario=Input::get('usuario');
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if(substr($jsonarray_diag2[$i]['Cod_dane'], 0, 2) ==$depto && $jsonarray_diag2[$i]['Usuario']==$usuario){
				$deptosencu[$jsonarray_diag2[$i]['Cod_dane']] = $jsonarray_diag2[$i]['Municipio'];
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}
		asort($deptosencu);

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_dane']!='NULL'){
				if(substr($jsonarray_anexo2[$j]['Cod_dane'], 0, 2) ==$depto && $jsonarray_anexo2[$j]['Usuario']==$usuario){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('muni'=>$deptosencu,'depto_val'=>$deptos);
	}

public function postDiagFamiUsuaMuni()
	{	
		$depto=Input::get('depto') ;
		$usuario=Input::get('usuario');
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if($jsonarray_diag2[$i]['Cod_dane'] ==$depto && $jsonarray_diag2[$i]['Usuario']==$usuario){
				$deptosencu[$jsonarray_diag2[$i]['Cod_vda']] = $jsonarray_diag2[$i]['Vereda'];
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}
		asort($deptosencu);

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_vda']!='NULL'){
				if($jsonarray_anexo2[$j]['Cod_dane'] ==$depto && $jsonarray_anexo2[$j]['Usuario']==$usuario){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('muni'=>$deptosencu,'depto_val'=>$deptos);
	}	

public function postDiagFamiUsuaVda()
	{	
		$depto=Input::get('depto') ;
		$usuario=Input::get('usuario');
		$jsonarray_diag = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_diagnostico.json'));
		$jsonarray_diag2 = json_decode($jsonarray_diag, true);

		$jsonarray_anexo = utf8_encode (file_get_contents(public_path().'\assets\art\js\encuentas_anexo.json'));
		$jsonarray_anexo2 = json_decode($jsonarray_anexo, true);


		//almacena del json  los datos de depto para buscarlos y agruparlos
		$num_diagn_depto=0;
		for ($i=0; $i < count($jsonarray_diag2); $i++) { 
			if($jsonarray_diag2[$i]['Cod_vda'] ==$depto && $jsonarray_diag2[$i]['Usuario']==$usuario){
				$num_diagn_depto=1+$num_diagn_depto;
			}				
		}

		$num_anexo_depto=0;
		for ($j=0; $j < count($jsonarray_anexo2); $j++) { 

			if($jsonarray_anexo2[$j]['Cod_vda']!='NULL'){
				if($jsonarray_anexo2[$j]['Cod_vda'] ==$depto && $jsonarray_anexo2[$j]['Usuario']==$usuario){
					$num_anexo_depto=1+$num_anexo_depto;
				}
			}
			
		}
		$deptos=array( $num_diagn_depto, $num_anexo_depto);
		return array('depto_val'=>$deptos);
	}
	//fin Funciones de graficas general	
}
?>