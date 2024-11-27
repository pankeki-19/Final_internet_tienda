-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2024 at 09:41 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tienda_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito_compras`
--

CREATE TABLE `carrito_compras` (
  `id_prod_carrito` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carrito_compras`
--

INSERT INTO `carrito_compras` (`id_prod_carrito`, `id_usuario`, `id_producto`) VALUES
(1, 8, 3),
(2, 8, 12),
(3, 8, 3),
(4, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `historial_compras`
--

CREATE TABLE `historial_compras` (
  `id_compra` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_compra` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `historial_compras`
--

INSERT INTO `historial_compras` (`id_compra`, `id_usuario`, `id_producto`, `fecha_compra`) VALUES
(1, 8, 3, '2024-11-27 17:50:02'),
(2, 8, 4, '2024-11-27 17:50:02'),
(3, 8, 3, '2024-11-27 17:54:34'),
(4, 8, 12, '2024-11-27 17:54:34'),
(5, 8, 3, '2024-11-27 19:48:42'),
(6, 8, 4, '2024-11-27 19:48:42');

-- --------------------------------------------------------

--
-- Table structure for table `Productos`
--

CREATE TABLE `Productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `fotos` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `cantidad_almacen` int(11) NOT NULL,
  `fabricante` varchar(255) NOT NULL,
  `origen` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Productos`
--

INSERT INTO `Productos` (`id_producto`, `nombre`, `description`, `fotos`, `precio`, `cantidad_almacen`, `fabricante`, `origen`) VALUES
(1, 'Rebanada de Mantequilla', 'Pan dulce cortado en porciones individuales que se unta con mantequilla y se espolvorea con azúcar', 'uploads/Rebanada-de-Mantequilla.jpg', 11.00, 20, 'Panaderia Panfilo', 'Mexico'),
(2, 'Concha de Vainilla', 'Pan dulce mexicano esponjoso y suave, con una costra crocante de azúcar que imita la forma de una concha de mar', 'uploads/Concha_vainilla.jpg', 12.00, 11, 'Panaderia Panfilo', 'Mexico'),
(3, 'Ojo de Buey', 'Pan mexicano en forma de círculo, con una textura esponjosa y un toque dulce en cada mordida.', 'uploads/Ojos-de-buey-o-pan.jpg', 15.00, 2, 'Panaderia Panfilo', 'Mexico'),
(4, 'Bolillo', 'Pan para hacer molletes', 'uploads/bolillo.jpg', 2.00, 40, 'Panaderia Panfilo', 'Mexico'),
(5, 'Telera', 'Para hacer tortas', 'uploads/telera.jpg', 2.00, 30, 'Panaderia Panfilo', 'Mexico'),
(6, 'Rosca de Reyes', 'Pan dulce tradicional de la época navideña que se caracteriza por su forma redonda u ovalada.', 'uploads/rosca-de-reyes.jpg', 30.00, 50, 'Panaderia Panfilo', 'Mexico'),
(7, 'Pan de Muerto', 'Este pan redondo, adornado de “huesos” de masa, tiene como ingredientes principales la harina de trigo, azúcar, huevos, y generalmente está adornado con ajonjolí o bien cubierto de azúcar, como toque especial perfumado con naranja y anís.', 'uploads/pan-de-muerto.jpg', 20.00, 30, 'Panaderia Panfilo', 'Mexico'),
(8, 'Bigote', 'Pan alargado y esponjoso con una ligera cubierta de azúcar.', 'uploads/hq720.jpg', 8.00, 13, 'Panaderia Panfilo', 'Mexico'),
(9, 'Campechana', 'Pan hojaldrado, crujiente y ligeramente azucarado.', 'uploads/campechanas.webp', 7.00, 20, 'Panaderia Panfilo', 'Mexico'),
(10, 'Oreja', 'Pan crujiente de hojaldre con azúcar caramelizada.', 'uploads/oreja.webp', 12.00, 33, 'Panaderia Panfilo', 'Mexico'),
(11, 'Cocol', 'Pan dulce y plano con un toque de anís o piloncillo.', 'uploads/cocol.jpg', 13.00, 7, 'Panaderia Panfilo', 'Mexico'),
(12, 'Piedra', 'an dulce de textura dura, común para café', 'uploads/piedras.jpg', 11.00, 80, 'Panaderia Panfilo', 'Mexico'),
(13, 'Beso', 'Pan dulce relleno de crema o mermelada, espolvoreado con azúcar.', 'uploads/beso.webp', 10.00, 30, 'Panaderia Panfilo', 'Mexico'),
(14, 'Cuerno', 'Pan en forma de media luna, suave y con azúcar o mantequilla.', 'uploads/cuernito.webp', 8.00, 100, 'Panaderia Panfilo', 'Mexico'),
(15, 'Garibaldi', 'Pan pequeño cubierto de mermelada y grajeas de colores.', 'uploads/garibaldi.webp', 10.00, 30, 'Panaderia Panfilo', 'Mexico'),
(16, 'Eclair', 'Pastelito alargado de masa choux, relleno de crema y cubierto de glaseado, generalmente de chocolate.', 'uploads/eclair.webp', 30.00, 98, 'Panaderia Panfilo', 'Mexico'),
(17, 'Cochinito', '**Cochinito de Piloncillo**  \r\nPan suave con forma de cerdito, endulzado con piloncillo y un toque de canela.', 'uploads/puerquitos.jpg', 8.00, 20, 'Panaderia Panfilo', 'Mexico'),
(18, 'Rol de Canela', '**Rol de Canela**  \r\nPan enrollado con relleno de canela y azúcar, a menudo cubierto con glaseado dulce.', 'uploads/rol-de-canela.jpg', 40.00, 30, 'Panaderia Panfilo', 'Mexico'),
(19, 'Panqué de Naranja', '**Panqué de Naranja**  \r\nPan esponjoso con un suave sabor a naranja, ideal para acompañar con café o té.', 'uploads/orange.webp', 20.00, 30, 'Panaderia Panfilo', 'Mexico'),
(20, 'Chocolatin', '**Chocolatín**  \r\nPan hojaldrado relleno de chocolate, perfecto para un antojo dulce.', 'uploads/chocolatin.webp', 13.00, 40, 'Panaderia Panfilo', 'Mexico'),
(21, 'Dona', '**Dona**  \r\nPan frito en forma de aro, cubierto de azúcar, glaseado o decorado con chispas.', 'uploads/dona.webp', 15.00, 27, 'Panaderia Panfilo', 'Mexico'),
(22, 'Muffin de Chocolate', '**Muffin de Chocolate**  \r\nPanecillo suave y esponjoso, lleno de sabor a chocolate y a menudo con trozos de chocolate en su interior.', 'uploads/muffin-chocolate.jpg', 30.00, 40, 'Panadería Cupcake', 'USA'),
(23, 'Mantecada', '**Mantecada**  \r\nPan dulce, esponjoso y con un delicado sabor a mantequilla.', 'uploads/mantecadas.webp', 13.00, 22, 'Panaderia Panfilo', 'Mexico'),
(24, 'Cupcake Cumpleaños', '**Cupcake**  \r\nPequeño pastel individual, esponjoso, decorado con glaseado y diversos toppings.', 'uploads/cupcake-bday.png', 25.00, 44, 'Panadería Cupcake', 'Piltover'),
(25, 'Bear Claw', '**Bear Claw**  \r\nPan hojaldrado con forma de garra, relleno de almendra o canela y cubierto de azúcar.', 'uploads/BearClaw.webp', 40.00, 58, 'Panadería Maple', 'Canadá'),
(26, 'Butter Tart', '**Butter Tarts**  \r\nPequeñas tartas de masa crujiente, rellenas de una mezcla dulce de mantequilla, azúcar y huevo, a veces con pasas o nueces.', 'uploads/butter-tarts.jpg', 25.00, 40, 'Panadería Maple', 'Canadá'),
(27, 'Nanaimo Bar', '**Nanaimo Bar**  \r\nPostre canadiense sin hornear, con capas de galleta, crema de mantequilla y chocolate.', 'uploads/Nanaimo-Bars-square.jpg', 20.00, 30, 'Panadería Maple', 'Canadá'),
(28, 'BeaverTails', '**BeaverTails**  \r\nPostre canadiense de masa frita en forma alargada, cubierto con azúcar, canela o toppings variados.', 'uploads/beavertails.webp', 35.00, 20, 'Panadería Maple', 'Canadá'),
(29, 'Flapper Pie', 'Una tarta típica de las praderas canadienses, hecha con una base de galletas Graham, un relleno de crema pastelera y un merengue encima.', 'uploads/flapperpie.jpg', 40.00, 22, 'Panadería Maple', 'Canadá'),
(30, 'Fried Bannock', 'Bannock es un tipo de pan rápido inspirado en las tradiciones indígenas. Se puede freír o hornear, y las versiones dulces incluyen miel, jarabe de arce o azúcar como acompañamiento.', 'uploads/fried-bannock.jpg', 10.00, 40, 'Panadería Maple', 'Canadá'),
(31, 'Maple Butter Pies', 'Tartas rellenas de una rica mezcla de mantequilla y jarabe de arce, ideales para los amantes de los sabores típicos canadienses', 'uploads/Maple-Browned-Butter-Pie.jpg', 20.00, 46, 'Panadería Maple', 'Canadá'),
(32, 'Maple Pecan Danish', 'Influenciados por las tradiciones danesas y el amor canadiense por el jarabe de arce, estos danishes son populares en panaderías y cafeterías.', 'uploads/Maple-Pecan_Danish.webp', 40.00, 12, 'Panadería Maple', 'Canadá');

-- --------------------------------------------------------

--
-- Table structure for table `Usuarios`
--

CREATE TABLE `Usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `num_tarjeta` varchar(20) NOT NULL,
  `cod_postal` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Usuarios`
--

INSERT INTO `Usuarios` (`id_usuario`, `nombre`, `correo`, `password`, `fecha_nacimiento`, `num_tarjeta`, `cod_postal`) VALUES
(1, 'Luis', 'luis@hotmail.com', '1234', '2015-11-04', '00138717382911232122', '03500'),
(6, 'Jorge', 'jorge@hola.com', '$2y$10$pkJetv6.S3eXrdDgppZFiOuhzv4quCb17zARN32QZ/fB6WprBNZGO', '2024-11-01', '001223948301931920', '02433'),
(7, 'Luisa', 'luisa@yo.com', '$2y$10$f7Ba8f8g02e9.Ve8dFD1POgc39f5CihLfjn2WBtdwDolQU.zQhrqu', '2024-11-07', '00128397483642874629', '02344'),
(8, 'Oscar', 'oscar@hotmail.com', '$2y$10$mlIuriXcpzfJIQmHsAxsJ.AlMAl2M2C5xBwTYVFZvgwNDag3vG9d6', '2024-11-01', '192379834201923830', '045600'),
(9, 'Alondra', 'alondra@hotmail.com', '$2y$10$zw3v3w1wzQ0TSN46wWzgz.KT9CDbeHrCJLJWRJtQwAPUDG60.DsUO', '2024-11-02', '192379834201923123', '045660'),
(10, 'Josefa', 'josefa@hotmail.com', '$2y$10$PfbD8pi4uvj3LAesVy52Nu418S/MSi81wGVsRBWVN8qXq10CtTOCC', '2024-11-02', '192379834201923123', '023443');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito_compras`
--
ALTER TABLE `carrito_compras`
  ADD PRIMARY KEY (`id_prod_carrito`);

--
-- Indexes for table `historial_compras`
--
ALTER TABLE `historial_compras`
  ADD PRIMARY KEY (`id_compra`);

--
-- Indexes for table `Productos`
--
ALTER TABLE `Productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `Usuarios`
--
ALTER TABLE `Usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito_compras`
--
ALTER TABLE `carrito_compras`
  MODIFY `id_prod_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `historial_compras`
--
ALTER TABLE `historial_compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Productos`
--
ALTER TABLE `Productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `Usuarios`
--
ALTER TABLE `Usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
