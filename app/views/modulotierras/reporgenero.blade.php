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
          <br>
      <div class="row">
        <br>
        <p class="lead text-center">DISTRIBUCIÓN DE PROCESOS POR GÉNERO</p>
      </div>
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="col-sm-4">
          <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
            <select id="seldpto" class="form-control" name="seldpto">
                <option value="" selected="selected">Por favor seleccione</option>
                @foreach($arraydpto as $pro)
                    <option value="{{$pro->cod_dpto}}">{{$pro->nom_dpto}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-4">
          <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
            <select id="selmpio" class="form-control" name="selmpio">
            </select>
        </div>
        <div class="col-sm-4">
          <label id="labelvda" for="Proceso" class="control-label">Vereda:</label>
            <select id="selvda" class="form-control" name="selvda">
            </select>
        </div>
      </div> 
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <h3 class="panel-title">Procesos por género</h3>
          </div>
          <div class="panel-body">
            <div id="container"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-1"></div>
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
  <script src="assets/js/highcharts/exporting.js"></script>
  <script>
  $(function () {
    $('#container').highcharts({
        chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
        title:{text:''},
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
          @foreach($arraygen as $arraygra)
          @if($arraygra->genero == 1)
             {{'{name:"Masculino",y:'.$arraygra->y.','}}sliced: true,
                  selected: true{{'},'}}
          @else
             {{'{name:"Femenino",y:'.$arraygra->y.'},'}}
          @endif
          @endforeach
          ]
        }]
    });
  });
  $(document).ready(function() {
    //para que los menus pequeño y grande funcione
    $( "#tierras" ).addClass("active");
    $( "#tierrasreporgenero" ).addClass("active");
    $( "#iniciomenupeq" ).html("<small> INICIO</small>");
    $( "#tierrasmenupeq" ).html("<strong>MÓDULO TIERRAS<span class='caret'></span></strong>");
    $( "#tierrasreporgeneromenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Género</strong>");
    $("#labelmpio").hide();
    $("#selmpio").hide();
    $("#labelvda").hide();
    $("#selvda").hide();
    $("#seldpto").change(function(){
      if((($('#seldpto').val()=='')&&($('#selmpio').val()!=''))||(($('#seldpto').val()=='')&&($('#selmpio').val()=='')))
      {
        location.reload();
      }
      else{
        $.ajax({url:"tierras/reporgenerompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
          success:function(data1){
            $("#labelmpio").show();
            $("#selmpio").show();
            $("#selmpio").empty();
            $("#selvda").empty();
            $("#selvda").hide();
            $("#selmpio").append("<option value=''>Por favor seleccione</option>");
            $.each(data1[0], function(nom,datos){
              $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
            });
            arreglo=[];
            for(i=0; i<data1[1].length;i++){
              if(data1[1][i].genero == 1){
                arreglo[i]={
                  name:"Masculino",
                  y:Number(data1[1][0].y)
                }
              } else {
                arreglo[i]={
                  name:"Femenino",
                  y:Number(data1[1][0].y)
                }
              }
            }
            $('#container').highcharts({
                chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
                title:{text:''},
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
                  data: arreglo
                }]
            });
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina chage seldpto
    $("#selmpio").change(function(){
      if($('#selmpio').val()==''){
        $.ajax({url:"tierras/reporgenerompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
          success:function(data1){
            $("#labelmpio").show();
            $("#selmpio").show();
            $("#selmpio").empty();
            $("#selvda").empty();
            $("#selvda").hide();
            $("#labelvda").hide();
            $("#selmpio").append("<option value=''>Por favor seleccione</option>");
            $.each(data1[0], function(nom,datos){
              $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
            });
            arreglo=[];
            for(i=0; i<data1[1].length;i++){
              if(data1[1][i].genero == 1){
                arreglo[i]={
                  name:"Masculino",
                  y:Number(data1[1][0].y)
                }
              } else {
                arreglo[i]={
                  name:"Femenino",
                  y:Number(data1[1][0].y)
                }
              }
            }
            $('#container').highcharts({
                chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
                title:{text:''},
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
                  data: arreglo
                }]
            });
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        $.ajax({url:"tierras/reporgenerovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
          success:function(data1){
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data1[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            arreglo=[];
            for(i=0; i<data1[1].length;i++){
              if(data1[1][i].genero == 1){
                arreglo[i]={
                  name:"Masculino",
                  y:Number(data1[1][0].y)
                }
              } else {
                arreglo[i]={
                  name:"Femenino",
                  y:Number(data1[1][0].y)
                }
              }
            }
            $('#container').highcharts({
                chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
                title:{text:''},
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
                  data: arreglo
                }]
            });
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina change selmpio
    $("#selvda").change(function(){
      if($('#selvda').val()=='')
      {
        $.ajax({url:"tierras/reporgenerovda",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
          success:function(data1){
            $("#labelvda").show();
            $("#selvda").show();
            $("#selvda").empty();
            $("#selvda").append("<option value=''>Por favor seleccione</option>");
            [].forEach.call(data1[0],function(datos){
              $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
            });
            arreglo=[];
            for(i=0; i<data1[1].length;i++){
              if(data1[1][i].genero == 1){
                arreglo[i]={
                  name:"Masculino",
                  y:Number(data1[1][0].y)
                }
              } else {
                arreglo[i]={
                  name:"Femenino",
                  y:Number(data1[1][0].y)
                }
              }
            }
            $('#container').highcharts({
                chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
                title:{text:''},
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
                  data: arreglo
                }]
            });
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
      else{
        $.ajax({url:"tierras/reporgenerovdadet",type:"POST",data:{vda:$('#selvda').val()},dataType:'json',
          success:function(data1){
            arreglo=[];
            for(i=0; i<data1[0].length;i++){
              if(data1[0][i].genero == 1){
                arreglo[i]={
                  name:"Masculino",
                  y:Number(data1[0][0].y)
                }
              } else {
                arreglo[i]={
                  name:"Femenino",
                  y:Number(data1[0][0].y)
                }
              }
            }
            $('#container').highcharts({
                chart:{type:'pie',options3d:{enabled:true,alpha:45,beta:0}},
                title:{text:''},
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
                  data: arreglo
                }]
            });
          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }
    });//Termina change selvda
  });
  </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->