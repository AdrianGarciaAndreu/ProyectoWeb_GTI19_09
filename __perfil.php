<!DOCTYPE html>

<?php require_once("conexion.php"); ?>
<script src="js/security.js"></script>

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

   

    <?php
    
        session_start();
        $sql="SELECT * FROM Usuarios WHERE Id=".$_SESSION["idusuario"];
        $result = mysqli_query($conn,$sql);
        
        if (mysqli_num_rows($result)>0){
            $rs = mysqli_fetch_assoc($result)
    
    ?>
        
     <section class="contenedor-perfiles">        
     <form action="alterUser.php" method="GET">

         <div class="perfiles-header form">

             <label for="recuperar_pass_form">Nombre</label>
             <input type="text" class="form-control mb-2 mr-sm-2" id="perfiles_nombre" name="perfiles_Nombre" value="<?php echo $rs["Nombre"];?>">
         </div>

          <div class="form-group">

           <br>
            <input type="hidden" name="perfiles_Id" value="<?php echo $rs["Id"]; ?>">
            
            <label for="recuperar_pass_form">Apellido 1</label>
            <input type="text" class="form-control-sm" name="perfiles_Apellido1" id="perfiles_Apellido1" value="<?php echo $rs["Apellido1"];?>">

            <label for="recuperar_pass_form">Apellido 2</label>
            <input type="text" class="form-control-sm" name="perfiles_Apellido2" id="perfiles_Apellido2" value="<?php echo $rs["Apellido2"];?>">
            <br>

            <label for="recuperar_pass_form">Contrase&ntilde;a</label>
            <input type="password" class="form-control" name="perfiles_Pass" id="perfiles_Pass" value="<?php echo $rs["Pass"];?>">

            <label for="recuperar_pass_form">Correo</label>
            <input type="email" class="form-control" name="perfiles_Correo" id="perfiles_Correo" value="<?php echo $rs["Correo"];?>"><br>


            <label for="recuperar_pass_form">Tel&eacute;fono</label>
            <input type="tel" class="form-control-sm" name="perfiles_Telefono" id="perfiles_Telefono" value="<?php echo $rs["Telefono"];?>">

            <label for="recuperar_pass_form">Provincia</label>
            <input type="text" class="form-control-sm" name="perfiles_Provincia" id="perfiles_Provincia" value="<?php echo $rs["Provincia"];?>">

            <br><br>
            <input class="form-control btn-primary" type="submit" value="Actualizar datos de perfil">

          </div>

    </form>
    </section>

       <?php 
                
            } //Fin de la comprobación de tamaño del resultado de la query
        ?>
    
    <!-- Carga de JQuery y BootStrap-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.js"></script>      

    
</body>
</html>