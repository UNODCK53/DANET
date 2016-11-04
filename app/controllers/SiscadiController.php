<?php

class SiscadiController extends BaseController {

	public function reporte_encuesta()
	{
		//Consultas para obtener las posibles intervenciones
		$arrayinter=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener las intervenciones de a partir de los codigos almacenados en las encuestas
			->select('intervencion')
			->groupBy('intervencion')
			->orderBy('intervencion')
			->get();

		return  View::make('modulosiscadi.Sisicadi_encuesta',array('arrayinter' => $arrayinter));
	}
	

	public function postSiscadirepmision()
	{

		//Consultas para obtener los tipos de mision segun la intervencion 
		$arraymision = DB::table('MODSISCADI_ENCUESTAS')
		->Join('MODSISCADI_MISION','MODSISCADI_ENCUESTAS.mision','=','MODSISCADI_MISION.mision')
		->WHERE('MODSISCADI_ENCUESTAS.intervencion','=',Input::get('intervencion'))
		->select('MODSISCADI_MISION.mision','MODSISCADI_MISION.nom_mision')
		->groupBy('MODSISCADI_MISION.mision')
		->groupBy('MODSISCADI_MISION.nom_mision')
		->get();
			

		return  Response::json(array('arraymision'=>$arraymision));
				

	}

	public function postSiscadireppiloto()
	{

		//Consultas para obtener los tipos de mision segun los datos selccionados 
		$arraypiloto = DB::table('MODSISCADI_ENCUESTAS')
		->WHERE('intervencion','=',Input::get('intervencion'))
		->WHERE('mision','=',Input::get('mision'))
		->select('piloto')
		->groupBy('piloto')
		->groupBy('piloto')
		->get();
			

		return  Response::json(array('arraypiloto'=>$arraypiloto));
				

	}

	public function postSiscadirepdpto()
	{

		$monitor=Input::get('monitor');
		if ($monitor !=""){//condicional que filtra los departamentos por monitor, sirve para reporte por monitor
			$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas				
				
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas	
		}
		return  Response::json(array('arraydpto'=>$arraydpto));
	}

