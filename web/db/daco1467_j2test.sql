-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 04, 2013 at 06:52 AM
-- Server version: 5.1.65-cll
-- PHP Version: 5.3.18

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `daco1467_j2test`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
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
-- Table structure for table `bid`
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
-- Dumping data for table `bid`
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

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- --------------------------------------------------------

--
-- Table structure for table `date_just`
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
  `endBid` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_544174247597D3FE` (`member_id`),
  KEY `IDX_54417424505C875F` (`ocassion_id`),
  KEY `IDX_5441742440A73EBA` (`venue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `date_just`
--

INSERT INTO `date_just` (`id`, `member_id`, `ocassion_id`, `venue_id`, `detailDate`, `minPrice`, `createdAt`, `updatedAt`, `estate`, `endBid`) VALUES
(1, 6, 1, 1, 'cena para dos con cosas', '100.00', '2012-12-22 00:00:00', '2012-12-27 16:13:20', 2, '2013-01-15 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jvj_country`
--

CREATE TABLE IF NOT EXISTS `jvj_country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jvj_country`
--

INSERT INTO `jvj_country` (`id`, `name`) VALUES
(1, 'peru');

-- --------------------------------------------------------

--
-- Table structure for table `jvj_department`
--

CREATE TABLE IF NOT EXISTS `jvj_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(11) DEFAULT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_92F4AB5BF92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jvj_department`
--

INSERT INTO `jvj_department` (`id`, `country_id`, `name`) VALUES
(1, 1, 'lima');

-- --------------------------------------------------------

--
-- Table structure for table `jvj_district`
--

CREATE TABLE IF NOT EXISTS `jvj_district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `Department_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_90EA4B461DFEBE2A` (`Department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `jvj_district`
--

INSERT INTO `jvj_district` (`id`, `name`, `Department_id`) VALUES
(1, 'chorrillos', 1);

-- --------------------------------------------------------

--
-- Table structure for table `jvj_role`
--

CREATE TABLE IF NOT EXISTS `jvj_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CEB0A75B57698A6A` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `jvj_role`
--

INSERT INTO `jvj_role` (`id`, `name`, `role`) VALUES
(1, 'Administrador', 'ROLE_ADMIN'),
(2, 'User', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Table structure for table `jvj_user`
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `jvj_user`
--

INSERT INTO `jvj_user` (`id`, `username`, `salt`, `password`, `email`, `codeActivation`, `is_active`, `face`, `member_id`) VALUES
(7, 'jhanice', 'c414b50843e59213722f18d353abb3c2', '9c1dcee0282e63d439557bfca42fbfb556379234', 'javiervilcapazsa@gmail.com', 'ze65lfbwhqhz59aczm8v89smdshi9y1lpyhrz0mv', 1, NULL, 6),
(8, 'mar', '3cf3fe64c34c28a779bf02dcd107752e', 'fc417051e6cb225f14827a48170362d195e0aa86', 'marasdfasdf@gmail.com', 'bkroxriypaloa89old53ns46drlo4u5wdmjr1mv4', 1, NULL, 7),
(9, 'mari', 'e8a692ca88c66123798ab6803b864e41', '238a83dcf8884b11588771cdcb43b13eb8c3a9ad', 'marasdfiasdf@gmail.com', 'yyqtjt3fvevjkbdwobicz53t6s608db4jlzj3anj', 1, NULL, 8),
(10, 'wsegurar', '686eec3c473459c58aead1ca4089939f', '0a40771d59c42aecf4a5a5a5cf67fe184bc0ed11', 'wsegurar@gmail.com', '5kdc524il9775wvcbvnis2yh3iy18nlmmi6cju5p', 1, NULL, 9),
(11, 'jha', '718e6a5d4602cd98c86b82333dab2298', '4c06a308d4397bb9a0cda2c16353c6a51e9d8c5a', 'jhanices@gmail.com', '0a3vovetvvft2ltg1r1216nt24cqw60n6xa80brk', 1, NULL, 10),
(12, 'jhannii', '5356791cfff64e933487b277a0a50857', 'd7a35adf4f045b483c773c0fd67a87098835ae71', 'jhanicess@gmail.com', '1e9wnlr29ibn32lp10fawglbnekxv9a8dwu3rz1o', 1, NULL, 11),
(21, 'maris', '8f38e523c8557cf41c0217e098b6939c', 'c1c84a7a88a08121a99b9f9dbc066e31470b6617', 'jhanice@gmail.com', 'mhx83a2dl5m54w4avahkz9xogzrdvyqqr9w1s3ih', 1, NULL, 20);

-- --------------------------------------------------------

--
-- Table structure for table `member`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_70E4FA78A76ED395` (`user_id`),
  KEY `IDX_70E4FA785D83CC1` (`state_id`),
  KEY `IDX_70E4FA78F92F3E70` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `state_id`, `country_id`, `firstName`, `lastName`, `street`, `postCode`, `phone`, `mobile`, `dateOfBirth`, `gender`, `user_id`) VALUES
(6, 1, 1, 'jah', 'jah', 'hola', '2323', '7978', '87867', '1922-01-01 00:00:00', 'M', 7),
(7, 1, 1, 'mar', 'mar', 'jsjd', '2323', '2323', '232323', '1927-01-01 00:00:00', 'm', 8),
(8, 1, 1, 'mar', 'mar', 'jsjd', '2323', '2323', '232323', '1927-01-01 00:00:00', 'm', 9),
(9, 1, 1, 'wilmer', 'segura ramirez', 'san juan de miraflores', 'lima29', '45454', '45454', '1981-01-11 00:00:00', 'm', 10),
(10, 1, 1, 'jav', 'jav', 'jjjs', '89', '878', '7878', '1920-01-01 00:00:00', 'm', 11),
(11, 1, 1, 'jav', 'jav', 'jjjs', '89', '878', '7878', '1920-01-01 00:00:00', 'm', 12),
(20, 1, 1, 'sd', 'jkl', 'jkl', 'jkl', 'lkjl', 'kj', '1920-01-01 00:00:00', 'm', 21);

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



-- --------------------------------------------------------

--
-- Table structure for table `reservation`
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
-- Table structure for table `user_group`
--

CREATE TABLE IF NOT EXISTS `user_group` (
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`group_id`),
  KEY `IDX_8F02BF9DA76ED395` (`user_id`),
  KEY `IDX_8F02BF9DFE54D947` (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`user_id`, `group_id`) VALUES
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(21, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
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
-- Table structure for table `venue`
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
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_91911B0D5126AC48` (`mail`),
  KEY `IDX_91911B0DF92F3E70` (`country_id`),
  KEY `IDX_91911B0DAE80F5DF` (`department_id`),
  KEY `IDX_91911B0DB08FA272` (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `country_id`, `department_id`, `district_id`, `name`, `address`, `mail`, `phone`, `contact`) VALUES
(1, 1, 1, 1, 'Rustica', 'Jr kuie', 'rusticachorillos@gmail.com', '3245623', 'Juan Villegas');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `FK_DEE4F593DC36EFAF` FOREIGN KEY (`winningMember_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_DEE4F593F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `FK_4AF2B3F37597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`),
  ADD CONSTRAINT `FK_4AF2B3F3F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Constraints for table `date_just`
--
ALTER TABLE `date_just`
  ADD CONSTRAINT `FK_5441742440A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_54417424505C875F` FOREIGN KEY (`ocassion_id`) REFERENCES `ocassion` (`id`),
  ADD CONSTRAINT `FK_544174247597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `jvj_department`
--
ALTER TABLE `jvj_department`
  ADD CONSTRAINT `FK_92F4AB5BF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

--
-- Constraints for table `jvj_district`
--
ALTER TABLE `jvj_district`
  ADD CONSTRAINT `FK_90EA4B461DFEBE2A` FOREIGN KEY (`Department_id`) REFERENCES `jvj_department` (`id`);

--
-- Constraints for table `jvj_user`
--
ALTER TABLE `jvj_user`
  ADD CONSTRAINT `FK_144AFB787597D3FE` FOREIGN KEY (`member_id`) REFERENCES `member` (`id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `FK_70E4FA78A76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`),
  ADD CONSTRAINT `FK_70E4FA785D83CC1` FOREIGN KEY (`state_id`) REFERENCES `jvj_department` (`id`),
  ADD CONSTRAINT `FK_70E4FA78F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

--
-- Filtros para la tabla `ocassion`
--
ALTER TABLE `ocassion`
  ADD CONSTRAINT `FK_DD8EB90C9395A88E` FOREIGN KEY (`categoryOcassion_id`) REFERENCES `category_ocassion` (`id`);




-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_42C8495540A73EBA` FOREIGN KEY (`venue_id`) REFERENCES `venue` (`id`),
  ADD CONSTRAINT `FK_42C84955F85000AD` FOREIGN KEY (`dateJust_id`) REFERENCES `date_just` (`id`);

--
-- Constraints for table `user_group`
--
ALTER TABLE `user_group`
  ADD CONSTRAINT `FK_8F02BF9DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8F02BF9DFE54D947` FOREIGN KEY (`group_id`) REFERENCES `jvj_role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `jvj_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `jvj_role` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `venue`
--
ALTER TABLE `venue`
  ADD CONSTRAINT `FK_91911B0DAE80F5DF` FOREIGN KEY (`department_id`) REFERENCES `jvj_department` (`id`),
  ADD CONSTRAINT `FK_91911B0DB08FA272` FOREIGN KEY (`district_id`) REFERENCES `jvj_district` (`id`),
  ADD CONSTRAINT `FK_91911B0DF92F3E70` FOREIGN KEY (`country_id`) REFERENCES `jvj_country` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- Filtros para la tabla `ocassionvenue`
--
ALTER TABLE `ocassionvenue`
  ADD CONSTRAINT `fk_ocassion` FOREIGN KEY (`id`) REFERENCES `ocassion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_venue` FOREIGN KEY (`id`) REFERENCES `venue` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;