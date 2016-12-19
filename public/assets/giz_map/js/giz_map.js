//POSICIÓN INICIAL DEL MAPA
bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));

var map = new L.Map('map', {center: [4,-74], zoom: 6, zoomControl: true, attributionControl: false});

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 5
}).addTo(map); 

var topoMap_osm2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});
var googleLayer_satellite = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',{
    maxZoom: 20,
    subdomains:['mt0','mt1','mt2','mt3']
});

//CARGAR MOSAICOS DE COBERTURAS
bounds_mos_ama = new L.LatLngBounds(new L.LatLng(-0.708265, -77.192731), new L.LatLng(3.496044, -69.985128));
bounds_mos_cat = new L.LatLngBounds(new L.LatLng(7.525815, -73.638468), new L.LatLng(9.295056, -72.464458));
var options_ama = {minZoom: 5,maxZoom: 13,opacity: 1.0,bounds: bounds_mos_ama, tms: false};
var options_cat = {minZoom: 5,maxZoom: 13,opacity: 1.0,bounds: bounds_mos_cat, tms: false};
var mos_catatumbo_2005 = new L.tileLayer('assets/giz_map/raster/cob_cata_05_wgs/{z}/{x}/{y}.png', options_cat);
var mos_amazonas_2005 = new L.tileLayer('assets/giz_map/raster/cob_amazonas_05_wgs/{z}/{x}/{y}.png', options_ama);
var mos_catatumbo_2010 = new L.tileLayer('assets/giz_map/raster/cob_cata_10_wgs/{z}/{x}/{y}.png', options_cat);
var mos_amazonas_2010 = new L.tileLayer('assets/giz_map/raster/cob_amazonas_10_wgs/{z}/{x}/{y}.png', options_ama);
var mos_catatumbo_2014 = new L.tileLayer('assets/giz_map/raster/cob_cata_14_wgs/{z}/{x}/{y}.png', options_cat);
var mos_amazonas_2014 = new L.tileLayer('assets/giz_map/raster/cob_amazonas_14_wgs/{z}/{x}/{y}.png', options_ama);
var mosaico_2005=L.layerGroup([mos_catatumbo_2005,mos_amazonas_2005]);
var mosaico_2010=L.layerGroup([mos_catatumbo_2010,mos_amazonas_2010]);
var mosaico_2014=L.layerGroup([mos_catatumbo_2014,mos_amazonas_2014]);
//CARGAR MOSAICOS DE DENSIDAD
bounds_mos_den = new L.LatLngBounds(new L.LatLng(-0.660038, -77.177755), new L.LatLng(9.298963, -69.941000));
var options_den = {minZoom: 5,maxZoom: 13,opacity: 1.0,bounds: bounds_mos_den, tms: false};
var densidad_2005_2010 = new L.tileLayer('assets/giz_map/raster/densidad_05_10_wgs/{z}/{x}/{y}.png', options_den);
var densidad_2010_2014 = new L.tileLayer('assets/giz_map/raster/densidad_10_14_wgs/{z}/{x}/{y}.png', options_den);
//CARGAR MOSAICOS DE MODELOS
var modelo_catatumbo_20 = new L.tileLayer('assets/giz_map/raster/modelo_20_cata_wgs/{z}/{x}/{y}.png', options_cat);
var modelo_amazonas_20 = new L.tileLayer('assets/giz_map/raster/modelo_20_ama_wgs/{z}/{x}/{y}.png', options_ama);
var modelo_catatumbo_25 = new L.tileLayer('assets/giz_map/raster/modelo_25_cata_wgs/{z}/{x}/{y}.png', options_cat);
var modelo_amazonas_25 = new L.tileLayer('assets/giz_map/raster/modelo_25_ama_wgs/{z}/{x}/{y}.png', options_ama);
var modelo_20=L.layerGroup([modelo_catatumbo_20,modelo_amazonas_20]);
var modelo_25=L.layerGroup([modelo_catatumbo_25,modelo_amazonas_25]);





//Layers
var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
var colombia_js= L.geoJson(colombia, {style: style_colombia});      
colombia_js.addTo(map)

var style_deptos = {"color": "#202020", "weight": 1.5, "opacity": 0.9, "fillOpacity": 0 };
var deptos_js= L.geoJson(deptos, {style: style_deptos});      

var municipios_js= L.geoJson(municipios, {style: estilo_municipios, onEachFeature: interaccion_mpios});      
municipios_js.addTo(map)

parques_js= L.geoJson(parques, {style: estilo_parques, onEachFeature: interaccion_parques});      


