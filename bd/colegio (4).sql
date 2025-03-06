-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2025 a las 01:19:15
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
(1, 'Biblioteca'),
(2, 'Control de estudio'),
(3, 'Difusion cultural'),
(4, 'Psicopedagogia'),
(5, 'Computacion '),
(6, 'Educacion Fisica');

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
(1, 'Prueba', 'ATENCION esto es una prueba actualiza', 'imgProductos/no-image.jpg', 1, '2024-11-27', '05:34:00', '2024-11-27', '04:34:00', 1),
(2, 'esto es una prueba estado', 'prueba actualizar', 'imgProductos/no-image.jpg', 1, '2024-11-27', '16:32:00', '2024-11-28', '17:32:00', 1),
(3, 'esto es una prueba', 'hhhhh', '67aa62a342a0e-image (3) (1).png', 1, '2025-02-27', '22:33:00', '2025-02-28', '22:33:00', 1),
(4, 'pruebaa 2222', 'probando guardar datos', '67aa742ada827-Drapeau_Venezuela_Drapeau_Autocollan', 5, '2025-02-10', '20:47:00', '2025-02-11', '05:47:00', 1),
(5, 'prueba', 'probando la carga de imagenes', '67bfab4c3894e-Ras.png', 5, '2025-02-28', '20:01:00', '2025-03-01', '20:03:00', 1),
(6, 'prueba carga de imagen', 'probando el cargar una imagen', '67bfabd254c80-20250206_232445_123.jpg', 4, '2025-02-28', '11:02:00', '2025-03-09', '07:02:00', 1);

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
(1, 'prueba', 'esto es una prueba', '67aa634b724e1-WhatsApp Image 2025-02-09 at 8.10.49 PM.jpeg', 0),
(2, 'probando registros', '¿Qué es, por qué y de dónde viene el Lorem Ipsum, el texto de relleno estándar de las industrias desde el año 1500? Descubre su origen, su uso, sus variaciones y su generador en este sitio web.', '67aa857d7b6dd-ee99d1f0b8e8d58cd388d715d6e35928.jpg', 1);

--
-- Índices para tablas volcadas
--

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `idDepartamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEventos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
