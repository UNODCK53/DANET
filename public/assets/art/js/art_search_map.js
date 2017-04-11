bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));

var municipios_js=L.esri.query({url: 'http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/Mpios_simplify/MapServer/0'});

  municipios_js.fields(["COD_DANE","NOM_DPTO","NOM_MPIO"]);
  datos=[];
;
municipios_js.ids(function (error, ids, response) {
    resultRecordCount = ids.length;
    var paginado = Math.ceil(resultRecordCount / 1000);
    //console.log(resultRecordCount);
    for (var i = 0; i < paginado; i++) {
        municipios_js.params.resultRecordCount = resultRecordCount;
        municipios_js.params.resultOffset = i * (1000);
        municipios_js.run(function muni(error, prytablaa, response) {
        	
            datos = datos.concat(prytablaa.features);
            graficadeptoregalias(datos);
        });

    }//termina el for
    
}); 

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 5
}); 

var topoMap_osm2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});
var googleLayer_satellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});

function graficadeptoregalias(datos){

	if (datos.length == resultRecordCount) { 

		municipios_js_new = [];
		mpiosPDET = [];
		mpiosZVTN=[];
		mpiosDAILCD=[];

        for (var i = 0; i < datos.length; i++) {
            for (var j = 0; j < datos_municipios.length; j++) {
                if (datos[i].properties.COD_DANE == datos_municipios[j].COD_DANE &&  datos_municipios[j].PDET==1) {
                	mpiosPDET.push(datos[i]);
                }
                if (datos[i].properties.COD_DANE == datos_municipios[j].COD_DANE &&  datos_municipios[j].ZVTN==1) {
                	mpiosZVTN.push(datos[i]);
                }
                if (datos[i].properties.COD_DANE == datos_municipios[j].COD_DANE &&  datos_municipios[j].DAILCD==1) {
                	mpiosDAILCD.push(datos[i]);
                }
            }
        }//termina el for 
        mpiosPDET_js= L.geoJson(mpiosPDET, {style: estilo_municipios_PDET, onEachFeature: interaccion_mpios_PDET}); 
        mpiosZVTN_js= L.geoJson(mpiosZVTN, {style: estilo_municipios_ZVTN, onEachFeature: interaccion_mpios_ZVTN}); 
        mpiosDAILCD_js= L.geoJson(mpiosDAILCD, {style: estilo_municipios_DAILCD, onEachFeature: interaccion_mpios_DAILCD}); 
        map = new L.Map('map', {center: [4,-74], zoom: 5, zoomControl: false, attributionControl: false,layers: [topoMap_osm1,mpiosZVTN_js]});

        //Layers
		var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
		var colombia_js= L.geoJson(colombia, {style: style_colombia}); 
		colombia_js.addTo(map)



		var overlayMaps = {
		   // "Municipios PEDT": mpiosPDET_js,
            "Municipios ZVTN": mpiosZVTN_js,
           // "Municipios DAILCD": mpiosDAILCD_js
		};

		//Capas de seleccion unica
		var baseMaps = 
		    { 
            "Mapa topográfico OSM1" :  topoMap_osm1,
            "Mapa topográfico OSM2" :  topoMap_osm2,
            "Mapa satelital" :  googleLayer_satellite
		    };

		L.control.layers(baseMaps).addTo(map);

		//SECCION DE FUNCIONES

		function estilo_municipios_PDET(feature) {
			return {
			fillColor:'#A9F5BC',
			weight: 1,
			opacity: 1,
			color: 'gray',
			dashArray: '3',
			fillOpacity: 0.4
			};
		}

		function estilo_municipios_DAILCD(feature) {
			return {
			fillColor:'#FFEDA0',
			weight: 1,
			opacity: 1,
			color: 'gray',
			dashArray: '3',
			fillOpacity: 0.4
			};
		}
		function estilo_municipios_ZVTN(feature) {
			return {
			fillColor:'#ECCEF5',
			weight: 1,
			opacity: 1,
			color: 'gray',
			dashArray: '3',
			fillOpacity: 0.4
			};
		}

		function borde(e) {
			var layers = e.target;
			layers.setStyle({
				weight: 3,
				color: 'cyan',
				dashArray: '3',
				fillOpacity: 0
			});

			if (!L.Browser.ie && !L.Browser.opera) {
				layers.bringToFront();
			}			
		}

		//función que redefine el borde después de pasar con el mouse
		function resetbordeZVTN(e) {	
	        mpiosZVTN_js.resetStyle(e.target);	
	       		
		};
		function resetbordePDET(e) {
			mpiosPDET_js.resetStyle(e.target);	
	       		
		};
		function resetbordeDAILCD(e) {
			mpiosDAILCD_js.resetStyle(e.target);		
		};

		//funcion que define la interacción de la capa municipios
				
		function interaccion_mpios_ZVTN(feature, layer) {	
			var cod=feature.properties.COD_DANE
			var mpio=feature.properties.NOM_MPIO
			var depto=feature.properties.NOM_DPTO 
			var texto="<div align='center'>Departamento:"+feature.properties.NOM_DPTO+"<br>Municipio: "+feature.properties.NOM_MPIO+ "<br><br><button type='button' class='btn btn-primary' onclick='search(\""+cod+"\",\""+mpio+"\",\""+depto+"\")'>Avance</button> </div>"
			var texto1="<div align='center'>"+feature.properties.NOM_MPIO+ "<br>("+feature.properties.NOM_DPTO+")</div>"
			layer.bindPopup(texto);
			layer.bindTooltip(texto1); 
			layer.on(
				{
				mouseover: borde,
				mouseout: resetbordeZVTN,	
				click: function (e) {                
		        map.fitBounds(e.target.getBounds());

		        }
			});	
		};

		function interaccion_mpios_DAILCD(feature, layer) {	
			var cod=feature.properties.COD_DANE
			var mpio=feature.properties.NOM_MPIO
			var depto=feature.properties.NOM_DPTO 
			var texto="<div align='center'>Departamento:"+feature.properties.NOM_DPTO+"<br>Municipio: "+feature.properties.NOM_MPIO+ "<br><br><button type='button' class='btn btn-primary' onclick='search(\""+cod+"\",\""+mpio+"\",\""+depto+"\")'>Avance</button> </div>"
			var texto1="<div align='center'>"+feature.properties.NOM_MPIO+ "<br>("+feature.properties.NOM_DPTO+")</div>"
			layer.bindPopup(texto);
			layer.bindTooltip(texto1); 
			layer.on(
				{
				mouseover: borde,
				mouseout: resetbordeDAILCD,	
				click: function (e) {                
		        map.fitBounds(e.target.getBounds());

		        }
			});	
		};

		function interaccion_mpios_PDET(feature, layer) {	
			var cod=feature.properties.COD_DANE
			var mpio=feature.properties.NOM_MPIO
			var depto=feature.properties.NOM_DPTO 
			var texto="<div align='center'>Departamento:"+feature.properties.NOM_DPTO+"<br>Municipio: "+feature.properties.NOM_MPIO+ "<br><br><button type='button' class='btn btn-primary' onclick='search(\""+cod+"\",\""+mpio+"\",\""+depto+"\")'>Avance</button> </div>"
			var texto1="<div align='center'>"+feature.properties.NOM_MPIO+ "<br>("+feature.properties.NOM_DPTO+")</div>"
			layer.bindPopup(texto);
			layer.bindTooltip(texto1); 
			layer.on(
				{
				mouseover: borde,
				mouseout: resetbordePDET,	
				click: function (e) {                
		        map.fitBounds(e.target.getBounds());

		        }
			});	
		};
	}
	var buttons = L.control({position: 'topleft'});
	buttons.onAdd = function (map) {
	  this._div = L.DomUtil.create('div', 'leyend'); // create a div with a class "query"
	  this._div.id = "buttons_div";
	  return this._div; 
	};
	var texto_production= '<button id="switch_pedt" type="button" class="btn btn-default" onclick="change_production(this)">PEDT</button> <button id="switch_zvtn" type="button" class="btn btn-primary" onclick="change_production(this)">ZVTN</button> <button id="switch_dailcd" type="button" class="btn btn-default" onclick="change_production(this)">DAILCD</button>'
	buttons.addTo(map);
	$("#buttons_div").html(texto_production);

	L.control.zoom({
    	position:'topleft'
	}).addTo(map);
}

