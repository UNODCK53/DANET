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

<!-- librerias JavaScript que se utilizan en la pagina -->  
 
  

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
          <h2 class="text-center text-primary">Familias censadas</h2>          
            <button id="btncargfami" title="Presione para cargar una familia" data-target="#cargfamiModal"  data-toggle="modal" type="button" class="btn btn-primary">Cargue familia</button><p></p>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Departamento</th>
                  <th>Municipio</th>
                  <th>Vereda</th>
                  <th>Nombres</th>
                  <th>Apellidos</th>
                  <th>N° de integrantes Familia</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Antioquia</td>
                  <td>Ituango</td>
                  <td>El Capote</td>
                  <td>Jhon</td>
                  <td>Doe</td>
                  <td>5</td>
                </tr>
                <tr>
                  <td>Antioquia</td>
                  <td>Bello</td>
                  <td>Bellavista</td>
                  <td>Mary</td>
                  <td>Moe</td>
                  <td>3</td>
                </tr>
                <tr>
                  <td>Caqueta</td>
                  <td>Albania</td>
                  <td>Arenosa</td>
                  <td>July</td>
                  <td>Dooley</td>
                  <td>15</td>
                </tr>
              </tbody>
            </table>
        </div>
      <div class="col-sm-1"></div>          
<!--fin del codigo-->    
    </div>
  </div>
<div id="cargfamiModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><strong>Censo Familiar</strong></h4>
      </div>
      <div class="modal-body">
        <form role="form" action="" method="get" id="formEdit">          
          <div class="form-group">
            <label for="proceso" class="control-label">Departamento:</label>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
              <option value="" selected="selected">Por favor seleccione</option>             
              <option value="1">Antioquia</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Municipio:</label>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
              <option value="" selected="selected">Por favor seleccione</option>             
              <option value="1">Ituango</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="proceso" class="control-label">Vereda:</label>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
              <option value="" selected="selected">Por favor seleccione</option>             
              <option value="1">El capote</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Nombres:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label">Apellidos:</label>
            <input id="modnompred" type="text" class="form-control" name="modnompred">
          </div>
          <div class="form-group">
            <label for="Proceso" class="control-label" >N° Integrantes familia:</label><br>
            <select id="modconcpjuri" "Seleccione el concepto" class="form-control" name="modconcpjuri" required>
              <option value="" selected="selected">Por favor seleccione</option>             
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
            </select>
          </div>          
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Confirmar Estudio Jurídico</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
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
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->