-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2020 at 04:52 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `billing`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `is_default` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `address`, `phone`, `email`, `is_default`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 'Bhayander', 'Bhayander east', '7977383095', 'pankaj@vpran.in', 1, 0, '2019-07-04 16:58:03', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `site_short_name` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_phone` varchar(12) NOT NULL,
  `company_gstin` varchar(50) NOT NULL,
  `country` varchar(50) CHARACTER SET utf8 NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zipcode` varchar(7) NOT NULL,
  `company_logo` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `company_name`, `site_short_name`, `company_email`, `company_phone`, `company_gstin`, `country`, `state`, `city`, `street`, `zipcode`, `company_logo`, `added_on`, `update_on`) VALUES
(1, 4, 'VPRAN INC', 'Vpran', 'vpran@gmail.com', '0987654321', '', 'India (भारत)', 'test', 'test', 'test', 'test', '', '2019-11-30 00:00:00', '2019-07-04 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(100) NOT NULL,
  `invoice_no` int(6) UNSIGNED ZEROFILL NOT NULL,
  `invoice_date` date NOT NULL,
  `invoice_payment_method` varchar(20) NOT NULL,
  `invoice_customer_name` varchar(255) NOT NULL,
  `invoice_notes` varchar(255) NOT NULL,
  `invoice_sub_total` decimal(10,2) NOT NULL,
  `invoice_tax_total` decimal(10,2) NOT NULL,
  `invoice_grand_total` decimal(10,2) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_no`, `invoice_date`, `invoice_payment_method`, `invoice_customer_name`, `invoice_notes`, `invoice_sub_total`, `invoice_tax_total`, `invoice_grand_total`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 000001, '2019-06-01', 'Cash', '1', 'Weparty software is going to create by VPRAN', '142500.00', '25650.00', '168150.00', 0, '2019-06-01 17:04:02', '2019-06-30 18:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `invoice_item_name` varchar(250) NOT NULL,
  `invoice_item_hsn` varchar(100) NOT NULL,
  `invoice_item_qty` decimal(10,2) NOT NULL,
  `invoice_item_rate` decimal(10,2) NOT NULL,
  `invoice_item_discount` varchar(100) NOT NULL,
  `invoice_item_amount` decimal(10,2) NOT NULL,
  `invoice_tax_name` varchar(100) NOT NULL,
  `invoice_tax_amount` decimal(10,2) NOT NULL,
  `invoice_tax_total` decimal(10,2) NOT NULL,
  `invoice_sub_total` decimal(10,2) NOT NULL,
  `invoice_grand_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_item`
--

INSERT INTO `invoice_item` (`id`, `invoice_id`, `invoice_item_name`, `invoice_item_hsn`, `invoice_item_qty`, `invoice_item_rate`, `invoice_item_discount`, `invoice_item_amount`, `invoice_tax_name`, `invoice_tax_amount`, `invoice_tax_total`, `invoice_sub_total`, `invoice_grand_total`) VALUES
(1, 1, 'Weparty S/W', 'hsn', '1.00', '150000.00', '5', '142500.00', 'GST@18(18.00)', '25650.00', '2.00', '1.00', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `event` varchar(50) NOT NULL,
  `ip_address` varchar(20) NOT NULL,
  `date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `event`, `ip_address`, `date_time`) VALUES
