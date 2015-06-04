<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>
		@section('titulo')
			SAI version2
		@show
	</title>
		@section('cabecera')
			<meta charset="UTF-8">
			
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">

			<style>
			    #sha{
			      -webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
			      -moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
			      box-shadow:         0px 0px 18px 0px rgba(48, 50, 50, 0.48);
			    }


			    .img-responsive{
			      -webkit-filter: none;
			    }
			    .img-responsive:hover{
			      -webkit-filter: grayscale(100%);
			    }
			    .modal-content {
			      max-width: 340px;
			      margin: 0 auto;
			      background-color: #f5f5f5;
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
</head>
<body>
<!--comienza la cabecera-->
@section('contenidocabecera1')
	<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
    <div class="row">
      <!--Columna logo con imágen-->
    <div class="col-xs-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img src="assets/img/unodc.png" class="logo">
        </div>
      <!--espaciado para que en xs queden separado logo y boton-->
    <div class="col-xs-4 visible-xs">
      
    </div>
    <div class="col-lg-6 visible-lg">
      
    </div>
        <!--columna botón crear cuenta solo es visible en xs-->
        <div class="col-xs-5 visible-xs">
        	<ul class="nav nav-pills ">
				<li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} {{Auth::user()->last_name}}<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                      <li><a tabindex="-1" href="logout"><i class="icon-off"></i> Logout</a></li>
                    </ul>
                </li>
 			</ul>
        </div>
        <!--columna link y boton solo son visibles en sm md lg-->
        <div class="col-sm-3 col-sm-offset-3 visible-sm visible-md visible-lg col-md-3 col-md-offset-3 col-lg-3 col-lg-offset-3">
		   	<ul class="nav nav-pills ">
				<li role="menu" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} {{Auth::user()->last_name}}<span class="caret"></span></a>
	    	        <ul class="dropdown-menu" role="menu">
	                     <li><a tabindex="-1" href="logout"><i class="icon-off"></i> Logout</a></li>
	                </ul>
	            </li>
	 		</ul>
        </div>        
    </div>
</div>
<!--Fin del primer contenedor-->
@show

<!--texto-->
@section('menu1')

@show

@section('contenedorgeneral1')
<!--tercer contenedor pie de página-->
	<div class="container" id="sha">
		<div class="row">

	      
@show

@section('contenedorgeneral2')	       
	    </div>
	</div>
	<!--Fin del tercer contenedor--> 
@show

@section('piedepagina')
<!--cuarto contenedor pie de página-->
<div class="container-fluid well">

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
      <div class="col-xs-12 col-md-12"><small><p class="text-right">Unidad de Información – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá - Colombia</p></small></div>
          
    </div>

	<br/><br/>
</div>

 <!--Fin del quinto contenedor-->  
@show


@section('js')
	<!-- librerias JavaScript que se utilizan en la pagina -->
  <script src="assets/js/jquery-1.11.2.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery-ui.js"></script>
  <script src="assets/js/login.js"></script>
@show
</body>
</html>


