<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
  <title>
			Sello Desarrollo Alternativo 
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

    .foto{
      width: 100%;
    }

    .info{
      background: #f2f2f2;
      padding: 15px;
      margin-bottom: 15px;
      height: 550px ;
    }

    .dropdown-submenu {
    position: relative;
    }

    .dropdown-submenu .dropdown-menu {
        top: 0;
        left: 100%;
        margin-top: -1px;
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
    <div class="col-sm-1 hidden-xs" ></div>
    <div class="col-xs-10">        
        <img src="assets/bid/img/sello.png" width="5%">        
    </div>
    <div class="col-sm-1 hidden-xs"></div>
    
    <div class="col-sm-1 hidden-xs"></div>
  </div>
</div>
<!--Fin del primer contenedor-->
<!--Segundo contenedor menu secundario-->
@include('access_outside.bid.include_navbar')
<!--Fin del segundo contenedor--> 
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row" >
      <div class="carousel-inner" style="height: 350px; width: 100%;display: table; color: white;font-size: 25px;text-align: center;background-image: url(assets/bid/banner/banner-default.jpg); background-repeat: no-repeat;">        
        <div style="display: table-cell; vertical-align: middle;">
        <?php echo  str_replace('"','',(json_encode($array[3][0] -> nombre))); ?>- <?php echo  str_replace('"','',(json_encode($array[3][0] -> acronim))); ?>
        </div>
        
      </div>  
      <div class="col-sm-1"></div>
      <div class="col-xs-12 col-sm-10" style="padding-top: 20px; padding-bottom: 10px">          
        <!--escribir el codigo-->
        <!--Datos del contacto-->        
        <div class="col-xs-12 col-md-3" style="background-color: #84b326; color: white; padding-bottom: 15px">
          <h3>Datos de contacto</h3>
          <span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> Calle 102 No 17A - 61 Bogotá D.C., Colombia<br>
          <span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> 57 1 646 70 00<br>
          <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> enrique.camargo@unodc.org<br>
        </div>
        <div class="col-xs-12 col-md-9" style="text-align: justify; font-size: 17px">
          @if(json_encode($array[4][0] -> logo)!="null")
          <img style="float: left; padding-right: 10px" src="assets/bid/logo/<?php echo  str_replace('"','',(json_encode($array[4][0] -> 
          logo))); ?>">
          @endif
          <?php echo  str_replace('\r\n\r\n','<br><br>',(str_replace('"','',(json_encode($array[4][0] -> descripcion,JSON_UNESCAPED_UNICODE)))))  ; ?>          
        </div>
        <!--finaliza escribir codigo--> 
      </div>
      <div class="col-sm-1"></div>
      <div class="carousel-inner"  style="background-color: #eeeeee;">
        <div class="col-sm-1"></div>
        <div class="col-xs-12 col-sm-10" style="padding-top: 20px; padding-bottom: 10px">
          <div style=" width: 100%;display: table; font-size: 25px;text-align: center;">        
          <h2>Línea Productiva</h2>
          <hr style="border: 1px solid #a0a0a0">
          <div class="col-xs-12 col-md-6">
            <!--Inicia foreach de acuerdo al numero de  codigo-->
            @foreach($array[5] as $pro)
            <div class="col-xs-12" style="padding-left: 0px; padding-right: 0px">
            <div class="col-xs-12 col-md-6">
              <img style="float: left; padding-right: 10px" src="assets/bid/logo_lp/<?php echo  str_replace('"','',(json_encode($pro -> 
              logo_lp))); ?>">
            </div>
            <div class="col-xs-12 col-md-6">
              <h3><?php echo  str_replace('\r\n\r\n','<br><br>',(str_replace('"','',(json_encode($pro -> linea_prod,JSON_UNESCAPED_UNICODE)))))  ; ?></h3>
              @if(json_encode($pro -> desc_lp)!="null")
              <div style="text-align: justify; font-size: 14px">
                <?php echo  str_replace('\r\n\r\n','<br><br>',(str_replace('"','',(json_encode($pro -> desc_lp,JSON_UNESCAPED_UNICODE)))))  ; ?>
              </div>
              @endif
            </div>
            <div class="col-xs-12" style="height: 10px"></div>
            </div>
            @endforeach
          </div>  
          <div class="col-xs-12 col-md-6" >
            <!--Inicia foreach de acuerdo al numero de  codigo-->
            <h4>VALOR AGREGADO DE LOS PRODUCTOS</h4>
            <div style="font-size: 12px; background-color: white">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <?php $i=0 ; ?>
              @foreach($array[6] as $pro)
                @if($i==0)
                <li role="presentation" class="active"><a href="#p_{{$pro->id_val}}" aria-controls="p_{{$pro->id_val}}" role="tab" data-toggle="tab">{{$pro->va}}</a></li>
                <?php $i=1 ; ?>
                @else
                <li role="presentation"><a href="#p_{{$pro->id_val}}" aria-controls="p_{{$pro->id_val}}" role="tab" data-toggle="tab">{{$pro->va}}</a></li>
                @endif
              @endforeach
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <?php $i=0 ; ?>
              @foreach($array[6] as $pro)
                @if($i==0)
                <div role="tabpanel" class="tab-pane active" id="p_{{$pro->id_val}}" style="text-align: justify; padding: 10px">{{$pro->descripcion}}</div>
                <?php $i=1 ; ?>
                @else
                <div role="tabpanel" class="tab-pane" id="p_{{$pro->id_val}}" style="text-align: justify; padding: 10px">{{$pro->descripcion}}</div>
                @endif
              @endforeach
            </div>
          </div>
          </div>
            <!--finaliza escribir codigo--> 
          
          </div>
        </div>
        <div class="col-sm-1"></div>
      </div>  
    </div>
  </div>
<!--Fin del tercer contenedor--> 

<!--cuarto contenedor pie de página-->
<div class="container-fluid well" id="piedepagina">      
      <div class="col-xs-12" style="color: white; text-align: center;">
      <img class="foto" src="assets/bid/img/regla.jpg" style="height: 135px; width: auto;">      
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
          $( "#organizaciones_menu" ).addClass("active");          
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#gizdatrelevmenupeq" ).html("<strong>Datos Relevantes</strong>");          
          $( "#mensajeestatus" ).fadeOut(5000);

          @include('access_outside.bid.include_organizaciones_menu')
      });
      

    </script>
</body>
</html>