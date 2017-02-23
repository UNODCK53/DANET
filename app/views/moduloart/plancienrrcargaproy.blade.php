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
  <script src="assets/art/js/wNumb.js"></script>   
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
          <h2 class="text-center text-primary">Plan 100 días</h2>
          <br><br>
          <div class="row">
            <?php $status=Session::get('status');?>
                @if($status=='ok_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue cargado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue creado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue editado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_editar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue editado</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='ok_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus" class="alert alert-success col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-success"></i> El proyecto fue eliminado con éxito</div>
                <div class="col-sm-1"></div>
                @endif
                @if($status=='error_estatus_borrar')
                <div class="col-sm-1"></div>
                <div id = "mensajeestatus"class="alert alert-danger col-sm-10"><button class="close" data-dismiss="alert" type="button">×</button>
                <i class="bg-danger"></i> El proyecto NO fue eliminado</div>
                <div class="col-sm-1"></div>
                @endif
            <?php $status=0; ?>
          </div>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cargar_proyecto">Crear proyecto</button>
          <button id="btnedipro" disabled="disabled" data-target="#editar_proyecto"  data-toggle="modal" type="button" class="btn btn-primary">Editar proyecto</button>
          <button id="btndeletepro" disabled="disabled" data-target="#borrar_proyecto"  data-toggle="modal" type="button" class="btn btn-danger">Borrar proyecto</button>          
          <!--Aca inicia el modal para cargar nuevo proyecto-->
          <!-- Modal -->
          <div class="modal fade" id="cargar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Ficha de proyecto - Plan 100 días - Respuesta Rápida</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="artplan100/cargar-proyecto" method="post" id="cargarproy" enctype="multipart/form-data" > 
                      <h4>Departamento</h4>
                      <select required id="depto" name="depto" class="form-control" onchange="filter_municipality()">
                        <option selected disabled>Seleccione un departamento</option>  
                        @foreach($departamentos as $pro)                  
                          <option value="{{$pro->COD_DPTO}}">{{$pro->NOM_DPTO}}</option>                    
                        @endforeach                    
                      </select>
                      <h4>Municipio</h4>
                      <select required id="municipios" name="municipios" class="form-control">                                       
                      </select>
                      <h4>Vereda(s)</h4>
                      <input required id="veredas" name="veredas" type="text" class="form-control" placeholder="Text input">
                      <h4>Nombre del proyecto</h4>
                      <input required id="nombre" name="nombre" type="text" class="form-control" placeholder="Text input">
                      <h4>Modalidad de Focalización</h4>
                      <select required id="modalidad" name="modalidad" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option value="Plan 100 días">Plan 100 días</option>  
                          <option value="Respuesta rápida">Respuesta rápida</option>                  
                      </select>
                      <h4>Entidad Líder</h4>
                      <select required id="entidad" name="entidad" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option value="Consejo Independiente Proteccion Primera Infancia">Consejo Independiente Proteccion Primera Infancia</option>
                          <option value="Dirección para el Posconflicto">Dirección para el Posconflicto</option>
                          <option value="DNP-IGAC">DNP-IGAC</option>
                          <option value="DPS">DPS</option>
                          <option value="DPS/FAO">DPS/FAO</option>
                          <option value="Fondo Adaptación">Fondo Adaptación</option>
                          <option value="Función Pública">Función Pública</option>
                          <option value="ICBF">ICBF</option>
                          <option value="Intersectorial">Intersectorial</option>
                          <option value="Ministerio de Agricultura">Ministerio de Agricultura</option>
                          <option value="Mincomercio">Mincomercio</option>
                          <option value="Ministerio de Agricultura - Agencia de Desarrollo Rural">Ministerio de Agricultura - Agencia de Desarrollo Rural</option>
                          <option value="Ministerio de Agricultura - Agencia Nacional de Tierras">Ministerio de Agricultura - Agencia Nacional de Tierras</option>
                          <option value="Ministerio de Ambiente">Ministerio de Ambiente</option>
                          <option value="Ministerio de Comercio, Industria y Turismo">Ministerio de Comercio, Industria y Turismo</option>
                          <option value="Ministerio de Cultura">Ministerio de Cultura</option>
                          <option value="Ministerio de Defensa">Ministerio de Defensa</option>
                          <option value="Ministerio de Educación">Ministerio de Educación</option>
                          <option value="Ministerio de Justicia">Ministerio de Justicia</option>
                          <option value="Ministerio de Minas ">Ministerio de Minas </option>
                          <option value="Ministerio de Tecnologías de la Información y las Comunicaciones">Ministerio de Tecnologías de la Información y las Comunicaciones</option>
                          <option value="Ministerio de Trabajo">Ministerio de Trabajo</option>
                          <option value="Ministerio de Transporte ">Ministerio de Transporte </option>
                          <option value="Ministerio de Vivienda, Ciudad y Territorio">Ministerio de Vivienda, Ciudad y Territorio</option>
                          <option value="Ministerio del Interior">Ministerio del Interior</option>
                          <option value="Ministerior de Agricultura">Ministerior de Agricultura</option>
                          <option value="PNUD">PNUD</option>
                          <option value="RedProdepaz">RedProdepaz</option>
                          <option value="UARIV">UARIV</option>
                          <option value="Unidad para la Atención y Reparación Integral a Víctimas">Unidad para la Atención y Reparación Integral a Víctimas</option>                 
                      </select>
                      <h4>Línea de proyecto</h4>
                      <select required id="linea" name="linea" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option value="Acciones para la reparación de sujetos colectivos">Acciones para la reparación de sujetos colectivos</option>
                          <option value="Acompañamiento técnico y capacitaciones del Sector Lácteo ">Acompañamiento técnico y capacitaciones del Sector Lácteo </option>
                          <option value="Acompañamiento territorial para el Gobierno en Línea">Acompañamiento territorial para el Gobierno en Línea</option>
                          <option value="Activación del Centro Estratégico Operacional integral contra las drogas ilícitas (CEO) ">Activación del Centro Estratégico Operacional integral contra las drogas ilícitas (CEO) </option>
                          <option value="Adjudicación de baldíos a entidades de derecho público">Adjudicación de baldíos a entidades de derecho público</option>
                          <option value="Alianzas Productivas">Alianzas Productivas</option>
                          <option value="Ampliación planta tratamiento de agua potable">Ampliación planta tratamiento de agua potable</option>
                          <option value="Asesoría musical">Asesoría musical</option>
                          <option value="Atención a comunidades en ZVTN y núcleos">Atención a comunidades en ZVTN y núcleos</option>
                          <option value="Bibliotecas públicas móviles">Bibliotecas públicas móviles</option>
                          <option value="Bienestarina">Bienestarina</option>
                          <option value="Canales directos de comercialización">Canales directos de comercialización</option>
                          <option value="Capacidades Empresariales Rurales">Capacidades Empresariales Rurales</option>
                          <option value="Capacitación">Capacitación</option>
                          <option value="Ciudadanos y servidores públicos paz">Ciudadanos y servidores públicos paz</option>
                          <option value="Cobertura universal Colombia Mayor">Cobertura universal Colombia Mayor</option>
                          <option value="Cofinanciacimiento">Cofinanciacimiento</option>
                          <option value="Computadores para Educar">Computadores para Educar</option>
                          <option value="Conectividad para salud">Conectividad para salud</option>
                          <option value="Construcción/optimización alcantarillado">Construcción/optimización alcantarillado</option>
                          <option value="Cría y manejo de ganado vacuno doble propósito">Cría y manejo de ganado vacuno doble propósito</option>
                          <option value="Diplomado formación musical">Diplomado formación musical</option>
                          <option value="Electrificación rural">Electrificación rural</option>
                          <option value="Empleo Temporal">Empleo Temporal</option>
                          <option value="Empleos verdes y culturales">Empleos verdes y culturales</option>
                          <option value="Encadenamiento productivo comerciantes informales de combustible">Encadenamiento productivo comerciantes informales de combustible</option>
                          <option value="Esquema de marca social ">Esquema de marca social </option>
                          <option value="Estaciones hidrológicas o metereológicas">Estaciones hidrológicas o metereológicas</option>
                          <option value="Ferias de trámites">Ferias de trámites</option>
                          <option value="Formación de formadores">Formación de formadores</option>
                          <option value="Formalización laboral">Formalización laboral</option>
                          <option value="Formulación POMCA">Formulación POMCA</option>
                          <option value="Fortalecimiento de Juntas de Acción Comunal">Fortalecimiento de Juntas de Acción Comunal</option>
                          <option value="Fortalecimiento De La Producción Agropecuaria">Fortalecimiento De La Producción Agropecuaria</option>
                          <option value="Fortalecimiento De La Producción Agropecuaria ">Fortalecimiento De La Producción Agropecuaria </option>
                          <option value="Fortalecimiento Productivo y Empresarial de Pueblos indígenas ">Fortalecimiento Productivo y Empresarial de Pueblos indígenas </option>
                          <option value="Fortalecimiento reservas alimentarias">Fortalecimiento reservas alimentarias</option>
                          <option value="Generación de capacidad institucional territorial para la prevención y atención de emergencias">Generación de capacidad institucional territorial para la prevención y atención de emergencias</option>
                          <option value="Granja integral autosostenible - adulto mayor">Granja integral autosostenible - adulto mayor</option>
                          <option value="Implementación de sistemas  agroforestales como modelo finca tradicional">Implementación de sistemas  agroforestales como modelo finca tradicional</option>
                          <option value="Implementación modelo de ganadería">Implementación modelo de ganadería</option>
                          <option value="Inclusión Productiva/MiNegocio">Inclusión Productiva/MiNegocio</option>
                          <option value="Informes de seguimiento y verificación de hechos de violencia en ZVTN que puedan llegar a generar emergencias humanitarias ">Informes de seguimiento y verificación de hechos de violencia en ZVTN que puedan llegar a generar emergencias humanitarias </option>
                          <option value="Infraestructura - Habilitabilidad">Infraestructura - Habilitabilidad</option>
                          <option value="Infraestructura cultural - Entrega   Biblioteca Municipal">Infraestructura cultural - Entrega   Biblioteca Municipal</option>
                          <option value="Infraestructura Primera infancia">Infraestructura Primera infancia</option>
                          <option value="Infraestructura- Vías y Transporte">Infraestructura- Vías y Transporte</option>
                          <option value="Intervención en centro de salud">Intervención en centro de salud</option>
                          <option value="Intervención en vivienda, acueducto o alcantarillado">Intervención en vivienda, acueducto o alcantarillado</option>
                          <option value="Jornadas socio-culturales">Jornadas socio-culturales</option>
                          <option value="Jornadas vinculación y ahorro">Jornadas vinculación y ahorro</option>
                          <option value="Manos a la Obra">Manos a la Obra</option>
                          <option value="Manos a la paz">Manos a la paz</option>
                          <option value="Mantenimiento de vías ">Mantenimiento de vías </option>
                          <option value="Mejoramiento de vías terciarias">Mejoramiento de vías terciarias</option>
                          <option value="Mejoramiento sistemas de acueducto">Mejoramiento sistemas de acueducto</option>
                          <option value="Organización y producción agrícola comunitaria para la Seguridad Alimentaria">Organización y producción agrícola comunitaria para la Seguridad Alimentaria</option>
                          <option value="Pavimentación de 7.1KMs de 8 Kms de la vía Gaitania-Planadas">Pavimentación de 7.1KMs de 8 Kms de la vía Gaitania-Planadas</option>
                          <option value="Paz en Acción">Paz en Acción</option>
                          <option value="Pescadores artesanales">Pescadores artesanales</option>
                          <option value="Piloto Catastro multipropósito">Piloto Catastro multipropósito</option>
                          <option value="Piloto mejoras infraestructura">Piloto mejoras infraestructura</option>
                          <option value="Plan maestro de alcantarillado">Plan maestro de alcantarillado</option>
                          <option value="Plan Nacional de música para la Reconciliación - Batuta">Plan Nacional de música para la Reconciliación - Batuta</option>
                          <option value="Planes viales participativos ">Planes viales participativos </option>
                          <option value="Producción de alimentos para el autoconsumo y educación nutricional">Producción de alimentos para el autoconsumo y educación nutricional</option>
                          <option value="Proyecto integral de abastecimiento de agua">Proyecto integral de abastecimiento de agua</option>
                          <option value="Proyecto reactivar">Proyecto reactivar</option>
                          <option value="Proyectos agropecuarios">Proyectos agropecuarios</option>
                          <option value="Proyectos de infraestructura">Proyectos de infraestructura</option>
                          <option value="Radios para la Paz">Radios para la Paz</option>
                          <option value="Recuperación ambiental, cambio climático, negocios verdes entre otros">Recuperación ambiental, cambio climático, negocios verdes entre otros</option>
                          <option value="Reparaciones colectivas">Reparaciones colectivas</option>
                          <option value="Reparaciones individuales">Reparaciones individuales</option>
                          <option value="Sistema acueducto interveredal">Sistema acueducto interveredal</option>
                          <option value="Sistemas Locales de Justicia, incluyendo movilidad ">Sistemas Locales de Justicia, incluyendo movilidad </option>
                          <option value="Solicitud y entrega de libros">Solicitud y entrega de libros</option>
                          <option value="Somos Rurales">Somos Rurales</option>
                          <option value="Sumando Paz">Sumando Paz</option>
                          <option value="TIC y AGRO">TIC y AGRO</option>
                          <option value="Turismo, paz y convivencia">Turismo, paz y convivencia</option>
                          <option value="Unidades móviles">Unidades móviles</option>
                          <option value="Universidades de paz">Universidades de paz</option>
                          <option value="Zonas WIFI">Zonas WIFI</option>
                      </select>
                      <h4>Alcance</h4>
                      <textarea required id="alcance" name="alcance" class="form-control" rows="3"></textarea>
                      <h4>Población beneficiada</h4>
                      <input required id="poblacion" name="poblacion" type="number" min="0" step="1" class="form-control" placeholder="Ingrese el número de la población objetivo"> 
                      <h4>Estado del proyecto</h4>
                      <select required id="estado" name="estado" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option>Convocatoria</option>
                          <option>Contratación</option>
                          <option>Ejecución</option>
                          <option>Finalización</option>
                          <option>Alistamiento</option>
                      </select>
                      <h4>Fecha de inicio del proyecto</h4>
                      <div class="input-group date" id="datepicker">                      
                        <input required id="fecha_inicio" name="fecha_inicio" type="text" class="form-control" name="fecha_inicio" required="true" placeholder="Ingrese la fecha de inicio del proyecto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                      </div>
                      <h4>Fecha de finalización del proyecto</h4>
                      <div class="input-group date" id="datepicker2">                      
                        <input required id="fecha_final" name="fecha_final" type="text" class="form-control" name="fecha_inicio" required="true" placeholder="Ingrese la fecha de finalización del proyecto">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                      </div>
                      <h4>Avance presupuestal</h4>
                      <input required id="avance_presupuestal" name="avance_presupuestal" onchange="current(this)" class="form-control" placeholder="Ingrese el valor del avance presupuestal" type="text" min="0" step="any"/>
                      <h4> Avance del producto</h4>
                      <select required id="avance_producto" name="avance_producto" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option>10</option>
                          <option>20</option>
                          <option>30</option>
                          <option>40</option>
                          <option>50</option>
                          <option>60</option>
                          <option>70</option>
                          <option>80</option>
                          <option>90</option>
                          <option>100</option>
                      </select>                    
                      <h4>Costo estimado</h4>
                      <input required id="costo_estimado" name="costo_estimado" onchange="current(this)" class="form-control" placeholder="Ingrese el valor del avance presupuestal" type="text" min="0" step="any"/>
                      <h4>Costo ejecutado</h4>
                      <input required id="costo_ejecutado" name="costo_ejecutado"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo ejecutado" type="text" min="0" step="any"/>
                      
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Cargar proyecto</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para cargar nuevo proyecto-->
          <!--Aca inicia el modal para editar proyecto-->
          <div class="modal fade" id="editar_proyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="Editar_tittle">Editar "Nombre del proyecto"</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="artplan100/editar-proyecto" method="post" id="cargarproy" enctype="multipart/form-data">
                      <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                      <input type="text" id="id_editar" name="id_editar"  class="form-control" style="display: none;">
                      <h4>Estado del proyecto</h4>
                      <select required id="estado_editar" name="estado_editar" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option value="Convocatoria">Convocatoria</option>
                          <option value="Contratación">Contratación</option>
                          <option value="Ejecución">Ejecución</option>
                          <option value="Finalización">Finalización</option>
                          <option value="Alistamiento">Alistamiento</option>
                      </select>                    
                      <h4>Fecha de finalización del proyecto</h4>
                      <div class="input-group date" id="datepicker2_editar">                      
                        <input required id="fecha_final_editar" name="fecha_final_editar" type="text" class="form-control" name="fecha_inicio" required="true">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>                      
                      </div>
                      <h4>Avance presupuestal</h4>
                      <input required id="avance_presupuestal_editar" name="avance_presupuestal_editar" onchange="current(this)" class="form-control" placeholder="Ingrese el valor del avance presupuestal" type="text" min="0" step="any"/>
                      <h4> Avance del producto</h4>
                      <select required id="avance_producto_editar" name="avance_producto_editar" class="form-control">
                          <option selected disabled>Seleccione una opción</option>
                          <option value="10.00">10</option>
                          <option value="20.00">20</option>
                          <option value="30.00">30</option>
                          <option value="40.00">40</option>
                          <option value="50.00">50</option>
                          <option value="60.00">60</option>
                          <option value="70.00">70</option>
                          <option value="80.00">80</option>
                          <option value="90.00">90</option>
                          <option value="100.00">100</option>
                      </select>                    
                      <h4>Costo ejecutado</h4>
                      <input required id="costo_ejecutado_editar" name="costo_ejecutado_editar"onchange="current(this)" class="form-control" placeholder="Ingrese el valor del costo ejecutado" type="text" min="0" step="any"/>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Editar proyecto</button>
                </div>
                </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para editar proyecto-->
          <!--Aca inicia el modal para borrar proyecto-->
          <div class="modal fade bs-example-modal-sm" id="borrar_proyecto" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="borrar_tittle">Ups</h4>
                  </div>
                  <div class="modal-body">
                  <form role="form" action="artplan100/borrar-proyecto" method="post" id="cargarproy" enctype="multipart/form-data">
                  <!--El siguiente input es invisible para el usuario. Cotiene el id del proyecto a modificar-->
                  <input type="text" id="id_borrar" name="id_borrar"  class="form-control" style="display: none;">
                  Esta seguro que desea borrar el proyecto
                  <br><br>
                  <b><i id="id_borrar_proyecto"></i></b>                
                  
                  </div>
                  <div class="modal-footer" style="margin-bottom: 5px">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Borrar proyecto</button>
                  </div>
                  </form>
              </div>
            </div>
          </div>
          <!--Aca finaliza el modal para borrar proyecto-->
          <!--Acá inicia la tabla de proyectos-->
          <h4>Listado de proyectos</h4>
          <table id="tabla_proyectos" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>  
              <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >
                <th class="text-center">Departamento</th>
                <th class="text-center">Municipio</th>
                <th class="text-center">Vereda(s)</th>
                <th class="text-center">Nombre del proyecto</th>
                <th class="text-center">Modalidad</th>
                <th class="text-center">Avance</th>                          
              </tr>
            </thead>
            <tbody>            
              @foreach($proyectos as $pro)
                <tr id="{{$pro->id}}">
                  <td >{{$pro->NOM_DPTO}}</td>
                  <td >{{$pro->NOM_MPIO}}</td>
                  <td >{{$pro->vereda}}</td>
                  <td >{{$pro->nom_proy}}</td>
                  <td >{{$pro->mod_foca}}</td>
                  <td>
                  <div class="progress" style="margin-bottom: 0px">                    
                      @if($pro->avance_prod >=75)
                      <div class="progress-bar progress-bar-success progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                        {{$pro->avance_prod}}%
                      </div>
                      @elseif($pro->avance_prod >=25) 
                      <div class="progress-bar progress-bar-warning progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                        {{$pro->avance_prod}}%
                      </div> 
                      @else
                      <div class="progress-bar progress-bar-danger progress-bar-striped col-xs-12" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: {{$pro->avance_prod}}%; ">
                        {{$pro->avance_prod}}%
                      </div> 
                      @endif
                  </div>                
                  </td>                                              
                </tr>            
              @endforeach    
            </tbody>
          </table>
          <!--Acá termina la tabla de proyectos-->
          <!--fin del codigo-->   
          </div>
        </div>
      <div class="col-sm-1"></div> 
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
           $('#datepicker2').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2010-01-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true

           });

           $('#datepicker2_editar').datepicker({
            format: "yyyy-mm-dd",
            language: "es",
            startDate: "2010-01-01",
            endDate: "today",
            todayBtn: "linked",
            orientation: "auto",
            autoclose: true,
            todayHighlight: true

           });

            $( "#mensajeestatus" ).fadeOut(5000);
            $('#tabla_proyectos').DataTable();

             
               
      });

