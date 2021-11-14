<?php
include("conex.php");
$con = Conectarse();

$insert1 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Contado')") or die(mysqli_error($con));
$insert2 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('VISA')") or die(mysqli_error($con));
$insert3 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Mastercard')") or die(mysqli_error($con));
$insert4 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('American Express')") or die(mysqli_error($con));
$insert5 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('PayPal')") or die(mysqli_error($con));
$insert6 = mysqli_query($con, "INSERT INTO pago(nombre) VALUES('Mercado Pago')") or die(mysqli_error($con));
$insert7 = mysqli_query($con, "INSERT INTO usuario (correo, nombre, apellido, contrasena, tipo, habilitado) VALUES ('admin@admin', 'admin', 'admin', 'admin', 0, 1)") or die(mysqli_error($con));
include("index.php");
?>