
var map; //Variable para guardar y manipular el mapa

var poly; //Poligono utilizado para crear figuras en el mapa
var points = new Array(); //Punto que representa las ubicaciones de una parcela "sondeadas"



///////////////////////////
//// Functiones de Mapa ///
///////////////////////////


//Carga el mapa en pantalla
function loadMap(){
      
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 40.416775, lng: -3.703790},
          zoom: 5
        });
}    



//Añade un poligono con la matriz de puntos recibida en el mapa y centra el mapa en este poligono
function AddPolygon(tmp_points){

    
        // Construct the polygon.
        poly = new google.maps.Polygon({
          paths: tmp_points,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
        });
        
        poly.setMap(this.map);
        //console.log(poly.getMap);
        
        var center = new google.maps.LatLng(tmp_points[tmp_points.length-1].lat, tmp_points[tmp_points.length-1].lng);
        map.panTo(center);
        map.setZoom(15);


}


/*
 
*/
function AddPoint(tmp_point, tmp_radius){
    
   var point = new google.maps.Circle({
          strokeColor: '#0000FF',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#0000FF',
          fillOpacity: 0.35,
          center: tmp_point,
          radius: tmp_radius
        });
    
    point.setMap(this.map);
    return point;
}



/*
 Obtiene las corrdenadas de la parcela seleccionada
*/
function selectParcel(element, idParcela){
  
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                      
                //Añadir el poligono obtenido
                var tmp_poly = Array();
                var tmp = JSON.parse(this.responseText);

            
                tmp.forEach(function(element){
                    var point = new Object();
                    point.lat = parseFloat(element.latitud);
                    point.lng = parseFloat(element.longitud);

                    tmp_poly.push(point);
                    
                    
                });
            
                //Limpia el poligono anterior
                if(poly != null){ poly.setMap(null);}  
                AddPolygon(tmp_poly); //Se añade el poligono al mapa
                selectParcelSensor(idParcela); //Se añaden también los puntos que pertenecen a la parcela
                
                sleectListElement(element);
            
        }
      };

      xhttp.open("GET", "getPoints.php?opt=0&IDParcela="+idParcela, true);
      xhttp.send();    

}


/*
 Obtiene las ubicaciones con sondas de una parcela.
*/
function selectParcelSensor(idParcela){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
                
                var tmp = JSON.parse(this.responseText);   
                        
                //Se limpian los puntos de la selección anterior
                tmp.forEach(function(element){
                    if(this.points!=null){
                        this.points.forEach(function(e){ e.setMap(null); });
                    };
                });
                this.points = [];
            
            
                //Se añaden los puntos obtenidos de la parcela
                tmp.forEach(function(element){
                    var point = new Object();
                    point.lat = parseFloat(element.latitud);
                    point.lng = parseFloat(element.longitud);
                
                    //Se guardan en un array los puntos añadidos 
                   this.points.push(AddPoint(point,25)); 
                });
            
        }
      };

      xhttp.open("GET", "getPoints.php?opt=1&IDParcela="+idParcela, true);
      xhttp.send();
    
}





function sleectListElement(element) {
                
    //Limpia los elementos seleccionados del listado de parcelas
    var list_elements = Array.from(document.getElementsByClassName("lista-elemento"));          
    list_elements.forEach(function(e) {
        e.classList.remove("lista-elemento-selected");

    });
                                            
    element.classList.add("lista-elemento-selected");
    
}


////////////////////////
// Funciones generales//
////////////////////////

function showHide(id) {
  var x = document.getElementById(id);
    console.log(x);
  if (x.style.display == "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}