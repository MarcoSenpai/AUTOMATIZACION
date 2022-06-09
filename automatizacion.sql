-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-06-2022 a las 21:01:28
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `automatizacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `ID_CARGO` int(10) NOT NULL,
  `NOMBRE_CARGO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `ID_COMISION` int(10) NOT NULL,
  `NOMBRE_COMISION` varchar(50) NOT NULL,
  `ID_ORGANISMO` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID_CURSO` varchar(50) NOT NULL,
  `NOM_CURSO` varchar(50) NOT NULL,
  `ESCUELA_PROFESIONAL` varchar(50) NOT NULL DEFAULT 'ESCUELA PROFESIONAL DE INGENIERÍA DE SISTEMAS',
  `CICLO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comision`
--

CREATE TABLE `detalle_comision` (
  `ID_DETALLE_COMISION` int(10) NOT NULL,
  `ID_DOCENTE` varchar(50) NOT NULL,
  `ID_CARGO` int(10) NOT NULL,
  `ID_COMISION` int(10) NOT NULL,
  `ID_SUB_COMISION` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cursos`
--

CREATE TABLE `detalle_cursos` (
  `ID_DETALLE_CURSOS` varchar(50) NOT NULL,
  `ID_CURSO` varchar(50) NOT NULL,
  `ESTADO` varchar(50) NOT NULL DEFAULT 'EN CURSO',
  `CUPOS_CURSO` int(10) NOT NULL,
  `ID_DOCENTE` varchar(50) NOT NULL,
  `ID_TIPO` varchar(50) NOT NULL,
  `SECCION_CURSO` varchar(50) NOT NULL,
  `HORA_INICIAL` datetime NOT NULL,
  `HORA_FINAL` datetime NOT NULL,
  `DIAS_CURSO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `ID_DOCENTE` varchar(50) NOT NULL,
  `NOMBRES` varchar(50) NOT NULL,
  `APELLIDOS` varchar(50) NOT NULL,
  `SEDE` varchar(50) NOT NULL,
  `CONDICION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismos`
--

CREATE TABLE `organismos` (
  `ID_ORGANISMO` int(10) NOT NULL,
  `NOMBRE_ORGANISMOS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_comision`
--

CREATE TABLE `sub_comision` (
  `ID_SUB_COMISION` int(10) NOT NULL,
  `NOMBRE_SUB_COMISION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_horario`
--

CREATE TABLE `tipo_horario` (
  `ID_TIPO` varchar(50) NOT NULL,
  `DESCRIPCION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_horario`
--

INSERT INTO `tipo_horario` (`ID_TIPO`, `DESCRIPCION`) VALUES
('L', 'LABORATORIO'),
('P', 'PRÁCTICA'),
('T', 'TEORÍA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`ID_CARGO`);

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`ID_COMISION`),
  ADD KEY `FK_IDORGANISMO` (`ID_ORGANISMO`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID_CURSO`);

--
-- Indices de la tabla `detalle_comision`
--
ALTER TABLE `detalle_comision`
  ADD PRIMARY KEY (`ID_DETALLE_COMISION`),
  ADD KEY `FK_IDSUBCOMISION` (`ID_SUB_COMISION`),
  ADD KEY `FK_IDCOMISION` (`ID_COMISION`),
  ADD KEY `FK_IDCARGO` (`ID_CARGO`),
  ADD KEY `FK_IDDOC` (`ID_DOCENTE`);

--
-- Indices de la tabla `detalle_cursos`
--
ALTER TABLE `detalle_cursos`
  ADD PRIMARY KEY (`ID_DETALLE_CURSOS`),
  ADD KEY `FK_IDCURSO` (`ID_CURSO`),
  ADD KEY `FK_IDDOCENTE` (`ID_DOCENTE`),
  ADD KEY `FK_ID_TIPO_HORARIO` (`ID_TIPO`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`ID_DOCENTE`);

--
-- Indices de la tabla `organismos`
--
ALTER TABLE `organismos`
  ADD PRIMARY KEY (`ID_ORGANISMO`);

--
-- Indices de la tabla `sub_comision`
--
ALTER TABLE `sub_comision`
  ADD PRIMARY KEY (`ID_SUB_COMISION`);

--
-- Indices de la tabla `tipo_horario`
--
ALTER TABLE `tipo_horario`
  ADD PRIMARY KEY (`ID_TIPO`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD CONSTRAINT `FK_IDORGANISMO` FOREIGN KEY (`ID_ORGANISMO`) REFERENCES `organismos` (`ID_ORGANISMO`);

--
-- Filtros para la tabla `detalle_comision`
--
ALTER TABLE `detalle_comision`
  ADD CONSTRAINT `FK_IDCARGO` FOREIGN KEY (`ID_CARGO`) REFERENCES `cargos` (`ID_CARGO`),
  ADD CONSTRAINT `FK_IDCOMISION` FOREIGN KEY (`ID_COMISION`) REFERENCES `comisiones` (`ID_COMISION`),
  ADD CONSTRAINT `FK_IDDOC` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docentes` (`ID_DOCENTE`),
  ADD CONSTRAINT `FK_IDSUBCOMISION` FOREIGN KEY (`ID_SUB_COMISION`) REFERENCES `sub_comision` (`ID_SUB_COMISION`);

--
-- Filtros para la tabla `detalle_cursos`
--
ALTER TABLE `detalle_cursos`
  ADD CONSTRAINT `FK_IDCURSO` FOREIGN KEY (`ID_CURSO`) REFERENCES `cursos` (`ID_CURSO`),
  ADD CONSTRAINT `FK_IDDOCENTE` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docentes` (`ID_DOCENTE`),
  ADD CONSTRAINT `FK_IDTIPO` FOREIGN KEY (`ID_TIPO`) REFERENCES `tipo_horario` (`ID_TIPO`),
  ADD CONSTRAINT `FK_ID_TIPO_HORARIO` FOREIGN KEY (`ID_TIPO`) REFERENCES `tipo_horario` (`ID_TIPO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
