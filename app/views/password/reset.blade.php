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
  <script src="../../assets/js/jquery-1.11.3.min.js"></script>
  <script src="../../assets/js/bootstrap.js"></script>
  <script src="../../assets/js/jquery-ui.js"></script>
</head>
<body>
<!--Primer Contenerdor logo y botón iniciar sesion-->  
<div class="container-fluid well">
  <div class="row">
    <!--Columna logo con imágen-->
    <div class="col-xs-3 col-sm-3 col-sm-offset-1 col-md-2 col-md-offset-2 col-lg-2 col-lg-offset-3">
      <img width="296px" height="44px"  src="../../assets/img/logos2.png" class="img-responsive logo">
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
      <h2><p class="text-center">Establecer contraseña</p></h2>
    <br/>
    <div class="col-sm-3"></div>
      <div class="col-sm-6">
      <form class="form center-block" id="cambiar_pass" action="{{ action('RemindersController@postReset') }}" method="post">
        <input id="token" type="hidden" name="token" value="{{ $token }}">
        <div class="form-group">
          E-mail:
          <input class="form-control input-lg" id="email" placeholder="e-mail" type="email" name="email" readonly>          
        </div>
        <div class="form-group has-warning has-feedback">
    <h4>
    <span class="label label-warning">
          Usuario para inicio de sesión: </span></h4>
          <input class="form-control input-lg" id="username" placeholder="Usuario" type="text" name="username" readonly>
        </div>
        <div class="form-group">
          <input class="form-control input-lg" id="password1" placeholder="Nueva contraseña" type="password" name="password">
          <span class="label label-info" id="b"></span>
          <span class="label label-danger" id="a"></span>
        </div>
        <div class="form-group">
          <input class="form-control input-lg" id="password2" placeholder="Repetir contraseña" type="password" name="password_confirmation">
        </div>
        <div class="form-group">
          <input class="btn btn-primary" id="btcambiarpass" value="Crear contraseña" type="submit">
          <br/>
        </div>
      </form>
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
    $( "#menuprincipal" ).addClass("active");
    $( "#mensajeestatus" ).fadeOut(5000); 
    $("#btcambiarpass").prop('disabled', true);
    $('#password2').prop('disabled', true);
  $.ajax({url:"../../password/email",type:"POST",data:{token:$('#token').val()},dataType:'json',
      success:function(data){
        if(data==''){
          $("#cambiar_pass").submit();
        }
        else{
          $('#email').val(data[0].email);
          $('#username').val(data[0].username);
        }
      },
      error:function(){alert('error');}
    });//Termina Ajax
    $('#password1').keyup(function(){
      var _this = $('#password1');
      var password1 = $('#password1').val();
      _this.parent().removeClass('has-info');
      if ( password1.match(/^(?=^.{8,}$)([a-z]+[0-9]+)|([0-9]+[a-z]+)/i) ) {
        _this.parent().removeClass('has-error');
        $("#b").hide();
        $('#password2').prop('disabled', false);
      }
      else{
        _this.parent().addClass('has-error');
        $('#b').text("La contraseña debe ser alfanúmerica y debe tener mínimo 8 caracteres");
        $("#b").show(100); 
        $('#password2').prop('disabled', true);
      }
    });
    $('#password2').keyup(function(){
      var password1 = $('#password1').val();
      var password2 = $('#password2').val();
      $("#btcambiarpass").prop('disabled', true); 
      var _this = $('#password2');
      _this.parent().removeClass('has-error');
      if(password1 == password2){
        $("#btcambiarpass").prop('disabled', false); 
      }
      else{
        _this.parent().addClass('has-error');
        $("#btcambiarpass").prop('disabled', true); 
      }
    });
    $('#password1').focus(function(){
      $("#btcambiarpass").prop('disabled', true);
      $('#password1').val("");
      $('#password2').val("");
      $('#password2').prop('disabled', true);
    });
  });
</script>
</body>
</html>