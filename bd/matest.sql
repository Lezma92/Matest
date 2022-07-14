-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2019 a las 21:57:43
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `matest`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `activarExamen` (IN `idExamen` INT(11), IN `stats` VARCHAR(25), IN `idV` INT(11))  BEGIN
    insert into stats_examen values(null, idV,idExamen,stats);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteUser` (IN `id_datos` INT(11))  begin 
delete from datos_personales where id = id_datos;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getAlumnosGrupos` (IN `idGrupo` INT(5))  BEGIN
SELECT 
    (select grupo from grupo where id = al.id_grupo) as grupo, al.id, CONCAT(dp.nombre, ' ', dp.app, ' ', dp.apm) AS nombre
FROM
    datos_personales AS dp
        INNER JOIN
    alumnos AS al ON al.id_datos_personales = dp.id
        AND al.id_grupo = idGrupo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEstAlumno` (IN `idAlumno` INT(11))  BEGIN
SELECT 
        ex_i.id_alumno, ae.nombre, COUNT(resp.id)
        FROM
        datos_personales AS dp
        INNER JOIN
        alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
        grupo AS gp ON gp.id = al.id_grupo
        INNER JOIN
        carreras AS ca ON ca.id = gp.id_carrera
        INNER JOIN
        examen_inicio AS ex_i ON ex_i.id_alumno = al.id and al.id = idAlumno
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
        ORDER BY id_alumno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEstGeneral` ()  BEGIN
SELECT 
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
			area_examen AS ae ON preg.id_area = ae.id
			LEFT JOIN
			respuestas AS resp ON resp.id = result.id_respuesta
			AND resp.re_correcta = 'C'
			GROUP BY ca.id,ae.id order by ae.id ASC,ca.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getEstGrupos` (IN `idCarrera` INT(11))  SELECT 
			gp.grupo, ae.nombre AS area,  ((COUNT(resp.id) / 10) * 10) AS total
			FROM
			datos_personales AS dp
			INNER JOIN
			alumnos AS al ON dp.id = al.id_datos_personales
			INNER JOIN
			grupo AS gp ON gp.id = al.id_grupo
			INNER JOIN
			carreras AS ca ON ca.id = gp.id_carrera and ca.id = idCarrera
			INNER JOIN
			examen_inicio AS ex_i ON ex_i.id_alumno = al.id
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
			GROUP BY gp.id , ae.id order by ae.id ASC, gp.id ASC$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getExamActivos` ()  SELECT 
    st_ex.id,st_ex.id_version as id_version,st_ex.id_carrera as id_carrera,ca.nombre as carrera,ve.nombre as version
FROM
    carreras AS ca
        INNER JOIN
    stats_examen AS st_ex ON st_ex.id_carrera = ca.id and st_ex.status = "Activado"
        INNER JOIN
    version_examen AS ve ON ve.id = st_ex.id_version$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getGeneral` (IN `idV` INT(11))  BEGIN
SELECT 
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
			version_examen AS ve ON ve.id = preg.id_version AND ve.id = idV
			INNER JOIN
			area_examen AS ae ON preg.id_area = ae.id
			LEFT JOIN
			respuestas AS resp ON resp.id = result.id_respuesta
			AND resp.re_correcta = 'C'
			GROUP BY ca.id,ae.id order by ae.id ASC,ca.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHistorial` (IN `idUsu` INT(11))  begin 
SELECT 
    COUNT(result.id) AS historial,us.id
FROM
    datos_personales AS dp
        INNER JOIN
    usuarios AS us ON dp.id = us.id_datos_personales
        INNER JOIN
    examen_inicio AS ex_i ON ex_i.id_usuario = us.id
        INNER JOIN
    resultados AS result ON result.id_inicio = ex_i.id
WHERE
    us.id = idUsu
GROUP BY us.id;
end$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getHistorialExamen` (IN `id_examen` INT(11))  BEGIN
SELECT 
    *
FROM
    preguntas AS preg
        INNER JOIN
    resultados AS res ON res.id_pregunta = preg.id
WHERE
    preg.id_version = id_examen
GROUP BY res.id_pregunta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getUsers` (IN `idDato` INT(11), IN `idUser` INT(11))  BEGIN
 SELECT 
        dp.id AS idDatos,
        us.id AS idUsu,
        dp.nombre,
        dp.app,
        dp.apm,
        us.nick,
        dp.tipo_usuario,
        us.nivel_usuario
    FROM
        datos_personales AS dp
            INNER JOIN
        usuarios AS us ON us.id_datos_personales = dp.id
            AND dp.tipo_usuario <> 'Alumno' where dp.id=idDato and us.id = idUser
    GROUP BY us.id_datos_personales;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `graficaAlumnos` (IN `nombre` VARCHAR(60), IN `idversion` INT(11))  SELECT 
    ae.nombre, COUNT(resp.id) AS buenas
FROM
      datos_personales AS dp
        INNER JOIN
    alumnos AS al ON dp.id = al.id_datos_personales
        AND CONCAT(dp.nombre, ' ', dp.app, ' ', dp.apm) = nombre
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
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = idversion
        INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id
        LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
GROUP BY ae.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `graficaGeneral` (IN `idV` INT(11))  SELECT 
    ae.nombre, (COUNT(resp.id) / COUNT(preg.id) * 100) AS general
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
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = idV
        INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id
        LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
GROUP BY ae.id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `graficasGrupos` (IN `grup` VARCHAR(10), IN `vers` INT(11))  BEGIN
SELECT 
    ae.nombre, (COUNT(resp.id) / COUNT(preg.id) * 100) AS buenas
FROM
    datos_personales AS dp
        INNER JOIN
    alumnos AS al ON dp.id = al.id_datos_personales
        INNER JOIN
    grupo AS gp ON gp.id = al.id_grupo
        AND gp.grupo = grup
        INNER JOIN
    carreras AS ca ON ca.id = gp.id_carrera
        INNER JOIN
    examen_inicio AS ex_i ON ex_i.id_alumno = al.id
        INNER JOIN
    resultados AS result ON ex_i.id = result.id_inicio
        INNER JOIN
    preguntas AS preg ON result.id_pregunta = preg.id
        INNER JOIN
    version_examen AS ve ON ve.id = preg.id_version AND ve.id = vers
        INNER JOIN
    area_examen AS ae ON preg.id_area = ae.id
        LEFT JOIN
    respuestas AS resp ON resp.id = result.id_respuesta
        AND resp.re_correcta = 'C'
