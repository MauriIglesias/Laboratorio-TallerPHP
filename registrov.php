<?php
    include('conex.php');
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $conexion = Conectarse();
    $consulta="SELECT*FROM usuario where correo='$correo';
    $resultado=mysqli_query($conexion,$consulta);

    $filas=mysqli_num_rows($resultado);

   if($filas){
        ?>
        <?php
        include("registro.php");
        ?>
        <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
        <?php
    }else{
        $sql = "INSERT INTO usuario (correo, nombre, apellido, contrasena, tipo, habilitado) VALUES ($correo, $nombre, $apellido, $contrasena, 1, 0)";
        if (mysqli_query($conexion, $sql)) {
            include("index.php");
        } else {
            ?>
            <?php
            include("registro.php");
            ?>
            <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
            <?php
        }

    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>