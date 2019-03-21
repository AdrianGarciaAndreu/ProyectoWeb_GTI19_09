var map;

var target = "map";
var layers = new Array(); //Capa con las capas del mapa

var zoom = 5;
//var center = ol.proj.fromLonLat([-3.703790,40.416775]);
var center = ol.proj.fromLonLat([0, 0]);

function loadMap(){
            
        var MainSource = new ol.source.OSM; //Motor de mapas
        var MainTile = new ol.layer.Tile({
            source: MainSource
        }); //Capa utilizada por el motor de mapas
    
        layers.push(MainTile); //Carga la capa en el motor de mapas
        
        //Vista de la capa
        var view = new ol.View({
            center: center,
            zoom: zoom,
        });
    
        // Construye el mapa
        map = new ol.Map({ target,layers, view });
    
}



function AddPolygon(){
    
    
    
    var a  = a[0] = { lng:0, lat:0};
    a  = a[1] = { lng:1, lat:1};
    a  = a[2] = { lng:2, lat:2};
    
    var ring = [
    [a[0].lng, a[0].lat], [a[1].lng, a[1].lat],
    [a[2].lng, a[2].lat], [a[0].lng, a[0].lat]
    ];

    
    var polygon = new ol.geom.Polygon([ring]);

    polygon.transform('EPSG:4326', 'EPSG:3857');

        // Create feature with polygon.
    var feature = new ol.Feature(polygon);

    // Create vector source and the feature to it.
    var vectorSource = new ol.source.Vector();
    vectorSource.addFeature(feature);

    // Create vector layer attached to the vector source.
    var vectorLayer = new ol.layer.Vector({
      source: vectorSource
    });

    // Add the vector layer to the map.
    map.addLayer(vectorLayer);
    map.render();

}