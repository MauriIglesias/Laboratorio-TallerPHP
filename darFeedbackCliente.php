<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feedback de la compra</title>
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
        <?php include("navbarCliente.php");?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Feedback de la compra</h2>
            <hr />
    <?php
        $con = Conectarse();
        $correoUsuario = $_SESSION['usuario'];
        $idUsuario = $_SESSION['usuarioid'];
        $tipoUsuario = $_SESSION['usuariotipo'];
        $compraId = $_GET['compraId'];
        if(isset($_POST['comentario'])) {
                $comentario = $_POST['comentario'];
                //$compraId = mysqli_real_escape_string($con,(strip_tags($_GET["compraId"],ENT_QUOTES)));
                $insertFeedback = mysqli_query($con, "INSERT INTO feedback(id_compra, id_usuario, comentario) VALUES('$compraId','$idUsuario','$comentario')") or die(mysqli_error($con));
                if($insertFeedback){
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Feedback enviado.</div>';
                } else {
                    echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> No se pudo enviar el comentario.</div>';
                }
        }
    ?>
            <form class="form-horizontal" action="" method="post">
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-4">
                        <input type="text" name="comentario" class="form-control" placeholder="Comentario" required>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">&nbsp;</label>
                    <div class="col-sm-6">
                        <input type="submit" name="enviar" class="btn btn-sm btn-primary" value="Enviar">
                    </div>
                </div>
            </form>
        </div>
    </div>
    
        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script> -->
</body>

</html>