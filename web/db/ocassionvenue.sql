-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-01-2013 a las 19:51:17
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
-- Estructura de tabla para la tabla `ocassionvenue`
--

CREATE TABLE IF NOT EXISTS `ocassionvenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocassion_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocassion_idx` (`id`),
  KEY `fk_venue_idx` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `ocassionvenue`
--

INSERT INTO `ocassionvenue` (`id`, `ocassion_id`, `venue_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 2);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ocassionvenue`
--
ALTER TABLE `ocassionvenue`
  ADD CONSTRAINT `fk_ocassion` FOREIGN KEY (`id`) REFERENCES `ocassion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venue` FOREIGN KEY (`id`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
