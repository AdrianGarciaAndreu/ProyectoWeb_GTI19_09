<?php

session_start();
$result = "FALSE";
    if (isset($_SESSION["idusuario"])){
        $result="TRUE";
    }
    
echo $result;


?>