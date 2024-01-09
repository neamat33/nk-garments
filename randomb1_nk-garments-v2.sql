-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 20, 2023 at 06:55 PM
-- Server version: 8.0.30
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `randomb1_nk-garments-v2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `opening_balance` decimal(22,2) NOT NULL DEFAULT '0.00',
  `default` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `name`, `opening_balance`, `default`, `created_at`, `updated_at`) VALUES
(1, 'CASH', 0.00, 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FACRORY SALES', 1, '2023-12-20 18:50:49', '2023-12-20 18:50:49'),
(2, 'SHOWROOM N.K.', 1, '2023-12-20 18:50:49', '2023-12-20 18:50:49');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Aarong', 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(2, 'Cats Eye', 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(3, 'Dorjibari', 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(4, 'Richman', 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(5, 'Yellow', 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_challans`
--

CREATE TABLE `delivery_challans` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_id` bigint UNSIGNED NOT NULL,
  `showroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci,
  `order_by` int DEFAULT NULL,
  `dispatched_by` int DEFAULT NULL,
  `mode_of_transport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_details` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_challan_items`
--

CREATE TABLE `delivery_challan_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `delivery_challan_id` bigint UNSIGNED NOT NULL,
  `party_sale_item_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `total_packages` int DEFAULT NULL,
  `packaging_details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Yern Stock', 1, '2023-12-20 18:50:49', '2023-12-20 18:50:49'),
