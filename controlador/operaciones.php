<?php 
require_once "../modules/conexion.php";
class Operaciones{


	static public function getGraAlumnos($id){

		$stmt = Conexion::getConexion()->prepare("SELECT 
			ex_i.id_alumno, ae.nombre, COUNT(resp.id) as total
			FROM
			datos_personales AS dp
			INNER JOIN
			alumnos AS al ON dp.id = al.id_datos_personales
			INNER JOIN
			grupo AS gp ON gp.id = al.id_grupo
			INNER JOIN
			carreras AS ca ON ca.id = gp.id_carrera
			INNER JOIN
			examen_inicio AS ex_i ON ex_i.id_alumno = al.id and al.id = $id
			INNER JOIN
			resultados AS result ON ex_i.id = result.id_inicio
			INNER JOIN
			preguntas AS preg ON result.id_pregunta = preg.id
			INNER JOIN
			version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
			INNER JOIN
			area_examen AS ae ON preg.id_area = ae.id
			LEFT JOIN
			respuestas AS resp ON resp.id = result.id_respuesta
			AND resp.re_correcta = 'C'
			GROUP BY ae.id , ex_i.id_alumno
			ORDER BY id_alumno;");

		$stmt -> execute();

		return $stmt -> fetchAll();


	}
	static public function getExamActivos(){
		$con = Conexion::getConexion()->prepare("call getExamActivos()");
		$con -> execute();
		return $con -> fetchAll();
	}
	static public function getGraGrupos($idCarrera){
		$con = Conexion::getConexion()->prepare("CALL getEstGrupos($idCarrera);");
		$con -> execute();
		return $con -> fetchAll();
	}
	static public function getAlumnosGrupos($idGrupo){
		$con = Conexion::getConexion()->prepare("call getAlumnosGrupos($idGrupo);");
		$con -> execute();
		return $con -> fetchAll();
	}

	static public function getGeneral($ve){
		$con = Conexion::getConexion()->prepare("CALL getGeneral($ve);");
		$con -> execute();
		return $con -> fetchAll();
	}

	function getNameExamen($idV){
		$con = Conexion::getConexion()->prepare("SELECT *FROM version_examen WHERE id = :idV;");
		$con -> bindParam(":idV",$idV,PDO::PARAM_INT);
		$con -> execute();
		return $con -> fetch();
	}

	static public function getCarreras($tabla, $item, $valor){
		if($item != null){
			$con = Conexion::getConexion()->prepare("SELECT id,nombre FROM $tabla WHERE $item = :$item");
			$con -> bindParam(":".$item, $valor, PDO::PARAM_STR);
			$con -> execute();
			return $con -> fetch();
		}else{
			$con = Conexion::getConexion()->prepare("SELECT id,nombre FROM $tabla");
			$con -> execute();
			return $con -> fetchAll();
		}	
		
		
	}

	static public function getGrupos($idC){
		$con = Conexion::getConexion()->prepare("SELECT id,grupo FROM grupo WHERE id_carrera = $idC");
		$con -> execute();
		return $con -> fetchAll();
		echo ($con);

	}

	static public function startAlumno($datos){
		session_start();
		Operaciones::insertDatosPerson($datos,0);
		$_SESSION["nombre"] = $datos["nombre"]." ".$datos["app"]." ".$datos["apm"];
		$_SESSION["id_carrera"] = $datos["id_carrera"];
		$_SESSION["id_asesor"] = $datos["id_asesor"];
		$_SESSION["id_grupo"] = $datos["id_grupo"];
 				# code...
	}
	static public function insertDatosPerson($datos,$tip){
		$con = Conexion::getConexion()->prepare("INSERT INTO datos_personales(nombre, app, apm, tipo_usuario,fecha_reg) VALUES (:nombre, :app, :apm, :tipo,CURDATE());");
		
		$con -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$con -> bindParam(":app", $datos["app"], PDO::PARAM_STR);
		$con -> bindParam(":apm", $datos["apm"], PDO::PARAM_STR);
		$con -> bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);

		if($con->execute()){	
			$nombre = $datos["nombre"]." ".$datos["app"]." ".$datos["apm"];			
			if ($tip==0) {
				if (Operaciones::insertAlumnos($nombre,$datos["id_grupo"],$datos["id_asesor"])=="ok") {
					return "ok";
				}
			}elseif ($tip == 1) {
				return $nombre;
			}
		}else{
			return "error";
			print_r($con->errorInfo());
		}
		

	}


