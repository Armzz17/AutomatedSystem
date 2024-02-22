-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 20, 2024 at 04:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `prod`
--

CREATE TABLE `prod` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `netWt` varchar(30) NOT NULL,
  `quanity` varchar(30) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `lStockV` int(12) NOT NULL,
  `date` varchar(30) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prod`
--

INSERT INTO `prod` (`prod_id`, `prod_name`, `netWt`, `quanity`, `barcode`, `lStockV`, `date`, `price`) VALUES
(13, 'Clover Bits', '35g', '40', '4800216128101', 15, '2023-09-27 22:36:24', 7.75),
(14, 'Cheezy Cheddar Jalapeno', '22g', '32', '4800216125728', 10, '2023-09-27 22:37:47', 8.25),
(15, 'Nissin Yakisoba Spicy Chicken', '59g', '40', '4800016551604', 5, '2023-09-27 22:38:43', 18.25),
(16, 'Tomi ', '25g', '30', '4800521441832', 15, '2023-09-27 22:39:20', 7.25),
(17, 'Boy Bawang Cornick BBQ', '100g', '32', '4809011681507', 10, '2023-09-27 22:40:41', 21),
(18, 'Tang Orange', '19g', '41', '7622300559991', 5, '2023-09-27 22:41:15', 24),
(19, 'Payless Pancit Canton Xtra Big', '125g', '33', '4800016555985', 10, '2023-09-27 22:42:18', 22),
(20, 'Clover Chips Chili Cheese', '24g', '20', '480021622215', 15, '2023-09-27 22:43:33', 7.25),
(23, 'Roller Coaster Cheddar Cheese', '24', '39', '4800016661006', 15, '2023-10-13 00:35:10', 7.25);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sale_ID` int(11) NOT NULL,
  `transaction_id` varchar(30) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `quanity` varchar(30) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sale_ID`, `transaction_id`, `prod_name`, `quanity`, `barcode`, `date`, `price`) VALUES
(5, '651d70996c04c', 'Clover Bits', '3', '4800216128101', '2023-10-04', 7.75),
(6, '651d70996c04c', 'Cheezy Cheddar Jalapeno', '3', '4800216125728', '2023-10-04', 8.25),
(7, '651d70e75f350', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(8, '651d70e75f350', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(9, '651d70f31dcb2', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(10, '651d70f8ac907', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(11, '651d712929acd', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(12, '651d712929acd', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(13, '651d74fecc035', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(14, '651d74fecc035', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(15, '651d75168f6d0', 'Cheezy Cheddar Jalapeno', '2', '4800216125728', '2023-10-04', 8.25),
(16, '651d75168f6d0', 'Clover Bits', '2', '4800216128101', '2023-10-04', 7.75),
(17, '651d7cebd898b', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(18, '651d7cebd898b', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(19, '651d7d027155d', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(20, '651d7f724d907', 'Clover Bits', '4', '4800216128101', '2023-10-04', 7.75),
(21, '651d7f724d907', 'Cheezy Cheddar Jalapeno', '3', '4800216125728', '2023-10-04', 8.25),
(22, '651d7f885e453', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(23, '651d7f885e453', 'Cheezy Cheddar Jalapeno', '2', '4800216125728', '2023-10-04', 8.25),
(24, '651d807c46aef', 'Clover Bits', '3', '4800216128101', '2023-10-04', 7.75),
(25, '651d807c46aef', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(26, '651d81084fa17', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(27, '651d81f32a59e', 'Clover Bits', '2', '4800216128101', '2023-10-04', 7.75),
(28, '651d81f32a59e', 'Cheezy Cheddar Jalapeno', '3', '4800216125728', '2023-10-04', 8.25),
(29, '651d827c1c049', 'Clover Bits', '3', '4800216128101', '2023-10-04', 7.75),
(30, '651d827c1c049', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(31, '651d827c1c049', 'Nissin Yakisoba Spicy Chicken', '1', '4800016551604', '2023-10-04', 18),
(32, '651d827c1c049', 'Tomi ', '2', '4800521441832', '2023-10-04', 7.25),
(33, '651d827c1c049', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-04', 21),
(34, '651d827c1c049', 'Tang Orange', '1', '7622300559991', '2023-10-04', 24),
(35, '651d827c1c049', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2023-10-04', 22),
(36, '651d827c1c049', 'Clover Chips Chili Cheese', '1', '480021622215', '2023-10-04', 7.25),
(37, '651d8679ef6a6', 'Tomi ', '2', '4800521441832', '2023-10-04', 7.25),
(38, '651d897b0acd0', 'Nissin Yakisoba Spicy Chicken', '1', '4800016551604', '2023-10-04', 18.25),
(39, '651d89c0800a1', 'Clover Bits', '1', '4800216128101', '2023-10-04', 7.75),
(40, '651d89c0800a1', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-04', 8.25),
(41, '651d89c0800a1', 'Tomi ', '1', '4800521441832', '2023-10-04', 7.25),
(42, '651d8d2aa1a28', 'Clover Bits', '3', '4800216128101', '2023-10-05', 7.75),
(43, '651d8d2aa1a28', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-05', 8.25),
(44, '651d8d2aa1a28', 'Tomi ', '1', '4800521441832', '2023-10-05', 7.25),
(45, '651d8ff329f67', 'Clover Bits', '1', '4800216128101', '2023-10-05', 7.75),
(46, '651d8ff329f67', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-05', 8.25),
(47, '651d904facaa0', 'Clover Bits', '2', '4800216128101', '2023-10-05', 7.75),
(48, '651d904facaa0', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-05', 8.25),
(49, '651d904facaa0', 'Tomi ', '1', '4800521441832', '2023-10-05', 7.25),
(50, '6523d0934e785', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-09', 21),
(51, '6523d0934e785', 'Clover Bits', '1', '4800216128101', '2023-10-09', 7.75),
(52, '6523d1d608e80', 'Clover Bits', '11', '4800216128101', '2023-10-09', 7.75),
(53, '6523d1d608e80', 'Boy Bawang Cornick BBQ', '3', '4809011681507', '2023-10-09', 21),
(54, '6523d7315860d', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-09', 8.25),
(55, '6525567ec8171', 'Boy Bawang Cornick BBQ', '7', '4809011681507', '2023-10-10', 21),
(65, '6525a4777f602', 'Tang Orange', '1', '7622300559991', '2023-10-11', 24),
(66, '6525a4777f602', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2023-10-11', 22),
(67, '6525a4777f602', 'Clover Bits', '1', '4800216128101', '2023-10-11', 7.75),
(68, '6525a57964be1', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2023-10-11', 22),
(69, '6525a5833261d', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2023-10-11', 22),
(70, '6525a69087a8a', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-11', 21),
(71, '6525a6bc56b34', 'Nissin Yakisoba Spicy Chicken', '2', '4800016551604', '2023-10-11', 18.25),
(72, '6525a6bc56b34', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2023-10-11', 22),
(73, '6525a6bc56b34', 'Cheezy Cheddar Jalapeno', '1', '4800216125728', '2023-10-11', 8.25),
(74, '6525ab2571ea0', 'Tomi ', '1', '4800521441832', '2023-10-11', 7.25),
(75, '6525ab2571ea0', 'Clover Bits', '1', '4800216128101', '2023-10-11', 7.75),
(76, '65269a4bdb0af', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-11', 21),
(77, '65269a4bdb0af', 'Nissin Yakisoba Spicy Chicken', '1', '4800016551604', '2023-10-11', 18.25),
(79, '6527b77deaeea', 'Tomi ', '1', '4800521441832', '2023-10-12', 7.25),
(80, '6527bdc37715c', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-12', 21),
(81, '6527bdc37715c', 'Clover Bits', '1', '4800216128101', '2023-10-12', 7.75),
(83, '6527def633c46', 'Boy Bawang Cornick BBQ', '3', '4809011681507', '2023-10-12', 21),
(84, '6527df3a25910', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2023-10-12', 21),
(85, '6527df3a25910', 'Clover Bits', '3', '4800216128101', '2023-10-12', 7.75),
(87, '6527e3efa0886', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-12', 21),
(88, '6527e53b44703', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-12', 21),
(89, '6527ea521428b', 'Clover Bits', '1', '4800216128101', '2023-10-12', 7.75),
(90, '6527ea521428b', 'Tang Orange', '1', '7622300559991', '2023-10-12', 24),
(92, '6527f79039d06', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2023-10-12', 21),
(93, '6527f79039d06', 'Clover Bits', '1', '4800216128101', '2023-10-12', 7.75),
(94, '6527f79039d06', 'Tang Orange', '1', '7622300559991', '2023-10-12', 24),
(95, '65281e9a25898', 'Nissin Yakisoba Spicy Chicken', '15', '4800016551604', '2023-10-13', 18.25),
(96, '65281e9a25898', 'Boy Bawang Cornick BBQ', '25', '4809011681507', '2023-10-13', 21),
(98, '6528206704c31', 'Roller Coaster Cheddar Cheese', '19', '4800016661006', '2023-10-13', 7.25),
(99, '6528206704c31', 'Clover Bits', '15', '4800216128101', '2023-10-13', 7.75),
(101, '652820b2d123a', 'Roller Coaster Cheddar Cheese', '2', '4800016661006', '2023-10-13', 7.25),
(102, '652820b2d123a', 'Clover Bits', '2', '4800216128101', '2023-10-13', 7.75),
(104, '652821d839147', 'Boy Bawang Cornick BBQ', '20', '4809011681507', '2023-10-13', 21),
(105, '6528241e4510b', 'Clover Bits', '6', '4800216128101', '2023-10-13', 7.75),
(106, '6528241e4510b', 'Roller Coaster Cheddar Cheese', '5', '4800016661006', '2023-10-13', 7.25),
(107, '65294bc2699fb', 'Clover Bits', '5', '4800216128101', '2023-10-13', 7.75),
(108, '65294bc2699fb', 'Roller Coaster Cheddar Cheese', '3', '4800016661006', '2023-10-13', 7.25),
(110, '65d4192536ad2', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(111, '65d41a825505c', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(112, '65d4252547fdd', 'Clover Bits', '8', '4800216128101', '2024-02-20', 7.75),
(114, '65d459efdba39', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(115, '65d45a2d3a06e', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(116, '65d45bd4d2a28', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(117, '65d45c881ef04', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(118, '65d45d16c28b9', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(119, '65d45d33de2d2', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(120, '65d45d7225a54', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(121, '65d45defbca24', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2024-02-20', 21),
(122, '65d45defbca24', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(124, '65d45e571e1d0', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(125, '65d45e9fa274a', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(126, '65d45f163c997', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(138, '65d460b0c08f3', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(139, '65d4610f21be1', 'Tang Orange', '2', '7622300559991', '2024-02-20', 24),
(140, '65d461bd8e9f8', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(141, '65d46227d5bcf', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(142, '65d46277ad1ad', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(143, '65d463120680e', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(144, '65d463120680e', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(146, '65d4636a61365', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(147, '65d463d44bf7b', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(148, '65d4645b82b10', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(149, '65d4647249ee7', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(150, '65d464d0be5b3', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(151, '65d46524a1e8b', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(152, '65d4659ef1a8b', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(153, '65d465b085a11', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(154, '65d4661639eb4', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(155, '65d46692e7373', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(156, '65d466b91c739', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(157, '65d466b91c739', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(158, '65d466b91c739', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(159, '65d46703df396', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(160, '65d46703df396', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(161, '65d46703df396', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(162, '65d46703df396', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(166, '65d467e34e657', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(167, '65d467e34e657', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(168, '65d467e34e657', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(169, '65d46c09dfb5a', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(170, '65d46c09dfb5a', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(172, '65d46c307049d', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(173, '65d46c307049d', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(174, '65d46c307049d', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(175, '65d46ca381e1e', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(176, '65d46cd6d5d03', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(177, '65d46cd6d5d03', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(179, '65d46d5059227', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(180, '65d46dcdb4cac', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(181, '65d46df403735', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(182, '65d46e2fcb6df', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(183, '65d46e6ef0df9', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(184, '65d46eabe6852', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(185, '65d46eabe6852', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(187, '65d46f296e002', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(188, '65d46f3a40b62', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(189, '65d46f6f1f944', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(190, '65d46f8fe0956', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(191, '65d46fb314d4a', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(192, '65d46fe4467ec', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(193, '65d46fe4467ec', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(195, '65d470a25e80f', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(196, '65d470ff7b2d0', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(197, '65d470ff7b2d0', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(199, '65d471471be00', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(200, '65d471471be00', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(202, '65d4721c6f13b', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(203, '65d4728fe1f51', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(204, '65d472e7b8d95', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(205, '65d4744d5e463', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(206, '65d474aed73fb', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(207, '65d474aed73fb', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(209, '65d474e019463', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(210, '65d474e019463', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(212, '65d4753c50146', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(213, '65d4753c50146', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(215, '65d47584622f5', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(216, '65d47584622f5', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(217, '65d47584622f5', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2024-02-20', 22),
(218, '65d475a0330f7', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(219, '65d475a0330f7', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(221, '65d475b9b0200', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(222, '65d475b9b0200', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(223, '65d475b9b0200', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2024-02-20', 21),
(224, '65d47bd626d3c', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(225, '65d47bd626d3c', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(226, '65d4a7275a918', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(227, '65d4a7275a918', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2024-02-20', 22),
(228, '65d4a7275a918', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(229, '65d4a77cc569d', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2024-02-20', 21),
(230, '65d4a84b1cacb', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2024-02-20', 22),
(231, '65d4a915d5ada', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(232, '65d4a915d5ada', 'Roller Coaster Cheddar Cheese', '2', '4800016661006', '2024-02-20', 7.25),
(234, '65d4a97160a87', 'Roller Coaster Cheddar Cheese', '2', '4800016661006', '2024-02-20', 7.25),
(235, '65d4a97160a87', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(237, '65d4a9e4eefb0', 'Tang Orange', '2', '7622300559991', '2024-02-20', 24),
(238, '65d4a9e4eefb0', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(240, '65d4aa3e2f746', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2024-02-20', 21),
(241, '65d4aa3e2f746', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(243, '65d4aa9234e63', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(244, '65d4aa9234e63', 'Boy Bawang Cornick BBQ', '2', '4809011681507', '2024-02-20', 21),
(246, '65d4ab7ef3c8c', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(247, '65d4ab7ef3c8c', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(248, '65d4ab7ef3c8c', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2024-02-20', 22),
(249, '65d4abb28c881', 'Tang Orange', '2', '7622300559991', '2024-02-20', 24),
(250, '65d4abb28c881', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(252, '65d4abf7d8119', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(253, '65d4ac1c26a31', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(254, '65d4ac3f6e538', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(255, '65d4ac7b1e3af', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(256, '65d4acbc08adf', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(257, '65d4ace691dca', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(258, '65d4ad19a2e09', 'Roller Coaster Cheddar Cheese', '1', '4800016661006', '2024-02-20', 7.25),
(259, '65d4ad304528f', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(260, '65d4b3b30f243', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(261, '65d4b40ae517d', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(262, '65d4b40ae517d', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(263, '65d4b40ae517d', 'Payless Pancit Canton Xtra Big', '2', '4800016555985', '2024-02-20', 22),
(264, '65d4c6c9ddf66', 'Clover Bits', '2', '4800216128101', '2024-02-20', 7.75),
(265, '65d4c6c9ddf66', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(267, '65d4c71245a4c', 'Payless Pancit Canton Xtra Big', '1', '4800016555985', '2024-02-20', 22),
(268, '65d4c71245a4c', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(270, '65d4c8adc48d0', 'Boy Bawang Cornick BBQ', '1', '4809011681507', '2024-02-20', 21),
(271, '65d4c8adc48d0', 'Tang Orange', '1', '7622300559991', '2024-02-20', 24),
(272, '65d4c8adc48d0', 'Clover Bits', '1', '4800216128101', '2024-02-20', 7.75),
(273, '65d4c8adc48d0', 'Roller Coaster Cheddar Cheese', '2', '4800016661006', '2024-02-20', 7.25);

-- --------------------------------------------------------

--
-- Table structure for table `selected_items`
--

CREATE TABLE `selected_items` (
  `id` int(12) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `account_lvl` varchar(30) NOT NULL,
  `date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `user_id`, `username`, `password`, `account_lvl`, `date`) VALUES
(1, 'AMSYSTEM32', 0, 'admin@gmail.com', 'admin', 'Admin', '2023-09-26 22:14:28'),
(2, 'Cashier', 1193855, 'cashier@gmail.com', 'test', 'Cashier', '2023-09-26 22:17:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `prod`
--
ALTER TABLE `prod`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sale_ID`);

--
-- Indexes for table `selected_items`
--
ALTER TABLE `selected_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_product_barcode` (`product_name`,`barcode`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `prod`
--
ALTER TABLE `prod`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sale_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

--
-- AUTO_INCREMENT for table `selected_items`
--
ALTER TABLE `selected_items`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
