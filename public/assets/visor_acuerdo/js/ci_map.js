

function ci_map(){

$(function() {
  $("body").on('shown.bs.tab','#link3', function() { 
    map3.invalidateSize(false);
  });
});

//POSICIÓN INICIAL DEL MAPA
bounds2 = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));


var map3 = new L.Map('ci_map', {center: [4,-74], zoom: 6, maxBounds: bounds2, zoomControl: false, attributionControl: false});

//var mymap = L.map('da_map').setView([51.505, -0.09], 13);

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 6
}).addTo(map3); 

var topoMap_osm2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});

//Simbologias personalizadas

//Simbología
        
var zvnt_icon = L.icon({
    iconUrl: 'assets/visor_acuerdo/Images/Green_position_icon.ico',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
    popupAnchor:  [-11, -20] // point from which the popup should open relative to the iconAnchor
});

var camping_icon = L.icon({
    iconUrl: 'assets/visor_acuerdo/Images/camping_icon.png',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
    popupAnchor:  [-11, -20] // point from which the popup should open relative to the iconAnchor
});

//función que ejecuta el color de la capa mpios
function getColor(d) {
return d > 6000 ? '#800026' :
   d > 2500  ? '#BD0026' :
   d > 1500  ? '#E31A1C' :   
   d > 500   ? '#FD8D3C' :   
   d > 10   ? '#FED976' :
              '#FFEDA0';
}

//función que define el estilo de la capa municipios
function estilo(feature) {
	return {
	fillColor: getColor(feature.properties.C_2015),
	weight: 2,
	opacity: 1,
	color: 'white',
	dashArray: '3',
	fillOpacity: 0.7
	};
}

//funcion que define el borde de la capa al pasar con el mouse encima
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
	mpios_ci.resetStyle(e.target);
	//info.update();
	//grafica.update();
	
};

function onClick(e){
	var layer = e.target;
	//grafica.update(layer.feature.properties);
	map3.fitBounds(e.target.getBounds());
};
		
//funcion que define la interacción de la capa municipios
		
function interaccion_mpios(feature, layer) {
	var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Departamento</th><td>" + feature.properties.NOM_DPTO + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.NOM_MPIO + "</td></tr>" + "<table>";
    var title="Cultivos Ilícitos en " + feature.properties.NOM_MPIO

	layer.on(

		{
		mouseover: borde,
		mouseout: resetborde,	
		click: function (e) {        
        //var layer = e.target;
        $("#feature-title-ci").html(title);
        $("#feature-info-ci").html(content);    
        $("#featureModal-ci").modal("show");
        map3.fitBounds(e.target.getBounds());
        grafica_ci.update(layer.feature.properties);
        }
	});
	
	//layer.bindPopup("Hola");
};


var mpios_ci = L.geoJson(municipios, {style: estilo, onEachFeature: interaccion_mpios}).addTo(map3);

var zvnt_pts = L.geoJson(zvnt,{
                pointToLayer: function(feature, latlng) { 
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Zona de transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";

                    

	                return L.marker(latlng, {icon: zvnt_icon}).bindLabel(label);
                }}).addTo(map3);

var campamento_pts = L.geoJson(campamento,{
                pointToLayer: function(feature, latlng) {
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Punto de Transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";

	                return L.marker(latlng, {icon: camping_icon}).bindLabel(label);
                }}).addTo(map3);



//Capas de seleccion unica
var baseMaps = [
    { 
        groupName : "Mapas base",
        expanded : true,
        layers    : {
            "Mapa topográfico OSM1" :  topoMap_osm1,
            "Mapa topográfico OSM2" :  topoMap_osm2                           
        }
    }                       
 ];

//Capas de seleccion multiple
 var overlays = [	    
     {
	    groupName : "Municipios con cultivos ilícitos",
	    expanded  : true,
	    layers    : { 
	        "Municipios con cultivos ilícitos" : mpios_ci,                            
	    }   
	 },
     {
        groupName : "Capas del acuerdo de paz",
        expanded  : true,
        layers    : { 
            "Zonas Veredales Transitorias de Normalización" : zvnt_pts,
            "Punto Transitorio de Normalización" : campamento_pts,                            
        }   
     }                         
]; 

var control = L.Control.styledLayerControl(baseMaps, overlays);
map3.addControl(control);

//add a legend to the map
var legend1 = L.control({position: 'bottomleft'});
legend1.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend ');
   
    div.innerHTML = "<table><tr><td><img src='assets/visor_acuerdo/Images/Green_position_icon.ico' height='10%'</td><td>  Zonas Veredales Transitorias de Normalización</td></tr><tr><td><img src='assets/visor_acuerdo/Images/camping_icon.png' height='10%'</td><td>  Punto Transitorio de Normalización</td></tr></table>" ;
    
    return div;
};
legend1.addTo(map3);

//LEYENDA PALETA DE COLORES
				
var legend = L.control({position: 'bottomleft'});

legend.onAdd = function (map) {

	var div = L.DomUtil.create('div', 'info legend'),
		ha = [0, 10, 500, 1500, 2500, 6000],
		labels = [],
		from, to;

	for (var i = 0; i < ha.length; i++) {
		from = ha[i];
		to = ha[i + 1];

		labels.push(
			'<i style="background:' + getColor(from + 1) + '"></i> ' +
			from + (to ? '&ndash;' + to : '+'));
	}

	div.innerHTML = "<normal_bold> Censo SIMCI 2015 (ha)</normal_bold><br/><br/>" + labels.join('<br>');
	return div;
};

legend.addTo(map3);



//CONTROL ZOOM

new L.Control.Zoom({ position: 'topleft' }).addTo(map3);
//Control Mouse Position
L.control.mousePosition({position: 'bottomright'}).addTo(map3);

}