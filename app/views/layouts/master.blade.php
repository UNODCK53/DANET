<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
		@section('titulo')
			Monitoreo a Desarrollo Alternativo UNODC 
		@show
	</title>
	@section('cabecera')
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/responsive.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datepicker.css">
	<style>
    #sha{
      -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
      -moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
      box-shadow:         0px 0px 18px 0px rgba(48, 50, 50, 0.48);
    }
	 .enlace-sesion{
	    margin-right:11px;
	  }
	  .enlace-menu{
	    margin-right:13px;
	    color:#245DC1;
	  }
	  .enlace-menu2{
	    margin-left:10px;
	    color:#444449;
	  }
	  #menu-sec{
	    border-bottom:1px #EEEEEE solid;  
	  }			  
	  .menu-footer{
	    font-size:11px;
	    color:#245DC1;
	    margin-right:2px;
	  }
    
  </style>
	@show
	@section('js')
	<!-- librerias JavaScript que se utilizan en la pagina -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	@show
	@section('scripthead')
	@show
</head>
<body>
<!--comienza la cabecera-->
@section('contenidocabecera1')
<!--Primer Contenerdor logo y botón iniciar sesion  
<div class="container-fluid well">
  <div class="row">
    Columna logo con imágen
    <div class="col-xs-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img src="assets/img/logos2.png" class="img-responsive" alt="logounodc">
    </div>
    espaciado para que en xs queden separado logo y boton
    <div class="col-xs-1 visible-xs">
    </div>
    <div class="col-lg-6 visible-lg">
    </div>
    columna botón crear cuenta solo es visible en xs
    <div class="col-xs-5 visible-xs">
     	<ul class="nav nav-pills ">
		   	<li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} {{Auth::user()->last_name}}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="logout"><i class="icon-off"></i> Cerrar sesión</a></li>
          </ul>
        </li>
			  </ul>
    </div>
    columna link y boton solo son visibles en sm md lg
    <div class="col-sm-3 col-sm-offset-3 visible-sm visible-md visible-lg col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
      <ul class="nav nav-pills ">
        <li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} {{Auth::user()->last_name}}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="logout"><i class="icon-off"></i> Cerrar sesión</a></li>
          </ul>
        </li>
 		  </ul>
    </div>        
  </div>
</div>
-->
<div class="container-fluid well">
  <div class="row">
    <div class="col-sm-1 hidden-xs" ></div>
    <div class="col-xs-10 col-sm-7 text-center">        
        <img src="assets/img/logos2.png" width="70%">        
    </div>
    <div class="col-sm-1 hidden-xs"></div>
    <div class="col-sm-2 text-center">
      <ul class="nav nav-pills ">
        <li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} {{Auth::user()->last_name}}<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a tabindex="-1" href="logout"><i class="icon-off"></i> Cerrar sesión</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <div class="col-sm-1 hidden-xs"></div>
  </div>
