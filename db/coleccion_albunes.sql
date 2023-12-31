-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-07-2023 a las 05:17:04
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `coleccion_albunes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `genero` text NOT NULL,
  `id_artista` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `album`
--

INSERT INTO `album` (`id`, `nombre`, `genero`, `id_artista`) VALUES
(1, 'Abbey Road', 'Rock', 1),
(3, 'Sgt. Pepper\'s Lonely Hearts Club Band', 'Rock', 1),
(4, 'Led Zeppelin IV', 'Rock', 2),
(5, 'Physical Graffiti', 'Rock', 2),
(6, 'Houses of the Holy', 'Rock', 2),
(7, 'The Dark Side of the Moon', 'Rock', 3),
(8, 'Wish You Were Here', 'Rock', 3),
(9, 'The Wall', 'Rock', 3),
(10, 'Exile on Main St.', 'Rock', 4),
(11, 'Sticky Fingers', 'Rock', 4),
(12, 'Let It Bleed', 'Rock', 4),
(13, 'Who´s Next', 'Rock', 5),
(14, 'Quadrophenia', 'Rock', 5),
(15, 'Tommy', 'Rock', 5),
(16, 'Are You Experience', 'Rock', 6),
(17, 'Axis: Bold as Love', 'Rock', 6),
(18, 'Electric Ladyland', 'Rock', 6),
(19, 'Master of Puppets', 'Rock', 7),
(20, 'Ride the Lightning', 'Rock', 7),
(21, 'The Black Album', 'Rock', 7),
(22, 'The Colours and the Shape', 'Rock', 8),
(23, 'Wasting Light', 'Rock', 8),
(24, 'Echoes, Silence, Pätience & Grace', 'Rock', 8),
(25, 'Ten', 'Rock', 9),
(26, 'VS', 'Rock', 9),
(27, 'Vitalogy', 'Rock', 9),
(28, 'The Doors', 'Rock', 10),
(29, 'Strange Days', 'Rock', 10),
(30, 'L.A. Woman', 'Rock', 10),
(31, 'Paranoid', 'Rock', 11),
(32, 'Master of Reality', 'Rock', 11),
(33, 'Black Sabbath', 'Rock', 11),
(37, 'Toys in the Attic', 'Rock', 12),
(38, 'Rocks', 'Rock', 12),
(39, 'Permanent Vacation', 'Rock', 12),
(40, 'Blood Sugar Sex Magic', 'Rock', 13),
(41, 'Californication', 'Rock', 13),
(42, 'By the Way', 'Rock', 13),
(43, 'Whatever People Say I Am Thats What Im Not', 'Rock', 14),
(44, 'AM', 'Rock', 14),
(45, 'Favourite Worst Nightmare', 'Rock', 14),
(46, 'Is This It', 'Rock', 15),
(47, 'Room on Fire', 'Rock', 15),
(48, 'Angles', 'Rock', 15),
(52, 'Absolution', 'Rock', 16),
(53, 'Black Holes and Revelations', 'Rock', 16),
(54, 'the Resistance', 'Rock', 16),
(55, 'Nevermind', 'Rock', 17),
(56, 'In Utero', 'Rock', 17),
(57, 'MTV Unplugged In New York', 'Rock', 17),
(58, 'A Night at the Opera', 'Rock', 18),
(59, 'News of the World', 'Rock', 18),
(60, 'The Game', 'Rock', 18),
(61, 'Appetite for Destruction', 'Rock', 19),
(62, 'Use Your Illusion I', 'Rock', 19),
(63, 'Use Your Illusion II', 'Rock', 19),
(64, 'Back in Black', 'Rock', 20),
(65, 'Highway to Heññ', 'Rock', 20),
(66, 'For Those About to Rock We Salute You', 'Rock', 20),
(67, 'Beggars Banquet', 'Rock', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artista`
--

CREATE TABLE `artista` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `genero` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `artista`
--

