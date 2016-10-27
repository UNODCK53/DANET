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
    <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-3">
        <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldpto" class="form-control" name="seldpto">
              <option value="" selected="selected">Por favor seleccione</option>              
              @foreach($deptoarray as $pro)
                  <option value="{{$pro->COD_DPTO}}">{{$pro->NOM_DPTO}}</option>
              @endforeach
          </select>
      </div>
      <div class="col-sm-3">
        <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
          <select id="selmpio" class="form-control" name="selmpio">
          </select>
      </div>
      <div class="col-sm-3">
        <label id="labelvda" for="Proceso" class="control-label">Vereda:</label>
          <select id="selvda" class="form-control" name="selvda">
          </select>
      </div>       
      <div class="col-sm-1"></div>
    </div>
    <div class="row">
      <br>
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <button type="button" id="genestadistic" data-toggle="tooltip" data-placement="top" title="Click para generar el reporte" class="btn btn-primary center-block">Reporte Nacional</button>        
      </div>
      <div class="col-sm-1"></div>
    </div>
    <!--espacio para hacer las graficas--> 
    <div id="titulo" class="text-center"><h1>INDICADORES POBLACIONALES</h1></div>
    <div class="row">          
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containera"></div>
      <div class="col-sm-5" id="containerb"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerc"></div>
      <div class="col-sm-5" id="containerd"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-7" id="containere"></div>
      <div class="col-sm-3" id="containerf"></div>
      <div class="col-sm-1"></div>
    </div>
    <div id="titulo" class="text-center"><h1>INDICADORES DE CAPITAL SOCIAL</h1></div>
    <div class="row">         
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerg"></div>
      <div class="col-sm-5" id="containerh"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containeri"></div>
      <div class="col-sm-5" id="containerj"></div>
      <div class="col-sm-1"></div>
    </div>
    <div id="titulo" class="text-center"><h1>RELACIÓN CON CULTIVOS ILÍCITOS</h1></div>
    <div class="row">         
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerk"></div>
      <div class="col-sm-5" id="containerl"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerm"></div>
      <div class="col-sm-5" id="containern"></div>
      <div class="col-sm-1"></div>
    </div>
    <!--fin espacio para hacer las graficas-->    
  <br/>
