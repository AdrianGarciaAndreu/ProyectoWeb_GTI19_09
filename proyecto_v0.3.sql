-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-03-2019 a las 11:52:30
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fincas`
--

CREATE TABLE `fincas` (
  `IdFinca` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Direccion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IdUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `fincas`
--

INSERT INTO `fincas` (`IdFinca`, `Nombre`, `Direccion`, `IdUsuario`) VALUES
(1, 'Finca de Prueba 1', 'Calle 1234, Gandia', 1),
(2, 'Finca de prueba 2', 'Calle otra1234, Murcia, Murcia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parcelas`
--

CREATE TABLE `parcelas` (
  `IDParcela` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL,
  `IdFinca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `parcelas`
--

INSERT INTO `parcelas` (`IDParcela`, `Nombre`, `Descripcion`, `IdFinca`) VALUES
(1, 'Parcela prueba 1', 'Esto es una parcela de prueba que puede contiene, melones', 1),
(3, 'Parcela prueba 2', 'Esta parcela contiene tomates', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE `puntos` (
  `IdPunto` int(11) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  `IdParcela` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`IdPunto`, `latitud`, `longitud`, `IdParcela`) VALUES
(1, 38.9963, -0.166916, 1),
(2, 38.9957, -0.166919, 1),
(3, 38.9956, -0.166495, 1),
(4, 38.9956, -0.165266, 1),
(5, 38.9965, -0.165179, 1),
(6, 38.9971, -0.165575, 1),
(7, 38.9973, -0.165955, 1),
(8, 38.9973, -0.166572, 1),
(9, 38.9967, -0.166815, 1),
(10, 38.9963, -0.166916, 1),
(11, 39.4616, -0.430512, 3),
(12, 39.461, -0.430599, 3),
(13, 39.4609, -0.429287, 3),
(14, 39.4616, -0.428974, 3),
(15, 39.4616, -0.430512, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sensores`
--

CREATE TABLE `sensores` (
  `IdSensor` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `sensores`
--

INSERT INTO `sensores` (`IdSensor`, `Nombre`) VALUES
(1, 'Sensor de prueba 1'),
(2, 'Sensor de prueba 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `IdUbicacion` int(11) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  `IdParcela` int(11) NOT NULL,
  `IdSensor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`IdUbicacion`, `latitud`, `longitud`, `IdParcela`, `IdSensor`) VALUES
(1, 38.9963, -0.1665, 1, 1),
(2, 38.995, -0.16659, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Pass` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido1` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Apellido2` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Correo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Telefono` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Provincia` varchar(25) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Fecha_alta` date NOT NULL,
  `Fecha_Baja` date DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Pass`, `Apellido1`, `Apellido2`, `Correo`, `Telefono`, `Provincia`, `Fecha_alta`, `Fecha_Baja`, `IdCliente`) VALUES
(1, 'Prueba1', 'en4scywq', 'Apellido de prueba', 'Apellido 2 de prueba', 'adgaran1@epsg.upv.es', '000000001', 'Valencia', '2019-03-06', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `fincas`
--
ALTER TABLE `fincas`
  ADD PRIMARY KEY (`IdFinca`),
  ADD KEY `FK_IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`IDParcela`),
  ADD KEY `FK_IdFinca` (`IdFinca`) USING BTREE;

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`IdPunto`),
  ADD KEY `FK_IDParcela` (`IdParcela`) USING BTREE;

--
-- Indices de la tabla `sensores`
--
ALTER TABLE `sensores`
  ADD PRIMARY KEY (`IdSensor`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`IdUbicacion`),
  ADD KEY `FK_IdParcela` (`IdParcela`),
  ADD KEY `FK_IdSensor` (`IdSensor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `fincas`
--
ALTER TABLE `fincas`
  MODIFY `IdFinca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `IDParcela` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `IdPunto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `sensores`
--
ALTER TABLE `sensores`
  MODIFY `IdSensor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `IdUbicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fincas`
--
ALTER TABLE `fincas`
  ADD CONSTRAINT `fincas_ibfk_1` FOREIGN KEY (`IdUsuario`) REFERENCES `usuarios` (`Id`);

--
-- Filtros para la tabla `parcelas`
--
ALTER TABLE `parcelas`
  ADD CONSTRAINT `parcelas_ibfk_1` FOREIGN KEY (`IdFinca`) REFERENCES `fincas` (`IdFinca`);

--
-- Filtros para la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD CONSTRAINT `puntos_ibfk_1` FOREIGN KEY (`IdParcela`) REFERENCES `parcelas` (`IDParcela`);

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`IdParcela`) REFERENCES `parcelas` (`IDParcela`),
  ADD CONSTRAINT `ubicaciones_ibfk_2` FOREIGN KEY (`IdSensor`) REFERENCES `sensores` (`IdSensor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
