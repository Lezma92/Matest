<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Exámenes</title>
	<link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/sweetalert2.all.js"></script>
</head>
<body>
	
	<div class="container col-md-10 col-lg-9 mt-5" style="padding: 8px;">
		
		<div class="card">
			<div class="card-header bg-dark text-white border text-center mb-1 rounded">
				<h5 class="card-title mt-1">
					<strong>Universidad Tecnológica de la Costa Grande de Guerrero.</strong>
				</h5>
				Evaluación de matemáticas
			</div>
			<form style="padding: 8px;" method="POST" class="formAlumno was-validated">
				<div class="form-row">
					<?php 
					require_once("../controlador/receptor.php"); 
					require_once("../controlador/operaciones.php");
					?>
					<div class="form-group col-md-6 col-lg-4">
						<label for="nombre">Nombre(s):</label>
						<input name="nombre" id="nombre" type="text" class="form-control" placeholder="Campo obligatorio*" minlength="3" maxlength="30" required>
					</div>
					<div class="form-group col-md-6 col-lg-4">
						<label for="app">Apellido paterno:</label>
						<input name="app" id="app" type="text" class="form-control" placeholder="Campo obligatorio*" minlength="3" maxlength="30" required>
					</div>
					<div class="form-group col-md-6 col-lg-4">
						<label for="apm">Apellido materno:</label>
						<input name="apm" id="apm" type="text" class="form-control" placeholder="Campo obligatorio*" minlength="3" maxlength="30" required>
					</div>
					<div class="form-group col-md-6 col-lg-6">
						<label for="carreras">Carrera:</label>
						<select name="carreras" id="carreras" class="form-control carreras" required>
							<option value="" selected disabled>Seleccionar</option>
							<?php        
							$carrera = Operaciones::getCarreras("carreras",null,null);
							foreach ($carrera as $key => $value) {
								echo '<option value="'.$value["id"].'" pre="'.$value["id"].'">'.$value["nombre"].'</option>';
							} 
							?>
						</select>
					</div>
					<div class="form-group col-md-6 col-lg-6">
						<label for="grupos">Grupo:</label>
						<select id="grupos" name="grupos" class="form-control grupos" required>
							<option value="" disabled selected>Seleccionar</option>

						</select>
					</div>
					<div class="form-group col-md-6 col-lg-6">
						<label for="asesor">Aplicador:</label>
						<select name="asesor" id="asesor" class="form-control asesor" required>
							<option  value="" disabled selected>Seleccionar</option>
							<?php 
							$asesor = Operaciones::getUsers();
							foreach ($asesor as $key => $valor) {
								echo '<option value="'.$valor["idUsu"].'" pre="'.$valor["idUsu"].'">'.$valor["nombre"]." ".$valor["app"]." ".$valor["apm"].'</option>';
							}
							?>
						</select>
					</div>

					<div class="form-group col-md-12 mt-4">
						<h6 class="text-right alert alert-primary">¿Eres administrador? <a href="#ses" class="alert-link alert-primary" data-toggle="modal" data-target="#ses">Aquí</a></h6>
					</div>

				</div>
				
				<div class="col-md-9 col-lg-9 mx-auto mb-3">
					<button type="submit" name="registrarAlumno" value="Registrar" class="btn btn-info btn-block">Iniciar evaluación</button>
				</div>
				<?php
					
					nuevo::registrar();		?>

			</form>		
		</div>
	</div>
	<?php include("../modules/modal_login.php"); ?>

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/llenar.js"></script>
	<script src="../js/bootstrap.min.js"></script>
</body>
</html>



<!-- MODIFICADO -->