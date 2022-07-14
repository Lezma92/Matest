<!doctype html>
<html lang="es">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
  <script src="../js/sweetalert2.all.js"></script>
  <title>Exámenes</title>
</head>
<body>

  <?php include '../modules/menu-nav.php'; ?>
  <?php require_once("../controlador/operaciones.php") ?>
  <?php require_once("../controlador/receptor.php") ?>
  <!-- NAVS xD -->
  <nav style="padding: 5px;">
    <div class="nav nav-pills" id="nav-tab" role="tablist">
      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Exámenes - Todos</a>
      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Exámenes - Carreras</a>
    </div>
  </nav>
  <div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <hr>

      <div class="container mt-5">
        <table class="table table-hover tablaActivar">       <!-- TABLA  -->
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
                  <button type="submit" name="btnActivar" id="btnActivar" class="btn btn-sm btn-info mb-2 btnActivar" <?php echo("idActivar = '".$value["id"]."'") ?> data-toggle="modal" data-target="#carrera">Activar</button>

                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>

    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

      <div class="container mt-5">
        <table class="table table-hover tablaActivos">       <!-- TABLA  #2 -->
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre de la carrera</th>
              <th scope="col">Examen Activo</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
          <tbody>

            <?php 
            $cont = 0;
            $activos = Operaciones::getExamActivos();
            foreach ($activos as $key => $value) {
                $cont++;
             ?>
             <tr>
              <th scope="row"><?php echo($cont) ?></th>
              <td><?php echo($value["carrera"]) ?></td>
              <td><?php echo($value["version"]) ?></td>
              <td>  <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-danger mb-2 btnDesactivar" >Desactivar</button>
              </td>
              <input type="hidden" name="id_carrera" id="id_carrera" class="id_carrera" <?php echo("value='".$value["id_carrera"]."'"); ?>>
              <input type="hidden" name="id_version" id="id_version" class="id_version"  <?php echo("value='".$value["id_version"]."'"); ?>>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- FIN NAVS -->
</div>

<!-- Modal -->
<div class="modal fade" id="stateAct" tabindex="-1" role="dialog" aria-labelledby="stateTi" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="stateTi">Exámenes</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php require 'table_modal.php'; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger btn-sm">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin Modal -->


<!-- Nuevo modal -->

<div class="modal fade" id="carrera" tabindex="-1" role="dialog" aria-labelledby="carreraTit" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="carreraTit">Seleccionar carrera</h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" class="was-validated formActivar" name="formActivar" id="formActivar">
          <h5>Escoger carrera:</h5>
          <div class="form-group row">
            <div class="col-sm-12">
              <select name="carrera" id="carrera" class="custom-select carrera" required>
                <option value="" selected disabled>Seleccionar</option>
                <option value="1">Tecnologia de la información</option>
                <option value="2">Gastronomia</option>
                <option value="3">Administración</option>
                <option value="4">Metal Mecanica</option>
                <option value="5">Procesos Alimentarios</option>
                <option value="6">Energías Renovables</option>
                <option value="7">Turismo</option>
                <option value="8">Mantenimiento industrial</option>
                <option value="9">Logística internacional</option>

              </select>
            </div>
          </div>
          <input type="hidden" name="idActivar" id="idActivar" class="idActivar" value="">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
          <button type="button" onclick="activar();" name="activarExamen" class="btn btn-info btn-sm col-sm-4">Activar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Fin modal -->
<script>
  function ewe(uwu) {
    return (confirm(uwu))?true:false;
  }
</script>
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/tabla.js"></script>
</body>
</html>