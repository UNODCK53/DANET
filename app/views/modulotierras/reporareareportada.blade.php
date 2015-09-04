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
              @foreach($arraydpto as $pro)
                  <option value="{{$pro->cod_dpto}}">{{$pro->nom_dpto}}</option>
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
      <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
    </div>


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
<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
    <script>
    



      $(document).ready(function() {

          $( "#tierras" ).addClass("active");
          $( "#reporarearepor" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasreporarearepormenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Area Levantada</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);


        $("#labelmpio").hide();
        $("#selmpio").hide();
        $("#labelvda").hide();
        $("#selvda").hide();
         
          $("#seldpto").change(function(){
            var datos = ($('#seldpto').val());
            
                $.ajax({
                    url:"tierras/reporarealevantadampio",
                    type:"POST",
                    data: {dpto: $('#seldpto').val()},
                    dataType:'json',
                    success:function(data1){
                        $("#labelmpio").show();
                        $("#selmpio").show();
                        $("#selmpio").empty();
                        $("#selmpio").append("<option value=''>Por favor seleccione</option>");
                        $.each(data1[0], function(nom,datos){
                          
                        $("#selmpio").append("<option value=\""+datos.cod_mpio+"\">"+datos.nom_mpio+"</option>");
                        });
                    },
                    error:function(){
                        alert('error');
                    }
                });//Termina Ajax prueva
          });//Termina chage seldpto

          $("#selmpio").change(function(){
                $.ajax({
                    url:"tierras/reporarealevantadavda",
                    type:"POST",
                    data: {mpio: $('#selmpio').val()},
                    dataType:'json',
                    success:function(data){
                        $("#labelvda").show();
                        $("#selvda").show();
                        $("#selvda").empty();
                        $("#selvda").append("<option value=''>Por favor seleccione</option>");
                        [].forEach.call(data[0],function(datos){
                            $("#selvda").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
                        });
                        //console.log(valores)
                        $('#container').highcharts({
                          chart: {
                              plotBackgroundColor: null,
                              plotBorderWidth: null,
                              plotShadow: false,
                              type: 'pie'
                          },
                          title: {
                              text: 'Área formalizada'
                          },
                          tooltip: {
                              pointFormat: '{series.name}: <b>{point.percentage:.1f} %</b>'
                          },
                          plotOptions: {
                              pie: {
                                  allowPointSelect: true,
                                  cursor: 'pointer',
                                  dataLabels: {
                                      enabled: true,
                                      format: '<b>{point.name}</b>:{point.y:.2f} ha',
                                      style: {
                                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                      }
                                  }
                              }
                          },
                          series: [{
                              name: "Área",
                              colorByPoint: true,
                              data: [{name: "Área total preliminar",
                                      y: Number(data[1])},
                                      {name: "Área total formalizada",
                                      y: Number(data[2])}
                                    ]
                          }]
                        });
                    },
                    error:function(){
                        alert('error');
                    }
                });//Termina Ajax prueva
          });//Termina chage selmpio

          ("#selvda").change(function(){
            
                $.ajax({
                    url:"tierras/reporarealevantadavda",
                    type:"POST",
                    data: {vda: $('#selvda').val()},
                    dataType:'json',
                    success:function(data3){
                        $.each(data3, function sd(nom,datos){
                        $("#selvd").append("<option value=\""+datos.cod_unodc+"\">"+datos.nombre1+"</option>");
                        al = datos.cod_unodc;
                        });
                    },
                    error:function(){
                        alert('error');
                    }
                });//Termina Ajax prueva
          });//Termina chage seldpto


          //para que los menus pequeño y grande funcione
          

      });//Termina document ready

    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->