resguardos_js= L.geoJson(resguardos, {style: estilo_resguardos, onEachFeature: interaccion_resguardos});      



//Capas de seleccion unica
var baseMaps = [
    { 
        groupName : "Mapas base",
        expanded : true,
        layers    : {
            "Mapa topográfico OSM1" :  topoMap_osm1,
            "Mapa topográfico OSM2" :  topoMap_osm2,
            "Mapa satelital" :  googleLayer_satellite,

        }
    }                       
 ];


//Capas de seleccion multiple
 var overlays = [	    
     {
	    groupName : "Capas Vectoriales en las zonas de estudio",
	    expanded  : true,
	    layers    : { 
	        "Departamentos" : deptos_js,
	        "Municipios" : municipios_js,  
	        "Parques Nacionales" : parques_js,
	        "Resguardos" : resguardos_js,
	        "Coberturas 2005": mosaico_2005,
	        "Coberturas 2010": mosaico_2010,
	        "Coberturas 2014": mosaico_2014,
	        "Densidad 2005-2010":densidad_2005_2010,
	        "Densidad 2010-2014":densidad_2010_2014,
	       	"Modelo 2020":modelo_20,
	       	"Modelo 2025":modelo_25 	 
	                                         
	    }   
	 }                         
];

var control = L.Control.styledLayerControl(baseMaps,overlays);
map.addControl(control);

//SECCION DE FUNCIONES

function estilo_municipios(feature) {
	return {
	
	weight: 2,
	opacity: 1,
	color: 'black',
	dashArray: '3',
	fillOpacity: 0
	};
}

function estilo_parques(feature) {
	return {
	fillColor: "#36A32B",
	weight: 2,
	opacity: 1,
	color: '#36A32B',
	dashArray: '3',
	fillOpacity: 0.7
	};
}

