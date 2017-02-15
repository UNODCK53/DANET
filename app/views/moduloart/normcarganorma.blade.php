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
      <div class="col-sm-1"></div>
        <div class="col-sm-10">    
        <!--aca se escribe el codigo-->
        <h2 class="text-center text-primary">Normatividad</h2>
        <br>
        <p class="lead text-justify">A continuación se presenta el avance a las normas que se están desarrollando para la implementación del acuedo.</p>
        <button type="button" class="btn btn-primary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="modal()">
          Cargar norma          
        </button>
        <br><br>
        <table id="tablagizdepto" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
          <thead>  
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
              <th class="text-center">Punto acuerdo</th>
              <th class="text-center">Norma</th>
              <th class="text-center">Responsable</th>
              <th class="text-center">Tipo</th>
              <th class="text-center">Estado</th>
              <th class="text-center">100 días</th>
              <th class="text-center">Fecha entrega</th>
              <th class="text-center" title="Tasa anual de deforestación">Observaciones</th>
            </tr>
          </thead>
          <tbody>            
            
              <tr>
                <td >3</td>
                <td >Consejo Nacional de Reincorporación</td>
                <td >ACR</td>
                <td >Decreto Ordinario</td>
                <td ><div class="progress">
                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                    100%
                  </div>
                </div></td>
                <td >Sí</td>
                <td >08-dic-17</td>
                <td >Expedido</td>             
              </tr>
              <tr>
                <td >Otras</td>
                <td >Régimen simplificado de contratación para la implementación del Acuerdo.</td>
                <td >Colombia Compra Eficiente</td>
                <td >Ley Fast Track</td>
                <td ><div class="progress">
                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                    50%
                  </div>
                </div></td>
                <td >Sí</td>
                <td >23-01-2017</td>
                <td >Enviado a Secretaria Jurídica para revisión. Se incluyeron articulos para acuerdos dentro de propuesta de Estatuto General de Contratación de la Administración Pública</td>             
              </tr>
              <tr>
                <td >1</td>
                <td >Consejo de ordenamiento territorial</td>
                <td >DNP</td>
                <td >Ley Fast Track</td>
                <td ><div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 25%">
                    25%
                  </div>
                </div></td>
                <td >Sí</td>
                <td >30-01-2017</td>
                <td >En construcción</td>             
              </tr>
              <tr>
                <td >4</td>
                <td >Extinción Judicial de Dominio</td>
                <td >MinJusticia</td>
                <td >Ley Fast Track</td>
                <td ><div class="progress">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 5%">
                    5%
                  </div>
                </div></td>
                <td >No</td>
                <td ></td>
                <td ></td>             
              </tr>          
            
          </tbody>
        </table>
        <div id="modal-normatividad" class="modal fade" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Cargar Norma<h4>
              </div>
              <div class="modal-body">
                Punto del acuerdo
                <select class="form-control">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>Otro</option>
                </select>
                <br>
                Nombre de la Norma
                <input type="text" class="form-control" placeholder="Text input">
                <br>
                Responsable
                <br>
                <select class="form-control selectpicker" multiple data-selected-text-format="count > 5">
                  <option>ACR</option>
                  <option>Colombia Compra Eficiente</option>
                  <option>DNP</option>
                  <option>DPS</option>
                  <option>Función pública</option>
                  <option>Fiscalia</option>
                  <option>MinAgricultura</option>
                  <option>MinAmbiente</option>
                  <option>MinComercio</option>
                  <option>MinDefensa</option>
                  <option>MinEducación</option>
                  <option>MinHacienda</option>
                  <option>MinJusticia</option>
                  <option>MinMinas</option>
                  <option>MinSalud</option>
                  <option>MinTic</option>
                  <option>MinTrabajo</option>
                  <option>MinTransporte</option>
                  <option>OACP</option>
                  <option>Postconflicto</option>
                  <option>Presidencia</option>
                  <option>Regiones</option>
                  <option>UNP</option>
                </select>
                <br>
                Tipo
                <select class="form-control">
                  <option>Decreto Ordinario</option>
                  <option>Ley Fast Track</option>
                  <option>P.D.</option>
                  <option>Decreto Ley</option>
                  <option>Acto Legislativo</option>
                  <option>Resolución</option>                  
                </select>
                <br>
                Estado
                <select class="form-control">
                  <option>10%</option>
                  <option>20%</option>
                  <option>30%</option>
                  <option>40%</option>
                  <option>50%</option>
                  <option>60%</option>
                  <option>70%</option>
                  <option>80%</option>
                  <option>90%</option>
                  <option>100%</option>                  
                </select>
                <br>
                Fechas
                <div class="input-group date" id="datepicker">                      
                  <input id="selectfechadocu" type="text" class="form-control" name="selectfechadocu" required="true" placeholder="Fecha de elaboración del documento">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                </div>
                <br>
                Observaciones
                <input type="text" class="form-control" placeholder="Text input">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->       
        <!--fin del codigo-->
        </div>
      <div class="col-sm-1"></div>        
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
          $('#tablagizdepto').DataTable();                
      });

      $('#datepicker').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2010-01-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true

           }); 

      function modal(){
        console.log("Aca estoy")
        $("#modal-normatividad").modal("show");
      }
    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->