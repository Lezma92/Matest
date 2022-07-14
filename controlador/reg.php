<?php 
require_once("operaciones.php");
class ControladorPreguntas{
	static public function crtRegistrarPregunta(){
		require_once("../alertas/alert.php");
		date_default_timezone_set("America/Mexico_City");
		
		$res_a = array(0 => 'C', 1 => 'I', 2 => 'I', 3 => 'I');
		$res_b = array(0 => 'I', 1 => 'C', 2 => 'I', 3 => 'I');
		$res_c = array(0 => 'I', 1 => 'I', 2 => 'C', 3 => 'I');
		$res_d = array(0 => 'I', 1 => 'I', 2 => 'I', 3 => 'C');
		$tabla_respuestas ="respuestas";
		$tabla_preguntas = "preguntas";
		
				    //TEXTO -TEXTO
		if(isset($_POST["txt_pregunta"]) && isset($_POST["Respuesta_A"])){
			$id_area = $_POST["area"];
			$id_version = $_POST["version"];
			$pregunta = $_POST["txt_pregunta"];
			$respuestas = array();
			$A = $_POST["Respuesta_A"];
			$B = $_POST["Respuesta_B"];
			$C = $_POST["Respuesta_C"];
			$D=  $_POST["Respuesta_D"];
			$opc = $_POST["Ridios_respuesta"];
			array_push($respuestas,$A);array_push($respuestas,$B);
			array_push($respuestas,$C);array_push($respuestas,$D);
			$campo = "preguntas";

			$respuesta = Operaciones::mdlRegistrarPregunta($tabla_preguntas,$id_area,$id_version,$pregunta,$campo);

			$tabla_id = "preguntas";
			$id_pregunta = Operaciones::mdlObtenerUltimoRegistro($tabla_id);
			$id = $id_pregunta[0]["id"];
			$campo_r = "respuesta";

			switch ($opc){
				case 'option1':

				$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_a);

				if($res == "ok"){
					alertas::alertBasic("Pregunta registrada correctamente","");
				}

				break;
				case 'option2':

				$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_b);
				if($res == "ok"){
					alertas::alertBasic("Pregunta registrada correctamente","");
				}		

				break;
				case 'option3':
				$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_c);
				if($res == "ok"){

					alertas::alertBasic("Pregunta registrada correctamente","");
				}

				break;
				case 'option4':

