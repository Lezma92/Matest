function graficaGeneral(ti,std1,std2,std3){
	var titulo = ti;
	window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: titulo
			},
			subtitles: [{
				text: "MATEST"
			}], 
			axisX: {
				title: "Áreas"
			},
			axisY: {
				title: "Porcentaje",
				titleFontColor: "#4fbca3",
				lineColor: "#4fbca3",
				labelFontColor: "#4fbca3",
				tickColor: "#4fbca3"
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
				dataPoints: std1
			},
			{
				type: "column",
				name: "Aritmetica",
				showInLegend: true,      
				yValueFormatString: "#,##0.# Puntos",
				dataPoints: std2
			},

			{
				type: "column",
				name: "Geometria",
				axisYType: "secondary",
				showInLegend: true,
				yValueFormatString: "#,##0.# Puntos",
				dataPoints: std3
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


}
function graficaGrupal(ti,std1,std2,std3){
	window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			exportEnabled: true,
			animationEnabled: true,
			title:{
				text: ti
			},
			subtitles: [{
				text: "MATEST"
			}], 
			axisX: {
				title: "Áreas"
			},
			axisY: {
				title: "Porcentajes",
				titleFontColor: "#4F81BC",
				lineColor: "#4F81BC",
				labelFontColor: "#4F81BC",
				tickColor: "#4F81BC"
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
				dataPoints: std1
			},
			{
				type: "column",
				name: "Aritmetica",
				showInLegend: true,      
				yValueFormatString: "#,##0.# Puntos",
				dataPoints: std2
			},

			{
				type: "column",
				name: "Geometria",
				axisYType: "secondary",
				showInLegend: true,
				yValueFormatString: "#,##0.# Puntos",
				dataPoints: std3
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
}
function getGraficasAlumno(ti,std1){
	window.onload = function () {

		var chart = new CanvasJS.Chart("chartContainer", {
			exportEnabled: true,
			animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title: {
  	text: ti
  },
  axisY: {
  	title: "Puntos",
  	suffix: "",
  	includeZero: true
  },
  axisX: {
  	title: "Countries"
  },
  data: [{
  	type: "column",
  	dataPoints: std1
  }]
});
		chart.render();

	}
}