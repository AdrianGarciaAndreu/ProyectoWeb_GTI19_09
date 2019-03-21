<!DOCTYPE html>
<html lang="es">
<head>
    
    <meta charset="UTF-8">
    <title>JADA 1 | Margarita S.L</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shirnk-to-fit=no">
    
    <link rel="shortcut icon" type="image/x-icon" href="Images/5156logoGTI.ico" />
    <link rel="stylesheet" type="text/css" href="css/estilos_principal.css" />
    
    <!-- carga de bootstrap -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    
    
</head>

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
               <div class="form-group">
                    Nombre: <input type="text" name="user"> <br><br>
                    Contrase&ntilde;a: <input type="password" name="pass"><br><br>

                    <div class="btn btn-primary" id="formulario1_boton" onclick="formulario_submit('formulario_login')">Acceder</div>
                </div>
                
                            
            <button type="button" data-toggle="modal" data-target="#recuperar_pass" class="btn btn btn-info"> Cambiar contraseña </button>
                
            </form>

        </section>
        
        <!-- ------------------------------------------ -->
        <!-- Diálogo modal para el cambio de contraseña -->
        <!-- ------------------------------------------ -->
        <div class="modal" id="recuperar_pass" tabindex="-1" role="dialog" aria-labelledby="titulo_recuperar_pass" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="titulo_recuperar_pass">Cambio de contraseña</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              
                  
                <!-- Mensaje para fallo al introducir el correo -->
                 <div id="recuperar_pass_failmsg" style="display:none" class="alert alert-warning" role="alert">
                  <strong>Ocurri&oacute; un problema!</strong> No se ha encontrado la dirección de correo en la base de datos, asegurese de que la ha introducido correctamente.
                </div>  
              
              <div class="modal-body">           
                <div class="form-group">
                    <p> Para cambiar su contraseña, introduzca su dirección de correo electronico </p>
                    
                    <input id="resetPassCorreo" size="30" type="text" placeholder="Nombre de usuario, o email...">
                    <br><br>
                    <div class="d-flex justify-content-center">
                        <div id="recuperar_pass_spinner" class="spinner-border" role="status" style="display:none"></div>
                    </div>
                </div>
                
              </div>
              
              <div class="modal-footer">
                <button id="recuperar_pass_btnClose" type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button onclick="resetPassword(this);" type="button" class="btn btn-warning">Continuar</button>
              </div>
            </div>
          </div>
        </div>
        <!-- ------------------------------------------ -->
        <!-- Final del dialogo modal -->
        <!-- ------------------------------------------ -->
        
        
        
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
    
    <!-- Carga de JQuery y BootStrap-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>
    
    <script src="js/login.js"></script> <!-- archivo con funciones especificas para esta sección-->
    
</body>
</html>