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
          <h2 class="text-center text-primary">Análisis del cultivo de coca como motor de deforestación en el contexto del Desarrollo Alternativo y REDD+, en las Regiones de Amazonía y Catatumbo (2005-2014)</h2>
          <br>
          <p class="lead text-justify">A continuación se muestran las tablas con los resultados  más relevantes obtenidos en este estudio.</p>

          <ul class="list-group">
          <li class="list-group-item"><a href="#tabla1">Tabla 1.</a> Distribución departamental del área deforestada y degradada <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></li>
          <li class="list-group-item"><a href="#tabla2">Tabla 2.</a> Distribución  municipios  con área deforestada y degradada <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></li>
          <li class="list-group-item"><a href="#tabla3">Tabla 3.</a> Distribución  del área deforestada y degradada en  el Sistema de Áreas Protegidas de Parques Nacionales Naturales <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></li>
          <li class="list-group-item"><a href="#tabla4">Tabla 4.</a> Distribución  del área deforestada y degradada en Resguardos Indígenas<b>por cultivos de coca entre el 2005 y 2014. (ha)</b></li>
          <li class="list-group-item"><a href="#tabla5">Tabla 5.</a> Factores determinantes del cultivos de coca como motor de deforestación</li>
          <li class="list-group-item"><a href="#tabla6">Tabla 6.</a> Causas subyacentes del cultivos de coca como motor de deforestación</li>
          <li class="list-group-item"><a href="#conclusiones">Conclusiones</a></li>
          <li class="list-group-item"><a href="#recomendaciones">Recomendaciones</a></li>
          </ul>

         <br> 
         <p class="lead text-justify"><i><b>Conceptos claves</b></i><br></p>

          <i><b>Bosque 2005:</b></i> Cobertura boscosa obtenida a partir de los mapas de cambio de coberturas bosque/ no bosque 2005-2010 del IDEAM.<br>
          <i><b>Deforestación:</b></i> Corresponde únicamente a la conversión directa de la cobertura de bosque natural a  un cultivo de coca durante el periodo 2005-2014.<br> 
          <i><b>Degradación:</b></i> Afectación continúa de las capacidades del bosque por el establecimiento de un cultivo de coca durante el periodo 2005-2014.<br>
          <i><b>Afectación total:</b></i> Es la pérdida total de la cobertura boscosa y/o la afectación continúa de las capacidades del bosque, a causa del establecimiento de un cultivo de coca (deforestación + degradación) durante el periodo 2005-2014.<br>
          <i><b>T.A.D:</b></i> Es la Tasa anual de deforestación por cultivos de coca que indica la relación entre el área de bosque de referencia (bosque en 2005) y el área deforestada por coca en cada región para el periodo 2005-2014.<br>
          <i><b>Def. Asociada:</b></i> La deforestación asociada al cultivo de coca se entiende como la pérdida de la cobertura boscosa en áreas circundantes (1km de distancia) a la afectación del bosque por cultivos de coca. Esta pérdida está condicionada por la presencia de actividades antrópicas<br> dinamizadas por la aparición de un cultivo de coca durante el periodo 2005-2014.</p><br>

          
        </div>
    </div>
    <!--Inicio de la tabla de departamentos-->
    <div id="tabla1" class="row">

        <!--aca se escribe el codigo-->  
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-sm-10">  
        <h4>Tabla 1. Distribución departamental del área deforestada y degradada <b>por cultivos de coca entre el 2005 y 2014. (ha)</b></h4>
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
    <hr>
    <!--Inicio tabla de municipios-->     
    <div id="tabla2" class="row">
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
    <hr>
    <!--Inicio tabla de parques-->     
    <div id="tabla3" class="row">
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
    <hr>
    <!--Inicio tabla de resguardos--> 
    <div id="tabla4" class="row">
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
  <!--Fin de la tabla de resguardos-->
    <hr>
   <!--Inicio tabla de factores--> 
  <div id="tabla5" class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
      <h4>Tabla 5. Factores determinantes del cultivos de coca como motor de deforestación</h4>   
      <br>
      <table id="tablagizfactores" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary ">              
              <th class="text-center">Factor Determinante</th>
              <th class="text-center">Aspecto a Evaluar</th>
              <th class="text-center">Indicador</th>                          
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Acceso víal</td>
              <td>Tipología y distancia a vías</td>
              <td>Proximidad a vías terrestres según categorías IGAC</td> 
            </tr> 
            <tr>
              <td>Hidrografía vulnerable</td>
              <td>Distancia a ríos según vulnerabilidad por cultivos de coca</td>
              <td>Proximidad a hidrografía</td> 
            </tr> 
            <tr>
              <td>Áreas protegidas</td>
              <td>Distancia a áreas protegidas</td>
              <td>Proximidad a áreas protegidas (Parques Nacionales Naturales)</td> 
            </tr> 
            <tr>
              <td>Resguardos indígenas</td>
              <td>Distancia a Resguardos Indígenas</td>
              <td>Proximidad a Resguardos Indígenas</td> 
            </tr>            

          </tbody>
      </table>
      </div>
  </div>
  <!--Fin de la tabla de factores-->
  <hr>
  <!--Inicio tabla causas--> 
  <div id="tabla6" class="row">
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
  <div id="conclusiones" class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
        <h3>Conclusiones</h3>
        <p><strong>Cuantificación y ubicación de la afectación del bosque por causa de los cultivos de coca</strong></p>
        <p>El estudio del cultivo de coca como motor de deforestación permite entender y dimensionar la afectación real de los cultivos ilícitos al ecosistema boscoso, en la medida en que se lograron ubicar zonas críticas del fenómeno, calcular la velocidad de reducción del bosque, caracterizar la dinámica y dimensionar la participación y el impacto de afectación al bosque natural.</p>
        <p>En las regiones Amazonía y Catatumbo, para el período comprendido entre 2005-2014 se deforestaron 19.769 hectáreas para el establecimiento de cultivos de coca; así mismo, la degradación fue de 30.567 hectáreas. Los resultados indicaron que para el establecimiento de este tipo de cultivos se afectó de forma directa 50.336 hectáreas de bosque y de forma indirecta (deforestación asociada al cultivo de coca) 327.193 hectáreas.</p>
        <p>Respecto a los datos registrados por el IDEAM sobre deforestación nacional, la pérdida de bosque por el establecimiento de cultivos de coca representa el 3% de la deforestación total generada en las dos regiones (781.379 ). Entre tanto el 42% de la deforestación total estimada en las dos regiones obedece a la deforestación asociada a los cultivos de coca, relacionada con el establecimiento de actividades concomitantes de este cultivo.</p>
        <p>Las tasas anuales de deforestación permiten conocer la velocidad de afectación del bosque por causa de los cultivos de coca. Para el último período de análisis (2010 – 2014) en la Amazonía sobresalen los municipios de Valle del Guamuez y Puerto Caicedo en el departamento de Putumayo, con los valores más altos respecto a las tasas; entre tanto, en Catatumbo los mayores valores se registran para los municipios de Tibú y El Tarra.</p>
        <p>En cuanto a la afectación del bosque, encontramos que para la región Catatumbo los municipios con mayores registros son Tibú y Sardinata ubicándose, principalmente, en la periferia de los centros poblados de la Gabarra y Versalles, en Tibú, y al norte de Sardinata. En la Amazonía, el departamento de Putumayo presenta los valores más altos, concentrando su afectación en los municipios de Puerto Asís, Puerto Leguízamo, Orito y Puerto Guzmán; Guaviare se encuentra en segundo lugar, ubicado espacialmente al interior y en la periferia de la Reserva Natural Nukak y del resguardo Indígena Nukak-Maku; el departamento de Meta se ubica tercero con las concentraciones más importantes en los municipios que conformar el PNN La Macarena (Puerto Rico, La Macarena y Vistahermosa) y por último se encuentra Caquetá en donde la afectación del bosque se ubica forma dispersa por lo cual no se generan núcleos destacados de afectación; sin embargo, los municipios de Cartagena del Chairá y Solano contienen los niveles más altos por esta actividad. </p>
        <p>La zona de estudio cuenta con 11 áreas de manejo especial, de las cuales nueve poseen algún grado de afectación del bosque por cultivos de coca concentrando el 12% (6.184 hectáreas) del total analizado. Ladinámica de la afectación en los dos períodos (2005-2010 y 2010-2014) mostró un aumento del 24% en las áreas protegidas de la región, en donde, la PNN La Macarena tuvo la mayor variación con un incremento en el área afectada de 761 hectáreas entre el 2010 y el 2014; mientras que la Reserva Nukak fue el área con mayor disminución, 251 hectáreas, frente al 2005-2010.</p>
        <p>En el análisis de la afectación del bosque y las áreas protegidas se encontró que Catatumbo agrupa el 5% del bosque afectado en la región, mientras que para Amazonía esta cifra es del 14 %. Las áreas protegidas con mayor afectación son: PNN Sierra de la Macarena, Reserva natural Nukak, PNN La Paya y PNN Catatumbo Barí.</p>
        <p><strong>Agentes de deforestación</strong></p>
        <p>La dinámica y la relación que se manifiesta entre los cultivos de coca, bosque y territorio, permitieron identificar dos tipologías de agentes de deforestación: agentes directos y agentes indirectos; los primeros correspondientes a cultivadores de coca de subsistencia y extensivos, los cuales se diferencian principalmente por el tamaño del lote sembrado. Entre tanto, los agentes indirectos se clasificaron en inversionista ausentista del cultivo de coca y grupos al margen de la ley.</p>
        <p>Los agentes de deforestación directa están diferenciados por el área del lote de coca sembrado, para los cultivadores de subsistencia se estableció en Catatumbo un área inferior a una hectárea mientras que en Amazonía inferior a 2 hectáreas. Para los cultivadores extensivos el área de intervención del lote de coca se cuantificó en una cifra superior a 2 hectáreas para Amazonía y mayor a 1 hectárea para Catatumbo.</p>
        <p>Respecto a las tendencias de movilidad de los agentes de deforestación hacia nuevas áreas, se estableció para Catatumbo que la afectación del bosque se desplaza hacia el norte de la región, avanzando hacia los límites de las áreas protegidas del PNN Catatumbo Barí y los Resguardos Indígenas Gabarra –Catalaura y Motilón Barí. Entre tanto para Amazonía, se estableció que la hidrografía vulnerable es un factor relevante en el proceso de movilidad, para Putumayo sobresale la afectación sobre los ríos Piñuña Blanco, Piñuña Negro, Mecaya, Vides, San Juan, Orito y Acae; para los departamentos de Meta y Guaviare, la tendencia de movilidad se ubica hacia las zonas de amortiguación de los PNN Tinigua y PNN Sierra de la Macarena, y en Caquetá, se obtuvo que en el futuro se seguirán afectando las áreas de bosque circundantes a los ríos Caguán en Cartagena del Chairá y en Solano alrededor del río Sunsiya y sobre el río Caquetá, afectando prioritariamente los resguardos indígenas de Jericó-Consaya, La Teófila, Aguas Negras y Coropoya.</p><p><strong>Causas subyacentes y factores determinantes</strong></p>
        <p>La identificación de causas subyacentes y factores determinantes se realizó a través de metodologías de análisis estructural implementadas con expertos y metodologías rurales participativas a nivel regional, que involucraron diversos grupos focales (líderes regionales, organizaciones e instituciones del orden municipal y nacional). Como resultado, se obtuvo el reconocimiento de tres tipologías de causas subyacentes de nivel sociopolítico, económico y ambiental; además, se identificaron como factores determinantes condiciones biofísicas que direccionan la ubicación del fenómeno de deforestación por coca, clasificadas en cuatro variables relevantes. Las causas subyacentes que inciden en la afectación del bosque por los cultivos de coca son: control social y estatal del bosque, medidas de control a cultivos ilícitos, ruralización, migración de comunidades por coca, cultura de la ilegalidad, tenencia de la tierra, valor económico del bosque, costo / beneficio de producción del cultivo de coca, competitividad productiva y valor ecológico del bosque. Los factores determinantes identificados fueron acceso vial, hidrografía vulnerable, áreas protegidas y resguardos indígenas, derivados de sus condicionantes geográficos y su incidencia en el territorio como atrayentes o detractores del establecimiento de los cultivos de coca en el bosque.</p>
        <p>Respecto al conjunto de variables estudiadas en el análisis estructural, se concluyó que la gobernabilidad del territorio, unida a la ocupación social y a las medidas de control a los cultivos ilícitos, condicionan la afectación del bosque por cultivos de coca y generan dinámicas en las migraciones de las comunidades cocaleras. A su vez, esta situación es impulsada por la dinámica del cultivo de coca, que genera presión directa sobre los bosques a través de las condiciones económicas del mercado y la disposición espacial en la que se establecen los cultivos ilícitos en el territorio (apertura de la frontera agrícola, permanencia y distribución de los lotes de coca). </p>
        <p>La hidrografía y los límites intermunicipales constituyen el principal eje de avance de la afectación del bosque por coca hacia el interior de los PNN y resguardos, dado que estos se han constituido como vías de acceso hacia estas áreas y cumplen un papel importante en el suministro de agua y el transporte de insumos para el procesamiento de la hoja de coca. Para el PNN Catatumbo Barí estos ejes han sido principalmente el río Catatumbo y la frontera municipal entre Tibú y El Tarra. En las áreas especiales de Amazonía los principales ejes han sido los ríos Cafre, Guayabero, Inírida, Mecaya, Putumayo y Sencella.</p>
        <p>Las áreas especiales de Parques Nacionales Naturales y Resguardos Indígenas constituyen un límite, que a pesar de ser físicamente intangible, ha frenado el avance de los cultivos de coca hacia las áreas internas de bosque, esto explica la relativa estabilidad de los porcentajes de afectación interna a pesar del constante incremento de cultivos de coca que presionan el avance de la intervención desde el límite exterior de estas áreas. En los PNN, esta barrera está dada por la idea que tienen los agentes cultivadores sobre la vigilancia, control estatal y monitoreo en estas áreas, mientras que en los resguardos el control es ejercido por las comunidades indígenas que los habitan. </p>
        <p>La reducción en el tamaño del área sembrada con coca implica un aumento en el número de lotes establecidos por el cultivador para compensar el área sembrada. Esta dinámica incrementa la fragmentación del bosque (mayor número de perforaciones para el establecimiento de coca) y genera eventos de afectación aislada alrededor de los cuales se extiende la pérdida de bosque por el establecimiento de otras actividades. Los departamentos analizados mantienen una tendencia a la aparición concentrada de cultivos de coca; sin embargo, a nivel municipal, se presentaron eventos de afectación dispersa principalmente en el Resguardo Indígena Nukak Maku, los Parques Naturales Tinigua y Sierra de la Macarena y a lo largo de las Sabanas del Yarí en el límite municipal entre La Macarena y San Vicente del Caguán.</p>
        <p>Durante los dos períodos analizados (2005-2010 y 2010-2014) en Catatumbo se presentó un aumento constante del área sembrada con coca y un consecuente incremento en el área de bosque afectada por el establecimiento de este cultivo; sin embargo, en Amazonía durante el segundo período, a la par de una reducción del área sembrada, se incrementó el área de bosque afectado por coca. Esta tendencia indica una preferencia por el establecimiento de estos cultivos en el bosque, asociada principalmente a la percepción que tiene el cultivador sobre el aumento en la productividad y obtención de mejores cosechas en suelos de bosque recién talados y/o quemados con mínima inversión en procesos de adecuación, compra de abonos y pesticidas.</p>
        <p>La afectación del bosque por cultivos de coca tiene un ciclo estrechamente relacionado con el proceso de ruralización dado que la consolidación de características mínimas de desarrollo, comercialización de productos, construcción de infraestructura y conformación y titulación de fincas, motiva la venta masiva de tierras y el desplazamiento de los campesinos hacia los frentes de colonización donde la coca es generalmente el primer cultivo comercial que se establece para soportar económicamente el desarrollo de otras actividades. Este desplazamiento está direccionado hacia áreas de bosque dentro o cerca de la frontera de colonización; de esta forma, entre el 40% y el 60% de la afectación del bosque de las dos regiones analizadas, se ubicó en grillas de colonización, principalmente en áreas de ampliación del límite de intervención y puntas de colonización.</p>
        <p>Los frentes de colonización actúan como un factor determinante dado que la vulnerabilidad del bosque a ser deforestado y/o degradado por el establecimiento de cultivos de coca aumenta conforme disminuye la distancia a estos frentes, de forma que los bosque hacia los que se desplazan los cultivos de coca están principalmente ubicados a menos de 1 km del límite de los frentes de intervención.</p>
        <p>El desconocimiento de las estructuras y relación de tenencia con la tierra es un factor característico de los municipios de Amazonía donde se concentró la afectación del bosque por cultivos de coca, debido a que el 65% de la afectación se ubicó en municipios con catastro desactualizado o sin formar. Esta característica es representativa principalmente en Guaviare, donde los cuatro municipios que conforman el departamento no han tenido procesos de formación catastral. Por el contrario, en Catatumbo, está no es una característica predominante, ya que en Tibú (municipio con estado catastral actualizado) se concentró el 58% de la afectación del bosque por coca. La existencia de matrícula inmobiliaria en catastro es un factor característico de los municipios con afectación en las dos regiones, ya que en Catatumbo el 61% de la afectación se concentró en áreas sin matrícula inmobiliaria y en Amazonía este porcentaje fue del 37%.</p>
        <p>Las migraciones son un factor dinamizador de la afectación del bosque por cultivos de coca. Bajo esta línea de producción, se identificó un ciclo de migración que inicia con la colonización del territorio (generalmente áreas en bosque), el cual está condicionado por el conflicto e incide en la decisión de migrar a un nuevo territorio, generando un ciclo de colonización – conflicto – migración. El conflicto para este tipo de grupos cocaleros está condicionado principalmente por la presencia y el control estatal a los cultivos ilícitos; la percepción de seguridad de los territorios y el mercado y precio de la coca.</p>
        <p>La cultura de la ilegalidad como causa subyacente, fue entendida como la aceptación por parte de las comunidades, de la siembra del cultivo de coca encaminado a garantizar el sostenimiento familiar, lo cual incide en el mantenimiento de la actividad ilegal en los territorios. En general, para el establecimiento del cultivo de coca, se vinculan tierras resguardadas del control estatal. Por lo tanto, esta condición aumenta la vulnerabilidad de los bosques, frente a la proliferación del cultivo de coca. Además se destaca que está cultura se ve arraigada con mayor fuerza en áreas de frontera, como en el caso de los municipios de Tibú en Norte de Santander y San Miguel y Valle de Guamuez en Putumayo, donde la ilegalidad se manifiesta bajo otro tipo de expresiones como el contrabando y la extracción ilegal de combustible; dinamizadores de la deforestación debido a la facilidad de acceso y disminución de los costos de los insumos requeridos para el establecimiento, mantenimiento y transformación de la coca.</p>
        <p>La afectación del ecosistema forestal se basa en la teoría económica de transformación, que influye en la decisión de los agentes de deforestar para convertir el bosque en tierras que produzcan mayores beneficios financieros; esta disposición respecto al establecimiento de los cultivos de coca se deriva de la concepción de un mayor beneficio económico derivado de la reducción de costos de producción, con el fin de compensar los ingresos netos obtenidos en el marco de la estructura de costos y precios del mercado de la coca.</p>
        <p>La reducción en los costos de establecimiento del cultivo de coca en el bosque obedece a la disminución, hasta en un 50% de la utilización de insumos agrícolas para el establecimiento del cultivo. En este sentido, se estableció bajo el análisis de costos, derivado de la información de los estudios de productividad de SIMCI, que para la región Catatumbo se alcanza un ahorro del 24% y para la región Amazonía del 11% en los costos totales de implementación de los cultivos de coca.</p>
        <p>La ventaja competitiva del cultivo de coca frente a los productos lícitos se definió como el encadenamiento productivo existente a partir del cual se tejen canales claros de comercialización, bajos costos de transporte a centros de comercialización, venta directa, y producto de alta duración natural. Estas consideraciones hace que la siembra del cultivo en el bosque continúe siendo atractiva para las comunidades de la dos regiones analizadas, derivado de las condiciones actuales de infraestructura vial y de servicios, la falta de titularidad de tierra, el bajo acceso a créditos y a los deficientes canales de comercialización de los mercados lícitos tradicionales. </p>
        <p>La siembra no controlada de cultivos de coca en el bosque y otras acciones antrópicas derivadas, como la aplicación de prácticas agropecuarias no sostenibles, han ocasionado que los bosques estén más afectados en su estructura y dinámica (lo que equivale a una mayor deforestación y degradación); está situación genera un círculo vicioso que permite que las intervenciones productivas ilícitas comprometan una mayor área boscosa y aumenten los índices de fragmentación del ecosistema derivado de la dispersión de los lotes sembrados.</p>
        <p><strong>Modelo de identificación de áreas vulnerables</strong></p>
        <p>El modelo de vulnerabilidad del bosque a ser deforestado por cultivos de coca permite tener una aproximación del comportamiento de esta actividad en los próximos diez años y tener insumos innovadores para la planeación y toma de decisiones que ayuden a mitigar este tipo de actividades. Municipios como Tibú y Sardinata en Norte de Santander; San José del Guaviare en Guaviare; La Macarena y Puerto Rico en el Meta; Solano y la Montañita en Caquetá y Puto Leguizamón y Puerto Asís en Putumayo, poseen los núcleos con mayores concentraciones de vulnerabilidad. Del mismo modo, permite indagar sobre la posible vulnerabilidad del bosque  entidades territoriales como Parques Nacionales o Resguardos indígenas. </p>
        <p><strong>Recomendaciones a la política de Desarrollo Alternativo</strong></p>
        <p>El Desarrollo Alternativo en el marco de la mitigación de la deforestación y degradación del bosque por cultivos de coca, deberá extender su alcance para transformarse en un esfuerzo coordinado y concertado política e institucionalmente, con el fin de orientar y dinamizar un plan estratégico regional, donde se potencialicen las capacidades productivas, ambientales y de inclusión social en cada uno de los territorios focalizados. Por lo tanto, se deberán incorporar los objetivos de sustitución y reducción de los cultivos ilícitos, en paralelo a los objetivos de reducción de deforestación y degradación como marco estratégico en los planes de desarrollo tanto a nivel nacional como departamental y municipal.</p>
        <p>El modelo de DA orientado a la mitigación de la afectación del bosque por cultivos de coca se debe enmarcar en un enfoque territorial, el cual emerge del concepto de nueva ruralidad y es tomado como un conjunto de relaciones socioculturales de gobernabilidad del territorio, enfoque diferencial, sostenibilidad ambiental, desarrollo económico y propiedad de la tierra; todo lo anterior intrínsecamente ligado a una base territorial.</p>
        <p>Se plantea que para alcanzar las metas conjuntas de reducción de cultivos ilícitos y mitigación de la deforestación y degradación del bosque, estos programas deberán asumir como unidad de planificación ambiental y productiva del territorio, la cuenca hidrográfica. El objetivo principal será el de orientar la focalización hacia un entorno regional, capaz de identificar las particularidades y potencialidades de los territorios y que permita que las estrategias implementadas a nivel municipal o inclusive veredal, le apunten a un mismo plan de ordenación y que se coordinen los esfuerzos técnicos y optimicen los recursos.</p>
        <p>El estudio planteó cuatro criterios para el diseño e implementación de programas de DA con enfoque ambiental, capaz de mitigar el fenómeno de afectación del bosque natural por causa de los cultivos de coca: i) La transformación productiva de los territorios debe formularse y gestionarse a nivel regional con horizontes de mediano y largo plazo; ii) La implementación de acciones orientadas al manejo sostenible del bosque y reducción de cultivos ilícitos, debe ser priorizada acorde a la dinámica de avance de la frontera agropecuaria; iii) La conformación de un modelo de gobernanza y concertación social es fundamental en los procesos de protección del bosque y la consolidación de la cultura de la legalidad; iv) La articulación entre instituciones públicas y organismos internacionales es prioritaria para garantizar el éxito de las intervenciones de desarrollo alternativo con énfasis ambiental en los territorios. </p>
        <p>El criterio de transformación productiva de los territorios plantea un desarrollo sostenible e integral de las comunidades vinculadas a los cultivos ilícitos, al interior de la frontera agrícola, a través de un enfoque integral y multisectorial, que promueva innovaciones productivas y la reconversión de los modelos rurales tradicionales.</p>
        <p>En materia ambiental,  los programas de DA deben frenar el avance de los cultivos ilícitos sobre el bosque. Por ende, se plantea una atención prioritaria a las áreas de expansión de la frontera agropecuaria, las cuales deberán formularse en función del potencial de desarrollo de las regiones y de las condiciones socioeconómicas, productivas y ambientales, redireccionando los enfoques productivos hacia la maximización de los bienes y servicios ofrecidos por el bosque. </p>
        <p>Con el fin de generar acciones que permitan gobernar los territorios sobre la base de los principios de sostenibilidad ambiental y cultura de la legalidad, se debe conformar un modelo de gobernanza y gestión local desde las comunidades que promueva prácticas sociales de acción colectiva y genere condiciones para que los beneficiarios amplíen sus capacidades y sus conocimientos acerca de los mecanismos de representación y apropiación de políticas que los afectan directamente.</p>
        <p>En la implementación de los programas de DA se concibe operativamente la construcción de una arquitectura institucional que dé cabida al Estado, organismos de cooperación internacional, gremios y sociedad civil, para alinear las estrategias en el marco de las dimensiones política, administrativa y técnica, orientadas a la coordinación de la transformación productiva de los territorios enmarcada en procesos de sostenibilidad de los recursos naturales, específicamente los bosques naturales. </p>
        <p>La participación de las comunidades vinculadas a los procesos de afectación del bosque por cultivos de coca, es una herramienta valiosa para entender y explicar la dinámica del cultivo de coca como motor de deforestación en Colombia. La información recolectada permite caracterizar las diferentes motivaciones para vincularse a las cadenas de ilegalidad, causas que difieren y rompen las fronteras administrativas. Por tal motivo una de las principales recomendaciones del estudio es poner en manifiesto la necesidad de información espacial actualizada, que permita realizar estudios con un mayor nivel de detalle.</p>
      </div>
  </div>
  <div id="recomendaciones" class="row">
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10">
        <h3>Recomendaciones</h3>

        <p>1. Como principio rector, los Programas de Desarrollo Alternativo y los Programas de  Reducción de Emisiones por Deforestación y Degradación de los Bosques (REDD+) deben estar articulados a los planes de desarrollo a través de procesos de concertación con los actores de nivel nacional, departamental y municipal. Así mismo, se deben generar instrumentos de seguimiento y monitoreo de los acuerdos que se impulsen y promover la  creación de enlaces institucionales que coordinen las actividades.</p>
        <p>2. Acorde al nuevo marco institucional creado desde la Presidencia de la República y bajo el direccionamiento de la Alta Consejería para el Posconflicto, Derechos Humanos y Seguridad, la Agencia de Renovación del territorio (ART) se constituye como la entidad que implementará la sustitución de cultivos ilícitos a través del Desarrollo Alternativo; por tal motivo, es imperante articular como ejes fundamentales de la dimensión ambiental los siguientes principios, que de forma transversal propendan por la mitigación de la afectación del bosque:
        <ul>
          <li>Ordenamiento territorial, con especial consideración de las áreas de manejo especial como Parques Nacionales Naturales, áreas de expansión de la frontera agropecuaria y zonas ambientalmente estratégicas.</li>
          <li>Inclusión de determinantes ambientales, que direccionen el uso adecuado del territorio respecto a su vocación.</li>
          <li>Implementación de buenas prácticas ambientales en el desarrollo de los proyectos productivos.</li>
          <li>Articulación con las entidades del Sistema Nacional Ambiental –SINA- con el fin de fortalecer  los sistemas de monitoreo y control.</li>
        </ul></p>
        <p>3. Las alianzas estratégicas construidas entre la Agencia de Renovación del territorio (ART) y la Agencia Nacional de Tierras (ANT) a través del Programa “Formalizar para sustituir”, deberán generar espacios de articulación que promuevan la formalización del derecho de dominio de predios rurales y el saneamiento de los títulos a quienes demuestren posesión material, pública, pacífica e ininterrumpida, con el fin de incentivar el desarrollo de proyectos encaminados a la conservación y el manejo sostenible de los bosques, en áreas de influencia de cultivos ilícitos.</p>
        <p>4. Es conveniente que las entidades rectoras del direccionamiento de la Política de Desarrollo Alternativo promuevan mesas de trabajo a nivel departamental, que integren los actores locales (organizaciones, entidades gubernamentales, cooperantes internacionales, ONG, empresa privada, gremios, entre otros), con el fin de concertar la intervención productiva en los territorios y generar economías basadas en encadenamientos productivos articulados con el sector empresarial.</p>
        <p>5. Un objetivo central de las intervenciones de los Programas de Desarrollo Alternativo con énfasis ambiental debe ser generar sostenibilidad de los proyectos implementados, garantizando cambios perdurables en los territorios, una vez los recursos de capital semilla se terminen. Por tal motivo, se deben fortalecer los acuerdos con instituciones de nivel regional, que apalanquen las iniciativas productivas implementadas, en el tránsito de las organizaciones hacia procesos de autogestión.</p>
        <p>6. Apoyar e incentivar el acceso a la investigación y desarrollo (I+D), a través de puentes intersectoriales (Gobierno Nacional, grupos de investigación y/o universidades y sector privado) que permitan generar cambios estructurales en el abordaje productivo, con miras hacia la optimización de los recursos naturales y la reconversión de los modelos de producción rural tradicional; además, de la identificación de líneas productivas potenciales, innovadoras y diferenciadoras, en el marco de economías verdes. </p>
        <p>7. El desconocimiento de las comunidades rurales acerca de las estructuras de negocio basadas en economías de manejo sostenible del bosque, requiere la implementación de programas pedagógicos rurales que permitan transferir y divulgar  la normatividad ambiental vigente, los alcances de las estrategias y los requisitos de proyectos de conservación y pagos de servicios ambientales. Adicional a esto, se plantea necesario conformar una red de organizaciones que permita el intercambio de experiencias a nivel regional, nacional o internacional, en temas de manejo y aprovechamiento sostenible de los recursos naturales y la biodiversidad, y frente a la conversión de economías ilícitas a lícitas. </p>
        <p>8. El componente productivo para los modelos del desarrollo alternativo con enfoque ambiental, debe considerar la vocación y oferta ambiental de los territorios; por tal motivo se plantean cuatro ejes productivos como líneas de intervención:
        <ul>
          <li>Sistemas agroforestales y silvopastoriles.</li>
          <li>Proyectos forestales (plantaciones comerciales y manejo de bosque natural).</li>
          <li>Conservación (pago por servicios ambientales (PSA), pago por conservación, proyectos REDD+).</li>
          <li>Biocomercio (productos maderables y no maderables, turismo de naturaleza).</li>
        </ul></p>
        <p>9. Para garantizar el manejo adecuado de los recursos naturales, la selección de los proyectos productivos deberá ir acompañada de la formulación de planes de manejo ambiental, que respondan a la implementación sostenible de los proyectos en el territorio.</p>
        <p>10.  Conformar un banco de proyectos que incluya las iniciativas productivas implementadas bajo los esquemas de Desarrollo Alternativo, que posean características de elegibilidad para incorporarlos a proyectos REDD+, con el fin de garantizar recursos que de forma paralela apalanquen las iniciativas productivas y comprometan acuerdos de conservación y manejo sostenible del bosque. Actualmente existen en el país fondos de carácter multilateral con recursos asignados para apoyar proyectos de desarrollo sostenible, conservación y protección de los bosques, en los cuales se podrían presentar los perfiles de los proyectos. </p>
        <p>11.  Para cumplir con los compromisos ambientales de conservación y mitigación de la afectación del bosque por parte de los programas de Desarrollo Alternativo con enfoque ambiental, se deberán priorizar, en conjunto con las instituciones del Sistema Nacional ambiental (SINA), acciones de recuperación de zonas degradadas por el efecto de la implementación de los cultivos ilícitos, en ecosistemas estratégicos y áreas de manejo especial, e involucrarlos como parte de los compromisos con las comunidades participantes de los proyectos de Desarrollo Alternativo.</p>
        <p>12.  Con el fin de fortalecer los procesos de gobernanza forestal y concertación social, es indispensable establecer sistemas de control y vigilancia a nivel comunitario, acerca del manejo de los bosques (alertas tempranas de deforestación) y los compromisos de mantener los territorios libres de cultivos ilícitos.</p>
        <p>13.  Es indispensable incluir procesos de monitoreo y evaluación periódicos, a través de la conformación de un sistema nacional de seguimiento ambiental para los Programas de Desarrollo Alternativo, que permita establecer el impacto de las intervenciones productivas en los territorios, respecto a la conservación del bosque y la mitigación de la deforestación y degradación por causa de los cultivos ilícitos</p>
        <p>14.  Continuar con la elaboración de estudios técnicos que permitan priorizar las áreas con mayor vulnerabilidad de afectación del bosque por cultivos ilícitos, acorde a la dinámica de avance de la frontera agropecuaria, e involucrarlo como un criterio de focalización de los Programas de Desarrollo Alternativo avalados por el Gobierno Nacional. También es necesario apoyar estudios técnicos que den seguimiento anual al comportamiento de la afectación del bosque por  cultivos de coca, en áreas de influencia de los programas de Desarrollo Alternativo y REDD+. </p>
        <p>15.  Como una herramienta de gestión entre organizaciones e instituciones, se plantea necesario construir una plataforma web de aprendizaje de políticas y manejo sostenible del bosque, capaz de proveer información a nivel nacional.</p>      
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