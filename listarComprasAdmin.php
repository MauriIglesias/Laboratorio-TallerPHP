<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Compras</title>

    <!-- Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        .content {
            margin-top: 80px;
        }
        a:link {
            text-decoration: none;
        }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php include("navbarAdmin.php");?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Lista de Compras</h2>
            <hr />
    <?php
        $con = Conectarse();
    ?>
            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Id Usuario</th>
                        <th>Nom Usuario</th>
                        <th>Ape Usuario</th>
                        <th>Id Pago</th>
                        <th>Tipo Pago</th>
                        <th>Monto</th>
                    </tr>
                    <?php
                        $sql = mysqli_query($con, "SELECT * FROM compra ORDER BY id ASC");
                        if(mysqli_num_rows($sql) == 0){
                            echo '<tr><td colspan="8">No hay compras realizadas.</td></tr>';
                        }else{
                            while($row = mysqli_fetch_assoc($sql)){
                                $row_id = $row['id'];
                                $row_IdUsuario = $row['id_usuario'];
                                $selectUsuario = mysqli_query($con, "SELECT * FROM usuario WHERE id='$row_IdUsuario'") or die(mysqli_error($con));
                                while($rowUser = mysqli_fetch_assoc($selectUsuario)) {
                                    $row_nombreUser = $rowUser['nombre'];
                                    $row_apellidoUser = $rowUser['apellido'];
                                }
                                $row_IdPago= $row['id_pago'];
                                $selectPago = mysqli_query($con, "SELECT * FROM pago WHERE id='$row_IdPago'") or die(mysqli_error($con));
                                while($rowPago = mysqli_fetch_assoc($selectPago)) {
                                    $row_nombrePago = $rowPago['nombre'];
                                }
                                $row_monto= $row['monto'];
                                echo '
                                <tr>
                                <td><a href="infoCompraAdmin.php?compraId='.$row['id'].'">'.$row['id'].'</a></td>
                                <td>'.$row['id_usuario'].'</td>

                                <td>'.$row_nombreUser.'</td>
                                <td>'.$row_apellidoUser.'</td>

                                <td>'.$row['id_pago'].'</td>
                                <td>'.$row_nombrePago.'</td>

                                <td>'.$row['monto'].'</td>';
                                
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