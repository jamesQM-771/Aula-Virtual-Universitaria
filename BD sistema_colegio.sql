-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-06-2025 a las 02:24:37
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
-- Base de datos: `sistema_colegio`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `n_identidad` bigint(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `f_nacimiento` date NOT NULL,
  `sexo` varchar(15) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `n_identidad`, `nombre`, `apellido`, `f_nacimiento`, `sexo`, `id_curso`, `direccion`, `telefono`) VALUES
(1, 1097098127, 'james', 'quintero mosquera', '2007-08-28', 'Masculino', 4, 'Mi casa\r\n', '123456789'),
(2, 1094047433, 'Bianca Lisbeth ', 'Lagos Ramirez', '2006-06-24', 'Femenino', 1, 'villa de rosario', '3104444444'),
(3, 1094220615, 'Juan Miguel', 'Lopez Alarcon', '2006-03-26', 'Masculino', 4, 'Patios', '314 2916921'),
(4, 1092341439, 'Juan Felipe', 'Rojas Escalante', '2006-11-11', 'Masculino', 4, 'Lomitas Villa del rosario', '317 6924883'),
(5, 1193396961, 'Camilo Andres', 'Ramirez Acevedo', '1999-12-21', 'Masculino', 4, 'Libertadores', '1234567989');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nombre_curso` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nombre_curso`) VALUES
(1, 'Diseño Grafico'),
(2, 'Diseño y Administración de Modas'),
(3, 'Administración Turística y Hotelera'),
(4, 'Ingenieria de Software'),
(5, 'Administracion de Negocios Internacionales'),
(6, 'Administracion Financiera'),
(7, 'Administracion de Negocios Internacionales (Distancia)'),
(8, 'Gestion Logistica Empresarial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id_docente` int(11) NOT NULL,
  `n_identidad` bigint(20) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `apellido` varchar(250) NOT NULL,
  `especialidad` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id_docente`, `n_identidad`, `nombre`, `apellido`, `especialidad`) VALUES
(1, 1001001001, 'Tatiana', 'Castaño', 'Fundamentos del Diseño'),
(2, 1001001002, 'Luisa', 'Torres', 'Ilustración Digital'),
(3, 1001001003, 'Mateo', 'Guzmán', 'Branding'),
(4, 1001001004, 'Iván', 'Pérez', 'Producción Gráfica'),
(5, 1001001005, 'María', 'Ruiz', 'Diseño Web'),
(6, 1001001006, 'Andrés', 'Pérez', 'Historia del Arte'),
(7, 1001001007, 'Paula', 'Sánchez', 'Publicidad'),
(8, 1001001008, 'Andrés', 'Martínez', 'Fotografía'),
(9, 1001001009, 'Diego', 'Sánchez', 'Diseño de Moda'),
(10, 1001001010, 'Alejandro', 'Flores', 'Confección Industrial'),
(11, 1001001011, 'Laura', 'Rojas', 'Patronaje'),
(12, 1001001012, 'María', 'Ortega', 'Diseño Textil'),
(13, 1001001013, 'Luisa', 'Herrera', 'Mercadeo de la Moda'),
(14, 1001001014, 'Paula', 'Ortega', 'Dibujo Técnico'),
(15, 1001001015, 'Iván', 'Pérez', 'Historia de la Moda'),
(16, 1001001016, 'Juan', 'Vargas', 'Producción de Colecciones'),
(17, 1001001017, 'Tomás', 'Reyes', 'Gestión Hotelera'),
(18, 1001001018, 'Miguel', 'Ruiz', 'Turismo Sostenible'),
(19, 1001001019, 'Sofía', 'Romero', 'Agencias de Viaje'),
(20, 1001001020, 'Juan', 'Pérez', 'Guianza Turística'),
(21, 1001001021, 'Santiago', 'Navarro', 'Patrimonio Cultural'),
(22, 1001001022, 'Sebastián', 'Ocampo', 'Marketing Turístico'),
(23, 1001001023, 'Mariana', 'Sánchez', 'Atención al Cliente'),
(24, 1001001024, 'Santiago', 'Pérez', 'Inglés Turístico'),
(25, 1001001025, 'Mateo', 'Vargas', 'Programación I'),
(26, 1001001026, 'Juan', 'Flores', 'Estructuras de Datos'),
(27, 1001001027, 'Sofía', 'Navarro', 'Bases de Datos'),
(28, 1001001028, 'Carlos', 'Navarro', 'Ingeniería de Software'),
(29, 1001001029, 'Tomás', 'López', 'Redes de Computadores'),
(30, 1001001030, 'Luisa', 'Ocampo', 'Desarrollo Web'),
(31, 1001001031, 'Carlos', 'Torres', 'Seguridad Informática'),
(32, 1001001032, 'Carlos', 'Álvarez', 'Sistemas Operativos'),
(33, 1001001033, 'Juan', 'Flores', 'Comercio Internacional'),
(34, 1001001034, 'Mateo', 'Mendoza', 'Negociación Internacional'),
(35, 1001001035, 'Camilo', 'Sánchez', 'Logística Global'),
(36, 1001001036, 'Mariana', 'Mendoza', 'Finanzas Internacionales'),
(37, 1001001037, 'Catalina', 'Flores', 'Derecho Comercial'),
(38, 1001001038, 'Jorge', 'López', 'Marketing Global'),
(39, 1001001039, 'Felipe', 'López', 'Macroeconomía'),
(40, 1001001040, 'Gabriela', 'Delgado', 'Inglés de Negocios'),
(41, 1001001041, 'Sofía', 'Herrera', 'Contabilidad'),
(42, 1001001042, 'Miguel', 'Guzmán', 'Matemáticas Financieras'),
(43, 1001001043, 'Valentina', 'Ramírez', 'Análisis Financiero'),
(44, 1001001044, 'María', 'Delgado', 'Gestión Bancaria'),
(45, 1001001045, 'Isabela', 'Sánchez', 'Impuestos'),
(46, 1001001046, 'Samuel', 'Campos', 'Finanzas Corporativas'),
(47, 1001001047, 'Estefanía', 'Vélez', 'Estadística'),
(48, 1001001048, 'Tatiana', 'Herrera', 'Presupuestos'),
(49, 1001001049, 'Carlos', 'Suárez', 'Comercio Exterior'),
(50, 1001001050, 'Jorge', 'Silva', 'Mercados Internacionales'),
(51, 1001001051, 'Juan', 'Álvarez', 'Negociación Comercial'),
(52, 1001001052, 'Miguel', 'Moreno', 'Logística Internacional'),
(53, 1001001053, 'Tatiana', 'Flores', 'Finanzas'),
(54, 1001001054, 'Diana', 'Romero', 'Macroeconomía Global'),
(55, 1001001055, 'Santiago', 'Suárez', 'Gestión de Empresas'),
(56, 1001001056, 'Carlos', 'Álvarez', 'Inglés Técnico'),
(57, 1001001057, 'Laura', 'Ramírez', 'Logística Empresarial'),
(58, 1001001058, 'Daniela', 'Vargas', 'Cadena de Suministro'),
(59, 1001001059, 'Sara', 'Martínez', 'Distribución Física'),
(60, 1001001060, 'Juliana', 'Navarro', 'Gestión de Inventarios'),
(61, 1001001061, 'Carlos', 'Moreno', 'Sistemas Logísticos'),
(62, 1001001062, 'Felipe', 'Campos', 'Costos Logísticos'),
(63, 1001001063, 'Andrés', 'Romero', 'Comercio Electrónico'),
(64, 1001001064, 'Isabela', 'Jiménez', 'Transporte Multimodal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias`
--

CREATE TABLE `materias` (
  `id_materia` int(11) NOT NULL,
  `nombre` varchar(250) NOT NULL,
  `id_docente` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materias`
--

INSERT INTO `materias` (`id_materia`, `nombre`, `id_docente`, `id_curso`) VALUES
(1, 'Fundamentos del Diseño', 1, 1),
(2, 'Ilustración Digital', 2, 1),
(3, 'Branding', 3, 1),
(4, 'Producción Gráfica', 4, 1),
(5, 'Diseño Web', 5, 1),
(6, 'Historia del Arte', 6, 1),
(7, 'Publicidad', 7, 1),
(8, 'Fotografía', 8, 1),
(9, 'Diseño de Moda', 9, 2),
(10, 'Confección Industrial', 10, 2),
(11, 'Patronaje', 11, 2),
(12, 'Diseño Textil', 12, 2),
(13, 'Mercadeo de la Moda', 13, 2),
(14, 'Dibujo Técnico', 14, 2),
(15, 'Historia de la Moda', 15, 2),
(16, 'Producción de Colecciones', 16, 2),
(17, 'Gestión Hotelera', 17, 3),
(18, 'Turismo Sostenible', 18, 3),
(19, 'Agencias de Viaje', 19, 3),
(20, 'Guianza Turística', 20, 3),
(21, 'Patrimonio Cultural', 21, 3),
(22, 'Marketing Turístico', 22, 3),
(23, 'Atención al Cliente', 23, 3),
(24, 'Inglés Turístico', 24, 3),
(25, 'Programación I', 25, 4),
(26, 'Estructuras de Datos', 26, 4),
(27, 'Bases de Datos', 27, 4),
(28, 'Ingeniería de Software', 28, 4),
(29, 'Redes de Computadores', 29, 4),
(30, 'Desarrollo Web', 30, 4),
(31, 'Seguridad Informática', 31, 4),
(32, 'Sistemas Operativos', 32, 4),
(33, 'Comercio Internacional', 33, 5),
(34, 'Negociación Internacional', 34, 5),
(35, 'Logística Global', 35, 5),
(36, 'Finanzas Internacionales', 36, 5),
(37, 'Derecho Comercial', 37, 5),
(38, 'Marketing Global', 38, 5),
(39, 'Macroeconomía', 39, 5),
(40, 'Inglés de Negocios', 40, 5),
(41, 'Contabilidad', 41, 6),
(42, 'Matemáticas Financieras', 42, 6),
(43, 'Análisis Financiero', 43, 6),
(44, 'Gestión Bancaria', 44, 6),
(45, 'Impuestos', 45, 6),
(46, 'Finanzas Corporativas', 46, 6),
(47, 'Estadística', 47, 6),
(48, 'Presupuestos', 48, 6),
(49, 'Comercio Exterior', 49, 7),
(50, 'Mercados Internacionales', 50, 7),
(51, 'Negociación Comercial', 51, 7),
(52, 'Logística Internacional', 52, 7),
(53, 'Finanzas', 53, 7),
(54, 'Macroeconomía Global', 54, 7),
(55, 'Gestión de Empresas', 55, 7),
(56, 'Inglés Técnico', 56, 7),
(57, 'Logística Empresarial', 57, 8),
(58, 'Cadena de Suministro', 58, 8),
(59, 'Distribución Física', 59, 8),
(60, 'Gestión de Inventarios', 60, 8),
(61, 'Sistemas Logísticos', 61, 8),
(62, 'Costos Logísticos', 62, 8),
(63, 'Comercio Electrónico', 63, 8),
(64, 'Transporte Multimodal', 64, 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `id_nota` int(11) NOT NULL,
  `id_alumno` int(11) NOT NULL,
  `id_materia` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `periodo` enum('previo_1','previo_2','nota_3','previo_final') NOT NULL,
  `acumulativo` int(11) NOT NULL,
  `examen` int(11) NOT NULL,
  `total` int(11) GENERATED ALWAYS AS (`acumulativo` + `examen`) STORED
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`id_nota`, `id_alumno`, `id_materia`, `id_curso`, `periodo`, `acumulativo`, `examen`) VALUES
(6, 3, 25, 4, 'previo_1', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `materias`
--
ALTER TABLE `materias`
  ADD PRIMARY KEY (`id_materia`),
  ADD KEY `id_docente` (`id_docente`),
  ADD KEY `fk_materias_cursos` (`id_curso`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id_nota`),
  ADD UNIQUE KEY `unique_alumno_materia` (`id_alumno`,`id_materia`),
  ADD KEY `id_materia` (`id_materia`),
  ADD KEY `id_curso` (`id_curso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `materias`
--
ALTER TABLE `materias`
  MODIFY `id_materia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `materias`
--
ALTER TABLE `materias`
  ADD CONSTRAINT `fk_materias_cursos` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON DELETE CASCADE,
  ADD CONSTRAINT `materias_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docentes` (`id_docente`);

--
-- Filtros para la tabla `notas`
--
ALTER TABLE `notas`
  ADD CONSTRAINT `notas_ibfk_1` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  ADD CONSTRAINT `notas_ibfk_2` FOREIGN KEY (`id_materia`) REFERENCES `materias` (`id_materia`),
  ADD CONSTRAINT `notas_ibfk_3` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
