-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-02-2026 a las 04:00:50
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
-- Base de datos: `sistema_escolar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `ap_paterno` varchar(100) DEFAULT NULL,
  `ap_materno` varchar(100) DEFAULT NULL,
  `id_grupo` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `ap_paterno`, `ap_materno`, `id_grupo`, `estado`) VALUES
(1, 'Arturo', 'García', 'Almaguer', 1, 1),
(2, 'María Fernanda', 'García', 'Hernández', 2, 1),
(3, 'Luis Ángel', 'Martínez', 'Sánchez', 1, 1),
(4, 'Ana Sofía', 'Rodríguez', 'Díaz', 3, 1),
(6, 'Elena', 'Ramírez', 'Flores', 5, 1),
(7, 'Pedro', 'Vázquez', 'Castillo', 2, 1),
(8, 'Lucía', 'Morales', 'Reyes', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `estado`) VALUES
(1, 'Ingeniería en Sistemas Computacionales', 1),
(2, 'Licenciatura en Derecho', 1),
(3, 'Arquitectura', 1),
(4, 'Licenciatura en Administración', 1),
(5, 'Contador Público', 1),
(6, 'Ingeniería Industrial', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grados`
--

CREATE TABLE `grados` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grados`
--

INSERT INTO `grados` (`id`, `nombre`, `estado`) VALUES
(1, '1er Cuatrimestre', 1),
(2, '2do Cuatrimestre', 1),
(3, '3er Cuatrimestre', 1),
(4, '4to Cuatrimestre', 1),
(5, '5to Cuatrimestre', 1),
(6, '6to Cuatrimestre', 1),
(7, '6to Cuatrimestre', 1),
(8, '7mo Cuatrimestre', 1),
(9, '8vo Cuatrimestre', 1),
(10, '9no Cuatrimestre', 1),
(11, '10mo Cuatrimestre', 1),
(12, '11vo Cuatrimestre', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupos`
--

CREATE TABLE `grupos` (
  `id` int(11) NOT NULL,
  `nombre_grupo` varchar(50) NOT NULL,
  `id_carrera` int(11) DEFAULT NULL,
  `id_turno` int(11) DEFAULT NULL,
  `id_grado` int(11) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `grupos`
--

INSERT INTO `grupos` (`id`, `nombre_grupo`, `id_carrera`, `id_turno`, `id_grado`, `estado`) VALUES
(1, 'ISC-101', 1, 1, 1, 1),
(2, 'DER-201', 2, 2, 2, 1),
(3, 'ARQ-301', 3, 1, 3, 1),
(5, 'CON-501', 5, 5, 5, 1),
(6, 'IND-102', 6, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `turnos`
--

INSERT INTO `turnos` (`id`, `nombre`, `estado`) VALUES
(1, 'Matutino', 1),
(2, 'Vespertino', 1),
(4, 'Mixto', 1),
(5, 'Sabatino', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grados`
--
ALTER TABLE `grados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carrera` (`id_carrera`),
  ADD KEY `id_turno` (`id_turno`),
  ADD KEY `id_grado` (`id_grado`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `grados`
--
ALTER TABLE `grados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `grupos`
--
ALTER TABLE `grupos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupos` (`id`);

--
-- Filtros para la tabla `grupos`
--
ALTER TABLE `grupos`
  ADD CONSTRAINT `grupos_ibfk_1` FOREIGN KEY (`id_carrera`) REFERENCES `carreras` (`id`),
  ADD CONSTRAINT `grupos_ibfk_2` FOREIGN KEY (`id_turno`) REFERENCES `turnos` (`id`),
  ADD CONSTRAINT `grupos_ibfk_3` FOREIGN KEY (`id_grado`) REFERENCES `grados` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
