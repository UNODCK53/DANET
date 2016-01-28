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
      <div class="col-sm-1"></div>
      <div class="col-sm-10">
        <h2 class="text-center text-primary">Administración de vistas</h2>
        
        <?php $status=Session::get('status'); ?>
        @if($status=='ok_estatus')
        
        <div class="col-sm-1"></div>    
        <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
        <i class="bg-success"></i>Actualización éxitosa</div>
        <div class="col-sm-1"></div>
        @endif
        @if($status=='error_estatus')
        
        <div class="col-sm-1"></div>    
        <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
        <i class="bg-danger"></i> No se pudo actualizar</div>
        <div class="col-sm-1"></div>
        @endif
      </div>
      <div class="col-sm-1"></div>
          <form role="form" action="admin/guardavistas" method="post" id="guardarvistas" enctype="multipart/form-data">
            <div class="row">
              <div class="col-sm-6">
                <div class="col-sm-1"></div>
                <div class="col-sm-11" id="sha">
                  <!--aca se escribe el codigo-->
                  <div class="form-group">
                    <br>
                    <label for="carguedocu" class="control-label">Modificación por:</label><br>
                    <input type="radio" name="modradiousu" id="grupo" value="1" required> Grupo
                    <input type="radio" name="modradiousu" id="individual" value="2" required> Usuario
                    <br>
                  </div>
                  <div class="form-group">
                    <label for="carguedocu" class="control-label"> Seleccione Grupo/usuario:</label>
                    <select id="selmodificar" class="form-control" name="selmodificar" required>
                    </select>
                  </div>                  
                  <div class="form-group" id="selmodificarleveldiv">
                    <label for="carguedocu" class="control-label"> Seleccione tipo de usuario:</label>
                    <select id="selmodificarlevel" class="form-control" name="selmodificarlevel" required>
                    </select>
                  </div>
                  <br>
                </div>
                <!--fin del codigo-->
              </div>
              <div class="col-sm-6">
                <div class="col-sm-11" id="sha">
                <!--aca se escribe el codigo-->
                  <br/>
                  <div class="form-group" id="listavistas">
                    <label for="carguedocu" class="control-label">Listado de vistas:</label><br>
                    <div class="btn-group-vertical" role="group" aria-label="...">
                      <div class="checkbox" id="checkboxvistas">
                        
                      </div>
                    </div>
                    <br>
                  </div>
                <!--fin del codigo-->
                </div>
                <div class="col-sm-1"></div>
              </div>
            </div>
            <div class="row">
              <div class="form-group text-center"  id="carguedocumento">
                <br/>
                <button id="guardarvistas" type="submit" class="btn btn-primary">Guardar permisos</button>
                <br/>
                <span class="label label-warning" id="a"></span>
              </div>
            </div>
          </form>
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
    <script>
      $(document).ready(function(){
        //para que los menus pequeño y grande funcione
        $( "#admin" ).addClass("active");
        $( "#adminvistas" ).addClass("active");
        $( "#iniciomenupeq" ).html("<small>INICIO</small>");
        $( "#adminmenupeq" ).html("<strong>MÓDULO ADMINISTRACIÓN<span class='caret'></span></strong>");
        $( "#adminvistasmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Acceso vistas</strong>");
        $( "#mensajeestatus" ).fadeOut(5000);
        $("#selmodificarlevel").prop('required', true);
        $('#selmodificar').prop('disabled', true);
        $('#selmodificarleveldiv').hide();
        $("#individual").click(function(){
          $('#selmodificarleveldiv').hide();
          $('#selmodificarlevel').empty();
          $('#selmodificar').prop('disabled', false);
          $.ajax({url:"admin/individual",type:"POST",data:{},dataType:'json',
            success:function(data){
              $("#selmodificar").empty();
              $("#selmodificar").append("<option value=''>Por favor seleccione</option>");
              $.each(data, function(nom,datos){
                $("#selmodificar").append("<option value=\""+datos.id+"\">"+datos.username+"</option>");
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax individuak
        });//Termina click individual
        $("#grupo").click(function(){
          $("#guardarvistas").prop('disabled', true);
          $('#selmodificar').prop('disabled', false);
          $("#selmodificarlevel").prop('required', true);
          $.ajax({url:"admin/grupo",type:"POST",data:{},dataType:'json',
            success:function(data1){
              $("#selmodificar").empty();
              $("#selmodificar").append("<option value=''>Por favor seleccione</option>");
              $.each(data1, function(nom,datos){
                $("#selmodificar").append("<option value=\""+datos.id+"\">"+datos.nom_grupo+"</option>");
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax grupo
        });//Termina click grupo
        $("#selmodificar").change(function(){
          $('#checkboxvistas').empty();
          $("#selmodificarlevel").empty();
          $("#selmodificarlevel").append("<option value=''>Por favor seleccione</option>");
          var grupo = document.getElementById('grupo').checked;
          var individual = document.getElementById('individual').checked;
          if(grupo==true){
            $('#selmodificarleveldiv').show();
            $.ajax({url:"admin/vistalevel",type:"POST",data:{},dataType:'json',
              success:function(data3){              
                $.each(data3, function(nom,datos){
                  $("#selmodificarlevel").append("<option value=\""+datos.id+"\">"+datos.nom_level+"</option>");
                });
              },
              error:function(){alert('error');}
            });//Termina Ajax vistagrupo
          }
          else if(individual==true){
            $('#selmodificarleveldiv').hide();
            $('#selmodificarlevel').empty();
            $.ajax({url:"admin/accindividual",type:"POST",data:{usu:$('#selmodificar').val()},dataType:'json',
              success:function(data2){
                $.each(data2, function(nom,datos){
                  if(datos.acces == "0"){
                  $("#checkboxvistas").append("<label><input type='checkbox' name='selectvistas[]' value=\""+datos.vista+"\" >"+datos.nom_vista+"</label><br>");
                  }
                  else{
                   $("#checkboxvistas").append("<label><input type='checkbox' name='selectvistas[]' value=\""+datos.vista+"\" checked>"+datos.nom_vista+"</label><br>"); 
                  }
                });
              },
              error:function(){alert('error');}
            });//Termina Ajax vistaindividual
            $('#selmodificarlevel').removeAttr('required');
          }
        });//Termina change selmodificar
        $("#selmodificarlevel").change(function(){
          $('#checkboxvistas').empty();
          $.ajax({url:"admin/accgrupo",type:"POST",data:{grupo:$('#selmodificar').val(), level:$('#selmodificarlevel').val()},dataType:'json',
            success:function(data4){
              $.each(data4, function(nom,datos){
                if(datos.acces == "0"){
                  $("#checkboxvistas").append("<label><input type='checkbox' name='selectvistas[]' value=\""+datos.id+"\" >"+datos.nom_vista+"</label><br>");
                }
                else{
                 $("#checkboxvistas").append("<label><input type='checkbox' name='selectvistas[]' value=\""+datos.id+"\" checked>"+datos.nom_vista+"</label><br>"); 
                }
              });
            },
            error:function(){alert('error');}
          });//Termina Ajax accgrupo
        });//termina modificarlevelchange     
      });//Termina Documentready
    </script>
@stop
@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->