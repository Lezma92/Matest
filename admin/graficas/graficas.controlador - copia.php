<?php 
class ControladorGraficas{

	static public function General(){

		$respuesta = ModeloGraficas::obtenerGeneral();

		return $respuesta;
	}

	static public function General2(){

		$respuesta = ModeloGraficas::obtenerGeneral2();

		return $respuesta;
	}

	static public function General3(){

		$respuesta = ModeloGraficas::obtenerGeneral3();

		return $respuesta;
	}


	static public function Grafica_alumno($id,$grupo){

		$respuesta = ModeloGraficas::mdlGrafica_alumno($id,$grupo);

		return $respuesta;

	}

	static public function ObtenerGrupos($id){

		$respuesta = ModeloGraficas::mdlGrafica_grupo($id);

		return $respuesta;


	}

	static public function ObtenerGrupos2($id){

		$respuesta = ModeloGraficas::mdlGrafica_grupo2($id);

		return $respuesta;


	}

	static public function ObtenerGrupos3($id){

		$respuesta = ModeloGraficas::mdlGrafica_grupo3($id);

		return $respuesta;


	}
}