<!--fin del codigo-->    
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
  <script src="assets/js/highcharts/highcharts-3d.js"></script>
  <script src="assets/js/highcharts/exporting.js"></script>
  <script>
    $(document).ready(function() {
      
      //se genera activacion de los tooltip de bootstrap
      $('[data-toggle="tooltip"]').tooltip()
      
      //para que los menus pequeño y grande funcione
      $( "#siscadi" ).addClass("active");
      $( "#estadisticosiscadi" ).addClass("active");
      $( "#iniciomenupeq" ).html("<small> INICIO</small>");
      $( "#siscadimenupeq" ).html("<strong>SISCADI<span class='caret'></span></strong>");
      $( "#estadisticosiscadimenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Estadisticas</strong>");
      $( "#mensajeestatus" ).fadeOut(5000);

      //inicio ocultando combobox
      $("#labelmpio").hide();
      $("#selmpio").hide();
      $("#labelvda").hide();
      $("#selvda").hide();
      $(".text-center").hide();

      //funcion de cambio del combo depto
      $("#seldpto").change(function(){
        if((($('#seldpto').val()=='')&&($('#selmpio').val()!=''))||(($('#seldpto').val()=='')&&($('#selmpio').val()=='')))
        {
          location.reload();
        }
        else{
          $.ajax({url:"siscadi/reporestadompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
            success:function(data1){
              document.getElementById("genestadistic").innerHTML = "Reporte Departamental";
              $("#labelmpio").show();
              $("#selmpio").show();
              $("#selmpio").empty();
              $("#selvda").empty();
              $("#selvda").hide();
              $("#selmpio").append("<option value=''>Por favor seleccione</option>");
                $.each(data1, function(nom,datos){
                  $("#selmpio").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
                });
              
            },
            error:function(){alert('error');}
          });//Termina Ajax 
        }
      });//Termina chage seldpto
      $("#selmpio").change(function(){
        if($('#selmpio').val()=='')
        {
          $.ajax({url:"siscadi/reporestadompio",type:"POST",data:{dpto:$('#seldpto').val()},dataType:'json',
          success:function(data1){
            document.getElementById("genestadistic").innerHTML = "Reporte Departamental";
            $("#labelmpio").show();
            $("#selmpio").show();
            $("#selmpio").empty();
            $("#selvda").empty();
            $("#selvda").hide();
            $("#labelvda").hide();
            $("#selmpio").append("<option value=''>Por favor seleccione</option>");
            $.each(data1, function(nom,datos){
              $("#selmpio").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
            });          
          },
          error:function(){alert('error');}
          });//Termina Ajax 
        }
        else{
          $.ajax({url:"siscadi/reporestadovered",type:"POST",data:{mpio:$('#selmpio').val()},dataType:'json',
            success:function(data){
              document.getElementById("genestadistic").innerHTML = "Reporte Municipal";
              $("#labelvda").show();
              $("#selvda").show();
              $("#selvda").empty();
              $("#selvda").append("<option value=''>Por favor seleccione</option>");
              [].forEach.call(data,function(datos){
                $("#selvda").append("<option value=\""+datos.Cod_Terr+"\">"+datos.Nombre_Terr+"</option>");
              });                           
            },
            error:function(){alert('error');}
          });//Termina Ajax 
        }
      });//Termina change selvda
      $("#selvda").change(function(){
        if($('#selvda').val()=='')
        {
          document.getElementById("genestadistic").innerHTML = "Reporte Municipal";
        }
        else{
          document.getElementById("genestadistic").innerHTML = "Reporte Veredal";
        }
      });//Termina change selvda
      //evento click de generar graficass
      $("#genestadistic").on('click', function(){
                
        $.ajax({
          url:"siscadi/reporestadtotal",
          type:"POST",
          data:{dpto:$('#seldpto').val(),mpio:$('#selmpio').val(),vere:$('#selvda').val()},
          dataType:'json',
          
          success:function(data){
            $(".text-center").show();
            console.log(data);
            var categories = data.categories;
            $('#containera').highcharts({
              chart: {
                  type: 'bar'
              },
              title: {
                  text: '1. Población por grupo de edades'
              },
              credits: {
                enabled: false
              },
              xAxis: [{
                  categories: categories,
                  reversed: false,
                  labels: {
                      step: 1
                  }
              }, { // mirror axis on right side
                  opposite: true,
                  reversed: false,
                  categories: categories,
                  linkedTo: 0,
                  labels: {
                      step: 1
                  }
              }],
              yAxis: {
                  title: {
                      text: null
                  },
                  labels: {
                      formatter: function () {
                          return Math.abs(this.value) + '%';
                      }
                  }
              },

              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },

              tooltip: {
                  formatter: function () {
                      return '<b>' + this.series.name + ', edad de ' + this.point.category + '</b><br/>' +
                          'Población: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0)+ '%';
                  }
              },

              series: [{
                  name: 'Masculino',
                  data: data.masculino1
              }, {
                  name: 'Femenino',
                  data: data.femenino1
              }]
            });
            $('#containerb').highcharts({
              chart: {
                  type: 'bar'
              },
              title: {
                  text: '2. Jefatura de hogar por grupo de edades'
              },
              credits: {
                enabled: false
              },
              xAxis: [{
                  categories: categories,
                  reversed: false,
                  labels: {
                      step: 1
                  }
              }, { // mirror axis on right side
                  opposite: true,
                  reversed: false,
                  categories: categories,
                  linkedTo: 0,
                  labels: {
                      step: 1
                  }
              }],
              yAxis: {
                  title: {
                      text: null
                  },
                  labels: {
                      formatter: function () {
                          return Math.abs(this.value) + '%';
                      }
                  }
              },

              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },

              tooltip: {
                  formatter: function () {
                      return '<b>' + this.series.name + ', edad de ' + this.point.category + '</b><br/>' +
                          'Población: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0)+ '%';
                  }
              },

              series: [{
                  name: 'Masculino',
                  data: data.masculino2
              }, {
                  name: 'Femenino',
                  data: data.femenino2
              }]
            });
            $('#containerc').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: '3. Jefatura de hogar'
              },
              credits: {
                enabled: false
              },              
              tooltip: {
                  headerFormat: '<table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y}%</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },
              series: [{
                  name: 'Masculino',
                  data: [data.masculino]

              }, {
                  name: 'Femenino',
                  data: [data.femenino]
              }]
            });
            $('#containerd').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: '4. Autoreconocimiento étnico'
              },
              credits: {
                enabled: false
              },              
              tooltip: {
                  headerFormat: '<table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y}%</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },                          
              series: data.etnico
            });             
            $('#containere').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '5. Razones para llegar al municipio'
              },
              subtitle: {
                text: 'El <b>'+data.naciompiono+'%</b> de los encuestados reporta no haber nacido en el municipio.'
              },
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.razones)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },
              tooltip: {
                  valueSuffix: ' %'
              },
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.razones)
              }]
            });
            document.getElementById("containerf").innerHTML = '<p class="text-justify">El <b>'+data.embarazoparto+'%PENDIENTECORREGIR</b> de las mujeres se encuentran en estado de embarazo o están lactando.</p><p class="text-justify">El <b>'+data.discapacidad+'%</b> de la población presenta alguna discapacidad.</p><p class="text-justify">El <b>'+data.analfabetismotot+'%</b> de la población mayor de 15 años encuestada no sabe leer, ni escribir.  <b>'+data.analfabetismomtot+'%</b> Mujeres – <b>'+data.analfabetismohtot+'%</b> Hombres</p><p class="text-justify">Promedio de personas en los hogares encuestados <b>'+data.promperhoga+'</b></p>';

            $('#containerg').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '1. Espacios de participación'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.espaciospart)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },
              tooltip: {
                  valueSuffix: ' %'
              },
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.espaciospart)
              }]
            });
            $('#containerh').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '2. Participación en actividades comunitarias'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.actividadcomuni)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },
              tooltip: {
                  valueSuffix: ' %'
              },
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.actividadcomuni)
              }]
            });
            $('#containeri').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '3. Vinculación a organizaciones'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.vinculoorg)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },
              tooltip: {
                  valueSuffix: ' %'
              },
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.vinculoorg)
              }]
            });
            $('#containerj').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: '4. Percepción de las relaciones comunitarias'
              },
              credits: {
                enabled: false
              },              
              tooltip: {
                  headerFormat: '<table>',
                  pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                      '<td style="padding:0"><b>{point.y} %</b></td></tr>',
                  footerFormat: '</table>',
                  shared: true,
                  useHTML: true
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0
                  }
              },                          
              series: data.gruporelaccomunidad
            });
            $('#containerk').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '1. Porcentaje de personas que tienen relación con cultivos ilícitos'
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
              },
              plotOptions: {
                  pie: {
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.0f} %'                         
                      }
                  }
              },
              series: [{
                  name: '->',
                  colorByPoint: true,
                  data: data.relculilici
              }]
            }); 
            $('#containerl').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '2. Razones de vinculación a los cultivos ilícitos'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.vinculoorg)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },
              tooltip: {
                  valueSuffix: ' %'
              },
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal'
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.vinculoorg)
              }]
            });
          //terminalos contenedores de graficas
 
          }, 
          error:function(){alert('error');}
        });//Termina Ajax 
      });//Termina change genestadistic      
    });    
  </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->