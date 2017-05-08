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
    <h2 class="text-center text-primary">Censo de familias</h2>
	<br><br>
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
      <b class="lead text-justify">Reporte de sincronización de encuestas de diagnóstioco de hogar y Anexo de Tierras   </b>
      <a class="glyphicon glyphicon-download-alt btn btn-success" title="Descarque el archvio del Criterio" href="\art\Rep_encuestas.pdf" target="_blank"></a>
    </div>
    <div class="col-sm-1"></div>
	<br><br><hr>
  <h3 class="text-center text-primary">Resultados detalaldos de recolección de encuestas digitales</h3>
  <br>
  <div class="row"> 
    <div class="col-sm-1"></div> 
    <div class="col-sm-2">
        <label id="labelindicador" for="Proceso" class="control-label">Tipo de Indicadores:</label>
    </div> 
    <div class="col-sm-2">
          <input type="radio" name="indicador" id="indicador1" value="1" required>General
    </div> 
    <div class="col-sm-1"></div> 
    <div class="col-sm-2">
          <input type="radio"  name="indicador" id="indicador2" value="2" required>Por Usuario
    </div> 
    <div class="col-sm-1"></div> 
  </div> 
  <br>
  <div class="row" id="General" style="display:none;">       
    
    <div class="col-sm-1"></div>   
    <div class="col-sm-3" id="General-depto"style="display:none;">
        <label id="labeldpto" for="Proceso" class="control-label">Departamento:</label>
        <select id="seldpto" class="form-control" name="seldpto">
          <option value="" selected="selected">Por favor seleccione</option>
          @foreach($depto as $key=>$val) 
             <option value="{{$key}}"> {{$val}}</option>                    
          @endforeach 
        </select>
    </div>  
    <div class="col-sm-3" id="General-mpio"style="display:none;">
        <label id="labelmpio" for="Proceso" class="control-label">Municipio:</label>
        <select id="selmpio" class="form-control" name="selmpio">
        </select>
    </div>
    <div class="col-sm-3" id="General-vda"style="display:none;">
        <label id="labelvda" for="Proceso" class="control-label">Vereda:</label>
        <select id="selvda" class="form-control" name="selvda">
        </select>
    </div> 
    <div class="col-sm-1"></div>
  </div>

  <div class="row" id="Usuario" style="display:none;">       
      <div class="col-sm-1"></div>
      <div class="col-sm-3" id="Usuario-usuar"style="display:none;">
        <label id="labelmonitor" for="Proceso" class="control-label">Usuario:</label>
        <select id="selmonitor" class="form-control" name="selmonitor">
            <option value="" selected="selected">Por favor seleccione</option>
          @foreach($usuario as $key=>$val) 
             <option value="{{$key}}"> {{$val}}</option>                    
          @endforeach 
        </select>
      </div>
      <div class="col-sm-2" id="Usuario-depto"style="display:none;">
          <label id="labeldptomoni" for="Proceso" class="control-label">Departamento:</label>
          <select id="seldptomoni" class="form-control" name="seldptomoni">
          </select>
      </div> 
      <div class="col-sm-2" id="Usuario-mpio"style="display:none;">
          <label id="labelmpiomoni" for="Proceso" class="control-label">Municipio:</label>
          <select id="selmpiomoni" class="form-control" name="selmpiomoni">
          </select>
      </div>  
      <div class="col-sm-3" id="Usuario-vda"style="display:none;">
          <label id="labelvdamoni" for="Proceso" class="control-label">Vereda:</label>
          <select id="selvdamoni" class="form-control" name="selvdamoni">
          </select>
      </div>  
      <div class="col-sm-1"></div>  
  </div> 
  <br><br>
  <div class="col-sm-12">
    <div id="container" class="col-sm-12"></div>
    <div class="col-sm-1"></div>
    <div id="map" class="col-sm-4"></div>
  </div>
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
@section('jsbody')
  @parent
  <script src="assets/js/highcharts/highcharts.js"></script>
    <script>
      $(document).ready(function() {          
          //para que los menus pequeño y grande funcione
          $( "#art" ).addClass("active");
          $( "#artdashboardmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#artdashboardmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Dashboard</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
      });

      $('input:radio[name=indicador]').change(function() {
        var indi = document.querySelector('input[name="indicador"]:checked').value;
        if(indi=='1'){
          $("#container").attr('class', 'col-sm-12');
          $("#General").css("display","block");
          $("#General-depto").css("display","block");
          $("#Usuario").css("display","none");
          $("#Usuario-usuar").css("display","none");

          $('#seldpto').val("");
          $("#General-mpio").css("display","none");
          $("#General-vda").css("display","none");


          nacional=<?php echo json_encode($nacional); ?>;
          Highcharts.chart('container', {
              chart: {
                  type: 'column'
              },
              title: {
                  text: 'Total de encuestas realizadas a nivel nacional, 2017'
              },
              xAxis: {
                  type: 'category'
              },
              yAxis: {
                  title: {
                      text: '# de encuestas'
                  }

              },
              legend: {
                  enabled: false
              },
              plotOptions: {
                  series: {
                      borderWidth: 0,
                      dataLabels: {
                          enabled: true,
                          format: '{point.y}'
                      }
                  }
              },

              tooltip: {
                  headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                  pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
              },

              series: [{
                  name: 'Encuestas capturadas en campo',
                  colorByPoint: true,
                  data: [{
                      name: 'Diagnóstico del hogar para renovación y transformación integral',
                      y: nacional[0]
                  }, {
                      name: 'Anexo línea base para formalización de tierras',
                      y: nacional[1]
                  }]
              }]
          });
        }else{
          $("#container").attr('class', 'col-sm-12');
          $("#Usuario").css("display","block");
          $("#Usuario-usuar").css("display","block");
          $("#General").css("display","none");
          $("#General-depto").css("display","none");

          $('#selmonitor').val("");
          $("#Usuario-depto").css("display","none");
          $("#Usuario-mpio").css("display","none");
          $("#Usuario-vda").css("display","none");

          usuario_datos=<?php echo $usuario_datos; ?>;
          Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Encuestas realizadas por Usuario a nivel Nacional'
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: -45,
                    style: {
                        fontSize: '10px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '# de encuestas'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions:{
                series:{
                    turboThreshold:0//larger threshold or set to 0 to disable
                }
            },
            tooltip: {
                pointFormat: 'Encuestas realizadas: <b>{point.y}</b>'
            },
            series: [{
                name: 'Usuario',
                data: usuario_datos
            }]
          });
        }
      });
