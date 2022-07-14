<?php 

session_start();    
session_get_cookie_params();
if (isset($_SESSION["nombre"]) && isset($_SESSION["id_carrera"])) { 
 $nombre = $_SESSION["nombre"];
 $id_carrera = $_SESSION["id_carrera"];
 $id_grupo = $_SESSION["id_grupo"];
 $id_asesor = $_SESSION["id_asesor"]; 


 ?>
 <!DOCTYPE html>
 <html lang="es">
 <head>
  <meta charset="utf-8">
  <title>Mostrar Preguntas de examen</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/sweetalert2.all.js"></script>
</head>
<body>
  <div>
   <?php require_once("../controlador/operaciones.php");
   require_once("../controlador/receptor.php");

   ?>
   <div class="container mt-1">

    <div class="alert alert-info text-center mt-5">
      <h4>UNIVERSIDAD TECNOLÓGICA DE LA COSTA GRANDE DE GUERRERO.</h4>
      <strong>MATEST</strong>
    </div>
    <div class="alert alert-success" role="alert">
      <h4 class="alert-heading">Examen de diagnóstico de Matemásticas.</h4>
      <p>En cada uno de los siguientes reactivos, existen cuatro o tres propuestas de respuestas, sólo una es la correcta, indique cuál es, subrayándola. <strong>No</strong> se permite el uso de <strong>calculadora</strong>.</p>
      <hr>
      <p class="mb-0">Suerte !! :D.</p>
    </div>
    

    <div class="ml-4 mt-5">  

     <form method="POST">
       <?php 
       $areas = Operaciones::getArea("random");
       $cont = 0;
       $vec = ["A","B","C","D"];

       foreach ($areas as $key => $value) {

        $preguntas = Operaciones::getPreguntas($value["id"], $id_carrera);

        if (sizeof($preguntas)>0) {

          foreach ($preguntas as $key => $valueP) {

           $cont++;

           if ($valueP["tipo"] == "PLetra") {

            echo '<b>'.$cont."). ".$valueP["pregunta"].'</b><br><br>';

          } elseif($valueP["tipo"]=="PIMG"){

            echo '<b>'.$cont."). ".'</b> <img src="'.$valueP["pregunta"].'" style="width:420px"><br><br>';

          }

          echo('<input type="hidden" name="id_pregunta'.$cont.'" value="'.$valueP["id"].'">');

          $n = 0;
          $respuesta = Operaciones::getRespuestas($valueP["id"]);
          $p = [];
          $bandera = 0;
          $tmp = 0;

          for ($i=0; $i < sizeof($respuesta); $i++) { 
            if ($respuesta[$i]["tipo"]=="RIMG") {
              $p[$tmp] = $respuesta[$i]["respuesta"];
              $bandera = 1;
              $tmp++;
            }

          }

          foreach ($respuesta as $key => $valueR) {
            if ($bandera == 1) {
              echo('<img src="'.$p[0].'" style="width:420px" class="ml-5">');
              echo("<br>");
              $bandera = 0;
            }

            if ($valueR["tipo"] == "RLetra" && $valueR["respuesta"]!="S/RL") {

              echo('<label><input type="radio" class="ml-5" name="res'.$cont.'" value="'.$valueR["id"].'" required>'.$vec[$n].')'.$valueR["respuesta"].'</label>');


            }elseif ($valueR["tipo"]=="RIMG" || $valueR["tipo"] == "RLetra" && $valueR["respuesta"]=="S/RL") {
              echo('<label class="mr-5"><input class="ml-5" type="radio" name="res'.$cont.'" value="'.$valueR["id"].'" required>'.$vec[$n].')</label>');
            }
            $n++;
          }
          echo('<input type="hidden" name="cont" value="'.$cont.'">');
          echo("<br><br>");
        }
        

      }else{
        require_once("../alertas/alert.php");
        Operaciones::deleteAlumno($nombre);
        alertas::alertCloseAuto("No se encontró evaluación activa","Intente más tarde por favor");
        session_destroy(); 
        break;
      }

    }

    ?>
    <div class="form-group row">
      <div class="col-sm-5 mx-auto mb-4 mt-4">
        <button type="submit" name="guardarRespuestas" class="btn btn-block btn-info">Guardar</button>
      </div>
    </div>
    <?php nuevo::guardarRespuestas(); ?>
    
  </form>
</div>

</div> <!-- fin del margin left -->

<!-- <h4><?php echo($cont) ?></h4> -->
</div>
</body>
</html>
<?php }else{

  echo("No pasa la session");
 // echo '<script language="javascript">window.location="index.php"</script>';
}  ?>