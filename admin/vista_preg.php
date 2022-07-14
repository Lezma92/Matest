<?php 
require_once("../controlador/operaciones.php");
$version;
if (isset($_GET["ver_examen"])) {
  $version = $_GET["ver_examen"];
}

?>
<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <title>Vista || Preguntas</title>
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
  <script src="../js/sweetalert2.all.js"></script>

</head>
<body>

  <?php include '../modules/menu-nav.php'; ?>

  <div class="container mt-5">
    <table class="table table-hover table-bordered">       <!-- TABLA  -->
      <thead>
        <tr class="bg-secondary text-white">
          <th scope="col">Preguntas</th>
          <th scope="col">Área</th>
          <!-- <th>Acción</th> -->
        </tr>
      </thead>
      <tbody>
        <?php 
        $cont = 0;
        $preguntas = Operaciones::getPreguntaAll($version);
        foreach ($preguntas as $key => $value) {
          $cont++;
          echo("<tr>");
          if ($value["tipo"]=="Letra") {
            echo('<th scope="row">'.$cont.".- ".$value["pregunta"].'</th>');
          }else if ($value["tipo"] == "IMG") {
            echo('<th scope="row">'.$cont.".- ".'<img src="'.$value["pregunta"].'" width="500px"></th>');
          }
          ?>
          <td scope="row"><?php echo($value["area"]) ?></td>
          <!-- <td scope="row"><button <?php echo("id_pregunta = '".$value["id"]."'") ?> type="submit" class="btn btn-primary">Eliminar</button></td> -->
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>