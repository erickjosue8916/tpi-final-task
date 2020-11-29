-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2020 a las 23:38:35
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
CREATE DATABASE IF NOT EXISTS `db_peliculas` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
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
(1, 'Bob Esponja: Al rescate', 'Cuando alguien rapta  Gary Bob Esponja y Patricio se embarcan en una alocada misión muy lejos de Fondo de Bikini para rescatar a su fiel amigo caracol', 'bob_esponja_al_rescate.jpg', 3, 20.50, 18.00, 'Available'),
(2, 'Bob Esponja: La pelicula', 'En este largometraje de aventuras, el optimista y alegre Bob Esponja parte para recuperar la corona robada del rey Neptuni', 'bob_esponja_la_pelicula.jpg', 10, 25.25, 20.25, 'Available'),
(3, 'Bob Esponja: Un heroe fuera del agua', 'El panico se apodera de Fondo de Bikini cuando un pirata roba la receta secreta de la Cangreburger. Bob Esponja y sus amigos emprenderan una mision para recuperarla', 'bob_esponja_heroe_fuera_del_agua.jpg', 8, 18.75, 15.25, 'Available'),
(4, 'Mad Max: Fury Road', 'Aunque está decidido a vagar solo por el páramo post-apocalíptico, Mad Max se une a Furiosa, una comandante fugitiva, y su banda, quienes están tratando de escapar de un señor de la guerra.', 'madmax.jpg', 5, 25.89, 30.50, 'Available'),
(5, 'Bumblebee', 'En 1987, Charlie, una adolescente, encuentra a Bumblebee, muy herido, en el depósito de chatarra al que había llegado mientras huía. Mientras lo restaura, Charlie percibe que lo que ha hallado no es un Volkswagen amarillo corriente.', 'bumblebee.jpg', 5, 30.50, 40.00, 'Available'),
(6, 'Transformers: la era de la extinción', 'Mientras la humanidad recoge las piezas después de una batalla épica, un grupo oscuro emerge para ganar control de la historia. Mientras tanto, una poderosa y nueva amenaza pone su mirada en la Tierra.', 'transfromers4.jpg', 4, 23.50, 30.00, 'Available'),
(7, 'Batman: el caballero de la noche asciende', 'Ocho años después de asumir la culpa por la muerte de Harvey Dent y desaparecer en la noche, Batman se ve obligado a salir del exilio autoimpuesto gracias a una ladrona astuta y a un terrorista despiadado.', 'batman3.jpg', 1, 35.60, 45.50, 'Available');

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
(7, 'Edgar', 'Reyes', 'alguien123@example.com', 7777, 'Avenida falsa 123456', 'edgar', '$2y$04$AaQqTs/pLM46LiCQjnj56eFoz4TrC.4cGA7/g0JBjC1Swj2VtaFIK', 'Administrador');

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
  MODIFY `id_compra` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `peliculas`
--
ALTER TABLE `peliculas`
  MODIFY `id_pelicula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `reacciones`
--
ALTER TABLE `reacciones`
  MODIFY `id_reaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `transacciones`
--
ALTER TABLE `transacciones`
  MODIFY `id_transaccion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuarios` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
