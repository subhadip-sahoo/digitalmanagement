-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2015 at 10:13 AM
-- Server version: 5.5.40
-- PHP Version: 5.4.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VisitorManagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `status`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 1, 3, '2015-08-07 06:56:22', '2015-08-12 03:55:57'),
(2, 'Biswajit', 'Das', 'biswajit.das@businessprodesigns.com', 1, 3, '2015-08-07 06:57:28', '2015-08-12 03:56:22'),
(5, 'Subhajit', 'Sadhukhan', 'subhajit.sadhukhan@businessprodesigns.com', 1, 3, '2015-08-12 01:57:19', '2015-08-12 03:56:25'),
(4, 'Avi', 'Biswas', 'abhishek.biswas@businessprodesigns.com', 1, 3, '2015-08-10 22:54:31', '2015-08-12 03:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=46 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Location 1', '2015-08-05 02:25:16', '2015-08-05 02:25:16', NULL),
(2, 'Location 2', '2015-08-05 02:25:16', '2015-08-05 02:25:16', NULL),
(3, 'Location 3', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(4, 'Location 4', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(11, 'Location 5', '2015-08-28 01:14:37', '2015-08-28 01:14:37', NULL),
(28, 'Delhi', '2015-08-28 07:00:01', '2015-09-22 10:54:58', NULL),
(39, 'Brisbane', '2015-09-26 17:18:40', '2015-09-26 17:18:40', NULL),
(24, 'Kolkata', '2015-08-28 04:29:54', '2015-08-28 04:29:54', NULL),
(37, 'Sydney', '2015-09-24 11:00:51', '2015-09-24 11:00:51', NULL),
(38, 'Apple City', '2015-09-24 11:01:11', '2015-09-24 11:01:11', NULL),
(40, 'Melbourne', '2015-09-26 17:18:58', '2015-09-26 17:18:58', NULL),
(41, 'London', '2015-10-29 15:27:33', '2015-10-29 15:27:33', NULL),
(42, 'Japan', '2015-10-29 15:27:46', '2015-10-29 15:27:46', NULL),
(43, 'New York', '2015-10-29 15:27:54', '2015-10-29 15:27:54', NULL),
(44, 'Singapaore', '2015-10-29 15:28:09', '2015-10-29 15:28:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_04_12_000836_orchestra_auth_create_users_table', 1),
('2013_04_12_012833_orchestra_auth_create_user_meta_table', 1),
('2013_04_12_013023_orchestra_auth_create_roles_table', 1),
('2013_04_12_013201_orchestra_auth_create_user_role_table', 1),
('2013_04_23_132623_orchestra_auth_basic_roles', 1),
('2013_05_27_062915_orchestra_auth_create_password_reminders_table', 1),
('2014_04_16_043555_orchestra_auth_add_remember_token_to_users_table', 1),
('2013_04_11_233631_orchestra_memory_create_options_table', 2),
('2015_08_07_121056_recept', 3),
('2015_08_07_122338_ems', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orchestra_options`
--

CREATE TABLE IF NOT EXISTS `orchestra_options` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orchestra_options_name_unique` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('aivie.ladge@businessprodesigns.com', 'f8a4266c701d932255e1cf8252f7a509edea2bb2ccd5ba56d8cab6eff05a5626', '2015-10-20 11:16:02'),
('subhajit.sadhukhan@businessprodesigns.com', 'c1c2219b1b4a628e8bc6387951048aa5a81f73404fef18ca0616230dabd58ab2', '2015-10-20 11:16:46'),
('suraj.samanta@businessprodesigns.com', 'a19d7bf3fa5df5728a6f8b017196efbf9614eb4da14d49b18ed62773b6a5562b', '2015-10-20 12:10:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', '2015-08-05 02:25:16', '2015-08-05 02:25:16', NULL),
(2, 'Member', '2015-08-05 02:25:16', '2015-08-05 02:25:16', NULL),
(3, 'Receptionist', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL),
(5, 'Employee', '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE IF NOT EXISTS `site_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `terms_conditions` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`id`, `title`, `logo`, `terms_conditions`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Demo Pty Ltd Visitors Management', 'logo.png', '<p><strong>IMPORTANT</strong> – Your signature in the Visitors log indicates your understanding of the following.</p>\r\n<p><strong>HEALTH and SAFETY</strong> - Your safety is important to us. You have a responsibility to care for your own and others health and safety while on the premises.</p>\r\n<p><strong>EMERGENCY PROCEDURE</strong> – If the alarm (a continuous siren) sounds, leave the building by nearest safe exit and report to the evacuation point at the end of the XYZ Street (Turn left at the end of the driveway and proceed to the laneway).</p>\r\n<p><strong>HAZARDOUS MATERIAL/SUBSTANCES</strong> – You must declare anything hazardous you bring onto the premises.</p>\r\n<p><strong>SMOKING</strong> – Smoking is not permitted anywhere inside the premises.</p>', '2015-08-20 05:24:36', '2015-11-20 03:01:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `time_entries`
--

CREATE TABLE IF NOT EXISTS `time_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_org` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `avatar` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extension_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=78 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `password_org`, `first_name`, `last_name`, `name`, `position`, `phone`, `status`, `role_id`, `location_id`, `avatar`, `department`, `extension_no`, `vehicle_no`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'suraj.samanta@businessprodesigns.com', '$2y$10$Z8Rs.CuAm/samdX8MrlaReEWVL/.NcBGGM.6SiZYghwhwxaEKgUAy', '', 'Suraj', 'Samanta', 'Suraj Samanta', '', '2221113334', 1, 3, 40, '1.jpg', '', '', '', 'Hd2iyatwUk3efhXJStg0lyQFUTb9q5aAmAd8L6CIKVo7srvJDFtK7HZe9zIn', '2015-08-05 05:52:30', '2015-11-30 16:24:40', NULL),
(2, 'biswajit.das@businessprodesigns.com', '$2y$10$uPK.JPYyjElRMxMzN.iU0.VjpSXnfOClQKEFBK1iYvJG/9ouKdRuu', '', 'Biswajit', 'Das1', 'Biswajit Das1', '', '', 1, 3, 4, '2.jpg', '', '', '', 'qjgv55yeHLuOtoaawJOVqkJw0itubFqLGXaiNwacf7B9fHswBG9aRec1QpfS', '2015-08-06 04:40:38', '2015-09-09 11:35:34', NULL),
(3, 'testerinlimtex@gmail.com', '$2y$10$c6WcjX2H1IdjgzCIdSAMGe3GY7fDInqbumz9I0mK2B8fT08ttYL/C', '', 'Super', 'Admin', 'Admin', '', '1111111111', NULL, 1, 1, '', '', '', '', 'lEyDQJs8k0xg82g57ruC6YBSSzxISZGuU4WMiHHQs6QipropVMRB8kdtbx2a', '2015-08-07 07:34:48', '2015-11-30 14:53:07', NULL),
(4, 'rajesh.shaw@businessprodesigns.com', '$2y$10$ES6dfc1L0hv1SmKO5loXQOki09koGUSbDdHi2Vds3M8D6Bg10Ku12', '', 'Rajesh', 'Shaw', 'Rajesh Shaw', '', '', 1, 1, 1, '', '', '', '', 'sKrTS192LqvV0dVSx9AocRrQtjhTFS3MHRrfFarCAhMHYmVYNrL9UZ6beN66', '2015-08-12 00:07:44', '2015-10-13 11:21:32', NULL),
(12, 'abhijit.das@businessprodesigns.com', '', '', 'Abhijit', 'Das', 'Abhijit Das', '', '', 1, 3, 3, '12.jpg', '', '', '', NULL, '2015-08-18 02:38:31', '2015-08-26 01:20:30', NULL),
(13, 'milon.roy@businessprodesigns.com', '', '', 'Milon', 'Roy', 'Milon Roy', 'System Administrator', '9999999999', 1, 5, NULL, '', 'Pay Roll', '123', '5432455A', NULL, '2015-08-18 02:39:20', '2015-10-29 14:12:22', NULL),
(10, 'r.t@businessprodesigns.com', '', '', 'Roben', 'Thomas', 'Roben Thomas', 'Developer', '1212121212', 1, 5, NULL, '', 'Operations', '123', 'A1B2C3', NULL, '2015-08-17 05:28:35', '2015-10-29 18:11:32', NULL),
(14, 'subhendu.das@businessprodesigns.com', '', '', 'Subhendu', 'Das', 'Subhendu Das', 'Developer', '09876543210', 1, 5, 4, '', '', '', '', NULL, '2015-08-18 04:16:58', '2015-08-19 02:09:09', NULL),
(15, 'tanmay.khan@businessprodesigns.com', '$2y$10$K.4e.Vm4kegeyPk/MnSYY.SrreruvBmMDoav/k/B74LhAf.9ZB27K', '', 'Tanmay', 'Khan', 'Tanmay Khan', '', '', 1, 3, 4, '', '', '', '', 'eE7aF2dU78ElGy1mja2cVPTIsPqsqNMlTQZFUUdf1Id5lktsmOlBEXHHqIIQ', '2015-08-18 06:09:49', '2015-08-19 03:32:09', NULL),
(16, 'aivie.ladge@businessprodesigns.com', '', '', 'Aivie', 'Ladge', 'Aivie Ladge', 'Developer', '09876543210', 1, 5, 4, '', '', '', '', 'RfKXS9wqk8jikoCIyuRBNeqaCACCaBW1fpbbDfu3va204emXqg6tJfKLqLWB', '2015-08-19 02:10:12', '2015-10-16 18:50:47', NULL),
(17, 'prabeen.sharma@businessprodesigns.com', '123456', '123456', 'Prabeen', 'Sharma', 'Prabeen Sharma', '', '', 1, 3, 2, '17.jpg', '', '', '', NULL, '2015-08-26 01:11:24', '2015-10-12 14:42:03', NULL),
(39, 'xx@yy.com', '12345', '12345', 'xx', 'yy', 'xx yy', '', '', 1, 3, 2, '', '', '', '', NULL, '2015-10-12 13:46:43', '2015-10-12 13:46:43', NULL),
(18, 'sourav.sarkar123@businessprodesigns.com', '$2y$10$c56Bxind1EihxPsrx/xXD.HgSCUu6XIuRDQxxpd39GYvYIRRkFnse', '', 'Sourav', 'Sarkar', 'Sourav Sarkar', '', '', 1, 3, NULL, '', '', '', '', NULL, '2015-08-26 01:32:00', '2015-09-04 02:23:02', NULL),
(20, 'subhajit.sadhukhan@businessprodesigns.com', '', '', 'Subhajit', 'Sadhukhan', 'Subhajit Sadhukhan', 'Developer', '09876543210', 1, 5, NULL, '', '', '', '', NULL, '2015-09-03 23:59:22', '2015-09-03 23:59:22', NULL),
(71, 'cvb@sdf.com', '1111', '1111', 'czx', 'zxc', 'czx zxc', NULL, '', 1, 3, 28, '71.jpg', '', '', '', NULL, '2015-10-20 13:19:32', '2015-10-20 13:19:32', NULL),
(76, 'aa@xx.com', '', '', 'sdasdas', 'rew', 'sdasdas rew', 'XYZ', '09876543210', 1, 5, NULL, '', 'Operations', 'ABC123', '5432', NULL, '2015-11-30 16:27:54', '2015-11-30 16:27:54', NULL),
(74, 'test@yahoo.com', '123', '123', 'Bianca', 'Lee', 'Bianca Lee', NULL, '', 1, 3, 41, '', '', '', '', NULL, '2015-10-29 15:40:33', '2015-10-29 15:40:33', NULL),
(75, 'dennis@jar.com.au', '123', '123', 'Dennis', 'Jar', 'Dennis Jar', NULL, '', 1, 3, 42, '', '', '', '', NULL, '2015-10-29 15:43:28', '2015-10-29 15:43:28', NULL),
(73, 'biancae@test.com', '123', '123', 'Bianca', 'Lee', 'Bianca Lee', NULL, '', 1, 3, 43, '', '', '', '', NULL, '2015-10-29 15:38:08', '2015-10-29 15:38:08', NULL),
(36, 'chandra@amazeit.com.au', '', '', 'Nidhi', 'K', 'Nidhi K', 'Ipad test', '462643263427532753', 1, 5, NULL, '', 'IT', '007', 'AXZ 12345', NULL, '2015-09-26 17:20:32', '2015-11-20 03:00:03', NULL),
(65, 'info@winebypost.com.au', '', '', 'Anil', 'Joseph', 'Anil Joseph', 'Director', '0432189000', 1, 5, NULL, '', 'Operations', '321', 'ABCD123', NULL, '2015-10-20 02:14:29', '2015-10-20 02:14:29', NULL),
(38, 'test.employee@businessprodesigns.com', '', '', 'Test', 'Employee', 'Test Employee', 'XYZ', '1212121212', 1, 5, NULL, '', 'Electrical', '12345', '4321', NULL, '2015-10-12 13:01:41', '2015-10-12 13:01:41', NULL),
(40, 'xxx@yyy.com', '12345', '12345', 'xxx', 'yyy', 'xxx yyy', '', '', 1, 3, 2, '', '', '', '', NULL, '2015-10-12 13:49:01', '2015-10-12 13:49:01', NULL),
(41, 'debolina.sen@businessprodesigns.com', '$2y$10$M0.zw.PVIskN6OT21Bti3uSjyiIs5Qvpkf7YIpKzd3lVl4SlBNL7K', '', 'Debolina', 'Sen', 'Debolina Sen', '', '', 1, 1, NULL, '', '', '', '', 'zpDceUeCiZEm5dm9LOpf14eBFZFHHV1jEWla6ziRMYAEbwCeYrLYj3NZERjM', '2015-10-13 10:27:43', '2015-10-13 14:26:58', NULL),
(61, 'abcd@abcd.com', '', '', 'abcd', 'efgh', 'abcd efgh', NULL, '9876543210', 1, 5, 2, '', 'zzz', '12345', '54321', NULL, '2015-10-16 09:56:57', '2015-10-16 09:56:57', NULL),
(62, 'abcd1@abcd.com', '', '', 'abcd', 'efgh', 'abcd efgh', NULL, '9876543210', 1, 5, 2, '', 'zzz', '12345', '54321', NULL, '2015-10-16 09:56:57', '2015-10-16 09:56:57', NULL),
(72, 'rosy@test.com.au', '123', '123', 'Rosy', 'lane', 'Rosy lane', NULL, '', 1, 3, 41, '', '', '', '', NULL, '2015-10-29 15:29:48', '2015-10-29 15:29:48', NULL),
(64, 'info@amazeit.com.au', '$2y$10$ci7suPnMJ9ACqBxCenYcNugnhuC2Xch528PjD7KTpM9TXfW3a82q6', '123456', 'Chandra', 'K', 'Chandra K', NULL, '', 1, 3, 40, '', '', '', '', 'YkH8hYsqK7xIkDXuMXarFRJeZXBwk2wIKqbopTdattMyfiw6Y0iX292uiN0y', '2015-10-19 16:47:28', '2015-11-20 03:07:18', NULL),
(77, 'aaa@vvv.com', '', '', 'aaa', 'vvv', 'aaa vvv', 'zzz', '09876543210', 1, 5, NULL, '', 'Operations', '123', 'A1B2C3', NULL, '2015-11-30 16:32:28', '2015-11-30 16:32:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_meta`
--

CREATE TABLE IF NOT EXISTS `user_meta` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_meta_user_id_name_unique` (`user_id`,`name`),
  KEY `user_meta_user_id_index` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_role_user_id_role_id_index` (`user_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `visitors`
--

CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_no` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `host_name` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `arival_date` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `arival_time` time NOT NULL,
  `arival_timestamp` int(11) NOT NULL,
  `departure_time` varchar(128) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `signature` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=147 ;

--
-- Dumping data for table `visitors`
--

INSERT INTO `visitors` (`id`, `card_no`, `title`, `first_name`, `last_name`, `email`, `company_name`, `host_name`, `location`, `arival_date`, `arival_time`, `arival_timestamp`, `departure_time`, `avatar`, `signature`, `status`, `created_at`, `updated_at`) VALUES
(1, '12345', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex Infotech', '14', '1', '0000-00-00', '00:00:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-08-13 00:34:09', '2015-08-19 03:30:28'),
(2, '12346', '', 'Rakesh', 'Tripathi', 'rakesh.tripathi@businessprodesigns.com', 'Limtex Infotech', '', '4', '0000-00-00', '00:00:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-08-13 01:17:38', '2015-08-19 03:31:59'),
(3, '12347', 'Mr', 'Biswajit', 'Das', 'biswajit.das@businessprodesigns.com', 'Limtex Infotech', '13', '1', '0000-00-00', '00:00:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-08-18 23:09:10', '2015-08-19 03:32:41'),
(4, 'a1IB1441712710', 'Mr', 'Subir', 'Das', 's.das@businessprodesigns.com', 'BPD', 'Subhendu Das', '1', '0000-00-00', '11:45:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-08 06:15:40', '2015-09-08 06:15:40'),
(8, 'TB3B1441717408', 'Mr', 'Santanu', 'Mal', 'sdf@asfed.com', 'sdf', '34', '1', '15-10-2015', '13:03:00', 1444827600, '0000-00-00 00:00:00', '0', 1, 1, '2015-09-08 07:33:42', '2015-10-15 11:21:36'),
(9, 'iWIx1441717721', 'Mr', 'ZX', 'ZX', 'ZX@asd.com', 'asd', '13', '1', '08-09-2015', '13:08:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-08 07:39:04', '2015-09-08 07:39:04'),
(10, 'U1Bm1441773724', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex Infotech', '14', '1', '09-09-2015', '14:42:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-09 09:29:11', '2015-09-09 13:56:42'),
(18, 'bwIh1441859079', 'Mr', 'asd', 'asd', 'sdf@asd.com', 'asd', '14', '1', '10-09-2015', '14:24:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-10 08:54:53', '2015-09-10 08:54:53'),
(17, 'VVZ41441792674', 'Mr', 'rr', 'yy', 'tt@ff.com', 'jj', '14', '1', '09-09-2015', '19:57:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-09 14:28:12', '2015-09-09 14:28:12'),
(16, 'a5oQ1441792604', 'Ms', 'ertttt', 'erttt', 'er@d.com', 'wer', '16', '1', '09-09-2015', '19:56:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-09 14:27:01', '2015-09-09 14:29:01'),
(19, '2DOu1441859170', 'Mr', 'cvbcvbb', 'bb', 'cv@dfs.com', 'asd', '20', '1', '10-09-2015', '14:26:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-10 08:56:30', '2015-09-10 08:56:30'),
(20, '9Acz1441859631', 'Mr', 'sss', 'ss', 'ss@ss.com', 'ww', '13', '1', '10-09-2015', '14:33:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-10 09:04:11', '2015-09-10 09:04:11'),
(21, 'aPfY1441859950', 'Ms', 'eee', 'err', 'rr@ff.com', 'rrr', '16', '1', '10-09-2015', '14:39:00', 0, '0000-00-00 00:00:00', '', 0, 1, '2015-09-10 09:09:31', '2015-09-10 09:14:10'),
(30, 'dio61442828046', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex Infotech', '14', '1', '21-09-2015', '19:34:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-21 14:05:02', '2015-09-21 14:05:02'),
(31, 'gWvH1442835926', 'Mr', 'Pradip', 'Pal', 'pr@businessprodesigns.com', 'BPD', '16', '1', '21-09-2015', '21:50:00', 1442757600, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-21 16:16:17', '2015-10-09 16:22:04'),
(24, 'GeC91441884528', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'sd', '10', '1', '15-10-2015', '21:28:00', 1444827600, '0000-00-00 00:00:00', '1', 1, 1, '2015-09-10 15:59:32', '2015-10-15 10:53:37'),
(25, 'NhQM1442400454', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex Infotech', '14', '1', '16-09-2015', '20:47:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-16 15:21:02', '2015-09-16 15:21:02'),
(26, 'QnrM1442406251', 'Ms', 'aaa', 'sss', 'aaa@ddd.com', 'dddd', '13', '1', '16-09-2015', '22:24:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-16 16:54:31', '2015-09-16 16:54:31'),
(27, 'gbyk1442406439', 'Mr', 'mm', 'jjj', 'jj@dd.com', 'sdas', '14', '1', '16-09-2015', '22:27:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-16 16:57:39', '2015-09-16 16:57:39'),
(28, 'YFV91442463250', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex Infotech', '14', '1', '17-09-2015', '14:14:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-17 08:44:51', '2015-09-17 08:44:51'),
(29, 'RL7g1442463925', 'Mr', 'kkk', 'kkk', 'kkk@dd.com', 'yyy', '13', '1', '17-09-2015', '14:25:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-17 08:56:11', '2015-09-23 14:40:36'),
(32, 'YyVg1442841348', 'Mr', 'ss', 'dd', 'dd@ff.com', 'sasd', '14', '1', '21-09-2015', '23:15:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-21 17:46:18', '2015-09-21 17:46:18'),
(33, 'XXx91442841817', 'Mr', 'ww', 'xx', 'aa@ds.com', 'qwewq', '13', '1', '21-09-2015', '23:23:00', 0, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-21 17:54:08', '2015-09-21 17:54:08'),
(34, 'MxWR1442841849', 'Mr', 'qwe', 'qwe', 'qwe@asd.com', 'qwe', '20', '1', '21-09-2015', '23:24:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-21 17:54:42', '2015-09-21 17:54:42'),
(35, 'cjVN1442842080', 'Mrs', 'rwer', 'rt', 'df@sdf.com', 'nnn', '13', '1', '21-09-2015', '23:28:00', 0, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-21 17:58:39', '2015-09-23 14:38:03'),
(36, 'p2N71442898033', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'Limtex', '20', '1', '22-09-2015', '23:30:00', 1442844000, '22-09-2015 23:30:42', '0', 0, 0, '2015-09-22 09:31:21', '2015-10-09 16:21:36'),
(44, 'lPLP1442983252', 'Mr', 'Sudip', 'Das', 's.d@ss.com', 'BPD', '14', '1', '23-09-2015', '19:30:00', 1442930400, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-23 09:12:08', '2015-10-09 16:20:50'),
(37, 'MKfP1442901127', 'Mr', 'ss', 'dd', 'gg@hh.com', 'qqq', '13', '1', '22-09-2015', '15:52:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-22 10:22:31', '2015-09-23 14:31:45'),
(38, 'fpQo1442901234', 'Mr', 'Prabeen', 'Sharma', 'prabeen.sharma@businessprodesigns.com', 'Limtex Infotech Ltd.', '14', '1', '23-09-2015', '16:14:00', 1442930400, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-22 10:24:57', '2015-10-09 16:21:14'),
(39, 'LXJs1442901385', 'Mr', 'mmm', 'ret', 'asd@asdf.com', 'mmm', '14', '1', '22-09-2015', '16:14:00', 1442844000, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-22 10:26:57', '2015-10-09 16:27:00'),
(40, 'Kg3i1442901417', 'Mrs', 'tyu', 'tyu', 'ty@sf.com', 'asd', '13', '1', '22-09-2015', '15:56:00', 0, '22-09-2015 23:33:45', '0', 0, 0, '2015-09-22 10:27:21', '2015-09-22 18:03:45'),
(41, 'tEBd1442901536', 'Ms', 'sdfc', 'sdf', 'dzsf@sdf.com', 'hfghfg', '13', '1', '22-09-2015', '15:58:00', 0, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-22 10:29:15', '2015-09-22 10:29:15'),
(42, '6O2b1442901596', 'Ms', 'xvc', 'xcv', 'xcv@sdfg.com', 'aaa', '13', '1', '22-09-2015', '15:59:00', 0, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-22 10:30:37', '2015-09-23 14:16:58'),
(43, 'EM2l1442901637', 'Ms', 'bnm', 'bnmbn', 'bnm@sdf.com', 'sdf', '13', '1', '22-09-2015', '16:00:00', 0, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-22 10:31:12', '2015-09-22 10:31:12'),
(45, 'ZXWP1443003662', 'Mr', 'dfg', 'dfg', 'dfg@sdf.com', 'sdf', '20', '1', '23-09-2015', '20:21:00', 1442930400, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-23 14:52:05', '2015-10-09 16:20:31'),
(46, 'QB9o1443018504', 'Ms', 'asd', 'asd', 'asd@sadf.com', 'asd', '13', '1', '24-09-2015', '00:28:00', 1443016800, '0000-00-00 00:00:00', '0', 0, 1, '2015-09-23 18:58:42', '2015-10-09 16:20:09'),
(47, 'bBLK1443262609', 'Mr', 'Chandra', 'K', 'chandra@amazeit.com.au', 'Amaze IT Pty Ltd', '13', '1', '26-09-2015', '20:16:00', 1443189600, '26-09-2015 23:10:44', '1', 0, 0, '2015-09-26 14:55:25', '2015-10-09 16:19:51'),
(48, 'IkXA1443263125', 'Ms', 'Nidhi', 'K', 'info@amazeit.com.au', 'Amaze IT', '34', '1', '26-09-2015', '20:31:00', 1443189600, '0000-00-00 00:00:00', '1', 0, 1, '2015-09-26 14:58:20', '2015-10-09 16:19:31'),
(49, 'tSXO1443263652', 'Mr', 'James', 'Bond', 'info@amazeapps.com.au', 'Amaze Apps', '14', '1', '26-09-2015', '20:34:00', 1443189600, '0000-00-00 00:00:00', '1', 0, NULL, '2015-09-26 15:05:30', '2015-10-09 16:26:39'),
(50, 'ETnv1443263808', 'Ms', 'Abhishek', 'Biswas', 'kcsm23@yahoo.com', 'BPD', '', '1', '26-09-2015', '20:36:00', 0, '0000-00-00 00:00:00', '0', 0, 0, '2015-09-26 15:07:42', '2015-09-26 15:07:42'),
(51, 'hlNU1443263863', 'Mr', 'Tom', 'Cruise', 'kcsm234@yahoo.com', 'Mission Impossible Pty Ltd', '', '1', '26-09-2015', '20:37:00', 0, '0000-00-00 00:00:00', '1', 0, 1, '2015-09-26 15:11:41', '2015-09-26 15:11:41'),
(52, 'Zu8A1443264134', 'Mr', 'Anil', 'Joseph', 'kcsm2345@yahoo.com', 'BPD OZ', '10', '1', '26-09-2015', '21:28:00', 1443189600, '0000-00-00 00:00:00', '1', 0, 1, '2015-09-26 15:17:41', '2015-10-09 16:18:41'),
(53, 'T24d1443264461', 'Ms', 'Visitor 2', 'VM', 'kcsm23@yahoo.com', 'BPD OZ', '10', '1', '26-09-2015', '21:28:00', 1443189600, '0000-00-00 00:00:00', '1', 0, 1, '2015-09-26 15:53:22', '2015-10-09 16:18:23'),
(54, 'c4yZ1443266603', 'Ms', 'Visitor 3', 'VM', 'kcsm23@yahoo.com', 'BPD OZ', '10', '1', '26-09-2015', '22:58:00', 1443189600, '26-09-2015 23:07:31', '1', 0, 0, '2015-09-26 15:58:20', '2015-10-09 16:17:09'),
(55, '7rL41444193194', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'XYZ', '10', '1', '09-10-2015', '15:46:00', 1444309200, '0000-00-00 00:00:00', '0', 0, 1, '2015-10-07 10:17:34', '2015-10-09 16:14:52'),
(56, 'M2Ut1444893014', 'Mr', 'X', 'Y', 'x@y.com', 'XXX', '34', '1', '16-10-2015', '18:10:00', 1444914000, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-15 12:41:19', '2015-10-16 11:13:09'),
(57, 'Jzm31444895385', 'Mr', 'aaa', 'bbb', 'aaa@bbb.com', 'aaabbb', '38', '1', '16-10-2015', '22:48:00', 1444914000, '16-10-2015 22:48:56', '1', 1, 0, '2015-10-15 13:20:48', '2015-10-16 17:18:56'),
(58, 'cDKl1444895590', 'Other', 'ccc', 'aaa', 'ccc@aaa.com', 'caca', '10', '1', '15-10-2015', '18:53:00', 1444827600, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-15 13:24:04', '2015-10-15 13:24:04'),
(59, 'dfvo1444895712', 'Ms', 'nn', 'mm', 'n@m.com', 'vb', '10', '1', '15-10-2015', '18:55:00', 1444827600, '0000-00-00 00:00:00', '1', 1, 0, '2015-10-15 13:26:04', '2015-10-15 13:26:04'),
(60, '573n1444910843', 'Mr', 'bb', 'nn', 'b@n.com', 'bbnn', '10', '1', '15-10-2015', '23:07:00', 1444827600, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-15 17:38:07', '2015-10-15 17:38:07'),
(61, 'u9cf1444910888', 'Mrs', 'khjh', 'lhjk', 'k@l.com', 'werw', '34', '1', '15-10-2015', '23:08:00', 1444827600, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-15 17:38:50', '2015-10-15 17:38:50'),
(62, 'Bd8z1444974539', 'Mr', 'sasas', 'fgh', 's@s.com', 'gfhgf', '10', '1', '16-10-2015', '22:16:00', 1444914000, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-16 11:19:49', '2015-10-16 16:46:28'),
(63, 'U4AI1444975574', '', 'Ipad', 'Test', 'i.t@a.com', 'Ff', '38', '1', '16-10-2015', '17:06:00', 1444914000, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-16 11:41:25', '2015-10-16 13:22:21'),
(65, 'pmd81444981977', 'Mrs', 'Trt', 'Ftyh', 'ff@dfg.com', 'Fghu', '14', '1', '16-10-2015', '18:52:00', 1444914000, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-16 13:24:08', '2015-10-16 13:48:44'),
(66, 'OKsz1444983562', 'Mr', 'Rakesh', 'Tripathi', 'r.t@rt.com', 'Rt', '38', '1', '16-10-2015', '19:19:00', 1444914000, '0000-00-00 00:00:00', '1', 1, 0, '2015-10-16 13:50:35', '2015-10-16 13:50:35'),
(67, 'SJAj1445130239', 'Mr', 'Ipad mini test', 'Ipad mini test', 'kcsm23@yahoo.om', 'Abcd', '14', '37', '18-10-2015', '13:15:00', 1445086800, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-18 06:44:40', '2015-10-18 07:45:34'),
(68, 'juzg1445131028', 'Mrs', 'Test2', 'Test2', 'chandra@yahoo.com', 'Abc', '', '37', '18-10-2015', '13:15:00', 1445086800, '18-10-2015 13:15:11', '0', 1, 0, '2015-10-18 06:48:31', '2015-10-18 07:45:11'),
(69, 'UEFu1445131112', 'Mrs', 'Test3', 'Test3', 'chandrak@yahoo.com', 'Abc', '24', '37', '18-10-2015', '12:18:00', 1445086800, '0000-00-00 00:00:00', '0', 1, 0, '2015-10-18 06:59:34', '2015-10-18 06:59:34'),
(70, 'ruRQ1445131775', 'Other', 'Group test 3', 'Group test 3', 'ck@yahoo.com', 'Abc', '24', '37', '18-10-2015', '12:29:00', 1445086800, '0000-00-00 00:00:00', '0', 1, 0, '2015-10-18 07:01:32', '2015-10-18 07:01:32'),
(71, 'R8p31445131893', 'Ms', 'Group visitor 3', 'Gv3 test', 'ckw@yahoo.com', 'Abc', '24', '37', '18-10-2015', '12:31:00', 1445086800, '18-10-2015 13:15:14', '0', 1, 0, '2015-10-18 07:20:02', '2015-10-18 07:45:14'),
(72, '1Dz61445133890', 'Ms', 'android test', 'test kit kat', 'chandra@test.com', 'ddfgh', '24', '37', '18-10-2015', '13:15:00', 1445086800, '18-10-2015 13:15:28', '0', 1, 0, '2015-10-18 07:37:43', '2015-10-18 07:45:28'),
(73, 'Te491445134064', 'Other', 'kitkat tezt 2', 'android test 2', 'test@test.com', 'rrrrr pty ltd', '10', '37', '18-10-2015', '13:15:00', 1445086800, '18-10-2015 13:15:24', '0', 1, 0, '2015-10-18 07:40:00', '2015-10-18 07:45:24'),
(74, 'iZIK1445236158', 'Mr', 'Dev', 'Kumar', 'd.k@dk.com', 'DK', '10', '37', '19-10-2015', '17:29:00', 1445173200, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-19 12:00:14', '2015-10-19 12:00:14'),
(90, 'Yk5R1445250977', 'Ms', 'Dxd', 'Cdc', 'cd@dd.com', 'Dff', '34', '37', '19-10-2015', '21:36:00', 1445173200, '0000-00-00 00:00:00', '1', 1, NULL, '2015-10-19 16:10:34', '2015-10-19 16:10:34'),
(87, 'QERx1445246104', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@gmail.com', 'Ss', '10', '37', '28-10-2015', '20:15:00', 1445950800, '28-10-2015 23:46:35', '1', 1, 0, '2015-10-19 14:47:22', '2015-10-28 18:16:35'),
(88, 'eb9C1445246243', 'Mr', 'Test', 'iPad mini', 'ip@gg.com', 'Hh', '10', '37', '19-10-2015', '20:17:00', 1445173200, '19-10-2015 22:45:36', '1', 1, 0, '2015-10-19 15:50:01', '2015-10-19 17:15:36'),
(89, 'V17T1445250134', 'Mrs', 'Second ipad test', 'Ipad9.0.2', 'kcsheker@yahooo.com', 'Test', '10', '37', '19-10-2015', '21:22:00', 1445173200, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-19 15:56:38', '2015-10-19 15:56:38'),
(91, 'v8UY1445251245', 'Mr', 'asd', 'asd', 'as@sdf.com', 'asd', '13', '1', '19-10-2015', '21:40:00', 1445173200, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-19 16:11:21', '2015-10-19 16:11:21'),
(92, 'Igsc1445254464', 'Mr', 'Samsung test', 'samsung', 'kcsheker@gmail.com', 'test', '13', '40', '20-10-2015', '22:53:00', 1445259600, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-19 17:06:53', '2015-10-19 18:32:43'),
(93, 'bgz91445340880', 'Mrs', 'IE Test', 'IE Test Windows 7', 'test@yahoo.com', 'Yahoo!', '10', '40', '20-10-2015', '22:34:00', 1445259600, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-20 17:06:00', '2015-10-20 17:06:00'),
(94, '8t7o1445422374', 'Mr', 'Anna', 'Casy', 'anna.casy@yahoo.com', 'All States Pty Ltd', '10', '40', '21-10-2015', '21:12:00', 1445346000, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-21 15:48:30', '2015-10-21 15:48:30'),
(95, '5Y9m1446015392', 'Mr', 'Suraj', 'Samanta', 'suraj.samanta@businessprodesigns.com', 'XYZ', '10', '37', '06-11-2015', '16:31:00', 1446728400, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-28 12:27:12', '2015-11-06 11:01:16'),
(96, '8Qmn1446105786', 'Mr', 'Anna', 'Ferari', 'ana@jameshardey.com.au', 'James Hardey Pty Ltd', '16', '40', '29-10-2015', '19:03:00', 1446037200, '0000-00-00 00:00:00', '1', 1, 1, '2015-10-29 13:35:59', '2015-10-29 13:35:59'),
(97, 'oPdB1446105960', 'Ms', 'Alana', 'Lam', 'alana@realestate.com.au', 'realestate.com.au', '10', '40', '29-10-2015', '19:06:00', 1446037200, '0000-00-00 00:00:00', '0', 1, 0, '2015-10-29 13:39:13', '2015-10-29 13:39:13'),
(98, 'Gs9j1446106154', 'Mr', 'Manuel', 'Boris', 'manuel@boris.com', 'Boris Building Products', '13', '40', '29-10-2015', '19:09:00', 1446037200, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-29 13:41:38', '2015-10-29 13:41:38'),
(99, 'jpJB1446106299', 'Other', 'Vivian', 'Rose', 'vivian@pd.com.au', 'TW Wholesale', '16', '40', '29-10-2015', '19:11:00', 1446037200, '0000-00-00 00:00:00', '1', 1, 0, '2015-10-29 13:45:35', '2015-10-29 13:45:35'),
(100, '0GIO1446106535', 'Mrs', 'Indus', 'Junior', 'indus@flowercity.com', 'flowercity.com Pty Ltd', '16', '40', '29-10-2015', '19:15:00', 1446037200, '0000-00-00 00:00:00', '1', 1, 0, '2015-10-29 13:49:34', '2015-10-29 13:49:34'),
(101, 'OOaa1446106775', 'Mr', 'Tom', 'Bell', 'tom@flowercity.com', 'flowercity.com Pty Ltd', '16', '40', '29-10-2015', '19:19:00', 1446037200, '0000-00-00 00:00:00', '0', 1, 0, '2015-10-29 13:51:14', '2015-10-29 13:51:14'),
(102, 'Z7tj1446107532', 'Other', 'Fifty', 'Fifty', 'fifty@helloworld.com', 'helloworld.com', '10', '37', '29-10-2015', '19:32:00', 1446037200, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-29 14:03:06', '2015-10-29 14:03:06'),
(103, '2BFr1446187717', 'Mr', 'James', 'Bond', 'james@yahoo.com', 'Test Pty Ltd', '10', '40', '30-10-2015', '17:48:00', 1446123600, '0000-00-00 00:00:00', '0', 1, 1, '2015-10-30 12:20:19', '2015-10-30 12:20:19'),
(104, 'YoZE1446187819', 'Mrs', 'Dean', 'Jones', 'dean@yahoo.com', 'Dean Pty Ltd', '10', '40', '30-10-2015', '17:50:00', 1446123600, '0000-00-00 00:00:00', '0', 1, 0, '2015-10-30 12:21:19', '2015-10-30 12:21:19'),
(105, 'gNqq1446555399', 'Mr', 'Suraj', 'Samanta', 'ss@gmail.com', 'BPD', '10', '37', '04-11-2015', '23:56:00', 1446555600, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-03 18:29:52', '2015-11-03 18:31:41'),
(107, 'JrFf1446619051', 'Mr', 'Test', 'Second Test', 'chandra@amazeit.com.au', 'test@amazeit.com.au', '14', '40', '10-11-2015', '14:06:00', 1447074000, '0000-00-00 00:00:00', '1', 1, 1, '2015-11-04 12:09:59', '2015-11-10 08:36:33'),
(108, 'K9es1446786213', 'Mr', 'Shabdha', 'K', 'info@winebypost.com.au', 'Amaze Apps', '10', '40', '06-11-2015', '16:03:00', 1446728400, '06-11-2015 23:29:51', '1', 1, 0, '2015-11-06 10:35:37', '2015-11-06 17:59:51'),
(140, 'vSfP1447933086', 'Mr', 'Xxx', 'Yyy', 'xx@yy.com', 'XYZ', '20', '40', '19-11-2015', '22:38:00', 1447851600, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-19 17:09:38', '2015-11-19 17:42:13'),
(110, 'Lwjv1446787587', 'Ms', 'Anna', 'Purna', 'info@amazeapps.com.au', 'Amaze Apps', '10', '40', '06-11-2015', '16:54:00', 1446728400, '06-11-2015 16:54:14', '1', 1, 0, '2015-11-06 11:00:33', '2015-11-06 11:24:14'),
(117, 'zB7q1446865618', 'Mr', 'Shabdha', 'K', 'info@winebypost.com.au', 'Wine By Post', '65', '40', '07-11-2015', '14:06:00', 1446814800, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-07 08:38:31', '2015-11-07 08:38:31'),
(141, '95Cu1447935264', 'Mr', 'vbnb', 'werwe', 'as@as.com', 'sdf', '20', '40', '19-11-2015', '23:22:00', 1447851600, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-19 17:46:20', '2015-11-19 17:52:21'),
(120, 'zsCU1447138968', 'Ms', 'Shabdha', 'K', 'info@winebypost.com.au', 'Amaze Apps', '14', '40', '10-11-2015', '18:02:00', 1447074000, '0000-00-00 00:00:00', '1', 1, 0, '2015-11-10 12:34:42', '2015-11-10 12:34:42'),
(121, 'J5aD1447140352', 'Mrs', 'Nidhi', 'K', 'sales@test.com.au', 'Amaze Apps', '10', '40', '10-11-2015', '18:25:00', 1447074000, '0000-00-00 00:00:00', '1', 1, NULL, '2015-11-10 12:57:50', '2015-11-10 12:57:50'),
(115, 'zIic1446793568', 'Mr', 'we', 'wer', 'erg@sd.com', 'e', '13', '40', '06-11-2015', '18:06:00', 1446728400, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-06 12:36:38', '2015-11-06 12:36:38'),
(116, 'v8ol1446793672', 'Mr', 'wer', 'wer', 'fhbgf@swd.com', 'wer', '10', '40', '06-11-2015', '18:07:00', 1446728400, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-06 12:38:31', '2015-11-06 12:38:31'),
(118, 'r0xs1446883499', 'Mr', 'Chandra', 'James', 'chandra@amazeapps.com.au', 'Amaze Apps', '14', '40', '18-11-2015', '19:04:00', 1447765200, '0000-00-00 00:00:00', '1', 1, NULL, '2015-11-07 13:38:33', '2015-11-18 10:10:50'),
(122, 'TBIJ1447143732', 'Mr', 'Test New', 'Test New', 'test@test.com.u', 'Test Pty Ltd', '14', '40', '10-11-2015', '19:22:00', 1447074000, '0000-00-00 00:00:00', '0', 1, NULL, '2015-11-10 13:54:35', '2015-11-10 13:54:35'),
(123, 'zepQ1447153709', 'Mr', 'Mumbai Dubai', 'Delhi Howra', 'delhi@test.com.au', 'ABCD Pty Ltd', '14', '40', '10-11-2015', '22:08:00', 1447074000, '0000-00-00 00:00:00', '0', 1, NULL, '2015-11-10 16:39:53', '2015-11-10 16:39:53'),
(124, 'zepQ1447153709', 'Mr', 'Mumbai Dubai', 'Delhi Howra', 'delhi@test.com.au', 'ABCD Pty Ltd', '14', '40', '10-11-2015', '22:08:00', 1447074000, '0000-00-00 00:00:00', '0', 1, NULL, '2015-11-10 16:39:54', '2015-11-10 16:39:54'),
(125, 'egxk1447155536', 'Mr', 'Chandra', 'Final 10-40', 'test@test.com.au', 'ABCD Pty Ltd', '10', '40', '10-11-2015', '22:38:00', 1447074000, '0000-00-00 00:00:00', '0', 1, 0, '2015-11-10 17:09:45', '2015-11-10 17:09:45'),
(126, 'g5UL1447822265', 'Mr', 'James', 'Bond', 'info@amazeit.com.au', 'Amaze Apps', '65', '40', '18-11-2015', '15:51:00', 1447765200, '0000-00-00 00:00:00', '1', 1, NULL, '2015-11-18 10:23:24', '2015-11-18 10:23:24'),
(127, 'bT0F1447828942', 'Ms', 'Shabdha', 'K', 'info@winebypost.com.au', 'Wine By Post', '36', '40', '18-11-2015', '17:48:00', 1447765200, '0000-00-00 00:00:00', '1', 1, 1, '2015-11-18 12:15:14', '2015-11-18 12:18:09'),
(128, 'LmxT1447831431', 'Ms', 'Nidhi', 'K', 'info@amazeapps.com', 'Amaze Apps', '16', '40', '18-11-2015', '18:23:00', 1447765200, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-18 12:55:27', '2015-11-18 12:55:27'),
(137, 'Qd4l1447919408', 'Mr', 'sf', 'fd', 'df@as.com', 'sdf', '14', '40', '19-11-2015', '18:50:00', 1447851600, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-19 13:21:00', '2015-11-19 14:58:50'),
(138, 'ewKR1447928578', 'Mr', 'Susdf', 'sdf', 'fgh@sef.com', 'qwe', '20', '40', '19-11-2015', '21:22:00', 1447851600, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-19 15:53:33', '2015-11-19 17:04:13'),
(139, 'cTZq1447928706', '', 'vcbvb', 'uyt', 'fds@xcvb.com', 'sdf', '14', '40', '19-11-2015', '21:25:00', 1447851600, '19-11-2015 22:30:32', '0', 1, 0, '2015-11-19 15:55:28', '2015-11-19 17:00:32'),
(142, 'nw8t1447968290', 'Ms', 'Shabdha', 'K', 'info@amazeapps.com', 'Amaze Apps', '36', '40', '20-11-2015', '08:24:00', 1447938000, '0000-00-00 00:00:00', '1', 1, 1, '2015-11-20 02:56:33', '2015-11-20 02:56:33'),
(143, 'nw8t1447968290', 'Ms', 'Shabdha', 'K', 'info@amazeapps.com', 'Amaze Apps', '36', '40', '20-11-2015', '08:24:00', 1447938000, '0000-00-00 00:00:00', '1', 1, 1, '2015-11-20 02:57:06', '2015-11-20 02:57:06'),
(144, 'nw8t1447968290', 'Ms', 'Shabdha', 'K', 'info@amazeapps.com', 'Amaze Apps', '36', '40', '20-11-2015', '08:24:00', 1447938000, '0000-00-00 00:00:00', '1', 1, 0, '2015-11-20 02:57:25', '2015-11-20 02:57:25'),
(145, 'vdJW1448428457', 'Ms', 'Radha', 'Ghosh', 'r.g@businessprodesigns.com', 'XXX', '16', '40', '30-11-2015', '16:14:00', 1448802000, '0000-00-00 00:00:00', '0', 1, 1, '2015-11-25 10:47:46', '2015-11-30 14:54:16'),
(146, 'nVrU1448428667', 'Mr', 'asdas', 'asd', 'dfg@sad.com', 'RRR', '20', '40', '25-11-2015', '16:17:00', 1448370000, '25-11-2015 16:23:11', '0', 1, 0, '2015-11-25 10:50:09', '2015-11-25 10:53:11');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_role`
--

CREATE TABLE IF NOT EXISTS `visitor_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visitor_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_role_user_id_role_id_index` (`visitor_id`,`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=143 ;

--
-- Dumping data for table `visitor_role`
--

INSERT INTO `visitor_role` (`id`, `visitor_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2015-08-19 01:09:48', '2015-08-19 01:35:38'),
(2, 2, 3, '2015-08-19 01:11:06', '2015-08-19 01:11:06'),
(3, 3, 2, '2015-08-19 01:35:55', '2015-08-19 01:35:55'),
(4, 4, 1, '2015-09-08 06:15:40', '2015-09-08 06:15:40'),
(5, 5, 2, '2015-09-08 06:21:31', '2015-09-08 06:21:31'),
(6, 6, 1, '2015-09-08 07:13:54', '2015-09-08 07:13:54'),
(7, 7, 2, '2015-09-08 07:27:37', '2015-09-08 07:27:37'),
(8, 8, 2, '2015-09-08 07:33:42', '2015-10-09 17:03:12'),
(9, 9, 2, '2015-09-08 07:39:04', '2015-09-08 07:39:04'),
(10, 10, 2, '2015-09-09 09:29:11', '2015-09-09 13:57:38'),
(12, 16, 1, '2015-09-09 14:27:01', '2015-09-09 14:27:01'),
(13, 17, 1, '2015-09-09 14:28:12', '2015-09-09 14:28:12'),
(14, 18, 1, '2015-09-10 08:54:53', '2015-09-10 08:54:53'),
(15, 19, 1, '2015-09-10 08:56:30', '2015-09-10 08:56:30'),
(16, 20, 3, '2015-09-10 09:04:11', '2015-09-10 09:04:11'),
(17, 21, 1, '2015-09-10 09:09:31', '2015-09-10 09:09:31'),
(18, 22, 1, '2015-09-10 15:33:16', '2015-09-10 15:33:16'),
(19, 23, 2, '2015-09-10 15:56:28', '2015-09-10 15:56:28'),
(20, 24, 1, '2015-09-10 15:59:32', '2015-09-10 15:59:32'),
(21, 25, 1, '2015-09-16 15:21:02', '2015-09-16 15:21:02'),
(22, 26, 3, '2015-09-16 16:54:31', '2015-09-16 16:54:31'),
(23, 27, 1, '2015-09-16 16:57:39', '2015-09-16 16:57:39'),
(24, 28, 1, '2015-09-17 08:44:51', '2015-09-17 08:44:51'),
(25, 29, 1, '2015-09-17 08:56:11', '2015-09-17 09:00:39'),
(26, 30, 1, '2015-09-21 14:05:02', '2015-09-21 14:05:02'),
(27, 31, 2, '2015-09-21 16:16:17', '2015-09-21 16:16:17'),
(28, 32, 3, '2015-09-21 17:46:18', '2015-09-21 17:46:18'),
(29, 33, 1, '2015-09-21 17:54:08', '2015-09-21 17:54:08'),
(30, 34, 3, '2015-09-21 17:54:42', '2015-09-21 17:54:42'),
(31, 35, 1, '2015-09-21 17:58:39', '2015-09-21 17:58:39'),
(32, 36, 1, '2015-09-22 09:31:21', '2015-09-22 09:31:21'),
(33, 37, 1, '2015-09-22 10:22:31', '2015-09-22 10:22:31'),
(34, 38, 2, '2015-09-22 10:24:57', '2015-09-22 10:24:57'),
(35, 39, 3, '2015-09-22 10:26:57', '2015-09-22 10:26:57'),
(36, 40, 1, '2015-09-22 10:27:21', '2015-09-22 10:27:21'),
(37, 41, 1, '2015-09-22 10:29:15', '2015-09-22 10:29:15'),
(38, 42, 3, '2015-09-22 10:30:37', '2015-09-22 10:30:37'),
(39, 43, 3, '2015-09-22 10:31:12', '2015-09-22 10:31:12'),
(40, 44, 1, '2015-09-23 09:12:08', '2015-09-23 09:12:08'),
(41, 45, 1, '2015-09-23 14:52:05', '2015-09-23 14:52:05'),
(42, 46, 1, '2015-09-23 18:58:42', '2015-09-23 18:58:42'),
(43, 47, 1, '2015-09-26 14:55:25', '2015-09-26 14:55:25'),
(44, 48, 2, '2015-09-26 14:58:20', '2015-09-26 14:58:20'),
(45, 49, 3, '2015-09-26 15:05:30', '2015-09-26 15:05:30'),
(46, 50, 5, '2015-09-26 15:07:42', '2015-09-26 15:07:42'),
(47, 51, 3, '2015-09-26 15:11:41', '2015-09-26 15:11:41'),
(48, 52, 5, '2015-09-26 15:17:41', '2015-09-26 15:17:41'),
(49, 53, 5, '2015-09-26 15:53:22', '2015-09-26 15:53:22'),
(50, 54, 5, '2015-09-26 15:58:20', '2015-09-26 15:58:20'),
(51, 55, 1, '2015-10-07 10:17:34', '2015-10-07 10:17:34'),
(52, 56, 1, '2015-10-15 12:41:19', '2015-10-15 12:41:19'),
(53, 57, 3, '2015-10-15 13:20:48', '2015-10-15 13:20:48'),
(54, 58, 5, '2015-10-15 13:24:04', '2015-10-15 13:24:04'),
(55, 59, 2, '2015-10-15 13:26:04', '2015-10-15 13:26:04'),
(56, 60, 2, '2015-10-15 17:38:07', '2015-10-15 17:38:07'),
(57, 61, 1, '2015-10-15 17:38:50', '2015-10-15 17:38:50'),
(58, 62, 1, '2015-10-16 11:19:49', '2015-10-16 11:19:49'),
(59, 63, 1, '2015-10-16 11:41:25', '2015-10-16 11:41:25'),
(60, 64, 1, '2015-10-16 13:17:22', '2015-10-16 13:17:22'),
(61, 65, 2, '2015-10-16 13:24:08', '2015-10-16 13:24:08'),
(62, 66, 3, '2015-10-16 13:50:35', '2015-10-16 13:50:35'),
(63, 67, 3, '2015-10-18 06:44:40', '2015-10-18 06:44:40'),
(64, 68, 5, '2015-10-18 06:48:31', '2015-10-18 06:48:31'),
(65, 69, 5, '2015-10-18 06:59:34', '2015-10-18 06:59:34'),
(66, 70, 5, '2015-10-18 07:01:33', '2015-10-18 07:01:33'),
(67, 71, 5, '2015-10-18 07:20:02', '2015-10-18 07:20:02'),
(68, 72, 2, '2015-10-18 07:37:43', '2015-10-18 07:37:43'),
(69, 73, 1, '2015-10-18 07:40:00', '2015-10-18 07:40:00'),
(70, 74, 1, '2015-10-19 12:00:14', '2015-10-19 12:00:14'),
(71, 75, 1, '2015-10-19 12:13:30', '2015-10-19 12:13:30'),
(72, 76, 1, '2015-10-19 12:39:08', '2015-10-19 12:39:08'),
(73, 77, 1, '2015-10-19 12:39:30', '2015-10-19 12:39:30'),
(74, 78, 1, '2015-10-19 12:39:58', '2015-10-19 12:39:58'),
(75, 79, 1, '2015-10-19 12:42:14', '2015-10-19 12:42:14'),
(76, 80, 1, '2015-10-19 12:45:05', '2015-10-19 12:45:05'),
(77, 81, 1, '2015-10-19 12:45:41', '2015-10-19 12:45:41'),
(78, 82, 1, '2015-10-19 12:47:50', '2015-10-19 12:47:50'),
(79, 83, 1, '2015-10-19 12:48:15', '2015-10-19 12:48:15'),
(80, 84, 1, '2015-10-19 12:49:41', '2015-10-19 12:49:41'),
(81, 85, 1, '2015-10-19 12:50:00', '2015-10-19 12:50:00'),
(82, 86, 1, '2015-10-19 12:58:11', '2015-10-19 12:58:11'),
(83, 87, 2, '2015-10-19 14:47:22', '2015-10-19 14:47:22'),
(84, 88, 1, '2015-10-19 15:50:01', '2015-10-19 15:50:01'),
(85, 89, 2, '2015-10-19 15:56:38', '2015-10-19 15:56:38'),
(86, 90, 2, '2015-10-19 16:10:34', '2015-10-19 16:10:34'),
(87, 91, 2, '2015-10-19 16:11:21', '2015-10-19 16:11:21'),
(88, 92, 2, '2015-10-19 17:06:53', '2015-10-19 17:06:53'),
(89, 93, 1, '2015-10-20 17:06:00', '2015-10-20 17:06:00'),
(90, 94, 1, '2015-10-21 15:48:30', '2015-10-21 15:48:30'),
(91, 95, 1, '2015-10-28 12:27:12', '2015-10-28 12:27:12'),
(92, 96, 1, '2015-10-29 13:35:59', '2015-10-29 13:35:59'),
(93, 97, 2, '2015-10-29 13:39:13', '2015-10-29 13:39:13'),
(94, 98, 5, '2015-10-29 13:41:38', '2015-10-29 13:41:38'),
(95, 99, 3, '2015-10-29 13:45:35', '2015-10-29 13:45:35'),
(96, 100, 5, '2015-10-29 13:49:34', '2015-10-29 13:49:34'),
(97, 101, 5, '2015-10-29 13:51:14', '2015-10-29 13:51:14'),
(98, 102, 2, '2015-10-29 14:03:06', '2015-10-29 14:03:06'),
(99, 103, 1, '2015-10-30 12:20:19', '2015-10-30 12:20:19'),
(100, 104, 1, '2015-10-30 12:21:19', '2015-10-30 12:21:19'),
(101, 105, 1, '2015-11-03 18:29:52', '2015-11-03 18:29:52'),
(102, 106, 1, '2015-11-04 04:44:21', '2015-11-04 04:44:21'),
(103, 107, 2, '2015-11-04 12:09:59', '2015-11-04 12:09:59'),
(104, 108, 3, '2015-11-06 10:35:37', '2015-11-06 10:35:37'),
(105, 109, 1, '2015-11-06 10:55:08', '2015-11-06 10:55:08'),
(106, 110, 3, '2015-11-06 11:00:33', '2015-11-06 11:24:29'),
(107, 111, 2, '2015-11-06 11:14:02', '2015-11-06 11:14:02'),
(108, 112, 1, '2015-11-06 11:26:21', '2015-11-06 11:26:21'),
(109, 113, 2, '2015-11-06 12:33:44', '2015-11-06 12:33:44'),
(110, 114, 3, '2015-11-06 12:36:08', '2015-11-06 12:36:08'),
(111, 115, 3, '2015-11-06 12:36:38', '2015-11-06 12:36:38'),
(112, 116, 1, '2015-11-06 12:38:31', '2015-11-06 12:38:31'),
(113, 117, 1, '2015-11-07 08:38:31', '2015-11-07 08:38:31'),
(114, 118, 3, '2015-11-07 13:38:33', '2015-11-07 13:38:33'),
(115, 119, 1, '2015-11-10 11:28:17', '2015-11-10 11:28:17'),
(116, 120, 1, '2015-11-10 12:34:42', '2015-11-10 12:34:42'),
(117, 121, 1, '2015-11-10 12:57:50', '2015-11-10 12:57:50'),
(118, 122, 3, '2015-11-10 13:54:35', '2015-11-10 13:54:35'),
(119, 123, 2, '2015-11-10 16:39:53', '2015-11-10 16:39:53'),
(120, 124, 2, '2015-11-10 16:39:54', '2015-11-10 16:39:54'),
(121, 125, 2, '2015-11-10 17:09:45', '2015-11-10 17:09:45'),
(122, 126, 1, '2015-11-18 10:23:24', '2015-11-18 10:23:24'),
(123, 127, 1, '2015-11-18 12:15:14', '2015-11-18 12:15:14'),
(124, 128, 3, '2015-11-18 12:55:27', '2015-11-18 12:55:27'),
(125, 129, 1, '2015-11-19 12:04:51', '2015-11-19 12:04:51'),
(126, 130, 2, '2015-11-19 12:07:31', '2015-11-19 12:07:31'),
(127, 131, 3, '2015-11-19 12:14:31', '2015-11-19 12:14:31'),
(128, 132, 5, '2015-11-19 12:15:42', '2015-11-19 12:15:42'),
(129, 133, 2, '2015-11-19 12:24:09', '2015-11-19 12:24:09'),
(130, 134, 1, '2015-11-19 12:34:54', '2015-11-19 12:34:54'),
(131, 135, 1, '2015-11-19 12:47:46', '2015-11-19 12:47:46'),
(132, 136, 2, '2015-11-19 13:18:01', '2015-11-19 13:18:01'),
(133, 137, 1, '2015-11-19 13:21:00', '2015-11-19 13:21:00'),
(134, 138, 2, '2015-11-19 15:53:33', '2015-11-19 15:53:33'),
(135, 139, 1, '2015-11-19 15:55:28', '2015-11-19 15:55:28'),
(136, 140, 1, '2015-11-19 17:09:38', '2015-11-19 17:09:38'),
(137, 141, 1, '2015-11-19 17:46:20', '2015-11-19 17:46:20'),
(138, 142, 1, '2015-11-20 02:56:33', '2015-11-20 02:56:33'),
(139, 143, 1, '2015-11-20 02:57:06', '2015-11-20 02:57:06'),
(140, 144, 1, '2015-11-20 02:57:25', '2015-11-20 02:57:25'),
(141, 145, 1, '2015-11-25 10:47:46', '2015-11-25 10:47:46'),
(142, 146, 3, '2015-11-25 10:50:09', '2015-11-25 10:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `visitor_types`
--

CREATE TABLE IF NOT EXISTS `visitor_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `visitor_types`
--

INSERT INTO `visitor_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Visitor', '2015-08-18 07:16:08', '2015-08-18 07:16:28', NULL),
(2, 'Contractor', '2015-08-18 07:16:58', '2015-08-18 07:16:58', NULL),
(3, 'Student', '2015-08-18 07:17:08', '2015-08-18 07:17:08', NULL),
(5, 'Industrial Tour Group', '2015-09-24 12:16:03', '2015-09-24 12:16:22', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
