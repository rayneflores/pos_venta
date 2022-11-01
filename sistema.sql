-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 01-11-2022 a las 18:30:37
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema`
--
CREATE DATABASE IF NOT EXISTS `sistema` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `sistema`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE `caja` (
  `id` int(11) NOT NULL,
  `caja` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `caja`
--

TRUNCATE TABLE `caja`;
--
-- Volcado de datos para la tabla `caja`
--

INSERT INTO `caja` (`id`, `caja`, `estado`) VALUES
(1, 'Principal', 1),
(2, 'Secundaria', 1),
(3, 'Maestra', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `categorias`
--

TRUNCATE TABLE `categorias`;
--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `estado`) VALUES
(1, 'Viveres', 1),
(2, 'Cigarrillos', 1),
(3, 'Refrescos', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cierre_caja`
--

DROP TABLE IF EXISTS `cierre_caja`;
CREATE TABLE `cierre_caja` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `monto_inicial` decimal(10,2) NOT NULL,
  `monto_inicial_bolos` decimal(10,2) NOT NULL,
  `monto_final` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monto_final_bolos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_apertura` date NOT NULL DEFAULT current_timestamp(),
  `fecha_cierre` date DEFAULT NULL,
  `total_ventas` int(11) NOT NULL DEFAULT 0,
  `monto_total` decimal(10,2) DEFAULT 0.00,
  `monto_total_bolos` decimal(10,2) NOT NULL DEFAULT 0.00,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `rif` varchar(12) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `clientes`
--

TRUNCATE TABLE `clientes`;
--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `estado`) VALUES
(1, 'V150586522', 'Rayne Flores', '04246957000', 'Veritas Avenida 10 con Calle 90 #90-42', 1),
(2, 'V12405304', 'Luzmary Arrieta', '04146852567', 'Veritas Avenida 10 con calle 90 #90-42', 1),
(3, 'J000000000', 'Cliente Contado', '00000000000', 'Maracaibo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

DROP TABLE IF EXISTS `compras`;
CREATE TABLE `compras` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `total_bolos` decimal(10,2) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
CREATE TABLE `configuracion` (
  `id` int(11) NOT NULL,
  `rif` varchar(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `mensaje` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `configuracion`
--

TRUNCATE TABLE `configuracion`;
--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`id`, `rif`, `nombre`, `telefono`, `direccion`, `mensaje`) VALUES
(1, 'J-300653595-9', 'Bodega La Fortaleza JJ C.A', '0424-6839545', 'Calle 91 con Avenida 11 # 91-68', 'Gracias por su Preferencia!!!');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle`
--

DROP TABLE IF EXISTS `detalle`;
CREATE TABLE `detalle` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_bolos` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `sub_total_bolos` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle2`
--

