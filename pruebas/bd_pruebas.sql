-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-07-2022 a las 06:18:23
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
-- Base de datos: `bd_pruebas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `ID_CARGO` varchar(5) NOT NULL,
  `NOMBRE_CARGO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `ID_COMISION` varchar(5) NOT NULL,
  `NOMBRE_COMISION` varchar(50) NOT NULL,
  `ID_ORGANISMO` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID_CURSO` varchar(50) NOT NULL,
  `NOM_CURSO` varchar(50) NOT NULL,
  `ESCUELA_PROFESIONAL` varchar(50) NOT NULL DEFAULT 'ESCUELA PROFESIONAL DE INGENIERÍA DE SISTEMAS',
  `PLAN_ESTUDIOS` varchar(20) NOT NULL,
  `CICLO` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`ID_CURSO`, `NOM_CURSO`, `ESCUELA_PROFESIONAL`, `PLAN_ESTUDIOS`, `CICLO`) VALUES
('C0001', 'PROYECTO DE SISTEMAS', 'ESCUELA PROFESIONAL DE INGENIERÍA DE SISTEMAS', '2016', 'X');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_comision`
--

CREATE TABLE `detalle_comision` (
  `ID_DETALLE_COMISION` int(11) NOT NULL,
  `ID_DOCENTE` varchar(50) NOT NULL,
  `ID_CARGO` varchar(5) NOT NULL,
  `ID_ORGANISMO` varchar(5) NOT NULL,
  `ID_COMISION` varchar(5) NOT NULL,
  `ID_SUB_COMISION` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_cursos`
--

CREATE TABLE `detalle_cursos` (
  `ID_DETALLE_CURSOS` int(11) NOT NULL,
  `ID_CURSO` varchar(50) NOT NULL,
  `ESTADO` varchar(50) NOT NULL DEFAULT 'EN CURSO',
  `CUPOS_CURSO` int(10) NOT NULL,
  `ID_DOCENTE` varchar(50) NOT NULL,
  `ID_TIPO` varchar(50) NOT NULL,
  `SECCION_CURSO` varchar(50) NOT NULL,
  `HORA_INICIAL` time NOT NULL,
  `HORA_FINAL` time NOT NULL,
  `DIAS_CURSO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `detalle_cursos`
--

INSERT INTO `detalle_cursos` (`ID_DETALLE_CURSOS`, `ID_CURSO`, `ESTADO`, `CUPOS_CURSO`, `ID_DOCENTE`, `ID_TIPO`, `SECCION_CURSO`, `HORA_INICIAL`, `HORA_FINAL`, `DIAS_CURSO`) VALUES
(1, 'C0001', 'EN CURSO', 50, 'D001', 'L', '01S(90G)', '09:40:00', '11:20:00', 'LUNES'),
(2, 'C0001', 'EN CURSO', 50, 'D001', 'T', '01S', '08:00:00', '09:40:00', 'LUNES');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `ID_DOCENTE` varchar(50) NOT NULL,
  `APELLIDOS_NOMBRES` varchar(50) NOT NULL,
  `SEDE` varchar(50) NOT NULL,
  `CONDICION` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`ID_DOCENTE`, `APELLIDOS_NOMBRES`, `SEDE`, `CONDICION`) VALUES
