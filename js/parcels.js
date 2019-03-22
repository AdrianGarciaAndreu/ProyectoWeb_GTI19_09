
var map; //Variable para guardar y manipular el mapa

//var poly; //Poligono utilizado para crear figuras en el mapa

var polygons = new Array(); //Poligonos utilizados para representar las parcelas

var points = new Array(); //Punto que representa las ubicaciones de una parcela "sondeadas"
var marcas = new Array(); //Marcadores con cada sensor
var infowindows = new Array(); //Cuadros de información de cada sensor



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
        
       // var center = new google.maps.LatLng(tmp_points[tmp_points.length-1].lat, tmp_points[tmp_points.length-1].lng);
        //map.panTo(center);
        //map.setZoom(15);

    return poly;
    
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


function AddMarker(tmp_marker, info){
    var marker = new google.maps.Marker({
    position: tmp_marker,
    map: this.map,
    title: 'Uluru (Ayers Rock)'
        });
    
    
    marker.addListener('click', function() {
      info.open(this.map, marker);
    });
    
    return marker;
}


function AddInfo(content){
    var infowindow = new google.maps.InfoWindow({
      content: content,
      maxWidth: 200
    });
    
    return infowindow;
}


/*
 Obtiene las corrdenadas de la parcela seleccionada
*/
function selectParcel(idParcela){
  
    
    //var chk = document.getElementById("check_parcela_"+idParcela);
    var chk_resp = document.getElementById("check_parcela_resp_"+idParcela);
   // if (chk.checked){chk.checked = false;} else {chk.checked = true;}
    if (chk_resp!=null){
        if (chk_resp.checked){chk_resp.checked = false;} else {chk_resp.checked = true;}
    }
    
    
    
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
                
                //sleectListElement(element);
            
        }
      };

      xhttp.open("GET", "getPoints.php?opt=0&IDParcela="+idParcela, true);
      xhttp.send();    

}



/*
 Obtiene las corrdenadas de la parcela seleccionada
*/
function selectParcelB(idParcela){
  
    
    
   clearMap(); //Limpia el mapa antes de redibujar

    
    var chk = document.getElementById("check_parcela_"+idParcela);   
    if(chk!=null){
        if (chk.checked){chk.checked = false;} else {chk.checked = true;}
    };
    
    var chk_resp = document.getElementById("check_parcela_resp_"+idParcela);
    if (chk_resp!=null){
        if (chk_resp.checked){chk_resp.checked = false;} else {chk_resp.checked = true;}
    };
    
        
        var parcelasSelected = Array();
        var parcelas = Array.from(document.getElementsByClassName("check_parcela"));
        parcelas.forEach(function(element){
            if(element.checked){
            //Por cada elemento chequeado, pinta un poligono

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
                            //if(poly != null){ poly.setMap(null);}  

                            polygons.push(AddPolygon(tmp_poly)); //Se añade el poligono al mapa
                            selectParcelSensor(tmp_id); //Se añaden también los puntos que pertenecen a la parcela

                            //sleectListElement(element);

                    }
                  };
                
                   var tmp_id = element.id.split("_")[element.id.split("_").length-1]; //ID de cada parcela seleccionada

                  xhttp.open("GET", "getPoints.php?opt=0&IDParcela="+tmp_id, true);
                  xhttp.send();   

            
            
       }
    });
     

}




/*
 Obtiene las ubicaciones con sondas de una parcela.
*/
function selectParcelSensor(idParcela){
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          
                
                var tmp = JSON.parse(this.responseText);   
                        
            
            
                //Se añaden los puntos obtenidos de la parcela
                tmp.forEach(function(element){
                    var point = new Object();
                    point.lat = parseFloat(element.latitud);
                    point.lng = parseFloat(element.longitud);
                
                    //Se guardan en un array los puntos añadidos 
                
                console.log(tmp);
                this.points.push(AddPoint(point,25)); 
                    
                //contenido a mostrar para indicar los datos de cada sensor en el mapa
                 var contenido = "<b>Sensor #</b><br> Humedad:<br> Salindad:<br> Iluminacion:<br> Temperatura:<br> Presion:<br>";
                    
                 this.infowindows.push(AddInfo(contenido));
                 this.marcas.push(AddMarker(point,this.infowindows[this.infowindows.length-1]));
                    
                    
                });
            
        }
      };

      xhttp.open("GET", "getPoints.php?opt=1&IDParcela="+idParcela, true);
      xhttp.send();
    
}



/*
    Limpia los dibujos del mapa
 */
function clearMap(){
    
        //Se limpia el array de poligonos
        polygons.forEach(function(element){
            element.setMap(null);
        });
    
        infowindows.forEach(function(element){
            element.setMap(null);
        });
    
        marcas.forEach(function(element){
            element.setMap(null);
        });
    
        points.forEach(function(element){
            element.setMap(null);
        });
    
    
    
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
    x.style.display = "flex";
  } else {
    x.style.display = "none";
  }
}