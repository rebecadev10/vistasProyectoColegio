-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-04-2026 a las 22:38:06
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunicacion`
--

CREATE TABLE `comunicacion` (
  `idAnuncio` int(11) NOT NULL,
  `asunto` varchar(50) NOT NULL,
  `descripcion` varchar(600) NOT NULL,
  `imagenAnuncio` varchar(80) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comunicacion`
--

INSERT INTO `comunicacion` (`idAnuncio`, `asunto`, `descripcion`, `imagenAnuncio`, `fecha`) VALUES
(1, 'Únete al Club de Innovación Tecnológica: ¡Programa', 'El Departamento de Computación invita a todos los estudiantes interesados en tecnología a unirse a nuestro club. Participa en:\n\nTalleres de programación básica (Python, HTML)\n\nDiseño de páginas web y aplicaciones simples\n\nProyectos prácticos con robótica educativa\n\nHorario:\nInicio: 10 de septiembre | Días: Martes y jueves (3:00 PM - 4:30 PM)\nLugar: Laboratorio 3 (Edificio Principal)\n\nInscripciones abiertas hasta el 5 de septiembre.\nInformes: Prof. Carlos Pérez (sala de profesores) o correo: clubcomputacion@instituto.edu\n\n\"Transforma tus ideas en soluciones tecnológicas\".', 'comunicacion/a.png', '2025-04-01'),
(2, 'prueba', 'Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus..\r\n\r\nPraesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum..\r\n\r\nSed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci..\r\n\r\nAliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla', 'comunicacion/prueba.jfif', '2025-04-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamentos`
--

CREATE TABLE `departamentos` (
  `idDepartamento` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `departamentos`
--

INSERT INTO `departamentos` (`idDepartamento`, `nombre`) VALUES
(1, ' '),
(2, 'Biblioteca '),
(3, 'Control de Estudio'),
(4, 'Difusion Cultural'),
(5, 'Psicopedagogia'),
(6, 'Computacion'),
(7, 'Educacion Fisica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `idEventos` int(11) NOT NULL,
  `titulo` varchar(25) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `nombreImagen` varchar(50) NOT NULL,
  `departamento` int(2) NOT NULL,
  `fechaInicio` date NOT NULL,
  `horaInicio` time NOT NULL,
  `fechaFin` date NOT NULL,
  `horaFin` time NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEventos`, `titulo`, `descripcion`, `nombreImagen`, `departamento`, `fechaInicio`, `horaInicio`, `fechaFin`, `horaFin`, `estado`) VALUES
(2, 'inscripcion curso pre uni', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido ', 'eventos/inscripcion_curso_pre_universitario.jfif', 3, '2025-04-15', '08:30:00', '2025-04-30', '05:30:00', 1),
(3, 'What is Lorem Ipsum?', 'Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus..\r\n\r\nPraesent adipiscing. Phasellus ullamcorper ips', 'eventos/What_is_Lorem_Ipsum_.png', 4, '2025-04-20', '09:00:00', '2025-05-15', '08:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticias` int(11) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `nombreImagenN` varchar(100) NOT NULL,
  `estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticias`, `titulo`, `descripcion`, `nombreImagenN`, `estado`) VALUES
(1, 'What is Lorem Ipsum?', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'noticias/What_is_Lorem_Ipsum_.jfif', 1),
(3, 'esto es una prueba', 'XXX', 'noticias/esto_es_una_prueba.jfif', 1),
(4, 'Prueba', 'xxx', 'noticias/Prueba.png', 1),
(6, 'cambio en el horario', 'debido al decreto de... xxx', 'noticias/cambio_en_el_horario.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idPermisos` int(11) NOT NULL,
  `descripcion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idPermisos`, `descripcion`) VALUES
(1, 'ESTUDIANTE'),
(2, 'DOCENTE'),
(3, 'ADMINISTRATIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(11) NOT NULL,
  `pregunta` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `pregunta`) VALUES
(1, '¿Cuál era el nombre de tu primera mascota?'),
(2, '¿En qué ciudad naciste?'),
(3, '¿Cómo se llamaba tu mejor amigo/a de la infancia?'),
(4, '¿Cuál era el nombre de tu colegio de primaria?'),
(5, 'Qué apodo tenías de niño/a?'),
(6, '¿Cuál es el segundo nombre de tu madre?'),
(7, '¿En qué año se casaron tus padres?'),
(8, '¿Cuál es el nombre de tu abuelo materno?'),
(9, 'Qué profesión tenía tu abuela paterna?'),
(10, '¿Cómo se llama tu primo/a más cercano/a?'),
(11, '¿En qué ciudad conociste a tu pareja?'),
(12, '¿Cuál fue tu primer lugar de trabajo?'),
(13, '¿En qué hospital naciste?'),
(14, 'Qué calle vivías cuando tenías 10 años?'),
(15, '¿Cuál es el nombre de tu playa o montaña favorita?'),
(16, '¿Cuál fue tu número de identificación estudiantil '),
(17, 'Qué materia reprobaste en el colegio?'),
(18, '¿Cuál era el nombre de tu profesor favorito en sec'),
(19, 'Qué instrumento musical aprendiste de niño/a?'),
(20, '¿En qué año te graduaste del colegio?'),
(21, '¿Cuál fue el primer concierto al que asististe?'),
(22, 'Qué deporte practicabas en la adolescencia?'),
(23, '¿Cuál es el nombre del primer libro que leíste com'),
(24, 'Qué película viste más veces en el cine?'),
(25, '¿Cuál fue tu primer vehículo (marca/modelo)?'),
(26, '¿Cuál es el nombre de tu primer jefe?'),
(27, 'Qué platillo cocinabas con tu familia en Navidad?'),
(28, '¿Cuál es el apellido de soltera de tu abuela?'),
(29, 'Qué premio ganaste en la escuela?'),
(30, '¿Cuál era el nombre de tu peluche favorito?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE `recursos` (
  `idRecursos` int(11) NOT NULL,
  `tituloRecurso` varchar(50) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `autor` varchar(20) NOT NULL,
  `fechaPublicacion` date NOT NULL,
  `editorial` varchar(25) NOT NULL,
  `idDepartamento` int(11) NOT NULL,
  `fotoPortada` varchar(100) NOT NULL,
  `dataRecurso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recursos`
--

INSERT INTO `recursos` (`idRecursos`, `tituloRecurso`, `descripcion`, `autor`, `fechaPublicacion`, `editorial`, `idDepartamento`, `fotoPortada`, `dataRecurso`) VALUES
(2, 'normas', 'Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus..\r\n\r\nPraesent adipiscing. Phasellus ullamcorper ips', 'uba', '2025-04-24', 'no aplica', 3, 'recursos/2025-04-24-normas.png', 'recursos/-CATALOGO EZER SPORT.pdf'),
(3, 'prueba', 'mmmm', 'n', '2025-04-30', 'no aplica', 5, 'recursos/2025-04-30-prueba.jfif', 'recursos/--6B Plan de Evaluación -2- (1).pdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `respuesta` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas`
--

INSERT INTO `respuestas` (`idRespuesta`, `idPregunta`, `idUsuario`, `respuesta`) VALUES
(1, 20, 7, '2019]'),
(2, 13, 8, 'x]'),
(3, 17, 9, 'matematicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` int(8) NOT NULL,
  `imagenUsuario` varchar(80) NOT NULL,
  `clave` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `cedula`, `imagenUsuario`, `clave`) VALUES
(1, 'Rebeca', 'Rodríguez', 30051282, 'usuarios/30051282-Rebeca.jfif', '12345'),
(2, 'Jade', 'Chiquin', 29450555, '', '12345'),
(3, 'Luis', 'rodriguez', 16368790, 'usuarios/user.png', '12345678'),
(4, 'alejandra', 'milan', 15713515, 'usuarios/user.png', '12345'),
(5, 'Evangeline', 'Fox', 12321111, 'usuarios/user.png', 'jacks'),
(6, 'x', 'c', 1223456, 'usuarios/user.png', 'xx'),
(7, 'Rebeca', 'Rodriguez', 30051288, 'usuarios/user.png', '11111'),
(8, 'a', 'a', 12098222, 'usuarios/user.png', '101010'),
(9, 'luigi', 'perez', 12345678, 'usuarios/user.png', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariopermiso`
--

CREATE TABLE `usuariopermiso` (
  `idUsuarioPer` int(11) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `idPermisos` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuariopermiso`
--

INSERT INTO `usuariopermiso` (`idUsuarioPer`, `idUsuario`, `idPermisos`) VALUES
(2, 2, 1),
(3, 2, 2),
(4, 2, 3),
(14, 1, 1),
(15, 1, 2),
(16, 3, 1),
(17, 4, 1),
(18, 5, 1),
(19, 6, 1),
(20, 7, 1),
(21, 8, 1),
(22, 9, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunicacion`
--
ALTER TABLE `comunicacion`
  ADD PRIMARY KEY (`idAnuncio`);

--
-- Indices de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`idDepartamento`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEventos`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticias`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idPermisos`);

--
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`idRecursos`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuesta`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuariopermiso`
--
ALTER TABLE `usuariopermiso`
  ADD PRIMARY KEY (`idUsuarioPer`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunicacion`
--
ALTER TABLE `comunicacion`
  MODIFY `idAnuncio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEventos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idPermisos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `idRecursos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuesta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuariopermiso`
--
ALTER TABLE `usuariopermiso`
  MODIFY `idUsuarioPer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
