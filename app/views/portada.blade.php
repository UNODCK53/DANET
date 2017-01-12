
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Monitoreo a Desarrollo Alternativo UNODC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

  <style>
      #sha{
        -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
        -moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
        box-shadow:         0px 0px 18px 0px rgba(48, 50, 50, 0.48);
      }
      
      #imagen{
        -webkit-filter: none;
      }
      #imagen:hover{
        -webkit-filter: grayscale(100%);
      }

      .modal-content {
        max-width: 340px;
        margin: 0 auto;
        background-color: #f5f5f5;
      }
  </style>
  <!-- librerias JavaScript que se utilizan en la pagina -->
  <script src="assets/js/jquery-1.11.2.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery-ui.js"></script>
  

  @if ((Session::has('login_errors'))or(Session::has('usuario_inactivo')) ) 
    <script>
      
      $(document).ready(function(){
        $("#loginModal").modal('show');
      });

    </script>
  @endif


</head>
<body>
  
<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
    <div class="row">
      <!--Columna logo con imágen-->
    <div class="col-xs-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img src="assets/img/logos2.png" class="img-responsive" alt="logounodc">
    </div>
      <!--espaciado para que en xs queden separado logo y boton-->
    <div class="col-xs-4 visible-xs">
      
    </div>
    <div class="col-lg-6 visible-lg">
      
    </div>
        <!--columna botón crear cuenta solo es visible en xs-->
        <div class="col-xs-3 visible-xs">
          <button data-target="#loginModal"  data-toggle="modal" type="button" class="btn btn-primary">Iniciar sesión</button>
        </div>
        <!--columna link y boton solo son visibles en sm md lg-->
        <div class="col-sm-3 col-sm-offset-3 visible-sm visible-md visible-lg col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
          <button data-target="#loginModal"  data-toggle="modal" type="button" class="btn btn-primary">Iniciar sesión</button>
        </div>        
    </div>
</div>
<!--Fin del primer contenedor-->
<!--Inicio mensaje solicitud de password-->
<div class="row">
  <?php $status=Session::get('status');?> 
  @if($status=='reminders.sent')
  <div class="col-sm-1"></div>
  <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
  <i class="bg-success"></i>La solicitud fue enviada con éxito</div>
  <div class="col-sm-1"></div>
  @endif
  @if($status=='reminders.reset')
  <div class="col-sm-1"></div>
  <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
  <i class="bg-success"></i>La contraseña fue creada con éxito</div>
  <div class="col-sm-1"></div>
  @endif
  <?php $error=Session::get('error');?>
  @if($error)
  <div class="col-sm-1"></div>
  <div id = "mensajeestatus" class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
  <i class="bg-danger"></i>La solicitud expiró o ya fue utilizada</div>
  <div class="col-sm-1"></div>
  @endif
</div>
<!--Fin mensaje solicitud de password-->
<!--Segundo contenedor -->
<div class="container-fluid">
    <div class="row" id="menu-sec">
        <!--espacio para en menu-->
        <div class="col-sm-12 col-sm-offset-1 visible-sm visible-md  col-md-8 col-md-offset-2 visible-lg col-lg-9 col-lg-offset-3">
           
            </br></br>      
        </div>  
            
         <!--fin del espacio para el segundo menu-->   
        
    </div>
<!--Fin del segundo contenedor-->   

<!--Tercer contenedor carrusel imagenes--> 
<div class="container" id="sha">
    <div class="row">
     
      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
          <div class="item active">
              <img src="assets/img/about-carousel-1.jpg" alt="Gmail en todo tipo de dispositivos">
            <div class="carousel-caption">
             
            </div>
          </div>
          <div class="item">
            <img src="assets/img/about-carousel-2.jpg" alt="Mensajes por tipo para organizarte mejor">
            <div class="carousel-caption">
             
            </div>
          </div>
          <div class="item">
            <img src="assets/img/about-carousel-3.jpg" alt="chatea con un compañero o llama por teléfono">
            <div class="carousel-caption"></div>
          </div>    
        </div>  
      </div>
    </div>
</div>    
<!--fin del tercer contenedor-->

