-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-12-2017 a las 22:09:13
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `red_social`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `frase`
--

CREATE TABLE `frase` (
  `id` int(11) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `texto` varchar(200) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `frase`
--

INSERT INTO `frase` (`id`, `idUsuario`, `texto`) VALUES
(11, 4, 'holaaaaaaaaaaaaaa'),
(12, 4, 'ultima'),
(13, 3, 'alalal'),
(14, 3, 'kldkdldkld'),
(15, 3, 'ultima jose'),
(16, 7, 'eeeeeeeeeooo'),
(17, 8, 'aaaaaaaaaa'),
(18, 8, 'mmmmmmmmmmm'),
(19, 8, 'esta es la uuuultima');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguido`
--

CREATE TABLE `seguido` (
  `id` int(11) NOT NULL,
  `idUsuario` int(10) NOT NULL,
  `idSeguido` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `seguido`
--

INSERT INTO `seguido` (`id`, `idUsuario`, `idSeguido`) VALUES
(8, 4, 3),
(9, 5, 3),
(10, 5, 4),
(11, 4, 5),
(12, 6, 7),
(13, 6, 3),
(14, 3, 4),
(15, 6, 4),
(16, 7, 4),
(17, 3, 8),
(18, 4, 8),
(19, 5, 8),
(20, 6, 8),
(21, 7, 3),
(22, 8, 3),
(23, 3, 7),
(24, 4, 7),
(25, 8, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `pass` varchar(60) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `pass`) VALUES
(3, 'jose', '81dc9bdb52d04dc20036dbd8313ed055'),
(4, 'pepe', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, 'manuel', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, 'paco', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, 'julia', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, 'Miguel', '81dc9bdb52d04dc20036dbd8313ed055');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `frase`
--
ALTER TABLE `frase`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `seguido`
--
ALTER TABLE `seguido`
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
-- AUTO_INCREMENT de la tabla `frase`
--
ALTER TABLE `frase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `seguido`
--
ALTER TABLE `seguido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
