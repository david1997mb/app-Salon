-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-11-2023 a las 22:28:50
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `salon`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `id_area` int(11) NOT NULL,
  `descripcion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`id_area`, `descripcion`) VALUES
(1, 'Pista de Baile'),
(2, 'Comedores De Planta '),
(3, 'Comedores De Mezanin'),
(4, 'Cocina'),
(5, 'Baños'),
(6, 'Deposito Subterráneo'),
(7, 'Cuarto de Tocador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas_reserva`
--

CREATE TABLE `areas_reserva` (
  `id` int(11) NOT NULL,
  `id_area` int(11) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `areas_reserva`
--

INSERT INTO `areas_reserva` (`id`, `id_area`, `id_reserva`) VALUES
(1, 4, 1),
(2, 5, 1),
(3, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(50) NOT NULL,
  `apePat` varchar(50) DEFAULT NULL,
  `apeMat` varchar(50) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `direc` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombres`, `apePat`, `apeMat`, `tel`, `correo`, `direc`) VALUES
(1, 'David Brandon', 'Mamani', 'Barrientos', '72782719', 'david1997mb@gmail.com', 'Waldo Ballivian 625'),
(20, 'Carlo Julio', 'Martinez', 'Gomez', '7589658', 'julio@gmail.com', 'calle Suecia'),
(21, 'Juan Carlos', 'Claros', 'Clemente', '8578855', 'juan@gmail.com', 'innominada'),
(22, 'Alberto ', 'prieto', 'Gonzalez', '7485848', 'alberpadilla@gmail.com', 'quillacollo'),
(23, 'marco', 'Gomez', 'Gonzales', '745854', 'marcogomez@gmail.com', 'suares Miranda 251'),
(24, 'Marcelo', 'Martinez', 'Mercado', '748584', 'marce@homail.com', 'Quillacollo'),
(25, 'marco', 'Gomez', 'Gonzales', '745854', 'marcogomez@gmail.com', 'suares Miranda 251'),
(26, 'Marcelo', 'Martinez', 'Mercado', '748584', 'marce@homail.com', 'Quillacollo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `cuota` int(11) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `metodo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `cuota`, `fecha`, `metodo`) VALUES
(5, 200, '2023-11-15', 'Efectivo'),
(7, 321, '2023-11-01', 'Efectivo'),
(8, 250, '2023-11-10', 'transferencia'),
(9, 152, '2023-11-10', 'transferencia'),
(10, 632, '2023-11-03', 'transferencia'),
(11, 250, '2023-11-02', 'Efectivo'),
(12, 250, '2023-11-10', 'transferencia'),
(13, 152, '2023-11-10', 'transferencia'),
(14, 632, '2023-11-03', 'transferencia'),
(15, 250, '2023-11-02', 'Efectivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reserva`
--

CREATE TABLE `reserva` (
  `id_reserva` int(11) NOT NULL,
  `fechareserva` date DEFAULT NULL,
  `tipoevento` varchar(30) DEFAULT NULL,
  `fechaevento` date DEFAULT NULL,
  `invitados` int(11) DEFAULT NULL,
  `inicio` time DEFAULT NULL,
  `final` time DEFAULT NULL,
  `costototal` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pago` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `fechareserva`, `tipoevento`, `fechaevento`, `invitados`, `inicio`, `final`, `costototal`, `id_cliente`, `id_usuario`, `id_pago`) VALUES
(1, '2023-11-05', 'Cumpleaños', '2023-12-12', 80, '17:00:00', '01:00:00', 1900, 1, 1, 5),
(2, '0000-00-00', 'Seleccione el Tipo del Evento', '0000-00-00', 0, '00:00:00', '00:00:00', 0, 1, 1, 7),
(4, '2023-11-05', 'Promocion', '2023-12-12', 150, '17:00:00', '01:00:00', 2500, 24, 6, 15),
(5, '2023-11-03', 'Matrimonio', '2023-12-11', 120, '17:00:00', '01:00:00', 5500, 22, 10, 7),
(6, '2023-11-01', 'Graduacion', '2023-11-24', 200, '17:00:00', '01:00:00', 3500, 21, 4, 9),
(7, '2023-11-01', 'Cumpleaño', '2023-11-18', 130, '17:00:00', '00:00:00', 4000, 24, 9, 10),
(8, '2023-10-27', 'Reunion Familiar', '2023-11-18', 100, '17:00:00', '00:00:00', 3100, 23, 8, 11),
(9, '2023-11-05', 'Promocion', '2023-12-12', 150, '17:00:00', '01:00:00', 2500, 24, 6, 15),
(10, '2023-11-03', 'Matrimonio', '2023-12-11', 120, '17:00:00', '01:00:00', 5500, 22, 10, 7),
(11, '2023-11-01', 'Graduacion', '2023-11-24', 200, '17:00:00', '01:00:00', 3500, 21, 4, 9),
(12, '2023-11-01', 'Cumpleaño', '2023-11-18', 130, '17:00:00', '00:00:00', 4000, 24, 9, 10),
(13, '2023-10-27', 'Reunion Familiar', '2023-11-18', 100, '17:00:00', '00:00:00', 3100, 23, 8, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `detalle` varchar(20) DEFAULT NULL,
  `costo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id_servicio`, `detalle`, `costo`) VALUES
(1, 'Garzoneria', 1500),
(2, 'Seguridad', 1000),
(3, 'Decorado', 1500),
(4, 'Conjunto Musical', 5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_reserva`
--

CREATE TABLE `servicios_reserva` (
  `id` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_reserva` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios_reserva`
--

INSERT INTO `servicios_reserva` (`id`, `id_servicio`, `id_reserva`) VALUES
(1, 3, 1),
(2, 4, 1),
(3, 4, 2),
(4, 2, 1),
(5, 3, 5),
(6, 3, 4),
(7, 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nom_usuario` varchar(50) NOT NULL,
  `contra` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nom_usuario`, `contra`, `correo`) VALUES
(1, 'David', '123', 'david1997mb@gmail.com'),
(3, 'jose', '123', 'jose@gmail.com'),
(4, 'calvi', 'calvi123', 'calvi@gmail.com'),
(5, 'maria', 'mari123', 'maria@hotmail.com'),
(6, 'maria', 'mari123', 'maria@hotmail.com'),
(7, 'alber', 'alber123', 'alberpadilla@gmail.com'),
(8, 'juan', 'juan123', 'juan@gmail.com'),
(9, 'keven', 'keven123', 'keven@hotmail.com'),
(10, 'Jose', 'jose345', 'jose@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id_area`);

--
-- Indices de la tabla `areas_reserva`
--
ALTER TABLE `areas_reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`id_reserva`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_pago` (`id_pago`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `servicios_reserva`
--
ALTER TABLE `servicios_reserva`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_servicio` (`id_servicio`),
  ADD KEY `id_reserva` (`id_reserva`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `id_area` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `areas_reserva`
--
ALTER TABLE `areas_reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `reserva`
--
ALTER TABLE `reserva`
  MODIFY `id_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id_servicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `servicios_reserva`
--
ALTER TABLE `servicios_reserva`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas_reserva`
--
ALTER TABLE `areas_reserva`
  ADD CONSTRAINT `areas_reserva_ibfk_1` FOREIGN KEY (`id_area`) REFERENCES `areas` (`id_area`),
  ADD CONSTRAINT `areas_reserva_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`);

--
-- Filtros para la tabla `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id_pago`),
  ADD CONSTRAINT `reserva_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `servicios_reserva`
--
ALTER TABLE `servicios_reserva`
  ADD CONSTRAINT `servicios_reserva_ibfk_1` FOREIGN KEY (`id_servicio`) REFERENCES `servicios` (`id_servicio`),
  ADD CONSTRAINT `servicios_reserva_ibfk_2` FOREIGN KEY (`id_reserva`) REFERENCES `reserva` (`id_reserva`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
