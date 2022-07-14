<!doctype html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
	<title>Nuevo usuario</title>
	
</head>

<body>

	<?php include('../modules/menu-nav.php');  ?>

	<div class="container mt-5">
		<?php require_once("../controlador/receptor.php"); ?>
		<?php require_once("../controlador/operaciones.php"); ?>
		<button type="button" class="btn btn-info" data-toggle="modal" data-target="#registerU">Registrar usuario</button>

		

		<br><br>
		<table class="table table-hover table-bordered table-striped">
			<thead class="thead-dark">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Nombre completo</th>
					<th scope="col">Usuario</th>
					<th scope="col">Tipo de usuario</th>
					<th>Acción</th>
				</tr>
			</thead>
			<tbody>
				<?php $resultado = Operaciones::getUsers(); 
				$cont = 0;
				foreach ($resultado as $key => $value) {
					$cont++;

					?>

					<tr>

						<th scope="row"><?php echo($cont); ?></th>
						<td scope="row"><?php echo($value["nombre"]) ?></td>
						<td scope="row"><?php echo($value["nick"]) ?></td>
						<td scope="row"><?php echo($value["tipo_usuario"]) ?></td>
						<td scope="row">
							<a href="#!" class="btn btn-sm btn-info" data-toggle="modal" data-target="#update">Modificar</a>
							<a onclick="return confirm('¿Estás seguro de eliminar el siguiente usuario?');" href="#!" class="btn btn-sm" style="background:#FF2930;color:#FFF;">Eliminar</a>
						</td>

					</tr>
				<?php } ?>
			</tbody>
		</table>
		<?php include('../modules/modal_users.php');?>
	</div>

	<?php include ('../modules/modal_update.php'); ?>


	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script>
		function onlyL(e) {
			key = e.keyCode || e.which;
			tecla = String.fromCharCode(key).toLowerCase();
			letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
			especiales = "8-37-39-46";

			tecla_especial = false
			for (var i in especiales) {
				if (key == especiales[i]) {
					tecla_especial = true;
					break;
				}
			}

			if (letras.indexOf(tecla) == -1 && !tecla_especial) {
				return false;
			}
		}

	</script>
</body>

</html>
