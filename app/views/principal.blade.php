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
      <i class="bg-success"></i> La contraseña fue cambiada con éxito</div>
      <div class="col-sm-1"></div>
      @endif      
    </div>
  </div>
  <!--Div bienvenida DANET-->
  <div class="container" id="sha">
    <div class="row">
    <!--Texto del contenido-->
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <br>
        <h2 class="text-center text-primary">Bienvenido al espacio web de Desarrollo Alternativo</h2>
        <br>
        <p class="lead text-justify">El DANET es un espacio diseñado para la transferencia de información y apoyo a los proyectos de Desarrollo Alternativo. Sirve como sistema de gestión y permite tener indicadores de la información. Gracias a esto, usted tiene acceso a:</p>
        <address>
        @if((Auth::user()->grupo=="2") OR (Auth::user()->grupo=="1"))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> GME</ul><h4>
        @endif
        @if((Auth::user()->grupo=="3") OR (Auth::user()->grupo=="1"))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Módulo de tierras</ul></h4>
        @endif
        @if((Auth::user()->grupo=="5") OR (Auth::user()->grupo=="1"))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Módulo de documentos</ul></h4>
        @endif
        </address>
        <br>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div> 
  <!--fin div bienvenida-->
  <br>
  @if((Auth::user()->grupo=="2") OR (Auth::user()->grupo=="1"))
  <div class="container" id="sha">
      <div class="row">
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h1 class="text-center text-primary">Erradicación Manual Forzosa</h1>
            <p class="lead text-justify" >La Unidad Administrativa Especial para la Consolidación Territorial a través de la Dirección de Programas contra Cultivos Ilícitos (DPCI), desarrolla acciones de erradicación y post erradicación a través de la armonización y  coordinación de la Estrategia de Erradicación Manual Forzosa y de la Estrategia de Desarrollo Alternativo, organizadas con el propósito de promover la transición económica y social de los territorios de las regiones focalizadas por la Política Nacional de Consolidación y Reconstrucción Territorial y los afectados por cultivos ilícitos.</p>
            <p class="lead text-justify" >En Colombia se han implementado diversas formas de lucha contra los cultivos ilícitos y las drogas ilegales, tales como la erradicación manual que presenta las siguientes modalidades:</p>
            <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> La Erradicación Manual Voluntaria, y</ul></h4>
            <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> La Erradicación Manual Forzosa.</ul></h4><br>
            <p class="lead text-justify" >La Erradicación Manual Forzosa a su vez presenta dos modalidades: i) Erradicación Manual Forzosa con los Grupos Móviles de Erradicación (GME) y ii) Erradicación Manual forzosa en tercera modalidad (Soldado a Soldado) la cual es realizada por la Fuerza Pública en sus constantes desplazamientos.</p> 
            <p class="lead text-justify" >La Estrategia de Erradicación Manual Forzosa con los Grupos Móviles de Erradicación se determina a partir de las condiciones de seguridad de los territorios a intervenir y de los resultados del proceso de coordinación y articulación con la Fuerza Pública, y consiste en eliminar la totalidad de los cultivos ilícitos a través de los Grupos Móviles de Erradicación (GME).</p>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
      <blockquote>
        <p class="text-justify"><strong>Fuente</strong>: <br>Manual Operatvo Ggrupos Móviles de Erradicación - GME <br>Dirección de Programas Contra Cultivos Ilícitos Grupo de Erradicación <br>Bogotá, D.C. Enero 23 de 2015</p>
      </blockquote>
  </div> 
  <br><!--Agregar al penúltimo div para el salto contenedores-->
  @endif
  @if((Auth::user()->grupo=="3") OR (Auth::user()->grupo=="1"))
  <div class="container" id="sha">
      <div class="row">
        <h1 class="text-center text-primary">Formalización de Tierras</h1>
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
            <br>
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
        $('#password2').prop('disabled', true);
        $("#btcambiarpass").prop('disabled', true);
        //valida cambio de contraseña
        $('#password1').keyup(function(){
          var _this = $('#password1');
          var password1 = $('#password1').val();
          _this.parent().removeClass('has-info');
          if ( password1.match(/^(?=^.{8,}$)([a-z]+[0-9]+)|([0-9]+[a-z]+)/i) ) {
            _this.parent().removeClass('has-error');
            $( "#b" ).hide();
            $('#password2').prop('disabled', false);
          }
          else{
            _this.parent().addClass('has-error');
            $('#b').text("La contraseña debe ser alfanúmerica y debe tener mínimo 8 caracteres");
            $( "#b" ).show(100); 
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
    <?php //$cambiar=Session::get('cambiar_pass'); ?>
    @if(Session::has('cambiar_pass'))
    <script>
      $(document).ready(function(){
        $("#cambiarpass").modal('show');
      });
    </script>
    @endif
@stop