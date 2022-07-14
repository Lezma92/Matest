<?php 
require_once("../controlador/operaciones.php");
require_once("../controlador/reg.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar preguntas y respuestas</title>
	<link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<script src="../js/sweetalert2.all.js"></script>
	<!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
	<style>
	textarea {
        resize: none;
	}	
	</style>
</head>
<body>

	<header><?php include("../modules/menu-nav.php"); ?></header>

	<div class="container mt-4">

		<form role="form" class="Form_Preguntas" method="post" enctype="multipart/form-data">
			
			<div class="form-group">
				<label for="version">Versión de examen</label>
				<select class="form-control version" id="version" name="version" required>

					<option value=""><--seleccionar--></option>

					<?php
					$version = Operaciones::getVersion();
					foreach ($version as $key => $value) {
						echo('<option value="'.$value["id"].'">'.$value["nombre"].'</option>');
					}
					?>

				</select>

			</div>

			<div class="form-group">
				<label for="version">Área de la pregunta</label>
				<select class="form-control area" id="area" name="area" required>
					<option value=""><--seleccionar--></option>
					<?php
					$area = Operaciones::getArea("combo");
					foreach ($area as $key => $value) {
						echo ('<option value="'.$value["id"].'">'.$value["nombre"].'</option>');
					}
					?>

				</select>

			</div>

			<!-- -------------------------------------------------------------------- -->
			<label for="lb_quest">Agregar pregunta:</label><br>
			<div class="form-check form-check-inline">
				
				<label class="form-check-label" for="optionsRadios1">
					<input type="radio"  class="form-check-input pregunta_text" name="RadiosPregunta" id="optionsRadios1" value="option1" required>
					Texto
				</label>
			</div>
			<div class="form-check form-check-inline">

				<label class="form-check-label" for="optionsRadios2">
					<input type="radio" class="form-check-input pregunta_foto" name="RadiosPregunta" id="optionsRadios2" value="option2" required>
					Imagen
				</label>
			</div>
			<!----------------------------------------------->
			<div class="Pregunta form-group">


			</div>
			<!------------------------------------------------>
			<label>Respuestas:</label>
			<div class="radio">

				<label>
					<input type="radio" class="respuestas_text" name="Radios_respuesta" id="radio_res" value="option1" required>
					Texto
				</label>

				<label>
					<input type="radio" class="respuestas_foto" name="Radios_respuesta" id="radio_res2" value="option2" required>
					Imagen
				</label>

			</div>
			
			<!----------------------------------------------->

			<div class="respuestas form-group">


			</div>

			<div class="form-group row">
				<div class="col-md-6 mx-auto">
					<button type="submit" class="btn btn-primary btn-lg btn-block">Registrar pregunta</button>
				</div>
			</div>


		</div><!-- fin  -->
	</div>


	<?php

	$crearPregunta = new ControladorPreguntas();
	$crearPregunta -> crtRegistrarPregunta();

	?>

</form>
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/preguntas.js"></script>
</body>
</html>


<!-- MODIFICADO -->