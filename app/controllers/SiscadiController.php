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
			$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
		
		
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
			
	
		}
		

		return  Response::json(array('arraydpto'=>$arraydpto));
				

	}

	public function postSiscadirepmpio()
	{

$monitor=Input::get('monitor');
if ($monitor !=""){//condicional que filtra los departamentos por monitor, sirve para reporte por monitor
			
		//Consultas para obtener los municipios segun los datos selccionados 
		$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc"); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas
		
		
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			
		//Consultas para obtener los municipios segun los datos selccionados 
		$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='".Input::get('piloto')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc"); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas
			
	
		}

			

		return  Response::json(array('arraymuni'=>$arraymuni));
				

	}

	public function postSiscadirepmoni()
	{

		$arraymoni=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.intervencion',Input::get('intervencion'))
			->where('MODSISCADI_ENCUESTAS.mision',Input::get('mision'))
			->where('MODSISCADI_ENCUESTAS.piloto',Input::get('piloto'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
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
			
		$tabla_encuestas_benef=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		
		

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
			
		$tabla_encuestas_ccvcs=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite' group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		
		

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
				
			}else// omite la impresion de la informacion de encuestas a comite e imprime la parte final del reporte
			{
				
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
		
		$tabla_encuestas_benef_gen=DB::select("select DEPARTAMENTOS.NOM_DPTO as Departamento,NOM_MPIO as Municipio,NOM_TERR as Vereda,encuestas as Encuentas
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		
		$tabla_encuestas_ccvsc_gen=DB::select("select DEPARTAMENTOS.NOM_DPTO as Departamento,NOM_MPIO as Municipio,NOM_TERR as Vereda,encuestas as Encuentas
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		


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
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')//join entre tabla dominio y tabla core de beneficiarios 
			->where('MODSISCADI_ENCUESTAS.cod_monitor','=', $monitor)//selecciona las veredas para el codigo de municipio ingresado
			->select('MODSISCADI_ENCUESTAS.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_ENCUESTAS.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->get();
			
		foreach($tabla_monitor as $category):// crea arreglo con el nombre del monitor
			$monitores2=array('cod_monitor'=>$category->cod_monitor,'nom_monitor'=>$category->nom_monitor);
			$monitores3 = $category->nom_monitor;	
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
			
		$tabla_encuestas_benef=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."' and  SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios'  group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		
		

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
			
		$tabla_encuestas_ccvcs=DB::select("select NOM_TERR,encuestas,NOM_MPIO,DEPARTAMENTOS.NOM_DPTO
	from DEPARTAMENTOS join
		(select NOM_TERR,encuestas,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
			(SELECT MODSISCADI_VEREDAS.COD_DANE ,MODSISCADI_VEREDAS.NOM_TERR,COUNT(MODSISCADI_ENCUESTAS.cod_unodc) as encuestas
				FROM MODSISCADI_ENCUESTAS join MODSISCADI_VEREDAS on MODSISCADI_ENCUESTAS.cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."' and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".$cod_dane."' and  MODSISCADI_ENCUESTAS.intervencion='".$inter."' and  MODSISCADI_VEREDAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' and MODSISCADI_ENCUESTAS.tipo='Comite' group By MODSISCADI_VEREDAS.COD_DANE , MODSISCADI_VEREDAS.NOM_TERR ) as vereda 
			on MUNICIPIOS.COD_DANE= vereda.COD_DANE) as muni
		on DEPARTAMENTOS.COD_DPTO=muni.COD_DPTO order by NOM_TERR asc");
		
		

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
				
			}else// omite la impresion de la informacion de encuestas a comite e imprime la parte final del reporte
			{
				
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
			$cuenta[$i] = DB::select(" select sum(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO ");
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
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();



		$arraydptocount = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as total,bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='2015' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='2015' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='2015' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='2015' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");
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
			$cuenta[$i] = DB::select(" select sum(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='".$mision[$i]->mision."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO ");// arrgelo con los datos de encuestas por departamento 

			if(empty($cuenta[$i])){$cuenta_todos[$i] = "0";}
				else{$cuenta_todos[$i]=(int)$cuenta[$i][0]->value;}

			}



//Codigo para  grafica de mision "linea base" mision="p"

$arraygrafica_p_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 

$grafica_p_depto=array();				
foreach($arraygrafica_p_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
					$categories_4['COD_DPTO']=$category->COD_DPTO;
					$categories_4['value']=(int)$category->value;
					$categories_4['nombre']=$category->name;
					array_push($grafica_p_depto,$categories_4);
				endforeach;	

 $arraygrafica_p_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='p' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene	

						on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc	");// arrgelo con los datos de encuestas por municipio 

$grafica_p_muni=array();				
foreach($arraygrafica_p_muni as $category):// crea arreglo con dos atributos cod_dane, el nombre y encuestas
					$categories_5['COD_DANE']=$category->COD_DANE;
					$categories_5['value']=(int)$category->value;
					$categories_5['name']=$category->name;
					array_push($grafica_p_muni,$categories_5);
				endforeach;			


//Codigo para  grafica de mision "Seguimiento" mision="s"

$arraygrafica_s_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 

$grafica_s_depto=array();				
foreach($arraygrafica_s_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
					$categories_4['COD_DPTO']=$category->COD_DPTO;
					$categories_4['value']=(int)$category->value;
					$categories_4['nombre']=$category->name;
					array_push($grafica_s_depto,$categories_4);
				endforeach;	

 $arraygrafica_s_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='s' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene	

						on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc	");// arrgelo con los datos de encuestas por municipio 

$grafica_s_muni=array();				
foreach($arraygrafica_s_muni as $category):// crea arreglo con dos atributos cod_dane, el nombre y encuestas
					$categories_5['COD_DANE']=$category->COD_DANE;
					$categories_5['value']=(int)$category->value;
					$categories_5['name']=$category->name;
					array_push($grafica_s_muni,$categories_5);
				endforeach;		


//Codigo para  grafica de mision "Linea final" mision="f"

$arraygrafica_f_depto = DB::select(" select bene.COD_DPTO,bene.NOM_DPTO as name,(comite.Comite+Bene.Beneficiarios)as value from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");// arrgelo con los datos de encuestas por departamento 

$grafica_f_depto=array();				
foreach($arraygrafica_f_depto as $category):// crea arreglo con dos atributos cod_depto, el nombre y encuestas
					$categories_4['COD_DPTO']=$category->COD_DPTO;
					$categories_4['value']=(int)$category->value;
					$categories_4['nombre']=$category->name;
					array_push($grafica_f_depto,$categories_4);
				endforeach;	

 $arraygrafica_f_muni = DB::select(" select bene.COD_DPTO,(comite.Comite+Bene.Beneficiarios)as value,bene.COD_DANE,bene.NOM_MPIO as name, bene.NOM_DPTO from  (select  DEPARTAMENTOS.COD_DPTO,depto.NOM_MPIO, depto.COD_DANE, DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.COD_DANE,MUNICIPIOS.NOM_MPIO, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,muni.COD_DANE,MUNICIPIOS.NOM_MPIO) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,depto.COD_DANE,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".$intervencion."' and  MODSISCADI_ENCUESTAS.mision='f' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".$intervencion."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,muni.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene	

						on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_DPTO asc	");// arrgelo con los datos de encuestas por municipio 

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


		$arrayintercount = DB::select("select MODSISCADI_MISION.nom_mision, MODSISCADI_MISION.mision
											from 
												(select count(mision) as num_intervencion, tipo,mision 
													from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter 
												join MODSISCADI_MISION 
											on inter.mision=MODSISCADI_MISION.mision");




		for($i=0; $i<count($arrayintercount); $i++){
			$arraypro1[$i] = DB::select("select inter.num_intervencion,inter.tipo,MODSISCADI_MISION.nom_mision 
											from 
												(select count(mision) as num_intervencion, tipo,mision 
													from MODSISCADI_ENCUESTAS where mision='".$arrayintercount[$i]->mision."' and  tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter 
												join MODSISCADI_MISION 
											on inter.mision=MODSISCADI_MISION.mision");
			if(empty($arraypro1[$i])){$arrayintercountcomi[$i] = "0";}
				else{$arrayintercountcomi[$i]=(int)$arraypro1[$i][0]->num_intervencion;}
			$arraypro2[$i] = DB::select("select inter.num_intervencion,inter.tipo,MODSISCADI_MISION.nom_mision 
											from 
												(select count(mision) as num_intervencion, tipo,mision 
													from MODSISCADI_ENCUESTAS where mision='".$arrayintercount[$i]->mision."' and  tipo='Beneficiarios' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter 
												join MODSISCADI_MISION 
											on inter.mision=MODSISCADI_MISION.mision");
			if(empty($arraypro2[$i])){$arrayintercountbene[$i] = "0";}
				else{$arrayintercountbene[$i]=(int)$arraypro2[$i][0]->num_intervencion;}

			$arraypro3[$i] = DB::select("select MODSISCADI_MISION.nom_mision, MODSISCADI_MISION.mision
											from 
												(select count(mision) as num_intervencion, tipo,mision 
													from MODSISCADI_ENCUESTAS where tipo='Comite' and piloto='No' and intervencion=".Input::get('intervencion')." group by tipo, mision) as inter 
												join MODSISCADI_MISION 
											on inter.mision=MODSISCADI_MISION.mision");
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
$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc");

//consulta para optener los datos necesarios par ala consyruccion de la grafica
$arraygrafica = DB::select(" select Bene.NOM_DPTO,Bene.Beneficiarios,comite.Comite from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo ,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo) as Bene	

						on comite.COD_DPTO=Bene.COD_DPTO order By bene.NOM_DPTO asc");




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
$arraymuni = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE ) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE order by depto.NOM_MPIO asc");

//consulta para optener los datos necesarios par ala consyruccion de la grafica
$arraygrafica = DB::select(" select Bene.NOM_MPIO,Bene.Beneficiarios,comite.Comite from  (select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE,sum(depto.sum_tipo)  as Comite from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."'  group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as comite 

						full join
							(select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE,sum(depto.sum_tipo) as Beneficiarios from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, muni.tipo,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE, ([MODSISCADI_ENCUESTAS].tipo) as tipo,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."' and  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' group By MODSISCADI_VEREDAS.COD_DANE, [MODSISCADI_ENCUESTAS].tipo) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO, muni.tipo,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".Input::get('departamento')."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.tipo,depto.NOM_MPIO,depto.COD_DANE) as Bene	

						on comite.COD_DANE=Bene.COD_DANE order By bene.NOM_MPIO asc");




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
$arraymoni=DB::select("select MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor from MODSISCADI_ENCUESTAS join MODSISCADI_MONITOR on MODSISCADI_ENCUESTAS.cod_monitor = MODSISCADI_MONITOR.cod_monitor where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor order by MODSISCADI_MONITOR.nom_monitor");

$categories_moni2=array();	
$Label=array();	
		foreach($arraymoni as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_moni=array($category->cod_monitor);
			$categories_moni3=array($category->nom_monitor);
			array_push($categories_moni2,$categories_moni);
			array_push($Label,$categories_moni3);
		endforeach;



			$arraygrafica= DB::select(" select moni_comi.cod_monitor,moni_comi.nom_monitor,moni_comi.num_comi,benefi.num_bene from
  (select moni.cod_monitor,moni.nom_monitor,comite.num_comi from
  (select MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor from MODSISCADI_ENCUESTAS join MODSISCADI_MONITOR on MODSISCADI_ENCUESTAS.cod_monitor = MODSISCADI_MONITOR.cod_monitor where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor) as moni
  full join 
  (SELECT [cod_monitor],COUNT([cod_monitor]) as num_comi
  FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by cod_monitor) as comite
   on moni.cod_monitor=comite.cod_monitor) as moni_comi
   full join
   (SELECT [cod_monitor],COUNT([cod_monitor]) as num_bene
  FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where  MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by cod_monitor) as benefi
  on moni_comi.cod_monitor=benefi.cod_monitor order by moni_comi.nom_monitor
");
 			
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
		$arraymoni=DB::select("select MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor from MODSISCADI_ENCUESTAS join MODSISCADI_MONITOR on MODSISCADI_ENCUESTAS.cod_monitor = MODSISCADI_MONITOR.cod_monitor where MODSISCADI_ENCUESTAS.mision='".Input::get('mision')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No'and SUBSTRING(MODSISCADI_ENCUESTAS.cod_unodc,1,5)='".Input::get('municipio')."' group by MODSISCADI_MONITOR.cod_monitor,MODSISCADI_MONITOR.nom_monitor order by MODSISCADI_MONITOR.nom_monitor");

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
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();

		
		

				return  Response::json(array('arrayintercountcomi'=>$arrayintercountcomi,'arrayinter'=>$arrayinter,'arraymonitor'=>$arraymonitor));


			}


public function postSiscadiidmoniinter()
	{	
		
		//consulta para traer los departamentos según datos del formulario
$arraydpto = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc");




		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();

		
	

$arraymunicount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='monitor' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");

$arrayvdacount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");



$label=array();				
foreach($arraydpto as $category):// crea arreglo con dos atributos cod_depto y el nombre
					$categories_4=array($category->NOM_DPTO);
					array_push($label,$categories_4);
				endforeach;	


		for($i=0; $i<count($arraydpto); $i++){
			$arraydptocountbene1[$i] = DB::select("select  DEPARTAMENTOS.NOM_DPTO,sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".$arraydpto[$i]->COD_DPTO."' group by  DEPARTAMENTOS.NOM_DPTO");
			if(empty($arraydptocountbene1[$i])){$arraydptocountbene[$i] = "0";}
				else{$arraydptocountbene[$i]=(int)$arraydptocountbene1[$i][0]->num;}



			$arraydptocountcomi1[$i] = DB::select("select  DEPARTAMENTOS.NOM_DPTO,sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where DEPARTAMENTOS.COD_DPTO='".$arraydpto[$i]->COD_DPTO."' group by  DEPARTAMENTOS.NOM_DPTO");

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
$arraympio = DB::select("select MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where   MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE where MUNICIPIOS.COD_DPTO=".Input::get('departamento')."group by MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO order by MUNICIPIOS.NOM_MPIO asc");




		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();

		
	



$arrayvdacount = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");



$label=array();				
foreach($arraympio as $category):// crea arreglo con dos atributos cod_depto y el nombre
					$categories_4=array($category->NOM_MPIO);
					array_push($label,$categories_4);
				endforeach;	


		for($i=0; $i<count($arraympio); $i++){
			$arraympiocountbene1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_DANE='".$arraympio[$i]->COD_DANE."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");
			if(empty($arraympiocountbene1[$i])){$arraympiocountbene[$i] = "0";}
				else{$arraympiocountbene[$i]=(int)$arraympiocountbene1[$i][0]->num;}



			$arraympiocountcomi1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_DANE='".$arraympio[$i]->COD_DANE."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE");

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
$arrayvda = DB::select("SELECT MODSISCADI_VEREDAS.COD_UNODC,MODSISCADI_VEREDAS.NOM_TERR
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where   MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."'  and SUBSTRING(MODSISCADI_VEREDAS.COD_UNODC,1,5)='".Input::get('municipio')."' group By MODSISCADI_VEREDAS.COD_UNODC,MODSISCADI_VEREDAS.NOM_TERR order by MODSISCADI_VEREDAS.NOM_TERR asc");




		//Consultas para obtener label del monitores
		$arraymonitor=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de monitores de a partir de los codigos almacenados en las encuestas
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();

		
	




$label=array();				
foreach($arrayvda as $category):// crea arreglo con dos atributos cod_depto y el nombre
					$categories_4=array($category->NOM_TERR);
					array_push($label,$categories_4);
				endforeach;	


		for($i=0; $i<count($arrayvda); $i++){
			$arrayvdacountbene1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Beneficiarios' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_UNODC='".$arrayvda[$i]->COD_UNODC."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");
			if(empty($arrayvdacountbene1[$i])){$arrayvdacountbene[$i] = "0";}
				else{$arrayvdacountbene[$i]=(int)$arrayvdacountbene1[$i][0]->num;}



			$arrayvdacountcomi1[$i] = DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC, sum(depto.sum_tipo)  as num from DEPARTAMENTOS join
						(select MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR, sum(muni.num_tipo)as sum_tipo from MUNICIPIOS join 
							(SELECT MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC, count([MODSISCADI_ENCUESTAS].tipo)as num_tipo
									 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_VEREDAS.intervencion='".Input::get('intervencion')."'  and MODSISCADI_ENCUESTAS.tipo='Comite' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.piloto='No' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group By MODSISCADI_VEREDAS.COD_DANE,MODSISCADI_VEREDAS.NOM_TERR,MODSISCADI_VEREDAS.COD_UNODC ) as muni 
								on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO,MUNICIPIOS.NOM_MPIO,MUNICIPIOS.COD_DANE,muni.COD_UNODC, muni.NOM_TERR) as depto 
							on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO where  depto.COD_UNODC='".$arrayvda[$i]->COD_UNODC."' group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO,depto.NOM_MPIO,depto.COD_DANE,depto.NOM_TERR,depto.COD_UNODC");

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
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.piloto','=','No')
			->WHERE('MODSISCADI_ENCUESTAS.cod_monitor','=',Input::get('monitor'))
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();
			
	
		$mision=DB::select("select MODSISCADI_ENCUESTAS.mision,MODSISCADI_MISION.nom_mision, count(MODSISCADI_ENCUESTAS.mision)as cuenta  from MODSISCADI_MISION full join MODSISCADI_ENCUESTAS on MODSISCADI_MISION.mision=MODSISCADI_ENCUESTAS.mision where MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' group by MODSISCADI_ENCUESTAS.mision,MODSISCADI_MISION.nom_mision");

$label=array();				
foreach($mision as $category):// crea arreglo con dos atributos cod_depto y el nombre
					$categories_4=array($category->nom_mision);
					array_push($label,$categories_4);
				endforeach;	

$grafica=array();
		for($i=0; $i<count($mision); $i++){
			$arrayvdacountbene1[$i] = DB::select("SELECT     
				      cod_unodc, mision, COUNT(mision)as num_comi
				  FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where tipo='Beneficiarios'and MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and mision='".$mision[$i]->mision."'  group by mision, tipo,cod_unodc
				");
							if(empty($arrayvdacountbene1[$i])){$arrayvdacountbene[$i] = 0;}
								else{$arrayvdacountbene[$i]=(int)$arrayvdacountbene1[$i][0]->num_comi;}



							$arrayvdacountcomi1[$i] = DB::select("SELECT     
				      cod_unodc, mision, COUNT(mision)as num_bene
				  FROM [DABASE].[sde].[MODSISCADI_ENCUESTAS] where tipo='Comite'and MODSISCADI_ENCUESTAS.cod_unodc='".Input::get('vereda')."' and MODSISCADI_ENCUESTAS.intervencion='".Input::get('intervencion')."' and MODSISCADI_ENCUESTAS.cod_monitor='".Input::get('monitor')."' and mision='".$mision[$i]->mision."'  group by mision, tipo,cod_unodc
				");

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

			

}