//funcion que filtra los municipios por departamentos
      //------------------------------------------
    function filter_municipality(){
        var depto=document.getElementById("depto").value;

        $.ajax({
            url:"artplan100/municipios",
            type:"POST",
            data:{depto: depto},
            dataType:'json',
            success:function(data){                                                
                $("#municipios").empty();
                $("#municipios").append("<option selected disabled>Seleccione un municipio</option>");
                for (var i = 0; i < data.length; i++) {
                    $("#municipios").append("<option value=\""+data[i].COD_DANE+"\">"+data[i].NOM_MPIO_1+"</option>");
                    //console.log(data[i].COD_DANE)
                }                                
            },
            error:function(){alert('error');}
        });//Termina Ajax listadoproini
    };
        
    function current(e){
        var val=document.getElementById(e.id).value;            
        var Format = wNumb({
            prefix: '$ ',
            decimals: 0,
            thousand: '.'
        });        
        val_format=Format.to(Number(val))
        if(val_format==false){
            document.getElementById(e.id).value="";
            alert("Ingrese un valor valido")        
        } else {            
            document.getElementById(e.id).value=val_format;                
        } 
    } 
    //Termina tbody 
    var table = $('#tabla_proyectos').DataTable();
    $('#tabla_proyectos tbody').on('click', 'tr', function () {
        if ( $(this).hasClass('active') ) {
            $(this).removeClass('active');
            $("#btnedipro").prop('disabled', true);
            $("#btndeletepro").prop('disabled', true);
        } else {
            table.$('tr.active').removeClass('active');
            $(this).addClass('active');
            var id=$(this);
            $("#btnedipro").prop('disabled', false);
            $("#btndeletepro").prop('disabled', false);
            //Consulta ajax para traer los atributos editables del proyecto
            //var num=($('td', this).eq(0).text());
            var id=$(this);
            var num=id[0].id;
            //var num=10;
            $.ajax({
                url:"artplan100/editar",
                type:"POST",
                data:{proyecto: num},
                dataType:'json',
                success:function(data){                    
                    var tittle="Editar proyecto: "+ data[0].nom_proy;
                    var tittle2=data[0].nom_proy;
                    var date=data[0].fecha_fin.split(" ");
                    $("#id_editar").val(num);
                    $("#id_borrar").val(num);
                    $("#Editar_tittle").html(tittle);
                    $("#id_borrar_proyecto").html(tittle2);                    
                    $("#estado_editar").val(data[0].est_proy);
                    $("#fecha_final_editar").val(date[0]);
                    $("#avance_presupuestal_editar").val(data[0].avance_pres);
                    current(document.getElementById("avance_presupuestal_editar"));
                    $("#avance_producto_editar").val(data[0].avance_prod);
                    $("#costo_ejecutado_editar").val(data[0].costo_ejec);
                    current(document.getElementById("costo_ejecutado_editar"));
                },
                error:function(){alert('error');}
            });//fin de la consulta ajax (Editar proceso)
            
        }
    });//Termina tbody

    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->