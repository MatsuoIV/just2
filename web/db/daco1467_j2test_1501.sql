-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-01-2013 a las 19:08:45
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

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
-- Estructura de tabla para la tabla `auction`
--

CREATE TABLE IF NOT EXISTS `auction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `winningMember_id` int(11) DEFAULT NULL,
  `reservation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `state` smallint(6) NOT NULL,
  `dateJust_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DEE4F593F85000AD` (`dateJust_id`),
  KEY `IDX_DEE4F593DC36EFAF` (`winningMember_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bid`
--

CREATE TABLE IF NOT EXISTS `bid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `createdAt` datetime NOT NULL,
  `dateJust_id` int(11) DEFAULT NULL,
  `estate` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4AF2B3F37597D3FE` (`member_id`),
  KEY `IDX_4AF2B3F3F85000AD` (`dateJust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `bid`
--

INSERT INTO `bid` (`id`, `member_id`, `price`, `createdAt`, `dateJust_id`, `estate`) VALUES
(14, 8, 109, '2012-12-27 11:10:34', 1, 3),
(15, 7, 110, '2012-12-29 11:15:31', 1, 1),
(16, 7, 120, '2012-12-29 11:16:01', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category_ocassion`
--

CREATE TABLE IF NOT EXISTS `category_ocassion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `category_ocassion`
--

INSERT INTO `category_ocassion` (`id`, `name`) VALUES
(1, 'Cena'),
(2, 'Paseo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `date_just`
--

CREATE TABLE IF NOT EXISTS `date_just` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `member_id` int(11) DEFAULT NULL,
  `ocassion_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  `detailDate` longtext COLLATE utf8_unicode_ci NOT NULL,
  `minPrice` decimal(10,2) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `endBid` datetime NOT NULL,
  `estate` smallint(6) NOT NULL,
  `dateEnd` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_544174247597D3FE` (`member_id`),
  KEY `IDX_54417424505C875F` (`ocassion_id`),
  KEY `IDX_5441742440A73EBA` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `date_just`
--

INSERT INTO `date_just` (`id`, `member_id`, `ocassion_id`, `venue_id`, `detailDate`, `minPrice`, `createdAt`, `updatedAt`, `endBid`, `estate`, `dateEnd`) VALUES
(1, 6, 1, 1, 'cena para dos con cosas', 100.00, '2012-12-22 00:00:00', '2013-01-14 20:27:40', '2013-01-15 14:00:00', 2, '2013-01-15 14:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `document`
--

INSERT INTO `document` (`id`, `name`, `path`, `member_id`) VALUES
(1, 'lol', 'png', 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `interest`
--

INSERT INTO `interest` (`id`, `name`) VALUES
(1, 'paseo'),
(2, 'fiesta'),
(3, 'ejercicio'),
(4, 'trabajo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jvj_country`
--

CREATE TABLE IF NOT EXISTS `jvj_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `jvj_country`
--

INSERT INTO `jvj_country` (`id`, `name`) VALUES
(1, 'peru');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jvj_department`
--

CREATE TABLE IF NOT EXISTS `jvj_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92F4AB5BF92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `jvj_department`
--

INSERT INTO `jvj_department` (`id`, `country_id`, `name`) VALUES
(1, 1, 'lima');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jvj_district`
--

CREATE TABLE IF NOT EXISTS `jvj_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90EA4B461DFEBE2A` (`Department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `jvj_district`
--

INSERT INTO `jvj_district` (`id`, `name`, `Department_id`) VALUES
(1, 'chorrillos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jvj_role`
--

CREATE TABLE IF NOT EXISTS `jvj_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CEB0A75B57698A6A` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `jvj_role`
--

INSERT INTO `jvj_role` (`id`, `name`, `role`) VALUES
(1, 'Administrador', 'ROLE_ADMIN'),
(2, 'User', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jvj_user`
--

CREATE TABLE IF NOT EXISTS `jvj_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `codeActivation` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `face` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `member_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_144AFB78F85E0677` (`username`),
  UNIQUE KEY `UNIQ_144AFB78E7927C74` (`email`),
  UNIQUE KEY `UNIQ_144AFB787597D3FE` (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `jvj_user`
--

INSERT INTO `jvj_user` (`id`, `username`, `salt`, `password`, `email`, `codeActivation`, `is_active`, `face`, `member_id`) VALUES
(7, 'test', 'c414b50843e59213722f18d353abb3c2', 'test', NULL, 'ze65lfbwhqhz59aczm8v89smdshi9y1lpyhrz0mv', 1, NULL, 6),
(8, 'mar', '3cf3fe64c34c28a779bf02dcd107752e', 'fc417051e6cb225f14827a48170362d195e0aa86', 'marasdfasdf@gmail.com', 'bkroxriypaloa89old53ns46drlo4u5wdmjr1mv4', 1, NULL, 7),
(9, 'mari', 'e8a692ca88c66123798ab6803b864e41', '238a83dcf8884b11588771cdcb43b13eb8c3a9ad', 'marasdfiasdf@gmail.com', 'yyqtjt3fvevjkbdwobicz53t6s608db4jlzj3anj', 1, NULL, 8),
(20, 'javier', '4d63510ff96dcebeab464bb49f94baea', '75d519b0da06e7e9e80f26c48e1c2784b329854b', 'jhanice@gmail.com', '5y4v1jxrlum50x0y004zg1n4kavr81pv678wyurn', 1, NULL, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `postCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateOfBirth` datetime NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `height` int(11) NOT NULL,
  `eyeColour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hairColour` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datePreference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `smoker` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `children` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `personality` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `interest_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_70E4FA78A76ED395` (`user_id`),
  KEY `IDX_70E4FA785D83CC1` (`state_id`),
  KEY `IDX_70E4FA78F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `member`
--

INSERT INTO `member` (`id`, `state_id`, `country_id`, `firstName`, `lastName`, `street`, `postCode`, `phone`, `mobile`, `dateOfBirth`, `gender`, `user_id`, `height`, `eyeColour`, `hairColour`, `datePreference`, `smoker`, `children`, `relationship`, `profession`, `personality`, `interest_id`, `image`, `path`) VALUES
(6, 1, 1, '', '', '', '', '', '', '1924-06-15 00:00:00', 'masculinods', 7, 50, 'asddddddd', 'ffffffffffffff', 'asdasd', 'no', 'tba', 'married', 'tba', 'ffffffffffffffffffffff', '', '', NULL),
(7, 1, 1, '', '', '', '', '', '', '1927-01-01 00:00:00', 'm', 8, 70, 'asdsad', 'asd', 'asdasd', 'yes', 'yes', 'single', 'tba', 'asdasd', '', '', NULL),
(8, 1, 1, 'mar', 'mar', 'jsjd', '2323', '2323', '232323', '1927-01-01 00:00:00', 'm', 9, 0, '', '', '', '', '', '', '', '', '', '', NULL),
(19, 1, 1, 'Javier', 'Vilcapaza', 'asdf', 'asdf', 'asdf', 'asdf', '1920-01-01 00:00:00', 'nope', 20, 0, 'black', 'black', 'asdasd', 'yes', 'yes', 'single', '-', 'asdad', '', '', '19.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `member_interest`
--

CREATE TABLE IF NOT EXISTS `member_interest` (
  `interest_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  KEY `fk_interest_idx` (`interest_id`),
  KEY `fk_member_idx` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `member_interest`
--

INSERT INTO `member_interest` (`interest_id`, `member_id`) VALUES
(4, 6),
(2, 6),
(2, 7),
(3, 7),
(3, 19),
(4, 19);

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
(1, 'cena', 15.00, 1),
(2, 'buffet', 20.00, 1),
(3, 'tour Lima', 35.00, 2),
(4, 'menu marino', 20.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocassionvenue`
--

CREATE TABLE IF NOT EXISTS `ocassionvenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocassion_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_ocassion` (`ocassion_id`),
  KEY `fk_venue` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `ocassionvenue`
--

INSERT INTO `ocassionvenue` (`id`, `ocassion_id`, `venue_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 2),
(4, 2, 4),
(5, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_id` int(11) DEFAULT NULL,
  `codeReservation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `estate` smallint(6) NOT NULL,
  `dateJust_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C8495540A73EBA` (`venue_id`),
  KEY `IDX_42C84955F85000AD` (`dateJust_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_8F02BF9DA76ED395` (`user_id`),
  KEY `IDX_8F02BF9DFE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 2),
(20, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  KEY `IDX_2DE8C6A3D60322AC` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91911B0D5126AC48` (`mail`),
  KEY `IDX_91911B0DF92F3E70` (`country_id`),
  KEY `IDX_91911B0DAE80F5DF` (`department_id`),
  KEY `IDX_91911B0DB08FA272` (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `venue`
--

INSERT INTO `venue` (`id`, `country_id`, `department_id`, `district_id`, `name`, `address`, `mail`, `phone`, `contact`, `image`, `details`) VALUES
(1, 1, 1, 1, 'Rustica', 'Jr kuie', 'rusticachorillos@gmail.com', '3245623', 'Juan Villegas', 'img1.png', 'venue1.png'),
(2, 1, 1, 1, 'Rokys', 'asdf', 'rokys@terra.pe', '4584564', 'Moises Oscanoa', 'img2.png', 'venue2.png'),
(3, 1, 1, 1, 'Boulevard 99', 'Wong', 'boulevard99@outlook.com', '7715145', 'Diego Quiroz', 'img3.png', 'venue3.png'),
(4, 1, 1, 1, 'MiraBus', 'Miraflores', 'mirabus@hotmail.es', '2245411', 'Renzo Loli', 'img4.png', 'venue4.png');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `FK_DEE4F593DC36EFAF` FOREIGN KEY (`winningMember_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_DEE4F593F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Filtros para la tabla `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `FK_4AF2B3F37597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_4AF2B3F3F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Filtros para la tabla `date_just`
--
ALTER TABLE `date_just`
  ADD CONSTRAINT `FK_5441742440A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_54417424505C875F` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`),
  ADD CONSTRAINT `FK_544174247597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Filtros para la tabla `jvj_department`
--
ALTER TABLE `jvj_department`
  ADD CONSTRAINT `FK_92F4AB5BF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

--
-- Filtros para la tabla `jvj_district`
--
ALTER TABLE `jvj_district`
  ADD CONSTRAINT `FK_90EA4B461DFEBE2A` FOREIGN KEY (`Department_id`) REFERENCES `jvj_department` (`id`);

--
-- Filtros para la tabla `jvj_user`
--
ALTER TABLE `jvj_user`
  ADD CONSTRAINT `FK_144AFB787597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Filtros para la tabla `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `FK_70E4FA785D83CC1` FOREIGN KEY (`state_id`) REFERENCES `jvj_department` (`id`),
  ADD CONSTRAINT `FK_70E4FA78A76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`),
  ADD CONSTRAINT `FK_70E4FA78F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

--
-- Filtros para la tabla `member_interest`
--
ALTER TABLE `member_interest`
  ADD CONSTRAINT `fk_interest` FOREIGN KEY (`interest_id`) REFERENCES `interest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_member` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `ocassion`
--
ALTER TABLE `ocassion`
  ADD CONSTRAINT `FK_DD8EB90C9395A88E` FOREIGN KEY (`categoryOcassion_id`) REFERENCES `category_ocassion` (`id`);

--
-- Filtros para la tabla `ocassionvenue`
--
ALTER TABLE `ocassionvenue`
  ADD CONSTRAINT `fk_ocassion` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venue` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495540A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_42C84955F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Filtros para la tabla `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `FK_8F02BF9DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8F02BF9DFE54D947` FOREIGN KEY (`group_id`) REFERENCES `jvj_role` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `jvj_role` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `FK_91911B0DAE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `jvj_department` (`id`),
  ADD CONSTRAINT `FK_91911B0DB08FA272` FOREIGN KEY (`district_id`) REFERENCES `jvj_district` (`id`),
  ADD CONSTRAINT `FK_91911B0DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
