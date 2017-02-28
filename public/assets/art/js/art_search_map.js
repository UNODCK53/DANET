bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));

var map = new L.Map('map', {center: [4,-74], zoom: 5, zoomControl: true, attributionControl: false});

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
var style_colombia = {"color": "#202020", "weight": 1.5, "opacity": 0.9 };
var colombia_js= L.geoJson(colombia, {style: style_colombia}); 
colombia_js.addTo(map)

var municipios_js= L.geoJson(municipios, {style: estilo_municipios, onEachFeature: interaccion_mpios});      
municipios_js.addTo(map)

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

var control = L.Control.styledLayerControl(baseMaps);
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

//funcion que define la interacción de la capa municipios
		
function interaccion_mpios(feature, layer) {	
	var cod=feature.properties.COD_DANE
	var mpio=feature.properties.NOM_MPIO
	var depto=feature.properties.NOM_DPTO 
	var texto="<div align='center'>Departamento:"+feature.properties.NOM_DPTO+"<br>Municipio: "+feature.properties.NOM_MPIO+ "<br><br><button type='button' class='btn btn-primary' onclick='search("+cod+",\""+mpio+"\",\""+depto+"\")'>Avance</button> </div>"
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

function search(cod,mpio, depto){	
	var tittle="Reporte de avance del municipio de " + mpio + ", "+depto
	var texto='<div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/DNP/'+cod+'.pdf"><img src="assets/art/img/dnp.png" alt="No images" class="img-rounded" style="height: 75px"></a></div> <div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/detallada/'+cod+'.pdf"><img src="assets/art/img/detallada.png" alt="No images" class="img-rounded" style="height: 75px"></a></div><div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/poblacional/'+cod+'.pdf"><img src="assets/art/img/poblacional.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>    <div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/Social/'+cod+'.pdf"><img src="assets/art/img/social.png" alt="No images" class="img-rounded" style="height: 75px"></a></div><div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/Inversion/'+cod+'.pdf"><img src="assets/art/img/inversion.png" alt="No images" class="img-rounded" style="height: 75px"></a></div><div class="col-xs-12 col-sm-6 col-md-1"><a target="_blank" href="assets/art/documentos/Infografias/ZVT/'+cod+'.pdf"><img src="assets/art/img/zv.png" alt="No images" class="img-rounded" style="height: 75px"></a></div><div class="col-xs-12 col-sm-6 col-md-2"><a target="_blank" href="assets/art/documentos/Infografias/Mapas/'+cod+'.pdf"><img src="assets/art/img/mapa.png" alt="No images" class="img-rounded" style="height: 75px"></a></div>'
	$("#avance").show();
	$('#titulo').html(tittle)
	$('#panel_fichas').html(texto)
}