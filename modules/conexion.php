<?php 

class Conexion{
	static public function getConexion(){
		$con = new PDO("mysql:host=localhost;dbname=matest","root","");
		$con->exec("set names utf8");
		return $con;
	}
}

?>