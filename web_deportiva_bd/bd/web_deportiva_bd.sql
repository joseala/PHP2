-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-12-2017 a las 14:44:13
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `web_deportiva_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE `equipo` (
  `id` int(11) NOT NULL,
  `idLiga` int(2) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`id`, `idLiga`, `nombre`) VALUES
(1, 39, 'AT'),
(2, 39, 'MAD'),
(3, 39, 'FCB'),
(4, 39, 'VAL'),
(5, 39, 'SEV'),
(6, 39, 'Descanso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornada`
--

CREATE TABLE `jornada` (
  `id` int(11) NOT NULL,
  `idLiga` int(2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `jornada`
--

INSERT INTO `jornada` (`id`, `idLiga`, `fecha`) VALUES
(1, 39, '2014-11-02'),
(2, 39, '2014-11-09'),
(3, 39, '2014-11-16'),
(4, 39, '2014-11-23'),
(5, 39, '2014-11-30'),
(6, 39, '2014-12-07'),
(7, 39, '2014-12-14'),
(8, 39, '2014-12-21'),
(9, 39, '2014-12-28'),
(10, 39, '2015-01-04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liga`
--

CREATE TABLE `liga` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `liga`
--

INSERT INTO `liga` (`id`, `nombre`) VALUES
(39, 'ESPANYA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

CREATE TABLE `partido` (
  `id` int(11) NOT NULL,
  `idJornada` int(11) NOT NULL,
  `equipoL` int(11) NOT NULL,
  `gL` varchar(11) COLLATE utf8_spanish_ci NOT NULL,
  `equipoV` int(11) NOT NULL,
  `gV` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`id`, `idJornada`, `equipoL`, `gL`, `equipoV`, `gV`) VALUES
(1, 1, 1, 'descanso', 6, 'descanso'),
(2, 1, 2, '0', 5, '2'),
(3, 1, 3, '2', 4, '0'),
(4, 2, 1, '2', 5, '1'),
(5, 2, 6, 'descanso', 4, 'descanso'),
(6, 2, 2, '1', 3, '1'),
(7, 3, 1, '1', 4, '0'),
(8, 3, 5, '4', 3, '0'),
(9, 3, 6, 'descanso', 2, 'descanso'),
(10, 4, 1, '', 3, ''),
(11, 4, 4, '', 2, ''),
(12, 4, 5, '', 6, ''),
(13, 5, 1, '', 2, ''),
(14, 5, 3, '', 6, ''),
(15, 5, 4, '', 5, ''),
(16, 6, 1, '', 6, ''),
(17, 6, 2, '', 5, ''),
(18, 6, 3, '', 4, ''),
(19, 7, 1, '', 5, ''),
(20, 7, 6, '', 4, ''),
(21, 7, 2, '', 3, ''),
(22, 8, 1, '', 4, ''),
(23, 8, 5, '', 3, ''),
(24, 8, 6, '', 2, ''),
(25, 9, 1, '', 3, ''),
(26, 9, 4, '', 2, ''),
(27, 9, 5, '', 6, ''),
(28, 10, 1, '', 2, ''),
(29, 10, 3, '', 6, ''),
(30, 10, 4, '', 5, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`) VALUES
(1, 'jose', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `equipo`
--
ALTER TABLE `equipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jornada`
--
ALTER TABLE `jornada`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `liga`
--
ALTER TABLE `liga`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `equipo`
--
ALTER TABLE `equipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `jornada`
--
ALTER TABLE `jornada`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `liga`
--
ALTER TABLE `liga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT de la tabla `partido`
--
ALTER TABLE `partido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