INSERT INTO `artista` (`id`, `nombre`, `genero`) VALUES
(1, 'The Beatles', 'Rock'),
(2, 'Led Zeppelin', 'Rock'),
(3, 'Pink Floyd', 'Rock'),
(4, 'The Rolling Stones', 'Rock'),
(5, 'The Who', 'Rock'),
(6, 'Jimi Hendrix', 'Rock'),
(7, 'Metallica', 'Rock'),
(8, 'Foo Fighters', 'Rock'),
(9, 'Pearl Jam', 'Rock'),
(10, 'The Doors', 'Rock'),
(11, 'Black Sabbath', 'Rock'),
(12, 'Aerosmith', 'Rock'),
(13, 'Red Hot Chili Peppers', 'Rock'),
(14, 'Arctic Monkeys', 'Rock'),
(15, 'The Strokes', 'Rock'),
(16, 'Muse', 'Rock'),
(17, 'Nirvana', 'Rock'),
(18, 'Queen', 'Rock'),
(19, 'Guns N\' Roses', 'Rock'),
(20, 'AC/DC', 'Rock'),
(22, 'Rage Against the Machine', 'Rock');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'manuel', 'manuel90@gmail.com', '123456'),
(2, 'userDos', 'usuario@usuario.com', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

CREATE TABLE `valoracion` (
  `id` int(11) NOT NULL,
  `valoracion` int(1) NOT NULL,
  `id_album` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id`, `valoracion`, `id_album`, `id_usuario`) VALUES
(1, 4, 67, 1),
(3, 5, 1, 1),
(4, 5, 3, 1),
(5, 4, 4, 1),
(6, 2, 5, 1),
(7, 5, 6, 1),
(8, 3, 7, 1),
(9, 5, 8, 1),
(10, 3, 9, 1),
(11, 2, 10, 1),
(12, 1, 11, 1),
(13, 5, 12, 1),
(14, 1, 67, 1),
(15, 3, 13, 1),
(16, 5, 14, 1),
(17, 3, 15, 1),
(18, 5, 16, 1),
(19, 1, 17, 1),
(20, 4, 18, 1),
(21, 4, 19, 1),
(22, 5, 20, 1),
(23, 2, 21, 1),
(24, 1, 22, 1),
(25, 1, 23, 1),
(26, 1, 24, 1),
(27, 3, 25, 1),
(28, 2, 26, 1),
(29, 4, 27, 1),
(30, 3, 28, 1),
(31, 2, 29, 1),
(32, 1, 30, 1),
(33, 3, 31, 1),
(34, 4, 32, 1),
(35, 3, 33, 1),
(36, 3, 37, 1),
(37, 5, 38, 1),
(38, 4, 39, 1),
(39, 1, 40, 1),
(40, 1, 41, 1),
(41, 1, 42, 1),
(42, 2, 43, 1),
(43, 4, 44, 1),
(44, 5, 45, 1),
(45, 5, 46, 1),
(46, 4, 47, 1),
(47, 5, 48, 1),
(48, 1, 52, 1),
(49, 1, 53, 1),
(50, 4, 54, 1),
(51, 2, 55, 1),
(52, 5, 56, 1),
(53, 3, 57, 1),
(54, 3, 58, 1),
(55, 1, 59, 1),
(56, 1, 60, 1),
(57, 2, 61, 1),
(58, 1, 62, 1),
(59, 3, 63, 1),
(60, 2, 64, 1),
(61, 1, 65, 1),
(62, 2, 66, 1),
(66, 1, 1, 2),
(67, 1, 3, 2),
(68, 5, 4, 2),
(69, 2, 5, 2),
(70, 5, 6, 2),
(71, 4, 7, 2),
(72, 4, 8, 2),
(73, 3, 9, 2),
(74, 3, 10, 2),
(75, 2, 11, 2),
(76, 3, 12, 2),
(77, 3, 67, 2),
(78, 5, 13, 2),
(79, 2, 14, 2),
(80, 2, 15, 2),
(81, 5, 16, 2),
(82, 3, 17, 2),
(83, 1, 18, 2),
(84, 3, 19, 2),
(85, 2, 20, 2),
(86, 5, 21, 2),
(87, 2, 22, 2),
(88, 2, 23, 2),
(89, 3, 24, 2),
(90, 4, 25, 2),
(91, 4, 26, 2),
(92, 2, 27, 2),
(93, 2, 28, 2),
(94, 5, 29, 2),
(95, 4, 30, 2),
(96, 3, 31, 2),
(97, 2, 32, 2),
(98, 3, 33, 2),
(99, 3, 37, 2),
(100, 5, 38, 2),
(101, 2, 39, 2),
(102, 1, 40, 2),
(103, 2, 41, 2),
(104, 1, 42, 2),
(105, 3, 43, 2),
(106, 5, 44, 2),
(107, 3, 45, 2),
(108, 2, 46, 2),
(109, 2, 47, 2),
(110, 3, 48, 2),
(111, 5, 52, 2),
(112, 4, 53, 2),
(113, 2, 54, 2),
(114, 4, 55, 2),
(115, 5, 56, 2),
(116, 4, 57, 2),
(117, 2, 58, 2),
(118, 2, 59, 2),
(119, 3, 60, 2),
(120, 3, 61, 2),
(121, 2, 62, 2),
(122, 2, 63, 2),
(123, 1, 64, 2),
(124, 1, 65, 2),
(125, 5, 66, 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artista` (`id_artista`);

--
-- Indices de la tabla `artista`
--
ALTER TABLE `artista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_album` (`id_album`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT de la tabla `artista`
--
ALTER TABLE `artista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `valoracion`
--
ALTER TABLE `valoracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_artista`) REFERENCES `artista` (`id`);

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`id_album`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `valoracion_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
