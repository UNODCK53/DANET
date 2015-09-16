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
<!--aca se escribe el codigo-->
<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
<!--fin del codigo-->    
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
  <script src="assets/js/highcharts/exporting.js"></script>
  <script>
  $(function () {
    $('#container').highcharts({
        chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
        title:{text:'Procesos con levatamiento topográfico'},
        tooltip:{pointFormat:'{series.name}:<b>{point.y:.0f}</b>'},
        plotOptions:{
          pie:{allowPointSelect:true,cursor:'pointer',depth:35,
            dataLabels:{
              enabled:true,
              format:'<b>{point.name}</b>: {point.percentage:.1f} %',
              style:{textShadow:'',color:(Highcharts.theme && Highcharts.theme.contrastTextColor)||'black'}
            }
          }
        },
        series: [{
          name: "No. de Procesos",
          colorByPoint: true,
          data: [
          @foreach($arraylt as $arraygra)
          @if($arraygra->requiererespgeo == 1)
             {{'{name:"Si requiere",y:'.$arraygra->y.','}}sliced: true,
                  selected: true{{'},'}}
          @else
             {{'{name:"No requiere",y:'.$arraygra->y.'},'}}
          @endif
          @endforeach
          ]
        }]
    });
  });
  $(document).ready(function() {
    //para que los menus pequeño y grande funcione
    $( "#tierras" ).addClass("active");
    $( "#tierrasreporlevtop" ).addClass("active");
    $( "#iniciomenupeq" ).html("<small> INICIO</small>");
    $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
    $( "#tierrasreporlevtopmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Levantamiento Topografico</strong>");
  });
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->