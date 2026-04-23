-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2026 a las 08:40:21
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
-- Base de datos: `casos_de_exito`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beneficios`
--

CREATE TABLE `beneficios` (
  `idBeneficio` int(11) NOT NULL,
  `nombreBeneficio` varchar(100) NOT NULL,
  `idTipoBeneficio` int(11) NOT NULL,
  `descuento` int(11) NOT NULL,
  `descBeneficio` varchar(50) NOT NULL,
  `idCategoriaBeneficio` int(11) NOT NULL,
  `imgBeneficioP` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `beneficios`
--

INSERT INTO `beneficios` (`idBeneficio`, `nombreBeneficio`, `idTipoBeneficio`, `descuento`, `descBeneficio`, `idCategoriaBeneficio`, `imgBeneficioP`) VALUES
(15, 'Garzas', 2, 10, 'ejemplo de descripción ', 1, 'img_68d0ced3107d83.96951045.jpg'),
(21, 'ada', 2, 12, 'prueba de descripción 2', 3, 'img_68da1bb21f2794.28406133.jpg'),
(22, 'ada', 2, 12, 'prueba de descripción 3', 4, 'img_68da1bb65b7c16.04445316.jpg'),
(23, 'Ga', 1, 12, 'prueba de descripción 4', 5, 'img_68da1bf644d3a6.94905333.jpeg'),
(28, 'ada', 1, 10, 'prueba de descripción 5', 6, 'img_68db58bc4f7725.28026601.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bolsa_trabajo`
--

