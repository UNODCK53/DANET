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
$menuartcarguefamilias=false; $menuartfichapriorizacionproy=false; $menuartseguimientopic=false; $menuartdashboard=false; $menuartcensofamilias=false; $menuartdiagnosticofamiliar=false; $menuartconsultapic=false;$menuartcargaindicador=false; $menuartseguimientoindicador=false; $menuarttableropresidente=false; $menuarttablerogeneral=false; $menuarttablerodetallado=false; $menuartcargaeditarnorma=false; $menuarttableronorma=false; $menuartcargaeditarplanrr=false; $menuartconsultaplanrr=false;

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
    if(($acceso->id_vista=="6111")&&($acceso->acces=="1")){$menuartcarguefamilias=true;}
    if(($acceso->id_vista=="6112")&&($acceso->acces=="1")){$menuartfichapriorizacionproy=true;}
    if(($acceso->id_vista=="6113")&&($acceso->acces=="1")){$menuartseguimientopic=true;}
    if(($acceso->id_vista=="6131")&&($acceso->acces=="1")){$menuartdashboard=true;}
    if(($acceso->id_vista=="6132")&&($acceso->acces=="1")){$menuartcensofamilias=true;}
    if(($acceso->id_vista=="6133")&&($acceso->acces=="1")){$menuartdiagnosticofamiliar=true;}
    if(($acceso->id_vista=="6134")&&($acceso->acces=="1")){$menuartconsultapic=true;}
    if(($acceso->id_vista=="6211")&&($acceso->acces=="1")){$menuartcargaindicador=true;}
    if(($acceso->id_vista=="6212")&&($acceso->acces=="1")){$menuartseguimientoindicador=true;}
    if(($acceso->id_vista=="6221")&&($acceso->acces=="1")){$menuarttableropresidente=true;}
    if(($acceso->id_vista=="6222")&&($acceso->acces=="1")){$menuarttablerogeneral=true;}
    if(($acceso->id_vista=="6223")&&($acceso->acces=="1")){$menuarttablerodetallado=true;}
    if(($acceso->id_vista=="6311")&&($acceso->acces=="1")){$menuartcargaeditarnorma=true;}
    if(($acceso->id_vista=="6321")&&($acceso->acces=="1")){$menuarttableronorma=true;}
    if(($acceso->id_vista=="6411")&&($acceso->acces=="1")){$menuartcargaeditarplanrr=true;}
    if(($acceso->id_vista=="6421")&&($acceso->acces=="1")){$menuartconsultaplanrr=true;}
    if(($acceso->id_vista=="9999")&&($acceso->acces=="1")){$menuguardaun=true;}
 }
 ?>
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
  @if(Auth::user()->grupo!="10")
  <!--Div bienvenida DANET-->
  <div class="container" id="sha">
    <div class="row">
    <!--Texto del contenido-->
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <br>
        <h2 class="text-center text-primary">Bienvenido al espacio web de Desarrollo Alternativo</h2>
        <br>
        <p class="lead text-justify">Este es un espacio diseñado para la transferencia de información y apoyo a los proyectos de Desarrollo Alternativo y sus aliados estratégicos. Sirve como sistema de gestión y permite tener indicadores de la información. Gracias a esto, usted tiene acceso a:</p>
        <address>
        @if(($menugmevalcert) || ($menugmemetodologia) || ($menugmedisterradi) || ($menugmeinformes))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> GME</ul><h4>
        @endif
        @if(($menucongral)||($menuestadoproc)||($menurepnumpro)||($menureplevtopo)||($menureparealev)||($menureprespjuri)
          ||($menucargaini)||($menuprocadj)||($menulevtopo)||($menucoor)||($menumaps)||($menurepgenero))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Módulo de tierras</ul></h4>
        @endif
        @if(($menucarguedocu) || ($menuconsuldocu) || ($menurepordocu))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Módulo de documentos</ul></h4>
        @endif
        @if(($menuartcargaeditarnorma)||($menuarttableronorma))
        <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> Producción Normativa </ul></h4>
        @endif
        </address>
        <br>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div> 
  <!--fin div bienvenida-->
  @endif
  <br>
  @if(($menugmevalcert) || ($menugmemetodologia) || ($menugmedisterradi) || ($menugmeinformes))
  <div class="container" id="sha">
      <div class="row">
      <!--Texto del contenido-->
        <div class="col-sm-1"></div>
        <div class="col-sm-10">
            <h2 class="text-center text-primary">Erradicación Manual Forzosa</h2>
            <p class="lead text-justify" >La Unidad Administrativa Especial para la Consolidación Territorial a través de la Dirección de Programas contra Cultivos Ilícitos (DPCI) desarrolla acciones de erradicación y post erradicación a través de la armonización y  coordinación de la Estrategia de Erradicación Manual Forzosa y de la Estrategia de Desarrollo Alternativo, organizadas con el propósito de promover la transición económica y social de los territorios de las regiones focalizadas por la Política Nacional de Consolidación y Reconstrucción Territorial y los afectados por cultivos ilícitos.</p>
            <p class="lead text-justify" >En Colombia se han implementado diversas formas de lucha contra los cultivos ilícitos y las drogas ilegales, tales como la erradicación manual que presenta las siguientes modalidades:</p>
            <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> La Erradicación Manual Voluntaria.</ul></h4>
            <h4><ul class=" text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> La Erradicación Manual Forzosa.</ul></h4><br>
            <p class="lead text-justify" >La Erradicación Manual Forzosa a su vez presenta dos modalidades: i) Erradicación Manual Forzosa con los Grupos Móviles de Erradicación (GME) y ii) Erradicación Manual forzosa en tercera modalidad (Soldado a Soldado) la cual es realizada por la Fuerza Pública en sus constantes desplazamientos.</p> 
            <p class="lead text-justify" >La Estrategia de Erradicación Manual Forzosa con los Grupos Móviles de Erradicación se determina a partir de las condiciones de seguridad de los territorios a intervenir y de los resultados del proceso de coordinación y articulación con la Fuerza Pública, y consiste en eliminar la totalidad de los cultivos ilícitos a través de los Grupos Móviles de Erradicación (GME).</p>
        </div>
        <div class="col-sm-1"></div>
      </div>
      <hr>
      <blockquote>
        <p class="text-justify"><strong>Fuente</strong>: <br>Manual Operatvo Grupos Móviles de Erradicación - GME <br>Dirección de Programas Contra Cultivos Ilícitos Grupo de Erradicación <br>Bogotá, D.C. Enero 23 de 2015</p>
      </blockquote>
  </div> 
  <br><!--Agregar al penúltimo div para el salto contenedores-->
  @endif
  @if(($menucongral)||($menuestadoproc)||($menurepnumpro)||($menureplevtopo)||($menureparealev)||($menureprespjuri)
          ||($menucargaini)||($menuprocadj)||($menulevtopo)||($menucoor)||($menumaps)||($menurepgenero))
  <div class="container" id="sha">
      <div class="row">
        <h2 class="text-center text-primary">Formalización de Tierras</h2>
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
  <br><!--Agregar al penúltimo div para el salto contenedores-->
 @if(Auth::user()->grupo=="10" and (Auth::user()->level=="10"||Auth::user()->level=="11"))
  <div class="container" id="sha">
      <div class="row">
        <h2 class="text-center text-primary">Agencia de Renovación territorial</h2>
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
                <img src="assets/art/img/about-carousel-1.jpg">                
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="assets/art/img/about-carousel-2.jpg">
              <div class="carousel-caption">
              </div>
            </div>
            <div class="item">
              <img src="assets/art/img/about-carousel-3.jpg">
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
            <p class="lead text-justify" >En este Sistema de Información encontrará el avance de la intervención de la ART.</p>                      
        </div>
        <div class="col-sm-1"></div>
      </div>      
      
  </div>
  @endif
  <br>


  @if(Auth::user()->grupo=="10" and (Auth::user()->level=="8"||Auth::user()->level=="9"))
  <div class="container" id="sha">
      <div class="row">
        <h2 class="text-center text-primary">Producción Normativa</h2>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
          <!-- Indicators -->
          <ol class="carousel-indicators">
          <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>          
          </ol>
          <!-- Wrapper for slides -->
          <div class="carousel-inner">
            <div class="item active">
                <img src="assets/img/NORMATIVIDAD.jpg" alt="Gmail en todo tipo de dispositivos">
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
            <p class="lead text-justify" >"Bienvenido. En este Sistema de Información encontrará el avance de la producción normativa para la implementación del Acuerdo Final para la Terminación y una Paz Estable y Duradera</p>                      
        </div>
        <div class="col-sm-1"></div>
      </div>      
      
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