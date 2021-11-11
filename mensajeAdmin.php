<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ver Mensajes de Usuarios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
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
        <?php include("navbarAdmin.php"); ?>	</nav>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Mensajes de Usuarios</h2>
                    </div>
                    <?php
                        $con = Conectarse();
                        $sql = "SELECT * FROM feedback";
                        if($result = mysqli_query($con, $sql)){
                            if(mysqli_num_rows($result) > 0){
                                
                                echo '<table class="table table-bordered">';
                                    echo "<thead>";
                                        echo "<tr>";
                                            echo "<th>#</th>";
                                            echo "<th>Compra</th>";
                                            echo "<th>Usuario</th>";
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
                                        // 
                                        // if(($resultCompra = mysqli_query($con, $sqlCompraData)) && mysqli_num_rows($resultCompra) > 0){
                                        //     $productoId;
                                        //     while($compra = mysqli_fetch_assoc($resultCompra)){
                                        //         $productoId = $compra['id_producto'];
                                        //     }
                                        //     if ($productoId){
                                        //         $sqlProductoData = "SELECT * FROM producto p WHERE p.id = '$productoId'";
                                        //         if(($resultProducto = mysqli_query($con, $sqlProductoData)) && mysqli_num_rows($resultProducto) > 0){
                                        //             while($producto = mysqli_fetch_assoc($resultProducto)){
                                        //                 $productoData = $producto['nombre'];
                                        //             }
                                        //         }
                                        //     }
                                        // }
                                        
                                        echo "<tr>";
                                            echo "<td>" . $row['id'] . "</td>";
                                            echo "<td>" . $row['id_compra'] . /*($productoData ? (" - Producto: " . $productoData) : "") .*/ "</td>";
                                            echo "<td>" . $row['id_usuario'] . ($userData ? (": " . $userData) : "") . "</td>";
                                            echo "<td>" . $row['comentario'] . "</td>";
                                            echo "<td>";
                                                // echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                // echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                // echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
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