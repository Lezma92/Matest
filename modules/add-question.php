<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/x-icon" href="../img/ico/mat.ico" />
  <title>Agregar examen</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
  <link rel="stylesheet" href="..css/bootstrap.min.css">
  <style>
    blockquote {
      margin: 20px 0;
      padding-left: 1.5rem;
      border-left: 5px solid #005ebb !important;
    }
    .dropdown-content li>a, .dropdown-content li>span {
      font-size: 16px;
      color: #fff !important;
      background: #0277bd;
      display: block;
      line-height: 22px;
      padding: 14px 16px;
    }
    nav ul a:hover {
      background-color: rgba(0,0,0,0.8) !important;
    }
    #q {
      min-width: 70%;
      min-height: 50%;
      max-width: 95%;
      max-height : 90px;
    }

    #noR {
      resize:none;
    }
    .waves-effect input[type="button"], .waves-effect input[type="reset"], .waves-effect input[type="submit"] {
      border: 0;
      color: #fff !important;
      font-style: normal;
      font-size: inherit;
      text-transform: inherit;
      background: none;
    }
  </style>
</head>

<body>

  <!-- Dropdown Structure -->
  <ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">Individual</a></li>
    <li class="divider"></li>
    <li><a href="#!">Carrera</a></li>
    <li class="divider"></li>
    <li><a href="#!">Grupal</a></li>
  </ul>
  <nav class="light-blue darken-3"> <!-- teal -->
    <div class="nav-wrapper container">
      <a href="../views/admin/" class="brand-logo"><i class="material-icons">device_hub</i>MATEST</a>
      <ul class="right hide-on-med-and-down">
        <!-- <li><a href="#modal1" class="modal-trigger">Examen</a></li> -->
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Calificaciones<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="#!">Gráfica</a></li>
        <li><a href="#!">Cerrar sesión</a></li>
      </ul>
    </div>
  </nav>

  <div class="container section">


   <form role="form" class="Form_Preguntas" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Pregunta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA AREA -->
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg ComboArea" id="ComboArea" name="ComboArea" required>

                  <option value="">Selecionar Área</option>

                  <?php


                  $tabla_a = "area_examen";

                  $area = ControladorConsultas::crtObtenerArea_version($tabla_a);
                  $value;
                  foreach ($area as $key => $value) {

                    echo '<option value="'.$value["id"].'" pre="'.$value["id"].'">'.$value["nombre"].'</option>';

                  }
                  
                  ?>

                </select>

              </div>

            </div>
            <!-- ----------------------------------------------------------------- -->
            <!-- ENTRADA VERSIÓN -->
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg ComboVersion" id="ComboVersion" name="ComboVersion" required>

                  <option value="">Selecionar Versión</option>

                  <?php


                  $tabla_a = "version_examen";

                  $area = ControladorConsultas::crtObtenerArea_version($tabla_a);
                  $value;
                  foreach ($area as $key => $value) {

                    echo '<option value="'.$value["id"].'" pre="'.$value["id"].'">'.$value["nombre"].'</option>';

                  }
                  
                  ?>

                </select>

              </div>

            </div>
            <!-- -------------------------------------------------------------------- -->
            <label>Pregunta:</label>
            <div class="radio">

              <label>
                <input type="radio" class="pregunta_text" name="RadiosPregunta" id="optionsRadios1" value="option1" required="">
                Texto
              </label>

              <label>
                <input type="radio" class="pregunta_foto" name="RadiosPregunta" id="optionsRadios2" value="option2" required="">
                Imagen
              </label>
            </div>
            <!----------------------------------------------->
            <div class="Pregunta">


            </div>
            <!------------------------------------------------>
            <label>Respuestas:</label>
            <div class="radio">

              <label>
                <input type="radio" class="respuestas_text" name="Radios_respuesta" id="radio_res" value="option1" required="" >
                Texto
              </label>

              <label>
                <input type="radio" class="respuestas_foto" name="Radios_respuesta" id="radio_res2" value="option2" required="">
                Imagen
              </label>

            </div>
            <!----------------------------------------------->

            <div class="respuestas">


            </div>
            



          </div><!-- fin  -->
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar carrera</button>

        </div>

        <?php

        $crearPregunta = new ControladorPreguntas();
        $crearPregunta -> crtRegistrarPregunta();

        ?>

      </form>    </div>


      <!--btn f-->

      <div class="fixed-action-btn">
        <a href="#!" class="btn-floating btn-large red">
          <i class="material-icons">mode_edit</i>
        </a>
        <ul>
          <!-- <li><a href="#!" class="btn-floating tooltipped teal" data-position="left" data-tooltip="Crear examen"><i class="material-icons">mode_edit</i></a></li> -->

          <li><a href="#!" class="btn-floating yellow darken-2 tooltipped" data-position="left" data-tooltip="Resultados - Individual"><i class="material-icons">person</i></a></li>

          <!-- account_balance location_city -->
          <li><a href="#!" class="btn-floating deep-orange darken-1 tooltipped" data-position="left" data-tooltip="Resultados - Carrera"><i class="material-icons">account_balance</i></a></li>

          <li><a href="#!" class="btn-floating green tooltipped" data-position="left" data-tooltip="Resultados - Grupal"><i class="material-icons">group</i></a></li>

          <li><a href="#!" class="btn-floating grey tooltipped" data-position="left" data-tooltip="Ver gráficas"><i class="material-icons">trending_up</i></a></li>

          <li><a href="#!" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Cerrar sesión"><i class="material-icons">exit_to_app</i></a></li>
        </ul>
      </div>
      <!---->


      <!-- Compiled and minified JavaScript -->
      <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
      <script src="../js/preload.login.js"></script>


      <script>    
        document.addEventListener('DOMContentLoaded', function() {
          M.AutoInit();
          var elems = document.querySelectorAll('.sidenav');
          var instances = M.Sidenav.init(elems);

          var elems = document.querySelectorAll('.fixed-action-btn');
          var instances = M.FloatingActionButton.init(elems, {
            direction: 'top',
            hoverEnabled: false
          });
          var elems = document.querySelectorAll('.slider');
          var instances = M.Slider.init(elems, {
            indicators: false,
            height: 631
          });
        });
      </script>
    </body>
    </html>