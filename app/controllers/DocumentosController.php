<?php

class DocumentosController extends BaseController {
	
	public function __construct()
	{
		$this->beforeFilter('auth');  //bloqueo de acceso
	}
	public function CarguedocuInicio()
	{    
		if (((Auth::user()->grupo==1) OR (Auth::user()->grupo==6)) AND (Auth::user()->level==1)) {
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
				$categoriaselect= $categoriaselect.' id_categoria = '.$tipoducuselect[$i]->id_categoria;
				if ($i != count($tipoducuselect)-1) {
					$categoriaselect= $categoriaselect.' OR ';
				}
			}
			$categoria = DB::select($categoriaselect);
		}

		$unidadgeo = DB::table('MODDOCUMENTOS_UNIGEO')		
		->select('id_ugeo', 'unidgeo')
		->get();		
			
		$depto = DB::table('DEPARTAMENTOS')	
		->select('COD_DPTO', 'NOM_DPTO')		
		->get();		

		$arrayiniciales=array($categoria, $unidadgeo, $depto);	

		return View::make('modulodocumentos.carguedocumentos', array('arrayiniciales' => $arrayiniciales));		
	}	
	public function postSubcategorias()
	{
		if (((Auth::user()->grupo==1) OR (Auth::user()->grupo==6))AND (Auth::user()->level==1)) {
			$subcategoria = DB::table('MODDOCUMENTOS_TIPODOCU')		
			->where('id_categoria','=',Input::get('categoria'))
			->select('id_tipo', 'id_categoria', 'tipo')	
			->orderby ('tipo')	
			->get();
		} else {

			$accesoescritura = DB::table('MODDOCUMENTOS_USERREADWRITE')
			->select('id_tipodocu')
			->where ('id_user','=', Auth::user()->id)
			->where ('carga','=','1')
			->get();

			$tipodocu='SELECT id_tipo, id_categoria, tipo FROM MODDOCUMENTOS_TIPODOCU WHERE ( ' ;
			for ($i=0; $i < count($accesoescritura); $i++) { 
				$tipodocu= $tipodocu.' id_tipo = '.$accesoescritura[$i]->id_tipodocu;
				if ($i != count($accesoescritura)-1) {
					$tipodocu= $tipodocu.' OR ';
				}
			}			
            
            $tipodocu= $tipodocu.') AND id_categoria ='.Input::get('categoria');
			$subcategoria = DB::select($tipodocu);						
		}

		$proyecto = DB::table('MODDOCUMENTOS_PROYECTO')		
		->where('id_categoria','=',Input::get('categoria'))
		->select('id_proyecto')		
		->get();

		$contraparte = DB::table('MODDOCUMENTOS_CONTRAPARTE')		
		->where('id_categoria','=',Input::get('categoria'))
		->select('id_contraparte', 'contrapate')		
		->get();

		$estrategia = DB::table('MODDOCUMENTOS_CATEGESTRAT')
		->where('id_categoria','=',Input::get('categoria'))		
		->select('id_estrategia', 'estrategia')		
		->get();

		$arrayajax=array($proyecto, $contraparte, $subcategoria, $estrategia);		
		return Response::json($arrayajax);		
		
	}

	public function postSelbloqmodmomen()
	{
		$bloquemod = DB::table('BLOQUE_MODALIDAD')		
		->where('id_estrategia','=',Input::get('estrategia'))
		->select('id_bloque', 'bloque_modalidad')			
		->get();
		
		$momento = DB::table('MODDOCUMENTOS_MOMENTO')		
		->where('id_estrategia','=',Input::get('estrategia'))
		->select('id_momento', 'momento')		
		->get();

		$arrayajax2=array($bloquemod, $momento);
		return Response::json($arrayajax2);	
	}
	public function postSubmpio()
	{
		//Aqui podemos listar las veredas del DEPTO seleccionado
		$submpio = DB::table('MUNICIPIOS')		
		->where('COD_DPTO','=',Input::get('depto'))
		->select('COD_DANE', 'NOM_MPIO')
		->groupBy ('COD_DANE', 'NOM_MPIO')
		->OrderBy('NOM_MPIO')
		->get();
			
		return Response::json($submpio);
	}
	public function postAdjuntarDocu()
	{	
		$path1 = DB::table('MODDOCUMENTOS_CATEGORIA')		
		->where('id_categoria','=',Input::get('selectcategoria'))
		->select('rutadecarpeta')
		->get();

		if (File::exists(public_path().'\moddocs\DA')){
			}
			else{
				File::makeDirectory(public_path().'\moddocs\DA',  $mode = 0777, $recursive = false);	
		}
		if (File::exists(public_path().'\moddocs\IMGDOCU')){
			}
			else{
				File::makeDirectory(public_path().'\moddocs\IMGDOCU',  $mode = 0777, $recursive = false);	
		}

		$path=public_path().$path1[0]->rutadecarpeta;		

		// creacion de carpeta dependiendo de la categoria del documento
		
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

		// creacion de carpeta dependiendo de la subcategoria del documento
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

		//creacion de la carpeta de categoria si es necesario
		$path3 = $path2.'\\'.$tipodocu[0]->siglas_categoria;		

		if (File::exists($path3)){						
		}
		else{
			File::makeDirectory($path3,  $mode = 0777, $recursive = false);	
		}
		//verifica si el documentos paso del cliente al servidor
		if(Input::hasFile('filedocu')) {
			$selectmpios=Input::get('selectmpios');		   		
    		$fecha = date("Y-m-d H:i:s");
			$idmaximo =  DB::table('MODDOCUMENTOS_MASTERDOCU')->max('id_documento');
			
			$nombredocumento = ($idmaximo+1).'_'.Input::file('filedocu')->getClientOriginalName();
			
			Input::file('filedocu')->move($path3,$nombredocumento);

			//exec('CALL '.public_path().'\ImageMagick\convert.exe "'.public_path().'\master.pdf[0]"  -resize 50% -quality 50 "'.public_path().'\prueba.jpg"');
			//exec('CALL '.public_path().'\ImageMagick\convert.exe "'.public_path().'\master.pdf[0]" -resize 215x278 "'.public_path().'\prueba.jpg"');

			//se realiza el QUICKLOOK de la primera hoja del documento cargado
			
			exec('CALL '.public_path().'\ImageMagick\convert.exe "'.$path3.'\\'.$nombredocumento.'[0]" "'.public_path().'\moddocs\IMGDOCU\\'.$nombredocumento.'.jpg"');

			$a=0;
			do {				
				if (File::exists(public_path().'\moddocs\IMGDOCU\\'.$nombredocumento.'.jpg')) {
					exec('CALL '.public_path().'\ImageMagick\convert.exe "'.public_path().'\moddocs\IMGDOCU\\'.$nombredocumento.'.jpg" -resize 215x278 "'.public_path().'\moddocs\IMGDOCU\\'.$nombredocumento.'.jpg"');
					$a=11;						
				} else {
					$a=0;
				}
			} while ($a <= 10);
			
    		// cargue en la tabla masterducu la informacion alfanumerica del documento
    		DB::table('MODDOCUMENTOS_MASTERDOCU')->insert(
		    	array(
		    		'titulo' => Input::get('titulo'), 
		    		'fecha' => Input::get('selectfechadocu'),
		    		'nombredocu' => $nombredocumento,
		    		'autor' => Input::get('selectautor'),
		    		'categoria' => Input::get('selectcategoria'),
		    		'tipo' => Input::get('selectipodocu'),
		    		'momento' => Input::get('selecmomento'),
		    		'ugeo' => Input::get('selecunigeo'),
		    		'estrategia' => Input::get('selectestrategia'),
		    		'bloque' => Input::get('selectbloque'),
		    		'ruta' => $path3.'\\'.$nombredocumento,
		    		'fechacarguedocu' => $fecha,		    				    		
	    			'usercargue' => Auth::user()->id,
	    			'proyecto' => Input::get('selectproyecto'),
	    			'contraparte' => Input::get('selectcontraparte')
		    	)
			);

			//si se carga referencia geografica municipal o departamental se carga en la tabla MODDOCUMENTOS_UNIGEODEPTOMUNI esas caracteristicas mas el id del documento
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
    public function postBusquedabasica()
	{
		if (((Auth::user()->grupo==1) OR (Auth::user()->grupo==6))AND (Auth::user()->level==1)) {
			/*USP_DOCUMENTOS_BUSCAR*/
			$dat='%'.Input::get('querybusqueda').'%';
			$queryresultbusbasic = DB::statement("exec USP_DOCUMENTOS_BUSCAR $dat");

			//$queryresultbusbasic = DB::select("SELECT id_documento, titulo, categoria, id_proyecto, contrapate, tipo, estrategia, id_bloque, momento, autor, unidgeo, ruta, nombredocu FROM Vista_MODDOCUMENTOS_MASTERDOCU_dom where titulo LIKE '%".Input::get('querybusqueda')."%' or categoria LIKE '%".Input::get('querybusqueda')."%' or id_proyecto LIKE '%".Input::get('querybusqueda')."%' or contrapate LIKE '%".Input::get('querybusqueda')."%' or tipo LIKE '%".Input::get('querybusqueda')."%' or estrategia LIKE '%".Input::get('querybusqueda')."%' or id_bloque LIKE '%".Input::get('querybusqueda')."%' or momento LIKE '%".Input::get('querybusqueda')."%' or autor LIKE '%".Input::get('querybusqueda')."%' or unidgeo LIKE '%".Input::get('querybusqueda')."%'");

			for ($i=0; $i <= count($queryresultbusbasic)-1 ; $i++) { 
					
				$queryresultbusbasic[$i]->ruta=str_replace(public_path().'\\', '', $queryresultbusbasic[$i]->ruta);
				if (File::exists(public_path().'\moddocs\IMGDOCU\\'.$queryresultbusbasic[$i]->nombredocu.'.jpg')){
					$queryresultbusbasic[$i]->imagen = 'moddocs/IMGDOCU/'.$queryresultbusbasic[$i]->nombredocu.'.jpg';
					
				}
				else{
					$queryresultbusbasic[$i]->imagen = null;
				}
			}
					
		}
		else{
			//pendiente realizar codigo para que se pueda hacer la busqueda por perfiles de usuario
			$queryresultbusbasic='';
		}

		
		return Response::json($queryresultbusbasic);
	}
	public function MasterDocu()
	{
		$dat='a';
			$queryresultbusbasic = DB::statement("exec USP_DOCUMENTOS_BUSCAR $dat"); 
			print_r($queryresultbusbasic);
	}
    		
}
?>