	static public function insertAlumnos($nombre,$id_grupo,$id_asesor){			
		$con = Conexion::getConexion()->prepare("Call insertAlumnos(:nom,:id_grupo)");
		$con -> bindParam(":nom",$nombre,PDO::PARAM_STR);
		$con -> bindParam(":id_grupo",$id_grupo,PDO::PARAM_STR);
		if ($con->execute()) {
			if (Operaciones::insertInicioExamen($nombre,$id_asesor)=="ok") {
				return "ok";
			}

		}else{
			echo "Error Fuerte";
			return "error";

		}
	}

	static public function deleteAlumno($nombre){
		$con = Conexion::getConexion() -> prepare("DELETE FROM datos_personales WHERE CONCAT(nombre,' ',app,' ',apm) = :nom");
		$con -> bindParam(":nom",$nombre,PDO::PARAM_STR);
		if ($con -> execute()) {
			return "ok";
		}else{
			print_r($con->errorInfo());
		}

	}

	static public function existsAlumno($nombre){
		$con = Conexion::getConexion() -> prepare("SELECT id FROM datos_personales WHERE CONCAT(nombre,' ',app,' ',apm) = :nom");
		$con -> bindParam(":nom",$nombre,PDO::PARAM_STR);
		if ($con -> execute()) {
			return $con->fetch();
		}else{	
			print_r($con->errorInfo());
		}

	}

	
	static public function insertInicioExamen($nombre,$id_asesor){
		$con = Conexion::getConexion()->prepare("Call insertInicioExamen(:nom,:id_usu)");
		$con->bindParam(":nom",$nombre,PDO::PARAM_STR);
		$con->bindParam(":id_usu",$id_asesor,PDO::PARAM_STR);
		if ($con->execute()) {
			return "ok";
		}
	}



	static public function insertUsuario($nombre,$user,$password,$nivel){
		$con = Conexion::getConexion()->prepare("Call insertUsuarios(:nombre,:user,:password,:nivel)");

		//AES_ENCRYPT(:password,:key)
		$con -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
		$con -> bindParam(":user",$user,PDO::PARAM_STR);
		$con -> bindParam(":password",$password,PDO::PARAM_STR);
		$con -> bindParam(":nivel",$nivel,PDO::PARAM_STR);
		//$con -> bindParam(":key",$user,PDO::PARAM_STR);
		if ($con->execute()) {
			print_r($con->errorInfo());
			
			return "bien";
		}
		print_r($con->errorInfo());
		
		return "error";
		
	}


