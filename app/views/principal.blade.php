 
 <!--agrega la pagina maestra-->
@extends('layouts.master')
<!--agrega seccion titulo por si se quiere cambiar el titulo de la pestaña-->
@section('titulo')
  @parent
@stop
 <!--agrega los estilos de la pagina y los meta-->
@section('cabecera')
  @parent
   

@stop
 <!--agrega el Primer Contenerdor  de logo y cabecera el boton de inicio se agrega por aca-->
@section('contenidocabecera1')
  @parent
@stop
<!--agrega el menu a la pagina-->
@section('menu1')
<!--Segundo contenedor menu secundario-->
@parent
<!--Fin del segundo contenedor-->   
@stop
<!--CONTENEDOR GENERAL-->
@section('contenedorgeneral1')
  @parent
<!--tercer contenedor pie de página-->
  <div class="container" id="sha">
    <div class="row">
      @if(Session::has('cambiopassok'))
      <div class="col-sm-1"></div>    
      <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
      <i class="bg-success"></i> La contraseña fue cambiadad con éxito</div>
      <div class="col-sm-1"></div>
      @endif      
    </div>
  </div>
  @if(Auth::user()->grupo=="3")
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
                <img src="assets/img/DANET_T1.jpg" alt="Gmail en todo tipo de dispositivos">
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="assets/img/DANET_T2.jpg" alt="Mensajes por tipo para organizarte mejor">
              <div class="carousel-caption">
              </div>
            </div>                
          </div>  
        </div>
      </div>
  </div>
  <div class="container" id="sha">
      <div class="row">
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="text-center">Formalización de Tierras</h1>
            <p class="lead text-justify" >Este programa <strong>brinda sostenibilidad y garantía en las intervenciones</strong> realizadas por los organismos multilaterales y el Estado. También transforma la problemática generada por la siembra de cultivos ilícitos, con un alcance social más amplio al <strong>mejorar la calidad de vida</strong> para las familias con la posibilidad de acceso a créditos y fuentes de financiamiento.</p>
            <p class="lead text-justify" >La formalización valoriza los municipios y las tierras colombianas, genera y protege el patrimonio de sus pobladores y además fomenta la cohesión social.</p>
            <p class="lead text-justify" >El gobierno colombiano, con el apoyo de la Cooperación Internacional, facilita los procesos de formalización de tierras, considerando que es un asunto de <strong>interés privado</strong> de cada familia campesina, pero también de <strong>interés público</strong>.</p> 
            <p class="lead text-justify" >Dado el volumen de las situaciones de informalidad y el contexto de la protección patrimonial, se busca fomentar los <strong>múltiples beneficios</strong> que representa la formalización para las familias, los entes territoriales y el Estado en general.</p>
            <p class="lead text-justify" >El Desarrollo Alternativo, como estrategia eficaz y eficiente, requiere enfoques económicos, sociales, políticos y ambientales. El desarrollo debe ser integral y sostenible, y considerar el <strong>desarrollo humano como elemento central</strong> en el proceso de intervención.</p>
            <p class="lead text-justify" >En la estrategia de Desarrollo Alternativo se ha incluido el programa de Formalización de Tierras que busca <strong>mitigar los impactos negativos</strong> causados por <em>fenómenos</em><strong>*</strong> que chocan con los principios del desarrollo social, económico y con el mandato constitucional. La estrategia es adelantada por el <strong>Ministerio de Justicia y del Derecho, la Unidad Administrativa para la Consolidación Territorial y la Oficina de las Naciones Unidas contra la Droga y el Delito</strong>.</p>            
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
      <blockquote>
        <p class="text-justify"><strong>*</strong>La informalidad en la tenencia de tierras, la presencia de actores armados ilegales, los cultivos ilícitos, la producción, comercialización y consumo de drogas ilícitas, la inequidad en la distribución y uso del suelo, las expectativas del dinero fácil, el desplazamiento masivo, la falta de vías de acceso y la minería ilegal, entre otros, son factores que han intensificado la precaria situación de los pobladores rurales.</p>
      </blockquote>
  </div> 
  @endif

  <!--cambiarpass modal-->
  <div id="cambiarpass" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="loginbox">
          <div class="modal-header">
            <h3 class="text-center">Usted debe cambiar la contraseña</h3>
          </div>
          <div class="modal-body">
            <form class="form center-block" id="cambiar_pass" action="cambiopass" method="post">
              <div class="form-group">
                <input class="form-control input-lg" id="password1" placeholder="Contraseña nueva" type="password" name="password1">
                <span class="label label-info" id="b"></span>
                <span class="label label-danger" id="a"></span>
              </div>
              <div class="form-group">
                <input class="form-control input-lg" id="password2" placeholder="Repetir contraseña" type="password" name="password2">
              </div>
              <div class="form-group">
                <input class="btn btn-primary btn-lg btn-block" id="btcambiarpass" value="Cambiar" type="submit" disabled="disabled">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            
          </div>
      </div>
    </div>
  </div>


  <!--Fin del tercer contenedor--> 
@stop
<!--Cierra el CONTENEDOR GENERAL-->
@section('contenedorgeneral2')
  @parent
@stop
<!--el pie de pagina o barra gris de abajo-->
@section('piedepagina')
  @parent
@stop
<!--agrega JavaScript dentro del body a la pagina-->
@section('js')
  @parent
    <script>
      $(document).ready(function() {
        //para que los menus pequeño y grande funcione
        $( "#menuprincipal" ).addClass("active");
        $( "#mensajeestatus" ).fadeOut(5000); 
        //valida cambio de contraseña

        $('#password1').keyup(function(){
          var _this = $('#password1');
          var password1 = $('#password1').val();
          _this.parent().removeClass('has-info');
          if ( password1.match(/^([a-z]+[0-9]+)|([0-9]+[a-z]+)/i) ) {
            _this.parent().removeClass('has-error');
            $( "#b" ).hide();
          }
          else{
            _this.parent().addClass('has-error');
            $('#b').text("La contraseña debe tener letras y un números");
            $( "#b" ).show(100); 
          }
        });
  
        $('#password2').keyup(function(){
          var password1 = $('#password1').val();
          var password2 = $('#password2').val();
          $("#btcambiarpass").prop('disabled', true); 
          var _this = $('#password2');
          _this.parent().removeClass('has-error');
          if(password1 != password2 && password2 != ''){
            _this.parent().addClass('has-error');
          }
          else{
            if(password2.charAt(0) == ' '){
            _this.parent().addClass('has-error');
            $("#btcambiarpass").prop('disabled', true); 
            }
            else{
              if(_this.val() == ''){
              _this.parent().addClass('has-error');
              $("#btcambiarpass").prop('disabled', true); 
              }
              else{
              $("#btcambiarpass").prop('disabled', false);
              }
            } 
          }
        });
        $('#password1').focus(function(){
          $("#btcambiarpass").prop('disabled', true);
          $( "#a" ).hide();
          $('#password1').val("");
          $('#password2').val("");

        });
        $('#password2').focus(function(){
          var password1 = $('#password1').val();
          $('#password2').val("");
          if((password1.length < 6) && (password1.length >0)){
            $("#password1").addClass('has-error');
            $('#a').text("La contraseña no puede tener menos de 5 caracteres");
            $( "#a" ).show(100); 
            $('#password1').val("");
          }
        });
    });

    </script>
    <?php //$cambiar=Session::get('cambiar_pass'); ?>
    @if(Session::has('cambiar_pass'))
    <script>
      $(document).ready(function(){
        $("#cambiarpass").modal('show');
      });
    </script>
    @endif

@stop

