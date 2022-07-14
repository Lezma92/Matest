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
  <?php 
  $idgrupo = 1;
  $title = "Listados del grupo IT1-1";
  if (isset($_GET["idGrupo"])&& isset($_GET["grupo"])) {
    $idgrupo = $_GET["idGrupo"];
    $text = $_GET["grupo"];
    $title = "Listados del grupo ".$text;
  }

  ?>
  <div class="container" style="padding: 10px;">
    <div class="card">
      <div class="card-header" style="padding: 10px;">
        <form class="formAlumno" name="formAlumno">
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
            <div class="form-group col-md-4 col-lg-4">
              <label for="grupos">Grupo:</label>
              <select id="grupos" name="grupos" class="form-control grupos" required>
                <option value="" disabled selected>Seleccionar</option>

              </select>
            </div>

            <div class="form-group col-md-2 col-lg-2">
              <label>.</label>
              <button type="button" onclick="llenarAlumnos();" class="btn btn-primary form-control">Listar</button>
            </div>
          </div>

        </form>
      </div>
      <div class="card-body">
        <div class="alert alert-info mb-4">
          <strong><?php echo($title) ?></strong>
        </div>
       <table class="table table-hover table-bordered table-striped tablaAlumnos">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre completo</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          
          $resultados = Operaciones::getAlumnosGrupos($idgrupo);
          $filas = 0;
          foreach ($resultados as $key => $value) {
            $filas++;
            ?>
            <tr>
              <th scope="row"><?php echo($filas); ?></th>
              <td scope="row"><?php echo($value["nombre"]) ?></td>
              <td scope="row"><a target="_blank" <?php echo('href="graf-alumnos.php?grupo='.$value["id"].'&nuevo='.$value["nombre"].'"') ?>><button class="btn btn-sm btn-info modificarUser" <?php echo("idAlumno = ".$value["id"]) ?>>Ver Resultados</button></a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

</div>





<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/llenar.js"></script>






</body>
</html>