</div>
<!--Fin del primer contenedor-->
@show
<!--texto-->
@section('menu1')
<?php $acc=(Session::get('acc')); ?>
<?php
//variables menú Tierras
$menucongral=false;$menuestadoproc=false;$menurepnumpro=false;$menureplevtopo=false;$menureparealev=false;$menureprespjuri=false;$menurepgenero=false;$menureptiempo=false;
$menucargaini=false;$menuprocadj=false;$menulevtopo=false;$menucoor=false;$menumaps=false;
//variables menú GME
$menugmevalcert=false;$menugmemetodologia=false;$menugmedisterradi=false;$menugmeinformes=false;
//variables menú Siscadi
$menureportesiscadi=false;$menuindicadoressiscadi=false;$menuestadisticosiscadi=false;
//variables menú Documentos
$menucarguedocu=false;$menuconsuldocu=false;$menurepordocu=false;
//variables menú geoapi
$menugeoapitecsaf=false;$menugeoapieliminreg=false;$menugeoapivisorterri=false;$menugeoapivisorbenef=false;$menugeoapirepordistorg=false;$menugeoapirepordistterri=false;$menugeoapirepordistlp=false;$menugeoapireporanalesp=false;$menugeoapireporregrepetidos=false;$menugeoapirepornovt1=false;$menugeoapirepornovt2=false;$menugeoapirepornovt3=false;
//variables menú ART
$artdashboard=false;$artmapa=false;$artcensofami=false;
//variables guardaun
$menuguardaun=false;
//foreach para habilitar las variables para el menú general
 foreach($acc as $acceso){
    if(($acceso->id_vista=="1101")&&($acceso->acces=="1")){$menucongral= true;}
    if(($acceso->id_vista=="1201")&&($acceso->acces=="1")){$menuestadoproc=true;}
    if(($acceso->id_vista=="1202")&&($acceso->acces=="1")){$menurepnumpro=true;}
    if(($acceso->id_vista=="1203")&&($acceso->acces=="1")){$menureplevtopo=true;}
    if(($acceso->id_vista=="1204")&&($acceso->acces=="1")){$menureparealev=true;}
    if(($acceso->id_vista=="1205")&&($acceso->acces=="1")){$menureprespjuri=true;}
    if(($acceso->id_vista=="1206")&&($acceso->acces=="1")){$menurepgenero=true;}
    if(($acceso->id_vista=="1207")&&($acceso->acces=="1")){$menureptiempo=true;}
    if(($acceso->id_vista=="1301")&&($acceso->acces=="1")){$menucargaini=true;}
    if(($acceso->id_vista=="1302")&&($acceso->acces=="1")){$menuprocadj=true;}
    if(($acceso->id_vista=="1304")&&($acceso->acces=="1")){$menulevtopo=true;}
    if(($acceso->id_vista=="1305")&&($acceso->acces=="1")){$menucoor=true;}
    if(($acceso->id_vista=="1306")&&($acceso->acces=="1")){$menumaps=true;}
    if(($acceso->id_vista=="2101")&&($acceso->acces=="1")){$menugmevalcert=true;}
    if(($acceso->id_vista=="2102")&&($acceso->acces=="1")){$menugmemetodologia=true;}
    if(($acceso->id_vista=="2103")&&($acceso->acces=="1")){$menugmedisterradi=true;}
    if(($acceso->id_vista=="2104")&&($acceso->acces=="1")){$menugmeinformes=true;}
    if(($acceso->id_vista=="3101")&&($acceso->acces=="1")){$menureportesiscadi=true;}
    if(($acceso->id_vista=="3102")&&($acceso->acces=="1")){$menuindicadoressiscadi=true;}
    if(($acceso->id_vista=="3103")&&($acceso->acces=="1")){$menuestadisticosiscadi=true;}
    if(($acceso->id_vista=="4101")&&($acceso->acces=="1")){$menucarguedocu=true;}
    if(($acceso->id_vista=="4102")&&($acceso->acces=="1")){$menuconsuldocu=true;}
    if(($acceso->id_vista=="4103")&&($acceso->acces=="1")){$menurepordocu=true;}
    if(($acceso->id_vista=="5101")&&($acceso->acces=="1")){$menugeoapitecsaf=true;}
    if(($acceso->id_vista=="5102")&&($acceso->acces=="1")){$menugeoapieliminreg=true;}
    if(($acceso->id_vista=="5103")&&($acceso->acces=="1")){$menugeoapivisorterri=true;}
    if(($acceso->id_vista=="5104")&&($acceso->acces=="1")){$menugeoapivisorbenef=true;}
    if(($acceso->id_vista=="5105")&&($acceso->acces=="1")){$menugeoapirepordistorg=true;}
    if(($acceso->id_vista=="5106")&&($acceso->acces=="1")){$menugeoapirepordistterri=true;}
    if(($acceso->id_vista=="5107")&&($acceso->acces=="1")){$menugeoapirepordistlp=true;}
    if(($acceso->id_vista=="5108")&&($acceso->acces=="1")){$menugeoapireporanalesp=true;}
    if(($acceso->id_vista=="5109")&&($acceso->acces=="1")){$menugeoapireporregrepetidos=true;}
    if(($acceso->id_vista=="5110")&&($acceso->acces=="1")){$menugeoapirepornovt1=true;}
    if(($acceso->id_vista=="5111")&&($acceso->acces=="1")){$menugeoapirepornovt2=true;}
    if(($acceso->id_vista=="5112")&&($acceso->acces=="1")){$menugeoapirepornovt3=true;}
    if(($acceso->id_vista=="6101")&&($acceso->acces=="1")){$artdashboard=true;}
    if(($acceso->id_vista=="6201")&&($acceso->acces=="1")){$artmapa=true;}
    if(($acceso->id_vista=="6301")&&($acceso->acces=="1")){$artcensofami=true;}
    if(($acceso->id_vista=="9999")&&($acceso->acces=="1")){$menuguardaun=true;}    
 }
 ?>
