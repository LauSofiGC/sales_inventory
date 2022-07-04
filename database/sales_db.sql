-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-07-2021 a las 00:44:35
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
-- Base de datos: `sales_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `enterprise`
--

CREATE TABLE `enterprise` (
  `idEnterprise` int(11) NOT NULL,
  `enterpriseName` varchar(85) NOT NULL,
  `address` varchar(95) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `enterprise`
--

INSERT INTO `enterprise` (`idEnterprise`, `enterpriseName`, `address`, `phoneNumber`) VALUES
(1, 'Empresa S.A.S', 'Cra 1 N 01-02 Tunja-Boyacá', '123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `person`
--

CREATE TABLE `person` (
  `idPerson` int(11) NOT NULL,
  `documentPerson` varchar(25) NOT NULL,
  `Role_idRole` int(11) NOT NULL,
  `correo` varchar(150) DEFAULT NULL,
  `clave` varchar(200) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `person`
--

INSERT INTO `person` (`idPerson`, `documentPerson`, `Role_idRole`, `correo`, `clave`, `name`) VALUES
(1, '123456', 2, 'admin@mail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'Laura'),
(2, '246810', 1, 'empleado@mail.com', '3627909a29c31381a071ec27f7c9ca97726182aed29a7ddd2e54353322cfb30abb9e3a6df2ac2c20fe23436311d678564d0c8d305930575f60e2d3d048184d79', 'Sofía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `idPRODUCT` int(11) NOT NULL,
  `nameProduct` varchar(45) NOT NULL,
  `productState` smallint(1) NOT NULL,
  `provider_idProvider` int(11) NOT NULL,
  `enterprise_idEnterprise` int(11) NOT NULL,
  `productType_idproductType` int(11) NOT NULL,
  `precioBruto` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`idPRODUCT`, `nameProduct`, `productState`, `provider_idProvider`, `enterprise_idEnterprise`, `productType_idproductType`, `precioBruto`, `quantity`) VALUES
(1, 'Arroz', 1, 1, 1, 3, '1200.00', 24),
(2, 'Pan', 1, 3, 1, 12, '500.00', 37),
(3, 'Fríjol', 1, 1, 1, 7, '12000.00', 5),
(4, 'Aceitunas', 1, 4, 1, 15, '7000.00', 22),
(5, 'Pollo', 1, 1, 1, 1, '12000.00', 21),
(6, 'Galletas', 1, 1, 1, 12, '3400.00', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producttype`
--

CREATE TABLE `producttype` (
  `idPRODUCTType` int(11) NOT NULL,
  `nameProductType` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `producttype`
--

INSERT INTO `producttype` (`idPRODUCTType`, `nameProductType`) VALUES
(1, 'Cárnicos, embutidos, pollo y pescado'),
(2, 'Lácteos'),
(3, 'Cereales'),
(4, 'Aseo personal'),
(5, 'Aseo para el hogar'),
(6, 'Importados'),
(7, 'Granos'),
(8, 'Condimentos y salsas'),
(9, 'Alimento para mascotas'),
(10, 'Frutas y verduras'),
(11, 'Belleza'),
(12, 'Panes y galletas'),
(13, 'Café y chocolates'),
(14, 'Confitería'),
(15, 'Snacks'),
(16, 'Encurtidos y enlatados'),
(17, 'Frutos secos'),
(18, 'Desechables'),
(19, 'Licores y bebidas alcohólicas'),
(20, 'Gaseosas, jugos y refrescos');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `idProvider` int(11) NOT NULL,
  `phoneNumber` varchar(25) NOT NULL,
  `providerName` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`idProvider`, `phoneNumber`, `providerName`) VALUES
(1, '315478962', 'Paco Proveedor'),
(2, '323456', 'Pedro Proveedor'),
(4, '12334543', 'Ana Proveedora'),
(5, '5945221', 'Kate Proveedora'),
(6, '7865425', 'Taffy Proveedora');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role`
--

CREATE TABLE `role` (
  `idRole` int(11) NOT NULL,
  `roleName` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `role`
--

INSERT INTO `role` (`idRole`, `roleName`) VALUES
(1, 'Empleado'),
(2, 'Administrador'),
(3, 'Cliente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax`
--

