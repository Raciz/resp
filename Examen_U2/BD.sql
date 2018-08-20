-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2018 a las 02:10:02
-- Versión del servidor: 10.1.33-MariaDB
-- Versión de PHP: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `curso`
--
DROP DATABASE IF EXISTS `curso`;
CREATE DATABASE IF NOT EXISTS `curso` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `curso`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Alumna`
--

CREATE TABLE `Alumna` (
  `id_alumna` int(11) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apellido` varchar(30) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL,
  `grupo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Alumna`
--

INSERT INTO `Alumna` (`id_alumna`, `nombre`, `apellido`, `fechaNac`, `grupo`) VALUES
(8, 'Yesica', 'Sanches', '2008-01-14', 5),
(9, 'Vanessa', 'Balderrama', '2018-06-07', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Grupo`
--

CREATE TABLE `Grupo` (
  `id_grupo` int(11) NOT NULL,
  `nombre` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Grupo`
--

INSERT INTO `Grupo` (`id_grupo`, `nombre`) VALUES
(1, '1-A'),
(2, '1-B'),
(3, '2-A'),
(4, '2-B'),
(5, '3-B');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pago`
--

CREATE TABLE `Pago` (
  `id_pago` int(11) NOT NULL,
  `alumna` int(11) DEFAULT NULL,
  `mama` varchar(60) DEFAULT NULL,
  `fecha_pago` date DEFAULT NULL,
  `fecha_envio` datetime DEFAULT NULL,
  `img_comprobante` varchar(255) DEFAULT NULL,
  `folio` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Pago`
--

INSERT INTO `Pago` (`id_pago`, `alumna`, `mama`, `fecha_pago`, `fecha_envio`, `img_comprobante`, `folio`) VALUES
(5, 9, 'Luisa lein', '2018-06-26', '2018-06-24 11:49:44', 'views/media/img/noimg.png', 1001),
(6, 8, 'Juana La Cubana', '2018-06-29', '2019-06-20 11:51:31', 'views/media/img/noimg.png', 2019);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE `Usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `username` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id_usuario`, `nombre`, `username`, `password`) VALUES
(1, 'Francisco Isaac Perales Morales', 'admin', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Alumna`
--
ALTER TABLE `Alumna`
  ADD PRIMARY KEY (`id_alumna`),
  ADD KEY `grupo` (`grupo`);

--
-- Indices de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  ADD PRIMARY KEY (`id_grupo`);

--
-- Indices de la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `alumna` (`alumna`);

--
-- Indices de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Alumna`
--
ALTER TABLE `Alumna`
  MODIFY `id_alumna` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Grupo`
--
ALTER TABLE `Grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Pago`
--
ALTER TABLE `Pago`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Alumna`
--
ALTER TABLE `Alumna`
  ADD CONSTRAINT `Alumna_ibfk_1` FOREIGN KEY (`grupo`) REFERENCES `Grupo` (`id_grupo`);

--
-- Filtros para la tabla `Pago`
--
ALTER TABLE `Pago`
  ADD CONSTRAINT `Pago_ibfk_1` FOREIGN KEY (`alumna`) REFERENCES `Alumna` (`id_alumna`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;