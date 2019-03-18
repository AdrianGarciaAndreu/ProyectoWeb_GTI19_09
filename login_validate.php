<?php

require_once("conexion.php");

//se captura el usuario que intenta acceder al sistema y se realiza con este una petición a la BD
$usr_name = $_GET["user"];
$usr_psw = $_GET["pass"];
$sql = "SELECT * FROM usuarios WHERE Nombre LIKE '".$usr_name."' AND Pass LIKE '".$usr_psw."' ";


$result = mysqli_query($conn,$sql);

//Si el usuario existe se genera una sesión con este (si no existía ya previamente)
if (mysqli_num_rows($result)>0){
    $msg = "Usuario exitente";
    $row = mysqli_fetch_assoc($result);
    
    session_start();
    //if (!isset($_SESSION["idusuario"])){
        $_SESSION["idusuario"] = $row["Id"]; //sesión que almacena el usuario logueado
    //}
    
    $msg = $row["Nombre"].", bienvenido!";
    $response = "Location:index.php?msg=".$msg;

} else{
    $msg = "El nombre de usuario o la contraseña no son correctos";
    $response = "Location: login.php?msg=".$msg;
}

echo $msg;
header($response);  


?>