(1, 1, 'login', '::1', '2019-05-24 22:18:40'),
(2, 1, 'login', '::1', '2019-05-25 19:39:23'),
(3, 1, 'login', '::1', '2019-05-26 09:12:10'),
(4, 1, 'login', '::1', '2019-05-26 09:16:12'),
(5, 1, 'login', '::1', '2019-05-26 15:28:51'),
(6, 1, 'login', '::1', '2019-05-26 19:40:31'),
(7, 1, 'login', '::1', '2019-05-26 19:58:45'),
(8, 0, 'login', '::1', '2019-05-27 22:38:30'),
(9, 1, 'login', '::1', '2019-05-27 22:38:45'),
(10, 1, 'logout', '::1', '2019-05-27 23:23:14'),
(11, 1, 'login', '::1', '2019-05-27 23:23:22'),
(12, 0, 'login', '::1', '2019-05-28 21:16:24'),
(13, 0, 'login', '::1', '2019-05-28 21:17:19'),
(14, 1, 'login', '::1', '2019-05-28 21:22:19'),
(15, 1, 'logout', '::1', '2019-05-28 21:25:53'),
(16, 4, 'login', '::1', '2019-05-28 21:26:19'),
(17, 1, 'login', '::1', '2019-05-29 22:17:43'),
(18, 1, 'logout', '::1', '2019-05-29 22:17:49'),
(19, 4, 'login', '::1', '2019-05-29 22:18:00'),
(20, 1, 'login', '::1', '2019-05-30 21:58:33'),
(21, 1, 'logout', '::1', '2019-05-30 22:20:25'),
(22, 4, 'login', '::1', '2019-05-30 22:20:38'),
(23, 1, 'login', '::1', '2019-05-30 22:40:42'),
(24, 1, 'login', '::1', '2019-05-30 22:46:45'),
(25, 4, 'login', '::1', '2019-05-31 20:12:27'),
(26, 4, 'login', '::1', '2019-06-01 20:21:30'),
(27, 1, 'login', '::1', '2019-06-01 22:08:33'),
(28, 4, 'login', '::1', '2019-06-01 22:09:26'),
(29, 1, 'login', '::1', '2019-06-02 19:46:25'),
(30, 4, 'login', '::1', '2019-06-02 19:46:43'),
(31, 4, 'login', '::1', '2019-06-03 20:10:18'),
(32, 1, 'login', '::1', '2019-06-30 21:47:28'),
(33, 1, 'logout', '::1', '2019-06-30 21:48:37'),
(34, 4, 'login', '::1', '2019-06-30 21:48:45'),
(35, 1, 'login', '::1', '2019-07-01 21:38:24'),
(36, 4, 'login', '::1', '2019-07-04 19:48:43'),
(37, 4, 'login', '::1', '2019-07-04 21:36:40'),
(38, 4, 'login', '::1', '2019-07-06 18:23:14'),
(39, 1, 'login', '::1', '2019-07-09 20:33:47'),
(40, 4, 'login', '::1', '2019-07-09 20:52:22'),
(41, 1, 'login', '203.194.99.96', '2019-07-09 21:35:08'),
(42, 1, 'logout', '203.194.99.96', '2019-07-09 21:46:54'),
(43, 1, 'login', '203.194.99.96', '2019-07-09 21:47:46'),
(44, 1, 'logout', '203.194.99.96', '2019-07-09 21:48:04'),
(45, 1, 'login', '203.194.99.96', '2019-07-09 21:48:12'),
(46, 1, 'login', '49.32.235.89', '2019-07-14 12:09:41'),
(47, 1, 'logout', '49.32.235.89', '2019-07-14 12:10:53'),
(48, 4, 'login', '49.32.235.89', '2019-07-14 12:11:09'),
(49, 1, 'login', '103.10.226.113', '2019-07-14 20:17:05'),
(50, 1, 'logout', '103.10.226.113', '2019-07-14 20:18:48'),
(51, 4, 'login', '103.10.226.113', '2019-07-14 20:19:15'),
(52, 4, 'login', '103.10.226.113', '2019-07-14 20:19:47'),
(53, 1, 'login', '49.33.245.92', '2019-08-20 19:45:43'),
(54, 1, 'login', '203.192.244.136', '2019-09-01 18:42:44'),
(55, 1, 'logout', '203.192.244.136', '2019-09-01 18:43:03'),
(56, 1, 'login', '203.192.244.136', '2019-09-01 18:43:10'),
(57, 1, 'logout', '203.192.244.136', '2019-09-01 18:43:29'),
(58, 4, 'login', '203.192.244.136', '2019-09-01 18:43:58'),
(59, 4, 'login', '203.192.244.136', '2019-09-01 18:44:25'),
(60, 4, 'login', '157.47.200.229', '2019-09-01 18:51:15'),
(61, 1, 'login', '203.192.213.9', '2019-11-30 12:43:56'),
(62, 1, 'logout', '203.192.213.9', '2019-11-30 12:44:40'),
(63, 1, 'login', '203.192.213.9', '2019-11-30 12:45:11'),
(64, 1, 'logout', '203.192.213.9', '2019-11-30 12:45:28'),
(65, 1, 'login', '203.192.213.9', '2019-11-30 12:45:38'),
(66, 1, 'logout', '203.192.213.9', '2019-11-30 12:47:46'),
(67, 4, 'login', '203.192.213.9', '2019-11-30 12:47:53'),
(68, 1, 'login', '203.192.209.176', '2019-12-04 22:08:48'),
(69, 1, 'logout', '203.192.209.176', '2019-12-04 22:10:51'),
(70, 4, 'login', '203.192.209.176', '2019-12-04 22:11:02'),
(71, 1, 'login', '203.192.209.189', '2019-12-24 22:49:09'),
(72, 1, 'logout', '203.192.209.189', '2019-12-24 22:49:28'),
(73, 1, 'login', '203.192.209.189', '2019-12-24 22:49:41'),
(74, 1, 'logout', '203.192.209.189', '2019-12-24 22:50:20'),
(75, 1, 'login', '203.192.209.189', '2019-12-24 22:51:49'),
(76, 1, 'logout', '203.192.209.189', '2019-12-24 22:52:28'),
(77, 3, 'login', '203.192.209.189', '2019-12-24 22:52:56'),
(78, 1, 'login', '157.49.237.14', '2019-12-25 11:46:59'),
(79, 1, 'login', '27.4.213.197', '2019-12-28 12:59:27'),
(80, 1, 'logout', '27.4.213.197', '2019-12-28 13:01:06'),
(81, 1, 'login', '27.4.213.197', '2019-12-28 13:11:50'),
(82, 4, 'login', '27.4.213.197', '2019-12-28 13:14:20'),
(83, 1, 'logout', '27.4.213.197', '2019-12-28 13:15:29'),
(84, 1, 'login', '203.192.209.167', '2020-01-01 15:09:54'),
(85, 1, 'logout', '203.192.209.167', '2020-01-01 15:11:19'),
(86, 1, 'login', '103.10.226.184', '2020-01-22 22:51:36'),
(87, 3, 'login', '::1', '2020-01-23 21:33:28'),
(88, 3, 'login', '::1', '2020-01-25 10:12:30'),
(89, 1, 'logout', '::1', '2020-03-15 01:46:36'),
(90, 1, 'login', '::1', '2020-03-15 01:47:56'),
(91, 1, 'logout', '::1', '2020-03-15 01:48:13'),
(92, 3, 'login', '::1', '2020-03-15 01:48:53'),
(93, 3, 'login', '::1', '2020-04-04 20:11:40'),
(94, 1, 'login', '::1', '2020-04-04 20:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `user_id`, `start_date`, `end_date`, `status`, `is_deleted`, `added_on`, `update_on`) VALUES
(2, 3, '2019-05-01', '2019-05-31', 0, 0, '2019-05-26 12:19:47', '2019-07-09 17:55:31'),
(3, 4, '2021-12-16', '2019-12-20', 1, 0, '2019-12-04 16:40:15', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(20) NOT NULL,
  `purchase` varchar(100) NOT NULL,
  `sale` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `hsn` enum('HSN','SAC','','') NOT NULL,
  `tax` varchar(40) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `quantity`, `purchase`, `sale`, `description`, `hsn`, `tax`, `status`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 'GST Billing', '50', '10000', '12000', 'GST Billing Software', 'HSN', 'GST@18', 1, 0, '2019-07-06 15:28:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `id` int(100) NOT NULL,
  `purchase_no` int(6) UNSIGNED ZEROFILL NOT NULL,
  `purchase_date` date NOT NULL,
  `purchase_payment_method` varchar(20) NOT NULL,
  `purchase_supplier_name` varchar(255) NOT NULL,
  `purchase_notes` varchar(255) NOT NULL,
  `purchase_sub_total` decimal(10,2) NOT NULL,
  `purchase_tax_total` decimal(10,2) NOT NULL,
  `purchase_grand_total` decimal(10,2) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `purchase_no`, `purchase_date`, `purchase_payment_method`, `purchase_supplier_name`, `purchase_notes`, `purchase_sub_total`, `purchase_tax_total`, `purchase_grand_total`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 000001, '2019-06-01', 'Cash', '1', 'asdf', '94.08', '11.29', '105.37', 0, '2019-06-02 18:00:43', '2019-06-02 18:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `purchase_item_name` varchar(250) NOT NULL,
  `purchase_item_hsn` varchar(100) NOT NULL,
  `purchase_item_qty` decimal(10,2) NOT NULL,
  `purchase_item_rate` decimal(10,2) NOT NULL,
  `purchase_item_discount` varchar(100) NOT NULL,
  `purchase_item_amount` decimal(10,2) NOT NULL,
  `purchase_tax_name` varchar(100) NOT NULL,
  `purchase_tax_amount` decimal(10,2) NOT NULL,
  `purchase_tax_total` decimal(10,2) NOT NULL,
  `purchase_sub_total` decimal(10,2) NOT NULL,
  `purchase_grand_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_item`
--

INSERT INTO `purchase_item` (`id`, `purchase_id`, `purchase_item_name`, `purchase_item_hsn`, `purchase_item_qty`, `purchase_item_rate`, `purchase_item_discount`, `purchase_item_amount`, `purchase_tax_name`, `purchase_tax_amount`, `purchase_tax_total`, `purchase_sub_total`, `purchase_grand_total`) VALUES
(1, 1, 'a', 'hsn', '32.00', '3.00', '2', '94.08', 'GST@12(12.00)', '11.29', '1.00', '9.00', '1.00');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id` int(100) NOT NULL,
  `quotation_no` int(6) UNSIGNED ZEROFILL NOT NULL,
  `quotation_date` date NOT NULL,
  `quotation_payment_method` varchar(20) NOT NULL,
  `quotation_customer_name` varchar(255) NOT NULL,
  `quotation_notes` varchar(255) NOT NULL,
  `quotation_sub_total` decimal(10,2) NOT NULL,
  `quotation_tax_total` decimal(10,2) NOT NULL,
  `quotation_grand_total` decimal(10,2) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id`, `quotation_no`, `quotation_date`, `quotation_payment_method`, `quotation_customer_name`, `quotation_notes`, `quotation_sub_total`, `quotation_tax_total`, `quotation_grand_total`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 000001, '2019-06-01', 'Cash', '2', 'asdf', '1050.00', '294.00', '1344.00', 0, '2019-06-02 16:22:08', '2019-06-02 16:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `quotation_item`
--

CREATE TABLE `quotation_item` (
  `id` int(11) NOT NULL,
  `quotation_id` int(11) NOT NULL,
  `quotation_item_name` varchar(250) NOT NULL,
  `quotation_item_hsn` varchar(100) NOT NULL,
  `quotation_item_qty` decimal(10,2) NOT NULL,
  `quotation_item_rate` decimal(10,2) NOT NULL,
  `quotation_item_discount` varchar(100) NOT NULL,
  `quotation_item_amount` decimal(10,2) NOT NULL,
  `quotation_tax_name` varchar(100) NOT NULL,
  `quotation_tax_amount` decimal(10,2) NOT NULL,
  `quotation_tax_total` decimal(10,2) NOT NULL,
  `quotation_sub_total` decimal(10,2) NOT NULL,
  `quotation_grand_total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_item`
--

INSERT INTO `quotation_item` (`id`, `quotation_id`, `quotation_item_name`, `quotation_item_hsn`, `quotation_item_qty`, `quotation_item_rate`, `quotation_item_discount`, `quotation_item_amount`, `quotation_tax_name`, `quotation_tax_amount`, `quotation_tax_total`, `quotation_sub_total`, `quotation_grand_total`) VALUES
(1, 1, 'b', 'hsn', '5.00', '200.00', '20', '800.00', 'GST@28(28.00)', '224.00', '9.00', '0.00', '3.00'),
(2, 1, 'b', 'hsn', '5.00', '200.00', '20', '800.00', 'GST@28(28.00)', '224.00', '9.00', '0.00', '3.00');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `filter` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `filter`, `status`, `is_deleted`, `added_on`, `update_on`) VALUES
(1, 'Invoice', 5, 1, 0, '2019-05-26 18:01:09', '0000-00-00 00:00:00'),
(2, 'Customer', 1, 1, 0, '2019-05-26 18:03:06', '2019-05-26 18:10:43'),
(3, 'Product', 3, 1, 0, '2019-05-26 18:03:15', '0000-00-00 00:00:00'),
(4, 'Quotation', 6, 1, 0, '2019-05-26 18:03:26', '0000-00-00 00:00:00'),
(5, 'Stock', 4, 1, 1, '2019-05-26 18:03:32', '0000-00-00 00:00:00'),
(6, 'Supplier', 2, 1, 1, '2019-05-26 18:03:41', '0000-00-00 00:00:00'),
(7, 'Purchase', 7, 1, 1, '2019-05-26 18:03:57', '0000-00-00 00:00:00'),
(8, 'Ledger', 8, 1, 1, '2019-05-26 18:06:40', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(12) NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `number` varchar(20) NOT NULL,
  `gstin` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `profile` varchar(50) NOT NULL,
  `role` enum('admin','sub_admin') NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `added_on` datetime NOT NULL,
  `update_on` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `last_logout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `number`, `gstin`, `country`, `state`, `city`, `street`, `zipcode`, `profile`, `role`, `is_deleted`, `status`, `service_id`, `added_on`, `update_on`, `last_login`, `last_logout`) VALUES
(1, 'Super Admin', 'admin@admin.com', '827ccb0eea8a706c4c34a16891f84e7b', '7977383095', '', 'India (भारत)', 'Maharashtra', 'Mumbai', 'Bhayander', '401105', '909589.jpg', 'admin', 0, '1', '', '2018-12-09 00:00:00', '2019-07-01 00:00:00', '2020-04-04 20:13:48', '2020-03-15 01:48:13'),
(3, 'rk', 'rk@vpran.in', '827ccb0eea8a706c4c34a16891f84e7b', '1234567890', '', 'India (भारत)', '', '', '', '', '', 'sub_admin', 0, '1', '1,2,3,4', '2019-05-24 20:20:53', '2019-12-24 17:22:22', '2020-04-04 20:11:39', '2020-01-23 21:33:39'),
(4, 'pankaj', 'pankaj@vpran.in', '827ccb0eea8a706c4c34a16891f84e7b', '0987654321', '', 'India (भारत)', 'test', 'test', 'test', 'test', 'team1.jpg', 'sub_admin', 0, '1', '1,2,3,4,6,7', '2019-05-26 18:38:13', '2019-11-30 00:00:00', '2019-12-28 13:14:19', '2019-12-28 13:15:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`purchase_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_item`
--
ALTER TABLE `quotation_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_id` (`quotation_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quotation_item`
--
ALTER TABLE `quotation_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