function search(cod,mpio, depto){	
	var tittle="Reporte de avance - " + mpio + ", "+depto
	var DNP=existeUrl('assets/art/documentos/Infografias/DNP/'+cod+'.pdf');
	var detallada=existeUrl('assets/art/documentos/Infografias/detallada/'+cod+'.pdf');
	var poblacional=existeUrl('assets/art/documentos/Infografias/poblacional/'+cod+'.pdf');
	var Social=existeUrl('assets/art/documentos/Infografias/Social/'+cod+'.pdf');
	var Inversion=existeUrl('assets/art/documentos/Infografias/Inversion/'+cod+'.pdf');
	var ZVT=existeUrl('assets/art/documentos/Infografias/ZVT/'+cod+'.pdf');
	var Mapas=existeUrl('assets/art/documentos/Infografias/Mapas/'+cod+'.pdf');
	var texto2=""
	if(DNP){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/DNP/'+cod+'.pdf"><img src="assets/art/img/dnp.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(detallada){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/detallada/'+cod+'.pdf"><img src="assets/art/img/detallada.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(poblacional){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/poblacional/'+cod+'.pdf"><img src="assets/art/img/poblacional.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(Social){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/Social/'+cod+'.pdf"><img src="assets/art/img/social.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(Inversion){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/Inversion/'+cod+'.pdf"><img src="assets/art/img/inversion.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(ZVT){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/ZVT/'+cod+'.pdf"><img src="assets/art/img/zv.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	if(Mapas){
		texto2+='<div class="col-xs-12 col-sm-6 col-md-2"><a target="_blank" href="assets/art/documentos/Infografias/Mapas/'+cod+'.pdf"><img src="assets/art/img/mapa.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>';
	};
	
	$("#municipal").show();
	$('#titulo').html(tittle)
	$('#panel_fichas').html(texto2)
	
	$.ajax({
		url:"artdashboard/pic",
		type:"POST",data:{indi:cod},
		dataType:'json',
	      success:function(data){
	      	
	        $('#obra_priori').html(data['obra_priori'])
	        $('#coca_simci').html(parseFloat(data['coca_simci']).toFixed(2)+" ha")
	      },
	      error:function(){alert('error');}
	  });//Termina Ajax
};

function existeUrl(url) {
   var http = new XMLHttpRequest();
   http.open('HEAD', url, false);
   http.send();
   return http.status!=404;
}


//Button

function change_production(e){
    if(e.id=="switch_pedt"){
        if($("#switch_pedt").hasClass("btn-primary")){
            $("#switch_pedt").removeClass("btn-primary").addClass("btn-default");
            map.removeLayer(mpiosPDET_js);
        } else {
            $("#switch_pedt").removeClass("btn-default").addClass("btn-primary");
            if($("#switch_zvtn").hasClass("btn-primary")){
                $("#switch_zvtn").removeClass("btn-primary").addClass("btn-default");
                $("#switch_dailcd").removeClass("btn-primary").addClass("btn-default");
                map.removeLayer(mpiosZVTN_js);                
                map.removeLayer(mpiosDAILCD_js);                
            } else {
            	$("#switch_zvtn").removeClass("btn-primary").addClass("btn-default");
                $("#switch_dailcd").removeClass("btn-primary").addClass("btn-default");
                map.removeLayer(mpiosZVTN_js);                
                map.removeLayer(mpiosDAILCD_js);                
            }
            mpiosPDET_js.addTo(map);
        }  
    } else if(e.id=="switch_zvtn") {
        if($("#switch_zvtn").hasClass("btn-primary")){
            $("#switch_zvtn").removeClass("btn-primary").addClass("btn-default");
            map.removeLayer(mpiosZVTN_js);
        } else {
            $("#switch_zvtn").removeClass("btn-default").addClass("btn-primary");
            if($("#switch_pedt").hasClass("btn-primary")){
                $("#switch_pedt").removeClass("btn-primary").addClass("btn-default");
                $("#switch_dailcd").removeClass("btn-primary").addClass("btn-default");
            	map.removeLayer(mpiosDAILCD_js);
            	map.removeLayer(mpiosPDET_js);                
            } else {
            	$("#switch_pedt").removeClass("btn-primary").addClass("btn-default");
                $("#switch_dailcd").removeClass("btn-primary").addClass("btn-default");
            	map.removeLayer(mpiosDAILCD_js);            	
            	map.removeLayer(mpiosPDET_js);
                
            }
            mpiosZVTN_js.addTo(map);
        }  
    } else {
        if($("#switch_dailcd").hasClass("btn-primary")){
            $("#switch_dailcd").removeClass("btn-primary").addClass("btn-default");
            map.removeLayer(mpiosDAILCD_js);
        } else {
            $("#switch_dailcd").removeClass("btn-default").addClass("btn-primary");
            if($("#switch_pedt").hasClass("btn-primary")){
                $("#switch_pedt").removeClass("btn-primary").addClass("btn-default");
            	$("#switch_zvtn").removeClass("btn-primary").addClass("btn-default");
                map.removeLayer(mpiosZVTN_js);
	            map.removeLayer(mpiosPDET_js);
            } else {
            	$("#switch_pedt").removeClass("btn-primary").addClass("btn-default");
            	$("#switch_zvtn").removeClass("btn-primary").addClass("btn-default");
                map.removeLayer(mpiosZVTN_js);
	            map.removeLayer(mpiosPDET_js);
            }
            mpiosDAILCD_js.addTo(map);
        }  
    }
};


