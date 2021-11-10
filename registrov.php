<?php
    include('conex.php');
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $correo=$_POST['correo'];
    $contrasena=$_POST['contrasena'];

    $conexion = Conectarse();
    $consulta="SELECT * FROM usuario where correo='$correo'";
    $resultado=mysqli_query($conexion,$consulta);

    $filas=mysqli_num_rows($resultado);

   if($filas){
        include("registro.php");
        echo "<h1 class='bad'>ERROR CORREO EN USO</h1>";
    }else{
        $sql = "INSERT INTO usuario (correo, nombre, apellido, contrasena, tipo, habilitado) VALUES ('$correo', '$nombre', '$apellido', '$contrasena', 1, 0)";
        if (mysqli_query($conexion, $sql)) {
            include("index.php");
        } else {
            include("registro.php");
            echo "<h1 class='bad'>ERROR DE REGISTRO</h1>";
        }

    }
    mysqli_free_result($resultado);
    mysqli_close($conexion);
?>