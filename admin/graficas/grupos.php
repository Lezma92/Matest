

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Grupos
    
    </h1>
   

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      

      <div class="box-header with-border">
  
        

      </div>

      <div class="box-body">
        
      
      <?php 
      	$id = $_GET[""];
      	$consulta = ControladorGraficas::ObtenerGrupos($id);
      	$consulta2 = ControladorGraficas::ObtenerGrupos2($id);
      	$consulta3= ControladorGraficas::ObtenerGrupos3($id);



      	

      	$dataPoints = array();
            foreach ($consulta as $key => $value) {
             
                array_push($dataPoints, array("y" => $value["total"], "label" => $value["grupo"]));
            }

        $dataPoints2 = array();
            foreach ($consulta2 as $key => $value) {
             
                array_push($dataPoints2, array("y" => $value["total"], "label" => $value["grupo"]));
            }
            
        $dataPoints3 = array();
            foreach ($consulta3 as $key => $value) {
             
                array_push($dataPoints3, array("y" => $value["total"], "label" => $value["grupo"]));
            }     




       ?>
       <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  exportEnabled: true,
  animationEnabled: true,
  title:{
    text: "Gráfica Por Grupos"
  },
  subtitles: [{
    text: "MATEST"
  }], 
  axisX: {
    title: "Áreas"
  },
  axisY: {
    title: "Algebra - Units",
    titleFontColor: "#4F81BC",
    lineColor: "#4F81BC",
    labelFontColor: "#4F81BC",
    tickColor: "#4F81BC"
  },
  axisY2: {
    title: "Aritmetica - Units",
    titleFontColor: "#C0504E",
    lineColor: "#C0504E",
    labelFontColor: "#C0504E",
    tickColor: "#C0504E"
  },
  axisY3: {
    title: "Geometria - Units",
    titleFontColor: "##CFCC29",
    lineColor: "##CFCC29",
    labelFontColor: "##CFCC29",
    tickColor: "##CFCC29"
  },
  toolTip: {
    shared: true
  },
  legend: {
    cursor: "pointer",
    itemclick: toggleDataSeries
  },
  data: [{
    type: "column",
    name: "Algebra",
    showInLegend: true,      
    yValueFormatString: "#,##0.# Puntos",
    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
  },
  {
    type: "column",
    name: "Aritmetica",
    showInLegend: true,      
    yValueFormatString: "#,##0.# Puntos",
    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
  },

  {
    type: "column",
    name: "Geometria",
    axisYType: "secondary",
    showInLegend: true,
    yValueFormatString: "#,##0.# Puntos",
    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
  }]
});
chart.render();

function toggleDataSeries(e) {
  if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
    e.dataSeries.visible = false;
  } else {
    e.dataSeries.visible = true;
  }
  e.chart.render();
}

}
</script>     

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


      </div>

    </div>

  </section>

</div>