				$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_d);
				if($res == "ok"){

					alertas::alertBasic("Pregunta registrada correctamente","");
				}

				break;    
			}//SWITCH

		}
		//PREGUNTA SEA TEXTO Y RESPUESTA FOTO.....................................................
		if(isset($_POST["txt_pregunta"]) && isset($_POST["Subir_foto_respuesta"])){
		

			/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["FotoRespuesta_2"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["FotoRespuesta_2"]["tmp_name"]);

					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["FotoRespuesta_2"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$hoy = date("d-m-Y-H.i.s");

						$aleatorio = mt_rand(100,999);

						$ruta = "../views/respuestas/".$hoy.".jpg";

						$origen = imagecreatefromjpeg($_FILES["FotoRespuesta_2"]["tmp_name"]);						

						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["FotoRespuesta_2"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						
						$hoy = date("d-m-Y-H.i.s");

						$ruta = "../views/respuestas/".$hoy.".png";

						$origen = imagecreatefrompng($_FILES["FotoRespuesta_2"]["tmp_name"]);						
						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				/////////////////////////////////////////////////////////////////////////
				$id_area = $_POST["area"];
				$id_version = $_POST["version"];
				$pregunta = $_POST["txt_pregunta"];
				$campo = "preguntas";

				$respuesta = Operaciones::mdlRegistrarPregunta($tabla_preguntas,$id_area,$id_version,$pregunta,$campo);

				$tabla_id = "preguntas";
				$id_pregunta = Operaciones::mdlObtenerUltimoRegistro($tabla_id);
				$id = $id_pregunta[0]["id"];
				$opc = $_POST["Radios_respuesta_Foto"];


				$ruta_a = array(0 => $ruta, 1 => 'S/RIMG', 2 => 'S/RIMG', 3 => 'S/RIMG');
				$ruta_b = array(0 => 'S/RIMG', 1 =>  $ruta, 2 => 'S/RIMG', 3 => 'S/RIMG');
				$ruta_c = array(0 => 'S/RIMG', 1 => 'S/RIMG', 2 =>  $ruta, 3 => 'S/RIMG');
				$ruta_d = array(0 => 'S/RIMG', 1 => 'S/RIMG', 2 => 'S/RIMG', 3 =>  $ruta);

				$campo_r = "rta_img_res";

				switch ($opc){
					case 'opc_1':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_a,$res_a);

					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'opc_2':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_b,$res_b);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}		

					break;
					case 'opc_3':
					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_c,$res_c);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'opc_4':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_d,$res_d);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;    
			}//SWITCH
			
			

		}
		//PREGUNTA SEA FOTO Y RESPUESTA TEXTO.....................................................
		if(isset($_POST["Subir_foto"]) && isset($_POST["Respuesta_A"])){

				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["FotoPregunta"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["FotoPregunta"]["tmp_name"]);

					

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["FotoPregunta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$hoy = date("d-m-Y-H.i.s");

						$aleatorio = mt_rand(100,999);

						$ruta = "../views/preguntas/".$hoy.".jpg";

						$origen = imagecreatefromjpeg($_FILES["FotoPregunta"]["tmp_name"]);						

						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["FotoPregunta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						
						$hoy = date("d-m-Y-H.i.s");

						$ruta = "../views/preguntas/".$hoy.".png";

						$origen = imagecreatefrompng($_FILES["FotoPregunta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				/////////////////////////////////////////////////////////////////////////
				$respuestas = array();
				$A = $_POST["Respuesta_A"];$B = $_POST["Respuesta_B"];
				$C = $_POST["Respuesta_C"];$D=  $_POST["Respuesta_D"];
				$opc = $_POST["Ridios_respuesta"];
				array_push($respuestas,$A);array_push($respuestas,$B);
				array_push($respuestas,$C);array_push($respuestas,$D);
				
				$id_area = $_POST["area"];
				$id_version = $_POST["version"];
				$campo = "rta_img_preg";

				$respuesta = Operaciones::mdlRegistrarPregunta($tabla_preguntas,$id_area,$id_version,$ruta,$campo);

				$tabla_id = "preguntas";
				$id_pregunta = Operaciones::mdlObtenerUltimoRegistro($tabla_id);
				$id = $id_pregunta[0]["id"];
				$campo_r = "respuesta";


				switch ($opc){
					case 'option1':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_a);

					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'option2':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_b);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}		

					break;
					case 'option3':
					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_c);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'option4':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$respuestas,$res_d);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;    
				}		

			}
		//PREGUNTA SEA FOTO Y RESPUESTA FOTO....................................................
			if(isset($_POST["Subir_foto"]) && isset($_POST["Subir_foto_respuesta"])){
			

			/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta = "";

				if(isset($_FILES["FotoPregunta"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["FotoPregunta"]["tmp_name"]);

					

					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["FotoPregunta"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$hoy = date("d-m-Y-H.i.s");

						$aleatorio = mt_rand(100,999);

						$ruta = "../views/preguntas/".$hoy.".jpg";

						$origen = imagecreatefromjpeg($_FILES["FotoPregunta"]["tmp_name"]);						

						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagejpeg($destino, $ruta);

					}

					if($_FILES["FotoPregunta"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						
						$hoy = date("d-m-Y-H.i.s");

						$ruta = "../views/preguntas/".$hoy.".png";

						$origen = imagecreatefrompng($_FILES["FotoPregunta"]["tmp_name"]);						
						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagepng($destino, $ruta);

					}

				}
				/////////////////////////////////////////////////////////////////////////
				/*=============================================
				VALIDAR IMAGEN
				=============================================*/

				$ruta_2 = "";

				if(isset($_FILES["FotoRespuesta_2"]["tmp_name"])){

					list($ancho, $alto) = getimagesize($_FILES["FotoRespuesta_2"]["tmp_name"]);

					
					/*=============================================
					DE ACUERDO AL TIPO DE IMAGEN APLICAMOS LAS FUNCIONES POR DEFECTO DE PHP
					=============================================*/

					if($_FILES["FotoRespuesta_2"]["type"] == "image/jpeg"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/
						$hoy = date("d-m-Y-H.i.s");

						$aleatorio = mt_rand(100,999);

						$ruta_2 = "../views/respuestas/".$hoy.".jpg";

						$origen = imagecreatefromjpeg($_FILES["FotoRespuesta_2"]["tmp_name"]);						

						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagejpeg($destino, $ruta_2);

					}

					if($_FILES["FotoRespuesta_2"]["type"] == "image/png"){

						/*=============================================
						GUARDAMOS LA IMAGEN EN EL DIRECTORIO
						=============================================*/

						
						$hoy = date("d-m-Y-H.i.s");

						$ruta_2 = "../views/respuestas/".$hoy.".png";

						$origen = imagecreatefrompng($_FILES["FotoRespuesta_2"]["tmp_name"]);						
						$destino = imagecreatetruecolor($ancho, $alto);

						imagecopyresized($destino, $origen, 0, 0, 0, 0, $ancho, $alto, $ancho, $alto);

						imagepng($destino, $ruta_2);

					}

				}
				/////////////////////////////////////////////////////////////////////////

				$id_area = $_POST["area"];
				$id_version = $_POST["version"];
				$campo = "rta_img_preg";

				$respuesta = Operaciones::mdlRegistrarPregunta($tabla_preguntas,$id_area,$id_version,$ruta,$campo);

				$tabla_id = "preguntas";
				$id_pregunta = Operaciones::mdlObtenerUltimoRegistro($tabla_id);
				$id = $id_pregunta[0]["id"];

				$opc = $_POST["Radios_respuesta_Foto"];


				$ruta_a = array(0 => $ruta_2, 1 => 'S/RIMG', 2 => 'S/RIMG', 3 => 'S/RIMG');
				$ruta_b = array(0 => 'S/RIMG', 1 =>  $ruta_2, 2 => 'S/RIMG', 3 => 'S/RIMG');
				$ruta_c = array(0 => 'S/RIMG', 1 => 'S/RIMG', 2 =>  $ruta_2, 3 => 'S/RIMG');
				$ruta_d = array(0 => 'S/RIMG', 1 => 'S/RIMG', 2 => 'S/RIMG', 3 =>  $ruta_2);

				$campo_r = "rta_img_res";

				

				switch ($opc){
					case 'opc_1':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_a,$res_a);

					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'opc_2':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_b,$res_b);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}		

					break;
					case 'opc_3':
					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_c,$res_c);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;
					case 'opc_4':

					$res = Operaciones::mdl($campo_r,$tabla_respuestas,$id,$ruta_d,$res_d);
					if($res == "ok"){

						alertas::alertBasic("Pregunta registrada correctamente","");
					}

					break;    
			}//SWITCH

		}

	}


}