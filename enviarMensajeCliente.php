<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Productos</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <?php
        $_SESSION['usuarioid'] = 1;
        if (!isset($_SESSION['usuarioid'])){
            header("location:index.php");
        }else{
            include("navbarCliente.php");
            $_SESSION['usuarioid'] = 1;
        }
        ?>
    </nav>
    <div class="container">
        <div class="content">
            <h2>Compra &raquo; Enviar Mensaje de Feedback</h2>
            <hr/>
            <?php
                $sessionUserId = $_SESSION['usuarioid'];
                $con = Conectarse();
                // Agarro el idCompra del query
                $compraId = null;
                if (isset($_GET['idCompra'])){
                    $compraId = mysqli_real_escape_string($con,(strip_tags($_GET["idCompra"],ENT_QUOTES)));
                }else{
                    ob_flush();
                    header("location:mainCliente.php");
                    ob_end_flush();
                    die();
                }
                $sql = mysqli_query($con, "SELECT * FROM compra WHERE id='$compraId' AND id_usuario='$sessionUserId'");
                if(mysqli_num_rows($sql) == 0){
                    ob_flush();
                    header("location:mainCliente.php");
                    ob_end_flush();
                    die();
                }else{
                    if(isset($_POST['add'])){
                        $comentario = mysqli_real_escape_string($con,(strip_tags($_POST['comentario'],ENT_QUOTES)));
                        $sql = mysqli_query($con, "SELECT * FROM feedback WHERE id_usuario='$sessionUserId' AND id_compra='$compraId'");
                        if(mysqli_num_rows($sql) == 0){
                            $insert = mysqli_query($con, "INSERT INTO feedback(id_compra, id_usuario, comentario) VALUES('$compraId','$sessionUserId', '$comentario')") or die(mysqli_error($con));
                            if($insert){
                                echo '<div id="alert" class="alert alert-success alert-dismissable"><button type="button" class="close btn btn-sm btn-success" aria-hidden="true" data-dismiss="alert">x</button>Guardado con éxito!</div>';

                            }else{
                                echo '<div id="alert" class="alert alert-danger alert-dismissable"><button type="button" class="close btn btn-sm btn-danger" aria-hidden="true" data-dismiss="alert">x</button>Error al enviar mensaje!</div>';

                            }
                        }else{
                            echo '<div id="alert" class="alert alert-danger alert-dismissable"><button type="button" class="close btn btn-sm btn-danger" aria-hidden="true" data-dismiss="alert">x</button>Error al enviar mensaje!</div>';
                        }
                    }
                }
            ?>
            <form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<!-- <label class="col-sm-3 control-label">Nombre</label> -->
					<div class="col-sm-12">
                        <textarea type="text" class="form-control" name="comentario" placeholder="Comentario" required></textarea>
						
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-12">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Enviar Mensaje">
						<a href="perfilCliente.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
	</script>
</body>
</html>