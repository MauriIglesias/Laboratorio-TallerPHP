<!DOCTYPE html>
<html lang="es">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Listar Usuarios</title>

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
            <h2>Lista de Usuarios</h2>
            <hr />
    <?php
        $con = Conectarse();
        if(isset($_GET['method'])) {
            if($_GET['method'] == 'put'){
                $estado = $_GET['estado'];
                $usuarioId = mysqli_real_escape_string($con,(strip_tags($_GET["usuarioId"],ENT_QUOTES)));
                $select = mysqli_query($con, "SELECT * FROM usuario WHERE tipo=1 and id='$usuarioId'");
                if(mysqli_num_rows($select) == 0){
                    echo '<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se encontro el usuario.</div>';
                }else{
                    $pseudo_update = mysqli_query($con, "UPDATE usuario SET habilitado='$estado' WHERE tipo=1 and id='$usuarioId'") or die(mysqli_error($con));
                    if($pseudo_update){
                        if($estado == 1) {
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Usuario habilitado con exito.</div>';
                        } else {
                            echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Usuario deshabilitado con exito.</div>';
                        }
                    }else{
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Error al cambiar el estado.</div>';
                    }
                }
            }
        }
    ?>
            <br />
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado</th>
                    </tr>
                    <?php
                        $sql = mysqli_query($con, "SELECT * FROM usuario u where u.tipo=1 ORDER BY id ASC");
                        if(mysqli_num_rows($sql) == 0){
                            echo '<tr><td colspan="8">No hay usuarios registrados.</td></tr>';
                        }else{
                            while($row = mysqli_fetch_assoc($sql)){
                                $row_id = $row['id'];
                                $row_correo = $row['correo'];
                                $row_nombre= $row['nombre'];
                                $row_apellido= $row['apellido'];
                                $row_estado= $row['habilitado'];
                                echo '
                                <tr>
                                <td>'.$row['id'].'</td>
                                <td>'.$row['correo'].'</td>
                                <td>'.$row['nombre'].'</td>
                                <td>'.$row['apellido'].'</td>
                                <td>'.$row['habilitado'].' ';
                                if ($row['habilitado'] == 0) {
                                    echo '<a href="listarUsuarioAdmin.php?method=put&estado=1&usuarioId='.$row['id'].'" title="Habilitar" onclick="return confirm(\'Esta seguro de habilitar el usuario '.$row['nombre'].'?\')" class="btn btn-success btn-sm"></a>';
                                } else {
                                    echo '<a href="listarUsuarioAdmin.php?method=put&estado=0&usuarioId='.$row['id'].'" title="Deshabilitar" onclick="return confirm(\'Esta seguro de deshabilitar el usuario '.$row['nombre'].'?\')" class="btn btn-danger btn-sm"></a>';
                                }
                                echo '</td>';
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