GROUP BY gp.id , ae.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertAlumnos` (IN `name` VARCHAR(60), IN `id_grupo` INT(11))  BEGIN
INSERT INTO alumnos VALUES(null,(SELECT id FROM datos_personales WHERE CONCAT(nombre,' ',app,' ',apm) = name),id_grupo);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertInicioExamen` (IN `name` VARCHAR(60), IN `id_usuario` INT(11))  INSERT INTO examen_inicio(id_usuario,id_alumno, fecha,hora) 
VALUES(id_usuario,(SELECT id FROM alumnos WHERE id_datos_personales= (SELECT id FROM datos_personales WHERE CONCAT(nombre,' ',app,' ',apm)=name)),CURDATE(),CURTIME())$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertUsuarios` (IN `nombre` VARCHAR(35), IN `usu` VARCHAR(25), IN `password` VARCHAR(25), IN `nivel` VARCHAR(25))  INSERT INTO usuarios (id_datos_personales,nick,password,nivel_usuario) VALUES 
((SELECT dp.id FROM datos_personales as dp WHERE CONCAT(dp.nombre,' ',dp.app,' ',dp.apm) = nombre),usu,password,nivel)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateStats` (IN `idExamen` INT(11), IN `stats` VARCHAR(25), IN `idV` INT(11))  BEGIN
    UPDATE stats_examen SET status = stats where id_carrera = idV and id_version = idExamen;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `updateUser` (IN `idDato` INT(11), IN `idUser` INT(11), IN `nom` VARCHAR(35), IN `app` VARCHAR(35), IN `apm` VARCHAR(35), IN `tipo_usu` VARCHAR(20), IN `nick` VARCHAR(25), IN `pass` VARCHAR(25))  begin
update datos_personales set nombre = nom, app = app, apm = apm, tipo_usuario = tipo_usu where id = idDato;
UPDATE usuarios 
SET 
    nick = nick,
    password = pass,
    nivel_usuario = tipo_usu
WHERE
    id = idUser;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `viewPreguntas` (IN `idVersion` INT(11))  BEGIN
SELECT 
    pg.id,
    IF(pg.rta_img_preg = 'S/PIMG',
        'Letra',
        'IMG') AS tipo,(SELECT nombre FROM area_examen where id = pg.id_area) as area,
    IF(pg.rta_img_preg = 'S/PIMG',
        pg.preguntas,
        pg.rta_img_preg) AS pregunta 
FROM
    preguntas AS pg
WHERE
    id_version = idVersion order by pg.id_area ASC;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `id_datos_personales` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `id_datos_personales`, `id_grupo`) VALUES
(1, 2, 3),
(3, 4, 17),
(4, 6, 2),
(5, 7, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_examen`
--

CREATE TABLE `area_examen` (
  `id` int(2) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `area_examen`
--

INSERT INTO `area_examen` (`id`, `nombre`) VALUES
(1, 'Algebra'),
(2, 'Aritmetica'),
(3, 'Geometrica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(5) NOT NULL,
  `nombre` varchar(130) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`) VALUES
(1, 'Tecnologías de la información'),
(2, 'Gastronomia'),
(3, 'Administración'),
(4, 'Metal Mecanica'),
(5, 'Procesos alimentarios'),
(6, 'Energías Renovables'),
(7, 'Turismo'),
(8, 'Mantenimiento industrial'),
(9, 'Logística internacional');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(35) NOT NULL,
  `app` varchar(35) NOT NULL,
  `apm` varchar(35) NOT NULL,
  `tipo_usuario` enum('Admin','Maestro','Alumno') NOT NULL,
  `fecha_reg` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_personales`
--

INSERT INTO `datos_personales` (`id`, `nombre`, `app`, `apm`, `tipo_usuario`, `fecha_reg`) VALUES
(1, 'Misael', 'Lezma', 'Mesino', 'Admin', '2019-08-18'),
(2, 'Fernando', 'Vazques', 'Jacintos', 'Alumno', '2019-08-19'),
(4, 'Karen', 'Galeana', 'Mi Dueño', 'Alumno', '2019-08-19'),
(5, 'Root', 'Root', 'Root', 'Admin', '2019-08-19'),
(6, 'Denys', 'Hernandez', 'Espuiz', 'Alumno', '2019-08-19'),
(7, 'Kenia ivett', 'Santos', 'Sanchez', 'Alumno', '2019-08-19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen_inicio`
--

CREATE TABLE `examen_inicio` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `examen_inicio`
--

