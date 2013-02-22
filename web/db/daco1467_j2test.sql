-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2013 a las 21:27:02
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `auction`
--

INSERT INTO `auction` (`id`, `winningMember_id`, `reservation`, `monto`, `state`, `dateJust_id`) VALUES
(1, 7, '1', 110.00, 1, 1),
(2, 20, '2', 220.00, 1, 2),
(3, 22, '23', 20.00, 1, 28),
(4, 22, '24', 35.00, 1, 29),
(5, 22, '24', 35.00, 1, 29);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Volcado de datos para la tabla `bid`
--

INSERT INTO `bid` (`id`, `member_id`, `price`, `createdAt`, `dateJust_id`, `estate`) VALUES
(14, 8, 109, '2012-12-27 11:10:34', 1, 3),
(15, 7, 110, '2012-12-29 11:15:31', 1, 1),
(16, 7, 120, '2012-12-29 11:16:01', 1, 1),
(17, 6, 130, '2013-01-17 04:46:48', 3, 2),
(18, 8, 135, '2013-01-25 11:13:38', 5, 2),
(39, 22, 20, '2013-02-14 00:00:00', 28, 1),
(40, 6, 35, '2013-02-13 10:58:51', 28, 3),
(41, 7, 28, '2013-02-13 11:03:00', 28, 1),
(42, 7, 40, '2013-02-13 11:03:44', 28, 1),
(43, 22, 35, '2013-02-13 00:00:00', 29, 1),
(44, 22, 35, '2013-02-19 00:00:00', 30, 1),
(45, 22, 35, '2013-02-01 00:00:00', 31, 1);

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
  `estate` smallint(6) NOT NULL,
  `dateEnd` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_544174247597D3FE` (`member_id`),
  KEY `IDX_54417424505C875F` (`ocassion_id`),
  KEY `IDX_5441742440A73EBA` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- Volcado de datos para la tabla `date_just`
--

INSERT INTO `date_just` (`id`, `member_id`, `ocassion_id`, `venue_id`, `detailDate`, `minPrice`, `createdAt`, `updatedAt`, `estate`, `dateEnd`) VALUES
(1, 6, 1, 1, 'Dinner for two', 100.00, '2012-12-22 00:00:00', '2013-01-26 05:02:31', 6, '2013-01-15 14:00:00'),
(2, 8, 1, 1, 'Year-end dinner', 90.00, '2013-01-10 00:00:00', '2013-01-17 15:45:58', 6, '2013-01-14 00:00:00'),
(3, 7, 3, 2, 'Just', 120.00, '2013-01-29 00:00:00', '2013-01-29 00:00:00', 2, '2013-01-31 00:00:00'),
(4, 8, 2, 3, 'Buffet', 400.00, '2012-12-22 00:00:00', '2013-01-24 14:35:17', 5, '2013-01-15 14:00:00'),
(5, 20, 2, 2, '', 129.00, '2013-01-23 00:00:00', '2013-01-24 15:07:44', 2, '2013-01-30 00:00:00'),
(6, 6, 1, 1, 'Dinner', 35.00, '2013-01-26 16:17:19', '2013-01-26 16:17:19', 1, '2013-01-21 00:00:00'),
(10, 6, 1, 2, 'Dinner', 35.00, '2013-01-26 16:47:15', '2013-01-26 16:47:15', 1, '2013-01-14 00:00:00'),
(28, 22, 2, 2, 'Australian Tour', 20.00, '2013-02-13 10:33:29', '2013-02-13 11:07:13', 3, '2013-02-13 11:07:00'),
(29, 22, 1, 2, 'Dinner', 35.00, '2013-02-13 16:44:49', '2013-02-13 16:47:20', 3, '2013-02-13 00:00:00'),
(30, 22, 1, 1, 'Dinner', 35.00, '2013-02-18 11:33:19', '2013-02-18 11:33:19', 2, '2013-02-22 21:30:00'),
(31, 22, 1, 3, 'Dinner', 35.00, '2013-02-22 15:07:27', '2013-02-22 15:07:27', 2, '2013-02-13 01:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `interest`
--

INSERT INTO `interest` (`id`, `name`) VALUES
(1, 'Poesia'),
(2, 'Musica');

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
-- Estructura de tabla para la tabla `jvj_suburb`
--

CREATE TABLE IF NOT EXISTS `jvj_suburb` (
  `id` int(11) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `long` decimal(10,6) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jvj_suburb`
