-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-01-2013 a las 19:51:08
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `daco1467_j2test`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocassion`
--

CREATE TABLE IF NOT EXISTS `ocassion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `categoryOcassion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DD8EB90C9395A88E` (`categoryOcassion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `ocassion`
--

INSERT INTO `ocassion` (`id`, `name`, `price`, `categoryOcassion_id`) VALUES
(1, 'cena para dos', '15.00', 1),
(2, 'buffet', '20.00', 1),
(3, 'tour Lima', '35.00', 2),
(4, 'menu marino', '20.00', 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ocassion`
--
ALTER TABLE `ocassion`
  ADD CONSTRAINT `FK_DD8EB90C9395A88E` FOREIGN KEY (`categoryOcassion_id`) REFERENCES `category_ocassion` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
