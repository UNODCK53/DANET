@if(Auth::check())<!--muestra el contenido de la página si esta autenticado-->
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
<!--agrega JavaScript dentro del header a la pagina-->
@section('js')
  @parent
@stop 
<!--agrega script de cabecera y no de cuerpo si se necesitan-->
@section('scripthead')
  @parent
@stop 
<!--agrega el Primer Contenerdor  de logo y cabecera el boton de inicio se agrega por aca-->
@section('contenidocabecera1')
  <div class="container-fluid well" id="containercabecera">
  <img id="logos" src="assets/img/Logos.png" class="logo" hidden>
    <div class="row" id="cabecera">
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
    <div id="btimpr"class="row">
      <br>
      <div class="col-sm-1">
      </div>
      <button title="Imprimir" type="button" class="btn btn-primary">Imprimir</button>
    </div>
    <div class="row">
      <br>
      <p class="lead text-center">PROCESOS DE FORMALIZACIÓN DE TIERRAS</p>
    </div>
    <div class="row">
<!--aca se escribe el codigo-->
      <div class="col-sm-1">
      </div>
      <div class="col-sm-4">
        <br><br>
        <p class="lead text-justify">A la fecha del reporte se encuentran {{$numpro}} procesos, ditribuidos como los presenta la gráfica 1.1.</p>
      </div>
      <div class="col-sm-6">
        <div id="container" style="min-width: 310px; height: 350px; max-width: 600px; margin: 0 auto"></div>
        <p class="text-center">Gráfica 1.1</p>
      </div>
      <div class="col-sm-1">
      </div>
<!--fin del codigo-->    
    </div>
    <div class="row">
      <div class="col-sm-1">
      </div>
      <div class="col-sm-1" id="firmapro" hidden>
        <br>
        <p class="text-justify">Firma: </p>
        <p>_____________________</p>
        <br>
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
  <script src="assets/js/highcharts/highcharts.js"></script>
  <script>
  $(function () {
    $('#container').highcharts({
      chart:{type:'pie',options3d:{enabled:true,alpha: 45,beta:0}},
      title:{text:'Procesos por Concepto Jurídico'},
      tooltip:{pointFormat:'{series.name}: <b>{point.y:.0f}</b>'},
      plotOptions:{
        pie:{allowPointSelect:true,cursor:'pointer',depth:35,
          dataLabels:{
            enabled:true,
            format:'<b>{point.name}</b>: {point.percentage:.1f} %',
            style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor)||'black'}
          }
        }
      },
      series:[{
        name: "No. de Procesos",
        colorByPoint: true,
        data:[
          @foreach($arraynumpro as $arraygra)
            {{'["'.$arraygra->name.'",'.$arraygra->y.'],'}}
          @endforeach
        ]
      }]
    });
  });
  $(document).ready(function() {
    //para que los menus pequeño y grande funcione
    $( "#tierras" ).addClass("active");
    $( "#tierrasrepornumproc" ).addClass("active");
    $( "#iniciomenupeq" ).html("<small> INICIO</small>");
    $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
    $( "#tierrasrepornumprocmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Número de procesos</strong>");
    $( "#mensajeestatus" ).fadeOut(5000);
    $('#btimpr').click(function(){
      $('#btimpr').hide();
      $("#firmapro").show();
      $('#piedepagina').hide();
      $('#cabecera').hide();
      $('#sha').attr({style:"border:ridge 1px"});
      $('#logos').show();
      document.title = 'Reporte Tierras';
      print();
      $("#firmapro").hide();
      $('#btimpr').show();
      $('#piedepagina').show();
      $('#logos').hide();
      $('#cabecera').show();
      $('#sha').removeAttr("style");
      document.title = 'SAI version2';
    });
  });
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->