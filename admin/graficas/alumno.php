<div class="content-wrapper">

  <section class="content-header">
    <h1>
      Administrar alumno
    </h1>
    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar alumno</li>
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-header with-border">
  

      </div>

      <div class="box-body">
        
       
       <?php 
          $grupo = $_GET["grupo"];

          $nombre = ModeloGraficas::nombre($id);

          $consulta = ControladorGraficas::Grafica_alumno($id,$grupo);
          // echo $consulta[0]["COUNT(resp.id)"];
          // var_dump($consulta);

          $dataPoints = array();
            foreach ($consulta as $key => $value) {
             
                array_push($dataPoints, array("y" => $value["COUNT(resp.id)"], "label" => $value["nombre"]));
            }

            echo "<h1 class='text-center'>".$nombre["nombre"]."</1>";
        ?>

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
    text: ""
  },
  axisY: {
    title: "Growth Rate (in %)",
    suffix: "%",
    includeZero: false
  },
  axisX: {
    title: "Countries"
  },
  data: [{
    type: "column",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

}
</script>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

      </div>

    </div>

  </section>

</div>

