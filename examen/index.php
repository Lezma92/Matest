<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Mostrar Preguntas de examen</title>
</head>
<body>
	<div>
		<?php require_once("../controlador/operaciones.php"); ?>
		<?php 
		$areas = Operaciones::getArea("random");
		$cont=1;

		foreach ($areas as $key => $value) {
			$preguntas = Operaciones::getPreguntas($value["id"]);
			foreach ($preguntas as $key => $value) {
				if ($value["tipo"] == "PLetra") {
					echo '<b>'.$cont."). ".$value["pregunta"].'</b><br><br>';
				}elseif($value["tipo"]=="PIMG"){
					echo '<b>'.$cont."). ".'</b> <img src="'.$value["pregunta"].'"><br><br>';
				}

				$respuesta = Operaciones::getRespuestas($value["id"]);
				foreach ($respuesta as $key => $value) {
					echo('<label>'.$value["respuesta"].'<input type="radio" name="r1"></label>');
				}
				echo("<br><br>");
				$cont++;
			}
		}
		

		?>
		<b>1.</b> Al afectar la operación indicada <b>[8 + (4 - 2)] + [9 - (3 + 1)]</b>, el resultado es:<br/><br><!-- &nbsp; -->

		<div>
			a) <label><input type="radio" class="with-gap" name="q1"><span><b>15</b></span></label>
		</div>
	</div>
</body>
</html>