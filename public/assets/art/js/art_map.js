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

//Layers

var den = L.tileLayer.wms("http://geoserver.unodc.org.co/geoserver/Censo/wms?", {
            layers: 'cen_densidad_2015',
            format: 'image/png',
            transparent: true,
            version: '1.1.0',
            //attribution: "Naciones Unidas - UNODC - Colombia - SIMCI "
}).addTo(map);

var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
var colombia_js= L.geoJson(colombia, {style: style_colombia});      
colombia_js.addTo(map)

var municipios_js= L.geoJson(municipios, {style: estilo_municipios, onEachFeature: interaccion_mpios});      
municipios_js.addTo(map)

var resguardos_js=L.esri.featureLayer({url: 'http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/resguardos_simp/MapServer/0',simplifyFactor: 0.5, precision: 5, style: estilo_resguardos, onEachFeature: interaccion_resgurados});

var concejos_js=L.esri.featureLayer({url: 'http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/consejos_simplificados/MapServer/0',simplifyFactor: 0.5, precision: 5, style: estilo_concejos, onEachFeature: interaccion_concejos});

var parques_js=L.esri.featureLayer({url: 'http://arcgisserver.unodc.org.co/arcgis/rest/services/K_53C05/parques_simplificados/MapServer/0 ',simplifyFactor: 0.5, precision: 5, style: estilo_parques, onEachFeature: interaccion_parques});

var veredas_js= L.geoJson(veredas, {style: estilo_veredas, onEachFeature: interaccion_veredas});      



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
	        "Densidad" : den,
	        "Veredas"  : veredas_js,
	        "Municipios": municipios_js,
	        "Resguardos": resguardos_js,
	        "Concejos": concejos_js,
	        "Parques Nacionales": parques_js      
	    }   
	 }                         
];

var control = L.Control.styledLayerControl(baseMaps, overlays);
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

function estilo_veredas(feature) {
	return {
	
	weight: 2,
	opacity: 1,
	color: '#51173A',
	dashArray: '3',
	fillOpacity: 0
	};
}

function estilo_resguardos(feature) {
	return {
	
	weight: 2,
	opacity: 1,
	color: '#EF8E0B',
	dashArray: '3',
	fillOpacity: 0
	};
}

function estilo_concejos(feature) {
	return {
	
	weight: 2,
	opacity: 1,
	color: '#BC9259',
	dashArray: '3',
	fillOpacity: 0
	};
}

function estilo_parques(feature) {
	return {
	
	weight: 2,
	opacity: 1,
	color: '#56BB20',
	dashArray: '3',
	fillOpacity: 0
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

function resetbordeveredas(e) {
	veredas_js.resetStyle(e.target);	
};

function resetborderesguardos(e) {
	resguardos_js.resetStyle(e.target);	
};

function resetbordeconcejos(e) {
	concejos_js.resetStyle(e.target);	
};

function resetbordeconcejos(e) {
	parques_js.resetStyle(e.target);	
};

function interaccion_mpios(feature, layer) {
	
	var cod=feature.properties.COD_DANE_1;
	var mpio=feature.properties.NOM_MPIO;
	var depto=feature.properties.NOM_DPTO; 
	var texto="<div align='center'>Departamento:"+feature.properties.NOM_DPTO+"<br>Municipio: "+feature.properties.NOM_MPIO+ "<br><br><button type='button' class='btn btn-primary' onclick='search("+cod+")'>Avance</button></div>"
	
	layer.bindPopup(texto);
	layer.on(
		{
		mouseover: borde,		
		mouseout: resetborde,
		click: function (e) {                
        map.fitBounds(e.target.getBounds());
        }
	});	
};

function interaccion_veredas(feature, layer) {
	var texto="<div align='center'>Municipio:"+feature.properties.NOM_MPIO+"<br>Vereda: "+feature.properties.NOMBRE_VER+ "</div>"
	layer.bindPopup(texto);
	layer.on(
		{
		mouseover: borde,		
		mouseout: resetbordeveredas,
		click: function (e) {                
        map.fitBounds(e.target.getBounds());
        }
	});	
};

function interaccion_resgurados(feature, layer) {
	
	var texto="<div align='center'>Resguardo:"+feature.properties.NOM_RI +"<br>Etnia: "+feature.properties.NOM_ETNIA+ "</div>"
	layer.bindPopup(texto);
	layer.on(
		{
		mouseover: borde,		
		mouseout: resetborderesguardos,
		click: function (e) {                
        map.fitBounds(e.target.getBounds());
        }
	});	
};

function interaccion_concejos(feature, layer) {	
	
	var texto="<div align='center'>Concejo:"+feature.properties.NOM_TC + "</div>"
	layer.bindPopup(texto);
	layer.on(
		{
		mouseover: borde,		
		mouseout: resetbordeconcejos,
		click: function (e) {                
        map.fitBounds(e.target.getBounds());
        }
	});	
};

function interaccion_parques(feature, layer) {	
	
	var texto="<div align='center'>Parque Nacional Natural:"+feature.properties.NOM_PNN + "</div>"
	layer.bindPopup(texto);
	layer.on(
		{
		mouseover: borde,		
		mouseout: resetbordeconcejos,
		click: function (e) {                
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
	bounds = map.fitBounds([[-5, -75],[13, -73]]);
	//var bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
	click: bounds;	
}

extend.addTo(map)

function search(e){
	console.log("en línea")
	for (i = 0; i < municipios.features.length; i++) {
		if(municipios.features[i].properties.COD_DANE_1==e){
			depto=municipios.features[i].properties.NOM_DPTO;
			mpio=municipios.features[i].properties.NOM_MPIO;
			P_cab=municipios.features[i].properties.P_Cab;
			P_ru=municipios.features[i].properties.P_Ru;
			mujeres=municipios.features[i].properties.P_M;
			hombres=municipios.features[i].properties.P_H;
			P_60=municipios.features[i].properties.P_60;
			P_15=municipios.features[i].properties.P_15;
			Analfa=(municipios.features[i].properties.Analfa).toFixed(1) + "%";
			Energia=municipios.features[i].properties.Energia;
			Acueduc=municipios.features[i].properties.Acueduc;
			Alcanta=municipios.features[i].properties.Alcanta;
		} 
    	
	}

	var title="Municipios " + mpio + ", " + depto
	
	$("#feature-title-municipio").html(title);
	$("#s_urbana").html(P_cab);
	$("#s_rural").html(P_ru);
	$("#s_mujer").html(mujeres);
	$("#s_hombre").html(hombres);
	$("#s_mayores").html(P_60);
	$("#s_menores").html(P_15);
	$("#s_analfabetismo").html(Analfa);
	$("#s_energia").html(Energia);
	$("#s_acueducto").html(Acueduc);
	$("#s_alcantarillado").html(Alcanta);
    //$("#feature-info-resguardos").html(content);    
    $("#featureModal-municipios").modal("show");
	//$("#avance").show();
	//$('#titulo').html(tittle)
	//$('#panel_fichas').html(texto)
}

//add a legend to the map
var legend2 = L.control({position: 'bottomleft'});
legend2.onAdd = function (map) {
    var div = L.DomUtil.create('div', 'info legend col-xs-6 col-md-3');
   
    div.innerHTML = "<div><img class='img-responsive' alt='Responsive image' src='assets/visor_acuerdo/Images/density_bar.png'</div> " ;
    
    return div;
};
legend2.addTo(map);
