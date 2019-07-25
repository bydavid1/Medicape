-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2019 a las 05:54:42
-- Versión del servidor: 10.3.15-MariaDB
-- Versión de PHP: 7.1.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `docdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth`
--

CREATE TABLE `auth` (
  `idauth` int(11) NOT NULL,
  `nombre` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `token` varchar(65) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auth`
--

INSERT INTO `auth` (`idauth`, `nombre`, `token`) VALUES
(1, 'X-API-Key', '3392d6c9-0ecd-44ca-b701-e153ddeef995');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idcita` int(11) NOT NULL,
  `fecha_Cita` date NOT NULL,
  `hora_Cita` time NOT NULL,
  `nombre_Paciente` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_Paciente` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `num_Consultorio` int(11) NOT NULL,
  `nombre_Doctor` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `num_Expediente` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idcita`, `fecha_Cita`, `hora_Cita`, `nombre_Paciente`, `apellido_Paciente`, `num_Consultorio`, `nombre_Doctor`, `num_Expediente`) VALUES
(17, '2019-07-12', '12:00:00', 'Byron', 'Martinez', 2, 'jose', '0'),
(18, '2019-12-19', '12:12:00', 'Karina', 'Diaz', 3, 'Jaja', ''),
(19, '0000-00-00', '04:00:00', 'Karina', 'Diaz', 12, 'juan', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultas`
--

CREATE TABLE `consultas` (
  `idconsulta` int(11) NOT NULL,
  `nombres` int(11) NOT NULL,
  `apellidos` int(11) NOT NULL,
  `num_Paciente` int(11) NOT NULL,
  `num_Consultorio` int(11) NOT NULL,
  `nom_Doctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idempleado` int(11) NOT NULL,
  `nombres` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Nac` date NOT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado_Civil` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dui` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `nit` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `especialidad` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `celular` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `municipio` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `antecedentes` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `solvencia` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `constancia_Titulo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `certificado_Salud` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Contratacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idempleado`, `nombres`, `apellidos`, `fecha_Nac`, `sexo`, `estado_Civil`, `dui`, `nit`, `especialidad`, `telefono`, `celular`, `email`, `departamento`, `municipio`, `direccion`, `antecedentes`, `solvencia`, `constancia_Titulo`, `certificado_Salud`, `fecha_Contratacion`) VALUES
