-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2019 a las 00:34:43
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prueba-crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `last_login` datetime NOT NULL DEFAULT current_timestamp(),
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$1$Dtqyvz7/$wZSaZbfHgn0UbLlVi1HHp0', 'Admin', '2019-09-12 00:19:26', '2019-09-10 10:35:16', '2019-09-10 10:35:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_authentication`
--

CREATE TABLE `users_authentication` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visitas`
--

CREATE TABLE `visitas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `celular` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `motivo_visita` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `visitas`
--

INSERT INTO `visitas` (`id`, `nombre`, `correo`, `celular`, `comentario`, `motivo_visita`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@admin.com', 2147483647, 'Hola, soy el administrador', 'Compra', '2019-09-10 16:15:44', '2019-09-11 04:28:18'),
(4, 'Juan', 'juan@juan.com', 2147483647, 'Hola, vine a hacer una venta', 'Venta', '2019-09-10 16:15:44', '2019-09-10 16:15:44'),
(5, 'Laura', 'laura@laura.com', 14553564, 'Hola, vine a hacer un alquiler', 'Alquiler', '2019-09-10 16:17:35', '2019-09-10 16:17:35'),
(8, 'admin1', 'admi1n@admin.com', 2147483647, 'Hola, soy el administrador v2', 'Compra', '2019-09-11 14:01:38', '2019-09-11 14:01:38');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_authentication`
--
ALTER TABLE `users_authentication`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `visitas`
--
ALTER TABLE `visitas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users_authentication`
--
ALTER TABLE `users_authentication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `visitas`
--
ALTER TABLE `visitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
