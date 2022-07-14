<?php 
require_once("operaciones.php");

class grupos{
	public $idCarrera;
	public function ajaxObtenerGrupos(){
		$valor = $this->idCarrera;
		$respuesta = Operaciones::getGrupos($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idCarrera"])){
	$carrera = new grupos();
	$carrera -> idCarrera = $_POST["idCarrera"];
	$carrera -> ajaxObtenerGrupos();
}elseif(isset($_POST["idActivar"])){	
	$id = $_POST["idActivar"];
	$carrera = Operaciones::getCarreras("carreras",null,null);
	echo json_encode($carrera);
	

}elseif ($_POST["idVersion"]) {
	$idVersion = $_POST["idVersion"];
}

?>