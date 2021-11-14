<?php
include("conex.php");
$con = Conectarse();
$consulta1="SELECT * FROM pago";
$consulta2="SELECT * FROM usuario";
$resultado1=mysqli_query($con,$consulta1);
$resultado2=mysqli_query($con,$consulta2);

$filas1=mysqli_num_rows($resultado1);
$filas2=mysqli_num_rows($resultado2);

if(!$filas1){
    $insert1 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Contado')") or die(mysqli_error($con));
    $insert2 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('VISA')") or die(mysqli_error($con));
    $insert3 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Mastercard')") or die(mysqli_error($con));
    $insert4 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('American Express')") or die(mysqli_error($con));
    $insert5 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('PayPal')") or die(mysqli_error($con));
    $insert6 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Mercado Pago')") or die(mysqli_error($con));
}
if(!$filas2){
    $insert7 = mysqli_query($con, "INSERT INTO usuario (correo, nombre, apellido, contrasena, tipo, habilitado) 
    VALUES ('admin@admin', 'admin', 'admin', 'admin', 0, 1)") or die(mysqli_error($con));
}
include("index.php");
?>