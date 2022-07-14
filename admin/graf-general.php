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

  $idV = 1;
  if (isset($_GET["idVersion"])) {
    $idV = $_GET["idVersion"];
  }
  ?>

  
  <div class="container" style="padding: 10px;">

    <div class="card">
     <div class="card-header">

      <form class="formGraficas" name="formGraficas">
        <div class="form-row">

          <div class="form-group col-md-6 col-lg-6">
            <label for="version">Versión de examen</label>
            <select class="form-control version" id="version" name="version" required>
              <option value="" selected disabled>seleccionar</option>
              <?php
              $version = Operaciones::getVersion();
              foreach ($version as $key => $value) {
                echo('<option value="'.$value["id"].'">'.$value["nombre"].'</option>');
              }
              ?>
            </select>
          </div>

          <div class="form-group col-md-2 col-lg-2">
            <label class="text-white">.</label>
            <button type="submit" id="boton" onclick="cambiarGrafica();" class="btn btn-primary form-control">Generar gráfica</button>

          </div>
        </div>

      </form>
    </div>
    <div class="card-body">

      <?php 
      $datos  = Operaciones::getGeneral($idV);
      $bandera = 0;
      $dataPoints = array();
      $dataPoints2 = array();
      $dataPoints3 = array();         
      foreach ($datos as $key => $value) {
        if ($value["area"]=="Algebra") {
          array_push($dataPoints, array("y" => $value["total"], "label" => $value["carreras"]));
        }elseif ($value["area"]=="Aritmetica") {
          array_push($dataPoints2, array("y" => $value["total"], "label" => $value["carreras"]));
        }elseif ($value["area"] == "Geometrica") {
          array_push($dataPoints3, array("y" => $value["total"], "label" => $value["carreras"]));
          $bandera=1;
        }
      }

      ?>

      <?php
      $v = Operaciones::getNameExamen($idV);
      $titulo = "Gráfica General de ".$v["nombre"];
      ?>
      <div id="chartContainer" style="height: 300px; width: 100%;">
        <?php 
        if ($bandera == 1) {
          echo("<script>graficaGeneral('".$titulo."',".json_encode($dataPoints, JSON_NUMERIC_CHECK).",".json_encode($dataPoints2, JSON_NUMERIC_CHECK).",".json_encode($dataPoints3, JSON_NUMERIC_CHECK).");</script>");
        }
        ?>
      </div>
    </div>

  </div>

</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/llenar.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


</body>
</html>