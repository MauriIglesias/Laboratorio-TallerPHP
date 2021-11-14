<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Datos de Producto</title>

    <style>
        .content {
            margin-top: 80px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php include("navbarAdmin.php");?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Datos del Producto &raquo; Editar datos</h2>
            <hr />
            <?php
                $con = Conectarse();
                $productId = mysqli_real_escape_string($con,(strip_tags($_GET["productId"],ENT_QUOTES)));
                $sql = mysqli_query($con, "SELECT * FROM producto WHERE id='$productId'");
                if(mysqli_num_rows($sql) == 0){
                    header("Location: mainAdmin.php");
                }else{
                    $row = mysqli_fetch_assoc($sql);
                    $row_id = $row['id'];
                    $imagen_query = mysqli_query($con, "SELECT imagen FROM producto_imagen WHERE id_producto='$row_id'");
                    $imagen_row = mysqli_fetch_row($imagen_query);
                    $imagen_url = $imagen_row[0];
                    $cantidad_query = mysqli_query($con, "SELECT cantidad FROM producto_cantidad WHERE id_producto='$row_id'");
                    $cantidad_row = mysqli_fetch_row($cantidad_query);
                    $cantidad = $cantidad_row[0];
                }

                if(isset($_POST['save'])){
                    $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                    $precio = (float) mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
                    $cantidad = (int) mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));
                    $imagen = mysqli_real_escape_string($con,(strip_tags($_POST["imagen"],ENT_QUOTES)));
                    $update_producto = mysqli_query($con, "UPDATE producto SET nombre='$nombre', precio='$precio' WHERE id='$productId'") or die(mysqli_error());
                    $update_producto_imagen = mysqli_query($con, "UPDATE producto_imagen SET imagen='$imagen' WHERE id_producto='$productId'") or die(mysqli_error());
                    $update_producto_cantidad = mysqli_query($con, "UPDATE producto_cantidad SET cantidad='$cantidad' WHERE id_producto='$productId'") or die(mysqli_error());
                    if($update_producto){
                        header("Location: modificarProductoAdmin.php?productId=".$productId."&result=success");
                    }else{
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X;</button>Error, no se pudo guardar los datos.</div>';
                    }
                }

                if(isset($_GET['result']) == 'success'){
                    header("Location: listarProductoAdmin.php");
                }
            ?>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" value="<?php echo $row ['nombre']; ?>" class="form-control"
                            placeholder="Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        <input type="number" name="precio" value="<?php echo $row ['precio']; ?>"
                            class="form-control" placeholder="Precio" required max="99999" min="1">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-3">
                        <input type="number" name="cantidad" value="<?php echo $cantidad; ?>" class="form-control"
                            placeholder="Cantidad (Stock)" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-3">
                        <textarea name="imagen" class="form-control"
                            placeholder="Link"><?php echo $imagen_url; ?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="save" class="btn btn-sm btn-primary" value="Guardar datos">
                        <a href="mainAdmin.php" class="btn btn-sm btn-danger">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>

</body>

</html>