DROP TABLE IF EXISTS `detalle2`;
CREATE TABLE `detalle2` (
  `id` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_bolos` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `sub_total_bolos` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compras`
--

DROP TABLE IF EXISTS `detalle_compras`;
CREATE TABLE `detalle_compras` (
  `id` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_bolos` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `sub_total_bolos` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

DROP TABLE IF EXISTS `detalle_permisos`;
CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `detalle_permisos`
--

TRUNCATE TABLE `detalle_permisos`;
--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(10, 1, 4),
(11, 1, 5),
(12, 1, 6),
(13, 1, 7),
(14, 1, 8),
(15, 1, 9),
(16, 1, 10),
(18, 1, 12),
(106, 1, 13),
(107, 1, 14),
(108, 3, 2),
(109, 3, 6),
(110, 1, 15),
(111, 1, 16),
(112, 1, 17),
(113, 1, 18),
(131, 1, 11),
(148, 1, 19),
(184, 2, 1),
(185, 2, 2),
(186, 2, 3),
(187, 2, 4),
(188, 2, 5),
(189, 2, 6),
(190, 2, 7),
(191, 2, 8),
(192, 2, 9),
(193, 2, 10),
(194, 2, 11),
(195, 2, 12),
(196, 2, 13),
(197, 2, 14),
(198, 2, 15),
(199, 2, 16),
(200, 2, 17),
(201, 2, 18),
(202, 2, 19);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

DROP TABLE IF EXISTS `detalle_ventas`;
CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `precio_bolos` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `sub_total_bolos` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

DROP TABLE IF EXISTS `medidas`;
CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `nombre_corto` varchar(5) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `medidas`
--

TRUNCATE TABLE `medidas`;
--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `nombre`, `nombre_corto`, `estado`) VALUES
(1, 'Unidad', 'U', 1),
(2, 'Kilogramo', 'Kg', 1),
(3, 'Bulto', 'B', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `permisos`
--

TRUNCATE TABLE `permisos`;
--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`) VALUES
(1, 'compras'),
(2, 'ventas'),
(3, 'clientes'),
(4, 'categorias'),
(5, 'medidas'),
(6, 'productos'),
(7, 'administracion'),
(8, 'cajas'),
(9, 'historialC'),
(10, 'historialV'),
(11, 'usuarios'),
(12, 'arqueo'),
(13, 'registrar_cliente'),
(14, 'eliminar_cliente'),
(15, 'registrar_producto'),
(16, 'eliminar_producto'),
(17, 'registrar_usuario'),
(18, 'eliminar_usuario'),
(19, 'permisos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_compra_bolos` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL,
  `precio_venta_bolos` decimal(10,2) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `id_medida` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `productos`
--

TRUNCATE TABLE `productos`;
--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `descripcion`, `precio_compra`, `precio_compra_bolos`, `precio_venta`, `precio_venta_bolos`, `cantidad`, `id_medida`, `id_categoria`, `foto`, `estado`) VALUES
(1, '8801116014552', 'Time Double Click', '0.55', '4.72', '1.00', '8.59', 137, 1, 2, '20221101182850.jpg', 1),
(2, '123456788765432', 'Carnival Doble Click', '0.75', '6.44', '1.20', '10.31', 7, 1, 2, '20221024060736.jpg', 1),
(3, '9876543212345', 'Carnival un click', '4.00', '34.36', '8.50', '73.02', 7, 1, 2, 'default.jpeg', 1),
(4, '7702084137520', 'Harina PAN', '0.75', '6.44', '1.50', '12.89', 70, 1, 1, '20221024211846.jpg', 1),
(5, '123456789', 'Yesqueros Colores', '1.50', '12.89', '3.00', '25.77', 6, 1, 2, '20221024051524.jpg', 1),
(6, 'jamon', 'Jamon Ahumado Servipork', '4.00', '34.36', '8.00', '68.72', 0, 2, 1, '20221029232601.jpg', 1),
(7, 'queso', 'Queso Semiduro', '2.50', '21.48', '5.00', '42.95', 0, 2, 1, 'default.jpeg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasa`
--

DROP TABLE IF EXISTS `tasa`;
CREATE TABLE `tasa` (
  `id` int(11) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `factor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `tasa`
--

TRUNCATE TABLE `tasa`;
--
-- Volcado de datos para la tabla `tasa`
--

INSERT INTO `tasa` (`id`, `fecha`, `factor`) VALUES
(2, '2022-10-22 22:18:07', '8.23'),
(3, '2022-10-23 22:41:33', '8.24'),
(4, '2022-10-24 09:46:45', '8.39'),
(5, '2022-10-25 09:43:17', '8.41'),
(6, '2022-10-26 10:25:27', '8.41'),
(7, '2022-10-27 08:08:26', '8.45'),
(8, '2022-10-28 09:36:00', '8.45'),
(9, '2022-10-29 09:37:01', '8.60'),
(10, '2022-11-01 09:10:45', '8.59');

--
-- Disparadores `tasa`
--
DROP TRIGGER IF EXISTS `alter_precios`;
DELIMITER $$
CREATE TRIGGER `alter_precios` AFTER UPDATE ON `tasa`
 FOR EACH ROW BEGIN
DECLARE nueva_tasa decimal(10,2);
SET nueva_tasa = new.factor;
UPDATE productos SET precio_compra_bolos = (nueva_tasa * precio_compra), precio_venta_bolos = (precio_venta * nueva_tasa) WHERE id_categoria <> 5;
END
$$
DELIMITER ;

DROP TRIGGER IF EXISTS `alter_precios_2`;
DELIMITER $$
CREATE TRIGGER `alter_precios_2` AFTER INSERT ON `tasa`
 FOR EACH ROW BEGIN
DECLARE nueva_tasa decimal(10,2);
SET nueva_tasa = new.factor;
UPDATE productos SET precio_compra_bolos = (nueva_tasa * precio_compra), precio_venta_bolos = (precio_venta * nueva_tasa) WHERE id_categoria <> 5;
END
$$
DELIMITER ;

DROP TRIGGER IF EXISTS `alter_precios_polar`;
DELIMITER $$
CREATE TRIGGER `alter_precios_polar` AFTER INSERT ON `tasa`
 FOR EACH ROW BEGIN
DECLARE nueva_tasa decimal(10,2);
SET nueva_tasa = new.factor_bcv;
UPDATE productos SET precio_compra_bolos = (nueva_tasa * precio_compra), precio_venta_bolos = (precio_venta * nueva_tasa) WHERE id_categoria = 5;
END
$$
DELIMITER ;

DROP TRIGGER IF EXISTS `alter_precios_2_polar`;
DELIMITER $$
CREATE TRIGGER `alter_precios_2_polar` AFTER UPDATE ON `tasa`
 FOR EACH ROW BEGIN
DECLARE nueva_tasa decimal(10,2);
SET nueva_tasa = new.factor_bcv;
UPDATE productos SET precio_compra_bolos = (nueva_tasa * precio_compra), precio_venta_bolos = (precio_venta * nueva_tasa) WHERE id_categoria = 5;
END
$$
DELIMITER ;
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_caja` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncar tablas antes de insertar `usuarios`
--

TRUNCATE TABLE `usuarios`;
--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `id_caja`, `estado`) VALUES
(1, 'admin', 'Rayne Flores', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 1),
(2, 'jenfer', 'Jenfer Cabello', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 3, 1),
(3, 'raynier', 'Raynier Flores', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `total_bolos` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL DEFAULT current_timestamp(),
  `estado` int(11) NOT NULL DEFAULT 1,
  `apertura` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle`
--
ALTER TABLE `detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle2`
--
ALTER TABLE `detalle2`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tasa`
--
ALTER TABLE `tasa`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_caja` (`id_caja`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cierre_caja`
--
ALTER TABLE `cierre_caja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `configuracion`
--
ALTER TABLE `configuracion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle`
--
ALTER TABLE `detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle2`
--
ALTER TABLE `detalle2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_compras`
--
ALTER TABLE `detalle_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tasa`
--
ALTER TABLE `tasa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_caja`) REFERENCES `caja` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;