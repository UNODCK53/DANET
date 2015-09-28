<?php

class SiscadiController extends BaseController {

	public function reporte_encuesta()
	{
		return  View::make('modulosiscadi.Sisicadi_encuesta');
	}
	
	public function showDepto() //Funcion que ejecuta la consulta de departamento para las encuetas digitales
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario
		$mision=$data['mision'];
		$inter=$data['inter'];
		$piloto=$data['piloto'];
		$monitor=$data['monitor'];
		$categories_depto=array();
		$categories_depto2=array();
		$version="";
		$campo_depto="";
		

		if ($monitor !=""){//condicional que filtra los departamentos por monitor, sirve para reporte por monitor
			$tabla=DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."' and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
		
		
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			$tabla=DB::select("select  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO from DEPARTAMENTOS join
									(select MUNICIPIOS.COD_DPTO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."' group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE group by MUNICIPIOS.COD_DPTO) as depto 
 									on DEPARTAMENTOS.COD_DPTO= depto.COD_DPTO group by  DEPARTAMENTOS.COD_DPTO,DEPARTAMENTOS.NOM_DPTO order by DEPARTAMENTOS.NOM_DPTO asc"); //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
			
	
		}
		

		
		foreach($tabla as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_depto=array('cod_depto'=>$category->COD_DPTO,'nom_depto'=>$category->NOM_DPTO);
			array_push($categories_depto2,$categories_depto);
		endforeach;
		
		return  Response::json($categories_depto2);//retorna al .js los codigos y nombre de los departamentos que estan en las encuestas
		
		

	}
	
	public function showMuni()//Funcion que ejecuta la consulta de municipios para las encuetas digitales
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario
		$mision=$data['mision'];
		$inter=$data['inter'];
		$id=$data['id'];
		$piloto=$data['piloto'];
		$monitor=$data['monitor'];
		$categories_muni=array();
		$categories_muni2=array();
		$version="";
		$campo_muni="";

		
		if ($monitor !=""){//condicional que filtra los departamentos por monitor, sirve para reporte por monitor
			$tabla=DB::select("select MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC where MODSISCADI_ENCUESTAS.cod_monitor='".$monitor."'  and MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."'  group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE where MUNICIPIOS.COD_DPTO ='".$id."' group by MUNICIPIOS.COD_DANE, MUNICIPIOS.NOM_MPIO order by MUNICIPIOS.NOM_MPIO asc" ); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas
		
		
		}else{//condicional que no filtra los departamentos por monitor, sirve para reportes por mision y general
			$tabla=DB::select("select MUNICIPIOS.COD_DANE,MUNICIPIOS.NOM_MPIO from MUNICIPIOS join 
										(SELECT MODSISCADI_VEREDAS.COD_DANE
 											 FROM [MODSISCADI_ENCUESTAS] join MODSISCADI_VEREDAS on [MODSISCADI_ENCUESTAS].cod_unodc=MODSISCADI_VEREDAS.COD_UNODC  where MODSISCADI_ENCUESTAS.mision='".$mision."' and MODSISCADI_ENCUESTAS.intervencion='".$inter."' and MODSISCADI_ENCUESTAS.piloto='".$piloto."'  group By MODSISCADI_VEREDAS.COD_DANE) as muni 
 										on MUNICIPIOS.COD_DANE= muni.COD_DANE where MUNICIPIOS.COD_DPTO ='".$id."' group by MUNICIPIOS.COD_DANE, MUNICIPIOS.NOM_MPIO order by MUNICIPIOS.NOM_MPIO asc"); //crea la consulta para obtener el nombre de municipios de a partir de los codigos almacenados en las encuestas
			
	}
				
		foreach($tabla as $category):// crea arreglo con dos atributos cod_dane y el nombre del municipio
			$categories_muni=array('cod_dane'=>$category->COD_DANE,'nom_muni'=>$category->NOM_MPIO);
			array_push($categories_muni2,$categories_muni);
		endforeach;
		
		return  Response::json($categories_muni2);//retorna al .js los codigos y nombre de los municipios que estan en las encuestas

	}
	
	
	public function showMonitor() //Funcion que ejecuta la consulta de departamento para las encuetas digitales
	{
		$data=Input::all();//trae y agrega a $data todos los input del fromulario
		$mision=$data['mision'];
		$inter=$data['inter'];
		$piloto=$data['piloto'];
		
		$categories_depto=array();
		$categories_depto2=array();

			
		$tabla=DB::table('MODSISCADI_ENCUESTAS') //crea la consulta para obtener el nombre de departamentos de a partir de los codigos almacenados en las encuestas
			->Join('MODSISCADI_MONITOR','MODSISCADI_ENCUESTAS.cod_monitor','=','MODSISCADI_MONITOR.cod_monitor')
			->where('MODSISCADI_ENCUESTAS.intervencion',$inter)
			->where('MODSISCADI_ENCUESTAS.mision',$mision)
			->where('MODSISCADI_ENCUESTAS.piloto',$piloto)
			->select('MODSISCADI_MONITOR.cod_monitor','MODSISCADI_MONITOR.nom_monitor')
			->groupBy('MODSISCADI_MONITOR.cod_monitor')
			->groupBy('MODSISCADI_MONITOR.nom_monitor')
			->orderBy('MODSISCADI_MONITOR.nom_monitor')
			->get();
		;
		foreach($tabla as $category):// crea arreglo con dos atributos cod_depto y el nombre
			$categories_depto=array('cod_moni'=>$category->cod_monitor,'nom_moni'=>$category->nom_monitor);
			array_push($categories_depto2,$categories_depto);
		endforeach;
		
		return  Response::json($categories_depto2);//retorna al .js los codigos y nombre de los departamentos que estan en las encuestas
		
		

	}
	
	
	
	
	public function repote_mision()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de mision
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


        Fpdf::Output();
        exit;
	
	}
	
	public function repote_general()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de general
	
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
	
	public function repote_monitor()// funcion que se ejecuta al momento dar click  para generar el pdf de reporte de mision
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


        Fpdf::Output();
        exit;	


	}
	
	
	public function showPdf_boot()
	{
		$data=Input::all();
		$mision=$data['mision'];
		$inter=$data['intervencion'];
		$cod_dane=$data['cod_dane'];
		$cod_depto=$data['cod_depto'];
		
		$categories_benef=array();
		$categories_benef2=array();
		$tabla_encuestas_benef=DB::table('dominio')			
			->Join('encuesta'.$inter.'_'.$mision.'_10022015_core','dominio.name','=','encuesta'.$inter.'_'.$mision.'_10022015_core.P1_C1_G1_C01_03')
			->where('list name', 'vereda')
			->where('otras', $cod_dane)
			->groupBy('name')
			->select(array('encuesta'.$inter.'_'.$mision.'_10022015_core.*','dominio.*', DB::raw('COUNT(encuesta'.$inter.'_'.$mision.'_10022015_core.P1_C1_G1_C01_03) as encuestas')))
			->get();
			$count=1;
		foreach($tabla_encuestas_benef as $category):
			$categories_benef2=array('value'=>$category->name,'name'=>$category->label,'encuestas'=>$category->encuestas);
			$count++;
			array_push($categories_benef,$categories_benef2);
		endforeach;
		
		$categories_ccvcs=array();
		$categories_ccvcs2=array();
		$tabla_encuestas_ccvcs=DB::table('dominio')			
			->Join('encuesta_comite_'.$mision.'_'.$inter.'_10022015_core','dominio.name','=','encuesta_comite_'.$mision.'_'.$inter.'_10022015_core.C01_03_')
			->where('list name', 'vereda')
			->where('otras', $cod_dane)
			->groupBy('name')
			->select(array('encuesta_comite_'.$mision.'_'.$inter.'_10022015_core.*','dominio.*', DB::raw('COUNT(encuesta_comite_'.$mision.'_'.$inter.'_10022015_core.C01_03_) as encuestas')))
			->get();
			$count=1;
		foreach($tabla_encuestas_ccvcs as $category):
			$categories_ccvcs2=array('value'=>$category->name,'name'=>$category->label,'encuestas'=>$category->encuestas);
			$count++;
			array_push($categories_ccvcs,$categories_ccvcs2);
		endforeach;
		
		$fecha=array();
		$fecha2=array();
		$tabla_fecha=DB::table('encuesta'.$inter.'_'.$mision.'_10022015_core')
			->select(array(DB::raw('SUBSTRING(min(encuesta'.$inter.'_'.$mision.'_10022015_core.TODAY),1,10) as f_inicio,SUBSTRING(max(encuesta'.$inter.'_'.$mision.'_10022015_core.TODAY),1,10) as f_final')))
			->where('P1_C1_G1_C01_04', $cod_dane)
			->get();
		foreach($tabla_fecha as $category):
			$fecha2=array('f_inicial'=>$category->f_inicio,'f_final'=>$category->f_final);
			array_push($fecha,$fecha2);
		endforeach;		
		
		
		$muni=array();
		$muni2=array();
		$tabla_muni=DB::table('dominio')
			->select(array(DB::raw('dominio.label')))
			->where('list name', 'municipio1')
			->where('name', $cod_dane)
			->get();
		foreach($tabla_muni as $category):
			$muni2=array('muni'=>$category->label);
			array_push($muni,$muni2);
		endforeach;	

		$depto=array();
		$depto2=array();
		$tabla_dpto=DB::table('dominio')
			->select(array(DB::raw('dominio.label')))
			->where('list name', 'Departamento1')
			->where('name', $cod_depto)
			->get();
		foreach($tabla_dpto as $category):
			$depto2=array('depto'=>$category->label);
			array_push($depto,$depto2);
		endforeach;
		
		$encuestas_benef=array();
		$encuestas_benef2=array();
		$tabla_sum_encuestas_benef=DB::table('encuesta'.$inter.'_'.$mision.'_10022015_core')			
			->select(array( DB::raw('COUNT(encuesta'.$inter.'_'.$mision.'_10022015_core.P1_C1_G1_C01_04) as total_encuestas')))
			->where('P1_C1_G1_C01_04', $cod_dane)
			
			->get();
		foreach($tabla_sum_encuestas_benef as $category):
			$encuestas_benef2=array('total'=>$category->total_encuestas);
			array_push($encuestas_benef,$encuestas_benef2);
		endforeach;
		
		$encuestas_ccvcs=array();
		$encuestas__ccvcs2=array();
		$tabla_sum_encuestas__ccvcs=DB::table('encuesta_comite_'.$mision.'_'.$inter.'_10022015_core')			
			->select(array( DB::raw('COUNT(encuesta_comite_'.$mision.'_'.$inter.'_10022015_core.C01_02) as total_encuestas')))
			->where('C01_02', $cod_dane)
			
			->get();
		foreach($tabla_sum_encuestas__ccvcs as $category):
			$encuestas_ccvcs2=array('total'=>$category->total_encuestas);
			array_push($encuestas_ccvcs,$encuestas_ccvcs2);
		endforeach;
		
		
		$cuenta_bene=count($categories_benef)+1;
		$cuenta_ccvcs=count($categories_ccvcs)+1;
		$fecha_reporte=date("d")."/". date("m")."/".date("Y");
		$total_encuestas=$encuestas_benef[0]["total"]+$encuestas_ccvcs[0]["total"];
		return  View::make('PDF_reporte')->with('muni',$muni)
									->with('depto',$depto)
									->with('fecha',$fecha)
									->with('encuestas_benef',$encuestas_benef)
									->with('encuestas_ccvcs',$encuestas_ccvcs)
									->with('categories_ccvcs',$categories_ccvcs)
									->with('categories_benef',$categories_benef)
									->with('fecha_reporte',$fecha_reporte)
									->with('total_encuestas',$total_encuestas)
									->with('cuenta_bene',$cuenta_bene)
									->with('cuenta_ccvcs',$cuenta_ccvcs)
									;

	}

	
	
	
	
	public function showPdfHtml()
	{
		return  View::make('PDF_reporte');
	}
}
