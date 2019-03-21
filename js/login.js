
//Envia un formulario a partir de su ID
function formulario_submit(fname){
  var element = document.getElementById(fname);
  element.submit();
 }


//Función para realizar un cambio de contraseña olvidada
function resetPassword(element){
    
  //Se inhabilita el boton del formulario
  document.getElementById("recuperar_pass_spinner").style.display="flex";
  element.disabled = true;

  var correo = document.getElementById("resetPassCorreo").value;
    
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     if(this.response=="[OK]"){
         
         document.getElementById("recuperar_pass_btnClose").click();
         alert("Contraseña actualizada correctamente, revise su buzon de entrada.");
         //location.reload();
         
     }else{
         document.getElementById("recuperar_pass_failmsg").style.display="block";
     }
      
        //Se rehabilita el formulario
        document.getElementById("recuperar_pass_spinner").style.display="none";
        element.disabled = false;
        
    }
      
  };
  xhttp.open("GET", "change_pass.php?Correo="+correo, true);
  xhttp.send();
    
}