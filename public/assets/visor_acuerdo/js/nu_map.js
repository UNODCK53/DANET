function nu_map(){

$(function() {
  $("body").on('shown.bs.tab','#link4', function() { 
    map4.invalidateSize(false);
  });
});

//POSICIÓN INICIAL DEL MAPA
bounds2 = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));

var map4 = new L.Map('nu_map', {center: [4,-74], zoom: 6, maxBounds: bounds2, zoomControl: false, attributionControl: false});

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 6
}).addTo(map4); 

var topoMap_osm2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});

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

var unodc_ico = L.icon({
    iconUrl: 'assets/visor_acuerdo/Images/iconoUbicacin.ico',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
    popupAnchor:  [-11, -20] // point from which the popup should open relative to the iconAnchor
});

var oa_ico = L.icon({
    iconUrl: 'assets/visor_acuerdo/Images/oa.ico',
    iconSize:     [25, 25], // size of the icon
    iconAnchor:   [25, 25], // point of the icon which will correspond to marker's location
    popupAnchor:  [-11, -20] // point from which the popup should open relative to the iconAnchor
});

var zvnt_pts = L.geoJson(zvnt,{
                pointToLayer: function(feature, latlng) { 
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Zona de transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";
	                return L.marker(latlng, {icon: zvnt_icon}).bindLabel(label);
                },
                onEachFeature: interaccion_zvnt}).addTo(map4);

var campamento_pts = L.geoJson(campamento,{
                pointToLayer: function(feature, latlng) {
                    var label="<table class='table table-striped table-bordered table-condensed' style='margin-bottom: 0px'>" + "<tr><th>Departamento</th><td>" + feature.properties.DEPARTAMEN + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.MUNICIPIO + "</td></tr>" + "<tr><th>Punto de Transición</th><td>" + feature.properties.A_R + "</td></tr>" + "<table>";

	                return L.marker(latlng, {icon: camping_icon}).bindLabel(label);
                }}).addTo(map4);

var unodc_pts = L.geoJson(unodc,{
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {icon: unodc_ico, ZindexOffset: '50px'});
                },
                onEachFeature: interaccion_unodc}).addTo(map4).bindLabel("UNODC");


var oa_pts = L.geoJson(oa,{
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {icon: oa_ico}).bindLabel(feature.properties.OA_Name);
                },
                onEachFeature: interaccion_oa}).addTo(map4);



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
        groupName : "Capas del acuerdo de paz",
        expanded  : true,
        layers    : { 
            "Zonas Veredales Transitorias de Normalización" : zvnt_pts,
            "Punto Transitorio de Normalización" : campamento_pts,                            
        }   
     }                         
]; 

var control = L.Control.styledLayerControl(baseMaps, overlays);
map4.addControl(control);


//add a legend to the map
var legend1 = L.control({position: 'bottomleft'});
legend1.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend ');
   
    div.innerHTML = "<table><tr><td><img src='assets/visor_acuerdo/Images/iconoUbicacin.ico' height='10%'</td><td>  Ofinas de UNODC</td></tr><tr><td><img src='assets/visor_acuerdo/Images/oa.ico' height='10%'</td><td>  Otras Ofinas del SNU</td></tr><tr><td><img src='assets/visor_acuerdo/Images/Green_position_icon.ico' height='10%'</td><td>  Zonas Veredales Transitorias de Normalización</td></tr><tr><td><img src='assets/visor_acuerdo/Images/camping_icon.png' height='10%'</td><td>  Punto Transitorio de Normalización</td></tr></table>" ;
    
    return div;
};
legend1.addTo(map4);


function interaccion_zvnt(feature, layer) {    
    layer.on({
        click: function (e) {        
        lat_left=e.latlng.lat+0.5
        lat_right=e.latlng.lat-0.5
        lng_left=e.latlng.lng-0.5
        lng_right=e.latlng.lng+0.5
        map4.fitBounds([
            [lat_left, lng_left],
            [lat_right, lng_right]
        ]);
        }        
    });       
};

function interaccion_unodc(feature, layer) {    
    layer.on({
        click: function (e) {        
        lat_left=e.latlng.lat+0.5
        lat_right=e.latlng.lat-0.5
        lng_left=e.latlng.lng-0.5
        lng_right=e.latlng.lng+0.5
        map4.fitBounds([
            [lat_left, lng_left],
            [lat_right, lng_right]
        ]);
        }        
    });       
};

function interaccion_oa(feature, layer) {    
    layer.on({
        click: function (e) {        
        lat_left=e.latlng.lat+0.5
        lat_right=e.latlng.lat-0.5
        lng_left=e.latlng.lng-0.5
        lng_right=e.latlng.lng+0.5
        map4.fitBounds([
            [lat_left, lng_left],
            [lat_right, lng_right]
        ]);
        }        
    });       
};


//CONTROL ZOOM

new L.Control.Zoom({ position: 'topleft' }).addTo(map4);
//Control Mouse Position
L.control.mousePosition({position: 'bottomright'}).addTo(map4);

}

