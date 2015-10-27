<?php

class DocumentosController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function CarguedocuInicio()
	{
		//retornamos las categorias apenas entramos a la vista de cargue documentos
		$categoria = DB::table('MODDOCUMENTOS_CATEGORIA')		
		->select('id_categoria', 'categoria')
		->get();

		$estrategia = DB::table('ESTRATEGIA_INTERVENCION')		
		->select('id_estrategia', 'estrategia')
		->orderBy ('ano', 'desc') 
		->get();		

		$unidadgeo = DB::table('MODDOCUMENTOS_UNIGEO')		
		->select('id_ugeo', 'unidgeo')
		->get();

		$autor = DB::table('MODDOCUMENTOS_AUTORDOCU')	
		->select('id_autor', 'autor')
		->get();
		
		$depto = DB::table('MODSISCADI_VEREDAS')	
		->select('COD_DPTO', 'NOM_DPTO')
		->groupBy ('COD_DPTO', 'NOM_DPTO')
		->get();		

		$arrayiniciales=array($categoria, $estrategia, $unidadgeo, $autor, $depto);

		return View::make('modulodocumentos.carguedocumentos', array('arrayiniciales' => $arrayiniciales));
	}	
	public function postSubcategoria()
	{
		//Aqui podemos listar las subcategoria de la categoria seleccionada
		$subcategoria = DB::table('MODDOCUMENTOS_TIPODOCU')		
		->where('id_categoria','=',Input::get('categoria'))
		->select('id_tipo', 'id_categoria', 'tipo')		
		->get();

		$momento = DB::table('MODDOCUMENTOS_MOMENTO')		
		->where('id_categoria','=',Input::get('categoria'))
		->select('id_momento', 'id_categoria', 'momento')		
		->get();

		$arrayajax=array($subcategoria, $momento);		
		return Response::json($arrayajax);
	}
	public function postSubmpio()
	{
		//Aqui podemos listar las veredas del DEPTO seleccionado
		$submpio = DB::table('MODSISCADI_VEREDAS')		
		->where('COD_DPTO','=',Input::get('depto'))
		->select('COD_DANE', 'NOM_MPIO')
		->groupBy ('COD_DANE', 'NOM_MPIO')
		->get();
			
		return Response::json($submpio);
	}
	public function postAdjuntarDocu()
	{	
		$proyrespons = DB::table('MODDOCUMENTOS_PROYRESPONS')		
		->where('proyectoresponsable','=',Auth::user()->proyecto)
		->select('id_proyresponsable', 'proyectoresponsable')
		->get();



		$path = public_path().'\moddocs\\'.$proyrespons[0]->proyectoresponsable;
		// creacion de carpeta dependiendo del nombre del proceso
		if (File::exists($path)){						
		}
		else{
			File::makeDirectory($path,  $mode = 0777, $recursive = false);	
		}

		$categoria = DB::table('MODDOCUMENTOS_CATEGORIA')		
		->where('id_categoria','=',Input::get('selectcategoria'))
		->select('id_categoria', 'siglas_categoria')
		->get();

		$path2 = $path.'\\'.$categoria[0]->siglas_categoria;		

		if (File::exists($path2)){						
		}
		else{
			File::makeDirectory($path2,  $mode = 0777, $recursive = false);	
		}

		$tipodocu = DB::table('MODDOCUMENTOS_TIPODOCU')		
		->where('id_tipo','=',Input::get('selectipodocu'))
		->select('id_tipo', 'siglas_categoria')
		->get();

		$momento = DB::table('MODDOCUMENTOS_MOMENTO')		
		->where('id_momento','=',Input::get('selectipodocu'))
		->select('id_momento', 'siglas_momento')
		->get();

		$path3 = $path2.'\\'.$tipodocu[0]->siglas_categoria;		

		if (File::exists($path3)){						
		}
		else{
			File::makeDirectory($path3,  $mode = 0777, $recursive = false);	
		}
	
		$nombredocumento = $categoria[0]->siglas_categoria.'_'.Input::get('selectestrategia').'_'.$tipodocu[0]->siglas_categoria.'_'.$momento[0]->siglas_momento.'_';
		
		
		if(Input::hasFile('filedocu')) {
			Input::file('filedocu')->move($path3,$categoria[0]->siglas_categoria.'_'.Input::get('selectestrategia').'_'.$tipodocu[0]->siglas_categoria.'_'.$momento[0]->siglas_momento.'_'.'.'.Input::file('filedocu')->getClientOriginalExtension());
    		$fecha = date("Y-m-d H:i:s");    		
    		DB::table('MODDOCUMENTOS_MASTERDOCU')->insert(
		    	array(
		    		'fecha' => Input::get('selectfechadocu'),
		    		'nombredocu' => $nombredocumento,
		    		'autor' => Input::get('selectautor'),
		    		'categoria' => Input::get('selectcategoria'),
		    		'tipo' => Input::get('selectipodocu'),
		    		'momento' => Input::get('selecmomento'),
		    		'ugeo' => Input::get('selecunigeo'),
		    		'estrategia' => Input::get('selectestrategia'),
		    		'ruta' => $path3,
		    		'fechacarguedocu' => $fecha,		    				    		
	    			'usercargue' => Auth::user()->id
		    	)
			);				
       		return Redirect::to('cargue_docu')->with('status', 'ok_estatus');
    	}
    	return Redirect::to('cargue_docu')->with('status', 'error_estatus');
    }
    		
}
?>