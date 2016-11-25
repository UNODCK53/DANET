function da_map(){

$(function() {
  $("body").on('shown.bs.tab','#link2', function() { 
    map.invalidateSize(false);
  });
});



//VARIABLE CREDITOS DEL MAPA
var creditos_da= " <b>UNODC Colombia 2014</b> - Desarrollo Alternativo - Unidad de información y análisis<br>La información geográfica presentada aqui no representa reconocimiento o aceptación por parte de las Naciones Unidas. 27/06/2016 <br>&copy; <a href='http://leafletjs.com/'>Leaflet</a> | &copy; <a href='http://www.highcharts.com/'>Highcharts</a>" 


//POSICIÓN INICIAL DEL MAPA
bounds2 = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
var map = new L.Map('da_map', {center: [4,-74], zoom: 6, maxBounds: bounds2, zoomControl: false, attributionControl: false});
//var mymap = L.map('da_map').setView([51.505, -0.09], 13);

//MAPAS BASE
var topoMap_osm1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 6
}).addTo(map); 


var topoMap_osm2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});

/*var den = L.tileLayer('http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/Proy2015/MapServer/0', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});*/

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

var den = L.tileLayer.wms("http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/Proy2015/MapServer", {
            layers: 'K_53C05/Proy2015',
            format: 'image/png',
            transparent: true,
            version: '1.1.0',
            //attribution: "Naciones Unidas - UNODC - Colombia - SIMCI "
}).addTo(map);


var zvnt_pts = L.geoJson(zvnt,{
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {icon: zvnt_icon});
                }}).addTo(map);

var campamento_pts = L.geoJson(campamento,{
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng, {icon: camping_icon});
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
            "Mapa topográfico OSM2" :  topoMap_osm2,
            "Mapa topográfico den" :  den                           
        }
    }                       
 ];

//Capas de seleccion multiple
 var overlays = [
     /*{
        groupName : "Capas Territoriales",
        expanded  : true,
        layers    : { 
            "Municipios del acuerdo" : mpios_acuerdo,                            
        }   
     },*/
     {
        groupName : "Capas del acuerdo de paz",
        expanded  : true,
        layers    : { 
            "Zonas Veredales Transitorias de Normalización" : zvnt_pts,
            "Punto Transitorio de Normalización" : campamento_pts
                                        
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

function interaccion_mpios(feature, layer) {
    var content = "<table class='table table-striped table-bordered table-condensed'>" + "<tr><th>Departamento</th><td>" + feature.properties.NOM_DPTO + "</td></tr>" + "<tr><th>Municipio</th><td>" + feature.properties.NOM_MPIO + "</td></tr>" + "<table>";
    var title="Desarrollo Alternativo en " + feature.properties.NOM_MPIO
    
    layer.on({
        click: function (e) {
        //mouseover: borde,
        //mouseout: resetborde,
        var layer = e.target;
        $("#feature-title").html(title);
        $("#feature-info").html(content);    
        $("#featureModal").modal("show");
        map.fitBounds(e.target.getBounds());
        grafica_da.update(layer.feature.properties);
        }
        //click: onClick,       
    });   
    //layer.bindPopup("Hola");
};

function getColor(d) {
return d == "Campamento" ? '#ff9933' :
   d == "Campamento y Zona Veredal"  ? '#BD0026' :
   d == "Piloto de sustitución de cultivos ilícitos"  ? '#009900' :
   d == "Zonas veredales transitorias de normalización"  ? '#3366ff' :
   d == "Áreas de Desarrollo Alternativo" ? '#cc66ff':
              '#FFEDA0';
}

//LEYENDA PALETA DE COLORES
                
/*var legend = L.control({position: 'bottomleft'});

legend.onAdd = function (map) {

    var div = L.DomUtil.create('div', 'info legend'),
        ha = ["Campamento", "Campamento y Zona Veredal", "Piloto de sustitución de cultivos ilícitos", "Zonas veredales transitorias de normalización","Áreas de Desarrollo Alternativo"],
        labels = [],
        from, to;

    for (var i = 0; i < ha.length; i++) {
        from = ha[i];
        //to = ha[i + 1];

        labels.push(
            '<i style="background:' + getColor(from) + '"></i> ' +
            from);
    }

    div.innerHTML = "<normal_bold><b>Municipio con:</b></normal_bold><br/>" + labels.join('<br>');
    return div;
};

legend.addTo(map);*/


function onClick(e){    
    var layer = e.target;
    //grafica.update(layer.feature.properties);
    //grafica2.update(layer.feature.properties);
    map.fitBounds(e.target.getBounds());
};

//add a legend to the map
var legend1 = L.control({position: 'bottomleft'});
legend1.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend ');
   
    div.innerHTML = "<table><tr><td><img src='assets/visor_acuerdo/Images/Green_position_icon.ico' height='10%'</td><td>  Zonas Veredales Transitorias de Normalización</td></tr><tr><td><img src='assets/visor_acuerdo/Images/camping_icon.png' height='10%'</td><td>  Punto Transitorio de Normalización</td></tr></table>" ;
    
    return div;
};
legend1.addTo(map);


//CONTROL ZOOM

new L.Control.Zoom({ position: 'topleft' }).addTo(map);
//Control Mouse Position
L.control.mousePosition({position: 'bottomright'}).addTo(map);

}