(2, 'Knitting', 1, '2023-12-20 18:50:49', '2023-12-20 18:50:49'),
(3, 'Cutting', 1, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(4, 'Sewing', 1, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(5, 'Iron & Packing', 1, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(6, 'Factory Sales', 1, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(7, 'Showroom N.K', 1, '2023-12-20 18:50:50', '2023-12-20 18:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_address` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_name`, `department_id`, `designation`, `employee_type`, `join_date`, `phone`, `email`, `image`, `current_address`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Heaven Baumbach', 5, 'Hairdresser OR Cosmetologist', 'Salary', '1987-04-06', '+1-954-282-0222', 'skozey@eichmann.org', 'asset/placeholder_190x140c.png', '664 Kassulke Port\nGerlachport, SC 26832-8886', 'Numquam placeat dolorum non est eius recusandae earum.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(2, 'Phoebe Runolfsson', 3, 'Pharmacy Aide', 'Production', '2013-11-16', '+13202574769', 'von.jazmyne@gmail.com', 'asset/placeholder_190x140c.png', '53907 Goyette Circle Suite 044\nEast Jerel, FL 71909', 'Nihil quia expedita beatae quas.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(3, 'Mrs. Telly Graham II', 4, 'Personal Trainer', 'Salary', '2019-04-15', '+1.878.748.4779', 'zulauf.adeline@collins.com', 'asset/placeholder_190x140c.png', '42037 Runte Centers Apt. 633\nWest Halle, DC 59265', 'Dolor ut sint eius et labore possimus dolores.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(4, 'Miss Jessyca Morissette IV', 5, 'Geologist', 'Production', '2011-08-08', '262-637-4049', 'madeline.gerhold@yahoo.com', 'asset/placeholder_190x140c.png', '850 Langworth Lodge\nBarbaraton, TX 86938-1612', 'Voluptatem autem et animi adipisci qui repellat molestiae.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(5, 'Cydney Jacobson', 7, 'Soldering Machine Setter', 'Salary', '2006-10-25', '+1.217.375.2503', 'omurazik@gleason.com', 'asset/placeholder_190x140c.png', '814 Harber Estates\nEast Reagan, CT 39675', 'Exercitationem et eos iusto et quia.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(6, 'Wilma Mayer', 1, 'Grounds Maintenance Worker', 'Salary', '1995-04-07', '+17729481820', 'dina61@hotmail.com', 'asset/placeholder_190x140c.png', '77520 Langworth Camp Apt. 743\nWest Hettie, RI 97076', 'Omnis laboriosam cupiditate cupiditate.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(7, 'Miss Ebony Gutmann DDS', 3, 'Actor', 'Production', '1990-08-21', '575.461.1360', 'edwin.bechtelar@bosco.info', 'asset/placeholder_190x140c.png', '18993 Price Lakes\nHellenchester, MO 09975', 'Quaerat deserunt saepe quaerat exercitationem enim temporibus.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(8, 'Mr. Jake Schumm Jr.', 6, 'Photographic Process Worker', 'Salary', '1997-03-26', '947-342-3707', 'parker.fabiola@yahoo.com', 'asset/placeholder_190x140c.png', '47247 Heidenreich View\nEast Torrance, SD 34301-1290', 'Culpa est recusandae reprehenderit exercitationem odit iure aut.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(9, 'Dr. Ismael Hills II', 3, 'Conservation Scientist', 'Production', '1997-06-11', '980.223.5227', 'sanford.ivory@hotmail.com', 'asset/placeholder_190x140c.png', '545 Annabell Keys\nZboncakbury, ID 14142', 'Praesentium aliquam animi dolore iure quidem tempora.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(10, 'Johan Tremblay', 4, 'Stone Cutter', 'Production', '1994-10-30', '(838) 954-1609', 'mgerlach@hotmail.com', 'asset/placeholder_190x140c.png', '54356 Kara Orchard Suite 366\nEast Walkermouth, SD 73882-2940', 'Vero ipsa vel eum vitae minima voluptatem quas.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(11, 'Prof. Perry Ward DVM', 2, 'Railroad Inspector', 'Salary', '2013-07-24', '1-272-630-5647', 'uflatley@lehner.com', 'asset/placeholder_190x140c.png', '54394 Conrad Pine\nLake Rico, OH 27687', 'Deserunt natus maxime magni saepe.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(12, 'Garrison Schneider', 2, 'Supervisor Fire Fighting Worker', 'Production', '2022-03-25', '1-534-238-0169', 'bailey.hayley@smith.com', 'asset/placeholder_190x140c.png', '516 Carter Glen Suite 390\nDominiquefort, OR 15734', 'Voluptas distinctio dolorem fuga minima quod quod.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(13, 'Ms. Jennie Fay II', 4, 'Pipelayer', 'Production', '2001-12-22', '1-341-420-8621', 'kautzer.berry@yahoo.com', 'asset/placeholder_190x140c.png', '8925 Padberg Valley\nTillmanmouth, MI 62840', 'Sunt dolores quia aliquid.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(14, 'Mrs. Domenica Towne', 6, 'Product Safety Engineer', 'Salary', '1974-11-09', '1-610-441-1943', 'zion35@yahoo.com', 'asset/placeholder_190x140c.png', '91444 Maynard Lodge Suite 586\nBoyerton, DC 18324-3204', 'Et voluptate eveniet recusandae nesciunt et dolor officiis ea.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(15, 'Ronny Fisher', 4, 'Athletic Trainer', 'Production', '2001-07-28', '+1 (951) 728-8980', 'beahan.marlene@yahoo.com', 'asset/placeholder_190x140c.png', '2020 Obie Flat\nEllisfurt, DE 70581-0962', 'Assumenda saepe dolores quae commodi.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(16, 'Dr. Deion Trantow', 1, 'Concierge', 'Production', '1999-03-12', '361-618-8093', 'ylabadie@bogan.com', 'asset/placeholder_190x140c.png', '27572 Leland Track\nNew Breannemouth, NH 15884', 'Cum vitae qui culpa omnis.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(17, 'Freida Johnston', 4, 'Inspector', 'Production', '1980-11-11', '+1-201-517-8217', 'ukoch@yahoo.com', 'asset/placeholder_190x140c.png', '90199 Breanne Tunnel\nNorth Chelsieport, ND 30371', 'Fugiat sequi sit quam.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(18, 'Lizzie Murphy', 6, 'Food Scientists and Technologist', 'Salary', '2016-06-24', '+1-832-407-0054', 'zander28@hudson.net', 'asset/placeholder_190x140c.png', '166 Clarabelle Dam\nEast Osbaldomouth, OH 61112-6094', 'Non minima qui et reiciendis.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(19, 'Dr. Ellsworth Conroy', 6, 'Solderer', 'Salary', '1979-01-21', '283.694.5327', 'gaylord.eusebio@mohr.info', 'asset/placeholder_190x140c.png', '4276 Steuber Canyon\nPreciouston, PA 73735-7163', 'Beatae optio et eos quas maiores et aperiam.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(20, 'Genesis Bosco', 1, 'Automotive Master Mechanic', 'Salary', '2019-08-24', '+1-938-873-2827', 'jacobson.tierra@gottlieb.com', 'asset/placeholder_190x140c.png', '54783 Kreiger Drive Apt. 288\nCliffordhaven, NJ 21764', 'Quam necessitatibus quia architecto iste neque a.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(21, 'Stanford Bauch', 7, 'MARCOM Director', 'Salary', '1971-04-27', '+1-347-965-9559', 'ezekiel.thiel@kutch.com', 'asset/placeholder_190x140c.png', '6158 Orin Locks\nWilltown, IA 42547-6243', 'Eius nam praesentium qui rerum.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(22, 'Ms. Kaelyn Kirlin II', 1, 'Surgical Technologist', 'Salary', '2023-09-30', '(845) 400-8241', 'etremblay@gibson.info', 'asset/placeholder_190x140c.png', '37480 Sporer Rapid Suite 549\nEast Westonmouth, TN 75376-2324', 'Ut illo odit omnis.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(23, 'Mariano Kautzer', 6, 'Personal Home Care Aide', 'Production', '2006-04-14', '1-646-510-4390', 'abergstrom@hotmail.com', 'asset/placeholder_190x140c.png', '465 Marquise Summit Apt. 827\nMorarport, NV 65637', 'Laudantium id quisquam ea eligendi harum et.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(24, 'Velma Kirlin', 3, 'Supervisor Fire Fighting Worker', 'Production', '2001-06-01', '+1-567-647-8079', 'elta.morissette@yahoo.com', 'asset/placeholder_190x140c.png', '236 Gene Pine\nNorth Friedaberg, ME 50858', 'Autem eos eos explicabo.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(25, 'Shemar Bayer', 3, 'Social Science Research Assistant', 'Salary', '1976-10-15', '+1.616.313.8621', 'borer.isabella@effertz.com', 'asset/placeholder_190x140c.png', '1540 Purdy Crossroad Suite 561\nNorth Cathrine, TX 22600', 'Doloremque totam earum omnis nesciunt et consequuntur.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(26, 'Mr. Bertrand Turcotte Sr.', 3, 'Information Systems Manager', 'Salary', '1985-03-22', '913-841-9992', 'graham.bertram@yahoo.com', 'asset/placeholder_190x140c.png', '188 Mosciski Drive Apt. 143\nLake Gabe, IL 90883', 'Deserunt quas non beatae mollitia.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(27, 'Rozella Mohr', 4, 'Gas Pumping Station Operator', 'Production', '2022-05-13', '(254) 552-5762', 'goodwin.jasper@mayert.com', 'asset/placeholder_190x140c.png', '3220 Dietrich Well Apt. 529\nLake Eudora, ID 04545-2553', 'Cupiditate iusto voluptates eum.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(28, 'Kailyn Buckridge', 2, 'Technical Specialist', 'Production', '1998-03-10', '(316) 984-3603', 'pyost@mitchell.biz', 'asset/placeholder_190x140c.png', '89021 Karelle Lock\nGunnarside, NJ 74776-1503', 'Dolor dolores voluptatibus quo cumque doloribus dolores est.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(29, 'Cloyd Roberts IV', 1, 'Employment Interviewer', 'Production', '2016-01-12', '(503) 263-1679', 'hettinger.michaela@gmail.com', 'asset/placeholder_190x140c.png', '48480 Evangeline Ville Apt. 088\nJaynemouth, WV 03884', 'Eum at nihil hic veniam.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(30, 'Emiliano Hermiston', 2, 'Computer Hardware Engineer', 'Production', '1970-08-23', '(617) 713-0420', 'weimann.adam@gmail.com', 'asset/placeholder_190x140c.png', '994 Hahn Viaduct Apt. 157\nChadport, SC 57808', 'Cum saepe laborum ullam ut consequatur aut dolores.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(31, 'Yessenia Lang Jr.', 7, 'Gauger', 'Production', '1999-01-21', '360-899-4058', 'melvin64@klein.org', 'asset/placeholder_190x140c.png', '99190 Arnold Street Apt. 762\nAndersonshire, VA 35418-9175', 'Earum amet asperiores rerum nam aliquid architecto repellat.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(32, 'Mrs. Flavie Jenkins', 5, 'Natural Sciences Manager', 'Production', '2017-02-28', '574-398-8755', 'raynor.rusty@gmail.com', 'asset/placeholder_190x140c.png', '8693 Archibald Fort\nNorth Cesar, IL 27669-7280', 'Nobis beatae quisquam dolorem iste ad quibusdam eum.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(33, 'Dr. Floyd Murray I', 3, 'Supervisor Fire Fighting Worker', 'Production', '2008-03-15', '424.927.0157', 'qweber@yahoo.com', 'asset/placeholder_190x140c.png', '699 Akeem Circle Suite 626\nLake Jabariport, UT 45712-3407', 'In natus doloremque quo adipisci omnis.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(34, 'Ms. Delphia Jacobi Sr.', 3, 'Psychology Teacher', 'Salary', '1978-01-20', '937-835-8573', 'emely85@kilback.com', 'asset/placeholder_190x140c.png', '5662 Hackett Ville Apt. 975\nSouth Davin, CA 94638', 'Architecto nesciunt sit cumque qui quasi.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(35, 'Mossie Moen Jr.', 5, 'Creative Writer', 'Production', '2011-01-30', '+1.813.954.0897', 'collin40@mertz.com', 'asset/placeholder_190x140c.png', '3300 Strosin Mountains\nReggieborough, AL 05035', 'Sed voluptatem minima ut non ex sed.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(36, 'Eriberto Beahan', 6, 'Airfield Operations Specialist', 'Salary', '2015-03-03', '+1-401-273-9883', 'fern54@rosenbaum.info', 'asset/placeholder_190x140c.png', '68770 Hoeger Path Apt. 206\nCarleyville, TX 02718-7499', 'Inventore sunt et itaque ipsum aperiam sed voluptatibus.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(37, 'Prof. Chauncey O\'Connell', 4, 'Telephone Station Installer and Repairer', 'Production', '2004-05-18', '(651) 201-7575', 'gbreitenberg@hagenes.com', 'asset/placeholder_190x140c.png', '7011 Friesen Dam\nNorth Isabellechester, IN 45669', 'Quidem iusto aut id autem vitae voluptates veritatis quibusdam.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(38, 'Lucas Mueller', 7, 'Recreation Worker', 'Production', '2002-01-02', '424.672.3479', 'conroy.yvette@wolf.com', 'asset/placeholder_190x140c.png', '7313 Janet Vista\nPort Johnpaultown, MO 65477', 'Aut cupiditate labore non distinctio.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(39, 'Dasia Ziemann', 1, 'Director Of Business Development', 'Salary', '1992-05-26', '+1-732-724-5078', 'schristiansen@hotmail.com', 'asset/placeholder_190x140c.png', '21910 Kulas Village Suite 503\nNew Adrielchester, TX 24536-8746', 'Nulla pariatur ab distinctio nam deleniti.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(40, 'Leila Hammes', 6, 'Dragline Operator', 'Production', '2011-07-06', '+1.934.417.4752', 'pacocha.dwight@yahoo.com', 'asset/placeholder_190x140c.png', '4112 Vladimir Unions Suite 019\nEast Russell, RI 00944-6441', 'Nulla veritatis quasi aspernatur ut suscipit repellendus.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(41, 'Dr. Jakob Strosin', 3, 'Personal Trainer', 'Production', '1997-12-05', '+1-559-463-1793', 'heathcote.elwin@hotmail.com', 'asset/placeholder_190x140c.png', '77408 Feest Center\nCummingshaven, MT 03151-3902', 'Dignissimos labore eos perspiciatis aut est est aut.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(42, 'Philip Streich', 7, 'Event Planner', 'Production', '1996-03-12', '+18548251705', 'erdman.guy@barrows.net', 'asset/placeholder_190x140c.png', '28959 Liana Motorway\nPort Gardner, WV 33753', 'Rerum eveniet excepturi unde.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(43, 'Edwin Heathcote', 3, 'Washing Equipment Operator', 'Salary', '2012-06-28', '+14353578517', 'wehner.shad@boehm.com', 'asset/placeholder_190x140c.png', '15381 Leann Inlet Suite 426\nNew Xzavier, NH 24691-7313', 'Minus iste ea dolor dolores quis perferendis.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(44, 'Nico Jones', 7, 'Patternmaker', 'Salary', '1980-03-21', '1-220-372-9578', 'sawayn.gus@nienow.com', 'asset/placeholder_190x140c.png', '71833 Gerald Vista Apt. 220\nNew Kieramouth, WV 31135', 'Ullam aspernatur nesciunt consectetur occaecati aperiam.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(45, 'Armani Kuvalis', 6, 'Electronics Engineer', 'Production', '1990-08-11', '+1 (321) 344-2337', 'rahsaan73@hotmail.com', 'asset/placeholder_190x140c.png', '356 Klocko Prairie Suite 347\nAlexandriaport, DC 47812', 'Ut voluptatem error quidem cum molestiae blanditiis ut numquam.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(46, 'Reanna Crist', 2, 'Special Force', 'Production', '1983-06-06', '650.692.8514', 'ckris@pacocha.biz', 'asset/placeholder_190x140c.png', '88683 Olson Inlet Apt. 580\nSmithamside, ME 03469-6834', 'Quia ut ex dolorem facere.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(47, 'Enrico Pfannerstill', 2, 'Heating Equipment Operator', 'Salary', '2012-04-06', '1-703-338-6741', 'leif.wehner@yahoo.com', 'asset/placeholder_190x140c.png', '75338 Roob Locks Suite 698\nRemingtonchester, MA 81422', 'Qui qui nobis quae recusandae et.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(48, 'Amelia Kris PhD', 4, 'Orthotist OR Prosthetist', 'Production', '1990-05-30', '714-992-9603', 'lakin.kole@goyette.net', 'asset/placeholder_190x140c.png', '53402 Delmer Ferry\nNorth Noeside, DE 74013', 'Reiciendis nihil ipsam nostrum exercitationem.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(49, 'Mrs. Ayana Bruen II', 4, 'Plating Operator', 'Salary', '1972-06-15', '+1-470-222-7405', 'julianne55@yahoo.com', 'asset/placeholder_190x140c.png', '34042 Kovacek Harbor Apt. 701\nNorth Tabithafort, VA 22755', 'Eius ad optio aliquam.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(50, 'Barbara Shields', 3, 'Paste-Up Worker', 'Production', '1987-02-16', '248-661-2423', 'hilpert.timmy@gmail.com', 'asset/placeholder_190x140c.png', '579 Corkery Corner Apt. 633\nMuellerside, NV 00793-6798', 'Est voluptatem ut aut natus.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(51, 'Dr. Lorenzo Altenwerth', 4, 'Tire Builder', 'Salary', '2005-11-06', '779.502.6800', 'sierra.dibbert@bruen.com', 'asset/placeholder_190x140c.png', '78859 Rhiannon Crescent Suite 766\nGrantstad, NC 39988-6240', 'Enim unde a dicta veniam.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(52, 'Emanuel Harber I', 7, 'Social Science Research Assistant', 'Salary', '1993-01-18', '+1-248-553-7676', 'vincenza.koss@lang.org', 'asset/placeholder_190x140c.png', '9138 Hilpert Springs Suite 517\nPort Marieborough, AK 07793-3343', 'Asperiores nam sequi voluptatem nemo incidunt et et.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(53, 'Chauncey Gleichner', 2, 'Multi-Media Artist', 'Production', '1984-03-22', '+1.603.765.8058', 'dino20@hauck.biz', 'asset/placeholder_190x140c.png', '208 Abbie Center\nNorth Letamouth, CA 70303', 'Temporibus nam facilis accusantium nobis ducimus eum.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(54, 'Gennaro Schultz', 4, 'Web Developer', 'Production', '2002-04-13', '1-712-468-8601', 'rlind@yahoo.com', 'asset/placeholder_190x140c.png', '78780 Gerhold Lake Apt. 183\nKeeblerside, MN 53654', 'Laborum omnis consequatur nisi aut iste.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(55, 'Mr. Juwan Bradtke', 4, 'Brake Machine Setter', 'Salary', '2001-05-23', '+1 (909) 706-9414', 'lynch.linda@gmail.com', 'asset/placeholder_190x140c.png', '345 Ari Fort\nPort Jaunitastad, WY 68306-9994', 'Rerum maiores voluptatum molestiae nulla officia quod modi.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(56, 'Viola Wiza', 2, 'Chiropractor', 'Production', '1991-05-26', '+14237972400', 'casey64@greenholt.info', 'asset/placeholder_190x140c.png', '9871 Rory Pines Apt. 607\nHamillfort, GA 27015-4944', 'Voluptas voluptatibus minus magnam magnam aliquid quo.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(57, 'Pasquale Koss', 6, 'Detective', 'Salary', '2010-08-21', '1-689-793-5154', 'nconn@gmail.com', 'asset/placeholder_190x140c.png', '87765 Herman Orchard\nNew Treyborough, MI 96081-2070', 'Illo quia rerum et aut repudiandae tenetur veritatis.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(58, 'Dr. Ethel Veum', 7, 'First-Line Supervisor-Manager of Landscaping, Lawn Service, and Groundskeeping Worker', 'Production', '1974-04-24', '626.675.1776', 'abigayle29@west.com', 'asset/placeholder_190x140c.png', '84796 Weber Turnpike\nMckaylabury, MI 34641', 'Qui dolor animi dolores quis.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(59, 'Dr. Rusty Langosh V', 4, 'Tool and Die Maker', 'Production', '2020-01-04', '1-470-745-2967', 'vidal.thiel@hotmail.com', 'asset/placeholder_190x140c.png', '50444 Jeramy Courts Apt. 729\nWest Forestshire, OR 56474-5275', 'Omnis consequuntur natus aut voluptas recusandae est.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(60, 'Boyd Kihn', 7, 'Textile Knitting Machine Operator', 'Production', '2005-11-18', '770-522-0243', 'skreiger@reichel.biz', 'asset/placeholder_190x140c.png', '83768 Icie Circle Suite 755\nBergstromview, MA 64403-9457', 'Distinctio aperiam quia quis incidunt ea illum maxime magnam.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(61, 'Prof. Elmore Smith', 2, 'Drywall Ceiling Tile Installer', 'Production', '1982-09-04', '870.388.5873', 'nfahey@yahoo.com', 'asset/placeholder_190x140c.png', '81032 Von Fork Apt. 566\nKubport, AK 81905', 'Explicabo iste maxime quis cum fugiat in ut natus.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(62, 'Jaylen Steuber', 4, 'Welder', 'Production', '1987-07-12', '(351) 342-6266', 'kuphal.creola@hahn.com', 'asset/placeholder_190x140c.png', '8810 Aliyah Meadows Apt. 031\nGottliebmouth, NV 66925', 'Ex est hic vel facere est ab quaerat perferendis.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(63, 'Precious Bosco', 2, 'Sales Engineer', 'Salary', '1980-01-15', '+1-714-423-6606', 'jayce40@okeefe.org', 'asset/placeholder_190x140c.png', '419 Arvel Shore\nFisherburgh, OR 42045-7441', 'Repellendus atque in distinctio natus labore quod veniam.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(64, 'Prof. Isaiah Dickinson', 6, 'Teller', 'Production', '1996-02-16', '+1.954.301.8977', 'santiago.schneider@yahoo.com', 'asset/placeholder_190x140c.png', '262 Candelario Haven Suite 026\nIvoryfort, VT 53754-7792', 'Delectus eos qui voluptas nemo eveniet nihil.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(65, 'Quinten Lemke', 3, 'Transportation Equipment Painters', 'Production', '2000-12-03', '+1 (734) 431-7996', 'elynch@mann.biz', 'asset/placeholder_190x140c.png', '813 D\'Amore Path Apt. 268\nConnerbury, MD 37022-0716', 'Veniam mollitia ea non occaecati qui ducimus.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(66, 'Dylan Conroy II', 7, 'State', 'Production', '2016-09-12', '(430) 299-2856', 'sadye.krajcik@yahoo.com', 'asset/placeholder_190x140c.png', '3128 Braulio Courts\nWest Kira, LA 75877', 'Distinctio ut animi corporis consectetur eos ex tempore.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(67, 'Torey Hettinger', 7, 'Mining Engineer OR Geological Engineer', 'Production', '1981-11-07', '1-773-467-6744', 'ucorkery@yahoo.com', 'asset/placeholder_190x140c.png', '85048 Ward Hill\nEast Magdalen, DE 84845-2667', 'Est corporis cumque magnam sunt.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(68, 'London DuBuque', 3, 'Building Cleaning Worker', 'Salary', '2016-10-05', '+19859494460', 'ubaldo.jacobi@gmail.com', 'asset/placeholder_190x140c.png', '6266 Stefan Mountains\nNorth Hesterchester, NH 66280-5495', 'Optio et distinctio quasi et beatae aspernatur dolorum.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(69, 'Mrs. Lexie Stoltenberg', 5, 'Railroad Inspector', 'Production', '1988-12-19', '+1 (984) 252-5931', 'amber.powlowski@fisher.net', 'asset/placeholder_190x140c.png', '1263 Leilani Way\nEusebioberg, NV 91149', 'Nulla eligendi tempore repellendus maxime temporibus.', '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(70, 'Prof. Garrison Lockman III', 5, 'Short Order Cook', 'Production', '2011-07-10', '1-304-843-6720', 'monty.wunsch@prosacco.net', 'asset/placeholder_190x140c.png', '44911 Carlo Burg\nNorth Shaniyaville, NM 76949', 'Vitae debitis aut porro quia et.', '2023-12-20 18:50:59', '2023-12-20 18:50:59'),
(71, 'Prof. Clyde Mertz', 6, 'Electro-Mechanical Technician', 'Salary', '2010-01-29', '1-281-917-1101', 'emerald45@gmail.com', 'asset/placeholder_190x140c.png', '962 Schimmel Rapids\nAnissaside, MT 75317-3962', 'Ab maxime rerum voluptate ut.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(72, 'Joseph Schumm', 7, 'Urban Planner', 'Salary', '1999-03-15', '+1.972.238.4975', 'lilliana.cartwright@yahoo.com', 'asset/placeholder_190x140c.png', '369 Conrad Dale\nPort Kylie, AR 14510-3731', 'Consequatur debitis dolores magnam.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(73, 'Mr. Keenan Rosenbaum I', 3, 'Gas Appliance Repairer', 'Salary', '1982-08-18', '+1.857.773.8528', 'kovacek.constance@gmail.com', 'asset/placeholder_190x140c.png', '306 Bosco Extensions\nNew Beryl, AL 13759-9376', 'Placeat vel voluptatem dignissimos occaecati deserunt dolore illum.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(74, 'Antonietta Kohler', 1, 'Movers', 'Production', '1986-01-18', '+1-743-988-7695', 'alan.boyle@kutch.biz', 'asset/placeholder_190x140c.png', '993 Kutch Lakes Suite 223\nNannietown, RI 29396-0202', 'Nam eius saepe sapiente nisi officiis.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(75, 'Prof. Lauriane Kihn', 7, 'Bookbinder', 'Production', '1994-10-22', '775-938-4814', 'elna.schumm@yahoo.com', 'asset/placeholder_190x140c.png', '3485 Hegmann Plaza Apt. 963\nPort Heath, NM 40072-5907', 'Nihil et aliquam ipsum inventore.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(76, 'Jaunita Schmitt', 7, 'Logging Worker', 'Production', '2005-11-13', '+1.240.637.1030', 'mhills@hotmail.com', 'asset/placeholder_190x140c.png', '8369 Makayla Island\nAdeleside, HI 34868', 'Voluptatibus nemo sed quibusdam facilis tempore.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(77, 'Matt Cole Sr.', 7, 'Fitness Trainer', 'Salary', '1992-02-25', '+15303309573', 'eva68@yahoo.com', 'asset/placeholder_190x140c.png', '77228 Clovis Port Suite 913\nNew Waldo, ND 63084-4559', 'Officia rem et odit dignissimos ipsam aliquam.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(78, 'Keagan Predovic', 6, 'Municipal Clerk', 'Salary', '2003-08-16', '+1-281-561-5242', 'nrau@macejkovic.info', 'asset/placeholder_190x140c.png', '8663 Cassandre Valleys\nEast Delphiastad, SC 33227-3200', 'Sed non est et molestias explicabo.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(79, 'Kris Miller', 1, 'Numerical Control Machine Tool Operator', 'Salary', '1996-03-28', '+1.910.657.0295', 'magnolia02@hotmail.com', 'asset/placeholder_190x140c.png', '5170 Daren Plains Suite 496\nReeceshire, NE 59459', 'Tenetur et dignissimos consequatur quos saepe ut.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(80, 'Prof. Vickie Fisher', 7, 'Credit Analyst', 'Production', '2005-09-27', '+1-423-951-2174', 'fbode@gmail.com', 'asset/placeholder_190x140c.png', '554 Devin View\nRoobport, MD 64433-6306', 'Nihil qui consequatur et nisi corporis fugiat.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(81, 'Opal Cummerata', 4, 'Surgical Technologist', 'Production', '2020-08-30', '640.902.4697', 'willard49@walter.net', 'asset/placeholder_190x140c.png', '93550 Camila Burgs Suite 303\nEast Jettieburgh, MD 12449-5531', 'Placeat debitis corrupti commodi quia nam vel qui.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(82, 'Ashleigh Gerlach', 6, 'Pest Control Worker', 'Production', '1984-04-25', '1-551-697-2132', 'rachael.oreilly@hotmail.com', 'asset/placeholder_190x140c.png', '459 Block Bridge Suite 805\nNew Loyberg, ME 45357', 'Rerum ipsam non quod dignissimos occaecati quidem.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(83, 'Brain Friesen', 6, 'Precision Instrument Repairer', 'Salary', '2015-12-08', '1-458-632-5129', 'roger24@weissnat.com', 'asset/placeholder_190x140c.png', '585 Marks Green Suite 538\nNorth Valentine, GA 31203-1329', 'Neque ab iure omnis exercitationem cum enim est.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(84, 'Catherine Koss', 5, 'Aircraft Rigging Assembler', 'Production', '2016-08-20', '1-361-395-6175', 'ratke.lempi@hotmail.com', 'asset/placeholder_190x140c.png', '7440 Torp Plaza\nNorth Cullenshire, TX 93088-7009', 'Excepturi nemo et suscipit et adipisci qui necessitatibus quis.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(85, 'Dr. Marcia Leuschke DVM', 6, 'Municipal Fire Fighter', 'Production', '2011-11-30', '+1-706-281-7156', 'ihintz@gmail.com', 'asset/placeholder_190x140c.png', '80077 Tillman Roads\nNorth Pansyside, WV 83632', 'Pariatur nisi alias dolor non.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(86, 'Emelie Bailey', 1, 'Electrical Engineering Technician', 'Salary', '2018-09-06', '+1.812.928.7997', 'vmohr@rutherford.com', 'asset/placeholder_190x140c.png', '75132 Fadel Place\nCarlifurt, NY 28227', 'Autem et occaecati quaerat veritatis.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(87, 'Adeline Heidenreich', 3, 'Manager', 'Salary', '1990-12-23', '+1 (817) 918-2636', 'raymond.howell@kiehn.biz', 'asset/placeholder_190x140c.png', '6433 Shields Forks Apt. 612\nNew Wiley, VT 86937', 'Soluta illum dolores ut est.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(88, 'Mr. Darrion Abshire I', 5, 'Poultry Cutter', 'Production', '2010-10-14', '+19414874476', 'pparisian@gmail.com', 'asset/placeholder_190x140c.png', '11576 Cruickshank Villages\nMichellehaven, AK 22489', 'Quia eveniet et impedit temporibus.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(89, 'Oliver Dooley', 7, 'Landscaping', 'Production', '1993-02-16', '458-623-2251', 'lchamplin@gmail.com', 'asset/placeholder_190x140c.png', '96282 Nicolas Spur\nWest Kianland, MO 87999', 'Et voluptas eligendi doloribus ut omnis culpa eius sit.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(90, 'Leo Abshire', 4, 'Real Estate Association Manager', 'Salary', '1993-04-01', '+17402324302', 'hackett.jensen@yahoo.com', 'asset/placeholder_190x140c.png', '53959 Katherine Pines\nSimmouth, NH 60660', 'A sed nihil temporibus tenetur quia atque sit.', '2023-12-20 18:51:03', '2023-12-20 18:51:03'),
(91, 'Garland Kassulke', 7, 'Protective Service Worker', 'Salary', '1978-11-18', '+1.602.299.8418', 'hschaden@hotmail.com', 'asset/placeholder_190x140c.png', '85464 Bette Garden Apt. 444\nEloisaside, NY 95105', 'Dolorem omnis corporis alias tempora facilis.', '2023-12-20 18:51:07', '2023-12-20 18:51:07'),
(92, 'Adrienne Bailey', 6, 'Central Office and PBX Installers', 'Production', '1989-03-23', '(210) 375-1240', 'isabelle.armstrong@hotmail.com', 'asset/placeholder_190x140c.png', '33396 Sanford Well\nJalenland, MS 24885', 'Aut laborum et qui.', '2023-12-20 18:51:08', '2023-12-20 18:51:08'),
(93, 'Mr. Mckenzie Halvorson', 6, 'Agricultural Technician', 'Salary', '1982-03-18', '+1.316.404.8362', 'sawayn.ana@hotmail.com', 'asset/placeholder_190x140c.png', '73668 Kellen Parks Suite 788\nEast Wilsonland, ID 67305', 'Deserunt molestiae assumenda dolorem ut aut.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(94, 'Savanah King PhD', 5, 'Information Systems Manager', 'Production', '1998-05-28', '1-573-277-7217', 'kaylin.huels@grant.com', 'asset/placeholder_190x140c.png', '31124 Dominique Lane\nLindgrenton, TN 22476', 'Officia quia cupiditate et animi aut labore.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(95, 'Betsy Ankunding', 2, 'Judge', 'Salary', '1978-07-24', '620.744.4115', 'paige71@hotmail.com', 'asset/placeholder_190x140c.png', '30981 Wayne Meadows Suite 524\nLake Kenyatta, AK 36766', 'Voluptas et est fugiat facilis maxime cumque qui.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(96, 'Alek Wisoky', 6, 'Roofer', 'Production', '2002-01-15', '920-552-7926', 'kbatz@yahoo.com', 'asset/placeholder_190x140c.png', '852 Ellis Dam Suite 550\nHaileeborough, AL 04154', 'Mollitia voluptates qui nam distinctio.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(97, 'Ferne Kutch II', 7, 'Mail Clerk', 'Production', '2009-12-26', '1-734-915-4844', 'ttreutel@koch.com', 'asset/placeholder_190x140c.png', '1410 Aubree Viaduct Suite 796\nWest Paolostad, AR 78069', 'Sit voluptate quo veritatis.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(98, 'Zoe Homenick', 2, 'Buyer', 'Production', '1975-01-31', '1-603-805-6348', 'summer.buckridge@hotmail.com', 'asset/placeholder_190x140c.png', '1866 Orland Pass Apt. 327\nKaitlinstad, MT 32739', 'Aliquam dolores cupiditate voluptate.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(99, 'Luna Hintz', 5, 'Veterinary Assistant OR Laboratory Animal Caretaker', 'Salary', '2008-02-11', '878-672-1245', 'humberto43@gmail.com', 'asset/placeholder_190x140c.png', '330 Laurel Haven Apt. 551\nLake Trystan, NM 60067-5766', 'Quos est magnam tenetur omnis quod.', '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(100, 'Noble Corwin', 4, 'Storage Manager OR Distribution Manager', 'Production', '1984-05-02', '747.462.7324', 'qschumm@hotmail.com', 'asset/placeholder_190x140c.png', '55603 Skiles Passage\nNew Alyce, KY 05698-6799', 'Incidunt non eaque necessitatibus ut sit ullam possimus.', '2023-12-20 18:51:10', '2023-12-20 18:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_educational_trainings`
--

CREATE TABLE `employee_educational_trainings` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `educational_qualification` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `educational_details` text COLLATE utf8mb4_unicode_ci,
  `training` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_educational_trainings`
--

INSERT INTO `employee_educational_trainings` (`id`, `employee_id`, `educational_qualification`, `educational_details`, `training`, `experience`, `created_at`, `updated_at`) VALUES
(1, 1, 'Master\'s', 'Accusantium rerum quia enim.', 'Perspiciatis ut ratione voluptas qui voluptates aut.', 'Dolorum odio et sunt molestiae quia.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(2, 2, 'PhD', 'Quas sequi praesentium nulla possimus libero quod sit repudiandae.', 'Ut et odit est provident et.', 'Expedita inventore vero numquam ipsa unde quo neque.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(3, 3, 'Master\'s', 'Et odio voluptates provident amet omnis adipisci ut.', 'Esse quasi veritatis quo dolorum nihil similique.', 'Reprehenderit cum quo quam quo quod sed.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(4, 4, 'PhD', 'Nihil enim consequatur qui ut qui impedit et.', 'Quia maiores deleniti nulla est pariatur provident.', 'Architecto est quas quis veritatis magnam.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(5, 5, 'Bachelor\'s', 'Nemo animi repellendus laboriosam nobis saepe tenetur incidunt.', 'Officia assumenda voluptas rerum consequatur totam quia.', 'Dolore distinctio delectus ea dolores.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(6, 6, 'Master\'s', 'Repellat voluptas laudantium ad placeat eum deserunt repudiandae.', 'Nesciunt consequuntur voluptate rerum hic.', 'Quo enim voluptatem sed fugiat cum porro.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(7, 7, 'Bachelor\'s', 'Libero perferendis fuga aliquid repudiandae aperiam aliquam eum ut.', 'Iste porro laborum id.', 'Et facilis cumque non repellat est et.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(8, 8, 'Master\'s', 'Id soluta eum et facere ratione maxime eligendi maiores.', 'Atque tenetur aut delectus.', 'Beatae nemo hic sapiente aut.', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(9, 9, 'PhD', 'Voluptates illo ea consequatur quo omnis rerum quod.', 'Architecto et repellat deleniti voluptatum beatae.', 'Excepturi occaecati sed velit eum nihil.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(10, 10, 'Bachelor\'s', 'Pariatur porro asperiores labore molestiae sed asperiores et in.', 'Id quas est sint.', 'Eum ab voluptatibus ab illo sed asperiores quas.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(11, 11, 'Bachelor\'s', 'Ut aut debitis totam non.', 'Officia sed numquam et et neque.', 'Et non accusantium exercitationem amet voluptatum aut sed.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(12, 12, 'Bachelor\'s', 'Nihil nobis est consequatur sed cum sunt.', 'Vel qui non eaque omnis ut et qui neque.', 'At est est reiciendis consequatur.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(13, 13, 'PhD', 'Ratione totam omnis necessitatibus aliquid quia.', 'Soluta dolorem perspiciatis et enim.', 'In est et soluta modi cupiditate.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(14, 14, 'Bachelor\'s', 'Aut ad et officiis sit quis deserunt cum.', 'Adipisci ut quia veniam vel voluptas fugit.', 'Quo alias doloribus repudiandae aliquam deserunt itaque rerum.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(15, 15, 'Bachelor\'s', 'Sunt earum non sint fugit voluptate.', 'Distinctio repellendus explicabo sit et voluptas quam quo aut.', 'Unde quam voluptatem iusto dicta.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(16, 16, 'Bachelor\'s', 'Quia nulla velit omnis sequi quibusdam.', 'Ipsam dolores temporibus esse omnis.', 'Vitae dolorum quos saepe sint asperiores velit.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(17, 17, 'Bachelor\'s', 'Corporis quia tempore maxime inventore quos alias.', 'Quia qui eum ut et ipsam est.', 'Itaque voluptatem nemo repudiandae rerum.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(18, 18, 'Bachelor\'s', 'Sit eligendi et sed et occaecati facilis.', 'Quis suscipit facere est culpa.', 'Enim id numquam quis nisi officiis.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(19, 19, 'PhD', 'Officia sunt autem error.', 'Eveniet voluptas et consequuntur corrupti dolorem aliquid tempore.', 'Dolores magni exercitationem facilis.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(20, 20, 'PhD', 'Dolore quaerat dolorem odit odit ut.', 'Aut corporis sed et pariatur alias.', 'Similique rerum voluptas rerum adipisci sit neque aut dolores.', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(21, 21, 'Master\'s', 'Qui aut excepturi aut magni sed accusantium distinctio.', 'Expedita itaque non ipsum mollitia rem inventore doloremque ut.', 'Quo voluptatibus provident quasi totam.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(22, 22, 'PhD', 'Est velit aperiam ut fuga.', 'Et perferendis rerum expedita molestiae excepturi.', 'Maxime consequatur quae et sint.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(23, 23, 'Master\'s', 'At nulla quia doloribus inventore autem at a.', 'Maiores dolor voluptates necessitatibus facere possimus consequatur.', 'Minima pariatur voluptas deleniti.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(24, 24, 'Master\'s', 'Numquam qui dolorem quod in rerum.', 'Quam facere ipsa quis quos sit adipisci.', 'Dolor non tempore asperiores expedita aliquid.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(25, 25, 'Master\'s', 'Aut enim eos unde.', 'Natus esse animi cumque veniam dolorem facilis.', 'Vitae quis voluptas perspiciatis expedita et in.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(26, 26, 'Bachelor\'s', 'Eveniet temporibus unde animi dolore.', 'Dolor omnis dolores id necessitatibus illum dolores et.', 'Est est quam sed.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(27, 27, 'Bachelor\'s', 'Quis repudiandae illum eum dolore pariatur non expedita quis.', 'Hic laborum unde qui.', 'Nostrum qui eum in.', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(28, 28, 'Master\'s', 'Animi qui aut et.', 'Repellendus voluptas voluptatem repellendus possimus explicabo ipsum quo.', 'Illo facere fuga delectus laudantium natus et repudiandae.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(29, 29, 'Master\'s', 'At sit consequatur velit voluptatum impedit.', 'Est esse voluptatem est omnis consequatur.', 'Omnis autem qui sequi ut est numquam nihil.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(30, 30, 'Master\'s', 'Molestiae ab explicabo dolorem ducimus eius magni voluptatem modi.', 'Eos vel quo ut esse dolor itaque.', 'Est asperiores sed et voluptas ut optio tenetur.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(31, 31, 'PhD', 'Alias deleniti eos necessitatibus est sed.', 'Voluptates illum exercitationem consectetur.', 'Est laboriosam eveniet animi necessitatibus corrupti.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(32, 32, 'Bachelor\'s', 'Commodi possimus repellat unde in pariatur.', 'Amet a labore qui praesentium tempora velit omnis.', 'Reiciendis ab cum aut facilis veritatis quo doloribus possimus.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(33, 33, 'Bachelor\'s', 'Eveniet sint commodi non.', 'Voluptate at porro assumenda natus non rem neque.', 'Sint aut porro aliquid incidunt quasi corrupti laudantium.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(34, 34, 'Master\'s', 'Nihil nisi assumenda nihil suscipit quasi aut.', 'Aut et quibusdam placeat qui fuga laboriosam et.', 'Qui saepe nemo aut qui vitae.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(35, 35, 'Master\'s', 'Quasi reprehenderit ullam et repellat sint.', 'Facere est fugiat consequatur.', 'Aut quia possimus dolor.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(36, 36, 'Master\'s', 'Ut nihil error minus perspiciatis.', 'Et dolores necessitatibus voluptatem ipsam quas vel.', 'At repellendus itaque debitis quia non saepe quis iusto.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(37, 37, 'Master\'s', 'Saepe fugiat facere veritatis ratione et sapiente est.', 'Consequatur sed ullam consequatur quo quis odit dolorem reiciendis.', 'Unde maxime illum sed non omnis tenetur vitae.', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(38, 38, 'PhD', 'Aut laudantium sit perferendis sint illum.', 'Vero sunt magni ducimus quia atque excepturi nemo.', 'Nam quos dolorem aut architecto.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(39, 39, 'Master\'s', 'Dolores provident quod deserunt voluptatem.', 'Ut quo possimus reiciendis vel.', 'Alias nemo ipsam consequatur illum qui eos rerum aliquam.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(40, 40, 'PhD', 'Fuga velit necessitatibus odit ea sed.', 'Nisi amet qui ut culpa.', 'Sapiente repellendus cum quia nulla a est tempore.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(41, 41, 'PhD', 'Deserunt fugiat modi voluptatem placeat laudantium id.', 'Voluptatum delectus officia consectetur omnis iste.', 'Est vitae architecto distinctio quam est.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(42, 42, 'PhD', 'Possimus provident voluptates aut nostrum omnis a expedita voluptatem.', 'Omnis hic commodi consequatur molestiae natus.', 'Perferendis soluta aut dolorem voluptas.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(43, 43, 'Master\'s', 'Dolores praesentium provident et delectus ipsam itaque.', 'Enim pariatur est iste iure voluptatibus omnis aut possimus.', 'Voluptas facilis et et veniam ullam.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(44, 44, 'Master\'s', 'Dolorem eum exercitationem perspiciatis saepe deleniti nesciunt laboriosam.', 'Nihil quo ut est necessitatibus pariatur animi esse.', 'Ratione modi sequi non quo eum sapiente.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(45, 45, 'Master\'s', 'Sit ea at repellendus officiis.', 'Sint est explicabo quia tenetur.', 'Itaque ducimus impedit nostrum adipisci non magni praesentium odio.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(46, 46, 'Bachelor\'s', 'Deleniti recusandae qui vel tenetur qui rem.', 'Et voluptatum voluptatem earum sit ducimus rerum.', 'Vero autem ipsum natus voluptatum quisquam sed.', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(47, 47, 'PhD', 'Sequi nulla maiores ut rerum voluptate ut sit repudiandae.', 'Saepe nulla qui consequatur earum provident est soluta.', 'Odio ad dolores cupiditate in doloribus.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(48, 48, 'PhD', 'Voluptate iusto at et blanditiis doloremque nostrum facilis.', 'Consequuntur eveniet enim doloribus aliquid laborum.', 'Soluta ut sint consequatur dolorem delectus.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(49, 49, 'Bachelor\'s', 'Repellat blanditiis aperiam modi dolores adipisci.', 'Odit tempore occaecati sed culpa culpa eaque in.', 'Et dolorum quis pariatur amet nihil ipsa omnis hic.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(50, 50, 'Master\'s', 'Velit quis iste aut iusto.', 'Velit aut repudiandae reprehenderit eveniet.', 'Adipisci amet qui similique doloribus omnis aut molestiae.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(51, 51, 'Master\'s', 'Non est est repudiandae quo.', 'Eos hic eaque adipisci saepe.', 'Harum dolores consequatur aut architecto id.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(52, 52, 'PhD', 'Eos reiciendis dolores error perferendis rem reprehenderit.', 'Nihil ipsum facilis fuga voluptatem labore.', 'Quis adipisci maiores vel incidunt aut.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(53, 53, 'Master\'s', 'Est sed quos iusto quisquam dolore.', 'Minus id sit eaque suscipit fuga.', 'Eos aperiam commodi officia distinctio mollitia dicta.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(54, 54, 'Master\'s', 'Aperiam voluptas quia ratione a non repellat quis.', 'Dicta nemo eos aut et eius quas.', 'Ducimus dolore dolorum sint et architecto nam.', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(55, 55, 'PhD', 'Ut corrupti modi ut ut est minima nisi.', 'Et repellendus possimus veniam vel porro.', 'Optio dolor doloremque molestiae alias perspiciatis ipsa eveniet.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(56, 56, 'Master\'s', 'Alias explicabo quam velit aut dolor voluptatum.', 'Natus ad dolorem consequatur modi impedit beatae sint eius.', 'Exercitationem cupiditate qui iste recusandae similique eaque molestiae non.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(57, 57, 'PhD', 'Consequatur est rerum quos quibusdam.', 'Illum quasi aut beatae accusamus iusto nostrum.', 'Dolore doloremque est enim enim dicta earum mollitia.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(58, 58, 'PhD', 'Quo magnam quasi velit rerum non.', 'Nulla doloremque sed iusto mollitia veniam debitis.', 'Et illo corrupti amet et saepe facere fugiat.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(59, 59, 'Master\'s', 'Quis et sed tempora sint.', 'Consequuntur voluptatum ducimus assumenda repellendus perferendis.', 'Nihil eligendi sed quidem corrupti sint corporis.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(60, 60, 'Master\'s', 'Nam aut sit illum et facilis pariatur.', 'Est similique sapiente ut cumque ut occaecati.', 'Quaerat ratione fuga sapiente voluptas voluptate cupiditate velit laborum.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(61, 61, 'Bachelor\'s', 'Tempore ut minima perspiciatis et consequatur.', 'Est est optio perspiciatis modi eaque animi.', 'Porro doloribus consectetur modi est culpa ipsam.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(62, 62, 'PhD', 'Dolor deserunt saepe non dolor perspiciatis assumenda laborum.', 'Eligendi autem unde rem.', 'Corrupti quos velit autem non enim odio.', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(63, 63, 'PhD', 'Ut dolorum sit quas saepe cumque voluptate sit.', 'Omnis dignissimos excepturi doloribus iste.', 'Nihil culpa doloremque consequatur architecto.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(64, 64, 'PhD', 'Est neque voluptate autem cumque fugit.', 'Sed sed iste eveniet.', 'Ea ut cumque a.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(65, 65, 'PhD', 'Sed ut eos eos enim illum.', 'Nihil dolores doloremque aut deleniti quo dolorem est odio.', 'Nemo autem sunt tempora ducimus officiis hic consectetur.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(66, 66, 'PhD', 'Harum amet beatae inventore architecto nisi ipsa sit fugit.', 'Dolores ut possimus distinctio omnis facere reiciendis perspiciatis qui.', 'Et facilis cumque qui omnis iusto velit.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(67, 67, 'Bachelor\'s', 'Dolorum ducimus qui delectus atque ut dolore et.', 'Animi eius ut nam.', 'Harum deleniti placeat aliquam ullam.', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(68, 68, 'Bachelor\'s', 'Quisquam animi repellat et illo quidem ut sint.', 'Explicabo voluptatem veritatis sequi rerum porro et quas.', 'Modi non quod nam iste praesentium et.', '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(69, 69, 'PhD', 'Repellat vitae commodi facilis.', 'Alias sed ex molestiae quidem ipsum ipsum ut dolores.', 'Laudantium tempore et et et tempore.', '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(70, 70, 'PhD', 'Maxime sit vitae pariatur nihil quo.', 'Ea enim ducimus animi fugiat voluptate dolore.', 'Modi eius numquam rerum sit.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(71, 71, 'Bachelor\'s', 'Soluta odit cumque ea cupiditate id omnis neque.', 'Aut quo repudiandae accusamus quod ipsa fugiat et.', 'Omnis excepturi magni deserunt.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(72, 72, 'PhD', 'Laboriosam minus dolor rerum autem illo sint consectetur.', 'Deleniti odit voluptatem aspernatur nihil id quis.', 'Vero dolor et et quidem voluptatem nulla.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(73, 73, 'Master\'s', 'Qui velit consequatur inventore dicta.', 'Vitae eveniet quidem soluta aut unde qui architecto.', 'Aperiam maiores autem voluptas repellendus.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(74, 74, 'Bachelor\'s', 'Ex necessitatibus molestiae officia dolores.', 'Temporibus doloribus amet tenetur eveniet qui mollitia qui.', 'Ipsa ipsam rerum voluptatibus id cum tenetur nesciunt.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(75, 75, 'Master\'s', 'Repellat qui iure veritatis eos.', 'Eius alias id dolor qui.', 'Qui tempora quis culpa sunt incidunt.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(76, 76, 'PhD', 'Omnis dolor sapiente libero enim corporis aliquid dolor.', 'Libero deleniti rerum placeat odit.', 'Repellat est rerum est ullam molestiae.', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(77, 77, 'Master\'s', 'Quia et nulla soluta illum laboriosam quibusdam aut.', 'Porro vitae quia voluptatem eum.', 'Ipsum et cum iste quia.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(78, 78, 'Bachelor\'s', 'Et fuga perferendis quae deleniti et.', 'Nobis eius repellendus quis omnis reprehenderit hic voluptates unde.', 'Consequatur labore nostrum dolorum esse alias perferendis rem quas.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(79, 79, 'Master\'s', 'Est quaerat eius tempore error reiciendis excepturi.', 'Enim maxime qui qui ullam repudiandae omnis quis.', 'Molestias atque doloribus labore qui consectetur est.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(80, 80, 'Bachelor\'s', 'Ipsa consequuntur id minima et quidem ipsum.', 'Quae ea reprehenderit porro necessitatibus voluptate non.', 'Vel ducimus sed voluptatem ratione rem.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(81, 81, 'Master\'s', 'At consequatur quasi corrupti similique natus rerum est.', 'Facere nulla provident ut quasi.', 'Sunt et officiis asperiores ut cum maxime fugiat.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(82, 82, 'PhD', 'Placeat rerum voluptas earum debitis qui inventore sit consequatur.', 'Et ducimus debitis vel maiores consequatur.', 'Quos sapiente consectetur deserunt fugit.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(83, 83, 'Bachelor\'s', 'Sequi aspernatur eius est porro.', 'Magnam non ullam voluptates saepe ullam.', 'Et commodi nostrum et molestiae eius.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(84, 84, 'Bachelor\'s', 'Qui harum et impedit necessitatibus.', 'Expedita eum consectetur dolor sequi.', 'Labore a nostrum rerum cupiditate officia.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(85, 85, 'PhD', 'Aut qui velit quia aut fugit perferendis expedita.', 'Doloremque vel eius quibusdam consequuntur.', 'Consequatur consequatur reiciendis earum est.', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(86, 86, 'PhD', 'Quia numquam necessitatibus id ipsa temporibus.', 'Minima possimus cupiditate explicabo nisi expedita accusantium dolorum.', 'Voluptas et omnis aut quisquam in.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(87, 87, 'Bachelor\'s', 'Nobis modi facilis eum labore accusamus occaecati ea.', 'Adipisci ut sit placeat.', 'Dolore eveniet saepe repellat odit voluptatem vel quia.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(88, 88, 'PhD', 'Dolorem dolores sit optio quo.', 'Vero voluptatem ipsum ut tempora.', 'Magnam sint non corporis.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(89, 89, 'PhD', 'Eos sapiente veniam quo ullam.', 'Quam eum sed animi eos rem ut nihil.', 'Deserunt iste laborum sit aliquid impedit.', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(90, 90, 'Master\'s', 'Alias totam sed quidem et.', 'Porro autem sit esse provident.', 'Cumque occaecati cupiditate rerum.', '2023-12-20 18:51:03', '2023-12-20 18:51:03'),
(91, 91, 'Bachelor\'s', 'Corporis omnis enim omnis exercitationem aliquam est iusto.', 'Quaerat natus qui quos odit libero.', 'Accusamus recusandae ut numquam ut dicta pariatur.', '2023-12-20 18:51:07', '2023-12-20 18:51:07'),
(92, 92, 'Master\'s', 'Aut necessitatibus laborum molestiae ea quasi commodi.', 'Fuga repudiandae iste qui ea recusandae.', 'Nisi voluptatibus fugiat beatae aliquid dolorem.', '2023-12-20 18:51:08', '2023-12-20 18:51:08'),
(93, 93, 'Bachelor\'s', 'Est temporibus eos culpa perferendis et maiores.', 'Qui ullam nihil quod sunt esse id aut eveniet.', 'Vel aut voluptatum quo aliquam modi.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(94, 94, 'PhD', 'Qui nesciunt ab unde exercitationem ex.', 'Possimus voluptas ullam doloremque asperiores sit.', 'Sit possimus reiciendis corrupti ut.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(95, 95, 'PhD', 'Odio voluptatem et at molestiae rem sed.', 'In ut quis error velit ex.', 'Rerum sapiente aspernatur molestiae quae ut vel reiciendis.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(96, 96, 'PhD', 'Ut atque voluptatem tempore voluptas quod saepe quam nihil.', 'Aspernatur rerum aspernatur vel sed magnam vel.', 'Eveniet alias qui eveniet itaque.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(97, 97, 'Bachelor\'s', 'Consequatur quibusdam laborum voluptatem quos nihil.', 'Ipsa culpa nostrum sit sit laboriosam et.', 'Molestiae ut beatae corporis dolores perferendis adipisci rerum alias.', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(98, 98, 'Bachelor\'s', 'Magni aspernatur suscipit cupiditate ipsam.', 'Consequatur eveniet laborum labore quod placeat explicabo.', 'Et ut non cumque sit distinctio.', '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(99, 99, 'PhD', 'Laborum cumque aperiam quae pariatur natus.', 'Necessitatibus voluptas et neque quod facere.', 'Vero sit sed id aperiam qui.', '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(100, 100, 'PhD', 'Corporis accusantium error ut qui dicta dolor aliquam.', 'Ullam saepe non natus deserunt voluptatum minima vel.', 'Itaque quos molestiae quibusdam voluptatem officiis.', '2023-12-20 18:51:10', '2023-12-20 18:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_personal_information`
--

CREATE TABLE `employee_personal_information` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `fathers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mothers_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `spouse_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permanent_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emergency_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_personal_information`
--

INSERT INTO `employee_personal_information` (`id`, `employee_id`, `fathers_name`, `mothers_name`, `spouse_name`, `date_of_birth`, `nid`, `blood_group`, `permanent_address`, `emergency_contact`, `created_at`, `updated_at`) VALUES
(1, 1, 'Celine Turner', 'Eunice Kerluke', 'Mr. Alf Stokes', '1985-01-13', '425868559', 'B-', '64312 Milford View Suite 019\nSatterfieldville, CT 44455-5492', '1-304-545-1405', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(2, 2, 'Mr. Caleb Bayer III', 'Icie Rempel', 'Dr. Hanna O\'Reilly', '2021-04-15', '378456938', 'A+', '643 Berge Square\nJosefinamouth, IA 79056', '+1-912-733-5056', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(3, 3, 'Marshall Daugherty I', 'Margarita Hamill', 'Prof. Georgiana Bahringer MD', '1991-12-25', '78255325', 'A-', '560 Cloyd Squares\nKuhntown, NY 91664', '267.922.8747', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(4, 4, 'Wendell Keeling I', 'Devin Jerde', 'Queen Grady', '1979-12-03', '155112515', 'AB-', '92882 Watsica Plaza\nSouth Jadon, HI 47317', '(220) 598-0573', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(5, 5, 'Laurianne Swaniawski', 'Mr. Carmelo Mueller DVM', 'Miss Lindsay Kiehn', '1992-07-25', '286061210', 'B+', '632 Joanne Locks\nNew Lylafort, SD 53514', '1-949-579-0605', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(6, 6, 'Hermina Rosenbaum Sr.', 'Dr. Melyna Kerluke PhD', 'Ottis Marquardt', '2003-06-11', '879397877', 'B+', '242 Gerhold Parkways\nMacejkovicborough, PA 51002', '+1.808.654.4533', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(7, 7, 'Megane Gorczany V', 'Mr. Colten Schumm', 'Frida Waelchi', '2021-07-06', '661489610', 'AB+', '51474 Lang Flat\nSouth Kolby, HI 75160', '414-673-8246', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(8, 8, 'Prof. Davion Cormier MD', 'Ms. Margarete Jacobs', 'Dr. Jarrod Rutherford DVM', '1993-09-06', '794176044', 'O-', '64279 DuBuque Dale\nZulaufland, WY 82656-6671', '(623) 621-1455', '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(9, 9, 'Ms. Eve Kutch', 'Prof. Savanna Huels MD', 'Prof. Ethan Pfeffer', '1983-04-03', '836356588', 'B+', '5073 Francisca Garden\nEast Mabelton, HI 93775', '+1.586.438.9399', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(10, 10, 'Mr. Abdul Donnelly I', 'Yazmin Sporer', 'Brooks Klein', '2022-07-07', '334556971', 'A+', '6428 Stroman Corners\nWest Asiamouth, IL 20076', '+1.916.665.0584', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(11, 11, 'Leif O\'Reilly', 'Horace Swift', 'Emery Greenfelder', '2023-04-26', '372710793', 'O+', '976 Turner Trace Apt. 636\nFlaviofurt, IN 47361', '571.885.4806', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(12, 12, 'Dr. Bryon Stehr Sr.', 'Prof. Theo Kunde III', 'Elmo Durgan', '1985-01-02', '113918895', 'AB-', '912 Kuvalis Stravenue Apt. 867\nNew Lianahaven, NM 05785', '1-972-410-1925', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(13, 13, 'Mrs. Yasmin Goldner PhD', 'Lizeth Donnelly', 'Amparo Denesik', '1990-11-24', '795842325', 'O-', '35403 Stokes Divide\nPort Marcelinoton, FL 41589-9090', '+1.707.267.6936', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(14, 14, 'Zora Schimmel', 'Pattie Orn', 'Jerrod Heller I', '1976-08-11', '467025552', 'B+', '823 Rutherford Drive\nLake Monserratville, WA 39189', '(539) 399-3632', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(15, 15, 'Blake Howell', 'Prof. Ulices Sporer III', 'Yadira Haley DVM', '2011-11-13', '333527824', 'A-', '187 Dominique Canyon\nWest Venaborough, FL 94509', '804.695.0953', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(16, 16, 'Mrs. Eldora Zulauf DDS', 'Terrence Gibson', 'Melany Weissnat', '2013-09-07', '981607049', 'A-', '685 Lizzie Place\nLudwigshire, OH 12255', '+1-430-215-8136', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(17, 17, 'Dr. Lyla Schamberger', 'Rebecca Wolf', 'Prof. Anjali Schmitt II', '1985-08-07', '907366032', 'AB+', '634 Greenfelder Ford Apt. 245\nMaritzaborough, WI 65919-5089', '1-410-339-5563', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(18, 18, 'Mozelle Hermiston', 'Abbie Effertz', 'Polly Willms V', '2000-08-03', '292348086', 'A-', '1588 Cummerata Square Apt. 238\nCummingsmouth, KY 99095-9021', '+1 (606) 712-8754', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(19, 19, 'Carlee Steuber', 'Dr. Ibrahim Reichel PhD', 'Uriel Williamson', '1999-10-18', '381288562', 'B-', '5470 Dickinson Islands\nEast Avahaven, NE 57612', '(848) 435-9304', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(20, 20, 'Martine Funk', 'Mr. Orlando Rutherford DVM', 'Mrs. Aniya Grant DVM', '1995-09-27', '15227511', 'O-', '376 Eichmann Street\nNew Justiceberg, UT 96747', '+12725003736', '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(21, 21, 'Nick Raynor', 'Mr. Cristobal Kirlin Sr.', 'Zaria Funk', '1981-05-28', '359824954', 'B-', '963 Mario Union Apt. 202\nEast Pamela, TN 42931-6899', '646-812-5156', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(22, 22, 'Richmond Ebert', 'Karley Treutel', 'Dr. Dannie Wolff', '1996-03-26', '185082170', 'AB+', '3485 Mante Port\nNorth Andreane, MD 70403', '+1.551.368.2403', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(23, 23, 'Sibyl Halvorson', 'Vito Swaniawski V', 'Josiah Quigley', '2021-12-17', '149323101', 'O-', '8550 Michaela Spring Apt. 637\nTimmyfort, NM 64498', '1-820-751-7441', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(24, 24, 'Miss Catherine Reilly', 'Carmine Buckridge', 'Ford Morissette', '1979-06-06', '22769213', 'O+', '72271 Stamm Mountains\nBednarport, WA 97640-4232', '309-420-2547', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(25, 25, 'Roslyn Nikolaus I', 'Eliseo Cummerata', 'Armani Nader', '2001-05-29', '777220904', 'B+', '82373 Jonatan Mills\nWest Edenshire, NY 53179-6527', '+1.281.312.8483', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(26, 26, 'Sister McDermott', 'Mr. Bernardo Conn', 'Gregg Eichmann', '1973-08-27', '188977369', 'B-', '2160 Waelchi Lodge\nLake Chynaburgh, NH 55579-4710', '+1 (585) 816-0530', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(27, 27, 'Domenica Balistreri', 'Earnest Kilback', 'Mustafa Lehner', '2007-03-04', '767315890', 'A+', '68999 Rice Pass Apt. 250\nAlyciaville, WV 13375', '(757) 245-6946', '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(28, 28, 'Blaise Thiel', 'Hermann Daniel', 'Prof. Lester Weber', '1981-06-26', '600762055', 'O+', '704 Konopelski Ridges Suite 997\nLorenzoville, DC 05956', '(954) 965-3768', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(29, 29, 'Mrs. Rafaela Ritchie I', 'Robin Haag', 'Nona Wisozk V', '1991-09-17', '676562646', 'B-', '282 Kris Fords Suite 709\nReichertview, ND 62448-4063', '1-360-392-9925', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(30, 30, 'Anderson Thompson', 'Jordan Cummings V', 'Chandler Hills', '1970-06-27', '781528268', 'O-', '7368 Emmerich Shoals Suite 580\nPort Cleveland, NC 04029', '520.361.9868', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(31, 31, 'Prof. Clement Skiles', 'Lesley Nitzsche', 'Rory Effertz', '2020-05-24', '450290151', 'AB-', '67570 Parker Valleys\nVivianeton, KY 99927-8565', '+1-512-754-0765', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(32, 32, 'Marjolaine Jakubowski PhD', 'Golden Keebler', 'Hulda Dicki', '1981-09-04', '678727175', 'O+', '5009 Boyer Parkway Suite 268\nLake Hillaryfurt, NY 92888', '+1-346-814-4584', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(33, 33, 'Selmer Littel', 'Mr. Major Pacocha DVM', 'Lucie Russel', '1988-12-24', '996180065', 'B+', '9969 Nikki Crest\nNew Carlieborough, MD 41218', '+1.539.415.0942', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(34, 34, 'Douglas Predovic', 'Cyrus Leuschke', 'Dr. Lindsay Tillman', '1978-12-21', '753218988', 'AB+', '5997 Stacey Centers\nNorth Jonas, IA 61720', '+13215861225', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(35, 35, 'Ima Hartmann', 'Dr. Keegan Denesik MD', 'Dr. Crawford Satterfield', '2000-12-18', '951712736', 'B+', '9236 Ledner Estate Apt. 629\nLake Spencerville, WA 51374', '+1.828.275.4059', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(36, 36, 'Aurelie Johns', 'Kyla Lockman', 'Prof. Shyann Gerhold IV', '2014-10-26', '647822498', 'AB-', '1710 Lexi Wall Apt. 529\nGerhardton, CA 82692', '+1 (206) 836-9428', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(37, 37, 'Esmeralda Mayert', 'Flossie Skiles Jr.', 'Keaton Keebler V', '1970-03-18', '184417167', 'A-', '6513 Fadel Way\nNew Devinborough, MT 55185', '+1.612.736.0824', '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(38, 38, 'Miracle Jacobson Jr.', 'Mrs. Christelle Bauch IV', 'Kiara Gorczany', '2006-03-03', '849330190', 'B-', '716 Orrin Island Apt. 509\nLawrenceland, MO 23219-4380', '+1 (352) 753-7794', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(39, 39, 'Rafaela Beer', 'Raheem Satterfield', 'Chad Raynor', '1972-04-12', '864453400', 'O+', '3239 Quigley Plain Apt. 713\nEast Elody, MN 74611-2389', '+1-850-632-8693', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(40, 40, 'Giovanni Anderson V', 'Aracely Gerhold', 'Hailie Boyer', '1978-12-01', '689361470', 'A-', '403 Louvenia Courts\nWest Abby, DC 04246-1540', '+1-423-789-0578', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(41, 41, 'Mr. Adolfo Emmerich', 'Gussie Medhurst', 'Ezequiel Schinner', '1984-04-07', '827291700', 'O+', '7433 Minnie Locks\nPort Johnson, CO 96357', '+1-253-992-3640', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(42, 42, 'Nestor Tillman II', 'Prof. Albina Satterfield', 'Leila Dibbert', '1971-04-30', '421868943', 'O+', '81001 Providenci Lodge\nJaylinmouth, WA 62750-1777', '386.418.2098', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(43, 43, 'Abigail Nikolaus', 'Prof. Marcos Davis', 'Madaline Kohler', '1975-11-19', '322813382', 'B-', '174 Prohaska Isle\nNew Aracelistad, CT 32702-3622', '+14342853351', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(44, 44, 'Andy Graham', 'Lacey Becker', 'Francisca Schiller PhD', '1980-09-20', '817695712', 'AB+', '11468 Stark Terrace Apt. 487\nSchillershire, MA 62107-3135', '+1.689.241.3807', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(45, 45, 'Dr. Meta Nader', 'Eleazar Jacobs', 'Miracle Lakin PhD', '1987-03-03', '48957335', 'A-', '63811 Torphy Pass Apt. 753\nWest Bobby, AZ 10223-8444', '+1-681-812-8409', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(46, 46, 'Prof. Toy Steuber II', 'Jaquan Wolf', 'Dr. Carlos Jacobs', '2017-03-07', '365493984', 'O-', '8570 Kub Bypass Apt. 579\nEast Chadrick, AL 33075', '(610) 396-4003', '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(47, 47, 'Dr. Janie Robel', 'Guillermo Jones', 'Prof. Keon Koepp', '2007-02-28', '865625803', 'O+', '7396 Noah Junctions\nWest Nicholas, MA 86756', '+1-564-892-6445', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(48, 48, 'Prof. Ernie Hansen II', 'Mr. Jamarcus Kohler', 'Karli Skiles', '2021-11-14', '741824940', 'O-', '5568 West Turnpike Apt. 509\nEast Bennettfurt, SC 71059-7717', '+1.212.421.8248', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(49, 49, 'Benton Reynolds', 'Miss Maxie Quitzon', 'Floyd Dicki', '2000-11-01', '546108881', 'B+', '4094 Thompson Points Apt. 518\nNew Citlallihaven, NV 77575-1649', '314.672.0656', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(50, 50, 'Mr. Norval Hill Jr.', 'Dr. Lloyd McClure PhD', 'Ms. Pat Conn', '2014-11-29', '89957676', 'B+', '1677 Maxime Brook Suite 256\nNorth Oceanetown, FL 37227', '+1-516-795-7798', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(51, 51, 'Jabari Stokes', 'Paige Hegmann', 'Mr. Jerry Wisozk PhD', '1972-07-24', '136633532', 'B+', '638 Hoeger Mountain Apt. 982\nSwiftstad, CA 86172-4983', '762.375.4453', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(52, 52, 'Abbey Zulauf', 'Claudia Ziemann', 'Dr. Nelle Robel Sr.', '1997-03-26', '726205002', 'AB-', '15884 Renee Forks Apt. 337\nLake Casimer, NC 85325', '469-277-5443', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(53, 53, 'Troy Legros', 'Priscilla Spinka MD', 'Katarina Smith Jr.', '2009-11-27', '727173631', 'O+', '64180 Brody Lodge\nNew Antonetteborough, OH 62605-6595', '+16186511141', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(54, 54, 'Joyce Rowe', 'Jovani Altenwerth', 'Zula Brown', '2022-07-21', '461056037', 'AB+', '339 Cummerata Fort Suite 923\nBaileymouth, RI 99130', '432-431-6727', '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(55, 55, 'Dr. Bennett Conn', 'Cody Kuhlman', 'Maynard Wiza', '1988-04-02', '267445265', 'A+', '63245 Shaniya Underpass Apt. 493\nSouth Brigittetown, DC 18062-3453', '+1 (267) 378-5127', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(56, 56, 'Elmo Schowalter', 'Daphney Romaguera', 'Prof. Glenda Hane', '2017-04-29', '474682550', 'B+', '16701 Crona Valley\nNew Antonehaven, AR 25609', '239-332-4052', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(57, 57, 'Zakary Lakin', 'Hans Cruickshank', 'Joan Kessler', '2013-02-21', '601223051', 'O+', '3569 Kattie Valleys\nSengershire, MA 97706-2236', '(630) 639-8599', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(58, 58, 'Ivah Glover', 'Sabina Becker', 'Laurianne Funk', '1970-07-22', '872048490', 'B+', '514 Pascale Passage\nWilhelmchester, DC 81172', '+1-614-281-1944', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(59, 59, 'Mrs. Liliana McDermott', 'Oceane Kunze', 'Kailee Streich Sr.', '1979-04-29', '485408720', 'AB-', '83765 Ramiro Meadow\nPort Neoma, GA 64918-9199', '+1.203.649.9975', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(60, 60, 'Kasandra Howe II', 'Hobart Howe', 'Kira Langworth', '1981-11-08', '826980319', 'A-', '1522 Adelbert Island Suite 127\nCoraland, MD 09712-0687', '+1.765.844.8529', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(61, 61, 'Dr. Margret Pfannerstill', 'Mrs. Mafalda Ferry', 'Andreane Greenholt I', '1987-07-26', '640496401', 'B+', '731 Stehr Groves Suite 170\nNorth Ayden, IL 78749', '1-559-694-3109', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(62, 62, 'Clarissa Lehner', 'Triston Jerde', 'Carmella Adams DVM', '2000-07-24', '589819759', 'O+', '154 Odessa Rest\nLizastad, PA 78799', '669.812.2057', '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(63, 63, 'Oral Friesen Sr.', 'Jazlyn Ryan', 'Freeda Lehner', '1983-08-24', '838298105', 'O-', '585 Lynch Center Apt. 862\nPort Nathen, CO 25648-6891', '(804) 903-9929', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(64, 64, 'Joy Armstrong', 'Mrs. Guadalupe Brekke', 'Mark Emmerich', '1992-04-08', '184906301', 'O+', '48413 Ziemann Place Apt. 561\nLittelhaven, UT 59832', '+1-680-344-3956', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(65, 65, 'Miss Bridgette Feil V', 'Mr. Jerad Kassulke', 'Savanah Jones', '2013-04-30', '568190189', 'B-', '457 Hal Rapid\nLupeville, DC 34669-8930', '+1-651-847-6951', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(66, 66, 'Zelma Heidenreich', 'Amalia Hackett', 'Dr. Buddy Mraz', '1981-03-21', '387598151', 'B-', '603 Hector Viaduct Suite 888\nTamiashire, CT 43051-9304', '1-253-714-9916', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(67, 67, 'Prof. Archibald Bernhard IV', 'Wilhelm Cormier', 'Annalise Bosco', '2008-08-28', '112216127', 'O+', '668 Billie Ferry\nNorth Leta, OK 78919-1806', '+1.531.914.6924', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(68, 68, 'Camryn Heidenreich Sr.', 'Coby Runolfsdottir', 'Nikolas Breitenberg', '1980-11-11', '433063199', 'A+', '8028 Yazmin Inlet\nSanfordton, AK 23978-6841', '413.462.3042', '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(69, 69, 'Gia Lakin', 'Alison Lang', 'Dr. Monroe Gutkowski', '1995-05-17', '533825462', 'A-', '42208 Eleanora Underpass\nSouth Ralphview, MN 02036-7297', '(781) 730-7376', '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(70, 70, 'Oren Considine I', 'Ubaldo Stracke', 'Amparo Collier', '2015-07-01', '211293331', 'A-', '2960 Mann Mill Suite 970\nSteveville, WY 70772', '+1-773-616-2990', '2023-12-20 18:50:59', '2023-12-20 18:50:59'),
(71, 71, 'Myrl Murray I', 'Tyson Ward PhD', 'Lola Lind', '2004-08-16', '758711837', 'A-', '29113 Reinger View Suite 942\nEast Esther, GA 04816-1464', '727.556.0039', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(72, 72, 'Mr. Stewart Glover DDS', 'Tamia Schmeler', 'Prof. Reggie Upton PhD', '2010-12-24', '887650274', 'A+', '85810 Alexandro Fall\nEast Kennedy, NY 25496-4178', '(854) 383-6463', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(73, 73, 'Mr. Johnpaul Marks MD', 'Rodrick Reichert', 'Ms. Kelli Mohr II', '1990-06-29', '372940908', 'B-', '778 Evie Walks\nSouth Erikatown, GA 34164', '+1 (972) 995-2830', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(74, 74, 'Prof. Dessie Tillman DVM', 'Prof. Felipa Lakin IV', 'Audra Goldner', '1979-10-24', '491322311', 'B-', '7597 Wilderman Falls Suite 776\nPort Verda, AZ 73669-8165', '1-848-420-9716', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(75, 75, 'Mckenna West', 'Vicenta Gerlach', 'Ms. Lia Kuhn Jr.', '2016-12-10', '229574994', 'B-', '530 Rodger Canyon\nNew Veronicaport, VT 05427-0538', '(828) 523-4292', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(76, 76, 'Leo Weimann', 'Dr. Xzavier Moen', 'Mafalda Shanahan', '1976-11-24', '250837090', 'B-', '28231 Batz Pine\nSouth Cruzton, LA 74096', '743.550.3983', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(77, 77, 'Charlene Upton DVM', 'Dr. Jaclyn Hyatt MD', 'Layla Funk', '2014-05-24', '959180975', 'O+', '12771 Jalon Gateway\nWest Kevon, UT 20097-5125', '1-979-226-8015', '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(78, 78, 'Margot Feest', 'Prof. Ernesto Effertz', 'Ms. Scarlett VonRueden I', '1982-04-21', '801050810', 'A+', '54310 Rebeca Overpass\nWymanfort, RI 27101-3902', '253-780-4163', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(79, 79, 'Eusebio Yundt', 'Mrs. Jazmyne Wunsch II', 'Clifford Daugherty IV', '1973-12-10', '647062053', 'B+', '4097 Leila Mews\nLake Abbey, NJ 43701-5319', '(743) 263-2641', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(80, 80, 'Morris Beatty', 'Norberto Schamberger', 'Prof. Abel Becker', '2013-10-11', '99805124', 'B-', '3096 Rafael Green Suite 137\nStromanstad, MD 74262', '878.761.4208', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(81, 81, 'Modesta Emmerich', 'Glenda Medhurst', 'Ciara Langworth PhD', '1982-03-14', '413618547', 'O-', '71875 Lucy Forges\nAliviaview, CO 63453', '1-253-278-8107', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(82, 82, 'Ms. Maci Skiles MD', 'Mr. Alvah Gutkowski', 'Madelyn Hagenes', '2012-05-27', '287317905', 'B-', '300 Pfannerstill Mountains Apt. 134\nStantonland, SC 83130-7108', '234.956.9204', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(83, 83, 'Mitchell Boyle', 'Patience Heaney', 'Joy Jakubowski IV', '1980-11-27', '417257023', 'B-', '64570 Jacobs Lodge Suite 286\nPort Dimitrichester, NV 88049', '+1-763-613-3134', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(84, 84, 'Leonel Keebler', 'Mortimer Mante', 'Amelia Simonis', '2010-10-27', '162744184', 'A+', '5527 Alexandre Terrace\nTrantowfort, AK 32487', '(520) 717-1305', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(85, 85, 'Jacquelyn Volkman', 'Marvin Stanton', 'Broderick Mann', '2003-12-27', '950415143', 'A+', '963 Kuhn Park Apt. 337\nWilliamsonchester, KY 89617-7985', '205.623.5128', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(86, 86, 'Ramiro Kulas V', 'Kayli Feeney', 'Aylin McDermott', '1981-03-31', '951890489', 'AB+', '73800 Greenholt Mission\nNorth Jennings, ME 22460-0641', '(973) 484-0088', '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(87, 87, 'Patience Pfannerstill', 'Bonnie Zulauf', 'Mrs. Cassandre Bauch', '2001-06-11', '397499290', 'O+', '5627 Kling Branch\nLake Mckenzieside, DE 96425-4543', '+1-631-850-9571', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(88, 88, 'Myrtis Huel', 'Khalid O\'Hara IV', 'Dr. Yoshiko Weber III', '2022-11-15', '858763151', 'B+', '2499 Breitenberg Dale Suite 594\nLake Lianaside, MN 96094-5329', '+1 (312) 716-8546', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(89, 89, 'Kirsten Donnelly', 'Lorenz Kreiger', 'Yadira Greenholt', '1988-09-01', '923838148', 'B+', '99848 Thiel Ramp\nWest Vito, MO 20011-7751', '+1.731.937.0171', '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(90, 90, 'Richmond Wolff', 'Desmond Nicolas', 'Deangelo Stanton', '2021-02-02', '295583124', 'O+', '8698 Marianna Road Suite 855\nWest Mckenzie, LA 43509', '828.340.0885', '2023-12-20 18:51:03', '2023-12-20 18:51:03'),
(91, 91, 'Tyrel Collier', 'Florencio Renner II', 'Estefania Quitzon', '1987-03-08', '621267346', 'AB+', '4255 Block Shore\nEast Carlosstad, NM 90527', '+1-386-223-2497', '2023-12-20 18:51:07', '2023-12-20 18:51:07'),
(92, 92, 'Esperanza Borer', 'Aurelio Ledner', 'Ava Stark', '2012-08-17', '958660372', 'O-', '799 Matt Trail Suite 567\nEast May, ME 46344-1177', '(661) 963-0281', '2023-12-20 18:51:08', '2023-12-20 18:51:08'),
(93, 93, 'Ms. Matilda Kertzmann PhD', 'Shanel Champlin', 'Prof. Sven Kub', '1981-09-14', '784111127', 'A+', '98056 Amir River Apt. 803\nBoganland, NC 57175', '+1-507-951-8720', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(94, 94, 'Prof. Andre Murazik Jr.', 'Isaias Anderson DDS', 'Mr. Lowell Schumm', '1995-10-25', '115241413', 'AB+', '693 Waelchi Walks\nGusikowskifurt, MD 55799-0988', '+1-816-879-6623', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(95, 95, 'Mr. Kamron Gutkowski', 'Adam Schowalter', 'Prof. Nigel Waelchi DVM', '1982-09-27', '71390785', 'O+', '2269 Tyson Field Apt. 012\nNew Derek, IA 94392', '1-360-976-9167', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(96, 96, 'Lamont Ward', 'Dr. Karson Crooks', 'Prof. Ramona Ziemann', '2021-09-11', '991955936', 'AB-', '449 Langworth Glen\nPort Mia, AR 19063-4813', '865.555.3259', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(97, 97, 'Mr. Judson Bahringer', 'Rupert Denesik Jr.', 'Jamal Breitenberg', '2012-01-22', '721174081', 'AB+', '3995 Stroman Alley\nMolliemouth, NE 90774-5595', '(475) 448-5843', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(98, 98, 'Fiona Champlin', 'Green Gulgowski', 'Kaylie Cartwright', '1970-12-10', '626437893', 'AB-', '5903 Jaskolski Mission Apt. 085\nWest Karleyfort, IN 59422', '361.742.6622', '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(99, 99, 'Elvera Senger III', 'Carrie Leffler I', 'Edmond Dooley', '1987-11-07', '40359109', 'AB+', '2033 Isabell Pine Apt. 857\nEast Mckenna, WV 56312', '1-740-819-7396', '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(100, 100, 'Dr. Braulio Zulauf', 'Samson Dooley', 'Ms. Cassandra Hackett', '2002-10-23', '838387573', 'B-', '43094 Justice View Suite 179\nPort Rickie, WY 43018-8991', '810-726-0321', '2023-12-20 18:51:10', '2023-12-20 18:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salaries`
--

CREATE TABLE `employee_salaries` (
  `id` bigint UNSIGNED NOT NULL,
  `employee_id` bigint UNSIGNED NOT NULL,
  `basic_salary` decimal(8,2) NOT NULL DEFAULT '0.00',
  `house_rent` decimal(8,2) DEFAULT NULL,
  `medical_allowance` decimal(8,2) DEFAULT NULL,
  `child_allowance` decimal(8,2) DEFAULT NULL,
  `communication_allowance` decimal(8,2) DEFAULT NULL,
  `special_allowance` decimal(8,2) DEFAULT NULL,
  `lta` decimal(8,2) DEFAULT NULL,
  `bonus` decimal(8,2) DEFAULT NULL,
  `total_salary` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_salaries`
--

INSERT INTO `employee_salaries` (`id`, `employee_id`, `basic_salary`, `house_rent`, `medical_allowance`, `child_allowance`, `communication_allowance`, `special_allowance`, `lta`, `bonus`, `total_salary`, `created_at`, `updated_at`) VALUES
(1, 1, 7229.00, 1613.00, 120.00, 183.00, 843.00, 3537.00, 565.00, 2437.00, 39550.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(2, 2, 4426.00, 973.00, 209.00, 137.00, 810.00, 4742.00, 929.00, 2195.00, 40455.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(3, 3, 3073.00, 1464.00, 266.00, 171.00, 740.00, 4809.00, 534.00, 1528.00, 38243.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(4, 4, 7169.00, 834.00, 402.00, 118.00, 670.00, 2904.00, 825.00, 3549.00, 34134.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(5, 5, 3972.00, 594.00, 260.00, 195.00, 931.00, 4411.00, 647.00, 1682.00, 48982.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(6, 6, 4600.00, 1955.00, 457.00, 138.00, 833.00, 1013.00, 544.00, 1023.00, 32825.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(7, 7, 3465.00, 1111.00, 337.00, 183.00, 823.00, 1683.00, 793.00, 4094.00, 38444.00, '2023-12-20 18:50:50', '2023-12-20 18:50:50'),
(8, 8, 7926.00, 1245.00, 280.00, 129.00, 896.00, 4707.00, 887.00, 3724.00, 41151.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(9, 9, 3937.00, 1721.00, 119.00, 141.00, 698.00, 1031.00, 521.00, 4521.00, 47080.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(10, 10, 7232.00, 636.00, 448.00, 167.00, 831.00, 3346.00, 803.00, 1523.00, 49034.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(11, 11, 4079.00, 1816.00, 431.00, 172.00, 680.00, 2454.00, 548.00, 4712.00, 34293.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(12, 12, 4565.00, 1718.00, 441.00, 149.00, 582.00, 3516.00, 948.00, 2887.00, 37090.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(13, 13, 4425.00, 1171.00, 447.00, 146.00, 544.00, 2618.00, 556.00, 3959.00, 38983.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(14, 14, 6593.00, 750.00, 322.00, 197.00, 639.00, 2537.00, 996.00, 1091.00, 40629.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(15, 15, 3418.00, 1837.00, 168.00, 200.00, 994.00, 2409.00, 605.00, 1329.00, 31721.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(16, 16, 7998.00, 996.00, 171.00, 169.00, 626.00, 3316.00, 931.00, 1126.00, 46339.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(17, 17, 6099.00, 652.00, 231.00, 187.00, 680.00, 3997.00, 709.00, 1952.00, 37570.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(18, 18, 4838.00, 1106.00, 310.00, 199.00, 571.00, 3985.00, 726.00, 2491.00, 48726.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(19, 19, 5526.00, 1954.00, 431.00, 106.00, 502.00, 1319.00, 768.00, 3429.00, 38553.00, '2023-12-20 18:50:51', '2023-12-20 18:50:51'),
(20, 20, 7811.00, 767.00, 299.00, 149.00, 560.00, 2009.00, 815.00, 1016.00, 32957.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(21, 21, 7744.00, 1841.00, 308.00, 197.00, 823.00, 3470.00, 806.00, 4925.00, 41563.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(22, 22, 3156.00, 1486.00, 488.00, 181.00, 634.00, 3801.00, 796.00, 4015.00, 39821.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(23, 23, 5499.00, 1883.00, 472.00, 192.00, 766.00, 4428.00, 707.00, 4670.00, 32895.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(24, 24, 5858.00, 1797.00, 320.00, 154.00, 576.00, 3665.00, 799.00, 3976.00, 43176.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(25, 25, 3560.00, 1584.00, 348.00, 124.00, 861.00, 4497.00, 621.00, 2966.00, 42207.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(26, 26, 7459.00, 595.00, 455.00, 106.00, 930.00, 3132.00, 670.00, 4180.00, 35958.00, '2023-12-20 18:50:52', '2023-12-20 18:50:52'),
(27, 27, 4700.00, 1782.00, 237.00, 196.00, 986.00, 3663.00, 589.00, 2882.00, 48523.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(28, 28, 3567.00, 1427.00, 458.00, 189.00, 775.00, 2942.00, 607.00, 2406.00, 32516.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(29, 29, 3242.00, 1191.00, 331.00, 128.00, 798.00, 4259.00, 584.00, 3216.00, 42143.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(30, 30, 3760.00, 1790.00, 464.00, 138.00, 706.00, 3730.00, 787.00, 1328.00, 38455.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(31, 31, 4182.00, 1949.00, 174.00, 166.00, 953.00, 4282.00, 912.00, 3273.00, 40479.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(32, 32, 7024.00, 1770.00, 202.00, 163.00, 760.00, 4752.00, 717.00, 2189.00, 46923.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(33, 33, 3063.00, 1057.00, 297.00, 169.00, 570.00, 2244.00, 530.00, 2913.00, 32213.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(34, 34, 3019.00, 1791.00, 254.00, 121.00, 648.00, 2624.00, 603.00, 4100.00, 45020.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(35, 35, 3616.00, 1575.00, 161.00, 114.00, 873.00, 2172.00, 834.00, 1403.00, 44621.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(36, 36, 7877.00, 529.00, 165.00, 157.00, 589.00, 3129.00, 809.00, 2860.00, 48845.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(37, 37, 6008.00, 1660.00, 263.00, 191.00, 978.00, 2171.00, 752.00, 2632.00, 33255.00, '2023-12-20 18:50:53', '2023-12-20 18:50:53'),
(38, 38, 7457.00, 1365.00, 223.00, 163.00, 846.00, 2398.00, 689.00, 1576.00, 36818.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(39, 39, 4759.00, 1755.00, 419.00, 134.00, 579.00, 2151.00, 637.00, 4934.00, 41169.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(40, 40, 7608.00, 692.00, 483.00, 114.00, 827.00, 4061.00, 529.00, 3300.00, 46520.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(41, 41, 4381.00, 667.00, 287.00, 148.00, 541.00, 2171.00, 861.00, 1142.00, 44930.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(42, 42, 7650.00, 774.00, 496.00, 117.00, 893.00, 2029.00, 583.00, 2220.00, 44674.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(43, 43, 4639.00, 1856.00, 102.00, 124.00, 855.00, 3613.00, 769.00, 2909.00, 36380.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(44, 44, 5058.00, 1731.00, 195.00, 144.00, 541.00, 3719.00, 523.00, 4943.00, 47877.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(45, 45, 5600.00, 1005.00, 244.00, 106.00, 891.00, 1910.00, 996.00, 3213.00, 34017.00, '2023-12-20 18:50:54', '2023-12-20 18:50:54'),
(46, 46, 4443.00, 549.00, 380.00, 186.00, 792.00, 1056.00, 869.00, 2150.00, 40320.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(47, 47, 7461.00, 520.00, 376.00, 127.00, 959.00, 3378.00, 708.00, 2119.00, 35252.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(48, 48, 4544.00, 1311.00, 300.00, 136.00, 700.00, 3856.00, 729.00, 4695.00, 41759.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(49, 49, 4830.00, 1097.00, 190.00, 155.00, 903.00, 3471.00, 740.00, 4371.00, 37813.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(50, 50, 7731.00, 672.00, 471.00, 112.00, 759.00, 1126.00, 625.00, 2299.00, 48848.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(51, 51, 5573.00, 915.00, 340.00, 138.00, 676.00, 1333.00, 842.00, 3378.00, 45996.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(52, 52, 4741.00, 1833.00, 240.00, 146.00, 603.00, 3669.00, 545.00, 2886.00, 48907.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(53, 53, 6042.00, 1835.00, 447.00, 116.00, 570.00, 2310.00, 593.00, 4575.00, 34912.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(54, 54, 4632.00, 1441.00, 463.00, 174.00, 761.00, 3575.00, 904.00, 2906.00, 41876.00, '2023-12-20 18:50:55', '2023-12-20 18:50:55'),
(55, 55, 3427.00, 1753.00, 123.00, 149.00, 781.00, 1923.00, 613.00, 4859.00, 39291.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(56, 56, 4909.00, 582.00, 403.00, 140.00, 553.00, 3051.00, 685.00, 1138.00, 46226.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(57, 57, 7059.00, 1079.00, 264.00, 190.00, 856.00, 1612.00, 627.00, 2064.00, 40601.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(58, 58, 6078.00, 1258.00, 499.00, 161.00, 860.00, 3202.00, 587.00, 1569.00, 40601.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(59, 59, 3267.00, 1911.00, 180.00, 124.00, 917.00, 3152.00, 528.00, 1387.00, 46698.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(60, 60, 7496.00, 1190.00, 471.00, 177.00, 664.00, 2202.00, 580.00, 3240.00, 36515.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(61, 61, 3995.00, 1095.00, 446.00, 147.00, 788.00, 2492.00, 750.00, 3694.00, 32348.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(62, 62, 6283.00, 919.00, 284.00, 125.00, 743.00, 1293.00, 590.00, 3488.00, 49412.00, '2023-12-20 18:50:56', '2023-12-20 18:50:56'),
(63, 63, 7026.00, 633.00, 354.00, 185.00, 622.00, 2230.00, 865.00, 1060.00, 42366.00, '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(64, 64, 6515.00, 975.00, 425.00, 114.00, 869.00, 3865.00, 708.00, 3667.00, 30629.00, '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(65, 65, 5149.00, 1031.00, 446.00, 115.00, 567.00, 2795.00, 760.00, 2906.00, 32049.00, '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(66, 66, 6825.00, 1748.00, 325.00, 189.00, 549.00, 4019.00, 623.00, 2129.00, 36838.00, '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(67, 67, 6648.00, 1479.00, 228.00, 132.00, 976.00, 3879.00, 981.00, 3944.00, 32394.00, '2023-12-20 18:50:57', '2023-12-20 18:50:57'),
(68, 68, 6650.00, 1816.00, 285.00, 127.00, 587.00, 3262.00, 687.00, 1092.00, 43861.00, '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(69, 69, 7290.00, 527.00, 279.00, 112.00, 540.00, 1153.00, 573.00, 1927.00, 34600.00, '2023-12-20 18:50:58', '2023-12-20 18:50:58'),
(70, 70, 7534.00, 1882.00, 329.00, 109.00, 558.00, 2230.00, 699.00, 2315.00, 31957.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(71, 71, 3016.00, 1707.00, 456.00, 189.00, 938.00, 2660.00, 533.00, 3358.00, 32635.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(72, 72, 3730.00, 818.00, 392.00, 147.00, 611.00, 4383.00, 735.00, 1948.00, 32846.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(73, 73, 7254.00, 1999.00, 380.00, 102.00, 704.00, 1843.00, 786.00, 4560.00, 40269.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(74, 74, 4106.00, 1324.00, 426.00, 103.00, 766.00, 4229.00, 701.00, 3468.00, 32114.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(75, 75, 7075.00, 526.00, 108.00, 197.00, 584.00, 1025.00, 649.00, 3098.00, 30321.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(76, 76, 7290.00, 1685.00, 267.00, 103.00, 939.00, 2807.00, 901.00, 2447.00, 37899.00, '2023-12-20 18:51:00', '2023-12-20 18:51:00'),
(77, 77, 7060.00, 1299.00, 159.00, 196.00, 706.00, 4911.00, 619.00, 1257.00, 34350.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(78, 78, 5932.00, 1358.00, 426.00, 193.00, 887.00, 1636.00, 822.00, 4458.00, 43664.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(79, 79, 6768.00, 1238.00, 278.00, 104.00, 892.00, 2292.00, 551.00, 4142.00, 35482.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(80, 80, 3107.00, 1574.00, 426.00, 159.00, 668.00, 4958.00, 592.00, 3555.00, 47015.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(81, 81, 6960.00, 1481.00, 277.00, 185.00, 604.00, 3929.00, 951.00, 2970.00, 33469.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(82, 82, 4891.00, 911.00, 338.00, 181.00, 640.00, 4882.00, 783.00, 1261.00, 48518.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(83, 83, 7078.00, 831.00, 278.00, 199.00, 641.00, 2822.00, 540.00, 2201.00, 38875.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(84, 84, 3342.00, 1968.00, 113.00, 139.00, 747.00, 2964.00, 917.00, 2923.00, 32171.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(85, 85, 6523.00, 1865.00, 483.00, 144.00, 501.00, 1671.00, 525.00, 3481.00, 31490.00, '2023-12-20 18:51:01', '2023-12-20 18:51:01'),
(86, 86, 5340.00, 1279.00, 428.00, 187.00, 581.00, 2152.00, 724.00, 4970.00, 37221.00, '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(87, 87, 5790.00, 1274.00, 110.00, 167.00, 709.00, 2166.00, 711.00, 2324.00, 31861.00, '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(88, 88, 4590.00, 1338.00, 250.00, 117.00, 865.00, 2881.00, 533.00, 2124.00, 39935.00, '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(89, 89, 7420.00, 822.00, 319.00, 158.00, 758.00, 2990.00, 547.00, 4041.00, 45994.00, '2023-12-20 18:51:02', '2023-12-20 18:51:02'),
(90, 90, 6216.00, 1977.00, 384.00, 166.00, 883.00, 3883.00, 603.00, 3754.00, 47873.00, '2023-12-20 18:51:05', '2023-12-20 18:51:05'),
(91, 91, 6810.00, 937.00, 482.00, 127.00, 567.00, 1088.00, 993.00, 3410.00, 31326.00, '2023-12-20 18:51:08', '2023-12-20 18:51:08'),
(92, 92, 7898.00, 812.00, 101.00, 125.00, 629.00, 2607.00, 913.00, 2995.00, 41450.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(93, 93, 7425.00, 768.00, 468.00, 131.00, 841.00, 1446.00, 666.00, 4663.00, 39906.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(94, 94, 3729.00, 1996.00, 374.00, 135.00, 999.00, 3963.00, 865.00, 4068.00, 40944.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(95, 95, 3488.00, 1437.00, 397.00, 134.00, 516.00, 2731.00, 694.00, 4647.00, 37108.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(96, 96, 7694.00, 1502.00, 133.00, 146.00, 781.00, 4851.00, 957.00, 4023.00, 40032.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(97, 97, 5369.00, 1711.00, 340.00, 193.00, 645.00, 1210.00, 572.00, 1110.00, 36553.00, '2023-12-20 18:51:09', '2023-12-20 18:51:09'),
(98, 98, 8000.00, 1745.00, 333.00, 120.00, 746.00, 3898.00, 526.00, 3806.00, 47073.00, '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(99, 99, 6266.00, 571.00, 373.00, 100.00, 878.00, 2692.00, 852.00, 2548.00, 34080.00, '2023-12-20 18:51:10', '2023-12-20 18:51:10'),
(100, 100, 5253.00, 1158.00, 294.00, 141.00, 733.00, 4069.00, 566.00, 2046.00, 42312.00, '2023-12-20 18:51:10', '2023-12-20 18:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `count` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `single_dye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `double_dye` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roll` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `finished` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gsm` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `production_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `csp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twist` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unit_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_price_for_salary` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_unit_id` int NOT NULL,
  `sub_unit_id` int DEFAULT NULL,
  `total_sold` int NOT NULL DEFAULT '0',
  `total_purchase` int NOT NULL DEFAULT '0',
  `show_variation` tinyint(1) NOT NULL DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `type`, `name`, `weight`, `count`, `brand`, `single_dye`, `double_dye`, `wash`, `roll`, `finished`, `gsm`, `source`, `cone`, `production_type`, `csp`, `twist`, `image`, `unit_price`, `unit_price_for_salary`, `main_unit_id`, `sub_unit_id`, `total_sold`, `total_purchase`, `show_variation`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Wastase', 'Product', '500 gm', '712.1689247378', 'Richman', 'labore', 'et', 'pariatur', 'voluptatibus', 'id', 'accusantium', 'et', 'molestiae', 'est', 'ipsum', 'fugiat', 'asset/placeholder_190x140c.png', '425', '628', 2, 1, 0, 0, 0, 'Veniam pariatur nostrum natus veniam molestias qui consequuntur.', '2023-12-20 18:50:47', '2023-12-20 18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `item_colors`
--

CREATE TABLE `item_colors` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_colors`
--

INSERT INTO `item_colors` (`id`, `item_id`, `color`, `created_at`, `updated_at`) VALUES
(1, 1, 'Red', '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(2, 1, 'Black', '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(3, 1, 'Blue', '2023-12-20 18:50:47', '2023-12-20 18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `item_sizes`
--

CREATE TABLE `item_sizes` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_sizes`
--

INSERT INTO `item_sizes` (`id`, `item_id`, `size`, `created_at`, `updated_at`) VALUES
(1, 1, 'X', '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(2, 1, 'L', '2023-12-20 18:50:47', '2023-12-20 18:50:47');

-- --------------------------------------------------------

--
-- Table structure for table `item_variations`
--

CREATE TABLE `item_variations` (
  `id` bigint UNSIGNED NOT NULL,
  `item_id` int NOT NULL,
  `item_size_id` int DEFAULT NULL,
  `item_color_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_variations`
--

INSERT INTO `item_variations` (`id`, `item_id`, `item_size_id`, `item_color_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(2, 1, 1, 2, '2023-12-20 18:50:47', '2023-12-20 18:50:47'),
(3, 1, 1, 3, '2023-12-20 18:50:48', '2023-12-20 18:50:48'),
(4, 1, 2, 1, '2023-12-20 18:50:48', '2023-12-20 18:50:48'),
(5, 1, 2, 2, '2023-12-20 18:50:48', '2023-12-20 18:50:48'),
(6, 1, 2, 3, '2023-12-20 18:50:48', '2023-12-20 18:50:48');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_11_08_092415_create_parties_table', 1),
(7, '2023_11_08_095752_create_items_table', 1),
(8, '2023_11_08_123550_create_brands_table', 1),
(9, '2023_11_09_132448_create_purchases_table', 1),
(10, '2023_11_10_145335_create_permission_tables', 1),
(11, '2023_11_13_055153_create_departments_table', 1),
(12, '2023_11_13_055516_create_employees_table', 1),
(13, '2023_11_13_060254_create_employee_personal_information_table', 1),
(14, '2023_11_13_060358_create_employee_educational_trainings_table', 1),
(15, '2023_11_13_060444_create_employee_salaries_table', 1),
(16, '2023_11_15_053432_create_units_table', 1),
(17, '2023_11_15_074047_create_purchase_items_table', 1),
(18, '2023_11_19_135231_create_party_sale_payments_table', 1),
(19, '2023_11_19_175951_create_bank_accounts_table', 1),
(20, '2023_11_19_180238_create_payments_table', 1),
(21, '2023_11_20_130013_create_party_sales_table', 1),
(22, '2023_11_20_131025_create_party_sale_items_table', 1),
(23, '2023_11_21_123321_create_receive_challans_table', 1),
(24, '2023_11_21_123451_create_receive_challan_items_table', 1),
(25, '2023_11_21_141933_create_delivery_challans_table', 1),
(26, '2023_11_21_141945_create_delivery_challan_items_table', 1),
(27, '2023_11_21_150502_create_moving_challans_table', 1),
(28, '2023_11_21_151024_create_moving_challan_items_table', 1),
(29, '2023_11_21_151908_create_branches_table', 1),
(30, '2023_11_21_220544_create_item_colors_table', 1),
(31, '2023_11_21_220602_create_item_sizes_table', 1),
(32, '2023_11_21_220610_create_item_variations_table', 1),
(33, '2023_11_22_131349_create_sales_table', 1),
(34, '2023_11_22_131355_create_sale_items_table', 1),
(35, '2023_12_07_172829_create_sale_returns_table', 1),
(36, '2023_12_07_172913_create_sale_return_items_table', 1),
(37, '2023_12_07_175336_create_party_sale_returns_table', 1),
(38, '2023_12_07_175358_create_party_sale_return_items_table', 1),
(39, '2023_12_10_190231_create_settings_table', 1),
(40, '2023_12_14_153639_create_purchase_returns_table', 1),
(41, '2023_12_14_153650_create_purchase_return_items_table', 1),
(42, '2023_12_19_130704_create_party_sale_commissions_table', 1),
(43, '2023_12_19_144251_create_party_sale_commission_items_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `moving_challans`
--

CREATE TABLE `moving_challans` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `for_sale` tinyint(1) NOT NULL DEFAULT '0',
  `party_id` int DEFAULT NULL,
  `showroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `release_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mode_of_transport` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transport_details` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `payable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `paid` decimal(22,2) NOT NULL DEFAULT '0.00',
  `due` decimal(22,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moving_challan_items`
--

CREATE TABLE `moving_challan_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `moving_challan_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `total_packages` int DEFAULT NULL,
  `packaging_details` text COLLATE utf8mb4_unicode_ci,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parties`
--

CREATE TABLE `parties` (
  `id` bigint UNSIGNED NOT NULL,
  `party_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web_page` text COLLATE utf8mb4_unicode_ci,
  `business_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_bank_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parties`
--

INSERT INTO `parties` (`id`, `party_type`, `party_name`, `company_name`, `owner_name`, `company_address`, `email`, `web_page`, `business_phone`, `home_phone`, `phone`, `country`, `party_bank_details`, `image`, `registration_date`, `note`, `created_at`, `updated_at`) VALUES
(1, 'Sales Party', 'Tiana Little', 'McKenzie-Erdman', 'Barrett Moen V', '32584 Wyman Path\nPort Ardenborough, DE 28678', 'geovanny.mertz@effertz.com', 'http://grady.biz/dignissimos-aut-ducimus-neque-aut-magnam-id-aliquid.html', '(602) 208-3860', '1-513-940-9264', '1-786-573-0332', 'Norway', 'Tempora consectetur saepe ipsam eos laborum tempora numquam. Cumque aut fugit eaque libero reiciendis quae quis. Rerum doloremque architecto cum molestiae.', 'asset/placeholder_190x140c.png', '2017-02-17', 'Omnis perferendis amet quis porro a quos.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(2, 'Sales Party', 'Irwin Lakin', 'Kertzmann, Hartmann and Hermiston', 'Sean Moore I', '113 Williamson Terrace\nNaderville, MD 82593-7474', 'arch54@mckenzie.com', 'http://shanahan.com/earum-eos-consectetur-omnis-ut-error-eum-autem', '1-458-793-0710', '563-963-6731', '870.688.0946', 'Palau', 'Maiores laudantium ut occaecati inventore. Consectetur sed expedita eaque quo occaecati vitae vero. Qui molestiae sit tempore ipsam blanditiis aut a.', 'asset/placeholder_190x140c.png', '1995-06-26', 'Soluta aut incidunt quibusdam.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(3, 'Sales Party', 'Prof. Willard Dibbert I', 'Connelly-Konopelski', 'Prof. Remington Gutkowski DVM', '31191 Mills Gardens Suite 412\nNorth Mabelfort, HI 16463', 'davion33@kutch.net', 'http://tromp.com/', '+1-804-694-7844', '+1-478-959-4983', '(928) 632-5701', 'Egypt', 'Et incidunt et laudantium eos officia. Asperiores a amet qui rerum velit qui. Quia ut aut id quas iure ullam velit ab. Sit voluptatem libero esse in et praesentium placeat.', 'asset/placeholder_190x140c.png', '2022-02-10', 'Error eum omnis maxime culpa reprehenderit laborum repudiandae.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(4, 'Sales Party', 'Kianna Prohaska', 'Streich and Sons', 'Dr. Darrel Pollich', '367 Domenic Forks Suite 789\nDustinville, PA 84941', 'roman.weissnat@gmail.com', 'http://www.keeling.org/adipisci-quis-quaerat-voluptas-distinctio-ut-eum-quisquam-officia', '+1-219-384-9895', '1-858-787-2113', '220-609-6356', 'Georgia', 'Atque placeat dolore qui. Nisi placeat molestias dicta unde iste pariatur. Magnam omnis vitae nisi quis aperiam error qui. Magnam commodi ducimus voluptas aspernatur corporis.', 'asset/placeholder_190x140c.png', '2009-06-28', 'Modi sit qui consequatur.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(5, 'Sales Party', 'Ambrose Haag', 'Breitenberg-Aufderhar', 'Delpha Langosh Sr.', '35785 Hubert Branch\nWest Nolan, AK 90685-5858', 'gulgowski.gunner@flatley.biz', 'http://www.hahn.com/rem-enim-qui-qui-illo-quos-vero-sint-nam.html', '(870) 633-5970', '865.775.9719', '385.519.4084', 'Estonia', 'Aliquid incidunt fuga omnis sed. Sed pariatur et voluptatem consequatur dolores cumque nulla. Incidunt fuga et recusandae non non.', 'asset/placeholder_190x140c.png', '1997-07-10', 'Doloribus ut minus in minus soluta ut earum.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(6, 'Purchase Party', 'Miss Queenie Pacocha', 'Hoeger, Monahan and Wuckert', 'Bertrand Boyer MD', '95434 Bins Green\nLindland, NV 62861', 'langosh.jamar@christiansen.info', 'https://kub.net/in-consectetur-aperiam-qui-saepe-qui-asperiores.html', '(423) 603-8060', '(612) 320-0245', '775-495-5835', 'Mauritius', 'Ipsum sint eum quia repellat et illo modi. Alias doloremque at autem enim. Recusandae provident vel quia ipsam voluptatibus.', 'asset/placeholder_190x140c.png', '1983-11-30', 'Porro modi eum est voluptatem.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(7, 'Third Party Production', 'Osbaldo Crooks', 'Schulist-Blick', 'Mr. Donny Pagac II', '76814 Beer Pass\nEast Bulahchester, SD 91759', 'hayes.kenyon@halvorson.com', 'http://robel.com/enim-animi-voluptatum-beatae-sunt-nihil-nostrum', '+1.707.654.8737', '646.906.4940', '1-404-800-0054', 'Andorra', 'Sed iure consequatur fugit magni aut repellendus. Et harum omnis eum dolorum nesciunt ea et. Earum consequuntur molestiae dolor.', 'asset/placeholder_190x140c.png', '1997-10-19', 'Omnis unde soluta culpa.', '2023-12-20 18:51:32', '2023-12-20 18:51:32'),
(8, 'Sales Party', 'Sallie Abbott', 'Ratke Group', 'Carlie Weimann', '8393 Lucy Turnpike\nCelineside, NC 93645', 'mathew.macejkovic@feeney.net', 'http://goyette.com/nihil-accusantium-commodi-omnis-iusto-recusandae-et-autem', '+1.331.853.4109', '+1.951.683.2883', '1-678-336-9475', 'Czech Republic', 'Exercitationem placeat laborum molestiae et. Et ratione quod ex laboriosam quia. Corporis quod porro ratione ea et itaque. Sit natus voluptates voluptatem non hic.', 'asset/placeholder_190x140c.png', '2013-12-31', 'Enim adipisci eaque ut voluptatibus qui incidunt quisquam.', '2023-12-20 18:51:33', '2023-12-20 18:51:33'),
(9, 'Third Party Production', 'Dr. Johnson Witting III', 'Kovacek-Grant', 'Dr. Fleta Collins', '81480 Huel Way\nEast Miracle, NE 50412-2701', 'pberge@reynolds.com', 'http://west.com/', '+1-609-707-1645', '1-541-317-1423', '541-557-1052', 'French Polynesia', 'Omnis dolor eos numquam rerum sint. Veritatis molestias cupiditate corrupti ex mollitia. Quia necessitatibus ducimus dolor illum mollitia. Architecto dolorum commodi rerum dolore.', 'asset/placeholder_190x140c.png', '1993-12-14', 'Debitis temporibus sit aut repudiandae.', '2023-12-20 18:51:33', '2023-12-20 18:51:33'),
(10, 'Sales Party', 'Reuben Willms', 'Borer-Gutmann', 'Ms. Emilie Volkman', '34030 Reinger Knoll Suite 820\nPort Clark, KY 14966', 'bianka91@yahoo.com', 'http://roberts.biz/sequi-assumenda-amet-quae-voluptas', '+1-636-201-9989', '(854) 345-4015', '1-928-950-0808', 'Norfolk Island', 'Deleniti magni enim atque minus tempore tempore. Rem expedita temporibus id optio. Quibusdam cupiditate repellat quam officiis. Quo et qui est sapiente.', 'asset/placeholder_190x140c.png', '1980-07-16', 'Voluptatem quaerat dolorem error enim necessitatibus modi.', '2023-12-20 18:51:33', '2023-12-20 18:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `party_sales`
--

CREATE TABLE `party_sales` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `showroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sold_by` int DEFAULT NULL,
  `returned_commission` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_discount` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_amount` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_qty` int NOT NULL DEFAULT '0',
  `payment_discount` decimal(22,2) DEFAULT NULL,
  `total_discount` decimal(22,2) DEFAULT NULL,
  `sale_commission` decimal(22,2) DEFAULT NULL,
  `add_commission` decimal(22,2) DEFAULT NULL,
  `total_commission` decimal(22,2) DEFAULT NULL,
  `receivable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `final_receivable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `paid` decimal(22,2) NOT NULL DEFAULT '0.00',
  `due` decimal(22,2) NOT NULL DEFAULT '0.00',
  `total_qty` int NOT NULL DEFAULT '0',
  `delivery_qty` int NOT NULL DEFAULT '0',
  `due_qty` int NOT NULL DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_commissions`
--

CREATE TABLE `party_sale_commissions` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `commission_date` date DEFAULT NULL,
  `commission_per_qty` decimal(10,2) DEFAULT NULL,
  `total_qty` int NOT NULL DEFAULT '0',
  `total_invoice` int DEFAULT NULL,
  `total_commission` decimal(10,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_commission_items`
--

CREATE TABLE `party_sale_commission_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_commission_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_id` bigint UNSIGNED NOT NULL,
  `total_qty` int NOT NULL DEFAULT '0',
  `commission_per_qty` decimal(10,2) DEFAULT NULL,
  `total_commission` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_items`
--

CREATE TABLE `party_sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `due_main_unit_qty` int DEFAULT NULL,
  `due_sub_unit_qty` int DEFAULT NULL,
  `delivery_qty` int NOT NULL DEFAULT '0',
  `due_qty` int DEFAULT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_payments`
--

CREATE TABLE `party_sale_payments` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `bank_account_id` int DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `total_invoice` int DEFAULT NULL,
  `discount_amount` decimal(22,2) DEFAULT NULL,
  `pay_amount` decimal(22,2) DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_returns`
--

CREATE TABLE `party_sale_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_id` bigint UNSIGNED NOT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `return_qty` int NOT NULL DEFAULT '0',
  `return_discount` decimal(10,2) DEFAULT NULL,
  `return_commission` decimal(10,2) DEFAULT NULL,
  `return_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `party_sale_return_items`
--

CREATE TABLE `party_sale_return_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` int NOT NULL,
  `party_sale_return_id` bigint UNSIGNED NOT NULL,
  `party_sale_item_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_sale_payment_id` bigint UNSIGNED DEFAULT NULL,
  `bank_account_id` int DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` enum('receive','pay') COLLATE utf8mb4_unicode_ci NOT NULL,
  `paymentable_id` int UNSIGNED NOT NULL,
  `paymentable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source_of_payment` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(22,2) DEFAULT NULL,
  `amount` decimal(22,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `feature`, `order`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'list-bank_account', 'bank_account', 0, 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(2, 'create-bank_account', 'bank_account', 0, 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(3, 'show-bank_account', 'bank_account', 0, 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(4, 'list-item', 'item', 0, 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(5, 'create-item', 'item', 0, 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(6, 'edit-item', 'item', 0, 'web', '2023-12-20 18:51:13', '2023-12-20 18:51:13'),
(7, 'delete-item', 'item', 0, 'web', '2023-12-20 18:51:13', '2023-12-20 18:51:13'),
(8, 'list-brand', 'brand', 0, 'web', '2023-12-20 18:51:13', '2023-12-20 18:51:13'),
(9, 'create-brand', 'brand', 0, 'web', '2023-12-20 18:51:13', '2023-12-20 18:51:13'),
(10, 'edit-brand', 'brand', 0, 'web', '2023-12-20 18:51:13', '2023-12-20 18:51:13'),
(11, 'delete-brand', 'brand', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(12, 'list-unit', 'unit', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(13, 'create-unit', 'unit', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(14, 'delete-unit', 'unit', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(15, 'list-party_purchase', 'party_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(16, 'create-party_purchase', 'party_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(17, 'show-party_purchase', 'party_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(18, 'edit-party_purchase', 'party_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(19, 'delete-party_purchase', 'party_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(20, 'list-petty_purchase', 'petty_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(21, 'create-petty_purchase', 'petty_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(22, 'show-petty_purchase', 'petty_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(23, 'edit-petty_purchase', 'petty_purchase', 0, 'web', '2023-12-20 18:51:14', '2023-12-20 18:51:14'),
(24, 'delete-petty_purchase', 'petty_purchase', 0, 'web', '2023-12-20 18:51:15', '2023-12-20 18:51:15'),
(25, 'list-party_sale', 'party_sale', 0, 'web', '2023-12-20 18:51:15', '2023-12-20 18:51:15'),
(26, 'create-party_sale', 'party_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(27, 'edit-party_sale', 'party_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(28, 'delete-party_sale', 'party_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(29, 'list-cash_sale', 'cash_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(30, 'create-cash_sale', 'cash_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(31, 'edit-cash_sale', 'cash_sale', 0, 'web', '2023-12-20 18:51:16', '2023-12-20 18:51:16'),
(32, 'delete-cash_sale', 'cash_sale', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(33, 'list-wastage_sale', 'wastage_sale', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(34, 'create-wastage_sale', 'wastage_sale', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(35, 'edit-wastage_sale', 'wastage_sale', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(36, 'delete-wastage_sale', 'wastage_sale', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(37, 'list-receive_challan', 'receive_challan', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(38, 'create-receive_challan', 'receive_challan', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(39, 'edit-receive_challan', 'receive_challan', 0, 'web', '2023-12-20 18:51:17', '2023-12-20 18:51:17'),
(40, 'delete-receive_challan', 'receive_challan', 0, 'web', '2023-12-20 18:51:18', '2023-12-20 18:51:18'),
(41, 'list-delivery_challan', 'delivery_challan', 0, 'web', '2023-12-20 18:51:18', '2023-12-20 18:51:18'),
(42, 'create-delivery_challan', 'delivery_challan', 0, 'web', '2023-12-20 18:51:18', '2023-12-20 18:51:18'),
(43, 'edit-delivery_challan', 'delivery_challan', 0, 'web', '2023-12-20 18:51:18', '2023-12-20 18:51:18'),
(44, 'delete-delivery_challan', 'delivery_challan', 0, 'web', '2023-12-20 18:51:19', '2023-12-20 18:51:19'),
(45, 'list-moving_challan', 'moving_challan', 0, 'web', '2023-12-20 18:51:19', '2023-12-20 18:51:19'),
(46, 'create-moving_challan', 'moving_challan', 0, 'web', '2023-12-20 18:51:19', '2023-12-20 18:51:19'),
(47, 'edit-moving_challan', 'moving_challan', 0, 'web', '2023-12-20 18:51:20', '2023-12-20 18:51:20'),
(48, 'delete-moving_challan', 'moving_challan', 0, 'web', '2023-12-20 18:51:20', '2023-12-20 18:51:20'),
(49, 'list-employee', 'employee', 0, 'web', '2023-12-20 18:51:20', '2023-12-20 18:51:20'),
(50, 'create-employee', 'employee', 0, 'web', '2023-12-20 18:51:20', '2023-12-20 18:51:20'),
(51, 'edit-employee', 'employee', 0, 'web', '2023-12-20 18:51:20', '2023-12-20 18:51:20'),
(52, 'delete-employee', 'employee', 0, 'web', '2023-12-20 18:51:21', '2023-12-20 18:51:21'),
(53, 'list-department', 'department', 0, 'web', '2023-12-20 18:51:21', '2023-12-20 18:51:21'),
(54, 'create-department', 'department', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(55, 'edit-department', 'department', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(56, 'delete-department', 'department', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(57, 'list-party', 'party', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(58, 'create-party', 'party', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(59, 'edit-party', 'party', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(60, 'delete-party', 'party', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(61, 'list-payment', 'payment', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(62, 'create-payment', 'payment', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(63, 'delete-payment', 'payment', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(64, 'list-role', 'role', 0, 'web', '2023-12-20 18:51:22', '2023-12-20 18:51:22'),
(65, 'create-role', 'role', 0, 'web', '2023-12-20 18:51:23', '2023-12-20 18:51:23'),
(66, 'edit-role', 'role', 0, 'web', '2023-12-20 18:51:23', '2023-12-20 18:51:23'),
(67, 'delete-role', 'role', 0, 'web', '2023-12-20 18:51:24', '2023-12-20 18:51:24'),
(68, 'list-user', 'user', 0, 'web', '2023-12-20 18:51:24', '2023-12-20 18:51:24'),
(69, 'create-user', 'user', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(70, 'edit-user', 'user', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(71, 'delete-user', 'user', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(72, 'bank_account-history', 'bank_account', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(73, 'item-stock', 'item', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(74, 'party_purchase_invoice', 'party_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(75, 'party_purchase_report', 'party_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(76, 'party_purchase_add_payment', 'party_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(77, 'party_purchase_payment_list', 'party_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(78, 'party_purchase_payment_delete', 'party_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(79, 'create-purchase_return', 'purchase_return', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(80, 'list-party_purchase_return', 'purchase_return', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(81, 'list-petty_purchase_return', 'purchase_return', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(82, 'delete-purchase_return', 'purchase_return', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(83, 'petty_purchase_invoice', 'petty_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(84, 'petty_purchase_report', 'petty_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(85, 'petty_purchase_add_payment', 'petty_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(86, 'petty_purchase_payment_list', 'petty_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(87, 'petty_purchase_payment_delete', 'petty_purchase', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(88, 'party_sale_invoice', 'party_sale', 0, 'web', '2023-12-20 18:51:25', '2023-12-20 18:51:25'),
(89, 'party_sale_report', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(90, 'party_sale_add_payment', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(91, 'party_sale_payment_list', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(92, 'party_sale_payment_delete', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(93, 'create-party_sale_return', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(94, 'list-party_sale_return', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(95, 'delete-party_sale_return', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(96, 'create-party_sale_commission', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(97, 'list-party_sale_commission', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(98, 'delete-party_sale_commission', 'party_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(99, 'cash_sale_invoice', 'cash_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(100, 'cash_sale_report', 'cash_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(101, 'cash_sale_add_payment', 'cash_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(102, 'cash_sale_payment_list', 'cash_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(103, 'cash_sale_payment_delete', 'cash_sale', 0, 'web', '2023-12-20 18:51:26', '2023-12-20 18:51:26'),
(104, 'create-cash_sale_return', 'cash_sale', 0, 'web', '2023-12-20 18:51:27', '2023-12-20 18:51:27'),
(105, 'list-cash_sale_return', 'cash_sale', 0, 'web', '2023-12-20 18:51:27', '2023-12-20 18:51:27'),
(106, 'delete-cash_sale_return', 'cash_sale', 0, 'web', '2023-12-20 18:51:27', '2023-12-20 18:51:27'),
(107, 'wastage_sale_invoice', 'wastage_sale', 0, 'web', '2023-12-20 18:51:27', '2023-12-20 18:51:27'),
(108, 'wastage_sale_report', 'wastage_sale', 0, 'web', '2023-12-20 18:51:28', '2023-12-20 18:51:28'),
(109, 'wastage_sale_add_payment', 'wastage_sale', 0, 'web', '2023-12-20 18:51:28', '2023-12-20 18:51:28'),
(110, 'wastage_sale_payment_list', 'wastage_sale', 0, 'web', '2023-12-20 18:51:28', '2023-12-20 18:51:28'),
(111, 'wastage_sale_payment_delete', 'wastage_sale', 0, 'web', '2023-12-20 18:51:29', '2023-12-20 18:51:29'),
(112, 'receive_challan_invoice', 'receive_challan', 0, 'web', '2023-12-20 18:51:29', '2023-12-20 18:51:29'),
(113, 'receive_challan_report', 'receive_challan', 0, 'web', '2023-12-20 18:51:29', '2023-12-20 18:51:29'),
(114, 'delivery_challan_invoice', 'delivery_challan', 0, 'web', '2023-12-20 18:51:29', '2023-12-20 18:51:29'),
(115, 'delivery_challan_report', 'delivery_challan', 0, 'web', '2023-12-20 18:51:29', '2023-12-20 18:51:29'),
(116, 'moving_challan_invoice', 'moving_challan', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(117, 'moving_challan_report', 'moving_challan', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(118, 'setting', 'misc', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(119, 'backup', 'misc', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(120, 'permissions', 'role', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(121, 'profile', 'profile', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(122, 'change_password', 'profile', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30'),
(123, 'dashboard', 'dashboard', 0, 'web', '2023-12-20 18:51:30', '2023-12-20 18:51:30');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `order_by` int DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `purchase_by` int DEFAULT NULL,
  `purchase_form` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by_department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `returned_amount` decimal(22,2) NOT NULL DEFAULT '0.00',
  `payable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `final_payable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `paid` decimal(22,2) NOT NULL DEFAULT '0.00',
  `due` decimal(22,2) NOT NULL DEFAULT '0.00',
  `total_qty` int NOT NULL DEFAULT '0',
  `returned_qty` int NOT NULL DEFAULT '0',
  `delivery_qty` int NOT NULL DEFAULT '0',
  `due_qty` int NOT NULL DEFAULT '0',
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_items`
--

CREATE TABLE `purchase_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `due_main_unit_qty` int DEFAULT NULL,
  `due_sub_unit_qty` int DEFAULT NULL,
  `delivery_qty` int NOT NULL DEFAULT '0',
  `due_qty` int DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_returns`
--

CREATE TABLE `purchase_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `party_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `purchase_form` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by_department` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_qty` int NOT NULL DEFAULT '0',
  `return_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_return_items`
--

CREATE TABLE `purchase_return_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` int NOT NULL,
  `purchase_return_id` bigint UNSIGNED NOT NULL,
  `purchase_item_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_challans`
--

CREATE TABLE `receive_challans` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `purchase_id` bigint UNSIGNED NOT NULL,
  `party_id` int DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `ref_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receive_by` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `order_by` int NOT NULL,
  `transport_details` text COLLATE utf8mb4_unicode_ci,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receive_challan_items`
--

CREATE TABLE `receive_challan_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `receive_challan_id` bigint UNSIGNED NOT NULL,
  `purchase_item_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `total_packages` int DEFAULT NULL,
  `packaging_details` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(2, 'test_admin', 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(3, 'operator', 'web', '2023-12-20 18:51:12', '2023-12-20 18:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(74, 1),
(75, 1),
(76, 1),
(77, 1),
(78, 1),
(79, 1),
(80, 1),
(81, 1),
(82, 1),
(83, 1),
(84, 1),
(85, 1),
(86, 1),
(87, 1),
(88, 1),
(89, 1),
(90, 1),
(91, 1),
(92, 1),
(93, 1),
(94, 1),
(95, 1),
(96, 1),
(97, 1),
(98, 1),
(99, 1),
(100, 1),
(101, 1),
(102, 1),
(103, 1),
(104, 1),
(105, 1),
(106, 1),
(107, 1),
(108, 1),
(109, 1),
(110, 1),
(111, 1),
(112, 1),
(113, 1),
(114, 1),
(115, 1),
(116, 1),
(117, 1),
(118, 1),
(119, 1),
(120, 1),
(121, 1),
(122, 1),
(123, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2),
(53, 2),
(54, 2),
(55, 2),
(56, 2),
(57, 2),
(58, 2),
(59, 2),
(60, 2),
(61, 2),
(62, 2),
(63, 2),
(64, 2),
(65, 2),
(66, 2),
(67, 2),
(68, 2),
(69, 2),
(70, 2),
(71, 2),
(72, 2),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(107, 2),
(108, 2),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(121, 3),
(122, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `showroom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_to` text COLLATE utf8mb4_unicode_ci,
  `sold_by` int DEFAULT NULL,
  `sale_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `returned_commission` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_discount` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_amount` decimal(22,2) NOT NULL DEFAULT '0.00',
  `returned_qty` int NOT NULL DEFAULT '0',
  `payment_discount` decimal(22,2) DEFAULT NULL,
  `total_discount` decimal(22,2) DEFAULT NULL,
  `total_commission` decimal(22,2) DEFAULT NULL,
  `receivable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `final_receivable` decimal(22,2) NOT NULL DEFAULT '0.00',
  `paid` decimal(22,2) NOT NULL DEFAULT '0.00',
  `due` decimal(22,2) NOT NULL DEFAULT '0.00',
  `total_qty` int NOT NULL DEFAULT '0',
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_items`
--

CREATE TABLE `sale_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `commission` decimal(10,2) DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_returns`
--

CREATE TABLE `sale_returns` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `sale_id` bigint UNSIGNED NOT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_address` text COLLATE utf8mb4_unicode_ci,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `return_date` datetime DEFAULT NULL,
  `return_qty` int NOT NULL DEFAULT '0',
  `return_discount` decimal(10,2) DEFAULT NULL,
  `return_commission` decimal(10,2) DEFAULT NULL,
  `return_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sale_return_items`
--

CREATE TABLE `sale_return_items` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` int NOT NULL,
  `sale_return_id` bigint UNSIGNED NOT NULL,
  `sale_item_id` bigint UNSIGNED NOT NULL,
  `item_id` int UNSIGNED NOT NULL,
  `main_unit_qty` int DEFAULT NULL,
  `sub_unit_qty` int DEFAULT NULL,
  `qty` int NOT NULL,
  `item_variation_id` bigint UNSIGNED DEFAULT NULL,
  `rate` decimal(10,2) NOT NULL,
  `sub_total` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_logo_type` enum('Logo','Name','Both') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Name',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company`, `logo`, `address`, `email`, `phone`, `invoice_logo_type`, `created_at`, `updated_at`) VALUES
(1, 'New Kanak Hosiery & Garments (N.K)', 'asset/images/logo.png', 'Narayanganj 1400, Bangladesh', '#', '#', 'Name', '2023-12-20 18:51:33', '2023-12-20 18:51:33');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_to_unit_id` int DEFAULT NULL,
  `related_sign` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `related_by` int DEFAULT NULL,
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `related_to_unit_id`, `related_sign`, `related_by`, `default`, `created_at`, `updated_at`) VALUES
(1, 'pc', NULL, NULL, NULL, 1, '2023-12-20 18:51:11', '2023-12-20 18:51:11'),
(2, 'Dozen', 1, '*', 12, 0, '2023-12-20 18:51:11', '2023-12-20 18:51:11'),
(3, 'gm', NULL, NULL, NULL, 0, '2023-12-20 18:51:11', '2023-12-20 18:51:11'),
(4, 'Kg', 3, '*', 1000, 0, '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(5, 'ml', NULL, NULL, NULL, 0, '2023-12-20 18:51:12', '2023-12-20 18:51:12'),
(6, 'Litre', 5, '*', 1000, 0, '2023-12-20 18:51:12', '2023-12-20 18:51:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `department_id`, `name`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Admin', 'admin@softghor.com', NULL, '$2y$12$VuKXhgAuC0XYGIISRdH1TOYiwNB/bnkL7Ip8UPdmrg0yaUxFmNbtS', 'asset/images/profile/1.jpg', NULL, '2023-12-20 18:51:33', '2023-12-20 18:51:33'),
(2, NULL, 'Test-Admin', 'test@softghor.com', NULL, '$2y$12$ENHnJAWM1ww3c89.MJF/GuWDaDKPS8CpW5.v5A0yfwq14/sYxS6TG', 'asset/images/profile/1.jpg', NULL, '2023-12-20 18:51:34', '2023-12-20 18:51:34'),
(3, 1, 'Operator', 'operator@softghor.com', NULL, '$2y$12$25sOXThtcbeGSiMKUicMfOyyI82CW.HWexMuq.TI5uA4OfFTIJxDK', 'asset/images/profile/1.jpg', NULL, '2023-12-20 18:51:35', '2023-12-20 18:51:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_challans`
--
ALTER TABLE `delivery_challans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_challans_party_sale_id_foreign` (`party_sale_id`);

--
-- Indexes for table `delivery_challan_items`
--
ALTER TABLE `delivery_challan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `delivery_challan_items_delivery_challan_id_foreign` (`delivery_challan_id`),
  ADD KEY `delivery_challan_items_party_sale_item_id_foreign` (`party_sale_item_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_educational_trainings`
--
ALTER TABLE `employee_educational_trainings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_educational_trainings_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_personal_information`
--
ALTER TABLE `employee_personal_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_personal_information_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_salaries_employee_id_foreign` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_colors`
--
ALTER TABLE `item_colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_sizes`
--
ALTER TABLE `item_sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_variations`
--
ALTER TABLE `item_variations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `moving_challans`
--
ALTER TABLE `moving_challans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moving_challan_items`
--
ALTER TABLE `moving_challan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `moving_challan_items_moving_challan_id_foreign` (`moving_challan_id`);

--
-- Indexes for table `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `party_sales`
--
ALTER TABLE `party_sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sales_party_id_foreign` (`party_id`);

--
-- Indexes for table `party_sale_commissions`
--
ALTER TABLE `party_sale_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_commissions_party_id_foreign` (`party_id`);

--
-- Indexes for table `party_sale_commission_items`
--
ALTER TABLE `party_sale_commission_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_commission_items_party_sale_commission_id_foreign` (`party_sale_commission_id`),
  ADD KEY `party_sale_commission_items_party_sale_id_foreign` (`party_sale_id`);

--
-- Indexes for table `party_sale_items`
--
ALTER TABLE `party_sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_items_party_sale_id_foreign` (`party_sale_id`);

--
-- Indexes for table `party_sale_payments`
--
ALTER TABLE `party_sale_payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_payments_party_id_foreign` (`party_id`);

--
-- Indexes for table `party_sale_returns`
--
ALTER TABLE `party_sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_returns_party_sale_id_foreign` (`party_sale_id`),
  ADD KEY `party_sale_returns_party_id_foreign` (`party_id`);

--
-- Indexes for table `party_sale_return_items`
--
ALTER TABLE `party_sale_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `party_sale_return_items_party_sale_return_id_foreign` (`party_sale_return_id`),
  ADD KEY `party_sale_return_items_party_sale_item_id_foreign` (`party_sale_item_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_party_sale_payment_id_foreign` (`party_sale_payment_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchases_party_id_foreign` (`party_id`);

--
-- Indexes for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_items_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_returns_purchase_id_foreign` (`purchase_id`),
  ADD KEY `purchase_returns_party_id_foreign` (`party_id`);

--
-- Indexes for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_return_items_purchase_return_id_foreign` (`purchase_return_id`),
  ADD KEY `purchase_return_items_purchase_item_id_foreign` (`purchase_item_id`);

--
-- Indexes for table `receive_challans`
--
ALTER TABLE `receive_challans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receive_challans_purchase_id_foreign` (`purchase_id`);

--
-- Indexes for table `receive_challan_items`
--
ALTER TABLE `receive_challan_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receive_challan_items_receive_challan_id_foreign` (`receive_challan_id`),
  ADD KEY `receive_challan_items_purchase_item_id_foreign` (`purchase_item_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_items_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_returns_sale_id_foreign` (`sale_id`);

--
-- Indexes for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_return_items_sale_return_id_foreign` (`sale_return_id`),
  ADD KEY `sale_return_items_sale_item_id_foreign` (`sale_item_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_challans`
--
ALTER TABLE `delivery_challans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_challan_items`
--
ALTER TABLE `delivery_challan_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `employee_educational_trainings`
--
ALTER TABLE `employee_educational_trainings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `employee_personal_information`
--
ALTER TABLE `employee_personal_information`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `item_colors`
--
ALTER TABLE `item_colors`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `item_sizes`
--
ALTER TABLE `item_sizes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `item_variations`
--
ALTER TABLE `item_variations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `moving_challans`
--
ALTER TABLE `moving_challans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moving_challan_items`
--
ALTER TABLE `moving_challan_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parties`
--
ALTER TABLE `parties`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `party_sales`
--
ALTER TABLE `party_sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_commissions`
--
ALTER TABLE `party_sale_commissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_commission_items`
--
ALTER TABLE `party_sale_commission_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_items`
--
ALTER TABLE `party_sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_payments`
--
ALTER TABLE `party_sale_payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_returns`
--
ALTER TABLE `party_sale_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `party_sale_return_items`
--
ALTER TABLE `party_sale_return_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_items`
--
ALTER TABLE `purchase_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receive_challans`
--
ALTER TABLE `receive_challans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `receive_challan_items`
--
ALTER TABLE `receive_challan_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_items`
--
ALTER TABLE `sale_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_returns`
--
ALTER TABLE `sale_returns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery_challans`
--
ALTER TABLE `delivery_challans`
  ADD CONSTRAINT `delivery_challans_party_sale_id_foreign` FOREIGN KEY (`party_sale_id`) REFERENCES `party_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `delivery_challan_items`
--
ALTER TABLE `delivery_challan_items`
  ADD CONSTRAINT `delivery_challan_items_delivery_challan_id_foreign` FOREIGN KEY (`delivery_challan_id`) REFERENCES `delivery_challans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `delivery_challan_items_party_sale_item_id_foreign` FOREIGN KEY (`party_sale_item_id`) REFERENCES `party_sale_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_educational_trainings`
--
ALTER TABLE `employee_educational_trainings`
  ADD CONSTRAINT `employee_educational_trainings_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_personal_information`
--
ALTER TABLE `employee_personal_information`
  ADD CONSTRAINT `employee_personal_information_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_salaries`
--
ALTER TABLE `employee_salaries`
  ADD CONSTRAINT `employee_salaries_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `moving_challan_items`
--
ALTER TABLE `moving_challan_items`
  ADD CONSTRAINT `moving_challan_items_moving_challan_id_foreign` FOREIGN KEY (`moving_challan_id`) REFERENCES `moving_challans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sales`
--
ALTER TABLE `party_sales`
  ADD CONSTRAINT `party_sales_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_commissions`
--
ALTER TABLE `party_sale_commissions`
  ADD CONSTRAINT `party_sale_commissions_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_commission_items`
--
ALTER TABLE `party_sale_commission_items`
  ADD CONSTRAINT `party_sale_commission_items_party_sale_commission_id_foreign` FOREIGN KEY (`party_sale_commission_id`) REFERENCES `party_sale_commissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `party_sale_commission_items_party_sale_id_foreign` FOREIGN KEY (`party_sale_id`) REFERENCES `party_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_items`
--
ALTER TABLE `party_sale_items`
  ADD CONSTRAINT `party_sale_items_party_sale_id_foreign` FOREIGN KEY (`party_sale_id`) REFERENCES `party_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_payments`
--
ALTER TABLE `party_sale_payments`
  ADD CONSTRAINT `party_sale_payments_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_returns`
--
ALTER TABLE `party_sale_returns`
  ADD CONSTRAINT `party_sale_returns_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `party_sale_returns_party_sale_id_foreign` FOREIGN KEY (`party_sale_id`) REFERENCES `party_sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `party_sale_return_items`
--
ALTER TABLE `party_sale_return_items`
  ADD CONSTRAINT `party_sale_return_items_party_sale_item_id_foreign` FOREIGN KEY (`party_sale_item_id`) REFERENCES `party_sale_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `party_sale_return_items_party_sale_return_id_foreign` FOREIGN KEY (`party_sale_return_id`) REFERENCES `party_sale_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_party_sale_payment_id_foreign` FOREIGN KEY (`party_sale_payment_id`) REFERENCES `party_sale_payments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_items`
--
ALTER TABLE `purchase_items`
  ADD CONSTRAINT `purchase_items_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_returns`
--
ALTER TABLE `purchase_returns`
  ADD CONSTRAINT `purchase_returns_party_id_foreign` FOREIGN KEY (`party_id`) REFERENCES `parties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_returns_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `purchase_return_items`
--
ALTER TABLE `purchase_return_items`
  ADD CONSTRAINT `purchase_return_items_purchase_item_id_foreign` FOREIGN KEY (`purchase_item_id`) REFERENCES `purchase_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_return_items_purchase_return_id_foreign` FOREIGN KEY (`purchase_return_id`) REFERENCES `purchase_returns` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receive_challans`
--
ALTER TABLE `receive_challans`
  ADD CONSTRAINT `receive_challans_purchase_id_foreign` FOREIGN KEY (`purchase_id`) REFERENCES `purchases` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `receive_challan_items`
--
ALTER TABLE `receive_challan_items`
  ADD CONSTRAINT `receive_challan_items_purchase_item_id_foreign` FOREIGN KEY (`purchase_item_id`) REFERENCES `purchase_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `receive_challan_items_receive_challan_id_foreign` FOREIGN KEY (`receive_challan_id`) REFERENCES `receive_challans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_items`
--
ALTER TABLE `sale_items`
  ADD CONSTRAINT `sale_items_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_returns`
--
ALTER TABLE `sale_returns`
  ADD CONSTRAINT `sale_returns_sale_id_foreign` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sale_return_items`
--
ALTER TABLE `sale_return_items`
  ADD CONSTRAINT `sale_return_items_sale_item_id_foreign` FOREIGN KEY (`sale_item_id`) REFERENCES `sale_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `sale_return_items_sale_return_id_foreign` FOREIGN KEY (`sale_return_id`) REFERENCES `sale_returns` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
