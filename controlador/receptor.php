<?php 
require_once('operaciones.php');
require_once("../alertas/alert.php");
class nuevo {
	
	function registrar(){
		$tipo = "";
		if (isset($_POST['registrarAlumno'])) {
			$exist = Operaciones::existsAlumno($_POST["nombre"]." ".$_POST["app"]." ".$_POST["apm"]);
			if ($exist["id"]  == "") {
				$tipo = "Alumno";
				$datos = array("nombre" => $_POST["nombre"],
					"app" => $_POST["app"],
					"apm" => $_POST["apm"],
					"tipo" => $tipo,
					"id_carrera"=>$_POST["carreras"],
					"id_grupo"=>$_POST["grupos"],
					"id_asesor"=>$_POST["asesor"]);
				Operaciones::startAlumno($datos);
				echo '<script language="javascript">window.location="vista.php"</script>';
			}elseif ($exist["id"] != "") {
				alertas::alertTipos("warning","El alumno ya se registro actualmente");
			}

			
		}elseif (isset($_POST["registrarUsuario"])) {
			$tipo = $_POST["tipo"];
			$datos = array("nombre" => $_POST["nom"],
				"app" => $_POST["app"],
				"apm" => $_POST["apm"],
				"tipo" => $tipo,
				"username"=> $_POST["username"],
				"pass" => $_POST["password"]);
			$respuesta = Operaciones::insertDatosPerson($datos,1);

			if ($respuesta != "" && $respuesta !="error") {
				Operaciones::insertUsuario($respuesta,$datos["username"],$datos["pass"],$datos["tipo"]);
				
			}
			echo '<script language="javascript">window.location="add_users.php"</script>';
		}
	}

	function acceso(){
		if (isset($_POST["btnAcceso"])) {
			$user = $_POST["iptUser"];
			$password = $_POST["iptPassword"];
			$array = array(
				"user" =>$user,
				"password"=>$password
			);

			$valit = Operaciones::getAcceso($array);

			if ($valit["nick"] == $user && $valit["password"]==$password) {
				session_start();
				$_SESSION["nick"] = $user;
				$_SESSION["pass"] = $password;
				$_SESSION["nivel_usuario"] = $valit["nivel_usuario"];
				echo '<script language="javascript">window.location="../admin/index.php"</script>';
				
			}

			
		}
		
	}
	function guardarRespuestas(){
		$cont = 1;
		$vectorResp=[];
		$vectorPreg=[];
		if (isset($_POST["guardarRespuestas"])) {
			$size = $_POST["cont"];
			$id_inicio = Operaciones::getidInicioExamen($_SESSION["nombre"]);
			
			for ($i=1; $i <= $size; $i++) { 
				$vectorResp[$i] = $_POST["res".$i];
				$vectorPreg[$i] = $_POST["id_pregunta".$i];
			}
			
			$r;
			for ($i=1; $i <= $size ; $i++) { 
				$r = Operaciones::insertCalificaciones($id_inicio["id"],$vectorPreg[$i],$vectorResp[$i]);
			}
			if ($r == "succes") {
				session_destroy();
				alertas::alertCloseAuto("Respuestas registradas correctamente","Gracias por realizar la evaluación");	
			}
			
		}
	}

	function updateUser(){
		if (isset($_POST["btnUpdate"])) {
			$datos = array(
				"idDato"=>$_POST["idDato"],
				"idUser"=>$_POST["idUser"],
				"nombre" => $_POST["nom"],
				"app" => $_POST["app"],
				"apm" => $_POST["apm"],
				"tipo" => $_POST["tipo"],
				"username"=> $_POST["username"],
				"pass" => $_POST["password"]
			);


			$respuesta = Operaciones::setUser($datos);
			if ($respuesta == "ok") {
				echo('<script>Swal.fire({
					title: "Usuario actualizado correctamente",
					text: "",
					type: "success",
					confirmButtonColor: "#3085d6",	
					confirmButtonText: "ok!"
					}).then((result) => {
						if (result.value) {
							window.location.href = "../admin/add_users.php";
						}
					})</script>');
				//echo '<script language="javascript">window.location="add_users.php"</script>';
			}
		}
	}
	function insertExamenes(){
		if (isset($_POST["btnGuardarExamen"])) {
			$nombre = $_POST["exa"];
			$respuesta = Operaciones::insertExamen($nombre);
			if ($respuesta == "ok") {
				echo('<script>Swal.fire({
					title: "El examen se agregó correctamente",
					text: "",
					type: "success",
					confirmButtonColor: "#3085d6",	
					confirmButtonText: "ok!"
					}).then((result) => {
						if (result.value) {
							window.location.href = "../admin/add_users.php";
						}
					})</script>');
				//echo '<script language="javascript">window.location="add_users.php"</script>';
			}
		}
	}
	public static function activarExamen(){
		if (isset($_POST["activarExamen"])) {
			$idCa = $_POST["carrera"];
			$idV = $_POST["idActivar"];
			$res = Operaciones::exist($idV,$idCa);
			if ($res) {
				
			}
		}
		
	}
	
}



?>