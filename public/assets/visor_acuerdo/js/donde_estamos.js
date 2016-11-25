//VARIABLE CREDITOS DEL MAPA
var creditos= " <b>UNODC Colombia 2014</b> - Desarrollo Alternativo - Unidad de información y análisis<br>La información geográfica presentada aqui no representa reconocimiento o aceptación por parte de las Naciones Unidas. 27/06/2016 <br>&copy; <a href='http://leafletjs.com/'>Leaflet</a> | &copy; <a href='http://www.highcharts.com/'>Highcharts</a>" 


//POSICIÓN INICIAL DEL MAPA
bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
var map = new L.Map('map', {center: [4,-80], zoom: 6, maxBounds: bounds, zoomControl: false, attributionControl: false});

var googleLayer_satellite = new L.Google("SATELLITE");
        
//MAPAS BASE
var topoMap_1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 6
}).addTo(map); 
var topoMap_2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});

//CARGAR CAPAS
var mpios_acuerdo = L.geoJson(mpios_ac, {style: estilo, onEachFeature: interaccion_mpios}).addTo(map);
var style_veredas = {"color": "#cc66ff", "weight": 1.5, "opacity": 1, "fillOpacity": 0.8 };
var vda = L.geoJson(veredas, {style: style_veredas});        
var vda_points = L.geoJson(veredas_point,{onEachFeature: interaccion_veredas});
var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
var colombia_js= L.geoJson(colombia, {style: style_colombia});      
colombia_js.addTo(map)

function getColor(d) {
return d == "Campamento" ? '#ff9933' :
   d == "Campamento y Zona Veredal"  ? '#BD0026' :
   d == "Piloto de sustitución de cultivos ilícitos"  ? '#009900' :
   d == "Zonas veredales transitorias de normalización"  ? '#3366ff' :
   d == "Áreas de Desarrollo Alternativo" ? '#cc66ff':
              '#FFEDA0';
}

//LEYENDA PALETA DE COLORES
        
var legend = L.control({position: 'bottomleft'});

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



//INCLUIR TEXTO GME 
    
var contextBanner = L.control({position: 'bottomleft'});

contextBanner.onAdd = function (map) {
    this._div = L.DomUtil.create('div', 'contexto'); // create a div with a class "contexto"
    this._div.id = "context_Banner";
    var html_banner=  "<b>Municipios de concentración<br></b><br>El 23 de junio de 2016 el gobierno de Colombia y las FARC E.P. firmaron el punto 3 del proceso de paz que da inicio al fin del conflicto. En este sentido, dos tipos de áreas fueron definidas <br><br><b>1. Zonas veredales transitorias de normalización: </b><br><br>Cuyo objeto es garantizar precisamente que cesen el fuego y las hostilidades de manera definitiva y que las FARC dejen las armas en manos de la Organización de las Naciones Unidas”.<br><br>Estas zonas son veredas o fracciones de veredas. La vereda es la más pequeña subdivisión en la estructura administrativa territorial colombiana.<br><br>De las 33 mil veredas existentes en el territorio colombiano, se usarán como zonas veredales transitorias de normalización (ZVTN) un total de 23.<br><br><b>2. Campamentos:</b><br><br>Habrá 8 campamentos, cada uno de 200 metros x 200 metros, es decir 4 hectáreas." ;
    this._div.innerHTML= html_banner;
    return this._div;
};

contextBanner.addTo(map);
legend.addTo(map);

//var context_gme= document.getElementById("context_Banner");
//context_gme.onmouseover=function(){context_gme.innerHTML="<b>Dos Tipos de áreas fueron definidas <br><br>1. Zonas veredales transitorias de normalización (ZVTN): </b><br><br>Cuyo objeto es garantizar precisamente que cesen el fuego y las hostilidades de manera definitiva y que las FARC dejen las armas en manos de la Organización de las Naciones Unidas”.<br><br>Estas zonas son veredas o fracciones de veredas. La vereda es la más pequeña subdivisión en la estructura administrativa territorial colombiana.<br><br>De las 33 mil veredas existentes en el territorio colombiano, se usarán como zonas veredales transitorias de normalización (ZVTN) un total de 23.<br><br><b>2. Campamentos:</b><br><br>Habrá 8 campamentos, cada uno de 200 metros x 200 metros, es decir 4 hectáreas."};
//context_gme.onmouseout=function(){context_gme.innerHTML="<table><tr><td><img src='assets/visor_acuerdo/images/info.png' width='20' height='20' align='middle'></td><td><b>Munucipios del acuerdo</b></td>"};


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
    mpios_acuerdo.resetStyle(e.target);
    //info.update();
    //grafica.update();
    
};

