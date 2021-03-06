<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Agregar Productos</title>

	<!-- Bootstrap -->
	<!-- <link href="bootstrap.min.css" rel="stylesheet"> -->
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php include("navbarAdmin.php"); ?>	
	</nav>
	<div class="container">
		<div class="content">
			<h2>Nuevo Producto &raquo; Cargar datos</h2>
			<hr />

			<?php
            $con = Conectarse();
			if(isset($_POST['add'])){
                $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
                $precio = (float) mysqli_real_escape_string($con,(strip_tags($_POST["precio"],ENT_QUOTES)));
                $cantidad = (int) mysqli_real_escape_string($con,(strip_tags($_POST["cantidad"],ENT_QUOTES)));
                $imagen = mysqli_real_escape_string($con,(strip_tags($_POST["imagen"],ENT_QUOTES)));
                $id_producto = "";
                // Guardar en tabla PRODUCTO
                // Chequeo que no exista
				$cek = mysqli_query($con, "SELECT * FROM producto WHERE nombre='$nombre'");
				if(mysqli_num_rows($cek) == 0){
                    $insert = mysqli_query($con, "INSERT INTO producto(nombre, precio)
                                                        VALUES('$nombre','$precio')") or die(mysqli_error($con));
                    if($insert){
                        $sql = mysqli_query($con, "SELECT * FROM producto WHERE nombre='$nombre'");
                        $id_producto = (int) mysqli_fetch_assoc($sql)['id'];
                        // echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Procesando...</div>';
                    }else{
                        echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close btn btn-sm btn-danger" data-dismiss="alert" aria-hidden="true">X</button>Error. No se pudo guardar los datos !</div>';
                    }
					 // Guardo cantidad en tabla PRODUCTO_CANTIDAD
					 $insert = mysqli_query($con, "INSERT INTO producto_cantidad(id_producto, cantidad)
					 VALUES('$id_producto','$cantidad')") or die(mysqli_error($con));
					if($insert){
					// echo '<div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Procesando...</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close btn btn-sm btn-danger" data-dismiss="alert" aria-hidden="true">X</button>Error. No se pudo guardar los datos !</div>';
					}

					// Guardo link a imagen en tabla PRODUCTO_IMAGEN
					$insert = mysqli_query($con, "INSERT INTO producto_imagen(id_producto, imagen)
										VALUES('$id_producto','$imagen')") or die(mysqli_error($con));
					if($insert){
						echo '<div class="alert alert-success alert-dismissable" id="success-alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>Producto guardado</div>';
					}else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>Error. No se pudo guardar los datos !</div>';
					}
				}else{
					$row = mysqli_fetch_row($cek);
					$row_id = $row[0];
					$sql = mysqli_query($con, "SELECT cantidad FROM producto_cantidad WHERE id_producto='$row_id'");
					if (mysqli_fetch_row($sql)[0] == -1){
						$update_cantidad = mysqli_query($con, "UPDATE producto_cantidad SET cantidad='$cantidad' WHERE id_producto='$row_id'") or die(mysqli_error($con));
						$update_producto = mysqli_query($con, "UPDATE producto SET precio='$precio' WHERE id='$row_id'") or die(mysqli_error($con));
                    	$update_producto_imagen = mysqli_query($con, "UPDATE producto_imagen SET imagen='$imagen' WHERE id_producto='$row_id'") or die(mysqli_error($con));
						echo '<div class="alert alert-success alert-dismissable" id="success-alert">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">X</button>Producto guardado</div>';
					}
					else{
						echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close btn btn-sm btn-danger" data-dismiss="alert" aria-hidden="true">X</button>Error. Ya existe producto!</div>';
					}
					
				}
			}
			?>

			<form class="form-horizontal" action="" method="post">
				<div class="form-group">
					<!-- <label class="col-sm-3 control-label">Nombre</label> -->
					<div class="col-sm-2">
						<input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
                <br>
				<div class="form-group">
					<!-- <label class="col-sm-3 control-label">URL Imagen</label> -->
					<div class="col-sm-3">
						<textarea name="imagen" class="form-control" placeholder="Link"></textarea>
					</div>
				</div>
                <br>
				<div class="form-group">
					<!-- <label class="col-sm-3 control-label">Precio</label> -->
					<div class="col-sm-3">
						<input 
                        type="number" 
                        name="precio" 
                        class="form-control" 
                        placeholder="Precio" 
                        required 
                        max="99999"
                        min="1">
					</div>
				</div>
                <br>
                <div class="form-group">
					<!-- <label class="col-sm-3 control-label">Cantidad</label> -->
					<div class="col-sm-3">
						<input 
                        type="number" 
                        name="cantidad" 
                        class="form-control" 
                        placeholder="Cantidad" 
                        required
                        max="99"
                        min="1">
					</div>
				</div>
				<br>
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="listarProductoAdmin.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="bootstrap.bundle.min.js"></script>
	<link href="bootstrap.min.css" rel="stylesheet"> -->
	<script>
	</script>
</body>
</html>