<?php
    require_once("conexion.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JADA 1 | Margarita S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shirnk-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="Images/5156logoGTI.ico" />

    
        <!-- carga de bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    
        
    <link rel="stylesheet" type="text/css" href="css/estilos_principal.css" />
    <link rel="stylesheet" type="text/css" href="css/parcels.css" />
    
    
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
    

    <aside  class="contenedor-lista-parcelas">
        <div class="lista-parcelas-titulo" style="color:white;"> Mis parcelas </div>
        <div class="lista-parcelas">
            
            
            <?php 
                //Cargar las fincas del usuario activo y sus parcelas
                
            
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
                       
                        <div onClick="selectParcelB(<?php echo $rs2["IDParcela"]; ?>);" class="lista-elemento"> <?php echo $rs2["Nombre"]; ?>
                        <input style="margin-left:1rem; align-self:center;" type="checkbox" class="check_parcela" id="check_parcela_<?php echo $rs2["IDParcela"]; ?>">
                        </div>
                        
                        
                
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
    
    
                            
                                            
      <!-- Listado de parcelas para dispositivos pequeños -->
      <section  class="dropdown open contenedor-lista-parcelas-responsive ">
        <button class="btn btn-secondary dropdown-toggle lista-parcelas-titulo"id="dropDown_parcelas" data-toggle="dropdown"
                                  aria-haspopup="true" aria-expanded="false">Mis parcelas</button> 
        
        <div class="dropdown-menu lista-parcelas-responsive" id="contenedor-parcelas-responsive">
            
                          
            <?php 
                //Cargar las fincas del usuario activo y sus parcelas
                
            
            $sql = "SELECT * FROM fincas WHERE idusuario=".$_SESSION["idusuario"];
            $result = mysqli_query($conn,$sql);

            //Si el usuario existe se genera una sesión con este (si no existía ya previamente)
            if (mysqli_num_rows($result)>0){
                
                while ($row = mysqli_fetch_assoc($result)){
                
                ?>                    
                   <h1 class="dropdown-header"><?php echo $row["Nombre"]; ?></h1>
  
                <?php
                    $sql2 = "SELECT * FROM parcelas WHERE IdFinca=".$row["IdFinca"];
                    $result2 = mysqli_query($conn, $sql2);
                    if(mysqli_num_rows($result2)>0){
                        while($rs2 = mysqli_fetch_assoc($result2)){
                            
                       ?>  
                        <a onClick="selectParcelB(<?php echo $rs2["IDParcela"]; ?>);" class="dropdown-item" href="#!"><?php echo $rs2["Nombre"]; ?>
                            <input type="checkbox" class="check_parcela" id="check_parcela_resp_<?php echo $rs2["IDParcela"]; ?>">
                        </a>
                      <?php    
                        }
                    } else{
                        ?><span class="lista-elemento-no-seleccionable"> No hay parcelas </span><?php
                    }
                }


            } else{
               ?><span class="lista-elemento-header dropdown-item"> No hay fincas </span><?php
            }
            
            ?>
            
           
           
            
        </div>
    </section>
         
         
    <aside class="contenedor-mapa">
     <div id="map" class="map"></div>
    </aside>
          


    </div>

   
    
</body>


    <script src="js/security.js"></script> <!-- comrpueba que la sesión este iniciada -->

   
       <!-- Carga de JQuery y BootStrap-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.js"></script>      
   
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCmdAfLHqRsdHEuXXoA-q6xKXrS4nsk3aY&callback=loadMap"></script>
    <script src="js/parcels.js"></script>

    <script>
        loadMap(); //Carga el mapa        
    </script>



</html>