CREATE TABLE `bolsa_trabajo` (
  `idPlataforma` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `urlPlataforma` varchar(300) NOT NULL,
  `imgPlataforma` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `bolsa_trabajo`
--

INSERT INTO `bolsa_trabajo` (`idPlataforma`, `nombre`, `urlPlataforma`, `imgPlataforma`) VALUES
(1, 'ejemplo plataforma 1', 'https://uaeh.edu.mx/fotografia_online/cedai/appEgresados/apisAdminEgresados/modLeerPlataformas.php', 'img_68ca51c5586e73.17042005.jpg'),
(2, 'ejemplo plataforma 2', 'https://es468431-2740914.postman.co/workspace/fe221751-da21-4a82-bd8b-098151c76217/collection/48085836-0494525f-e10e-4d9b-ac35-4af6dbce4228', 'img_68ca524c282082.20713702.jpg'),
(3, 'ejemplo plataforma 3', 'https://es468431-2740914.postman.co/workspace/fe221751-da21-4a82-bd8b-098151c76217/collection/48085836-0494525f-e10e-4d9b-ac35-4af6dbce4228', 'img_68ca5236d1dce2.07336442.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casos_exito`
--

CREATE TABLE `casos_exito` (
  `idCaso` int(11) NOT NULL,
  `Nombre` varchar(200) NOT NULL,
  `Carrera` varchar(100) NOT NULL,
  `Descripcion` text NOT NULL,
  `imgCE` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `casos_exito`
--

INSERT INTO `casos_exito` (`idCaso`, `Nombre`, `Carrera`, `Descripcion`, `imgCE`) VALUES
(6, 'Francisco Javier ', 'Gastronomia', 'Prueba 1', 'img_68bfa1627b1978.28907123.jpg'),
(7, 'Alejandro Cruz Islas', 'Músico', 'Prueba 2', 'img_68bfa16ee88a94.04230998.jpeg'),
(8, 'Cristian Enrique Rivas Anzaldo', 'Arquitectura', 'Prueba 3', 'img_68bfa246464798.59701100.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_beneficios`
--

CREATE TABLE `categoria_beneficios` (
  `idCategoriaBeneficio` int(11) NOT NULL,
  `nombreCategoria` varchar(100) NOT NULL,
  `urlImg` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria_beneficios`
--

INSERT INTO `categoria_beneficios` (`idCategoriaBeneficio`, `nombreCategoria`, `urlImg`) VALUES
(1, 'Alimentos y Bebidas', 'img_68cb62e6e4c0c1.41601863.jpg'),
(2, 'Entretenimiento', 'img_68db57eab00e07.99123801.jpg'),
(3, 'Salud y Bienestar', 'img_68db57f313e460.04876481.jpeg'),
(4, 'Decoracion', 'img_68ccdc1c73e561.78410611.jpg'),
(5, 'Belleza', 'img_68ccc5d5720e50.05042035.jpg'),
(6, 'Hospedaje', 'img_68db58a9612341.82480582.jpg'),
(7, 'Seguros', 'img_68db58eacc31b1.37988824.jpg'),
(8, 'Otros', 'img_68db58f85db380.49046645.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idComentarios` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `correo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idComentarios`, `descripcion`, `correo`) VALUES
(1, 'Si editas manualmente los IDs en MySQL usando phpMyAdmin, el principal riesgo es romper la integrida', 'ejemplos@gnail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL,
  `nombreEvento` varchar(100) NOT NULL,
  `nombrePersona` varchar(100) NOT NULL,
  `hora` time NOT NULL,
  `fecha` date NOT NULL,
  `descEvento` varchar(100) NOT NULL,
  `lugar` varchar(100) NOT NULL,
  `imagenEvento` varchar(100) NOT NULL,
  `urlEvento` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`idEvento`, `nombreEvento`, `nombrePersona`, `hora`, `fecha`, `descEvento`, `lugar`, `imagenEvento`, `urlEvento`) VALUES
(1, 'Caminata', '', '02:02:00', '2001-12-12', 'paseo por jardines de la universidad', 'icbi', 'img_68ca5005687dc8.34946807.jpg', 'https://es468431-2740914.postman.co/workspace/fe221751-da21-4a82-bd8b-098151c76217/collection/48085836-0494525f-e10e-4d9b-ac35-4af6dbce4228');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `autor` varchar(100) NOT NULL,
  `epigrafe` varchar(100) NOT NULL,
  `contenido` text NOT NULL,
  `imgNoticia` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `autor`, `epigrafe`, `contenido`, `imgNoticia`) VALUES
(2, 'ICBI', 'Desconocido', 'ejemplo de epígrafe ', 'prueba de descripción 1 ', 'img_68c3b9008b66c0.76267319.jpg'),
(3, 'ICBI', 'Desconocido', 'ejemplo de epígrafe ', 'prueba de descripción 2', 'img_68c3b9090d6e82.65185194.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recuerdos`
--

CREATE TABLE `recuerdos` (
  `idRecuerdo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `imgRecuerdo` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `recuerdos`
--

INSERT INTO `recuerdos` (`idRecuerdo`, `nombre`, `descripcion`, `imgRecuerdo`) VALUES
(1, 'Abasolo', 'prueba de descripción 1 ', 'img_68c0f894b16895.59004381.jpg'),
(2, 'Garzas', 'prueba de descripción 2', 'img_68c0f8838f0482.65793507.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `numEmpleado` int(11) NOT NULL,
  `correo` varchar(300) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `username`, `numEmpleado`, `correo`, `password`) VALUES
(1, 'lalo', 468431, 'es468431@uaeh.edu.mx', '0389602652c11a49384aa4a51b334e3334877dfb980ced8f9817441f755682776871d6873259aa5826cb4630df1b9ab828c0302766971d526a53b14846bcd876'),
(2, 'Edu', 10102, 'ejemplo@uaeh.edu.mx', '33275a8aa48ea918bd53a9181aa975f15ab0d0645398f5918a006d08675c1cb27d5c645dbd084eee56e675e25ba4019f2ecea37ca9e2995b49fcb12c096a032e');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  ADD PRIMARY KEY (`idBeneficio`);

--
-- Indices de la tabla `bolsa_trabajo`
--
ALTER TABLE `bolsa_trabajo`
  ADD PRIMARY KEY (`idPlataforma`);

--
-- Indices de la tabla `casos_exito`
--
ALTER TABLE `casos_exito`
  ADD PRIMARY KEY (`idCaso`);

--
-- Indices de la tabla `categoria_beneficios`
--
ALTER TABLE `categoria_beneficios`
  ADD PRIMARY KEY (`idCategoriaBeneficio`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`idComentarios`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`idEvento`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`);

--
-- Indices de la tabla `recuerdos`
--
ALTER TABLE `recuerdos`
  ADD PRIMARY KEY (`idRecuerdo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `beneficios`
--
ALTER TABLE `beneficios`
  MODIFY `idBeneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `bolsa_trabajo`
--
ALTER TABLE `bolsa_trabajo`
  MODIFY `idPlataforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `casos_exito`
--
ALTER TABLE `casos_exito`
  MODIFY `idCaso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categoria_beneficios`
--
ALTER TABLE `categoria_beneficios`
  MODIFY `idCategoriaBeneficio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idComentarios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `idEvento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `recuerdos`
--
ALTER TABLE `recuerdos`
  MODIFY `idRecuerdo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