INSERT INTO `examen_inicio` (`id`, `id_usuario`, `id_alumno`, `fecha`, `hora`) VALUES
(1, 1, 1, '2019-08-19', '00:54:19'),
(3, 1, 3, '2019-08-19', '01:02:16'),
(4, 1, 4, '2019-08-19', '10:50:43'),
(5, 1, 5, '2019-08-19', '10:53:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE `grupo` (
  `id` int(11) NOT NULL,
  `id_carrera` int(5) NOT NULL,
  `grupo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `id_carrera`, `grupo`) VALUES
(1, 1, 'TI1-1'),
(2, 1, 'TI1-2'),
(3, 1, 'TI1-3'),
(4, 2, 'GA1-1'),
(5, 2, 'GA1-2'),
(6, 2, 'GA1-3'),
(7, 3, 'DIE1-1'),
(8, 3, 'DIE1-2'),
(9, 3, 'DIE1-3'),
(10, 4, 'MM1-1'),
(11, 4, 'MM1-2'),
(12, 4, 'MM1-3'),
(13, 5, 'PA1-1'),
(14, 5, 'PA1-2'),
(15, 5, 'PA1-3'),
(16, 7, 'GDT1-1'),
(17, 7, 'GDT1-2'),
(18, 7, 'GDT1-3'),
(19, 6, 'ER1-1'),
(20, 6, 'ER1-2'),
(21, 6, 'ER1-3'),
(22, 8, 'MI1-1'),
(23, 8, 'MI1-2'),
(24, 8, 'MI1-3'),
(25, 9, 'OSI1-1'),
(26, 9, 'OSI1-2'),
(27, 9, 'OSI1-3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `id` int(11) NOT NULL,
  `id_area` int(2) NOT NULL,
  `id_version` int(11) NOT NULL,
  `preguntas` varchar(255) NOT NULL DEFAULT 'S/PL',
  `rta_img_preg` varchar(255) NOT NULL DEFAULT 'S/PIMG'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`id`, `id_area`, `id_version`, `preguntas`, `rta_img_preg`) VALUES
(1, 1, 1, 'si sumamos 3 + 3 el resultado es:', 'S/PIMG'),
(2, 1, 1, 'Si x = 5 / y = 6, entonces x² + y² = ', 'S/PIMG'),
(3, 1, 1, 'Si x² - 64 = 0, entonces x = ', 'S/PIMG'),
(4, 1, 1, 'Si 3y + 38 = 4x + 8 / x = 2y, entonces ¿cuáles son los valores de x e y?', 'S/PIMG'),
(5, 1, 1, 'Completa la secuencia: 1, 4, 9, 16, 25, ?', 'S/PIMG'),
(6, 1, 1, 'Si 4(a – 8) = 8, entonces a = ', 'S/PIMG'),
(7, 1, 1, '(a² – b²) =', 'S/PIMG'),
(8, 1, 1, 'Si (a + b)² = 64 / b = 3, entonces a =', 'S/PIMG'),
(9, 1, 1, 'Si 4(3x – 5) – 6(x – 5) = 70, entonces x =', 'S/PIMG'),
(10, 1, 1, 'Si x² + y² + 2xy = 25, entonces x + y =', 'S/PIMG'),
(11, 2, 1, 'siendo f(x)=x+1, calcular f(-2)', 'S/PIMG'),
(14, 2, 1, '¿cuanto hay que sumarle a 39, para que sea igual al mayor número o par de dos cifras?', 'S/PIMG'),
(15, 2, 1, 'cuando Carlos nació, Miguel tenia 5 años. ¿Después de cuántos años la suma de sus edades será 19 años?', 'S/PIMG'),
(16, 2, 1, '¿cuanto a que sumarle a 39 para que sea igual al mayor numero par de dos cifras ?', 'S/PIMG'),
(17, 2, 1, '¿si antes de ayer fue lunes qué día será el mañana de mañana ?', 'S/PIMG'),
(18, 2, 1, '¿En una papelería se compro un paquete con 8 libretas, con un costo 176 cuanto costo cada libreta?', 'S/PIMG'),
(19, 2, 1, 'Si en  un camión pasajero da 12 vueltas a la venida en le transcurso del día ¿cuantos vueltas va a dar en 3 días y medio?', 'S/PIMG'),
(20, 2, 1, 'Cada 8 días Don Pedro cobra su pensión $1150, ¿cuanto dinero cobraría al año ?', 'S/PIMG'),
(21, 2, 1, 'Si Juan nació cuando su papá tenía 18 años de edad y su mamá 15 ¿cuantos años tiene Juan si su papá tiene 87?', 'S/PIMG'),
(22, 2, 1, 'Si en una primaría en el área de la cooperativa se venden diariamente 40 tortas y 100 tacos con un valor de $17¿cual el total de la venta de esos productos?', 'S/PIMG'),
(23, 2, 1, 'Si Pedro tiene 30 dulces, María tiene 10 y Juan le pide la mitad a cada uno ¿cuantos dulces hay en total?', 'S/PIMG'),
(24, 3, 1, 'Una forma planar cerrada con 5 lados se llama?', 'S/PIMG'),
(25, 3, 1, 'Un triángulo es una forma planar cerrada con:', 'S/PIMG'),
(26, 3, 1, 'Una forma plana cerrada con 4 lados se llama:', 'S/PIMG'),
(27, 3, 1, 'Un segmento de línea se define por:', 'S/PIMG'),
(28, 3, 1, '¿cual de las siguientes afirmaciones describe mejor un cuadrado?', 'S/PIMG'),
(29, 3, 1, 'Un triangulo cuya base mide 10 cm, su lado 43.17 cm y su altura 42 cm. ¿cual seria su área?  ', 'S/PIMG'),
(30, 3, 1, 'Una mesa cuadrada de 1.20 m de lado. ¿cual es es su perimetro?', 'S/PIMG'),
(31, 3, 1, 'Una tapa de zapatos que mide 38 cm de largo por 21 cm de ancho. ¿de cuanto es  su perímetro?', 'S/PIMG'),
(32, 3, 1, 'Un pentágono regular que mide 7.265 cm de lado y 5 cm de apotema. ¿De cuanto es su área ? ', 'S/PIMG'),
(33, 3, 1, 'Una mesa cuadrada de 1.20 m de lado .¿De cuanto es su área ', 'S/PIMG'),
(35, 1, 1, 'S/PL', '../views/preguntas/12-08-2019-05.25.51.png'),
(36, 2, 1, 'S/PL', '../views/preguntas/14-08-2019-11.04.54.png'),
(37, 2, 1, 'cuanto es 2 + 2;', 'S/PIMG'),
(38, 1, 1, 'Al efectuar la operación indicada [8+(4-2)]+[9-(3+1)], el resultado es:', 'S/PIMG'),
(39, 1, 1, 'Después de efectuar la operación, (-x)(-y)(-z), el resultado es:', 'S/PIMG'),
(40, 1, 1, 'S/PL', '../views/preguntas/18-08-2019-23.59.22.png'),
(41, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.00.55.png'),
(42, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.02.52.png'),
(43, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.04.26.png'),
(44, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.09.15.png'),
(45, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.09.46.png'),
(46, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.13.15.png'),
(47, 1, 1, 'S/PL', '../views/preguntas/19-08-2019-00.13.44.png'),
(48, 2, 1, 'S/PL', '../views/preguntas/19-08-2019-00.17.23.png'),
(49, 2, 1, 'S/PL', '../views/preguntas/19-08-2019-00.17.55.png'),
(50, 2, 1, 'S/PL', '../views/preguntas/19-08-2019-00.18.23.png'),
(51, 2, 1, 'Si se efectúa el producto (m-n)(m+n), el resultado es:', 'S/PIMG'),
(52, 2, 1, 'El resultado del binomio al cubo, (n-4)³, es:', 'S/PIMG'),
(53, 2, 1, 'El producto de los dos binomios, (a+1)(a+2) es:', 'S/PIMG'),
(54, 2, 1, 'Al factorar la siguiente expresión, a³+a²+a, el resultado es:', 'S/PIMG'),
(55, 2, 1, 'S/PL', '../views/preguntas/19-08-2019-00.30.14.png'),
(56, 2, 1, 'Al factorar la siguiente expresión en dos factores 1-4m², el resultado es:', 'S/PIMG'),
(57, 2, 1, 'Si se factoriza la siguiente expresión en dos factores, c²+5c-24, el resultado es:', 'S/PIMG'),
(58, 3, 1, 'Factorar si es posible la siguiente expresión, a³+3a²+3a+1; si es posible, el resultado es:', 'S/PIMG'),
(59, 3, 1, 'El valor de x que satisface la ecuación 1-2[4-3(x+1)] = 4(x-5)-1 es:', 'S/PIMG'),
(60, 3, 1, 'Los valores de x que satisfacen la ecuación x 2²+5x+6=0 son:', 'S/PIMG'),
(61, 3, 1, 'S/PL', '../views/preguntas/19-08-2019-00.43.35.png'),
(62, 3, 1, 'S/PL', '../views/preguntas/19-08-2019-00.43.56.png'),
(63, 3, 1, 'S/PL', '../views/preguntas/19-08-2019-00.45.00.png'),
(64, 3, 1, 'S/PL', '../views/preguntas/19-08-2019-00.45.39.png'),
(65, 3, 1, 'Para sostener la torre de la antena de una estación de radio de 72 m de altura se desea poner tirantes de 120 m. para darle mayor estabilidad; si se proyecta tender los tirantes desde la parte más alta de la torre, ¿a qué distancia del pie de ésta deben c', 'S/PIMG'),
(66, 3, 1, 'La longitud del segmento x(m) marcado en la figura es:\r\nNota: las dimensiones de la figura están en metros.', 'S/PIMG'),
(67, 3, 1, 'Al resolver el siguiente sistema de ecuaciones, los valores de x e y son: x+y=5 x-y=1', 'S/PIMG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `id` int(11) NOT NULL,
  `id_preguntas` int(11) NOT NULL,
  `respuesta` varchar(255) NOT NULL DEFAULT 'S/RL',
  `rta_img_res` varchar(255) NOT NULL DEFAULT 'S/RIMG',
  `re_correcta` enum('C','I') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`id`, `id_preguntas`, `respuesta`, `rta_img_res`, `re_correcta`) VALUES
(1, 1, '6', 'S/RIMG', 'C'),
(2, 1, '10', 'S/RIMG', 'I'),
(3, 1, '5', 'S/RIMG', 'I'),
(4, 1, '22', 'S/RIMG', 'I'),
(5, 2, '19', 'S/RIMG', 'I'),
(6, 2, '35', 'S/RIMG', 'I'),
(7, 2, '52', 'S/RIMG', 'I'),
(8, 2, '61', 'S/RIMG', 'C'),
(9, 3, '16', 'S/RIMG', 'I'),
(10, 3, '8', 'S/RIMG', 'C'),
(11, 3, '24', 'S/RIMG', 'I'),
(12, 3, '4', 'S/RIMG', 'I'),
(13, 4, 'x = 6, y = 12', 'S/RIMG', 'I'),
(14, 4, 'x = 12, y = 6', 'S/RIMG', 'C'),
(15, 4, 'x = 4, y = 8', 'S/RIMG', 'I'),
(16, 4, 'x = 8, y = 4', 'S/RIMG', 'I'),
(17, 5, '36', 'S/RIMG', 'C'),
(18, 5, '55', 'S/RIMG', 'I'),
(19, 5, '5', 'S/RIMG', 'I'),
(20, 5, '120', 'S/RIMG', 'I'),
(21, 6, '1', 'S/RIMG', 'I'),
(22, 6, '10', 'S/RIMG', 'C'),
(23, 6, '8', 'S/RIMG', 'I'),
(24, 6, '125', 'S/RIMG', 'I'),
(25, 7, '(a – b) (a – b)', 'S/RIMG', 'I'),
(26, 7, '(a + b) (a + b)', 'S/RIMG', 'I'),
(27, 7, '(a+b)(a+x)', 'S/RIMG', 'I'),
(28, 7, '(a + b) (a – b)', 'S/RIMG', 'C'),
(29, 8, '87', 'S/RIMG', 'I'),
(30, 8, '5', 'S/RIMG', 'C'),
(31, 8, '30', 'S/RIMG', 'I'),
(32, 8, '78', 'S/RIMG', 'I'),
(33, 9, '10', 'S/RIMG', 'C'),
(34, 9, '62', 'S/RIMG', 'I'),
(35, 9, '0', 'S/RIMG', 'I'),
(36, 9, '14', 'S/RIMG', 'I'),
(37, 10, '63', 'S/RIMG', 'I'),
(38, 10, '5', 'S/RIMG', 'C'),
(39, 10, '30', 'S/RIMG', 'I'),
(40, 10, '87', 'S/RIMG', 'I'),
(41, 11, 'f(-2)=5', 'S/RIMG', 'C'),
(42, 11, 'f(-2)=-3', 'S/RIMG', 'I'),
(43, 11, 'f(-2)=-2', 'S/RIMG', 'I'),
(44, 11, 'f(-2)=0', 'S/RIMG', 'I'),
(53, 14, '69', 'S/RIMG', 'I'),
(54, 14, '54', 'S/RIMG', 'I'),
(55, 14, '64', 'S/RIMG', 'I'),
(56, 14, '59', 'S/RIMG', 'C'),
(57, 15, '9', 'S/RIMG', 'I'),
(58, 15, '6', 'S/RIMG', 'I'),
(59, 15, '8', 'S/RIMG', 'I'),
(60, 15, '7', 'S/RIMG', 'C'),
(61, 16, '64', 'S/RIMG', 'I'),
(62, 16, '81', 'S/RIMG', 'I'),
(63, 16, '69', 'S/RIMG', 'I'),
(64, 16, '59', 'S/RIMG', 'C'),
(65, 17, 'Jueves ', 'S/RIMG', 'I'),
(66, 17, 'Miercoles ', 'S/RIMG', 'I'),
(67, 17, 'Viernes ', 'S/RIMG', 'C'),
(68, 17, 'Sabado', 'S/RIMG', 'I'),
(69, 18, '25', 'S/RIMG', 'I'),
(70, 18, '22', 'S/RIMG', 'C'),
(71, 18, '27', 'S/RIMG', 'I'),
(72, 18, '32', 'S/RIMG', 'I'),
(73, 19, '42', 'S/RIMG', 'C'),
(74, 19, '36', 'S/RIMG', 'I'),
(75, 19, '48', 'S/RIMG', 'I'),
(76, 19, '52', 'S/RIMG', 'I'),
(77, 20, '50500', 'S/RIMG', 'I'),
(78, 20, '51750', 'S/RIMG', 'C'),
(79, 20, '48000', 'S/RIMG', 'I'),
(80, 20, '50000', 'S/RIMG', 'I'),
(81, 21, '69', 'S/RIMG', 'C'),
(82, 21, '79', 'S/RIMG', 'I'),
(83, 21, '66', 'S/RIMG', 'I'),
(84, 21, '73', 'S/RIMG', 'I'),
(85, 22, '2140', 'S/RIMG', 'I'),
(86, 22, '2310', 'S/RIMG', 'I'),
(87, 22, '2380', 'S/RIMG', 'C'),
(88, 22, '2250', 'S/RIMG', 'I'),
(89, 23, '40', 'S/RIMG', 'C'),
(90, 23, '20', 'S/RIMG', 'I'),
(91, 23, '25', 'S/RIMG', 'I'),
(92, 23, '30', 'S/RIMG', 'I'),
(93, 24, 'pentágono', 'S/RIMG', 'I'),
(94, 24, 'hexágono', 'S/RIMG', 'I'),
(95, 24, 'cuadrado', 'S/RIMG', 'I'),
(96, 24, 'heptágono', 'S/RIMG', 'C'),
(97, 25, '5 lados ', 'S/RIMG', 'C'),
(98, 25, '3 lados', 'S/RIMG', 'I'),
(99, 25, '4 lados ', 'S/RIMG', 'I'),
(100, 25, '2 lados ', 'S/RIMG', 'I'),
(101, 26, 'segment', 'S/RIMG', 'I'),
(102, 26, 'heptagon', 'S/RIMG', 'C'),
(103, 26, 'quadrilateral', 'S/RIMG', 'I'),
(104, 26, 'hexagon', 'S/RIMG', 'I'),
(105, 27, '1 punto', 'S/RIMG', 'C'),
(106, 27, '4 puntos', 'S/RIMG', 'I'),
(107, 27, '3 puntos', 'S/RIMG', 'I'),
(108, 27, '2 puntos', 'S/RIMG', 'I'),
(109, 28, 'Un cuadrado tiene 4 lados iguales', 'S/RIMG', 'I'),
(110, 28, 'Un cuadrado tiene 4 ángulos rectos', 'S/RIMG', 'I'),
(111, 28, 'Un cuadrado tiene 4 lados iguales y 4 ángulos rectos ', 'S/RIMG', 'C'),
(112, 28, '2 pares de lados paralelos', 'S/RIMG', 'I'),
(113, 29, '200 cm', 'S/RIMG', 'I'),
(114, 29, '215 cm', 'S/RIMG', 'I'),
(115, 29, '217 cm', 'S/RIMG', 'I'),
(116, 29, '210 cm', 'S/RIMG', 'C'),
(117, 30, '4.60 m', 'S/RIMG', 'I'),
(118, 30, '4.80 m', 'S/RIMG', 'C'),
(119, 30, '4.20 m', 'S/RIMG', 'I'),
(120, 30, '4.10', 'S/RIMG', 'I'),
(121, 31, '115 cm', 'S/RIMG', 'I'),
(122, 31, '110 cm', 'S/RIMG', 'I'),
(123, 31, '118 cm', 'S/RIMG', 'C'),
(124, 31, '123 cm', 'S/RIMG', 'I'),
(125, 32, '34.200 cm', 'S/RIMG', 'I'),
(126, 32, '36.325 cm', 'S/RIMG', 'C'),
(127, 32, '35.300 cm', 'S/RIMG', 'I'),
(128, 32, '37.250 cm', 'S/RIMG', 'I'),
(129, 33, '1.30 m', 'S/RIMG', 'I'),
(130, 33, '1.24 m', 'S/RIMG', 'I'),
(131, 33, '1.50 m', 'S/RIMG', 'I'),
(132, 33, '1.44 m', 'S/RIMG', 'C'),
(137, 35, 'S/RL', '../views/respuestas/12-08-2019-05.25.51.png', 'C'),
(138, 35, 'S/RL', 'S/RIMG', 'I'),
(139, 35, 'S/RL', 'S/RIMG', 'I'),
(140, 35, 'S/RL', 'S/RIMG', 'I'),
(141, 36, 'S/RL', 'S/RIMG', 'I'),
(142, 36, 'S/RL', '../views/respuestas/14-08-2019-11.04.54.png', 'C'),
(143, 36, 'S/RL', 'S/RIMG', 'I'),
(144, 36, 'S/RL', 'S/RIMG', 'I'),
(145, 37, '5', 'S/RIMG', 'I'),
(146, 37, '62', 'S/RIMG', 'I'),
(147, 37, '4', 'S/RIMG', 'C'),
(148, 37, '8', 'S/RIMG', 'I'),
(149, 38, '15', 'S/RIMG', 'C'),
(150, 38, '12', 'S/RIMG', 'I'),
(151, 38, '11', 'S/RIMG', 'I'),
(152, 38, '16', 'S/RIMG', 'I'),
(153, 39, 'xyz', 'S/RIMG', 'I'),
(154, 39, '-xyz', 'S/RIMG', 'C'),
(155, 39, '+xyz', 'S/RIMG', 'I'),
(156, 39, '±xyz', 'S/RIMG', 'I'),
(157, 40, 'S/RL', 'S/RIMG', 'I'),
(158, 40, 'S/RL', 'S/RIMG', 'I'),
(159, 40, 'S/RL', 'S/RIMG', 'I'),
(160, 40, 'S/RL', '../views/respuestas/18-08-2019-23.59.23.png', 'C'),
(161, 41, 'S/RL', 'S/RIMG', 'I'),
(162, 41, 'S/RL', '../views/respuestas/19-08-2019-00.00.55.png', 'C'),
(163, 41, 'S/RL', 'S/RIMG', 'I'),
(164, 41, 'S/RL', 'S/RIMG', 'I'),
(165, 42, 'S/RL', '../views/respuestas/19-08-2019-00.02.52.png', 'C'),
(166, 42, 'S/RL', 'S/RIMG', 'I'),
(167, 42, 'S/RL', 'S/RIMG', 'I'),
(168, 42, 'S/RL', 'S/RIMG', 'I'),
(169, 43, 'S/RL', 'S/RIMG', 'I'),
(170, 43, 'S/RL', 'S/RIMG', 'I'),
(171, 43, 'S/RL', '../views/respuestas/19-08-2019-00.04.26.png', 'C'),
(172, 43, 'S/RL', 'S/RIMG', 'I'),
(173, 44, 'S/RL', '../views/respuestas/19-08-2019-00.09.15.png', 'C'),
(174, 44, 'S/RL', 'S/RIMG', 'I'),
(175, 44, 'S/RL', 'S/RIMG', 'I'),
(176, 44, 'S/RL', 'S/RIMG', 'I'),
(177, 45, 'S/RL', '../views/respuestas/19-08-2019-00.09.47.png', 'C'),
(178, 45, 'S/RL', 'S/RIMG', 'I'),
(179, 45, 'S/RL', 'S/RIMG', 'I'),
(180, 45, 'S/RL', 'S/RIMG', 'I'),
(181, 46, 'S/RL', 'S/RIMG', 'I'),
(182, 46, 'S/RL', 'S/RIMG', 'I'),
(183, 46, 'S/RL', 'S/RIMG', 'I'),
(184, 46, 'S/RL', '../views/respuestas/19-08-2019-00.13.15.png', 'C'),
(185, 47, 'S/RL', 'S/RIMG', 'I'),
(186, 47, 'S/RL', 'S/RIMG', 'I'),
(187, 47, 'S/RL', '../views/respuestas/19-08-2019-00.13.44.png', 'C'),
(188, 47, 'S/RL', 'S/RIMG', 'I'),
(189, 48, 'S/RL', 'S/RIMG', 'I'),
(190, 48, 'S/RL', 'S/RIMG', 'I'),
(191, 48, 'S/RL', 'S/RIMG', 'I'),
(192, 48, 'S/RL', '../views/respuestas/19-08-2019-00.17.23.png', 'C'),
(193, 49, 'S/RL', 'S/RIMG', 'I'),
(194, 49, 'S/RL', '../views/respuestas/19-08-2019-00.17.55.png', 'C'),
(195, 49, 'S/RL', 'S/RIMG', 'I'),
(196, 49, 'S/RL', 'S/RIMG', 'I'),
(197, 50, 'S/RL', '../views/respuestas/19-08-2019-00.18.23.png', 'C'),
(198, 50, 'S/RL', 'S/RIMG', 'I'),
(199, 50, 'S/RL', 'S/RIMG', 'I'),
(200, 50, 'S/RL', 'S/RIMG', 'I'),
(201, 51, 'm² - n²', 'S/RIMG', 'C'),
(202, 51, 'm² + n²', 'S/RIMG', 'I'),
(203, 51, '(m+n)²', 'S/RIMG', 'I'),
(204, 51, '(m-n)²', 'S/RIMG', 'I'),
(205, 52, 'n³ - 12n²+48n-64', 'S/RIMG', 'C'),
(206, 52, 'n³+12n²+48n+64', 'S/RIMG', 'I'),
(207, 52, '-n³+12n²-48n+64', 'S/RIMG', 'I'),
(208, 52, '-n³+12n²-48n-68', 'S/RIMG', 'I'),
(209, 53, 'a²+3a+2', 'S/RIMG', 'C'),
(210, 53, 'a²+3', 'S/RIMG', 'I'),
(211, 53, 'a²+2a', 'S/RIMG', 'I'),
(212, 53, 'a²-3a+2', 'S/RIMG', 'I'),
(213, 54, 'a(a²+a+1)', 'S/RIMG', 'C'),
(214, 54, 'a(a²+a+a)', 'S/RIMG', 'I'),
(215, 54, 'a(a²+1+a)', 'S/RIMG', 'I'),
(216, 54, 'a(a²+a-1)', 'S/RIMG', 'I'),
(217, 55, '(a³-1)(a³+1)', 'S/RIMG', 'I'),
(218, 55, '(a³-1)(a³-1)', 'S/RIMG', 'C'),
(219, 55, '(a³+1)(a³-1)', 'S/RIMG', 'I'),
(220, 55, '(a³+1)(a³+1)', 'S/RIMG', 'I'),
(221, 56, '(1+2m)(1-2m)', 'S/RIMG', 'C'),
(222, 56, '(1+2m)(1+1m)', 'S/RIMG', 'I'),
(223, 56, '(1-2m)(1-2m)', 'S/RIMG', 'I'),
(224, 56, '(1+m)(1-2m)', 'S/RIMG', 'I'),
(225, 57, '(c+8)(3-c)', 'S/RIMG', 'I'),
(226, 57, '(c+8)(c+3)', 'S/RIMG', 'I'),
(227, 57, '(c+8)(c-3)', 'S/RIMG', 'C'),
(228, 57, '(c-8)(c-3)', 'S/RIMG', 'I'),
(229, 58, '(a-1)³', 'S/RIMG', 'I'),
(230, 58, '(a+1)(a+1)(a-1)', 'S/RIMG', 'I'),
(231, 58, '(a+1)(a-1)(a+1)', 'S/RIMG', 'I'),
(232, 58, '(a+1)(a+1)(a+1)', 'S/RIMG', 'C'),
(233, 59, 'x= -9', 'S/RIMG', 'I'),
(234, 59, 'x = 9', 'S/RIMG', 'I'),
(235, 59, 'x = 10', 'S/RIMG', 'I'),
(236, 59, 'x = -10', 'S/RIMG', 'C'),
(237, 60, 'S/RL', 'S/RIMG', 'I'),
(238, 60, 'S/RL', '../views/respuestas/19-08-2019-00.40.35.png', 'C'),
(239, 60, 'S/RL', 'S/RIMG', 'I'),
(240, 60, 'S/RL', 'S/RIMG', 'I'),
(241, 61, 'S/RL', '../views/respuestas/19-08-2019-00.43.35.png', 'C'),
(242, 61, 'S/RL', 'S/RIMG', 'I'),
(243, 61, 'S/RL', 'S/RIMG', 'I'),
(244, 61, 'S/RL', 'S/RIMG', 'I'),
(245, 62, 'S/RL', 'S/RIMG', 'I'),
(246, 62, 'S/RL', 'S/RIMG', 'I'),
(247, 62, 'S/RL', 'S/RIMG', 'I'),
(248, 62, 'S/RL', '../views/respuestas/19-08-2019-00.43.56.png', 'C'),
(249, 63, 'S/RL', 'S/RIMG', 'I'),
(250, 63, 'S/RL', 'S/RIMG', 'I'),
(251, 63, 'S/RL', 'S/RIMG', 'I'),
(252, 63, 'S/RL', '../views/respuestas/19-08-2019-00.45.00.png', 'C'),
(253, 64, '-27', 'S/RIMG', 'I'),
(254, 64, '26', 'S/RIMG', 'I'),
(255, 64, '27', 'S/RIMG', 'C'),
(256, 64, '-26', 'S/RIMG', 'I'),
(257, 65, 'a 96m de distancia', 'S/RIMG', 'C'),
(258, 65, 'a 140m de distancia', 'S/RIMG', 'I'),
(259, 65, 'a 180m de distancia', 'S/RIMG', 'I'),
(260, 65, 'a 85m de distancia', 'S/RIMG', 'I'),
(261, 66, 'S/RL', 'S/RIMG', 'I'),
(262, 66, 'S/RL', 'S/RIMG', 'I'),
(263, 66, 'S/RL', 'S/RIMG', 'I'),
(264, 66, 'S/RL', '../views/respuestas/19-08-2019-00.49.48.png', 'C'),
(265, 67, 'x=3 ;y=2', 'S/RIMG', 'C'),
(266, 67, 'x=-3; y=2', 'S/RIMG', 'I'),
(267, 67, 'x=3; y=-2', 'S/RIMG', 'I'),
(268, 67, 'x=-3; y=-2', 'S/RIMG', 'I');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `id_inicio` int(11) NOT NULL,
  `id_pregunta` int(11) NOT NULL,
  `id_respuesta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id`, `id_inicio`, `id_pregunta`, `id_respuesta`) VALUES
(1, 1, 45, 177),
(2, 1, 38, 150),
(3, 1, 42, 166),
(4, 1, 46, 182),
(5, 1, 44, 174),
(6, 1, 47, 186),
(7, 1, 41, 162),
(8, 1, 39, 155),
(9, 1, 40, 159),
(10, 1, 43, 169),
(11, 1, 52, 206),
(12, 1, 49, 195),
(13, 1, 56, 222),
(14, 1, 54, 214),
(15, 1, 55, 218),
(16, 1, 50, 198),
(17, 1, 51, 202),
(18, 1, 57, 226),
(19, 1, 53, 210),
(20, 1, 48, 190),
(21, 1, 58, 231),
(22, 1, 67, 267),
(23, 1, 61, 242),
(24, 1, 63, 251),
(25, 1, 65, 258),
(26, 1, 66, 263),
(27, 1, 62, 248),
(28, 1, 60, 238),
(29, 1, 64, 254),
(30, 1, 59, 234),
(31, 3, 42, 166),
(32, 3, 43, 169),
(33, 3, 46, 182),
(34, 3, 44, 174),
(35, 3, 8, 31),
(36, 3, 7, 26),
(37, 3, 39, 154),
(38, 3, 9, 35),
(39, 3, 4, 14),
(40, 3, 45, 178),
(41, 3, 24, 94),
(42, 3, 32, 125),
(43, 3, 28, 111),
(44, 3, 29, 115),
(45, 3, 61, 243),
(46, 3, 66, 264),
(47, 3, 31, 123),
(48, 3, 27, 106),
(49, 3, 63, 250),
(50, 3, 25, 98),
(51, 3, 54, 214),
(52, 3, 36, 142),
(53, 3, 52, 206),
(54, 3, 56, 223),
(55, 3, 14, 55),
(56, 3, 57, 226),
(57, 3, 16, 62),
(58, 3, 53, 211),
(59, 3, 19, 76),
(60, 3, 50, 198),
(61, 4, 7, 26),
(62, 4, 38, 150),
(63, 4, 42, 166),
(64, 4, 3, 10),
(65, 4, 9, 34),
(66, 4, 35, 138),
(67, 4, 5, 19),
(68, 4, 8, 31),
(69, 4, 41, 162),
(70, 4, 10, 38),
(71, 4, 66, 262),
(72, 4, 27, 105),
(73, 4, 61, 242),
(74, 4, 62, 246),
(75, 4, 26, 102),
(76, 4, 67, 266),
(77, 4, 28, 109),
(78, 4, 59, 234),
(79, 4, 33, 130),
(80, 4, 63, 250),
(81, 4, 11, 42),
(82, 4, 56, 221),
(83, 4, 49, 193),
(84, 4, 20, 78),
(85, 4, 52, 205),
(86, 4, 50, 198),
(87, 4, 57, 226),
(88, 4, 19, 75),
(89, 4, 23, 91),
(90, 4, 22, 87),
(91, 5, 24, 93),
(92, 5, 64, 253),
(93, 5, 26, 101),
(94, 5, 28, 109),
(95, 5, 32, 126),
(96, 5, 67, 266),
(97, 5, 33, 130),
(98, 5, 59, 234),
(99, 5, 31, 123),
(100, 5, 63, 251),
(101, 5, 35, 139),
(102, 5, 46, 183),
(103, 5, 44, 175),
(104, 5, 7, 26),
(105, 5, 3, 11),
(106, 5, 42, 166),
(107, 5, 39, 155),
(108, 5, 4, 14),
(109, 5, 43, 170),
(110, 5, 45, 179),
(111, 5, 51, 203),
(112, 5, 15, 60),
(113, 5, 11, 43),
(114, 5, 36, 142),
(115, 5, 52, 206),
(116, 5, 14, 55),
(117, 5, 17, 67),
(118, 5, 22, 87),
(119, 5, 56, 222),
(120, 5, 20, 79);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stats_examen`
--

CREATE TABLE `stats_examen` (
  `id` int(2) NOT NULL,
  `id_version` int(11) NOT NULL,
  `id_carrera` int(5) NOT NULL,
  `status` enum('Activado','Desactivado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `stats_examen`
--

INSERT INTO `stats_examen` (`id`, `id_version`, `id_carrera`, `status`) VALUES
(1, 1, 1, 'Desactivado'),
(2, 1, 2, 'Activado'),
(3, 1, 3, 'Activado'),
(4, 1, 4, 'Activado'),
(5, 1, 5, 'Activado'),
(6, 1, 6, 'Activado'),
(7, 1, 7, 'Activado'),
(8, 1, 8, 'Activado'),
(9, 1, 9, 'Activado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_datos_personales` int(11) NOT NULL,
  `nick` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `nivel_usuario` enum('Admin','Maestro','Alumno','Support') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_datos_personales`, `nick`, `password`, `nivel_usuario`) VALUES
(1, 1, 'Lezma92', '12345', 'Support'),
(2, 5, 'root', 'root', 'Admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `version_examen`
--

CREATE TABLE `version_examen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `version_examen`
--

INSERT INTO `version_examen` (`id`, `nombre`) VALUES
(1, 'Examen Prueba Matest 2019-2020');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `viewusuarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `viewusuarios` (
`idDatos` int(11)
,`idUsu` int(11)
,`nombre` varchar(35)
,`app` varchar(35)
,`apm` varchar(35)
,`nick` varchar(25)
,`tipo_usuario` enum('Admin','Maestro','Alumno')
,`nivel_usuario` enum('Admin','Maestro','Alumno','Support')
);

-- --------------------------------------------------------

--
-- Estructura para la vista `viewusuarios`
--
DROP TABLE IF EXISTS `viewusuarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewusuarios`  AS  select `dp`.`id` AS `idDatos`,`us`.`id` AS `idUsu`,`dp`.`nombre` AS `nombre`,`dp`.`app` AS `app`,`dp`.`apm` AS `apm`,`us`.`nick` AS `nick`,`dp`.`tipo_usuario` AS `tipo_usuario`,`us`.`nivel_usuario` AS `nivel_usuario` from (`datos_personales` `dp` join `usuarios` `us` on(`us`.`id_datos_personales` = `dp`.`id` and `dp`.`tipo_usuario` <> 'Alumno')) group by `us`.`id_datos_personales` ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos_personales` (`id_datos_personales`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `area_examen`
--
ALTER TABLE `area_examen`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `examen_inicio`
--
ALTER TABLE `examen_inicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_alumno` (`id_alumno`);

--
-- Indices de la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_version` (`id_version`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_preguntas` (`id_preguntas`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_inicio` (`id_inicio`),
  ADD KEY `id_pregunta` (`id_pregunta`),
  ADD KEY `id_respuesta` (`id_respuesta`);

--
-- Indices de la tabla `stats_examen`
--
ALTER TABLE `stats_examen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_version` (`id_version`) USING BTREE,
  ADD KEY `id_carrera` (`id_carrera`) USING BTREE;

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_datos_personales` (`id_datos_personales`);

--
-- Indices de la tabla `version_examen`
--
ALTER TABLE `version_examen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `area_examen`
--
ALTER TABLE `area_examen`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `examen_inicio`
--
ALTER TABLE `examen_inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=269;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `stats_examen`
--
ALTER TABLE `stats_examen`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `version_examen`
--
ALTER TABLE `version_examen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_datos_personales`) REFERENCES `datos_personales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `examen_inicio`
--
ALTER TABLE `examen_inicio`
  ADD CONSTRAINT `examen_inicio_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `examen_inicio_ibfk_2` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD CONSTRAINT `preguntas_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `area_examen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `preguntas_ibfk_2` FOREIGN KEY (`id_version`) REFERENCES `version_examen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`id_preguntas`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD CONSTRAINT `resultados_ibfk_1` FOREIGN KEY (`id_inicio`) REFERENCES `examen_inicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultados_ibfk_2` FOREIGN KEY (`id_pregunta`) REFERENCES `preguntas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `resultados_ibfk_3` FOREIGN KEY (`id_respuesta`) REFERENCES `respuestas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `stats_examen`
--
ALTER TABLE `stats_examen`
  ADD CONSTRAINT `stats_examen_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stats_examen_ibfk_2` FOREIGN KEY (`id_version`) REFERENCES `version_examen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_datos_personales`) REFERENCES `datos_personales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
