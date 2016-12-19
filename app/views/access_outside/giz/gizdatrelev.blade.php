<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
			Cooperación GIZ-UNODC 
	</title>
	
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
	
	<!-- librerias JavaScript que se utilizan en la pagina -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery.dataTables.min.js"></script>
	<script src="assets/js/dataTables.bootstrap.min.js"></script>
  <script src="assets/js/dataTables.responsive.min.js"></script>
	<script src="assets/js/bootstrap-datepicker.js"></script>
	<script src="assets/js/locales/bootstrap-datepicker.es.min.js" charset="UTF-8"></script>
	
</head>
<body>
<!--comienza la cabecera-->

<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
  <div class="row">
    <!--Columna logo con imágen-->
    <div class="col-xs-6 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img src="assets/img/unodc.gif" class="img-responsive" alt="logounodc">
    </div>
    <!--espaciado para que en xs queden separado logo y boton-->
    <div class="col-xs-1 visible-xs">
    </div>
    <div class="col-lg-6 visible-lg">
    </div>
    <!--columna botón crear cuenta solo es visible en xs-->
    <div class="col-xs-5 visible-xs">
    
    </div>
           
  </div>
</div>
<!--Fin del primer contenedor-->

<!--Segundo contenedor menu secundario-->
<div class="container-fluid">
  <div class="row" id="menu-sec">
    <!--Menu secundario es visible en sm lg-->
    <div class="col-sm-2 "></div>
    <div class="col-sm-9 text-center text-primary visible-sm visible-md visible-lg ">
      <ul class="nav nav-pills ">
        <!--<li role="presentation" ><a href="#"><strong> INICIO</strong></a></li>-->
        <li id="menuprincipal" role="menu"><a href="principal">INICIO</a></li>
        <li id="menugizestudio" role="menu"><a href="Cooperacion_GIZ" class="enlace-menu">Estudio</a></li>
        <li id="menugizdatrelev" role="menu"><a href="Cooperacion_GIZ_datosrelevantes" class="enlace-menu">Datos Relevantes</a></li>
        <li id="menugizvisor" role="menu"><a href="Cooperacion_GIZ_visorgeo" class="enlace-menu">Visor Geográfico</a></li>
        <li id="menugizdocu" role="menu"><a href="Cooperacion_GIZ_documentos" class="enlace-menu">Documentos</a></li>        
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
            <a id="iniciomenupeq" class="navbar-brand " href="principal"><small><strong> INICIO</strong></small></a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
              <!-- Lista desplegable de menu con submenu -->
              <li><a id="gizestudiomenupeq" href="Cooperacion_GIZ" class="enlace-menu">Estudio</a></li>                           
              <li><a id="gizdatrelevmenupeq" href="Cooperacion_GIZ_datosrelevantes" class="enlace-menu">Datos Relevantes</a></li>
              <li><a id="gizvisormenupeq" href="Cooperacion_GIZ_visorgeo" class="enlace-menu">Visor Geográfico</a></li>
              <li><a id="gizdocumenupeq" href="Cooperacion_GIZ_documentos" class="enlace-menu">Documentos</a></li>
              <!--  <li><a id="guardaunmenupeq" href="guardaun">GUARDAUN</a></li>   -->            
              
            </ul><!-- fin de menu con submenu -->
          </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
      </nav>
    </div>
  </div>
