<?php

/*
    Fichero que realiza la conexión con la BD del proyecto
 */

$servidor = "localhost"; $usuario = "root"; $password = "";
$bd = "Proyecto";

$response = "Location: index.php"; //página a la que enviar una vez realizada la operación
$msg = ""; //Mensaje de depuración de la página


//Se realiza la conexión con la base de datos
$conn = mysqli_connect($servidor, $usuario, $password,$bd) or die("Fallo al conectar");


?>