(1, 'vladimirH', 'valdesH', '1999-01-07', 'm', 'soltero', '90124578', '56123jkl', 'doctor', '12457889', '231456', 'vladimir@gmail.com', ' Ana', 'le', 'calle numero la no se', 'si', 'si', 'si', 'si', '2019-08-20'),
(3, 'vladimirHumber', 'valdesHumv', '1998-01-07', 'm', 'soltero', '90124578', '56123jkl', 'doctor', '12457889', '231456', 'vladimirH@gmail.com', ' Ana', 'le', 'calle numero la no se', 'si', 'si', 'si', 'si', '2019-08-20'),
(4, 'vladimirH', 'valdesH', '1999-01-07', 'm', 'soltero', '90124578', '56123jkl', 'doctor', '12457889', '231456', 'vladimir@gmail.com', ' Ana', 'le', 'calle numero la no se', 'si', 'si', 'si', 'si', '2019-08-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes`
--

CREATE TABLE `examenes` (
  `idexamen` int(11) NOT NULL,
  `tipo_Examen` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Examen` date NOT NULL,
  `estado_examen` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Limite` date NOT NULL,
  `idpaciente` int(11) NOT NULL,
  `num_Expediente` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `examenes`
--

INSERT INTO `examenes` (`idexamen`, `tipo_Examen`, `fecha_Examen`, `estado_examen`, `fecha_Limite`, `idpaciente`, `num_Expediente`) VALUES
(1, 'vladimir', '2019-08-09', 'jhgajhgdhjdgjkdakjda', '2019-08-09', 3, '879ipo'),
(3, 'vladimirHm', '2019-08-09', 'ORINA', '2019-08-09', 3, '879ipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `item_expediente`
--

CREATE TABLE `item_expediente` (
  `iditemexp` int(11) NOT NULL,
  `fecha_Consulta` date NOT NULL,
  `diagnostico` text COLLATE utf8_spanish_ci NOT NULL,
  `tratamiento` text COLLATE utf8_spanish_ci NOT NULL,
  `observaciones` text COLLATE utf8_spanish_ci NOT NULL,
  `receta` text COLLATE utf8_spanish_ci NOT NULL,
  `num_Expediente` int(11) NOT NULL,
  `descripcion_Exam` text COLLATE utf8_spanish_ci NOT NULL,
  `idpaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `item_expediente`
--

INSERT INTO `item_expediente` (`iditemexp`, `fecha_Consulta`, `diagnostico`, `tratamiento`, `observaciones`, `receta`, `num_Expediente`, `descripcion_Exam`, `idpaciente`) VALUES
(1, '2019-05-08', 'diarrea Cronica', 'Alka-D', 'Liquidos Blandos', 'una Alka-D todos los dias', 30456, 'Parasitos Positivo', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamentos`
--

CREATE TABLE `medicamentos` (
  `idmedicamentos` int(11) NOT NULL,
  `nom_Medicamento` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `cantidad` float NOT NULL,
  `precio_U` float NOT NULL,
  `fecha_V` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `medicamentos`
--

INSERT INTO `medicamentos` (`idmedicamentos`, `nom_Medicamento`, `cantidad`, `precio_U`, `fecha_V`) VALUES
(3, 'minife', 15, 2, '2019-05-08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `idpaciente` int(11) NOT NULL,
  `nombres` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_Nac` date NOT NULL,
  `sexo` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `estado_Civil` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dui` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(65) COLLATE utf8_spanish_ci NOT NULL,
  `departamento` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `municipio` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `num_Expediente` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`idpaciente`, `nombres`, `apellidos`, `fecha_Nac`, `sexo`, `estado_Civil`, `dui`, `email`, `departamento`, `municipio`, `direccion`, `telefono`, `num_Expediente`) VALUES
(4, 'Byron', 'Martinez', '0199-08-02', 'M', 'Soltero', '12345678', 'Byron@gamail.com', 'Santa Ana', 'El Refugio', 'El Refugio', 12345, '789456'),
(5, 'Vladimir', 'Valdes', '0199-01-07', 'Masculino', 'Soltero', '00178945-5', 'vladimirValdes@gmail.com', 'Santa Ana', 'Coatepeque', 'Coatepeque', 104798656, '789456'),
(6, 'Karina', 'Diaz', '0199-08-02', 'Femenino', 'Soltera', '001789456-9', 'karinaD@gamail.com', 'Ahuchapan', 'Ahuchapan', 'Ahuchapan', 14879610, 'ui213'),
(7, 'Byron', 'Martinez', '0199-08-02', 'M', 'Soltero', '12345678', 'Byron@gamail.com', 'Santa Ana', 'El Refugio', 'El Refugio', 12345, '12345'),
(8, 'yyejejejd', 'jsjsksk', '0000-00-00', 'Masculino', 'Casado', '6277171', 'usuwu@jwjjw', 'sjannana', 'mwmmeme', 'indnsnav', 727171, '717171'),
(9, 'Elizabeth ', 'Garcia ', '0000-00-00', 'Masculino', 'Casado', '777171', 'jajqja', 'sana', 'jajaj', '7jdjs', 717871, '717171');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil_paciente`
--

CREATE TABLE `perfil_paciente` (
  `idperfil` int(11) NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `temperatura` float NOT NULL,
  `presion` float NOT NULL,
  `frec_Cardiaca` float NOT NULL,
  `pulso` int(11) NOT NULL,
  `idpaciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `perfil_paciente`
--

INSERT INTO `perfil_paciente` (`idperfil`, `peso`, `altura`, `temperatura`, `presion`, `frec_Cardiaca`, `pulso`, `idpaciente`) VALUES
(2, 100, 20, 40, 25, 30, 85, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `user_Name` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `user_Password` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `user_type` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `user_Name`, `user_Password`, `email`, `user_type`) VALUES
(1, 'Ramon', '45789', 'rodolfo@gamil.com', 'admin'),
(3, 'Byron', '1234', 'Kusi@gamil.com', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`idauth`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idcita`);

--
-- Indices de la tabla `consultas`
--
ALTER TABLE `consultas`
  ADD PRIMARY KEY (`idconsulta`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idempleado`);

--
-- Indices de la tabla `examenes`
--
ALTER TABLE `examenes`
  ADD PRIMARY KEY (`idexamen`);

--
-- Indices de la tabla `item_expediente`
--
ALTER TABLE `item_expediente`
  ADD PRIMARY KEY (`iditemexp`);

--
-- Indices de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`idmedicamentos`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`idpaciente`);

--
-- Indices de la tabla `perfil_paciente`
--
ALTER TABLE `perfil_paciente`
  ADD PRIMARY KEY (`idperfil`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `auth`
--
ALTER TABLE `auth`
  MODIFY `idauth` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idcita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `consultas`
--
ALTER TABLE `consultas`
  MODIFY `idconsulta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idempleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `examenes`
--
ALTER TABLE `examenes`
  MODIFY `idexamen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `item_expediente`
--
ALTER TABLE `item_expediente`
  MODIFY `iditemexp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `idmedicamentos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `idpaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `perfil_paciente`
--
ALTER TABLE `perfil_paciente`
  MODIFY `idperfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
