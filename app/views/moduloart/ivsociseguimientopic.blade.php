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
<!--aca se escribe el codigo-->
        <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h2 class="text-center text-primary">Viabilización de proyectos PIC</h2>
        <br>
        <p class="lead text-justify">En este módulo se realiza la viabilización de los proyectos PIC según los criterios necesarios para cada categoría, subcategoría y/o estado del proyecto.</p>  
    </div>  
    <div class="col-sm-1"></div>
    </div>
    <div class="row">
    <div class="col-sm-1"></div>
      <div class="col-sm-8">
        <button id="criterios" disabled="disabled" type="button" class="btn btn-primary" data-toggle="modal" data-target="#carga_criterios">Cargar criterios</button>
      </div>
    </div>
     <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
        <h2 class="text-center text-primary">Proyectos</h2>
        <table id="tabla_viabili" class="table table-striped table-bordered nowrap">
          <thead>
            <tr class="well text-primary" data-toggle="tooltip" data-placement="top" >              
              <th class="text-center">ID</th>
              <th class="text-center">Departamento</th>
              <th class="text-center">Municipio</th>
              <th class="text-center">Núcleo veredal</th>              
              <th class="text-center">Proyecto</th>
              <th class="text-center">Ranking</th>                            
            </tr>
          </thead>
          <tbody>
            @foreach($arrayindipic as $pro) 
              <tr id="{{$pro->id_proy}}"> 
                <td >{{$pro->ID}} </td> 
                <td >@foreach($arraydepto as $key=>$val) @if($pro->cod_depto==$key) {{$val}} @endif @endforeach </td> 
                <td >@foreach($arraymuni as $key=>$val) @if($pro->cod_mpio==$key) {{$val}} @endif @endforeach </td> 
                <td id="{{$pro->cod_nucleo}}" name="nucle">@foreach($arraynucleos as $key=>$val) @if($pro->cod_nucleo==$key) {{$val}} @endif @endforeach </td> 
                <td >{{$pro->nom_proy}}</td>
                <td >{{$pro->ranking}}</td>
              </tr> 
            @endforeach 
          </tbody>
        </table>  
        </div>        
      <div class="col-sm-1"></div>  
<!--fin del codigo-->    
    </div>
    <!--Aca inicia el modal para borrar proyecto-->
    <div class="modal fade" id="carga_criterios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="Editar_tittle">Editar iniciativa-PIC</h4>
                </div>
                <div class="modal-body">
                  <form role="form" action="artpic/editar-proyecto" method="post" id="crearindi" enctype="multipart/form-data" >
                       <div class="form-group col-sm-12" style="padding: 0px; margin: 0px;">
<div class="form-group col-sm-4" style="padding: 0px; margin: 0px;">

<label>0</label>
</div>
<div class="col-sm-8">
<span>
<a id="0" target="_blank" href="" class="glyphicon glyphicon-download-alt btn btn-primary" title="0"></a>
</span>
</div>
</div>
<div class="form-group col-sm-12" style="padding: 0px; margin: 0px;">
<div class="form-group col-sm-3" style="padding: 0px; margin: 0px;">

<label>0a</label>
</div>
<div class="col-sm-3" style="margin: 0px;">
<div id="edicheckediacta">
<input type="radio" name="0r" value="1"></input>
<input type="radio" name="0r" value="2"></input>
</div>
</div>
<div class="form-group col-sm-6" style="margin: 0px;">

