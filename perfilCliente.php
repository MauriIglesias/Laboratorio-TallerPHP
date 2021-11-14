<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil</title>
    <style>
        .content {
            margin-top: 80px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php include("navbarCliente.php"); ?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Perfil del cliente </h2>
            <hr />
            <?php
                $correoUsuario = $_SESSION['usuario'];
                $idUsuario = $_SESSION['usuarioid'];
                $tipoUsuario = $_SESSION['usuariotipo'];
                $con = Conectarse();
                //$productId = mysqli_real_escape_string($con,(strip_tags($_GET["productId"],ENT_QUOTES)));
                $sql = mysqli_query($con, "SELECT * FROM usuario WHERE id='$idUsuario'");
                if(mysqli_num_rows($sql) == 0){
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No existe el usuario.</div>';
                }else{
                    $row = mysqli_fetch_assoc($sql);
                    $row_id = $row['id'];
                    $row_nombre = $row['nombre'];
                    $row_apellido = $row['apellido'];
                }

                if(isset($_POST['actualizar'])) {
                    $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                    $apellido = mysqli_real_escape_string($con,(strip_tags($_POST["apellido"],ENT_QUOTES)));
                    $update_usuario = mysqli_query($con, "UPDATE usuario SET nombre='$nombre', apellido='$apellido' WHERE id='$idUsuario'") or die(mysqli_error($con));
                    //$update_producto_imagen = mysqli_query($con, "UPDATE producto_imagen SET imagen='$imagen' WHERE id_producto='$productId'") or die(mysqli_error($con));
                    //$update_producto_cantidad = mysqli_query($con, "UPDATE producto_cantidad SET cantidad='$cantidad' WHERE id_producto='$productId'") or die(mysqli_error($con));
                    if($update_usuario){
                        echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Usuario actualizado con exito.</div>';
                        $sql = mysqli_query($con, "SELECT * FROM usuario WHERE id='$idUsuario'");
                        if(mysqli_num_rows($sql) == 0){
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No existe el usuario.</div>';
                        }else{
                            $row = mysqli_fetch_assoc($sql);
                            $row_id = $row['id'];
                            $row_nombre = $row['nombre'];
                            $row_apellido = $row['apellido'];
                        }
                    }else{
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X;</button>Error, no se pudo actualizar el usuario.</div>';
                    }
                }

                if(isset($_GET['eliminar'])) {
                    if($_GET['eliminar'] == 'eliminar'){
                        $delete_usuario = mysqli_query($con, "DELETE FROM usuario WHERE id='$idUsuario'") or die(mysqli_error($con));
                        if($delete_usuario){
                            header("Location: limpiar.php", true);
                        }else{
                            echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X;</button>Error, no se pudo eliminar su usuario.</div>';
                        }
                    }
                }
            ?>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>" class="form-control"
                            placeholder="Nombre" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        <input type="text" name="apellido" value="<?php echo $row['apellido']; ?>" class="form-control"
                            placeholder="Apellido" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="actualizar" class="btn btn-sm btn-primary" value="Actualizar datos">
                        <?php
                            echo '<a href="perfilCliente.php?eliminar=eliminar" class="btn btn-sm btn-danger">Eliminar cuenta</a>';
                            echo '<a href="listarComprasCliente.php?estado=list&usuarioId='.$idUsuario.'" class="btn btn-sm btn-success">Ver compras</a>';
                        ?>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</body>

</html>