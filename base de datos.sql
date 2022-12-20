-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-12-2022 a las 00:53:26
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurantes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredientes`
--

DROP TABLE IF EXISTS `ingredientes`;
CREATE TABLE IF NOT EXISTS `ingredientes` (
  `idingrediente` int(11) NOT NULL AUTO_INCREMENT,
  `idproducto` int(11) NOT NULL,
  `nombre_ingrediente` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `costo_adicional` float DEFAULT NULL,
  PRIMARY KEY (`idingrediente`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ingredientes`
--

INSERT INTO `ingredientes` (`idingrediente`, `idproducto`, `nombre_ingrediente`, `costo_adicional`) VALUES
(1, 1, 'chile picante', 2.5),
(2, 2, 'aros de cebolla', 0.99),
(3, 2, 'carne vegetariana', 2),
(4, 3, 'salsa de soya', 5),
(5, 3, 'ensalada', 6.25),
(6, 3, 'cebollines', 0.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `idproducto` int(11) NOT NULL AUTO_INCREMENT,
  `idrestaurante` int(11) NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto1` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto2` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto3` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` float NOT NULL,
  PRIMARY KEY (`idproducto`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `idrestaurante`, `nombre`, `descripcion`, `foto1`, `foto2`, `foto3`, `precio`) VALUES
(1, 2, 'Plato de papas gigante', 'un plato de papas enorme', '/restaurantes/publico/lugares/1581_1_07032017101201.jpg', '', '/restaurantes/publico/lugares/ClLz73HWMAk4Lwb.jpg', 2.5),
(2, 2, 'hamburguesa huerfana', 'hamburguesa sin papas', '/restaurantes/publico/lugares/hamburguesa-sencilla.jpg', '/restaurantes/publico/lugares/4e4293857c03d819e4ae51de1e86d66a.jpg', '/restaurantes/publico/lugares/NCI_Visuals_Food_Hamburger.jpg', 7),
(3, 3, 'Rib eye', 'carne asada', '/restaurantes/publico/lugares/istockphoto-1092451104-612x612.jpg', '/restaurantes/publico/lugares/FULL-CORTE-CARNE.jfif', '/restaurantes/publico/lugares/photo.jpg', 27),
(4, 4, 'pizza hawaiana', 'pizza con piÃ±a ', '/restaurantes/publico/lugares/como-hacer-pizza-hawaiana.jpg', '/restaurantes/publico/lugares/original_pizza_hawaiana_50621_600.jpg', '/restaurantes/publico/lugares/La-Pizza-Hawaiana-de-Canada.jpg', 10.99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

DROP TABLE IF EXISTS `restaurantes`;
CREATE TABLE IF NOT EXISTS `restaurantes` (
  `idrestaurante` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_restaurante` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contacto` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `latitud` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitud` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`idrestaurante`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`idrestaurante`, `nombre_restaurante`, `direccion`, `telefono`, `contacto`, `foto`, `fecha_ingreso`, `latitud`, `longitud`) VALUES
(2, 'Papas El PajarÃ³n', 'calle antigua a san salvador', '7586-6969', 'el pajaro loco', '', '2022-12-16', '13.939303', '-89.524433'),
(5, 'Silvestre Cardedeu', 'Cardedeu Hotel, Calle Los Planes, Km 2, Lago de Coatepeque, El Salvador', '76000658', 'samuel', '/restaurantes/publico/lugares/unnamed.jpeg', '2022-12-19', '13.891053', '-89.534676'),
(3, 'La Pampa - Coatepeque', 'Calle Los Planes, Km 2, El Congo', '6053-8197', 'Celina', '', '2022-12-16', '13.891313', '-89.534419'),
(4, 'Pizza Hut â€¢ Metrocentro Santa Ana', 'CC Metrocentro local F 3 Santa Ana FC, Santa Ana', '2257-7777', 'Oswaldo Martinez', '/restaurantes/publico/lugares/2018-03-02.jpg', '2022-12-16', '13.977435', '-89.562487'),
(6, 'Javis', 'Barrio San Rafael esquina formada por calle Libertad Oriente y VeintitrÃ©s, Av Norte calle Casa #113B, Santa Ana, El Salvador', '2257-7777', 'javi', '/restaurantes/publico/lugares/unnamed.jpeg', '2022-12-19', '13.992562', '-89.547671');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `usuario`, `tipo`, `password`) VALUES
(1, 'danilo', 'Administrador', 'f10e2821bbbea527ea02200352313bc059445190'),
(2, 'alejandro', 'Usuario', 'f10e2821bbbea527ea02200352313bc059445190'),
(3, 'aguilar', 'super usuario', 'f10e2821bbbea527ea02200352313bc059445190');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