<input type="file" name="0f" id="0f" accept=".pdf">
</div>
</div>
                       
                      <div class="form-group text-right"  id="cargueind">                
                        <button type="submit" class="btn btn-primary" >Editar</button>
                        <button type="button" class="btn btn-primary" onclick="window.location=window.location.pathname">Cancelar</button> 
                      </div>
                    </form>
                </div>    
              </div>
            </div>
          </div>
    
          <!--Aca finaliza el modal para borrar proyecto-->
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
          $( "#ivsociseguimientopicmenu" ).addClass("active");
          $( "#iniciomenupeq" ).html("<small> INICIO</small>");
          $( "#artmenupeq" ).html("<strong>ART<span class='caret'></span></strong>");
          $( "#ivsociseguimientopicmenupeq" ).html("<strong><span class='glyphicon glyphicon-ok'></span>Seguimiento PIC</strong>");
          $( "#mensajeestatus" ).fadeOut(5000);
          
          table=$('#tabla_viabili').DataTable({
              "order": [[ 5, "asc" ]]
          });
      });

      $('#tabla_viabili tbody').on('click', 'tr', function () {
            var Format = wNumb({
              prefix: '$ ',
              decimals: 0,
              thousand: '.'
          }); 

            if ( $(this).hasClass('active') ) {
              $(this).removeClass('active');
              $("#criterios").prop('disabled', true);
            }else {
              table.$('tr.active').removeClass('active');
              $(this).addClass('active');
              $("#criterios").prop('disabled', false);
              num =$('tr', this).context.id;
              nucleo =$(this).find('td')[3].id;
            }
      });

      $('#criterios').on('click',function () {
            $.ajax({url:"artpic/criterios",type:"POST",data:{proy:num,nucleo:nucleo},dataType:'json',
                success:function(data){
                      var  divs= $('<div>');
                       var form = document.createElement("form");
                        form.setAttribute('method',"post");
                        form.setAttribute('action',"artpic/cargar-criterio");

                     for(var i = 0; i < data['array_viable'].length; i++){
                        var div1 = document.createElement("div");
                        div1.className ="form-group col-sm-12";
                        div1.style="padding: 0;margin: 0;";

                        var div = document.createElement("div");
                        div.className ="form-group col-sm-4";
                        div.style="padding: 0;margin: 0;";
                        var Label = document.createElement("label");
                        Label.innerHTML=i;
                        div.append(Label);
                        div1.append(div);
                        var div = document.createElement("div");
                        div.className ="col-sm-8";
                        var span = document.createElement("span");
                        var a = document.createElement("a");
                        a.id=i;
                        a.target ="_blank";
                        a.href="";
                        a.className="glyphicon glyphicon-download-alt btn btn-primary";
                        a.title=i;
                        a.role="button";
                        span.append(a);
                        div.append(span);
                        div1.append(div);
                        divs.append(div1);

                        var div1 = document.createElement("div");
                        div1.className ="form-group col-sm-12";
                        div1.style="padding: 0;margin: 0;";

                        var div = document.createElement("div");
                        div.className ="form-group col-sm-3";
                        div.style="padding: 0;margin: 0;";
                        var Label = document.createElement("label");
                        Label.innerHTML=i+"a";
                        div.append(Label);
                        div1.append(div);
                        var div = document.createElement("div");
                        div.className ="col-sm-3";
                        div.style="right-padding: 0;margin: 0;";
                        var radio= document.createElement("input");
                        radio.type = "radio";
                        radio.name=i+"r";
                        radio.value='1';
                        radio.innerHTML=i+"si";
                        radio.appendChild(document.createTextNode(i+"si"));
                        var radio2= document.createElement("input");
                        radio2.type = "radio";
                        radio2.name=i+"r";
                        radio2.value='2';
                        radio2.innerHTML=i+"No";
                        div.append(radio);
                        div.append(radio2);
                        div1.append(div);
                        var div = document.createElement("div");
                        div.className ="form-group col-sm-6";
                        div.style="right-padding: 0;margin: 0;";
                        var file= document.createElement("input");
                        file.type = "file";
                        file.className ="form-group";
                        file.name=i+"f";
                        file.id=i+"f";
                        file.accept=".pdf";
                        div.append(file);
                        div1.append(div);
                        divs.append(div1);
                        
                        }

                        divs.append("</div>");
                        form.appendChild(divs[0]);
                        console.log(form)
                         $('#carga_criterios .modal-body').html(form)

                         
                  },
                error:function(){alert('error');}
            });//Termina Ajax
       });


    </script>    
@stop

@endif<!--Cierra el if de mostrar el contenido de la página si esta autenticado-->