function estilo_resguardos(feature) {
	return {
	fillColor: "#ffd700",
	weight: 2,
	opacity: 1,
	color: '#ffd700',
	dashArray: '3',
	fillOpacity: 0.7
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
function resetborde(e) {
	municipios_js.resetStyle(e.target);	
};

function resetbordeparque(e) {
	parques_js.resetStyle(e.target);	
};

function resetborderesguardo(e) {
	resguardos_js.resetStyle(e.target);	
};


function onClick(e){
	var layer = e.target;
	//grafica.update(layer.feature.properties);
	map.fitBounds(e.target.getBounds());
};
		
//funcion que define la interacción de la capa municipios
		
function interaccion_mpios(feature, layer) {

	var cod=feature.properties.COD_DEPTO
	var defo_depto=0
	var degra_depto=0
	var afecta_depto=0
	var def_asoc_depto=0
	for (i = 0; i < municipios.features.length; i++) { 
		if (municipios.features[[i]].properties.COD_DEPTO==cod){
			defo_depto=defo_depto+municipios.features[[i]].properties.Defo_05_14;
			degra_depto=degra_depto+municipios.features[[i]].properties.Degra_05_2;
			afecta_depto=afecta_depto+municipios.features[[i]].properties.Afec_05_14;
			def_asoc_depto=def_asoc_depto+municipios.features[[i]].properties.Defo_aso_1;
		}
	}	


	var content = "<table class='table table-striped table-bordered table-condensed'><thead><tr class='well text-primary' data-toggle='tooltip' data-placement='top'><th class='text-center'>Capa Administrativa</th><th class='text-center'>Nombre</th><th class='text-center'>Deforestación  (Ha)</th><th class='text-center'>Degradación  (Ha)</th><th class='text-center'>Afectación (Ha)</th><th class='text-center' title='Tasa anual de deforestación'>T.A.D. (%)</th><th class='text-center'>Def. asociada  (Ha)</th></tr></thead><tbody><tr align='center'><td>Municipio</td><td>"+feature.properties.NOM_MPIO+"</td><td>"+feature.properties.Defo_05_14+"</td><td>"+feature.properties.Degra_05_2+"</td><td>"+feature.properties.Afec_05_14+"</td><td>"+feature.properties.Tasa_05_14+"</td><td>"+feature.properties.Defo_aso_1+"</td></tr><tr align='center'><td>Departamento</td><td>"+feature.properties.NOM_DPTO+"</td><td>"+defo_depto+"</td><td>"+degra_depto+"</td><td>"+afecta_depto+"</td><td>"+feature.properties.tasa_depto+"</td><td>"+def_asoc_depto+"</td></tr></tbody></table>"  

	/*+ ""



	"<tr><th>Departamento</th><td>" + feature.properties.NOM_DPTO + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.NOM_MPIO + "</td></tr>" + "<table>";*/
    var title="Municipio " + feature.properties.NOM_MPIO + ", " + feature.properties.NOM_DPTO

	layer.on(
		{
		mouseover: borde,
		mouseout: resetborde,	
		click: function (e) {        
        $("#feature-title-municipios").html(title);
        $("#feature-info-municipios").html(content);    
        $("#featureModal-municipios").modal("show");
        map.fitBounds(e.target.getBounds());        
        }
	});	
};
		
function interaccion_parques(feature, layer) {

	var title="Parque Nacional " + feature.properties.NOM_PNN 

	var content = "<table class='table table-striped table-bordered table-condensed'><thead><tr class='well text-primary' data-toggle='tooltip' data-placement='top'><th class='text-center'>Capa Administrativa</th><th class='text-center'>Nombre</th><th class='text-center'>Deforestación  (Ha)</th><th class='text-center'>Degradación  (Ha)</th><th class='text-center'>Afectación (Ha)</th></thead><tbody><tr align='center'><td>Parques Nacionales</td><td>"+feature.properties.NOM_PNN+"</td><td>"+feature.properties.Defo_05_14+"</td><td>"+feature.properties.Degra_05_2+"</td><td>"+feature.properties.Afec_05_14+"</td></tr>"+"</td></tr></tbody></table>"

	layer.on(

		{
		mouseover: borde,
		mouseout: resetbordeparque,	
		click: function (e) {		             
        $("#feature-title-parques").html(title);
        $("#feature-info-parques").html(content);    
        $("#featureModal-parques").modal("show");
        map.fitBounds(e.target.getBounds());        
        }
	});	
};

		
function interaccion_resguardos(feature, layer) {

	var title="Resguardo " + feature.properties.NOM_RI + " - (ETNIA - " + feature.properties.NOM_ETNIA +")"

	var content = "<table class='table table-striped table-bordered table-condensed'><thead><tr class='well text-primary' data-toggle='tooltip' data-placement='top'><th class='text-center'>Capa Administrativa</th><th class='text-center'>Nombre</th><th class='text-center'>Deforestación  (Ha)</th><th class='text-center'>Degradación  (Ha)</th><th class='text-center'>Afectación (Ha)</th></thead><tbody><tr align='center'><td>Resguardos</td><td>"+feature.properties.NOM_RI+"</td><td>"+feature.properties.Defo_05_14+"</td><td>"+feature.properties.Degra_05_2+"</td><td>"+feature.properties.Afec_05_14+"</td></tr>"+"</td></tr></tbody></table>"

	layer.on(

		{
		mouseover: borde,
		mouseout: resetborderesguardo,	
		click: function (e) {		             
        $("#feature-title-resguardos").html(title);
        $("#feature-info-resguardos").html(content);    
        $("#featureModal-resguardos").modal("show");
        map.fitBounds(e.target.getBounds());        
        }
	});	
};

//BOTÓN EXTEND
var extend = L.control({position: 'topright'});
extend.onAdd = function (map) {
	this._div = L.DomUtil.create('div', 'fullextend'); // create a div with a class "infosidebar"
	this._div.id = "head_Banner";
	L.DomEvent.disableClickPropagation(this._div);
	var html_banner=  '<i class="fa fa-globe fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Full extend" onclick = "fullextend()"></i>' ;
	this._div.innerHTML= html_banner;
	return this._div;
};

function fullextend() {
	bounds = map.fitBounds([[-5, -75],[13, -73]])
	//var bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
	click: bounds;	
}

extend.addTo(map);

//BOTÓN QUERY
var query = L.control({position: 'topright'});
query.onAdd = function (map) {
	this._div = L.DomUtil.create('div', 'query'); // create a div with a class "infosidebar"
	this._div.id = "query";
	L.DomEvent.disableClickPropagation(this._div);
	var html_banner=  '<i class="fa fa-bar-chart fa-2x" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Gráficas" onclick = "querysearch()"></i>' ;
	this._div.innerHTML= html_banner;
	return this._div;
};

function querysearch() {
	
    options=departamento.update();	
	var chart = new Highcharts.Chart(options);
	$("#featureModal-query").modal("show",function(){
		$("#container").css('visibility', 'initial');
        chart.reflow();
    });    
}

query.addTo(map);

//BOTÓN INFO
var info = L.control({position: 'topright'});
info.onAdd = function (map) {
	this._div = L.DomUtil.create('div', 'query'); // create a div with a class "infosidebar"
	this._div.id = "info";
	L.DomEvent.disableClickPropagation(this._div);
	var html_banner=  '<i class="fa fa-info-circle fa-2x" data-container="body" data-toggle="popover" title="<h4>Información</h4>" data-placement="left" data-content="<b>Deforestación:</b> corresponde únicamente a la conversión directa de la cobertura de bosque natural a  un cultivo de coca durante el periodo 2005-2014.<br><b>Degradación:</b> afectación continúa de las capacidades del bosque por el establecimiento de un cultivo de coca durante el periodo 2005-2014.<br><b>Afectación:</b> es la pérdida total de la cobertura boscosa y/o la afectación continúa de las capacidades del bosque, a causa del establecimiento de un cultivo de coca (deforestación + degradación) durante el periodo 2005-2014.<br><b>T.A.D:</b> es la Tasa anual de deforestación por cultivos de coca que indica la relación entre el área de bosque de referencia (bosque en 2005) y el área deforestada por coca en cada región para el periodo 2005-2014.<br><b>Def. Asociada:</b> la deforestación asociada al cultivo de coca se entiendo como la pérdida de la cobertura boscosa en áreas circundantes (1km de distancia) a la afectación del bosque por cultivos de coca. Esta pérdida está condicionada por la presencia de actividades antrópicas dinamizadas por la aparición de un cultivo de coca durante el periodo 2005-2014.<br><b>Coberturas:</b> coberturas vegetales obtenidas de los mapas de cambio de coberturas bosque/ no bosque 2005-2010 y 2013-2014 del IDEAM.<br><b>Densidad de afectación del bosque:</b> corresponde a la densidad de la afectación del bosque por cultivos de coca (ha/km2).<br><b>Vulnerabilidad del bosque:</b> Corresponde a los mapas generados por un moldeo espacial que  identifica las zonas de bosque más vulnerables a ser deforestadas por cultivos de coca. Este modelo solo tiene en cuenta la variable de deforestación por coca." </i>' ;
	this._div.innerHTML= html_banner;
	return this._div;
};

info.addTo(map);

//Slider coberturas y leyenda

var leyenda = L.control({position: 'bottomleft'});

var texto_leyenda='<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true"><div class="panel panel-default"><div class="panel-heading" role="tab" id="headingOne"><h4 class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Coberturas</a></h4></div><div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne"><div class="panel-body "><div class="col-xs-12"><div><font color="#267300">██</font> Bosque</div><div ><font color="#ffffbd">██ </font> Otras coberturas</div><div><font color="#e1e1e1">██</font> Áreas sin Información</div><br> Año interpretación<br><br><div id="slider_DIV"><!-- Slider button --><div id="cober_slider" class="col-xs-12" ></div><div id="cober-slider-lower" class="col-xs-4" style="padding-top: 5px"></div><br><div class="col-xs-4">2005</div><div class="col-xs-4">2010</div><div class="col-xs-4">2014</div><br><br></div></div>       </div> </div></div>  <div class="panel panel-default"><div class="panel-heading" role="tab" id="headingTwo"><h4 class="panel-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Densidad de afectación del bosque</a> </h4> </div> <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo"> <div class="panel-body">     <div class="col-xs-12"><div><font color="#8D140F">██</font> Alta</div><div ><font color="#9F5B4F">██ </font> Media</div><div><font color="#D6C3C0">██</font> Baja</div>  <br>Intervalo de densidad<br><br><div id="slider_den_DIV"><!-- Slider button --><div id="den_slider" class="col-xs-12" ></div><div id="den-slider-lower" class="col-xs-4" style="padding-top: 5px"></div><br><div class="col-xs-6">2005-2010</div><div class="col-xs-6" style="text-align: right;">2010-2014</div></div></div>     <div class="col-xs-12"><br>Transparencia: <span id="dato_trans">50</span>% <br><br><div id="slider_den_DIV"><!-- Slider button --><div id="den_tran_slider" class="col-xs-12" ></div><div id="den-tran-slider-lower" class="col-xs-4" style="padding-top: 5px"></div>     </div>     </div>      </div>         </div> </div> <div class="panel panel-default"> <div class="panel-heading" role="tab" id="headingThree"> <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Vulnerabilidad del bosque</a> </h4> </div>  <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree"> <div class="panel-body"><div>        <div class="col-xs-12"><div><font color="#4E0373">██</font> Alta</div><div ><font color="#A701E3">██ </font> Media</div><div><font color="#E5BCFC">██</font> Baja</div>  <br>   Año de modelamiento<br><br><div id="slider_den_DIV"><!-- Slider button --><div id="mod_slider" class="col-xs-12" ></div><div id="mod-slider-lower" class="col-xs-4" style="padding-top: 5px"></div><br><div class="col-xs-6">2020</div><div class="col-xs-6" style="text-align: right;">2025</div></div></div>     <div class="col-xs-12"><br>Transparencia: <span id="dato_mod_trans">50</span>% <br><br><div id="slider_mod_DIV"><!-- Slider button --><div id="mod_tran_slider" class="col-xs-12" ></div><div id="mod-tran-slider-lower" class="col-xs-4" style="padding-top: 5px"></div></div></div>     </div> </div> </div> </div> </div>'

leyenda.onAdd = function (map) {
	this._div = L.DomUtil.create('div', 'leyenda'); // create a div with a class "infosidebar"
	this._div.id = "leyenda";
	L.DomEvent.disableClickPropagation(this._div);	
	
	return this._div;
};


leyenda.addTo(map);
$("#leyenda").html(texto_leyenda);

//Slider para la covertura de bosque en el municipio
//Inicializa el slide
var cober_slider = document.getElementById('cober_slider');
noUiSlider.create(cober_slider, {
start: 1,	
step: 1,
decimals: 0,	
range: {
	'min': 1,
	'max': 3
	}
});

cober_slider.noUiSlider.on('update', function( values, handle ) {
	var value = values[handle];
	if (value==1){
		mosaico_2005.addTo(map);
		map.removeLayer(mosaico_2010);
		map.removeLayer(mosaico_2014);		
	} else if (value==2){
		mosaico_2010.addTo(map);
		map.removeLayer(mosaico_2005);
		map.removeLayer(mosaico_2014);
	} else {
		mosaico_2014.addTo(map);
		map.removeLayer(mosaico_2005);
		map.removeLayer(mosaico_2010);
	}
	
});

//Slider para la densidad
//Inicializa el slide
var den_slider = document.getElementById('den_slider');
noUiSlider.create(den_slider, {
start: 1,	
step: 1,
decimals: 0,	
range: {
	'min': 1,
	'max': 2
	}
});

den_slider.noUiSlider.on('update', function( values, handle ) {
	var value = values[handle];
	if (value==1){
		densidad_2005_2010.addTo(map);		
		map.removeLayer(densidad_2010_2014);		
	} else{
		densidad_2010_2014.addTo(map);
		map.removeLayer(densidad_2005_2010);		
	} 	
});

//Slider para la transparencia de densidad
//Inicializa el slide
var den_tran_slider = document.getElementById('den_tran_slider');
noUiSlider.create(den_tran_slider, {
start: 1,	
step: 1,
decimals: 0,	
range: {
	'min': 0,
	'max': 100
	}
});

den_tran_slider.noUiSlider.on('update', function( values, handle ) {
	var value = parseInt(values[handle]);	
	$("#dato_trans").html(value);
	value=1-(value/100);
	densidad_2005_2010.setOpacity(value);
	densidad_2010_2014.setOpacity(value);
});



//Slider para el modelo
//Inicializa el slide
var mod_slider = document.getElementById('mod_slider');
noUiSlider.create(mod_slider, {
start: 1,	
step: 1,
decimals: 0,	
range: {
	'min': 1,
	'max': 2
	}
});

mod_slider.noUiSlider.on('update', function( values, handle ) {
	var value = values[handle];
	if (value==1){
		modelo_20.addTo(map);		
		map.removeLayer(modelo_25);		
	} else{
		modelo_25.addTo(map);
		map.removeLayer(modelo_20);		
	} 	
});

//Slider para la transparencia de densidad
//Inicializa el slide
var mod_tran_slider = document.getElementById('mod_tran_slider');
noUiSlider.create(mod_tran_slider, {
start: 1,	
step: 1,
decimals: 0,	
range: {
	'min': 0,
	'max': 100
	}
});

mod_tran_slider.noUiSlider.on('update', function( values, handle ) {
	var value = parseInt(values[handle]);	
	$("#dato_mod_trans").html(value);
	value=1-(value/100);
	
	modelo_catatumbo_20.setOpacity(value);
	modelo_amazonas_20.setOpacity(value);
	modelo_catatumbo_25.setOpacity(value);
	modelo_amazonas_25.setOpacity(value);
	
	
});