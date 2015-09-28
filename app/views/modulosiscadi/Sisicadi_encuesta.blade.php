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
  {{ HTML::script('assets/js/SISCADI/funciones_reporte.js')}} 
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
    
<!--aca se escribe el codigo-->
<!--formulario para reporte de mision-->
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 text-left" style="padding-top: 25px;padding-bottom: 25px;">
          <h3>Reporte por misión:</h3>Seleccione los siguientes datos para generar el reporte de encuestas almacenadas en base de datos por misión
        </div>
      </div>
      
  
      {{ Form::open(array('action' => 'SiscadiController@repote_mision','method' => 'POST','name' => 'reporte_encuentas_mision')) }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="intervencion">Intervención:</label>
            </div>  
            <div class="col-sm-4" >
              <select class="form-control" id="intervencion" name="intervencion" title="Seleccione uno" onchange="depto(),borrar(this)" required> 
                <option value=''>Seleccione uno</option>;
                <option value='2015'>2015</option>;
                <option value='2014'>2014</option>;
                <!--<option value='2013'>2013</option>;
                <option value='2012'>2012</option>;-->
              </select>
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision" name="mision" title="Seleccione uno" onchange="depto(),borrar(this)" required> 
                <option value=''>Seleccione uno</option>
                <option value='p'>Línea Base</option>
                <!--<option value='s1'>Seguimiento 1</option>
                <option value='s2'>Seguimiento 2</option>
                <option value='s'>Línea final</option>-->
              </select> 
            </div>              
          </div>  
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto">Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
              <input   type="radio" id="Piloto_si" name="Piloto"  value= 'Si' onchange="depto(),borrar(this)" required> Si
              <input   type="radio" id="Piloto_no" name="Piloto"  value= 'No' onchange="depto(),borrar(this)" checked="checked" required> No    
            </div>              
          </div>  
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="">Departamento:</label>
            </div>  
            <div class="col-sm-4" >
              {{ Form::select('cod_depto', array(''=>'Seleccione uno'),'',array('class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'cod_depto','onchange'=>'change(),muni(),borrar(this)'))}}  
            </div>              
          </div>  
        </div>
        
                      
        
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="cod_depto">Municipio:</label>
            </div>  
            <div class="col-sm-4" >
              {{ Form::select('cod_dane', array(''=>'Seleccione uno'),'',array('class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'cod_dane','onchange'=>'change(),borrar(this)'))}} 
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" value="Reporte de entrega por misión" id="formulairo" disabled>
          </div>  
        </div>
      </form> 
    
   <!-- formualrio de reporte general-->   

<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 text-left" style="padding-top: 25px;padding-bottom: 25px;">
          <h3>Reporte general:</h3>Seleccione los siguientes datos para generar el reporte general de encuestas almacenadas en base de datos
        </div>
      </div>

      {{ Form::open(array('action' => 'SiscadiController@repote_general','method' => 'POST','name' => 'reporte_encuentas_general')) }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="intervencion">Intervención:</label>
            </div>  
            <div class="col-sm-4" >
              <select class="form-control" id="intervencion_gen" name="intervencion_gen" title="Seleccione uno" onchange="general(),borrar(this)" required> 
                <option value=''>Seleccione uno</option>;
                <option value='2015'>2015</option>;
                <option value='2014'>2014</option>;
                <!--<option value='2013'>2013</option>;
                <option value='2012'>2012</option>;-->
              </select>
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision_gen" name="mision_gen" title="Seleccione uno" onchange="general()" required> 
                <option value=''>Seleccione uno</option>
                <option value='p'>Línea Base</option>
                <!--<option value='s1'>Seguimiento 1</option>
                <option value='s2'>Seguimiento 2</option>
                <option value='s'>Línea final</option>-->
              </select> 
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto">Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
              <input   type="radio" id="Piloto_gen_si" name="Piloto_gen"  value= 'Si' onchange="general()" required> Si
              <input   type="radio" id="Piloto_gen_no" name="Piloto_gen"  value= 'No' onchange="general()" checked="checked" required> No   
            </div>              
          </div>  
        </div>

        
        
        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" value="Reporte de entrega por misión" id="formulairo_gen" disabled>
          </div>  
        </div>
      
      </form> 

<!-- formualrio de reporte por monitor-->   

  <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 text-left" style="padding-top: 25px;padding-bottom: 25px;">
          <h3>Reporte por monitor:</h3>Seleccione los siguientes datos para generar el reporte de encuestas almacenadas en base de datos por monitor
        </div>
      </div>
      
  
      {{ Form::open(array('action' => 'SiscadiController@repote_monitor','method' => 'POST','name' => 'reporte_encuentas_monitor')) }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="intervencion">Intervención:</label>
            </div>  
            <div class="col-sm-4" >
              <select class="form-control" id="intervencion_moni" name="intervencion_moni" title="Seleccione uno" onchange="depto_moni(),borrar(this)" required> 
                <option value=''>Seleccione uno</option>;
                <option value='2015'>2015</option>;
                <option value='2014'>2014</option>;
                <!--<option value='2013'>2013</option>;
                <option value='2012'>2012</option>;-->
              </select>
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision_moni" name="mision_moni" title="Seleccione uno" onchange="monitores(),borrar(this)" required> 
                <option value=''>Seleccione uno</option>
                <option value='p'>Línea Base</option>
                <!--<option value='s1'>Seguimiento 1</option>
                <option value='s2'>Seguimiento 2</option>
                <option value='s'>Línea final</option>-->
              </select> 
            </div>              
          </div>  
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto">Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
              <input   type="radio" id="Piloto_si_moni" name="Piloto_moni"  value= 'Si' onchange="monitores(),borrar(this)" required> Si
              <input   type="radio" id="Piloto_no_moni" name="Piloto_moni"  value= 'No' onchange="monitores(),borrar(this)" checked="checked" required> No    
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="">Monitor:</label>
            </div>  
            <div class="col-sm-4" >
              {{ Form::select('monitor', array(''=>'Seleccione uno'),'',array('class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'monitor','onchange'=>'change(),depto_moni(),borrar(this)'))}}  
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="">Departamento:</label>
            </div>  
            <div class="col-sm-4" >
              {{ Form::select('cod_depto_moni', array(''=>'Seleccione uno'),'',array('class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'cod_depto_moni','onchange'=>'change(),muni_moni(),borrar(this)'))}}   
            </div>              
          </div>  
        </div>
        
                      
        
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="cod_depto_moni">Municipio:</label>
            </div>  
            <div class="col-sm-4" >
              {{ Form::select('cod_dane_moni', array(''=>'Seleccione uno'),'',array('class'=>'form-control','disabled'=>'disabled','required'=>'required','id'=>'cod_dane_moni','onchange'=>'change(),borrar(this)'))}} 
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" value="Reporte de entrega por misión" id="formulairo_moni" disabled>
          </div>  
        </div>
        
        
      </form> 

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
    <script>
    

      $(document).ready(function() {
          //para que los menus pequeño y grande funcione
          $( "#tierras" ).addClass("active");
          $( "#tierraslevtopo" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#tierrasmenupeq" ).html("<strong>MODULO TIERRAS<span class='caret'></span></strong>");
          $( "#tierrasestjurmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Estudio Juridico</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);

     
      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->