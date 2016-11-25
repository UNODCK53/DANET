function acuerdo_map(){
$(function() {
  $("body").on('shown.bs.tab','#link1', function() { 
    
  });
});

//VARIABLE CREDITOS DEL MAPA

var creditos_da= " <b>UNODC Colombia 2014</b> - Desarrollo Alternativo - Unidad de información y análisis<br>La información geográfica presentada aqui no representa reconocimiento o aceptación por parte de las Naciones Unidas. 27/06/2016 <br>&copy; <a href='http://leafletjs.com/'>Leaflet</a> | &copy; <a href='http://www.highcharts.com/'>Highcharts</a>" 


//POSICIÓN INICIAL DEL MAPA
bounds2 = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
var map = new L.Map('acuerdo_map', {center: [4,-74], zoom: 6, maxBounds: bounds2, zoomControl: false, attributionControl: false});
//var mymap = L.map('da_map').setView([51.505, -0.09], 13);

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 6
}).addTo(map); 

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


//CAPAS DE DESARROLLO ALTERNATIVO
//var mpios_acuerdo = L.geoJson(mpios_ac, {style: estilo, onEachFeature: interaccion_mpios}).addTo(map);

var den = L.tileLayer.wms("http://geoserver.unodc.org.co/geoserver/Censo/wms?", {
            layers: 'cen_densidad_2015',
            format: 'image/png',
            transparent: true,
            version: '1.1.0',
            //attribution: "Naciones Unidas - UNODC - Colombia - SIMCI "
}).addTo(map);

var zvnt_pts = L.geoJson(zvnt,{
				pointToLayer: function(feature, latlng) { 
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Zona de transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";

                    

	                return L.marker(latlng, {icon: zvnt_icon}).bindLabel(label);
	            },
                onEachFeature: interaccion_zvnt}).addTo(map);

var campamento_pts = L.geoJson(campamento,{

				pointToLayer: function(feature, latlng) {
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Punto de Transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";

	                return L.marker(latlng, {icon: camping_icon}).bindLabel(label);
	            }}).addTo(map);

var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
        var colombia_js= L.geoJson(colombia, {style: style_colombia});      
        colombia_js.addTo(map)



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
	    groupName : "Densidad de cultivos 2015",
	    expanded  : true,
	    layers    : { 
	        "Densidad de cultivos 2015" : den,                            
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

//Opciones de tamaño la leyenda de capas
var options = {
	container_width     : "300px",
	container_maxHeight : "350px", 
	group_maxHeight     : "80px",
	exclusive           : true
};

var control = L.Control.styledLayerControl(baseMaps, overlays);
map.addControl(control);

//add a legend to the map
var legend1 = L.control({position: 'bottomleft'});
legend1.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend col-xs-6 col-md-3');
   
    div.innerHTML = "<table><tr><td><img src='assets/visor_acuerdo/Images/Green_position_icon.ico' height='10%'</td><td>  Zonas Veredales Transitorias de Normalización</td></tr><tr><td><img src='assets/visor_acuerdo/Images/camping_icon.png' height='10%'</td><td>  Punto Transitorio de Normalización</td></tr></table>" ;
    
    return div;
};
legend1.addTo(map);

//add a legend to the map
var legend2 = L.control({position: 'bottomleft'});
legend2.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend col-xs-6 col-md-3');
   
    div.innerHTML = "<div><img class='img-responsive' alt='Responsive image' src='assets/visor_acuerdo/Images/density_bar.png'</div> " ;
    
    return div;
};
legend2.addTo(map);


//función que define el estilo de la capa municipios
function estilo(feature) {
return {
fillColor: getColor(feature.properties.Acuerdo_01),
weight: 2,
opacity: 1,
color: 'white',
dashArray: '3',
fillOpacity: 0.6
};
}

function interaccion_zvnt(feature, layer) {
    
    layer.on({

        click: function (e) {        
        lat_left=e.latlng.lat+0.5
        lat_right=e.latlng.lat-0.5
        lng_left=e.latlng.lng-0.5
        lng_right=e.latlng.lng+0.5
        map.fitBounds([
            [lat_left, lng_left],
            [lat_right, lng_right]
        ]);
        //var layer = e.target.setRadius(5);
        //map.fitBounds(layer.getBounds());
        }
        //click: onClick,       
    });   
    //layer.bindPopup("Hola");
};




function onClick(e){	
    var layer = e.target;
    //grafica.update(layer.feature.properties);
    //grafica2.update(layer.feature.properties);
    map.fitBounds(e.target.getBounds());
};

//CONTROL ZOOM

new L.Control.Zoom({ position: 'topleft' }).addTo(map);
//Control Mouse Position
L.control.mousePosition({position: 'bottomright'}).addTo(map);

//Final de la funcion
}