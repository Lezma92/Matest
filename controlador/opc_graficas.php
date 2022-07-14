<?php 
require_once("operaciones.php");
if (isset($_POST["idVersion"])) {
	$idV = $_POST["idVersion"];
	$resultado = Operaciones::getGeneral($idV);
	echo json_encode($resultado);
}elseif (isset($_POST["id_carrera"])) {
	$idCarrera = $_POST["id_carrera"];
	$resultado = Operaciones::getGraGrupos($idCarrera);
	echo(json_encode($resultado));
}elseif (isset($_POST["idGrupo"])) {
	$idGrupo = $_POST["idGrupo"];
	$resultado = Operaciones::getAlumnosGrupos($idGrupo);
	echo(json_encode($resultado));
}elseif (isset($_POST["ver_examen"])) {
	$ver_examen = $_POST["ver_examen"];
	$resultado = Operaciones::getPreguntaAll($ver_examen);

	echo(json_encode($resultado));
}
?>