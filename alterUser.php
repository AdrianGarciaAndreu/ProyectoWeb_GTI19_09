<?php

//print_r(array_values($_GET));
require_once("conexion.php");
$response = "[NO]";

$sql = "UPDATE Usuarios ";
$sql .= "SET Nombre='".$_GET["perfiles_Nombre"]."', ";
$sql .= " Apellido1='".$_GET["perfiles_Apellido1"]."', ";
$sql .= " Apellido2='".$_GET["perfiles_Apellido2"]."', ";
$sql .= " Pass='".$_GET["perfiles_Pass"]."', ";
$sql .= " Correo='".$_GET["perfiles_Correo"]."', ";
$sql .= " Telefono='".$_GET["perfiles_Telefono"]."', ";
$sql .= " Provincia='".$_GET["perfiles_Provincia"]."' ";
$sql .= "WHERE Id=".$_GET["perfiles_Id"];

//echo $sql;

mysqli_query($conn, $sql); //se actulizan los datos del usuario
$response = "[OK]";

echo $response;
//TODO: cambiar redirección a la página de iniciio del usuario.
header("Location: __perfil.php");

?>