	public function postSiscadirepmpio()
	{

		$monitor=Input::get('monitor');
		if ($monitor !=""){//condicional que filtra los departamentos por monitor, sirve para reporte por monitor
			
			//Consultas para obtener los municipios segun los datos selccionados 
			$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc"); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas	
		
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			
			//Consultas para obtener los municipios segun los datos selccionados 
			$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc"); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas	
		}
		return  Response::json(array('arraymuni'=>$arraymuni));
	}
	public function postSiscadirepmoni()
	{

		$arraymoni=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.intervencion',Input::get('intervencion'))
			->where('MODSISCADI_ENCUESTAS.mision',Input::get('mision'))
			->where('MODSISCADI_ENCUESTAS.piloto',Input::get('piloto'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();
			

		return  Response::json(array('arraymoni'=>$arraymoni));
				

	}	
	public function getRepotemision()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de mision
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario reporte_encuentas_mision
		$mision=$data['mision'];
		$inter=$data['intervencion'];
		$cod_dane=$data['cod_dane'];
		$cod_depto=$data['cod_depto'];
		$piloto=$data['Piloto'];
		
		if($piloto=='Si'){
			$texto_piloto=" (prueba piloto)";
		}else{
			$texto_piloto="";
		}

		$fecha=array();//arrelo donde se almacenara las fechas de inicio y finalizacion de la misión
		$fecha2=array();
		$tabla_fecha=DB::table('MODSISCADI_ENCUESTAS')	
			->select(array(DB::raw('convert(VARCHAR(19),min(MODSISCADI_ENCUESTAS.fecha),111) as f_inicio,convert(VARCHAR(19),max(MODSISCADI_ENCUESTAS.fecha),111) as f_final')))//selecciona el max y el min de las fechas (campo TODAY) en las cuales se realizaron las encuestas
			->where('MODSISCADI_ENCUESTAS.cod_unodc','like',$cod_dane.'%')
			->get();
			

		foreach($tabla_fecha as $category):// crea arreglo con dos atributos fecha incial y final de las encuestaspor vereda
			$fecha2=array('f_inicial'=>$category->f_inicio,'f_final'=>$category->f_final);
			array_push($fecha,$fecha2);
		endforeach;		
		
		
		$muni=array();//arrelo donde se almacenara el nombre del municipio seleccionado
		$muni2=array();
		$tabla_muni=DB::table('MUNICIPIOS')//crea la consulta para obtener el nombre del municipio segun el codigo seleccionado en el formulario		
			->select('COD_DANE','NOM_MPIO')
			->where('COD_DANE', $cod_dane)
			->get();
		foreach($tabla_muni as $category):// crea arreglo con el nombre del municipio
			$muni2=array('muni'=>$category->NOM_MPIO);
			array_push($muni,$muni2);
		endforeach;	

		$depto=array();//arrelo donde se almacenara el nombre del departamento seleccionado
		$depto2=array();
		$tabla_dpto=DB::table('DEPARTAMENTOS')//crea la consulta para obtener el nombre del departamento segun el codigo seleccionado en el formulario		
			->select('COD_DPTO','NOM_DPTO')
			->where('COD_DPTO', $cod_depto)
			->get();
		foreach($tabla_dpto as $category):// crea arreglo con el nombre del departamento
			//$muni2=array('muni'=>$category->label);
			$depto2=array('depto'=>$category->NOM_DPTO);
			array_push($depto,$depto2);
		endforeach;
		
		$encuestas_benef=array();//arrelo donde se almacenara la sumatoria de encuestas realizadas a beneficiarios por vereda
		$encuestas_benef2=array();

		$tabla_sum_encuestas_benef=DB::table('MODSISCADI_ENCUESTAS')
			->where('cod_unodc','like',$cod_dane.'%')
			->where('MODSISCADI_ENCUESTAS.intervencion',$inter)
			->where('MODSISCADI_ENCUESTAS.mision',$mision)
			->where('MODSISCADI_ENCUESTAS.piloto',$piloto)
			->where('tipo', '=','Beneficiarios')	
			->select(DB::raw('count(*) as total_encuestas'))
			->get();
			

		foreach($tabla_sum_encuestas_benef as $category):// crea arreglo con el total de encuestas realizadas a beneficiarios por vereda	
			$encuestas_benef2=array('total'=>$category->total_encuestas);
			array_push($encuestas_benef,$encuestas_benef2);
		endforeach;
		

		$encuestas_ccvcs=array();//arrelo donde se almacenara la sumatoria de encuestas realizadas a comites por vereda
		$encuestas__ccvcs2=array();
		$tabla_sum_encuestas__ccvcs=DB::table('MODSISCADI_ENCUESTAS')
			->where('cod_unodc','like',$cod_dane.'%')
			->where('MODSISCADI_ENCUESTAS.intervencion',$inter)
			->where('MODSISCADI_ENCUESTAS.mision',$mision)
			->where('MODSISCADI_ENCUESTAS.piloto',$piloto)
			->where('tipo', '=','Comite')	
			->select(DB::raw('count(*) as total_encuestas'))
			->get();

		foreach($tabla_sum_encuestas__ccvcs as $category):// crea arreglo con el total de encuestas realizadas a comites por vereda
			$encuestas_ccvcs2=array('total'=>$category->total_encuestas);
			array_push($encuestas_ccvcs,$encuestas_ccvcs2);
		endforeach;


		$fecha_reporte=date("d")."/". date("m")."/".date("Y"); //variable con la fecha de hoy
		

		$tipo="";
		if($mision=="p"){
			$tipo="Línea base";
		}
		
		//parrafo2 del pdf 
		$text_bene='-'.$encuestas_benef[0]["total"].' encuestas a beneficiarios - '.$tipo.' '.$inter.$texto_piloto;
		
		//parrafo3 del pdf 
		if (count($encuestas_ccvcs)>0){// este parrafo solo aparece si existen encuestas a comites en la mision
			$text_comite='-'.$encuestas_ccvcs[0]["total"].' encuestas a comités - '.$tipo.' '.$inter.$texto_piloto;
			$total_encuestas=$encuestas_benef[0]["total"]+$encuestas_ccvcs[0]["total"];//variable con la sumatoria todal de encuestas (beneficiarios + comite)
		}else{
			$text_comite="";
			$total_encuestas=$encuestas_benef[0]["total"];//variable con la sumatoria todal de encuestas (beneficiarios )
		}
		
		//parrafo1 del pdf 
		$text_general='En el proceso de recolección de información en terreno realizado en el municipio de '.$muni[0]["muni"].' ('.$depto[0]["depto"].') en el marco de la misión '.$tipo.$texto_piloto.'  Modelo de Intervención Poserradicación y Contención Familias Guardabosques para la Prosperidad (Focalización '.$inter.')  se recopilaron '.$total_encuestas.' encuestas realizadas entre el '.$fecha[0]["f_inicial"].' y el '.$fecha[0]["f_final"].' y discriminadas como se relaciona a continuación: ';

		//estructura para crear pdf segun paquete TCPDF para laravel
		//1° estrcutura estatica de cada pdf
			Fpdf::AddPage('P','Letter');
	        Fpdf::SetFont('Arial', 'B', 12);
			//inserto la cabecera poniendo una imagen dentro de una celda
			Fpdf::SetY(16);
			Fpdf::SetX(150);
			Fpdf::Cell(35,6,utf8_decode('Bogotá ').$fecha_reporte);//variable Cell con formato de celda(ancho, alto,texto)
			Fpdf::SetFont('','B',15);//variable SetFon con formato del texto (tipo de letra, estilo,tamaño)
			Fpdf::SetY(30);
			Fpdf::SetX(50);
			Fpdf::Cell(35,6,utf8_decode('Acta de recopilación de encuestas digitales'));
			Fpdf::SetFont('','',12);
			Fpdf::SetY(46);
			Fpdf::SetX(15);
			Fpdf::MultiCell(180,6,utf8_decode($text_general),0,'J');//variable MultiCell con formato de celda, la diferencia con Cell esque en Cell el tamaño de la celda puede ser amplido si el tamaño del texto es superior a este, mientras que con MultiCell si el tamaño del texto supeera el tamaño de la celda este crea saltos de linea y no se amplia horizontalmente (ancho, alto,texto, borde,alineacion)
			Fpdf::SetY(86);
			Fpdf::SetX(15);
			Fpdf::MultiCell(180,6,utf8_decode($text_bene),0,'L');

			
			//2° estrcutura dinamica de cada pdf que depende de la informacion almacenada en la base de datos
		
			
			$Y_Fields_Name_position = 96;//posicion Y de referencia para la parte de estructura dinamicas del reporte
			
			// variable tbl que contiene la tabla en formato html de encuestas a beneficiarios
			
			Fpdf::SetLeftMargin(15);
			Fpdf::SetRightMargin(15);
			Fpdf::SetFillColor(200,200,200);
			Fpdf::SetFont('Arial', 'B', 10);
			Fpdf::Cell(52,7,'Departamento','TBL',0,'C','1');
			Fpdf::Cell(52,7,'Municipio','TB',0,'C','1');
			Fpdf::Cell(55,7,'Vereda','TB',0,'C','1');
			Fpdf::Cell(20,7,'Encuestas','TBR',0,'L','1');
			Fpdf::Ln(7);
			
		$tabla_encuestas_benef=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");

		//crea la consulta para obtener los campos almacenados 
		$vds_bene = "";
		$vds_encuesta_bene = "";	
		foreach($tabla_encuestas_benef as $category):// crea arreglo con dos atributos cod_unodc, el nombre de la vereda y el numero de encuestas de beneficiarios por vereda
			Fpdf::SetFont('','',10);
			Fpdf::Cell(52,5,utf8_decode($category->NOM_DPTO),'',0,'L',0);
			Fpdf::Cell(52,5,utf8_decode($category->NOM_MPIO),'',0,'L',0);
			Fpdf::Cell(55,5,utf8_decode($category->NOM_TERR),'',0,'L',0);
			Fpdf::Cell(20,5,utf8_decode($category->encuestas),'',0,'C',0);
			Fpdf::Ln(5);
		endforeach;
		
		
			//3° estructura de pdf dinamica si existe encuestas de comite
			if (count($encuestas_ccvcs)>0){
				if(112+count($tabla_encuestas_benef)*20+8>280){ //si existe encuestas a comite y la posicion de finalización de tbl es mayor 166, adiciona una nueva pagina y su comienzo sera la tabla de comites sino siguie en la pagina 1  del pdf
					Fpdf::AddPage();
					$cuenta_bene=-13;//si se agrega una nueva pagina, se recalcula la variable ceunta bene que se utilizara para calular la posicion de tabla comites 
					
					}
				
				Fpdf::SetFont('','',12);
				Fpdf::Ln(15);
				Fpdf::SetX(15);
				Fpdf::MultiCell(170,6,utf8_decode($text_comite),0,'L');// imprime el texto de comite 
				Fpdf::SetLeftMargin(15);
				Fpdf::SetRightMargin(15);
				Fpdf::SetFillColor(200,200,200);
				Fpdf::SetFont('Arial', 'B', 10);
				Fpdf::Cell(52,7,'Departamento','TBL',0,'C','1');
				Fpdf::Cell(52,7,'Municipio','TB',0,'C','1');
				Fpdf::Cell(55,7,'Vereda','TB',0,'C','1');
				Fpdf::Cell(20,7,'Encuestas','TBR',0,'L','1');
				Fpdf::Ln(7);
			
				$tabla_encuestas_ccvcs=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite' group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");

				//crea la consulta para obtener los campos almacenados 
				$vds_bene = "";
				$vds_encuesta_bene = "";	
				foreach($tabla_encuestas_ccvcs as $category):// crea arreglo con dos atributos cod_unodc, el nombre de la vereda y el numero de encuestas de beneficiarios por vereda
					Fpdf::SetFont('','',10);
					Fpdf::Cell(52,5,utf8_decode($category->NOM_DPTO),'',0,'L',0);
					Fpdf::Cell(52,5,utf8_decode($category->NOM_MPIO),'',0,'L',0);
					Fpdf::Cell(55,5,utf8_decode($category->NOM_TERR),'',0,'L',0);
					Fpdf::Cell(20,5,utf8_decode($category->encuestas),'',0,'C',0);
					Fpdf::Ln(5);
				endforeach;				
					Fpdf::Ln(10);				
					Fpdf::SetFont('','',12);
					Fpdf::SetX(15);
					Fpdf::Cell(38,6,'En constancia firman:');
					Fpdf::SetFont('','B',12);
					Fpdf::Ln(20);
					Fpdf::SetX(15);
					Fpdf::Cell(35,6,utf8_decode('Unidad de Información COL/K53'));
					Fpdf::SetX(125);
					Fpdf::Cell(55,6,'Unidad de Campo COL/K53');
					Fpdf::SetFont('','',12);
					Fpdf::Ln(10);
					Fpdf::SetX(15);
					Fpdf::Cell(35,6,'Nombre: ____________________');
					Fpdf::SetX(125);
					Fpdf::Cell(35,6,'Nombre: ____________________');
					Fpdf::SetFont('','',12);
					Fpdf::Ln(5);
					Fpdf::SetX(15);
					Fpdf::Cell(35,6,'Firma:    ____________________');
					Fpdf::SetX(125);
					Fpdf::Cell(35,6,'Firma:    ____________________');
					Fpdf::Ln(5);
				
			}else{
				// omite la impresion de la informacion de encuestas a comite e imprime la parte final del reporte
				Fpdf::Ln(10);
				Fpdf::SetFont('','',12);
				Fpdf::SetX(15);
				Fpdf::Cell(38,6,'En constancia firman:');
				Fpdf::SetFont('','B',12);
				Fpdf::Ln(20);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,utf8_decode('Unidad de Información COL/K53'));
				Fpdf::SetX(125);
				Fpdf::Cell(55,6,'Unidad de Campo COL/K53');
				Fpdf::SetFont('','',12);
				Fpdf::Ln(10);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,'Nombre: ____________________');
				Fpdf::SetX(125);
				Fpdf::Cell(35,6,'Nombre: ____________________');
				Fpdf::SetFont('','',12);
				Fpdf::Ln(5);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,'Firma:    ____________________');
				Fpdf::SetX(125);
				Fpdf::Cell(35,6,'Firma:    ____________________');
				Fpdf::Ln(5);
			}

        Fpdf::Output($muni[0]["muni"].'_'.$depto[0]["depto"].'_'.$tipo.'.pdf','D');
        exit;	
	}
	
	public function getRepotegeneral()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de general
	
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario reporte_encuentas_general
		$mision=$data['mision_gen'];
		$inter=$data['intervencion_gen'];	
		$piloto=$data['Piloto_gen'];		

		$categories_bene_gen=array();//arrelo donde se almacenara el nombre del departamento, el nombre del municipio, el nombre de la vereda y la cuenta y el numero de encuestas realizadas a beneficiarios en la intervencion seleccionada
		$categories_bene_gen2=array();
		if($mision=="p"){
			$tipo="Línea_base";
		}
		
		$tabla_encuestas_benef_gen=DB::select("select DEPARTAMENTOS.NOM_DPTO as Departamento,NOM_MPIO as Municipio,NOM_TERR as Vereda,encuestas as Encuentas from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni	on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");		
		$tabla_encuestas_ccvsc_gen=DB::select("select DEPARTAMENTOS.NOM_DPTO as Departamento,NOM_MPIO as Municipio,NOM_TERR as Vereda,encuestas as Encuentas from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");

		Excel::create('Reporte_general_de_encuestas_'.$tipo.'_'.$inter,function($excel) use ($tabla_encuestas_benef_gen,$tabla_encuestas_ccvsc_gen)
		{
			$excel->sheet('Beneficiarios',function($sheet)  use ($tabla_encuestas_benef_gen)
			{
				$data = array();
				
				foreach ($tabla_encuestas_benef_gen as $result) {
				$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:D1', function($cells) {
			    	$cells->setBackground('#dadae3');
				});
			});

			$excel->sheet('CCVCS',function($sheet)  use ($tabla_encuestas_ccvsc_gen)
			{
				$data = array();
				
				foreach ($tabla_encuestas_ccvsc_gen as $result) {
				$data[] = (array)$result;
				}  	
				$sheet->with($data);
				$sheet->freezeFirstRow();
				$sheet->setAutoFilter();
				$sheet->cells('A1:D1', function($cells) {
			    	$cells->setBackground('#dadae3');
				});
			});
			
		})->export('xls');
	}
	
	public function getRepotemonitor()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de mision
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario reporte_encuentas_mision
		$mision=$data['mision_moni'];
		$inter=$data['intervencion_moni'];
		$cod_dane=$data['cod_dane_moni'];
		$cod_depto=$data['cod_depto_moni'];
		$piloto=$data['Piloto_moni'];
		$monitor=$data['monitor'];
		
		if($piloto=='Si'){
			$texto_piloto=" (prueba piloto)";
		}else{
			$texto_piloto="";
		}

		$fecha=array();//arrelo donde se almacenara las fechas de inicio y finalizacion de la misión
		$fecha2=array();
		$tabla_fecha=DB::table('MODSISCADI_ENCUESTAS')	
			->select(array(DB::raw('convert(VARCHAR(19),min(MODSISCADI_ENCUESTAS.fecha),111) as f_inicio,convert(VARCHAR(19),max(MODSISCADI_ENCUESTAS.fecha),111) as f_final')))//selecciona el max y el min de las fechas (campo TODAY) en las cuales se realizaron las encuestas
			->where('MODSISCADI_ENCUESTAS.cod_unodc','like',$cod_dane.'%')
			->where('MODSISCADI_ENCUESTAS.cod_monitor','=',$monitor)
			->get();
			

		foreach($tabla_fecha as $category):// crea arreglo con dos atributos fecha incial y final de las encuestaspor vereda
			$fecha2=array('f_inicial'=>$category->f_inicio,'f_final'=>$category->f_final);
			array_push($fecha,$fecha2);
		endforeach;		
		
		
		$muni=array();//arrelo donde se almacenara el nombre del municipio seleccionado
		$muni2=array();
		$tabla_muni=DB::table('MUNICIPIOS')//crea la consulta para obtener el nombre del municipio segun el codigo seleccionado en el formulario		
			->select('COD_DANE','NOM_MPIO')
			->where('COD_DANE', $cod_dane)
			->get();
		foreach($tabla_muni as $category):// crea arreglo con el nombre del municipio
			$muni2=array('muni'=>$category->NOM_MPIO);
			array_push($muni,$muni2);
		endforeach;	

		$depto=array();//arrelo donde se almacenara el nombre del departamento seleccionado
		$depto2=array();
		$tabla_dpto=DB::table('DEPARTAMENTOS')//crea la consulta para obtener el nombre del departamento segun el codigo seleccionado en el formulario		
			->select('COD_DPTO','NOM_DPTO')
			->where('COD_DPTO', $cod_depto)
			->get();
		foreach($tabla_dpto as $category):// crea arreglo con el nombre del departamento
			//$muni2=array('muni'=>$category->label);
			$depto2=array('depto'=>$category->NOM_DPTO);
			array_push($depto,$depto2);
		endforeach;
		
		$encuestas_benef=array();//arrelo donde se almacenara la sumatoria de encuestas realizadas a beneficiarios por vereda
		$encuestas_benef2=array();

		$tabla_sum_encuestas_benef=DB::table('MODSISCADI_ENCUESTAS')
			->where('cod_unodc','like',$cod_dane.'%')
			->where('MODSISCADI_ENCUESTAS.intervencion',$inter)
			->where('MODSISCADI_ENCUESTAS.mision',$mision)
			->where('MODSISCADI_ENCUESTAS.piloto',$piloto)
			->where('tipo', '=','Beneficiarios')	
			->where('MODSISCADI_ENCUESTAS.cod_monitor','=',$monitor)
			->select(DB::raw('count(*) as total_encuestas'))
			->get();		

		foreach($tabla_sum_encuestas_benef as $category):// crea arreglo con el total de encuestas realizadas a beneficiarios por vereda	
			$encuestas_benef2=array('total'=>$category->total_encuestas);
			array_push($encuestas_benef,$encuestas_benef2);
		endforeach;		

		$encuestas_ccvcs=array();//arrelo donde se almacenara la sumatoria de encuestas realizadas a comites por vereda
		$encuestas__ccvcs2=array();
		$tabla_sum_encuestas__ccvcs=DB::table('MODSISCADI_ENCUESTAS')
			->where('cod_unodc','like',$cod_dane.'%')
			->where('MODSISCADI_ENCUESTAS.intervencion',$inter)
			->where('MODSISCADI_ENCUESTAS.mision',$mision)
			->where('MODSISCADI_ENCUESTAS.piloto',$piloto)
			->where('tipo', '=','Comite')	
			->where('MODSISCADI_ENCUESTAS.cod_monitor','=',$monitor)
			->select(DB::raw('count(*) as total_encuestas'))
			->get();

		foreach($tabla_sum_encuestas__ccvcs as $category):// crea arreglo con el total de encuestas realizadas a comites por vereda
			$encuestas_ccvcs2=array('total'=>$category->total_encuestas);
			array_push($encuestas_ccvcs,$encuestas_ccvcs2);
		endforeach;

		$monitores=array();//arrelo donde se almacenara el codigo y nombre de las veredas a las cuales se realziaron encuestas a comites en el municipio seleccionado 
		$monitores2=array();
		$tabla_monitor=DB::table('MODSISCADI_ENCUESTAS')	//crea la consulta para obtener el nombre del monitor (tabla core)		
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')//join entre tabla dominio y tabla core de beneficiarios 
			->where('MODSISCADI_ENCUESTAS.cod_monitor','=', $monitor)//selecciona las veredas para el codigo de municipio ingresado
			->select('MODSISCADI_ENCUESTAS.cod_monitor','users.name','users.last_name')
			->groupBy('MODSISCADI_ENCUESTAS.cod_monitor')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->get();
			
		foreach($tabla_monitor as $category):// crea arreglo con el nombre del monitor
			$monitores2=array('cod_monitor'=>$category->cod_monitor,'nom_monitor'=>$category->name." ".$category->last_name);
			$monitores3 = $category->name." ".$category->last_name;	
		endforeach;	

		$fecha_reporte=date("d")."/". date("m")."/".date("Y"); //variable con la fecha de hoy

		$tipo="";
		if($mision=="p"){
			$tipo="Línea base";
		}		
		//parrafo2 del pdf 
		$text_bene='-'.$encuestas_benef[0]["total"].' encuestas a beneficiarios - '.$tipo.' '.$inter.$texto_piloto;
		
		//parrafo3 del pdf 
		if (count($encuestas_ccvcs)>0){// este parrafo solo aparece si existen encuestas a comites en la mision
			$text_comite='-'.$encuestas_ccvcs[0]["total"].' encuestas a comités - '.$tipo.' '.$inter.$texto_piloto;
			$total_encuestas=$encuestas_benef[0]["total"]+$encuestas_ccvcs[0]["total"];//variable con la sumatoria todal de encuestas (beneficiarios + comite)
		}else{
			$text_comite="";
			$total_encuestas=$encuestas_benef[0]["total"];//variable con la sumatoria todal de encuestas (beneficiarios )
		}		
		//parrafo1 del pdf 
		$text_general='En el proceso de recolección de información en terreno realizado en el municipio de '.$muni[0]["muni"].' ('.$depto[0]["depto"].') en el marco de la misión '.$tipo.$texto_piloto.'  Modelo de Intervención Poserradicación y Contención Familias Guardabosques para la Prosperidad (Focalización '.$inter.'), el profesional '.$monitores3.' recopiló '.$total_encuestas.' encuestas realizadas entre el '.$fecha[0]["f_inicial"].' y el '.$fecha[0]["f_final"].' y discriminadas como se relaciona a continuación: ';

		//estructura para crear pdf segun paquete TCPDF para laravel
		//1° estrcutura estatica de cada pdf
			Fpdf::AddPage('P','Letter');
	        Fpdf::SetFont('Arial', 'B', 12);
			//inserto la cabecera poniendo una imagen dentro de una celda
			Fpdf::SetY(16);
			Fpdf::SetX(150);
			Fpdf::Cell(35,6,utf8_decode('Bogotá ').$fecha_reporte);//variable Cell con formato de celda(ancho, alto,texto)
			Fpdf::SetFont('','B',15);//variable SetFon con formato del texto (tipo de letra, estilo,tamaño)
			Fpdf::SetY(30);
			Fpdf::SetX(50);
			Fpdf::Cell(35,6,utf8_decode('Acta de recopilación de encuestas digitales'));
			Fpdf::SetFont('','',12);
			Fpdf::SetY(46);
			Fpdf::SetX(15);
			Fpdf::MultiCell(180,6,utf8_decode($text_general),0,'J');//variable MultiCell con formato de celda, la diferencia con Cell esque en Cell el tamaño de la celda puede ser amplido si el tamaño del texto es superior a este, mientras que con MultiCell si el tamaño del texto supeera el tamaño de la celda este crea saltos de linea y no se amplia horizontalmente (ancho, alto,texto, borde,alineacion)
			Fpdf::SetY(86);
			Fpdf::SetX(15);
			Fpdf::MultiCell(180,6,utf8_decode($text_bene),0,'L');

			
			//2° estrcutura dinamica de cada pdf que depende de la informacion almacenada en la base de datos
		
			
			$Y_Fields_Name_position = 96;//posicion Y de referencia para la parte de estructura dinamicas del reporte
			
			// variable tbl que contiene la tabla en formato html de encuestas a beneficiarios
			
			Fpdf::SetLeftMargin(15);
			Fpdf::SetRightMargin(15);
			Fpdf::SetFillColor(200,200,200);
			Fpdf::SetFont('Arial', 'B', 10);
			Fpdf::Cell(52,7,'Departamento','TBL',0,'C','1');
			Fpdf::Cell(52,7,'Municipio','TB',0,'C','1');
			Fpdf::Cell(55,7,'Vereda','TB',0,'C','1');
			Fpdf::Cell(20,7,'Encuestas','TBR',0,'L','1');
			Fpdf::Ln(7);
			
		$tabla_encuestas_benef=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."' and  SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni	on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");		

		//crea la consulta para obtener los campos almacenados 
		$vds_bene = "";
		$vds_encuesta_bene = "";	
		foreach($tabla_encuestas_benef as $category):// crea arreglo con dos atributos cod_unodc, el nombre de la vereda y el numero de encuestas de beneficiarios por vereda
			Fpdf::SetFont('','',10);
			Fpdf::Cell(52,5,utf8_decode($category->NOM_DPTO),'',0,'L',0);
			Fpdf::Cell(52,5,utf8_decode($category->NOM_MPIO),'',0,'L',0);
			Fpdf::Cell(55,5,utf8_decode($category->NOM_TERR),'',0,'L',0);
			Fpdf::Cell(20,5,utf8_decode($category->encuestas),'',0,'C',0);
			Fpdf::Ln(5);
		endforeach;
		
		
		//3° estructura de pdf dinamica si existe encuestas de comite
		if (count($encuestas_ccvcs)>0){
			if(112+count($tabla_encuestas_benef)*20+8>280){ //si existe encuestas a comite y la posicion de finalización de tbl es mayor 166, adiciona una nueva pagina y su comienzo sera la tabla de comites sino siguie en la pagina 1  del pdf
				Fpdf::AddPage();
				$cuenta_bene=-13;//si se agrega una nueva pagina, se recalcula la variable ceunta bene que se utilizara para calular la posicion de tabla comites 
				
			}
			
			Fpdf::SetFont('','',12);
			Fpdf::Ln(15);
			Fpdf::SetX(15);
			Fpdf::MultiCell(170,6,utf8_decode($text_comite),0,'L');// imprime el texto de comite 
			Fpdf::SetLeftMargin(15);
			Fpdf::SetRightMargin(15);
			Fpdf::SetFillColor(200,200,200);
			Fpdf::SetFont('Arial', 'B', 10);
			Fpdf::Cell(52,7,'Departamento','TBL',0,'C','1');
			Fpdf::Cell(52,7,'Municipio','TB',0,'C','1');
			Fpdf::Cell(55,7,'Vereda','TB',0,'C','1');
			Fpdf::Cell(20,7,'Encuestas','TBR',0,'L','1');
			Fpdf::Ln(7);
			
			$tabla_encuestas_ccvcs=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."' and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite' group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
			//crea la consulta para obtener los campos almacenados 
			$vds_bene = "";
			$vds_encuesta_bene = "";	
			foreach($tabla_encuestas_ccvcs as $category):// crea arreglo con dos atributos cod_unodc, el nombre de la vereda y el numero de encuestas de beneficiarios por vereda
				Fpdf::SetFont('','',10);
				Fpdf::Cell(52,5,utf8_decode($category->NOM_DPTO),'',0,'L',0);
				Fpdf::Cell(52,5,utf8_decode($category->NOM_MPIO),'',0,'L',0);
				Fpdf::Cell(55,5,utf8_decode($category->NOM_TERR),'',0,'L',0);
				Fpdf::Cell(20,5,utf8_decode($category->encuestas),'',0,'C',0);
				Fpdf::Ln(5);
			endforeach;					
				Fpdf::Ln(10);				
				Fpdf::SetFont('','',12);
				Fpdf::SetX(15);
				Fpdf::Cell(38,6,'En constancia firman:');
				Fpdf::SetFont('','B',12);
				Fpdf::Ln(20);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,utf8_decode('Unidad de Información COL/K53'));
				Fpdf::SetX(125);
				Fpdf::Cell(55,6,'Unidad de Campo COL/K53');
				Fpdf::SetFont('','',12);
				Fpdf::Ln(10);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,'Nombre: ____________________');
				Fpdf::SetX(125);
				Fpdf::Cell(35,6,utf8_decode('Nombre: '.$monitores3));
				Fpdf::SetFont('','',12);
				Fpdf::Ln(5);
				Fpdf::SetX(15);
				Fpdf::Cell(35,6,'Firma:    ____________________');
				Fpdf::SetX(125);
				Fpdf::Cell(35,6,'Firma:    ____________________');
				Fpdf::Ln(5);
				
		}else{
			// omite la impresion de la informacion de encuestas a comite e imprime la parte final del reporte
			Fpdf::Ln(10);
			Fpdf::SetFont('','',12);
			Fpdf::SetX(15);
			Fpdf::Cell(38,6,'En constancia firman:');
			Fpdf::SetFont('','B',12);
			Fpdf::Ln(20);
			Fpdf::SetX(15);
			Fpdf::Cell(35,6,utf8_decode('Unidad de Información COL/K53'));
			Fpdf::SetX(125);
			Fpdf::Cell(55,6,'Unidad de Campo COL/K53');
			Fpdf::SetFont('','',12);
			Fpdf::Ln(10);
			Fpdf::SetX(15);
			Fpdf::Cell(35,6,'Nombre: ____________________');
			Fpdf::SetX(125);
			Fpdf::Cell(35,6,'Nombre: ____________________');
			Fpdf::SetFont('','',12);
			Fpdf::Ln(5);
			Fpdf::SetX(15);
			Fpdf::Cell(35,6,'Firma:    ____________________');
			Fpdf::SetX(125);
			Fpdf::Cell(35,6,'Firma:    ____________________');
			Fpdf::Ln(5);
		}
        Fpdf::Output($muni[0]["muni"].'_'.$depto[0]["depto"].'_'.$tipo.'.pdf','D');
        exit;
	}	
	public function showPdfHtml()
	{
		return  View::make('PDF_reporte');
	}


	public function siscadi_indicadores()
	{			
		//Consultas para obtener el número de encuetas por intervencion 
		$arrayintercountcomi = DB::select("select count(intervencion) as num_intervencion, tipo,intervencion from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' group by tipo, intervencion");
		$arrayintercountbene = DB::select("select count(intervencion) as num_intervencion, tipo,intervencion from MODSISCADI_ENCUESTAS where tipo='Beneficiarios' and piloto='No' group by tipo, intervencion");
		$arrayintercount=array($arrayintercountbene,$arrayintercountcomi);	

		//consulta para traer los años de intervencion en la tabla de encuestas
		$arrayintervencion = DB::table('MODSISCADI_ENCUESTAS')
		->select('intervencion')
		->groupBy('intervencion')
		->get();

		$intervencion = DB::table('MODSISCADI_ENCUESTAS')
			->max('intervencion');
		$mision = DB::table('MODSISCADI_MISION')
			->select('mision')
			->get();

		for($i=0; $i<count($mision); $i++){
			//crea arreglo con el numero encuestas por departamento
			$cuenta[$i] = DB::select(" select sum(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO ");
			if(empty($cuenta[$i])){$cuenta_todos[$i] = "0";}
			else{$cuenta_todos[$i]=(int)$cuenta[$i][0]->value;}
			//crea arreglo con el numero de departamentos que tienen encuestas	
			$deptos[$i] = DB::select("select SUBSTRING(cod_unodc,1,2)as deptos FROM MODSISCADI_ENCUESTAS where mision='".$mision[$i]->mision."' and intervencion='".$intervencion."' group by SUBSTRING(cod_unodc,1,2)");
			$cuenta_deptos[$i]=(int)count($deptos[$i]);
			//crea arreglo con el numero de municipios que tienen encuestas
			$munis[$i] = DB::select("select SUBSTRING(cod_unodc,1,5)as deptos FROM MODSISCADI_ENCUESTAS where mision='".$mision[$i]->mision."' and intervencion='".$intervencion."' group by SUBSTRING(cod_unodc,1,5)");
			$cuenta_munis[$i]=(int)count($munis[$i]);
			//crea arreglo conel intervalo de fechas en los que se realzaron las encuestas
			$fecha[$i] = DB::select("select FORMAT(max(fecha),'dd/MM/yyyy') as fecha_final,FORMAT(min(fecha),'dd/MM/yyyy') as fecha_inicial FROM MODSISCADI_ENCUESTAS where FORMAT(fecha,'yyyy')>2013 and mision='".$mision[$i]->mision."'");	
			if(empty($fecha[$i][0]->fecha_inicial)){
				$fechas_todos[$i][0] = "NA";
				$fechas_todos[$i][1] = "NA";
			}
			else{
				$fechas_todos[$i][0]=$fecha[$i][0]->fecha_inicial;
				$fechas_todos[$i][1]=$fecha[$i][0]->fecha_final;
			}

		}	

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();

		$arraydptocount = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as total,bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='2015' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='2015' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 	full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='2015' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='2015' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");
		$grafica=array();				
		foreach($arraydptocount as $category):// crea arreglo con dos atributos cod_depto y el nombre
							$categories_4['COD_DPTO']=$category->COD_DPTO;
							$categories_4['value']=(int)$category->total;
							$categories_4['name']=$category->NOM_DPTO;
							array_push($grafica,$categories_4);
						endforeach;	

		$todo=array($arrayintervencion,$arraymonitor,$arrayintercountbene,$arrayintercountcomi,$intervencion,$fechas_todos,$cuenta_todos,$cuenta_deptos,$cuenta_munis);
		return  View::make('modulosiscadi.Sisicadi_indicadores',array('todo' => $todo));
	}

	public function postSiscadiidmapa()
	{	
		$intervencion = DB::table('MODSISCADI_ENCUESTAS')
			->max('intervencion');
		$mision = DB::table('MODSISCADI_MISION')
			->select('mision')
			->get();

		for($i=0; $i<count($mision); $i++){
			$cuenta[$i] = DB::select(" select sum(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO ");// arrgelo con los datos de encuestas por departamento 
			if(empty($cuenta[$i])){$cuenta_todos[$i] = "0";}
			else{$cuenta_todos[$i]=(int)$cuenta[$i][0]->value;}
		}
		//Codigo para  grafica de mision "linea base" mision="p"

		$arraygrafica_p_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join	(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 

		$grafica_p_depto=array();				
		foreach($arraygrafica_p_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
							$categories_4['COD_DPTO']=$category->COD_DPTO;
							$categories_4['value']=(int)$category->value;
							$categories_4['nombre']=$category->name;
							array_push($grafica_p_depto,$categories_4);
						endforeach;	

		 $arraygrafica_p_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite full join (select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene	on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc	");// arrgelo con los datos de encuestas por municipio 
		$grafica_p_muni=array();				
		foreach($arraygrafica_p_muni as $category):// crea arreglo con dos atributos cod_dane, el nombre y encuestas
			$categories_5['COD_DANE']=$category->COD_DANE;
			$categories_5['value']=(int)$category->value;
			$categories_5['name']=$category->name;
			array_push($grafica_p_muni,$categories_5);
		endforeach;	
		//Codigo para  grafica de mision "Seguimiento" mision="s"

		$arraygrafica_s_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 
		$grafica_s_depto=array();				
		foreach($arraygrafica_s_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
			$categories_4['COD_DPTO']=$category->COD_DPTO;
			$categories_4['value']=(int)$category->value;
			$categories_4['nombre']=$category->name;
			array_push($grafica_s_depto,$categories_4);
		endforeach;	

		 $arraygrafica_s_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite full join (select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc ");// arrgelo con los datos de encuestas por municipio 
		$grafica_s_muni=array();				
		foreach($arraygrafica_s_muni as $category):// crea arreglo con dos atributos cod_dane, el nombre y encuestas
			$categories_5['COD_DANE']=$category->COD_DANE;
			$categories_5['value']=(int)$category->value;
			$categories_5['name']=$category->name;
			array_push($grafica_s_muni,$categories_5);
		endforeach;
		//Codigo para  grafica de mision "Linea final" mision="f"
		$arraygrafica_f_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 
		$grafica_f_depto=array();				
		foreach($arraygrafica_f_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
			$categories_4['COD_DPTO']=$category->COD_DPTO;
			$categories_4['value']=(int)$category->value;
			$categories_4['nombre']=$category->name;
			array_push($grafica_f_depto,$categories_4);
		endforeach;	
		 $arraygrafica_f_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite full join (select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc	");// arrgelo con los datos de encuestas por municipio 

		$grafica_f_muni=array();				
		foreach($arraygrafica_f_muni as $category):// crea arreglo con dos atributos cod_dane, el nombre y encuestas
			$categories_5['COD_DANE']=$category->COD_DANE;
			$categories_5['value']=(int)$category->value;
			$categories_5['name']=$category->name;
			array_push($grafica_f_muni,$categories_5);
		endforeach;						

		return Response::json(array('intervencion'=>$intervencion,'cuenta_todos'=>$cuenta_todos,'Linea_base_depto'=>$grafica_p_depto,'Linea_base_muni'=>$grafica_p_muni,'Seguimiento_depto'=>$grafica_s_depto,'Seguimiento_muni'=>$grafica_s_muni,'Linea_final_depto'=>$grafica_f_depto,'Linea_final_muni'=>$grafica_f_muni));
	}
	
	public function postSiscadiinter()
	{
		//Consultas para obtener el número de encuetas por mision 
		$arrayintercount = DB::select("select MODSISCADI_MISION.nom_mision, MODSISCADI_MISION.mision from (select count(mision) as num_intervencion, tipo,mision from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter join MODSISCADI_MISION on inter.mision=MODSISCADI_MISION.mision");
		for($i=0; $i<count($arrayintercount); $i++){
			$arraypro1[$i] = DB::select("select inter.num_intervencion,inter.tipo,MODSISCADI_MISION.nom_mision from (select count(mision) as num_intervencion, tipo,mision from MODSISCADI_ENCUESTAS where mision='".$arrayintercount[$i]->mision."' and  tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter join MODSISCADI_MISION on inter.mision=MODSISCADI_MISION.mision");

			if(empty($arraypro1[$i])){$arrayintercountcomi[$i] = "0";}
			else{$arrayintercountcomi[$i]=(int)$arraypro1[$i][0]->num_intervencion;}
			
			$arraypro2[$i] = DB::select("select inter.num_intervencion,inter.tipo,MODSISCADI_MISION.nom_mision from (select count(mision) as num_intervencion, tipo,mision from MODSISCADI_ENCUESTAS where mision='".$arrayintercount[$i]->mision."' and  tipo='Beneficiarios' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter join MODSISCADI_MISION on inter.mision=MODSISCADI_MISION.mision");

			if(empty($arraypro2[$i])){$arrayintercountbene[$i] = "0";}
			else{$arrayintercountbene[$i]=(int)$arraypro2[$i][0]->num_intervencion;}

			$arraypro3[$i] = DB::select("select MODSISCADI_MISION.nom_mision, MODSISCADI_MISION.mision from (select count(mision) as num_intervencion, tipo,mision from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter join MODSISCADI_MISION on inter.mision=MODSISCADI_MISION.mision");

			if(empty($arraypro1[$i])){$arrayintercountlabel[$i] = "";}
			else{$arrayintercountlabel[$i]=$arraypro1[$i][0]->nom_mision;}

		}

		$arraymision = DB::table('MODSISCADI_ENCUESTAS')
		->Join('MODSISCADI_MISION','MODSISCADI_ENCUESTAS.mision','=','MODSISCADI_MISION.mision')
		->WHERE('MODSISCADI_ENCUESTAS.intervencion','=',Input::get('intervencion'))
		->select('MODSISCADI_MISION.mision','MODSISCADI_MISION.nom_mision')
		->groupBy('MODSISCADI_MISION.mision')
		->groupBy('MODSISCADI_MISION.nom_mision')
		->get();

		$arrayintercount=array($arraymision,$arrayintercountbene,$arrayintercountcomi,$arrayintercountlabel);
		return Response::json($arrayintercount);
	}	

	public function postSiscadimision()
	{

		//Consultas para obtener el número de encuetas por mision 

		$arraymision = DB::table('MODSISCADI_MISION')
			->WHERE('mision','=',Input::get('mision'))
			->select('nom_mision')
			->groupBy('nom_mision')
			->get();

		//consulta para traer los departamentos según datos del formulario
		$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc");
			//consulta para optener los datos necesarios par ala consyruccion de la grafica
		$arraygrafica = DB::select(" select Bene.NOM_DPTO,Bene.Beneficiarios,comite.Comite from (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");
		//se crea un vector  "categories_depto2" con los departamentos
		$categories_depto2=array();
		foreach($arraydpto as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_depto=array($category->NOM_DPTO);
			array_push($categories_depto2,$categories_depto);
		endforeach;
		//se crea el vector "grafica"  que contiene la esctructura necesaria para generar la grafica
		$grafica=array();			
		for ($i = 0; $i < count($categories_depto2); $i++){
			$suma=0;
			foreach($arraygrafica as $category):// crea arreglo con dos atributosde arraygrafica y con la estructura para la grafica
				$dpto_mision=array($category->NOM_DPTO);
				if ($categories_depto2[$i]==$dpto_mision){						
					$Bene['id']='id_'.$i.'_0';
					$Bene['name']='Beneficiarios';
					$Bene['parent']='id_'.$i;
					$Bene['value']=(int)$category->Beneficiarios;
					$Comi['id']='id_'.$i.'_1';
					$Comi['name']='Comité';
					$Comi['parent']='id_'.$i;
					$Comi['value']=(int)$category->Comite;
					$suma=$category->Comite + $category->Beneficiarios;
					array_push($grafica,$Bene,$Comi);
				}
			endforeach;
			$randomcolor = '#' . strtoupper(dechex(rand(0,10000000)));//genera un codigo de color html aleatorio
			$depto['color']=$randomcolor;
			$depto['id']='id_'.$i;
			$depto['name']=$categories_depto2[$i];
			$depto['value']=$suma;
			array_push($grafica,$depto);
		}			


		return Response::json(array('arraydpto'=>$arraydpto,'arraymision'=>$arraymision,'grafica'=>$grafica));


	}

	public function postSiscadidpto()
	{
		//Consultas para obtener ellable del tipo de mision seleccionada
		$arraymision = DB::table('MODSISCADI_MISION')
				->WHERE('mision','=',Input::get('mision'))
				->select('nom_mision')
				->groupBy('nom_mision')
				->get();
		//Consultas para obtener label del departamento seleccionado
		$arraydepto = DB::table('DEPARTAMENTOS')
				->WHERE('COD_DPTO','=',Input::get('departamento'))
				->select('NOM_DPTO')
				->groupBy('NOM_DPTO')
				->get();

		//consulta para traer los muncipios según datos del formulario
		$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc");
		//consulta para optener los datos necesarios par ala consyruccion de la grafica
		$arraygrafica = DB::select(" select Bene.NOM_MPIO,Bene.Beneficiarios,comite.Comite from  (select DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."'  group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite full join (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_MPIO asc");
		//se crea un vector  "categories_muni2" con los departamentos
		$categories_muni2=array();
		foreach($arraymuni as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_muni=array($category->NOM_MPIO);
			array_push($categories_muni2,$categories_muni);
		endforeach;
		//se crea el vector "grafica"  que contiene la esctructura necesaria para generar la grafica
		$grafcia=array();			
		for ($i = 0; $i < count($categories_muni2); $i++){
			$suma=0;
			foreach($arraygrafica as $category):// crea arreglo con dos atributosde arraygrafica y con la estructura para la grafica
				$mpio_mision=array($category->NOM_MPIO);
				if ($categories_muni2[$i]==$mpio_mision){						
					$Bene['id']='id_'.$i.'_0';
					$Bene['name']='Beneficiarios';
					$Bene['parent']='id_'.$i;
					$Bene['value']=(int)$category->Beneficiarios;
					$Comi['id']='id_'.$i.'_1';
					$Comi['name']='Comité';
					$Comi['parent']='id_'.$i;
					$Comi['value']=(int)$category->Comite;
					$suma=$category->Comite + $category->Beneficiarios;
					array_push($grafcia,$Bene,$Comi);
				}
			endforeach;
			$randomcolor = '#' . strtoupper(dechex(rand(0,10000000)));//genera un codigo de color html aleatorio
			$muni['color']=$randomcolor;
			$muni['id']='id_'.$i;
			$muni['name']=$categories_muni2[$i];
			$muni['value']=$suma;
			array_push($grafcia,$muni);
		}
		$arrayintercount=array($categories_muni2,$arraygrafica);
		return Response::json(array('arraymuni'=>$arraymuni,'arraydepto'=>$arraydepto,'arraymision'=>$arraymision,'grafica'=>$grafcia));
	}
	public function postSiscadimpio()
	{
		//consulta para traer los monitores según datos del formulario
		$arraymoni=DB::select("select users.id as cod_monitor,users.name,users.last_name, CONCAT (users.name,users.last_name)as nom_monitor from MODSISCADI_ENCUESTAS join users on MODSISCADI_ENCUESTAS.cod_monitor = users.id where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by users.id,users.name,users.last_name order by users.name");

		$categories_moni2=array();	
		$Label=array();	
		foreach($arraymoni as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_moni=array($category->cod_monitor);
			$categories_moni3=array($category->nom_monitor);
			array_push($categories_moni2,$categories_moni);
			array_push($Label,$categories_moni3);
		endforeach;

		$arraygrafica= DB::select(" select moni_comi.cod_monitor,moni_comi.nom_monitor,moni_comi.num_comi,benefi.num_bene from (select moni.cod_monitor,moni.nom_monitor,comite.num_comi from (select  users.id as cod_monitor,users.name,users.last_name, CONCAT (users.name,users.last_name)as nom_monitor from MODSISCADI_ENCUESTAS join users on MODSISCADI_ENCUESTAS.cod_monitor = users.id where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by users.id,users.name,users.last_name) as moni full join (SELECT [cod_monitor],COUNT([cod_monitor]) as num_comi FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by cod_monitor) as comite on moni.cod_monitor=comite.cod_monitor) as moni_comi full join (SELECT [cod_monitor],COUNT([cod_monitor]) as num_bene FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by cod_monitor) as benefi on moni_comi.cod_monitor=benefi.cod_monitor order by moni_comi.nom_monitor ");
		 			
		$grafcia=array();
		$dato="";		
		for ($i = 0; $i < count($categories_moni2); $i++){
			foreach($arraygrafica as $category):// crea arreglo con dos atributosde arraygrafica y con la estructura para la grafica
			$mpio_mision=array($category->cod_monitor);
				if ($categories_moni2[$i]==$mpio_mision){					
					if(empty($category->num_comi)){
						$valor_comi = 0;
					}else{
						$valor_comi=(int)$category->num_comi;
					}
					if(empty($category->num_bene)){
						$valor_bene = 0;
					}else{
						$valor_bene=(int)$category->num_bene;
					}
					$dato= $dato."[".$i.",0,". $valor_comi."],[".$i.",1,". $valor_bene."],";
				}
			endforeach;
		}
		$datofinal="[".substr($dato,0, -1)."]";
		return  $datofinal;
	}

	public function postSiscadimoni()
	{
		//Consultas para obtener ellable del tipo de mision seleccionada
		$arraymision = DB::table('MODSISCADI_MISION')
			->WHERE('mision','=',Input::get('mision'))
			->select('nom_mision')
			->groupBy('nom_mision')
			->get();
		//Consultas para obtener label del departamento seleccionado
		$arraydepto = DB::table('DEPARTAMENTOS')
			->WHERE('COD_DPTO','=',Input::get('departamento'))
			->select('NOM_DPTO')
			->groupBy('NOM_DPTO')
			->get();

		//Consultas para obtener label del municipios seleccionado
		$arraymuni = DB::table('MUNICIPIOS')
			->WHERE('COD_DANE','=',Input::get('municipio'))
			->select('NOM_MPIO')
			->groupBy('NOM_MPIO')
			->get();		
		
		//consulta para traer los monitores según datos del formulario
		$arraymoni=DB::select("select users.id as cod_monitor,users.name,users.last_name,CONCAT(users.name,users.last_name) as nom_monitor from MODSISCADI_ENCUESTAS join users on MODSISCADI_ENCUESTAS.cod_monitor = users.id where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by users.id,users.name,users.last_name order by users.name");

		$categories_1=array();	
		$moni=array();	
		foreach($arraymoni as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_1=array($category->nom_monitor);
			array_push($moni,$categories_1);
		endforeach;

		$categories_2=array();	
		$muni=array();	
		foreach($arraymuni as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_2=array($category->NOM_MPIO);
			array_push($muni,$categories_2);
		endforeach;		

		$categories_3=array();	
		$depto=array();	
		foreach($arraydepto as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_3=array($category->NOM_DPTO);
			array_push($depto,$categories_3);
		endforeach;		

		$categories_4=array();	
		$misi=array();	
		foreach($arraymision as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_4=array($category->nom_mision);
			array_push($misi,$categories_4);
		endforeach;	
		return  Response::json(array('moni'=>$moni,'depto'=>$depto,'muni'=>$muni,'mision'=>$misi));
	}

	public function postSiscadiidmonitor()
	{
		//Consultas para obtener el lable año seleccionado
		$arrayinter = DB::table('MODSISCADI_ENCUESTAS')
			->WHERE('cod_monitor','=',Input::get('monitor'))
			->select('intervencion')
			->groupBy('intervencion')
			->orderBy('intervencion','desc')
			->get();

		$arraymonicountcomi[0] = DB::select("select count(intervencion) as num_comi, tipo,cod_monitor from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' and  cod_monitor ='".Input::get('monitor')."' group by tipo, cod_monitor");
		$arraymonicountbene[0] = DB::select("select count(intervencion) as num_bene, tipo,cod_monitor from MODSISCADI_ENCUESTAS where tipo='Beneficiarios' and piloto='No' and  cod_monitor ='".Input::get('monitor')."' group by tipo, cod_monitor");

		if(empty($arraymonicountcomi[0])){$arrayintercountcomi[0] = 0;}
		else{$arrayintercountcomi[0]=(int)$arraymonicountcomi[0][0]->num_comi;}

		if(empty($arraymonicountbene[0])){$arrayintercountcomi[1] = 0;}
		else{$arrayintercountcomi[1]=(int)$arraymonicountbene[0][0]->num_bene;}

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();	

		return  Response::json(array('arrayintercountcomi'=>$arrayintercountcomi,'arrayinter'=>$arrayinter,'arraymonitor'=>$arraymonitor));

	}


	public function postSiscadiidmoniinter()
	{			
		//consulta para traer los departamentos según datos del formulario
		$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc");

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();
		
	

		$arraymunicount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='monitor' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");
		$arrayvdacount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");

		$label=array();				
		foreach($arraydpto as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_4=array($category->NOM_DPTO);
			array_push($label,$categories_4);
		endforeach;	

		for($i=0; $i<count($arraydpto); $i++){
			$arraydptocountbene1[$i] = DB::select("select  DEPARTAMENTOS.NOM_DPTO,sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".$arraydpto[$i]->COD_DPTO."' group by  DEPARTAMENTOS.NOM_DPTO"); 
			if(empty($arraydptocountbene1[$i])){$arraydptocountbene[$i] = "0";}
			else{$arraydptocountbene[$i]=(int)$arraydptocountbene1[$i][0]->num;}
			$arraydptocountcomi1[$i] = DB::select("select  DEPARTAMENTOS.NOM_DPTO,sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".$arraydpto[$i]->COD_DPTO."' group by  DEPARTAMENTOS.NOM_DPTO");
			if(empty($arraydptocountcomi1[$i])){$arraydptocountcomi[$i] = "0";}
			else{$arraydptocountcomi[$i]=(int)$arraydptocountcomi1[$i][0]->num;}
		}
		return  Response::json(array('arraydpto'=>$arraydpto,'arraymonitor'=>$arraymonitor,'arraydptocountbene'=>$arraydptocountbene,'arraydptocountcomi'=>$arraydptocountcomi,'nombre'=>$label));
	}			

	public function postSiscadiidmonidepto()
	{
		//Consultas para obtener el lable del departamentoseleccionada
		$arraydpto = DB::table('DEPARTAMENTOS')
			->WHERE('COD_DPTO','=',Input::get('departamento')) 
			->select('NOM_DPTO')
			->get();
		
		//consulta para traer los departamentos según datos del formulario
		$arraympio = DB::select("select MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where   MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE where MUNICIPIOS.COD_DPTO=".Input::get('departamento')."group by MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO order by MUNICIPIOS.NOM_MPIO asc");

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();

		$arrayvdacount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");

		$label=array();				
		foreach($arraympio as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_4=array($category->NOM_MPIO);
			array_push($label,$categories_4);
		endforeach;	


		for($i=0; $i<count($arraympio); $i++){
			$arraympiocountbene1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join	(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_DANE='".$arraympio[$i]->COD_DANE."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");

			if(empty($arraympiocountbene1[$i])){$arraympiocountbene[$i] = "0";}
			else{$arraympiocountbene[$i]=(int)$arraympiocountbene1[$i][0]->num;}

			$arraympiocountcomi1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join	(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_DANE='".$arraympio[$i]->COD_DANE."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");

			if(empty($arraympiocountcomi1[$i])){$arraympiocountcomi[$i] = "0";}
			else{$arraympiocountcomi[$i]=(int)$arraympiocountcomi1[$i][0]->num;}
		}
		return  Response::json(array('arraympio'=>$arraympio,'arraymonitor'=>$arraymonitor,'arraympiocountbene'=>$arraympiocountbene,'arraympiocountcomi'=>$arraympiocountcomi,'nombre'=>$label,'arraydpto'=>$arraydpto));
	}	

	public function postSiscadiidmonimuni()
	{

		//Consultas para obtener el lable del departamentoseleccionada
		$arraydpto = DB::table('DEPARTAMENTOS')
			->WHERE('COD_DPTO','=',Input::get('departamento')) 
			->select('NOM_DPTO')
			->get();

		//Consultas para obtener el lable del municipio seleccionado
		$arraymuni = DB::table('MUNICIPIOS')
			->WHERE('COD_DANE','=',Input::get('municipio')) 
			->select('NOM_MPIO')
			->get();
		
		//consulta para traer los departamentos según datos del formulario
		$arrayvda = DB::select("SELECT MODSISCADI_VEREDAS.COD_UNODC,MODSISCADI_VEREDAS.NOM_TERR FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where   MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."'  and SUBSTRING(MODSISCADI_VEREDAS.COD_UNODC,1,5)='".Input::get('municipio')."' group By MODSISCADI_VEREDAS.COD_UNODC,MODSISCADI_VEREDAS.NOM_TERR order by MODSISCADI_VEREDAS.NOM_TERR asc");

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();

		$label=array();				
		foreach($arrayvda as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_4=array($category->NOM_TERR);
			array_push($label,$categories_4);
		endforeach;	

		for($i=0; $i<count($arrayvda); $i++){
			$arrayvdacountbene1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_UNODC='".$arrayvda[$i]->COD_UNODC."' group by DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");
			if(empty($arrayvdacountbene1[$i])){$arrayvdacountbene[$i] = "0";}
			else{$arrayvdacountbene[$i]=(int)$arrayvdacountbene1[$i][0]->num;}

			$arrayvdacountcomi1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join (select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join (SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_UNODC='".$arrayvda[$i]->COD_UNODC."' group by DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");
			if(empty($arrayvdacountcomi1[$i])){$arrayvdacountcomi[$i] = "0";}
			else{$arrayvdacountcomi[$i]=(int)$arrayvdacountcomi1[$i][0]->num;}
		}
		return  Response::json(array('arrayvda'=>$arrayvda,'arraymonitor'=>$arraymonitor,'arrayvdacountcomi'=>$arrayvdacountcomi,'arrayvdacountbene'=>$arrayvdacountbene,'nombre'=>$label,'arraydpto'=>$arraydpto,'arraymuni'=>$arraymuni));
		//return  Response::json(array('arrayvda'=>$arrayvda,'arraymonitor'=>$arraymonitor,'arrayvdacountcomi'=>$arrayvdacountcomi,'arrayvdacountbene'=>$arrayvdacountbene,'nombre'=>$label,'arraydpto'=>$arraydpto,'arraymuni'=>$arraymuni));
	}

	public function postSiscadiidmonivda()
	{

		//Consultas para obtener el lable del departamentoseleccionada
		$arraydpto = DB::table('DEPARTAMENTOS')
			->WHERE('COD_DPTO','=',Input::get('departamento')) 
			->select('NOM_DPTO')
			->get();

		//Consultas para obtener el lable del municipio seleccionado
		$arraymuni = DB::table('MUNICIPIOS')
			->WHERE('COD_DANE','=',Input::get('municipio')) 
			->select('NOM_MPIO')
			->get();		

		//Consultas para obtener el lable del vereda seleccionada
		$arrayvda = DB::table('MODSISCADI_VEREDAS')
			->WHERE('COD_UNODC','=',Input::get('vereda')) 
			->select('NOM_TERR')
			->get();		

		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('users','MODSISCADI_ENCUESTAS.cod_monitor','=','users.id')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('users.id','users.name','users.last_name')
			->groupBy('users.id')
			->groupBy('users.name')
			->groupBy('users.last_name')
			->orderBy('users.name')
			->get();			
	
		$mision=DB::select("select MODSISCADI_ENCUESTAS.mision,MODSISCADI_MISION.nom_mision, count(MODSISCADI_ENCUESTAS.mision)as cuenta  from MODSISCADI_MISION full join MODSISCADI_ENCUESTAS on MODSISCADI_MISION.mision=MODSISCADI_ENCUESTAS.mision where MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group by MODSISCADI_ENCUESTAS.mision,MODSISCADI_MISION.nom_mision");

		$label=array();				
		foreach($mision as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_4=array($category->nom_mision);
			array_push($label,$categories_4);
		endforeach;	

		$grafica=array();
			for($i=0; $i<count($mision); $i++){
				$arrayvdacountbene1[$i] = DB::select("SELECT cod_unodc, mision, COUNT(mision)as num_comi FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where tipo='Beneficiarios'and MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and mision='".$mision[$i]->mision."'  group by mision, tipo,cod_unodc");
				if(empty($arrayvdacountbene1[$i])){$arrayvdacountbene[$i] = 0;}
				else{$arrayvdacountbene[$i]=(int)$arrayvdacountbene1[$i][0]->num_comi;}
				$arrayvdacountcomi1[$i] = DB::select("SELECT cod_unodc, mision, COUNT(mision)as num_bene FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where tipo='Comite'and MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and mision='".$mision[$i]->mision."'  group by mision, tipo,cod_unodc");
				if(empty($arrayvdacountcomi1[$i])){$arrayvdacountcomi[$i] = 0;}
				else{$arrayvdacountcomi[$i]=(int)$arrayvdacountcomi1[$i][0]->num_bene;}

				$randomcolor = '#' . strtoupper(dechex(rand(0,10000000)));//genera un codigo de color html aleatorio
				$grafica1['y']=(int)$mision[$i]->cuenta;// y: es el total de situaciones adm_gme
				$grafica1['color']=$randomcolor;// color de esta clase	
				$grafica1['drilldown']['name']=$mision[$i]->nom_mision;	//nombre de la serie = Adm_GME
				$grafica1['drilldown']['categories']=['Beneficiarios','Comite'];
				$grafica1['drilldown']['data'][]=$arrayvdacountbene[$i];
				$grafica1['drilldown']['data'][]=$arrayvdacountcomi[$i];
				$grafica1['drilldown']['color']=$randomcolor;	
				array_push($grafica,$grafica1);
				unset($grafica1);//borra el arreglo grafica1 porque estaba concatenando los valores de arrayvdacountbene y arrayvdacountcomi en el data

			}
		return  Response::json(array('grafica'=>$grafica,'nombre'=>$label,'arrayvda'=>$arrayvda,'arraymonitor'=>$arraymonitor,'arraydpto'=>$arraydpto,'arraymuni'=>$arraymuni));
		//return  Response::json(array('arrayvda'=>$arrayvda,'arraymonitor'=>$arraymonitor,'arrayvdacountcomi'=>$arrayvdacountcomi,'arrayvdacountbene'=>$arrayvdacountbene,'nombre'=>$label,'arraydpto'=>$arraydpto,'arraymuni'=>$arraymuni));
	}
	public function siscadi_repestadistic()
	{
		//Consultas para obtener los datos del txt
		$jsonarray = file_get_contents(public_path().'\assets\statistics\Encuesta_Beneficiarios_Diagnostico_Territorial.json');				
		$jsonarray2 = json_decode($jsonarray, true);

		//variables para buscar depto		
		$deptosencu[] = null;
		$deptoarray = array();
		$a = 0;
		//almacena del json  los datos de depto para buscarlos y agruparlos
		for ($i=0; $i < count($jsonarray2); $i++) { 
			//array_push ( $deptosencu[$i] , $jsonarray2[$i]['Cod_Dpto'] );
			$deptosencu[$i] = $jsonarray2[$i]['Cod_Dpto'];							
		}
		for ($j=0; $j < count($deptosencu); $j++) { 
			if (in_array($deptosencu[$j], $deptoarray)) {
			    	//no hace nada 
			    } else {
			    	//almacena en un arreglo
			    	$deptoarray[$a] = $deptosencu[$j];
			    	$a = 1+$a;
			    }
		}
		//----------------------------copia abajo
		//Consultas para obtener el número de procesos por estado y son viables
		$jsonarray = file_get_contents(public_path().'\assets\statistics\Encuesta_Beneficiarios_Diagnostico_Territorial.json');
		$jsonarray2 = json_decode($jsonarray, true);

		$jsonarraypoblacion = file_get_contents(public_path().'\assets\statistics\Encuesta_Diagnostico_Territorial_Poblacion.json');
		$jsonarraypoblacion2 = json_decode($jsonarraypoblacion, true);		

		if (Input::get('dpto')!='' && Input::get('mpio')!='' && Input::get('vere')!='') {			
			$variable = 'veredal';
		}elseif (Input::get('dpto')!='' && Input::get('mpio')!='' && Input::get('vere')=='') {
			$variable = 'municipal';			
		}elseif (Input::get('dpto')!='' && Input::get('mpio')=='' && Input::get('vere')=='') {
			$variable = 'departamental';			
		}elseif (Input::get('dpto')=='' && Input::get('mpio')=='' && Input::get('vere')=='') {
			$variable = 'nacional';			
		}

		//variables para estadistica
		$estadEBDT[] = null;		
		$a = 0;
		for ($i=0; $i < count($jsonarray2); $i++) { 
			switch ($variable) {
				case 'veredal':
					if ($jsonarray2[$i]['Cod_Terr']== Input::get('vere')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'municipal':
					if ($jsonarray2[$i]['Cod_mpio']== Input::get('mpio')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'departamental':
					if ($jsonarray2[$i]['Cod_Dpto']== Input::get('dpto')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'nacional':
					$estadEBDT[$a] = $jsonarray2[$i];
					$a = 1+$a;
					break;
			}
		}
		$estadEDTP[] = null;		
		$a = 0;
		for ($i=0; $i < count($jsonarraypoblacion2); $i++) { 
			switch ($variable) {
				case 'veredal':
					if ($jsonarraypoblacion2[$i]['Cod_Terr']== Input::get('vere')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'municipal':
					if ($jsonarraypoblacion2[$i]['Cod_mpio']== Input::get('mpio')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'departamental':
					if ($jsonarraypoblacion2[$i]['Cod_Dpto']== Input::get('dpto')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'nacional':
					$estadEDTP[$a] = $jsonarraypoblacion2[$i];
					$a = 1+$a;
					break;
			}
		}

		//return $relculilici;
		//----------------------------hasta aca		
		
		//Consultas para obtener los tipos de mision segun la intervencion 
		$deptoarrayfin = DB::table('DEPARTAMENTOS')
		->whereIn('DEPARTAMENTOS.COD_DPTO', $deptoarray)		
		->select('DEPARTAMENTOS.COD_DPTO','DEPARTAMENTOS.NOM_DPTO')
		->orderBy('DEPARTAMENTOS.NOM_DPTO')		
		->get();
		//retorna un array con los deptos para el combobox
		return View::make('modulosiscadi.diagnosticoterritorial', array('deptoarray' =>$deptoarrayfin));		
	}
	public function postReporestadompio()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$jsonarray = file_get_contents(public_path().'\assets\statistics\Encuesta_Beneficiarios_Diagnostico_Territorial.json');				
		$jsonarray2 = json_decode($jsonarray, true);
		
		//variables para buscar mpio
		$mpiosencu[] = null;
		$mpiosarray = array();
		$a = 0;
		//almacena del json  los datos de mpio para buscarlos y agruparlos
		for ($i=0; $i < count($jsonarray2); $i++) { 
			if ($jsonarray2[$i]['Cod_Dpto']==Input::get('dpto')) {
				$mpiosencu[$a] = $jsonarray2[$i]['Cod_mpio'];
				$a = 1+$a;
			}			
		}
		$a = 0;
		for ($j=0; $j < count($mpiosencu); $j++) { 
			if (in_array($mpiosencu[$j], $mpiosarray)) {
			    	//no hace nada 
			} else {
			    	//almacena en un arreglo
			  	$mpiosarray[$a] = $mpiosencu[$j];
			   	$a = 1+$a;
			}
		}
			
		$arraympio = DB::table('MUNICIPIOS')
		->whereIn('COD_DANE', $mpiosarray)
		->select('NOM_MPIO','COD_DANE')
		->orderBy('NOM_MPIO')
		->get();
		//retorna un array con los municipios para el combobox
		return Response::json($arraympio);
	}
	public function postReporestadovered()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$jsonarray = file_get_contents(public_path().'\assets\statistics\Encuesta_Beneficiarios_Diagnostico_Territorial.json');				
		$jsonarray2 = json_decode($jsonarray, true);
		
		//variables para buscar mpio  Nombre_Terr
		$veresencu[] = null;
		$verearray = array();
		$a = 0;
		//almacena del json  los datos de mpio para buscarlos y agruparlos
		for ($i=0; $i < count($jsonarray2); $i++) { 
			//if ($jsonarray2[$i]['Cod_mpio']==Input::get('mpio')) {
			if ($jsonarray2[$i]['Cod_mpio']== Input::get('mpio')) {
				$veresencu[$a]['Nombre_Terr'] = $jsonarray2[$i]['Nombre_Terr'];
				$veresencu[$a]['Cod_Terr'] = $jsonarray2[$i]['Cod_Terr'];
				$a = 1+$a;
			}			
		}
		$a = 0;		
		for ($j=0; $j < count($veresencu); $j++) { 
			if (in_array($veresencu[$j], $verearray)) {
			    	//no hace nada 
			    } else {
			    	//almacena en un arreglo
			    	$verearray[$a]['Nombre_Terr'] = $veresencu[$j]['Nombre_Terr'];
			    	$verearray[$a]['Cod_Terr'] = $veresencu[$j]['Cod_Terr'];
			    	$a = 1+$a;
			    }
		}		
		return Response::json($verearray);
	}
	public function postReporestadtotal()
	{
		//Consultas para obtener el número de procesos por estado y son viables
		$jsonarray = file_get_contents(public_path().'\assets\statistics\Encuesta_Beneficiarios_Diagnostico_Territorial.json');
		$jsonarray2 = json_decode($jsonarray, true);

		$jsonarraypoblacion = file_get_contents(public_path().'\assets\statistics\Encuesta_Diagnostico_Territorial_Poblacion.json');
		$jsonarraypoblacion2 = json_decode($jsonarraypoblacion, true);	

		$jsonarrayactproduc = file_get_contents(public_path().'\assets\statistics\Encuesta_Diagnostico_Territorial_Act_Productivas.json');
		$jsonarrayactproduc2 = json_decode($jsonarrayactproduc, true);	

		if (Input::get('dpto')!='' && Input::get('mpio')!='' && Input::get('vere')!='') {			
			$variable = 'veredal';
		}elseif (Input::get('dpto')!='' && Input::get('mpio')!='' && Input::get('vere')=='') {
			$variable = 'municipal';			
		}elseif (Input::get('dpto')!='' && Input::get('mpio')=='' && Input::get('vere')=='') {
			$variable = 'departamental';			
		}elseif (Input::get('dpto')=='' && Input::get('mpio')=='' && Input::get('vere')=='') {
			$variable = 'nacional';			
		}

		//variables para estadistica
		$estadEBDT[] = null;		
		$a = 0;
		for ($i=0; $i < count($jsonarray2); $i++) { 
			switch ($variable) {
				case 'veredal':
					if ($jsonarray2[$i]['Cod_Terr']== Input::get('vere')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'municipal':
					if ($jsonarray2[$i]['Cod_mpio']== Input::get('mpio')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'departamental':
					if ($jsonarray2[$i]['Cod_Dpto']== Input::get('dpto')) {
						$estadEBDT[$a] = $jsonarray2[$i];
						$a = 1+$a;
					}
					break;
				case 'nacional':
					$estadEBDT[$a] = $jsonarray2[$i];
					$a = 1+$a;
					break;
			}
		}
		$estadEDTP[] = null;		
		$a = 0;
		for ($i=0; $i < count($jsonarraypoblacion2); $i++) { 
			switch ($variable) {
				case 'veredal':
					if ($jsonarraypoblacion2[$i]['Cod_Terr']== Input::get('vere')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'municipal':
					if ($jsonarraypoblacion2[$i]['Cod_mpio']== Input::get('mpio')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'departamental':
					if ($jsonarraypoblacion2[$i]['Cod_Dpto']== Input::get('dpto')) {
						$estadEDTP[$a] = $jsonarraypoblacion2[$i];
						$a = 1+$a;
					}
					break;
				case 'nacional':
					$estadEDTP[$a] = $jsonarraypoblacion2[$i];
					$a = 1+$a;
					break;
			}
		}
		$estadEDTAP[] = null;		
		$a = 0;
		for ($i=0; $i < count($jsonarrayactproduc2); $i++) { 
			switch ($variable) {
				case 'veredal':
					if ($jsonarrayactproduc2[$i]['Cod_Terr']== Input::get('vere')) {
						$estadEDTAP[$a] = $jsonarrayactproduc2[$i];
						$a = 1+$a;
					}
					break;
				case 'municipal':
					if ($jsonarrayactproduc2[$i]['Cod_mpio']== Input::get('mpio')) {
						$estadEDTAP[$a] = $jsonarrayactproduc2[$i];
						$a = 1+$a;
					}
					break;
				case 'departamental':
					if ($jsonarrayactproduc2[$i]['Cod_Dpto']== Input::get('dpto')) {
						$estadEDTAP[$a] = $jsonarrayactproduc2[$i];
						$a = 1+$a;
					}
					break;
				case 'nacional':
					$estadEDTAP[$a] = $jsonarrayactproduc2[$i];
					$a = 1+$a;
					break;
			}
		}
		//1. Población por grupo de edades
		$masculino = 0;
		$Masc1 = $Masc2 = $Masc3 = $Masc4 = $Masc5 = $Masc6 = $Masc7 = $Masc8 = $Masc9 = $Masc10 = $Masc11 = $Masc12 = $Masc13 = $Masc14 = $Masc15 = $Masc16 = $Masc17 = 0;
		$femenino = 0;
		$Femn1 = $Femn2 = $Femn3 = $Femn4 = $Femn5 = $Femn6 = $Femn7 = $Femn8 = $Femn9 = $Femn10 = $Femn11 = $Femn12 = $Femn13 = $Femn14 = $Femn15 = $Femn16 = $Femn17 = 0;
		for ($i=0; $i < count($estadEDTP); $i++) { 
			if ($estadEDTP[$i]['Genero'] == "Masculino") {
				$masculino = 1+$masculino;
				if ($estadEDTP[$i]['Edad']<=4) {
					$Masc1 = 1+$Masc1;
				}elseif ($estadEDTP[$i]['Edad']<=9 && $estadEDTP[$i]['Edad']>=5) {
					$Masc2 = 1+$Masc2;
				}elseif ($estadEDTP[$i]['Edad']<=14 && $estadEDTP[$i]['Edad']>=10) {
					$Masc3 = 1+$Masc3;
				}elseif ($estadEDTP[$i]['Edad']<=19 && $estadEDTP[$i]['Edad']>=15) {
					$Masc4 = 1+$Masc4;
				}elseif ($estadEDTP[$i]['Edad']<=24 && $estadEDTP[$i]['Edad']>=20) {
					$Masc5 = 1+$Masc5;
				}elseif ($estadEDTP[$i]['Edad']<=29 && $estadEDTP[$i]['Edad']>=25) {
					$Masc6 = 1+$Masc6;
				}elseif ($estadEDTP[$i]['Edad']<=34 && $estadEDTP[$i]['Edad']>=30) {
					$Masc7 = 1+$Masc7;
				}elseif ($estadEDTP[$i]['Edad']<=39 && $estadEDTP[$i]['Edad']>=35) {
					$Masc8 = 1+$Masc8;
				}elseif ($estadEDTP[$i]['Edad']<=44 && $estadEDTP[$i]['Edad']>=40) {
					$Masc9 = 1+$Masc9;
				}elseif ($estadEDTP[$i]['Edad']<=49 && $estadEDTP[$i]['Edad']>=45) {
					$Masc10 = 1+$Masc10;
				}elseif ($estadEDTP[$i]['Edad']<=54 && $estadEDTP[$i]['Edad']>=50) {
					$Masc11 = 1+$Masc11;
				}elseif ($estadEDTP[$i]['Edad']<=59 && $estadEDTP[$i]['Edad']>=55) {
					$Masc12 = 1+$Masc12;
				}elseif ($estadEDTP[$i]['Edad']<=64 && $estadEDTP[$i]['Edad']>=60) {
					$Masc13 = 1+$Masc13;
				}elseif ($estadEDTP[$i]['Edad']<=69 && $estadEDTP[$i]['Edad']>=65) {
					$Masc14 = 1+$Masc14;
				}elseif ($estadEDTP[$i]['Edad']<=74 && $estadEDTP[$i]['Edad']>=70) {
					$Masc15 = 1+$Masc15;
				}elseif ($estadEDTP[$i]['Edad']<=79 && $estadEDTP[$i]['Edad']>=75) {
					$Masc16 = 1+$Masc16;
				}elseif ($estadEDTP[$i]['Edad']>=80) {
					$Masc17 = 1+$Masc17;
				}		

			}elseif ($estadEDTP[$i]['Genero'] == "Femenino") {
				$femenino = 1+$femenino;
				if ($estadEDTP[$i]['Edad']<=4) {
					$Femn1 = 1+$Femn1;
				}elseif ($estadEDTP[$i]['Edad']<=9 && $estadEDTP[$i]['Edad']>=5) {
					$Femn2 = 1+$Femn2;
				}elseif ($estadEDTP[$i]['Edad']<=14 && $estadEDTP[$i]['Edad']>=10) {
					$Femn3 = 1+$Femn3;
				}elseif ($estadEDTP[$i]['Edad']<=19 && $estadEDTP[$i]['Edad']>=15) {
					$Femn4 = 1+$Femn4;
				}elseif ($estadEDTP[$i]['Edad']<=24 && $estadEDTP[$i]['Edad']>=20) {
					$Femn5 = 1+$Femn5;
				}elseif ($estadEDTP[$i]['Edad']<=29 && $estadEDTP[$i]['Edad']>=25) {
					$Femn6 = 1+$Femn6;
				}elseif ($estadEDTP[$i]['Edad']<=34 && $estadEDTP[$i]['Edad']>=30) {
					$Femn7 = 1+$Femn7;
				}elseif ($estadEDTP[$i]['Edad']<=39 && $estadEDTP[$i]['Edad']>=35) {
					$Femn8 = 1+$Femn8;
				}elseif ($estadEDTP[$i]['Edad']<=44 && $estadEDTP[$i]['Edad']>=40) {
					$Femn9 = 1+$Femn9;
				}elseif ($estadEDTP[$i]['Edad']<=49 && $estadEDTP[$i]['Edad']>=45) {
					$Femn10 = 1+$Femn10;
				}elseif ($estadEDTP[$i]['Edad']<=54 && $estadEDTP[$i]['Edad']>=50) {
					$Femn11 = 1+$Femn11;
				}elseif ($estadEDTP[$i]['Edad']<=59 && $estadEDTP[$i]['Edad']>=55) {
					$Femn12 = 1+$Femn12;
				}elseif ($estadEDTP[$i]['Edad']<=64 && $estadEDTP[$i]['Edad']>=60) {
					$Femn13 = 1+$Femn13;
				}elseif ($estadEDTP[$i]['Edad']<=69 && $estadEDTP[$i]['Edad']>=65) {
					$Femn14 = 1+$Femn14;
				}elseif ($estadEDTP[$i]['Edad']<=74 && $estadEDTP[$i]['Edad']>=70) {
					$Femn15 = 1+$Femn15;
				}elseif ($estadEDTP[$i]['Edad']<=79 && $estadEDTP[$i]['Edad']>=75) {
					$Femn16 = 1+$Femn16;
				}elseif ($estadEDTP[$i]['Edad']>=80) {
					$Femn17 = 1+$Femn17;
				}
			}
		}
		
		$Masc1=(((-1)*$Masc1)/($masculino+$femenino)*100);
		$Masc2=(((-1)*$Masc2)/($masculino+$femenino)*100);
		$Masc3=(((-1)*$Masc3)/($masculino+$femenino)*100);
		$Masc4=(((-1)*$Masc4)/($masculino+$femenino)*100);
		$Masc5=(((-1)*$Masc5)/($masculino+$femenino)*100);
		$Masc6=(((-1)*$Masc6)/($masculino+$femenino)*100);
		$Masc7=(((-1)*$Masc7)/($masculino+$femenino)*100);
		$Masc8=(((-1)*$Masc8)/($masculino+$femenino)*100);
		$Masc9=(((-1)*$Masc9)/($masculino+$femenino)*100);
		$Masc10=(((-1)*$Masc10)/($masculino+$femenino)*100);
		$Masc11=(((-1)*$Masc11)/($masculino+$femenino)*100);
		$Masc12=(((-1)*$Masc12)/($masculino+$femenino)*100);
		$Masc13=(((-1)*$Masc13)/($masculino+$femenino)*100);
		$Masc14=(((-1)*$Masc14)/($masculino+$femenino)*100);
		$Masc15=(((-1)*$Masc15)/($masculino+$femenino)*100);
		$Masc16=(((-1)*$Masc16)/($masculino+$femenino)*100);
		$Masc17=(((-1)*$Masc17)/($masculino+$femenino)*100);
		$Femn1=(($Femn1)/($masculino+$femenino)*100);
		$Femn2=(($Femn2)/($masculino+$femenino)*100);
		$Femn3=(($Femn3)/($masculino+$femenino)*100);
		$Femn4=(($Femn4)/($masculino+$femenino)*100);
		$Femn5=(($Femn5)/($masculino+$femenino)*100);
		$Femn6=(($Femn6)/($masculino+$femenino)*100);
		$Femn7=(($Femn7)/($masculino+$femenino)*100);
		$Femn8=(($Femn8)/($masculino+$femenino)*100);
		$Femn9=(($Femn9)/($masculino+$femenino)*100);
		$Femn10=(($Femn10)/($masculino+$femenino)*100);
		$Femn11=(($Femn11)/($masculino+$femenino)*100);
		$Femn12=(($Femn12)/($masculino+$femenino)*100);
		$Femn13=(($Femn13)/($masculino+$femenino)*100);
		$Femn14=(($Femn14)/($masculino+$femenino)*100);
		$Femn15=(($Femn15)/($masculino+$femenino)*100);
		$Femn16=(($Femn16)/($masculino+$femenino)*100);
		$Femn17=(($Femn17)/($masculino+$femenino)*100);		
		
		$masculino1 = [$Masc1, $Masc2, $Masc3, $Masc4, $Masc5, $Masc6, $Masc7, $Masc8, $Masc9, $Masc10, $Masc11, $Masc12, $Masc13, $Masc14, $Masc15, $Masc16, $Masc17];
		$femenino1 = [$Femn1, $Femn2, $Femn3, $Femn4, $Femn5, $Femn6, $Femn7, $Femn8, $Femn9, $Femn10, $Femn11, $Femn12, $Femn13, $Femn14, $Femn15, $Femn16, $Femn17];

		//2. Jefatura de hogar por grupo de edades

		$categories = ['0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65-69', '70-74', '75-79', '80 + '];
		$masculino = 0;
		$Masc1 = $Masc2 = $Masc3 = $Masc4 = $Masc5 = $Masc6 = $Masc7 = $Masc8 = $Masc9 = $Masc10 = $Masc11 = $Masc12 = $Masc13 = $Masc14 = $Masc15 = $Masc16 = $Masc17 = 0;
		$femenino = 0;
		$Femn1 = $Femn2 = $Femn3 = $Femn4 = $Femn5 = $Femn6 = $Femn7 = $Femn8 = $Femn9 = $Femn10 = $Femn11 = $Femn12 = $Femn13 = $Femn14 = $Femn15 = $Femn16 = $Femn17 = 0;
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Genero'] == "Masculino") {
				$masculino = 1+$masculino;
				if ($estadEBDT[$i]['Edad']<=4) {
					$Masc1 = 1+$Masc1;
				}elseif ($estadEBDT[$i]['Edad']<=9 && $estadEBDT[$i]['Edad']>=5) {
					$Masc2 = 1+$Masc2;
				}elseif ($estadEBDT[$i]['Edad']<=14 && $estadEBDT[$i]['Edad']>=10) {
					$Masc3 = 1+$Masc3;
				}elseif ($estadEBDT[$i]['Edad']<=19 && $estadEBDT[$i]['Edad']>=15) {
					$Masc4 = 1+$Masc4;
				}elseif ($estadEBDT[$i]['Edad']<=24 && $estadEBDT[$i]['Edad']>=20) {
					$Masc5 = 1+$Masc5;
				}elseif ($estadEBDT[$i]['Edad']<=29 && $estadEBDT[$i]['Edad']>=25) {
					$Masc6 = 1+$Masc6;
				}elseif ($estadEBDT[$i]['Edad']<=34 && $estadEBDT[$i]['Edad']>=30) {
					$Masc7 = 1+$Masc7;
				}elseif ($estadEBDT[$i]['Edad']<=39 && $estadEBDT[$i]['Edad']>=35) {
					$Masc8 = 1+$Masc8;
				}elseif ($estadEBDT[$i]['Edad']<=44 && $estadEBDT[$i]['Edad']>=40) {
					$Masc9 = 1+$Masc9;
				}elseif ($estadEBDT[$i]['Edad']<=49 && $estadEBDT[$i]['Edad']>=45) {
					$Masc10 = 1+$Masc10;
				}elseif ($estadEBDT[$i]['Edad']<=54 && $estadEBDT[$i]['Edad']>=50) {
					$Masc11 = 1+$Masc11;
				}elseif ($estadEBDT[$i]['Edad']<=59 && $estadEBDT[$i]['Edad']>=55) {
					$Masc12 = 1+$Masc12;
				}elseif ($estadEBDT[$i]['Edad']<=64 && $estadEBDT[$i]['Edad']>=60) {
					$Masc13 = 1+$Masc13;
				}elseif ($estadEBDT[$i]['Edad']<=69 && $estadEBDT[$i]['Edad']>=65) {
					$Masc14 = 1+$Masc14;
				}elseif ($estadEBDT[$i]['Edad']<=74 && $estadEBDT[$i]['Edad']>=70) {
					$Masc15 = 1+$Masc15;
				}elseif ($estadEBDT[$i]['Edad']<=79 && $estadEBDT[$i]['Edad']>=75) {
					$Masc16 = 1+$Masc16;
				}elseif ($estadEBDT[$i]['Edad']>=80) {
					$Masc17 = 1+$Masc17;
				}		

			}elseif ($estadEBDT[$i]['Genero'] == "Femenino") {
				$femenino = 1+$femenino;
				if ($estadEBDT[$i]['Edad']<=4) {
					$Femn1 = 1+$Femn1;
				}elseif ($estadEBDT[$i]['Edad']<=9 && $estadEBDT[$i]['Edad']>=5) {
					$Femn2 = 1+$Femn2;
				}elseif ($estadEBDT[$i]['Edad']<=14 && $estadEBDT[$i]['Edad']>=10) {
					$Femn3 = 1+$Femn3;
				}elseif ($estadEBDT[$i]['Edad']<=19 && $estadEBDT[$i]['Edad']>=15) {
					$Femn4 = 1+$Femn4;
				}elseif ($estadEBDT[$i]['Edad']<=24 && $estadEBDT[$i]['Edad']>=20) {
					$Femn5 = 1+$Femn5;
				}elseif ($estadEBDT[$i]['Edad']<=29 && $estadEBDT[$i]['Edad']>=25) {
					$Femn6 = 1+$Femn6;
				}elseif ($estadEBDT[$i]['Edad']<=34 && $estadEBDT[$i]['Edad']>=30) {
					$Femn7 = 1+$Femn7;
				}elseif ($estadEBDT[$i]['Edad']<=39 && $estadEBDT[$i]['Edad']>=35) {
					$Femn8 = 1+$Femn8;
				}elseif ($estadEBDT[$i]['Edad']<=44 && $estadEBDT[$i]['Edad']>=40) {
					$Femn9 = 1+$Femn9;
				}elseif ($estadEBDT[$i]['Edad']<=49 && $estadEBDT[$i]['Edad']>=45) {
					$Femn10 = 1+$Femn10;
				}elseif ($estadEBDT[$i]['Edad']<=54 && $estadEBDT[$i]['Edad']>=50) {
					$Femn11 = 1+$Femn11;
				}elseif ($estadEBDT[$i]['Edad']<=59 && $estadEBDT[$i]['Edad']>=55) {
					$Femn12 = 1+$Femn12;
				}elseif ($estadEBDT[$i]['Edad']<=64 && $estadEBDT[$i]['Edad']>=60) {
					$Femn13 = 1+$Femn13;
				}elseif ($estadEBDT[$i]['Edad']<=69 && $estadEBDT[$i]['Edad']>=65) {
					$Femn14 = 1+$Femn14;
				}elseif ($estadEBDT[$i]['Edad']<=74 && $estadEBDT[$i]['Edad']>=70) {
					$Femn15 = 1+$Femn15;
				}elseif ($estadEBDT[$i]['Edad']<=79 && $estadEBDT[$i]['Edad']>=75) {
					$Femn16 = 1+$Femn16;
				}elseif ($estadEBDT[$i]['Edad']>=80) {
					$Femn17 = 1+$Femn17;
				}
			}
		}
		
		$Masc1=(((-1)*$Masc1)/($masculino+$femenino)*100);
		$Masc2=(((-1)*$Masc2)/($masculino+$femenino)*100);
		$Masc3=(((-1)*$Masc3)/($masculino+$femenino)*100);
		$Masc4=(((-1)*$Masc4)/($masculino+$femenino)*100);
		$Masc5=(((-1)*$Masc5)/($masculino+$femenino)*100);
		$Masc6=(((-1)*$Masc6)/($masculino+$femenino)*100);
		$Masc7=(((-1)*$Masc7)/($masculino+$femenino)*100);
		$Masc8=(((-1)*$Masc8)/($masculino+$femenino)*100);
		$Masc9=(((-1)*$Masc9)/($masculino+$femenino)*100);
		$Masc10=(((-1)*$Masc10)/($masculino+$femenino)*100);
		$Masc11=(((-1)*$Masc11)/($masculino+$femenino)*100);
		$Masc12=(((-1)*$Masc12)/($masculino+$femenino)*100);
		$Masc13=(((-1)*$Masc13)/($masculino+$femenino)*100);
		$Masc14=(((-1)*$Masc14)/($masculino+$femenino)*100);
		$Masc15=(((-1)*$Masc15)/($masculino+$femenino)*100);
		$Masc16=(((-1)*$Masc16)/($masculino+$femenino)*100);
		$Masc17=(((-1)*$Masc17)/($masculino+$femenino)*100);
		$Femn1=(($Femn1)/($masculino+$femenino)*100);
		$Femn2=(($Femn2)/($masculino+$femenino)*100);
		$Femn3=(($Femn3)/($masculino+$femenino)*100);
		$Femn4=(($Femn4)/($masculino+$femenino)*100);
		$Femn5=(($Femn5)/($masculino+$femenino)*100);
		$Femn6=(($Femn6)/($masculino+$femenino)*100);
		$Femn7=(($Femn7)/($masculino+$femenino)*100);
		$Femn8=(($Femn8)/($masculino+$femenino)*100);
		$Femn9=(($Femn9)/($masculino+$femenino)*100);
		$Femn10=(($Femn10)/($masculino+$femenino)*100);
		$Femn11=(($Femn11)/($masculino+$femenino)*100);
		$Femn12=(($Femn12)/($masculino+$femenino)*100);
		$Femn13=(($Femn13)/($masculino+$femenino)*100);
		$Femn14=(($Femn14)/($masculino+$femenino)*100);
		$Femn15=(($Femn15)/($masculino+$femenino)*100);
		$Femn16=(($Femn16)/($masculino+$femenino)*100);
		$Femn17=(($Femn17)/($masculino+$femenino)*100);		
		
		$masculino2 = [$Masc1, $Masc2, $Masc3, $Masc4, $Masc5, $Masc6, $Masc7, $Masc8, $Masc9, $Masc10, $Masc11, $Masc12, $Masc13, $Masc14, $Masc15, $Masc16, $Masc17];
		$femenino2 = [$Femn1, $Femn2, $Femn3, $Femn4, $Femn5, $Femn6, $Femn7, $Femn8, $Femn9, $Femn10, $Femn11, $Femn12, $Femn13, $Femn14, $Femn15, $Femn16, $Femn17];
		
		//4. Autoreconocimiento étnico
				
		$grupoetnicoa = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$grupoetnicoa[$i] = $estadEBDT[$i]['Grupo_etnico'];		
		}		
		$grupoetnico = array_count_values($grupoetnicoa);
		$a = 0;
		$etnico = array();
		if (!empty($grupoetnico)) {
			for ($i=0; $i < count($grupoetnico); $i++) { 
				if (array_keys($grupoetnico)[$i] != 'Ninguno') {
					$etnico[$a]['name'] = array_keys($grupoetnico)[$i];
					$etnico[$a]['data'] = array(array_values($grupoetnico)[$i]);
					$etnico[$a]['data'][0] = round(($etnico[$a]['data'][0]/count($estadEBDT))*100);
					$a = 1+$a;				
				}			
			}
		}
		//5. Razones para llegar al municipio
		
		$naciompio = 0;		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Nacio_Mpio']=='No') {
				$naciompio = 1+$naciompio;	
			}			
		}
		$naciompiono = round(($naciompio/count($estadEBDT))*100);

		$Razones_a = $Razones_b = $Razones_c = $Razones_d = $Razones_e = $Razones_f = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Razones_a']==1) {
				$Razones_a = 1+$Razones_a;	
			}
			if ($estadEBDT[$i]['Razones_b']==1) {
				$Razones_b = 1+$Razones_b;	
			}
			if ($estadEBDT[$i]['Razones_c']==1) {
				$Razones_c = 1+$Razones_c;	
			}
			if ($estadEBDT[$i]['Razones_d']==1) {
				$Razones_d = 1+$Razones_d;	
			}
			if ($estadEBDT[$i]['Razones_e']==1) {
				$Razones_e = 1+$Razones_e;	
			}
			if ($estadEBDT[$i]['Razones_f']==1) {
				$Razones_f = 1+$Razones_f;	
			}
		}
		$Razones = array('Porque su familia vivía en el municipio' => round(($Razones_a/$naciompio)*100), 'Porque encontró una opción de trabajo en actividades lícitas' => round(($Razones_b/$naciompio)*100), 'Porque fue desplazado por la violencia donde vivía' => round(($Razones_c/$naciompio)*100), 'Por posibilidades de generar ingresos de la explotación minera' => round(($Razones_d/$naciompio)*100), 'Por posibilidades de generar ingresos relacionados con los cultivos ilícitos' => round(($Razones_e/$naciompio)*100), 'Otras' => round(($Razones_f/$naciompio)*100) );
		arsort($Razones);
		//6. preguntas de texto
		$embarazoparto = $mujeresparto = 0;
		//&& ($estadEDTP[$i]['Embarazo_Parto']=='Embarazo' || $estadEDTP[$i]['Embarazo_Parto']=='Embarazo y Lactancia' || $estadEDTP[$i]['Embarazo_Parto']=='Lactando')
		for ($i=0; $i < count($estadEDTP); $i++) { 
			if ($estadEDTP[$i]['Genero']=='Femenino') {
				$mujeresparto = 1+$mujeresparto;
				//$embarazoparto = 1+$embarazoparto;
				if ($estadEDTP[$i]['Embarazo_Parto']!='NA' && $estadEDTP[$i]['Embarazo_Parto']!='Ninguna' && $estadEDTP[$i]['Embarazo_Parto']!='Na') {
					$embarazoparto = 1+$embarazoparto;
				}	
			}			
		}
		$embarazopartotot = round(($embarazoparto/$mujeresparto)*100);

		$discapacidad = 0;		
		for ($i=0; $i < count($estadEDTP); $i++) { 
			if ($estadEDTP[$i]['Discapacidad']=='Si') {
				$discapacidad = 1+$discapacidad;	
			}			
		}
		$discapacidadtot = round(($discapacidad/count($estadEDTP))*100);

		$analfabeh = $analfabem = $mayoraquince = 0;
		for ($i=0; $i < count($estadEDTP); $i++) { 
			if ($estadEDTP[$i]['Edad']>15) {
				$mayoraquince =1+$mayoraquince;
			}
			if ($estadEDTP[$i]['Analfabetismo']==1 && $estadEDTP[$i]['Genero']=='Masculino') {
				$analfabeh = 1+$analfabeh;	
			}
			if ($estadEDTP[$i]['Analfabetismo']==1 && $estadEDTP[$i]['Genero']=='Femenino') {
				$analfabem = 1+$analfabem;	
			}			
		}
		$analfabetismotot = round((($analfabeh+$analfabem)/$mayoraquince)*100);
		$analfabetismohtot = round(($analfabeh/($analfabeh+$analfabem))*100);
		$analfabetismomtot = round(($analfabem/($analfabeh+$analfabem))*100);

		$arraytitular = array();		
		for ($i=0; $i < count($estadEDTP); $i++) { 
			$arraytitular[$i] = $estadEDTP[$i]['CC_Titular'];		
		}		
		$arraytitulargroup = array_count_values($arraytitular);
		
		$arraytitularfilter = array();
		if (!empty($arraytitulargroup)) {
			for ($i=0; $i < count($arraytitulargroup); $i++) { 
				if (array_keys($arraytitulargroup)[$i] != 'Ninguno') {
					
					$arraytitularfilter[$i] = array_values($arraytitulargroup)[$i];
								
				}			
			}
		}

		$promperhoga = round((array_sum($arraytitularfilter)/count($arraytitularfilter)));

//----------------------------INDICADORES DE CAPITAL SOCIAL---------------------------------
		//1. Espacios de participación
		$Participacion_a = $Participacion_b = $Participacion_c = $Participacion_d = $Participacion_e = $Participacion_f = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Participacion_a']==1) {
				$Participacion_a = 1+$Participacion_a;	
			}
			if ($estadEBDT[$i]['Participacion_b']==1) {
				$Participacion_b = 1+$Participacion_b;	
			}
			if ($estadEBDT[$i]['Participacion_c']==1) {
				$Participacion_c = 1+$Participacion_c;	
			}
			if ($estadEBDT[$i]['Participacion_d']==1) {
				$Participacion_d = 1+$Participacion_d;	
			}
			if ($estadEBDT[$i]['Participacion_e']==1) {
				$Participacion_e = 1+$Participacion_e;	
			}
			if ($estadEBDT[$i]['Participacion_f']==1) {
				$Participacion_f = 1+$Participacion_f;	
			}
		}
		$Participacion = array('JAC' => round(($Participacion_a/count($estadEBDT))*100), 'Veedurías ciudadanas' => round(($Participacion_b/count($estadEBDT))*100), 'Consejo municipal de desarrollo rural' => round(($Participacion_c/count($estadEBDT))*100), 'Copacos' => round(($Participacion_d/count($estadEBDT))*100), 'Otro' => round(($Participacion_e/count($estadEBDT))*100), 'Ninguno' => round(($Participacion_f/count($estadEBDT))*100) );
		arsort($Participacion);
		
		//2. Participación en actividades comunitarias
		$Actividad_comunitaria_a = $Actividad_comunitaria_b = $Actividad_comunitaria_c = $Actividad_comunitaria_d = $Actividad_comunitaria_e = $Actividad_comunitaria_f = $Actividad_comunitaria_g = $Actividad_comunitaria_h = $Actividad_comunitaria_i = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Actividad_comunitaria_a']==1) {
				$Actividad_comunitaria_a = 1+$Actividad_comunitaria_a;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_b']==1) {
				$Actividad_comunitaria_b = 1+$Actividad_comunitaria_b;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_c']==1) {
				$Actividad_comunitaria_c = 1+$Actividad_comunitaria_c;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_d']==1) {
				$Actividad_comunitaria_d = 1+$Actividad_comunitaria_d;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_e']==1) {
				$Actividad_comunitaria_e = 1+$Actividad_comunitaria_e;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_f']==1) {
				$Actividad_comunitaria_f = 1+$Actividad_comunitaria_f;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_g']==1) {
				$Actividad_comunitaria_g = 1+$Actividad_comunitaria_g;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_h']==1) {
				$Actividad_comunitaria_h = 1+$Actividad_comunitaria_h;	
			}
			if ($estadEBDT[$i]['Actividad_comunitaria_i']==1) {
				$Actividad_comunitaria_i = 1+$Actividad_comunitaria_i;	
			}
		}
		$actividad_comunitaria = array('Culturales' => round(($Actividad_comunitaria_a/count($estadEBDT))*100), 'Deportivas' => round(($Actividad_comunitaria_b/count($estadEBDT))*100), 'Religiosas' => round(($Actividad_comunitaria_c/count($estadEBDT))*100), 'Recreativas' => round(($Actividad_comunitaria_d/count($estadEBDT))*100), 'Mercados campesinos' => round(($Actividad_comunitaria_e/count($estadEBDT))*100), 'Reuniones comunitarias' => round(($Actividad_comunitaria_f/count($estadEBDT))*100), 'Trabajo comunitario' => round(($Actividad_comunitaria_g/count($estadEBDT))*100), 'Otras' => round(($Actividad_comunitaria_h/count($estadEBDT))*100), 'Ninguna' => round(($Actividad_comunitaria_i/count($estadEBDT))*100));
		arsort($actividad_comunitaria);

		//3. Vinculación a organizaciones
		$Vinculo_org_a = $Vinculo_org_b = $Vinculo_org_c = $Vinculo_org_d = $Vinculo_org_e = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Vinculo_org_a']==1) {
				$Vinculo_org_a = 1+$Vinculo_org_a;	
			}
			if ($estadEBDT[$i]['Vinculo_org_b']==1) {
				$Vinculo_org_b = 1+$Vinculo_org_b;	
			}
			if ($estadEBDT[$i]['Vinculo_org_c']==1) {
				$Vinculo_org_c = 1+$Vinculo_org_c;	
			}
			if ($estadEBDT[$i]['Vinculo_org_d']==1) {
				$Vinculo_org_d = 1+$Vinculo_org_d;	
			}
			if ($estadEBDT[$i]['Vinculo_org_e']==1) {
				$Vinculo_org_e = 1+$Vinculo_org_e;	
			}			
		}
		$vinculo_org = array('Productiva' => round(($Vinculo_org_a/count($estadEBDT))*100), 'Comunitaria' => round(($Vinculo_org_b/count($estadEBDT))*100), 'Ambiental' => round(($Vinculo_org_c/count($estadEBDT))*100), 'Otra' => round(($Vinculo_org_d/count($estadEBDT))*100), 'Ninguna' => round(($Vinculo_org_e/count($estadEBDT))*100));
		arsort($vinculo_org);

		//4. Percepción de las relaciones comunitarias
		$gruporelaccomuni = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$gruporelaccomuni[$i] = $estadEBDT[$i]['Relaciones_comunidad'];		
		}		
		$gruporelaccomunid = array_count_values($gruporelaccomuni);
		$a = 0;
		$gruporelaccomunidad = array();
		if (!empty($gruporelaccomunid)) {
			for ($i=0; $i < count($gruporelaccomunid); $i++) { 
				$gruporelaccomunidad[$a]['name'] = array_keys($gruporelaccomunid)[$i];					
				$gruporelaccomunidad[$a]['data'] = array(array_values($gruporelaccomunid)[$i]);
				$gruporelaccomunidad[$a]['data'][0] = round(($gruporelaccomunidad[$a]['data'][0]/count($estadEBDT))*100);
				$a = 1+$a;				
			}
		}
		
//----------------------------RELACIÓN CON CULTIVOS ILÍCITOS---------------------------------
		//1. Porcentaje de personas que tienen relación con cultivos ilícitos
		$arraygruporelculilici = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$arraygruporelculilici[$i] = $estadEBDT[$i]['Cultivos_Ilicitos'];		
		}		
		$gruporelculilici = array_count_values($arraygruporelculilici);
		$a = 0;
		arsort($gruporelculilici);
		$relculilici = array();		
		if (!empty($gruporelculilici)) {
			for ($i=0; $i < count($gruporelculilici); $i++) { 				
				$relculilici[$a]['name'] = array_keys($gruporelculilici)[$i];					
				$relculilici[$a]['y'] = array_values($gruporelculilici)[$i];
				$a = 1+$a;				
			}
		}

		$relculilicisi = 0;
		for ($i=0; $i < count($relculilici); $i++) { 
			if ($relculilici[$i]['name']=='Si') {
				$relculilicisi = $relculilici[$i]['y'];
			}
		}

		//2. Razones de vinculación a los cultivos ilícitos
		
		$Vinculacion_CI_a = $Vinculacion_CI_b = $Vinculacion_CI_c = $Vinculacion_CI_d = $Vinculacion_CI_e = $Vinculacion_CI_f = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Vinculacion_CI_a']==1) {
				$Vinculacion_CI_a = 1+$Vinculacion_CI_a;	
			}
			if ($estadEBDT[$i]['Vinculacion_CI_b']==1) {
				$Vinculacion_CI_b = 1+$Vinculacion_CI_b;	
			}
			if ($estadEBDT[$i]['Vinculacion_CI_c']==1) {
				$Vinculacion_CI_c = 1+$Vinculacion_CI_c;	
			}
			if ($estadEBDT[$i]['Vinculacion_CI_d']==1) {
				$Vinculacion_CI_d = 1+$Vinculacion_CI_d;	
			}
			if ($estadEBDT[$i]['Vinculacion_CI_e']==1) {
				$Vinculacion_CI_e = 1+$Vinculacion_CI_e;	
			}
			if ($estadEBDT[$i]['Vinculacion_CI_f']==1) {
				$Vinculacion_CI_f = 1+$Vinculacion_CI_f;	
			}			
		}
		
		$vinculacionci = array('Porque era lo más rentable' => round(($Vinculacion_CI_a/$relculilicisi)*100), 'Porque no había más opciones' => round(($Vinculacion_CI_b/$relculilicisi)*100), 'Porque no había compradores para los otros productos' => round(($Vinculacion_CI_c/$relculilicisi)*100), 'Por presión de un Grupo Armado al Margen de la Ley' => round(($Vinculacion_CI_d/$relculilicisi)*100), 'Porque es lo que siempre se ha cultivado en la región' => round(($Vinculacion_CI_e/$relculilicisi)*100), 'Otra' => round(($Vinculacion_CI_f/$relculilicisi)*100));
		arsort($vinculacionci);

		//3. Relación con los cultivos ilícitos

		$Relacion_CI_a = $Relacion_CI_b = $Relacion_CI_c = $Relacion_CI_d = $Relacion_CI_e = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Relacion_CI_a']==1) {
				$Relacion_CI_a = 1+$Relacion_CI_a;	
			}
			if ($estadEBDT[$i]['Relacion_CI_b']==1) {
				$Relacion_CI_b = 1+$Relacion_CI_b;	
			}
			if ($estadEBDT[$i]['Relacion_CI_c']==1) {
				$Relacion_CI_c = 1+$Relacion_CI_c;	
			}
			if ($estadEBDT[$i]['Relacion_CI_d']==1) {
				$Relacion_CI_d = 1+$Relacion_CI_d;	
			}
			if ($estadEBDT[$i]['Relacion_CI_e']==1) {
				$Relacion_CI_e = 1+$Relacion_CI_e;	
			}						
		}
		
		$relacionci = array('Propietario' => round(($Relacion_CI_a/$relculilicisi)*100), 'Recolector' => round(($Relacion_CI_b/$relculilicisi)*100), 'Comercializador' => round(($Relacion_CI_c/$relculilicisi)*100), 'Transformador' => round(($Relacion_CI_d/$relculilicisi)*100), 'Otra' => round(($Relacion_CI_e/$relculilicisi)*100));
		arsort($relacionci);
		
		//4. Área de cultivos ilícitos reportada por los encuestados Area_CI_Valor


//----------------------------INDICADORES ECONÓMICOS---------------------------------
		//1. Índice de pobreza multidimensional
		
		$rangoipm = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$rangoipm[$i] = $estadEBDT[$i]['Rango_IPM'];		
		}		
		$rangoipma = array_count_values($rangoipm);
		$a = 0;
		ksort($rangoipma);
		$rangoipmtot = array();		
		if (!empty($rangoipma)) {
			for ($i=0; $i < count($rangoipma); $i++) { 				
				$rangoipmtot[$a]['name'] = array_keys($rangoipma)[$i];					
				$rangoipmtot[$a]['y'] = array_values($rangoipma)[$i];
				//$rangoipmtot[$a]['y'] = round((array_values($rangoipma)[$i]/count($estadEBDT))*100);
				$a = 1+$a;				
			}
		}
		$pobresino = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$pobresino[$i] = $estadEBDT[$i]['Rango_IPM_02'];		
		}		
		$pobresinoa = array_count_values($pobresino);
		$a = 0;
		ksort($pobresinoa);
		$pobresinotot = array();		
		if (!empty($pobresinoa)) {
			for ($i=0; $i < count($pobresinoa); $i++) { 				
				$pobresinotot[$a]['name'] = array_keys($pobresinoa)[$i];					
				$pobresinotot[$a]['y'] = array_values($pobresinoa)[$i];				
				$a = 1+$a;				
			}
		}

		// SGSSS
		$sgsss = array();
		$a = 0;		
		for ($i=0; $i < count($estadEDTP); $i++) { 
			if ($estadEDTP[$i]['SGSSS']!='Ns/Nr' && $estadEDTP[$i]['SGSSS']!='No afiliado') {
				$sgsss[$a] = $estadEDTP[$i]['SGSSS'];
				$a = 1+$a;
			}
					
		}
		$sgssstot = round((array_sum(array_count_values($sgsss))/count($estadEDTP))*100);

		// Estudia
		



		//2. Índice de Pobreza Monetaria
		
		$rangopm = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$rangopm[$i] = $estadEBDT[$i]['Rango_PM'];		
		}		
		$rangopma = array_count_values($rangopm);
		$a = 0;
		ksort($rangopma);
		$rangopmtot = array();		
		if (!empty($rangopma)) {
			for ($i=0; $i < count($rangopma); $i++) { 				
				$rangopmtot[$a]['name'] = array_keys($rangopma)[$i];					
				$rangopmtot[$a]['y'] = array_values($rangopma)[$i];				
				$a = 1+$a;				
			}
		}
		$hogarespobr = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$hogarespobr[$i] = $estadEBDT[$i]['Rango_PM_02'];		
		}		
		$hogarespobra = array_count_values($hogarespobr);
		$a = 0;
		ksort($hogarespobra);
		$hogarespobratot = array();		
		if (!empty($hogarespobra)) {
			for ($i=0; $i < count($hogarespobra); $i++) { 				
				$hogarespobratot[$a]['name'] = array_keys($hogarespobra)[$i];					
				$hogarespobratot[$a]['y'] = array_values($hogarespobra)[$i];				
				$a = 1+$a;				
			}
		}

//----------------------------ACTIVIDADES PRODUCTIVAS---------------------------------
		//1. Actividades productivas principales

		$lineapp = array();
		$haprodagro = array();
		for ($i=0; $i < count($estadEDTAP); $i++) { 
			$lineapp[$i] = $estadEDTAP[$i]['Linea_PP'];
			$haprodagro[$i]	= $estadEDTAP[$i]['Area_PP_has'];	
		}

		$haprodagrotot = round(array_sum($haprodagro));

		$lineappa = array_count_values($lineapp);
		$a = 0;
		arsort($lineappa);
		$lineapptot = array();

		if (!empty($lineappa)) {
			for ($i=0; $i < count($lineappa); $i++) { 				
				$lineapptot[array_keys($lineappa)[$i]] = round((array_values($lineappa)[$i]/count($estadEDTAP))*100);
			}
		}
		arsort($lineapptot);	

		//2. Acceso a capacitaciones y/o asistencia técnica
		
		$Acceso_cat_a = $Acceso_cat_b = $Acceso_cat_c = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Acceso_cat_a']==1) {
				$Acceso_cat_a = 1+$Acceso_cat_a;	
			}
			if ($estadEBDT[$i]['Acceso_cat_b']==1) {
				$Acceso_cat_b = 1+$Acceso_cat_b;	
			}
			if ($estadEBDT[$i]['Acceso_cat_c']==1) {
				$Acceso_cat_c = 1+$Acceso_cat_c;	
			}
			
		}
		$accesocat = array('Asistencia técnica' => round(($Acceso_cat_a/count($estadEBDT))*100), 'Capacitaciones' => round(($Acceso_cat_b/count($estadEBDT))*100), 'Ninguno' => round(($Acceso_cat_c/count($estadEBDT))*100));
		ksort($accesocat);

		//3. Venta de productos de las actividades productivas

		$Ventas_a = $Ventas_b = $Ventas_c = $Ventas_d = $Ventas_e = $Ventas_f = $Ventas_g = $Ventas_h = $Ventas_i = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Ventas_a']==1) {
				$Ventas_a = 1+$Ventas_a;	
			}
			if ($estadEBDT[$i]['Ventas_b']==1) {
				$Ventas_b = 1+$Ventas_b;	
			}
			if ($estadEBDT[$i]['Ventas_c']==1) {
				$Ventas_c = 1+$Ventas_c;	
			}
			if ($estadEBDT[$i]['Ventas_d']==1) {
				$Ventas_d = 1+$Ventas_d;	
			}
			if ($estadEBDT[$i]['Ventas_e']==1) {
				$Ventas_e = 1+$Ventas_e;	
			}
			if ($estadEBDT[$i]['Ventas_f']==1) {
				$Ventas_f = 1+$Ventas_f;	
			}
			if ($estadEBDT[$i]['Ventas_g']==1) {
				$Ventas_g = 1+$Ventas_g;	
			}
			if ($estadEBDT[$i]['Ventas_h']==1) {
				$Ventas_h = 1+$Ventas_h;	
			}
			if ($estadEBDT[$i]['Ventas_i']==1) {
				$Ventas_i = 1+$Ventas_i;	
			}
		}
		$ventasproduc = array('A su organización productiva' => round(($Ventas_a/count($estadEBDT))*100), 'A otra organización productiva' => round(($Ventas_b/count($estadEBDT))*100), 'A intermediarios' => round(($Ventas_c/count($estadEBDT))*100), 'Al consumidor final' => round(($Ventas_d/count($estadEBDT))*100), 'Comercio al por menor (plaza, galería)' => round(($Ventas_e/count($estadEBDT))*100), 'Otros' => round(($Ventas_f/count($estadEBDT))*100), 'No vende' => round(($Ventas_g/count($estadEBDT))*100), 'Ns/Nr' => round(($Ventas_h/count($estadEBDT))*100), 'NA' => round(($Ventas_i/count($estadEBDT))*100));
		arsort($ventasproduc);

//----------------------------TERRITORIO Y MEDIO AMBIENTE---------------------------------
		//1. Relación de tenencia de la tierra

		$relacionpredio = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$relacionpredio[$i] = $estadEBDT[$i]['Relacion_predio'];		
		}		
		$relacionpredioa = array_count_values($relacionpredio);
		$a = 0;
		arsort($relacionpredioa);
		
		$relacionprediotot = array();		
		if (!empty($relacionpredioa)) {
			for ($i=0; $i < count($relacionpredioa); $i++) { 				
				$relacionprediotot[$a]['name'] = array_keys($relacionpredioa)[$i];					
				$relacionprediotot[$a]['y'] = array_values($relacionpredioa)[$i];
				$a = 1+$a;				
			}
		}

		//2. Participación en procesos de formalización de la propiedad

		$formalizpredio = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$formalizpredio[$i] = $estadEBDT[$i]['Formalizacion'];		
		}		
		$formalizpredioa = array_count_values($formalizpredio);
		$a = 0;
		arsort($formalizpredioa);
		
		$formalizprediotot = array();		
		if (!empty($formalizpredioa)) {
			for ($i=0; $i < count($formalizpredioa); $i++) { 				
				$formalizprediotot[$a]['name'] = array_keys($formalizpredioa)[$i];					
				$formalizprediotot[$a]['y'] = array_values($formalizpredioa)[$i];
				$a = 1+$a;				
			}
		}	

		//3. Participación en actividades relacionadas con la conservación

		$Actividades_a = $Actividades_b = $Actividades_c = $Actividades_d = $Actividades_e = $Actividades_f = $Actividades_g = $Actividades_h = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Actividades_a']==1) {
				$Actividades_a = 1+$Actividades_a;	
			}
			if ($estadEBDT[$i]['Actividades_b']==1) {
				$Actividades_b = 1+$Actividades_b;	
			}
			if ($estadEBDT[$i]['Actividades_c']==1) {
				$Actividades_c = 1+$Actividades_c;	
			}
			if ($estadEBDT[$i]['Actividades_d']==1) {
				$Actividades_d = 1+$Actividades_d;	
			}
			if ($estadEBDT[$i]['Actividades_e']==1) {
				$Actividades_e = 1+$Actividades_e;	
			}
			if ($estadEBDT[$i]['Actividades_f']==1) {
				$Actividades_f = 1+$Actividades_f;	
			}
			if ($estadEBDT[$i]['Actividades_g']==1) {
				$Actividades_g = 1+$Actividades_g;	
			}
			if ($estadEBDT[$i]['Actividades_h']==1) {
				$Actividades_h = 1+$Actividades_h;	
			}			
		}
		$actividpartici = array('Protección de nacimientos de agua y/o rondas hídricas' => round(($Actividades_a/count($estadEBDT))*100), 'Conservación del bosque' => round(($Actividades_b/count($estadEBDT))*100), 'Reforestación / Revegetalización' => round(($Actividades_c/count($estadEBDT))*100), 'Incorporación de residuos orgánicos en los cultivos' => round(($Actividades_d/count($estadEBDT))*100), 'Establecimiento de cercas vivas' => round(($Actividades_e/count($estadEBDT))*100), 'Otro' => round(($Actividades_f/count($estadEBDT))*100), 'Ninguna' => round(($Actividades_g/count($estadEBDT))*100), 'Ns/Nr' => round(($Actividades_h/count($estadEBDT))*100));
		arsort($actividpartici);

		//4. Acuerdos ambientales que existen en la comunidad

		$Acuerdo_a = $Acuerdo_b = $Acuerdo_c = $Acuerdo_d = $Acuerdo_e = $Acuerdo_f = $Acuerdo_g = $Acuerdo_h = $Acuerdo_i = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Acuerdo_a']==1) {
				$Acuerdo_a = 1+$Acuerdo_a;	
			}
			if ($estadEBDT[$i]['Acuerdo_b']==1) {
				$Acuerdo_b = 1+$Acuerdo_b;	
			}
			if ($estadEBDT[$i]['Acuerdo_c']==1) {
				$Acuerdo_c = 1+$Acuerdo_c;	
			}
			if ($estadEBDT[$i]['Acuerdo_d']==1) {
				$Acuerdo_d = 1+$Acuerdo_d;	
			}
			if ($estadEBDT[$i]['Acuerdo_e']==1) {
				$Acuerdo_e = 1+$Acuerdo_e;	
			}
			if ($estadEBDT[$i]['Acuerdo_f']==1) {
				$Acuerdo_f = 1+$Acuerdo_f;	
			}
			if ($estadEBDT[$i]['Acuerdo_g']==1) {
				$Acuerdo_g = 1+$Acuerdo_g;	
			}
			if ($estadEBDT[$i]['Acuerdo_h']==1) {
				$Acuerdo_h = 1+$Acuerdo_h;	
			}
			if ($estadEBDT[$i]['Acuerdo_i']==1) {
				$Acuerdo_i = 1+$Acuerdo_i;	
			}
		}
		$acuerdoambien = array('Área de conservación' => round(($Acuerdo_a/count($estadEBDT))*100), 'Acuerdos de no quema' => round(($Acuerdo_b/count($estadEBDT))*100), 'Acuerdos de no tala' => round(($Acuerdo_c/count($estadEBDT))*100), 'Vedas de caza y/o pesca' => round(($Acuerdo_d/count($estadEBDT))*100), 'Restricción de uso de fuentes hídricas' => round(($Acuerdo_e/count($estadEBDT))*100), 'Restricción de zonas para disposición de residuos' => round(($Acuerdo_f/count($estadEBDT))*100), 'Otro' => round(($Acuerdo_g/count($estadEBDT))*100), 'Ns/Nr' => round(($Acuerdo_h/count($estadEBDT))*100), 'Ninguna' => round(($Acuerdo_i/count($estadEBDT))*100));
		arsort($acuerdoambien);

		//5. Implementación de buenas prácticas ambientales  o amigables con el medio ambiente

		$Practicas_a = $Practicas_b = $Practicas_c = $Practicas_d = $Practicas_e = $Practicas_f = $Practicas_g = $Practicas_h = $Practicas_i = $Practicas_j = $Practicas_k = $Practicas_l = $Practicas_m = 0;	
		for ($i=0; $i < count($estadEBDT); $i++) { 
			if ($estadEBDT[$i]['Practicas_a']==1) {
				$Practicas_a = 1+$Practicas_a;	
			}
			if ($estadEBDT[$i]['Practicas_b']==1) {
				$Practicas_b = 1+$Practicas_b;	
			}
			if ($estadEBDT[$i]['Practicas_c']==1) {
				$Practicas_c = 1+$Practicas_c;	
			}
			if ($estadEBDT[$i]['Practicas_d']==1) {
				$Practicas_d = 1+$Practicas_d;	
			}
			if ($estadEBDT[$i]['Practicas_e']==1) {
				$Practicas_e = 1+$Practicas_e;	
			}
			if ($estadEBDT[$i]['Practicas_f']==1) {
				$Practicas_f = 1+$Practicas_f;	
			}
			if ($estadEBDT[$i]['Practicas_g']==1) {
				$Practicas_g = 1+$Practicas_g;	
			}
			if ($estadEBDT[$i]['Practicas_h']==1) {
				$Practicas_h = 1+$Practicas_h;	
			}
			if ($estadEBDT[$i]['Practicas_i']==1) {
				$Practicas_i = 1+$Practicas_i;	
			}
			if ($estadEBDT[$i]['Practicas_j']==1) {
				$Practicas_j = 1+$Practicas_j;	
			}
			if ($estadEBDT[$i]['Practicas_k']==1) {
				$Practicas_k = 1+$Practicas_k;	
			}
			if ($estadEBDT[$i]['Practicas_l']==1) {
				$Practicas_l = 1+$Practicas_l;	
			}			
		}
		$practicaambien = array('Roza' => round(($Practicas_a/count($estadEBDT))*100), 'Tala' => round(($Practicas_b/count($estadEBDT))*100), 'Quema' => round(($Practicas_c/count($estadEBDT))*100), 'Arado' => round(($Practicas_d/count($estadEBDT))*100), 'Descanso del terreno' => round(($Practicas_e/count($estadEBDT))*100), 'Rotación de cultivos' => round(($Practicas_f/count($estadEBDT))*100), 'Labranza mínima' => round(($Practicas_g/count($estadEBDT))*100), 'Siembra en curvas de nivel' => round(($Practicas_h/count($estadEBDT))*100), 'Asocio de cultivos' => round(($Practicas_i/count($estadEBDT))*100), 'Otra' => round(($Practicas_j/count($estadEBDT))*100), 'Ns/Nr' => round(($Practicas_k/count($estadEBDT))*100), 'Ninguna' => round(($Practicas_l/count($estadEBDT))*100));
		arsort($practicaambien);

