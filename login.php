<?php
include('conex.php');
$usuario=$_POST['logimeEmail'];
$contraseña=$_POST['loginPassword'];
session_start();
$_SESSION['usuario']=$usuario;

$conexion = Conectarse();
$consulta="SELECT*FROM usuario where correo='$usuario' and contrasena='$contraseña' and habilitado=1";
$resultado=mysqli_query($conexion,$consulta);

$filas=mysqli_num_rows($resultado);

if($filas){
    $consulta2="SELECT*FROM usuario where correo='$usuario' and contrasena='$contraseña' and tipo=1";
    $resultado2=mysqli_query($conexion,$consulta2);
    $filas2=mysqli_num_rows($resultado2);
    if($filas2){
        header("location:productoCliente.php");
    }else{
        header("location:agregarProductoAdmin.php");
    }

}else{
    ?>
    <?php
    include("index.php");

  ?>
  <h1 class="bad">ERROR DE AUTENTIFICACION</h1>
  <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);
?>