<?php
session_start(); 
unset($_SESSION['carrito']);
$carrito_mio=$_SESSION['carrito'];
$_SESSION['carrito']=$carrito_mio;
header("location:index.php");
?>