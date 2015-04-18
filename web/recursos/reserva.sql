-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 29-06-2014 a las 21:44:54
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `reserva`
--
CREATE DATABASE IF NOT EXISTS `reserva` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `reserva`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(50) NOT NULL,
  `address2` varchar(50) DEFAULT NULL,
  `district` varchar(20) NOT NULL,
  `city_id` smallint(5) unsigned NOT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `phone` varchar(20) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`address_id`),
  KEY `idx_fk_city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `address`
--

INSERT INTO `address` (`address_id`, `address`, `address2`, `district`, `city_id`, `postal_code`, `phone`, `last_update`) VALUES
(0, 'Completar', 'Completar', 'Completar', 1, '5000', '0321654987', '2014-06-29 22:08:27'),
(1, 'San Martin 201', NULL, 'Capital', 1, '4000', '3815653265', '2014-05-31 18:24:51');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `prize` int(11) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `description`, `prize`, `last_update`) VALUES
(1, 'Single', 240, '2014-05-31 15:29:34'),
(2, 'Double', 400, '2014-06-06 15:14:44'),
(3, 'Triple', 600, '2014-06-06 15:48:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(50) NOT NULL,
  `country_id` smallint(5) unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`city_id`),
  KEY `idx_fk_country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `city`
--

INSERT INTO `city` (`city_id`, `city`, `country_id`, `last_update`) VALUES
(1, 'Tucuman', 1, '2014-05-31 18:23:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `country_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `country` varchar(50) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `country`
--

INSERT INTO `country` (`country_id`, `country`, `last_update`) VALUES
(1, 'Argentina', '2014-05-31 18:23:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(400) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `address_id` smallint(5) unsigned NOT NULL,
  `usertype` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `idx_fk_address_id` (`address_id`),
  KEY `idx_last_name` (`last_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table storing all customers. Holds foreign keys to the addre' AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `first_name`, `last_name`, `email`, `password`, `active`, `create_date`, `last_update`, `address_id`, `usertype`) VALUES
(1, 'Vanesa', 'Rostand', 'vanerostand@gmail.com', 'O+G31a6tn5O76ExCthQuZK1+YRll45tYyLUivGgrobY=', 1, '2014-05-31 15:25:56', '2014-05-31 18:25:56', 1, 2),
(2, 'Joaquin', 'Nader', 'jnader@convey.com', 'O+G31a6tn5O76ExCthQuZK1+YRll45tYyLUivGgrobY=', 1, '2014-06-03 19:53:15', '2014-06-03 22:53:15', 1, 2),
(3, 'JoaquÃ­n', 'Nader', 'joaquinnader@gmail.com', 'O+G31a6tn5O76ExCthQuZK1+YRll45tYyLUivGgrobY=', 1, '2014-06-29 19:26:26', '2014-06-29 22:26:26', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registration`
--

CREATE TABLE IF NOT EXISTS `registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `since` date NOT NULL,
  `to` date NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `room_id` int(11) NOT NULL,
  `customer_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_registration_room1_idx` (`room_id`),
  KEY `fk_registration_customer1_idx` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `registration`
--

INSERT INTO `registration` (`id`, `since`, `to`, `date`, `status`, `last_update`, `room_id`, `customer_id`) VALUES
(1, '2014-06-02', '2014-06-03', '2014-06-03 19:39:34', 1, '2014-06-03 19:39:34', 1, 1),
(2, '2014-06-04', '2014-06-05', '2014-06-03 19:53:40', 1, '2014-06-03 19:53:40', 1, 2);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `reserva`
--
CREATE TABLE IF NOT EXISTS `reserva` (
`nro` int(11)
,`nombre` varchar(92)
,`habitacion` varchar(45)
,`checkIn` date
,`checkOut` date
,`precio` int(11)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `last_update` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_room_category1_idx` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `room`
--

INSERT INTO `room` (`id`, `number`, `status`, `active`, `last_update`, `category_id`) VALUES
(1, 101, 0, 1, '2014-05-31 15:31:58', 1),
(2, 102, 1, 1, '2014-06-06 14:58:26', 1),
(3, 103, 0, 1, '2014-06-06 15:25:07', 2);

-- --------------------------------------------------------

--
-- Estructura para la vista `reserva`
--
DROP TABLE IF EXISTS `reserva`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `reserva` AS select `res`.`id` AS `nro`,concat(`cu`.`last_name`,', ',`cu`.`first_name`) AS `nombre`,`cat`.`description` AS `habitacion`,`res`.`since` AS `checkIn`,`res`.`to` AS `checkOut`,`cat`.`prize` AS `precio` from (((`registration` `res` join `category` `cat`) join `customer` `cu`) join `room` `ro`) where ((`res`.`room_id` = `ro`.`id`) and (`ro`.`category_id` = `cat`.`id`) and (`res`.`customer_id` = `cu`.`id`) and (`res`.`status` = 1)) order by `res`.`id` desc;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `fk_address_city` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `fk_city_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`country_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_customer_address` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `registration`
--
ALTER TABLE `registration`
  ADD CONSTRAINT `fk_registration_customer1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_registration_room1` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `fk_room_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