--

INSERT INTO `jvj_suburb` (`id`, `name`, `lat`, `long`, `district_id`) VALUES
(1, 'Hunters Hill', -33.833981, 151.144648, 1),
(2, 'Sidney', -33.867489, 151.206994, 1),
(3, 'Surry Hills', -33.890646, 151.212918, 1),
(4, 'Norwood', -34.927292, 138.627908, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `jvj_user`
--

INSERT INTO `jvj_user` (`id`, `username`, `salt`, `password`, `email`, `codeActivation`, `is_active`, `face`, `member_id`) VALUES
(7, 'jhanice', '0540ec1cabc0d9707ecb6f7a9786da73', 'f8113411200f3df1fba8f6406f390226c68515c5', 'jhaniceasdf@gmail.com', 'ze65lfbwhqhz59aczm8v89smdshi9y1lpyhrz0mv', 1, '6.', 6),
(8, 'mar', '3cf3fe64c34c28a779bf02dcd107752e', 'fc417051e6cb225f14827a48170362d195e0aa86', 'marasdfasdf@gmail.com', 'bkroxriypaloa89old53ns46drlo4u5wdmjr1mv4', 1, '7.', 7),
(9, 'mari', 'e8a692ca88c66123798ab6803b864e41', '238a83dcf8884b11588771cdcb43b13eb8c3a9ad', 'marasdfiasdf@gmail.com', 'yyqtjt3fvevjkbdwobicz53t6s608db4jlzj3anj', 1, '8.', 8),
(20, 'javier', '4d63510ff96dcebeab464bb49f94baea', '75d519b0da06e7e9e80f26c48e1c2784b329854b', 'jhanice@gmail.com', '5y4v1jxrlum50x0y004zg1n4kavr81pv678wyurn', 0, NULL, 19),
(21, 'wsegurar', '286fd9350690a4a1d42f0f2079fac464', 'ad82f722ae1310a245159ef0df0060a54f64ab1d', 'wsegurar@gmail.com', '8u8w3a20omhaxpvxft4poyq6o7zt094bq7udrf4y', 1, '20.', 20),
(22, 'carlo', '23ee3d6b96a692b205ca59ac25cf8756', '04833da1c1b99b838f123f563387806ea6eaedd1', 'carlo_uni@hotmail.com', 'jz9ggjju9inkf43mbpddp9a4wtd0jqkt3olmpu8d', 0, NULL, 21),
(23, 'pedrotlx', 'ef2a8c16031608a88464b9063b712531', 'e949fe6137f5295f6b62215b5eaef1ebb6b857cc', 'pedrotlx@gmail.com', '9z313v7w7jb03nqwvocdd3jx84olinktgl9o3jwh', 1, NULL, 22);

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
  `height` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `eyeColour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hairColour` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `datePreference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `smoker` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `children` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profession` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personality` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_70E4FA78A76ED395` (`user_id`),
  KEY `IDX_70E4FA785D83CC1` (`state_id`),
  KEY `IDX_70E4FA78F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `member`
--

INSERT INTO `member` (`id`, `state_id`, `country_id`, `firstName`, `lastName`, `street`, `postCode`, `phone`, `mobile`, `dateOfBirth`, `gender`, `user_id`, `height`, `eyeColour`, `hairColour`, `datePreference`, `smoker`, `children`, `relationship`, `profession`, `personality`, `image`, `path`) VALUES
(6, 1, 1, 'Jhanice', 'jah', 'hola', '2323', '7978', '87867', '1922-01-01 00:00:00', 'f', 7, '150', 'brown', 'blond', 'm', 'no', 'yes', 'engaged', 'tba', 'shy', '', '6.'),
(7, 1, 1, 'Diana', '', '', '', '', '', '1938-01-01 00:00:00', 'f', 8, '180', 'brown', 'black', 'm', 'yes', 'yes', 'single', '-', 'locuas', '', '7.'),
(8, 1, 1, 'María', 'mar', 'jsjd', '2323', '2323', '232323', '1927-01-01 00:00:00', 'f', 9, '0', '', '', 'f', '', '', '', '', '', '', ''),
(19, 1, 1, 'Javier', 'javier', 'lkjj', 'lkj', 'kl', 'lk', '1920-01-01 00:00:00', 'm', 20, '0', '', '', 'f', '', '', '', '', '', '', ''),
(20, 1, 1, 'Wilmer', 'segura', 'lima', 'lima29', '344545', '5454545', '1980-11-01 00:00:00', 'm', 21, '1', 'brown', 'black', 'f', 'no', 'no', 'single', 'tba', 'mi personalidad', '', '20.'),
(21, 1, 1, 'Carlo', 'Cardenas', 'Pohlman St', 'LIMA 14', '989050170', '989050170', '1927-06-11 00:00:00', 'm', 22, '160', 'brown', 'blond', 'm', 'yes', 'no', 'divorced', 'tba', 'friendly', '', ''),
(22, 1, 1, 'Pedro', 'Pairazaman', 'asdf', 'asdf', '1234', '1234', '1920-01-01 00:00:00', 'm', 23, '174', 'Black', 'Black', 'f', 'yes', 'yes', 'Single', 'tba', 'lol', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `member_interest`
--

CREATE TABLE IF NOT EXISTS `member_interest` (
  `member_id` int(11) NOT NULL,
  `interest_id` int(11) NOT NULL,
  PRIMARY KEY (`member_id`,`interest_id`),
  KEY `IDX_9BE3B98D7597D3FE` (`member_id`),
  KEY `IDX_9BE3B98D5A95FF89` (`interest_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `member_interest`
--

INSERT INTO `member_interest` (`member_id`, `interest_id`) VALUES
(6, 2),
(7, 1),
(7, 2),
(20, 2),
(21, 1),
(22, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `messsage`
--

CREATE TABLE IF NOT EXISTS `messsage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bodyMessage` longtext COLLATE utf8_unicode_ci NOT NULL,
  `imessage` smallint(6) NOT NULL,
  `estate` smallint(6) NOT NULL,
  `createdAt` datetime NOT NULL,
  `memberOf_id` int(11) DEFAULT NULL,
  `memberFor_id` int(11) DEFAULT NULL,
  `dateJust_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E37D2AE33A61D03F` (`memberOf_id`),
  KEY `IDX_E37D2AE3C38EA514` (`memberFor_id`),
  KEY `IDX_E37D2AE3F85000AD` (`dateJust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `messsage`
--

INSERT INTO `messsage` (`id`, `subject`, `bodyMessage`, `imessage`, `estate`, `createdAt`, `memberOf_id`, `memberFor_id`, `dateJust_id`) VALUES
(31, 'Hi', 'Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo', 0, 1, '2013-01-24 14:41:14', 7, 6, 1),
(32, 'Reply - Hi', 'Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo Lorep ipsum as doleo', 31, 1, '2013-01-24 16:41:32', 7, 6, NULL),
(33, 'Hi Resp', 'hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum hi Lorep Ipsum', 0, 2, '2013-01-24 14:47:31', 6, 7, 1),
(34, 'Test', 'message for testing', 0, 2, '2013-01-25 21:11:48', 7, 6, 1);

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
(1, 'Dinner', 35.00, 1),
(2, 'Australian Tour', 20.00, 1),
(3, 'New Zealand Tour', 35.00, 2),
(4, 'Camping', 20.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ocassionvenue`
--

CREATE TABLE IF NOT EXISTS `ocassionvenue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocassion_id` int(11) DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_EB267AC4505C875F` (`ocassion_id`),
  KEY `IDX_EB267AC440A73EBA` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

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
-- Estructura de tabla para la tabla `ocassion_venue`
--

CREATE TABLE IF NOT EXISTS `ocassion_venue` (
  `ocassion_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  PRIMARY KEY (`ocassion_id`,`venue_id`),
  KEY `IDX_F96B3AE4505C875F` (`ocassion_id`),
  KEY `IDX_F96B3AE440A73EBA` (`venue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ocassion_venue`
--

INSERT INTO `ocassion_venue` (`ocassion_id`, `venue_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 4);

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
  `ocassion_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_42C8495540A73EBA` (`venue_id`),
  KEY `IDX_42C84955F85000AD` (`dateJust_id`),
  KEY `IDX_42C84955505C875F` (`ocassion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `venue_id`, `codeReservation`, `fecha`, `estate`, `dateJust_id`, `ocassion_id`) VALUES
(1, 1, 'J2000011', '2013-01-25 20:00:00', 4, 1, 1),
(2, 1, 'JURRRR90', '2013-01-20 00:00:00', 1, 2, 1),
(3, 2, 'J2000012', '2013-02-05 00:00:00', 2, 3, 2),
(4, 2, 'JR23232', '2013-02-13 00:00:00', 1, 5, 2),
(5, 2, '434533', '2013-01-14 00:00:00', 1, 10, 1),
(23, 2, '162814', '2013-02-28 00:00:00', 2, 28, 2),
(24, 2, '719601', '2013-02-13 00:00:00', 2, 29, 1),
(25, 1, '107388', '2013-02-23 00:00:00', 1, 30, 1),
(26, 3, '819659', '2013-02-14 00:00:00', 1, 31, 1);

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
(20, 2),
(21, 2),
(22, 2),
(23, 2);

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
  `suburb_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lat` decimal(10,6) NOT NULL,
  `long` decimal(10,6) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91911B0D5126AC48` (`mail`),
  KEY `IDX_91911B0DF92F3E70` (`country_id`),
  KEY `IDX_91911B0DAE80F5DF` (`department_id`),
  KEY `IDX_91911B0DB08FA272` (`district_id`),
  KEY `suburb_id` (`suburb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `venue`
--

INSERT INTO `venue` (`id`, `country_id`, `department_id`, `district_id`, `suburb_id`, `name`, `address`, `mail`, `phone`, `contact`, `image`, `details`, `lat`, `long`) VALUES
(1, 1, 1, 1, 1, 'Five Spices Restaurant', '54 Alexandra St \nHunters Hill NSW 2110', 'info@fivespices.net.au', '(02) 9879 3200', 'John Dobson', 'img1.png', 'venue1.png', -33.834939, 151.155534),
(2, 1, 1, 1, 1, 'Sydney Showboats', 'KIng Street Wharf 5\n32 The Promenade ', 'res@sydneyshowboats.com.au', '(02) 8296 7200', 'Edna Everage', 'img2.png', 'venue2.png', -33.867823, 151.201433),
(3, 1, 1, 1, 2, 'MoVida', '50 Holt St \nSurry Hills NSW 2010', 'contact@movida.com.au', '(02) 8296 7200', 'Henry Parkes', 'img3.png', 'venue3.png', -33.886404, 151.209302),
(4, 1, 1, 1, 1, 'Adventure Tours', '72 The Parade, Norwood, South Australia, 5067', 'webenquiry@adventuretours.com.au', '(08) 8132 8230', 'Elle MacPherson', 'img4.png', 'venue4.png', -34.921615, 138.629646);

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
-- Filtros para la tabla `jvj_suburb`
--
ALTER TABLE `jvj_suburb`
  ADD CONSTRAINT `jvj_suburb_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `jvj_district` (`id`);

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
  ADD CONSTRAINT `FK_9BE3B98D5A95FF89` FOREIGN KEY (`interest_id`) REFERENCES `interest` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_9BE3B98D7597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `messsage`
--
ALTER TABLE `messsage`
  ADD CONSTRAINT `FK_E37D2AE33A61D03F` FOREIGN KEY (`memberOf_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_E37D2AE3C38EA514` FOREIGN KEY (`memberFor_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_E37D2AE3F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Filtros para la tabla `ocassion`
--
ALTER TABLE `ocassion`
  ADD CONSTRAINT `FK_DD8EB90C9395A88E` FOREIGN KEY (`categoryOcassion_id`) REFERENCES `category_ocassion` (`id`);

--
-- Filtros para la tabla `ocassionvenue`
--
ALTER TABLE `ocassionvenue`
  ADD CONSTRAINT `FK_EB267AC440A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_EB267AC4505C875F` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`);

--
-- Filtros para la tabla `ocassion_venue`
--
ALTER TABLE `ocassion_venue`
  ADD CONSTRAINT `FK_F96B3AE440A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_F96B3AE4505C875F` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495540A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_42C84955505C875F` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`),
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
  ADD CONSTRAINT `FK_91911B0DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`),
  ADD CONSTRAINT `venue_ibfk_1` FOREIGN KEY (`suburb_id`) REFERENCES `jvj_suburb` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
