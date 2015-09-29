<?php


	Fpdf::AddPage('p','Letter');
	Fpdf::SetFont('Arial', 'B', 12);
	Fpdf::SetLeftMargin(15);
	Fpdf::SetRightMargin(15);
	//inserto la cabecera poniendo una imagen dentro de una celda
	Fpdf::Cell(100,10,Fpdf::Image('./assets/img/unodc.png',30,10,50),0,0,'C');
	Fpdf::Ln(7);
	//Fpdf::Line(10,40,10,200);
	//linea horizontal superior
	//Fpdf::Line(200,40,10,40);
	//Fpdf::Line(200,40,200,200);
	//Linea horizontal inferior
	//Fpdf::Line(200,200,10,200);
	//(x,y,ancho,alto)
	Fpdf::Rect(10,90,190,100);
	Fpdf::Ln(25);
	//Fpdf::Write(5,"To find out what's new in this tutorial, click ");
	Fpdf::Cell(100,10,utf8_decode("La Unidad de Información certifica el siguiente número de procesos"));//.$campodb['nombre']);
	//Fpdf::Line(35,74,190,74);
	Fpdf::Ln(10);
	Fpdf::Cell(100,10,utf8_decode("Número de procesos: ").$arraytp);//. $campodb['direccion']);
	//Fpdf::Line(35,84,190,84);
	Fpdf::Ln(10);
	Fpdf::Cell(90,10,utf8_decode("Fecha de elaboración de Informe: ").date("Y/m/d"));//.$campodb['telefono']));
	//Fpdf::Line(35,94,190,94);
	Fpdf::Ln(10);
	Fpdf::Cell(100,10,utf8_decode("Hora de elaboración de Informe: ").date("H:i"));//.$campodb['ordenador']);
	//Se agrega un salto de linea
	Fpdf::Ln(25);
	Fpdf::SetTitle("Lista de alumnos");
	Fpdf::SetFillColor(200,200,200);
	Fpdf::SetFont('Arial', 'B', 10);
		//inserto la cabecera poniendo una imagen dentro de una celda
		//Cell(Ancho,	Alto,	texto,	borde,	posición,	alineación,	relleno);
	Fpdf::Cell(180,7,'REPORTE','TBL',0,'C',1);
	Fpdf::Cell(0.1,7,'','TBR',0,'C',1);
	//Se agrega un salto de linea
	Fpdf::Ln(7);
		Fpdf::Cell(10,		7,		'NUM',	'TBL',	0,			'C',		1);
	Fpdf::Cell(25,7,'PATERNO','TBL',0,'C',1);
	Fpdf::Cell(25,7,'MATERNO','TBL',0,'C',1);
	Fpdf::Cell(25,7,'NOMBRE','TBL',0,'C',1);
	Fpdf::Cell(45,7,'FECHA DE NACIMIENTO','TBL',0,'C',1);
	Fpdf::Cell(25,7,'GRADO','TBL',0,'C',1);
	//Dibuja linea izquierda de grupo
	Fpdf::Cell(0.1,7,'','TBL',0,'C',1);
	Fpdf::Cell(25,7,'GRUPO','TBR',0,'C',1);
	//Se agrega un salto de linea
	Fpdf::Ln(7);
	// La variable $x se utiliza para mostrar un número consecutivo
	$x = 1;
	$paterno = 'apellido';
	//foreach ($alumnos as $alumno) {
	// se imprime el numero actual y despues se incrementa el valor de $x en uno
	Fpdf::Cell(10,5,$x++,'BL',0,'C',0);
	// Se imprimen los datos de cada alumno
	Fpdf::Cell(25,5,$paterno,'BL',0,'C',0);
	Fpdf::Cell(25,5,'materno','BL',0,'C',0);
	Fpdf::Cell(25,5,'nombre','BL',0,'C',0);
	Fpdf::Cell(45,5,'fec_nac','BL',0,'C',0);
	Fpdf::Cell(25,5,'grado','BL',0,'C',0);
	//Dibuja linea izquierda de grupo
	Fpdf::Cell(0.1,5,'','BL',0,'C',0);
	Fpdf::Cell(25,5,'grupo','BR',0,'C',0);
	//Se agrega un salto de linea
	Fpdf::Ln(6);
	Fpdf::PageNo();
	Fpdf::Output('informe.pdf','D');
	exit;


?>