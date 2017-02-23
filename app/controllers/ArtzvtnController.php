<?php

class ArtzvtnController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function zvtn_indicadores()//funcion que precarga los datos de los indicadores  veredales y las categorias
	{    
		
			//retornamos las categorias apenas entramos a la vista de cargue documentos
			$metodo = DB::table('MODART_METODO')
			->select('id','nombre')
			->get();
			$arraymetodo['']='Seleccione uno';
			foreach($metodo as $pro)
			{
				$arraymetodo[$pro->id] = $pro->nombre;
			}

			$categoria = DB::table('MODART_CATEGORIA')
			->select('id','nombre')
			->get();
			$arraycategoria['']='Seleccione una';
			foreach($categoria as $pro)
			{
				$arraycategoria[$pro->id] = $pro->nombre;
			}

			$periodo = DB::table('MODART_PERIODICIDAD')
			->select('id','nombre')
			->get();
			$arrayperiodo['']='Seleccione una';
			foreach($periodo as $pro)
			{
				$arrayperiodo[$pro->id] = $pro->nombre;
			}


			$arraypidnicadores = DB::table('MODART_INDICADORES')	
			->select(DB::raw("MODART_INDICADORES.id as id,MODART_INDICADORES.nombre as nombre,concat(name,' ',last_name) as id_responsable ,MODART_CATEGORIA.nombre as id_categoria,MODART_PERIODICIDAD.nombre as id_period,MODART_METODO.nombre as id_metodo,MODART_TABLERO.nombre as id_tablero,c2,c3,c4,dia_semana,MODART_INDICADORES.created_at"))
			->join('users','users.id','=','MODART_INDICADORES.id_responsable')
			->join('MODART_CATEGORIA','MODART_CATEGORIA.id','=','MODART_INDICADORES.id_categoria')
			->join('MODART_PERIODICIDAD','MODART_PERIODICIDAD.id','=','MODART_INDICADORES.id_period')
			->join('MODART_METODO','MODART_METODO.id','=','MODART_INDICADORES.id_metodo')
			->join('MODART_TABLERO','MODART_TABLERO.id','=','MODART_INDICADORES.id_tablero')
			->get();	


			


		return View::make('moduloart.zvcargaindicador', array('arraymetodo' => $arraymetodo,'arraycategoria' => $arraycategoria,'arrayperiodo' => $arrayperiodo,'arraypidnicadores' => $arraypidnicadores,'categoria'=>$categoria));		
	}	


	public function postTablaindi()//funcion que precarga los datos de indicadores para su edicion
	{    
		
	

			$arraypidnicadores = DB::table('MODART_INDICADORES')	
			->select(DB::raw("MODART_INDICADORES.id as id,MODART_INDICADORES.nombre as nombre,concat(name,' ',last_name) as id_responsable ,id_categoria, id_period,id_metodo,id_tablero,c2,c3,c4,dia_semana,MODART_INDICADORES.created_at"))
			->join('users','users.id','=','MODART_INDICADORES.id_responsable')
			->where('MODART_INDICADORES.id','=', Input::get('indi'))
			->get();	

		return $arraypidnicadores;	

}
	public function postEditindia()//funcion que actualiza los indicadores 
	{    
			

			$fecha = date("Y-m-d H:i:s");
						if (Input::get('metodoedi')==2){
							$c2=str_replace(" días", "", Input::get('edirangos-value-1'));
							$c3=str_replace(" días", "", Input::get('edirangos-value-2'));
							$c4=str_replace(" días", "", Input::get('edirangos-value-3'));
						}else if (Input::get('metodoedi')==1){
							$c2=str_replace("%", "", Input::get('edirangos-value-1'));
							$c3=str_replace("%", "", Input::get('edirangos-value-2'));
							$c4=str_replace("%", "", Input::get('edirangos-value-3'));
						}else{
							$c2=null;
							$c3=null;
							$c4=null;
						}

				DB::table('MODART_INDICADORES_HISTO')->insert(
			    	array(
			    		'id_indi' => Input::get('idindiedi'),
			    		'nombre' => Input::get('nomindiedi'),
			    		'id_responsable' => Auth::user()->id,
			    		'id_categoria' => Input::get('categoedi'),
			    		'id_period' => Input::get('periodoedi'),
			    		'dia_semana' => Input::get('radioperidiocidadidedi'),
			    		'id_metodo' =>  Input::get('metodoedi'),
			    		'id_tablero' => Input::get('Tableroedi'),
			    		'c1' =>0,
			    		'c2' => $c2,
			    		'c3' => $c3,
			    		'c4' => $c4,	 
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);



	    		$edit=DB::table('MODART_INDICADORES')->where('id', Input::get('idindiedi'))->update(
			    	array(
			    		
			    		'nombre' => Input::get('nomindiedi'),
			    		'id_categoria' => Input::get('categoedi'),
			    		'id_period' => Input::get('periodoedi'),
			    		'dia_semana' => Input::get('radioperidiocidadidedi'),
			    		'id_metodo' =>  Input::get('metodoedi'),
			    		'id_tablero' => Input::get('Tableroedi'),
			    		'c1' =>0,
			    		'c2' => $c2,
			    		'c3' => $c3,
			    		'c4' => $c4,	 
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);
			

		if($edit>0){
			return Redirect::to('zvtn_indicadores')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('zvtn_indicadores')->with('status', 'error_estatus_editar'); 
		} 	
		
	}


	public function postCrearIndicador()//funcion que inserta los nuevos indeicadores y crea cada indicador en las cada zona veredal
	{	

			$fecha = date("Y-m-d H:i:s");
			if (Input::get('metodo')==2){
				$c2=str_replace(" días", "", Input::get('rangos-value-1'));
				$c3=str_replace(" días", "", Input::get('rangos-value-2'));
				$c4=str_replace(" días", "", Input::get('rangos-value-3'));
			}else if (Input::get('metodo')==1){
				$c2=str_replace("%", "", Input::get('rangos-value-1'));
				$c3=str_replace("%", "", Input::get('rangos-value-2'));
				$c4=str_replace("%", "", Input::get('rangos-value-3'));
			}else{
				$c2=null;
				$c3=null;
				$c4=null;
			}
			

    		$insert=DB::table('MODART_INDICADORES')->insert(//ingresa los indicadores genenales
		    	array(
		    		'nombre' => Input::get('nomindi'),
		    		'id_responsable' => Auth::user()->id,
		    		'id_categoria' => Input::get('catego'),
		    		'id_period' => Input::get('periodo'),
		    		'dia_semana' => Input::get('radioperidiocidadid'),
		    		'id_metodo' =>  Input::get('metodo'),
		    		'id_tablero' => Input::get('Tablero'),
		    		'c1' =>0,
		    		'c2' => $c2,
		    		'c3' => $c3,
		    		'c4' => $c4,	 
		    		//'created_at' => $fecha,
	    			//'updated_at' => $fecha				    		
	    			
		    	)
			);

			
			$id_indi =  DB::table('MODART_INDICADORES')->max('id');

    		$zv = DB::table('MODART_ZVT')
			->select('id_zona')
			->get();
			
			foreach($zv as $pro)
			{
	    		DB::table('MODART_SEG_INDICADOR')->insert(//ingresa los inidicadores para cada zona veredal
			    	array(
			    		'id_indicador' => $id_indi,
			    		'id_responsable' => Auth::user()->id,
			    		'id_zv' => $pro->id_zona,
			    		'valor' =>0,
			    		'fecha_ini' =>'',
			    		'meta_parc' => 0,
			    		'meta_total' =>0 
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);
			}

			if($insert>0){
			return Redirect::to('zvtn_indicadores')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('zvtn_indicadores')->with('status', 'error_estatus'); 
		}
    	
    }

    public function postCrearCategoria()//funcion que crea las nuevas categorias de indicadores
	{	
    		$insert=DB::table('MODART_CATEGORIA')->insert(
		    	array(
		    		'nombre' => Input::get('nomcate'),
		    			    		
	    			
		    	)
			);

       	if($insert>0){
			return Redirect::to('zvtn_indicadores')->with('status', 'ok_estatus'); 
		} else {
			return Redirect::to('zvtn_indicadores')->with('status', 'error_estatus'); 
		}
    	
    }

    public function postTablacate()//funcion que precarga los datos de indicadores para su edicion
	{    
		
	

			$arraypidnicadores = DB::table('MODART_CATEGORIA')	
			->select('id','nombre')
			->where('MODART_CATEGORIA.id','=', Input::get('cate'))
			->get();	

		return $arraypidnicadores;	

	}

	public function postEditcate()//funcion que precarga los datos de indicadores para su edicion
	{    
		$fecha = date("Y-m-d H:i:s");
		$Edit=DB::table('MODART_CATEGORIA')->where('id', Input::get('editcate'))->update(
			    	array(
			    		
			    		'nombre' => Input::get('editnomcate')
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);
			

		if($Edit>0){
			return Redirect::to('zvtn_indicadores')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('zvtn_indicadores')->with('status', 'error_estatus_editar'); 
		}	

	}


    public function zvtn_seguimiento()//funcion que precarga los datos de la paguina de seguimineto de indicadores por zona veredal
	{    

			$indicadores = DB::select('select MODART_INDICADORES.id as id,MODART_INDICADORES.nombre as nombre, MODART_CATEGORIA.nombre as cate from MODART_INDICADORES,MODART_CATEGORIA where MODART_INDICADORES.id_categoria=MODART_CATEGORIA.id order by MODART_CATEGORIA.nombre' );
		
			$categorias = DB::select('select MODART_CATEGORIA.nombre as cate, MODART_CATEGORIA.id as id from MODART_INDICADORES,MODART_CATEGORIA where MODART_INDICADORES.id_categoria=MODART_CATEGORIA.id  group by MODART_CATEGORIA.nombre, MODART_CATEGORIA.id order by MODART_CATEGORIA.nombre' );
			$result = array();
			foreach($categorias as $depot){
			   $result[$depot->cate][] = $depot->id;
			}


			$arraysegidicadores = DB::table('MODART_SEG_INDICADOR')	
			->select(DB::raw("concat(name,' ',last_name) as id_responsable,MODART_INDICADORES.nombre as nombre, MODART_ZVT.Nombre as id_zv,valor,MODART_INDICADORES.id_categoria as id_categoria,id_metodo,id_tablero"))
			->join('users','users.id','=','MODART_SEG_INDICADOR.id_responsable')
			->join('MODART_INDICADORES','MODART_INDICADORES.id','=','MODART_SEG_INDICADOR.id_indicador')			
			->join('MODART_ZVT','MODART_ZVT.id_zona','=','MODART_SEG_INDICADOR.id_zv')	
			->get();	


		
		return View::make('moduloart.zvsegindicador', array('indicadores'=>$indicadores,'categorias'=>$result,'arraysegidicadores'=>$arraysegidicadores));		
	}


    public function postTablaseguiindi()//funcion que precarga los datos del seguimiento de indicadores para cada zona veredal
	{    
		
			
			$arraysegidicadores = DB::table('MODART_INDICADORES')	

			->select(DB::raw("concat(MODART_INDICADORES.id,MODART_SEG_INDICADOR.id_zv) as id,MODART_INDICADORES.nombre as nombre,concat(name,' ',last_name) as id_responsable,MODART_ZVT.Nombre as id_zv,MODART_CATEGORIA.nombre as id_categoria,MODART_METODO.nombre as metodo ,MODART_SEG_INDICADOR.valor as valor,MODART_SEG_INDICADOR.meta_parc as meta_parc,MODART_SEG_INDICADOR.meta_total as meta_total,CONVERT(VARCHAR(10),MODART_SEG_INDICADOR.fecha_ini,103) as fecha_ini"))
			->join('users','users.id','=','MODART_INDICADORES.id_responsable')
			->join('MODART_CATEGORIA','MODART_CATEGORIA.id','=','MODART_INDICADORES.id_categoria')
			->join('MODART_PERIODICIDAD','MODART_PERIODICIDAD.id','=','MODART_INDICADORES.id_period')
			->join('MODART_METODO','MODART_METODO.id','=','MODART_INDICADORES.id_metodo')
			->join('MODART_TABLERO','MODART_TABLERO.id','=','MODART_INDICADORES.id_tablero')
			->join('MODART_SEG_INDICADOR','MODART_SEG_INDICADOR.id_indicador','=','MODART_INDICADORES.id')	
			->join('MODART_ZVT','MODART_ZVT.id_zona','=','MODART_SEG_INDICADOR.id_zv')		
			->where('MODART_INDICADORES.id','=',Input::get('indi'))
			->get();

		return $arraysegidicadores;		
	}


	public function postEditseguiindi()//funcion que actualiza los indicadores de cada zona veredal
	{    
			

			$arraysegidicadores = DB::table('MODART_SEG_INDICADOR')	
			->select('id_indicador','id_zv','valor','fecha_ini')
			->where('id_indicador','=',Input::get('id_indi'))
			->get();

			foreach($arraysegidicadores as $pro)
			{
	    		DB::table('MODART_SEG_HISTORICO')->insert(
			    	array(
			    		
			    		'id_indicador' =>$pro->id_indicador,
			    		'id_zv' => $pro->id_zv,
			    		'valor' => $pro->valor,
			    		'fecha_hoy' => $pro->fecha_ini,
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);
			}


			$zv = DB::table('MODART_ZVT')
			->select('id_zona')
			->get();
			foreach($zv as $pro)
			{

	    		$Edit=DB::table('MODART_SEG_INDICADOR')->where('id_indicador', Input::get('id_indi'))->where('id_zv', $pro->id_zona)->update(
			    	array(
			    		
			    		'valor' =>Input::get('valor'.Input::get('id_indi').$pro->id_zona),
			    		'fecha_ini' =>Input::get('fecha_ini'.Input::get('id_indi').$pro->id_zona),
			    		'meta_parc' => Input::get('meta_parc'.Input::get('id_indi').$pro->id_zona),
			    		'meta_total' =>Input::get('meta_total'.Input::get('id_indi').$pro->id_zona),
			    		//'created_at' => $fecha,
		    			//'updated_at' => $fecha
			    	)
				);
			}

		if($Edit>0){
			return Redirect::to('zvtn_seguimiento')->with('status', 'ok_estatus_editar'); 
		} else {
			return Redirect::to('zvtn_seguimiento')->with('status', 'error_estatus_editar'); 
		}	
	}

}
?>