<?php session_start(); 
include("conex.php");
$con = Conectarse();
if(isset($_SESSION['carrito'])){
    $compra = $_SESSION['carrito'];
    $pago = $_POST('pago');

    $total=0;
    for($i=0;$i<=count($compra)-1;$i ++){
    if($compra[$i]!=NULL){ 
    $total=$total + ($compra[$i]['precio'] * $compra[$i]['cantidad']);
    }}


    $idusuario = $_SESSION['usuarioid'];
    $insert = mysqli_query($con, "INSERT INTO compra(id_usuario , id_pago, monto)
                                                        VALUES($idusuario, $pago, $precio)") or die(mysqli_error($con));
     if($insert){
        $sql = mysqli_query($con, "SELECT * FROM compra WHERE id_usuario=$idusuario and id_pago=$pago and monto=$precio");
        if($sql){
            $id_compra = (int) mysqli_fetch_assoc($sql)['id'];
            for($i=0;$i<=count($compra)-1;$i ++){
                if($compra[$i]!=NULL){ 
                $id_producto = $compra[$i]['id'];
                $insert = mysqli_query($con, "INSERT INTO compra_producto(id_compra  , id_producto)
                                                VALUES($id_compra, $id_producto)") or die(mysqli_error($con));


                }}
        }
     }

}




header("Location: ".$_SERVER['HTTP_REFERER']."");
?>