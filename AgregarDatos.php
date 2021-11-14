<?php
include("conex.php");
$con = Conectarse();
$consulta1="SELECT * FROM pago";
$consulta2="SELECT * FROM usuario";

$consulta3="SELECT * FROM compra";
$consulta4="SELECT * FROM producto";
$consulta5="SELECT * FROM compra_producto";
$consulta6="SELECT * FROM feedback";


$resultado1=mysqli_query($con,$consulta1);
$resultado2=mysqli_query($con,$consulta2);

$resultado3=mysqli_query($con,$consulta3);
$resultado4=mysqli_query($con,$consulta4);
$resultado5=mysqli_query($con,$consulta5);
$resultado6=mysqli_query($con,$consulta6);


$filas1=mysqli_num_rows($resultado1);
$filas2=mysqli_num_rows($resultado2);

$filas3=mysqli_num_rows($resultado3);
$filas4=mysqli_num_rows($resultado4);
$filas5=mysqli_num_rows($resultado5);
$filas6=mysqli_num_rows($resultado6);


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
    $insert8 = mysqli_query($con, "INSERT INTO usuario (correo, nombre, apellido, contrasena, tipo, habilitado) 
    VALUES ('cliente@cliente', 'cliente', 'cliente', 'cliente', 1, 1)") or die(mysqli_error($con));
}


if(!$filas3) {
    $insert9 = mysqli_query($con, "INSERT INTO compra (id_usuario, id_pago, monto) 
    VALUES (2, 1, 500)") or die(mysqli_error($con));
}
if(!$filas4) {
    $insert10 = mysqli_query($con, "INSERT INTO producto (nombre, precio) 
    VALUES ('TV 32 FHD', 1500)") or die(mysqli_error($con));
    $insert11 = mysqli_query($con, "INSERT INTO producto_cantidad (id_producto, cantidad) 
    VALUES (1, 80)") or die(mysqli_error($con));
    $insert12 = mysqli_query($con, "INSERT INTO producto_imagen (id_producto, imagen) 
    VALUES (1, 'https://www.precio-calidad.com.ar/wp-content/uploads/2021/03/LED-AOC-32S5295-77G-4-800x800.jpg')") or die(mysqli_error($con));
}
if(!$filas5) {
    $insert13 = mysqli_query($con, "INSERT INTO compra_producto (id_compra, id_producto, cantidad) 
    VALUES (1, 1, 1)") or die(mysqli_error($con));
}
if(!$filas6) {
    $insert14 = mysqli_query($con, "INSERT INTO feedback (id_compra, id_usuario, comentario) 
    VALUES (1, 2, 'Excelente atencion')") or die(mysqli_error($con));
}

include("index.php");
?>