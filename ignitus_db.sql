-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2025 a las 14:27:55
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ignitus_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `precio_total` decimal(10,2) DEFAULT NULL,
  `porcentaje_pagado` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id_contacto` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mensaje` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id_contacto`, `id_cliente`, `nombre`, `email`, `mensaje`, `fecha`) VALUES
(1, 1, 'Tamir', 'tamirscocozza@gmail.com', 'Donde esta el taller en florida', '2025-10-22 21:46:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `sueldo` decimal(10,2) DEFAULT NULL,
  `turno` enum('mañana','tarde','noche') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `garantias`
--

CREATE TABLE `garantias` (
  `id_garantia` int(11) NOT NULL,
  `id_compra` int(11) DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `condiciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id_insumo` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `unidad_medida` varchar(20) DEFAULT NULL,
  `cantidad_stock` int(11) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_servicio`
--

CREATE TABLE `insumos_servicio` (
  `id_servicio_realizado` int(11) NOT NULL,
  `id_insumo` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_servicio`
--

CREATE TABLE `mensajes_servicio` (
  `id_mensaje` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `emisor` enum('cliente','empleado') NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes_solicitud`
--

CREATE TABLE `mensajes_solicitud` (
  `id_mensaje` int(11) NOT NULL,
  `id_solicitud` int(11) NOT NULL,
  `remitente` enum('cliente','empleado') NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_envio` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id_notificacion` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `tipo` varchar(50) DEFAULT NULL,
  `mensaje` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id_notificacion`, `id_cliente`, `tipo`, `mensaje`, `fecha`) VALUES
(1, 1, 'Recordatorio', 'Tu próximo servicio está programado para el 25/10/2025.', '2025-10-22 22:06:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promocion` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `tipo` enum('small','large') NOT NULL DEFAULT 'small',
  `orden_slide` int(11) NOT NULL DEFAULT 1,
  `orden_columna` int(11) NOT NULL DEFAULT 1,
  `activo` tinyint(1) NOT NULL DEFAULT 1,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` date DEFAULT NULL,
  `categoria` varchar(50) NOT NULL DEFAULT 'general',
  `precio` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `promociones`
--

INSERT INTO `promociones` (`id_promocion`, `titulo`, `descripcion`, `imagen`, `tipo`, `orden_slide`, `orden_columna`, `activo`, `fecha_creacion`, `fecha_fin`, `categoria`, `precio`) VALUES
(1, '20% de Descuento en Cambio de Aceite', 'Mantén tu motor en óptimas condiciones.', 'images/cambio_aceite.jpg', 'large', 1, 2, 1, '2025-10-22 21:38:55', NULL, 'general', '0.00'),
(2, '25% de Descuento en Cambio de Batería', 'Energía confiable.', 'images/cambio_bateria.png', 'small', 1, 1, 1, '2025-10-22 21:38:55', NULL, 'general', '0.00'),
(3, '30% de Descuento en Revisión General', 'Revisión completa de frenos y niveles.', 'images/revision_general.png', 'small', 1, 3, 1, '2025-10-22 21:38:55', NULL, 'general', '0.00'),
(4, '20% de Descuento en Cambio de Aceite', 'Mantén tu motor en óptimas condiciones.', 'images/cambio_aceite.jpg', 'large', 1, 2, 1, '2025-10-22 21:40:06', NULL, 'general', '0.00'),
(5, '25% de Descuento en Cambio de Batería', 'Energía confiable.', 'images/cambio_bateria.png', 'small', 1, 1, 1, '2025-10-22 21:40:06', NULL, 'general', '0.00'),
(6, '30% de Descuento en Revisión General', 'Revisión completa de frenos y niveles.', 'images/revision_general.png', 'small', 1, 3, 1, '2025-10-22 21:40:06', NULL, 'general', '0.00'),
(7, '20% de Descuento en Cambio de Aceite', 'Mantén tu motor en óptimas condiciones.', 'images/cambio_aceite.jpg', 'large', 1, 2, 1, '2025-10-22 21:40:09', NULL, 'general', '0.00'),
(8, '25% de Descuento en Cambio de Batería', 'Energía confiable.', 'images/cambio_bateria.png', 'small', 1, 1, 1, '2025-10-22 21:40:09', NULL, 'general', '0.00'),
(9, '30% de Descuento en Revisión General', 'Revisión completa de frenos y niveles.', 'images/revision_general.png', 'small', 1, 3, 1, '2025-10-22 21:40:09', NULL, 'general', '0.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores_insumos`
--

CREATE TABLE `proveedores_insumos` (
  `id_proveedor` int(11) NOT NULL,
  `id_insumo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reclamos`
--

CREATE TABLE `reclamos` (
  `id_reclamo` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `tipo` enum('compra','servicio','otro') DEFAULT 'otro',
  `descripcion` text DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `estado` enum('Pendiente','Confirmada','Completada') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `fecha_inicio`, `fecha_fin`, `servicio`, `estado`) VALUES
(0, 1, '2025-10-30', '2025-10-30', 'Revisión general', 'Pendiente'),
(1, 1, '2025-10-26', '2025-10-26', 'Revisión general', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id_servicio` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios_realizados`
--

CREATE TABLE `servicios_realizados` (
  `id_servicio_realizado` int(11) NOT NULL,
  `id_servicio` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `vin` varchar(17) DEFAULT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `estado` enum('pendiente','en proceso','completado') DEFAULT 'pendiente',
  `observaciones` text DEFAULT NULL,
  `id_vehiculo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_servicio`
--

CREATE TABLE `solicitudes_servicio` (
  `id_solicitud` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `vehiculo` varchar(17) NOT NULL,
  `servicio` varchar(255) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `estado` enum('pendiente','en_proceso','finalizado') DEFAULT 'pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_servicio`
--

INSERT INTO `solicitudes_servicio` (`id_solicitud`, `id_cliente`, `vehiculo`, `servicio`, `fecha`, `estado`) VALUES
(0, 1, '1', 'Revisión general', '2025-10-30 00:00:00', 'pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `rol` enum('admin','empleado','cliente') DEFAULT 'cliente',
  `activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `email`, `contraseña`, `rol`, `activo`) VALUES
(0, 'Diego', 'Castro', 'diegosip@gmail.com', '$2y$10$OrkUqe/evMyO/2AZJoPA9em/bNRHE4oWzsBwBLOzvvj5Q2c8JJDQi', 'empleado', 1),
(1, 'Tamir', 'Scocozza', 'tamirscocozza@gmail.com', '$2y$10$c4akh5XhwX1hOPh8sG9Hge9GhBqqa7RpdfkSF0B/oHPm6KQ7tOaGW', 'cliente', 1),
(2, 'Juan', 'Perez', 'juanperez@gmail.com', '$2y$10$HsNOKN9JCsSiT8FaBKOL8uS0/55EAODIrIo0yC8il94UkrKlL.ywW', 'cliente', 1),
(4, 'Lucas', 'Perez', 'lucasprz@gmail.com', '$2y$10$jlS4iXDzmGIUmImmM0QIw.vGFWK9CUpv2VjTZ/z5Ln.lwiHrZjkt.', 'empleado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `vin` varchar(17) NOT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `modelo` varchar(100) DEFAULT NULL,
  `año` int(11) DEFAULT NULL,
  `tipo_combustible` varchar(50) DEFAULT NULL,
  `transmision` varchar(50) DEFAULT NULL,
  `kilometraje` int(11) DEFAULT NULL,
  `garantia` varchar(100) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `id_cliente` int(11) NOT NULL,
  `placa` varchar(50) DEFAULT NULL,
  `potencia_motor` varchar(50) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`vin`, `marca`, `modelo`, `año`, `tipo_combustible`, `transmision`, `kilometraje`, `garantia`, `color`, `precio`, `id_cliente`, `placa`, `potencia_motor`, `imagen`) VALUES
('1', 'Cherry cucu', '1', 2000, '1', '1', 11, '11', '11', NULL, 1, '1', '1', '1.png'),
('3', '3', '3', 3, '3', '3', 33, '3', '3', NULL, 1, '3', '3', '3.webp'),
('5', '5', '5', 5, '5', '5', 5, '5', '5', NULL, 1, '5', '5', '5.webp');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `vin` (`vin`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `garantias`
--
ALTER TABLE `garantias`
  ADD PRIMARY KEY (`id_garantia`),
  ADD KEY `id_compra` (`id_compra`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `insumos_servicio`
--
ALTER TABLE `insumos_servicio`
  ADD PRIMARY KEY (`id_servicio_realizado`,`id_insumo`),
  ADD KEY `id_insumo` (`id_insumo`);

--
-- Indices de la tabla `mensajes_servicio`
--
ALTER TABLE `mensajes_servicio`
  ADD PRIMARY KEY (`id_mensaje`),
  ADD KEY `id_solicitud` (`id_solicitud`);

--
-- Indices de la tabla `mensajes_solicitud`
--
ALTER TABLE `mensajes_solicitud`
  ADD PRIMARY KEY (`id_mensaje`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id_notificacion`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `proveedores_insumos`
--
ALTER TABLE `proveedores_insumos`
  ADD PRIMARY KEY (`id_proveedor`,`id_insumo`),
  ADD KEY `id_insumo` (`id_insumo`);

--
-- Indices de la tabla `reclamos`
--
ALTER TABLE `reclamos`
  ADD PRIMARY KEY (`id_reclamo`),
  ADD KEY `id_cliente` (`id_cliente`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`id_reserva`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id_servicio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`vin`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
