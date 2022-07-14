<!DOCTYPE html>
<html>
<head>
  <title>Iniciar sesión</title>
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
  <!-- Compiled and minified CSS -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
  <link rel="stylesheet" href="../css/materialize.min.css">
  <script src="../modules/validate.js"></script> 
  <link rel="stylesheet" href="../css/style.css">

  <!-- <?php /*include '../modules/style-login.php';*/ ?> esto choca con los inicios de sesion --> 
</head>
<body>
  <div id="flayer">
    <div id="slayer">

      <div class="container section" id="content">

        <div class="row">

          <div class="col l3 m2 s12"></div>

          <div class="col l12  m11 offset-m1 s12">
            <div class="card-panel z-depth-5">
              <h5 class="center tit">Universidad Tecnológica de la Costa Grande de Guerrero.</h5>
              <p class="center pEvaluacion">Evaluación de matemáticas.</p>
              <form method="POST" class="formAlumno" onsubmit="return validate();">
                <?php 
                require_once("../controlador/receptor.php"); 
                require_once("../controlador/operaciones.php");
                ?>
                <div class="input-field col m6 s12 l4">
                 <input type="text" name="nombre" id="nombre" class="validate" onkeypress="return onlyL(event);" minlength="3" maxlength="30" required>
                 <label for="nombre">Nombre(s):</label>
                 <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
               </div>

               <div class="input-field col m6 s12 l4">
                <input type="text" name="app" id="app" class="validate" onkeypress="return onlyL(event);" minlength="3" maxlength="30" required>
                <label for="app">Apellido paterno:</label>
                <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>
              </div>

              <div class="input-field col m6 s12 l4">
                <input type="text" name="apm" id="apm" class="validate" onkeypress="return onlyL(event);" minlength="3" maxlength="20" required>
                <label for="apm">Apellido materno:</label>
                <span class="helper-text" data-error="Campo requerido*" data-success="&radic;">Campo requerido*</span>

              </div>

              <div class="input-field col m6 s12 m12 l12">
               <select  name="carreras" id="carreras" class="validate carreras" required>
                <option value="" disabled selected><--seleccionar--></option>
                <?php        
                $carrera = Operaciones::getCarreras("carreras",null,null);
                $value;
                foreach ($carrera as $key => $value) {
                  echo '<option value="'.$value["id"].'" pre="'.$value["id"].'">'.$value["nombre"].'</option>';
                } 
                ?>
              </select>
              <label for="carreras">Carrera:</label>
            </div>

            <div class="input-field col s12 m12 l12">
              <select id="grupos" class="grupos" name="grupos" required>
                <option value="" disabled selected><--seleccionar--></option>
              </select>
              <label for="grupos">Carrera</label>
            </div>


            <div class="input-field col m6 s12 m12 l12">
              <select name="asesor" class="asesor" id="asesor" required>
                <option value=""  disabled selected><--seleccionar---></option>
                <?php 
                $asesor = Operaciones::getAsesores();
                $valor;
                foreach ($asesor as $key => $valor) {
                  echo '<option value="'.$valor["id"].'" pre="'.$valor["id"].'">'.$valor["nombre"].'</option>';
                }
                ?>
              </select>   
              <label for="asesor">Asesor:</label>  
            </div>
            <p class="right">¿Eres administrador? <a href="#login" class="modal-trigger">Aquí</a></p>

            <button type="submit" name="registrarAlumno" value="Registrar" class="btn left col s12">Registrar</button>

            <?php 
              nuevo::registrar();
            ?>
            
          </form>
          <div class="clearfix"></div>
        </div>
      </div>


    </div>

  </div>

</div>
</div>



<?php include '../modules/modal-login.php'; ?>

<script src="../js/materialize.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/llenar.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/ljibs/materialize/1.0.0/js/materialize.min.js"></script> -->

<!-- Validando campos num-lyr -->
<script src="../modules/js-lyr.js"></script>
</body>
</html>