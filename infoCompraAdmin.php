<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Info Compra</title>
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
            <h2>Productos de la compra</h2>
            <hr />
    <?php
        $con = Conectarse();
        if(isset($_GET['compraId'])) {
                //$compraIdno = $_GET['compraId'];
                $compraId = mysqli_real_escape_string($con,(strip_tags($_GET["compraId"],ENT_QUOTES)));

                $selectCompra = mysqli_query($con, "SELECT * FROM compra_producto WHERE id_compra='$compraId'");
                //$sql = mysqli_query($con, "SELECT * FROM compra ORDER BY id ASC");
                if(mysqli_num_rows($selectCompra) == 0){
                    // Lanzar un cartel de error
                    echo '<tr><td colspan="8">La compra no tiene productos.</td></tr>';
                }else{
                    while($row = mysqli_fetch_assoc($selectCompra)){
                        $row_idCompra = $row['id_compra'];
                        $row_idProducto = $row['id_producto'];
                        $row_cantidad = $row['cantidad'];
                        $selectProducto = mysqli_query($con, "SELECT * FROM producto WHERE id='$row_idProducto'") or die(mysqli_error($con));
                        while($rowProducto = mysqli_fetch_assoc($selectProducto)) {
                            $row_nombreProducto= $rowProducto['nombre'];
                            $row_precioProducto = $rowProducto['precio'];

                            // traer imagen
                            $selectImagen = mysqli_query($con, "SELECT * FROM producto_imagen WHERE id_producto='$row_idProducto'") or die(mysqli_error($con));
                            while($rowImagen = mysqli_fetch_assoc($selectImagen)) {
                                $row_urlImagen = $rowImagen['imagen'];
                            }
                            echo '
                            <div class="card mb-3" style="max-width: 540px;">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                    <img src='.$row_urlImagen.'class="img-fluid rounded-start" alt="Imagen Producto">
                                    </div>
                                    <div class="col-md-8">
                                    <div class="card-body">
                                        <h3 class="card-title">'.$row_nombreProducto.'</h3>
                                        <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                                        <h5>Cantidad: '.$row_cantidad.'</h5>
                                        <h5>Precio: '.$row_precioProducto.'</h5>
                                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                                    </div>
                                    </div>
                                </div>
                                </div>
                            ';
                        }
                        
                    }
                }
        }
    ?>
        </div>
    </div>
    
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> -->
</body>

</html>