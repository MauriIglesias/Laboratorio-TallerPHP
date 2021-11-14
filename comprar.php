<?php session_start(); 
include("conex.php");
$con = Conectarse();
if(isset($_SESSION['carrito'])){
    $compra = $_SESSION['carrito'];
    $pago = $_POST['pago']; //$_SESSION['pago']; $_POST['pago'];
    if(isset($_POST['pago']))
        echo $_POST['pago'];
    echo $pago;
    echo 'aqui deveria estar';
    $total=0;
    for($i=0;$i<=count($compra)-1;$i ++){
    if($compra[$i]!=NULL){ 
    $total=$total + ($compra[$i]['precio'] * $compra[$i]['cantidad']);
    }}
    $idusuario = $_SESSION['usuarioid'];
    $insert = mysqli_query($con, "INSERT INTO compra(id_usuario , id_pago, monto)
                                                        VALUES('$idusuario', '$pago', '$total')") or die(mysqli_error($con));

    

     if($insert){
        $sql = mysqli_query($con, "SELECT * FROM compra WHERE id_usuario='$idusuario' and id_pago='$pago' and monto='$total'");
        if($sql){
            $id_compra = (int) mysqli_fetch_assoc($sql)['id'];
            for($i=0;$i<=count($compra)-1;$i ++){
                if($compra[$i]!=NULL){ 
                $id_producto = $compra[$i]['id'];
                $canti = $compra[$i]['cantidad'];
                $insert = mysqli_query($con, "INSERT INTO compra_producto(id_compra  , id_producto, cantidad)
                                                VALUES('$id_compra', '$id_producto', '$canti')") or die(mysqli_error($con));

                $cantidad_query = mysqli_fetch_row(mysqli_query($con, "SELECT cantidad FROM producto_cantidad WHERE id_producto='$id_producto'"));
                $c = $cantidad_query[0];
                $cantidad =$c - $compra[$i]['cantidad'];

                $update_producto_cantidad = mysqli_query($con, "UPDATE producto_cantidad SET cantidad='$cantidad' WHERE id_producto='$id_producto'") or die(mysqli_error());

                
                


                }}
        }
     }

}


unset($_SESSION['carrito']);


$carrito_mio=$_SESSION['carrito'];
$_SESSION['carrito']=$carrito_mio;


header("Location: ".$_SERVER['HTTP_REFERER']."");
?>