<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>JADA1 | Margarita S.L</title>
    <link rel="stylesheet" type="text/css" href="styles/estilos_principal.css" />
</head>

<style>
    

    
</style>

<script>
        
   function formulario_submit(fname){
      var element = document.getElementById(fname);
      element.submit();
     }
</script>
    

<body>
    
<div class="contenedor-principal">
        
      <header class="contenedor-cabecera">
            <nav class="menu">
                <img style="display:none" class="menu-icono" src="images/menu.png">
                
                
                <?php

                    if (isset($_SESSION["idusuario"])){
                        echo "<img class='menu-icono' src='images/user.png' onclick='cerrarSesion()'>";
                    }else{

                        echo "<img class='menu-icono' src='images/user.png' onclick='iniciarSesion()'>";
            
                    }
                ?>
                
            </nav>
            
            <img class="menu-icono" id="logo-principal" onclick="location='index.php'" src="images/logoGTI.svg" >
            
        </header>
        
        
        <section class="contenedor-login">
            <h3>Acceso al sistema</h3>
            
                <?php
                    //Si se ha introdecido un usuario, y este no es correcto 
                    if (isset($_GET["msg"])){
                        echo "<span class='warning_msg'>".$_GET["msg"]."</span>";
                    }
                ?>
            
            <form id="formulario_login" action="login_validate.php" method="GET">
                Nombre: <input type="text" name="user"> <br><br>
                Contrase&ntilde;a: <input type="password" name="pass"><br><br>
                
                <div class="boton1" id="formulario1_boton" onclick="formulario_submit('formulario_login')">Acceder</div>
            </form>
        </section>
        
        
        
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