-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-04-2016 a las 18:14:55
-- Versión del servidor: 5.5.46-0ubuntu0.14.04.2
-- Versión de PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `yii_2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'value 1 disponilble para su descarga',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `files`
--

INSERT INTO `files` (`id`, `name`, `status`) VALUES
(1, 'ACTA1.doc', 1),
(2, 'ACTA2.doc', 1),
(3, 'ACTAS DE INVERSIONES JD.doc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `folders`
--

CREATE TABLE IF NOT EXISTS `folders` (
  `idFolder` int(11) NOT NULL AUTO_INCREMENT,
  `nameFolder` varchar(100) NOT NULL,
  `cant_files` int(11) NOT NULL,
  `ruta` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `id_files` int(11) NOT NULL,
  PRIMARY KEY (`idFolder`),
  KEY `id_files` (`id_files`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `folders`
--

INSERT INTO `folders` (`idFolder`, `nameFolder`, `cant_files`, `ruta`, `logo`, `id_files`) VALUES
(1, 'db_updates', 104, '/var/www/html/advanced/', '', 1),
(2, 'views', 12, '/var/www/html/advanced/frontend', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1460780249),
('m130524_201442_init', 1460780252);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Volcado de datos para la tabla `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `password`, `email`) VALUES
(1, 'test1', 'pass1', 'test1@example.com'),
(2, 'test2', 'pass2', 'test2@example.com'),
(3, 'test3', 'pass3', 'test3@example.com'),
(4, 'test4', 'pass4', 'test4@example.com'),
(5, 'test5', 'pass5', 'test5@example.com'),
(6, 'test6', 'pass6', 'test6@example.com'),
(7, 'test7', 'pass7', 'test7@example.com'),
(8, 'test8', 'pass8', 'test8@example.com'),
(9, 'test9', 'pass9', 'test9@example.com'),
(10, 'test10', 'pass10', 'test10@example.com'),
(11, 'test11', 'pass11', 'test11@example.com'),
(12, 'test12', 'pass12', 'test12@example.com'),
(13, 'test13', 'pass13', 'test13@example.com'),
(14, 'test14', 'pass14', 'test14@example.com'),
(15, 'test15', 'pass15', 'test15@example.com'),
(16, 'test16', 'pass16', 'test16@example.com'),
(17, 'test17', 'pass17', 'test17@example.com'),
(18, 'test18', 'pass18', 'test18@example.com'),
(19, 'test19', 'pass19', 'test19@example.com'),
(20, 'test20', 'pass20', 'test20@example.com'),
(21, 'test21', 'pass21', 'test21@example.com'),
(24, 'angel manuel modify', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'angel_manu_modi@gmail.com'),
(25, 'koritohern', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'koritoher@gmail.com'),
(26, 'usertesty', '1234', 'usertesty@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` int(11) NOT NULL DEFAULT '1' COMMENT 'value 1 para user simple y 2 para admin',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'yane223', '0V_ydU9jymLwqrVprSKsp4Rxtn2w2WRz', '$2y$13$wMVjaozqla09NG0Kk0O4VuLkew2iF80n45LGx1usBL19kEcw4cZce', NULL, 'coro798@gmail.com', 10, 2, 1460984361, 1460984361),
(2, 'testy2', 'Bf4JzKS33ZzYIT2Q7fCue5txg6IGsxZy', '$2y$13$eshXFNV8ZwZTES2uQPOnmeJLLV83W/E/FoCoKZ3OKCizebZ4XI3ka', NULL, 'testy2@dd.com', 10, 1, 1461006082, 1461006082);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_otros`
--

CREATE TABLE IF NOT EXISTS `user_otros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `role` int(11) NOT NULL DEFAULT '1' COMMENT 'value 1 para user simple y 2 para admin',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_otros`
--

INSERT INTO `user_otros` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `role`, `created_at`, `updated_at`) VALUES
(1, 'testy', 'Bf4JzKS33ZzYIT2Q7fCue5txg6IGsxZy', '$2y$13$eshXFNV8ZwZTES2uQPOnmeJLLV83W/E/FoCoKZ3OKCizebZ4XI3ka', NULL, 'testy@gmil.com', 10, 2, 1461005321, 1461005321),
(2, 'koro22', '0V_ydU9jymLwqrVprSKsp4Rxtn2w2WRz', '$2y$13$wMVjaozqla09NG0Kk0O4VuLkew2iF80n45LGx1usBL19kEcw4cZce', NULL, 'coro7981@gmail.com', 10, 1, 1460984361, 1460984361);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`id_files`) REFERENCES `files` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
