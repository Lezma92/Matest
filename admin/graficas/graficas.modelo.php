<?php 
require_once "conexion.php";
class ModeloGraficas{

    static public function nombre($id){

        $stmt = Conexion::conectar()->prepare("SELECT 
            CONCAT(dp.nombre, ' ', dp.app, ' ', dp.apm) as nombre
            FROM
            datos_personales as dp
            INNER JOIN
            alumnos AS al ON al.id_datos_personales = dp.id
            AND al.id = $id;");

        $stmt -> execute();

        return $stmt -> fetch();


    }


    static public function obtenerGeneral(){

      $stmt = Conexion::conectar()->prepare("SELECT 
        ca.nombre as carreras, ae.nombre as area, ((COUNT(resp.id) / 10) * 10) AS total
        FROM
        datos_personales AS dp
        INNER JOIN
        alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
        grupo AS gp ON gp.id = al.id_grupo 
        INNER JOIN
        carreras AS ca ON ca.id = gp.id_carrera
        INNER JOIN
        examen_inicio AS ex_i ON ex_i.id_alumno = al.id
        INNER JOIN
        resultados AS result ON ex_i.id = result.id_inicio
        INNER JOIN
        preguntas AS preg ON result.id_pregunta = preg.id
        INNER JOIN
        version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
        INNER JOIN
        area_examen AS ae ON preg.id_area = ae.id and ae.id = 1
        LEFT JOIN
        respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
        GROUP BY ca.id;");

      $stmt -> execute();

      return $stmt -> fetchAll();


  }

  static public function obtenerGeneral2(){

    $stmt = Conexion::conectar()->prepare("SELECT 
        ca.nombre as carreras, ae.nombre as area, ((COUNT(resp.id) / 10) * 10) AS total
        FROM
        datos_personales AS dp
        INNER JOIN
        alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
        grupo AS gp ON gp.id = al.id_grupo 
        INNER JOIN
        carreras AS ca ON ca.id = gp.id_carrera
        INNER JOIN
        examen_inicio AS ex_i ON ex_i.id_alumno = al.id
        INNER JOIN
        resultados AS result ON ex_i.id = result.id_inicio
        INNER JOIN
        preguntas AS preg ON result.id_pregunta = preg.id
        INNER JOIN
        version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
        INNER JOIN
        area_examen AS ae ON preg.id_area = ae.id and ae.id = 2
        LEFT JOIN
        respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
        GROUP BY ca.id;");

    $stmt -> execute();

    return $stmt -> fetchAll();


}

static public function obtenerGeneral3(){

    $stmt = Conexion::conectar()->prepare("SELECT 
        ca.nombre as carreras, ae.nombre as area, ((COUNT(resp.id) / 10) * 10) AS total
        FROM
        datos_personales AS dp
        INNER JOIN
        alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
        grupo AS gp ON gp.id = al.id_grupo 
        INNER JOIN
        carreras AS ca ON ca.id = gp.id_carrera
        INNER JOIN
        examen_inicio AS ex_i ON ex_i.id_alumno = al.id
        INNER JOIN
        resultados AS result ON ex_i.id = result.id_inicio
        INNER JOIN
        preguntas AS preg ON result.id_pregunta = preg.id
        INNER JOIN
        version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
        INNER JOIN
        area_examen AS ae ON preg.id_area = ae.id and ae.id = 3
        LEFT JOIN
        respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
        GROUP BY ca.id;");

    $stmt -> execute();

    return $stmt -> fetchAll();


}

static public function mdlGrafica_alumno($id,$grupo){

    $stmt = Conexion::conectar()->prepare("SELECT 
        ex_i.id_alumno, ae.nombre, COUNT(resp.id)
        FROM
        datos_personales AS dp
        INNER JOIN
        alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
        grupo AS gp ON gp.id = al.id_grupo
        AND gp.grupo = '$grupo'
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

static public function mdlGrafica_grupo($id){

   $stmt = Conexion::conectar()->prepare("SELECT 
    gp.grupo, ae.nombre, ((COUNT(resp.id) / 10) * 10) AS total
    FROM
    datos_personales AS dp
    INNER JOIN
    alumnos AS al ON dp.id = al.id_datos_personales
    INNER JOIN
    grupo AS gp ON gp.id = al.id_grupo
    INNER JOIN
    carreras AS ca ON ca.id = gp.id_carrera and ca.id = $id
    INNER JOIN
    examen_inicio AS ex_i ON ex_i.id_alumno = al.id
    INNER JOIN
    resultados AS result ON ex_i.id = result.id_inicio
    INNER JOIN
    preguntas AS preg ON result.id_pregunta = preg.id
    INNER JOIN
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
    INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id and  ae.id = 1
    LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
    AND resp.re_correcta = 'C'
    GROUP BY gp.id , ae.id;");

   $stmt -> execute();

   return $stmt -> fetchAll();

}


static public function mdlGrafica_grupo2($id){

   $stmt = Conexion::conectar()->prepare("SELECT 
    gp.grupo, ae.nombre, ((COUNT(resp.id) / 10) * 10) AS total
    FROM
    datos_personales AS dp
    INNER JOIN
    alumnos AS al ON dp.id = al.id_datos_personales
    INNER JOIN
    grupo AS gp ON gp.id = al.id_grupo
    INNER JOIN
    carreras AS ca ON ca.id = gp.id_carrera and ca.id = $id
    INNER JOIN
    examen_inicio AS ex_i ON ex_i.id_alumno = al.id
    INNER JOIN
    resultados AS result ON ex_i.id = result.id_inicio
    INNER JOIN
    preguntas AS preg ON result.id_pregunta = preg.id
    INNER JOIN
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
    INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id and  ae.id = 2
    LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
    AND resp.re_correcta = 'C'
    GROUP BY gp.id , ae.id;");

   $stmt -> execute();

   return $stmt -> fetchAll();

}

static public function mdlGrafica_grupo3($id){

   $stmt = Conexion::conectar()->prepare("SELECT 
    gp.grupo, ae.nombre, ((COUNT(resp.id) / 10) * 10) AS total
    FROM
    datos_personales AS dp
    INNER JOIN
    alumnos AS al ON dp.id = al.id_datos_personales
    INNER JOIN
    grupo AS gp ON gp.id = al.id_grupo
    INNER JOIN
    carreras AS ca ON ca.id = gp.id_carrera and ca.id = $id
    INNER JOIN
    examen_inicio AS ex_i ON ex_i.id_alumno = al.id
    INNER JOIN
    resultados AS result ON ex_i.id = result.id_inicio
    INNER JOIN
    preguntas AS preg ON result.id_pregunta = preg.id
    INNER JOIN
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = 1
    INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id and  ae.id = 3
    LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
    AND resp.re_correcta = 'C'
    GROUP BY gp.id , ae.id;");

   $stmt -> execute();

   return $stmt -> fetchAll();

}

}



