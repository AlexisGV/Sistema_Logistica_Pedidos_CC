-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-01-2021 a las 20:55:52
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `logistica-pedidos`
--
CREATE DATABASE IF NOT EXISTS `logistica-pedidos` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `logistica-pedidos`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acabado`
--

CREATE TABLE `acabado` (
  `Id_Acabado` int(11) NOT NULL,
  `Foto_Acabado` text COLLATE utf8_unicode_ci NOT NULL,
  `Acabado` text COLLATE utf8_unicode_ci NOT NULL,
  `Abreviacion_Acabado` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acabado`
--

INSERT INTO `acabado` (`Id_Acabado`, `Foto_Acabado`, `Acabado`, `Abreviacion_Acabado`) VALUES
(1, '', 'Otro acabado', 'AO'),
(2, '', 'Pulido', 'AP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acabado_dpedido`
--

CREATE TABLE `acabado_dpedido` (
  `Id_Acabado1` int(11) NOT NULL,
  `Id_Detalle_Pedido1` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `acabado_dpedido`
--

INSERT INTO `acabado_dpedido` (`Id_Acabado1`, `Id_Detalle_Pedido1`) VALUES
(2, 1),
(2, 2),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actualizaciones_pedido`
--

CREATE TABLE `actualizaciones_pedido` (
  `Id_Pedido2` int(11) NOT NULL,
  `Id_Estatus1` int(11) NOT NULL,
  `Id_Usuario1` int(11) DEFAULT NULL,
  `Comentario` text COLLATE utf8_unicode_ci NOT NULL,
  `Estado` int(11) NOT NULL COMMENT 'Este campo permite saber si el estado del pedido esta activo para ser evaluado',
  `Fecha_Actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `actualizaciones_pedido`
--

INSERT INTO `actualizaciones_pedido` (`Id_Pedido2`, `Id_Estatus1`, `Id_Usuario1`, `Comentario`, `Estado`, `Fecha_Actualizacion`) VALUES
(10001, 1, 3, '', 1, '2021-01-25 15:07:18'),
(10001, 2, 3, 'Se recogió el pedido de  la tienda sin complicaciones', 1, '2021-01-25 16:42:57'),
(10001, 3, 3, '', 1, '2021-01-25 17:03:46'),
(10001, 4, 3, '', 1, '2021-01-25 17:15:29'),
(10001, 5, 3, '', 1, '2021-01-25 17:17:23'),
(10001, 6, 3, '', 1, '2021-01-25 19:45:11'),
(10001, 7, 3, '', 1, '2021-02-26 15:37:09'),
(10001, 8, 3, '', 1, '2021-02-26 15:37:17'),
(10001, 9, 3, '', 1, '2021-02-26 15:37:23'),
(10005, 1, 3, '', 1, '2021-01-25 17:30:33'),
(10005, 2, 3, '', 1, '2021-01-25 17:35:43'),
(10005, 3, 3, '', 1, '2021-01-25 17:36:39'),
(10005, 4, 3, '', 1, '2021-01-25 17:37:46'),
(10005, 5, 3, '', 1, '2021-01-25 17:39:48'),
(10005, 6, 3, '', 1, '2021-01-25 17:42:59'),
(10005, 7, 3, '', 1, '2021-01-25 17:43:37'),
(10005, 8, 3, '', 1, '2021-01-25 17:43:50'),
(10005, 9, 3, '', 1, '2021-01-25 19:50:24'),
(10006, 1, 4, '', 1, '2021-01-26 18:17:51'),
(10006, 2, 3, '', 1, '2021-01-26 18:18:07'),
(10006, 3, 3, '', 1, '2021-01-26 18:18:12'),
(10006, 4, 4, '', 1, '2021-01-26 18:18:20'),
(10006, 5, 4, '', 1, '2021-01-26 18:18:47'),
(10006, 6, 4, '', 1, '2021-01-26 18:23:09'),
(10006, 7, 3, '', 1, '2021-01-26 18:37:08'),
(10006, 8, 3, '', 1, '2021-01-26 18:37:59'),
(10006, 9, 3, '', 1, '2021-01-26 18:38:20'),
(10007, 1, 3, '', 1, '2021-01-29 16:58:26'),
(10007, 2, 3, '', 1, '2021-01-29 17:00:41'),
(10007, 3, 3, '', 1, '2021-01-29 17:00:58'),
(10007, 4, 4, '', 1, '2021-01-29 17:01:17'),
(10007, 5, 4, '', 0, '2021-01-29 17:01:17'),
(10007, 6, 4, '', 0, '2021-01-29 17:01:17'),
(10007, 7, 2, '', 0, '2021-01-29 16:58:26'),
(10007, 8, 2, '', 0, '2021-01-29 16:58:26'),
(10007, 9, 2, '', 0, '2021-01-29 16:58:27'),
(10008, 1, 3, '', 1, '2021-01-29 16:59:16'),
(10008, 2, 3, '', 1, '2021-01-29 17:00:45'),
(10008, 3, 3, '', 1, '2021-01-29 17:01:01'),
(10008, 4, 3, '', 1, '2021-01-29 17:01:39'),
(10008, 5, 3, '', 0, '2021-01-29 17:01:39'),
(10008, 6, 3, '', 0, '2021-01-29 17:01:39'),
(10008, 7, 2, '', 0, '2021-01-29 16:59:16'),
(10008, 8, 2, '', 0, '2021-01-29 16:59:16'),
(10008, 9, 2, '', 0, '2021-01-29 16:59:16'),
(10009, 1, 3, '', 1, '2021-01-29 17:00:13'),
(10009, 2, 3, '', 1, '2021-01-29 17:00:47'),
(10009, 3, 3, '', 1, '2021-01-29 17:01:04'),
(10009, 4, 5, '', 1, '2021-01-29 17:01:50'),
(10009, 5, 5, '', 0, '2021-01-29 17:01:50'),
(10009, 6, 5, '', 0, '2021-01-29 17:01:50'),
(10009, 7, 2, '', 0, '2021-01-29 17:00:13'),
(10009, 8, 2, '', 0, '2021-01-29 17:00:13'),
(10009, 9, 2, '', 0, '2021-01-29 17:00:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte`
--

CREATE TABLE `corte` (
  `Id_Corte` int(11) NOT NULL,
  `Foto_Corte` text COLLATE utf8_unicode_ci NOT NULL,
  `Corte` text COLLATE utf8_unicode_ci NOT NULL,
  `Abreviacion_Corte` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `corte`
--

INSERT INTO `corte` (`Id_Corte`, `Foto_Corte`, `Corte`, `Abreviacion_Corte`) VALUES
(1, '', 'Otro corte', 'CO'),
(2, '', 'Diagonal', 'CD'),
(3, '', 'Horizontal', 'CH'),
(4, '', 'Ventana', 'CVN'),
(5, '', 'Vertical', 'CVR'),
(6, '', 'Prueba', 'CP');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `corte_dpedido`
--

CREATE TABLE `corte_dpedido` (
  `Id_Corte1` int(11) NOT NULL,
  `Id_Detalle_Pedido2` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `corte_dpedido`
--

INSERT INTO `corte_dpedido` (`Id_Corte1`, `Id_Detalle_Pedido2`) VALUES
(2, 1),
(2, 7),
(2, 8),
(2, 9),
(3, 2),
(4, 7),
(4, 11),
(4, 12),
(5, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `Id_Detalle_Pedido` int(11) NOT NULL,
  `Foto` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Descripcion` text COLLATE utf8_unicode_ci NOT NULL,
  `Precio_Uni` float NOT NULL,
  `Descuento` int(11) NOT NULL,
  `Precio_CDescuento` float NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Importe` float NOT NULL,
  `Observacion` text COLLATE utf8_unicode_ci NOT NULL,
  `Id_Pedido1` int(11) NOT NULL,
  `Id_Marca1` int(11) NOT NULL,
  `Id_Forma1` int(11) NOT NULL,
  `Otro_Corte` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Otro_Acabado` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Otra_Forma` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `Otra_Marca` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`Id_Detalle_Pedido`, `Foto`, `Descripcion`, `Precio_Uni`, `Descuento`, `Precio_CDescuento`, `Cantidad`, `Importe`, `Observacion`, `Id_Pedido1`, `Id_Marca1`, `Id_Forma1`, `Otro_Corte`, `Otro_Acabado`, `Otra_Forma`, `Otra_Marca`) VALUES
(1, NULL, 'Producto de prueba 1', 15, 0, 15, 1, 15, 'Sin observaciones', 10001, 4, 3, NULL, NULL, NULL, NULL),
(2, NULL, 'Producto de prueba 2', 25, 10, 22.5, 2, 45, 'Sin observaciones', 10001, 2, 2, NULL, NULL, NULL, NULL),
(7, NULL, 'Producto de prueba', 25, 0, 25, 3, 75, 'Sin observaciones', 10005, 2, 2, 'Circulo', NULL, NULL, NULL),
(8, NULL, 'Prueba 1', 15, 0, 15, 1, 15, 'Sin observaciones', 10006, 4, 3, NULL, NULL, NULL, NULL),
(9, NULL, 'Producto de prueba 1', 18, 5, 17.1, 2, 34.2, 'Sin observaciones', 10007, 4, 3, NULL, NULL, NULL, NULL),
(10, NULL, 'Producto de prueba 2', 35, 10, 31.5, 1, 31.5, 'Sin observaciones', 10007, 3, 2, NULL, NULL, NULL, NULL),
(11, NULL, 'Prueba 1', 35, 0, 35, 1, 35, 'Sin observaciones', 10008, 2, 2, NULL, NULL, NULL, NULL),
(12, NULL, 'Prueba 1', 35, 20, 28, 1, 28, 'Sin observaciones', 10009, 2, 3, 'Circulos', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estatus_pedido`
--

CREATE TABLE `estatus_pedido` (
  `Id_Estatus` int(11) NOT NULL,
  `Nombre_Estatus` text COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion_Estatus` text COLLATE utf8_unicode_ci NOT NULL,
  `Orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estatus_pedido`
--

INSERT INTO `estatus_pedido` (`Id_Estatus`, `Nombre_Estatus`, `Descripcion_Estatus`, `Orden`) VALUES
(1, 'Pedido en tienda', 'El pedido ha sido tomado y esta listo para ser recogido por el personal de logística de Cerrando el Ciclo A.C.', 1),
(2, 'Salió de tienda y va camino a taller', 'Un trabajador de Cerrando el Ciclo A.C. ha recogido el pedido y lo llevará a taller para empezar con la producción del mismo.', 2),
(3, 'Llegó a taller', 'El pedido ha llegado al taller y está a espera de ser asignado al personal del taller para comenzar a producirlo.', 3),
(4, 'Recibido por producción', 'El personal encargado de la producción ha recibido el pedido, está enterado de los detalles del mismo y empezará con su producción lo más pronto posible.', 4),
(5, 'En producción', 'El pedido actualmente está en producción.', 5),
(6, 'Terminado', 'Ha finalizado la producción del pedido y está listo para ser enviado de vuelta a tienda.', 6),
(7, 'Salió de taller y va camino a tienda.', 'El pedido ha sido recogido por una camioneta de Cerrando el Ciclo A.C. y está siendo translalado a tienda.', 7),
(8, 'Llegó a tienda', 'El pedido ha llegado ha tienda y esta listo para ser recogido por el cliente.', 8),
(9, 'Entregado', 'El pedido ya fue entregado al cliente.', 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `forma`
--

CREATE TABLE `forma` (
  `Id_Forma` int(11) NOT NULL,
  `Foto_Forma` text COLLATE utf8_unicode_ci NOT NULL,
  `Forma` text COLLATE utf8_unicode_ci NOT NULL,
  `Abreviacion_Forma` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `forma`
--

INSERT INTO `forma` (`Id_Forma`, `Foto_Forma`, `Forma`, `Abreviacion_Forma`) VALUES
(1, '', 'Otra forma', 'FO'),
(2, '', 'Cuadrada', 'FCD'),
(3, '', 'Cilindrica', 'FCL'),
(4, '', 'Amorfa', 'FA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `Id_Marca` int(11) NOT NULL,
  `Foto_Marca` text COLLATE utf8_unicode_ci NOT NULL,
  `Marca` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`Id_Marca`, `Foto_Marca`, `Marca`) VALUES
(1, '', 'Otra marca'),
(2, '', 'Bacardi'),
(3, '', 'Jhony Walker'),
(4, '', 'Sky');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `Id_Modulo` int(11) NOT NULL,
  `Nombre_Modulo` text COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion_Modulo` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `C_A` int(11) NOT NULL DEFAULT 1,
  `R_A` int(11) NOT NULL DEFAULT 1,
  `U_A` int(11) NOT NULL DEFAULT 1,
  `D_A` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`Id_Modulo`, `Nombre_Modulo`, `Descripcion_Modulo`, `C_A`, `R_A`, `U_A`, `D_A`) VALUES
(1, 'Administración de pedidos', NULL, 1, 1, 1, 1),
(2, 'Administración de usuarios', NULL, 1, 1, 1, 1),
(3, 'Administración de roles', NULL, 1, 1, 1, 1),
(4, 'Administración de acabados', NULL, 1, 1, 1, 1),
(5, 'Administración de cortes', NULL, 1, 1, 1, 1),
(6, 'Administración de formas', NULL, 1, 1, 1, 1),
(7, 'Administración de marcas', NULL, 1, 1, 1, 1),
(8, 'Entrega final', NULL, 0, 1, 1, 0),
(9, 'Recolección y descarga de pedidos', NULL, 0, 1, 1, 0),
(10, 'Asignación de pedidos', NULL, 0, 1, 1, 0),
(11, 'Pedidos en espera', NULL, 0, 1, 1, 0),
(12, 'Producción de pedidos', NULL, 0, 1, 1, 0),
(13, 'Vista general de pedidos', NULL, 0, 1, 0, 0),
(14, 'Logística y reportes', NULL, 1, 1, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `Id_Pedido` int(11) NOT NULL,
  `Fecha_Inicio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Fecha_Compromiso` datetime NOT NULL,
  `Fecha_Entrega` datetime DEFAULT NULL,
  `Nombre_Cliente` text COLLATE utf8_unicode_ci NOT NULL,
  `Telefono_Cliente` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Correo_Cliente` text COLLATE utf8_unicode_ci NOT NULL,
  `Anticipo` float NOT NULL,
  `Subtotal` float NOT NULL,
  `IVA` int(11) NOT NULL,
  `Total` float NOT NULL,
  `Avance_Estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`Id_Pedido`, `Fecha_Inicio`, `Fecha_Compromiso`, `Fecha_Entrega`, `Nombre_Cliente`, `Telefono_Cliente`, `Correo_Cliente`, `Anticipo`, `Subtotal`, `IVA`, `Total`, `Avance_Estado`) VALUES
(10001, '2021-02-26 15:37:24', '2021-02-15 09:07:18', '2021-02-26 09:37:23', 'Francisco Alexis García Villanueva', '5542189135', '', 63, 60, 5, 63, 90),
(10005, '2021-01-26 16:08:10', '2021-02-15 11:30:33', '2021-01-25 13:50:24', 'Julia Novelo', '5512345678', '', 87, 75, 16, 87, 90),
(10006, '2021-01-26 18:38:20', '2021-02-16 12:17:51', '2021-01-26 12:38:20', 'Fann', '5542134566', '', 15, 15, 0, 15, 90),
(10007, '2021-01-29 17:01:17', '2021-02-19 10:58:26', NULL, 'Yoselin García', '5644332211', 'yoseh@hotmail.com', 76.21, 65.7, 16, 76.21, 40),
(10008, '2021-01-29 17:01:39', '2021-02-19 10:59:16', NULL, 'Mich Luna', '5566778899', '', 35, 35, 0, 35, 40),
(10009, '2021-01-29 17:01:50', '2021-02-19 11:00:13', NULL, 'Francisco García', '5674356782', '', 28, 28, 0, 28, 40);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `Id_Tipo_User2` int(11) NOT NULL,
  `Id_Modulo1` int(11) NOT NULL,
  `C` int(11) NOT NULL DEFAULT 0,
  `R` int(11) NOT NULL DEFAULT 0,
  `U` int(11) NOT NULL DEFAULT 0,
  `D` int(11) NOT NULL DEFAULT 0,
  `Fecha_Reg_Permiso` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `Id_Tipo_User` int(11) NOT NULL,
  `Tipo_User` text COLLATE utf8_unicode_ci NOT NULL,
  `Descripcion_Tipo_User` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`Id_Tipo_User`, `Tipo_User`, `Descripcion_Tipo_User`) VALUES
(1, 'Administrador', 'El administrador tiene los privilegios de acceder a todas las funciones disponibles en cada uno de los módulos del sistema, sin ningún tipo de restricción.'),
(2, 'Ventas', 'Este tipo de usuario tiene acceso únicamente a los módulos correspondientes a la toma de pedidos en tienda. Sin embargo, tiene la restricción de editar alguna venta, pues para ello deberá solicitar acceso al administrador para así poder realizar dicha acción.'),
(3, 'Producción y recolección', 'Todo empleado con este tipo de rol tendrá acceso a los módulos para poder actualizar el estado de los pedidos, desde la salida de tienda hasta el regreso a la misma.'),
(4, 'Gerente de producción', 'Todo empleado con este tipo de rol tendrá la opción de asignar los pedidos a las diferentes personas encargadas de la producción de los mismos en taller.'),
(5, 'Usuario eliminado', 'Este es solo un identificador para cuando se elimine un usuario que este involucrado en las actualizaciones del estatus del pedido'),
(6, 'Usuario no asignado', 'Este tipo de usuario es solo un identificador para saber cuando un usuario aun no ha sido asignado a un pedido');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id_Usuario` int(11) NOT NULL,
  `Foto_User` text COLLATE utf8_unicode_ci NOT NULL,
  `Nombre_Usuario` text COLLATE utf8_unicode_ci NOT NULL,
  `Correo` text COLLATE utf8_unicode_ci NOT NULL,
  `Apodo` text COLLATE utf8_unicode_ci NOT NULL,
  `Password` text COLLATE utf8_unicode_ci NOT NULL,
  `Id_Tipo_User1` int(11) NOT NULL,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id_Usuario`, `Foto_User`, `Nombre_Usuario`, `Correo`, `Apodo`, `Password`, `Id_Tipo_User1`, `Fecha_Registro`) VALUES
(1, '', 'Usuario eliminado', 'Usuario eliminado', 'Usuario eliminado', 'Usuario eliminado', 5, '2020-12-22 02:04:01'),
(2, '', 'Usuario no asignado', 'Usuario no asignado', 'Usuario no asignado', 'Usuario no asignado', 6, '2020-12-28 19:11:59'),
(3, '', 'Francisco Alexis García Villanueva', 'alexisfvgarcia@gmail.com', 'Frankye', '$2a$07$cialOgCcrAolNofVEsmcrOS4o.8pKba5INoVB3I.rrrWenh/nWTVy', 1, '2020-12-28 18:55:16'),
(4, '', 'Estephany Luna Hernandez', 'estephany@gmail.com', 'Fann', '$2a$07$cialOgCcrAolNofVEsmcrODrZaFBtIjZGXPzBu.eVIkngGwCOk41y', 3, '2021-01-26 16:58:05'),
(5, '', 'Rocio', 'rocio@gmail.com', 'Chio', '$2a$07$cialOgCcrAolNofVEsmcrOdRtnAQPUNbR4LEoAbso83u1yBBJ/Oye', 4, '2021-01-29 15:39:47');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acabado`
--
ALTER TABLE `acabado`
  ADD PRIMARY KEY (`Id_Acabado`);

--
-- Indices de la tabla `acabado_dpedido`
--
ALTER TABLE `acabado_dpedido`
  ADD KEY `Id_Acabado1` (`Id_Acabado1`,`Id_Detalle_Pedido1`),
  ADD KEY `Id_Detalle_Pedido1` (`Id_Detalle_Pedido1`);

--
-- Indices de la tabla `actualizaciones_pedido`
--
ALTER TABLE `actualizaciones_pedido`
  ADD KEY `Id_Pedido2` (`Id_Pedido2`,`Id_Estatus1`,`Id_Usuario1`),
  ADD KEY `Id_Usuario1` (`Id_Usuario1`),
  ADD KEY `Id_Estatus1` (`Id_Estatus1`);

--
-- Indices de la tabla `corte`
--
ALTER TABLE `corte`
  ADD PRIMARY KEY (`Id_Corte`);

--
-- Indices de la tabla `corte_dpedido`
--
ALTER TABLE `corte_dpedido`
  ADD KEY `Id_Corte1` (`Id_Corte1`,`Id_Detalle_Pedido2`),
  ADD KEY `Id_Detalle_Pedido2` (`Id_Detalle_Pedido2`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`Id_Detalle_Pedido`),
  ADD KEY `Id_Pedido1` (`Id_Pedido1`,`Id_Marca1`,`Id_Forma1`),
  ADD KEY `Id_Marca1` (`Id_Marca1`),
  ADD KEY `Id_Forma1` (`Id_Forma1`);

--
-- Indices de la tabla `estatus_pedido`
--
ALTER TABLE `estatus_pedido`
  ADD PRIMARY KEY (`Id_Estatus`);

--
-- Indices de la tabla `forma`
--
ALTER TABLE `forma`
  ADD PRIMARY KEY (`Id_Forma`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`Id_Marca`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`Id_Modulo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`Id_Pedido`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD KEY `Id_Tipo_User2` (`Id_Tipo_User2`),
  ADD KEY `Id_Modulo1` (`Id_Modulo1`);

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`Id_Tipo_User`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_Usuario`),
  ADD KEY `Id_Tipo_User1` (`Id_Tipo_User1`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acabado`
--
ALTER TABLE `acabado`
  MODIFY `Id_Acabado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `corte`
--
ALTER TABLE `corte`
  MODIFY `Id_Corte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `Id_Detalle_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;

--
-- AUTO_INCREMENT de la tabla `estatus_pedido`
--
ALTER TABLE `estatus_pedido`
  MODIFY `Id_Estatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `forma`
--
ALTER TABLE `forma`
  MODIFY `Id_Forma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `Id_Marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `Id_Modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `Id_Pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10011;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `Id_Tipo_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acabado_dpedido`
--
ALTER TABLE `acabado_dpedido`
  ADD CONSTRAINT `acabado_dpedido_ibfk_1` FOREIGN KEY (`Id_Acabado1`) REFERENCES `acabado` (`Id_Acabado`) ON UPDATE CASCADE,
  ADD CONSTRAINT `acabado_dpedido_ibfk_2` FOREIGN KEY (`Id_Detalle_Pedido1`) REFERENCES `detalle_pedido` (`Id_Detalle_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `actualizaciones_pedido`
--
ALTER TABLE `actualizaciones_pedido`
  ADD CONSTRAINT `actualizaciones_pedido_ibfk_1` FOREIGN KEY (`Id_Pedido2`) REFERENCES `pedido` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `actualizaciones_pedido_ibfk_2` FOREIGN KEY (`Id_Usuario1`) REFERENCES `usuario` (`Id_Usuario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `actualizaciones_pedido_ibfk_3` FOREIGN KEY (`Id_Estatus1`) REFERENCES `estatus_pedido` (`Id_Estatus`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `corte_dpedido`
--
ALTER TABLE `corte_dpedido`
  ADD CONSTRAINT `corte_dpedido_ibfk_1` FOREIGN KEY (`Id_Corte1`) REFERENCES `corte` (`Id_Corte`) ON UPDATE CASCADE,
  ADD CONSTRAINT `corte_dpedido_ibfk_2` FOREIGN KEY (`Id_Detalle_Pedido2`) REFERENCES `detalle_pedido` (`Id_Detalle_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`Id_Marca1`) REFERENCES `marca` (`Id_Marca`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`Id_Forma1`) REFERENCES `forma` (`Id_Forma`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_3` FOREIGN KEY (`Id_Pedido1`) REFERENCES `pedido` (`Id_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`Id_Tipo_User2`) REFERENCES `tipo_usuario` (`Id_Tipo_User`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`Id_Modulo1`) REFERENCES `modulo` (`Id_Modulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`Id_Tipo_User1`) REFERENCES `tipo_usuario` (`Id_Tipo_User`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
