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

             <label for="formGroupExampleInput">Nombre</label>
             <input type="text" class="form-control mb-2 mr-sm-2" id="perfiles_nombre" value="<?php echo $rs["Nombre"];?>">
         </div>

          <div class="form-group">

           <br>
            <label for="formGroupExampleInput">Apellido 1</label>
            <input type="text" class="form-control-sm" id="formGroupExampleInput" value="<?php echo $rs["Apellido1"];?>">

            <label for="formGroupExampleInput">Apellido 2</label>
            <input type="text" class="form-control-sm" id="formGroupExampleInput" value="<?php echo $rs["Apellido2"];?>">
            <br>

            <label for="formGroupExampleInput">Contrase&ntilde;a</label>
            <input type="password" class="form-control" id="formGroupExampleInput" value="<?php echo $rs["Pass"];?>">

            <label for="formGroupExampleInput">Correo</label>
            <input type="email" class="form-control" id="formGroupExampleInput" value="<?php echo $rs["Correo"];?>"><br>


            <label for="formGroupExampleInput">Tel&eacute;fono</label>
            <input type="tel" class="form-control-sm" id="formGroupExampleInput" value="<?php echo $rs["Telefono"];?>">

            <label for="formGroupExampleInput">Provincia</label>
            <input type="text" class="form-control-sm" id="formGroupExampleInput" value="<?php echo $rs["Provincia"];?>">

            <br><br>
            <input class="form-control btn-danger" type="submit" value="Actualizar datos de perfil">

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