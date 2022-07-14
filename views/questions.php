
<!-- <?php 
    session_start();    
    $nombre = $_SESSION["nombre"];
    $id_carrera = $_SESSION["id_carrera"];
    $id_grupo = $_SESSION["id_grupo"];
    $id_asesor = $_SESSION["id_asesor"];

    ?> -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Compiled and minified CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"> -->
    <link rel="stylesheet" href="../css/materialize.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/animate.min.css">
    <script src="../js/cronometro.js"></script> <!-- Para el cronómetro api -->
    <title>Examen de Matemáticas</title>

<style>
.waves-effect input[type="button"], .waves-effect input[type="reset"], .waves-effect input[type="submit"] {
    border: 0;
    font-style: normal;
    color: #fff;
    font-size: inherit;
    text-transform: inherit;
    background: none;
}
</style>
</head>

<body onload="carga()"> <!-- Para el cronómetro api -->

<?php include("preload.views.php"); ?>

<div class="hide" id="contenido"> <!-- inicioHide -->
<?php echo("<h5>Alumno = $nombre</h5>"); ?>
<?php echo ("<h5>id_asesor = $id_asesor <h/5>"); ?>
<?php echo("<h5>id_carrera= $id_carrera</h5>"); ?>
<?php echo ("<h5>id_grupo = $id_grupo <h/5>"); ?>
<div class="container center section">
        <blockquote>

        <h4 class="mat">MATEST</h4><small class="smallxD">UNIVERSIDAD TECNOLÓGICA DE LA COSTA GRANDE DE GUERRERO.</small>
            <!-- Cronómetro -->
            <div class="container section">
            <p>
            <span id="minutos" class="flow-text">0</span> <span class="flow-text">:</span> <span class="flow-text" id="segundos">0</span>
            </p>
            <input type="button" onclick="detenerse()" class="btn btn-small red darken-3 waves-effect waves-light" value="Detener"/> <!-- quitalo si quieres -->
            </div>
        </blockquote>
    </div>
    <!--&nbsp;  Espacio-->

    <div class="row container">
        <div class="col s12 m12">
            <h1 class="flow-text center exam">Examen de diagnóstico en Matemáticas.</h1>
        </div>
        <div class="col s12 m12">
            <hr style="width:100%">
            <p class="prf" style="text-align:justify">En cada uno de los siguientes reactivos, existen cuatro o tres propuestas de respuesta, sólo una es la correcta, indique cuál es la subrayándola. No se permite el uso de calculadora. </p>
            <hr style="width:100%">
        </div>
        
    <form action="" method="POST">

    <div class="col s12 m12">

        <?php include 'q1-5.php'?>

            <br><br>

                                                <!-- Pregunta #6 - 10 -->

            <?php include 'q6-10.php'; ?>


            <br><br>

                                                <!-- Pregunta #11 - 15 -->

            <?php include 'q11-15.php'; ?>

            <br><br>

                                                <!-- Pregunta #16 - 20 -->

            <?php  include 'q16-20.php'; ?>

            
            <br><br>

                                            <!-- Pregunta #16 - 20 -->

        <?php  include 'q21-25.php'; ?>


            <br><br>

        <!-- Pregunta #16 - 20 -->

        <?php  include 'q26-30.php'; ?>

    </div> 


    <div class="col s6 offset-s4 m6 offset-m5">
        <button name="btnGuardar" class="btn waves-effect waves-light">Guardar datos</button>
    </div>

    </form>

</div>

</div>   <!-- finHide -->

<script>
     document.addEventListener('DOMContentLoaded', function() {

        M.AutoInit();

        var gg = document.querySelectorAll('.tooltipped');
        var wp = M.Tooltip.init(gg);

        var r = document.querySelectorAll('.modal');
        var t = M.Modal.init(r);

        });
</script>


<script src="../js/preload.tpp.js"></script>
<script src="../js/materialize.min.js"></script>
</body>
</html>