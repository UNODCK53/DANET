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
  <div id="uno"></div>
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

        <button type="button" id="genestadistic" data-toggle="tooltip" data-placement="top" title="Click para generar el reporte" class="btn btn-primary btn-block">Reporte Nacional</button><br>
        <button type="button" id="genestadisticpdf" data-placement="top" class="btn btn-warning center-block" style="display: none">Generar reporte PDF</button>
        

      </div>
      <div class="col-sm-1"></div>
    </div>
    <br>
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <div class="row">
        <div id="reporte" style="display: none">
          <div  class="panel panel-default">
            <div class="panel-body">
              <h3 class="text-center text-primary">Ficha técnica de las encuentas con los cuales se generaron los siguientes inidcadores.</h3>
             <br>
             <div class="col-sm-1"></div>
             <div class="col-sm-10">
             <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="table_consulta">
                <thead>
                </thead>
                <tbody id="body_table_consulta">
                </tbody> 
              </table>
              </div>
              <div class="col-sm-1"></div>
            </div>
            <br>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-1"></div>
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
    <div id="titulo" class="text-center"><h1>INDICADORES ECONÓMICOS</h1></div>
    <div class="row">         
      <div class="col-sm-1"></div>      
      <div  id="subtitulo1" style="display: none" class="col-sm-10"><h4>1. Índice de pobreza multidimensional</h4><blockquote><p>El Índice de Pobreza Multidimensional (IPM) busca realizar un análisis de pobreza desde la perspectiva de múltiples dimensiones asociadas a las privaciones de las personas. Las variables definidas para el cálculo del IPM están enmarcadas en cuatro dimensiones: educación, salud, infancia y adolescencia y condiciones de la vivienda, las cuales fueron diseñadas para determinar condiciones de pobreza de hogares rurales colombianos vinculados a los programas de desarrollo alternativo. Se considera un hogar multidimensionalmente pobre si está privado de un tercio de las dimensiones de los indicadores ponderados.</p></blockquote></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">         
      <div class="col-sm-1"></div>      
      <div class="col-sm-5" id="containerp"></div>
      <div class="col-sm-5" id="containero"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="containerq"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">         
      <div class="col-sm-1"></div>      
      <div  id="subtitulo2" style="display: none" class="col-sm-10"><h4>2. Índice de Pobreza Monetaria</h4>        
        <div class="row"> 
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
          <table class="table">
            <thead>
              <tr>
                <th>Nivel de pobreza</th>
                <th>Ingreso Hogar *</th>              
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>No Pobre</td>
                <td>Mayor a $622.391</td>              
              </tr>
              <tr>
                <td>Pobre</td>
                <td>Menor a $622.391 y mayor a $366.133</td>              
              </tr>
              <tr>
                <td>Pobre extremo</td>
                <td>Menor a $366.133</td>              
              </tr>
            </tbody>
          </table>
          </div>
          <div class="col-sm-3"></div>
        </div>
        <blockquote>
          <p>* Fuente: Boletín Técnico Pobreza Monetaria y Multidimensional en Colombia . DANE 2015 – Área rural dispersa. Ajustado con inflación</p>
        </blockquote>
      </div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containers"></div>
      <div class="col-sm-5" id="containerr"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="containert"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div id="titulo" class="text-center"><h1>ACTIVIDADES PRODUCTIVAS</h1></div>
    <div class="row">         
      <div class="col-sm-1"></div>
      <div class="col-sm-10 text-center" id="containeru"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-4" id="containerv"></div>
      <div class="col-sm-6" id="containerw"></div>      
      <div class="col-sm-1"></div>
    </div>    
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerespe"></div>
      <div class="col-sm-5" id="containerpeces"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="containerganado"></div>      
      <div class="col-sm-1"></div>
    </div>
    
    <div id="titulo" class="text-center"><h1>TERRITORIO Y MEDIO AMBIENTE</h1></div>
    <div class="row">         
      <div class="col-sm-1"></div>
      <div class="col-sm-10" id="containerdondevive"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">         
      <div class="col-sm-1"></div>   
      <div class="col-sm-5" id="containerx"></div>     
      <div class="col-sm-5" id="containery"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerz"></div>
      <div class="col-sm-5" id="containeraa"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>      
      <div class="col-sm-10" id="containerab"></div>
      <div class="col-sm-1"></div>
    </div>
    <div id="titulo" class="text-center"><h1>INFRAESTRUCTURA VEREDAL</h1></div>
    <div class="row">     
      <div class="col-sm-1"></div>
      <div class="col-sm-5" id="containerac"></div>
      <div class="col-sm-5" id="containerad"></div>      
      <div class="col-sm-1"></div>
    </div>
    <div class="row">     
      <div class="col-sm-1"></div>      
      <div class="col-sm-5" id="containerae"></div>
      <div class="col-sm-5" id="containeraf"></div>
      <div class="col-sm-1"></div>
    </div>
    <div class="row">         
      <div class="col-sm-1"></div>      
      <div class="col-sm-10" id="containerag"></div>
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

  <script src="assets/js/html2canvas.js"></script>
  <script src="assets/js/canvas2image.js"></script>

  <!-- librerias para q funcione el segundo ejemplo
  <script src="assets/js/jspdf.debug.js"></script>
  <script src="assets/js/html2pdf.js"></script>-->
  
  <script>
    $(document).ready(function() {
      var chart1, chart2;
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
        $('#genestadisticpdf').hide();      
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
        $('#genestadisticpdf').hide();        
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
        $('#genestadisticpdf').hide();               
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
        $('#genestadisticpdf').show();  
        $('#reporte').css("display","block");
        $.ajax({
          url:"siscadi/reporestadtotal",
          type:"POST",
          data:{dpto:$('#seldpto').val(),mpio:$('#selmpio').val(),vere:$('#selvda').val()},
          dataType:'json',
          
          success:function(data){
            //se actuliaza la ficah tecnica
            $('#table_consulta').empty();
            console.log(data['ficha_tecnica'])

            var thead = document.createElement("thead");

            var y = document.createElement("TR");
            y.className="text-primary";
            y.setAttribute("data-toggle","tooltip");
            y.setAttribute("data-placement","top");
            thead.appendChild(y);

            var th = document.createElement("TH");
            var t = document.createTextNode("No. de encuestas");
            th.appendChild(t);
            y.appendChild(th);
            thead.appendChild(y);
          
            var th = document.createElement("TH");
            var t = document.createTextNode("Fecha de recolección");
            th.appendChild(t);
            y.appendChild(th);
            thead.appendChild(y);

            var th = document.createElement("TH");
            var t = document.createTextNode("Endidad que realizó la recolección");
            th.appendChild(t);
            y.appendChild(th);
            thead.appendChild(y);

            var th = document.createElement("TH");
            var t = document.createTextNode("Método de recolección");
            th.appendChild(t);
            y.appendChild(th);
            thead.appendChild(y);
            document.getElementById('table_consulta').appendChild(thead);

            var tbody = document.createElement("tbody");
            tbody.setAttribute("id", "body_table_consulta");
            document.getElementById('table_consulta').appendChild(tbody);

            //ficha tecnica 

            $(".text-center").show();
            $('#subtitulo1').show();
            $('#subtitulo2').show();
            var obj=data['ficha_tecnica'];
            Object.keys(obj).forEach(function(key) {
            var Fecha_desde=[];
            var Fecha_Hasta=[];
            var metodo="";
              Object.keys(data['ficha_tecnica'][key]).forEach(function(key2) {
                
                if (obj[key][key2]){
                  Fecha_desde.push(new Date(obj[key][key2]['Fecha_Desde']));
                  Fecha_Hasta.push(new Date(obj[key][key2]['Fecha_Hasta'] ));
                  metodo=obj[key][key2]['Metodo']
                }
              });

              var maxFecha_desde_array=new Date(Math.max.apply(null,Fecha_Hasta));
              var minFecha_desde_array=new Date(Math.min.apply(null,Fecha_desde));
              var maxFecha_desde=maxFecha_desde_array.getUTCDate() +"-"+ (maxFecha_desde_array.getUTCMonth()+1) +"-"+ maxFecha_desde_array.getUTCFullYear();
              var minFecha_desde=minFecha_desde_array.getUTCDate() +"-"+ (minFecha_desde_array.getUTCMonth()+1) +"-"+ minFecha_desde_array.getUTCFullYear();

              var y = document.createElement("TR");
              y.setAttribute("id", key);
              document.getElementById("body_table_consulta").appendChild(y);

              var z = document.createElement("TD");
              var t = document.createTextNode(Object.keys(obj[key]).length);
              z.appendChild(t);
              document.getElementById(key).appendChild(z);

              var z = document.createElement("TD");
              var t = document.createTextNode("Desde el "+minFecha_desde+" hasta el "+maxFecha_desde);
              z.appendChild(t);
              document.getElementById(key).appendChild(z);

              var z = document.createElement("TD");
              var t = document.createTextNode(key);
              z.appendChild(t);
              document.getElementById(key).appendChild(z);

              var z = document.createElement("TD");
              var t = document.createTextNode(metodo);
              z.appendChild(t);
              document.getElementById(key).appendChild(z);

            });

            if ( $.fn.dataTable.isDataTable( '#table_consulta' ) ) {
              table2.destroy();
              table2 = $('#table_consulta').DataTable( {
                } );
            }else {
              table2 = $('#table_consulta').DataTable( {
              });
            }
            var categories = data.categories;
            chart1 = Highcharts.chart('containera', {
            //$('#containera').highcharts({
              chart: {
                  type: 'bar'
              },
              title: {
                  text: '1. Población por grupo de edades'
              },
              subtitle: {
                  text: 'Población total: '+data['ficha_pobla_edad'][0]+" <br> ("+data['ficha_pobla_edad'][1]+ " hombres y "+ data['ficha_pobla_edad'][2]+" mujeres)"
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
            chart2 = Highcharts.chart('containerb', {
            //$('#containerb').highcharts({
              chart: {
                  type: 'bar'
              },
              title: {
                  text: '2. Jefatura de hogar por grupo de edades'
              },
              subtitle: {
                  text: 'Total de hogares: '+data['ficha_jefatu_edad'][0]+" <br>("+data['ficha_jefatu_edad'][1]+ " Jefatura masculina y "+ data['ficha_jefatu_edad'][2]+" Jefatura femenina)"
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
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.razones)
              }]
            });
            document.getElementById("containerf").innerHTML = '<p class="text-justify">El <b>'+data.embarazoparto+'%</b> de las mujeres se encuentran en estado de embarazo o están lactando.</p><p class="text-justify">El <b>'+data.discapacidad+'%</b> de la población presenta alguna discapacidad.</p><p class="text-justify">El <b>'+data.analfabetismotot+'%</b> de la población mayor de 15 años encuestada no sabe leer, ni escribir.  <b>'+data.analfabetismomtot+'%</b> Mujeres – <b>'+data.analfabetismohtot+'%</b> Hombres</p><p class="text-justify">Promedio de personas en los hogares encuestados <b>'+data.promperhoga+'</b></p><p class="text-justify">El <b>'+data.primer_infancia+'% </b> de la población de los hogares encuestados está en la primera infancia</p>';

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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
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
              credits: {
                enabled: false
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
                  categories: Object.keys(data.vinculacionci)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.vinculacionci)
              }]
            });
            $('#containerm').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '3. Relación con los cultivos ilícitos'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.relacionci)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.relacionci)
              }]
            });
            
            document.getElementById("containern").innerHTML = '<h4>4. Área de cultivos ilícitos reportada por los encuestados</h4><h1 class="text-center">'+data.hacultiilictot+' hectáreas</h1><h4>Tamaño promedio de los lotes: <b>'+data.hacultiilicprom+' hectáreas</b></h4><h4>Ingreso promedio mensual neto por hectárea de un cultivador de coca: <b>$'+data.ingrepromcultcocatot+'</b></h4>';            
            $('#containero').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'                 
              },
              title: {
                  text: ' '
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
              },                          
              plotOptions: {
                  pie: {
                      innerSize: 50,                      
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.0f} %'                         
                      }
                  }                  
              },
              series: [{
                  name: ' ',
                  data: data.rangoipmtot
              }]
            });            
            $('#containerp').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'                    
              },
              title: {
                  text: ' '
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
              },                          
              plotOptions: {
                   pie: {
                      innerSize: 50,                      
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.0f} %'                         
                      }
                  } 
              },
              series: [{
                  name: ' ',
                  data: data.pobresinotot
              }]
            });
            document.getElementById("containerq").innerHTML = '<blockquote><p><b>NPVP*</b> = No pobre - Vulnerable a la pobreza.</p><p class="text-justify">El <b>'+data.sgssstot+'%</b> de la población encuestada está afiliada al sistema de seguridad social.</p><p class="text-justify">El <b>'+data.poblestudiatot+'%</b> de la población en edad de asistir a la escuela lo hace.</p><p class="text-justify">El <b>'+data.saludhogartot+'%</b> de los hogares encuestados tiene acceso a servicios de salud en hospital  o centro de salud.</p><p class="text-justify">El <b>'+data.infantrabaja+'%</b> de la población infantil entre 6 y 9 años se encuentra trabajando.</p><p class="text-justify">El <b>'+data.energhogartot+'%</b> de los hogares encuestados cuenta con energía eléctrica.</p></blockquote>';
            $('#containerr').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'                   
              },
              title: {
                  text: ' '
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
              },                          
              plotOptions: {
                   pie: {
                      innerSize: 50,                      
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.0f} %'                         
                      }
                  } 
              },
              series: [{
                  name: ' ',
                  data: data.rangopmtot
              }]
            });
            $('#containers').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'                   
              },
              title: {
                  text: ' '
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
              },              
              plotOptions: {
                   pie: {
                      innerSize: 50,                      
                      allowPointSelect: true,
                      cursor: 'pointer',
                      dataLabels: {
                          enabled: true,
                          format: '<b>{point.name}</b>: {point.percentage:.0f} %'                         
                      }
                  } 
              },
              series: [{
                  name: ' ',
                  data: data.hogarespobratot
              }]
            });
            document.getElementById("containert").innerHTML = '<blockquote><p class="text-justify">El <b>'+data.pobrepoblatot+'%</b> de la población encuestada se considera pobre.</p><p class="text-justify">El <b>'+data.edadtrabaja+'%</b> de la población en edad laboral se encuentra trabajando.</p><p class="text-justify">El <b>'+data.huertascasetot+'%</b> de la población encuestada cuenta con huertas caseras y cultivos para el autoconsumo.</p></blockquote>';
            $('#containeru').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '1. Actividades productivas principales'
              },              
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.y}%</b>'
              },               
              xAxis: {
                  categories: Object.keys(data.lineapptot)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },              
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.lineapptot)
              }]
            });
            $("#containeru").append('<h1><b>'+data.haprodagrotot+' hectáreas</b></h1><h4>Destinadas a la producción agropecuaria</h4>');
            $('#containerv').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: '2. Acceso a capacitaciones y/o asistencia técnica'
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
              xAxis: {
                  categories: Object.keys(data.accesocat)
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },                          
              series: [{
                  name: ' ',
                  data: Object.values(data.accesocat)
              }]
            }); 
            $('#containerw').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '3. Venta de productos de las actividades productivas'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.ventasproduc)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.ventasproduc)
              }]
            });     
            
            $('#containerespe').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '4. Especies menores para el autoconsumo'
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{point.percentage:.0f}%'
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
                  data: data.espemenores
              }]
            }); 

            $('#containerpeces').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '5. Piscicultura para el autoconsumo'
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{point.percentage:.0f}%'
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
                  data: data.peces
              }]
            }); 


            $('#containerganado').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '6. Ganadería para el autoconsumo'
              },
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{point.percentage:.0f}%'
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
                  data: data.ganado
              }]
            }); 

            $('#containerdondevive').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '1. Lugar de residencia, población encuestada'
              },
              credits: {
                enabled: false
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
                  data: data.donde_vive
              }]
            });

            $('#containerx').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '2. Relación de tenencia de la tierra según los encuestados'
              },
              credits: {
                enabled: false
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
                  data: data.relacionprediotot
              }]
            });

            $('#containery').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '3. Participación en procesos de formalización de la propiedad'
              },
              credits: {
                enabled: false
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
                  data: data.formalizprediotot
              }]
            });
            $('#containerz').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '4. Participación en actividades relacionadas con la conservación'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.actividpartici)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.actividpartici)
              }]
            });
            $('#containeraa').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '5. Acuerdos ambientales que existen en la comunidad'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.acuerdoambien)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.acuerdoambien)
              }]
            });
            $('#containerab').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '6. Implementación de prácticas agrícolas'
              },              
              credits: {
                enabled: false
              },
              xAxis: {
                  categories: Object.keys(data.practicaambien)
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
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.practicaambien)
              }]
            });
            $('#containerac').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '1. Existencia de vías de acceso terrestre'
              },
              credits: {
                enabled: false
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
                  data: data.viasaccesotot
              }]
            });
            $('#containerad').highcharts({
              chart: {
                  type: 'column'
              },
              title: {
                  text: '2. Estado de las vías de acceso'
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
              xAxis: {
                  categories: Object.keys(data.estadoviastot)
              },
              plotOptions: {
                  column: {
                      pointPadding: 0.2,
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },                          
              series: [{
                  name: ' ',
                  data: Object.values(data.estadoviastot)
              }]
            });             
            $('#containerae').highcharts({
              chart: {
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false,
                  type: 'pie'
              },
              title: {
                  text: '3. Tipo de transporte utilizado'
              },
              credits: {
                enabled: false
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
                  data: data.topitransptot
              }]
            });
            $('#containeraf').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '4. Disponibilidad de agua para el consumo'
              },              
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.y}%</b>'
              },               
              xAxis: {
                  categories: Object.keys(data.obtenaguatot)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },              
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.obtenaguatot)
              }]
            });
            $('#containerag').highcharts({              
              chart: {
                  type: 'bar'
              },
              title: {
                text: '5. Disponibilidad de agua para las actividades productivas'
              },              
              credits: {
                enabled: false
              },
              tooltip: {
                  pointFormat: '{series.name}: <b>{point.y}%</b>'
              },               
              xAxis: {
                  categories: Object.keys(data.obtenaguaaptot)
              },
              yAxis: {
                  min: 0,
                  title: {
                      text: 'Porcentaje (%)'
                  }
                  
              },              
              legend: {
                  reversed: true,
                  enabled: false
              },
              plotOptions: {
                  series: {
                      stacking: 'normal',
                      dataLabels: {
                          enabled: true,
                          format: '{point.y:.0f}%'
                      }
                  }
              },              
              series: [{
                  name: ' ',
                  data: Object.values(data.obtenaguaaptot)
              }]
            });
          //terminalos contenedores de graficas practicaambien
 
          }, 
          error:function(){alert('error');}
        });//Termina Ajax 
      });//Termina change genestadistic
      $("#genestadisticpdf").on('click', function(){
        $("#sha").removeClass("container");
        $("#sha").addClass("container-fluid");
        //$("div").removeClass("col-sm-1");
        $('#genestadisticpdf').hide();       
        
        window.print();        
        

/*        
        //este es un ejemplo pero higchart se daña
        html2canvas($("body"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("#uno").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
*/
/*
        // segundo ejemplo 
        var pdf = new jsPDF('p', 'pt', 'letter');
        var canvas = pdf.canvas;
        canvas.height = 72 * 11;
        canvas.width= 72 * 8.5;;

        // can also be document.body
       

        html2pdf(document.body, pdf, function(pdf) {
                pdf.output('save', 'estadisticas.pdf');                
        });
*/
/*
        //console.log(document.body.innerHTML);
        var a =  document.body.innerHTML;
        $.ajax({url:"siscadi/generarpfd",type:"POST",data:{cuerpo:a},dataType:'json',        
          success:function(data){             
            console.log(data);
          },
          error:function(){alert('error');}
        });//Termina Ajax 
*/
        $("#uno").hide();
        $('#genestadisticpdf').show();
        $("#sha").removeClass("container-fluid");
        $("#sha").addClass("container");
        
       
        /*
        



        //otro ejemplo
        html2canvas($("body"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("#uno").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });
        //

        
        //

        //otro ejemplo
        html2canvas($("body"), {
            onrendered: function(canvas) {
                theCanvas = canvas;
                document.body.appendChild(canvas);

                // Convert and download as image 
                Canvas2Image.saveAsPNG(canvas); 
                $("#img-out").append(canvas);
                // Clean up 
                //document.body.removeChild(canvas);
            }
        });


        $( window ).resize(function() {
          $( "body" ).css( "width: 21cm" );
        });
        html2canvas($("#sha"), {
          onrendered: function(canvas) {
            var canvasImg = canvas.toDataURL("image/jpg");
            $('#uno').html('<img id="mainImg" src="'+canvasImg+'" alt="">');
            //document.getElementById("muestra").appendChild(canvas);            
          }
        });
        */
      });

    });    
  </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->