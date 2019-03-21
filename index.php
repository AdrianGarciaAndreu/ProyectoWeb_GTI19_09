<?php
    require_once("conexion.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>JADA 1 | Margarita S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shirnk-to-fit=no">
    <link rel="shortcut icon" type="image/x-icon" href="Images/5156logoGTI.ico" />
    
    <link rel="stylesheet" type="text/css" href="css/estilos_principal.css" />

</head>

<script>
    
    
    function cerrarSesion(){
        
        if(confirm("¿Seguro que quieres salir?")){
            window.location = "logout.php"
        }
        
    }
    
     function iniciarSesion(){
        window.location = "login.php"
    }
    
</script>

<body>
    
    
<div class="contenedor-principal">

    <header class="contenedor-cabecera">
        <nav class="menu">
            <img style="display:none" class="menu-icono" src="images/menu.png">
            
            
            <?php
                    session_start();
            
                    if (isset($_SESSION["idusuario"])){

                        echo "<img class='menu-icono' src='images/user.png' onclick='cerrarSesion()'>";
                                                
                        $usr_id = $_SESSION["idusuario"];
                        $sql = "SELECT * FROM usuarios WHERE Id=".$usr_id;
                        $result = mysqli_query($conn,$sql);
                        $usr_name="";

                        if (mysqli_num_rows($result)>0){
                            $row = mysqli_fetch_assoc($result); $usr_name = $row["Nombre"];

                        }

                        
                        echo "<br><span class='msg_welcome'>Bienvenido al sistema, ".$usr_name." </span>";
                        
                        
                    }else{

                        echo "<img class='menu-icono' src='images/user.png' onclick='iniciarSesion()'>";
            
                    }
            
            ?>
            
            
        </nav>
            
        <img class="menu-icono" id="logo-principal" onclick="location='index.php'" src="images/logoGTI.svg" >        
    </header>
    
    
        <div class="slider">
        <ul>
            <li><img src="Images/Imagen1.jpg" alt="">
                <h2>Descripcion de la imagen 1</h2>
            </li>
            <li><img src="Images/imagen2.jpg" alt="">
                <h2>Descripcion de la imagen 2</h2>
            </li>
            <li><img src="Images/imagen3.png" alt="">
                <h2>Descripcion de la imagen 3</h2>
            </li>
            <li><img src="Images/imagen4.png" alt="">
                <h2>Descripcion de la imagen 4</h2>
            </li>
        </ul>
    </div>
    
    
    <div class="descripcionProducto1">
        <p class="descripcion1">Esto es la descripción del producto.</p>
    </div>
    
    
    
    <?php 
        
        if(!isset($_SESSION["idusuario"])){
            echo "<span class='boton1' onclick='iniciarSesion()'>Acceder ahora</span>";
            
        }
        
    ?>

        
          

        <footer class="contenedor-pie">
                   
                <p>
                    <b>Margarita S.L</b><br>
                    Dirección: C/Camino Vera 21
                </p>

                <p>
                    Telefono: 666000122.<br>
                    Email de contacto: margaritaquintero@upv.es
                </p>


            <ul class="politicas-pie">
                <li><a href="#">Política</a></li>
                <li><a href="#">Privacidad</a></li>
                <li><a href="#">Condiciones</a></li>
            </ul>
            
        </footer>
        
    </div>

</body>
</html>