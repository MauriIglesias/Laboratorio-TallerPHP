<?php session_start(); 
header("Location: ".$_SERVER['HTTP_REFERER']."");
unset($_SESSION['carrito']);


$carrito_mio=$_SESSION['carrito'];
$_SESSION['carrito']=$carrito_mio;

?>