<!--Cuardo contenedor contenido-->    
<div class="container" id="sha">

    <div class="row">
    
        <div>
          <br />
          <h2><p class="text-center">Desarrollo Alternativo</p></h2>
          <br />
        </div>
    </div>
    <!--Segundo bloque derecha-->
    <div class="row">
      <!--imagen responsive-->
        <a href="<?=URL::to('Cooperacion_GIZ'); ?>"><div>
          <div id="imagen1" class="col-xs-12 col-sm-3">
            <center><img src="assets/img/Circulo_GIZ.png" id="imagen" class="img-responsive" alt="cirdondeestamos"></center>
          </div>
          <!--Texto del contenido-->
          <div class="col-xs-12 col-sm-3">
            <br />
              <strong>Cooperación GIZ-UNODC</strong>
              <small><p>Espacio dedicado a los estudios realizados en cooperación con GIZ, de los cultivos de coca y su relación con los bosques en Colombia.
                  </p></small>
          
          </div>
        </div></a>
        <!--imagen responsive--> 
        <a href="<?=URL::to('municipios_concentracion'); ?>" target="_blank" ><div>
          <div id="imagen1" class="col-xs-12 col-sm-3">
            <center><img src="assets/img/Circulo_Donde_estamos.png" id="imagen" class="img-responsive" alt="cirdondeestamos"></center>
          </div>
          <!--Texto del contenido-->
          <div class="col-xs-12 col-sm-3">
            <br />
              <strong>Municipios de concentración</strong>
              <small><p>Con esta aplicación podrás ver en donde se encuentran los municipios de concentración acordados por el gobierno de Colombia y las FARC.
                  </p></small>
          
          </div>
        </div></a>
    </div>
    <!--Primer bloque izquierda-->
    <div class="row">
      <!--imagen responsive-->
      <div class="col-xs-12 col-sm-3">
          <center><img src="assets/img/Circulo_Gestion.png" id="imagen" class="img-responsive" alt="circulogestion"></center>
      </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
            <strong>Intervención 2014</strong>
            <small><p>Mediante esta herramienta, la coordinación puede realizar el seguimiento a los indicadores que dan muestra de la evaluación del monitoreo.
             </p>
            </small>
        </div>
        
        <!--imagen responsive-->
        <div class="col-xs-12 col-sm-3">
          <center><img src="assets/img/Circulo_SAI.png" id="imagen" class="img-responsive" alt="circulosai"></center>
        </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
            <strong>Sistema de administración de la información</strong>
            <small><p>Es una herramienta del Programa de Desarrollo Alternativo de UNODC, que permite administrar y compartir la información generada por el equipo de monitoreo.
             </p>
            </small>
        </div>
    </div>    
    <!--Segundo bloque derecha-->
    <div class="row">
      <!--imagen responsive-->
      <div class="col-xs-12 col-sm-3">
          <center><img src="assets/img/Circulo_SISCADI.png" width="184" height="184" id="imagen" class="img-responsive" alt="cirsiscadi"></center>
        </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
          <strong>SISCADI</strong>
            <small><p>En 2015 el equipo de monitoreo cuenta con una novedosa herramienta que permite el levantamiento de encuestas mediante un dispositivo móvil.
             </p></small>
        </div>
        <!--imagen responsive-->
       <div class="col-xs-12 col-sm-3">
          <center><img src="assets/img/Circulo_10.png" width="184" height="184" id="imagen" class="img-responsive" alt="cir10"></center>
        </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
          <strong>10 años de monitoreo desarrollo alternativo</strong>
            <small><p>En esta página podrás encontrar información histórica de los territorios intervenidos por el gobierno de Colombia y monitoreados por UNODC.
            </p></small>
        </div>
    </div>
    <!--Segundo fila nuevo bloque izquierda-->
    <div class="row">
      <!--imagen responsive-->
        <div class="col-xs-12 col-sm-3">
          <center><img src="assets/img/Circulo_GME.png" id="imagen" class="img-responsive" alt="gme"></center>
        </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
            <strong>Monitoreo a GME</strong>
            <small><p>Seguimiento al monitoreo realizado por UNODC al proceso de certificación de áreas erradicadas por los Grupos Móviles de Erradicación – GME.
            </p></small>
        
        </div>
        <!--imagen responsive-->
        <div class="col-xs-12 col-sm-3">
          
        </div>
        <!--Texto del contenido-->
        <div class="col-xs-12 col-sm-3">
          <br />
            
        
        </div>
        <!--nueva columna auxiliar solo para dar espacio al final-->
        <div class="col-xs-12">
        <br /><br /><br /><br /><br />
        </div>
       
    </div>
    
    </div>
</div>
<!--Fin del cuarto contenedor-->

<!--Quinto contenedor pie de página-->
<div class="container-fluid well">

  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 col-lg-offset-3">
        <br />
        
        <br />
        
    </div>
  </div>
</div>
<!--Fin del quinto contenedor-->
<!--Sexto contenedor-->  
<div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-12"><small><p class="text-right">Unidad de Información y Análisis – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá - Colombia</p></small></div>
          
    </div>

  <br/><br/>
</div>
 <!--Fin del sexto contenedor-->  

<!--login modal-->
<div id="loginModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content" id="loginbox">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h2 class="text-center"><img src="assets/img/avatar_2x.png" class="img-circle" alt="avatar"><br>Ingreso</h2>
      </div>
      <div class="modal-body">
          <!--<form class="form center-block">-->
            <form class="form center-block" id="loginform" action="login" method="post">
              @if (Session::has('login_errors'))
                <p class="bg-danger">El nombre de usuario o la contraseña no son correctos.</p>

              @elseif (Session::has('usuario_inactivo'))
                <p class="bg-danger">El usuario está inactivo.</p>
              @else
                <p>Introduzca usuario y contraseña.</p>
              @endif


            <div class="form-group">
              <input class="form-control input-lg" id="username" placeholder="Usuario" type="text" name="username">
            </div>
            <div class="form-group">
              <input class="form-control input-lg" id="password" placeholder="Contraseña" type="password" name="password">
            </div>
            <div class="form-group">
              <input class="btn btn-primary btn-lg btn-block" value="Acceder" type="submit">              
            </div>
            <a href='forgotpassword'>Crear/restaurar contraseña</a>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
      </div>  
      </div>
  </div>
  </div>
</div>

<!--  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
-->
  

<script src="assets/js/login.js"></script>
<script>
  $(document).ready(function() {
    $( "#mensajeestatus" ).fadeOut(5000);
  });
</script>
</body>
</html>