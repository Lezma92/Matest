<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <title>Examen || Preguntas</title>
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
  <script src="../js/sweetalert2.all.js"></script>
</head>
<body>

  <?php include '../modules/menu-nav.php'; ?>
  <?php require_once("../controlador/operaciones.php") ?>
  <?php require_once("../controlador/receptor.php") ?>
  <br><br>
  <?php require 'modal_exa.php'; ?>

  <div class="container">
    <button  class="btn btn-info" data-toggle="modal" data-target="#exa">Agregar examen</button>
  </div>

  <div class="container mt-3">
    <table class="table table-hover tablaExa">       <!-- TABLA  -->
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Examen</th>
          <th scope="col">Total preguntas</th>
          <th scope="col">Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $cont = 0;
        $version = Operaciones::getExamenes();
        foreach ($version as $key => $value) {
          $cont++;
          ?>

          <tr>
            <th scope="row"><?php echo($cont); ?></th>
            <td><?php echo($value["nombre"]);?></td>
            <td><?php echo($value["total"]); ?></td>
            <td>
             <button type="submit" name="btnVerPre" id="btnVerPre" class="btn btn-sm btn-info mb-2 btnVerPre" <?php echo("ver_examen = '".$value["id"]."'") ?> >Ver preguntas</button>
             
             <button type="submit" name="btnEliminarPreguntas" id="btnEliminarPreguntas" <?php echo "id_examen = '".$value["id"]."'"; ?> class="btn btn-sm btn-danger mb-2 btnEliminarPreguntas">Eliminar</button>
           </td>
         </tr>
       <?php } ?>
     </tbody>
   </table>
 </div>
</div>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/tabla.js"></script>
</body>
</html>