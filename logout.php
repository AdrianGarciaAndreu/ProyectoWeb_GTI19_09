<?php


//se cierra la sesión abierta en el sistema
session_start();
unset($_SESSION["idusuario"]);

header("Location: index.php");


?>