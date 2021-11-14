<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Mensajes Enviados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    	<!-- Bootstrap -->
	<link href="bootstrap.min.css" rel="stylesheet">
	<!-- <link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet"> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        thead {
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #540826;
            color: white;
        }
        tr:nth-child(even)
        {
            background-color: #fff6fa;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php include("navbarCliente.php"); ?>	</nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Mensajes enviados</h2>
                    </div>
                    <?php
                    // faltaria preguntar la session por si el usuario esta como cliente y sacar el ID de ahi
                        if (!isset($_SESSION['usuarioid'])){
                            header("location:index.php");
                        }
                        $sessionUserId = $_SESSION['usuarioid'];
                        $con = Conectarse();
                        $sql = "SELECT * FROM feedback f WHERE f.id_usuario='$sessionUserId'";
                        if($result = mysqli_query($con, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                
                                echo '<table class="table table-bordered">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Compra</th>";
                                            echo "<th>Comentario</th>";
                                            echo "<th></th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    while($row = mysqli_fetch_array($result)){
                                        $productoData = null;
                                        $userData = null;
                                        $userId = $row['id_usuario'];
                                        $compraId = $row['id_compra'];
                                        $sqlUserData = "SELECT * FROM usuario u WHERE u.id = '$userId'";
                                        $sqlCompraData = "SELECT * FROM compra_producto c WHERE c.id_compra = '$compraId'";
                                        // Busco nombre y apellido del usuario
                                        if(($resultUser = mysqli_query($con, $sqlUserData)) && mysqli_num_rows($resultUser) > 0){
                                            // Deberia ser una fila (al buscar por ID)
                                            while($user = mysqli_fetch_assoc($resultUser)){
                                                $userData = $user['nombre'] . " " . $user['apellido'];
                                            }
                                        }
                                        
                                        if(($resultCompra = mysqli_query($con, $sqlCompraData)) && mysqli_num_rows($resultCompra) > 0){
                                            $productoId;
                                            while($compra = mysqli_fetch_array($resultCompra)){
                                                $productoId = $compra['id_producto'];
                                                if ($productoId){
                                                    $sqlProductoData = "SELECT * FROM producto p WHERE p.id = '$productoId'";
                                                    if(($resultProducto = mysqli_query($con, $sqlProductoData)) && mysqli_num_rows($resultProducto) > 0){
                                                        while($producto = mysqli_fetch_assoc($resultProducto)){
                                                            $productoData .= $producto['nombre'] . ', ';
                                                        }
                                                        
                                                    }
                                                }
                                            }
                                            $productoData = substr($productoData, 0, -2);
                                        }
                                        
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['id_compra'] . ($productoData ? (" - Productos: " . $productoData) : "...") . "</td>";
                                            echo "<td>" . $row['comentario'] . "</td>";
                                            echo "<td>";
                                            echo "</td>";
                                        echo "</tr>";
                                    }
                                    echo "</tbody>";                            
                                echo "</table>";

                                mysqli_free_result($result);
                            } else{
                                echo '<div class="alert alert-danger"><em>No hay resultados.</em></div>';
                            }
                        } else{
                            echo "Hubo un problema. Intente más tarde.";
                        }
    
                        mysqli_close($con);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>