	static public function setUser($datos){
		$con = Conexion::getConexion()->prepare("Call updateUser(:idDato,:idUser,:nombre,:app,:apm,:tipo_usu,:nick,:password)");
		$con -> bindParam(":idDato",$datos["idDato"],PDO::PARAM_INT);
		$con -> bindParam(":idUser",$datos["idUser"],PDO::PARAM_INT);
		$con -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$con -> bindParam(":app",$datos["app"],PDO::PARAM_STR);
		$con -> bindParam(":apm",$datos["apm"],PDO::PARAM_STR);
		$con -> bindParam(":tipo_usu",$datos["tipo"],PDO::PARAM_STR);
		$con -> bindParam(":nick",$datos["username"],PDO::PARAM_STR);
		$con -> bindParam(":password",$datos["pass"],PDO::PARAM_STR);

		if ($con -> execute()) {
			return "ok";
		}


	}
	static public function getHistoUser($id_user){
		$con = Conexion::getConexion()->prepare("Call getHistorial(:id_user)");
		$con -> bindParam(":id_user",$id_user,PDO::PARAM_STR);
		$con -> execute();
		return $con -> fetch();
	}
	static public function getuserUpdate($idDato,$idUser){
		$con = Conexion::getConexion()->prepare("call getUsers(:idDato,:idUser)");
		$con -> bindParam(":idDato",$idDato,PDO::PARAM_INT);
		$con -> bindParam("idUser",$idUser,PDO::PARAM_INT);
		$con -> execute();
		return $con -> fetch();
	}
	static public function getUsers(){
		$con = Conexion::getConexion()->prepare("SELECT * FROM viewusuarios
			");
		$con->execute();
		$resultado = $con->fetchAll();
		return $resultado;
	}


	static public function deleteUser($dato){
		$con = Conexion::getConexion()->prepare("Call deleteUser(:id_datos)");
		$con -> bindParam(":id_datos",$dato,PDO::PARAM_STR);
		if ($con -> execute()) {
			return "ok";
		}
	}

	static public function getAcceso($token){
		$con = Conexion::getConexion()->prepare("SELECT nick,password,nivel_usuario FROM usuarios WHERE nick = :nick AND password = :pass");
		$con->bindParam(":nick",$token["user"],PDO::PARAM_STR);
		$con->bindParam(":pass",$token["password"],PDO::PARAM_STR);
		$con->execute();
		return $con->fetch();

	}

	static public function getArea($tipo){
		if ($tipo == "combo") {
			$con = Conexion::getConexion()->prepare("SELECT * FROM area_examen");
		}elseif ($tipo == "random") {
			$con = Conexion::getConexion()->prepare("SELECT id FROM area_examen ORDER BY RAND()");
		}
		if ($con->execute()) {
			return $con->fetchAll();
		}
	}
	static public function getVersion(){
		$con = Conexion::getConexion()->prepare("SELECT * FROM version_examen");
		if ($con->execute()) {
			return $con->fetchAll();
		}
	}
	static public function getExamenes(){
		$con = Conexion::getConexion()->prepare("SELECT 
			v.id,v.nombre, COUNT(pg.id) as total
			FROM
			version_examen AS v
			LEFT JOIN
			preguntas AS pg ON v.id = pg.id_version
			GROUP BY v.id");
		if ($con->execute()) {
			return $con->fetchAll();
			
		}
	}
	public static function existActivo($id_ca,$id_version,$opc){
		$sql = "SELECT status FROM stats_examen WHERE id_carrera= :id_ca and status = 'Activado';";
		if ($opc == 1) {
			$sql = "SELECT status FROM stats_examen WHERE id_carrera= :id_ca and id_version = $id_version";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con -> bindParam(":id_ca",$id_ca,PDO::PARAM_INT);
		$con -> execute();
		return $con->fetchAll();
	}
	public static function actDesExamen($carrera,$version,$estado){
		$res = Operaciones::existActivo($carrera,$version,1);
		$sql;
		if (sizeof($res)==0) {
			$sql = "INSERT INTO stats_examen VALUES(NULL,:id_version,:id_carrera,:estado)";
		}else{
			$sql = "UPDATE stats_examen SET status = :estado WHERE id_version = :id_version and id_carrera = :id_carrera;";
		}
		$con = Conexion::getConexion()->prepare($sql);
		$con -> bindParam(":id_version",$version,PDO::PARAM_INT);
		$con -> bindParam(":id_carrera",$carrera,PDO::PARAM_INT);
		$con -> bindParam(":estado",$estado,PDO::PARAM_STR);

		if ($con ->execute()) {
			return "Ok";
		}

	}

	public static function deleteExamen($id_ver){
		$con = Conexion::getConexion()->prepare("DELETE FROM version_examen WHERE id = :id");
		$con -> bindParam(":id",$id_ver,PDO::PARAM_STR);
		if ($con -> execute()) {
			return "bien";
		}
	}

	static public function insertExamen($nombre){
		$con = Conexion::getConexion()->prepare("INSERT INTO version_examen VALUES(null,:nombre)");
		$con -> bindParam(":nombre",$nombre,PDO::PARAM_STR);
		if ($con -> execute()) {
			return "bien";
		}
	}
	static public function getHistorialExamen($id_examen){
		$con = Conexion::getConexion()->prepare("CALL getHistorialExamen(:id_examen);");
		$con -> bindParam(":id_examen",$id_examen,PDO::PARAM_INT);
		$con -> execute();
		return $con -> fetchAll();
	}
	static public function mdlObtenerArea_version($tabla){

		$con = Conexion::getConexion()->prepare("SELECT * FROM $tabla");

		$con -> execute();

		return $con -> fetchAll();
	}

	static public function mdlRegistrarPregunta($tabla,$id_a,$id_v,$pregunta,$campo){

		$con = Conexion::getConexion()->prepare("INSERT INTO $tabla(id_area,id_version,$campo) VALUES (:id_a,:id_v,:pregunta)");

		$con -> bindParam(":id_a",$id_a,PDO::PARAM_INT);
		$con -> bindParam(":id_v",$id_v,PDO::PARAM_INT);
		$con -> bindParam(":pregunta",$pregunta,PDO::PARAM_STR);

		if($con -> execute()){

			return "ok";

		}


	}
	static public function mdlObtenerUltimoRegistro($tabla){

		$con = Conexion::getConexion()->prepare("SELECT id FROM $tabla ORDER by ID DESC LIMIT 1");

		$con -> execute();

		return $con -> fetchAll();

		

	}

	static public function mdl($campo,$tabla2,$id_pregunta,$respuestas,$res_a){
		$number = count($res_a);
		
		if($number > 0){  
			for($i=0; $i<$number; $i++){  


				$con = Conexion::getConexion()->prepare("INSERT INTO $tabla2(id_preguntas,$campo,re_correcta)VALUES(:id,:respuestas,:correctas)");

				$con->bindParam(":id", $id_pregunta, PDO::PARAM_INT);
				$con->bindParam(":respuestas", $respuestas[$i], PDO::PARAM_STR);
				$con->bindParam(":correctas", $res_a[$i], PDO::PARAM_STR);
				
				
				$con->execute();                                       	 
			}  
			return "ok";  
		}else{  
			echo "Please Enter Name";  
		}

	}
	public static function getPreguntaAll($idV){
		$con = Conexion::getConexion()->prepare('call viewPreguntas(:id_version);');
		$con -> bindParam(":id_version",$idV,PDO::PARAM_INT);

		$con -> execute();
		return $con -> fetchAll();
	}
	static public function getPreguntas($id_area,$id_carrera){
		$con = Conexion::getConexion()->prepare('SELECT result.id,result.tipo,result.pregunta FROM (SELECT pg.id, IF(pg.rta_img_preg = "S/PIMG", "PLetra", "PIMG") AS tipo, IF(pg.rta_img_preg = "S/PIMG", pg.preguntas, pg.rta_img_preg) AS pregunta
			FROM preguntas AS pg INNER JOIN stats_examen AS ste ON ste.id_version = pg.id_version AND ste.status = "Activado" AND ste.id_carrera = :id_carrera
			WHERE pg.id_area = :id_area ORDER BY RAND()) result LIMIT 10');
		$con -> bindParam(":id_area",$id_area,PDO::PARAM_STR);
		$con -> bindParam(":id_carrera",$id_carrera,PDO::PARAM_STR);
		$con -> execute();
		return $con->fetchAll();

	}
	static public function getRespuestas($id_pregunta){
		$con = Conexion::getConexion()->prepare('SELECT 
			respuestas.id, respuestas.tipo, respuestas.respuesta FROM (SELECT rp.id, IF(rp.rta_img_res = "S/RIMG", "RLetra", "RIMG") AS tipo, IF(rp.rta_img_res = "S/RIMG", rp.respuesta, rp.rta_img_res) AS respuesta FROM respuestas AS rp WHERE rp.id_preguntas = :id_pregunta) respuestas');
		$con->bindParam(":id_pregunta",$id_pregunta,PDO::PARAM_STR);
		
		if ($con->execute()) {
			return $con->fetchAll();
		}else{
			print_r($con->errorInfo());
		}
		
	}

	function getidInicioExamen($nomb){
		$con = Conexion::getConexion()->prepare('SELECT ex_i.id FROM examen_inicio AS ex_i INNER JOIN
			alumnos AS al ON ex_i.id_alumno = al.id INNER JOIN datos_personales AS dp ON dp.id = al.id_datos_personales WHERE CONCAT(dp.nombre," ",dp.app," ",dp.apm) = :nombre');
		$con -> bindParam(":nombre",$nomb,PDO::PARAM_STR);
		$con->execute();
		return $con->fetch();

	}

	static public function insertCalificaciones($id_inicio,$id_pregunta,$id_respuesta){
		$con = Conexion::getConexion()->prepare("INSERT INTO resultados VALUES (null,:id_inicio,:id_pregunta,:id_respuesta)");
		$con -> bindParam(":id_inicio",$id_inicio,PDO::PARAM_INT);
		$con -> bindParam(":id_pregunta",$id_pregunta,PDO::PARAM_INT);
		$con -> bindParam(":id_respuesta",$id_respuesta,PDO::PARAM_INT);

		if ($con -> execute()) {
			return "succes";
		}else{
			print_r($con->errorInfo());
		}
	}
	static public function getEstadisticas(){
		$con = Conexion::getConexion()->prepare("");
	}
}



?>