<!--Segundo contenedor menu secundario-->
<div class="container-fluid">
  <div class="row" id="menu-sec">
    <!--Menu secundario es visible en sm lg-->
    <div class="col-sm-2 "></div>
    <div class="col-sm-9 text-center text-primary visible-sm visible-md visible-lg ">
      <ul class="nav nav-pills ">
        <!--<li role="presentation" ><a href="#"><strong> INICIO</strong></a></li>-->
        <li id="menuprincipal" role="menu"><a href="principal">Inicio</a></li>
        @if(Auth::user()->grupo=="1")<!--Oculta la opción Ejecución si no es el administrador-->
          <li role="menu" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ejecución <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Monitoreo Integrado</a></li>
              <li><a href="#">GME</a></li>
              <li><a href="#">Proyectos Productivos</a></li>
              <li><a href="#">Catatumbo</a></li>
              <li><a href="#">SAI</a></li>
              <li><a href="#">Saldo a Diciembre</a></li>
            </ul>
          </li>
        @endif<!--Finaliza Ocultar la opción si no es el administrador-->
        @if(($menureportesiscadi) || ($menuindicadoressiscadi) || ($menuestadisticosiscadi))
          <li class="dropdown"id="siscadi" ><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SISCADI <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            @if($menuindicadoressiscadi)
              <li id="indicadoressiscadi"><a href="siscadi_indicadores">Resultados de recolección</a></li>
            @endif
            @if($menureportesiscadi)
              <li id="reportesiscadi"><a  href='siscadi_encuentas'>Reportes PDF</a></li>
            @endif
            @if($menuestadisticosiscadi)
              <li id="estadisticosiscadi"><a  href='siscadi_estadisticas'>Estadísticas</a></li>
            @endif             
            </ul>
          </li>
        @endif
        @if(Auth::user()->grupo=="1")<!--Oculta la opción Ejecución si no es el administrador-->
          <li role="menu" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Donde estamos<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href='vista1'>Crear misión</a></li>
              <li><a href="#">Cargar track</a></li>
            </ul>
          </li> 
          <li role="menu"><a href="#" class="enlace-menu">Historia</a></li>
        @endif<!--Finaliza Ocultar la opción si no es el administrador-->
        @if(($menugmevalcert) || ($menugmemetodologia) || ($menugmedisterradi) || ($menugmeinformes))<!--Oculta la opción si no es el administrador o gupo2-->
          <li id="GME" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">GME<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            @if($menugmevalcert)
              <li id="gmevalcert"><a href='validacion_certificacion'>Validación y Certificación</a></li>
            @endif
            @if($menugmemetodologia)
              <li id="gmemetodologia"><a href="metodologia_gme">Metodología</a></li>
            @endif
            @if($menugmedisterradi)
              <li id="gmedisterradi"><a href="distribucion_gme">Distribución de la erradicación (Mapa)</a></li>
            @endif
            @if($menugmeinformes)
              <li id="gmeinformes"><a href="informes_gme">Informes</a></li>
            @endif
            </ul>
          </li>
        @endif        
        @if(($menucongral)||($menuestadoproc)||($menurepnumpro)||($menureplevtopo)||($menureparealev)||($menureprespjuri)||($menucargaini)||($menuprocadj)||($menulevtopo)||($menucoor)||($menumaps)||($menurepgenero)||($menureptiempo)) <!--Oculta la opción tierras si no es el administrador-->
          <li id="tierras" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formalización de tierras<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              @if($menucongral)
                <li id="tierrasconsultageneral"><a href="<?=URL::to('consulta_general_tierras'); ?>">Consulta General y/o Consulta por Proceso</a></li>
                <li class="divider"></li>
              @endif
              <!--espacio de reportes-->
                <li><a align="center"><b>Reportes</b></a></li>
              @if($menuestadoproc)
                <li id="tierrasreporestado"><a href="<?=URL::to('reporte_estado'); ?>"> <span class="glyphicon glyphicon-ok"></span> Estado</a></li>
              @endif
              @if($menurepnumpro)
                <li id="tierrasrepornumproc"><a href="<?=URL::to('reporte_numero_proceso'); ?>"> <span class="glyphicon glyphicon-ok"></span> Número de Procesos</a></li>
              @endif
              @if($menureplevtopo)
                <li id="tierrasreporlevtop"><a href="<?=URL::to('reporte_lavantamiento_topografico'); ?>"> <span class="glyphicon glyphicon-ok"></span> Levantamiento Topográfico</a></li>
              @endif
              @if($menureparealev)
                <li id="tierrasreporarearepor"><a href="<?=URL::to('reporte_area_levantada'); ?>"> <span class="glyphicon glyphicon-ok"></span> Área Levantada</a></li>
              @endif
              @if($menureprespjuri)
                <li id="tierrasreporresponsjuri"><a href="<?=URL::to('reporte_responsable_juridico'); ?>"><span class="glyphicon glyphicon-ok"></span> Responsable Jurídico</a></li>
              @endif
              @if($menurepgenero)
                <li id="tierrasreporgenero"><a href="<?=URL::to('reporte_genero'); ?>"><span class="glyphicon glyphicon-ok"></span> Género</a></li>
              @endif
              @if($menureptiempo)
                <li id="tierrasreportiempo"><a href="<?=URL::to('reporte_tiempo'); ?>"><span class="glyphicon glyphicon-ok"></span> Temporalidad de eventos</a></li>
              @endif
                <li class="divider"></li>
                <!--Termina espacio de reportes-->
                <!--espacio de procesos-->
                <li><a align="center"><b>Procesos</b></a></li>
              @if($menucargaini)
                <li id="tierrascargainicial"><a href="<?=URL::to('carga_inicial'); ?>"> <span class='glyphicon glyphicon-ok'></span> Carga Inicial</a></li>
              @endif
              @if($menuprocadj)
                <li id="tierrascargaproceso"><a href="<?=URL::to('procesos_adjudicados'); ?>"> <span class="glyphicon glyphicon-ok"></span> Procesos Adjudicados</a></li>
              @endif
              @if($menulevtopo)
                <li id="tierraslevtopo"><a href="<?=URL::to('levantamiento_topografico'); ?>"> <span class="glyphicon glyphicon-ok"></span> Levantamiento Topográfico</a></li>
              @endif
              @if($menucoor)
                <li id="tierrascoord"><a href="<?=URL::to('coordenadas_edicion'); ?>"> <span class="glyphicon glyphicon-ok"></span> Edición de Coordenadas</a></li>
              @endif
                <li class="divider"></li>
                <!--Termina espacio de procesos-->
              @if($menumaps)
                <li id="tierrasmapas"><a href="<?=URL::to('mapas'); ?>"><span class="glyphicon glyphicon-ok"></span> Mapas</a></li>
              @endif
            </ul>
          </li>
        @endif<!--Finaliza Ocultar la opción Ejecución si no es el administrador-->
        @if(($menucarguedocu) || ($menuconsuldocu) || ($menurepordocu))
        <!--Oculta la opción Documentos si no es el administrador-->
          <li class="dropdown" id="documentos" ><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Documentos<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            @if($menucarguedocu)
              <li id="carguedocumenu"><a  href="<?=URL::to('cargue_docu'); ?>"> <span class="glyphicon glyphicon-ok"></span> Cargar documentos</a></li>
            @endif
            @if($menuconsuldocu)
              <li id="consultadocumenu"><a  href="<?=URL::to('consulta_docu'); ?>"> <span class="glyphicon glyphicon-ok"></span> Consulta de documentos</a></li>
            @endif
            @if($menurepordocu)
              <li id="repordocumenu"><a href="<?=URL::to('repor_docu'); ?>"> <span class="glyphicon glyphicon-ok"></span> Reporte de documentos</a></li>
            @endif
            </ul>
          </li>
        @endif<!--Finaliza Ocultar la opción documentos si no es el administrador-->
        @if(($artdashboard) || ($artmapa) || ($artcensofami))
        <!--Oculta la opción art si no es el administrador-->
          <li class="dropdown" id="art" ><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ART<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
            <!--espacio de Reportes-->
              <li><a align="center"><b>Reportes</b></a></li>
                @if($artdashboard)
                  <li id="artdashboardmenu"><a href="<?=URL::to('artdashboard'); ?>"><span class="glyphicon glyphicon-ok"></span> Dashboard</a></li>
                @endif
                @if($artmapa)
                  <li id="artmapamenu"><a href="<?=URL::to('artmapa'); ?>"><span class="glyphicon glyphicon-ok"></span> Mapa</a></li>
                @endif
                @if($artmapa)
                  <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> Diagnóstico familiar</a></li>
                @endif
                @if($artmapa)
                  <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> ZVTN - PTN</a></li>
                @endif 
                @if($artmapa)
                  <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> Normatividad</a></li>
                @endif   
              <li class="divider"></li>
                <!--Termina espacio de Reportes-->
              <li><a align="center"><b>Cargue de información</b></a></li>
                @if($artcensofami)
                  <li id="artcensofamilimenu"><a href="<?=URL::to('censofamiliar'); ?>"><span class="glyphicon glyphicon-ok"></span> Censo de familias</a></li>
                @endif                       
            </ul>
          </li>
        @endif<!--Finaliza Ocultar la opción art si no es el administrador-->
        @if(($menugeoapitecsaf)||($menugeoapieliminreg)||($menugeoapivisorterri)||($menugeoapivisorbenef)||($menugeoapirepordistorg)||($menugeoapirepordistterri)||($menugeoapirepordistlp)||($menugeoapireporanalesp)||($menugeoapireporregrepetidos)||($menugeoapirepornovt1)||($menugeoapirepornovt2)||($menugeoapirepornovt3)) 
        <!--Oculta la opción geoapi si no es el administrador-->
          <li id="geoapi" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">GeoApi<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!--espacio de administracion-->
              <li><a align="center"><b>Administración</b></a></li>
              @if($menugeoapitecsaf)
                <li id="geoapitecsaf"><a href="<?=URL::to('tecnicosaf'); ?>"><span class="glyphicon glyphicon-ok"></span> Técnicos SAF</a></li>              
              @endif
              @if($menugeoapieliminreg)
                <li id="geoapieliminreg"><a href="#"><span class="glyphicon glyphicon-ok"></span> Eliminar Registros</a></li>
              @endif
                <li class="divider"></li>
                <!--Termina espacio de administracion-->
                <!--espacio de visores-->
                <li><a align="center"><b>Visores Geográfico</b></a></li>
              @if($menugeoapivisorterri)
                <li id="geoapivisorterri"><a href="#"><span class="glyphicon glyphicon-ok"></span> Territorios</a></li>
              @endif
              @if($menugeoapivisorbenef)
                <li id="geoapivisorbenef"><a target="_blank" href="http://geoapic7.unodc.org.co/visor_territorios_benficiarios_DPCI/visor_territorios_benficiarios_DPCI.php"> <span class="glyphicon glyphicon-ok"></span> Beneficiarios</a></li>
              @endif
                <li class="divider"></li>
                <!--Termina espacio de visores-->
                <!--espacio de reportes-->
                <li><a align="center"><b>Reportes</b></a></li>
              @if($menugeoapirepordistorg)
                <li id="geoapirepordistorg"><a href="<?=URL::to('distribucion_organizacion'); ?>"> <span class="glyphicon glyphicon-ok"></span> Distribución por Organización</a></li>
              @endif
              @if($menugeoapirepordistterri)
                <li id="geoapirepordistterri"><a href="#"> <span class="glyphicon glyphicon-ok"></span> Distribución Territorial</a></li>
              @endif              
              @if($menugeoapirepordistlp)
                <li id="geoapirepordistlp"><a href="#"><span class="glyphicon glyphicon-ok"></span> Distribución por Línea Productiva</a></li>
              @endif
              @if($menugeoapireporanalesp)
                <li id="geoapireporanalesp"><a href="#"><span class="glyphicon glyphicon-ok"></span> Análisis Espacial de los datos</a></li>
              @endif
              @if($menugeoapireporregrepetidos)
                <li id="geoapireporregrepetidos"><a href="#"><span class="glyphicon glyphicon-ok"></span> Registros Repetidos</a></li>
              @endif
              @if($menugeoapirepornovt1)
                <li id="geoapirepornovt1"><a href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo I</a></li>
              @endif
              @if($menugeoapirepornovt2)
                <li id="geoapirepornovt2"><a href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo II</a></li>
              @endif
              @if($menugeoapirepornovt3)
                <li id="geoapirepornovt3"><a href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo III</a></li>
              @endif 
              <!--Termina espacio de reportes-->
            </ul>
          </li>
        @endif<!--Finaliza Ocultar la opción Geoapi si no es el administrador-->        
        @if($menuguardaun) <!--Oculta la opción guardaun si no es el administrador-->  
          <li id="guardaun" role="menu"><a href="guardaun" class="enlace-menu">GUARDAUN</a></li>             
        @endif<!--Finaliza Ocultar la opción guardaun si no es el administrador-->
        
      </ul>
    </div>
    <div class="col-sm-1"></div>

    <!--Menu compacto es visible en xs -->   
    <div class="col-xs-12 visible-xs">
      <nav class="navbar navbar-default" >
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a id="iniciomenupeq" class="navbar-brand " href="principal"><small><strong> Inicio</strong></small></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <!-- Lista desplegable de menu con submenu -->
              @if(Auth::user()->grupo=="1")<!--Oculta la opción Ejecución si no es el administrador-->
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Ejecución <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Monitoreo Integrado</a></li>
                    <li><a href="#">GME</a></li>
                    <li><a href="#">Proyectos Productivos</a></li>
                    <li><a href="#">Catatumbo</a></li>
                    <li><a href="#">SAI</a></li>
                    <li><a href="#">Saldo a Diciembre</a></li>
                  </ul>
                </li>
              @endif
              @if(($menureportesiscadi) || ($menuindicadoressiscadi) || ($menuestadisticosiscadi))
                <li class="dropdown"><a id="siscadimenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">SISCADI <span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    @if($menuindicadoressiscadi)
                    <li><a id="indicadoressiscadimenupeq"  href="siscadi_indicadores">Resultados de recolección</a></li>
                    @endif
                    @if($menureportesiscadi)
                    <li><a id="reportesiscadimenupeq" href='siscadi_encuentas'>Reportes PDF</a></li>
                    @endif
                    @if($menuestadisticosiscadi)
                    <li><a id="estadisticosiscadimenupeq" href='siscadi_estadisticas'>Estadísticas</a></li>                    
                    @endif 
                  </ul>
                </li>
              @endif
              @if(Auth::user()->grupo=="1")<!--Oculta la opción Ejecución si no es el administrador-->
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Donde estamos<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href='vista1'>Crear misión</a></li>
                    <li><a href="#">Cargar track</a></li>
                  </ul>
                </li>                
                <li><a href="#" class="enlace-menu">Historia</a></li>
              @endif<!--Finaliza Ocultar la opción si no es el administrador-->
              @if(($menugmevalcert) || ($menugmemetodologia) || ($menugmedisterradi) || ($menugmeinformes))
              <li class="dropdown"><a id="gmemenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">GME<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  @if($menugmevalcert)
                  <li><a id="gmevalcertmenupeq" href='validacion_certificacion'>Validación y Certificación</a></li>
                  @endif
                  @if($menugmemetodologia)
                  <li><a id="gmemetodologiamenupeq" href="metodologia_gme">Metodología</a></li>
                  @endif
                  @if($menugmedisterradi)
                  <li><a id="gmedisterradimenupeq" href="distribucion_gme">Distribución de la erradicación (Mapa)</a></li>
                  @endif
                  @if($menugmeinformes)
                  <li><a id="gmeinformesmenupeq" href="informes_gme">Informes</a></li>
                  @endif
                </ul>
              </li>                  
              @endif
              @if(($menucongral)||($menuestadoproc)||($menurepnumpro)||($menureplevtopo)||($menureparealev)||($menureprespjuri)||($menucargaini)||($menuprocadj)||($menulevtopo)||($menucoor)||($menumaps)||($menurepgenero)||($menureptiempo)) <!--Oculta la opción tierras si no es el administrador-->
                <li class="dropdown"><a id="tierrasmenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formalización de tierras<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    @if($menucongral)
                    <li><a id="tierrascongenmenupeq" href="<?=URL::to('consulta_general_tierras'); ?>">Consulta General y/o Consulta por Proceso</a></li>
                    <li class="divider"></li>
                    @endif
                    <!--espacio de reportes-->
                    <li><a align="center"><b>Reportes</b></a></li>
                    @if($menuestadoproc)
                    <li><a id="tierrasreporestadomenupeq" href="<?=URL::to('reporte_estado'); ?>"> <span class="glyphicon glyphicon-ok"></span> Estado</a></li>
                    @endif
                    @if($menurepnumpro)
                    <li><a id="tierrasrepornumprocmenupeq" href="<?=URL::to('reporte_numero_proceso'); ?>"> <span class="glyphicon glyphicon-ok"></span> Número de Procesos</a></li>
                    @endif
                    @if($menureplevtopo)
                    <li><a id="tierrasreporlevtopmenupeq" href="<?=URL::to('reporte_lavantamiento_topografico'); ?>"> <span class="glyphicon glyphicon-ok"></span> Levantamiento Topográfico</a></li>
                    @endif
                    @if($menureparealev)
                    <li><a id="tierrasreporarearepormenupeq" href="<?=URL::to('reporte_area_levantada'); ?>"> <span class="glyphicon glyphicon-ok"></span> Área Levantada</a></li>
                    @endif
                    @if($menureprespjuri)
                    <li><a id="tierrasreporesjurimenupeq" href="<?=URL::to('reporte_responsable_juridico'); ?>"><span class="glyphicon glyphicon-ok"></span> Responsable Jurídico</a></li>
                    @endif
                    @if($menurepgenero)
                    <li><a id="tierrasreporgeneromenupeq" href="<?=URL::to('reporte_genero'); ?>"><span class="glyphicon glyphicon-ok"></span> Género</a></li>
                    @endif
                    @if($menureptiempo)
                    <li><a id="tierrasreportiempomenupeq" href="<?=URL::to('reporte_tiempo'); ?>"><span class="glyphicon glyphicon-ok"></span> Temporalidad de eventos</a></li>
                    @endif                    
                    <li class="divider"></li>
                    <!--Termina espacio de reportes-->
                    <!--espacio de procesos-->
                    <li><a align="center"><b>Procesos</b></a></li>
                    @if($menucargaini)
                      <li><a id="tierrascarinimenupeq" href="<?=URL::to('carga_inicial'); ?>"> <span class="glyphicon glyphicon-ok"></span> Carga Inicial</a></li>
                    @endif
                    @if($menuprocadj)  
                      <li><a id="tierrasestjurmenupeq" href="<?=URL::to('procesos_adjudicados'); ?>"> <span class="glyphicon glyphicon-ok"></span> Procesos Adjudicados</a></li>
                    @endif
                    @if($menulevtopo)
                      <li><a id="tierraslevtopmenupeq" href="<?=URL::to('levantamiento_topografico'); ?>"><span class="glyphicon glyphicon-ok"></span> Levantamiento Topográfico</a></li>
                    @endif
                    @if($menucoor)
                      <li><a id="tierrascoordmenupeq" href="<?=URL::to('coordenadas_edicion'); ?>"><span class="glyphicon glyphicon-ok"></span> Edición de Coordenadas</a></li>
                    @endif
                    <li class="divider"></li>
                    <!--Termina espacio de procesos-->
                    @if($menumaps)
                    <li><a id="tierrasmapasmenupeq" href="<?=URL::to('mapas'); ?>"><span class="glyphicon glyphicon-ok"></span> Mapas</a></li>
                    @endif
                  </ul>
                </li>  
              @endif<!--Finaliza Ocultar la opción Ejecución si no es el administrador-->
              @if(($menucarguedocu) || ($menuconsuldocu) || ($menurepordocu))
              <li class="dropdown"><a id="documentosmenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Documentos<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  @if($menucarguedocu)
                  <li><a id="carguedocumenupeq" href="<?=URL::to('cargue_docu'); ?>"><span class="glyphicon glyphicon-ok"></span> Cargar documentos</a></li>
                  @endif
                  @if($menuconsuldocu)
                  <li><a id="consultadocumenupeq" href="<?=URL::to('consulta_docu'); ?>"><span class="glyphicon glyphicon-ok"></span> Consulta de documentos</a></li>
                  @endif
                  @if($menurepordocu)
                  <li><a id="repordocumenupeq" href="<?=URL::to('repor_docu'); ?>"><span class="glyphicon glyphicon-ok"></span> Reporte de documentos</a></li>                  
                  @endif
                </ul>
              </li>
              @endif<!--Finaliza Ocultar la opción art si no es el administrador-->
              @if(($artdashboard) || ($artmapa))
              <li class="dropdown"><a id="artmenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">ART<span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                  @if($menucarguedocu)
                  <li><a id="artdashboardmenupeq" href="<?=URL::to('artdashboard'); ?>"><span class="glyphicon glyphicon-ok"></span> Dashboard</a></li>
                  @endif
                  @if($menuconsuldocu)
                  <li><a id="artmapamenupeq" href="<?=URL::to('artmapa'); ?>"><span class="glyphicon glyphicon-ok"></span> Mapa</a></li>
                  @endif
                  @if($artmapa)
                    <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> Diagnóstico familiar</a></li>
                  @endif
                  @if($artmapa) 
                    <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> ZVTN - PTN</a></li>
                  @endif
                  @if($artmapa) 
                    <li id="artmapamenu"><a href='siscadi_estadisticas'"><span class="glyphicon glyphicon-ok"></span> Normatividad</a></li>
                  @endif
                  <li class="divider"></li>
                  <!--Termina espacio de Reportes-->
                  <li><a align="center"><b>Cargue de información</b></a></li>
                  @if($artcensofami)                  
                  <li><a id="artcensofamilimenupeq" href="<?=URL::to('censofamiliar'); ?>"><span class="glyphicon glyphicon-ok"></span> Censo de familias</a></li>
                  @endif                   
                </ul>
              </li>
              @endif<!--Finaliza Ocultar la opción art si no es el administrador-->
              @if(($menugeoapitecsaf)||($menugeoapieliminreg)||($menugeoapivisorterri)||($menugeoapivisorbenef)||($menugeoapirepordistorg)||($menugeoapirepordistterri)||($menugeoapirepordistlp)||($menugeoapireporanalesp)||($menugeoapireporregrepetidos)||($menugeoapirepornovt1)||($menugeoapirepornovt2)||($menugeoapirepornovt3)) 
              <!--Oculta la opción geoapi si no es el administrador-->                
                <li  class="dropdown"><a id="geoapimenupeq" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">GeoApi<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <!--espacio de administracion-->
                    <li><a align="center"><b>Administración</b></a></li>
                    @if($menugeoapitecsaf)
                      <li><a id="geoapitecsafmenupeq" href="<?=URL::to('tecnicosaf'); ?>"><span class="glyphicon glyphicon-ok"></span> Técnicos SAF</a></li>
                    @endif
                    @if($menugeoapieliminreg)
                      <li><a id="geoapieliminregmenupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Eliminar Registros</a></li>
                    @endif
                      <li class="divider"></li>
                      <!--Termina espacio de administracion-->
                      <!--espacio de visores-->
                      <li><a align="center"><b>Visores Geográfico</b></a></li>
                    @if($menugeoapivisorterri)
                      <li><a id="geoapivisorterrimenupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Territorios</a></li>
                    @endif
                    @if($menugeoapivisorbenef)
                      <li><a id="geoapivisorbenefmenupeq" target="_blank" href="http://geoapic7.unodc.org.co/visor_territorios_benficiarios_DPCI/visor_territorios_benficiarios_DPCI.php"> <span class="glyphicon glyphicon-ok"></span> Beneficiarios</a></li>
                    @endif
                      <li class="divider"></li>
                      <!--Termina espacio de visores-->
                      <!--espacio de reportes-->
                      <li><a align="center"><b>Reportes</b></a></li>
                    @if($menugeoapirepordistorg)
                      <li><a id="geoapirepordistorgmenupeq" href="<?=URL::to('distribucion_organizacion'); ?>"> <span class="glyphicon glyphicon-ok"></span> Distribución por Organización</a></li>
                    @endif
                    @if($menugeoapirepordistterri)
                      <li><a id="geoapirepordistterrimenupeq" href="#"> <span class="glyphicon glyphicon-ok"></span> Distribución Territorial</a></li>
                    @endif              
                    @if($menugeoapirepordistlp)
                      <li><a id="geoapirepordistlpmenupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Distribución por Línea Productiva</a></li>
                    @endif
                    @if($menugeoapireporanalesp)
                      <li><a id="geoapireporanalespmenupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Análisis Espacial de los datos</a></li>
                    @endif
                    @if($menugeoapireporregrepetidos)
                      <li><a id="geoapireporregrepetidosmenupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Registros Repetidos</a></li>
                    @endif
                    @if($menugeoapirepornovt1)
                      <li><a id="geoapirepornovt1menupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo I</a></li>
                    @endif
                    @if($menugeoapirepornovt2)
                      <li><a id="geoapirepornovt2menupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo II</a></li>
                    @endif
                    @if($menugeoapirepornovt3)
                      <li><a id="geoapirepornovt3menupeq" href="#"><span class="glyphicon glyphicon-ok"></span> Novedades Tipo III</a></li>
                    @endif 
                    <!--Termina espacio de reportes-->
                  </ul>
                </li>
              @endif<!--Finaliza Ocultar la opción Geoapi si no es el administrador-->
              @if($menuguardaun) <!--Oculta la opción guardaun si no es el administrador-->  
              <li><a id="guardaunmenupeq" href="guardaun">GUARDAUN</a></li>              
              @endif<!--Finaliza Ocultar la opción guardaun si no es el administrador-->
            </ul><!-- fin de menu con submenu -->
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>


 <!--Fin del segundo contenedor-->  
@show
@section('contenedorgeneral1')
@show
@section('piedepagina')
<!--cuarto contenedor pie de página-->
<div class="container-fluid well" id="piedepagina">
  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-3">
      <br />        
      <br />        
    </div>
  </div>
</div>
<!--Fin del cuarto contenedor-->
<!--quinto contenedor-->  
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-12"><small><p class="text-right">Unidad de Información y Análisis – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá D.C. - Colombia</p></small>
    </div>
  </div>
	<br/><br/>
</div>
<!--Fin del quinto contenedor-->  
@show
@section('jsbody')
@show
</body>
</html>