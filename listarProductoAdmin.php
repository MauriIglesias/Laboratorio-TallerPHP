<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Productos</title>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        .content {
            margin-top: 80px;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php include("navbarAdmin.php");?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Lista de Productos</h2>
            <hr />

    <?php
        $con = Conectarse();
        // Eliminar Prodcuto -> Dejar sin stock
        if(isset($_GET['aksi']) == 'delete'){
            $productId = mysqli_real_escape_string($con,(strip_tags($_GET["productId"],ENT_QUOTES)));
            $select = mysqli_query($con, "SELECT * FROM producto WHERE id='$productId'");
            if(mysqli_num_rows($select) == 0){
                echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button> No se encontraron datos de Producto.</div>';
            }else{
                $pseudo_delete = mysqli_query($con, "UPDATE producto_cantidad SET cantidad=-1 WHERE id_producto='$productId'") or die(mysqli_error());
                if($pseudo_delete){
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button> Datos eliminados con exito.</div>';
                }else{
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button> Error, no se pudo eliminar el producto.</div>';
                }
            }
        }   
    ?>

            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>Imagen</th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php

                        $sql = mysqli_query($con, "SELECT * FROM producto ORDER BY id ASC");
                        
                        if(mysqli_num_rows($sql) == 0){
                            echo '<tr><td colspan="8">No hay datos.</td></tr>';
                        }else{
                            while($row = mysqli_fetch_assoc($sql)){
                                $row_id = $row['id'];
                                $imagen_query = mysqli_query($con, "SELECT imagen FROM producto_imagen WHERE id_producto='$row_id'");
                                $imagen_row = mysqli_fetch_row($imagen_query);
                                $imagen_url = $imagen_row[0];
                                $cantidad_query = mysqli_query($con, "SELECT cantidad FROM producto_cantidad WHERE id_producto='$row_id'");
                                $cantidad_row = mysqli_fetch_row($cantidad_query);
                                $cantidad = (int) $cantidad_row[0];
                                if ($cantidad >= 0) {
                                    echo '
                                <tr>
                                <td><img src="'.$imagen_url.'" style="max-height:100px"</td>
                                <td>'.$row['id'].'</td>
                                <td><a href="modificarProductoAdmin.php?productId='.$row['id'].'"><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> '.$row['nombre'].'</a></td>
                                                            <td>'.$row['precio'].'</td>
                                                            <td>'.$cantidad.'</td>
                                <td>';
                            
                                echo '
                                </td>
                                <td>
                                
                                <a href="modificarProductoAdmin.php?productId='.$row['id'].'" title="Editar datos" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
                                <a href="listarProductoAdmin.php?aksi=delete&productId='.$row['id'].'" title="Eliminar" onclick="return confirm(\'Esta seguro de borrar los datos '.$row['nombre'].'?\')" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                                </td>
                                </tr>
                                ';
                                } 
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
    
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> -->
</body>

</html>