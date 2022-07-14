s<!DOCTYPE html>
<html lang="es">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Page Title</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/animate.min.css">
</head>
<body>
	<?php include("../modules/menu-nav.php"); ?>
	<!-- --------------------------------------------------------------->
		<?php 
			require_once "../controlador/operaciones.php";

            
            $res = Operaciones::graficos();
            
            $dataPoints = array();
            foreach ($res as $key => $value) {
             
                array_push($dataPoints, array("y" => $value["general"], "label" => $value["nombre"]));
            }
         ?>
         <script>
            window.onload = function () {
             
            var chart = new CanvasJS.Chart("chartContainer", {
              title: {
                text: "Estadisticas Generales"
              },
              axisY: {
                title: "N°"
              },
              data: [{
                type: "line",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
              }]
            });
            chart.render();
             
            }
          </script>

      <div id="chartContainer" style="height: 370px; width: 100%;"></div>
      <script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>

	<!-- ---------------------------------------------------------------->


	

	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="../js/jquery-3.1.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>


</body>
</html>