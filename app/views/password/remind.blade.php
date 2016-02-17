<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Monitoreo a Desarrollo Alternativo UNODC</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../../assets/css/bootstrap.css">
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
  </style>
  <!-- librerias JavaScript que se utilizan en la pagina -->
  <script src="../../assets/js/jquery-1.11.2.js"></script>
  <script src="../../assets/js/bootstrap.js"></script>
  <script src="../../assets/js/jquery-ui.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
  <div class="row">
    <!--Columna logo con imágen-->
    <div class="col-xs-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <a href="<?=URL::to('/'); ?>"><img src="../../assets/img/unodc.png" class="logo" alt="logounodc"></a>
    </div>
    <!--columna link y boton solo son visibles en sm md lg-->
  </div>
</div>
<!--Fin del primer contenedor-->
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
<!--Cuardo contenedor contenido-->    
<div class="container" id="sha">
  <div class="row">
    <br/>
    <h2><p class="text-center">Solicitud para nueva contraseña</p></h2>
    <br/>
    <div class="col-sm-3"></div>
  <div class="col-sm-6">
    <form action="{{ action('RemindersController@postRemind') }}" method="POST">
        <div class="form-group">
          <input class="form-control input-lg" id="email" placeholder="Escriba aquí su e-mail" type="email" name="email" required>
          <?php $error=Session::get('error'); ?> 
          @if ($error)
          <span class="label label-danger" id="a">Su e-mail no se encuentra registrado</span>
          @endif
      </div>
      <div class="g-recaptcha" id = "de" data-sitekey="{{$_ENV['data_site']}}"></div>
      <div class="form-group">
        <input class="btn btn-primary" id="btenviaremail" value="Enviar solicitud" type="button">
        <h4><span class="label label-info" id="b"></span></h4>
        <br/>
      </div>
    </form>
  <br>
  </div>
  <div class="col-sm-3"></div>
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
      <div class="col-xs-12 col-md-12"><small><p class="text-right">Unidad de Información – Monitoreo Integrado Desarrollo Alternativo – UNODC <br/>Bogotá - Colombia</p></small>
      </div>
    </div>
  <br/><br/>
</div>
<!--Fin del sexto contenedor-->  
<script>
  $(document).ready(function() {
    //para que los menus pequeño y grande funcione
    var _this = $('#email');
    _this.parent().addClass('has-error');
    $( "#b" ).hide();
    $( "#a" ).fadeOut(5000);
    $('#email').keyup(function(){
      var email = $('#email').val();
      if ( email.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i) ) {
        _this.parent().removeClass('has-error');
      }
      else{
      _this.parent().addClass('has-error');
      }
    });
    $('#btenviaremail').click(function(){
      var v = grecaptcha.getResponse();
      var email = $('#email').val();
      if((v.length != 0 )&&(email.match(/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i))){
        document.getElementById("email").readOnly = true;
        $('#btenviaremail').hide();
        $( "#b" ).show();
        $('#b').text("Enviando solicitud");
        $("form").submit();
      }
      else{    
        $( "#b" ).show();
        $('#b').text("Asegurese de haber seleccionado No soy un robot y el e-mail sea correcto");
        $( "#b" ).fadeOut(5000);
      }
    });
  });
</script>
</body>
</html>