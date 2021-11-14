<?php
include('conex.php');
$usuario=$_POST['logimeEmail'];
$contraseña=$_POST['loginPassword'];
session_start();


$conexion = Conectarse();
$consulta="SELECT*FROM usuario where correo='$usuario' and contrasena='$contraseña' and habilitado=1";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    $row = mysqli_fetch_assoc($resultado);
    $_SESSION['usuario']=$row['correo'];
    $_SESSION['usuarioid']=$row['id'];
    $_SESSION['usuariotipo']=$row['tipo'];
    $consulta2="SELECT*FROM usuario where correo='$usuario' and contrasena='$contraseña' and tipo=1";
    $resultado2=mysqli_query($conexion,$consulta2);
    $filas2=mysqli_num_rows($resultado2);
    if($filas2){
        header("location:listarProductoCliente.php");
    }else{
        header("location:listarProductoAdmin.php");
    }

}else{
    include("index.php");
    echo "<h1 class='bad'>ERROR DE AUTENTIFICACION</h1>";
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>