</div>
<!--Fin del segundo contenedor-->  
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-sm-10">
          <br>
          <h2 class="text-center text-primary">Evaluación de motores de deforestación y degradación de bosques asociada a cultivos ilícitos en la región de Amazonía y Catatumbo</h2>
          <br>
          <p class="lead text-justify">A continuación se muestran las tablas con los resultados  más relevantes obtenidos en este estudio.</p>

         <p class="lead text-justify"><i><b>Conceptos claves</b></i><br></p>

          <i><b>Bosque 2005:</b></i> Cobertura boscosa obtenida a partir de los mapas de cambio de coberturas bosque/ no bosque 2005-2010 del IDEAM.<br>
          <i><b>Deforestación:</b></i> Corresponde únicamente a la conversión directa de la cobertura de bosque natural a  un cultivo de coca durante el periodo 2005-2014.<br> 
          <i><b>Degradación:</b></i> Afectación continúa de las capacidades del bosque por el establecimiento de un cultivo de coca durante el periodo 2005-2014.<br>
          <i><b>Afectación total:</b></i> Es la pérdida total de la cobertura boscosa y/o la afectación continúa de las capacidades del bosque, a causa del establecimiento de un cultivo de coca (deforestación + degradación) durante el periodo 2005-2014.<br>
          <i><b>T.A.D:</b></i> Es la Tasa anual de deforestación por cultivos de coca que indica la relación entre el área de bosque de referencia (bosque en 2005) y el área deforestada por coca en cada región para el periodo 2005-2014.<br>
          <i><b>Def. Asociada:</b></i> La deforestación asociada al cultivo de coca se entiende como la pérdida de la cobertura boscosa en áreas circundantes (1km de distancia) a la afectación del bosque por cultivos de coca. Esta pérdida está condicionada por la presencia de actividades antrópicas<br> dinamizadas por la aparición de un cultivo de coca durante el periodo 2005-2014.</p><br>

          <h4>Tabla 1. Distribución departamental del área deforestada y degradada <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></h4>
        </div>
    </div>
    <!--Inicio de la tabla de departamentos-->
    <div class="row">
        <!--aca se escribe el codigo-->  
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-sm-10">  
        <br>

        <table id="tablagizdepto" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">Región</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Bosque 2005</th>
              <th class="text-center">Deforestación</th>
              <th class="text-center">Degradación</th>
              <th class="text-center">Afectación directa</th>
              <th class="text-center" title="Tasa anual de deforestación">T.A.D. (%)</th>
              <th class="text-center">Def. asociada</th>              
            </tr>
          </thead>
          <tbody>            
            @foreach($Datos_arreglo[0] as $departamentos)
              <tr>
                <td >{{$departamentos->NOM_REGION}}</td>
                <td >{{$departamentos->NOM_DPTO}}</td>
                <td >{{$departamentos->Bosque_05}}</td>
                <td >{{$departamentos->Defo_05_14}}</td>
                <td >{{$departamentos->Degra_05_14}}</td>
                <td >{{$departamentos->Afec_05_14}}</td>
                <td >{{$departamentos->Tasa_05_14}}</td>
                <td >{{$departamentos->Defo_asoc_05_14}}</td>                                
              </tr>            
            @endforeach            
          </tbody>
        </table>
        
        </div>
        <div class="col-sm-1"></div>   
      </div>
    <!--Fin de la tabla de departamentos-->
    <!--Inicio tabla de municipios-->     
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <h4>Tabla 2. Distribución  municipios  con área deforestada y degradada <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></h4> 
      <br>
      <table id="tablagizmuni" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">
              
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Bosque 2005</th>
              <th class="text-center">Deforestación</th>
              <th class="text-center">Degradación</th>
              <th class="text-center">Afectación Total</th>
              <th class="text-center" title="Tasa anual de deforestación">T.A.D. (%)</th>
              <th class="text-center">Def. asociada</th>              
            </tr>
          </thead>
          <tbody>            
            @foreach($Datos_arreglo[1] as $municipios)
              <tr>
                
                <td >{{$municipios->NOM_DPTO}}</td>
                <td >{{$municipios->NOM_MPIO}}</td>
                <td >{{$municipios->Bosque_05}}</td>
                <td >{{$municipios->Defo_05_14}}</td>
                <td >{{$municipios->Degra_05_14}}</td>
                <td >{{$municipios->Afec_05_14}}</td>
                <td >{{$municipios->Tasa_05_14}}</td>
                <td >{{$municipios->Defo_asoc_05_14}}</td>                                
              </tr>            
            @endforeach            
          </tbody>
        </table>


      </div>
    </div>
    <!--Fin de la tabla de municipios-->
    <!--Inicio tabla de parques-->     
    <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <h4>Tabla 3. Distribución  del área deforestada y degradada en  el Sistema de Áreas Protegidas de Parques Nacionales Naturales <b>por cultivos de coca entre el 2005 y 2014. (ha)</b>
      </h4> 
      <br>
      <table id="tablagizparque" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">              
              <th class="text-center">Área protegida</th>
              <th class="text-center">Deforestación</th>
              <th class="text-center">Degradación</th>
              <th class="text-center">Afectación total</th>            
            </tr>
          </thead>
        <tbody>            
            @foreach($Datos_arreglo[2] as $parques)
              <tr>                
                <td >{{$parques->NOM_PNN}}</td>                
                <td >{{$parques->Defo_05_14}}</td>
                <td >{{$parques->Degra_05_14}}</td>
                <td >{{$parques->Afec_05_14}}</td>                
              </tr>            
            @endforeach            
          </tbody>

      </table>

      </div>
    </div>
    <!--Fin de la tabla de parques-->
    <!--Inicio tabla de resguardos--> 
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-sm-10">
        <h4>Tabla 4. Distribución  del área deforestada y degradada en Resguardos Indígenas<b>por cultivos de coca entre el 2005 y 2014. (ha)</b>
        </h4> 
        <br>
        <table id="tablagizresguardos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary ">              
                <th class="text-center">Resguardo Indígena</th>
                <th class="text-center">Etnía</th>
                <th class="text-center">Deforestación</th>
                <th class="text-center">Degradación</th>
                <th class="text-center">Afectación total</th>            
              </tr>
            </thead>
          <tbody>            
              @foreach($Datos_arreglo[3] as $parques)
                <tr>                
                  <td >{{$parques->NOM_RI}}</td>   
                  <td >{{$parques->NOM_ETNIA}}</td>                             
                  <td >{{$parques->Defo_05_14}}</td>
                  <td >{{$parques->Degra_05_14}}</td>
                  <td >{{$parques->Afec_05_14}}</td>                
                </tr>            
              @endforeach            
            </tbody>

        </table>

        </div>
      </div>


  <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <h4>Tabla 5. Factores determinantes del cultivos de coca como motor de deforestación</h4>   
      <br>
      <table id="tablagizfactores" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">              
              <th class="text-center">Variables</th>
              <th class="text-center">Aspectos Evaluados</th>
              <th class="text-center">Indicador</th>                          
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Características biofísicas</td>
              <td>-Drenaje<br>
                  -Clima<br> 
                  -Erosión<br>
                  -Fertilidad<br>
                  -Altitud<br>
              </td>
              <td>-Zonas agroecológicas<br>
                  -Modelo Digital de Elevación
              </td> 
            </tr> 
            <tr>
              <td>Presencia de coca</td>
              <td>-Distancia a zonas con alta intensidad, persistencia de cultivos de coca</td>
              <td>-Índice de amenaza<br>-Proximidad a cultivos de coca</td> 
            </tr> 
            <tr>
              <td>Presencia de infraestructura vial</td>
              <td>-Distancia a vías</td>
              <td>-Anillos de proximidad a vías terrestres</td> 
            </tr> 
            <tr>
              <td>Presencia de bosque</td>
              <td>-Intervención del bosque</td>
              <td>-Cobertura de bosque<br>-Caracterización de grillas según participación de bosque</td> 
            </tr> 
            <tr>
              <td>Presencia de ríos</td>
              <td>-Distancia a ríos según vulnerabilidad por cultivos de coca</td>
              <td>-Anillos de proximidad a ríos</td> 
            </tr> 
            <tr>
              <td>Áreas protegidas</td>
              <td>-Distancia a área protegidas</td>
              <td>-Anillos de proximidad a áreas protegidas</td> 
            </tr> 
            <tr>
              <td>Resguardo indígenas</td>
              <td>-Distancia a Resguardos Indígenas</td>
              <td>-Anillos de proximidad a Resguardos Indígenas</td> 
            </tr> 
            <tr>
              <td>Centros poblados</td>
              <td>-Distancia a centros poblados</td>
              <td>-Anillos de proximidad a centros poblados</td> 
            </tr> 
            <tr>
              <td>Zonas excluidas para la aspersión</td>
              <td>-Distancia e incidencia de áreas con limitaciones jurídicas para ser asperjadas</td>
              <td>-Anillos de proximidad respecto a áreas excluidas para la aspersión</td> 
            </tr> 

          </tbody>
      </table>
      </div>
  </div>

  <div class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <h4>Tabla 6. Causas subyacentes del cultivos de coca como motor de deforestación</h4>   
      <br>
      <table id="tablagizaspectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">              
              <th class="text-center">Causas subyacentes</th>
              <th class="text-center">Aspecto a evaluar</th>
              <th class="text-center">Indicador</th>                          
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Control estatal  y social del bosque</td>
              <td>Eficacia en las medidas de control ejercidas para la protección del bosque, respecto a la deforestación por coca.</td>
              <td>-Intervención del bosque por cultivos de coca en áreas protegidas y resguardos indígenas</td> 
            </tr>
            <tr>
              <td>Medidas de control a cultivos ilícitos</td>
              <td>Acciones de los cultivadores de coca para disminuir el impacto en las medidas de control.</td>
              <td>-Tamaño de lotes de coca<br>-Dispersión de lotes de coca</td> 
            </tr>
            <tr>
              <td>Migración de comunidades por coca</td>
              <td>-La movilización de la deforestación asociada al cultivo de coca.<br>-Expansión de nuevos frentes de colonización.</td>
              <td>-Percepción de la comunidad capturada en talleres<br>-Cartografía Social<br>-Revisión bibliográfica</td> 
            </tr>
            <tr>
              <td>Ruralización</td>
              <td>Dinámica de colonización y transformación del territorio a causa del cultivo de coca.</td>
              <td>-Porcentajes de área intervenida<br>-Distancia a frentes de colonización</td> 
            </tr>
            <tr>
              <td>Cultura de la legalidad</td>
              <td>Percepción cultural dominante en las comunidades respecto a la problemática de deforestación y degradación del bosque a causa de los cultivos de coca</td>
              <td>-Percepción de la comunidad capturada en talleres.</td> 
            </tr>
            <tr>
              <td>Costo-beneficio productor de coca</td>
              <td>Incidencia de la relación costo/beneficio sobre el cultivo de coca establecido en el bosque.</td>
              <td>-Percepción de la comunidad capturada en talleres<br>-Revisión bibliográfica</td> 
            </tr>
            <tr>
              <td>Competitividad productiva</td>
              <td>Incidencia de la falta de alternativas productivas, sobre la decisión de establecer cultivos de coca en el bosque.</td>
              <td>-Percepción de la comunidad capturada en talleres<br>-Revisión bibliográfica</td> 
            </tr>
            <tr>
              <td>Tenencia de la tierra</td>
              <td>Estructura de la tenencia de la tierra y relación con la afectación por deforestación y degradación ocasionada por los cultivos de coca.</td>
              <td>-Estado de actualización catastral<br>-Existencia de matrícula inmobiliaria<br>-Índice de Gini</td> 
            </tr>
            <tr>
              <td>Valor económico del bosque</td>
              <td>Caracterizar el valor de avalúo del bosque de las áreas afectadas por los cultivos de coca.</td>
              <td>-Distribución municipal de avalúo catastral por hectárea</td> 
            </tr>
            <tr>
              <td>Valor ecológico del bosque</td>
              <td>Incidencia del desconocimiento de los bienes y servicios ofrecidos por el bosque en torno a la decisión de afectación por deforestación a causa de los cultivos de coca.</td>
              <td>-Percepción de la comunidad capturada en talleres</td> 
            </tr>
          </tbody>
      </table>


      </div>
  </div>  

  <!--Aca se acava el div contenedor-->    
  </div>
<!--fin de se escribe el codigo-->        
       
      
<!--fin del codigo-->    
    </div>
  </div>
<!--Fin del tercer contenedor--> 

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
<script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#menugizdatrelev" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);
          $('[data-toggle="tooltip"]').tooltip();
          $('[data-toggle="popover"]').popover();
          $('#tablagizdepto').DataTable();             
          $('#tablagizmuni').DataTable();
          $('#tablagizparque').DataTable();
          $('#tablagizresguardos').DataTable();
          $('#tablagizaspectos').DataTable();
          $('#tablagizfactores').DataTable();
      });
    
    </script>
</body>
</html>