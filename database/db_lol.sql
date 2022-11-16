-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2022 a las 04:09:19
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_lol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `champs_table`
--

CREATE TABLE `champs_table` (
  `ID_champ` int(11) NOT NULL,
  `Champ_name` varchar(50) NOT NULL,
  `ID_rol` int(11) NOT NULL,
  `Line_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `champs_table`
--

INSERT INTO `champs_table` (`ID_champ`, `Champ_name`, `ID_rol`, `Line_name`) VALUES
(1, 'Teemo', 1, 'Jungla'),
(2, 'Malzahar', 2, 'MID');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_table`
--

CREATE TABLE `roles_table` (
  `ID_rol` int(11) NOT NULL,
  `Rol_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `roles_table`
--

INSERT INTO `roles_table` (`ID_rol`, `Rol_name`) VALUES
(1, 'Asesino'),
(2, 'Mago');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_table`
--

CREATE TABLE `users_table` (
  `ID_user` int(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users_table`
--

INSERT INTO `users_table` (`ID_user`, `Username`, `email`, `password`) VALUES
(1, 'admin1', 'admin@admin.com', '$2a$12$uBjt/0OBM8F1uRVeICMJueIUT7PAjsSdv3x9meK1wYJTIVxmKRBE.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `champs_table`
--
ALTER TABLE `champs_table`
  ADD PRIMARY KEY (`ID_champ`),
  ADD KEY `ID_rol` (`ID_rol`);

--
-- Indices de la tabla `roles_table`
--
ALTER TABLE `roles_table`
  ADD PRIMARY KEY (`ID_rol`);

--
-- Indices de la tabla `users_table`
--
ALTER TABLE `users_table`
  ADD PRIMARY KEY (`ID_user`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `champs_table`
--
ALTER TABLE `champs_table`
  MODIFY `ID_champ` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `roles_table`
--
ALTER TABLE `roles_table`
  MODIFY `ID_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `users_table`
--
ALTER TABLE `users_table`
  MODIFY `ID_user` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `champs_table`
--
ALTER TABLE `champs_table`
  ADD CONSTRAINT `champs_table_ibfk_1` FOREIGN KEY (`ID_rol`) REFERENCES `roles_table` (`ID_rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
