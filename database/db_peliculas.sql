-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 30-11-2020 a las 15:41:40
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
CREATE DATABASE IF NOT EXISTS `db_peliculas` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `db_peliculas`;

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
(3, 4, 5, 1, '2020-12-06'),
(4, 4, 2, 1, '2020-12-06'),
(5, 6, 4, 1, '2020-12-06'),
(6, 8, 6, 1, '2020-12-06'),
(7, 10, 1, 1, '2020-12-06');

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
(5, 5, 1, 1),
(6, 7, 2, 1),
(7, 9, 6, 1),
(8, 9, 7, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peliculas`
--

CREATE TABLE `peliculas` (
  `id_pelicula` int(10) NOT NULL,
  `titulo` varchar(300) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(800) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(100) NOT NULL,
  `precio_alquiler` float(4,2) NOT NULL,
  `precio_venta` float(4,2) NOT NULL,
  `disponibilidad` enum('Available','Unavailable') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `peliculas`
--

INSERT INTO `peliculas` (`id_pelicula`, `titulo`, `descripcion`, `imagen`, `stock`, `precio_alquiler`, `precio_venta`, `disponibilidad`) VALUES
(1, 'Bob Esponja: Al rescate', 'Cuando alguien rapta  Gary Bob Esponja y Patricio se embarcan en una alocada misión muy lejos de Fondo de Bikini para rescatar a su fiel amigo caracol', 'bob_esponja_al_rescate.jpg', 1, 20.50, 18.00, 'Available'),
(2, 'Bob Esponja: La pelicula', 'En este largometraje de aventuras, el optimista y alegre Bob Esponja parte para recuperar la corona robada del rey Neptuni', 'bob_esponja_la_pelicula.jpg', 8, 25.25, 20.25, 'Available'),
(3, 'Bob Esponja: Un heroe fuera del agua', 'El panico se apodera de Fondo de Bikini cuando un pirata roba la receta secreta de la Cangreburger. Bob Esponja y sus amigos emprenderan una mision para recuperarla', 'bob_esponja_heroe_fuera_del_agua.jpg', 8, 18.75, 15.25, 'Available'),
(4, 'Mad Max: Fury Road', 'Aunque está decidido a vagar solo por el páramo post-apocalíptico, Mad Max se une a Furiosa, una comandante fugitiva, y su banda, quienes están tratando de escapar de un señor de la guerra.', 'madmax.jpg', 4, 25.89, 30.50, 'Available'),
(5, 'Bumblebee', 'En 1987, Charlie, una adolescente, encuentra a Bumblebee, muy herido, en el depósito de chatarra al que había llegado mientras huía. Mientras lo restaura, Charlie percibe que lo que ha hallado no es un Volkswagen amarillo corriente.', 'bumblebee.jpg', 4, 30.50, 40.00, 'Available'),
(6, 'Transformers: la era de la extinción', 'Mientras la humanidad recoge las piezas después de una batalla épica, un grupo oscuro emerge para ganar control de la historia. Mientras tanto, una poderosa y nueva amenaza pone su mirada en la Tierra.', 'transfromers4.jpg', 2, 23.50, 30.00, 'Available'),
(7, 'Batman: el caballero de la noche asciende', 'Ocho años después de asumir la culpa por la muerte de Harvey Dent y desaparecer en la noche, Batman se ve obligado a salir del exilio autoimpuesto gracias a una ladrona astuta y a un terrorista despiadado.', 'batman3.jpg', 0, 35.60, 45.50, 'Unavailable');

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
(7, 8, 2, 'Activo'),
(8, 8, 7, 'Activo'),
(9, 8, 5, 'Activo'),
(10, 10, 4, 'Activo'),
(11, 10, 7, 'Activo'),
(12, 10, 1, 'Activo'),
(13, 11, 5, 'Activo'),
(14, 11, 6, 'Activo'),
(15, 11, 7, 'Activo'),
(16, 11, 4, 'Activo'),
(17, 12, 1, 'Activo'),
(18, 12, 2, 'Activo'),
(19, 12, 3, 'Activo'),
(20, 12, 4, 'Activo'),
(21, 13, 6, 'Activo'),
(22, 13, 3, 'Activo'),
(23, 13, 5, 'Activo'),
(24, 13, 1, 'Activo'),
(25, 13, 2, 'Activo'),
(28, 17, 1, 'Activo'),
(29, 17, 3, 'Activo'),
(30, 17, 6, 'Activo'),
(31, 17, 7, 'Activo'),
(32, 18, 1, 'Activo'),
(33, 18, 5, 'Activo');

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
(4, '2020-11-29', 55.75, 8, 'Cancelado', 'Alquiler'),
(5, '2020-11-29', 18.00, 10, 'Cancelado', 'Compra'),
(6, '2020-11-29', 25.89, 11, 'Pendiente', 'Alquiler'),
(7, '2020-11-29', 20.25, 12, 'Cancelado', 'Compra'),
(8, '2020-11-29', 23.50, 13, 'Pendiente', 'Alquiler'),
(9, '2020-11-29', 75.50, 17, 'Cancelado', 'Compra'),
(10, '2020-11-29', 20.50, 18, 'Pendiente', 'Alquiler');

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
  `rol` enum('Administrador','Cliente') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuarios`, `nombre`, `apellido`, `email`, `telefono`, `direccion`, `username`, `password`, `rol`) VALUES
