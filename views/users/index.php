<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- <link rel="icon" type="image/png" href="/imágenes/mifavicon.png" /> -->
    <link rel="shortcut icon" type="image/x-icon" href="../../img/ico/mat.ico" />
    <title>Página principal</title>

    <!--Imported Google Icons Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link rel="stylesheet" href="../../css/materialize.min.css">
    <link rel="stylesheet" href="../../css/animate.min.css">

</head>
<body>

<?php include("../preload.views.php"); ?>

<div class="hide" id="contenido"> <!-- inicioHide -->

<!-- Dropdown Structure -->
<ul id="dropdown1" class="dropdown-content">
    <li><a href="#!">Individual</a></li>
    <li class="divider"></li>
    <li><a href="#!">Carrera</a></li>
    <li class="divider"></li>
    <li><a href="#!">Grupal</a></li>
</ul>
<nav class="teal">
    <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo"><i class="material-icons">device_hub</i>MATEST</a>
        <ul class="right hide-on-med-and-down">
        <li><a href="#!">Ver gráfica</a></li>
        <!-- Dropdown Trigger -->
        <li><a class="dropdown-trigger" href="#!" data-target="dropdown1">Resultados<i class="material-icons right">arrow_drop_down</i></a></li>
        <li><a href="#!">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>


<?php include '../../modules/form-usuarios.php'; ?>


</div> <!-- CIERRE DEL PRELOAD -->



<!-- Floating Action Button -->

<div class="fixed-action-btn hide-on-large-only">
    <a href="#!" class="btn-floating btn-large red">
        <i class="material-icons">mode_edit</i>
    </a>
    <ul>
        <li><a href="#!" class="btn-floating tooltipped teal" data-position="left" data-tooltip="Ver gráfica"><i class="material-icons">trending_up</i></a></li>
            
        <li><a href="#!" class="btn-floating yellow darken-2 tooltipped" data-position="top" data-tooltip="Resultados - Individual"><i class="material-icons">person</i></a></li>

        <!-- account_balance location_city -->
        <li><a href="#!" class="btn-floating deep-orange darken-1 tooltipped" data-position="top" data-tooltip="Resultados - Carrera"><i class="material-icons">account_balance</i></a></li>

        <li><a href="#!" class="btn-floating green tooltipped" data-position="top" data-tooltip="Resultados - Grupal"><i class="material-icons">group</i></a></li>

        <li><a href="#!" class="btn-floating blue tooltipped" data-position="top" data-tooltip="Cerrar sesión"><i class="material-icons">exit_to_app</i></a></li>
    </ul>
</div>

<!-- FIN Floating Action Button -->

    <!-- Compiled and minified JavaScript -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script> -->
<script src="../../js/preload.login.js"></script>
<script src="../../js/materialize.min.js"></script>

    <script>    
        document.addEventListener('DOMContentLoaded', function() {
            M.AutoInit();
            var elems = document.querySelectorAll('.sidenav');
            var instances = M.Sidenav.init(elems);
            
            var elems = document.querySelectorAll('.fixed-action-btn');
            var instances = M.FloatingActionButton.init(elems, {
                direction: 'left'
            });
        });
    </script>
</body>
</html>
