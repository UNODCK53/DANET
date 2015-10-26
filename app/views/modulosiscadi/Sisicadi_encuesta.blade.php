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
  <h1 class="text-center text-primary">Reportes de encuestas digitales realizadas por Desarrollo alternativo</h1>
  <p class="lead text-justify" >Este módulo permite consultar y generar reportes de las encuestas digitales realizadas en Desarrollo Alternativo según las siguientes opciones:</p>
  <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Reporte por misión:</span> Este reporte se utiliza principalmente para generar las actas de entrega de encuestas por misión. Cuantifica las encuestas realizadas tanto a Beneficiarios como para Comités</ul>
  <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Reporte general:</span> Genera un excel para el total de encuestas realizadas, beneficiarios y comités, durante una intervención específica y las clasifica por departamento y  muncipios </ul>
  <ul class="lead text-justify" ><span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:#337ab7"></span> <span style="font-style: italic;">Reporte por monitor:</span>Este reporte sirve como control para los monitores. Muestra el total de encuestas realizadas por cada monitor según el municipio en el cual trabajó</ul>            
</div>

 <div class="col-sm-1"></div> 
   </div>  


<div  class="col-sm-12"><hr></div>

<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-offset-1 col-md-10 text-left" style="padding-top: 25px;padding-bottom: 25px;">
          <h3>Reporte por misión:</h3>Seleccione los siguientes datos para generar el reporte de encuestas almacenadas en base de datos por misión
        </div>
      </div>
      
  
      {{ Form::open(array('action' => 'SiscadiController@repote_mision','method' => 'POST','name' => 'reporte_encuentas_mision')) }}
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="intervencion" id="labelintervencion">Intervención:</label>
            </div>  
            <div class="col-sm-4" >
              <select class="form-control" id="intervencion" name="intervencion" title="Seleccione uno" required> 
                <option value=''>Seleccione uno</option>;
                @foreach($arrayinter as $pro)
                  <option value="{{$pro->intervencion}}">{{$pro->intervencion}}</option>
               @endforeach
              </select>
              </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision"id="labelmision">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision" name="mision" required> 
              </select> 
            </div>              
          </div>  
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto"id="labelPiloto" >Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="Piloto" name="Piloto" required> 
              </select> 
            </div>              
          </div>  
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for=""id="labelcod_depto" >Departamento:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="cod_depto" name="cod_depto" required> 
              </select> 
            </div>              
          </div>  
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="cod_depto"id="labelcod_dane" >Municipio:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="cod_dane" name="cod_dane" required> 
              </select> 
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" target="_blank" value="Reporte de entrega por misión" id="formulairo" >
          </div>  
        </div>
      </form> 
     <div  class="col-sm-12"><hr></div>   
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
                @foreach($arrayinter as $pro)
                  <option value="{{$pro->intervencion}}">{{$pro->intervencion}}</option>
               @endforeach
              </select>
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision"id="labelmision_gen">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision_gen" name="mision_gen" title="Seleccione uno" onchange="general()" required> 
              </select> 
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto"id="labelPiloto_gen">Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
                <select  class="form-control" id="Piloto_gen" name="Piloto_gen" required> 
              </select> 
            </div>              
          </div>  
        </div>

        
        
        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" value="Reporte de entrega por misión" id="formulairo_gen" >
          </div>  
        </div>
          <div  class="col-sm-12"><hr></div>
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
              <label for="intervencion"id="labelintervencion_moni">Intervención:</label>
            </div>  
            <div class="col-sm-4" >
              <select class="form-control" id="intervencion_moni" name="intervencion_moni" title="Seleccione uno" required> 
                <option value=''>Seleccione uno</option>;
                @foreach($arrayinter as $pro)
                  <option value="{{$pro->intervencion}}">{{$pro->intervencion}}</option>
               @endforeach
              </select>
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="mision"id="labelmision_moni">Tipo de misón:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="mision_moni" name="mision_moni" title="Seleccione uno"  required> 
        
              </select> 
            </div>              
          </div>  
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="Piloto" id="labelPiloto_moni">Prueba piloto:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="Piloto_moni" name="Piloto_moni" required> 
              </select> 
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for=""id="labelmonitor">Monitor:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="monitor" name="monitor" required> 
              </select>
              
            </div>              
          </div>  
        </div>
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for=""id="labelcod_depto_moni">Departamento:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="cod_depto_moni" name="cod_depto_moni" required> 
              </select>
              
            </div>              
          </div>  
        </div>
        
                      
        
        
        <div class="form-group">
          <div class="row">
            <div class="col-sm-offset-2 col-sm-3">
              <label for="cod_depto_moni"id="labelcod_dane_moni">Municipio:</label>
            </div>  
            <div class="col-sm-4" >
              <select  class="form-control" id="cod_dane_moni" name="cod_dane_moni" required> 
              </select>
             
            </div>              
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-5 col-sm-4 text-center">
            <input  class="form-control btn btn-primary btn-sm" type="submit" value="Reporte de entrega por misión" id="formulairo_moni" >
          </div>  
        </div>
            <div  class="col-sm-12"><hr></div>
        
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

        //input reporte por mision
        $("#labelmision").hide();
        $("#mision").hide();
        $("#labelPiloto").hide();
        $("#Piloto").hide();
        $("#labelcod_depto").hide();
        $("#cod_depto").hide();
        $("#labelcod_dane").hide();
        $("#cod_dane").hide();
        $("#formulairo").hide();

        //input reporte general
        $("#labelmision_gen").hide();
        $("#mision_gen").hide();
        $("#labelPiloto_gen").hide();
        $("#Piloto_gen").hide();
        $("#formulairo_gen").hide();

        //input reporte por MONITOR
        $("#labelmision_moni").hide();
        $("#mision_moni").hide();
        $("#labelPiloto_moni").hide();
        $("#Piloto_moni").hide();
        $("#labelcod_depto_moni").hide();
        $("#cod_depto_moni").hide();
        $("#labelcod_dane_moni").hide();
        $("#cod_dane_moni").hide();
        $("#formulairo_moni").hide();
        $("#labelmonitor").hide();
        $("#monitor").hide();


