<?php 
require_once("operaciones.php");

if (isset($_POST["id_user"])) {
	$id_user = $_POST["id_user"];
	$respuesta = Operaciones::getHistoUser($id_user);
	if ($respuesta["historial"] > 0) {
		echo json_encode($respuesta);
	}else{
		echo json_encode("ValioMode");
	}
}elseif (isset($_GET["opcion"])) {
	$id_dato = $_GET["opcion"];
	$r = Operaciones::deleteUser($id_dato);
	if ($r == "ok") {
		echo '<script language="javascript">window.location="../admin/add_users.php"</script>';
	}
}elseif (isset($_GET["idPre"])) {
	$id = $_GET["idPre"];
	$r = Operaciones::deleteExamen($id);
	if ($r=="bien") {
		echo '<script language="javascript">window.location="../admin/t_new.php"</script>';
	}
}elseif (isset($_POST["id_examen"])) {
	$id_examen = $_POST["id_examen"];
	$respuesta = Operaciones::getHistorialExamen($id_examen);
	echo(json_encode($respuesta));
}
?>