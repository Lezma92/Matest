<!DOCTYPE html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Reporte por alumno</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/graficas.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
</head>
<body>

    <div class="container" style="padding: 10px;">
     <?php require_once("../controlador/operaciones.php") ?>
     <?php 

     $grupo = $_GET["grupo"];
     $titulo = $_GET["nuevo"];
     $consulta = Operaciones::getGraAlumnos($grupo);
     $dataPoints = array();
     foreach ($consulta as $key => $value) {

      array_push($dataPoints, array("y" => $value["total"], "label" => $value["nombre"]));
    }
    ?>

    <div class="card mt-4">

     <div class="card-header">
       
        <h4 class="display-5 justify-content">Gráfica del alumno <?php echo(" ".$titulo); ?></h4>
      
    </div>

    <div id="chartContainer" style="height: 300px; width: 100%;">
      <?php echo("<script>getGraficasAlumno('".$titulo."',".json_encode($dataPoints, JSON_NUMERIC_CHECK).");</script>"); ?>
    </div>

  </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>

