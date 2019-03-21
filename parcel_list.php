<?php
    require_once("conexion.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JADA 1 | Margarita S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shirnk-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="Images/5156logoGTI.ico" />
    
    <link rel="stylesheet" type="text/css" href="css/estilos_principal.css" />
    <link rel="stylesheet" type="text/css" href="css/parcels.css" />
    
    <link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css" type="text/css">
    
</head>
<body>
   

    <header class="contenedor-cabecera">
       
               <img class="menu-icono" id="logo-principal" onclick="location='index.php'" src="images/logoGTI.svg" >  
       
        <nav class="menu">            
            <img class='menu-icono' src='images/user.png' onclick='cerrarSesion()'>
            <img  class="menu-icono" src="images/menu.png">

            
        </nav>
            
      
    </header>
    

    <div class="contenedor-principal">
    

    <aside class="contenedor-lista-parcelas">
        <div class="lista-parcelas-titulo"> Mis parcelas </div>
        <div class="lista-parcelas">
            
            
            <?php 
                //Cargar las fincas del usuario activo y sus parcelas
                
            session_start();
            
            $sql = "SELECT * FROM fincas WHERE idusuario=".$_SESSION["idusuario"];
            $result = mysqli_query($conn,$sql);

            //Si el usuario existe se genera una sesión con este (si no existía ya previamente)
            if (mysqli_num_rows($result)>0){
                
                while ($row = mysqli_fetch_assoc($result)){
                
                ?>
                    <span onClick="showHide('lista-elementos_<?php echo $row["IdFinca"]; ?>');" class="lista-elemento-head"> <?php echo $row["Nombre"]; ?></span>
                                
                <?php
                    $sql2 = "SELECT * FROM parcelas WHERE IdFinca=".$row["IdFinca"];
                    $result2 = mysqli_query($conn, $sql2);
                    echo "<div class='lista-contenedores-porFinca' style='display:none;' id='lista-elementos_".$row["IdFinca"]."'>";
                    if(mysqli_num_rows($result2)>0){
                        while($rs2 = mysqli_fetch_assoc($result2)){
                            
                       ?>
                       
                        <span onClick="selectParcel(this,<?php echo $rs2["IDParcela"]; ?>);" class="lista-elemento"> <?php echo $rs2["Nombre"]; ?></span>
                        
                
                      <?php
                            
                            
                            
                        }
                    } else{
                        ?><span class="lista-elemento-no-seleccionable"> No hay parcelas </span><?php
                    }
                    echo "</div>";
                }


            } else{
               ?><span class="lista-elemento-header"> No hay fincas </span><?php
            }
            
            ?>
            
            
                        
        </div>
    </aside>
         
         
    <aside class="contenedor-mapa">
     <div id="map" class="map"></div>
    </aside>
          


    </div>

   
    
</body>


    <script src="js/security.js"></script> <!-- comrpueba que la sesión este iniciada -->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmdAfLHqRsdHEuXXoA-q6xKXrS4nsk3aY&callback=loadMap"></script>
    <script src="js/parcels.js"></script>

    <script>
        loadMap(); //Carga el mapa        
    </script>



</html>