('D001', 'CASAZOLA CRUZ DANIEL OSWALDO', 'CALLAO', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ficha`
--

CREATE TABLE `ficha` (
  `ID_FICHA` int(11) NOT NULL,
  `COD_ASIG` varchar(50) NOT NULL,
  `GH` varchar(50) NOT NULL,
  `ASIGNATURA` varchar(50) NOT NULL,
  `TIPO_T` varchar(50) NOT NULL,
  `TIPO_P` varchar(50) NOT NULL,
  `TIPO_L` varchar(50) NOT NULL,
  `ESCUELA_PROFESIONAL` varchar(50) NOT NULL DEFAULT 'ESCUELA PROFESIONAL DE INGENIERIA DE SISTEMAS',
  `FECHA_INICIO` date NOT NULL DEFAULT '2022-04-04',
  `LOCAL` varchar(50) NOT NULL DEFAULT 'CALLAO',
  `HORAS_SEMANA` int(11) NOT NULL,
  `HORAS_SEMESTRE` int(11) NOT NULL,
  `LUNES` varchar(50) NOT NULL,
  `MARTES` varchar(50) NOT NULL,
  `MIERCOLES` varchar(50) NOT NULL,
  `JUEVES` varchar(50) NOT NULL,
  `VIERNES` varchar(50) NOT NULL,
  `SABADO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ficha`
--

INSERT INTO `ficha` (`ID_FICHA`, `COD_ASIG`, `GH`, `ASIGNATURA`, `TIPO_T`, `TIPO_P`, `TIPO_L`, `ESCUELA_PROFESIONAL`, `FECHA_INICIO`, `LOCAL`, `HORAS_SEMANA`, `HORAS_SEMESTRE`, `LUNES`, `MARTES`, `MIERCOLES`, `JUEVES`, `VIERNES`, `SABADO`) VALUES
(20, 'C0001', '01S', 'PROYECTO DE SISTEMAS', 'T', '', 'L', 'ESCUELA PROFESIONAL DE INGENIERIA DE SISTEMAS', '2022-04-04', 'CALLAO', 0, 0, '08:00:00 - 09:40:00', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organismos`
--

CREATE TABLE `organismos` (
  `ID_ORGANISMO` varchar(5) NOT NULL,
  `NOMBRE_ORGANISMOS` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sub_comision`
--

CREATE TABLE `sub_comision` (
  `ID_SUB_COMISION` varchar(5) NOT NULL,
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
  ADD KEY `FK_organismo` (`ID_ORGANISMO`);

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
  ADD KEY `FK_id_cargo` (`ID_CARGO`),
  ADD KEY `FK_id_comision` (`ID_COMISION`),
  ADD KEY `FK_id_docente` (`ID_DOCENTE`),
  ADD KEY `FK_id_organismo` (`ID_ORGANISMO`),
  ADD KEY `FK_id_sub` (`ID_SUB_COMISION`);

--
-- Indices de la tabla `detalle_cursos`
--
ALTER TABLE `detalle_cursos`
  ADD PRIMARY KEY (`ID_DETALLE_CURSOS`),
  ADD KEY `FK_curso` (`ID_CURSO`),
  ADD KEY `FK_docente` (`ID_DOCENTE`),
  ADD KEY `FK_tipo` (`ID_TIPO`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`ID_DOCENTE`);

--
-- Indices de la tabla `ficha`
--
ALTER TABLE `ficha`
  ADD PRIMARY KEY (`ID_FICHA`);

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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_comision`
--
ALTER TABLE `detalle_comision`
  MODIFY `ID_DETALLE_COMISION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_cursos`
--
ALTER TABLE `detalle_cursos`
  MODIFY `ID_DETALLE_CURSOS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ficha`
--
ALTER TABLE `ficha`
  MODIFY `ID_FICHA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD CONSTRAINT `FK_organismo` FOREIGN KEY (`ID_ORGANISMO`) REFERENCES `organismos` (`ID_ORGANISMO`);

--
-- Filtros para la tabla `detalle_comision`
--
ALTER TABLE `detalle_comision`
  ADD CONSTRAINT `FK_id_cargo` FOREIGN KEY (`ID_CARGO`) REFERENCES `cargos` (`ID_CARGO`),
  ADD CONSTRAINT `FK_id_comision` FOREIGN KEY (`ID_COMISION`) REFERENCES `comisiones` (`ID_COMISION`),
  ADD CONSTRAINT `FK_id_docente` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docentes` (`ID_DOCENTE`),
  ADD CONSTRAINT `FK_id_organismo` FOREIGN KEY (`ID_ORGANISMO`) REFERENCES `organismos` (`ID_ORGANISMO`),
  ADD CONSTRAINT `FK_id_sub` FOREIGN KEY (`ID_SUB_COMISION`) REFERENCES `sub_comision` (`ID_SUB_COMISION`);

--
-- Filtros para la tabla `detalle_cursos`
--
ALTER TABLE `detalle_cursos`
  ADD CONSTRAINT `FK_curso` FOREIGN KEY (`ID_CURSO`) REFERENCES `cursos` (`ID_CURSO`),
  ADD CONSTRAINT `FK_docente` FOREIGN KEY (`ID_DOCENTE`) REFERENCES `docentes` (`ID_DOCENTE`),
  ADD CONSTRAINT `FK_tipo` FOREIGN KEY (`ID_TIPO`) REFERENCES `tipo_horario` (`ID_TIPO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
