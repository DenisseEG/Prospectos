-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-02-2021 a las 17:52:17
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `id_modulo` bigint(20) NOT NULL,
  `titulo` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `estatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`id_modulo`, `titulo`, `descripcion`, `estatus`) VALUES
(1, 'Usuarios', 'Usuarios', 1),
(2, 'Prospectos', 'Prospectos a clientes', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_permiso` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `modulo_id` bigint(20) NOT NULL,
  `leer` tinyint(4) NOT NULL DEFAULT 0,
  `escribir` tinyint(4) NOT NULL DEFAULT 0,
  `actualizar` tinyint(4) NOT NULL DEFAULT 0,
  `eliminar` tinyint(4) NOT NULL DEFAULT 0,
  `evaluar` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_permiso`, `rol_id`, `modulo_id`, `leer`, `escribir`, `actualizar`, `eliminar`, `evaluar`) VALUES
(1, 1, 1, 1, 1, 1, 1, 0),
(2, 1, 2, 1, 1, 1, 1, 1),
(3, 2, 1, 0, 0, 0, 0, 0),
(4, 2, 2, 1, 1, 0, 0, 0),
(5, 3, 1, 0, 0, 0, 0, 0),
(6, 3, 2, 1, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prospecto`
--

CREATE TABLE `prospecto` (
  `id_prospecto` bigint(20) NOT NULL,
  `usuario_id` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `calle` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `numero` int(20) NOT NULL,
  `colonia` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `rfc` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `observaciones` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `estatus_prospecto` enum('Enviado','Autorizado','Rechazado') COLLATE utf8mb4_swedish_ci NOT NULL DEFAULT 'Enviado',
  `estatus` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `prospecto`
--

INSERT INTO `prospecto` (`id_prospecto`, `usuario_id`, `nombre`, `apellido_paterno`, `apellido_materno`, `calle`, `numero`, `colonia`, `codigo_postal`, `telefono`, `rfc`, `observaciones`, `estatus_prospecto`, `estatus`, `fecha_creado`) VALUES
(1, 1, 'Prueba', 'Prueba', 'Prueba', 'Prueba', 1, 'Prueba', 31000, 6143224811, 'PRUEBA1234', 'falta de documentos', 'Enviado', 1, '2021-02-26 23:28:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `estatus` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`, `estatus`) VALUES
(1, 'Administrador', 'Administrador', 1),
(2, 'Promotor', 'Captura de prospectos', 1),
(3, 'Evaluación', 'Evaluación de prospectos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` bigint(20) NOT NULL,
  `rol_id` bigint(20) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellido_paterno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `apellido_materno` varchar(50) COLLATE utf8mb4_swedish_ci NOT NULL,
  `correo` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `contrasena` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `estatus` tinyint(4) NOT NULL DEFAULT 1,
  `fecha_creado` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `rol_id`, `nombre`, `apellido_paterno`, `apellido_materno`, `correo`, `contrasena`, `estatus`, `fecha_creado`) VALUES
(1, 1, 'Denisse', 'Enríquez', 'González', 'denisse_enriquez@outlook.com', 'ac3f091ca34109c5427afb46cf83b296e2004ca9e55d3b0da8aa7434f47c69ed', 1, '2021-02-26 23:23:22'),
(2, 2, 'Promotor', 'Promotor', 'Promotor', 'promotor@gmail.com', '4afeb8f13a96f81649b42495dce3555867743620945cc556f2540b9e304343e9', 1, '2021-02-26 23:27:31'),
(3, 3, 'Evaluación', 'Evaluación', 'Evaluación', 'evaluacion@gmail.com', '5899b16862afed9f740e57bde5d4fae7d6b8df30a27c59bb50580748e55aed32', 1, '2021-02-26 23:27:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_permiso`),
  ADD KEY `role_id` (`rol_id`),
  ADD KEY `module_id` (`modulo_id`);

--
-- Indices de la tabla `prospecto`
--
ALTER TABLE `prospecto`
  ADD PRIMARY KEY (`id_prospecto`),
  ADD KEY `user_id` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`) USING BTREE;

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `id_modulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_permiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `prospecto`
--
ALTER TABLE `prospecto`
  MODIFY `id_prospecto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`modulo_id`) REFERENCES `modulo` (`id_modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `prospecto`
--
ALTER TABLE `prospecto`
  ADD CONSTRAINT `prospecto_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
