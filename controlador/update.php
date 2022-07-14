<?php 
 require_once("../controlador/operaciones.php");
if (isset($_POST["idDato"]) && isset($_POST["idUser"])) {
	$idDato = $_POST["idDato"];
	$idUser = $_POST["idUser"];
	$respuesta = Operaciones::getuserUpdate($idDato, $idUser);
	echo json_encode($respuesta);

}elseif (isset($_POST["id_carrera"])) {
	$id_carrera = $_POST["id_carrera"];
	$respuesta = Operaciones::existActivo($id_carrera,5,0);
	echo(json_encode($respuesta));

}elseif (isset($_GET["version"]) && isset($_GET["carrera"])) {
	$carrera = $_GET["carrera"];
	$version = $_GET["version"];
	Operaciones::actDesExamen($carrera,$version,"Activado");
	echo '<script language="javascript">window.location="../admin/table_exam.php"</script>';

}elseif (isset($_POST["id_version"]) && isset($_POST["idCarrera"])) {
	$id_version = $_POST["id_version"];
	$id_carrera = $_POST["idCarrera"];
	$respuesta = Operaciones::actDesExamen($id_carrera,$id_version,"Desactivado");
	if ($respuesta == "Ok") {
		$a = array('respuesta' => "Bien");
		echo(json_encode($a));
	}
}



?>