(8, 'Edgar', 'Reyes', 'rc1800@gmail.com', 75784910, 'Ciudad Pacifica, San Miguel', 'Edgar18', '$2y$04$Hlw.g21HppxfhER54LeBNu1v1gSIp6CRGUrkLQh8/2tz3IqZHre8O', 'Cliente'),
(10, 'Keny', 'Torres', 'keny18@gmail.com', 71828478, 'Canton El Papalon, Moncagua', 'Keny18', '$2y$04$xfJxRirhkJFfwgoDEopkNOCS1VYwNA0aoukn8fiGOcrMtckMzrMK.', 'Cliente'),
(11, 'Erick', 'Saravia', 'erick@gmail.com', 78451236, 'Canton El Revalse, Moncagua', 'Erick18', '$2y$04$kjo.hnsup9Cuz2s2yvqNX.dInl8GTN5y.mxjGyJc0xDLo8zo4vE2S', 'Cliente'),
(12, 'Gema', 'Manzano', 'gemita@gmail.com', 63659874, 'Ciudad Pacifica, San Miguel', 'Gema18', '$2y$04$I38.5dvkf9E8vH/yRpKxZ.VSf.cktfcy0h3y4UTywftIkwfZ9Xad6', 'Cliente'),
(13, 'Carlos', 'Cordero', 'carlos@gmail.com', 71746164, 'Canton El Progreso, San Miguel', 'Carlos18', '$2y$04$7GC8zOMxiSpdCcA5LuTfxeJNMetR7jkwvOqVYG3XuNTR6ApVzM5Fa', 'Cliente'),
(15, 'Diego', 'Herrera', 'diego@gmail.com', 71005665, 'Chinameca, San Miguel', 'Diego20', '$2y$04$h4umvrtXfGugqJHZ6hy7jeZpOSraO9d41ERSczG1Ahw3y5eXYVsc2', 'Administrador'),
(17, 'Rebeca', 'Chavez', 'rebe@gmail.com', 73435566, 'Nueva Guadalupe San Miguel', 'Rebe', '$2y$04$bEZcGVoAn0jOIgGBdrVRz.QC7KEGEeHFxSStzEwwZEdwx3yuOqvSK', 'Cliente'),
(18, 'Yosibeth', 'Villalobos', 'yosi@gmail.com', 78401214, 'Mercedes Umaña, Usulutan ', 'Yosi', '$2y$04$E3.FtMonNQDnq8SkLSXaRuyhoGD/.Mcvo2QJnThP5KcYFpo3LRErm', 'Cliente'),
(19, 'Edgar', 'Ceron', 'ceron@gmail.com', 61205560, 'Jucuapa, Usulutan', 'Edgar20', '$2y$04$uFBHNxRpnGtMchB9GU/Bzuw0QYj6K1KdzPsQpDJUZN1sZediMXSaa', 'Administrador'),
(20, 'Carlos', 'Linares', 'linares@gmail.com', 71706560, 'Santiago de Maria, Usulutan', 'Carlos20', '$2y$04$vMNtkMaFhMRgxClZv8skfuSGOPr4WxEaaEHXIqzJzjBD/GHW4WJKe', 'Administrador'),
(21, 'Gema', 'Machuca', 'machuca@gmail.com', 65601230, 'San Martin, San Salvador', 'Gema20', '$2y$04$RBQLHAdenw.uqcUel48xX.gLPlduPR2UbN7jV68kAq2liL80oWlde', 'Administrador'),
(22, 'Erick', 'Aragon', 'aragon@gmail.com', 75809070, 'Lolotique, San Miguel', 'Erick20', '$2y$04$6Gy/96r.v300a5xNANwuZ.jBP2FkBlwIPzYsP/qc8Y0bBuGVJXjmu', 'Administrador'),
(23, 'Keny', 'Chavez', 'chavez@gmail.com', 60632020, 'Santa Ana, Santa Ana', 'Keny20', '$2y$04$ICP/.LH4Y3WFsnoXAiQK5.e1g8XZcz/MkkhF.s1XOk94C87tZBD9W', 'Administrador');

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
  MODIFY `id_alquiler` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  MODIFY `id_reaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