function interaccion_mpios(feature, layer) {
    var popupText = '<hr>Departamento: ' + feature.properties.NOM_DPTO + '<br/>   Municipio: ' + feature.properties.NOM_MPIO + '<br> Tipo: ' + feature.properties.acuerdo +'<hr>';  
    //layer.bindPopup(popupText);
    layer.on({
        //mouseover: borde,
        //mouseout: resetborde,
        click: onClick,
    });         
    //layer.bindPopup("Hola");
};


function interaccion_veredas(feature, layer) {
    if (feature.properties.Tipo_Proy=="PC"){
        x="Poserradicación y Contención";
    } else if (feature.properties.Tipo_Proy=="FGB"){
        x="Familia Guardabosques";  
    } else if (feature.properties.Tipo_Proy=="PP"){
        x="Proyectos Productivos";  
    } else if (feature.properties.Tipo_Proy=="FGB y PP"){
        x="Familia Guardabosques y Proyectos Productivos";  
    } else if (feature.properties.Tipo_Proy=="FGB y PC"){
        x="Familia Guardabosques y Poserradicación y Contención";   
    } else if (feature.properties.Tipo_Proy=="PP y PC"){
        x="Proyectos Productivos y Poserradicación y Contención";   
    } else if (feature.properties.Tipo_Proy=="FGB, PPy PC"){
        x="Familia Guardabosques, Proyectos Productivos y Poserradicación y Contención";    
    }
    else {
        x=feature.properties.Tipo_Proy;
    }
    var popupText = '<hr>Departamento: ' + feature.properties.NOM_DPTO + '<br/>   Municipio: ' + feature.properties.NOM_MPIO + '<br> Vereda: ' + feature.properties.NOM_TERR + '<br> Estrategia: ' + x +'<hr>';
    layer.bindPopup(popupText);

    //layer.bindPopup(popupText);
    //layer.bindPopup("Hola");
};

//zoom to feature
function zoomToFeature(e) {
map.fitBounds(e.target.getBounds());
};

function onClick(e){
    var layer = e.target;
    grafica.update(layer.feature.properties);
    grafica2.update(layer.feature.properties);
    map.fitBounds(e.target.getBounds());
};


var baseMaps = {
"Mapa topográfico OSM1": topoMap_1,
"Mapa topográfico OSM2": topoMap_2,
//"Mapa UNODC": topoMap_4,
"Mapa Satelital Google " : googleLayer_satellite    
};
var capas = {"Municipios acuerdo": mpios_acuerdo, "Áreas de Desarrollo Alternativo": vda, "Veredas de Desarrollo Alternativo": vda_points}; 
L.control.layers(baseMaps,capas,{position: 'bottomleft', collapsed: false}).addTo(map);

//CONTROL ZOOM

new L.Control.Zoom({ position: 'bottomleft' }).addTo(map);

map.on('zoomend', function() {
    if (map.getZoom() <9){
        if (map.hasLayer(vda_points)) {
            map.removeLayer(vda_points);
        } else {
            console.log("no point layer active");
        }
    }
    if (map.getZoom() >= 9){
        if (map.hasLayer(vda_points)){
            console.log("layer already added");
        } else {
            map.addLayer(vda_points);
        }
    }
})

//Addición de creditos a DA/UNODC en posicion bottomright
var creditos_box= L.control.attribution({position: 'bottomright'});
creditos_box.setPrefix('<div class= "creditos">'+creditos).addTo(map);
//Control Mouse Position
L.control.mousePosition({position: 'bottomright'}).addTo(map);
