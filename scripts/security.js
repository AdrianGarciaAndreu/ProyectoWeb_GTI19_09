  


//Comprueba que la sesión este iniciada
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if(this.responseText=="FALSE"){ //Si el resultado de la comprobación es negativo redirecciona a LP
            window.location = "index.php";
         }
    }
  };

  xhttp.open("GET", "seguridad.php", true);
  xhttp.send();