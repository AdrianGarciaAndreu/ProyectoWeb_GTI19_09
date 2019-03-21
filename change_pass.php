<?php
require_once("conexion.php");



/*
 Función para generar cadenas de caracteres aleatorias
 */
function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



/*
 Función para enviar un mail con una contraseña nueva a los usuarios
 */
function mailTo($destino, $pass){
    
    $to      = $destino;
    $subject = "JADA 1 | Cambio de contraseña";
    $message = "Su contraseña ha sido actualizada a la siguiente: ".$pass.", por favor al acceder a la aplicación modifique su contraseña. <br>Por favor no responda a este mensaje";
    $headers = "From: margaritaUPV@gmail.com";

mail($to, $subject, $message, $headers);
    
}












$response="[NO]";

$correo = $_GET["Correo"]; //Si se ha introducido un mail se cambia la contraseña
if($correo!=null or strlen($correo)>0){
    $sql = "SELECT * FROM usuarios WHERE Correo LIKE '".$correo."'";
    
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
            
        
            $nPass = generateRandomString(8); //Nueva contraseña aleatoria
        
            $sql2 = "UPDATE usuarios SET Pass='".$nPass."' WHERE Id=".$row["Id"]; //Se actualiza la contraseña por una aleatoria
        
            mysqli_query($conn, $sql2);
        
            //Esta se envia por mail
            mailTo($row["Correo"],$nPass);
        
            $response="[OK]";
    }
    
}



echo $response;

?>