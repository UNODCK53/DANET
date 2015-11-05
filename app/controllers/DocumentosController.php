<?php

class DocumentosController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function CarguedocuInicio()
	{
		if (((Auth::user()->grupo==1) OR (Auth::user()->grupo==6))AND (Auth::user()->level==1)) {
			//retornamos las categorias apenas entramos a la vista de cargue documentos
			$categoria = DB::table('MODDOCUMENTOS_CATEGORIA')		
			->select('id_categoria', 'categoria')
			//->where ('responsable', '=', Auth::user()->proyecto)
			->get();
					
		} else {
			//retornamos las categorias apenas entramos a la vista de cargue documentos
			$accesoescritura = DB::table('MODDOCUMENTOS_USERREADWRITE')
			->select('id_tipodocu')
			->where ('id_user','=', Auth::user()->id)
			->where ('carga','=','1')
			->get();
		
			$tipodocu='SELECT id_categoria FROM MODDOCUMENTOS_TIPODOCU WHERE';
			for ($i=0; $i < count($accesoescritura); $i++) { 
				$tipodocu= $tipodocu.' id_tipo = '.$accesoescritura[$i]->id_tipodocu;
				if ($i != count($accesoescritura)-1) {
					$tipodocu= $tipodocu.' OR ';
				}
			}			
            $tipodocu= $tipodocu.' group by id_categoria';

			$tipoducuselect = DB::select($tipodocu);
		
		

			$categoriaselect='SELECT id_categoria, categoria FROM MODDOCUMENTOS_CATEGORIA WHERE';
			for ($i=0; $i < count($tipoducuselect); $i++) { 
				$categoriaselect= $categoriaselect.' id_categoria = '.$accesoescritura[$i]->id_tipodocu;
				if ($i != count($tipoducuselect)-1) {
					$categoriaselect= $categoriaselect.' OR ';
				}
			}
			$categoria = DB::select($categoriaselect);					
		}
		
		$estrategia = DB::table('ESTRATEGIA_INTERVENCION')		
		->select('id_estrategia', 'estrategia')		
		->get();		

		$unidadgeo = DB::table('MODDOCUMENTOS_UNIGEO')		
		->select('id_ugeo', 'unidgeo')
		->get();

		$autor = DB::table('MODDOCUMENTOS_AUTORDOCU')	
		->select('id_autor', 'autor')
		->get();
			
		$depto = DB::table('DEPARTAMENTOS')	
		->select('COD_DPTO', 'NOM_DPTO')		
		->get();		

		$arrayiniciales=array($categoria, $estrategia, $unidadgeo, $autor, $depto);	

		return View::make('modulodocumentos.carguedocumentos', array('arrayiniciales' => $arrayiniciales));
		
		
	}	
	public function postSubcategoria()
	{
		if (((Auth::user()->grupo==1) OR (Auth::user()->grupo==6))AND (Auth::user()->level==1)) {
			$subcategoria = DB::table('MODDOCUMENTOS_TIPODOCU')		
			->where('id_categoria','=',Input::get('categoria'))
			->select('id_tipo', 'id_categoria', 'tipo')		
			->get();
		} else {

			$accesoescritura = DB::table('MODDOCUMENTOS_USERREADWRITE')
			->select('id_tipodocu')
			->where ('id_user','=', Auth::user()->id)
			->where ('carga','=','1')
			->get();

			$tipodocu='SELECT id_tipo, id_categoria, tipo FROM MODDOCUMENTOS_TIPODOCU WHERE ' ;
			for ($i=0; $i < count($accesoescritura); $i++) { 
				$tipodocu= $tipodocu.' id_tipo = '.$accesoescritura[$i]->id_tipodocu;
				if ($i != count($accesoescritura)-1) {
					$tipodocu= $tipodocu.' OR ';
				}
			}			
            
            $tipodocu= $tipodocu.'AND id_categoria ='.Input::get('categoria');
			$subcategoria = DB::select($tipodocu);			
		}		

		$momento = DB::table('MODDOCUMENTOS_MOMENTO')		
		->where('id_categoria','=',Input::get('categoria'))
		->select('id_momento', 'id_categoria', 'momento')		
		->get();

		$arrayajax=array($subcategoria, $momento);		
		return Response::json($arrayajax);
	}

	public function postSelbloque()
	{
		$arrayajax2 = DB::table('BLOQUE_MODALIDAD')		
		->where('id_estrategia','=',Input::get('estrategia'))
		->select('id_bloque', 'bloque_modalidad')			
		->get();			
		return Response::json($arrayajax2);
	}
	public function postSubmpio()
	{
		//Aqui podemos listar las veredas del DEPTO seleccionado
		$submpio = DB::table('MUNICIPIOS')		
		->where('COD_DPTO','=',Input::get('depto'))
		->select('COD_DANE', 'NOM_MPIO')
		->groupBy ('COD_DANE', 'NOM_MPIO')
		->get();
			
		return Response::json($submpio);
	}
	public function postAdjuntarDocu()
	{	
		$path1 = DB::table('MODDOCUMENTOS_CATEGORIA')		
		->where('id_categoria','=',Input::get('selectcategoria'))
		->select('rutadecarpeta')
		->get();

		$path=public_path().$path1[0]->rutadecarpeta;

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
		->select('id_momento')
		->get();

		$path3 = $path2.'\\'.$tipodocu[0]->siglas_categoria;		

		if (File::exists($path3)){						
		}
		else{
			File::makeDirectory($path3,  $mode = 0777, $recursive = false);	
		}	

		if(Input::hasFile('filedocu')) {
			$selectmpios=Input::get('selectmpios');		   		
    		$fecha = date("Y-m-d H:i:s");
			$idmaximo =  DB::table('MODDOCUMENTOS_MASTERDOCU')->max('id_documento');
			
			if (Input::get('selectcategoria')== 1) {
				$nombredocumento = $categoria[0]->siglas_categoria.'_'.$tipodocu[0]->siglas_categoria.'_'.Input::get('selectestrategia').'_'.Input::get('selectbloque').'_'.Input::get('selecmomento').'_'.($idmaximo+1).'.'.Input::file('filedocu')->getClientOriginalExtension();
			} else if ((Input::get('selectestrategia')=='') AND (Input::get('selectcategoria')== 2)) {			
				$nombredocumento = $categoria[0]->siglas_categoria.'_'.$tipodocu[0]->siglas_categoria.'_'.Input::get('selecmomento').'_'.($idmaximo+1).'.'.Input::file('filedocu')->getClientOriginalExtension();
			} else {
				$nombredocumento = Input::file('filedocu')->getClientOriginalName();
			}

			Input::file('filedocu')->move($path3,$nombredocumento);
    		
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
		    		'bloque' => Input::get('selectbloque'),
		    		'ruta' => $path3,
		    		'fechacarguedocu' => $fecha,		    				    		
	    			'usercargue' => Auth::user()->id
		    	)
			);
    		if (Input::get('selecunigeo')==3) {
    			
    			for ($i=0; $i < count($selectmpios) ; $i++) { 
    				DB::table('MODDOCUMENTOS_UNIGEODEPTOMUNI')->insert(
				    	array(
				    		'id_documento' => $idmaximo+1,
				    		'COD_DEPTO' => Input::get('selecdepto'),
				    		'COD_DANE' => $selectmpios[$i]		    		
				    	)
					);
    			}

    		} else if(Input::get('selecunigeo')==2){
    			DB::table('MODDOCUMENTOS_UNIGEODEPTOMUNI')->insert(
			    	array(
			    		'id_documento' => $idmaximo+1,
			    		'COD_DEPTO' => Input::get('selecdepto')		    				    		
			    	)
		    	);
    		} else if(Input::get('selecunigeo')==1){
	    		DB::table('MODDOCUMENTOS_UNIGEODEPTOMUNI')->insert(
			    	array(
			    		'id_documento' => $idmaximo+1,
			    		'COD_DEPTO' => '00'
			    	)
				);
    		}							
       		return Redirect::to('cargue_docu')->with('status', 'ok_estatus');
    	}
    	return Redirect::to('cargue_docu')->with('status', 'error_estatus');
    }
    		
}
?>