CREATE TABLE `tax` (
  `idTAX` int(11) NOT NULL,
  `taxName` varchar(45) NOT NULL,
  `value` decimal(2,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tax`
--

INSERT INTO `tax` (`idTAX`, `taxName`, `value`) VALUES
(1, 'Iva 19%', '0.19'),
(2, 'Iva 5%', '0.05'),
(3, 'Excluido', '0.00'),
(4, 'Exento', '0.00');
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tax_product`
--

CREATE TABLE `tax_product` (
  `idTAX_PRODUCT` int(11) NOT NULL,
  `dateInit` date DEFAULT NULL,
  `Product_idProduct` int(11) NOT NULL,
  `Tax_idTax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket`
--

CREATE TABLE `ticket` (
  `idTicket` int(11) NOT NULL,
  `ticketDate` varchar(45) DEFAULT NULL,
  `Person_idPerson` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ticket_tax_product`
--

CREATE TABLE `ticket_tax_product` (
  `idTicket_TAX_PRODUCT` int(11) NOT NULL,
  `dateTicketTaxProductDevolution` date DEFAULT NULL,
  `Tax_Product_idTax_Product` int(11) NOT NULL,
  `Ticket_idTicket` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `devolution` (
  `idDevolution` int(11) NOT NULL,
  `dateDevolution` date DEFAULT NULL,
  `Ticket_tax_product_idTicTaxPro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  ADD PRIMARY KEY (`idEnterprise`);

--
-- Indices de la tabla `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idPerson`),
  ADD KEY `FK_person_role` (`Role_idRole`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`idPRODUCT`),
  ADD KEY `FK_product_enterprise` (`enterprise_idEnterprise`),
  ADD KEY `FK_product_PrtoductType` (`productType_idproductType`),
  ADD KEY `FK_PRODUCT_provider` (`provider_idProvider`);

--
-- Indices de la tabla `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`idPRODUCTType`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`idProvider`);

--
-- Indices de la tabla `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`idRole`);
  
ALTER TABLE `devolution`
  ADD PRIMARY KEY (`idDevolution`),
  ADD KEY `FK_ticket_tax_prod` (`Ticket_tax_product_idTicTaxPro`);

--
-- Indices de la tabla `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`idTAX`);

--
-- Indices de la tabla `tax_product`
--
ALTER TABLE `tax_product`
  ADD PRIMARY KEY (`idTAX_PRODUCT`),
  ADD KEY `FK_taxProduct_product` (`Product_idProduct`),
  ADD KEY `FK_TAXPRODUCT_TAX` (`Tax_idTax`);

--
-- Indices de la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`idTicket`),
  ADD KEY `Person_idPerson` (`Person_idPerson`);

--
-- Indices de la tabla `ticket_tax_product`
--
ALTER TABLE `ticket_tax_product`
  ADD PRIMARY KEY (`idTicket_TAX_PRODUCT`),
  ADD KEY `FK_TicketTaxProduct_TaxProduct` (`Tax_Product_idTax_Product`),
  ADD KEY `FK_TicketTaxProduct_Ticket` (`Ticket_idTicket`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `enterprise`
--
ALTER TABLE `enterprise`
  MODIFY `idEnterprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `person`
--
ALTER TABLE `person`
  MODIFY `idPerson` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `idPRODUCT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producttype`
--
ALTER TABLE `producttype`
  MODIFY `idPRODUCTType` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `idProvider` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `role`
--
ALTER TABLE `role`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tax`
--
ALTER TABLE `tax`
  MODIFY `idTAX` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tax_product`
--
ALTER TABLE `tax_product`
  MODIFY `idTAX_PRODUCT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket`
--
ALTER TABLE `ticket`
  MODIFY `idTicket` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ticket_tax_product`
--
ALTER TABLE `ticket_tax_product`
  MODIFY `idTicket_TAX_PRODUCT` int(11) NOT NULL AUTO_INCREMENT;
  
ALTER TABLE `devolution`
  MODIFY `idDevolution` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `FK_person_role` FOREIGN KEY (`Role_idRole`) REFERENCES `role` (`idRole`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_PRODUCT_provider` FOREIGN KEY (`provider_idProvider`) REFERENCES `provider` (`idProvider`),
  ADD CONSTRAINT `FK_product_PrtoductType` FOREIGN KEY (`productType_idproductType`) REFERENCES `producttype` (`idPRODUCTType`),
  ADD CONSTRAINT `FK_product_enterprise` FOREIGN KEY (`enterprise_idEnterprise`) REFERENCES `enterprise` (`idEnterprise`);

--
-- Filtros para la tabla `tax_product`
--
ALTER TABLE `tax_product`
  ADD CONSTRAINT `FK_TAXPRODUCT_TAX` FOREIGN KEY (`Tax_idTax`) REFERENCES `tax` (`idTAX`),
  ADD CONSTRAINT `FK_taxProduct_product` FOREIGN KEY (`Product_idProduct`) REFERENCES `product` (`idPRODUCT`);

--
-- Filtros para la tabla `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`Person_idPerson`) REFERENCES `person` (`idPerson`);

--
-- Filtros para la tabla `ticket_tax_product`
--
ALTER TABLE `ticket_tax_product`
  ADD CONSTRAINT `FK_TicketTaxProduct_TaxProduct` FOREIGN KEY (`Tax_Product_idTax_Product`) REFERENCES `tax_product` (`idTAX_PRODUCT`),
  ADD CONSTRAINT `FK_TicketTaxProduct_Ticket` FOREIGN KEY (`Ticket_idTicket`) REFERENCES `ticket` (`idTicket`);
  
ALTER TABLE `devolution`
  ADD CONSTRAINT `FK_ticket_tax_prod` FOREIGN KEY (`Ticket_tax_product_idTicTaxPro`) REFERENCES `ticket_tax_product` (`idTicket_TAX_PRODUCT`);
  
ALTER TABLE `devolution` ADD `approved` BOOLEAN NOT NULL AFTER `Ticket_tax_product_idTicTaxPro`; 

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
