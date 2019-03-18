<?php

require_once("conexion.php");


$idParcela = $_GET["IDParcela"]; //Parcela con la que se opera
$option = $_GET["opt"]; //Opción a realizar

$response = array(); //Respuesta 



    switch($option){

        case 0: //Devuelve los puntos que conforman el poligono de una parcela
            $sql = "SELECT * FROM puntos WHERE IdParcela=".$idParcela;
        break;
        case 1: //Devuelve los puntos establecidos para sondear de una parcela
            $sql = "SELECT * FROM Ubicaciones WHERE IdParcela=".$idParcela;
        break;
        
        default: // Por defecto se realiza el caso 0
            $sql = "SELECT * FROM puntos WHERE IdParcela=".$idParcela;
        break;
    
    }
    
    $result = mysqli_query($conn,$sql);
    if (mysqli_num_rows($result)>0){
        while ($row = mysqli_fetch_assoc($result)){
            array_push($response, $row);
        }    
    }



echo json_encode($response);



?>