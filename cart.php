<?php session_start(); 
//aqui empieza el carrito

	if(isset($_SESSION['carrito'])){
		$carrito_mio=$_SESSION['carrito'];
		if(isset($_POST['id'])){
            $id=$_POST['id'];
			$nombre=$_POST['nombre'];
			$precio=$_POST['precio'];
			$cantidad=$_POST['cantidad'];
			$num=0;
     		$carrito_mio[]=array("id"=>$id,"nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);
        
 		}
	}else{
		$id=$_POST['id'];
		$nombre=$_POST['nombre'];
		$precio=$_POST['precio'];
		$cantidad=$_POST['cantidad'];
		$carrito_mio[]=array("id"=>$id,"nombre"=>$nombre,"precio"=>$precio,"cantidad"=>$cantidad);


	}
	

$_SESSION['carrito']=$carrito_mio;


//aqui termina el carrito

header("Location: ".$_SERVER['HTTP_REFERER']."");

?>
