$(function() {
  $("body").on('shown.bs.tab','#link1', function() { 
    map.invalidateSize(false);
  });
});
//VARIABLE CREDITOS DEL MAPA
var creditos= " <b>UNODC Colombia 2014</b> - Desarrollo Alternativo - Unidad de información y análisis<br>La información geográfica presentada aqui no representa reconocimiento o aceptación por parte de las Naciones Unidas. 27/06/2016 <br>&copy; <a href='http://leafletjs.com/'>Leaflet</a> | &copy; <a href='http://www.highcharts.com/'>Highcharts</a>" 


//POSICIÓN INICIAL DEL MAPA
bounds = new L.LatLngBounds(new L.LatLng(-7, -90), new L.LatLng(15, -50));
var map = new L.Map('acuerdo', {center: [4,-74], zoom: 6, maxBounds: bounds, zoomControl: false, attributionControl: false});
//var mymap = L.map('acuerdo').setView([51.505, -0.09], 13);

//MAPAS BASE
var topoMap_1=L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>', maxZoom: 15 , minZoom: 4
}).addTo(map); 
var topoMap_2 = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a>'});