//######### reporte por mision ###############
        //datos segun intervencion      
      $("#intervencion").change(function(){
      if($('#intervencion').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepmision",type:"POST",data:{intervencion:$('#intervencion').val()},dataType:'json',//llama al controlador siscadi/siscadirepmision que trae los valores necesario para la grafica
          success:function(data1){
            $("#mision").empty();
            $("#labelmision").show();
            $("#mision").show();
            $("#labelPiloto").hide();
            $("#Piloto").hide();
            $("#labelcod_depto").hide();
            $("#cod_depto").hide();
            $("#labelcod_dane").hide();
            $("#cod_dane").hide();
            $("#formulairo").hide();
            $("#mision").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymision, function(nom,datos){
              $("#mision").append("<option value=\""+datos.mision+"\">"+datos.nom_mision+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelmision").hide();
        $("#mision").hide();
        $("#labelPiloto").hide();
        $("#Piloto").hide();
        $("#labelcod_depto").hide();
        $("#cod_depto").hide();
        $("#labelcod_dane").hide();
        $("#cod_dane").hide();
        $("#formulairo").hide();

      }
       });//Termina chage intervencion


        //datos segun mision      
      $("#mision").change(function(){
      if($('#mision').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadireppiloto",type:"POST",data:{intervencion:$('#intervencion').val(),mision:$('#mision').val()},dataType:'json',//llama al controlador siscadi/siscadireppiloto que trae los valores necesario para la grafica
          success:function(data1){
            $("#Piloto").empty();
            $("#labelPiloto").show();
            $("#Piloto").show();
            $("#labelcod_depto").hide();
            $("#cod_depto").hide();
            $("#labelcod_dane").hide();
            $("#cod_dane").hide();
            $("#formulairo").hide();
            $("#Piloto").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraypiloto, function(nom,datos){
              $("#Piloto").append("<option value=\""+datos.piloto+"\">"+datos.piloto+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelPiloto").hide();
        $("#Piloto").hide();
        $("#labelcod_depto").hide();
        $("#cod_depto").hide();
        $("#labelcod_dane").hide();
        $("#cod_dane").hide();
        $("#formulairo").hide();

      }
       });//Termina chage mision


        //datos segun Piloto      
      $("#Piloto").change(function(){
      if($('#Piloto').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepdpto",type:"POST",data:{intervencion:$('#intervencion').val(),mision:$('#mision').val(),piloto:$('#Piloto').val(),monitor:''},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $("#cod_depto").empty();
            $("#labelcod_depto").show();
            $("#cod_depto").show();
            $("#labelcod_dane").hide();
            $("#cod_dane").hide();
            $("#formulairo").hide();
            $("#cod_depto").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraydpto, function(nom,datos){
              $("#cod_depto").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelcod_depto").hide();
        $("#cod_depto").hide();
        $("#labelcod_dane").hide();
        $("#cod_dane").hide();
        $("#formulairo").hide();

      }
       });//Termina chage Piloto

      
        //datos segun Piloto      
      $("#cod_depto").change(function(){
      if($('#cod_depto').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepmpio",type:"POST",data:{intervencion:$('#intervencion').val(),mision:$('#mision').val(),piloto:$('#Piloto').val(),departamento:$('#cod_depto').val(),monitor:''},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $("#cod_dane").empty();
            $("#labelcod_dane").show();
            $("#cod_dane").show();      
            $("#formulairo").hide();     
            $("#cod_dane").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymuni, function(nom,datos){
              $("#cod_dane").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelcod_dane").hide();
        $("#cod_dane").hide();
        $("#formulairo").hide();

      }
       });//Termina chage Piloto

      $("#cod_dane").change(function(){
      if($('#cod_dane').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {       
         $("#formulairo").show();         
          
      }else{
        $("#formulairo").hide();

      }
       });//Termina chage Piloto

//######### reporte general ###############
      $("#intervencion_gen").change(function(){
      if($('#intervencion_gen').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
        
         $.ajax({url:"siscadi/siscadirepmision",type:"POST",data:{intervencion:$('#intervencion_gen').val()},dataType:'json',//llama al controlador siscadi/siscadirepmision que trae los valores necesario para la grafica
          success:function(data1){
            $("#mision_gen").empty();
            $("#labelmision_gen").show();
            $("#mision_gen").show();
            $("#labelPiloto_gen").hide();
            $("#Piloto_gen").hide();       
            $("#formulairo_gen").hide();
            $("#mision_gen").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymision, function(nom,datos){
              $("#mision_gen").append("<option value=\""+datos.mision+"\">"+datos.nom_mision+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelmision_gen").hide();
        $("#mision_gen").hide();
        $("#labelPiloto_gen").hide();
        $("#Piloto_gen").hide();       
        $("#formulairo_gen").hide();

      }
       });//Termina chage intervencion

       //datos segun mision      
      $("#mision_gen").change(function(){
      if($('#mision_gen').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadireppiloto",type:"POST",data:{intervencion:$('#intervencion_gen').val(),mision:$('#mision_gen').val()},dataType:'json',//llama al controlador siscadi/siscadireppiloto que trae los valores necesario para la grafica
          success:function(data1){
            $("#Piloto_gen").empty();
            $("#labelPiloto_gen").show();
            $("#Piloto_gen").show();
            $("#formulairo_gen").hide();
            $("#Piloto_gen").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraypiloto, function(nom,datos){
              $("#Piloto_gen").append("<option value=\""+datos.piloto+"\">"+datos.piloto+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelPiloto_gen").hide();
        $("#Piloto_gen").hide();
        $("#formulairo_gen").hide();

      }
       });//Termina chage mision

      $("#Piloto_gen").change(function(){
      if($('#Piloto_gen').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {       
         $("#formulairo_gen").show();         
          
      }else{
        $("#formulairo_gen").hide();

      }
       });//Termina chage Piloto




//######### reporte por monitor ###############
       //datos segun intervencion      
      $("#intervencion_moni").change(function(){
      if($('#intervencion_moni').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepmision",type:"POST",data:{intervencion:$('#intervencion_moni').val()},dataType:'json',//llama al controlador siscadi/siscadirepmision que trae los valores necesario para la grafica
          success:function(data1){
            $("#mision_moni").empty();
            $("#labelmision_moni").show();
            $("#mision_moni").show();
            $("#labelPiloto_moni").hide();
            $("#Piloto_moni").hide();
            $("#labelcod_depto_moni").hide();
            $("#cod_depto_moni").hide();
            $("#labelcod_dane_moni").hide();
            $("#cod_dane_moni").hide();
            $("#formulairo_moni").hide();
            $("#labelmonitor").hide();
            $("#monitor").hide();
            $("#mision_moni").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymision, function(nom,datos){
              $("#mision_moni").append("<option value=\""+datos.mision+"\">"+datos.nom_mision+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelmision_moni").hide();
        $("#mision_moni").hide();
        $("#labelPiloto_moni").hide();
        $("#Piloto_moni").hide();
        $("#labelcod_depto_moni").hide();
        $("#cod_depto_moni").hide();
        $("#labelcod_dane_moni").hide();
        $("#cod_dane_moni").hide();
        $("#formulairo_moni").hide();
        $("#labelmonitor").hide();
        $("#monitor").hide();

      }
       });//Termina chage intervencion


        //datos segun mision      
      $("#mision_moni").change(function(){
      if($('#mision_moni').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadireppiloto",type:"POST",data:{intervencion:$('#intervencion_moni').val(),mision:$('#mision_moni').val()},dataType:'json',//llama al controlador siscadi/siscadireppiloto que trae los valores necesario para la grafica
          success:function(data1){
            $("#Piloto_moni").empty();
            $("#labelPiloto_moni").show();
            $("#Piloto_moni").show();
            $("#labelcod_depto_moni").hide();
            $("#cod_depto_moni").hide();
            $("#labelcod_dane_moni").hide();
            $("#cod_dane_moni").hide();
            $("#formulairo_moni").hide();
            $("#labelmonitor").hide();
            $("#monitor").hide();
            $("#Piloto_moni").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraypiloto, function(nom,datos){
              $("#Piloto_moni").append("<option value=\""+datos.piloto+"\">"+datos.piloto+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelPiloto_moni").hide();
        $("#Piloto_moni").hide();
        $("#labelcod_depto_moni").hide();
        $("#cod_depto_moni").hide();
        $("#labelcod_dane_moni").hide();
        $("#cod_dane_moni").hide();
        $("#formulairo_moni").hide();
        $("#labelmonitor").hide();
        $("#monitor").hide();

      }
       });//Termina chage mision


        //datos segun Piloto      
      $("#Piloto_moni").change(function(){
      if($('#Piloto_moni').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepmoni",type:"POST",data:{intervencion:$('#intervencion_moni').val(),mision:$('#mision_moni').val(),piloto:$('#Piloto_moni').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $("#monitor").empty();
            $("#labelmonitor").show();
            $("#monitor").show();
            $("#labelcod_depto_moni").hide();
            $("#cod_depto_moni").hide();
            $("#labelcod_dane_moni").hide();
            $("#cod_dane_moni").hide();
            $("#formulairo_moni").hide();
            $("#monitor").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymoni, function(nom,datos){
              $("#monitor").append("<option value=\""+datos.cod_monitor+"\">"+datos.nom_monitor+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelcod_depto_moni").hide();
        $("#cod_depto_moni").hide();
        $("#labelcod_dane_moni").hide();
        $("#cod_dane_moni").hide();
        $("#formulairo_moni").hide();


      }
       });//Termina chage Piloto

    
        //datos segun Piloto      
      $("#monitor").change(function(){
      if($('#monitor').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepdpto",type:"POST",data:{intervencion:$('#intervencion_moni').val(),mision:$('#mision_moni').val(),piloto:$('#Piloto_moni').val(),monitor:$('#monitor').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $("#cod_depto_moni").empty();
            $("#labelcod_depto_moni").show();
            $("#cod_depto_moni").show();
            $("#labelcod_dane_moni").hide();
            $("#cod_dane_moni").hide();
            $("#formulairo_moni").hide();
            $("#cod_depto_moni").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraydpto, function(nom,datos){
              $("#cod_depto_moni").append("<option value=\""+datos.COD_DPTO+"\">"+datos.NOM_DPTO+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#labelcod_depto_moni").hide();
        $("#cod_depto_moni").hide();
        $("#labelcod_dane_moni").hide();
        $("#cod_dane_moni").hide();
        $("#formulairo_moni").hide();

      }
       });//Termina chage Piloto

        
          //datos segun Piloto      
      $("#cod_depto_moni").change(function(){
      if($('#cod_depto_moni').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {
         
         $.ajax({url:"siscadi/siscadirepmpio",type:"POST",data:{intervencion:$('#intervencion_moni').val(),mision:$('#mision_moni').val(),piloto:$('#Piloto_moni').val(),departamento:$('#cod_depto_moni').val(),monitor:$('#monitor').val()},dataType:'json',//llama al controlador siscadi/siscadirepdpto que trae los valores necesario para la grafica
          success:function(data1){
            $("#cod_dane_moni").empty();
            $("#labelcod_dane_moni").show();
            $("#cod_dane_moni").show();  
            $("#formulairo_moni").hide();         
            $("#cod_dane_moni").append("<option value=''>Por favor seleccione</option>");
            $.each(data1.arraymuni, function(nom,datos){
              $("#cod_dane_moni").append("<option value=\""+datos.COD_DANE+"\">"+datos.NOM_MPIO+"</option>");
            });

          },
          error:function(){alert('error');}
        });//Termina Ajax prueva
      }else{
        $("#formulairo_moni").hide();

      }
       $("#cod_dane_moni").change(function(){
      if($('#cod_dane_moni').val()!='')//si selecciona una opcion diferente de "" ejecuta la nueva grafica si no oculta el imput siguiente
      {       
         $("#formulairo_moni").show();         
          
      }else{
        $("#formulairo_moni").hide();

      }
       });//Termina chage Piloto
       });//Termina chage Piloto
          //para que los menus pequeño y grande funcione
          $( "#siscadi" ).addClass("active");
          $( "#reportesiscadi" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#siscadimenupeq" ).html("<strong>SISCADI<span class='caret'></span></strong>");
          $( "#reportesiscadimenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Consulta de encuestas</strong>");

          

      });
    
    </script>
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->