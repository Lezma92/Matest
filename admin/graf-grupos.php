<!doctype html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
	<script src="../js/graficas.js"></script>
	<script src="../js/sweetalert2.all.js"></script>
	<title>Exámenes</title>
</head>
<body>

	<?php include '../modules/menu-nav.php'; ?>
	<?php require_once("../controlador/operaciones.php") ?>
	<?php 
	$id_carrera = 1;
	$titulo = "Estadisticas Grupales";
	if (isset($_GET["id_carrera"])) {
		$id_carrera = $_GET["id_carrera"];
		$name = Operaciones::getCarreras("carreras","id",$id_carrera);
		$titulo = "Estadistica de ".$name["nombre"];
	}
	?>
	<div class="container" style="padding: 10px;">
		<div class="card">
			<div class="card-header" style="padding: 10px;">
				<form class="fomGraGru" name="fomGraGru">
					<div class="form-row">
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

						<div class="form-group col-md-4">
							<label class="text-white">.</label>
							<button type="button" onclick="cambiarGraficaGrupo();" class="btn btn-primary form-control">Generar gráfica</button>
						</div>
					</div>

				</form>
			</div>
			<div class="card-body">
				<?php 
				$datos =  Operaciones::getGraGrupos($id_carrera);
				$dataPoints = array();
				$dataPoints2 = array();
				$dataPoints3 = array();   
				
				foreach ($datos as $key => $value) {
					if ($value["area"]=="Algebra") {
						array_push($dataPoints, array("y" => $value["total"], "label" => $value["grupo"]));
					}elseif ($value["area"]=="Aritmetica") {
						array_push($dataPoints2, array("y" => $value["total"], "label" => $value["grupo"]));
					}elseif ($value["area"] == "Geometrica") {
						array_push($dataPoints3, array("y" => $value["total"], "label" => $value["grupo"]));
						$bandera=1;
					}
				}
				?>


				<div id="chartContainer" style="height: 300px; width: 100%;">
					<?php echo("<script>graficaGrupal('".$titulo."',".json_encode($dataPoints, JSON_NUMERIC_CHECK).",".json_encode($dataPoints2, JSON_NUMERIC_CHECK).",".json_encode($dataPoints3, JSON_NUMERIC_CHECK).");</script>"); ?>
				</div>
			</div>
		</div>
	</div>
	



	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/llenar.js"></script>
	<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>