//----------------------------TERRITORIO Y MEDIO AMBIENTE---------------------------------
		//1. Existencia de vías de acceso terrestre

		$viasacceso = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$viasacceso[$i] = $estadEBDT[$i]['Vias'];		
		}		
		$viasaccesoa = array_count_values($viasacceso);
		$a = 0;
		arsort($viasaccesoa);
		
		$viasaccesotot = array();		
		if (!empty($viasaccesoa)) {
			for ($i=0; $i < count($viasaccesoa); $i++) { 				
				$viasaccesotot[$a]['name'] = array_keys($viasaccesoa)[$i];					
				$viasaccesotot[$a]['y'] = array_values($viasaccesoa)[$i];
				$a = 1+$a;				
			}
		}

		//2. Estado de las vías de acceso

		$estadovias = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$estadovias[$i] = $estadEBDT[$i]['Estado_vias'];		
		}		
		$estadoviasa = array_count_values($estadovias);
		$a = 0;
		ksort($estadoviasa);
		
		$estadoviastot = array();		
		if (!empty($estadoviasa)) {
			for ($i=0; $i < count($estadoviasa); $i++) {
				
				$estadoviastot[array_keys($estadoviasa)[$i]] = round((array_values($estadoviasa)[$i]/count($estadEDTAP))*100);
				/*
				$estadoviastot[$a]['name'] = array_keys($estadoviasa)[$i];					
				$estadoviastot[$a]['y'] = array_values($estadoviasa)[$i];
				$a = 1+$a;
				*/
			}
		}

		//3. Tipo de transporte utilizado

		$topitransp = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$topitransp[$i] = $estadEBDT[$i]['Tipo_transporte'];		
		}		
		$topitranspa = array_count_values($topitransp);
		$a = 0;
		arsort($topitranspa);
		
		$topitransptot = array();		
		if (!empty($topitranspa)) {
			for ($i=0; $i < count($topitranspa); $i++) { 				
				$topitransptot[$a]['name'] = array_keys($topitranspa)[$i];					
				$topitransptot[$a]['y'] = array_values($topitranspa)[$i];
				$a = 1+$a;				
			}
		}

		//4. Disponibilidad de agua para el consumo

		$obtenagua = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$obtenagua[$i] = $estadEBDT[$i]['Obtencion_agua'];		
		}		

		$obtenaguaa = array_count_values($obtenagua);
		$a = 0;
		arsort($obtenaguaa);
		$obtenaguatot = array();

		if (!empty($obtenaguaa)) {
			for ($i=0; $i < count($obtenaguaa); $i++) { 				
				$obtenaguatot[array_keys($obtenaguaa)[$i]] = round((array_values($obtenaguaa)[$i]/count($estadEBDT))*100);
			}
		}
		arsort($obtenaguatot);

		//5. Disponibilidad de agua para las actividades productivas

		$obtenaguaap = array();		
		for ($i=0; $i < count($estadEBDT); $i++) { 
			$obtenaguaap[$i] = $estadEBDT[$i]['Obtencion_agua_ap'];		
		}		

		$obtenaguaapa = array_count_values($obtenaguaap);
		$a = 0;
		arsort($obtenaguaapa);
		$obtenaguaaptot = array();

		if (!empty($obtenaguaapa)) {
			for ($i=0; $i < count($obtenaguaapa); $i++) { 				
				$obtenaguaaptot[array_keys($obtenaguaapa)[$i]] = round((array_values($obtenaguaapa)[$i]/count($estadEBDT))*100);
			}
		}
		arsort($obtenaguaaptot);

		//retorno todas las variables para las graficas 
		return Response::json(array('variable'=>$estadEDTP, 'categories'=>$categories, 'masculino'=>round(($masculino/count($estadEBDT))*100), 'femenino'=>round(($femenino/count($estadEBDT))*100), 'masculino1'=>$masculino1, 'femenino1'=>$femenino1,'masculino2'=>$masculino2, 'femenino2'=>$femenino2, 'etnico'=>$etnico, 'naciompiono'=>$naciompiono, 'razones'=>$Razones, 'embarazoparto'=>$embarazopartotot, 'discapacidad'=>$discapacidadtot, 'analfabetismotot'=>$analfabetismotot, 'analfabetismohtot'=>$analfabetismohtot, 'analfabetismomtot'=>$analfabetismomtot, 'promperhoga'=>$promperhoga, 'espaciospart'=>$Participacion, 'actividadcomuni'=>$actividad_comunitaria, 'vinculoorg'=>$vinculo_org, 'gruporelaccomunidad'=>$gruporelaccomunidad, 'relculilici'=>$relculilici, 'vinculacionci'=>$vinculacionci, 'relacionci'=>$relacionci, 'rangoipmtot'=>$rangoipmtot, 'pobresinotot'=>$pobresinotot, 'sgssstot'=>$sgssstot, 'rangopmtot'=>$rangopmtot, 'hogarespobratot'=>$hogarespobratot, 'lineapptot'=>$lineapptot, 'haprodagrotot'=>$haprodagrotot, 'accesocat'=>$accesocat, 'ventasproduc'=>$ventasproduc, 'relacionprediotot'=>$relacionprediotot, 'formalizprediotot'=>$formalizprediotot, 'actividpartici'=>$actividpartici, 'acuerdoambien'=>$acuerdoambien, 'practicaambien'=>$practicaambien, 'viasaccesotot'=>$viasaccesotot, 'estadoviastot'=>$estadoviastot, 'topitransptot'=>$topitransptot, 'obtenaguatot'=>$obtenaguatot, 'obtenaguaaptot'=>$obtenaguaaptot));
	}
}