//## graficas general
      //grafica segun departamento      
      $("#seldpto").change(function(){
        if($('#seldpto').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
            $("#General-mpio").css("display","none");
            $("#General-vda").css("display","none");
            var nacional=<?php echo json_encode($nacional); ?>;
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas a nivel nacional, 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: nacional[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: nacional[1]
                    }]
                }]
            });
           
        }else{
            $("#General-vda").css("display","none");
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-gene-depto",type:"POST",data:{depto:$('#seldpto').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#General-mpio").css("display","block");
              $("#selmpio").empty();
              $("#selmpio").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selmpio").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#seldpto option:selected").text()+', 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage seldpto

      //grafica segun municipio      
      $("#selmpio").change(function(){
        if($('#selmpio').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
          $("#General-vda").css("display","none");
           $.ajax({url:"artdashboard/diag-fami-gene-depto",type:"POST",data:{depto:$('#seldpto').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#General-mpio").css("display","block");
              $("#selmpio").empty();
              $("#selmpio").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selmpio").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#seldpto option:selected").text()+', 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
           
        }else{
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-gene-muni",type:"POST",data:{depto:$('#selmpio').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#General-vda").css("display","block");
              $("#selvda").empty();
              $("#selvda").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selvda").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmpio option:selected").text()+' ('+$("#seldpto option:selected").text()+'), 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage selmpio


      //grafica segun vereda      
      $("#selvda").change(function(){
        if($('#selvda').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
           $.ajax({url:"artdashboard/diag-fami-gene-muni",type:"POST",data:{depto:$('#selmpio').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#General-vda").css("display","block");
              $("#selvda").empty();
              $("#selvda").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selvda").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmpio option:selected").text()+' ('+$("#seldpto option:selected").text()+'), 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
           
        }else{
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-gene-vda",type:"POST",data:{depto:$('#selvda').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              console.log(data1)
             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selvda option:selected").text()+' ('+$("#selmpio option:selected").text()+', '+$("#seldpto option:selected").text()+'), 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage selmpio
//### fin de graficas general

//### inicio de graficas por usuario

    //grafica segun departamento      
      $("#selmonitor").change(function(){
        if($('#selmonitor').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
             $("#container").attr('class', 'col-sm-12');
              $("#Usuario-depto").css("display","none");
              $("#Usuario-mpio").css("display","none");
              $("#Usuario-vda").css("display","none");

              usuario_datos=<?php echo $usuario_datos; ?>;
              Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Encuestas realizadas por Usuario a nivel Nacional'
                },
                xAxis: {
                    type: 'category',
                    labels: {
                        rotation: -45,
                        style: {
                            fontSize: '10px',
                            fontFamily: 'Verdana, sans-serif'
                        }
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: '# de encuestas'
                    }
                },
                legend: {
                    enabled: false
                },
                plotOptions:{
                    series:{
                        turboThreshold:0//larger threshold or set to 0 to disable
                    }
                },
                tooltip: {
                    pointFormat: 'Encuestas realizadas: <b>{point.y}</b>'
                },
                series: [{
                    name: 'Usuario',
                    data: usuario_datos
                }]
              });
           
        }else{
            $("#Usuario-depto").css("display","block");
              $("#Usuario-mpio").css("display","none");
              $("#Usuario-vda").css("display","none");
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-usua-usua",type:"POST",data:{usuario:$('#selmonitor').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#seldptomoni").empty();
              $("#seldptomoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['depto'], function(nom,datos){
                $("#seldptomoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val'];
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmonitor option:selected").text()+', 2017'
                },
                
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage seldpto

    //grafica segun departamento      
      $("#seldptomoni").change(function(){
        if($('#seldptomoni').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
            $("#Usuario-mpio").css("display","none");
            $("#Usuario-vda").css("display","none");

          $.ajax({url:"artdashboard/diag-fami-usua-usua",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#seldptomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#seldptomoni").empty();
              $("#seldptomoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['depto'], function(nom,datos){
                $("#seldptomoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val'];
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmonitor option:selected").text()+', 2017'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
           
        }else{
            $("#Usuario-mpio").css("display","block");
              $("#Usuario-vda").css("display","none");
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-usua-depto",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#seldptomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#selmpiomoni").empty();
              $("#selmpiomoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selmpiomoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#seldptomoni option:selected").text()+', 2017'
                },
                subtitle: {
                    text: 'Realizadas por:'+$("#selmonitor option:selected").text()
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage seldpto

      //grafica segun municipio      
      $("#selmpiomoni").change(function(){
        if($('#selmpiomoni').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
          $("#Usuario-vda").css("display","none");
           $.ajax({url:"artdashboard/diag-fami-usua-depto",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#seldptomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#selmpiomoni").empty();
              $("#selmpiomoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selmpiomoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#seldptomoni option:selected").text()+', 2017'
                },
                subtitle: {
                    text: 'Realizadas por:'+$("#selmonitor option:selected").text()
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
           
        }else{
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-usua-muni",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#selmpiomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#Usuario-vda").css("display","block");
              $("#selvdamoni").empty();
              $("#selvdamoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selvdamoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmpiomoni option:selected").text()+' ('+$("#seldptomoni option:selected").text()+'), 2017'
                },
                subtitle: {
                    text: 'Realizadas por:'+$("#selmonitor option:selected").text()
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage selmpio


      //grafica segun vereda      
      $("#selvdamoni").change(function(){
        if($('#selvdamoni').val()=='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no vuelve a calcular la grafica anterior
        {
           $.ajax({url:"artdashboard/diag-fami-usua-muni",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#selmpiomoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              $("#Usuario-vda").css("display","block");
              $("#selvdamoni").empty();
              $("#selvdamoni").append("<option value=''>Por favor seleccione</option>");
              $.each(data1['muni'], function(nom,datos){
                $("#selvdamoni").append("<option value=\""+nom+"\">"+datos+"</option>");
              });

             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selmpiomoni option:selected").text()+' ('+$("#seldptomoni option:selected").text()+'), 2017'
                },
                subtitle: {
                    text: 'Realizadas por:'+$("#selmonitor option:selected").text()
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
           
        }else{
          //crea la grafica a un nivel mas detalaldo
          $.ajax({url:"artdashboard/diag-fami-usua-vda",type:"POST",data:{usuario:$('#selmonitor').val(),depto:$('#selvdamoni').val()},dataType:'json',//llama al controlador siscadi/siscadiinter que trae los valores necesario para la grafica
            success:function(data1){
              console.log(data1)
             var depto_val=data1['depto_val']; 
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total de encuestas realizadas en '+$("#selvdamoni option:selected").text()+' ('+$("#selmpiomoni option:selected").text()+', '+$("#seldptomoni option:selected").text()+'), 2017'
                },
                subtitle: {
                    text: 'Realizadas por:'+$("#selmonitor option:selected").text()
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: '# de encuestas'
                    }

                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    series: {
                        borderWidth: 0,
                        dataLabels: {
                            enabled: true,
                            format: '{point.y}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> encuestas<br/>'
                },

                series: [{
                    name: 'Encuestas capturadas en campo',
                    colorByPoint: true,
                    data: [{
                        name: 'Diagnóstico del hogar para renovación y transformación integral',
                        y: depto_val[0]
                    }, {
                        name: 'Anexo línea base para formalización de tierras',
                        y: depto_val[1]
                    }]
                }]
            });
              
         //Termina function highchart
            },
            error:function(){alert('error');}
          });//Termina Ajax prueva
        }
      });//Termina chage selmpio
//### fin de graficas por usuario
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->