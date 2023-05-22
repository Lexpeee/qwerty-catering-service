-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 01:12 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcatering`
--
CREATE DATABASE IF NOT EXISTS `dbcatering` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dbcatering`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(10) NOT NULL,
  `cat_name` varchar(64) NOT NULL,
  `cat_image` varchar(255) NOT NULL,
  `cat_isshow` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_name`, `cat_image`, `cat_isshow`) VALUES
(7, 'Appetizers', 'appetizers.jpg', 1),
(8, 'Desserts', 'desserts.jpg', 1),
(9, 'Drinks', 'drinks.jpg', 1),
(10, 'Main Course', 'maincourse.jpg', 1),
(12, 'Soup', 'soup.jpg', 1),
(23, 'Breakfast', 'breakfast.jpg', 1),
(27, 'Salads', 'salads.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory_log`
--

CREATE TABLE `inventory_log` (
  `inv_id` int(11) NOT NULL,
  `inv_user_id` int(11) NOT NULL,
  `inv_payment_id` int(11) NOT NULL,
  `inv_pcont_id` int(11) NOT NULL,
  `inv_quantity` int(11) NOT NULL,
  `inv_price` int(11) NOT NULL,
  `inv_date` date NOT NULL,
  `inv_time` time NOT NULL,
  `inv_category` varchar(255) NOT NULL,
  `inv_isPackaged` int(1) NOT NULL COMMENT '1 = yes, 0 = no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messagesbox`
--

CREATE TABLE `messagesbox` (
  `mbox_id` int(5) NOT NULL,
  `mbox_receiver_id` int(11) NOT NULL,
  `mbox_name` varchar(32) NOT NULL,
  `mbox_email` varchar(32) NOT NULL,
  `mbox_contact` varchar(16) NOT NULL,
  `mbox_message` text NOT NULL,
  `mbox_type` varchar(32) NOT NULL,
  `mbox_datesent` date NOT NULL,
  `mbox_timesent` time NOT NULL,
  `mbox_isNotified` int(11) NOT NULL,
  `mbox_isRead` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messagesbox`
--

INSERT INTO `messagesbox` (`mbox_id`, `mbox_receiver_id`, `mbox_name`, `mbox_email`, `mbox_contact`, `mbox_message`, `mbox_type`, `mbox_datesent`, `mbox_timesent`, `mbox_isNotified`, `mbox_isRead`) VALUES
(1, 0, 'Arthur', 'sgr@rocker.com', '0189273661', 'panget ng system niyo', 'contactform', '2018-06-28', '06:52:11', 0, 0),
(2, 0, 'Alexis', 'ixspnd.ap@gmail.com', '0192319i273', 'I love yur veeds', 'contactform', '2018-06-30', '12:00:22', 1, 0),
(3, 0, 'asda', 'null', 'null', 'wdaasdaw<br>Order No: 501', 'ordercounter', '2018-06-30', '12:08:36', 0, 0),
(5, 0, 'awdasda', 'null', 'null', 'wdasd<br>Order No: 501', 'ordercounter', '2018-06-30', '12:46:32', 0, 0),
(6, 0, 'awdasda', 'null', 'null', 'wdasd<br>Order No: 501', 'ordercounter', '2018-06-30', '12:46:41', 0, 0),
(7, 0, 'awdasda', 'null', 'null', 'wdasd<br>Order No: 501', 'ordercounter', '2018-06-30', '12:46:54', 0, 0),
(8, 0, 'awdasda', 'null', 'null', 'wdasd<br>Order No: 501', 'ordercounter', '2018-06-30', '12:46:58', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(64) NOT NULL,
  `notif_date_generated` date NOT NULL,
  `notif_time_generated` time NOT NULL,
  `notif_isRead` int(1) NOT NULL,
  `notif_received_user` int(8) NOT NULL,
  `notif_text` varchar(256) NOT NULL,
  `notif_type` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `notif_date_generated`, `notif_time_generated`, `notif_isRead`, `notif_received_user`, `notif_text`, `notif_type`) VALUES
(50, '2018-04-07', '04:06:15', 1, 1, 'An outsider('') has requested a new order paid via Paypal', 'payments'),
(51, '2018-04-07', '04:07:19', 1, 1, 'An outsider() has requested a new order paid via Paypal', 'payments'),
(52, '2018-04-07', '04:07:54', 1, 1, 'An outsider('') has requested a new order paid via Paypal', 'payments'),
(53, '2018-04-07', '04:08:06', 1, 1, 'An outsider('''') has requested a new order paid via Paypal', 'payments'),
(54, '2018-04-07', '04:10:17', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(55, '2018-04-07', '04:17:45', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(56, '2018-04-07', '04:18:11', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(57, '2018-04-07', '04:18:57', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(58, '2018-04-07', '06:53:10', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(59, '2018-04-07', '09:45:30', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(60, '2018-04-08', '02:27:43', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(61, '2018-04-08', '02:50:33', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(62, '2018-04-08', '12:24:45', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(63, '2018-04-08', '12:34:33', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(64, '2018-04-08', '12:37:19', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(65, '2018-04-08', '12:42:04', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(66, '2018-04-08', '12:44:38', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(67, '2018-04-08', '12:59:56', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(68, '2018-04-08', '02:37:18', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(69, '2018-04-08', '02:41:12', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(70, '2018-04-08', '02:41:27', 1, 1, 'Alexis has requested a new order paid via Paypal', 'payments'),
(71, '2018-04-08', '02:46:56', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(72, '2018-04-08', '02:49:22', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(73, '2018-04-08', '02:50:15', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(74, '2018-04-10', '12:04:46', 1, 1, 'Sumbin has requested a new order paid via Paypal', 'payments'),
(75, '2018-04-11', '12:32:19', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(76, '2018-04-11', '04:36:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(77, '2018-04-11', '04:47:21', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(78, '2018-04-12', '02:28:04', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(79, '2018-04-17', '10:35:48', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(80, '2018-04-17', '10:56:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(81, '2018-04-17', '10:56:52', 1, 1, 'Alexis has requested a new order paid via Paypal', 'payments'),
(82, '2018-04-18', '02:47:32', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(83, '2018-04-18', '02:47:47', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(84, '2018-04-18', '02:51:34', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(85, '2018-04-18', '03:18:23', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(86, '2018-04-18', '03:22:31', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(87, '2018-04-18', '03:26:22', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(88, '2018-04-19', '05:08:51', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(89, '2018-04-19', '05:30:50', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(90, '2018-04-19', '05:31:02', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(91, '2018-04-19', '05:31:13', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(92, '2018-04-19', '05:59:15', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(93, '2018-04-19', '05:59:24', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(94, '2018-04-19', '05:59:40', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(95, '2018-04-19', '06:04:52', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(96, '2018-04-19', '06:06:33', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(97, '2018-04-19', '06:06:55', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(98, '2018-04-19', '06:07:13', 0, 0, 'Administrator discarded a request sent by user', 'payments'),
(99, '2018-04-19', '06:07:59', 0, 0, 'Administrator discarded a request sent by 0', 'payments'),
(100, '2018-04-19', '06:08:01', 0, 0, 'Administrator discarded a request sent by 0', 'payments'),
(101, '2018-04-19', '06:10:28', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(102, '2018-04-19', '06:11:16', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(103, '2018-04-19', '06:11:50', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(104, '2018-04-19', '06:12:08', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(105, '2018-04-19', '06:13:22', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(106, '2018-04-19', '06:13:56', 0, 0, 'Administrator discarded a request sent by ''', 'payments'),
(107, '2018-04-19', '06:14:02', 0, 0, 'Administrator discarded a request sent by da who', 'payments'),
(108, '2018-04-19', '06:14:26', 0, 0, 'Administrator discarded a request sent by a user', 'payments'),
(109, '2018-04-19', '06:14:28', 0, 0, 'Administrator discarded a request sent by a user', 'payments'),
(110, '2018-04-19', '06:17:43', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(111, '2018-04-19', '06:17:56', 0, 0, 'Administrator discarded a request sent by + ', 'payments'),
(112, '2018-04-19', '06:21:01', 0, 0, 'Administrator discarded a request sent by asd', 'payments'),
(113, '2018-04-19', '06:21:14', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(114, '2018-04-19', '06:21:35', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(115, '2018-04-19', '06:21:56', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(116, '2018-04-19', '06:22:05', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(117, '2018-04-19', '06:22:24', 0, 0, 'Administrator discarded a request sent by ''', 'payments'),
(118, '2018-04-19', '06:22:47', 0, 0, 'Administrator discarded a request sent by '' ', 'payments'),
(119, '2018-04-19', '06:22:53', 0, 0, 'Administrator discarded a request sent by ', 'payments'),
(120, '2018-04-19', '06:23:20', 0, 0, 'Administrator discarded a request ', 'payments'),
(121, '2018-04-19', '06:23:30', 0, 0, 'Administrator discarded a request ', 'payments'),
(122, '2018-04-19', '06:23:57', 0, 0, 'Administrator discarded a request ', 'payments'),
(123, '2018-04-19', '06:24:21', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(124, '2018-04-19', '06:24:38', 0, 0, 'Administrator discarded a request ', 'payments'),
(125, '2018-04-19', '06:24:47', 0, 0, 'Administrator discarded a request ', 'payments'),
(126, '2018-04-19', '06:24:50', 0, 0, 'Administrator discarded a request ', 'payments'),
(127, '2018-04-19', '06:25:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(128, '2018-04-19', '06:25:21', 0, 0, 'Administrator discarded a request ', 'payments'),
(129, '2018-04-19', '06:25:24', 0, 0, 'Administrator discarded a request ', 'payments'),
(130, '2018-04-19', '06:27:04', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(131, '2018-04-19', '06:27:20', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(132, '2018-04-19', '06:27:34', 0, 0, 'Administrator discarded a request ', 'payments'),
(133, '2018-04-19', '06:51:25', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(134, '2018-04-20', '02:46:52', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(135, '2018-04-20', '02:53:24', 0, 0, 'Administrator discarded a request ', 'payments'),
(136, '2018-04-20', '02:53:32', 0, 0, 'Administrator discarded a request ', 'payments'),
(137, '2018-04-20', '02:55:59', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(138, '2018-04-20', '02:56:11', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(139, '2018-04-20', '03:05:59', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(140, '2018-04-20', '03:06:18', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(141, '2018-04-20', '03:06:36', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(142, '2018-04-20', '03:07:22', 0, 0, 'Administrator discarded a request ', 'payments'),
(143, '2018-04-20', '03:07:28', 0, 0, 'Administrator discarded a request ', 'payments'),
(144, '2018-04-21', '12:50:05', 0, 0, 'Administrator discarded a request ', 'payments'),
(145, '2018-04-21', '12:50:21', 0, 0, 'Administrator discarded a request ', 'payments'),
(146, '2018-04-21', '01:02:47', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(147, '2018-04-21', '01:03:12', 0, 0, 'Administrator discarded a request ', 'payments'),
(148, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(149, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(150, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(151, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(152, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(153, '2018-04-25', '12:58:52', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(154, '2018-04-25', '12:58:54', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(155, '2018-04-25', '12:59:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(156, '2018-04-25', '12:59:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(157, '2018-04-25', '12:59:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(158, '2018-04-25', '12:59:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(159, '2018-04-25', '12:59:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(160, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(161, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(162, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(163, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(164, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(165, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(166, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(167, '2018-04-25', '12:59:09', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(168, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(169, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(170, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(171, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(172, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(173, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(174, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(175, '2018-04-25', '12:59:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(176, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(177, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(178, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(179, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(180, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(181, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(182, '2018-04-25', '12:59:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(183, '2018-04-26', '05:00:54', 0, 0, 'Administrator discarded a request ', 'payments'),
(184, '2018-04-26', '05:01:00', 0, 0, 'Administrator discarded a request ', 'payments'),
(185, '2018-04-26', '05:01:04', 0, 0, 'Administrator discarded a request ', 'payments'),
(186, '2018-04-26', '01:14:46', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(187, '2018-04-26', '01:15:14', 1, 1, 'Sumbin has requested a new order paid via Paypal', 'payments'),
(188, '2018-04-28', '10:05:13', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(189, '2018-04-28', '10:26:03', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(190, '2018-04-29', '01:11:51', 1, 1, 'Sumbin has requested a new order paid via Paypal', 'payments'),
(191, '2018-05-08', '07:01:37', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(192, '2018-05-08', '07:02:29', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(193, '2018-05-08', '07:04:08', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(194, '2018-05-08', '07:06:08', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(195, '2018-05-08', '07:06:59', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(196, '2018-05-08', '07:08:00', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(197, '2018-05-08', '07:08:10', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(198, '2018-05-08', '07:08:54', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(199, '2018-05-08', '07:09:12', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(200, '2018-05-08', '07:10:26', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(201, '2018-05-08', '07:11:11', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(202, '2018-05-08', '07:12:47', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(203, '2018-05-08', '07:17:53', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(204, '2018-05-08', '07:18:50', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(205, '2018-05-08', '07:19:52', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(206, '2018-05-08', '07:20:55', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(207, '2018-05-08', '07:21:24', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(208, '2018-05-08', '07:21:50', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(209, '2018-05-08', '07:34:43', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(210, '2018-05-08', '07:37:07', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(211, '2018-05-08', '07:38:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(212, '2018-05-08', '07:38:36', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(213, '2018-05-08', '07:38:47', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(214, '2018-05-08', '07:39:21', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(215, '2018-05-08', '07:40:00', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(216, '2018-05-08', '07:41:20', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(217, '2018-05-08', '07:42:15', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(218, '2018-05-08', '07:44:38', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(219, '2018-05-08', '07:58:32', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(220, '2018-05-08', '07:59:15', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(221, '2018-05-08', '08:07:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(222, '2018-05-08', '08:08:10', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(223, '2018-05-08', '08:08:50', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(224, '2018-05-08', '08:12:14', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(225, '2018-05-08', '08:12:42', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(226, '2018-05-08', '08:18:07', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(227, '2018-05-08', '08:24:10', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(228, '2018-05-08', '08:26:01', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(229, '2018-05-08', '08:27:41', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(230, '2018-05-08', '08:29:08', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(231, '2018-05-08', '08:29:47', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(232, '2018-05-08', '08:30:24', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(233, '2018-05-08', '08:31:13', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(234, '2018-05-08', '08:31:23', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(235, '2018-05-08', '08:31:33', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(236, '2018-05-08', '08:34:24', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(237, '2018-05-08', '09:12:17', 1, 1, 'Sumbin has requested a new order paid via Paypal', 'payments'),
(238, '2018-05-08', '09:15:28', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(239, '2018-05-08', '09:16:57', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(240, '2018-05-08', '07:27:43', 0, 0, 'Administrator discarded a request ', 'payments'),
(241, '2018-05-10', '11:41:47', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(242, '2018-05-10', '11:44:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(243, '2018-05-11', '01:36:29', 1, 1, 'Juddmacomb has requested a new order  via On Hand.', 'payments'),
(244, '2018-05-13', '06:41:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(245, '2018-05-14', '12:46:03', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(246, '2018-05-14', '12:48:26', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(247, '2018-05-14', '01:10:47', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(248, '2018-05-14', '01:11:44', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(249, '2018-05-14', '01:12:35', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(250, '2018-05-14', '01:13:59', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(251, '2018-05-14', '01:14:19', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(252, '2018-05-14', '01:18:00', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(253, '2018-05-14', '04:11:29', 0, 0, 'Administrator discarded a request ', 'payments'),
(254, '2018-05-14', '04:15:04', 0, 0, 'Administrator discarded a request ', 'payments'),
(255, '2018-05-14', '04:20:01', 0, 0, 'Administrator discarded a request ', 'payments'),
(256, '2018-05-14', '04:20:05', 0, 0, 'Administrator discarded a request ', 'payments'),
(257, '2018-05-14', '04:20:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(258, '2018-05-14', '04:53:10', 0, 0, 'Administrator discarded a request ', 'payments'),
(259, '2018-05-14', '04:56:35', 0, 0, 'Administrator discarded a request ', 'payments'),
(260, '2018-05-14', '04:59:25', 0, 0, 'Administrator discarded a request ', 'payments'),
(261, '2018-05-14', '04:59:29', 0, 0, 'Administrator discarded a request ', 'payments'),
(262, '2018-05-14', '04:59:33', 0, 0, 'Administrator discarded a request ', 'payments'),
(263, '2018-05-14', '05:05:57', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(264, '2018-05-15', '04:04:14', 0, 0, 'Administrator discarded a request ', 'payments'),
(265, '2018-05-16', '05:08:11', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(266, '2018-05-16', '06:19:20', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(267, '2018-05-16', '06:20:24', 0, 0, 'Administrator discarded a request ', 'payments'),
(268, '2018-05-16', '06:20:48', 0, 0, 'Administrator discarded a request ', 'payments'),
(269, '2018-05-16', '06:22:48', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(270, '2018-05-16', '06:23:46', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(271, '2018-05-21', '09:03:06', 0, 0, 'Administrator discarded a request ', 'payments'),
(272, '2018-05-21', '09:03:12', 0, 0, 'Administrator discarded a request ', 'payments'),
(273, '2018-05-21', '09:03:56', 0, 0, 'Administrator discarded a request ', 'payments'),
(274, '2018-05-21', '09:05:18', 0, 0, 'Administrator discarded a request ', 'payments'),
(275, '2018-05-21', '09:56:32', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(276, '2018-05-21', '04:39:46', 0, 0, 'Administrator discarded a request ', 'payments'),
(277, '2018-05-21', '04:40:09', 0, 0, 'Administrator discarded a request ', 'payments'),
(278, '2018-05-21', '04:40:36', 0, 0, 'Administrator discarded a request ', 'payments'),
(279, '2018-05-21', '04:43:47', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(280, '2018-05-21', '04:45:34', 0, 0, 'Administrator discarded a request ', 'payments'),
(281, '2018-05-21', '04:46:15', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(282, '2018-05-21', '04:46:23', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(283, '2018-05-21', '04:46:52', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(284, '2018-05-21', '05:42:41', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(285, '2018-05-21', '05:43:21', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(286, '2018-05-21', '05:44:13', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(287, '2018-05-21', '05:44:26', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(288, '2018-05-21', '05:44:34', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(289, '2018-05-21', '05:44:49', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(290, '2018-05-21', '05:45:04', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(291, '2018-05-21', '05:50:37', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(292, '2018-05-21', '05:51:05', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(293, '2018-05-21', '05:54:05', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(294, '2018-05-21', '05:54:14', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(295, '2018-05-21', '05:55:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(296, '2018-05-21', '05:56:18', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(297, '2018-05-21', '05:59:57', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(298, '2018-05-21', '06:00:54', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(299, '2018-05-21', '06:01:14', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(300, '2018-05-21', '06:01:29', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(301, '2018-05-21', '06:01:41', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(302, '2018-05-21', '06:02:03', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(303, '2018-05-21', '06:02:57', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(304, '2018-05-21', '06:03:46', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(305, '2018-05-21', '06:04:24', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(306, '2018-05-21', '06:04:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(307, '2018-05-21', '06:07:17', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(308, '2018-05-21', '06:07:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(309, '2018-05-21', '06:07:40', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(310, '2018-05-21', '06:07:44', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(311, '2018-05-21', '06:07:49', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(312, '2018-05-21', '06:07:52', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(313, '2018-05-21', '06:09:33', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(314, '2018-05-21', '06:09:46', 0, 0, 'Administrator discarded a request ', 'payments'),
(315, '2018-05-21', '06:09:56', 0, 0, 'Administrator discarded a request ', 'payments'),
(316, '2018-05-21', '06:10:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(317, '2018-05-21', '06:10:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(318, '2018-05-21', '06:10:12', 0, 0, 'Administrator discarded a request ', 'payments'),
(319, '2018-05-21', '06:10:18', 0, 0, 'Administrator discarded a request ', 'payments'),
(320, '2018-05-21', '06:11:01', 1, 1, 'Administrator discarded a request ', 'payments'),
(321, '2018-05-21', '06:11:25', 0, 0, 'Administrator discarded a request ', 'payments'),
(322, '2018-05-21', '06:55:45', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(323, '2018-05-21', '07:06:24', 0, 0, 'Administrator discarded a request ', 'payments'),
(324, '2018-05-21', '07:07:31', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(325, '2018-05-21', '07:09:02', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(326, '2018-05-21', '07:09:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(327, '2018-05-21', '07:09:44', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(328, '2018-05-21', '07:10:17', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(329, '2018-05-21', '07:11:04', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(330, '2018-05-21', '07:11:34', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(331, '2018-05-21', '07:12:53', 0, 0, 'Administrator discarded a request ', 'payments'),
(332, '2018-05-21', '07:12:57', 0, 0, 'Administrator discarded a request ', 'payments'),
(333, '2018-05-21', '07:13:02', 0, 0, 'Administrator discarded a request ', 'payments'),
(334, '2018-05-21', '07:13:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(335, '2018-05-21', '07:13:13', 0, 0, 'Administrator discarded a request ', 'payments'),
(336, '2018-05-21', '07:13:21', 0, 0, 'Administrator discarded a request ', 'payments'),
(337, '2018-05-22', '01:49:46', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(338, '2018-05-22', '03:20:11', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(339, '2018-05-22', '03:20:55', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(340, '2018-05-22', '03:21:14', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(341, '2018-05-22', '03:21:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(342, '2018-05-22', '03:21:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(343, '2018-05-22', '03:21:56', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(344, '2018-05-22', '03:22:13', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(345, '2018-05-22', '03:22:30', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(346, '2018-05-22', '03:22:42', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(347, '2018-05-22', '03:22:45', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(348, '2018-05-22', '03:23:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(349, '2018-05-22', '03:23:12', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(350, '2018-05-22', '03:24:00', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(351, '2018-05-22', '03:24:09', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(352, '2018-05-22', '03:24:21', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(353, '2018-05-22', '03:24:25', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(354, '2018-05-22', '03:24:28', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(355, '2018-05-22', '03:24:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(356, '2018-05-22', '03:24:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(357, '2018-05-22', '03:25:00', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(358, '2018-05-22', '03:25:11', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(359, '2018-05-22', '03:25:33', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(360, '2018-05-22', '03:25:37', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(361, '2018-05-22', '03:25:40', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(362, '2018-05-22', '03:25:49', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(363, '2018-05-22', '03:25:54', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(364, '2018-05-22', '03:26:45', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(365, '2018-05-22', '03:27:02', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(366, '2018-05-22', '03:27:43', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(367, '2018-05-22', '03:28:03', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(368, '2018-05-22', '03:28:28', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(369, '2018-05-22', '03:28:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(370, '2018-05-22', '03:29:17', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(371, '2018-05-22', '03:29:39', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(372, '2018-05-22', '03:29:43', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(373, '2018-05-22', '03:30:05', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(374, '2018-05-22', '03:30:19', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(375, '2018-05-22', '03:30:32', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(376, '2018-05-22', '03:30:57', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(377, '2018-05-22', '03:31:26', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(378, '2018-05-22', '03:31:40', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(379, '2018-05-22', '03:32:29', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(380, '2018-05-22', '03:32:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(381, '2018-05-22', '03:32:49', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(382, '2018-05-22', '03:34:28', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(383, '2018-05-22', '03:35:43', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(384, '2018-05-22', '03:35:51', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(385, '2018-05-22', '03:35:58', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(386, '2018-05-22', '03:36:03', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(387, '2018-05-22', '04:05:09', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(388, '2018-05-22', '04:05:26', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(389, '2018-05-22', '04:06:00', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(390, '2018-05-22', '04:07:30', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(391, '2018-05-22', '04:07:33', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(392, '2018-05-22', '04:07:59', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(393, '2018-05-22', '04:08:11', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(394, '2018-05-22', '04:08:15', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(395, '2018-05-22', '04:09:19', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(396, '2018-05-22', '04:10:02', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(397, '2018-05-22', '04:11:06', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(398, '2018-05-22', '04:12:45', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(399, '2018-05-22', '04:12:56', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(400, '2018-05-22', '04:13:26', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(401, '2018-05-22', '04:13:38', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(402, '2018-05-22', '04:13:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(403, '2018-05-22', '04:14:04', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(404, '2018-05-22', '04:14:47', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(405, '2018-05-22', '04:14:59', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(406, '2018-05-22', '04:15:12', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(407, '2018-05-22', '04:15:25', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(408, '2018-05-22', '04:15:39', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(409, '2018-05-22', '04:15:56', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(410, '2018-05-22', '04:16:24', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(411, '2018-05-22', '04:16:37', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(412, '2018-05-22', '04:17:23', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(413, '2018-05-22', '04:17:46', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(414, '2018-05-22', '04:18:57', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(415, '2018-05-22', '04:19:22', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(416, '2018-05-22', '04:19:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(417, '2018-05-22', '04:19:44', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(418, '2018-05-22', '04:20:40', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(419, '2018-05-22', '04:21:01', 0, 0, 'Administrator discarded a request ', 'payments'),
(420, '2018-05-22', '04:22:58', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(421, '2018-05-22', '05:45:17', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(422, '2018-05-22', '05:45:41', 0, 0, 'Administrator discarded a request ', 'payments'),
(423, '2018-05-22', '08:30:55', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(424, '2018-05-22', '05:56:27', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(425, '2018-05-22', '05:57:03', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(426, '2018-05-22', '05:58:41', 0, 0, 'Administrator discarded a request ', 'payments'),
(427, '2018-05-22', '06:01:22', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(428, '2018-05-22', '06:04:26', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(429, '2018-05-22', '06:30:58', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(430, '2018-05-22', '06:32:06', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(431, '2018-05-23', '04:21:31', 0, 0, 'Administrator discarded a request ', 'payments'),
(432, '2018-05-23', '04:21:36', 0, 0, 'Administrator discarded a request ', 'payments'),
(433, '2018-05-23', '04:21:42', 0, 0, 'Administrator discarded a request ', 'payments'),
(434, '2018-05-23', '05:22:50', 0, 0, 'Administrator discarded a request ', 'payments'),
(435, '2018-05-24', '05:01:03', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(436, '2018-05-28', '03:39:15', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(437, '2018-05-28', '03:39:37', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(438, '2018-05-28', '03:40:18', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(439, '2018-05-28', '03:40:28', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(440, '2018-05-28', '03:41:09', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(441, '2018-05-31', '05:29:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(442, '2018-05-31', '10:17:52', 0, 0, 'Administrator discarded a request ', 'payments'),
(443, '2018-06-02', '05:49:52', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(444, '2018-06-02', '08:08:14', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(445, '2018-06-02', '08:08:28', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(446, '2018-06-02', '08:35:01', 0, 0, 'Administrator discarded a request ', 'payments'),
(447, '2018-06-02', '08:36:52', 0, 0, 'Administrator discarded a request ', 'payments'),
(448, '2018-06-02', '08:37:00', 0, 0, 'Administrator discarded a request ', 'payments'),
(449, '2018-06-02', '08:37:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(450, '2018-06-02', '08:37:14', 0, 0, 'Administrator discarded a request ', 'payments'),
(451, '2018-06-02', '08:37:25', 0, 0, 'Administrator discarded a request ', 'payments'),
(452, '2018-06-02', '08:37:32', 0, 0, 'Administrator discarded a request ', 'payments'),
(453, '2018-06-02', '08:39:21', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(454, '2018-06-02', '08:39:40', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(455, '2018-06-02', '09:01:35', 0, 0, 'Administrator discarded a request ', 'payments'),
(456, '2018-06-03', '12:19:11', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(457, '2018-06-03', '12:28:32', 0, 0, 'Administrator discarded a request ', 'payments'),
(458, '2018-06-03', '12:28:38', 0, 0, 'Administrator discarded a request ', 'payments'),
(459, '2018-06-03', '12:29:34', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(460, '2018-06-03', '12:32:02', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(461, '2018-06-03', '12:33:01', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(462, '2018-06-03', '12:33:46', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(463, '2018-06-03', '12:36:18', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(464, '2018-06-03', '12:37:00', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(465, '2018-06-03', '12:37:30', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(466, '2018-06-03', '12:41:56', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(467, '2018-06-03', '12:42:17', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(468, '2018-06-03', '12:42:35', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(469, '2018-06-03', '12:46:21', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(470, '2018-06-03', '12:47:20', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(471, '2018-06-03', '12:47:44', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(472, '2018-06-03', '12:49:05', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(473, '2018-06-03', '12:49:43', 0, 0, 'Administrator discarded a request ', 'payments'),
(474, '2018-06-03', '12:49:46', 0, 0, 'Administrator discarded a request ', 'payments'),
(475, '2018-06-03', '12:49:52', 0, 0, 'Administrator discarded a request ', 'payments'),
(476, '2018-06-03', '12:49:57', 0, 0, 'Administrator discarded a request ', 'payments'),
(477, '2018-06-03', '12:50:02', 0, 0, 'Administrator discarded a request ', 'payments'),
(478, '2018-06-03', '12:50:07', 0, 0, 'Administrator discarded a request ', 'payments'),
(479, '2018-06-03', '12:50:16', 0, 0, 'Administrator discarded a request ', 'payments'),
(480, '2018-06-03', '12:50:21', 0, 0, 'Administrator discarded a request ', 'payments'),
(481, '2018-06-03', '12:50:26', 0, 0, 'Administrator discarded a request ', 'payments'),
(482, '2018-06-03', '12:50:31', 0, 0, 'Administrator discarded a request ', 'payments'),
(483, '2018-06-03', '12:50:35', 0, 0, 'Administrator discarded a request ', 'payments'),
(484, '2018-06-03', '12:50:40', 0, 0, 'Administrator discarded a request ', 'payments'),
(485, '2018-06-03', '12:50:45', 0, 0, 'Administrator discarded a request ', 'payments'),
(486, '2018-06-03', '12:50:58', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(487, '2018-06-03', '12:52:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(488, '2018-06-03', '12:53:53', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(489, '2018-06-03', '12:54:13', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(490, '2018-06-03', '12:55:36', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(491, '2018-06-03', '12:55:47', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(492, '2018-06-03', '12:57:25', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(493, '2018-06-03', '12:57:51', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(494, '2018-06-05', '03:06:50', 0, 0, 'Administrator discarded a request ', 'payments'),
(495, '2018-06-06', '03:29:37', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(496, '2018-06-06', '03:30:53', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(497, '2018-06-06', '03:31:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(498, '2018-06-06', '03:31:16', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(499, '2018-06-06', '03:31:41', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(500, '2018-06-06', '03:31:50', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(501, '2018-06-06', '03:32:02', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(502, '2018-06-06', '03:32:07', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(503, '2018-06-06', '03:32:10', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(504, '2018-06-06', '03:32:15', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(505, '2018-06-06', '03:32:18', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(506, '2018-06-06', '03:32:20', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(507, '2018-06-06', '03:32:30', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(508, '2018-06-06', '03:32:35', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(509, '2018-06-06', '03:32:40', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(510, '2018-06-06', '03:32:44', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(511, '2018-06-06', '03:33:06', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(512, '2018-06-06', '03:33:12', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(513, '2018-06-06', '03:33:26', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(514, '2018-06-06', '03:33:53', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(515, '2018-06-06', '03:34:36', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(516, '2018-06-06', '03:34:37', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(517, '2018-06-06', '03:34:37', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(518, '2018-06-06', '03:34:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(519, '2018-06-06', '03:34:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(520, '2018-06-06', '03:34:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(521, '2018-06-06', '03:34:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(522, '2018-06-06', '03:34:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(523, '2018-06-06', '03:34:39', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(524, '2018-06-06', '03:35:23', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(525, '2018-06-06', '03:35:58', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(526, '2018-06-06', '03:36:29', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(527, '2018-06-06', '03:37:49', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(528, '2018-06-06', '03:38:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(529, '2018-06-06', '03:38:44', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(530, '2018-06-06', '03:38:59', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(531, '2018-06-06', '03:39:23', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(532, '2018-06-06', '03:39:38', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(533, '2018-06-06', '03:40:42', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(534, '2018-06-06', '03:40:47', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(535, '2018-06-06', '03:40:50', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(536, '2018-06-06', '03:41:07', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(537, '2018-06-06', '03:41:42', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(538, '2018-06-06', '03:42:18', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(539, '2018-06-06', '03:43:54', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(540, '2018-06-06', '03:44:08', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(541, '2018-06-06', '02:38:15', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(542, '2018-06-07', '07:24:02', 0, 0, 'Administrator discarded a request ', 'payments'),
(543, '2018-06-07', '07:24:16', 0, 0, 'Administrator discarded a request ', 'payments'),
(544, '2018-06-07', '07:24:23', 0, 0, 'Administrator discarded a request ', 'payments'),
(545, '2018-06-07', '07:24:30', 0, 0, 'Administrator discarded a request ', 'payments'),
(546, '2018-06-07', '07:24:36', 0, 0, 'Administrator discarded a request ', 'payments'),
(547, '2018-06-07', '07:24:43', 0, 0, 'Administrator discarded a request ', 'payments'),
(548, '2018-06-07', '07:24:49', 0, 0, 'Administrator discarded a request ', 'payments'),
(549, '2018-06-07', '07:24:54', 0, 0, 'Administrator discarded a request ', 'payments'),
(550, '2018-06-09', '01:17:16', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(551, '2018-06-09', '03:03:22', 0, 0, 'Administrator discarded a request ', 'payments'),
(552, '2018-06-09', '03:03:33', 0, 0, 'Administrator discarded a request ', 'payments'),
(553, '2018-06-09', '08:40:23', 0, 0, 'Administrator discarded a request ', 'payments'),
(554, '2018-06-09', '08:40:30', 0, 0, 'Administrator discarded a request ', 'payments'),
(555, '2018-06-09', '08:40:41', 0, 0, 'Administrator discarded a request ', 'payments'),
(556, '2018-06-09', '08:40:47', 0, 0, 'Administrator discarded a request ', 'payments'),
(557, '2018-06-09', '08:40:53', 0, 0, 'Administrator discarded a request ', 'payments');
INSERT INTO `notifications` (`notif_id`, `notif_date_generated`, `notif_time_generated`, `notif_isRead`, `notif_received_user`, `notif_text`, `notif_type`) VALUES
(558, '2018-06-09', '08:41:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(559, '2018-06-09', '11:23:28', 1, 1, 'Sumbin has requested a new order  via On Hand.', 'payments'),
(560, '2018-06-10', '10:33:11', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(561, '2018-06-12', '02:42:41', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(562, '2018-06-12', '06:33:09', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(563, '2018-06-12', '07:14:24', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(564, '2018-06-13', '12:58:26', 0, 0, 'Administrator discarded a request ', 'payments'),
(565, '2018-06-18', '12:34:09', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(566, '2018-06-18', '12:36:42', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(567, '2018-06-18', '03:41:19', 0, 0, 'Administrator discarded a request ', 'payments'),
(568, '2018-06-18', '03:41:59', 0, 0, 'Administrator discarded a request ', 'payments'),
(569, '2018-06-18', '03:42:33', 0, 0, 'Administrator discarded a request ', 'payments'),
(570, '2018-06-18', '04:00:35', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(571, '2018-06-18', '05:10:25', 0, 0, 'Administrator discarded a request ', 'payments'),
(572, '2018-06-18', '05:13:05', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(573, '2018-06-18', '05:34:25', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(574, '2018-06-20', '04:47:12', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(575, '2018-06-20', '04:51:28', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(576, '2018-06-20', '04:55:17', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(577, '2018-06-20', '05:38:32', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(578, '2018-06-20', '05:38:43', 1, 1, 'Alexis has requested a new order  via On Hand.', 'payments'),
(579, '2018-06-20', '05:38:53', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(580, '2018-06-21', '08:16:01', 0, 0, 'Administrator discarded a request ', 'payments'),
(581, '2018-06-21', '08:16:16', 0, 0, 'Administrator discarded a request ', 'payments'),
(582, '2018-06-21', '08:17:34', 0, 0, 'Administrator discarded a request ', 'payments'),
(583, '2018-06-21', '08:18:27', 0, 0, 'Administrator discarded a request ', 'payments'),
(584, '2018-06-21', '08:18:31', 0, 0, 'Administrator discarded a request ', 'payments'),
(585, '2018-06-21', '08:18:38', 0, 0, 'Administrator discarded a request ', 'payments'),
(586, '2018-06-21', '08:20:37', 0, 0, 'Administrator discarded a request ', 'payments'),
(587, '2018-06-21', '08:23:31', 0, 0, 'Administrator discarded a request ', 'payments'),
(588, '2018-06-21', '08:24:25', 0, 0, 'Administrator discarded a request ', 'payments'),
(589, '2018-06-21', '08:25:06', 0, 0, 'Administrator discarded a request ', 'payments'),
(590, '2018-06-21', '08:27:15', 0, 0, 'Administrator discarded a request ', 'payments'),
(591, '2018-06-21', '09:12:27', 0, 0, 'Administrator discarded a request ', 'payments'),
(592, '2018-06-21', '09:18:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(593, '2018-06-21', '09:57:40', 0, 0, 'Administrator discarded a request ', 'payments'),
(594, '2018-06-21', '09:57:53', 0, 0, 'Administrator discarded a request ', 'payments'),
(595, '2018-06-21', '09:58:08', 0, 0, 'Administrator discarded a request ', 'payments'),
(596, '2018-06-21', '11:55:23', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(597, '2018-06-21', '11:57:16', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(598, '2018-06-21', '11:58:05', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(599, '2018-06-21', '12:20:53', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(600, '2018-06-21', '12:26:00', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(601, '2018-06-21', '12:26:25', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(602, '2018-06-21', '12:50:28', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(603, '2018-06-21', '12:52:14', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(604, '2018-06-21', '12:55:35', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(605, '2018-06-21', '12:56:12', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(606, '2018-06-21', '12:58:17', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(607, '2018-06-21', '12:58:59', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(608, '2018-06-22', '01:04:32', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(609, '2018-06-22', '01:05:27', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(610, '2018-06-22', '01:06:41', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(611, '2018-06-22', '01:07:10', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(612, '2018-06-22', '01:10:14', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(613, '2018-06-22', '03:11:44', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(614, '2018-06-22', '03:15:36', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(615, '2018-06-22', '03:18:34', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(616, '2018-06-22', '03:24:05', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(617, '2018-06-22', '03:29:12', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(618, '2018-06-22', '03:29:36', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(619, '2018-06-22', '03:29:57', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(620, '2018-06-23', '04:12:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(621, '2018-06-23', '04:12:12', 0, 0, 'Administrator discarded a request ', 'payments'),
(622, '2018-06-23', '04:12:48', 0, 0, 'Administrator discarded a request ', 'payments'),
(623, '2018-06-23', '04:12:54', 0, 0, 'Administrator discarded a request ', 'payments'),
(624, '2018-06-23', '04:13:11', 0, 0, 'Administrator discarded a request ', 'payments'),
(625, '2018-06-23', '04:13:46', 0, 0, 'Administrator discarded a request ', 'payments'),
(626, '2018-06-23', '04:14:14', 0, 0, 'Administrator discarded a request ', 'payments'),
(627, '2018-06-23', '04:14:48', 0, 0, 'Administrator discarded a request ', 'payments'),
(628, '2018-06-23', '04:14:53', 0, 0, 'Administrator discarded a request ', 'payments'),
(629, '2018-06-23', '04:15:20', 0, 0, 'Administrator discarded a request ', 'payments'),
(630, '2018-06-23', '04:15:38', 0, 0, 'Administrator discarded a request ', 'payments'),
(631, '2018-06-23', '04:15:58', 0, 0, 'Administrator discarded a request ', 'payments'),
(632, '2018-06-23', '04:16:12', 0, 0, 'Administrator discarded a request ', 'payments'),
(633, '2018-06-23', '04:17:36', 0, 0, 'Administrator discarded a request ', 'payments'),
(634, '2018-06-23', '04:18:04', 0, 0, 'Administrator discarded a request ', 'payments'),
(635, '2018-06-23', '04:18:11', 0, 0, 'Administrator discarded a request ', 'payments'),
(636, '2018-06-23', '04:18:27', 0, 0, 'Administrator discarded a request ', 'payments'),
(637, '2018-06-23', '06:39:44', 0, 0, 'Administrator discarded a request ', 'payments'),
(638, '2018-06-23', '06:39:50', 0, 0, 'Administrator discarded a request ', 'payments'),
(639, '2018-06-23', '06:40:05', 0, 0, 'Administrator discarded a request ', 'payments'),
(640, '2018-06-23', '06:40:16', 0, 0, 'Administrator discarded a request ', 'payments'),
(641, '2018-06-23', '06:40:18', 0, 0, 'Administrator discarded a request ', 'payments'),
(642, '2018-06-23', '06:41:04', 0, 0, 'Administrator discarded a request ', 'payments'),
(643, '2018-06-27', '03:38:53', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(644, '2018-06-27', '07:36:36', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(645, '2018-06-27', '10:05:08', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(646, '2018-06-28', '12:50:48', 0, 0, 'Administrator discarded a request ', 'payments'),
(647, '2018-06-28', '12:56:49', 0, 0, 'Administrator discarded a request ', 'payments'),
(648, '2018-06-28', '02:10:10', 0, 0, 'Administrator discarded a request ', 'payments'),
(649, '2018-06-28', '02:10:35', 0, 0, 'Administrator discarded a request ', 'payments'),
(650, '2018-06-28', '02:10:56', 0, 0, 'Administrator discarded a request ', 'payments'),
(651, '2018-06-28', '02:36:51', 0, 0, 'Administrator discarded a request ', 'payments'),
(652, '2018-06-28', '02:37:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(653, '2018-06-28', '02:37:14', 0, 0, 'Administrator discarded a request ', 'payments'),
(654, '2018-06-28', '02:37:58', 0, 0, 'Administrator discarded a request ', 'payments'),
(655, '2018-06-28', '11:28:24', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(656, '2018-06-28', '04:14:49', 0, 0, 'Administrator discarded a request ', 'payments'),
(657, '2018-06-28', '04:14:55', 0, 0, 'Administrator discarded a request ', 'payments'),
(658, '2018-06-28', '04:15:03', 0, 0, 'Administrator discarded a request ', 'payments'),
(659, '2018-06-28', '04:17:25', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(660, '2018-06-28', '04:44:24', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(661, '2018-06-28', '04:58:13', 0, 0, 'Administrator discarded a request ', 'payments'),
(662, '2018-06-28', '05:27:13', 1, 1, 'Administrator has placed a new order via On Hand.', 'payments'),
(663, '2018-06-28', '05:30:26', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(664, '2018-06-28', '05:36:27', 0, 0, 'Administrator discarded a request ', 'payments'),
(665, '2018-06-28', '05:37:17', 0, 0, 'Administrator discarded a request ', 'payments'),
(666, '2018-06-28', '05:37:35', 0, 0, 'Administrator discarded a request ', 'payments'),
(667, '2018-06-28', '06:52:11', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(668, '2018-06-30', '12:00:22', 1, 1, 'Administrator received a non-client message', 'messagesbox'),
(669, '2018-07-03', '05:47:12', 1, 1, 'An outsider has requested a new order via On Hand.', 'payments'),
(670, '2018-07-03', '06:01:32', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments'),
(671, '2018-07-03', '06:19:54', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(672, '2018-07-03', '06:20:21', 1, 1, 'Administrator has placed a new order paid via Paypal', 'payments'),
(673, '2018-07-03', '06:26:45', 0, 0, 'Administrator discarded a request ', 'payments'),
(674, '2018-07-05', '06:34:29', 0, 0, 'Administrator discarded a request ', 'payments'),
(675, '2018-07-07', '09:01:00', 0, 0, 'Administrator discarded a request ', 'payments'),
(676, '2018-07-07', '09:01:05', 0, 0, 'Administrator discarded a request ', 'payments'),
(677, '2018-07-07', '09:01:10', 0, 0, 'Administrator discarded a request ', 'payments'),
(678, '2018-07-07', '09:01:13', 0, 0, 'Administrator discarded a request ', 'payments'),
(679, '2018-07-07', '09:01:31', 0, 0, 'Administrator discarded a request ', 'payments'),
(680, '2018-07-07', '09:01:41', 0, 0, 'Administrator discarded a request ', 'payments'),
(681, '2018-07-07', '09:01:46', 0, 0, 'Administrator discarded a request ', 'payments'),
(682, '2018-07-07', '09:01:49', 0, 0, 'Administrator discarded a request ', 'payments'),
(683, '2018-07-08', '05:46:24', 1, 1, 'An outsider has requested a new order paid via Paypal', 'payments');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(5) NOT NULL,
  `package_user_id` int(5) NOT NULL,
  `package_name` varchar(64) NOT NULL,
  `package_category` varchar(32) NOT NULL,
  `package_desc` varchar(256) NOT NULL,
  `package_image` text NOT NULL,
  `package_price` int(11) NOT NULL,
  `package_order_counter` int(8) NOT NULL,
  `package_rating` float NOT NULL,
  `package_visibility` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `package_user_id`, `package_name`, `package_category`, `package_desc`, `package_image`, `package_price`, `package_order_counter`, `package_rating`, `package_visibility`) VALUES
(1, 0, 'Package 1', 'General', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 'package-1.jpg', 1699, 5, 3.8, 1),
(2, 0, 'Package 2', 'General', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 'package-2.jpg', 2499, 16, 4.3, 1),
(3, 0, 'Package 3', 'General', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 'package-3.jpg', 2399, 3, 3.8, 1),
(4, 0, 'Package 4', 'General', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 'package-4.jpg', 2299, 12, 3.7, 1),
(5, 0, 'Package 5', 'Mix Package', '', 'package-5.jpg', 2900, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_contents`
--

CREATE TABLE `package_contents` (
  `pcont_id` int(5) NOT NULL,
  `pcont_name` varchar(64) NOT NULL,
  `pcont_package_id` int(5) NOT NULL,
  `pcont_category_id` int(10) NOT NULL,
  `pcont_image` int(11) NOT NULL,
  `pcont_ordercounter` int(10) NOT NULL,
  `pcont_price` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_contents`
--

INSERT INTO `package_contents` (`pcont_id`, `pcont_name`, `pcont_package_id`, `pcont_category_id`, `pcont_image`, `pcont_ordercounter`, `pcont_price`) VALUES
(1, 'Assorted Cold Cuts', 1, 7, 0, 36, 250),
(2, 'Ham with Pineapple', 1, 7, 0, 0, 200),
(3, 'Cream of Chicken and Asparagus Soup', 1, 12, 0, 0, 200),
(4, 'Braised Beef Loin in Moreau Blanc Gravy Cream Sauce', 1, 10, 0, 78, 200),
(5, 'Chicken Supreme', 1, 10, 0, 0, 200),
(6, 'Grilled Pork Steak w/ Sauced Mushrooms', 1, 10, 0, 0, 200),
(7, 'Buttered Vegetables', 1, 10, 0, 0, 200),
(8, 'Steamed Rice', 1, 10, 0, 0, 200),
(9, 'Fresh Fruits in Season', 1, 8, 0, 0, 150),
(10, 'Pastries', 1, 8, 0, 0, 100),
(11, 'Crispy wanton Balls', 2, 7, 0, 0, 600),
(12, 'Korean Pork Spareribs', 2, 10, 0, 0, 150),
(13, 'Pollo con Jamon y Keso', 2, 10, 0, 114, 250),
(14, 'Baked Fish Fillet in Lemon Butter Cream Sauce', 2, 10, 0, 0, 250),
(15, 'Spaghetti Carbonara', 2, 10, 0, 96, 500),
(16, 'Potato Gratin', 2, 10, 0, 78, 250),
(17, 'Glazed Ham with Pineapple', 2, 10, 0, 0, 250),
(18, 'Steamed Rice', 2, 10, 0, 0, 100),
(19, 'Creme Brulee', 2, 8, 0, 156, 150),
(20, 'Fish Fingers', 3, 7, 0, 0, 250),
(21, 'Cream of Mushroom Soup', 3, 7, 0, 0, 250),
(22, 'LenguaFinanciera', 3, 10, 0, 0, 250),
(23, 'Pork Strips with Quail Eggs and Cashew Nuts', 3, 7, 0, 0, 300),
(24, 'Stuffed Homeless Chicken', 3, 10, 0, 0, 250),
(25, 'Sauteed Vegetables in Oyster Sauce', 3, 10, 0, 0, 250),
(26, 'Baked Lasagna', 3, 10, 0, 0, 250),
(27, 'Steamed Rice', 3, 10, 0, 0, 250),
(28, 'Iceberg Lettuce', 27, 10, 0, 0, 250),
(29, 'Sliced Cucumber', 27, 10, 0, 0, 250),
(30, 'Crispy Croutons', 27, 10, 0, 0, 250),
(31, 'Rosemary Dressing', 27, 10, 0, 0, 250),
(32, 'Mango Crepe', 3, 8, 0, 0, 250),
(33, 'Buko Fruit Salad', 3, 8, 0, 0, 250),
(34, 'Refillable Fruit Punch', 3, 9, 0, 0, 250),
(35, 'Flowing Coffee & Tea', 3, 9, 0, 0, 250),
(36, 'Assorted Cold Cuts', 4, 7, 0, 0, 250),
(37, 'Fish Fingers', 4, 7, 0, 0, 250),
(38, 'Pinsee Frito', 4, 7, 0, 0, 250),
(39, 'Cream of Mushroom Soup', 4, 12, 0, 0, 250),
(40, 'Caesar Salad with Croutons and Crispy Bacon', 4, 27, 0, 0, 250),
(41, 'Potato Salad', 4, 27, 0, 0, 250),
(42, 'Ham and Macaroni Salad', 4, 27, 0, 0, 250),
(43, 'Beef Steak with Mushroom Gravy', 4, 10, 0, 0, 250),
(44, 'Pork Mechado', 4, 10, 0, 0, 250),
(45, 'Pan Fried Butterflied Prawns Don Ignacio', 4, 10, 0, 0, 250),
(46, 'Coq Au Vin (Roasted Chicken in Mushroom Rosemary Gravy Sauce)', 4, 10, 0, 0, 250),
(47, 'Mixed Seafood with Vegetables', 4, 10, 0, 0, 250),
(48, 'Fettuccine ala Primavera', 4, 10, 0, 0, 250),
(49, 'Lechon', 4, 10, 0, 0, 250),
(50, 'Steamed Rice', 4, 10, 0, 0, 250),
(51, 'Mango Crepe', 4, 8, 0, 0, 250),
(52, 'Assorted Pastries', 4, 8, 0, 0, 250),
(53, 'Flowing Coffee and Tea', 4, 9, 0, 0, 250),
(54, 'Mixed Sushi', 5, 7, 0, 0, 250),
(55, 'Tuna Sashimi', 5, 7, 0, 0, 250),
(56, 'Szechuan Squid Balls', 5, 7, 0, 0, 250),
(57, 'Cream of Agnes Sorel', 5, 12, 0, 0, 250),
(58, 'Tossed Green Salad with Thousand island Dressing', 5, 27, 0, 0, 250),
(59, 'Dilled Pasta Salad', 5, 27, 0, 0, 250),
(60, 'Waldorf Salad', 5, 27, 0, 0, 250),
(61, 'Beef Stroganoff with Bell Pepper & Dill Pickles', 5, 10, 0, 0, 250),
(62, 'Korean Pork Spareribs', 5, 10, 0, 0, 250),
(63, 'Grilled Prawns alaPobre', 5, 10, 0, 0, 250),
(64, 'Pollo con Jamon y Keso', 5, 10, 0, 0, 250),
(65, 'Buttered vegetabes', 5, 10, 0, 0, 250),
(66, 'Lasagna Italian', 5, 10, 0, 0, 250),
(67, 'Lechon', 5, 10, 0, 0, 250),
(68, 'Steamed Rice', 5, 10, 0, 0, 250),
(69, 'Mini Cream Puffs', 5, 9, 0, 0, 250),
(70, 'Mango Crepe', 5, 9, 0, 0, 250),
(71, 'Fresh Fruits', 5, 9, 0, 0, 250),
(72, 'Flowing Cup of Tea', 5, 10, 0, 0, 250);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `paylog_id` int(5) NOT NULL,
  `paylog_account_id` int(5) NOT NULL,
  `paylog_package_id` int(5) NOT NULL,
  `paylog_lname` varchar(32) NOT NULL,
  `paylog_fname` varchar(32) NOT NULL,
  `paylog_email` varchar(64) NOT NULL,
  `paylog_address` varchar(128) NOT NULL,
  `paylog_contact` varchar(12) NOT NULL,
  `paylog_eventtype` varchar(32) NOT NULL,
  `paylog_eventname` varchar(64) NOT NULL,
  `paylog_additionalinfo` varchar(256) NOT NULL,
  `paylog_paytype` varchar(16) NOT NULL,
  `paylog_pax` int(5) NOT NULL,
  `paylog_price` int(11) NOT NULL,
  `paylog_date_paid` date NOT NULL,
  `paylog_time_paid` time NOT NULL,
  `paylog_date_req` date NOT NULL,
  `paylog_time_req` time NOT NULL,
  `paylog_date_sent` date NOT NULL,
  `paylog_time_sent` time NOT NULL,
  `paylog_status` varchar(16) NOT NULL,
  `paylog_ordertype` varchar(16) NOT NULL,
  `paylog_package_ordered` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='This is where ALL payment logs(including connected databases) are stored. Please do take note';

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`paylog_id`, `paylog_account_id`, `paylog_package_id`, `paylog_lname`, `paylog_fname`, `paylog_email`, `paylog_address`, `paylog_contact`, `paylog_eventtype`, `paylog_eventname`, `paylog_additionalinfo`, `paylog_paytype`, `paylog_pax`, `paylog_price`, `paylog_date_paid`, `paylog_time_paid`, `paylog_date_req`, `paylog_time_req`, `paylog_date_sent`, `paylog_time_sent`, `paylog_status`, `paylog_ordertype`, `paylog_package_ordered`) VALUES
(506, 0, 0, 'Doe', 'John', 'maximize@gmail.com', '#225 Broadway St. California, USA', '09156132354', '', 'TestMan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in', 'Paypal', 200, 2299, '0000-00-00', '00:00:00', '2018-10-01', '17:00:00', '2018-07-08', '05:46:24', 'Reserved', 'package', '');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rev_id` int(5) NOT NULL,
  `rev_package_id` int(5) NOT NULL,
  `rev_rating_counter` float NOT NULL,
  `rev_comments` text NOT NULL,
  `rev_account_id` int(5) NOT NULL,
  `rev_account_username` varchar(16) NOT NULL,
  `rev_date_submitted` date NOT NULL,
  `rev_time_submitted` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rev_id`, `rev_package_id`, `rev_rating_counter`, `rev_comments`, `rev_account_id`, `rev_account_username`, `rev_date_submitted`, `rev_time_submitted`) VALUES
(1, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Bobbie', '0000-00-00', '00:00:00'),
(2, 2, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Frankie', '0000-00-00', '00:00:00'),
(3, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'John', '0000-00-00', '00:00:00'),
(4, 2, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Blankie', '0000-00-00', '00:00:00'),
(5, 2, 2, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Johnson', '0000-00-00', '00:00:00'),
(6, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Benson', '0000-00-00', '00:00:00'),
(7, 2, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Peter', '0000-00-00', '00:00:00'),
(8, 2, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Flagg', '0000-00-00', '00:00:00'),
(9, 1, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Bobbie', '0000-00-00', '00:00:00'),
(10, 1, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Frankie', '0000-00-00', '00:00:00'),
(11, 1, 2, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Anne', '0000-00-00', '00:00:00'),
(12, 1, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Kelly Parks', '0000-00-00', '00:00:00'),
(13, 1, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Shawn', '0000-00-00', '00:00:00'),
(14, 1, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Baldwin', '0000-00-00', '00:00:00'),
(15, 1, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Billy', '0000-00-00', '00:00:00'),
(16, 1, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Myers', '0000-00-00', '00:00:00'),
(17, 3, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'John', '0000-00-00', '00:00:00'),
(18, 3, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Flagg', '0000-00-00', '00:00:00'),
(19, 3, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Bobbie', '0000-00-00', '00:00:00'),
(20, 3, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Kelly Parks', '0000-00-00', '00:00:00'),
(21, 3, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Shawn', '0000-00-00', '00:00:00'),
(22, 4, 2, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Markie', '0000-00-00', '00:00:00'),
(23, 4, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Lance', '0000-00-00', '00:00:00'),
(24, 4, 3, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Miko', '0000-00-00', '00:00:00'),
(25, 4, 4, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Susan', '0000-00-00', '00:00:00'),
(26, 4, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Millie', '0000-00-00', '00:00:00'),
(27, 4, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Johnny', '0000-00-00', '00:00:00'),
(28, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Gills', '0000-00-00', '00:00:00'),
(29, 1, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Darwin', '0000-00-00', '00:00:00'),
(30, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Jack', '0000-00-00', '00:00:00'),
(31, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'David', '0000-00-00', '00:00:00'),
(32, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Porter', '0000-00-00', '00:00:00'),
(33, 2, 5, 'This package is so amazing! This required me to write some more stuff on this review system, because it requires me to do so..', 0, 'Eminam', '0000-00-00', '00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `acct_id` int(5) NOT NULL,
  `acct_lname` varchar(32) NOT NULL,
  `acct_fname` varchar(32) NOT NULL,
  `acct_emailaddress` varchar(64) NOT NULL,
  `acct_contact` varchar(12) NOT NULL,
  `acct_status` varchar(16) NOT NULL,
  `acct_images` varchar(128) NOT NULL,
  `acct_datereg` date NOT NULL,
  `acct_timereg` time NOT NULL,
  `acct_date_verified` date NOT NULL,
  `acct_time_verified` time NOT NULL,
  `acct_username` varchar(16) NOT NULL,
  `acct_password` varchar(32) NOT NULL,
  `acct_type` varchar(8) NOT NULL,
  `acct_lastlogin_date` date NOT NULL,
  `acct_lastlogin_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`acct_id`, `acct_lname`, `acct_fname`, `acct_emailaddress`, `acct_contact`, `acct_status`, `acct_images`, `acct_datereg`, `acct_timereg`, `acct_date_verified`, `acct_time_verified`, `acct_username`, `acct_password`, `acct_type`, `acct_lastlogin_date`, `acct_lastlogin_time`) VALUES
(1, 'Administrator', 'Administrator', 'null', '09123456789', 'verified', '0', '2018-02-03', '00:00:00', '2018-02-03', '00:00:00', 'admin', 'admin', 'admin', '2018-07-10', '06:46:51'),
(2, 'Pineda', 'Alexis', 'ixspnd.ap@gmail.com', '09151789825', 'verified', '', '2018-02-07', '07:00:00', '2018-02-07', '15:00:00', 'Alexis', 'asdqwe', 'user', '2018-07-10', '06:49:08'),
(10, 'Bin', 'Sum', 'sumbin@gmail.com', '09234567898', 'verified', '', '2018-03-24', '03:48:41', '0000-00-00', '00:00:00', 'Sumbin', 'asdqwe', 'user', '2018-07-10', '06:55:05'),
(13, 'Macomb', 'Judd', 'Macombjadd2@gmail.com', '09997321073', 'verified', '', '2018-05-11', '01:31:24', '0000-00-00', '00:00:00', 'Juddmacomb', 'matshie', 'user', '0000-00-00', '00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `inventory_log`
--
ALTER TABLE `inventory_log`
  ADD PRIMARY KEY (`inv_id`);

--
-- Indexes for table `messagesbox`
--
ALTER TABLE `messagesbox`
  ADD PRIMARY KEY (`mbox_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_contents`
--
ALTER TABLE `package_contents`
  ADD PRIMARY KEY (`pcont_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`paylog_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`acct_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `inventory_log`
--
ALTER TABLE `inventory_log`
  MODIFY `inv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1106;
--
-- AUTO_INCREMENT for table `messagesbox`
--
ALTER TABLE `messagesbox`
  MODIFY `mbox_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notif_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=684;
--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `package_contents`
--
ALTER TABLE `package_contents`
  MODIFY `pcont_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `paylog_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=507;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `acct_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
