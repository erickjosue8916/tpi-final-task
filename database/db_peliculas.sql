-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-11-2020 a las 02:32:41
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_peliculas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alquileres`
--

CREATE TABLE `alquileres` (
  `id_alquiler` int(10) NOT NULL,
  `id_transaccion` int(10) NOT NULL,
  `id_pelicula` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `fecha_devolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `alquileres`
--

INSERT INTO `alquileres` (`id_alquiler`, `id_transaccion`, `id_pelicula`, `cantidad`, `fecha_devolucion`) VALUES
(1, 1, 1, 1, '2020-11-03'),
(2, 2, 3, 1, '2020-12-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(10) NOT NULL,
  `id_transaccion` int(10) NOT NULL,
  `id_pelicula` int(10) NOT NULL,
  `cantidad` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `id_transaccion`, `id_pelicula`, `cantidad`) VALUES
(1, 1, 1, 1),
(2, 2, 3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(10) NOT NULL,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(100) NOT NULL,
  `precio_alquiler` float(4,2) NOT NULL,
  `precio_venta` float(4,2) NOT NULL,
  `disponibilidad` varchar(30) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `descripcion`, `imagen`, `stock`, `precio_alquiler`, `precio_venta`, `disponibilidad`) VALUES
(1, 'Bob Esponja: Al rescate', 'Cuando alguien rapta  Gary Bob Esponja y Patricio se embarcan en una alocada misión muy lejos de Fondo de Bikini para rescatar a su fiel amigo caracol', '', 5, 20.50, 18.00, '3'),
(2, 'Bob Esponja: La pelicula', 'En este largometraje de aventuras, el optimista y alegre Bob Esponja parte para recuperar la corona robada del rey Neptuni', '', 10, 25.25, 20.25, '10'),
(3, 'Bob Esponja: Un heroe fuera de', 'El panico se apodera de Fondo de Bikini cuando un pirata roba la receta secreta de la Cangreburger. Bo Esponja y sus amigos emprenderan una mision para recuperarla', '', 8, 18.75, 15.25, '3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reacciones`
--

CREATE TABLE `reacciones` (
  `id_reaccion` int(10) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `id_pelicula` int(10) NOT NULL,
  `reaccion` enum('Activo','Inactivo') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `reacciones`
--

INSERT INTO `reacciones` (`id_reaccion`, `id_usuario`, `id_pelicula`, `reaccion`) VALUES
(1, 3, 1, 'Activo'),
(2, 1, 3, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transacciones`
--

CREATE TABLE `transacciones` (
  `id_transaccion` int(10) NOT NULL,
  `fecha_transaccion` date NOT NULL,
  `total_transaccion` float(4,2) NOT NULL,
  `id_usuario` int(10) NOT NULL,
  `estado` enum('Cancelado','Pendiente') COLLATE utf8_spanish_ci NOT NULL,
  `tipo_transaccion` enum('Compra','Alquiler') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `transacciones`
--

INSERT INTO `transacciones` (`id_transaccion`, `fecha_transaccion`, `total_transaccion`, `id_usuario`, `estado`, `tipo_transaccion`) VALUES
(1, '2020-11-01', 3.00, 1, 'Cancelado', 'Compra'),
(2, '2020-12-12', 2.00, 3, 'Pendiente', 'Alquiler');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuarios` int(10) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(15) NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `username` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `rol` varchar(15) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `username`, `password`, `rol`) VALUES
(1, 'Keny', 'Torres', 'torres20@gmail.com', 75826953, 'Moncagua, Canton el Papalon', 'keny', '123', 'Cliente'),
(2, 'Erick', 'Saravia', 'erick@gmail.com', 75787963, 'Canton el Revalse', 'erick', '1234', 'Administrador'),
(3, 'Edgar', 'Reyes', 'edgar@gmail.com', 65612425, 'Colonia la presita, San Miguel', 'edgar', '12345', 'Cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD PRIMARY KEY (`id_alquiler`),
  ADD KEY `id_transaccion` (`id_transaccion`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_transaccion` (`id_transaccion`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_pelicula`);

--
-- Indices de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  ADD PRIMARY KEY (`id_reaccion`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pelicula` (`id_pelicula`);

--
-- Indices de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD PRIMARY KEY (`id_transaccion`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuarios`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alquileres`
--
ALTER TABLE `alquileres`
  MODIFY `id_alquiler` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  MODIFY `id_reaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alquileres`
--
ALTER TABLE `alquileres`
  ADD CONSTRAINT `alquileres_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alquileres_ibfk_2` FOREIGN KEY (`id_transaccion`) REFERENCES `transacciones` (`id_transaccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `compras`
--
ALTER TABLE `compras`
  ADD CONSTRAINT `compras_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `compras_ibfk_2` FOREIGN KEY (`id_transaccion`) REFERENCES `transacciones` (`id_transaccion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `reacciones`
--
ALTER TABLE `reacciones`
  ADD CONSTRAINT `reacciones_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_pelicula`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reacciones_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `transacciones`
--
ALTER TABLE `transacciones`
  ADD CONSTRAINT `transacciones_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuarios`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
