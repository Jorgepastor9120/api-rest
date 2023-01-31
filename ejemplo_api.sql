-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 31-01-2023 a las 05:21:13
-- Versión del servidor: 5.7.40-cll-lve
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ejemplo_api`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(155) COLLATE utf8_spanish2_ci NOT NULL,
  `categoria` varchar(55) COLLATE utf8_spanish2_ci NOT NULL,
  `precio_iva_excl` decimal(20,2) NOT NULL,
  `id_iva` int(1) NOT NULL,
  `fecha_add` datetime NOT NULL,
  `fecha_upd` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `categoria`, `precio_iva_excl`, `id_iva`, `fecha_add`, `fecha_upd`) VALUES
(1, 'Coche Bmw rojo 5 puertas', 'BMW', '100.00', 1, '2023-01-30 16:29:30', '2023-01-30 16:29:30'),
(2, 'Coche Peugeot Azul', 'Peugeot ', '120.00', 1, '2023-01-30 16:29:30', '2023-01-30 16:29:30'),
(3, 'Nuevo coche', 'Audi', '100.00', 2, '2023-01-30 19:10:18', '2023-01-30 19:10:18'),
(4, 'Nuevo coche', 'Audi', '100.00', 2, '2023-01-30 19:16:38', '2023-01-30 19:16:38'),
(5, 'Nuevo coche1', 'Audi', '100.00', 2, '2023-01-31 09:36:47', '2023-01-31 09:36:47'),
(6, 'Nuevo coche1', 'Audi', '100.00', 2, '2023-01-31 09:37:33', '2023-01-31 09:37:33'),
(7, 'Nuevo coche1', 'Audi', '100.00', 2, '2023-01-31 09:39:23', '2023-01-31 09:39:23'),
(9, 'Nuevo coche1', 'Audi', '100.00', 2, '2023-01-31 09:44:29', '2023-01-31 09:44:29'),
(10, 'Nuevo coche2', 'Audi', '100.00', 2, '2023-01-31 09:48:53', '2023-01-31 09:48:53'),
(11, 'Actualizar coche 33', 'Audi', '100.00', 2, '2023-01-31 10:05:50', '2023-01-31 10:05:50');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(90) COLLATE utf8_spanish2_ci NOT NULL,
  `passwd` varchar(90) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `passwd`) VALUES
(1, 'nombreejemplo', '282hdbd73bhwks982jhwhs2');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
