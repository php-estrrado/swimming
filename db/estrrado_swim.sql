-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 20, 2023 at 01:25 PM
-- Server version: 5.7.37
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `estrrado_swim`
--

-- --------------------------------------------------------

--
-- Table structure for table `sw_admins`
--

CREATE TABLE `sw_admins` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(256) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `sms_username` varchar(100) DEFAULT NULL,
  `sms_password` varchar(255) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `remember_token` varchar(256) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_admins`
--

INSERT INTO `sw_admins` (`id`, `name`, `email`, `password`, `phone`, `role`, `sms_username`, `sms_password`, `active`, `remember_token`, `created_on`, `modified_on`, `status`) VALUES
(1, 'Administrator', 'admin@estrrado.com', '$2y$10$m/XmEwYqXrB0Z/Nig.t5EupVNzqhPh1ONAWdHNy/aUrZPUDuC5oXq', 5656825556, 1, NULL, NULL, 1, 'XeByqxWBRgCm8Viwn58omYlIot8A72Sw1KSpMuvTAjBXYKtFYnFkO7lvWd1n', '2019-02-08 12:39:20', '2020-10-27 13:03:51', 1),
(2, 'Merlin S', 'merlin@estrrado.com', '$2y$10$Cb.mtd2vFjDW1uTizaRoC.gdRGHGLREXZCpQ3x1Vw9DtbzlKhi5mC', 9855555555, 1, NULL, NULL, 1, 'TwDOTHLKLgK1jYtmHLsOxqLk0GDPsr9inmVa1iPqzTYs7WKBhvP31VSCQ5wv', '2019-02-08 12:39:20', '2021-05-11 23:10:58', 1),
(3, 'Vijith', 'vijith@estrrado.com', '$2y$10$Pr7RazCTkQ3tRswX2QZgr.yGDyC4VR.0vJUzynsHBGa4NcrGKqdeS', 454545489, 1, NULL, NULL, 1, 'SvCWCtCOmHwDR7iBaC0dAujVHQqTomKcP8YQrRyygQJ4WwotA7Dq8TZcSid0', '2019-02-21 13:42:02', '2019-06-09 13:03:02', 1),
(4, 'Vijith', 'vijithvijaydemo@gmail.com', '$2y$10$S4lKLoD3ltVFciX8.eDlKesgOHoD.GzqnnKSdEDV7R1izDG1lFq8e', 4545454545, 2, NULL, NULL, 1, NULL, '2019-02-22 13:00:05', '2019-03-18 11:11:09', 1),
(5, 'ATHIRA SURESH B', 'athira.suresh@estrrado.com', '$2y$10$HbAEg71Km5xTdHoHUOBpS.B5L7PSEGcZ6Jdfk24XbRff19g2F7Oda', 554545465456, 2, NULL, NULL, 1, NULL, '2019-02-23 07:12:32', '2019-04-22 08:16:43', 1),
(8, 'Visak', 'visak@estrrado.com', '$2y$10$tQrmnfAqPLQRXOvb/KH8AehBej.UiwA0psZBgOGYszQlg.ozuAz8.', 464646464649, 1, NULL, NULL, 1, NULL, '2019-03-12 12:56:35', '2019-04-01 11:00:29', 1),
(10, 'Test', 'test@test.test', '$2y$10$AJJvF5tcf.JqPSVCFr/Gm.iVPGp0fel5Xu4rRg0Jq4p0GbhicpxJm', 6465764747, 1, NULL, NULL, 1, NULL, '2019-05-13 10:16:18', '2019-05-13 10:17:31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_admin_password_resets`
--

CREATE TABLE `sw_admin_password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(256) NOT NULL,
  `token` varchar(256) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_admin_password_resets`
--

INSERT INTO `sw_admin_password_resets` (`id`, `email`, `token`, `created_at`) VALUES
(9, 'merlin@estrrado.com', '', '2019-11-22 09:43:09');

-- --------------------------------------------------------

--
-- Table structure for table `sw_admin_role`
--

CREATE TABLE `sw_admin_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(55) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_admin_role`
--

INSERT INTO `sw_admin_role` (`id`, `role_name`, `description`, `status`) VALUES
(1, 'Super Admin', 'Super admin can manage everything', 1),
(2, 'Admin', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_badges`
--

CREATE TABLE `sw_badges` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `description` varchar(155) DEFAULT NULL,
  `badge_img` varchar(55) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_badges`
--

INSERT INTO `sw_badges` (`id`, `title`, `description`, `badge_img`, `active`, `status`) VALUES
(1, 'Bronze', NULL, '/app/public/Courses/Badges/bronze.png', 1, 1),
(2, 'Silver', 'Silver', '/app/public/Courses/Badges/silver.png', 1, 1),
(3, 'Gold', NULL, '/app/public/Courses/Badges/gold.png', 1, 0),
(4, 'sss', 'as', '/app/public/Courses/Badges/sss.jpg', 1, 0),
(5, 'PLATINUM', NULL, '/app/public/Courses/Badges/PLATINUM.jpg', 1, 0),
(6, 'ruby', 'ruby badges', '/app/public/Courses/Badges/ruby.jpg', 1, 1),
(7, 'test badge', 'test badge description', '/app/public/Courses/Badges/test badge.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sw_banner`
--

CREATE TABLE `sw_banner` (
  `id` int(11) NOT NULL,
  `identifier` varchar(55) NOT NULL,
  `title` varchar(150) NOT NULL,
  `type` varchar(15) NOT NULL DEFAULT 'image',
  `banner` varchar(35) NOT NULL,
  `description` text,
  `sort` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_banner`
--

INSERT INTO `sw_banner` (`id`, `identifier`, `title`, `type`, `banner`, `description`, `sort`, `active`, `created`, `modified`, `status`) VALUES
(1, 'banner1', 'Banner Image 1', 'image', 'banner1.jpg', '<h3>BECOME A BETTER SWIMMER</h3>\r\n<p>Find the techniques and fine points that will help you individualize your stroke performance for better performance.</p>\r\n', 1, 1, '2019-02-01 15:51:12', '2019-11-18 08:50:49', 1),
(2, 'banner2', 'Banner Image 2', 'image', 'banner2_1555312190.jpg', '<h3>One solution for your all <br>your daily operations.</h3>\r\n<a class=\"btn btn-lg btn-theme mb-2\" href=\"{{ url(\'/\') }}/register\">Start Your Free Trial</a>\r\n<p>7-day free trial • No credit card required • Cancel anytime</p>', 2, 1, '2019-02-01 15:51:12', '2019-11-18 08:51:27', 0),
(3, 'banner3', 'Banner Image 3', 'image', 'banner3_1555312205.jpg', '<h3>SIMPLIFY YOUR SALON <br>BOOKING PROCESS</h3>\r\n<p>EVERYTHING YOU NEED</p>\r\n<a class=\"btn btn-lg btn-theme mb-2\" href=\"{{ url(\'/\') }}/register\">Start Your Free Trial</a>\r\n<p>7-day free trial • No credit card required • Cancel anytime</p>', 3, 1, '2019-02-01 15:51:12', '2019-11-18 08:51:33', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sw_chat`
--

CREATE TABLE `sw_chat` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `group` tinyint(4) NOT NULL,
  `name` varchar(55) NOT NULL,
  `member` int(11) NOT NULL,
  `group_img` varchar(150) NOT NULL,
  `last_msg_on` datetime NOT NULL,
  `unread` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `last_update` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_chat`
--

INSERT INTO `sw_chat` (`id`, `created_by`, `created_on`, `group`, `name`, `member`, `group_img`, `last_msg_on`, `unread`, `status`, `last_update`) VALUES
(1, 5, '2019-10-21 14:29:01', 0, '', 1, '', '2019-11-12 14:57:12', '', 1, '2019-11-12 09:27:12'),
(2, 142, '2019-10-23 14:54:05', 0, '', 1, '', '2019-10-23 14:56:26', '', 1, '2019-10-23 09:26:26'),
(3, 6, '2019-10-23 15:14:01', 0, '', 1, '', '2019-10-30 19:05:04', '', 1, '2019-10-30 13:35:04'),
(21, 289, '2019-12-10 17:53:07', 0, '', 293, '', '2019-12-10 17:56:44', '', 1, '2019-12-10 12:26:44'),
(5, 152, '2019-10-27 21:03:01', 0, '', 1, '', '2020-10-22 18:37:36', '', 1, '2020-10-22 13:07:36'),
(6, 176, '2019-10-31 14:39:58', 0, '', 1, '', '2019-10-31 15:14:48', '', 1, '2019-10-31 09:44:48'),
(7, 139, '2019-11-06 08:50:57', 0, '', 1, '', '2019-11-06 08:51:02', '', 1, '2019-11-06 03:21:02'),
(8, 212, '2019-11-07 15:39:18', 0, '', 210, '', '2019-11-07 15:41:13', '', 1, '2019-11-07 10:11:13'),
(9, 209, '2019-11-07 16:47:42', 0, '', 1, '', '2019-11-08 11:58:24', '', 1, '2019-11-08 06:28:24'),
(10, 224, '2019-11-14 16:09:25', 0, '', 210, '', '2019-11-14 16:09:39', '', 1, '2019-11-14 10:39:39'),
(11, 204, '2019-11-18 17:14:43', 0, '', 1, '', '2021-05-12 04:42:38', '', 1, '2021-05-11 23:12:38'),
(12, 204, '2019-11-18 17:15:33', 0, '', 210, '', '2019-12-03 18:48:14', '', 1, '2019-12-03 13:18:14'),
(13, 238, '2019-11-20 17:33:56', 0, '', 210, '', '0000-00-00 00:00:00', '', 1, NULL),
(14, 2, '2019-11-28 15:49:54', 0, '', 1, '', '2020-10-16 20:39:21', '', 1, '2020-10-16 15:09:21'),
(15, 268, '2019-12-03 15:32:52', 0, '', 267, '', '2019-12-03 15:38:34', '', 1, '2019-12-03 10:08:34'),
(16, 259, '2019-12-04 14:25:02', 0, '', 1, '', '0000-00-00 00:00:00', '', 1, NULL),
(17, 273, '2019-12-05 18:03:11', 0, '', 225, '', '2019-12-05 18:09:13', '', 1, '2019-12-05 12:39:13'),
(18, 270, '2019-12-06 10:44:31', 0, '', 210, '', '2019-12-06 11:29:32', '', 1, '2019-12-06 05:59:32'),
(19, 168, '2019-12-06 17:26:53', 0, '', 1, '', '2019-12-07 14:20:23', '', 1, '2019-12-07 08:50:23'),
(20, 278, '2019-12-06 17:44:27', 0, '', 1, '', '2019-12-07 14:17:07', '', 1, '2019-12-07 08:47:07'),
(22, 1, '2019-12-10 22:30:21', 0, '', 221, '', '2021-05-12 04:43:07', '', 1, '2021-05-11 23:13:07'),
(23, 1, '2019-12-16 15:39:33', 0, '', 141, '', '0000-00-00 00:00:00', '', 1, NULL),
(24, 302, '2020-10-22 12:45:46', 0, '', 306, '', '2020-10-22 12:45:49', '', 1, '2020-10-22 07:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `sw_chat_members`
--

CREATE TABLE `sw_chat_members` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `exit` tinyint(4) NOT NULL,
  `delete` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_chat_members`
--

INSERT INTO `sw_chat_members` (`id`, `chat_id`, `user_id`, `exit`, `delete`, `status`) VALUES
(1, 1, 1, 0, 0, 1),
(2, 2, 1, 0, 0, 1),
(3, 3, 1, 0, 0, 1),
(21, 21, 293, 0, 0, 1),
(5, 5, 1, 0, 0, 1),
(6, 6, 1, 0, 0, 1),
(7, 7, 1, 0, 0, 1),
(8, 8, 210, 0, 0, 1),
(9, 9, 1, 0, 0, 1),
(10, 10, 210, 0, 0, 1),
(11, 11, 1, 0, 0, 1),
(12, 12, 210, 0, 0, 1),
(13, 13, 210, 0, 0, 1),
(14, 14, 1, 0, 0, 1),
(15, 15, 267, 0, 0, 1),
(16, 16, 1, 0, 0, 1),
(17, 17, 225, 0, 0, 1),
(18, 18, 210, 0, 0, 1),
(19, 19, 1, 0, 0, 1),
(20, 20, 1, 0, 0, 1),
(22, 22, 221, 0, 0, 1),
(23, 23, 141, 0, 0, 1),
(24, 24, 306, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_chat_messages`
--

CREATE TABLE `sw_chat_messages` (
  `id` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `message` blob NOT NULL,
  `edited` tinyint(4) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `read_by` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `noticed` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sw_chat_messages`
--

INSERT INTO `sw_chat_messages` (`id`, `chat_id`, `from`, `to`, `message`, `edited`, `deleted`, `created_on`, `read_by`, `status`, `noticed`) VALUES
(1, 1, 5, 1, 0x4869, 0, 0, '2019-10-21 14:59:29', '', 1, 1),
(2, 1, 1, 5, 0x4869, 0, 0, '2019-10-21 15:27:19', '', 1, 1),
(3, 1, 5, 1, 0x486f772061726520796f75, 0, 0, '2019-10-21 15:31:09', '', 1, 1),
(4, 1, 1, 5, 0x48656c6c6f77, 0, 0, '2019-10-22 15:32:16', '', 1, 1),
(5, 2, 142, 1, 0x68656c6c6f, 0, 0, '2019-10-23 14:56:26', '', 1, 1),
(6, 3, 6, 1, 0x68656c6c6f, 0, 0, '2019-10-23 15:14:10', '', 1, 1),
(7, 3, 6, 1, 0x737a7a6b7a6b767a6b6273626b7320636865656b20444a20746861742074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e2074686520666f722073616c6520616e642074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e20696e20696e2074686520666f722073616c6520696e20696e20696e2074686520666f7220746f2065682079797920696e2061207768696c652061676f20627574206e6576657220696e206d792066697273742074696d65204920444a2074686174204920444a20696620756e646f204c4a2074686520666f7220746f206c6f6e672062656163682043616c69666f726e696120737461746520756e697665727369747920636f6c6c656765204475626c696e20776865726520746f206568207979792073686f7020696e207468652066757475726520706c65617365207573652074686973206c696e6b20666f7220746865204c656520636f756e747920696e207768696368204920444a2065616368206f74686572207768656e20796f75206765742074686520666f7220746f20696e20696e206f6d20666f7220746f206c6f6e672049736c616e64204e59204e5920746f20656820656820696e20696e20696e207468652066757475726520706c6561736520757365207468697320656d61696c20697320696e74656e646564206f6e6c7920746f207468652066757475726520706c6561736520757365206d79206e6577206164647265737320666f72207468652066757475726520616e6420746865204c65652066616d696c7920696e20746f776e20666f722073616c6520616e64206861732065766572207365656e20666f722074686520667574757265206f662066617368696f6e20746f206c6f6e6720696e2067657474696e6720746865204c6565, 0, 0, '2019-10-25 14:50:40', '', 1, 1),
(8, 3, 6, 1, 0x6868626868, 0, 0, '2019-10-26 10:58:43', '', 1, 1),
(9, 1, 5, 1, 0x686f772061726520796f75, 0, 0, '2019-10-26 14:37:06', '', 1, 1),
(10, 1, 5, 1, 0x6669656c64696e67, 0, 0, '2019-10-26 14:44:34', '', 1, 1),
(11, 1, 5, 1, 0x46756a6966696c6d, 0, 0, '2019-10-26 14:44:38', '', 1, 1),
(12, 1, 5, 1, 0x6b616c636e6c736e636d, 0, 0, '2019-10-26 14:44:47', '', 1, 1),
(13, 5, 152, 1, 0x6a69, 0, 0, '2019-10-27 21:03:06', '', 1, 1),
(14, 3, 6, 1, 0x6467776865672061757468656e7469632048617774686f726e65206375746f6666204361726c73626164206c6561726e206f776e2044656e6d61726b206d79206d6f756e74207a65627261, 0, 0, '2019-10-28 15:02:08', '', 1, 1),
(15, 3, 6, 1, 0x682068206820682068206820756e7520696d696d6f6f0a692e692e692e692e692e692e692e692e692e692e692e692e692e692e696d692e20752075207520752075207520752075207520752075207520756e756e756e756e756e696e756e696e, 0, 0, '2019-10-28 18:29:42', '', 1, 1),
(16, 3, 6, 1, 0x4023c2a35f262d2b292f25c2aee29c93c2aec2a25b5d7d5c3dc2a2c2a57e60e2889acf80c397e288863dc2b07d3dc2a97c7bc2b0247d7c3dc2b6c2a2c2b0c397c2a2c2b0c3b7257cc2a27ce29c935c5bc2a27b245c3d24c2b6cf807cc397e282ace29c93283b22393b33293b5f2d5f392d23263723325f26c2a3333726c2a3383a2a3fc2a33b222822282330222b283b402a29273b22323b283bc2a3c2a32dc2a32d38c2a33b38c2a32d282d2229c2a3, 0, 0, '2019-10-28 18:30:03', '', 1, 1),
(17, 3, 6, 1, 0x68656c6c6f, 0, 0, '2019-10-29 14:23:26', '', 1, 1),
(18, 3, 6, 1, 0x6d65726c, 0, 0, '2019-10-29 15:19:34', '', 1, 1),
(19, 3, 6, 1, 0x736574, 0, 0, '2019-10-30 17:09:28', '', 1, 1),
(20, 3, 6, 1, 0x73657474696e67, 0, 0, '2019-10-30 17:09:42', '', 1, 1),
(21, 3, 6, 1, 0x7465727376757320676479736764756520686475736a736773752073797375736864676476796420756475736873687375646864206468647564687768796873732064796479647964756468646964756562647967786a6462206475647568736864696469646a6420646864686468646864666866647964207368647564686468686620696e20696e2074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e20696e2074686520666f722073616c6520696e2074686520667574757265206f662066617368696f6e20746563686e6f6c6f677920636f206c74642054656c204176697620616e6420686173206e6f20656666656374206f6e207468652066757475726520706c6561736520756e737562736372696265206d652074686520666f722073616c6520696e, 0, 0, '2019-10-30 17:10:35', '', 1, 1),
(22, 1, 5, 1, 0x48656c6c6f, 0, 0, '2019-10-30 18:04:41', '', 1, 1),
(23, 1, 5, 1, 0x476f6f64, 0, 0, '2019-10-30 18:13:23', '', 1, 1),
(24, 1, 5, 1, 0x536565207520746f6d6f72726f77, 0, 0, '2019-10-30 18:28:51', '', 1, 1),
(25, 1, 5, 1, 0x48656c6c6f20686f772061726520796f75, 0, 0, '2019-10-30 18:50:24', '', 1, 1),
(26, 3, 6, 1, 0x68656c6c6f6f, 0, 0, '2019-10-30 19:05:04', '', 1, 1),
(27, 1, 5, 1, 0x56767676, 0, 0, '2019-10-31 13:32:45', '', 1, 1),
(28, 1, 5, 1, 0x5361736920736f6d616e, 0, 0, '2019-10-31 13:33:24', '', 1, 1),
(29, 1, 5, 1, 0x547970652041204d657373616765, 0, 0, '2019-10-31 13:33:31', '', 1, 1),
(30, 1, 5, 1, 0x547970652041204d657373616765, 0, 0, '2019-10-31 13:33:45', '', 1, 1),
(31, 1, 5, 1, 0x547970652041204d657373616765, 0, 0, '2019-10-31 13:33:52', '', 1, 1),
(32, 1, 5, 1, 0x547970652041204d657373616765, 0, 0, '2019-10-31 13:34:07', '', 1, 1),
(33, 1, 5, 1, 0x486920626f62, 0, 0, '2019-10-31 13:54:27', '', 1, 1),
(34, 1, 5, 1, 0x546f20636f616368, 0, 0, '2019-10-31 14:14:30', '', 1, 1),
(35, 1, 5, 1, 0x48656c6c6f, 0, 0, '2019-10-31 14:14:43', '', 1, 1),
(36, 1, 5, 1, 0x426f62, 0, 0, '2019-10-31 14:14:55', '', 1, 1),
(37, 6, 176, 1, 0x6869, 0, 0, '2019-10-31 14:56:28', '', 1, 1),
(38, 6, 176, 1, 0x6d65726c, 0, 0, '2019-10-31 15:14:48', '', 1, 1),
(39, 1, 5, 1, 0x546767676767, 0, 0, '2019-11-05 13:21:06', '', 1, 1),
(40, 7, 139, 1, 0x4869, 0, 0, '2019-11-06 08:51:02', '', 1, 1),
(41, 8, 212, 210, 0x74657374696e67206d7367, 0, 0, '2019-11-07 15:39:53', '', 1, 1),
(42, 8, 212, 210, 0x787878787878, 0, 0, '2019-11-07 15:41:13', '', 1, 1),
(43, 9, 209, 1, 0x62692063797675, 0, 0, '2019-11-08 11:58:09', '', 1, 1),
(44, 9, 209, 1, 0x62786b627a6c62736e736f, 0, 0, '2019-11-08 11:58:24', '', 1, 1),
(45, 1, 5, 1, 0x46696e65, 0, 0, '2019-11-12 14:57:12', '', 1, 1),
(46, 10, 224, 210, 0x6869, 0, 0, '2019-11-14 16:09:39', '', 1, 1),
(47, 11, 204, 1, 0x4869, 0, 0, '2019-11-18 17:14:46', '', 1, 1),
(48, 11, 204, 1, 0x48656c6c6f, 0, 0, '2019-11-18 17:14:52', '', 1, 1),
(49, 11, 204, 1, 0x486f77, 0, 0, '2019-11-18 17:15:00', '', 1, 1),
(50, 12, 204, 210, 0x4869, 0, 0, '2019-11-18 17:15:35', '', 1, 1),
(51, 12, 204, 210, 0xf09f918b, 0, 0, '2019-11-18 17:15:41', '', 1, 1),
(52, 11, 204, 1, 0x4173204d69636861656c20486172766579207772697465732c20706172616772617068732061726520e2809c696e20657373656e6365e280946120666f726d206f662070756e6374756174696f6e2c20616e64206c696b65206f7468657220666f726d73206f662070756e6374756174696f6e207468657920617265206d65616e7420746f206d616b65207772697474656e206d6174657269616c206561737920746f20726561642ee2809d5b315d20456666656374697665207061726167726170687320617265207468652066756e64616d656e74616c20756e697473206f662061636164656d69632077726974696e673b20636f6e73657175656e746c792c207468652074686f7567687466756c2c206d756c74696661636574656420617267756d656e7473207468617420796f75722070726f666573736f72732065787065637420646570656e64206f6e207468656d2e20576974686f757420676f6f6420706172616772617068732c20796f752073696d706c792063616e6e6f7420636c6561726c7920636f6e7665792073657175656e7469616c20706f696e747320616e642074686569722072656c6174696f6e736869707320746f206f6e6520616e6f746865722e200a0a4d616e79206e6f7669636520777269746572732074656e6420746f206d616b6520612073686172702064697374696e6374696f6e206265747765656e20636f6e74656e7420616e64207374796c652c207468696e6b696e67207468617420612070617065722063616e206265207374726f6e6720696e206f6e6520616e64207765616b20696e20746865206f746865722c2062757420666f637573696e67206f6e206f7267616e697a6174696f6e2073686f777320686f7720636f6e74656e7420616e64207374796c6520636f6e766572676520696e2064656c6962657261746976652061636164656d69632077726974696e672e20596f75722070726f666573736f72732077696c6c2076696577206576656e20746865206d6f737420656c6567616e742070726f73652061732072616d626c696e6720616e6420746564696f75732069662074686572652069736ee28099742061206361726566756c2c20636f686572656e7420617267756d656e7420746f2067697665207468652074657874206d65616e696e672e2050617261677261706873206172652074686520e2809c737475666620e2809d206f662061636164656d69632077726974696e6720616e642c20746875732c20776f727468206f757220617474656e74696f6e20686572652e, 0, 0, '2019-11-18 17:17:05', '', 1, 1),
(53, 11, 204, 1, 0x6869, 0, 0, '2019-11-22 11:03:12', '', 1, 1),
(54, 14, 2, 1, 0x6b69, 0, 0, '2019-11-28 16:41:03', '', 1, 1),
(55, 14, 1, 2, 0x6767, 0, 0, '2019-11-28 16:41:39', '', 1, 1),
(56, 14, 2, 1, 0x666666, 0, 0, '2019-11-28 16:41:45', '', 1, 1),
(57, 14, 1, 2, 0x66736166, 0, 0, '2019-11-28 16:41:49', '', 1, 1),
(58, 14, 2, 1, 0x6767, 0, 0, '2019-11-28 17:09:27', '', 1, 1),
(59, 14, 1, 2, 0x4c6f72656d20497073756d2069732073696d706c792064756d6d792074657874206f6620746865207072696e74696e6720616e64207479706573657474696e6720696e6475737472792e204c6f72656d20497073756d20686173206265656e2074686520696e6475737472792773207374616e646172642064756d6d79207465787420657665722073696e636520746865203135303073, 0, 0, '2019-11-28 17:36:42', '', 1, 1),
(60, 14, 2, 1, 0xf09f988af09f9889f09f98a3f09f9899f09f988df09f988bf09f989d, 0, 0, '2019-11-28 17:37:42', '', 1, 1),
(61, 14, 2, 1, 0xf09f9889f09f988df09f988bf09f9899f09f989df09f9899f09f989df09f9889f09f988bf09f989af09f988df09f988af09f9884f09f9885e29bb9efb88ff09f9282e29bb9efb88ff09f9ab6e29bb9efb88ff09f9ab6f09f91bcf09f9287f09f91bcf09f91b8f09f9286f09f91bcf09f9ab6f09f9282f09f9286f09f8f8af09f91b8f09f8cb2e29b84f09f92aef09f8c80e29898efb88fe29b84f09f8c80f09f8d83f09f8d94f09f8d8cf09f8d8ff09f8d97f09f8d9ff09f90bef09f8d8df09f8d8d, 0, 0, '2019-11-28 17:38:02', '', 1, 1),
(62, 14, 1, 2, 0x576f77, 0, 0, '2019-11-28 17:38:19', '', 0, 1),
(63, 15, 268, 267, 0x4465, 0, 0, '2019-12-03 15:32:57', '', 1, 1),
(64, 15, 267, 268, 0x6f6b, 0, 0, '2019-12-03 15:37:42', '', 1, 1),
(65, 15, 267, 268, 0x6869, 0, 0, '2019-12-03 15:37:57', '', 1, 1),
(66, 15, 268, 267, 0x4869, 0, 0, '2019-12-03 15:38:11', '', 1, 0),
(67, 15, 267, 268, 0x6f6b0a706b, 0, 0, '2019-12-03 15:38:34', '', 1, 1),
(68, 11, 204, 1, 0x686f, 0, 0, '2019-12-03 15:58:56', '', 1, 1),
(69, 11, 204, 1, 0x6869, 0, 0, '2019-12-03 16:00:38', '', 1, 1),
(70, 11, 1, 204, 0x68656c6c650a666c6b6d6b666c6e6d0a676668676866676866, 0, 0, '2019-12-03 16:01:05', '', 1, 1),
(71, 11, 1, 204, 0x6a676867686a67686a, 0, 0, '2019-12-03 16:01:16', '', 1, 1),
(72, 11, 1, 204, 0x6a68676a6768, 0, 0, '2019-12-03 16:01:20', '', 1, 1),
(73, 11, 1, 204, 0x686a67686a6768, 0, 0, '2019-12-03 16:02:04', '', 1, 1),
(74, 11, 1, 204, 0x74797579757479757479, 0, 0, '2019-12-03 16:02:19', '', 1, 1),
(75, 11, 1, 204, 0x7574757974, 0, 0, '2019-12-03 16:02:21', '', 1, 1),
(76, 11, 1, 204, 0x79757479757475697479, 0, 0, '2019-12-03 16:02:25', '', 1, 1),
(77, 11, 1, 204, 0x53, 0, 0, '2019-12-03 16:03:03', '', 1, 1),
(78, 11, 1, 204, 0x69, 0, 0, '2019-12-03 16:03:12', '', 1, 1),
(79, 11, 1, 204, 0x6d, 0, 0, '2019-12-03 16:03:16', '', 1, 1),
(80, 11, 1, 204, 0x69, 0, 0, '2019-12-03 16:03:19', '', 1, 1),
(81, 11, 204, 1, 0x7a68207a6862796e7368732e6a6d7a6a6d7a6a6d7a756d7a756d7a6a6d7a6a6e756261756162737568736e6a62736a6e73756e73756e73756e736e757375736e756e73756e736a6e73756e73, 0, 0, '2019-12-03 17:45:02', '', 1, 1),
(82, 12, 204, 210, 0xf09f8f86f09f96a4f09f8f86f09f96a4f09f8f86f09f8d92e2998af09f8d92e2998af09f8f86f09f96a4f09f8f86f09f8d92f09fa592f09f8d92f09f8d92f09fa592f09f8d92f09fa592f09f8d85f09fa592f09f8d85f09fa592f09f8d85f09f8d85f09fa592f09f8d85f09fa592f09f8d85f09f8d85f09fa592f09f8d85f09fa592f09f8d85f09f8d85f09fa592f09f8d85f09fa592f09f8d85f09f8d85f09fa592f09f8d85f09f8f86e2998af09f8d92f09f8d8df09f8f86f09f8d8df09f8d92f09f8d8df09f8d92f09f8d92f09f8d85f09f8d85f09f8d8df09f8d85f09fa592f09f8d85f09f9bb5e29992f09f9bb5f09f9bb5e29992f09fa592f09f9bb5f09f8d85f09fa592f09f8d85f09f8d8df09f8d85f09f8d85f09f8d8df09f8d85f09f8d8df09f8d85f09f8d8df09f8d85f09fa592f09f8d85f09f8e83e29992f09f8f86f09f8d92f09f9ba2efb88ff09f8d92f09fa592f09f8d92f09f8d92f09fa592f09f8d85f09f8d92f09f8d85, 0, 0, '2019-12-03 17:46:39', '', 1, 1),
(83, 11, 1, 204, 0x687474703a2f2f6d7961707074656d706c617465732e636f6d2f73696d706c652d616e64726f69642d636861742d6170702d70617273652d696e746567726174696f6e2d7475746f7269616c2f, 0, 0, '2019-12-03 17:48:59', '', 1, 1),
(84, 12, 204, 210, 0x6862206962736f, 0, 0, '2019-12-03 18:17:52', '', 1, 1),
(85, 12, 204, 210, 0xf09f9a95e29992f09f8f86f09f948cf09f8e83f09f8d8ff09f8d8d, 0, 0, '2019-12-03 18:18:00', '', 1, 1),
(86, 12, 204, 210, 0xf09f8e8ef09f8e8ef09f8eabf09f8eab, 0, 0, '2019-12-03 18:18:04', '', 1, 1),
(87, 12, 204, 210, 0x6666, 0, 0, '2019-12-03 18:18:55', '', 1, 1),
(88, 12, 204, 210, 0x6464, 0, 0, '2019-12-03 18:18:57', '', 1, 1),
(89, 12, 204, 210, 0x2f636f6e74656e742f74656e6f725f6769662f74656e6f725f676966343839313630383537323837313839333839352e676966, 0, 0, '2019-12-03 18:34:22', '', 1, 1),
(90, 12, 204, 210, 0x7b0a202022617574686f72697479223a207b0a20202020226465636f646564223a2022636f6d2e676f6f676c652e616e64726f69642e696e7075746d6574686f642e6c6174696e2e66696c6570726f7669646572222c0a2020202022656e636f646564223a20224e4f5420434143484544220a20207d2c0a202022667261676d656e74223a207b7d2c0a20202270617468223a207b0a20202020226465636f646564223a20224e4f5420434143484544222c0a2020202022656e636f646564223a20222f636f6e74656e742f74656e6f725f6769662f74656e6f725f676966373637313332343334383339333935323430372e676966220a20207d2c0a2020227175657279223a207b7d2c0a202022736368656d65223a2022636f6e74656e74222c0a202022757269537472696e67223a20224e4f5420434143484544222c0a202022686f7374223a20224e4f5420434143484544222c0a202022706f7274223a202d320a7d, 0, 0, '2019-12-03 18:35:09', '', 1, 1),
(91, 12, 204, 210, 0x7b0a202022636163686564467369223a202d322c0a202022636163686564537369223a20352c0a202022736368656d65223a20226874747073222c0a202022757269537472696e67223a202268747470733a2f2f6d656469612e74656e6f722e636f6d2f696d616765732f36366636656236313433633932346330336231626536396138616365333333392f74656e6f722e676966222c0a202022686f7374223a20224e4f5420434143484544222c0a202022706f7274223a202d320a7d, 0, 0, '2019-12-03 18:35:49', '', 1, 1),
(92, 12, 204, 210, 0x222f696d616765732f63356239633132646233323266633033393532326432366361376632383436632f74656e6f722e67696622, 0, 0, '2019-12-03 18:37:12', '', 1, 1),
(93, 12, 204, 210, 0x7b0a202022636163686564467369223a202d322c0a202022636163686564537369223a20352c0a202022736368656d65223a20226874747073222c0a202022757269537472696e67223a202268747470733a2f2f6d656469612e74656e6f722e636f6d2f696d616765732f63356239633132646233323266633033393532326432366361376632383436632f74656e6f722e676966222c0a202022686f7374223a20224e4f5420434143484544222c0a202022706f7274223a202d320a7d, 0, 0, '2019-12-03 18:41:17', '', 1, 1),
(94, 12, 204, 210, 0x222f696d616765732f63356239633132646233323266633033393532326432366361376632383436632f74656e6f722e67696622, 0, 0, '2019-12-03 18:45:54', '', 1, 1),
(95, 12, 204, 210, 0x7b0a202022636163686564467369223a202d322c0a202022636163686564537369223a20352c0a202022736368656d65223a20226874747073222c0a202022757269537472696e67223a202268747470733a2f2f6d656469612e74656e6f722e636f6d2f696d616765732f63356239633132646233323266633033393532326432366361376632383436632f74656e6f722e676966222c0a202022686f7374223a20224e4f5420434143484544222c0a202022706f7274223a202d320a7d, 0, 0, '2019-12-03 18:47:05', '', 1, 1),
(96, 12, 204, 210, 0x7b0a202022636163686564467369223a202d322c0a202022636163686564537369223a20352c0a202022736368656d65223a20226874747073222c0a202022757269537472696e67223a202268747470733a2f2f6d656469612e74656e6f722e636f6d2f696d616765732f36366636656236313433633932346330336231626536396138616365333333392f74656e6f722e676966222c0a202022686f7374223a20224e4f5420434143484544222c0a202022706f7274223a202d320a7d, 0, 0, '2019-12-03 18:48:14', '', 1, 1),
(97, 11, 1, 204, 0x68656c6c6f0a68656c6c6f, 0, 0, '2019-12-04 09:32:39', '', 1, 1),
(98, 11, 1, 204, 0x636f6d6520696e, 0, 0, '2019-12-04 10:04:33', '', 1, 1),
(99, 11, 1, 204, 0x717765727479, 0, 0, '2019-12-04 10:21:44', '', 1, 1),
(100, 11, 1, 204, 0x6865650a686565, 0, 0, '2019-12-04 15:30:43', '', 1, 1),
(101, 5, 152, 1, 0x48656c6c6f, 0, 0, '2019-12-05 14:19:41', '', 1, 1),
(102, 17, 273, 225, 0x6869206869, 0, 0, '2019-12-05 18:03:19', '', 1, 1),
(103, 17, 225, 273, 0x68696920686969696969, 0, 0, '2019-12-05 18:08:55', '', 1, 1),
(104, 17, 225, 273, 0x6a6b6a686a686a68, 0, 0, '2019-12-05 18:09:13', '', 1, 1),
(105, 17, 273, 225, 0x686969206f6f6f6f6f6f6f6f, 0, 0, '2019-12-05 18:09:13', '', 1, 1),
(106, 18, 270, 210, 0x4368696c64, 0, 0, '2019-12-06 10:45:05', '', 1, 1),
(107, 18, 210, 270, 0x68692068653b6c6f200a6a686b6a680a686b6a686b6a0a6a686a68676a676b6a0a686a676a68670a77696c6c2075757575757575757575757575757575, 0, 0, '2019-12-06 10:45:55', '', 1, 1),
(108, 18, 270, 210, 0x4869, 0, 0, '2019-12-06 11:28:44', '', 1, 1),
(109, 18, 270, 210, 0x426f6220697320676f696e67206f6e206d792064617920746f2065796520f09f91812077697468206d79206d6f6d20746f64617920616e6420686520736169642068652077617320636f6d696e67206f76657220746f64617920746f207175657374696f6e2077686174206865207164696420697320686520776173, 0, 0, '2019-12-06 11:29:03', '', 1, 1),
(110, 18, 210, 270, 0x426f6220697320676f696e67206f6e206d792064617920746f2065796520f09f91812077697468206d79206d6f6d20746f64617920616e6420686520736169642068652077617320636f6d696e67206f76657220746f64617920746f207175657374696f6e2077686174206865207164696420697320686520776173, 0, 0, '2019-12-06 11:29:32', '', 1, 1),
(111, 19, 168, 1, 0x75666878677868, 0, 0, '2019-12-06 17:26:57', '', 1, 1),
(112, 20, 278, 1, 0x416c6c20672068682064, 0, 0, '2019-12-06 17:44:30', '', 1, 1),
(113, 20, 1, 278, 0x6869, 0, 0, '2019-12-07 14:17:07', '', 1, 0),
(114, 19, 1, 168, 0x6869, 0, 0, '2019-12-07 14:20:23', '', 1, 0),
(115, 14, 1, 2, 0x737373, 0, 0, '2019-12-07 14:20:51', '', 1, 1),
(116, 14, 1, 2, 0x68686868, 0, 0, '2019-12-09 17:38:28', '', 1, 1),
(117, 14, 1, 2, 0x6d6d6d6d6d, 0, 0, '2019-12-09 17:38:37', '', 1, 1),
(118, 14, 1, 2, 0x686868, 0, 0, '2019-12-10 09:05:12', '', 1, 1),
(119, 14, 2, 1, 0xf09f9290f09fa580f09f8cb7f09f8cb5f09f8cacefb88ff09f8d82e29898efb88ff09f8cb5f09f8cb7f09f8cb3f09fa580f09f8cb3f09f8cbaf09f8cb5f09f8cb8f09f8cb5f09f8cb8f09f8d83f09f8cbaf09f8d83f09f8cb8f09f8d83, 0, 0, '2019-12-10 11:53:29', '', 1, 1),
(120, 14, 2, 1, 0xf09f8e84f09f8e84f09f8f86f09f8e84f09f8e96efb88ff09f8e84f09f8e96efb88ff09f8e84f09f8e81f09f8e96efb88ff09f8e81f09f8e96efb88f, 0, 0, '2019-12-10 11:53:51', '', 1, 1),
(121, 14, 2, 1, 0xe29bbdf09f9a90f09f9a95e29bbdf09f9a95f09f9a95e29bbdf09f9a93e29bbdf09f9a93e29bbdf09f9a95e29bbdf09f9a95e29bbdf09f9a95f09f9ba2efb88ff09f9a95e29bbdf09f9a8cf09f9ba2efb88fe29bbdf09f9a95e29bbdf09f9a95f09f9a8de29a93f09f9a90, 0, 0, '2019-12-10 11:54:04', '', 1, 1),
(122, 14, 2, 1, 0xf09f9a8cf09f8f86f09f989bf09f9a93e29a93f09f989bf09f8d82f09f9a8cf09f989bf09f8cb8f09f9a8cf09f8f8defb88ff09f989df09f989af09f98a3f09f8e91f09f8d82f09f9b8ce28ca8efb88ff09f8c80f09f8cbbe28ca8efb88fe28ca8efb88f, 0, 0, '2019-12-10 11:54:13', '', 1, 1),
(123, 21, 289, 293, 0x6869207369722c, 0, 0, '2019-12-10 17:55:38', '', 1, 1),
(124, 21, 293, 289, 0x6869692c20686f706520796f75206172652066696e65, 0, 0, '2019-12-10 17:56:15', '', 1, 0),
(125, 21, 293, 289, 0x76627662766276626276626e6e626e6e62, 0, 0, '2019-12-10 17:56:36', '', 1, 0),
(126, 21, 289, 293, 0x636a636b766b766b766b636a6b766b76, 0, 0, '2019-12-10 17:56:44', '', 1, 0),
(127, 5, 1, 152, 0x4869, 0, 0, '2019-12-10 22:24:50', '', 1, 1),
(128, 22, 1, 221, 0x4869, 0, 0, '2019-12-10 22:30:33', '', 1, 0),
(129, 11, 1, 204, 0x5a53646378, 0, 0, '2019-12-11 10:36:17', '', 1, 1),
(130, 11, 204, 1, 0x6869, 0, 0, '2020-01-01 16:26:40', '', 1, 1),
(131, 11, 1, 204, 0x6869, 0, 0, '2020-06-02 20:24:48', '', 1, 0),
(132, 11, 1, 204, 0x6874, 0, 0, '2020-06-02 20:25:05', '', 1, 0),
(133, 22, 1, 221, 0x686b, 0, 0, '2020-06-04 16:01:07', '', 1, 0),
(134, 22, 1, 221, 0x686a6b, 0, 0, '2020-06-04 16:01:17', '', 1, 0),
(135, 22, 1, 221, 0x686868, 0, 0, '2020-06-04 16:01:38', '', 1, 0),
(136, 14, 2, 1, 0xf09f9894, 0, 0, '2020-10-07 10:53:32', '', 1, 0),
(137, 14, 2, 1, 0xf09f9982, 0, 0, '2020-10-12 13:03:33', '', 1, 0),
(138, 5, 152, 1, 0x6869, 0, 0, '2020-10-13 17:04:20', '', 1, 1),
(139, 14, 2, 1, 0x686969696969, 0, 0, '2020-10-16 12:06:33', '', 1, 0),
(140, 14, 2, 1, 0x67696969, 0, 0, '2020-10-16 12:08:24', '', 1, 0),
(141, 14, 2, 1, 0x67696969, 0, 0, '2020-10-16 12:08:25', '', 1, 0),
(142, 5, 152, 1, 0x4869, 0, 0, '2020-10-16 12:10:35', '', 1, 1),
(143, 5, 152, 1, 0x68696969696969696969, 0, 0, '2020-10-16 20:25:21', '', 1, 1),
(144, 5, 152, 1, 0x7470707079797575, 0, 0, '2020-10-16 20:26:26', '', 1, 1),
(145, 5, 152, 1, 0x7465727279, 0, 0, '2020-10-16 20:28:15', '', 1, 1),
(146, 5, 152, 1, 0x796f75206974, 0, 0, '2020-10-16 20:37:14', '', 1, 1),
(147, 14, 2, 1, 0x6869, 0, 0, '2020-10-16 20:38:42', '', 1, 0),
(148, 14, 2, 1, 0x61, 0, 0, '2020-10-16 20:39:20', '', 1, 0),
(149, 14, 2, 1, 0x61, 0, 0, '2020-10-16 20:39:21', '', 1, 0),
(150, 5, 152, 1, 0x686969, 0, 0, '2020-10-16 20:50:52', '', 1, 1),
(151, 5, 152, 1, 0x68656c6c6f6f6f6f, 0, 0, '2020-10-19 09:36:31', '', 1, 1),
(152, 5, 152, 1, 0x6865656c6e646e646a646a64, 0, 0, '2020-10-19 09:36:37', '', 1, 1),
(153, 5, 152, 1, 0x686969, 0, 0, '2020-10-19 20:16:11', '', 1, 1),
(154, 5, 152, 1, 0x74757475, 0, 0, '2020-10-19 20:16:24', '', 1, 1),
(155, 5, 152, 1, 0x746f7572, 0, 0, '2020-10-19 20:17:54', '', 1, 1),
(156, 5, 152, 1, 0x343534353435343535, 0, 0, '2020-10-20 13:10:49', '', 1, 1),
(157, 24, 302, 306, 0x6869, 0, 0, '2020-10-22 12:45:49', '', 1, 0),
(158, 5, 152, 1, 0x6869, 0, 0, '2020-10-22 18:37:36', '', 1, 1),
(159, 22, 1, 221, 0x6869, 0, 0, '2021-05-12 04:42:12', '', 1, 0),
(160, 11, 1, 204, 0x6466, 0, 0, '2021-05-12 04:42:38', '', 1, 0),
(161, 22, 1, 221, 0x6666, 0, 0, '2021-05-12 04:43:07', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sw_cities`
--

CREATE TABLE `sw_cities` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text,
  `state_id` int(11) NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_cities`
--

INSERT INTO `sw_cities` (`id`, `name`, `description`, `state_id`, `active`, `status`) VALUES
(26917, 'Bandar Maharani', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26918, 'Bandar Penggaram', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26919, 'Bukit Bakri', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26920, 'Buloh Kasap', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26921, 'Chaah', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26922, 'Johor Bahru', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26923, 'Kelapa Sawit', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26924, 'Kluang', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26925, 'Kota Tinggi', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2307, 1, 1),
(26927, 'Labis', NULL, 2307, 1, 1),
(48362, 'christnagar', NULL, 2308, 1, 1),
(48363, 'testing', NULL, 2312, 1, 0),
(48364, 'sreerangam', NULL, 2310, 1, 0),
(48365, 'portugal', NULL, 2309, 1, 0),
(48366, 'brazil', NULL, 2309, 1, 1),
(48367, 'abc', NULL, 2307, 1, 0),
(48368, 'Test Location', NULL, 2307, 1, 0),
(48369, 'dvfydguvb', NULL, 2312, 1, 0),
(48370, 'Aries Estrrado Technologies', NULL, 2312, 1, 1),
(48371, 'Vellayambalam', NULL, 2323, 1, 0),
(48372, 'kuala lumpur', NULL, 2307, 1, 1),
(48373, 'marina bay', NULL, 2307, 1, 1),
(48374, 'joh', NULL, 2307, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_contacts`
--

CREATE TABLE `sw_contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` varchar(256) NOT NULL,
  `message` text NOT NULL,
  `reply_count` int(11) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_contacts`
--

INSERT INTO `sw_contacts` (`id`, `name`, `email`, `phone`, `subject`, `message`, `reply_count`, `active`, `sort`, `created_at`, `status`) VALUES
(1, 'Francesvetle', 'angelawrossydrunny@gmail.com', NULL, 'The best advertising of your products and services!', 'Good day!  bizzsalon.com \r\n \r\nWe propose \r\n \r\nSending your commercial proposal through the Contact us form which can be found on the sites in the contact section. Feedback forms are filled in by our application and the captcha is solved. The profit of this method is that messages sent through feedback forms are whitelisted. This technique increases the chances that your message will be read. Mailing is done in the same way as you received this message. \r\nYour  commercial offer will be open by millions of site administrators and those who have access to the sites! \r\n \r\nThe cost of sending 1 million messages is $ 49 instead of $ 99. (you can select any country or country domain) \r\nAll USA - (10 million messages sent) - $399 instead of $699 \r\nAll Europe (7 million messages sent)- $ 299 instead of $599 \r\nAll sites in the world (25 million messages sent) - $499 instead of $999 \r\nThere is a possibility of FREE TEST MAILING. \r\n \r\nDiscounts are valid until May 10. \r\nFeedback and warranty! \r\nDe', 0, 1, 0, '2019-05-08 07:41:00', 1),
(2, 'Aly Chiman', 'aly1@alychidesigns.com', NULL, 'Broken Links Update', 'Hello there, My name is Aly and I would like to know if you would have any interest to have your website here at bizzsalon.com  promoted as a resource on our blog alychidesign.com ?\r\n\r\n We are  updating our do-follow broken link resources to include current and up to date resources for our readers. If you may be interested in being included as a resource on our blog, please let me know.\r\n\r\n Thanks, Aly', 0, 1, 0, '2019-06-10 19:56:08', 1),
(3, 'Winston', 'roseqvah57@thefirstpageplan.com', NULL, 'Nice site, quick question...', 'Hey guys, I just wanted to see if you need anything in the way of site editing/code fixing/programming, unique blog post material, extra traffic, social media management, etc.  I have quite a few ways I can set all of this and do thhis for you.  Don\'t mean to impose, was just curious, I\'ve been doing thhis for some time and was just curious if you needed an extra hand. I can even do Wordpress and other related tasks (you name it).\r\n\r\nPS - I\'m here in the states, no need to outsource :-)\r\n\r\nWinston R.\r\n1.708.320.3171', 0, 1, 0, '2019-10-04 11:18:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_contact_reply`
--

CREATE TABLE `sw_contact_reply` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `reply_by` int(11) NOT NULL,
  `reply_message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sw_countries`
--

CREATE TABLE `sw_countries` (
  `id` int(11) NOT NULL,
  `sortname` varchar(3) NOT NULL,
  `name` varchar(150) NOT NULL,
  `phonecode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sw_countries`
--

INSERT INTO `sw_countries` (`id`, `sortname`, `name`, `phonecode`) VALUES
(1, 'AF', 'Afghanistan', 93),
(2, 'AL', 'Albania', 355),
(3, 'DZ', 'Algeria', 213),
(4, 'AS', 'American Samoa', 1684),
(5, 'AD', 'Andorra', 376),
(6, 'AO', 'Angola', 244),
(7, 'AI', 'Anguilla', 1264),
(8, 'AQ', 'Antarctica', 0),
(9, 'AG', 'Antigua And Barbuda', 1268),
(10, 'AR', 'Argentina', 54),
(11, 'AM', 'Armenia', 374),
(12, 'AW', 'Aruba', 297),
(13, 'AU', 'Australia', 61),
(14, 'AT', 'Austria', 43),
(15, 'AZ', 'Azerbaijan', 994),
(16, 'BS', 'Bahamas The', 1242),
(17, 'BH', 'Bahrain', 973),
(18, 'BD', 'Bangladesh', 880),
(19, 'BB', 'Barbados', 1246),
(20, 'BY', 'Belarus', 375),
(21, 'BE', 'Belgium', 32),
(22, 'BZ', 'Belize', 501),
(23, 'BJ', 'Benin', 229),
(24, 'BM', 'Bermuda', 1441),
(25, 'BT', 'Bhutan', 975),
(26, 'BO', 'Bolivia', 591),
(27, 'BA', 'Bosnia and Herzegovina', 387),
(28, 'BW', 'Botswana', 267),
(29, 'BV', 'Bouvet Island', 0),
(30, 'BR', 'Brazil', 55),
(31, 'IO', 'British Indian Ocean Territory', 246),
(32, 'BN', 'Brunei', 673),
(33, 'BG', 'Bulgaria', 359),
(34, 'BF', 'Burkina Faso', 226),
(35, 'BI', 'Burundi', 257),
(36, 'KH', 'Cambodia', 855),
(37, 'CM', 'Cameroon', 237),
(38, 'CA', 'Canada', 1),
(39, 'CV', 'Cape Verde', 238),
(40, 'KY', 'Cayman Islands', 1345),
(41, 'CF', 'Central African Republic', 236),
(42, 'TD', 'Chad', 235),
(43, 'CL', 'Chile', 56),
(44, 'CN', 'China', 86),
(45, 'CX', 'Christmas Island', 61),
(46, 'CC', 'Cocos (Keeling) Islands', 672),
(47, 'CO', 'Colombia', 57),
(48, 'KM', 'Comoros', 269),
(49, 'CG', 'Republic Of The Congo', 242),
(50, 'CD', 'Democratic Republic Of The Congo', 242),
(51, 'CK', 'Cook Islands', 682),
(52, 'CR', 'Costa Rica', 506),
(53, 'CI', 'Cote D\'Ivoire (Ivory Coast)', 225),
(54, 'HR', 'Croatia (Hrvatska)', 385),
(55, 'CU', 'Cuba', 53),
(56, 'CY', 'Cyprus', 357),
(57, 'CZ', 'Czech Republic', 420),
(58, 'DK', 'Denmark', 45),
(59, 'DJ', 'Djibouti', 253),
(60, 'DM', 'Dominica', 1767),
(61, 'DO', 'Dominican Republic', 1809),
(62, 'TP', 'East Timor', 670),
(63, 'EC', 'Ecuador', 593),
(64, 'EG', 'Egypt', 20),
(65, 'SV', 'El Salvador', 503),
(66, 'GQ', 'Equatorial Guinea', 240),
(67, 'ER', 'Eritrea', 291),
(68, 'EE', 'Estonia', 372),
(69, 'ET', 'Ethiopia', 251),
(70, 'XA', 'External Territories of Australia', 61),
(71, 'FK', 'Falkland Islands', 500),
(72, 'FO', 'Faroe Islands', 298),
(73, 'FJ', 'Fiji Islands', 679),
(74, 'FI', 'Finland', 358),
(75, 'FR', 'France', 33),
(76, 'GF', 'French Guiana', 594),
(77, 'PF', 'French Polynesia', 689),
(78, 'TF', 'French Southern Territories', 0),
(79, 'GA', 'Gabon', 241),
(80, 'GM', 'Gambia The', 220),
(81, 'GE', 'Georgia', 995),
(82, 'DE', 'Germany', 49),
(83, 'GH', 'Ghana', 233),
(84, 'GI', 'Gibraltar', 350),
(85, 'GR', 'Greece', 30),
(86, 'GL', 'Greenland', 299),
(87, 'GD', 'Grenada', 1473),
(88, 'GP', 'Guadeloupe', 590),
(89, 'GU', 'Guam', 1671),
(90, 'GT', 'Guatemala', 502),
(91, 'XU', 'Guernsey and Alderney', 44),
(92, 'GN', 'Guinea', 224),
(93, 'GW', 'Guinea-Bissau', 245),
(94, 'GY', 'Guyana', 592),
(95, 'HT', 'Haiti', 509),
(96, 'HM', 'Heard and McDonald Islands', 0),
(97, 'HN', 'Honduras', 504),
(98, 'HK', 'Hong Kong S.A.R.', 852),
(99, 'HU', 'Hungary', 36),
(100, 'IS', 'Iceland', 354),
(101, 'IN', 'India', 91),
(102, 'ID', 'Indonesia', 62),
(103, 'IR', 'Iran', 98),
(104, 'IQ', 'Iraq', 964),
(105, 'IE', 'Ireland', 353),
(106, 'IL', 'Israel', 972),
(107, 'IT', 'Italy', 39),
(108, 'JM', 'Jamaica', 1876),
(109, 'JP', 'Japan', 81),
(110, 'XJ', 'Jersey', 44),
(111, 'JO', 'Jordan', 962),
(112, 'KZ', 'Kazakhstan', 7),
(113, 'KE', 'Kenya', 254),
(114, 'KI', 'Kiribati', 686),
(115, 'KP', 'Korea North', 850),
(116, 'KR', 'Korea South', 82),
(117, 'KW', 'Kuwait', 965),
(118, 'KG', 'Kyrgyzstan', 996),
(119, 'LA', 'Laos', 856),
(120, 'LV', 'Latvia', 371),
(121, 'LB', 'Lebanon', 961),
(122, 'LS', 'Lesotho', 266),
(123, 'LR', 'Liberia', 231),
(124, 'LY', 'Libya', 218),
(125, 'LI', 'Liechtenstein', 423),
(126, 'LT', 'Lithuania', 370),
(127, 'LU', 'Luxembourg', 352),
(128, 'MO', 'Macau S.A.R.', 853),
(129, 'MK', 'Macedonia', 389),
(130, 'MG', 'Madagascar', 261),
(131, 'MW', 'Malawi', 265),
(132, 'MY', 'Malaysia', 60),
(133, 'MV', 'Maldives', 960),
(134, 'ML', 'Mali', 223),
(135, 'MT', 'Malta', 356),
(136, 'XM', 'Man (Isle of)', 44),
(137, 'MH', 'Marshall Islands', 692),
(138, 'MQ', 'Martinique', 596),
(139, 'MR', 'Mauritania', 222),
(140, 'MU', 'Mauritius', 230),
(141, 'YT', 'Mayotte', 269),
(142, 'MX', 'Mexico', 52),
(143, 'FM', 'Micronesia', 691),
(144, 'MD', 'Moldova', 373),
(145, 'MC', 'Monaco', 377),
(146, 'MN', 'Mongolia', 976),
(147, 'MS', 'Montserrat', 1664),
(148, 'MA', 'Morocco', 212),
(149, 'MZ', 'Mozambique', 258),
(150, 'MM', 'Myanmar', 95),
(151, 'NA', 'Namibia', 264),
(152, 'NR', 'Nauru', 674),
(153, 'NP', 'Nepal', 977),
(154, 'AN', 'Netherlands Antilles', 599),
(155, 'NL', 'Netherlands The', 31),
(156, 'NC', 'New Caledonia', 687),
(157, 'NZ', 'New Zealand', 64),
(158, 'NI', 'Nicaragua', 505),
(159, 'NE', 'Niger', 227),
(160, 'NG', 'Nigeria', 234),
(161, 'NU', 'Niue', 683),
(162, 'NF', 'Norfolk Island', 672),
(163, 'MP', 'Northern Mariana Islands', 1670),
(164, 'NO', 'Norway', 47),
(165, 'OM', 'Oman', 968),
(166, 'PK', 'Pakistan', 92),
(167, 'PW', 'Palau', 680),
(168, 'PS', 'Palestinian Territory Occupied', 970),
(169, 'PA', 'Panama', 507),
(170, 'PG', 'Papua new Guinea', 675),
(171, 'PY', 'Paraguay', 595),
(172, 'PE', 'Peru', 51),
(173, 'PH', 'Philippines', 63),
(174, 'PN', 'Pitcairn Island', 0),
(175, 'PL', 'Poland', 48),
(176, 'PT', 'Portugal', 351),
(177, 'PR', 'Puerto Rico', 1787),
(178, 'QA', 'Qatar', 974),
(179, 'RE', 'Reunion', 262),
(180, 'RO', 'Romania', 40),
(181, 'RU', 'Russia', 70),
(182, 'RW', 'Rwanda', 250),
(183, 'SH', 'Saint Helena', 290),
(184, 'KN', 'Saint Kitts And Nevis', 1869),
(185, 'LC', 'Saint Lucia', 1758),
(186, 'PM', 'Saint Pierre and Miquelon', 508),
(187, 'VC', 'Saint Vincent And The Grenadines', 1784),
(188, 'WS', 'Samoa', 684),
(189, 'SM', 'San Marino', 378),
(190, 'ST', 'Sao Tome and Principe', 239),
(191, 'SA', 'Saudi Arabia', 966),
(192, 'SN', 'Senegal', 221),
(193, 'RS', 'Serbia', 381),
(194, 'SC', 'Seychelles', 248),
(195, 'SL', 'Sierra Leone', 232),
(196, 'SG', 'Singapore', 65),
(197, 'SK', 'Slovakia', 421),
(198, 'SI', 'Slovenia', 386),
(199, 'XG', 'Smaller Territories of the UK', 44),
(200, 'SB', 'Solomon Islands', 677),
(201, 'SO', 'Somalia', 252),
(202, 'ZA', 'South Africa', 27),
(203, 'GS', 'South Georgia', 0),
(204, 'SS', 'South Sudan', 211),
(205, 'ES', 'Spain', 34),
(206, 'LK', 'Sri Lanka', 94),
(207, 'SD', 'Sudan', 249),
(208, 'SR', 'Suriname', 597),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', 47),
(210, 'SZ', 'Swaziland', 268),
(211, 'SE', 'Sweden', 46),
(212, 'CH', 'Switzerland', 41),
(213, 'SY', 'Syria', 963),
(214, 'TW', 'Taiwan', 886),
(215, 'TJ', 'Tajikistan', 992),
(216, 'TZ', 'Tanzania', 255),
(217, 'TH', 'Thailand', 66),
(218, 'TG', 'Togo', 228),
(219, 'TK', 'Tokelau', 690),
(220, 'TO', 'Tonga', 676),
(221, 'TT', 'Trinidad And Tobago', 1868),
(222, 'TN', 'Tunisia', 216),
(223, 'TR', 'Turkey', 90),
(224, 'TM', 'Turkmenistan', 7370),
(225, 'TC', 'Turks And Caicos Islands', 1649),
(226, 'TV', 'Tuvalu', 688),
(227, 'UG', 'Uganda', 256),
(228, 'UA', 'Ukraine', 380),
(229, 'AE', 'United Arab Emirates', 971),
(230, 'GB', 'United Kingdom', 44),
(231, 'US', 'United States', 1),
(232, 'UM', 'United States Minor Outlying Islands', 1),
(233, 'UY', 'Uruguay', 598),
(234, 'UZ', 'Uzbekistan', 998),
(235, 'VU', 'Vanuatu', 678),
(236, 'VA', 'Vatican City State (Holy See)', 39),
(237, 'VE', 'Venezuela', 58),
(238, 'VN', 'Vietnam', 84),
(239, 'VG', 'Virgin Islands (British)', 1284),
(240, 'VI', 'Virgin Islands (US)', 1340),
(241, 'WF', 'Wallis And Futuna Islands', 681),
(242, 'EH', 'Western Sahara', 212),
(243, 'YE', 'Yemen', 967),
(244, 'YU', 'Yugoslavia', 38),
(245, 'ZM', 'Zambia', 260),
(246, 'ZW', 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `sw_courses`
--

CREATE TABLE `sw_courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(55) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_desc` text NOT NULL,
  `location` int(11) NOT NULL,
  `coach` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `closing_date` date DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_courses`
--

INSERT INTO `sw_courses` (`id`, `course_code`, `course_name`, `course_desc`, `location`, `coach`, `start_date`, `end_date`, `closing_date`, `active`, `created_at`, `modified_at`, `status`) VALUES
(1, 'CS1', 'Course01', 'Lorem Ipsum is simply dummied text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages,', 26922, 226, '2019-11-21', '2019-11-22', '2019-12-10', 1, '2019-09-21 16:06:00', NULL, 1),
(2, 'SC2', 'Course2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26920, 210, '2019-11-30', '2019-12-20', '2019-12-26', 1, '2019-09-25 16:06:00', NULL, 1),
(3, 'CS3', 'Course3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26917, 1, '2019-09-23', '2019-12-15', '2019-12-31', 1, '2019-09-21 16:06:00', NULL, 1),
(4, 'SC4', 'Course4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26925, 225, '2019-09-25', '2019-12-15', '2019-12-30', 1, '2019-09-25 16:06:00', NULL, 1),
(5, 'CS5', 'Course5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26927, 225, '2019-09-23', '2019-11-30', '2019-12-15', 1, '2019-09-21 16:06:00', NULL, 0),
(6, 'SC6', 'Course6', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26920, 1, '2019-09-25', '2019-11-30', '2019-10-15', 0, '2019-09-25 16:06:00', NULL, 0),
(7, 'CS7', 'Course7', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26918, 260, '2019-09-23', '2019-12-15', '2019-11-30', 1, '2019-09-21 16:06:00', NULL, 0),
(8, 'SC8', 'Course8', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 26919, 267, '2019-10-30', '2019-12-15', '2019-11-30', 1, '2019-09-25 16:06:00', NULL, 1),
(9, 'SC-9', 'Test Course for Testing Purpose', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem IpsumLorem Ipsum is simply dummy text of the prin', 26921, 225, '2019-11-05', '2019-11-30', '2019-11-20', 1, '2019-11-05 18:26:51', NULL, 1),
(10, 'SC-10', 'BASIC SKILL FOR SWIMMING COURSE', 'Even if you will never join a swim team, basic swimming skills are important.\r\n\r\nSwimming offers tremendous fitness benefits. The Centers for Disease Control and Prevention says that just 2.5 hours of swimming per week decreases the risk for chronic illnesses. Swimming improves mood and decreases anxiety, and the buoyancy of the water makes swimming a good choice for those with arthritis and other pain conditions. Even if you have no plans to become the next Michael Phelps, basic swimming skills are easy to learn.', 48372, 1, '2019-11-06', '2021-09-14', '2020-05-21', 1, '2019-11-06 06:34:15', NULL, 1),
(11, 'SC-11', 'testing course for swimming', 'testing course, testing course, testing course, testing course', 26927, 252, '2019-11-06', '2019-11-21', '2019-11-12', 1, '2019-11-06 10:00:35', NULL, 1),
(12, 'SC-12', 'swimming course999. This is a testing course', 'Swimming is an individual or team racing sport that requires the use of one\'s entire body to move through water. The sport takes place in pools or open water (e.g., in a sea or lake). Competitive swimming is one of the most popular Olympic sports,[1] with varied distance events in butterfly, backstroke, breaststroke, freestyle, and individual medley. In addition to these individual events, four swimmers can take part in either a freestyle or medley relay. A medley relay consists of four swimmers who will each swim a different stroke, ordered as backstroke, breaststroke, butterfly and freestyle.[2] Swimming each stroke requires a set of specific techniques; in competition, there are distinct regulations concerning the acceptable form for each individual stroke.[3] There are also regulations on what types of swimsuits, caps, jewelry and injury tape that are allowed at competitions', 26923, 1, '2019-11-15', '2019-12-05', '2019-11-20', 1, '2019-11-13 11:07:39', NULL, 1),
(13, 'SC-13', 'Learn ABC of swimming', 'dadafsdfs, dfsdfsdf', 26922, 225, '2019-11-14', '2019-12-26', '2019-12-06', 1, '2019-11-13 12:50:57', NULL, 1),
(14, 'SC-14', 'Course02', 'test course. Update a web page without reloading the page', 26924, 210, '2019-11-19', '2019-11-30', '2019-11-30', 1, '2019-11-18 06:25:09', NULL, 0),
(15, 'SC-15', 'Developing your skills as a swimmer.', 'We have combined our expertise with British Swimming and Swim England to develop an exciting coaching program. Exclusive to the Institute of Swimming.\r\n\r\nLeading coaches in their fields developed the framework for each discipline. This means all content is specific.\r\n\r\nThe coach training program contains the most relevant and up to date training techniques. Continual reviews keep it fresh.', 48372, 1, '2019-11-25', '2020-03-21', '2020-05-28', 1, '2019-11-25 06:23:15', NULL, 1),
(16, 'SC-16', 'Mobile app test course', 'New course', 26920, 1, '2019-11-26', '2019-11-30', '2019-12-26', 1, '2019-11-26 05:16:17', NULL, 0),
(17, 'SC-17', 'qwerty', 'The function will check the form details, whether the details are appropriate or not and then it alert messages if the user has entered wrong information or left any field empty', 48367, 1, '2019-11-26', '2019-12-27', '2019-12-31', 1, '2019-11-26 06:00:39', NULL, 0),
(18, 'SC-18', 'ENTER COURSE', 'NOP', 26917, 210, '2019-11-28', '2020-02-14', '2020-04-24', 1, '2019-11-28 08:31:04', NULL, 1),
(19, 'SC-19', 'sc5', 'Firstly, let’s have a look how a user can make mistake while entering wrong email address', 26923, 225, '2019-11-28', '2019-11-30', '2019-12-25', 1, '2019-11-28 08:57:09', NULL, 1),
(20, 'SC-20', 'sc6', 'The combination of letters, numbers, periods, plus sign, and /or underscores.', 26923, 225, '2019-12-05', '2020-01-03', '2019-04-01', 1, '2019-11-29 06:09:37', NULL, 1),
(21, 'SC-21', 'SC6', 'kerala', 26920, 210, '2019-12-20', '2019-12-16', '2019-12-28', 1, '2019-11-29 07:58:20', NULL, 1),
(22, 'SC-22', 'sc7', 'Like,  formValidation() is the main function that runs as soon as the user clicks on submit button. Here, object is defined for each field. Objects are stored in different variable.', 26920, 210, '2019-12-27', '2019-11-30', '2019-11-30', 1, '2019-11-29 08:11:09', NULL, 1),
(23, 'SC-23', 'Course014', 'ji', 48367, 225, '2019-12-19', '2019-12-28', '2020-01-03', 0, '2019-12-02 09:04:27', NULL, 1),
(24, 'SC-24', 'Course017', 'hi', 26923, 195, '2019-12-02', '2019-12-09', '2019-12-16', 1, '2019-12-02 09:39:34', NULL, 1),
(25, 'SC-25', 'Deepak', 'Deepak Free style', 48371, 267, '2019-12-03', '2019-12-13', '2019-12-12', 1, '2019-12-03 09:55:26', NULL, 1),
(26, 'SC-26', 'Total Immersion Swimming: Swim Better, Easier, Faster!', 'Official Course: Total Immersion head coach Terry Laughlin teaches you how to swim faster and further using less effort\r\n\r\n* Requirements\r\n\r\nAbility to swim 25 meters\r\nMotivation to learn and improve\r\n\r\n* Description\r\n\r\nThe Ultra-Efficient Freestyle Complete Self-Coaching Course will teach you to swim a dramatically more efficient freestyle—and transform you into your own most effective swim instructor and coach.\r\n\r\n* You will learn . . . the proven advantages of:\r\n\r\nSaving energy over trying to build endurance.\r\n\r\nLetting conditioning \'happen\' while you improve the skills that matter.\r\n\r\nAchieving comfort, body control, and weightlessness before any other skill', 48372, 1, '2019-12-05', '2019-12-27', '2019-12-27', 1, '2019-12-05 09:02:41', NULL, 1),
(27, 'SC-27', 'From 1K to swimming 4K', 'In this course you will change your swimming technique and you will be able to swim long distance with less effort.\r\n\r\nWhat you\'ll learn ?\r\n\r\nSwim faster 1000 freestyle\r\nLearn how to control pace in long distances\r\nLearn how to use less energy while swimming.\r\nLearn how to protect your lower back while swimming.\r\nLearn to swim according to your flexibility and abilities', 48372, 1, '2019-12-05', '2019-12-27', '2019-12-27', 1, '2019-12-05 09:29:55', NULL, 1),
(28, 'SC-28', 'coursename345', 'course description, course description', 48373, 225, '2019-12-07', '2019-12-28', '2019-12-08', 1, '2019-12-06 08:30:43', NULL, 1),
(29, 'SC-29', 'aries swimming course', 'course description', 48370, 293, '2019-12-09', '2019-12-26', '2019-12-12', 1, '2019-12-09 10:55:15', NULL, 0),
(30, 'SC-30', 'aries swimming class', 'Swimming class swimming class', 48370, 293, '2019-12-11', '2019-12-26', '2019-12-18', 1, '2019-12-10 09:49:30', NULL, 1),
(31, 'SC-31', 'test course', 'test course', 26920, 1, '2019-12-11', '2019-12-20', '2019-12-19', 1, '2019-12-11 05:16:05', NULL, 1),
(32, 'SC-32', 'Back Storke', 'Minimum 100 meters in 2 minutes', 26921, 1, '2020-10-19', '2020-10-30', '2020-10-19', 1, '2020-10-13 09:41:39', NULL, 1),
(33, 'SC-33', 'Swimming course 01', 'Lorem ipsum is a pseudo-Latin text used in web design, typography, layout, and printing in place of English to emphasise design elements over content. It\'s also called placeholder (or filler) text.', 26917, 303, '2020-10-21', '2020-12-05', '2020-10-30', 1, '2020-10-21 08:56:18', NULL, 1),
(34, 'SC-34', 'Swimming', 'Since the human body is (slightly) less dense than water, water supports the weight of the body during swimming. As a result, swimming is “low-impact” compared to land activities such as running. The density and viscosity of water also create resistance for objects moving through the water.', 48366, 303, '2020-10-30', '2021-01-30', '2020-11-01', 1, '2020-10-21 09:34:19', NULL, 1),
(35, 'SC-35', 'Bond Safari', 'Bond Safari gives every coach the opportunity to receive training to teach swim lessons as a part of the Bond Safari swimming program. In this way, we will make sure that all of our coaches are on the right track and all classes are going on the same level.', 26920, 306, '2020-10-21', '2020-10-22', '2020-10-21', 1, '2020-10-21 09:58:14', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_acivities`
--

CREATE TABLE `sw_course_acivities` (
  `id` int(11) NOT NULL,
  `activity_code` varchar(55) NOT NULL,
  `ms_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `activity_name` varchar(111) NOT NULL,
  `activity_desc` text NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_acivities`
--

INSERT INTO `sw_course_acivities` (`id`, `activity_code`, `ms_id`, `course_id`, `activity_name`, `activity_desc`, `active`, `created_at`, `modified_at`, `status`) VALUES
(1, 'AV1', 1, 1, 'Activity1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(2, 'AV2', 1, 1, 'Activity2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(3, 'AV3', 2, 1, 'Activity3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(4, 'AV4', 1, 1, 'Activity3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. ff', 1, '2019-09-21 20:33:57', NULL, 1),
(5, 'AV5', 1, 1, 'Activity4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(6, 'AV6', 3, 2, 'Activity1w', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(7, 'AV7', 3, 2, 'Activity2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(8, 'AV8', 4, 2, 'Activity3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(9, 'AV3-1', 0, 3, 'Activity3-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(10, 'AV3-2', 0, 3, 'Activity3-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(11, 'AV3-3', 0, 3, 'Activity3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(12, 'AV6-1', 6, 3, 'Activity6-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(13, 'AV6-2', 6, 3, 'Activity6-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(14, 'AV6-3', 6, 3, 'Activity6-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(15, 'AV6-4', 6, 3, 'Activity6-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(16, 'AV6-5', 6, 3, 'Activity6-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(17, 'AV7-1', 7, 3, 'Activity7-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(18, 'AV7-2', 7, 3, 'Activity7-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(19, 'AV7-3', 7, 3, 'Activity7-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(20, 'AV8-1', 8, 3, 'Activity8-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(21, 'AV8-2', 8, 3, 'Activity8-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(22, 'AV8-3', 8, 3, 'Activity8-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(23, 'AV8-4', 8, 3, 'Activity8-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(24, 'AV9-1', 9, 4, 'Activity9-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(25, 'AV9-2', 9, 4, 'Activity9-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(26, 'AV9-3', 9, 4, 'Activity9-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(27, 'AV10-1', 10, 4, 'Activity10-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(28, 'AV10-2', 10, 4, 'Activity10-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(29, 'AV10-3', 10, 4, 'Activity10-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(30, 'AV10-4', 10, 4, 'Activity10-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(31, 'AV10-5', 10, 4, 'Activity10-5', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(32, 'AV711-1', 11, 4, 'Activity11-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(33, 'AV11-2', 11, 4, 'Activity11-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(34, 'AV11-3', 11, 4, 'Activity11-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:34:48', NULL, 1),
(35, 'AV12-1', 12, 4, 'Activity12-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(36, 'AV12-2', 12, 4, 'Activity8\\12-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(37, 'AV12-3', 12, 4, 'Activity12-3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(38, 'AV12-4', 12, 4, 'Activity12-4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-09-21 20:33:57', NULL, 1),
(39, 'AV39', 30, 1, 'fff Activity 1a', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 05:11:09', NULL, 1),
(40, 'AV40', 30, 1, 'fff Activity 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 05:11:23', NULL, 1),
(41, 'AV41', 31, 1, 'Activity2 A', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 05:12:04', NULL, 1),
(42, 'AV42', 32, 1, 'Activity M5-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 11:16:13', NULL, 1),
(43, 'AV43', 33, 1, 'ActivityM6-1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 11:16:44', NULL, 1),
(44, 'AV44', 33, 1, 'Activity M6-2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2019-10-31 11:16:56', NULL, 1),
(45, 'AV45', 34, 10, 'Water Comfort', 'The most basic and essential swimming skill is simply becoming comfortable in the water. Although humans are born with innate water skills, many people develop a fear of water. When unintentional submersion occurs, panicking gets in the way of logical thinking and increases the likelihood of drowning. To become more comfortable in the water, spend time in a shallow pool or wading in the ocean. Never enter the water alone, especially if you are not a strong swimmer.', 1, '2019-11-06 06:42:53', NULL, 1),
(46, 'AV46', 34, 10, 'Breath Control', 'Breathing is often difficult for novice swimmers. With water all around, having some water enter the nose and mouth is a common occurrence. Some novice swimmers panic at the feeling of water in their noses, while others have trouble holding their breath while submerged. Learning to control your breathing is a key component in learning to swim.\n\nBreath control begins with simple exercises such as drawing a breath, submerging, blowing bubbles and then resurfacing for another breath. As your swimming skills improve, you will learn specific breathing techniques for different strokes. Work with a swimming coach or a friend or relative who is a strong swimmer.', 1, '2019-11-06 06:53:41', NULL, 1),
(47, 'AV47', 35, 10, 'Floating', 'Floating, or keeping your body in a horizontal position in the water, is a basic water skill. If you accidentally fall in the water, you may be able to float until you are rescued, even if you are not strong enough to swim to safety. Humans are naturally buoyant, and floating is not difficult. Like any other skill, however, floating does require a bit of technique. Get lessons from a coach or a competent friend or relative.', 1, '2019-11-06 06:55:51', NULL, 1),
(48, 'AV48', 35, 10, 'Kicking', 'Kicking provides propulsion through the water. Once you are comfortable with floating, kicking is the logical next step. Kicking is also used in treading water, which is the process of remaining in one place while keeping your head above the water line. Many coaches use kickboards, or flat flotation devices made of foam or plastic, to support the swimmer’s body. A kickboard allows you to focus solely on your kicking technique without worrying about staying afloat.', 1, '2019-11-06 06:57:32', NULL, 1),
(49, 'AV49', 35, 10, 'Strokes', 'Strokes are the arm movements used to pull the body through the water. The front crawl, sidestroke, breast stroke, backstroke and butterfly are the five most common swimming strokes. Each stoke uses different body positioning, breathing techniques and arm movements. Training with a qualified swimming coach is the best way to learn the various strokes.', 1, '2019-11-06 06:58:57', NULL, 1),
(50, 'AV50', 37, 11, 'testing activity1', 'this is a testing activity for testing purpose. This is a testing activity for testing purpose. This is a testing activity for testing purpose. This is a testing activity for testing purpose', 1, '2019-11-07 09:30:33', NULL, 1),
(51, 'AV51', 40, 12, 'Daily classes', 'The students who have milestone 50m , should attend the classes daily', 1, '2019-11-13 11:22:24', NULL, 1),
(52, 'AV52', 40, 12, 'weekly classes', 'The students who are registered for weekly classes , should attended the weekly classes', 1, '2019-11-13 11:46:27', NULL, 1),
(53, 'AV53', 40, 12, 'Weedend classes', 'The students who have registered in weekend classes, should attend the classes on the weekends.', 1, '2019-11-13 11:47:44', NULL, 1),
(54, 'AV54', 41, 12, 'daily classes', 'The students who are registered for weekly classes , should attend the daily classes', 1, '2019-11-13 11:49:58', NULL, 1),
(55, 'AV55', 41, 12, 'Weekly classes', 'The students who are registered for weekly classes , should attend the weekly classes', 1, '2019-11-13 11:50:28', NULL, 1),
(56, 'AV56', 41, 12, 'weekend classes', 'The students who are registered for weekend classes , should attend the weekend classes', 1, '2019-11-13 11:51:35', NULL, 1),
(57, 'AV57', 42, 12, 'Daily classes', 'The students who are attending this class should attend the classes on daily basis', 1, '2019-11-13 12:18:42', NULL, 1),
(58, 'AV58', 42, 12, 'Weekly classes', 'The students who are attending this class should attend the classes on weekly basis', 1, '2019-11-13 12:22:16', NULL, 1),
(59, 'AV59', 42, 12, 'Weekend classes', 'The students who are attending this class should attend the classes on weekend basis', 1, '2019-11-13 12:23:09', NULL, 1),
(60, 'AV60', 1, 1, 'Activity6', 'dfgdh', 1, '2019-11-14 13:41:49', NULL, 1),
(61, 'AV61', 1, 1, 'Activity7', 'Activity7', 1, '2019-11-14 13:59:00', NULL, 1),
(62, 'AV62', 1, 1, 'Activity8', 'Activity8', 1, '2019-11-14 13:59:12', NULL, 1),
(63, 'AV63', 43, 14, 'act1', 'act1 desc', 1, '2019-11-18 08:01:34', NULL, 0),
(64, 'AV64', 44, 13, 'activity123', 'cvczvzvc, vgfdffssfaaASDADSDFSFgfgfggh, vgfghfhghghgfdfdfgdf, bhghhhhhfghg', 1, '2019-11-19 13:38:41', NULL, 1),
(65, 'AV65', 40, 12, '123', 'asdasdsd', 1, '2019-11-20 06:47:20', NULL, 1),
(66, 'AV66', 51, 15, 'Coaching Swimming', 'This course will equip you with the knowledge and tools to actively support a Swim England Swimming Coach.', 1, '2019-11-25 06:27:24', NULL, 1),
(67, 'AV67', 51, 15, 'Coaching Diving', 'Builds on the Swim England Assistant Swimming Coach certificate, developing your knowledge and skills ahead of becoming an independent swimming coach.', 1, '2019-11-25 06:28:18', NULL, 1),
(68, 'AV68', 51, 15, 'Coaching Synchronised Swimming', 'This course will equip you with the knowledge and tools to actively support a Swim England Synchronised Swimming Coach.', 1, '2019-11-25 06:28:53', NULL, 1),
(69, 'AV69', 51, 15, 'Coaching Water Polo', 'This course will equip you with the knowledge and tools to actively support a Water Polo Coach.', 1, '2019-11-25 06:29:27', NULL, 1),
(70, 'AV70', 51, 15, 'Coaching Open Water Swimming', 'Develops the skills needed to effectively plan, deliver, and evaluate a series of open water training sessions.', 1, '2019-11-25 06:31:51', NULL, 1),
(71, 'AV71', 51, 15, 'Swim Offer Course', 'We work with Swim England to provide subsidized coaching courses for their clubs. These courses can be arranged through Swim England’s regional club development team.', 1, '2019-11-25 06:33:19', NULL, 1),
(72, 'AV72', 51, 15, 'Continuing Professional Development', 'We find that for most the gaining of a qualification is only the start of their coaching journey. The best coaches are always looking to add to their knowledge and develop their skills.', 1, '2019-11-25 06:33:44', NULL, 1),
(73, 'AV73', 51, 15, 'Courses for Officials and Volunteers', 'We have a series of e-learning modules and seminars for club volunteers and officials.', 1, '2019-11-25 06:34:10', NULL, 1),
(74, 'AV74', 52, 15, 'Swim  Aquatic Activity for Health', 'Goes through the properties of exercising in water including physiological effects, benefits and exercises for a range of mild to moderate health conditions.', 1, '2019-11-25 06:46:01', NULL, 1),
(75, 'AV75', 52, 15, 'Active IQ Level 2 Fitness Instructing Core Units 1 to 4', 'This course takes you through the core units of the Level 2 Fitness Instructor qualification, ahead of taking the Certificate in Fitness Instructing (Aqua) Units 5 to 6.', 1, '2019-11-25 06:46:32', NULL, 1),
(76, 'AV76', 52, 15, 'Active IQ Level 2 Certificate in Fitness Instructing (Aqua) Units 5 to 6', 'Provides fitness and exercise-to-music instructors with the skills to deliver aqua fitness programmes.', 1, '2019-11-25 06:46:56', NULL, 1),
(77, 'AV77', 1, 1, 'sssss', 'sss', 1, '2019-11-25 06:53:54', NULL, 0),
(78, 'AV78', 54, 18, 'Coaching SwimmingM', 'K', 1, '2019-11-28 08:34:50', NULL, 1),
(79, 'AV79', 58, 23, 'Coaching Water Polo', 'k', 1, '2019-12-02 09:13:23', NULL, 1),
(80, 'AV80', 59, 25, 'Activity 1', 'dfdsf', 1, '2019-12-03 09:57:34', NULL, 1),
(81, 'AV81', 59, 25, 'Activity 2', 'SHIMI', 1, '2019-12-03 09:59:00', NULL, 1),
(82, 'AV82', 8, 3, 'sssssss', 'ssss', 0, '2019-12-04 04:58:04', NULL, 0),
(83, 'AV83', 8, 3, 'ddd', 'ddd', 1, '2019-12-04 04:58:58', NULL, 0),
(84, 'AV84', 8, 3, 'ssdffgff', 'ffff', 0, '2019-12-04 05:02:57', NULL, 0),
(85, 'AV85', 5, 3, 'sss', 'ssss', 0, '2019-12-04 05:23:34', NULL, 1),
(86, 'AV86', 60, 26, 'comfort and body confrol', 'Introduction : \n\nThis group of drills and skills imparts three qualities essential to ultra-efficient swimming—and to creating the conditions for continuous long-term improvement:\n1. Immediate energy savings from a weightless and stable body position.\n2. The body control necessary to learn all subsequent skills.\n3. The focus, sense of calm, and habits of self-perception that will make your swimming more satisfying and effective for decades to come\n\nTrado : \n\nTorpedo practice repeats are briefer than any other drill. Though you may only practice it a few times, it will create invaluable and enduring body awareness that improves Balance and Core Stability—the indispensable foundations of an efficient stroke.', 1, '2019-12-05 09:09:03', NULL, 1),
(87, 'AV87', 60, 26, 'Controlled and Stable Recovery', 'Group One (Balance and Body Control) exercises rely entirely on gross-motor skills. These involve large body parts and major muscle groups. They’re relatively easy to coordinate—and to sense when you’re performing them correctly. This makes them ideal as the first step in improving efficiency.\n\nGroup Two exercises introduce many fine-motor skills, requiring the coordination of many more, and smaller, muscles. There are nearly limitless opportunities for error and a very narrow range of effective solutions. This greatly increases the difficulty of coordination and requires much deeper sensory awareness.\n\nTo reduce the learning curve, we’ve broken this section into many ‘bite-size’ skills—some in rehearsals, some in whole-stroke—', 1, '2019-12-05 09:10:16', NULL, 1),
(88, 'AV88', 60, 26, 'Elbow swing', 'Lifting the elbow, or pulling it back, as the hand exits the water is an extremely common instinct.\nThis causes the hips to over-rotate, diverting the hands to ‘steadying’ actions (which undermine propulsion) and causing legs to splay (which increases drag). It also increases injury risk. This exercise teaches you to swing the elbow outwards on exit. This brings it into the ‘scapular plane’ – the healthiest and most relaxed range of motion for the arm.\n\nElbow Swing: Rehearsal\nPerform this rehearsal in two steps. Do both while leaning forward as shown, with lead hand positioned as if to start the next stroke.', 1, '2019-12-05 09:10:53', NULL, 1),
(89, 'AV89', 60, 26, 'Paint a line (the rag doll arm)', 'This step helps channel momentum from the arm, and save energy, by imprinting two critical mini-skills:\n\nIt brings the arm directly forward, eliminating sideways motions. This channels energy and momentum forward.\n\nIt imprints ‘deep’ relaxation of hand and forearm, This gives muscles a ‘rest break’ between strokes and eliminates de-stabilizing ballistic forces.\n\nPaint a Line: Rehearsal\n\nPerform this rehearsal in two steps. Imprint the Rag Doll sensation first, then moving hand and arm forward via a wide, straight line.', 1, '2019-12-05 09:11:34', NULL, 1),
(90, 'AV90', 60, 26, 'Hop-and-slot', 'This lesson teaches two small and distinct actions (think of them as ‘micro-skills’) that combine smoothly to save energy and increase efficiency. We call the first Ear Hop and the second Mail Slot. We call the combined action Hop-and-Slot.\n\nEar Hop\nVisualize a laser extending from your ear. Hop your fingers barely over the laser on recovery.\nThis teaches you to keep fingertips close to the surface on recovery. An arm in the air weighs 10x its weight in the water; every needless inch of clearance wastes energy.', 1, '2019-12-05 09:12:11', NULL, 1),
(91, 'AV91', 61, 26, 'Breathing rehearsals', 'Single Arm Rehearsal\n\nAs you did in Recovery Rehearsals, refine and imprint the action of one arm, before progressing to alternating arms. Because bilateral breathing is critical to stroke symmetry, perform this with each arm—both as a single-arm and whole-stroke rehearsal.\n\nStep One Breathe Without Recovery\n\nRepeat six or more times on each side.\n\nPause in each position to familiarize and memorize.\n\nRight Hand at Bumper;\n\nThen Turn Nose Down\n\nLaser Forward During ‘Risky’ Breath\n\nLeft in Cargo Pocket', 1, '2019-12-05 09:19:39', NULL, 1),
(92, 'AV92', 61, 26, 'Simple roll to air', 'Basic Breathing Drills\n\nThese drills imprint habits that are integral to breathing in whole stroke. Practicing them in simpler drills (with few moving parts) will improve coordination in the more advanced drills that follow.\nFocus on imprinting three critical habits:\nRotate from hips. Initiate rotation from your hips let your head follow the body to air. Use lead hand as a ‘rudder’ to guide rotation.\nStay aligned. Rotate around head-spine line—keeping laser aimed forward. Travel through the water like an arrow through the air as you rotate up and down.\nWeightless head Feel your head resting on the water at all times—before, during, and after rotation.', 1, '2019-12-05 09:20:08', NULL, 1),
(93, 'AV93', 61, 26, 'Breath in skate', 'This is also called ‘Risky’ Breathing because you breathe with water touching the corner of your mouth. Mastering ‘risky’ breathing here will make it easier to do the same in our final step (4.6) because, here, you have less momentum—and thus little or no bow wave. This drill has three goals\nPractice as in Simple Roll to Air. Keep repeats short. In fact, start by doing just one ‘risky’ breathing cycle:\n\nStart in Skate. Rotate to breathe. Return to Skate. Stand up.. Repeat one cycle on the other side. Proceed to two or three cycles when you feel comfort and control of all Focal Points for one cycle.\n\nDo many short reps with correct form, rather than continuing on just to reach the other end of the pool.', 1, '2019-12-05 09:20:47', NULL, 1),
(94, 'AV94', 61, 26, 'Whale eye (non-breathing)', 'This drill is named for the thrilling moment during a whale-watching cruise, when a whale glides alongside the boat, seeming to study you with one eye. Perform this exactly as Nod, but clear the surface with just one goggle. As in Nod, let your gaze ‘linger’ there a moment and notice the stereoscopic view—seeing just above and just below the surface.\n\nPractice Tips\nPractice Whale-Eye just as you did Nod. Devote at least one set of repeats rotating in each direction—to each key Focal Point', 1, '2019-12-05 09:21:22', NULL, 1),
(95, 'AV95', 61, 26, 'Popeye (non-breathing)', 'his drill recalls the way Popeye the Sailorman stretched his mouth to \'inhale\' spinach.You\'ll stretch your mouth to air as shown above. \n\nReview Breathing Rehearsals:\n4.1b Whole\nStroke and 4.1c Bilateral.\n\nGlide briefly in Superman, start stroking—then just turn your head a tiny bit farther than in Whale-Eye. Bring your mouth above the surface on every cycle—but don’t feel obliged to breathe right away. You might actually try for a breath on the third or fourth cycle. Rotate one way on one rep, the other way on the next. Is there water in your mouth? Air can still pass over it on the way to your airways.', 1, '2019-12-05 09:21:55', NULL, 1),
(96, 'AV96', 62, 27, 'Diagnose yourself according to your flexibility level', 'Stretch to swim – determining your personal WEST zone\n\nOver the years, and after coaching and treating many thousands of people, we have come up with a way for each and every person to determine, on his own, and without any prior experience in coaching or water treatments, his personal optimal zone for swimming, or as we call it – his WEST D.N.A.\n\nWe are no Olympic swimmers or contortionists, and the WEST technique takes this into account and puts emphasis on taking care of the most important areas of our body: the lower back, which is the center of balance, and the neck, which is the stress and tension area.\n\nThe method we have developed includes a combination of age, gender, physical ability and three stretches which we will demonstrate', 1, '2019-12-05 09:32:06', NULL, 1),
(97, 'AV97', 62, 27, 'Before you go to the next workout', 'Before you go to workout number 2 it is important to repeat workout 1 exactly 3 times, and send me a message if the workout was good?, bad? if you didn\'t understand something?\n\nSome times a little tip can change everything.\n\nI am here for you.....', 1, '2019-12-05 09:32:44', NULL, 1),
(98, 'AV98', 63, 28, 'act1', 'Swimming is an individual or team racing sport that requires the use of one\'s entire body to move through water. The sport takes place in pools or open water (e.g., in a sea or lake). Competitive swimming is one of the most popular Olympic sports,[1] with varied distance events in butterfly, backstroke, breaststroke, freestyle, and individual medley. In addition to these individual events, four swimmers can take part in either a freestyle or medley relay.', 1, '2019-12-06 09:44:56', NULL, 1),
(99, 'AV99', 63, 28, 'act2', 'Evidence of recreational swimming in prehistoric times has been found, with the earliest evidence dating to Stone Age paintings from around 10,000 years ago. Written references date from 2000 BC, with some of the earliest references to swimming including the Iliad, the Odyssey, the Bible, Beowulf, the Quran and others. In 1538, Nikolaus Wynmann, a Swiss–German professor of languages, wrote the earliest known complete book about swimming, Colymbetes, sive de arte natandi dialogus et festivus et iucundus lectu (The Swimmer, or A Dialogue on the Art of Swimming and Joyful and Pleasant to Read', 1, '2019-12-06 10:37:29', NULL, 1),
(100, 'AV100', 64, 28, 'act3', 'Swimming emerged as a competitive recreational activity in the 1830s in England. In 1828, the first indoor swimming pool, St George\'s Baths was opened to the public.[6] By 1837, the National Swimming Society was holding regular swimming competitions in six artificial swimming pools, built around London. The recreational activity grew in popularity and by 1880, when the first national governing body, the Amateur Swimming Association was formed, there were already over 300 regional clubs in operation across the country', 1, '2019-12-06 10:42:33', NULL, 1),
(101, 'AV101', 64, 28, 'act4', 'Competitive swimming became popular in the 19th century. The goal of high level competitive swimming is to break personal or world records while beating competitors in any given event. Swimming in competition should create the least resistance in order to obtain maximum speed. However, some professional swimmers who do not hold a national or world ranking are considered the best in regard to their technical skills. Typically, an athlete goes through a cycle of training in which the body is overloaded with work in the beginning and middle segments of the cycle, and then the workload is decreased in the final stage as the swimmer approaches competition.', 1, '2019-12-06 10:43:25', NULL, 1),
(102, 'AV102', 65, 29, 'act123', 'description', 0, '2019-12-10 07:57:25', NULL, 1),
(103, 'AV103', 66, 29, 'act567', 'description, description, description', 1, '2019-12-10 08:47:41', NULL, 1),
(104, 'AV104', 67, 30, 'act678', 'activity name, activity name, activity name', 1, '2019-12-10 10:32:50', NULL, 1),
(105, 'AV105', 68, 31, 'test activity', 'test activity description', 1, '2019-12-11 05:19:52', NULL, 1),
(106, 'AV106', 5, 3, 'ddda', 'asg', 1, '2020-10-29 04:24:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_acivity_media`
--

CREATE TABLE `sw_course_acivity_media` (
  `id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_acivity_media`
--

INSERT INTO `sw_course_acivity_media` (`id`, `activity_id`, `description`, `file`, `type`, `active`, `status`) VALUES
(8, 4, NULL, '/app/public/Activities/1/gate.jpg', 'image', 1, 1),
(9, 5, NULL, '/app/public/Activities/1/data.jpg', 'image', 1, 1),
(14, 9, NULL, '/app/public/Activities/1/logo.png', 'image', 1, 1),
(15, 10, NULL, '/app/public/Activities/1/data.jpg', 'image', 1, 1),
(16, 11, NULL, '/app/public/Activities/1/gate.jpg', 'image', 1, 1),
(17, 12, NULL, '/app/public/Activities/1/data.jpg', 'image', 1, 1),
(18, 13, NULL, '/app/public/Activities/1/gate.jpg', 'image', 1, 1),
(19, 14, NULL, '/app/public/Activities/1/logo.png', 'image', 1, 1),
(34, 44, NULL, '/app/public/Activities/44/1572520728.jpg', 'image', 1, 1),
(39, 41, NULL, '/app/public/Activities/41/1572584722.jpg', 'image', 1, 1),
(40, 5, NULL, '/app/public/Activities/5/1572702776.jpg', 'image', 1, 1),
(41, 5, NULL, '/app/public/Activities/5/1572702824.jpg', 'image', 1, 1),
(42, 1, NULL, '/app/public/Activities/1/1572702850.jpg', 'image', 1, 1),
(48, 45, NULL, '/app/public/Activities/45/1573023938.jpg', 'image', 1, 1),
(49, 46, NULL, '/app/public/Activities/46/1573030202.jpg', 'image', 1, 1),
(50, 47, NULL, '/app/public/Activities/47/1573030257.jpg', 'image', 1, 1),
(51, 48, NULL, '/app/public/Activities/48/1573030272.jpg', 'image', 1, 1),
(52, 49, NULL, '/app/public/Activities/49/1573030288.jpg', 'image', 1, 1),
(53, 50, NULL, '/app/public/Activities/50/1573119243.jpg', 'image', 1, 1),
(54, 50, NULL, '/app/public/Activities/50/1573119284.jpg', 'image', 1, 1),
(55, 51, NULL, '/app/public/Activities/51/1573645693.gif', 'image', 1, 1),
(56, 52, NULL, '/app/public/Activities/52/1573645714.gif', 'image', 1, 1),
(57, 53, NULL, '/app/public/Activities/53/1573645731.jpg', 'image', 1, 1),
(60, 63, NULL, '/app/public/Activities/63/1574065706.jpg', 'image', 1, 1),
(61, 64, NULL, '/app/public/Activities/64/1574244981.jpg', 'image', 1, 1),
(62, 66, NULL, '/app/public/Activities/66/1574663398.jpg', 'image', 1, 1),
(63, 67, NULL, '/app/public/Activities/67/1574663411.jpg', 'image', 1, 1),
(64, 68, NULL, '/app/public/Activities/68/1574663423.jpg', 'image', 1, 1),
(65, 69, NULL, '/app/public/Activities/69/1574663442.jpg', 'image', 1, 1),
(66, 73, NULL, '/app/public/Activities/73/1574664000.jpg', 'image', 1, 1),
(67, 72, NULL, '/app/public/Activities/72/1574664012.jpg', 'image', 1, 1),
(68, 71, NULL, '/app/public/Activities/71/1574664020.jpg', 'image', 1, 1),
(69, 70, NULL, '/app/public/Activities/70/1574664029.jpg', 'image', 1, 1),
(70, 6, NULL, '/app/public/Activities/6/1574917421.jpg', 'image', 1, 1),
(71, 7, NULL, '/app/public/Activities/7/1574917499.jpg', 'image', 1, 1),
(72, 2, NULL, '/app/public/Activities/2/1574940507.jpg', 'image', 1, 1),
(75, 6, NULL, '/app/public/Activities/6/1575009147.jpg', 'image', 1, 1),
(77, 3, NULL, '/app/public/Activities/3/1575032564.jpg', 'image', 1, 1),
(80, 80, NULL, '/app/public/Activities/80/1575367092.jpg', 'image', 1, 1),
(81, 86, NULL, '/app/public/Activities/86/1575537925.jpg', 'image', 1, 1),
(82, 87, NULL, '/app/public/Activities/87/1575537940.jpg', 'image', 1, 1),
(83, 88, NULL, '/app/public/Activities/88/1575537951.jpg', 'image', 1, 1),
(84, 89, NULL, '/app/public/Activities/89/1575537968.jpg', 'image', 1, 1),
(85, 90, NULL, '/app/public/Activities/90/1575537982.jpg', 'image', 1, 1),
(86, 91, NULL, '/app/public/Activities/91/1575538003.jpg', 'image', 1, 1),
(87, 92, NULL, '/app/public/Activities/92/1575538018.jpg', 'image', 1, 1),
(88, 93, NULL, '/app/public/Activities/93/1575538033.jpg', 'image', 1, 1),
(89, 95, NULL, '/app/public/Activities/95/1575538044.jpg', 'image', 1, 1),
(90, 96, NULL, '/app/public/Activities/96/1575538423.jpg', 'image', 1, 1),
(91, 97, NULL, '/app/public/Activities/97/1575538437.jpg', 'image', 1, 1),
(92, 98, NULL, '/app/public/Activities/98/1575625814.jpg', 'image', 1, 1),
(93, 98, NULL, '/app/public/Activities/98/1575625830.jpg', 'image', 1, 1),
(94, 99, NULL, '/app/public/Activities/99/1575628775.jpg', 'image', 1, 1),
(95, 99, NULL, '/app/public/Activities/99/1575628788.jpg', 'image', 1, 1),
(96, 100, NULL, '/app/public/Activities/100/1575629087.jpg', 'image', 1, 1),
(97, 100, NULL, '/app/public/Activities/100/1575631611.jpg', 'image', 1, 1),
(98, 101, NULL, '/app/public/Activities/101/1575633280.jpg', 'image', 1, 1),
(101, 85, NULL, '/app/public/Activities/85/1575723778.jpg', 'image', 1, 1),
(103, 103, NULL, '/app/public/Activities/103/1575967942.jpg', 'image', 1, 1),
(107, 85, NULL, '/app/public/Activities/85/1576473441.jpg', 'image', 1, 1),
(108, 85, NULL, '/app/public/Activities/85/1576473494.jpg', 'image', 1, 1),
(109, 16, NULL, '/app/public/Activities/16/1576558512.jpg', 'image', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_activity_groups`
--

CREATE TABLE `sw_course_activity_groups` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `ms_id` int(11) NOT NULL,
  `group_name` varchar(155) NOT NULL,
  `activity_ids` text NOT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_activity_groups`
--

INSERT INTO `sw_course_activity_groups` (`id`, `course_id`, `ms_id`, `group_name`, `activity_ids`, `active`, `created_at`, `modified_at`, `status`) VALUES
(1, 1, 1, 'Group 1', '4,1', 1, '2019-09-25 14:30:23', '2019-12-16 07:08:41', 1),
(2, 1, 1, 'Group2', '', 1, '2019-11-14 14:01:37', '2019-11-14 14:02:27', 1),
(8, 10, 34, 'grup1', '45,46', 1, '2019-12-18 05:50:17', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_group_activities`
--

CREATE TABLE `sw_course_group_activities` (
  `ms_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_group_activities`
--

INSERT INTO `sw_course_group_activities` (`ms_id`, `group_id`, `activity_id`, `status`) VALUES
(1, 2, 2, 1),
(34, 8, 46, 1),
(1, 1, 1, 1),
(1, 2, 5, 1),
(1, 1, 4, 1),
(34, 8, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_media`
--

CREATE TABLE `sw_course_media` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file` varchar(155) NOT NULL,
  `type` enum('image','video') NOT NULL DEFAULT 'image',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_media`
--

INSERT INTO `sw_course_media` (`id`, `course_id`, `description`, `file`, `type`, `active`, `status`) VALUES
(1, 1, NULL, '/app/public/Courses/1/data.jpg', 'image', 1, 1),
(2, 2, NULL, '/app/public/Courses/2/it.jpg', 'image', 1, 1),
(3, 2, NULL, '/app/public/Courses/2/school.jpg', 'image', 1, 1),
(5, 3, NULL, '/app/public/Courses/3/1572426415.jpg', 'image', 1, 1),
(7, 5, NULL, '/app/public/Courses/5/1572426456.jpg', 'image', 1, 1),
(8, 6, NULL, '/app/public/Courses/6/1572426468.jpg', 'image', 1, 1),
(9, 7, NULL, '/app/public/Courses/7/1572426476.jpg', 'image', 1, 1),
(11, 1, NULL, '/app/public/Courses/1/1572498536.jpg', 'image', 1, 1),
(12, 1, NULL, '/app/public/Courses/1/1572527299.jpg', 'image', 1, 1),
(13, 10, NULL, '/app/public/Courses/10/1573022084.jpg', 'image', 1, 1),
(14, 11, NULL, '/app/public/Courses/11/1573115875.gif', 'image', 1, 1),
(15, 11, NULL, '/app/public/Courses/11/1573115884.gif', 'image', 1, 1),
(16, 12, NULL, '/app/public/Courses/12/1573643578.jpg', 'image', 1, 1),
(17, 12, NULL, '/app/public/Courses/12/1573643618.jpg', 'image', 1, 1),
(18, 12, NULL, '/app/public/Courses/12/1573643667.jpg', 'image', 1, 1),
(19, 13, NULL, '/app/public/Courses/13/1573649684.jpg', 'image', 1, 1),
(20, 14, NULL, '/app/public/Courses/14/1574058658.jpg', 'image', 1, 1),
(22, 14, NULL, '/app/public/Courses/14/1574059430.jpg', 'image', 1, 1),
(24, 14, NULL, '/app/public/Courses/14/1574059448.jpg', 'image', 1, 1),
(25, 15, NULL, '/app/public/Courses/15/1574663119.jpg', 'image', 1, 1),
(30, 19, NULL, '/app/public/Courses/19/1574931452.jpg', 'image', 1, 1),
(31, 10, NULL, '/app/public/Courses/10/1574944351.jpg', 'image', 1, 1),
(32, 10, NULL, '/app/public/Courses/10/1574944382.jpg', 'image', 1, 1),
(33, 15, NULL, '/app/public/Courses/15/1574944481.jpg', 'image', 1, 1),
(34, 15, NULL, '/app/public/Courses/15/1574944535.jpg', 'image', 1, 1),
(35, 15, NULL, '/app/public/Courses/15/1574945128.jpg', 'image', 1, 1),
(36, 5, NULL, '/app/public/Courses/5/1575003772.jpg', 'image', 1, 1),
(37, 4, NULL, '/app/public/Courses/4/1575013840.jpg', 'image', 1, 1),
(40, 2, NULL, '/app/public/Courses/2/1575019661.png', 'image', 1, 1),
(41, 2, NULL, '/app/public/Courses/2/1575019686.jpg', 'image', 1, 1),
(42, 2, NULL, '/app/public/Courses/2/1575019701.jpg', 'image', 1, 1),
(44, 8, NULL, '/app/public/Courses/8/1575022907.gif', 'image', 1, 1),
(45, 8, NULL, '/app/public/Courses/8/1575026023.gif', 'image', 1, 1),
(46, 8, NULL, '/app/public/Courses/8/1575026175.gif', 'image', 1, 1),
(51, 8, NULL, '/app/public/Courses/8/1575026702.png', 'image', 1, 1),
(52, 18, NULL, '/app/public/Courses/18/1575027534.png', 'image', 1, 1),
(53, 18, NULL, '/app/public/Courses/18/1575027702.PNG', 'image', 1, 1),
(55, 18, NULL, '/app/public/Courses/18/1575027767.gif', 'image', 1, 1),
(56, 22, NULL, '/app/public/Courses/22/1575027825.jpg', 'image', 1, 1),
(57, 22, NULL, '/app/public/Courses/22/1575027832.jpg', 'image', 1, 1),
(58, 22, NULL, '/app/public/Courses/22/1575027870.jpg', 'image', 1, 1),
(63, 23, NULL, '/app/public/Courses/23/1575278684.jpg', 'image', 1, 1),
(66, 25, NULL, '/app/public/Courses/25/1575366992.jpg', 'image', 1, 1),
(67, 26, NULL, '/app/public/Courses/26/1575536785.jpg', 'image', 1, 1),
(68, 27, NULL, '/app/public/Courses/27/1575538210.jpg', 'image', 1, 1),
(69, 28, NULL, '/app/public/Courses/28/1575625139.jpg', 'image', 1, 1),
(70, 28, NULL, '/app/public/Courses/28/1575625202.jpg', 'image', 1, 1),
(71, 28, NULL, '/app/public/Courses/28/1575625276.jpg', 'image', 1, 1),
(76, 29, NULL, '/app/public/Courses/29/1575889753.jpg', 'image', 1, 1),
(77, 30, NULL, '/app/public/Courses/30/1575973825.jpg', 'image', 1, 1),
(81, 3, NULL, '/app/public/Courses/3/1576473423.jpg', 'image', 1, 1),
(82, 33, NULL, '/app/public/Courses/33/1603270657.jpg', 'image', 1, 1),
(83, 34, NULL, '/app/public/Courses/34/1603272887.jpg', 'image', 1, 1),
(84, 35, NULL, '/app/public/Courses/35/1603274368.jpg', 'image', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_course_milestones`
--

CREATE TABLE `sw_course_milestones` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `ms_name` varchar(115) NOT NULL,
  `ms_desc` varchar(255) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_course_milestones`
--

INSERT INTO `sw_course_milestones` (`id`, `course_id`, `ms_name`, `ms_desc`, `active`, `status`) VALUES
(1, 1, 'Milestone1', 'Milestone description1', 1, 1),
(2, 1, 'Milestone 2 A', 'Milestone description2', 1, 1),
(3, 2, 'Milestone1', 'Milestone description1', 0, 1),
(4, 2, 'Milestone 2', 'Milestone description2', 1, 1),
(5, 3, 'Milestone1', 'Milestone description1', 1, 1),
(6, 3, 'Milestone 2', 'Milestone description2', 1, 1),
(7, 3, 'Milestone3', 'Milestone description3', 1, 1),
(8, 3, 'Milestone 4', 'Milestone description4', 1, 1),
(9, 4, 'Milestone1', 'Milestone description1', 0, 1),
(10, 4, 'Milestone 2', 'Milestone description2', 1, 1),
(11, 4, 'Milestone3', 'Milestone description3', 1, 1),
(12, 4, 'Milestone 4', 'Milestone description4', 1, 1),
(13, 5, 'Milestone1', 'Milestone description1', 1, 1),
(14, 5, 'Milestone 2', 'Milestone description2', 1, 1),
(15, 5, 'Milestone3', 'Milestone description3', 0, 1),
(16, 5, 'Milestone 4', 'Milestone description4', 1, 1),
(17, 6, 'Milestone1', 'Milestone description1', 1, 1),
(18, 6, 'Milestone 2', 'Milestone description2', 1, 1),
(19, 6, 'Milestone3', 'Milestone description3', 1, 1),
(20, 6, 'Milestone 4', 'Milestone description4', 1, 1),
(21, 7, 'Milestone1', 'Milestone description1', 1, 1),
(22, 7, 'Milestone 2', 'Milestone description2', 1, 1),
(23, 7, 'Milestone3', 'Milestone description3', 1, 1),
(24, 7, 'Milestone 4', 'Milestone description4', 1, 1),
(25, 8, 'Milestone1', 'Milestone description1', 0, 1),
(26, 8, 'Milestone 2', 'Milestone description2', 0, 1),
(27, 8, 'Milestone3', 'Milestone description3', 1, 1),
(28, 8, 'Milestone 4', 'Milestone description4', 1, 1),
(29, 5, 'sssss', NULL, 0, 1),
(30, 1, 'Mile 3', NULL, 1, 1),
(31, 1, 'Milestone 4', NULL, 1, 1),
(32, 1, 'Milestone5', NULL, 1, 1),
(33, 1, 'Milestone6', NULL, 1, 1),
(34, 10, 'MILESTONE-1', NULL, 1, 1),
(35, 10, 'MILESTONE-2', NULL, 1, 1),
(36, 10, 'Milestone 3', NULL, 0, 1),
(37, 11, 'testing milestone1', NULL, 1, 1),
(38, 11, 'testing milestone2', NULL, 1, 1),
(39, 11, 'testing milestone3', NULL, 1, 1),
(40, 12, 'finish 50m', NULL, 1, 1),
(41, 12, 'finish 100m', NULL, 1, 1),
(42, 12, 'finish 200m', NULL, 1, 1),
(43, 14, 'milestone 1a', NULL, 1, 0),
(44, 13, 'milestone123', NULL, 1, 1),
(45, 13, 'milestone234', NULL, 1, 1),
(46, 13, 'milestone345', NULL, 1, 1),
(47, 2, 'MS3', NULL, 1, 1),
(48, 1, 'adasd', NULL, 1, 0),
(49, 13, 'sdfsdg', NULL, 1, 1),
(50, 14, '2121', NULL, 0, 1),
(51, 15, 'Defined pathways to success', NULL, 1, 1),
(52, 15, 'Adding aquatics to your health and fitness qualification', NULL, 1, 1),
(53, 14, 'sss', NULL, 0, 0),
(54, 18, 'CC', NULL, 1, 1),
(55, 19, 'Milestone6', NULL, 1, 1),
(56, 2, 'asdas', NULL, 0, 0),
(57, 2, 'xdgxdfg', NULL, 0, 0),
(58, 23, 'CC', NULL, 0, 1),
(59, 25, 'D1', NULL, 1, 1),
(60, 26, 'Courses to get you started', NULL, 1, 1),
(61, 26, 'Breath Easy', NULL, 1, 1),
(62, 27, 'Swim 4k without 1', NULL, 1, 1),
(63, 28, 'miles1', NULL, 1, 1),
(64, 28, 'miles2', NULL, 1, 1),
(65, 29, 'ms678', NULL, 0, 0),
(66, 29, 'ms678', NULL, 1, 1),
(67, 30, 'ms546', NULL, 1, 1),
(68, 31, 'test milestone', NULL, 0, 1),
(69, 33, 'Milestone 01', NULL, 1, 1),
(70, 33, 'Milestone 02', NULL, 1, 1),
(71, 33, 'Milestone 03', NULL, 1, 1),
(72, 34, 'Milestone 01', NULL, 1, 1),
(73, 35, 'bond safari milestone 1', NULL, 1, 1),
(74, 35, 'bond safari milestone 2', NULL, 1, 1),
(75, 34, 'Milestone 02', NULL, 1, 1),
(76, 34, 'Milestone 02', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sw_email_template`
--

CREATE TABLE `sw_email_template` (
  `id` int(11) NOT NULL,
  `identifier` varchar(150) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` longtext NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(2) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_email_template`
--

INSERT INTO `sw_email_template` (`id`, `identifier`, `title`, `description`, `active`, `sort`, `type`, `created_at`, `updated_at`, `status`) VALUES
(1, 'welcome_email', 'Welcome Email', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                  <tr>\r\n                    <td style=\"font-size: 30px; text-align:center;\">\r\n                      <br>\r\n                        Awesome Co\r\n                      <br>\r\n                      <br>\r\n                    </td>\r\n                  </tr>\r\n                </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br><br><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0px auto; height: 460px; width: 100%;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr style=\"height: 262px;\">\r\n<td style=\"height: 262px;\"><br><br><br><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\"></td>\r\n</tr>\r\n<tr style=\"height: 18px;\">\r\n<td class=\"headline\" style=\"height: 18px;\">Welcome..!</td>\r\n</tr>\r\n<tr style=\"height: 18px;\">\r\n<td class=\"headlines\" style=\"height: 18px;\">{{User}}</td>\r\n</tr>\r\n<tr style=\"height: 76px;\">\r\n<td style=\"height: 76px;\"><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br>To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br><br></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n<tr style=\"height: 86px;\">\r\n<td style=\"height: 86px;\">\r\n<div><!-- [if mso]>\r\n                        <v:roundrect xmlns:v=\"urn:schemas-microsoft-com:vml\" xmlns:w=\"urn:schemas-microsoft-com:office:word\" href=\"http://\" style=\"height:50px;v-text-anchor:middle;width:200px;\" arcsize=\"8%\" stroke=\"f\" fillcolor=\"#178f8f\">\r\n                          <w:anchorlock/>\r\n                          <center>\r\n                        <![endif]--> <a style=\"background-color: #ab0219; border-radius: 4px; color: #ffffff; display: inline-block; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: bold; line-height: 50px; text-align: center; text-decoration: none; width: 200px; -webkit-text-size-adjust: none;\" href=\"https://bizzsalon.com/{{active_link}}\">Activate Account!</a> <!-- [if mso]>\r\n                          </center>\r\n                        </v:roundrect>\r\n                      <![endif]--></div>\r\n<br><br></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\"> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\"> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">© <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 2, '2019-03-04 11:46:32', '2019-06-01 08:30:52', 1),
(10, 'membership_expiry', 'Membership Expiry', '<!-- Title --> <!-- Favicon -->\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                              <tr>\r\n                                <td style=\"font-size: 30px; text-align:center;\">\r\n                                  <br>\r\n                                    Awesome Co\r\n                                  <br>\r\n                                  <br>\r\n                                </td>\r\n                              </tr>\r\n                            </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\">Hi..!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">{{User}}</td>\r\n</tr>\r\n<tr>\r\n<td><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<div>Your Membership Plan will expire soon. <br />\r\n<p>Expiry Date: {{expiry}}</p>\r\n</div>\r\n<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-11 10:24:14', '2019-03-11 10:24:14', 1),
(11, 'membership_expired', 'Membership Expired', '<!-- Title --> <!-- Favicon -->\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                              <tr>\r\n                                <td style=\"font-size: 30px; text-align:center;\">\r\n                                  <br>\r\n                                    Awesome Co\r\n                                  <br>\r\n                                  <br>\r\n                                </td>\r\n                              </tr>\r\n                            </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\">Hi..!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">{{User}}</td>\r\n</tr>\r\n<tr>\r\n<td><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<div>Your Membership Plan has been expired on {{expiry}}.</div>\r\n<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-12 08:45:30', '2019-03-12 13:00:20', 1),
(2, 'admin_welcome_email', 'Welcome Email', '<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<!-- Title -->\r\n<p>&nbsp;</p>\r\n<!-- Favicon -->\r\n<p>&nbsp;</p>\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\">\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\">Welcome..!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">{{User}}</td>\r\n</tr>\r\n<tr>\r\n<td>Thanks for registering with Bizz Salon.</td>\r\n</tr>\r\n<tr>\r\n<td>Email Id: {{EmailId}}</td>\r\n</tr>\r\n<tr>\r\n<td>Password: {{Password}}</td>\r\n</tr>\r\n<tr>\r\n<td><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-04 11:46:32', '2019-03-07 06:17:19', 1),
(7, 'membership_renewal', 'Membership Renewal', '<!-- Title --> <!-- Favicon -->\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                              <tr>\r\n                                <td style=\"font-size: 30px; text-align:center;\">\r\n                                  <br>\r\n                                    Awesome Co\r\n                                  <br>\r\n                                  <br>\r\n                                </td>\r\n                              </tr>\r\n                            </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\">Hi..!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">{{User}}</td>\r\n</tr>\r\n<tr>\r\n<td><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n<tr>\r\n<td>\r\n<div>Your Membership Plan has been extended to {{expiry}}.</div>\r\n<br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-07 12:15:43', '2019-03-07 12:15:43', 1),
(14, 'contact_email', 'Contact Details', '<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                              <tr>\r\n                                <td style=\"font-size: 30px; text-align:center;\">\r\n                                  <br>\r\n                                    Awesome Co\r\n                                  <br>\r\n                                  <br>\r\n                                </td>\r\n                              </tr>\r\n                            </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br><br><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\"></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br><br><br><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\"></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\">Hi..!</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">Admin</td>\r\n</tr>\r\n<tr>\r\n<td>&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Name:</strong> {{Name}}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Email Id:</strong> {{EmailId}}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Subject:</strong> {{Subject}}</td>\r\n</tr>\r\n<tr>\r\n<td><strong>Message:</strong> {{Message}}</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<br>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\"> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\"> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\"></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">© <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-28 05:34:05', '2019-04-22 08:25:23', 1),
(3, 'admin_reset_password_link', 'Admin Reset Password Link', '<!-- Title --> <!-- Favicon --> \r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\">\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://estrradodemo.com/swimming/public/images/logo.png\" alt=\"Logo\" /> </td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0 auto;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr>\r\n<td class=\"headline\" style=\"font-size: 16px;\">Hi, Bizz Salon Admin, Reset Password:</td>\r\n</tr>\r\n<tr>\r\n<td class=\"headlines\">{{Link}}</td>\r\n</tr>\r\n<tr>\r\n<td><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a> </td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved </td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-04 11:46:32', '2019-11-29 08:23:06', 1),
(13, 'welcome_email_customer', 'Welcome Email - Customer', '<!-- Title --> <!-- Favicon -->\r\n<table width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"100%\"><center>\r\n<table class=\"w320\" style=\"margin: 0 auto;\" width=\"600\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td align=\"center\" valign=\"top\"><!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                  <tr>\r\n                    <td style=\"font-size: 30px; text-align:center;\">\r\n                      <br>\r\n                        Awesome Co\r\n                      <br>\r\n                      <br>\r\n                    </td>\r\n                  </tr>\r\n                </table> -->\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #ffffff;\"><br /><br /><img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\" /></td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table style=\"margin: 0px auto; height: 460px; width: 100%;\" width=\"100%\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\">\r\n<tbody>\r\n<tr style=\"height: 262px;\">\r\n<td style=\"height: 262px;\"><br /><br /><br /><img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" alt=\"robot picture\" width=\"100%\" /></td>\r\n</tr>\r\n<tr style=\"height: 18px;\">\r\n<td class=\"headline\" style=\"height: 18px;\">Welcome..!</td>\r\n</tr>\r\n<tr style=\"height: 18px;\">\r\n<td class=\"headlines\" style=\"height: 18px;\">{{User}}</td>\r\n</tr>\r\n<tr style=\"height: 76px;\">\r\n<td style=\"height: 76px;\"><center>\r\n<table style=\"margin: 0 auto;\" width=\"60%\" cellspacing=\"0\" cellpadding=\"0\">\r\n<tbody>\r\n<tr>\r\n<td style=\"color: #ab0219;\"><br />To the BizzSalon! We\'re sure you will feel right at home with Awesome Co. <br /><br /></td>\r\n</tr>\r\n\r\n<tr>\r\n    <td style=\"color: #ab0219;\">\r\n        <div>Your login credentials given below</div>  <br /><br />\r\n        <div>Email : {{email}}</div>  <br />\r\n         <div>Password : {{password}}</div>  <br />\r\n    </td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n<tr style=\"height: 86px;\">\r\n<td style=\"height: 86px;\">&nbsp;\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<table class=\"force-full-width\" style=\"margin: 0 auto;\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#414141\">\r\n<tbody>\r\n<tr>\r\n<td style=\"background-color: #414141;\"><img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\" /> <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\" /> <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\" /></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\"><a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a></td>\r\n</tr>\r\n<tr>\r\n<td style=\"color: #bbbbbb; font-size: 12px;\">&copy; <!--?php echo date(\"Y\"); ?--> All Rights Reserved</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n</center></td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 0, 1, '2019-03-04 11:46:32', '2019-03-22 12:02:23', 1),
(4, 'membership_plan_change', 'Membership Plan Changed', '<!DOCTYPE html>\r\n<html>\r\n    <head>\r\n        <meta charset=\"utf-8\">\r\n        <meta content=\"width=device-width, initial-scale=1, shrink-to-fit=no\" name=\"viewport\">\r\n        <meta content=\"\" name=\"description\">\r\n        <meta content=\"saloon &amp; spa\" name=\"BizzSaloon\">\r\n\r\n        <!-- Title -->\r\n        <title>BizzSalon</title>\r\n\r\n        <!-- Favicon -->\r\n        <link href=\"{{asset(\'public/shop/assets/img/brand/favicon.png\')}}\" rel=\"icon\" type=\"image/png\">\r\n\r\n        <style type=\"text/css\">\r\n            @import url(http://fonts.googleapis.com/css?family=Droid+Sans);\r\n\r\n            /* Take care of image borders and formatting */\r\n\r\n            img {\r\n                max-width: 600px;\r\n                outline: none;\r\n                text-decoration: none;\r\n                -ms-interpolation-mode: bicubic;\r\n            }\r\n\r\n            a {\r\n                text-decoration: none;\r\n                border: 0;\r\n                outline: none;\r\n                color: #bbbbbb;\r\n            }\r\n\r\n            a img {\r\n                border: none;\r\n            }\r\n\r\n            /* General styling */\r\n\r\n            td, h1, h2, h3  {\r\n                font-family: Helvetica, Arial, sans-serif;\r\n                font-weight: 400;\r\n            }\r\n\r\n            td {\r\n                text-align: center;\r\n            }\r\n\r\n            body {\r\n                -webkit-font-smoothing:antialiased;\r\n                -webkit-text-size-adjust:none;\r\n                width: 100%;\r\n                height: 100%;\r\n                color: #37302d;\r\n                background: #ffffff;\r\n                font-size: 16px;\r\n            }\r\n\r\n            table {\r\n                border-collapse: collapse !important;\r\n            }\r\n\r\n            .headline {\r\n                color: #AB0219;\r\n                font-size: 30px;\r\n            }\r\n\r\n            .headlines {\r\n                color: #AB0219;\r\n                font-size: 24px;\r\n            }\r\n\r\n            .force-full-width {\r\n                width: 100% !important;\r\n            }\r\n\r\n        </style>\r\n\r\n        <style type=\"text/css\" media=\"screen\">\r\n            @media screen {\r\n                /*Thanks Outlook 2013! http://goo.gl/XLxpyl*/\r\n                td, h1, h2, h3 {\r\n                    font-family: \'Droid Sans\', \'Helvetica Neue\', \'Arial\', \'sans-serif\' !important;\r\n                }\r\n            }\r\n        </style>\r\n\r\n        <style type=\"text/css\" media=\"only screen and (max-width: 480px)\">\r\n            /* Mobile styles */\r\n            @media only screen and (max-width: 480px) {\r\n\r\n                table[class=\"w320\"] {\r\n                    width: 320px !important;\r\n                }\r\n\r\n            }\r\n        </style>\r\n    </head>\r\n    <body class=\"body\" style=\"padding:0; margin:0; display:block; background:#ffffff; -webkit-text-size-adjust:none\" bgcolor=\"#ffffff\">\r\n        <table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"100%\" >\r\n            <tr>\r\n                <td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\"  width=\"100%\">\r\n            <center>\r\n                <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"600\" class=\"w320\">\r\n                    <tr>\r\n                        <td align=\"center\" valign=\"top\">\r\n            <!--                 <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"margin:0 auto;\">\r\n                              <tr>\r\n                                <td style=\"font-size: 30px; text-align:center;\">\r\n                                  <br>\r\n                                    Awesome Co\r\n                                  <br>\r\n                                  <br>\r\n                                </td>\r\n                              </tr>\r\n                            </table> -->\r\n                            <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" class=\"force-full-width\" bgcolor=\"#ffffff\" style=\"margin: 0 auto\">\r\n                                <tr>\r\n                                    <td style=\"background-color:#ffffff;\">\r\n                                        <br>\r\n                                        <br>\r\n                                        <img src=\"https://bizzsalon.com/public/images/logo.jpg\" alt=\"Logo\">\r\n                                        <br>\r\n                                    </td>\r\n                                </tr>\r\n                            </table>\r\n                            <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" bgcolor=\"#ffffff\">\r\n                                <tr>\r\n                                    <td>\r\n                                        <br>\r\n                                        <br>\r\n                                        <br>\r\n                                        <img style=\"max-width: 100%; display: block;\" src=\"https://bizzsalon.com/public/uploads/banner_slider/banner2.jpg\" width=\"100%\" alt=\"robot picture\">\r\n                                    </td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td class=\"headline\">\r\n                                        Hi..!\r\n                                    </td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td class=\"headlines\">\r\n                                        {{User}}\r\n                                    </td>\r\n                                </tr>\r\n                                <tr>\r\n                                    <td>\r\n                                <center>\r\n                                    <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" width=\"60%\">\r\n                                        <tr>\r\n                                            <td style=\"color:#AB0219;\">\r\n                                                <br>\r\n                                                To the BizzSalon! We\'re sure you will feel right at home with Awesome Co.\r\n                                                <br>\r\n                                                <br>\r\n                                            </td>\r\n                                        </tr>\r\n                                    </table>\r\n                                </center>\r\n\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td>\r\n                            <div>\r\n                                Your Membership Plan has been changed to {{plan}}.\r\n                            </div>\r\n                            <br>\r\n                            <br>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                <table style=\"margin: 0 auto;\" cellpadding=\"0\" cellspacing=\"0\" class=\"force-full-width\" bgcolor=\"#414141\" style=\"margin: 0 auto\">\r\n                    <tr>\r\n                        <td style=\"background-color:#414141;\">\r\n                            <img src=\"https://www.filepicker.io/api/file/R4VBTe2UQeGdAlM7KDc4\" alt=\"google+\">\r\n                            <img src=\"https://www.filepicker.io/api/file/cvmSPOdlRaWQZnKFnBGt\" alt=\"facebook\">\r\n                            <img src=\"https://www.filepicker.io/api/file/Gvu32apSQDqLMb40pvYe\" alt=\"twitter\">\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"color:#bbbbbb; font-size:12px;\">\r\n                            <a href=\"#\">Home</a> | <a href=\"#\">Company</a> | <a href=\"#\">Support</a>\r\n                            <br>\r\n                        </td>\r\n                    </tr>\r\n                    <tr>\r\n                        <td style=\"color:#bbbbbb; font-size:12px;\">\r\n                            © <?php echo date(\"Y\"); ?> All Rights Reserved\r\n                            <br>\r\n                        </td>\r\n                    </tr>\r\n                </table>\r\n                </td>\r\n                </tr>\r\n        </table>\r\n    </center>\r\n</td>\r\n</tr>\r\n</table>\r\n</body>\r\n</html>', 1, 0, 1, '2019-03-04 11:46:32', '2019-03-04 11:46:32', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_faqs`
--

CREATE TABLE `sw_faqs` (
  `id` int(11) NOT NULL,
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `sort` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_faqs`
--

INSERT INTO `sw_faqs` (`id`, `question`, `answer`, `active`, `sort`, `created_at`, `updated_at`, `status`) VALUES
(2, 'Can I change plans whenever I want?', 'Yes! You can upgrade at any point in time to a different plan.', 1, 1, '2019-03-06 09:38:36', '2019-03-21 06:39:31', 1),
(3, 'How much does online booking cost?', 'Online booking functionality is included in the base price for all plans. In fact, all our plans contain all features.', 1, 2, '2019-03-06 09:38:59', '2019-03-19 12:19:33', 1),
(4, 'What are sites?', 'Sites refer to the physical locations or branches of your business. Our rental fee is charged per site, and allows as many users as you want to use Bizzsalon.', 1, 3, '2019-03-06 09:39:19', '2019-03-19 12:19:33', 1),
(5, 'How much does support cost?', 'Online Support is included in the monthly subscription price.', 1, 4, '2019-03-06 09:39:36', '2019-03-06 12:07:49', 1),
(6, 'How does the 14-day trial work?', 'Use the sign-up form to quickly create a new account. You\'ll have instant access to all Bizzsalon features for 14 days. There\'s no need to provide any payment details at this point in time.', 1, 6, '2019-03-06 09:39:55', '2019-03-06 12:05:46', 1),
(7, 'Can customers book add-on services?', 'Yes. If you activate the \"Provide Multiple Services\" feature', 1, 5, '2019-03-06 09:40:17', '2019-03-07 06:19:54', 1),
(8, 'What happens when my trial period ends?', 'Our support team will contact you to discuss your payment options before your trial expires...', 1, 7, '2019-03-06 09:40:35', '2019-03-06 12:09:49', 1),
(9, 'Is there anything to install?', 'No, Bizzsalon works &ldquo;in the cloud&rdquo;. You can book online 24/7, use and access Bizzsalon from any device and you always have the latest updates', 1, 8, '2019-03-06 09:40:52', '2019-03-06 12:08:12', 1),
(10, 'I have multiple sites, am I eligible for a discount?', 'We offer great discounts on multiple site subscriptions. Contact our support team to let us know your personal requirements.', 1, 9, '2019-03-06 09:41:14', '2019-03-06 12:08:00', 1),
(11, 'What kind of computer do I need?', 'Bizzsalon runs on any modern computer, desktop, laptop, tablet and it supports Mac and PC and can run on an iPad with ease.', 1, 10, '2019-03-06 09:41:33', '2019-03-08 13:48:18', 1),
(12, 'What Payment Methods Do You Accept?', 'Pay for your plan with Visa, MasterCard or American Express.', 1, 11, '2019-03-06 09:41:50', '2019-03-06 12:10:15', 1),
(13, 'Can I downgrade my plan?', 'Yes. We want Bizzsalon to meet your business needs all the time, whether you\'re growing or scaling back. You can upgrade or downgrade at any time.', 1, 12, '2019-03-06 09:42:08', '2019-03-06 12:05:33', 1),
(14, 'How Much Do SMS Notifications Cost?', 'Sri Lanka: $0.007 per text message. All other countries: USD 0.075 per text message', 1, 13, '2019-03-06 09:42:24', '2019-03-06 12:06:05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_licences`
--

CREATE TABLE `sw_licences` (
  `id` int(11) NOT NULL,
  `ip` varchar(55) NOT NULL,
  `domain` varchar(155) NOT NULL,
  `licence_key` varchar(155) NOT NULL,
  `active_from` date NOT NULL,
  `expire_on` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_licences`
--

INSERT INTO `sw_licences` (`id`, `ip`, `domain`, `licence_key`, `active_from`, `expire_on`, `status`) VALUES
(1, '172.31.23.181', 'bizzsalon.com', 'FGGJ68KHK876786JHG', '2019-04-01', '2019-11-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_location_notify_log`
--

CREATE TABLE `sw_location_notify_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_location_notify_log`
--

INSERT INTO `sw_location_notify_log` (`id`, `user_id`, `location_id`, `created_at`, `status`) VALUES
(1, 5, 26928, '2019-09-28 11:49:08', 1),
(2, 5, 26923, '2019-09-28 14:02:59', 1),
(3, 5, 26920, '2019-09-28 14:04:41', 1),
(4, 69, 26921, '2019-09-29 14:57:50', 1),
(5, 5, 26918, '2019-09-30 12:03:48', 1),
(6, 5, 26910, '2019-09-30 12:05:06', 1),
(7, 6, 26917, '2019-09-30 12:55:05', 1),
(8, 6, 26918, '2019-09-30 12:55:49', 1),
(9, 69, 26917, '2019-09-30 16:02:46', 1),
(10, 6, 26922, '2019-10-01 15:30:43', 1),
(11, 139, 26923, '2019-10-09 18:39:46', 1),
(12, 5, 26972, '2019-10-11 17:39:53', 1),
(13, 140, 26933, '2019-10-11 18:31:58', 1),
(14, 140, 26924, '2019-10-17 16:31:41', 1),
(15, 140, 26918, '2019-10-21 12:58:38', 1),
(16, 140, 26921, '2019-10-21 13:00:46', 1),
(17, 139, 26918, '2019-10-21 13:05:23', 1),
(18, 5, 26935, '2019-10-23 11:47:38', 1),
(19, 5, 26938, '2019-10-23 11:48:13', 1),
(20, 139, 26919, '2019-10-26 09:47:51', 1),
(21, 69, 26924, '2019-10-26 14:48:28', 1),
(22, 176, 26923, '2019-10-26 18:09:23', 1),
(23, 174, 26922, '2019-10-31 11:14:39', 1),
(24, 209, 26920, '2019-11-06 15:25:24', 1),
(25, 222, 26918, '2019-11-13 14:25:41', 1),
(26, 176, 26927, '2019-11-22 10:04:25', 1),
(27, 250, 26927, '2019-11-22 10:06:51', 1),
(28, 69, 48364, '2019-11-25 17:20:12', 1),
(29, 69, 48365, '2019-11-25 17:26:34', 1),
(30, 244, 48363, '2019-11-25 17:29:25', 1),
(31, 69, 48366, '2019-11-25 17:43:44', 1),
(32, 69, 48367, '2019-11-26 11:29:43', 1),
(33, 207, 48369, '2019-12-02 14:33:32', 1),
(34, 204, 26924, '2019-12-03 13:23:12', 1),
(35, 204, 26919, '2019-12-03 13:46:10', 1),
(36, 268, 48371, '2019-12-03 15:22:35', 1),
(37, 152, 48362, '2019-12-05 14:14:19', 1),
(38, 275, 48373, '2019-12-06 13:56:23', 1),
(39, 289, 48370, '2019-12-09 15:16:57', 1),
(40, 2, 26924, '2020-10-07 10:13:53', 1),
(41, 152, 26920, '2020-10-13 14:29:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_notifications`
--

CREATE TABLE `sw_notifications` (
  `id` int(11) NOT NULL,
  `notify_from` int(11) NOT NULL,
  `notify_to` int(11) NOT NULL,
  `type` varchar(125) NOT NULL,
  `title` varchar(55) DEFAULT NULL,
  `message` varchar(250) NOT NULL,
  `is_notify` tinyint(2) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL,
  `notify_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_notifications`
--

INSERT INTO `sw_notifications` (`id`, `notify_from`, `notify_to`, `type`, `title`, `message`, `is_notify`, `ref_id`, `notify_on`, `status`) VALUES
(1, 0, 209, 'course_approved', ' Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 27, '2019-11-06 16:07:39', 1),
(2, 0, 204, 'course_rejected', ' Course  Rejected', 'Your registered course Course1 has been rejected by Admin. ', 0, 26, '2019-11-06 16:07:48', 1),
(3, 0, 70, 'course_approved', '  Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 2, '2019-11-07 11:02:11', 1),
(4, 0, 70, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 2, '2019-11-07 11:11:00', 1),
(5, 5, 1, 'activity_submited', 'Activity Submited', 'Merlin has been submited activity', 0, 42, '2019-11-07 11:16:36', 1),
(6, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 44, '2019-11-07 12:14:33', 1),
(7, 0, 212, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 28, '2019-11-07 15:07:12', 1),
(8, 0, 212, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 28, '2019-11-07 15:19:25', 1),
(9, 0, 212, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 28, '2019-11-07 15:22:27', 1),
(10, 0, 212, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 28, '2019-11-07 15:27:03', 1),
(11, 212, 210, 'activity_submited', 'Activity Submited', 'rohan has been submited activity', 0, 45, '2019-11-07 15:29:43', 1),
(12, 212, 210, 'activity_submited', 'Activity Submited', 'rohan has been submited activity', 0, 46, '2019-11-07 16:32:51', 1),
(13, 0, 212, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 29, '2019-11-07 17:23:11', 1),
(14, 212, 210, 'activity_submited', 'Activity Submited', 'rohan has been submited activity', 0, 47, '2019-11-07 17:27:28', 1),
(15, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 48, '2019-11-08 11:36:55', 1),
(16, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 49, '2019-11-08 11:37:06', 1),
(17, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 50, '2019-11-08 11:37:40', 1),
(18, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 51, '2019-11-08 11:41:32', 1),
(19, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 52, '2019-11-08 11:41:41', 1),
(20, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 53, '2019-11-08 11:41:46', 1),
(21, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 54, '2019-11-08 11:41:51', 1),
(22, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 55, '2019-11-08 11:42:03', 1),
(23, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 56, '2019-11-08 11:42:09', 1),
(24, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 57, '2019-11-08 11:42:15', 1),
(25, 176, 1, 'activity_submited', 'Activity Submited', 'Estrrado has been submited activity', 0, 58, '2019-11-08 11:42:27', 1),
(26, 0, 204, 'course_rejected', 'Course Rejected', 'Your registered course Course1 has been rejected by Admin. ', 0, 26, '2019-11-08 17:05:48', 1),
(27, 0, 204, 'course_rejected', 'Course Rejected', 'Your registered course Course1 has been rejected by Admin. ', 0, 26, '2019-11-08 17:10:36', 1),
(28, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 59, '2019-11-11 10:21:28', 1),
(29, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 43, '2019-11-13 11:48:57', 1),
(30, 0, 221, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 33, '2019-11-13 13:47:35', 1),
(31, 0, 221, 'course_approved', 'Course Approved', 'Your registered course Course8 has been approved by Admin. ', 0, 34, '2019-11-13 13:50:33', 1),
(32, 0, 221, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 35, '2019-11-13 15:52:29', 1),
(33, 0, 222, 'course_approved', 'Course Approved', 'Your registered course Course8 has been approved by Admin. ', 0, 36, '2019-11-13 16:01:04', 1),
(34, 0, 223, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 37, '2019-11-13 16:17:41', 1),
(35, 0, 223, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 38, '2019-11-13 16:21:13', 1),
(36, 0, 223, 'course_approved', 'Course Approved', 'Your registered course Course8 has been approved by Admin. ', 0, 39, '2019-11-13 16:25:07', 1),
(37, 0, 224, 'course_rejected', 'Course Rejected', 'Your registered course swimming course999. This is a testing course has been rejected by Admin. ', 0, 40, '2019-11-13 18:36:08', 1),
(38, 0, 224, 'course_approved', 'Course Approved', 'Your registered course swimming course999. This is a testing course has been approved by Admin. ', 0, 41, '2019-11-13 18:36:48', 1),
(39, 224, 210, 'activity_submited', 'Activity Submited', 'fini has been submited activity', 0, 63, '2019-11-14 14:05:36', 1),
(40, 0, 209, 'course_rejected', 'Course Rejected', 'Your registered course testing course for swimming has been rejected by Admin. ', 0, 30, '2019-11-18 14:34:57', 1),
(41, 0, 177, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 32, '2019-11-18 14:35:05', 1),
(42, 0, 204, 'course_approved', 'Course Approved', 'Your registered course testing course for swimming has been approved by Admin. ', 0, 31, '2019-11-18 14:51:41', 1),
(43, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 64, '2019-11-18 14:53:11', 1),
(44, 0, 204, 'course_approved', 'Course Approved', 'Your registered course swimming course999. This is a testing course has been approved by Admin. ', 0, 42, '2019-11-18 16:55:25', 1),
(45, 0, 240, 'course_approved', 'Course Approved', 'Your registered course Learn ABC of swimming has been approved by Admin. ', 0, 43, '2019-11-19 16:38:11', 1),
(46, 0, 238, 'course_approved', 'Course Approved', 'Your registered course Learn ABC of swimming has been approved by Admin. ', 0, 45, '2019-11-20 15:40:50', 1),
(47, 0, 238, 'course_approved', 'Course Approved', 'Your registered course swimming course999. This is a testing course has been approved by Admin. ', 0, 46, '2019-11-20 15:48:45', 1),
(48, 238, 210, 'activity_submited', 'Activity Submited', 'aqil has been submited activity', 0, 66, '2019-11-20 17:32:13', 1),
(49, 238, 210, 'activity_submited', 'Activity Submited', 'aqil has been submited activity', 0, 67, '2019-11-20 17:48:55', 1),
(50, 1, 6, 'request_approved', 'Session Request Approved', 'Session request hes been approved by Merlin Sundar Singh', 0, 2, '2019-11-20 18:36:49', 1),
(51, 1, 177, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 93, '2019-11-20 18:40:50', 1),
(52, 1, 177, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 95, '2019-11-20 18:41:12', 1),
(53, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 43, '2019-11-21 14:27:28', 1),
(54, 1, 139, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 17, '2019-11-21 16:32:31', 1),
(55, 0, 250, 'course_approved', 'Course Approved', 'Your registered course Course5 has been approved by Admin. ', 0, 48, '2019-11-22 10:10:51', 1),
(56, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 106, '2019-11-22 11:05:51', 1),
(57, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 104, '2019-11-22 11:05:55', 1),
(58, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 61, '2019-11-22 11:37:27', 1),
(59, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-11-22 11:38:34', 1),
(60, 0, 251, 'course_approved', 'Course Approved', 'Your registered course Course8 has been approved by Admin. ', 0, 49, '2019-11-22 15:20:55', 1),
(61, 210, 238, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 189, '2019-11-22 18:29:43', 1),
(62, 224, 210, 'activity_submited', 'Activity Submited', 'fini has been submited activity', 0, 68, '2019-11-22 18:37:59', 1),
(63, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 69, '2019-11-25 11:30:04', 1),
(64, 0, 259, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 50, '2019-11-25 15:48:11', 1),
(65, 0, 259, 'course_rejected', 'Course Rejected', 'Your registered course Course7 has been rejected by Admin. ', 0, 51, '2019-11-25 15:51:19', 1),
(66, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 70, '2019-11-25 15:54:46', 1),
(67, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 71, '2019-11-25 16:19:35', 1),
(68, 1, 6, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 19, '2019-11-25 16:53:50', 1),
(69, 1, 177, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 48, '2019-11-25 17:14:56', 1),
(70, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 72, '2019-11-26 10:31:04', 1),
(71, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 73, '2019-11-26 10:38:49', 1),
(72, 0, 147, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 52, '2019-11-26 10:44:00', 1),
(73, 0, 147, 'course_approved', 'Course Approved', 'Your registered course Mobile app test course has been approved by Admin. ', 0, 54, '2019-11-26 11:19:15', 1),
(74, 0, 251, 'course_approved', 'Course Approved', 'Your registered course Course3 has been approved by Admin. ', 0, 53, '2019-11-26 11:24:55', 1),
(75, 69, 1, 'activity_submited', 'Activity Submited', 'arya stark has been submited activity', 0, 74, '2019-11-26 11:37:41', 1),
(76, 1, 177, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 98, '2019-11-26 14:44:56', 1),
(77, 1, 177, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 88, '2019-11-26 14:45:16', 1),
(78, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 75, '2019-11-27 10:50:08', 1),
(79, 0, 176, 'new_course', 'New Course', 'New course has been launched at Labis', 0, 11, '2019-11-27 16:56:34', 1),
(80, 0, 250, 'new_course', 'New Course', 'New course has been launched at Labis', 0, 11, '2019-11-27 16:56:34', 1),
(81, 1, 6, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 15, '2019-11-27 17:22:04', 1),
(82, 1, 6, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 19, '2019-11-27 17:32:36', 1),
(83, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 72, '2019-11-27 18:09:53', 1),
(84, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 72, '2019-11-27 18:12:47', 1),
(85, 0, 204, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 24, '2019-11-27 18:12:47', 1),
(86, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 107, '2019-11-27 18:17:21', 1),
(87, 0, 204, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 24, '2019-11-27 18:17:22', 1),
(88, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 76, '2019-11-28 10:10:23', 1),
(89, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 77, '2019-11-28 10:11:47', 1),
(90, 210, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 169, '2019-11-28 10:27:12', 1),
(91, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 78, '2019-11-28 10:29:26', 1),
(92, 210, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 78, '2019-11-28 10:31:50', 1),
(93, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 79, '2019-11-28 11:03:09', 1),
(94, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 80, '2019-11-28 11:14:42', 1),
(95, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 81, '2019-11-28 11:16:55', 1),
(96, 210, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 81, '2019-11-28 11:17:26', 1),
(97, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 82, '2019-11-28 11:19:29', 1),
(98, 210, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 76, '2019-11-28 11:22:37', 1),
(99, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 83, '2019-11-28 11:58:15', 1),
(100, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 84, '2019-11-28 11:58:39', 1),
(101, 0, 251, 'course_approved', 'Course Approved', 'Your registered course swimming course999. This is a testing course has been approved by Admin. ', 0, 55, '2019-11-28 12:00:18', 1),
(102, 2, 1, 'activity_submited', 'Activity Submited', 'Student One has been submited activity', 0, 8, '2019-11-28 13:42:43', 1),
(103, 0, 6, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 18, '2019-11-28 14:01:04', 1),
(104, 0, 69, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 18, '2019-11-28 14:01:04', 1),
(105, 0, 261, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 56, '2019-11-28 14:07:02', 1),
(106, 261, 260, 'activity_submited', 'Activity Submited', 'anamika has been submited activity', 0, 87, '2019-11-28 14:08:30', 1),
(107, 261, 260, 'activity_submited', 'Activity Submited', 'anamika has been submited activity', 0, 88, '2019-11-28 14:10:02', 1),
(108, 0, 176, 'new_course', 'New Course', 'New course has been launched at Kelapa Sawit', 0, 19, '2019-11-28 14:27:09', 1),
(109, 1, 2, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 8, '2019-11-28 14:33:08', 1),
(110, 2, 1, 'activity_submited', 'Activity Submited', 'Student One has been submited activity', 0, 89, '2019-11-28 14:34:27', 1),
(111, 1, 2, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 72, '2019-11-28 14:35:28', 1),
(112, 2, 1, 'activity_submited', 'Activity Submited', 'Student One has been submited activity', 0, 90, '2019-11-28 14:36:08', 1),
(113, 1, 2, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 90, '2019-11-28 14:36:42', 1),
(114, 1, 2, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 90, '2019-11-28 14:52:19', 1),
(115, 2, 1, 'activity_submited', 'Activity Submited', 'Student One has been submited activity', 0, 91, '2019-11-28 15:28:10', 1),
(116, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 62, '2019-11-28 17:17:00', 1),
(117, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 92, '2019-11-28 17:17:14', 1),
(118, 210, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 172, '2019-11-28 17:22:23', 1),
(119, 210, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by riya', 0, 169, '2019-11-28 17:25:43', 1),
(120, 0, 6, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 20, '2019-11-29 11:39:37', 1),
(121, 0, 69, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 20, '2019-11-29 11:39:37', 1),
(122, 0, 176, 'new_course', 'New Course', 'New course has been launched at Kelapa Sawit', 0, 20, '2019-11-29 11:39:46', 1),
(123, 0, 209, 'new_course', 'New Course', 'New course has been launched at Buloh Kasap', 0, 21, '2019-11-29 13:28:20', 1),
(124, 0, 209, 'new_course', 'New Course', 'New course has been launched at Buloh Kasap', 0, 22, '2019-11-29 13:41:09', 1),
(125, 0, 176, 'new_course', 'New Course', 'New course has been launched at Kelapa Sawit', 0, 12, '2019-11-29 13:54:33', 1),
(126, 0, 238, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 47, '2019-11-29 15:19:12', 1),
(127, 0, 207, 'new_course', 'New Course', 'New course has been launched at dvfydguvb', 0, 23, '2019-12-02 14:34:27', 1),
(128, 0, 69, 'new_course', 'New Course', 'New course has been launched at abc', 0, 23, '2019-12-02 14:35:52', 1),
(129, 0, 174, 'new_course', 'New Course', 'New course has been launched at Johor Bahru', 0, 1, '2019-12-02 14:36:24', 1),
(130, 0, 176, 'new_course', 'New Course', 'New course has been launched at Kelapa Sawit', 0, 24, '2019-12-02 15:09:34', 1),
(131, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-03 13:39:12', 1),
(132, 0, 204, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 24, '2019-12-03 13:39:13', 1),
(133, 0, 204, 'new_course', 'New Course', 'New course has been launched at Bukit Bakri', 0, 8, '2019-12-03 13:46:34', 1),
(134, 0, 268, 'new_course', 'New Course', 'New course has been launched at Vellayambalam', 0, 25, '2019-12-03 15:25:26', 1),
(135, 0, 268, 'course_approved', 'Course Approved', 'Your registered course Deepak has been approved by Admin. ', 0, 57, '2019-12-03 15:30:57', 1),
(136, 268, 267, 'activity_submited', 'Activity Submited', 'vishnu has been submited activity', 0, 93, '2019-12-03 15:31:36', 1),
(137, 268, 267, 'activity_submited', 'Activity Submited', 'vishnu has been submited activity', 0, 94, '2019-12-03 15:32:32', 1),
(138, 267, 268, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by joble', 0, 93, '2019-12-03 15:35:31', 1),
(139, 0, 268, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 57, '2019-12-03 15:35:32', 1),
(140, 267, 268, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by joble', 0, 242, '2019-12-03 15:36:08', 1),
(141, 268, 267, 'activity_submited', 'Activity Submited', 'vishnu has been submited activity', 0, 95, '2019-12-03 15:37:15', 1),
(142, 0, 240, 'course_approved', 'Course Approved', 'Your registered course swimming course999. This is a testing course has been approved by Admin. ', 0, 44, '2019-12-03 15:39:34', 1),
(143, 267, 268, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by joble', 0, 241, '2019-12-03 15:40:02', 1),
(144, 0, 268, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 57, '2019-12-03 15:40:03', 1),
(145, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 96, '2019-12-03 17:10:35', 1),
(146, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 99, '2019-12-03 17:24:48', 1),
(147, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 205, '2019-12-03 17:25:16', 1),
(148, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 100, '2019-12-03 17:25:50', 1),
(149, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 205, '2019-12-03 17:26:08', 1),
(150, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 101, '2019-12-03 17:26:55', 1),
(151, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 205, '2019-12-03 17:27:06', 1),
(152, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 102, '2019-12-03 17:56:57', 1),
(153, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 103, '2019-12-03 18:05:49', 1),
(154, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 104, '2019-12-03 18:06:03', 1),
(155, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 207, '2019-12-03 18:06:45', 1),
(156, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 206, '2019-12-03 18:06:48', 1),
(157, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 205, '2019-12-03 18:06:51', 1),
(158, 0, 259, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 50, '2019-12-03 18:06:51', 1),
(159, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 204, '2019-12-03 18:06:54', 1),
(160, 0, 259, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 50, '2019-12-03 18:06:54', 1),
(161, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 203, '2019-12-03 18:06:57', 1),
(162, 0, 259, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 50, '2019-12-03 18:06:57', 1),
(163, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 98, '2019-12-04 10:27:51', 1),
(164, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 97, '2019-12-04 10:30:49', 1),
(165, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 105, '2019-12-04 11:52:59', 1),
(166, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-04 13:07:33', 1),
(167, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 106, '2019-12-04 13:20:04', 1),
(168, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-04 13:20:51', 1),
(169, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 107, '2019-12-04 13:26:25', 1),
(170, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-04 13:26:47', 1),
(171, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 108, '2019-12-04 14:15:51', 1),
(172, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-04 14:16:24', 1),
(173, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 107, '2019-12-04 14:16:27', 1),
(174, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 106, '2019-12-04 14:16:28', 1),
(175, 0, 204, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 24, '2019-12-04 14:16:29', 1),
(176, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 109, '2019-12-04 15:33:22', 1),
(177, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 110, '2019-12-04 15:33:47', 1),
(178, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 111, '2019-12-04 15:45:14', 1),
(179, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 108, '2019-12-04 15:46:00', 1),
(180, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 112, '2019-12-04 15:53:57', 1),
(181, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 85, '2019-12-04 16:49:48', 1),
(182, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 106, '2019-12-04 16:51:54', 1),
(183, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 107, '2019-12-04 16:52:16', 1),
(184, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 113, '2019-12-05 11:29:20', 1),
(185, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 108, '2019-12-05 11:31:04', 1),
(186, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 105, '2019-12-05 11:33:23', 1),
(187, 1, 204, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 105, '2019-12-05 11:33:25', 1),
(188, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 114, '2019-12-05 12:09:55', 1),
(189, 259, 1, 'activity_submited', 'Activity Submited', 'vyka has been submited activity', 0, 115, '2019-12-05 12:11:29', 1),
(190, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 115, '2019-12-05 12:13:09', 1),
(191, 0, 259, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 50, '2019-12-05 12:13:10', 1),
(192, 1, 139, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 34, '2019-12-05 13:55:06', 1),
(193, 1, 139, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 37, '2019-12-05 13:55:09', 1),
(194, 0, 139, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 9, '2019-12-05 13:55:09', 1),
(195, 1, 139, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 36, '2019-12-05 13:55:12', 1),
(196, 1, 139, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 33, '2019-12-05 13:55:15', 1),
(197, 0, 139, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 9, '2019-12-05 13:55:15', 1),
(198, 0, 273, 'course_approved', 'Course Approved', 'Your registered course Learn ABC of swimming has been approved by Admin. ', 0, 58, '2019-12-05 17:34:08', 1),
(199, 0, 270, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 59, '2019-12-06 09:43:44', 1),
(200, 0, 270, 'course_approved', 'Course Approved', 'Your registered course sc7 has been approved by Admin. ', 0, 60, '2019-12-06 09:50:58', 1),
(201, 0, 271, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 61, '2019-12-06 09:53:17', 1),
(202, 271, 210, 'activity_submited', 'Activity Submited', 'geethu has been submited activity', 0, 116, '2019-12-06 09:55:38', 1),
(203, 269, 210, 'activity_submited', 'Activity Submited', 'amal has been submited activity', 0, 117, '2019-12-06 09:58:47', 1),
(204, 271, 210, 'activity_submited', 'Activity Submited', 'geethu has been submited activity', 0, 118, '2019-12-06 10:01:42', 1),
(205, 210, 271, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 247, '2019-12-06 10:03:15', 1),
(206, 0, 271, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 61, '2019-12-06 10:03:16', 1),
(207, 210, 271, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 248, '2019-12-06 10:03:20', 1),
(208, 0, 271, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 61, '2019-12-06 10:03:21', 1),
(209, 210, 271, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by riya', 0, 249, '2019-12-06 10:03:49', 1),
(210, 0, 271, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 61, '2019-12-06 10:03:49', 1),
(211, 0, 275, 'new_course', 'New Course', 'New course has been launched at marina bay', 0, 28, '2019-12-06 14:00:43', 1),
(212, 0, 168, 'course_approved', 'Course Approved', 'Your registered course From 1K to swimming 4K has been approved by Admin. ', 0, 64, '2019-12-06 17:13:34', 1),
(213, 0, 278, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 62, '2019-12-06 17:13:39', 1),
(214, 0, 278, 'course_approved', 'Course Approved', 'Your registered course Developing your skills as a swimmer. has been approved by Admin. ', 0, 63, '2019-12-06 17:13:44', 1),
(215, 168, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 122, '2019-12-06 17:18:50', 1),
(216, 1, 168, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 122, '2019-12-06 17:21:41', 1),
(217, 0, 168, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 64, '2019-12-06 17:21:42', 1),
(218, 0, 168, 'course_approved', 'Course Approved', 'Your registered course BASIC SKILL FOR SWIMMING COURSE has been approved by Admin. ', 0, 65, '2019-12-06 17:23:45', 1),
(219, 168, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 123, '2019-12-06 17:29:07', 1),
(220, 1, 168, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 267, '2019-12-06 17:29:23', 1),
(221, 0, 278, 'course_approved', 'Course Approved', 'Your registered course From 1K to swimming 4K has been approved by Admin. ', 0, 66, '2019-12-06 17:32:51', 1),
(222, 278, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 124, '2019-12-06 17:33:20', 1),
(223, 278, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 125, '2019-12-06 17:33:32', 1),
(224, 1, 278, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 273, '2019-12-06 17:33:34', 1),
(225, 0, 278, 'near_to_end', 'Nearing to End', 'You  have 1 more  activities pending to complete ', 0, 66, '2019-12-06 17:33:35', 1),
(226, 1, 278, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 274, '2019-12-06 17:33:41', 1),
(227, 0, 278, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 66, '2019-12-06 17:33:42', 1),
(228, 278, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 126, '2019-12-06 17:37:36', 1),
(229, 0, 275, 'course_approved', 'Course Approved', 'Your registered course coursename345 has been approved by Admin. ', 0, 67, '2019-12-06 17:37:53', 1),
(230, 1, 278, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 126, '2019-12-06 17:38:51', 1),
(231, 0, 278, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 66, '2019-12-06 17:38:52', 1),
(232, 278, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 127, '2019-12-06 17:39:28', 1),
(233, 1, 278, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 127, '2019-12-06 17:39:53', 1),
(234, 0, 278, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 66, '2019-12-06 17:39:53', 1),
(235, 278, 1, 'activity_submited', 'Activity Submited', 'Monish has been submited activity', 0, 128, '2019-12-06 17:40:45', 1),
(236, 1, 278, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 128, '2019-12-06 17:41:34', 1),
(237, 0, 278, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 66, '2019-12-06 17:41:34', 1),
(238, 275, 225, 'activity_submited', 'Activity Submited', 'nikku has been submited activity', 0, 129, '2019-12-06 17:47:21', 1),
(239, 275, 225, 'activity_submited', 'Activity Submited', 'nikku has been submited activity', 0, 130, '2019-12-09 09:51:39', 1),
(240, 225, 275, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by haifa', 0, 276, '2019-12-09 09:55:46', 1),
(241, 225, 275, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by haifa', 0, 129, '2019-12-09 10:02:58', 1),
(242, 0, 275, 'near_to_end', 'Nearing to End', 'You  have 2 more  activities pending to complete ', 0, 67, '2019-12-09 10:02:59', 1),
(243, 275, 225, 'activity_submited', 'Activity Submited', 'nikku has been submited activity', 0, 132, '2019-12-09 11:18:53', 1),
(244, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 121, '2019-12-09 11:30:32', 1),
(245, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 121, '2019-12-09 12:41:39', 1),
(246, 0, 289, 'new_course', 'New Course', 'New course has been launched at Aries Estrrado Technologies', 0, 29, '2019-12-09 16:25:15', 1),
(247, 0, 289, 'course_rejected', 'Course Rejected', 'Your registered course aries swimming course has been rejected by Admin. ', 0, 68, '2019-12-09 16:40:33', 1),
(248, 0, 289, 'course_rejected', 'Course Rejected', 'Your registered course aries swimming course has been rejected by Admin. ', 0, 69, '2019-12-09 16:49:02', 1),
(249, 0, 289, 'course_approved', 'Course Approved', 'Your registered course aries swimming course has been approved by Admin. ', 0, 70, '2019-12-09 17:12:05', 1),
(250, 0, 289, 'new_course', 'New Course', 'New course has been launched at Aries Estrrado Technologies', 0, 30, '2019-12-10 15:19:30', 1),
(251, 0, 289, 'course_approved', 'Course Approved', 'Your registered course aries swimming class has been approved by Admin. ', 0, 71, '2019-12-10 16:04:04', 1),
(252, 289, 293, 'activity_submited', 'Activity Submited', 'ester has been submited activity', 0, 135, '2019-12-10 16:05:55', 1),
(253, 293, 289, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by sachin t', 0, 135, '2019-12-10 16:25:00', 1),
(254, 289, 293, 'activity_submited', 'Activity Submited', 'ester has been submited activity', 0, 136, '2019-12-10 16:50:58', 1),
(255, 293, 289, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by sachin t', 0, 136, '2019-12-10 16:52:50', 1),
(256, 0, 289, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 71, '2019-12-10 16:52:50', 1),
(257, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 133, '2019-12-11 11:03:26', 1),
(258, 1, 204, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 133, '2019-12-11 11:08:40', 1),
(259, 269, 210, 'activity_submited', 'Activity Submited', 'amal has been submited activity', 0, 120, '2019-12-12 13:38:23', 1),
(260, 0, 204, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 72, '2019-12-12 13:46:54', 1),
(261, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 138, '2019-12-12 13:49:11', 1),
(262, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 139, '2019-12-12 13:54:37', 1),
(263, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 140, '2019-12-12 14:13:46', 1),
(264, 204, 1, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 137, '2019-12-12 18:06:41', 1),
(265, 204, 210, 'activity_submited', 'Activity Submited', 'simi has been submited activity', 0, 141, '2019-12-16 10:57:37', 1),
(266, 1, 177, 'activity_rejected', 'Activity Rejected', 'Submitted activity has been rejected by Merlin Sundar Singh', 0, 103, '2020-04-11 10:06:47', 1),
(267, 1, 259, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 203, '2020-04-11 10:07:03', 1),
(268, 0, 259, 'near_to_end', 'Nearing to End', 'You  have 0 more  activities pending to complete ', 0, 50, '2020-04-11 10:07:04', 1),
(269, 1, 143, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 41, '2020-05-21 12:14:28', 1),
(270, 1, 2, 'activity_approved', 'Activity Approved', 'Submitted activity has been approved by Merlin Sundar Singh', 0, 91, '2020-05-25 11:49:43', 1),
(271, 152, 1, 'activity_submited', 'Activity Submited', 'Deepu has been submited activity', 0, 142, '2020-06-25 19:13:53', 1),
(272, 0, 69, 'new_course', 'New Course', 'New course has been launched at Chaah', 0, 32, '2020-10-13 15:11:39', 1),
(273, 152, 1, 'activity_submited', 'Activity Submited', 'Deepu has been submited activity', 0, 143, '2020-10-21 11:06:50', 1),
(274, 152, 1, 'activity_submited', 'Activity Submited', 'Deepu has been submited activity', 0, 144, '2020-10-21 11:20:13', 1),
(275, 152, 1, 'activity_submited', 'Activity Submited', 'Deepu has been submited activity', 0, 145, '2020-10-21 11:28:58', 1),
(276, 0, 6, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 33, '2020-10-21 14:26:18', 1),
(277, 0, 69, 'new_course', 'New Course', 'New course has been launched at Bandar Maharani', 0, 33, '2020-10-21 14:26:18', 1),
(278, 0, 304, 'course_approved', 'Course Approved', 'Your registered course Swimming course 01 has been approved by Admin. ', 0, 75, '2020-10-21 14:30:50', 1),
(279, 0, 69, 'new_course', 'New Course', 'New course has been launched at brazil', 0, 34, '2020-10-21 15:04:19', 1),
(280, 0, 152, 'new_course', 'New Course', 'New course has been launched at Buloh Kasap', 0, 35, '2020-10-21 15:28:14', 1),
(281, 0, 302, 'course_approved', 'Course Approved', 'Your registered course Bond Safari has been approved by Admin. ', 0, 77, '2020-10-21 15:45:40', 1),
(282, 0, 302, 'course_approved', 'Course Approved', 'Your registered course Bond Safari has been approved by Admin. ', 0, 76, '2020-10-21 16:19:36', 1),
(283, 0, 302, 'course_rejected', 'Course Rejected', 'Your registered course Course2 has been rejected by Admin. ', 0, 78, '2020-10-21 16:31:00', 1),
(284, 0, 302, 'course_rejected', 'Course Rejected', 'Your registered course Course2 has been rejected by Admin. ', 0, 81, '2020-10-22 14:43:43', 1),
(285, 0, 304, 'course_approved', 'Course Approved', 'Your registered course Course2 has been approved by Admin. ', 0, 91, '2020-10-23 09:17:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_pages`
--

CREATE TABLE `sw_pages` (
  `id` int(11) NOT NULL,
  `identifier` varchar(55) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(155) DEFAULT NULL,
  `content` longtext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_pages`
--

INSERT INTO `sw_pages` (`id`, `identifier`, `title`, `image`, `content`, `created_on`, `modified_on`, `active`, `status`) VALUES
(1, 'home', 'Home', NULL, '', '2019-03-28 17:09:55', '2019-03-28 17:26:39', 1, 1),
(2, 'about', 'Company', 'bannerBg01.jpg', '<div class=\"col-12 nopad graybg1\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"pt-5 pb-5 txtbx col-12\">\r\n<div class=\"col-12\">\r\n<h4 class=\"mb-3\">ABOUT US</h4>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-12 mb-5\">\r\n<div class=\"container\">\r\n<div class=\"row\">\r\n<div class=\"col-12 pt-5 pb-5 txtbx\">\r\n<div class=\"col-12\">\r\n<h4 class=\"mb-3\">WHY CHOOSE US</h4>\r\n<h6 class=\"text-theme\">We offer 24X7 support:</h6>\r\n<p>Our support personnel are at your service at any time at our fully-fledged support center which not only provides assistance with troubleshooting, training and implementation but also client requested enhancements and upgrades.</p>\r\n<h6 class=\"text-theme\">We value time:</h6>\r\n<p>Time is a resource that must be well spent and we deliver solutions to our clients on time.</p>\r\n<h6 class=\"text-theme\">Our Expert Team:</h6>\r\n<p>Our team of experienced and skilled developers are always ready to understand the requirements of a company. We specialize in developing methodologies to deliver cost-effective products and services that give our clients a competitive edge.</p>\r\n<h6 class=\"text-theme\">We strive to remain flexible</h6>\r\n<p>Our flexibility helps us in developing intuitive, engaging and interactive platforms for our clients\' business. We appraise your needs in detail and select the most viable solutions which are recommended, we ensure that our clients make informed decisions and we ensure that the solution selected is both effective and viable.</p>\r\n<h6 class=\"text-theme\">We are Fully Responsive</h6>\r\n<p>The apps developed by our company are fully responsive, just like we are. We not only develop technologically high end apps but also SEO friendly fully responsive website and mobile apps for all popular platforms. We take the ideas of our clients to a new level and customize their apps that are meant to cater to niche areas.</p>\r\n<h6 class=\"text-theme\">We have Great Ideas</h6>\r\n<p>We have a host of app development tools and technologies. We specialize in Mobile Business Strategy, Responsive Web Design &amp; Development, PHP, Magneto, Java, .Net, Android and iOS. You just need to specify your requirements and we will provide you with an extremely functional, user-friendly app that is beyond your expectations.</p>\r\n<h6 class=\"text-theme\">WHY BIZZSAlON</h6>\r\n<p>A centralized solution to manage all your salons needs, Bizzsalon is an affordable, powerful and modern Salon software that is customized for independent and multi-location businesses. We will ensure that you have the right tools to grow and expand your customer base. Our cloud platform ties in with a handy mobile app to make your experience and that of your customers a breeze.</p>\r\n<p>Unleash your hidden potential to empower, grow and modernize your business through the latest technology. We will provide you with the best solutions that cater specifically to the salon and spa industry. You will have a holistic and centralized system that allows you to easily manage all your processes. Be it scheduling, marketing, building loyalty programs, and numerous other features, we make sure that our solutions handle all your requirements smoothly and efficiently.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2019-02-12 11:03:14', '2019-11-21 09:31:14', 1, 1),
(3, 'pricing', 'Pricing', 'bannerBg_1554214013.jpg', '<h3>Customize your plan</h3>\r\n<p>Add as many Staff &amp; professionals you want and make Bizzsalon suite your exact business needs, for an additional USD5/month for each additional staff &amp; professional.</p>\r\n<p class=\"mb-0\">We will work with you to make a plan tailored for your business <a href=\"https://bizzsalon.com/contact\">contact us</a></p>', '2019-02-12 11:03:14', '2019-04-05 07:43:03', 1, 1),
(4, 'features', 'Features', 'bannerBg_1554214024.jpg', '<section id=\"management\" class=\"graybg pt-5 pb-5\">\r\n<div class=\"container\">\r\n<div class=\"text mb-5\">\r\n<h2 class=\"mb-2\">Our Online Appointment Scheduling Features</h2>\r\n<p>Everything you need to run your business easily and efficiently</p>\r\n</div>\r\n<div class=\"col-12\">\r\n<div class=\"row whitebg\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Appointments</h5>\r\n<p>Easy to use and flexible, you can view all your staff, resources needed and appointment statuses in day, week or month view.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Walk In Salon Management</h5>\r\n<p>If you are a walk in business and not primarily an appointment based salon our walk in manager combined with self-check in makes client management a breeze.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Inventory Management</h5>\r\n<p>Manage your products, brands, vendors, product orders and professional stock with ease</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Mobile Apps</h5>\r\n<p>Access your appointment book to add or change appointments from any phone.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">SMS &amp; Email Marketing</h5>\r\n<p>Using SMS &amp; Email to send your clients your latest promotions and sales to expand and grow your business has never been easier.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Automated Reminders</h5>\r\n<p>Reducing no shows has never been easier with automated SMS &amp; Email Reminders and confirmations. A real money saver.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Client Management</h5>\r\n<p>Collect your customers contact information, manage their profiles and keep track of their appointment history</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Products &amp; Services</h5>\r\n<p>Manage all the products &amp; Services sold through your business including stock control, suppliers and brands.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Packages and Pre purchases</h5>\r\n<p>Packages for a number of sessions or pre purchase one service all handled automatically</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Multiple Locations</h5>\r\n<p>Easily setup your multiple office locations. Customers will be able to choose closest location to them at the time of the booking.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Taxes</h5>\r\n<p>Businesses worldwide can setup their region\'s tax (for example: VAT, HST, GST or any other custom name).</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Website plugin</h5>\r\n<p>Integrate Bizzsalon scheduling directly into your webpage with our \'pop-up\' or \'in-body\' website widgets.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Gift Vouchers</h5>\r\n<p>Gift vouchers are essential for any business and you can sell and redeem them, maintain their balances and report on usage all at a touch</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Loyalty Points</h5>\r\n<p>Configure loyalty points earned for all your products or services and then allow them to be used when making a sale and stored against the client.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Sales &amp; Promotions</h5>\r\n<p>If you have a sale then you have percentage or set discounts for all products or based on a promotion code.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Point of Sale</h5>\r\n<p>A complete point of sale where you can invoice appointments, perform product sales, refunds or print receipts.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Payment Gateways</h5>\r\n<p>Integrate directly with Bank to take credit card deposits or payments directly to your bank</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Staff Rosters, Timesheets &amp; Holidays</h5>\r\n<p>Flexible rostering means you can set up your staff hours exactly as you need them including breaks, lunch or days off.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Staff Commission &amp; incentives</h5>\r\n<p>This feature including automatic splitting between staff and payout reports for the end of day</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Staff Security</h5>\r\n<p>Configure security to restrict staff access to what you require and be automatically notified of any suspicious staff activity.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Time Zone Selection</h5>\r\n<p>Clients located in different countries/time zones will be able to receive notifications, book appointments and classes in their local time, eliminating time zone barriers.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Business Reporting</h5>\r\n<p>Know which are your best selling products, track sales and view staff performance with the extensive business reporting.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Dashboard</h5>\r\n<p>View all your businesses key metrics live to see how you are performing today against historical records</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\">\r\n<h5 class=\"mb-3\">Customer Reviews</h5>\r\n<p>Empower customers to post reviews, feedback, and testimonials. Showcase your business ratings and reviews</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-22 13:44:39', '2019-04-05 07:42:42', 1, 1),
(5, 'support', 'Support', 'bannerBg_1554214036.jpg', '<div class=\"row\">\r\n<div class=\"col-12 text\">\r\n<div class=\"wrap\">\r\n<h2>Your Bizzacc support team just got bigger</h2>\r\n<p>When you sign up for Bizzsalon you gain access to our 24/7 critical support team. Have an issue with your account? Just click or tap to start a 1-2-1 chat with a team member, who will get back to you in mere minutes.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-6 text-center\"><i class=\"mb-4\"><img src=\"https://bizzsalon.com/public/images/launch.png\" alt=\"\"></i>\r\n<h3 class=\"mb-4\">How to setup your account ?</h3>\r\n</div>\r\n<div class=\"col-lg-6 text-center\"><i class=\"mb-4\"><img src=\"https://bizzsalon.com/public/images/help.png\" alt=\"\"></i>\r\n<h3 class=\"mb-4\">How to setup your mobile app ?</h3>\r\n</div>\r\n</div>', '2019-03-28 17:32:37', '2019-05-16 06:14:33', 1, 1),
(6, 'contact', 'Contact Us', 'bannerBg_1554214046.jpg', '<div class=\"row\">\r\n<div class=\"col-12\">\r\n<h4 class=\"mb-4\">CONTACT US</h4>\r\n</div>\r\n<div class=\"col-12 mt-5 mb-5\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<p><i class=\"fa fa-map-marker\"></i><strong>DIGITAL BUSINESS ACCELERATORS (PVT) LTD</strong></p>\r\n</div>\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<p><i class=\"fa fa-mobile\"></i><strong>PHONE <small>+94 117 979 593</small></strong></p>\r\n</div>\r\n</div>\r\n</div>\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<p><i class=\"fa fa-envelope\"></i><strong>EMAIL <small>info@bizzacc.lk</small></strong></p>\r\n</div>\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<p><i class=\"fa fa-phone\"></i><strong>HOTLINE<small>+94 115 979 593</small></strong></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', '2019-02-22 13:44:39', '2019-04-24 09:51:59', 1, 1),
(7, 'terms', 'Terms & Conditions', 'bannerBg_1554214056.jpg', 'Terms &amp; Conditions', '2019-03-28 17:34:13', '2019-04-24 09:51:35', 1, 1),
(8, 'privacy', 'Privacy', 'bannerBg_1554214065.jpg', 'Privacy', '2019-03-28 17:32:37', '2019-04-24 09:51:38', 1, 1),
(9, 'location', 'Locations', 'bannerBg01.jpg', '<div class=\"container\">\r\n<section id=\"uses\" class=\"pt-5 pb-5\">\r\n<div class=\"galimg\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal1.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Malaysia</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal2.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Singapore</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal3.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Indonesia</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal4.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">philippines</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal5.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Thailand</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal6.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Taiwan</span></div>\r\n</div>\r\n<div class=\"btn btn-clr col-lg-2 col-md-2 col-sm-12 col-12 btn-blk\"\r\n<button> view more </button> </div>\r\n</div>\r\n</div>\r\n</section>\r\n</div>', '2019-11-22 04:02:26', '2020-10-05 05:52:17', 1, 1),
(10, 'course', 'Courses', 'bannerBg01.jpg', '<div class=\"container\">\r\n<section id=\"uses\" class=\"pt-5 pb-5\">\r\n<div class=\"galimg\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co1.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Freestyle-Turn</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co2.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Butterfly</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co3.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Freestyle</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co4.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">For-Babies</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co5.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Breaststroke</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/co6.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Backstroke</span></div>\r\n</div>\r\n<div class=\"btn btn-clr col-lg-2 col-md-2 col-sm-12 col-12 btn-blk\"\r\n<button> view more </button> </div>\r\n</div>\r\n</div>\r\n</section>\r\n</div>', '2019-11-22 04:23:51', '2020-10-05 05:59:37', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_password_resets`
--

CREATE TABLE `sw_password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(155) NOT NULL,
  `token` varchar(155) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sw_registered_courses`
--

CREATE TABLE `sw_registered_courses` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `complete_percent` int(11) NOT NULL DEFAULT '0',
  `reg_status` tinyint(2) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `registered_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_registered_courses`
--

INSERT INTO `sw_registered_courses` (`id`, `student_id`, `course_id`, `coach_id`, `complete_percent`, `reg_status`, `active`, `registered_at`, `status`) VALUES
(2, 70, 2, 1, 0, 1, 1, '2019-09-26 13:10:24', 1),
(3, 69, 2, 1, 0, 1, 1, '2019-09-27 11:17:07', 1),
(5, 6, 2, 1, 20, 1, 1, '2019-09-28 11:57:13', 1),
(6, 6, 1, 1, 0, 1, 1, '2019-09-28 11:58:10', 1),
(7, 69, 1, 1, 0, 1, 1, '2019-09-30 05:10:29', 1),
(9, 139, 1, 1, 0, 1, 1, '2019-10-09 08:39:50', 1),
(10, 139, 2, 1, 0, 1, 1, '2019-10-09 08:40:41', 1),
(11, 143, 1, 1, 0, 1, 1, '2019-10-09 11:55:17', 1),
(12, 142, 2, 1, 0, 1, 1, '2019-10-11 09:47:39', 1),
(13, 141, 2, 1, 0, 1, 1, '2019-10-11 09:51:04', 1),
(14, 141, 1, 1, 0, 1, 1, '2019-10-11 09:54:14', 1),
(15, 142, 1, 1, 0, 1, 1, '2019-10-11 09:54:32', 1),
(16, 70, 1, 1, 0, 1, 1, '2019-10-11 10:42:45', 1),
(17, 153, 1, 1, 0, 1, 1, '2019-10-17 11:57:25', 1),
(18, 2, 1, 1, 75, 1, 1, '2019-10-18 06:23:35', 1),
(19, 2, 2, 1, 85, 1, 1, '2019-10-18 06:42:05', 1),
(20, 153, 2, 1, 0, 1, 1, '2019-10-22 04:20:01', 1),
(21, 191, 1, 1, 0, 1, 1, '2019-10-26 12:00:38', 1),
(22, 1770000000, 1, 1, 0, 1, 1, '2019-10-26 12:46:29', 0),
(23, 177, 1, 1, 0, 1, 1, '2019-10-31 11:29:34', 1),
(24, 204, 10, 1, 0, 1, 1, '2019-11-06 08:38:53', 1),
(25, 209, 1, 1, 0, 1, 1, '2019-11-06 09:08:18', 1),
(26, 204, 1, 1, 0, 4, 0, '2019-11-06 09:08:32', 1),
(27, 209, 2, 1, 0, 1, 1, '2019-11-06 09:09:16', 1),
(28, 212, 11, 210, 0, 1, 1, '2019-11-07 09:36:25', 0),
(29, 212, 11, 210, 0, 1, 1, '2019-11-07 11:44:08', 1),
(30, 209, 11, 210, 0, 4, 0, '2019-11-08 12:06:51', 1),
(31, 204, 11, 210, 0, 1, 1, '2019-11-11 04:26:26', 1),
(32, 177, 11, 210, 0, 1, 1, '2019-11-11 07:33:20', 1),
(33, 221, 11, 210, 0, 1, 1, '2019-11-13 06:31:03', 1),
(34, 221, 8, 195, 0, 1, 1, '2019-11-13 08:19:56', 1),
(35, 221, 10, 1, 0, 1, 1, '2019-11-13 08:50:10', 1),
(36, 222, 8, 195, 0, 1, 1, '2019-11-13 09:46:46', 1),
(37, 223, 11, 210, 0, 1, 1, '2019-11-13 10:47:15', 1),
(38, 223, 10, 1, 0, 1, 1, '2019-11-13 10:51:00', 1),
(39, 223, 8, 195, 0, 1, 1, '2019-11-13 10:54:45', 1),
(40, 224, 12, 210, 0, 4, 0, '2019-11-13 13:05:01', 1),
(41, 224, 12, 210, 0, 1, 1, '2019-11-13 13:06:33', 1),
(42, 204, 12, 210, 0, 1, 1, '2019-11-18 11:24:13', 1),
(43, 240, 13, 225, 0, 1, 1, '2019-11-19 10:05:36', 1),
(44, 240, 12, 210, 0, 1, 1, '2019-11-19 11:26:48', 1),
(45, 238, 13, 225, 0, 1, 1, '2019-11-20 10:07:59', 1),
(46, 238, 12, 210, 0, 1, 1, '2019-11-20 10:18:27', 1),
(47, 238, 10, 1, 0, 1, 1, '2019-11-20 11:28:23', 1),
(48, 250, 5, 1, 0, 1, 1, '2019-11-22 04:40:22', 1),
(49, 251, 8, 195, 0, 1, 1, '2019-11-22 09:45:17', 1),
(50, 259, 10, 1, 0, 1, 1, '2019-11-25 10:17:19', 1),
(51, 259, 7, 1, 0, 4, 0, '2019-11-25 10:20:26', 1),
(52, 147, 2, 1, 0, 1, 1, '2019-11-26 05:12:57', 1),
(53, 251, 3, 1, 0, 1, 1, '2019-11-26 05:44:01', 1),
(54, 147, 16, 1, 0, 1, 1, '2019-11-26 05:48:44', 1),
(55, 251, 12, 210, 0, 1, 1, '2019-11-28 06:29:48', 1),
(56, 261, 10, 260, 0, 1, 1, '2019-11-28 08:36:24', 1),
(57, 268, 25, 267, 0, 1, 1, '2019-12-03 10:00:24', 1),
(58, 273, 13, 225, 0, 1, 1, '2019-12-05 11:56:19', 1),
(59, 270, 2, 210, 0, 1, 1, '2019-12-06 04:12:06', 1),
(60, 270, 22, 210, 0, 1, 1, '2019-12-06 04:20:47', 1),
(61, 271, 2, 210, 0, 1, 1, '2019-12-06 04:22:42', 1),
(62, 278, 10, 1, 0, 1, 1, '2019-12-06 11:38:36', 1),
(63, 278, 15, 1, 0, 1, 1, '2019-12-06 11:38:55', 1),
(64, 168, 27, 1, 0, 1, 1, '2019-12-06 11:39:27', 1),
(65, 168, 10, 1, 0, 1, 1, '2019-12-06 11:53:32', 1),
(66, 278, 27, 1, 0, 1, 1, '2019-12-06 12:02:33', 1),
(67, 275, 28, 225, 0, 1, 1, '2019-12-06 12:06:42', 1),
(68, 289, 29, 293, 0, 4, 0, '2019-12-09 11:00:36', 1),
(69, 289, 29, 293, 0, 4, 0, '2019-12-09 11:10:58', 1),
(70, 289, 29, 293, 0, 1, 1, '2019-12-09 11:24:12', 1),
(71, 289, 30, 293, 35, 1, 1, '2019-12-10 10:33:34', 1),
(72, 204, 2, 210, 0, 1, 1, '2019-12-12 08:11:49', 1),
(73, 153, 30, 293, 0, 0, 1, '2020-10-06 09:55:46', 1),
(74, 153, 3, 1, 0, 0, 1, '2020-10-07 10:49:57', 1),
(75, 304, 33, 303, 0, 1, 1, '2020-10-21 09:00:27', 1),
(76, 302, 35, 306, 100, 1, 1, '2020-10-21 10:13:17', 1),
(77, 302, 35, 306, 100, 1, 1, '2020-10-21 10:13:17', 1),
(78, 302, 2, 210, 0, 4, 0, '2020-10-21 11:00:48', 1),
(79, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(80, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(81, 302, 2, 210, 0, 4, 0, '2020-10-21 11:01:39', 1),
(82, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(83, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(84, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(85, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(86, 302, 2, 210, 0, 0, 1, '2020-10-21 11:01:39', 1),
(87, 304, 18, 210, 0, 0, 1, '2020-10-21 11:02:01', 1),
(88, 304, 18, 210, 0, 0, 1, '2020-10-21 11:02:02', 1),
(89, 304, 18, 210, 0, 0, 1, '2020-10-21 11:02:02', 1),
(90, 304, 34, 303, 0, 0, 1, '2020-10-21 11:03:04', 1),
(91, 304, 2, 210, 0, 1, 1, '2020-10-22 07:17:09', 1),
(92, 304, 8, 267, 0, 0, 1, '2020-10-22 07:18:52', 1),
(93, 304, 3, 1, 0, 0, 1, '2020-10-22 07:20:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_registered_course_activities`
--

CREATE TABLE `sw_registered_course_activities` (
  `id` int(11) NOT NULL,
  `reg_course_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `ms_id` int(11) NOT NULL,
  `activity_id` int(11) NOT NULL,
  `curr_status` tinyint(2) NOT NULL DEFAULT '0',
  `badge_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_registered_course_activities`
--

INSERT INTO `sw_registered_course_activities` (`id`, `reg_course_id`, `course_id`, `ms_id`, `activity_id`, `curr_status`, `badge_id`, `status`) VALUES
(4, 2, 2, 3, 6, 2, 3, 1),
(5, 2, 2, 3, 7, 2, 2, 1),
(6, 2, 2, 4, 8, 2, 0, 1),
(7, 3, 2, 3, 6, 0, 0, 1),
(8, 3, 2, 3, 7, 0, 0, 1),
(9, 3, 2, 4, 8, 0, 0, 1),
(15, 5, 2, 3, 6, 0, 2, 1),
(16, 5, 2, 3, 7, 0, 0, 1),
(17, 5, 2, 4, 8, 0, 0, 1),
(18, 6, 1, 1, 1, 0, 0, 1),
(19, 6, 1, 1, 2, 4, 0, 1),
(20, 6, 1, 2, 3, 3, 2, 1),
(21, 6, 1, 1, 4, 0, 0, 1),
(22, 6, 1, 1, 5, 0, 0, 1),
(23, 7, 1, 1, 1, 0, 0, 1),
(24, 7, 1, 1, 2, 0, 0, 1),
(25, 7, 1, 2, 3, 0, 0, 1),
(26, 7, 1, 1, 4, 0, 0, 1),
(27, 7, 1, 1, 5, 0, 0, 1),
(33, 9, 1, 1, 1, 3, 0, 1),
(34, 9, 1, 1, 2, 3, 0, 1),
(35, 9, 1, 2, 3, 3, 0, 1),
(36, 9, 1, 1, 4, 4, 0, 1),
(37, 9, 1, 1, 5, 3, 0, 1),
(38, 10, 2, 3, 6, 3, 0, 1),
(39, 10, 2, 3, 7, 0, 0, 1),
(40, 10, 2, 4, 8, 0, 0, 1),
(41, 11, 1, 1, 1, 3, 0, 1),
(42, 11, 1, 1, 2, 0, 0, 1),
(43, 11, 1, 2, 3, 0, 0, 1),
(44, 11, 1, 1, 4, 0, 0, 1),
(45, 11, 1, 1, 5, 0, 0, 1),
(46, 12, 2, 3, 6, 0, 0, 1),
(47, 12, 2, 3, 7, 0, 0, 1),
(48, 12, 2, 4, 8, 0, 0, 1),
(49, 13, 2, 3, 6, 0, 0, 1),
(50, 13, 2, 3, 7, 0, 0, 1),
(51, 13, 2, 4, 8, 0, 0, 1),
(52, 14, 1, 1, 1, 0, 0, 1),
(53, 14, 1, 1, 2, 0, 0, 1),
(54, 14, 1, 2, 3, 0, 0, 1),
(55, 14, 1, 1, 4, 0, 0, 1),
(56, 14, 1, 1, 5, 0, 0, 1),
(57, 15, 1, 1, 1, 0, 0, 1),
(58, 15, 1, 1, 2, 0, 0, 1),
(59, 15, 1, 2, 3, 0, 0, 1),
(60, 15, 1, 1, 4, 0, 0, 1),
(61, 15, 1, 1, 5, 0, 0, 1),
(62, 16, 1, 1, 1, 2, 0, 1),
(63, 16, 1, 1, 2, 0, 0, 1),
(64, 16, 1, 2, 3, 0, 0, 1),
(65, 16, 1, 1, 4, 0, 0, 1),
(66, 16, 1, 1, 5, 0, 0, 1),
(67, 17, 1, 1, 1, 2, 0, 1),
(68, 17, 1, 1, 2, 2, 0, 1),
(69, 17, 1, 2, 3, 0, 0, 1),
(70, 17, 1, 1, 4, 0, 0, 1),
(71, 17, 1, 1, 5, 0, 0, 1),
(72, 18, 1, 1, 1, 3, 1, 1),
(73, 18, 1, 1, 2, 0, 0, 1),
(74, 18, 1, 2, 3, 0, 0, 1),
(75, 18, 1, 1, 4, 0, 0, 1),
(76, 18, 1, 1, 5, 0, 0, 1),
(77, 19, 2, 3, 6, 3, 0, 1),
(78, 19, 2, 3, 7, 0, 0, 1),
(79, 19, 2, 4, 8, 0, 0, 1),
(80, 20, 2, 3, 6, 2, 0, 1),
(81, 20, 2, 3, 7, 2, 0, 1),
(82, 20, 2, 4, 8, 0, 0, 1),
(83, 21, 1, 1, 1, 0, 0, 1),
(84, 21, 1, 1, 2, 0, 0, 1),
(85, 21, 1, 2, 3, 0, 0, 1),
(86, 21, 1, 1, 4, 0, 0, 1),
(87, 21, 1, 1, 5, 0, 0, 1),
(88, 22, 1, 1, 1, 3, 0, 1),
(89, 22, 1, 1, 2, 0, 0, 1),
(90, 22, 1, 2, 3, 0, 0, 1),
(91, 22, 1, 1, 4, 0, 0, 1),
(92, 22, 1, 1, 5, 0, 0, 1),
(93, 23, 1, 1, 1, 3, 0, 1),
(94, 23, 1, 1, 2, 4, 0, 1),
(95, 23, 1, 2, 3, 3, 0, 1),
(96, 23, 1, 1, 4, 2, 0, 1),
(97, 23, 1, 1, 5, 2, 0, 1),
(98, 23, 1, 30, 39, 4, 0, 1),
(99, 23, 1, 30, 40, 2, 0, 1),
(100, 23, 1, 31, 41, 2, 0, 1),
(101, 23, 1, 32, 42, 2, 0, 1),
(102, 23, 1, 33, 43, 2, 0, 1),
(103, 23, 1, 33, 44, 0, 0, 1),
(104, 24, 10, 34, 45, 4, 0, 1),
(105, 24, 10, 34, 46, 2, 0, 1),
(106, 24, 10, 35, 47, 4, 0, 1),
(107, 24, 10, 35, 48, 4, 0, 1),
(108, 24, 10, 35, 49, 4, 2, 1),
(109, 25, 1, 1, 1, 0, 0, 1),
(110, 25, 1, 1, 2, 0, 0, 1),
(111, 25, 1, 2, 3, 0, 0, 1),
(112, 25, 1, 1, 4, 0, 0, 1),
(113, 25, 1, 1, 5, 0, 0, 1),
(114, 25, 1, 30, 39, 0, 0, 1),
(115, 25, 1, 30, 40, 0, 0, 1),
(116, 25, 1, 31, 41, 0, 0, 1),
(117, 25, 1, 32, 42, 0, 0, 1),
(118, 25, 1, 33, 43, 0, 0, 1),
(119, 25, 1, 33, 44, 0, 0, 1),
(120, 26, 1, 1, 1, 0, 0, 1),
(121, 26, 1, 1, 2, 0, 0, 1),
(122, 26, 1, 2, 3, 0, 0, 1),
(123, 26, 1, 1, 4, 0, 0, 1),
(124, 26, 1, 1, 5, 0, 0, 1),
(125, 26, 1, 30, 39, 0, 0, 1),
(126, 26, 1, 30, 40, 0, 0, 1),
(127, 26, 1, 31, 41, 0, 0, 1),
(128, 26, 1, 32, 42, 0, 0, 1),
(129, 26, 1, 33, 43, 0, 0, 1),
(130, 26, 1, 33, 44, 0, 0, 1),
(131, 27, 2, 3, 6, 0, 0, 1),
(132, 27, 2, 3, 7, 0, 0, 1),
(133, 27, 2, 4, 8, 0, 0, 1),
(134, 28, 11, 37, 50, 0, 0, 1),
(135, 29, 11, 37, 50, 3, 1, 1),
(136, 30, 11, 37, 50, 0, 0, 1),
(137, 31, 11, 37, 50, 2, 0, 1),
(138, 32, 11, 37, 50, 0, 0, 1),
(139, 33, 11, 37, 50, 0, 0, 1),
(140, 35, 10, 34, 45, 0, 0, 1),
(141, 35, 10, 34, 46, 0, 0, 1),
(142, 35, 10, 35, 47, 0, 0, 1),
(143, 35, 10, 35, 48, 0, 0, 1),
(144, 35, 10, 35, 49, 0, 0, 1),
(145, 37, 11, 37, 50, 0, 0, 1),
(146, 38, 10, 34, 45, 0, 0, 1),
(147, 38, 10, 34, 46, 0, 0, 1),
(148, 38, 10, 35, 47, 0, 0, 1),
(149, 38, 10, 35, 48, 0, 0, 1),
(150, 38, 10, 35, 49, 0, 0, 1),
(151, 40, 12, 40, 51, 0, 0, 1),
(152, 40, 12, 40, 52, 0, 0, 1),
(153, 40, 12, 40, 53, 0, 0, 1),
(154, 40, 12, 41, 54, 0, 0, 1),
(155, 40, 12, 41, 55, 0, 0, 1),
(156, 40, 12, 41, 56, 0, 0, 1),
(157, 40, 12, 42, 57, 0, 0, 1),
(158, 40, 12, 42, 58, 0, 0, 1),
(159, 40, 12, 42, 59, 0, 0, 1),
(160, 41, 12, 40, 51, 2, 0, 1),
(161, 41, 12, 40, 52, 2, 0, 1),
(162, 41, 12, 40, 53, 0, 0, 1),
(163, 41, 12, 41, 54, 0, 0, 1),
(164, 41, 12, 41, 55, 0, 0, 1),
(165, 41, 12, 41, 56, 0, 0, 1),
(166, 41, 12, 42, 57, 0, 0, 1),
(167, 41, 12, 42, 58, 0, 0, 1),
(168, 41, 12, 42, 59, 0, 0, 1),
(169, 42, 12, 40, 51, 4, 0, 1),
(170, 42, 12, 40, 52, 2, 0, 1),
(171, 42, 12, 40, 53, 2, 3, 1),
(172, 42, 12, 41, 54, 2, 3, 1),
(173, 42, 12, 41, 55, 2, 0, 1),
(174, 42, 12, 41, 56, 2, 0, 1),
(175, 42, 12, 42, 57, 2, 0, 1),
(176, 42, 12, 42, 58, 2, 3, 1),
(177, 42, 12, 42, 59, 2, 0, 1),
(178, 44, 12, 40, 51, 0, 0, 1),
(179, 44, 12, 40, 52, 0, 0, 1),
(180, 44, 12, 40, 53, 0, 0, 1),
(181, 44, 12, 41, 54, 0, 0, 1),
(182, 44, 12, 41, 55, 0, 0, 1),
(183, 44, 12, 41, 56, 0, 0, 1),
(184, 44, 12, 42, 57, 0, 0, 1),
(185, 44, 12, 42, 58, 0, 0, 1),
(186, 44, 12, 42, 59, 0, 0, 1),
(187, 45, 13, 44, 64, 0, 0, 1),
(188, 46, 12, 40, 51, 0, 0, 1),
(189, 46, 12, 40, 52, 3, 0, 1),
(190, 46, 12, 40, 53, 0, 0, 1),
(191, 46, 12, 41, 54, 0, 0, 1),
(192, 46, 12, 41, 55, 0, 0, 1),
(193, 46, 12, 41, 56, 0, 0, 1),
(194, 46, 12, 42, 57, 0, 0, 1),
(195, 46, 12, 42, 58, 0, 0, 1),
(196, 46, 12, 42, 59, 0, 0, 1),
(197, 46, 12, 40, 65, 0, 0, 1),
(198, 47, 10, 34, 45, 0, 0, 1),
(199, 47, 10, 34, 46, 0, 0, 1),
(200, 47, 10, 35, 47, 0, 0, 1),
(201, 47, 10, 35, 48, 0, 0, 1),
(202, 47, 10, 35, 49, 0, 0, 1),
(203, 50, 10, 34, 45, 3, 0, 1),
(204, 50, 10, 34, 46, 3, 3, 1),
(205, 50, 10, 35, 47, 3, 0, 1),
(206, 50, 10, 35, 48, 3, 0, 1),
(207, 50, 10, 35, 49, 3, 0, 1),
(208, 52, 2, 3, 6, 2, 0, 1),
(209, 52, 2, 3, 7, 0, 0, 1),
(210, 52, 2, 4, 8, 0, 0, 1),
(211, 53, 3, 5, 9, 0, 0, 1),
(212, 53, 3, 5, 10, 0, 0, 1),
(213, 53, 3, 5, 11, 0, 0, 1),
(214, 53, 3, 6, 12, 0, 0, 1),
(215, 53, 3, 6, 13, 0, 0, 1),
(216, 53, 3, 6, 14, 0, 0, 1),
(217, 53, 3, 6, 15, 0, 0, 1),
(218, 53, 3, 6, 16, 0, 0, 1),
(219, 53, 3, 7, 17, 0, 0, 1),
(220, 53, 3, 7, 18, 0, 0, 1),
(221, 53, 3, 7, 19, 0, 0, 1),
(222, 53, 3, 8, 20, 0, 0, 1),
(223, 53, 3, 8, 21, 0, 0, 1),
(224, 53, 3, 8, 22, 0, 0, 1),
(225, 53, 3, 8, 23, 0, 0, 1),
(226, 55, 12, 40, 51, 0, 0, 1),
(227, 55, 12, 40, 52, 0, 0, 1),
(228, 55, 12, 40, 53, 0, 0, 1),
(229, 55, 12, 41, 54, 0, 0, 1),
(230, 55, 12, 41, 55, 0, 0, 1),
(231, 55, 12, 41, 56, 0, 0, 1),
(232, 55, 12, 42, 57, 0, 0, 1),
(233, 55, 12, 42, 58, 0, 0, 1),
(234, 55, 12, 42, 59, 0, 0, 1),
(235, 55, 12, 40, 65, 0, 0, 1),
(236, 56, 10, 34, 45, 2, 0, 1),
(237, 56, 10, 34, 46, 2, 0, 1),
(238, 56, 10, 35, 47, 0, 0, 1),
(239, 56, 10, 35, 48, 0, 0, 1),
(240, 56, 10, 35, 49, 0, 0, 1),
(241, 57, 25, 59, 80, 3, 1, 1),
(242, 57, 25, 59, 81, 4, 0, 1),
(243, 58, 13, 44, 64, 0, 0, 1),
(244, 59, 2, 3, 6, 2, 0, 1),
(245, 59, 2, 3, 7, 0, 0, 1),
(246, 59, 2, 4, 8, 0, 0, 1),
(247, 61, 2, 3, 6, 3, 0, 1),
(248, 61, 2, 3, 7, 3, 0, 1),
(249, 61, 2, 4, 8, 3, 0, 1),
(250, 62, 10, 34, 45, 0, 0, 1),
(251, 62, 10, 34, 46, 0, 0, 1),
(252, 62, 10, 35, 47, 0, 0, 1),
(253, 62, 10, 35, 48, 0, 0, 1),
(254, 62, 10, 35, 49, 0, 0, 1),
(255, 63, 15, 51, 66, 0, 0, 1),
(256, 63, 15, 51, 67, 0, 0, 1),
(257, 63, 15, 51, 68, 0, 0, 1),
(258, 63, 15, 51, 69, 0, 0, 1),
(259, 63, 15, 51, 70, 0, 0, 1),
(260, 63, 15, 51, 71, 0, 0, 1),
(261, 63, 15, 51, 72, 0, 0, 1),
(262, 63, 15, 51, 73, 0, 0, 1),
(263, 63, 15, 52, 74, 0, 0, 1),
(264, 63, 15, 52, 75, 0, 0, 1),
(265, 63, 15, 52, 76, 0, 0, 1),
(266, 64, 27, 62, 96, 3, 3, 1),
(267, 64, 27, 62, 97, 4, 0, 1),
(268, 65, 10, 34, 45, 0, 0, 1),
(269, 65, 10, 34, 46, 0, 0, 1),
(270, 65, 10, 35, 47, 0, 0, 1),
(271, 65, 10, 35, 48, 0, 0, 1),
(272, 65, 10, 35, 49, 0, 0, 1),
(273, 66, 27, 62, 96, 3, 2, 1),
(274, 66, 27, 62, 97, 3, 5, 1),
(275, 67, 28, 63, 98, 3, 5, 1),
(276, 67, 28, 63, 99, 2, 0, 1),
(277, 67, 28, 64, 100, 0, 0, 1),
(278, 67, 28, 64, 101, 0, 0, 1),
(279, 71, 30, 67, 104, 3, 5, 1),
(280, 72, 2, 3, 6, 2, 0, 1),
(281, 72, 2, 3, 7, 2, 0, 1),
(282, 72, 2, 4, 8, 2, 0, 1),
(283, 73, 30, 67, 104, 0, 0, 1),
(284, 74, 3, 0, 9, 0, 0, 1),
(285, 74, 3, 0, 10, 0, 0, 1),
(286, 74, 3, 0, 11, 0, 0, 1),
(287, 74, 3, 6, 12, 0, 0, 1),
(288, 74, 3, 6, 13, 0, 0, 1),
(289, 74, 3, 6, 14, 0, 0, 1),
(290, 74, 3, 6, 15, 0, 0, 1),
(291, 74, 3, 6, 16, 0, 0, 1),
(292, 74, 3, 7, 17, 0, 0, 1),
(293, 74, 3, 7, 18, 0, 0, 1),
(294, 74, 3, 7, 19, 0, 0, 1),
(295, 74, 3, 8, 20, 0, 0, 1),
(296, 74, 3, 8, 21, 0, 0, 1),
(297, 74, 3, 8, 22, 0, 0, 1),
(298, 74, 3, 8, 23, 0, 0, 1),
(299, 78, 2, 3, 6, 0, 0, 1),
(300, 78, 2, 3, 7, 0, 0, 1),
(301, 78, 2, 4, 8, 0, 0, 1),
(302, 79, 2, 3, 6, 0, 0, 1),
(303, 79, 2, 3, 7, 0, 0, 1),
(304, 79, 2, 4, 8, 0, 0, 1),
(305, 80, 2, 3, 6, 0, 0, 1),
(306, 80, 2, 3, 7, 0, 0, 1),
(307, 80, 2, 4, 8, 0, 0, 1),
(308, 81, 2, 3, 6, 0, 0, 1),
(309, 81, 2, 3, 7, 0, 0, 1),
(310, 81, 2, 4, 8, 0, 0, 1),
(311, 82, 2, 3, 6, 0, 0, 1),
(312, 82, 2, 3, 7, 0, 0, 1),
(313, 82, 2, 4, 8, 0, 0, 1),
(314, 83, 2, 3, 6, 0, 0, 1),
(315, 83, 2, 3, 7, 0, 0, 1),
(316, 83, 2, 4, 8, 0, 0, 1),
(317, 84, 2, 3, 6, 0, 0, 1),
(318, 84, 2, 3, 7, 0, 0, 1),
(319, 84, 2, 4, 8, 0, 0, 1),
(320, 85, 2, 3, 6, 0, 0, 1),
(321, 85, 2, 3, 7, 0, 0, 1),
(322, 85, 2, 4, 8, 0, 0, 1),
(323, 86, 2, 3, 6, 0, 0, 1),
(324, 86, 2, 3, 7, 0, 0, 1),
(325, 86, 2, 4, 8, 0, 0, 1),
(326, 87, 18, 54, 78, 0, 0, 1),
(327, 88, 18, 54, 78, 0, 0, 1),
(328, 89, 18, 54, 78, 0, 0, 1),
(329, 91, 2, 3, 6, 0, 0, 1),
(330, 91, 2, 3, 7, 0, 0, 1),
(331, 91, 2, 4, 8, 0, 0, 1),
(332, 93, 3, 0, 9, 0, 0, 1),
(333, 93, 3, 0, 10, 0, 0, 1),
(334, 93, 3, 0, 11, 0, 0, 1),
(335, 93, 3, 6, 12, 0, 0, 1),
(336, 93, 3, 6, 13, 0, 0, 1),
(337, 93, 3, 6, 14, 0, 0, 1),
(338, 93, 3, 6, 15, 0, 0, 1),
(339, 93, 3, 6, 16, 0, 0, 1),
(340, 93, 3, 7, 17, 0, 0, 1),
(341, 93, 3, 7, 18, 0, 0, 1),
(342, 93, 3, 7, 19, 0, 0, 1),
(343, 93, 3, 8, 20, 0, 0, 1),
(344, 93, 3, 8, 21, 0, 0, 1),
(345, 93, 3, 8, 22, 0, 0, 1),
(346, 93, 3, 8, 23, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_relationships`
--

CREATE TABLE `sw_relationships` (
  `id` int(11) NOT NULL,
  `relation` varchar(55) NOT NULL,
  `description` varchar(155) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_relationships`
--

INSERT INTO `sw_relationships` (`id`, `relation`, `description`, `status`) VALUES
(1, 'Son', NULL, 1),
(2, 'Daughter', NULL, 1),
(3, 'Other', 'Guardian of student', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_request_extra_activity_session`
--

CREATE TABLE `sw_request_extra_activity_session` (
  `id` int(11) NOT NULL,
  `submit_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reg_course_id` int(11) NOT NULL,
  `reg_activity_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `review` varchar(255) NOT NULL,
  `act_status` enum('Pending','Approved','Rejected') NOT NULL,
  `submited_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_request_extra_activity_session`
--

INSERT INTO `sw_request_extra_activity_session` (`id`, `submit_id`, `student_id`, `reg_course_id`, `reg_activity_id`, `description`, `coach_id`, `review`, `act_status`, `submited_at`, `status`) VALUES
(1, 9, 6, 2, 6, 'sdfsdg sdfgsdg eeehh', 1, 'gh', 'Approved', '2019-11-12 00:00:00', 1),
(2, 10, 6, 2, 6, 'rtytrc asdf fghdd', 1, '', 'Approved', '2019-11-12 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_settings`
--

CREATE TABLE `sw_settings` (
  `id` int(11) NOT NULL,
  `type` varchar(35) NOT NULL,
  `value` varchar(125) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_settings`
--

INSERT INTO `sw_settings` (`id`, `type`, `value`, `status`) VALUES
(1, 'site_name', 'Swimming App', 1),
(2, 'site_url', 'https://estrradodemo.com/swimming/', 1),
(3, 'admin_name', 'Admin', 1),
(4, 'admin_email', 'admin@estrradodemo.com', 1),
(5, 'currency_name', 'USD', 1),
(6, 'currency_symbol', '$', 1),
(7, 'admin_url', 'https://estrradodemo.com/swimming/admin', 1),
(15, 'sms_sender_id', 'Poetrl', 1),
(16, 'sms_username', 'Poetrl', 1),
(17, 'sms_password', 'sms4poetrl', 1),
(18, 'fire_base_id', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_states`
--

CREATE TABLE `sw_states` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `country_id` int(11) NOT NULL DEFAULT '1',
  `status` tinyint(2) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_states`
--

INSERT INTO `sw_states` (`id`, `name`, `country_id`, `status`) VALUES
(2307, 'Johor', 132, 1),
(2308, 'Kedah', 132, 1),
(2309, 'Kelantan', 132, 1),
(2310, 'Kuala Lumpur', 132, 1),
(2311, 'Labuan', 132, 1),
(2312, 'Melaka', 132, 1),
(2313, 'Negeri Johor', 132, 1),
(2314, 'Negeri Sembilan', 132, 1),
(2315, 'Pahang', 132, 1),
(2316, 'Penang', 132, 1),
(2317, 'Perak', 132, 1),
(2318, 'Perlis', 132, 1),
(2319, 'Pulau Pinang', 132, 1),
(2320, 'Sabah', 132, 1),
(2321, 'Sarawak', 132, 1),
(2322, 'Selangor', 132, 1),
(2323, 'Sembilan', 132, 1),
(2324, 'Terengganu', 132, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_status_list`
--

CREATE TABLE `sw_status_list` (
  `id` int(11) NOT NULL,
  `status_name` varchar(55) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_status_list`
--

INSERT INTO `sw_status_list` (`id`, `status_name`, `status`) VALUES
(0, 'Pending', 1),
(1, 'Confirmed', 1),
(2, 'Processing', 1),
(3, 'Complete', 1),
(4, 'Rejected', 1),
(5, 'Cancelled', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_submited_activities`
--

CREATE TABLE `sw_submited_activities` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `reg_course_id` int(11) NOT NULL,
  `reg_activity_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `submited_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `coach_review` text,
  `reviewed_at` datetime DEFAULT NULL,
  `act_status` tinyint(4) NOT NULL DEFAULT '0',
  `badge_id` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_submited_activities`
--

INSERT INTO `sw_submited_activities` (`id`, `student_id`, `reg_course_id`, `reg_activity_id`, `description`, `submited_at`, `coach_review`, `reviewed_at`, `act_status`, `badge_id`, `status`) VALUES
(1, 70, 2, 4, '', '2019-09-30 13:08:30', 'sdgsdg', NULL, 3, 2, 1),
(2, 70, 2, 5, 'sdfsdg', '2019-09-30 13:08:30', NULL, NULL, 1, 0, 1),
(3, 70, 2, 6, 'I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. I was very busy that’s why it gets delayed. delayed. I was very busy that’s why it gets delayed shhshshjdjs. She djodjd .', '2019-10-16 13:12:35', NULL, NULL, 1, 0, 1),
(4, 153, 17, 67, 'fhguj hujjh hhhhhhhh ghbbhdj hgh hhb hh', '2019-10-17 17:57:06', NULL, NULL, 1, 0, 1),
(8, 2, 18, 72, 'aisvidbVh', '2019-11-28 13:42:43', 'Good', NULL, 3, 2, 1),
(12, 141, 13, 49, 'hai,please check the attachment', '2019-10-21 13:00:35', NULL, NULL, 4, 0, 1),
(11, 139, 9, 33, 'dufigfiyotogoh', '2019-10-21 12:50:10', NULL, NULL, 3, 0, 1),
(13, 139, 9, 35, 'hi , pfa', '2019-10-21 14:38:32', 'Well done', NULL, 3, 0, 1),
(14, 139, 9, 36, 'hhhhh', '2019-10-21 15:00:22', NULL, NULL, 4, 0, 1),
(15, 139, 9, 37, 'uhh', '2019-10-21 15:04:30', NULL, NULL, 3, 0, 1),
(16, 139, 9, 34, 'hh', '2019-10-21 15:15:54', NULL, NULL, 3, 0, 1),
(17, 139, 10, 38, 'jjj', '2019-10-21 15:14:22', 'Good', NULL, 3, 0, 1),
(18, 6, 6, 19, 'name kbsbskbskbsibsjbkdbidbisbkbsibdobdibdkbsibe', '2019-10-22 10:50:42', NULL, NULL, 4, 0, 1),
(19, 6, 6, 20, 'gvchvg DJ g', '2019-10-22 18:33:24', 'Good', NULL, 3, 2, 1),
(20, 6, 5, 15, 'hj DJ jchg', '2019-10-22 18:33:08', NULL, NULL, 1, 2, 1),
(21, 70, 2, 5, 'des', '2019-10-22 16:15:18', NULL, NULL, 1, 0, 1),
(22, 6, 5, 17, '', '2019-10-22 10:51:47', NULL, NULL, 0, 0, 10),
(23, 70, 2, 5, 'Des', '2019-10-22 23:22:06', NULL, NULL, 1, 0, 1),
(24, 142, 12, 48, '', '2019-10-23 07:52:09', NULL, NULL, 0, 0, 10),
(25, 70, 16, 62, 'jxhzkzsj', '2019-10-24 12:52:23', NULL, NULL, 1, 0, 1),
(26, 143, 11, 41, 'xsss', '2019-10-24 14:38:10', NULL, NULL, 3, 0, 1),
(27, 142, 12, 46, '', '2019-10-24 11:01:38', NULL, NULL, 0, 0, 10),
(28, 6, 5, 16, '', '2019-10-25 11:28:27', NULL, NULL, 0, 0, 10),
(29, 141, 13, 50, '', '2019-10-26 04:33:06', NULL, NULL, 0, 0, 10),
(30, 70, 2, 5, 'Des', '2019-10-26 11:05:11', NULL, NULL, 1, 0, 1),
(31, 70, 2, 5, 'Ggg', '2019-10-26 11:12:52', NULL, NULL, 1, 0, 1),
(32, 70, 2, 5, 'BB', '2019-10-26 11:18:46', NULL, NULL, 1, 0, 1),
(33, 141, 13, 51, '', '2019-10-26 07:08:29', NULL, NULL, 0, 0, 10),
(34, 70, 16, 63, '', '2019-10-26 12:52:49', NULL, NULL, 0, 0, 10),
(35, 177, 22, 88, 'dddd', '2019-10-31 16:36:20', NULL, NULL, 3, 0, 1),
(36, 70, 2, 4, 'Good one', '2019-11-04 11:28:27', NULL, NULL, 1, 0, 1),
(37, 70, 16, 66, '', '2019-11-06 08:54:18', NULL, NULL, 0, 0, 10),
(38, 204, 24, 104, 'hi coach,\nplease check the attachment.this shows how i complete this activity.', '2019-11-06 15:22:25', NULL, NULL, 4, 0, 1),
(39, 204, 24, 104, 'hi coach,\nplease check the attachment.this shows how i complete this activity.', '2019-11-06 15:22:28', NULL, NULL, 4, 0, 1),
(40, 70, 2, 6, 'Test description', '2019-11-06 16:36:48', NULL, NULL, 1, 0, 1),
(41, 6, 6, 21, '', '2019-11-07 05:10:55', NULL, NULL, 0, 0, 10),
(42, 70, 2, 5, 'Test description', '2019-11-07 11:16:36', NULL, NULL, 1, 0, 1),
(43, 204, 24, 107, 'Ok', '2019-11-13 11:48:57', 'Good activity', NULL, 3, 0, 1),
(44, 204, 24, 105, 'zgfhzp', '2019-11-07 12:14:33', NULL, NULL, 3, 2, 1),
(45, 212, 28, 134, 'testing remarks for testing purposes', '2019-11-07 15:29:43', NULL, NULL, 1, 0, 1),
(46, 212, 28, 134, 'testing remarks for testing purposes', '2019-11-07 16:32:51', NULL, NULL, 1, 0, 1),
(47, 212, 29, 135, 'fufufuf', '2019-11-07 17:27:28', NULL, NULL, 1, 0, 1),
(48, 177, 23, 94, 'yyh', '2019-11-08 11:36:55', 'Need improvemrnt', NULL, 4, 0, 1),
(49, 177, 23, 93, 'hjkk', '2019-11-08 11:37:06', NULL, NULL, 3, 0, 1),
(50, 177, 23, 95, 'hhbn', '2019-11-08 11:37:40', NULL, NULL, 3, 0, 1),
(51, 177, 23, 96, 'hhn', '2019-11-08 11:41:32', NULL, NULL, 1, 0, 1),
(52, 177, 23, 97, 'fbuu', '2019-11-08 11:41:41', NULL, NULL, 1, 0, 1),
(53, 177, 23, 98, 'db vyy', '2019-11-08 11:41:46', NULL, NULL, 4, 0, 1),
(54, 177, 23, 99, 'add h bb j', '2019-11-08 11:41:51', NULL, NULL, 1, 0, 1),
(55, 177, 23, 101, 'gj it y', '2019-11-08 11:42:03', NULL, NULL, 1, 0, 1),
(56, 177, 23, 100, 'g gj my uj', '2019-11-08 11:42:09', NULL, NULL, 1, 0, 1),
(57, 177, 23, 102, 'ugcgugc', '2019-11-08 11:42:15', NULL, NULL, 1, 0, 1),
(58, 177, 23, 103, 'vtigcig', '2019-11-08 11:42:27', NULL, NULL, 4, 0, 1),
(59, 204, 24, 106, 'remarks', '2019-11-11 10:21:28', NULL, NULL, 3, 0, 1),
(60, 209, 25, 109, '', '2019-11-08 09:55:05', NULL, NULL, 0, 0, 10),
(61, 204, 24, 108, 'Hi', '2019-11-22 11:37:27', NULL, NULL, 3, 0, 1),
(62, 204, 24, 105, 'zgfhzp', '2019-11-28 17:17:00', NULL, NULL, 3, 0, 1),
(63, 224, 41, 160, 'remarks1, remarks2, remarks3, remarks4', '2019-11-14 14:05:36', NULL, NULL, 1, 0, 1),
(64, 204, 24, 104, 'Hi there are you guys coming to pick up my car and I can pick up my check in my truck please let bob Beauty Parlour was the day we got our new mail today I was thinking of going and I cannot is that I cannot you like the chicken I love u I cannot is a time of day u u was u I cannot was the time to look for the time of my time in my head and of u I cannot is a time of day for me haha is a good night to be able for you haha was a good time for me haha is a good time for me to come over for dinner tonight I have to pick up my car ? I', '2019-11-18 14:53:11', NULL, NULL, 4, 0, 1),
(65, 238, 46, 188, '', '2019-11-20 11:19:32', NULL, NULL, 0, 0, 10),
(66, 238, 46, 189, 'Sass', '2019-11-20 17:32:13', NULL, NULL, 3, 0, 1),
(67, 238, 46, 189, 'Shahs has', '2019-11-20 17:48:55', NULL, NULL, 3, 0, 1),
(68, 224, 41, 161, 'dgdgdgsg', '2019-11-22 18:37:59', NULL, NULL, 1, 0, 1),
(69, 204, 31, 137, 'hi this is for test', '2019-11-25 11:30:04', NULL, NULL, 1, 0, 1),
(70, 259, 50, 203, 'his name is intended only for the for sale in in om the Lee I have to be able intended recipient or the Lee family in the for to long in in in the Lee county and the Lee I DJ that the for the future please unsubscribe me from the for sale in in the for sale in in in in om in om in om', '2019-11-25 15:54:46', NULL, NULL, 3, 0, 1),
(71, 259, 50, 204, 'his name and address proof in the future please unsubscribe here newsletter unsubscribe', '2019-11-25 16:19:35', NULL, NULL, 3, 0, 1),
(72, 204, 24, 108, 'Strokes added', '2019-11-26 10:31:04', 'sdsad', NULL, 3, 2, 1),
(73, 204, 24, 107, 'Nice', '2019-11-26 10:38:49', NULL, NULL, 3, 0, 1),
(74, 147, 52, 208, 'Ffff', '2019-11-26 11:37:41', NULL, NULL, 1, 0, 1),
(75, 204, 42, 169, 'Ghh', '2019-11-27 10:50:08', NULL, NULL, 3, 0, 1),
(76, 204, 42, 171, 'Hiiii', '2019-11-28 10:10:23', 'ok', NULL, 3, 3, 1),
(77, 204, 42, 170, 'Hi', '2019-11-28 10:11:47', NULL, NULL, 1, 0, 1),
(78, 204, 42, 176, 'Hi', '2019-11-28 10:29:26', 'very good', NULL, 3, 3, 1),
(79, 204, 42, 176, 'Hi', '2019-11-28 11:03:09', NULL, NULL, 1, 0, 1),
(80, 204, 42, 169, 'Hi', '2019-11-28 11:14:42', NULL, NULL, 4, 0, 1),
(81, 204, 42, 172, 'Hi', '2019-11-28 11:16:55', 'ok', NULL, 3, 3, 1),
(82, 204, 42, 172, 'Uu', '2019-11-28 11:19:29', NULL, NULL, 3, 0, 1),
(83, 204, 42, 173, 'Bbbb', '2019-11-28 11:58:15', NULL, NULL, 1, 0, 1),
(84, 204, 42, 171, 'Hiiii', '2019-11-28 11:58:39', NULL, NULL, 1, 0, 1),
(85, 204, 42, 174, 'Deer', '2019-12-04 16:49:48', NULL, NULL, 1, 0, 1),
(86, 2, 19, 77, 'hjhj', '2019-11-28 08:05:58', NULL, NULL, 3, 2, 1),
(87, 261, 56, 236, 'hi', '2019-11-28 14:08:30', NULL, NULL, 1, 0, 1),
(88, 261, 56, 237, 'tt', '2019-11-28 14:10:02', NULL, NULL, 1, 0, 1),
(89, 2, 18, 72, 'aisvidbVhchcgftfbt', '2019-11-28 14:34:27', NULL, NULL, 3, 0, 1),
(90, 2, 18, 72, 'aisvidbVh', '2019-11-28 14:36:08', 'Good', NULL, 3, 5, 1),
(91, 2, 18, 72, 'aisvidbVhba', '2019-11-28 15:28:10', 'gfhg', NULL, 3, 1, 1),
(92, 204, 24, 108, 'Hi', '2019-11-28 17:17:14', NULL, NULL, 3, 0, 1),
(93, 268, 57, 241, 'Complete', '2019-12-03 15:31:36', 'ok view', NULL, 3, 1, 1),
(94, 268, 57, 242, 'Ok', '2019-12-03 15:32:32', NULL, NULL, 4, 0, 1),
(95, 268, 57, 241, 'Complete', '2019-12-03 15:37:15', NULL, NULL, 3, 0, 1),
(96, 204, 42, 172, 'Hi', '2019-12-03 17:10:35', NULL, NULL, 1, 0, 1),
(97, 204, 24, 108, 'Hi', '2019-12-04 10:30:49', NULL, NULL, 3, 0, 1),
(98, 204, 24, 106, 'Hi', '2019-12-04 10:27:51', NULL, NULL, 3, 0, 1),
(99, 259, 50, 205, 'Gusto ghh ahah', '2019-12-03 17:24:48', NULL, NULL, 3, 0, 1),
(100, 259, 50, 205, 'Gusto ghh ahah', '2019-12-03 17:25:50', NULL, NULL, 3, 0, 1),
(101, 259, 50, 205, 'Gusto ghh ahahbbuk', '2019-12-03 17:26:55', NULL, NULL, 3, 0, 1),
(102, 259, 50, 205, 'Gusto ghh ahah', '2019-12-03 17:56:57', NULL, NULL, 3, 0, 1),
(103, 259, 50, 206, 'Bob', '2019-12-03 18:05:49', NULL, NULL, 3, 0, 1),
(104, 259, 50, 207, 'Hi there', '2019-12-03 18:06:03', NULL, NULL, 3, 0, 1),
(105, 204, 24, 107, 'Nice', '2019-12-04 11:52:59', NULL, NULL, 3, 0, 1),
(106, 204, 24, 108, 'stick', '2019-12-04 13:20:04', NULL, NULL, 3, 0, 1),
(107, 204, 24, 108, 'codicil', '2019-12-04 13:26:25', NULL, NULL, 3, 0, 1),
(108, 204, 24, 108, 'codicil', '2019-12-04 14:15:51', NULL, NULL, 3, 0, 1),
(109, 204, 24, 106, 'Chgdghf', '2019-12-04 15:33:22', NULL, NULL, 4, 0, 1),
(110, 204, 24, 107, 'iDisk Co', '2019-12-04 15:33:47', NULL, NULL, 4, 0, 1),
(111, 204, 24, 108, 'codicilnbb', '2019-12-04 15:45:14', NULL, NULL, 3, 0, 1),
(112, 204, 24, 108, 'Codelib', '2019-12-04 15:53:57', NULL, NULL, 4, 0, 1),
(113, 204, 42, 175, 'Bbbb', '2019-12-05 11:29:20', NULL, NULL, 1, 0, 1),
(114, 259, 50, 203, 'his name is intended only for the for sale in in om the Lee I have to be able intended recipient or the Lee family in the for to long in in in the Lee county and the Lee I DJ that the for the future please unsubscribe me from the for sale in in the for sale in in in in om in om in om', '2019-12-05 12:09:55', NULL, NULL, 3, 0, 1),
(115, 259, 50, 204, 'here newsletter unsubscribe', '2019-12-05 12:11:29', 'ok', NULL, 3, 3, 1),
(116, 271, 61, 247, 'high court jaipur case of the year and I am v neck is a not a good time to explore new the data by this email and any files or previous email and delete this email in front view of the day of the data if I can you check with you to edit the following the data with a good time to make a not for me to make a week or next Monday and Tuesday the status of the data if I can you check with you and let the enquiry and UPA Government of India and Pakistan army in front of the day of my favourite this health tip the balance of ek baar ek din the jab bhi nahi the status quo you check with you to make a not for you check with you and your company and the request of the year and I will have to make sure that you are not for you check with you and your company and its really and truly appreciate your we will contact them without the data with the data by the end of ek kg as an attachment to this email is not a problem', '2019-12-06 09:55:38', NULL, NULL, 3, 0, 1),
(117, 271, 61, 248, 'Bob I cannot is the day we are in town for a good night to come to our new place and I have a lot going in there so we cannot is the time we go there I have a time to come and go pick you guys pick up my car I yes and I have a time to come over to my place for a little eyiop was that I would be a little more time for me to pick up my tipsy stuff and I have some fun with me haha was ewetipp you have a time to come pick u me a check in my mail please let me check in with', '2019-12-06 09:58:47', NULL, NULL, 3, 0, 1),
(118, 271, 61, 249, 'hi coach and let the data with you check on the Marketing with the data with a problem with you to make a week ago the data by this email in your company and its really a good idea to make sure that you are doing good time to make a week and the request of ek baar ek kg gj jgj gj Bailey and the other side of the day of the data if you add any product data field and let you check', '2019-12-06 10:01:42', NULL, NULL, 3, 0, 1),
(119, 270, 59, 246, '', '2019-12-06 07:05:39', NULL, NULL, 0, 0, 10),
(120, 270, 59, 244, 'Hi there are you going home today', '2019-12-12 13:38:23', NULL, NULL, 1, 0, 1),
(121, 204, 24, 105, 'By Merlin', '2019-12-09 11:30:32', 'Not good', NULL, 4, 0, 1),
(122, 168, 64, 266, 'chcyf', '2019-12-06 17:18:50', 'Very Good', NULL, 3, 3, 1),
(123, 168, 64, 267, 'if cvvvh skal', '2019-12-06 17:29:07', NULL, NULL, 4, 0, 1),
(124, 278, 66, 273, 'Bob', '2019-12-06 17:33:20', NULL, NULL, 3, 0, 1),
(125, 278, 66, 274, 'Good', '2019-12-06 17:33:32', NULL, NULL, 3, 0, 1),
(126, 278, 66, 273, 'Bobc dd h hh fgh', '2019-12-06 17:37:36', 'good', NULL, 3, 1, 1),
(127, 278, 66, 274, 'Goodc fff ff', '2019-12-06 17:39:28', 'hhh', NULL, 3, 5, 1),
(128, 278, 66, 273, 'Bob CGI', '2019-12-06 17:40:45', 'ggfcg', NULL, 3, 2, 1),
(129, 275, 67, 275, 'remarks', '2019-12-06 17:47:21', 'This student is eligible for the next level', NULL, 3, 5, 1),
(130, 275, 67, 276, 'remarks', '2019-12-09 09:51:39', NULL, NULL, 3, 0, 1),
(131, 278, 66, 273, '', '2019-12-09 04:23:49', NULL, NULL, 0, 0, 10),
(132, 275, 67, 276, 'remarks', '2019-12-09 11:18:53', NULL, NULL, 1, 0, 1),
(133, 204, 24, 105, 'Hhhj', '2019-12-11 11:03:26', 'ok', NULL, 4, 0, 1),
(134, 2, 19, 77, '', '2019-12-10 06:34:02', NULL, NULL, 0, 0, 10),
(135, 289, 71, 279, 'ccctttzzzsssd', '2019-12-10 16:05:55', 'need improvement', NULL, 4, 0, 1),
(136, 289, 71, 279, 'remarks', '2019-12-10 16:50:58', 'has improved', NULL, 3, 5, 1),
(137, 204, 24, 105, 'zwzwuiv', '2019-12-12 18:06:41', NULL, NULL, 1, 0, 1),
(138, 204, 72, 280, 'Hi there are you going to pick me haha is a good time for me haha is the time to be there for you haha was a time for you', '2019-12-12 13:49:11', NULL, NULL, 1, 0, 1),
(139, 204, 42, 177, 'Hi there are you going haha are you', '2019-12-12 13:54:37', NULL, NULL, 1, 0, 1),
(140, 204, 72, 281, 'hi chechi kku evidengilum paadan pokkude I will be on leave from 3rd', '2019-12-12 14:13:46', NULL, NULL, 1, 0, 1),
(141, 204, 72, 282, 'high court jaipur', '2019-12-16 10:57:37', NULL, NULL, 1, 0, 1),
(142, 153, 17, 67, 'fhguj hujjh hhhhhhhh ghbbhdj hgh hhb hh', '2020-06-25 19:13:53', NULL, NULL, 1, 0, 1),
(143, 153, 17, 68, 'Trrr', '2020-10-21 11:06:50', NULL, NULL, 1, 0, 1),
(144, 153, 20, 80, 'Tyyttgg', '2020-10-21 11:20:13', NULL, NULL, 1, 0, 1),
(145, 153, 20, 81, 'Trrrrrrrrr', '2020-10-21 11:28:58', NULL, NULL, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_submited_activity_media`
--

CREATE TABLE `sw_submited_activity_media` (
  `id` int(11) NOT NULL,
  `submit_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `file` varchar(155) NOT NULL,
  `type` varchar(25) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_submited_activity_media`
--

INSERT INTO `sw_submited_activity_media` (`id`, `submit_id`, `description`, `file`, `type`, `status`) VALUES
(1, 1, 'adwdf', '/app/public/Activities/Submited/1/Act1.mp4', 'video', 1),
(2, 1, 'adasfg', '/app/public/Activities/Submited/1/data.jpg', 'image', 1),
(5, 3, '', '/app/public/Activities/Submited/1570605831.jpg', 'image', 1),
(6, 3, '', '/app/public/Activities/Submited/1570605892.jpg', 'image', 1),
(7, 3, 'ddd', '/app/public/Activities/Submited/1570605938.mp4', 'video', 1),
(8, 3, 'ddd', '/app/public/Activities/Submited/3/1570606431.mp4', 'video', 1),
(9, 3, '', '/app/public/Activities/Submited/3/1570610429.png', 'image', 1),
(10, 3, '', '/app/public/Activities/Submited/3/1570708482.jpg', 'image', 1),
(12, 3, '', '/app/public/Activities/Submited/3/1570712641.jpg', 'image', 1),
(13, 3, '', '/app/public/Activities/Submited/3/1570712649.jpg', 'image', 1),
(14, 3, '', '/app/public/Activities/Submited/3/1570712981.jpg', 'image', 1),
(15, 3, '', '/app/public/Activities/Submited/3/1570713225.jpg', 'image', 1),
(16, 3, '', '/app/public/Activities/Submited/3/1570713343.jpg', 'image', 1),
(25, 3, '', '/app/public/Activities/Submited/3/1571028096.jpg', 'image', 1),
(26, 3, '', '/app/public/Activities/Submited/3/1571028400.jpg', 'image', 1),
(27, 3, '', '/app/public/Activities/Submited/3/1571031062.mp4', 'video', 1),
(28, 3, '', '/app/public/Activities/Submited/3/1571033583.mp4', 'video', 1),
(29, 3, '', '/app/public/Activities/Submited/3/1571033718.mp4', 'video', 1),
(30, 3, '', '/app/public/Activities/Submited/3/1571033789.mp4', 'video', 1),
(31, 3, '', '/app/public/Activities/Submited/3/1571041655.jpg', 'image', 1),
(32, 3, '', '/app/public/Activities/Submited/3/1571041790.jpg', 'image', 1),
(33, 3, '', '/app/public/Activities/Submited/3/1571041903.jpg', 'image', 1),
(34, 3, '', '/app/public/Activities/Submited/3/1571043101.jpg', 'image', 1),
(35, 3, '', '/app/public/Activities/Submited/3/1571043572.jpg', 'image', 1),
(36, 3, '', '/app/public/Activities/Submited/3/1571043790.jpg', 'image', 1),
(37, 3, '', '/app/public/Activities/Submited/3/1571043866.jpg', 'image', 1),
(38, 3, '', '/app/public/Activities/Submited/3/1571043963.jpg', 'image', 1),
(39, 3, '', '/app/public/Activities/Submited/3/1571044184.jpg', 'image', 1),
(40, 3, '', '/app/public/Activities/Submited/3/1571050198.jpg', 'image', 1),
(41, 3, '', '/app/public/Activities/Submited/3/1571050408.jpg', 'image', 1),
(42, 3, '', '/app/public/Activities/Submited/3/1571050423.jpg', 'image', 1),
(43, 3, '', '/app/public/Activities/Submited/3/1571050503.jpg', 'image', 1),
(44, 3, '', '/app/public/Activities/Submited/3/1571050999.jpg', 'image', 1),
(45, 3, '', '/app/public/Activities/Submited/3/1571052144.jpg', 'image', 1),
(46, 3, '', '/app/public/Activities/Submited/3/1571052449.jpg', 'image', 1),
(47, 3, '', '/app/public/Activities/Submited/3/1571053181.jpg', 'image', 1),
(48, 3, '', '/app/public/Activities/Submited/3/1571054188.jpg', 'image', 1),
(49, 3, '', '/app/public/Activities/Submited/3/1571054331.jpg', 'image', 1),
(50, 3, '', '/app/public/Activities/Submited/3/1571054361.mp4', 'video', 1),
(89, 3, '', '/app/public/Activities/Submited/3/1571138240.jpg', 'image', 1),
(90, 3, '', '/app/public/Activities/Submited/3/1571138835.jpg', 'image', 1),
(91, 3, '', '/app/public/Activities/Submited/3/1571139580.jpg', 'image', 1),
(92, 3, '', '/app/public/Activities/Submited/3/1571139907.jpg', 'image', 1),
(93, 3, '', '/app/public/Activities/Submited/3/1571140572.jpg', 'image', 1),
(94, 3, '', '/app/public/Activities/Submited/3/1571140816.jpg', 'image', 1),
(95, 3, '', '/app/public/Activities/Submited/3/1571141043.jpg', 'image', 1),
(96, 3, '', '/app/public/Activities/Submited/3/1571141967.jpg', 'image', 1),
(97, 3, '', '/app/public/Activities/Submited/3/1571143967.jpg', 'image', 1),
(98, 3, '', '/app/public/Activities/Submited/3/1571145534.jpg', 'image', 1),
(99, 3, '', '/app/public/Activities/Submited/3/1571192363.jpg', 'image', 1),
(100, 3, '', '/app/public/Activities/Submited/3/1571211663.jpg', 'image', 1),
(101, 3, '', '/app/public/Activities/Submited/3/1571230436.jpg', 'image', 1),
(102, 3, '', '/app/public/Activities/Submited/3/1571247561.jpg', 'image', 1),
(103, 3, '', '/app/public/Activities/Submited/3/1571247623.jpg', 'image', 1),
(104, 3, '', '/app/public/Activities/Submited/3/1571247694.jpg', 'image', 1),
(105, 3, '', '/app/public/Activities/Submited/3/1571294848.jpg', 'image', 1),
(106, 3, '', '/app/public/Activities/Submited/3/1571304515.jpg', 'image', 1),
(107, 3, '', '/app/public/Activities/Submited/3/1571304907.jpg', 'image', 1),
(118, 6, '', '/app/public/Activities/Submited/6/1571395522.jpg', 'image', 1),
(119, 7, '', '/app/public/Activities/Submited/7/1571395820.jpg', 'image', 1),
(120, 7, '', '/app/public/Activities/Submited/7/1571396150.jpg', 'image', 1),
(121, 7, '', '/app/public/Activities/Submited/7/1571401520.png', 'image', 1),
(122, 7, '', '/app/public/Activities/Submited/7/1571403262.png', 'image', 1),
(123, 7, '', '/app/public/Activities/Submited/7/1571403270.jpg', 'image', 1),
(124, 10, '', '/app/public/Activities/Submited/10/1571404145.jpg', 'image', 1),
(125, 11, '', '/app/public/Activities/Submited/11/1571642367.jpg', 'image', 1),
(126, 12, '', '/app/public/Activities/Submited/12/1571643032.jpg', 'image', 1),
(127, 13, '', '/app/public/Activities/Submited/13/1571647533.mp4', 'video', 1),
(128, 13, '', '/app/public/Activities/Submited/13/1571647896.jpg', 'image', 1),
(129, 16, '', '/app/public/Activities/Submited/16/1571650482.jpg', 'image', 1),
(130, 16, '', '/app/public/Activities/Submited/16/1571650493.jpg', 'image', 1),
(131, 16, '', '/app/public/Activities/Submited/16/1571650507.jpg', 'image', 1),
(132, 16, '', '/app/public/Activities/Submited/16/1571650516.jpg', 'image', 1),
(133, 17, '', '/app/public/Activities/Submited/17/1571650547.jpg', 'image', 1),
(134, 17, '', '/app/public/Activities/Submited/17/1571650552.jpg', 'image', 1),
(135, 17, '', '/app/public/Activities/Submited/17/1571650560.jpg', 'image', 1),
(136, 17, '', '/app/public/Activities/Submited/17/1571650567.jpg', 'image', 1),
(137, 19, '', '/app/public/Activities/Submited/19/1571721653.png', 'image', 1),
(138, 19, '', '/app/public/Activities/Submited/19/1571721947.png', 'image', 1),
(139, 19, '', '/app/public/Activities/Submited/19/1571721989.jpg', 'image', 1),
(140, 19, '', '/app/public/Activities/Submited/19/1571721997.jpg', 'image', 1),
(141, 20, '', '/app/public/Activities/Submited/20/1571723501.jpg', 'image', 1),
(142, 21, '', '/app/public/Activities/Submited/21/1571727003.jpg', 'image', 1),
(144, 21, '', '/app/public/Activities/Submited/21/1571727636.jpg', 'image', 1),
(145, 21, '', '/app/public/Activities/Submited/21/1571732897.jpg', 'image', 1),
(146, 21, '', '/app/public/Activities/Submited/21/1571733159.jpg', 'image', 1),
(154, 24, '', '/app/public/Activities/Submited/24/1571817129.jpg', 'image', 1),
(155, 24, '', '/app/public/Activities/Submited/24/1571817140.mp4', 'video', 1),
(156, 24, '', '/app/public/Activities/Submited/24/1571817279.jpg', 'image', 1),
(157, 27, '', '/app/public/Activities/Submited/27/1571914898.jpg', 'image', 1),
(166, 33, '', '/app/public/Activities/Submited/33/1572073734.mp4', 'video', 1),
(167, 33, '', '/app/public/Activities/Submited/33/1572073904.mp4', 'video', 1),
(168, 33, '', '/app/public/Activities/Submited/33/1572074242.mp4', 'video', 1),
(171, 35, '', '/app/public/Activities/Submited/35/1572519769.jpg', 'image', 1),
(172, 35, '', '/app/public/Activities/Submited/35/1572519971.jpg', 'image', 1),
(176, 37, '', '/app/public/Activities/Submited/37/1573030458.jpg', 'image', 1),
(179, 41, '', '/app/public/Activities/Submited/41/1573103455.jpg', 'image', 1),
(181, 45, '', '/app/public/Activities/Submited/45/1573120751.jpg', 'image', 1),
(182, 47, '', '/app/public/Activities/Submited/47/1573127843.jpg', 'image', 1),
(188, 60, '', '/app/public/Activities/Submited/60/1573208039.jpg', 'image', 1),
(195, 62, '', '/app/public/Activities/Submited/62/1573653988.mp4', 'video', 1),
(196, 62, '', '/app/public/Activities/Submited/62/1573654008.mp4', 'video', 1),
(197, 62, '', '/app/public/Activities/Submited/62/1573654045.mp4', 'video', 1),
(201, 63, '', '/app/public/Activities/Submited/63/1573719776.jpg', 'image', 1),
(202, 64, '', '/app/public/Activities/Submited/64/1574068987.jpg', 'image', 1),
(205, 67, '', '/app/public/Activities/Submited/67/1574252324.jpg', 'image', 1),
(206, 65, '', '/app/public/Activities/Submited/65/1574252755.jpg', 'image', 1),
(209, 68, '', '/app/public/Activities/Submited/68/1574428024.jpg', 'image', 1),
(210, 68, '', '/app/public/Activities/Submited/68/1574428036.jpg', 'image', 1),
(211, 68, '', '/app/public/Activities/Submited/68/1574428048.jpg', 'image', 1),
(212, 68, '', '/app/public/Activities/Submited/68/1574428061.jpg', 'image', 1),
(213, 70, '', '/app/public/Activities/Submited/70/1574677425.jpg', 'image', 1),
(214, 71, '', '/app/public/Activities/Submited/71/1574678962.jpg', 'image', 1),
(215, 76, '', '/app/public/Activities/Submited/76/1574915997.jpg', 'image', 1),
(216, 77, '', '/app/public/Activities/Submited/77/1574916095.jpg', 'image', 1),
(217, 77, '', '/app/public/Activities/Submited/77/1574916104.jpg', 'image', 1),
(218, 78, '', '/app/public/Activities/Submited/78/1574917121.jpg', 'image', 1),
(219, 78, '', '/app/public/Activities/Submited/78/1574917131.jpg', 'image', 1),
(220, 78, '', '/app/public/Activities/Submited/78/1574917161.mp4', 'video', 1),
(222, 82, '', '/app/public/Activities/Submited/82/1574920130.mp4', 'video', 1),
(223, 85, '', '/app/public/Activities/Submited/85/1574922729.jpg', 'image', 1),
(224, 85, '', '/app/public/Activities/Submited/85/1574922754.mp4', 'video', 1),
(228, 87, '', '/app/public/Activities/Submited/87/1574930304.jpg', 'image', 1),
(229, 88, '', '/app/public/Activities/Submited/88/1574930398.jpg', 'image', 1),
(231, 94, '', '/app/public/Activities/Submited/94/1575367312.jpg', 'image', 1),
(232, 94, '', '/app/public/Activities/Submited/94/1575367344.mp4', 'video', 1),
(233, 95, '', '/app/public/Activities/Submited/95/1575367632.jpg', 'image', 1),
(234, 96, '', '/app/public/Activities/Submited/96/1575372730.mp4', 'video', 1),
(235, 96, '', '/app/public/Activities/Submited/96/1575372900.mp4', 'video', 1),
(236, 96, '', '/app/public/Activities/Submited/96/1575373111.mp4', 'video', 1),
(237, 96, '', '/app/public/Activities/Submited/96/1575373223.jpg', 'image', 1),
(242, 98, '', '/app/public/Activities/Submited/98/1575373676.jpg', 'image', 1),
(244, 100, '', '/app/public/Activities/Submited/100/1575374149.jpg', 'image', 1),
(245, 102, '', '/app/public/Activities/Submited/102/1575376015.jpg', 'image', 1),
(246, 103, '', '/app/public/Activities/Submited/103/1575376034.jpg', 'image', 1),
(247, 104, '', '/app/public/Activities/Submited/104/1575376559.jpg', 'image', 1),
(248, 85, '', '/app/public/Activities/Submited/85/1575435407.jpg', 'image', 1),
(251, 105, '', '/app/public/Activities/Submited/105/1575440557.jpg', 'image', 1),
(254, 85, '', '/app/public/Activities/Submited/85/1575445197.jpg', 'image', 1),
(256, 106, '', '/app/public/Activities/Submited/106/1575445790.jpg', 'image', 1),
(258, 107, '', '/app/public/Activities/Submited/107/1575446136.jpg', 'image', 1),
(260, 108, '', '/app/public/Activities/Submited/108/1575449141.jpg', 'image', 1),
(261, 109, '', '/app/public/Activities/Submited/109/1575451146.jpg', 'image', 1),
(262, 110, '', '/app/public/Activities/Submited/110/1575451810.jpg', 'image', 1),
(263, 111, '', '/app/public/Activities/Submited/111/1575454505.jpg', 'image', 1),
(264, 112, '', '/app/public/Activities/Submited/112/1575454986.jpg', 'image', 1),
(265, 112, '', '/app/public/Activities/Submited/112/1575454995.jpg', 'image', 1),
(266, 113, '', '/app/public/Activities/Submited/113/1575525550.jpg', 'image', 1),
(267, 115, '', '/app/public/Activities/Submited/115/1575528072.jpg', 'image', 1),
(268, 115, '', '/app/public/Activities/Submited/115/1575528084.jpg', 'image', 1),
(269, 116, '', '/app/public/Activities/Submited/116/1575606320.jpg', 'image', 1),
(270, 117, '', '/app/public/Activities/Submited/117/1575606482.jpg', 'image', 1),
(271, 117, '', '/app/public/Activities/Submited/117/1575606489.jpg', 'image', 1),
(272, 118, '', '/app/public/Activities/Submited/118/1575606696.mp4', 'video', 1),
(273, 119, '', '/app/public/Activities/Submited/119/1575615939.jpg', 'image', 1),
(277, 121, '', '/app/public/Activities/Submited/121/1575617297.jpg', 'image', 1),
(279, 122, '', '/app/public/Activities/Submited/122/1575632923.jpg', 'image', 1),
(280, 124, '', '/app/public/Activities/Submited/124/1575633796.jpg', 'image', 1),
(281, 125, '', '/app/public/Activities/Submited/125/1575633809.jpg', 'image', 1),
(282, 126, '', '/app/public/Activities/Submited/126/1575634054.jpg', 'image', 1),
(283, 127, '', '/app/public/Activities/Submited/127/1575634166.jpg', 'image', 1),
(284, 128, '', '/app/public/Activities/Submited/128/1575634244.jpg', 'image', 1),
(285, 129, '', '/app/public/Activities/Submited/129/1575634604.jpg', 'image', 1),
(287, 129, '', '/app/public/Activities/Submited/129/1575634636.jpg', 'image', 1),
(288, 121, '', '/app/public/Activities/Submited/121/1575864843.jpg', 'image', 1),
(289, 121, '', '/app/public/Activities/Submited/121/1575864865.jpg', 'image', 1),
(290, 121, '', '/app/public/Activities/Submited/121/1575864884.jpg', 'image', 1),
(291, 121, '', '/app/public/Activities/Submited/121/1575864923.jpg', 'image', 1),
(292, 121, '', '/app/public/Activities/Submited/121/1575865185.jpg', 'image', 1),
(293, 130, '', '/app/public/Activities/Submited/130/1575865280.jpg', 'image', 1),
(294, 131, '', '/app/public/Activities/Submited/131/1575865429.jpg', 'image', 1),
(295, 132, '', '/app/public/Activities/Submited/132/1575868782.jpg', 'image', 1),
(296, 121, '', '/app/public/Activities/Submited/121/1575871049.jpg', 'image', 1),
(297, 121, '', '/app/public/Activities/Submited/121/1575871065.jpg', 'image', 1),
(300, 133, '', '/app/public/Activities/Submited/133/1575877900.jpg', 'image', 1),
(310, 134, '', '/app/public/Activities/Submited/134/1575969219.jpg', 'image', 1),
(311, 135, '', '/app/public/Activities/Submited/135/1575974122.jpg', 'image', 1),
(312, 135, '', '/app/public/Activities/Submited/135/1575974135.jpg', 'image', 1),
(313, 135, '', '/app/public/Activities/Submited/135/1575974153.jpg', 'image', 1),
(314, 136, '', '/app/public/Activities/Submited/136/1575975631.mp4', 'video', 1),
(315, 137, '', '/app/public/Activities/Submited/137/1576043200.jpg', 'image', 1),
(316, 120, '', '/app/public/Activities/Submited/120/1576137900.jpg', 'image', 1),
(317, 120, '', '/app/public/Activities/Submited/120/1576137912.jpg', 'image', 1),
(318, 120, '', '/app/public/Activities/Submited/120/1576137926.jpg', 'image', 1),
(319, 120, '', '/app/public/Activities/Submited/120/1576137949.jpg', 'image', 1),
(320, 120, '', '/app/public/Activities/Submited/120/1576137965.jpg', 'image', 1),
(321, 120, '', '/app/public/Activities/Submited/120/1576137984.jpg', 'image', 1),
(322, 120, '', '/app/public/Activities/Submited/120/1576138010.jpg', 'image', 1),
(323, 120, '', '/app/public/Activities/Submited/120/1576138027.jpg', 'image', 1),
(324, 120, '', '/app/public/Activities/Submited/120/1576138042.jpg', 'image', 1),
(325, 120, '', '/app/public/Activities/Submited/120/1576138062.jpg', 'image', 1),
(326, 120, '', '/app/public/Activities/Submited/120/1576138077.jpg', 'image', 1),
(327, 120, '', '/app/public/Activities/Submited/120/1576138088.jpg', 'image', 1),
(328, 138, '', '/app/public/Activities/Submited/138/1576138651.jpg', 'image', 1),
(329, 138, '', '/app/public/Activities/Submited/138/1576138656.jpg', 'image', 1),
(330, 138, '', '/app/public/Activities/Submited/138/1576138661.jpg', 'image', 1),
(331, 138, '', '/app/public/Activities/Submited/138/1576138668.jpg', 'image', 1),
(332, 138, '', '/app/public/Activities/Submited/138/1576138675.jpg', 'image', 1),
(333, 138, '', '/app/public/Activities/Submited/138/1576138683.jpg', 'image', 1),
(334, 138, '', '/app/public/Activities/Submited/138/1576138690.jpg', 'image', 1),
(335, 138, '', '/app/public/Activities/Submited/138/1576138696.jpg', 'image', 1),
(336, 138, '', '/app/public/Activities/Submited/138/1576138702.jpg', 'image', 1),
(337, 138, '', '/app/public/Activities/Submited/138/1576138718.jpg', 'image', 1),
(338, 138, '', '/app/public/Activities/Submited/138/1576138727.jpg', 'image', 1),
(339, 139, '', '/app/public/Activities/Submited/139/1576138958.jpg', 'image', 1),
(340, 139, '', '/app/public/Activities/Submited/139/1576138964.jpg', 'image', 1),
(341, 139, '', '/app/public/Activities/Submited/139/1576138970.jpg', 'image', 1),
(342, 139, '', '/app/public/Activities/Submited/139/1576138976.jpg', 'image', 1),
(343, 139, '', '/app/public/Activities/Submited/139/1576138980.jpg', 'image', 1),
(344, 139, '', '/app/public/Activities/Submited/139/1576138992.jpg', 'image', 1),
(345, 139, '', '/app/public/Activities/Submited/139/1576139001.jpg', 'image', 1),
(346, 139, '', '/app/public/Activities/Submited/139/1576139021.jpg', 'image', 1),
(347, 139, '', '/app/public/Activities/Submited/139/1576139033.jpg', 'image', 1),
(348, 139, '', '/app/public/Activities/Submited/139/1576139046.jpg', 'image', 1),
(349, 139, '', '/app/public/Activities/Submited/139/1576139067.jpg', 'image', 1),
(350, 141, '', '/app/public/Activities/Submited/141/1576474052.jpg', 'image', 1),
(351, 142, '', '/app/public/Activities/Submited/142/1593092631.jpg', 'image', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_temp_users`
--

CREATE TABLE `sw_temp_users` (
  `id` int(11) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '1',
  `is_login` tinyint(4) NOT NULL DEFAULT '0',
  `is_parent` tinyint(11) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `access_token` varchar(25) DEFAULT '0',
  `otp` int(11) DEFAULT NULL,
  `otp_sent_at` datetime DEFAULT NULL,
  `remember_token` varchar(155) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `push_notify` int(11) NOT NULL DEFAULT '0',
  `chat_notify` int(11) NOT NULL DEFAULT '0',
  `deviceToken` varchar(155) DEFAULT NULL,
  `os` varchar(55) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_temp_users`
--

INSERT INTO `sw_temp_users` (`id`, `email`, `phone`, `password`, `user_type`, `is_login`, `is_parent`, `active`, `access_token`, `otp`, `otp_sent_at`, `remember_token`, `email_verified_at`, `parent`, `created_at`, `updated_at`, `push_notify`, `chat_notify`, `deviceToken`, `os`, `status`) VALUES
(3, 'parent1@estrrado.com', 464577, '$2y$10$GBgdpROwlhhGX6gAPi1zO.FXcNWtU7BxIsxwrcxbZKLTCOAHkLjey', 2, 0, 1, 1, NULL, NULL, NULL, '279VcnNJ1oP1ASc3NhNbALQlhX1loP0c4ZJKz8FItDIeMLj2UjjHRtGRjIza', '2019-04-03 12:10:02', 0, '2019-08-21 05:51:18', '2019-09-18 12:37:03', 0, 0, NULL, NULL, 1),
(4, 'login@email.co2', 89737327332, '', 2, 0, 0, 0, '0', 7373, '2019-09-23 18:38:17', NULL, NULL, 0, '2019-09-23 17:37:22', '2019-09-23 13:08:17', 0, 0, NULL, NULL, 1),
(7, 'ghh@g.in', 9791869918, '', 2, 0, 0, 0, '0', 3977, '2019-09-24 12:16:20', NULL, NULL, 0, '2019-09-24 12:16:20', NULL, 0, 0, NULL, NULL, 1),
(8, 'ghh@g.in', 6374365450, '', 2, 0, 0, 0, '0', 5923, '2019-09-24 12:17:22', NULL, NULL, 0, '2019-09-24 12:17:22', NULL, 0, 0, NULL, NULL, 1),
(9, 'ghh@g.in', 7907203796, '', 2, 0, 0, 0, '0', 6648, '2019-09-24 12:18:25', NULL, NULL, 0, '2019-09-24 12:18:25', NULL, 0, 0, NULL, NULL, 1),
(10, 'hhh@hh.h', 98956277, '', 2, 0, 0, 0, '0', 2570, '2019-09-24 14:33:59', NULL, NULL, 0, '2019-09-24 14:33:59', NULL, 0, 0, NULL, NULL, 1),
(11, 'gg@vvv.n', 9895096276, '', 2, 0, NULL, 0, '0', 6171, '2019-09-24 14:55:32', NULL, NULL, 0, '2019-09-24 14:53:08', '2019-09-24 09:42:17', 0, 0, NULL, NULL, 1),
(16, 'fugug@gugb.jkbib', 9999999993, '', 2, 0, NULL, 0, '0', 1234, '2019-09-24 15:23:26', NULL, NULL, 0, '2019-09-24 15:23:26', NULL, 0, 0, NULL, NULL, 1),
(18, 'test@test.com', 9973732732, '', 2, 0, NULL, 0, '0', 1234, '2019-09-24 15:30:16', NULL, NULL, 0, '2019-09-24 15:30:16', NULL, 0, 0, NULL, NULL, 1),
(22, 'arya@gmail.com', 9605467855, '', 2, 0, NULL, 0, '0', 1234, '2019-09-25 14:57:14', NULL, NULL, 0, '2019-09-25 14:57:14', '2019-09-25 09:27:14', 0, 0, NULL, NULL, 1),
(38, 'jhh@bb.im', 86565566, '', 2, 0, NULL, 0, '0', 4815, '2019-09-25 10:28:51', NULL, NULL, 0, '2019-09-25 10:28:37', '2019-09-25 04:58:51', 0, 0, NULL, NULL, 1),
(86, 'ghh.huj@estrrado.hh.com', 9544814026, '', 2, 0, NULL, 0, '0', 1234, '2019-10-01 16:22:45', NULL, NULL, 0, '2019-10-01 16:22:45', NULL, 0, 0, NULL, NULL, 1),
(88, 'simi@estrradio.com', 9547885555, '', 2, 0, NULL, 0, '0', 4165, '2019-10-01 16:58:58', NULL, NULL, 0, '2019-10-01 16:58:57', '2019-10-01 11:28:58', 0, 0, NULL, NULL, 1),
(90, 'uj@efhu.fhj', 9632587415, '', 2, 0, NULL, 0, '0', 2837, '2019-10-01 17:13:21', NULL, NULL, 0, '2019-10-01 17:13:18', '2019-10-01 11:43:21', 0, 0, NULL, NULL, 1),
(91, 'simii@estrrado.com', 9521458658, '', 2, 0, NULL, 0, '0', 1234, '2019-10-01 17:41:02', NULL, NULL, 0, '2019-10-01 17:41:02', NULL, 0, 0, NULL, NULL, 1),
(110, 'hi@estrrado.com', 9444444162, '', 2, 0, NULL, 0, '0', 6219, '2019-10-09 18:32:27', NULL, NULL, 0, '2019-10-09 18:32:14', '2019-10-09 13:02:27', 0, 0, NULL, NULL, 1),
(116, 'as@e.in', 32424244223, '', 2, 0, NULL, 0, '0', 1234, '2019-10-18 14:38:03', NULL, NULL, 0, '2019-10-18 14:38:03', NULL, 0, 0, NULL, NULL, 1),
(117, 'hah@baba.bb', 84848464646, '', 2, 0, NULL, 0, '0', 1234, '2019-10-18 14:43:37', NULL, NULL, 0, '2019-10-18 14:43:37', NULL, 0, 0, NULL, NULL, 1),
(122, 'devper.estrrado@gmail.com', 9632587526, '', 2, 0, NULL, 0, '0', 1234, '2019-10-22 17:45:40', NULL, NULL, 0, '2019-10-22 17:45:40', '2019-10-22 12:15:40', 0, 0, NULL, NULL, 1),
(136, 'estrradotechnologies@gmail.com', 7894564231, '', 2, 0, NULL, 0, '0', 1234, '2019-10-26 14:53:01', NULL, NULL, 0, '2019-10-26 14:53:01', NULL, 0, 0, NULL, NULL, 1),
(145, 'manikandan@estrrado.com', 7736605373, '', 2, 0, NULL, 0, '0', 1234, '2019-10-26 18:05:38', NULL, NULL, 0, '2019-10-26 18:05:24', '2019-10-26 12:35:38', 0, 0, NULL, NULL, 1),
(166, 'bauba@uavua.skbsiji', 99612456, '', 2, 0, NULL, 0, '0', 1234, '2019-11-11 11:36:42', NULL, NULL, 0, '2019-11-11 11:36:42', NULL, 0, 0, NULL, NULL, 1),
(167, 'inn@HCjva.svjb', 99613232, '', 2, 0, NULL, 0, '0', 1234, '2019-11-11 12:33:04', NULL, NULL, 0, '2019-11-11 12:33:04', NULL, 0, 0, NULL, NULL, 1),
(176, 'ankitha@estrrado.com', 9511598, '', 2, 0, NULL, 0, '0', 1234, '2019-11-15 10:01:56', NULL, NULL, 0, '2019-11-15 10:01:56', NULL, 0, 0, NULL, NULL, 1),
(177, 'ankitha@estrrado.com', 9511598521235, '', 2, 0, NULL, 0, '0', 1234, '2019-11-15 10:02:12', NULL, NULL, 0, '2019-11-15 10:02:12', NULL, 0, 0, NULL, NULL, 1),
(192, 'sangeetha@estrrado.com', 98765432111, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 09:41:49', NULL, NULL, 0, '2019-11-28 09:41:49', NULL, 0, 0, NULL, NULL, 1),
(195, 'which@through.jsjj', 9696969, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 10:57:19', NULL, NULL, 0, '2019-11-28 10:57:19', NULL, 0, 0, NULL, NULL, 1),
(196, 'which@through.jsjj', 9696969363652, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 10:57:52', NULL, NULL, 0, '2019-11-28 10:57:52', NULL, 0, 0, NULL, NULL, 1),
(197, 'which@through.jsjj', 8686865, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 10:58:01', NULL, NULL, 0, '2019-11-28 10:58:01', NULL, 0, 0, NULL, NULL, 1),
(198, 'which@through.jsjj', 86868636, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 10:58:09', NULL, NULL, 0, '2019-11-28 10:58:09', NULL, 0, 0, NULL, NULL, 1),
(199, 'which@through.jsjj', 9444544, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 11:00:00', NULL, NULL, 0, '2019-11-28 11:00:00', NULL, 0, 0, NULL, NULL, 1),
(202, 'd@dd.com', 99887744, '', 2, 0, NULL, 0, '0', 1234, '2019-11-28 13:11:14', NULL, NULL, 0, '2019-11-28 13:11:14', NULL, 0, 0, NULL, NULL, 1),
(203, 'vhiu@fh.com', 8523698521, '', 2, 0, NULL, 0, '0', 1234, '2020-01-30 12:13:35', NULL, NULL, 0, '2020-01-30 12:13:35', NULL, 0, 0, NULL, NULL, 1);

--
-- Triggers `sw_temp_users`
--
DELIMITER $$
CREATE TRIGGER `delete_temp_user_detail` AFTER DELETE ON `sw_temp_users` FOR EACH ROW delete from sw_temp_user_details where sw_temp_user_details.user_id = old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sw_temp_user_details`
--

CREATE TABLE `sw_temp_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `company_name` varchar(55) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(55) DEFAULT NULL,
  `state` varchar(55) DEFAULT NULL,
  `country` varchar(55) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `avthar` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_temp_user_details`
--

INSERT INTO `sw_temp_user_details` (`id`, `user_id`, `name`, `company_name`, `address1`, `address2`, `dob`, `city`, `state`, `country`, `zip`, `company_logo`, `avthar`, `created`, `modified`, `status`) VALUES
(3, 3, 'Parent1', '', 'Vellayambalam', 'TVM', NULL, '2045', '19', '101', NULL, '', '', '2019-02-08 05:51:18', '2019-10-04 09:20:21', 1),
(116, 110, 'hi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 13:02:14', NULL, 1),
(123, 116, 'adds', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-18 09:08:03', NULL, 1),
(10, 4, 'Merlin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-23 12:07:22', NULL, 1),
(17, 11, 'sad', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 09:23:08', NULL, 1),
(22, 16, 'fugivivhub', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 09:53:26', NULL, 1),
(13, 7, 'bob', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 06:46:20', NULL, 1),
(14, 8, 'bob', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 06:47:22', NULL, 1),
(15, 9, 'bob', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 06:48:25', NULL, 1),
(16, 10, 'uu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 09:03:59', NULL, 1),
(24, 18, 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 10:00:16', NULL, 1),
(28, 22, 'arya stark', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 10:25:54', '2019-09-25 09:27:14', 1),
(183, 176, 'ankitha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-15 04:31:56', NULL, 1),
(44, 38, 'bbb', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-25 04:58:37', NULL, 1),
(92, 86, 'joble', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-01 10:52:45', NULL, 1),
(94, 88, 'sini', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-01 11:28:57', NULL, 1),
(96, 90, 'gh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-01 11:43:18', NULL, 1),
(97, 91, 'simi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-01 12:11:02', NULL, 1),
(124, 117, 'hahah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-18 09:13:37', NULL, 1),
(129, 122, 'tufhfhf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:12:30', NULL, 1),
(143, 136, 'Estrrado', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 09:23:01', NULL, 1),
(152, 145, 'manikandan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 12:35:24', NULL, 1),
(173, 166, 'ha usbbsibsin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-11 06:06:42', NULL, 1),
(174, 167, 'sjbjbihoh', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-11 07:03:04', NULL, 1),
(184, 177, 'ankitha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-15 04:32:12', NULL, 1),
(199, 192, 'sangeetha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 04:11:49', NULL, 1),
(202, 195, 'ugauguah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:27:19', NULL, 1),
(203, 196, 'ugauguah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:27:52', NULL, 1),
(204, 197, 'ugauguah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:28:01', NULL, 1),
(205, 198, 'ugauguah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:28:09', NULL, 1),
(206, 199, 'ugauguah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:30:00', NULL, 1),
(209, 202, 'd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 07:41:14', NULL, 1),
(218, 203, 'khyiujk', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-01-30 06:43:35', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_test`
--

CREATE TABLE `sw_test` (
  `id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `email` varchar(155) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(55) DEFAULT NULL,
  `qualification` varchar(155) DEFAULT NULL,
  `modes` varchar(155) DEFAULT NULL,
  `faculties` varchar(55) DEFAULT NULL,
  `courses` varchar(55) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_test`
--

INSERT INTO `sw_test` (`id`, `name`, `email`, `phone`, `nationality`, `qualification`, `modes`, `faculties`, `courses`, `created_at`) VALUES
(1, 'Merlin', 'merlin@estrrado.com', '+918973732732', 'India', 'SPM / O Level / SSC or equivalent', 'Full time', 'Faculty of Medicine, Bioscience & Nursing', 'Bachelor of Medicine & Bachelor of Surgery', '2020-08-18 02:08:14'),
(2, 'Merlin Sundar Singh', 'merlin@merlin.in', '+917767888', 'India', 'Diploma', 'Full time', 'Faculty of Medicine, Bioscience & Nursing', 'Bachelor of Medicine & Bachelor of Surgery', '2020-08-18 02:46:14');

-- --------------------------------------------------------

--
-- Table structure for table `sw_users`
--

CREATE TABLE `sw_users` (
  `id` int(11) NOT NULL,
  `email` varchar(55) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `user_type` tinyint(4) NOT NULL DEFAULT '1',
  `is_login` tinyint(4) NOT NULL DEFAULT '0',
  `is_parent` tinyint(11) DEFAULT NULL,
  `active` tinyint(2) NOT NULL DEFAULT '0',
  `active_from` date DEFAULT NULL,
  `access_token` varchar(25) DEFAULT '0',
  `otp` int(11) DEFAULT NULL,
  `otp_sent_at` datetime DEFAULT NULL,
  `active_link` varchar(255) DEFAULT NULL,
  `remember_token` varchar(155) DEFAULT NULL,
  `email_verified_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `parent` int(11) NOT NULL DEFAULT '0',
  `relation` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `push_notify` int(11) NOT NULL DEFAULT '0',
  `chat_notify` int(11) NOT NULL DEFAULT '0',
  `deviceToken` varchar(155) DEFAULT NULL,
  `os` varchar(55) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_users`
--

INSERT INTO `sw_users` (`id`, `email`, `phone`, `password`, `user_type`, `is_login`, `is_parent`, `active`, `active_from`, `access_token`, `otp`, `otp_sent_at`, `active_link`, `remember_token`, `email_verified_at`, `last_login`, `parent`, `relation`, `created_at`, `updated_at`, `push_notify`, `chat_notify`, `deviceToken`, `os`, `status`) VALUES
(1, 'merlin@estrrado.com', 897373273, '$2y$10$0noQuUMEj1hH78ISTMiHTeCORiE91mvPQ9wecUmZLyEwtQe1tgfJS', 1, 1, 0, 1, '2019-09-25', '1540175', NULL, NULL, 'MzgyNDE2cmVzZXRwYXNzd29yZDE1NzU1MzI3MTcx', 'rVIIa1VIww7Vzs8CbRhzTWu3MnMaFtY0GsfSgslj0hisA7unzu9LdSiS1Jfl', '2019-12-05 13:28:37', '2020-10-01 03:46:38', 0, NULL, '2019-02-08 05:51:18', '2021-05-11 23:11:46', 0, 0, 'd7YTd45uZRM:APA91bEVZV-izs5Jp_28uJKUhU_ApgOHTmG-FQVp7YgAhUcRnvt0dL_dRWTTCS927f95AgJ0Mk8dAxllpJRk9Gd6J7v-Q2Rmjvaqvo2Em3aUo0-ca3e5dhOw2EFNzxtio9xjK6KDokrC', 'android', 1),
(2, 'studentone@estrrado.com', 1234567890, '$2y$10$GBgdpROwlhhGX6gAPi1zO.FXcNWtU7BxIsxwrcxbZKLTCOAHkLjey', 2, 1, 0, 1, '2019-09-30', '2980892', NULL, '2020-10-23 11:52:29', NULL, '279VcnNJ1oP1ASc3NhNbALQlhX1loP0c4ZJKz8FItDIeMLj2UjjHRtGRjIza', '2019-04-03 12:10:02', NULL, 0, NULL, '2019-02-08 05:51:18', '2020-10-23 06:22:31', 0, 0, 'dZOcdtO-SlQ:APA91bHCMxXOpsnJ9dpDwjF31SUWDxi_K1tSekuhK4rn_qvncI4BlZTgWUG8norw9ouQ_UwZYLEmUS0ZLJHj7rE_Y3BiEuhH7aLG_4mVytJ-V-2F6VTsRYo0NYv9pclSpBIGBIX-t_Rf', 'android', 1),
(3, 'parent1@estrrado.com', 464577777, '$2y$10$GBgdpROwlhhGX6gAPi1zO.FXcNWtU7BxIsxwrcxbZKLTCOAHkLjey', 2, 1, 1, 1, '0000-00-00', '3742938', NULL, NULL, NULL, '279VcnNJ1oP1ASc3NhNbALQlhX1loP0c4ZJKz8FItDIeMLj2UjjHRtGRjIza', '2019-04-03 12:10:02', NULL, 0, NULL, '2019-02-08 05:51:18', '2019-12-07 13:18:36', 0, 0, NULL, NULL, 1),
(4, 'student2@estrrado.com', 1234567891, '$2y$10$GBgdpROwlhhGX6gAPi1zO.FXcNWtU7BxIsxwrcxbZKLTCOAHkLjey', 2, 0, 0, 1, '2019-10-01', '', NULL, NULL, NULL, '279VcnNJ1oP1ASc3NhNbALQlhX1loP0c4ZJKz8FItDIeMLj2UjjHRtGRjIza', '2019-04-03 12:10:02', NULL, 3, 1, '2019-02-08 05:51:18', '2019-11-29 07:38:44', 0, 0, NULL, NULL, 1),
(6, 'login@email.co', 8973732734, '', 2, 1, 0, 1, '2019-12-02', '6109912', NULL, '2019-11-09 14:47:42', NULL, NULL, NULL, NULL, 0, NULL, '2019-09-20 20:22:57', '2020-10-21 08:56:18', 7, 0, 'eufbwy9_dB4:APA91bFMKm2fFwVO_3PlAP1-7x-kVPhf_2uaMJqjubEh6O-CjamDamNx9zswOPHJuZCiZ-LrHJoRRI54vDcCiWk40nXhdggxwDJEu1wcoJ7mf6I_85kGCiddT4iIJoBVA5zdfck5-Xi_', NULL, 1),
(69, 'aryastark@gmail.com', 8070605040, '', 2, 1, 0, 1, NULL, '69927682', NULL, '2019-11-26 10:42:03', NULL, NULL, NULL, NULL, 0, NULL, '2019-09-25 14:57:54', '2020-10-21 09:34:19', 6, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(71, 'child2@email.com', 356776567, '', 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 5, 1, '2019-09-23 13:30:00', NULL, 0, 0, NULL, NULL, 1),
(139, 'simi@estrrado.com', 9447348140, '', 2, 1, 0, 1, '2019-10-09', '139722969', NULL, '2019-11-16 10:41:31', 'MzU3NzUzcmVzZXRwYXNzd29yZDE1NzQ0ODU2ODgx', NULL, '2019-11-23 10:38:08', NULL, 0, NULL, '2019-10-09 11:34:36', '2019-12-05 08:25:15', 7, 0, 'c9Ho2u_3NQc:APA91bHv7jEZaVmoVhhKl67oULGrnGrFg-XyAFtGPrhgJlVHfQaazmdvSOd7_a31WgKtynnmSBcvc3voRQ_rxSKwlsXB51IGZ3msQv1MAU8ZV-CL6g_hPJ4yjmHKowiyJvGIGp2SWgde', 'ios', 0),
(141, 'arun@estrrado.com', 7907131311, NULL, 2, 0, 0, 1, NULL, '0', 1234, '2020-04-01 18:08:54', NULL, NULL, NULL, NULL, 140, 3, '2019-10-09 11:37:48', '2020-04-01 12:38:54', 0, 0, 'exr3x4rB8Z0:APA91bFZXT7PzOGqg27rEuTvhylRKFavHHLXl5mujq9Lm9dMY8I96bC1FpCyZKP6uSvwzKz8gwBMF4aYCDu3n6-q6ygtE9gGMjgYlZ3DKFFMzdWiKi1QcGAFLN-mm2kIClypWDWAP_cC', NULL, 1),
(142, 'sevin@estrrado.com', 9447429638, NULL, 2, 0, 0, 1, NULL, '0', 1234, '2019-11-06 11:15:21', NULL, NULL, NULL, NULL, 140, 1, '2019-10-09 11:37:48', '2019-11-06 05:45:21', 0, 0, 'cOh4cMkiSoM:APA91bG2yKCGabokA67aqet8n4C6zM3EBTonzrmcPQMk6SfndwnulsOAXNtgKG1M_vE7vMAnb6ayeplDyu0tlRmeUfW68LB7K5OAZbhVXxAPzMACYZaYwKhUwbK0SHWwurq7tq00VBpK', NULL, 1),
(143, 'priya@estrrado.com', 1111111111, '', 2, 1, 0, 1, '2019-10-09', '143903198', NULL, '2019-10-24 14:36:15', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-09 11:38:35', '2020-05-21 06:44:29', 1, 0, 'cOh4cMkiSoM:APA91bG2yKCGabokA67aqet8n4C6zM3EBTonzrmcPQMk6SfndwnulsOAXNtgKG1M_vE7vMAnb6ayeplDyu0tlRmeUfW68LB7K5OAZbhVXxAPzMACYZaYwKhUwbK0SHWwurq7tq00VBpK', NULL, 0),
(144, 'priyajacob@estrrado.com', 2222222222, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-09 11:39:42', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-09 11:39:42', '2019-11-29 11:51:34', 0, 0, NULL, NULL, 0),
(145, 'ath@estrrado.com', 3333333333, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-09 12:11:49', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-09 12:11:49', '2019-10-09 06:41:55', 0, 0, NULL, NULL, 1),
(146, 'test@g.com', 94969988, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-09 12:14:17', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-09 12:14:17', '2019-10-09 06:44:25', 0, 0, NULL, NULL, 1),
(147, 'bob@gmail.com', 9806508123, NULL, 2, 0, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 69, 1, '2019-10-09 17:04:21', '2019-11-26 05:49:15', 2, 0, NULL, NULL, 1),
(148, 'joble@estrrado.com', 9333333333, '', 2, 0, 0, 0, NULL, '0', NULL, '2019-10-09 18:11:01', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-09 18:11:01', '2019-11-29 11:51:25', 0, 0, NULL, NULL, 0),
(149, 'si5@estrrado.com', 9555555555, '', 2, 1, 1, 1, NULL, '149761821', NULL, '2019-10-11 18:36:08', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-11 18:34:03', '2019-10-11 13:06:11', 0, 0, 'drhwI1ylbDg:APA91bGtZ5cEgJ9YZ70U_X7-XOEOCnXZoT3_N9cO8jlZge7SmetbcjCWCOM1vyh7EvMMiYrGhFcPoiJzE7FDIddDAKA3KIngOHopUakfK7yn8FxUSUkMJYJC58q76Mnr74Yba0hlduod', NULL, 1),
(150, 'sim@estrra.com', 9592959592, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 149, 2, '2019-10-11 18:35:01', NULL, 0, 0, NULL, NULL, 1),
(151, 'mis@esjj.com', 8523694528, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 149, 1, '2019-10-11 18:35:01', NULL, 0, 0, NULL, NULL, 1),
(152, 'deepus@estrrado.com', 9496369988, '', 2, 1, 1, 1, NULL, '152306634', NULL, '2020-10-23 15:25:15', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-16 08:19:31', '2020-10-23 09:55:19', 0, 0, 'cx0k4Xdp_eE:APA91bENOEqsdt5Rbka95S-FrxhpyAIaknJEp1hvrHNSI7_KUkf3ZpM2CS7nIkiv357zpNk7L-FibEnbZpzQxZIIx2ppPwm5iouFMMSFXb8019km519AVvL5jNz5QddVHK80ZSsiHAwR', 'ios', 1),
(153, 'deepus@estrrado.com', 9496369988, NULL, 2, 0, 0, 1, NULL, '0', 1234, '2020-10-23 15:25:15', NULL, NULL, NULL, NULL, 152, 1, '2019-10-16 08:21:02', '2020-10-23 09:55:15', 0, 0, 'edfhemsaVLw:APA91bEELOfCln_olezlrpUgCIKBXh7J1nWKRwhkPG3VpKPvYpiQb08w8EMKIMRTHOsEVpmeVUWeRNWzXL_tvsHynR8Eq-5TUT1naGDNpGtooY3u35lLjig9P13RhLmF_jIcMVgEWHgZ', 'ios', 1),
(154, 'robb@mail.in', 9741369, '', 2, 0, 0, 0, NULL, '0', NULL, '2019-10-17 11:36:47', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-17 11:36:47', '2019-10-17 06:06:56', 0, 0, NULL, NULL, 1),
(155, 'anupama@estrrado.com', 9632587412, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-17 16:38:00', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-17 16:38:00', '2019-10-17 11:11:05', 0, 0, NULL, NULL, 1),
(156, 'simu@estrrafo.com', 9888888888, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-17 17:03:23', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-17 17:03:23', '2019-10-17 11:33:27', 0, 0, NULL, NULL, 1),
(157, 'deepus@estrradoo.com', 9496666666, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-17 17:04:36', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-17 17:04:36', '2019-12-05 12:45:59', 0, 0, NULL, NULL, 0),
(158, 'ghh@h.in', 256885969, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-21 11:34:56', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-21 11:34:56', '2019-10-21 06:05:48', 0, 0, NULL, NULL, 1),
(159, 'gh@vb.n', 256886666, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-21 12:30:58', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-21 12:30:58', '2019-10-21 07:01:08', 0, 0, NULL, NULL, 1),
(160, 'priya.jacob@estrrado.com', 9072344210, '', 2, 0, 1, 1, '2019-11-01', '0', 1234, '2019-11-13 10:22:23', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 11:13:22', '2019-11-13 04:52:23', 0, 0, 'f8oZhme73W4:APA91bEB83zLbSrLb6cRXllAIBa2vpGsjC3D9mC94yeyi6m3TRNZ-51yT5bNVjQbDn8sAT7x2iXFQRWQBBqNPHi9-sLTOMs7BoEEBrEudsHng2B5BLeYdWB8GunU6JA4yV4IbBEy7IRb', NULL, 0),
(161, 'simi@gth.com', 9632582552, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-22 17:35:21', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 17:35:21', '2019-10-22 12:05:27', 0, 0, NULL, NULL, 1),
(162, 'developer.esrado@gmail.com', 9632584715, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-22 17:51:22', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 17:51:22', '2019-12-06 04:53:23', 0, 0, NULL, NULL, 0),
(163, 'developer.errado@gmail.com', 9393855282, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-22 17:52:31', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 17:52:31', '2019-10-22 12:22:38', 0, 0, NULL, NULL, 1),
(164, 'devper.estrrado@gmail.com', 9632584175, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-22 17:55:54', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 17:55:54', '2019-12-06 04:53:17', 0, 0, NULL, NULL, 0),
(165, 'develer.estrrado@gmail.com', 9632587452, '', 2, 0, 0, 0, NULL, '0', NULL, '2019-10-22 18:00:00', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 18:00:00', '2019-12-06 05:12:04', 0, 0, NULL, NULL, 1),
(166, 'anoop@estrrrado.com', 9791369918, '', 2, 0, 0, 1, '2019-10-26', '0', NULL, '2019-10-22 18:02:09', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 18:02:09', '2019-10-26 16:00:44', 0, 0, NULL, NULL, 1),
(167, 'devoper.estrrado@gmail.com', 8089139416, '', 2, 0, 0, 1, '2019-10-26', '0', NULL, '2019-10-22 18:03:57', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 18:03:57', '2019-12-06 04:54:09', 0, 0, NULL, NULL, 1),
(168, 'monish@estrrado.com', 9605935569, '', 2, 1, 0, 1, '2019-12-06', '168318436', NULL, '2019-12-06 17:59:02', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-22 18:12:17', '2019-12-07 08:50:24', 0, 1, 'ea9DxR-rwx0:APA91bF0yCvWLo1rbHV31Kta-A6yN0JNTzIN9a28otNVWJNKaEOUe_zqBkZC2InKuQzpNdZxh7V26S7eTYWlJOR435_bc1QWSZlXdtMTqPhUq0gw-33yx1HHX_UQOx-4cbuTb51EJYLX', 'ios', 1),
(169, 'developer.esado@gmail.com', 9635287415, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-23 11:52:06', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-23 11:52:06', '2019-10-23 06:22:11', 0, 0, NULL, NULL, 1),
(170, 'deper.estrrado@gmail.com', 9632581475, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-24 16:41:43', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-24 16:41:43', '2019-12-06 04:54:56', 0, 0, NULL, NULL, 0),
(171, 'developer.estrrado@gmail.com', 9453523385, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-24 16:43:02', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-24 16:43:02', '2019-12-06 04:55:01', 0, 0, NULL, NULL, 0),
(172, 'hh@BB.kn', 5688966, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-10-26 10:51:19', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 10:51:19', '2019-12-06 04:55:06', 0, 0, NULL, NULL, 0),
(173, 'duttu@estrrado.com', 7559048140, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 14:20:40', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 14:20:40', '2019-10-26 08:50:46', 0, 0, NULL, NULL, 1),
(174, 'ansau@estrrafo.com', 9876543210, '', 2, 1, 1, 1, NULL, '174240785', NULL, '2019-12-04 12:49:40', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 14:22:31', '2019-12-04 07:19:53', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(175, 'sfg@rfghij.cbj', 9876543211, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 174, 1, '2019-10-26 14:23:08', NULL, 0, 0, NULL, NULL, 1),
(176, 'estrradotechnologies@gmail.com', 9999999999, '', 2, 0, 1, 1, NULL, '0', 1234, '2019-12-03 18:15:58', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 14:53:42', '2020-04-11 04:36:47', 5, 0, 'cztf7Sgauo0:APA91bF9ktWM0cCxacgWdcgTxOsQNsv4C7jSc0JZIuF6RLsspLV0nNDFhZpZ39iehPng1rbV8mDlpGiuyKbFshsD4ZwAp_7Nj7P1zza5020KED7ikeqmIQbzsuGPPdNrmJLqbzUJAenO', 'android', 1),
(177, 'such@fjxj.fulfill', 8523691470, NULL, 2, 0, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 176, 1, '2019-10-26 14:55:04', '2020-04-11 04:36:47', 10, 0, NULL, NULL, 1),
(178, 'Vicki@dbxgb.Hickk', 8658741236, NULL, 2, 0, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 176, 2, '2019-10-26 14:55:04', '2019-10-26 11:55:08', 0, 0, NULL, NULL, 1),
(179, 'developer.estrrado@gmail.coms', 8934635438, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:22:11', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:22:11', '2019-10-26 09:52:17', 0, 0, NULL, NULL, 1),
(180, 'developer.estrrado@gmail.comsss', 8984354354, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:23:42', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:23:42', '2019-10-26 09:54:28', 0, 0, NULL, NULL, 1),
(181, 'developer.estrrado@gmail.coma', 9865237845, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:39:00', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:39:00', '2019-10-26 10:09:09', 0, 0, NULL, NULL, 1),
(182, 'estrradotechnologies@gmail.comas', 8956237845, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:39:38', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:39:38', '2019-10-26 10:09:43', 0, 0, NULL, NULL, 1),
(183, 'developer.estrsrado@gmail.com', 9876543566, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:47:21', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:47:21', '2019-10-26 10:17:25', 0, 0, NULL, NULL, 1),
(184, 'developer.estrrado@gmab.ubby', 9655555565, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:49:52', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:49:52', '2019-10-26 10:19:59', 0, 0, NULL, NULL, 1),
(185, 'developer.estrrado@gmail.comm', 9988774400, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 15:53:28', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 15:53:28', '2019-10-26 10:23:32', 0, 0, NULL, NULL, 1),
(186, 'distic@given.ido', 9865321245, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 185, 3, '2019-10-26 15:58:46', NULL, 0, 0, NULL, NULL, 1),
(187, 'shdd@gain.hbbhdj', 9632884170, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 185, 2, '2019-10-26 15:58:46', NULL, 0, 0, NULL, NULL, 1),
(188, 'dydy@tuf.fuj', 9865323265, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 185, 2, '2019-10-26 15:58:46', NULL, 0, 0, NULL, NULL, 1),
(189, 'fhfhf@gjchsj.hjjj', 9805050505, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 185, 2, '2019-10-26 15:58:46', NULL, 0, 0, NULL, NULL, 1),
(190, 'hah@b.n', 9654312650, NULL, 2, 0, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 176, 2, '2019-10-26 16:50:20', '2019-10-26 11:50:06', 0, 0, NULL, NULL, 1),
(191, 'chi_Ifajvajac@augai.sus', 9898989899, NULL, 2, 0, 0, 1, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 176, 3, '2019-10-26 16:59:37', '2019-10-26 11:50:10', 0, 0, NULL, NULL, 1),
(192, 'manikandan@estrrado.com', 7736605372, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-10-26 18:06:25', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 18:06:22', '2019-10-26 12:36:44', 0, 0, NULL, NULL, 1),
(193, 'haha@BB.j', 21345454545, '', 2, 0, 1, 1, '2019-10-26', '0', NULL, '2019-10-26 18:37:41', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 18:37:41', '2019-10-26 15:49:25', 0, 0, NULL, NULL, 0),
(194, 'vishnu@estrrado.com', 7736651253, '', 2, 0, 0, 1, '2019-10-26', '0', NULL, '2019-10-26 18:56:23', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 18:56:23', '2019-10-26 15:48:38', 0, 0, NULL, NULL, 1),
(195, 'coach1@swim.com', 99988877761, '$2y$10$dBPPDvdHCU75RlH1LqTmv.R6LcDq3RdW6fvj3up4YDFwfpqAPmD7G', 1, 0, NULL, 1, '2019-11-11', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-10-26 21:13:45', '2019-11-11 08:00:47', 0, 0, NULL, NULL, 1),
(196, 'kaharkassim@gmail.com', 9123456789, '', 2, 0, 0, 0, NULL, '0', NULL, '2019-10-31 11:13:11', NULL, NULL, NULL, NULL, 0, NULL, '2019-10-31 11:12:24', '2019-10-31 05:43:23', 0, 0, NULL, NULL, 1),
(197, 'Priya.jacob@estrrado.co.in', 9072344211, '', 2, 0, 0, 1, '2019-11-01', '0', NULL, '2019-11-01 10:58:13', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-01 10:58:13', '2019-11-06 05:59:08', 0, 0, NULL, NULL, 0),
(198, 'maya@q.com', 2580369010, '', 2, 1, 1, 1, '2019-12-04', '198401050', NULL, '2019-12-04 12:48:12', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-01 11:01:55', '2019-12-04 07:18:15', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(199, 'priya@q.com', 9072344222, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 198, 1, '2019-11-01 11:04:54', '2019-12-11 05:00:01', 0, 0, NULL, NULL, 1),
(200, 'ghh@vv.n', 8756963212, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-04 14:41:01', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-04 14:41:01', '2019-11-04 09:11:07', 0, 0, NULL, NULL, 1),
(201, 'ghh@gbb.n', 9692580741, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-04 14:47:31', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-04 14:47:31', '2019-11-04 09:17:36', 0, 0, NULL, NULL, 1),
(202, 'ghhh@cv.n', 9632580742, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-04 14:53:54', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-04 14:53:54', '2019-11-04 09:24:17', 0, 0, NULL, NULL, 1),
(203, 'rt@v.n', 9632580123, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-04 18:10:35', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-04 18:10:35', '2019-11-29 07:55:16', 0, 0, NULL, NULL, 1),
(204, 'Simisaji56@estrrado.com', 9121212121, '', 2, 1, 0, 1, '2019-11-06', '204629670', NULL, '2019-12-16 10:56:18', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:40:02', '2021-05-11 23:12:39', 0, 3, 'f2_MJRImQC8:APA91bGkntRSzP-JsohG7stunPVAZrhLT3jSF9dTW3McMgUwuCm94l1EdaM3NOsvzfNyS5YRHV6xRKervs8F-wSesXfUJkKrTUI1qOQgOi9PRaXbxycTLzdW_kPSYbURNU_xCaB0qtIX', 'android', 1),
(205, 'priya@q.comm', 1471471471, '', 2, 0, 0, 1, '2019-11-06', '0', 1234, '2019-11-06 11:47:57', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:43:41', '2019-12-06 04:30:02', 0, 0, NULL, NULL, 0),
(206, 'g@s.com', 9898989898, '', 2, 0, 1, 1, '2019-11-14', '0', 1234, '2019-11-28 13:34:39', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:49:54', '2020-10-21 06:01:34', 0, 0, NULL, NULL, 1),
(207, 'par@a.com', 9869869866, '', 2, 1, 0, 1, '2019-12-02', '207718360', NULL, '2019-12-02 14:33:08', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:51:12', '2019-12-02 09:04:28', 1, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(208, 'paru@g.com', 9619619612, '', 2, 0, 0, 1, '2019-11-13', '0', 1234, '2019-11-13 11:05:18', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:52:19', '2019-11-13 05:35:48', 0, 0, NULL, NULL, 0),
(209, 'leah@r.com', 3636363633, '', 2, 1, 0, 1, '2019-11-06', '209728156', NULL, '2019-11-20 12:04:45', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-06 11:59:50', '2019-12-02 05:23:41', 3, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 0),
(210, 'riya@q.com', 1234567899, '$2y$10$myUyg4/jYCP1BemQn4BVMOCi9M3CDswZroAUx.hRDCT9Ivkoms7qq', 1, 0, NULL, 1, '2019-11-06', '0', NULL, NULL, NULL, '4g2xzjV9i3Wf69sXjcOYQgJkpX7UGuU75K3F8gwf4Rugph6Edmh4QMcXUhpn', NULL, '2019-11-20 17:45:09', 0, NULL, '2019-11-06 15:09:20', '2019-12-16 11:07:17', 0, 0, NULL, NULL, 1),
(211, 'anoop@esfyu.gjk', 9111111111, '', 2, 1, 0, 1, '2019-11-07', '211749800', NULL, '2019-11-07 11:19:51', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-07 11:19:18', '2019-11-07 05:49:54', 0, 0, 'cOh4cMkiSoM:APA91bG2yKCGabokA67aqet8n4C6zM3EBTonzrmcPQMk6SfndwnulsOAXNtgKG1M_vE7vMAnb6ayeplDyu0tlRmeUfW68LB7K5OAZbhVXxAPzMACYZaYwKhUwbK0SHWwurq7tq00VBpK', NULL, 1),
(212, 'rohan@a.com', 9696969699, '', 2, 1, 0, 1, '2019-11-07', '212351619', NULL, '2019-11-07 14:52:54', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-07 14:50:19', '2019-11-13 08:34:00', 0, 0, 'dMkUoF31FqA:APA91bGrHXM_4JeMSkilyIoQ1btILG6iNMWA_q5aKtklyfFzfdVYFCAeAgZRCZ5suN_kL7c8bkTiYXDY4RXfioVSRuFdwPoBq3Q5At1lAw7UfaBXkVRaSJPK2AKSXXVJSgsFLK_JStsF', NULL, 1),
(213, 'simi12@estrrafo.com', 9141414141, '', 2, 0, 1, 0, '2019-11-14', '0', NULL, '2019-11-08 12:05:36', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-08 12:05:36', '2019-11-15 05:31:44', 0, 0, NULL, NULL, 0),
(214, 'anoopz@estrrado.com', 9632581471, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 213, 1, '2019-11-08 12:07:03', NULL, 0, 0, NULL, NULL, 1),
(215, 'athira@estrrado.com', 9638527413, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 213, 2, '2019-11-08 12:07:03', NULL, 0, 0, NULL, NULL, 1),
(216, 'sanu@estrrafo.com', 9232323232323, '', 2, 0, 0, 0, NULL, '0', NULL, '2019-11-11 10:02:05', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-11 10:02:05', '2019-11-11 04:32:13', 0, 0, NULL, NULL, 1),
(217, 'ash@hdusjsgsu.vbhk', 9961527022, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-11 12:34:10', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-11 12:34:10', '2019-11-22 14:58:21', 0, 0, NULL, NULL, 1),
(218, 'joble45@estrrado.com', 9424545454, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-13 10:12:32', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 10:03:43', '2019-11-13 04:58:50', 0, 0, NULL, NULL, 1),
(219, 'kp@est.vom', 9696969696, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-13 10:30:28', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 10:30:28', '2019-11-13 05:00:32', 0, 0, NULL, NULL, 1),
(220, 'joble99@estrrado.com', 9988776655, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-13 10:51:41', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 10:51:41', '2019-11-13 05:21:49', 0, 0, NULL, NULL, 1),
(221, 'gayu@q.com', 9639639632, '', 2, 1, 0, 1, '2019-11-13', '221226933', NULL, '2019-11-13 14:21:41', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 11:06:50', '2021-05-11 23:13:07', 0, 6, 'fQ7YmdCiXaw:APA91bGQgFdTekOIL0UkPZWWilN3zqeU4M9MCEVvtkI-IRjQcB1NQ6DfRLfnvC-N3ffHfY6jhKG9gDwEgljoZph4Ujjp__1dOaJ_McXCR5q7XgSOCtaKj3CcOYtCBIfQlvFwip1EEK8T', 'android', 1),
(222, 'santhi@q.com', 9879879870, '', 2, 1, 0, 1, '2019-11-13', '222783742', NULL, '2019-11-13 16:07:17', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 11:17:06', '2019-11-13 10:37:37', 0, 0, 'fdE00qISxHc:APA91bG1jc4LAYXCsVzI6GaM1soseyIlRxS2F66a0xGW8sUNkBRxHrQxzabX9pw3C5b6DLKxnv_2DPKgURCbJQmDO4djHzoQtoSAmo3VBscEoegLZ04gsAdmRVigYmu_LTA6taP3JwLJ', 'android', 1),
(223, 'fini@q.com', 9519519513, '', 2, 1, 0, 1, '2019-11-13', '223424702', NULL, '2019-11-13 18:05:14', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 16:14:26', '2019-11-13 12:35:18', 0, 0, 'eNvruDMumdI:APA91bFysH4thnP9ftMbfVI3FpQe9OfyRT9P3jMHrtwhslx6__xeaNlWBFgFmbXy8dkGmL1l3MfhgRUFnS9BD1rbwa0GzDCqbNgsXInC8ujOuC_QOtykOnKFPT-qFjItpbZWD5SiiMQJ', 'android', 0),
(224, 'fini@w.com', 9090909090, '', 2, 1, 0, 1, '2019-11-13', '224940394', NULL, '2019-11-22 18:25:49', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-13 18:10:17', '2019-11-22 12:55:53', 0, 0, 'd9ApKZKEzfc:APA91bF0Y4quQyyeIOFZSDxGNaJsp3YEdcnXQQf7XMCXU9mSljXflGkI85dz7OLqlXfz97wvVEiTiUIsdjVrzBmmx1_G_EMDTNCFoZLl3WIQyMoOZwO6igO8tL3NLBjtxcER1vAx5Gkj', 'android', 1),
(225, 'haifa@q.com', 8976543210, '$2y$10$FjoTz8b8aR20MWDJbXaJJOx8NfXxdqj8sLf6BjizkZlBaRj05EFHy', 1, 0, NULL, 1, '2019-11-13', '0', NULL, NULL, NULL, 'hKvqkyAa29ugoG0PWvBd3WKDw8pci0R4eaUq64fwI3cIxOYLsFRw4h3x7iFc', NULL, '2019-12-09 13:39:22', 0, NULL, '2019-11-13 18:19:46', '2019-12-09 08:09:22', 0, 0, NULL, NULL, 1),
(226, 'anupama140@estrrado.com', 9559048140, '$2y$10$YdVcA00sopNV5dzrHLfMi.Y81Dk/.utMbf7.KoLMzCB3gNrcoMHNu', 1, 0, NULL, 1, '2019-11-14', '0', NULL, NULL, NULL, '1oRK09JRjcWRPhbm0MoFVphX8jh3nh5aqND8SOzQthE3JunDlFw4sRUQBAmh', NULL, '2019-11-23 11:01:12', 0, NULL, '2019-11-14 10:31:37', '2019-11-23 05:31:12', 0, 0, NULL, NULL, 1),
(227, 'gg@ff.h', 8052345696, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-14 13:56:17', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-14 13:56:17', '2019-11-14 08:26:22', 0, 0, NULL, NULL, 1),
(228, 'saneesh@estrrado.con', 4586582581, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-15 09:24:59', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-15 09:24:59', '2019-11-15 03:55:12', 0, 0, NULL, NULL, 1),
(229, 'Simisaji168@gmail.com', 9544348140, '', 2, 1, 1, 1, '2019-11-15', '229802592', NULL, '2019-11-25 11:35:49', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-15 10:55:09', '2019-11-25 06:05:53', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(230, 'sahira@estrrado.com', 9212121212, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-18 11:18:39', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-18 11:18:39', '2019-11-18 05:48:44', 0, 0, NULL, NULL, 1),
(232, 'merlinu@estrrado.com', 963235689, '$2y$10$xTY4ojYuWNZIWY6zEq4ImeKoz08F1KbwEQXzC8YtN5.lVlSz6jW1y', 1, 0, NULL, 1, '2020-10-13', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-18 10:26:21', '2020-10-13 04:20:12', 0, 0, NULL, NULL, 1),
(233, 'sillu@gmail.com', 7705993378, '$2y$10$xZVY9RUgKK6dy12gn7vKReY1xlVUbyXqUMnL0ANcBXzSqAAPBYW1K', 1, 0, NULL, 0, '2021-04-28', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-18 10:28:24', '2021-04-28 05:45:51', 0, 0, NULL, NULL, 1),
(234, 'merlinkk@estrrado.com', 9876543256, '$2y$10$62UDLIGnmZ1LDmWe7vWtZuz1xYE4k6xe/DRVlER5HrHDRL896yotu', 1, 0, NULL, 1, '2020-04-11', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-18 10:41:27', '2020-04-11 06:05:57', 0, 0, NULL, NULL, 1),
(235, 'merlin411@estrrado.com', 9092564955, '$2y$10$5CrkwnnNVE6S1kOiW22haegFT8LLgUR1UH98eWg4v4Ikki8S/znhG', 1, 0, NULL, 1, '2020-04-11', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-18 10:44:19', '2020-04-11 06:05:12', 0, 0, NULL, NULL, 1),
(236, 'merlin52@estrrado.com', 96523874, '$2y$10$SVBDWd7CJnyeMjjVoY.GLO0czsrRsuhQC45fUPCfsa0cXsB.yB4z6', 1, 0, NULL, 0, '2019-12-11', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 05:42:25', '2019-12-11 07:23:02', 0, 0, NULL, NULL, 1),
(237, 'd@q.com', 9393939393, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-11-19 12:02:43', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 12:02:43', '2019-12-06 04:56:01', 0, 0, NULL, NULL, 0),
(238, 'a@q.com', 9393939392, '', 2, 1, 0, 1, '2019-11-20', '238193569', NULL, '2019-11-20 16:57:45', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 12:13:39', '2019-11-29 09:49:13', 2, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(239, 'devi@q.com', 9595959591, '', 2, 1, 1, 1, '2019-11-20', '239661701', NULL, '2019-11-20 16:32:17', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 13:09:18', '2019-12-03 10:09:34', 1, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(240, 'gini@q.com', 9494949494, NULL, 2, 1, 0, 1, '2019-11-19', '240282130', NULL, '2019-11-20 16:31:51', NULL, NULL, NULL, NULL, 239, 1, '2019-11-19 13:43:28', '2019-12-03 10:09:34', 1, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(241, 'feba@q.com', 7227722772, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-19 15:03:57', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 15:03:57', '2019-11-19 09:34:12', 0, 0, NULL, NULL, 1),
(242, 'sherinm@gmail.com', 9876543215, '$2y$10$fKBCxbawagggT6lgYV491eCm9eFri.3hnJNZCWuP8gbzsRxMXvhiy', 1, 0, NULL, 1, '2020-04-11', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 09:57:35', '2020-04-11 06:02:29', 0, 0, NULL, NULL, 1),
(243, 'gopi@q.com', 7070707070, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-19 15:46:29', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-19 15:46:29', '2019-11-19 10:16:38', 0, 0, NULL, NULL, 1),
(244, 'anuska@estrrado.com', 9120912091, '', 2, 1, 1, 1, '2019-11-20', '244973274', NULL, '2019-11-28 13:35:29', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-20 09:35:47', '2019-11-28 08:05:47', 0, 0, 'd9ApKZKEzfc:APA91bF0Y4quQyyeIOFZSDxGNaJsp3YEdcnXQQf7XMCXU9mSljXflGkI85dz7OLqlXfz97wvVEiTiUIsdjVrzBmmx1_G_EMDTNCFoZLl3WIQyMoOZwO6igO8tL3NLBjtxcER1vAx5Gkj', 'android', 0),
(245, 'anu12@estrrado.com', 9852487563, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 244, 2, '2019-11-20 09:37:37', NULL, 0, 0, NULL, NULL, 1),
(246, 'anoop@estrrado.com', 9741253698, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 244, 1, '2019-11-20 09:37:37', NULL, 0, 0, NULL, NULL, 1),
(247, 'akash@estrrado.com', 7523698541, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 244, 3, '2019-11-20 09:37:37', NULL, 0, 0, NULL, NULL, 1),
(248, 'dude@gmail.com', 1234567, '', 2, 1, 0, 1, '2019-11-20', '248697737', NULL, '2019-11-20 12:09:47', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-20 12:08:43', '2019-11-20 06:39:52', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(249, 'jacob@q.com', 7417417417, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-20 16:52:23', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-20 16:52:23', '2019-11-20 11:22:40', 0, 0, NULL, NULL, 1),
(250, 'sanu@estrrado.cim', 9222222222, '', 2, 1, 0, 1, '2019-11-22', '250951697', NULL, '2019-11-22 10:08:47', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-22 10:05:35', '2019-11-27 11:26:35', 2, 0, 'fQ7YmdCiXaw:APA91bGQgFdTekOIL0UkPZWWilN3zqeU4M9MCEVvtkI-IRjQcB1NQ6DfRLfnvC-N3ffHfY6jhKG9gDwEgljoZph4Ujjp__1dOaJ_McXCR5q7XgSOCtaKj3CcOYtCBIfQlvFwip1EEK8T', 'android', 1),
(251, 'merlin.s@estrrado.co.in', 9961527023, '$2y$10$9NErFm6NMeO1JeunncwmoOGJNkM8YkwV7PxbkVLi64XzerjTLKYDu', 2, 1, 0, 1, '2019-11-22', '251134264', NULL, '2019-12-03 18:13:42', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-22 14:57:13', '2019-12-06 04:57:15', 0, 0, 'eZh6pIuau54:APA91bFw6nfRfPEewLvRkfzMERRaISUrj9LBeVLAkKAuMfC1S3UE4lQoBj2W8HQKRLhAS6t5yrdYoi4ZpNlNu76U5QBypqE1LosC8aK63CNgPjlkMtNVbrhOMAVelSn9Mg-PfExT9oM0', 'android', 1),
(252, 'raju@estrrado.com', 7777777777, '$2y$10$pXZtJctAtxxjNlutueoeKe7O57XWtMWA2uzVTv51puHOphMDNvLfa', 1, 0, NULL, 1, '2019-11-23', '0', NULL, NULL, '', 'f11ZpZePhdzeV6mvQZYDtdrxCxr3XuP89pDwpFuFyjxrz5Y6uoxmijScA9fu', '2019-11-23 10:39:16', '2019-11-23 10:37:19', 0, NULL, '2019-11-23 10:07:37', '2019-11-23 05:12:09', 0, 0, NULL, NULL, 1),
(253, 'joble10@estrrado.com', 9544348140, '$2y$10$flGdnaXhqnC28B.4a04qputqGpx/nEj4lGVAdBva7oH6XWklNkivW', 1, 0, NULL, 1, '2020-04-11', '0', 1234, '2019-11-25 11:35:49', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-23 05:30:42', '2020-04-11 06:00:40', 0, 0, NULL, NULL, 1),
(254, 'simi@getnada.com', 9544734814, '$2y$10$AG71hcKAOM6nCAoFSyMffOZSaCJOtOhDM6G5SzVmntGVl0BXp73nS', 1, 0, NULL, 1, '2019-11-25', '0', NULL, NULL, NULL, 'OYUuNHfG1kq6wun0qixTRVdWoqYHPvxfGLSzRmrlfrBpG0mOvbIHhJdyYoyL', NULL, '2019-11-25 16:09:43', 0, NULL, '2019-11-25 04:47:28', '2019-11-29 11:50:23', 0, 0, NULL, NULL, 0),
(255, 'merlin123@estrrado.com', 9092564985, '$2y$10$R7vUF1.slqU0ygtDt9m.H.MoJMnrFWRkYW9tNrul2OpWA6Iejyebq', 1, 0, NULL, 1, '2019-12-12', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-25 05:49:25', '2019-12-12 10:21:22', 0, 0, NULL, NULL, 1),
(256, 'simi@getnado.com', 9544348141, '$2y$10$G4KIfZODYYJF0DfKjM1nuuemqfXIpeWa3u5S/2zoGxQY2U9ayjn1K', 1, 0, NULL, 1, '2019-11-25', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-11-25 11:46:00', '2019-11-29 11:50:27', 0, 0, NULL, NULL, 0),
(257, 'sanuja@estrrado.com', 9639639639, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-25 12:06:06', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-25 12:06:06', '2019-11-25 06:36:15', 0, 0, NULL, NULL, 1),
(258, 'kp@estrrado.com', 9879879879, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-25 12:08:02', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-25 12:08:02', '2019-11-25 06:38:08', 0, 0, NULL, NULL, 1),
(259, 'vyka@estrrado.com', 9131313131, '', 2, 1, 0, 1, '2019-11-25', '259559494', NULL, '2019-12-05 14:10:27', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-25 12:21:51', '2020-04-11 04:37:05', 2, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(260, 'simisaji@zetmail.com', 9447348141, '$2y$10$oa.dNwnwLD2F.32EKCPyceGEBUvfzN61sqpTtf/nv2FSuXGrZV0SS', 1, 0, NULL, 1, '2019-11-25', '0', NULL, NULL, 'NDkyMjEzcmVzZXRwYXNzd29yZDE1NzY2NTQ2OTQx', 'yFD3c1MtrWDuTAY9kq7Rj0PbvuQso0ZhyUu4eQ71ONIGwjw6joS79WiCFkUt', '2019-12-18 13:08:14', '2019-12-18 13:07:54', 0, NULL, '2019-11-25 16:04:53', '2019-12-18 07:38:14', 0, 0, NULL, NULL, 1),
(261, 'anamika@estrrado.com', 9151515151, '', 2, 1, 0, 1, '2019-11-28', '261293557', NULL, '2019-11-28 14:05:51', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-28 09:51:36', '2019-11-28 08:37:20', 0, 0, 'd9ApKZKEzfc:APA91bF0Y4quQyyeIOFZSDxGNaJsp3YEdcnXQQf7XMCXU9mSljXflGkI85dz7OLqlXfz97wvVEiTiUIsdjVrzBmmx1_G_EMDTNCFoZLl3WIQyMoOZwO6igO8tL3NLBjtxcER1vAx5Gkj', 'android', 1),
(262, 'aa@estrrado.com', 9966332211, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-28 10:02:08', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-28 10:02:08', '2019-11-28 04:32:12', 0, 0, NULL, NULL, 1),
(263, 'cjvIviB@boAbkab.kbka', 996152708, '', 2, 0, NULL, 0, NULL, '0', NULL, '2019-11-28 11:01:18', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-28 11:01:18', '2019-12-06 04:57:49', 0, 0, NULL, NULL, 0),
(264, 'cHcacauuga.sjg@ugs.x', 996666996, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-28 11:02:20', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-28 11:02:20', '2019-11-28 05:32:35', 0, 0, NULL, NULL, 1),
(265, 'm@estrrado.com', 9999999996, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-11-28 13:25:33', NULL, NULL, NULL, NULL, 0, NULL, '2019-11-28 13:25:33', '2019-11-28 07:55:50', 0, 0, NULL, NULL, 1),
(266, 'v@gh.com', 9999999993, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 265, 3, '2019-11-28 13:26:39', NULL, 0, 0, NULL, NULL, 1),
(267, 'joble@getnada.com', 7418529632, '$2y$10$5UwBDC6tefX6UK6FrDyrZuvLy3/9ROgwSSMIeCKT909y1x7HSMkv.', 1, 0, NULL, 1, '2019-12-02', '0', NULL, NULL, 'OTA3MTI0cmVzZXRwYXNzd29yZDE1NzYyMTg3NjAx', 'RoEZ7q8QkJ8JO1mfqRtMMIdpL4oAhKs2n8jNSsxoTkDAX8n0qJ0VpY611dh6', '2019-12-13 12:02:40', '2019-12-13 12:01:27', 0, NULL, '2019-12-02 08:51:50', '2019-12-13 06:32:40', 0, 0, NULL, NULL, 1),
(268, 'vishnu12@estrrado.com', 9074555150, '', 2, 1, 0, 1, '2019-12-03', '268496076', NULL, '2019-12-03 15:21:16', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-03 15:19:58', '2019-12-03 10:10:03', 2, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(269, 'amal@estrrado.com', 9181818181, '', 2, 1, 1, 1, '2019-12-05', '269407311', NULL, '2019-12-12 13:34:13', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-05 14:15:58', '2019-12-12 08:04:17', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(270, 'chithu@estrrado.com', 9181181181, NULL, 2, 0, 0, 1, '2019-12-06', '0', 1234, '2019-12-18 15:22:32', NULL, NULL, NULL, NULL, 269, 1, '2019-12-05 14:18:21', '2019-12-18 09:52:32', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(271, 'geethu@estrrado.com', 91811191181, NULL, 2, 1, 0, 1, '2019-12-06', '271866783', NULL, '2019-12-09 14:50:09', NULL, NULL, NULL, NULL, 269, 2, '2019-12-05 14:18:21', '2019-12-09 09:20:14', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(272, 'kavita@q.com', 9236554440, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-12-05 17:13:50', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-05 17:13:50', '2019-12-06 04:28:13', 1, 0, NULL, NULL, 0),
(273, 'kavita@q.co.in', 9836580002, NULL, 2, 1, 0, 1, '2019-12-05', '273917453', NULL, '2019-12-05 17:23:21', NULL, NULL, NULL, NULL, 272, 1, '2019-12-05 17:18:07', '2019-12-06 04:28:03', 0, 0, 'f-3XDXLqwTo:APA91bEPuOz_EyYZPxqv9L4RUaIMAbwV6VM_rWoro0tJlMB6GfUg9Ko-REI0y1ye7wSqjNtfvlP22waVygcWyWvOD5VHkS273AA1kySlOxYWGT-dXzDITtIjvR4CMocZR0oayeBp1nhH', 'android', 0),
(274, 'sheela@q.com', 9632589632, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-12-06 11:03:58', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-06 11:03:48', '2019-12-09 04:32:59', 4, 0, NULL, NULL, 1),
(275, 'nikku@q.com', 9859859852, NULL, 2, 1, 0, 1, '2019-12-06', '275544414', NULL, '2019-12-09 15:03:53', NULL, NULL, NULL, NULL, 274, 2, '2019-12-06 11:07:12', '2019-12-09 09:34:01', 0, 0, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(276, 'joel@q.com', 9859859852, NULL, 2, 0, 0, 1, '2019-12-06', '0', 1234, '2019-12-09 15:03:53', NULL, NULL, NULL, NULL, 274, 1, '2019-12-06 11:07:12', '2019-12-09 09:33:53', 0, 0, NULL, NULL, 1),
(277, 'vishnum678@gmail.com', 9074555150, '$2y$10$lLwqU/cmLj4xWyFcwBn9QeSzyYDX.4L/L8hJGwpNumBTepwttmA2W', 1, 0, NULL, 1, '2020-03-28', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-12-06 11:21:13', '2020-03-28 05:06:41', 0, 0, NULL, NULL, 1),
(278, 'monish@elviserp.com', 9605935555, '', 2, 1, 0, 1, '2019-12-06', '278432328', NULL, '2019-12-06 17:00:12', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-06 16:51:11', '2019-12-07 08:47:08', 6, 1, 'eDAgrI7hDcY:APA91bEvFH-RyyWyAdxjsOrYHM1H6WhNPd1jbE1DbEPVgujS6uCbtVs7OR0NpeSuuvf0v6PMoH8-VwERVIiK1ieEFotl40XYV_sWpRCPpGq-PYqEM7ROLjR6oazIhpSOYiWtv2W18tiD', 'ios', 1),
(281, 'test@email.com', 8888888887, NULL, 2, 0, 0, 1, '2019-12-07', '0', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2019-12-07 13:13:13', '2019-12-07 13:15:12', 0, 0, NULL, NULL, 1),
(282, NULL, NULL, NULL, 2, 0, 0, 1, '2019-12-07', '0', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2019-12-07 13:14:11', '2019-12-07 07:45:21', 0, 0, NULL, NULL, 1),
(283, NULL, NULL, NULL, 2, 0, 0, 1, '2019-12-07', '0', NULL, NULL, NULL, NULL, NULL, NULL, 3, NULL, '2019-12-07 13:14:31', '2019-12-07 07:44:42', 0, 0, NULL, NULL, 0),
(284, 'parent2@parent.com', 666666666, NULL, 2, 0, 1, 1, '2019-12-07', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-12-07 13:22:32', NULL, 0, 0, NULL, NULL, 1),
(285, 'mohan@y.com', 9258925892, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-12-09 12:04:45', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-09 12:04:45', '2019-12-09 06:35:53', 0, 0, NULL, NULL, 1),
(286, 'manu@y.com', 9369369369, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 285, 1, '2019-12-09 12:08:40', NULL, 0, 0, NULL, NULL, 1),
(287, 'sun@q.com', 9369369369, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 285, 1, '2019-12-09 12:08:40', NULL, 0, 0, NULL, NULL, 1),
(288, 'yamini@y.com', 9494949499, '', 2, 0, 1, 0, NULL, '0', NULL, '2019-12-09 12:13:31', NULL, NULL, NULL, NULL, 0, NULL, '2019-12-09 12:13:31', '2019-12-10 11:22:51', 7, 0, NULL, NULL, 1),
(289, 'ester@y.com', 9089089089, NULL, 2, 1, 0, 1, '2019-12-09', '289523759', NULL, '2019-12-10 15:12:01', NULL, NULL, NULL, NULL, 288, 2, '2019-12-09 12:18:48', '2019-12-10 12:27:01', 0, 0, 'fllSbpuQ7uw:APA91bHPrk1V03WU9r-ZgNvPWNN-4hCdifBP-YZwsPt4DYjKdOLFGU47R4os4VjrEZ0Iiy3nZ5Q6e5Sdsttr8g8A4Zw_JPFyzz-ri_Qkufu6EPB-nudxKQc2VR20dISNcUjefZ3nzIm3', 'android', 1),
(290, 'rehan@y.com', 9089089089, NULL, 2, 0, 0, 1, '2019-12-09', '0', 1234, '2019-12-10 15:12:01', NULL, NULL, NULL, NULL, 288, 1, '2019-12-09 12:18:48', '2019-12-10 09:42:01', 0, 0, NULL, NULL, 1),
(291, 'tara@y.com', 9089089089, NULL, 2, 0, 0, 1, '2019-12-09', '0', 1234, '2019-12-10 15:12:01', NULL, NULL, NULL, NULL, 288, 2, '2019-12-09 12:18:48', '2019-12-10 09:42:01', 0, 0, NULL, NULL, 1),
(292, 'varun@q.com', 4564564561, '$2y$10$w8Y7negfmE9oHM2J7C3S6e8e..9LxlwjM1WRVQNufgcYeQ1WiqEAq', 1, 0, NULL, 1, '2019-12-09', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-12-09 13:35:51', NULL, 0, 0, NULL, NULL, 1),
(293, 'sachin@q.com', 8978978976, '$2y$10$IxrqRMp.MlM3WElFFJTon.PW.FkyR//tkPsqgl1UDJ3Uvl908eteS', 1, 0, NULL, 1, '2019-12-09', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2019-12-09 13:37:08', '2020-10-21 11:29:55', 0, 1, NULL, NULL, 1),
(294, 'dp@gmail.con', 94963598866, '', 2, 0, NULL, 0, NULL, '0', NULL, '2020-06-26 11:44:06', NULL, NULL, NULL, NULL, 0, NULL, '2020-06-26 11:44:06', NULL, 0, 0, NULL, NULL, 1),
(295, 'deep@gmail.com', 94963598867, '', 2, 0, 1, 0, NULL, '0', NULL, '2020-06-26 11:45:05', NULL, NULL, NULL, NULL, 0, NULL, '2020-06-26 11:45:05', '2020-06-26 06:15:12', 0, 0, NULL, NULL, 1),
(296, 'geethuraj92@gmail.com', 9633315603, '', 2, 0, 0, 0, NULL, '0', NULL, '2020-06-26 11:52:10', NULL, NULL, NULL, NULL, 0, NULL, '2020-06-26 11:52:10', '2020-06-26 06:22:16', 0, 0, NULL, NULL, 1),
(297, 'athira.suresh@estrrado.com', 8089821130, '', 2, 0, 0, 0, NULL, '0', NULL, '2020-09-10 11:59:16', NULL, NULL, NULL, NULL, 0, NULL, '2020-09-10 11:59:16', '2020-09-10 06:29:36', 0, 0, NULL, NULL, 1),
(298, 'priya.m@estrrado.com', 7356868433, '', 2, 0, 1, 0, NULL, '0', NULL, '2020-10-05 12:52:12', NULL, NULL, NULL, NULL, 0, NULL, '2020-10-05 12:52:12', '2020-10-05 07:22:39', 0, 0, NULL, NULL, 1),
(299, 'deepz@estrrado.com', 9496366688, '$2y$10$zNUueF.LqrtFVoW.zzbKt.dliSGo2eHG.oHJiyTqpLli7SutV.ey2', 1, 0, NULL, 1, '2020-10-06', '0', NULL, NULL, NULL, '5e2fttsoGXivdmkePdDFKOXBsrtG6kNbDvhIVUAAou73HVtlzgdPwfGRXTPJ', NULL, '2020-10-24 10:30:20', 0, NULL, '2020-10-06 12:49:35', '2020-10-24 05:00:21', 0, 0, NULL, NULL, 1),
(300, 'deeputalkin@gmail.com', 9447017862, '$2y$10$SbI9MCv7D7IbIKchYhzdDOtb1IJkU60T7EtorcbwqwLHJ3pNaByjy', 1, 0, NULL, 1, '2020-10-13', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-10-13 10:21:25', NULL, 0, 0, NULL, NULL, 1),
(301, 'p@gmail.com', 9847348894, NULL, 2, 0, 0, 0, NULL, '0', NULL, NULL, NULL, NULL, NULL, NULL, 152, 1, '2020-10-15 19:45:22', NULL, 0, 0, NULL, NULL, 1),
(302, 'anuroop@gmail.com', 9895222222, '', 2, 1, 0, 1, '2020-10-20', '302486344', NULL, '2020-10-23 10:34:47', NULL, NULL, NULL, NULL, 0, NULL, '2020-10-20 11:14:41', '2020-10-23 05:04:51', 1, 0, 'cL1I7lInkTw:APA91bFbsFYxz1v5CPqzr-f6__Ut6iyPghN_TaA4_TfVZwGai3iGfBHRkXqRGYPnCbUXu51NxcFg0f8tkuydeDyiNfeAyTbtNn6N0BOpRdYhKx3FxRceSsSrODsa2obDXnJySqFfcDXw', 'ios', 1),
(303, 'lekshmi@estrrado.com', 7994510065, '$2y$10$UJ8dvXyjIgxd8YXi.9XeDOWid7u4fYYdHrlSIPtmXp5WBG/ZL8Oja', 1, 0, NULL, 1, '2020-10-21', '0', NULL, NULL, NULL, '91SpeJi1gyHf9eogWLfNPZME9VxkPleMgRtRh5aCRGWe5ETxubnjHoeW6sWL', NULL, '2020-10-27 18:33:59', 0, NULL, '2020-10-21 14:09:46', '2020-10-27 13:03:59', 0, 0, NULL, NULL, 1),
(304, 'lekshmi@gmail.com', 7994510064, '', 2, 1, 0, 1, '2020-10-21', '304517319', NULL, '2020-10-21 14:22:42', NULL, NULL, NULL, NULL, 0, NULL, '2020-10-21 14:21:43', '2020-10-23 03:48:00', 1, 0, 'dJ3pcBku3Fc:APA91bFOc7oyfODpjpv67wsE8_fkNcc2A9zIXyM1mT2f-4Nazs-mYzgmv-WYRnzwFww4wyIPK_tCzdg-QKmEjKPCV6GDetlhdO3Xxx5RE7CI3nQmBOLQ78CPM7_WMMUNgsL8Gspkq5WQ', 'android', 1),
(305, 'athira123@estrrado.com', 8765432100, '$2y$10$kgBPBPwjJ8eMRU3C3uqcuO3b2mJUWj0.Pd1ob73zOxkmN3mTSf3Eu', 1, 0, NULL, 1, '2020-10-21', '0', NULL, NULL, NULL, 'EBEZ5kS51Ry0t1zedSNtzBl1llkNW12cQfnF1O7i6i2kyqfRv2MKVN1sYPKZ', NULL, '2020-10-21 15:06:49', 0, NULL, '2020-10-21 09:09:10', '2020-10-21 09:36:49', 0, 0, NULL, NULL, 1),
(306, 'ram@gmail.com', 9632365120, '$2y$10$y8P2tFPe.0u4VfcsDczmQuSoci6e/.dpQT97YkpAMnPXoCAw6kuYO', 1, 0, NULL, 1, '2020-10-21', '0', NULL, NULL, NULL, 'LzXvSB4UaVjuyn19MZD3dikU36g2u2v3vPpu0r16Pt1sgQ4rOK84tSeIu26o', NULL, '2020-10-21 17:42:12', 0, NULL, '2020-10-21 15:25:31', '2020-10-22 07:15:49', 0, 1, NULL, NULL, 1),
(307, 'dev@gmail.com', 9874520212, '$2y$10$l.F1p/qrvDPl4KnBVVudSO.trU6v7m.axLVXPBvhkSQ4udz70aibS', 1, 0, NULL, 1, '2020-10-21', '0', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2020-10-21 10:58:41', '2020-10-21 10:59:03', 0, 0, NULL, NULL, 1);

--
-- Triggers `sw_users`
--
DELIMITER $$
CREATE TRIGGER `delete_user_detail` AFTER DELETE ON `sw_users` FOR EACH ROW delete from sw_user_details where sw_user_details.user_id = old.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_details`
--

CREATE TABLE `sw_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(55) NOT NULL,
  `experience` int(20) NOT NULL,
  `company_name` varchar(55) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `city` varchar(55) DEFAULT NULL,
  `state` varchar(55) DEFAULT NULL,
  `country` varchar(55) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `company_logo` varchar(255) DEFAULT NULL,
  `avthar` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_user_details`
--

INSERT INTO `sw_user_details` (`id`, `user_id`, `name`, `experience`, `company_name`, `address1`, `address2`, `dob`, `city`, `state`, `country`, `zip`, `company_logo`, `avthar`, `created`, `modified`, `status`) VALUES
(1, 1, 'Merlin Sundar Singh', 6, 'Salon Shop1', 'Thiruvananthapuram', 'TVM', NULL, '2045', '19', '101', NULL, '/app/public/business_logo_picture/1559220802_product_36_1_thumb.jpg', '/app/public/users/1/avthar.png', '2019-02-08 05:51:18', '2019-12-07 13:58:10', 1),
(2, 2, 'Student One', 0, '', 'Vellayambalam', 'TVM', NULL, '2045', '19', '101', NULL, '/app/public/business_logo_picture/1559220802_product_36_1_thumb.jpg', '/app/public/shop_profile_picture/1553245132_profile.jpg', '2019-02-08 05:51:18', '2019-11-11 16:05:57', 1),
(3, 3, 'Parent', 0, '', 'Vellayambalam', 'TVM', NULL, '2045', '19', '101', NULL, '/app/public/business_logo_picture/1559220802_product_36_1_thumb.jpg', '/app/public/shop_profile_picture/1553245132_profile.jpg', '2019-02-08 05:51:18', '2019-12-07 13:18:36', 1),
(4, 4, 'Student2', 0, '', 'Vellayambalam', 'TVM', NULL, '2045', '19', '101', NULL, '/app/public/business_logo_picture/1559220802_product_36_1_thumb.jpg', '/app/public/shop_profile_picture/1553245132_profile.jpg', '2019-02-08 05:51:18', '2019-09-17 13:41:29', 1),
(232, 244, 'anuska', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 04:05:47', NULL, 1),
(9, 6, 'Merlinss', 0, NULL, 'Address', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-20 14:52:57', '2019-11-12 10:26:14', 1),
(199, 210, 'riya', 0, NULL, 'address, address', NULL, NULL, '26920', NULL, NULL, NULL, NULL, NULL, '2019-11-06 15:09:20', '2019-12-16 11:07:17', 1),
(198, 209, 'leah', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/209/avthar.png', '2019-11-06 06:29:50', '2019-11-06 06:35:32', 1),
(197, 208, 'paru', 0, NULL, 'address', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-06 06:22:19', '2019-11-13 11:04:19', 1),
(196, 207, 'paru', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-06 06:21:12', NULL, 1),
(195, 206, 'gggg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-06 06:19:55', NULL, 1),
(194, 205, 'priya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-06 06:13:41', NULL, 1),
(192, 203, 'fggg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-04 12:40:35', NULL, 1),
(193, 204, 'simi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/204/avthar.png', '2019-11-06 06:10:02', '2019-11-13 05:37:43', 1),
(191, 202, 'ghh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-04 09:23:54', NULL, 1),
(190, 201, 'hhjj', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-04 09:17:31', NULL, 1),
(189, 200, 'hjj', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-04 09:11:01', NULL, 1),
(188, 199, 'child', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-01 05:34:54', NULL, 1),
(187, 198, 'maya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-01 05:31:55', NULL, 1),
(186, 197, 'Priya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-01 05:28:13', NULL, 1),
(185, 196, 'Kahar', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-31 05:42:24', NULL, 1),
(184, 195, 'Coach Ones', 0, NULL, 'Address1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 21:13:45', '2019-10-28 10:39:04', 1),
(183, 194, 'vishnu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 13:26:23', NULL, 1),
(182, 193, 'haha', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 13:07:41', NULL, 1),
(181, 192, 'manikandan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 12:36:22', NULL, 1),
(180, 191, 'studio', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 11:29:37', NULL, 1),
(179, 190, 'man', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 11:20:20', NULL, 1),
(178, 189, 'Ricoh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:28:46', NULL, 1),
(177, 188, 'Sudip', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:28:46', NULL, 1),
(176, 187, 'traffic', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:28:46', NULL, 1),
(175, 186, 'Syndicate', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:28:46', NULL, 1),
(174, 185, 'Developer Estrradoo', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:23:28', NULL, 1),
(173, 184, 'Developer Estrradovyvygy', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:19:52', NULL, 1),
(172, 183, 'Developer Estrrsado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:17:21', NULL, 1),
(171, 182, 'Developer Estrradop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:09:38', NULL, 1),
(170, 181, 'Developer', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 10:09:00', NULL, 1),
(169, 180, 'Developer Estrradoss', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 09:53:42', NULL, 1),
(68, 69, 'arya stark', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-25 09:27:54', NULL, 1),
(231, 243, 'gopi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 10:16:29', NULL, 1),
(70, 71, 'Child B', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-26 11:01:36', NULL, 1),
(168, 179, 'Developer Estrrados', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 09:52:11', NULL, 1),
(167, 178, 'chick', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/178/avthar.png', '2019-10-26 09:25:04', '2019-10-26 11:55:08', 1),
(166, 177, 'do', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 09:25:04', NULL, 1),
(165, 176, 'Estrrado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/176/avthar.png', '2019-10-26 09:23:42', '2019-10-26 11:43:09', 1),
(164, 175, 'san', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 08:53:08', NULL, 1),
(163, 174, 'anusu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/174/avthar.png', '2019-10-26 08:52:31', '2019-12-04 07:20:26', 1),
(162, 173, 'Duttu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 08:50:40', NULL, 1),
(161, 172, 'ghh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-26 05:21:19', NULL, 1),
(160, 171, 'Developer Estrrado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 11:13:02', NULL, 1),
(159, 170, 'Developer rado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-24 11:11:43', NULL, 1),
(158, 169, 'Devper Estrrado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-23 06:22:06', NULL, 1),
(157, 168, 'Monish', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:42:17', NULL, 1),
(156, 167, 'anuz', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:33:57', NULL, 1),
(155, 166, 'Anoop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:32:09', NULL, 1),
(154, 165, 'Dloper Estrrado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:30:00', NULL, 1),
(153, 164, 'Deoper Estrrado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:25:54', NULL, 1),
(152, 163, 'Developer Estado', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:22:31', NULL, 1),
(151, 162, 'Developer Estrradooo', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:21:22', NULL, 1),
(150, 161, 'yghh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 12:05:21', NULL, 1),
(149, 160, 'priya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-22 05:43:22', NULL, 1),
(148, 159, 'ghh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-21 07:00:58', NULL, 1),
(147, 158, 'ghhh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-21 06:04:56', NULL, 1),
(146, 157, 'tedt', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 11:34:36', NULL, 1),
(145, 156, 'simu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 11:33:23', NULL, 1),
(144, 155, 'anupama', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 11:08:00', NULL, 1),
(143, 154, 'robb', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-17 06:06:47', NULL, 1),
(142, 153, 'DeepuS', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/153/avthar.png', '2019-10-16 02:51:02', '2020-10-14 10:42:38', 1),
(141, 152, 'Deepu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-16 02:49:31', NULL, 1),
(140, 151, 'mis', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-11 13:05:01', NULL, 1),
(139, 150, 'sim', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-11 13:05:01', NULL, 1),
(138, 149, 'si', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-11 13:04:03', NULL, 1),
(137, 148, 'joble', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 12:41:01', NULL, 1),
(136, 147, 'childOne', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 11:34:21', NULL, 1),
(135, 146, 'test', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:44:17', NULL, 1),
(134, 145, 'athira', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:41:49', NULL, 1),
(133, 144, 'Priya jacob', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:09:42', NULL, 1),
(132, 143, 'priya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:08:35', NULL, 1),
(131, 142, 'sevin', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:07:48', NULL, 1),
(130, 141, 'arun', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-10-09 06:07:48', NULL, 1),
(218, 229, 'Simi saji', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-15 05:25:09', NULL, 1),
(128, 139, 'simi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/139/avthar.png', '2019-10-09 06:04:36', '2019-11-06 03:23:20', 1),
(200, 211, 'anoop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-07 05:49:18', NULL, 1),
(201, 212, 'rohan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/212/avthar.png', '2019-11-07 09:20:19', '2019-11-07 10:08:48', 1),
(202, 213, 'simi saji', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-08 06:35:36', NULL, 1),
(203, 214, 'anoop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-08 06:37:03', NULL, 1),
(204, 215, 'athira', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-08 06:37:03', NULL, 1),
(205, 216, 'sanu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-11 04:32:05', NULL, 1),
(206, 217, 'audible', 0, NULL, 'hahaah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-11 07:04:10', '2019-11-22 14:58:21', 1),
(207, 218, 'joble', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 04:33:43', NULL, 1),
(208, 219, 'kp', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 05:00:28', NULL, 1),
(209, 220, 'joble', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 11:05:52', '2019-11-13 05:21:41', 1),
(210, 221, 'gayathri', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 05:36:50', NULL, 1),
(211, 222, 'santhi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 05:47:06', NULL, 1),
(212, 223, 'fini', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 10:44:26', NULL, 1),
(213, 224, 'fini', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-09-24 11:27:28', '2019-11-13 12:40:17', 1),
(214, 225, 'haifa', 0, NULL, 'asdadasdas', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-13 18:19:46', '2019-12-05 18:05:00', 1),
(215, 226, 'Anupama', 0, NULL, '1P Vajira Rd Colombo 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-14 10:31:37', '2019-11-23 10:53:10', 1),
(216, 227, 'fghh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-14 08:26:17', NULL, 1),
(217, 228, 'saneesh', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-15 03:54:59', NULL, 1),
(219, 230, 'Sahira', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-18 05:48:39', NULL, 1),
(220, 232, 'midhu', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-18 10:26:21', NULL, 1),
(221, 233, 'Sillu', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-18 10:28:24', NULL, 1),
(222, 234, 'midhu S', 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-18 10:41:27', NULL, 1),
(223, 235, 'Sherin', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-18 10:44:19', NULL, 1),
(224, 236, 'Sherin b n', 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 05:42:25', NULL, 1),
(225, 237, 'diya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 06:32:43', NULL, 1),
(226, 238, 'aqil', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 06:43:39', NULL, 1),
(227, 239, 'devi', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 07:39:18', NULL, 1),
(228, 240, 'gini', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 08:13:28', NULL, 1),
(229, 241, 'feba', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 09:33:57', NULL, 1),
(230, 242, 'Sherin b n', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-19 09:57:35', NULL, 1),
(233, 245, 'anu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 04:07:37', NULL, 1),
(234, 246, 'anoop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 04:07:37', NULL, 1),
(235, 247, 'akash', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 04:07:37', NULL, 1),
(236, 248, 'dude', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 06:26:22', '2019-11-20 06:38:43', 1),
(237, 249, 'jacob', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-20 11:22:23', NULL, 1),
(238, 250, 'sanu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-22 04:35:35', NULL, 1),
(239, 251, 'Lord Baelish', 0, NULL, '9961527023996152702399615270239961527023996152702399615270239961527023996152702399615270239961527023996152702399615270239961527023996152702399615270239961527023996152702399615270239961527023996152702399699615270239961527023', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-22 14:57:14', NULL, 1),
(240, 252, 'Raju', 0, NULL, '1P Vajira Rd Colombo 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-23 10:07:37', '2019-11-23 10:29:06', 1),
(241, 253, 'joble', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-23 05:30:42', NULL, 1),
(242, 254, 'Simi Saji', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-25 04:47:28', NULL, 1),
(243, 255, 'Sherin', 4, NULL, NULL, NULL, NULL, '26923', NULL, NULL, NULL, NULL, NULL, '2019-11-25 05:49:25', '2019-12-12 10:18:58', 1),
(244, 256, 'Simi Saji', 0, NULL, '1P Vajira Rd Colombo 01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-25 11:46:00', NULL, 1),
(245, 257, 'sanuja', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-25 06:36:06', NULL, 1),
(246, 258, 'kp', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-25 06:38:02', NULL, 1),
(247, 259, 'vyka', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/259/avthar.png', '2019-11-25 06:51:51', '2019-12-03 08:21:36', 1),
(248, 260, 'simi saji', 0, NULL, '1P Vajira Rd Colombo 01', NULL, NULL, '48362', NULL, NULL, NULL, NULL, NULL, '2019-11-25 16:04:53', '2019-12-18 13:07:14', 1),
(249, 261, 'anamika', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 04:21:36', NULL, 1),
(250, 262, 'aa', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 04:32:08', NULL, 1),
(251, 263, 'ugauguah', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:31:18', NULL, 1),
(252, 264, 'HcUfUg', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 05:32:20', NULL, 1),
(253, 265, 'm', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 07:55:33', NULL, 1),
(254, 266, 'm', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-11-28 07:56:39', NULL, 1),
(255, 267, 'joble', 1, NULL, NULL, NULL, NULL, '26923', NULL, NULL, NULL, NULL, NULL, '2019-12-02 08:51:50', '2019-12-07 01:10:19', 1),
(256, 268, 'vishnu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-03 09:49:58', NULL, 1),
(257, 269, 'amal', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/269/avthar.png', '2019-12-05 08:45:58', '2019-12-06 09:30:27', 1),
(258, 270, 'chithu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-05 08:48:21', NULL, 1),
(259, 271, 'geethu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/271/avthar.png', '2019-12-05 08:48:21', '2019-12-06 08:50:55', 1),
(260, 272, 'kavita', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-05 11:43:50', NULL, 1),
(261, 273, 'Noel', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '/app/public/users/273/avthar.png', '2019-12-05 11:48:07', '2019-12-05 12:06:46', 1),
(262, 274, 'sheela m a', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-06 05:33:48', NULL, 1),
(263, 275, 'nikku', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-06 05:37:12', NULL, 1),
(264, 276, 'joel m a', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-06 05:37:12', NULL, 1),
(265, 277, 'Vishnu Test Coah', 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-06 11:21:13', NULL, 1),
(266, 278, 'Monish', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-06 11:21:11', NULL, 1),
(270, 282, 'Test Child', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-07 13:14:11', NULL, 1),
(269, 281, 'Test C', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-07 13:13:13', '2019-12-07 13:15:12', 1),
(271, 283, 'ssss', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-07 13:14:31', NULL, 1),
(272, 284, 'Parent Two', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-07 13:22:32', NULL, 1),
(273, 285, 'mohan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:34:45', NULL, 1),
(274, 286, 'manu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:38:40', NULL, 1),
(275, 287, 'sunu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:38:40', NULL, 1),
(276, 288, 'yamini', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:43:31', NULL, 1),
(277, 289, 'ester', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:48:48', NULL, 1),
(278, 290, 'rehan', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:48:48', NULL, 1),
(279, 291, 'tara', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2019-12-09 06:48:48', NULL, 1),
(280, 292, 'varun dhawan', 0, NULL, NULL, NULL, NULL, '48373', NULL, NULL, NULL, NULL, NULL, '2019-12-09 13:35:51', NULL, 1),
(281, 293, 'sachin t', 0, NULL, NULL, NULL, NULL, '48373', NULL, NULL, NULL, NULL, NULL, '2019-12-09 13:37:08', '2020-10-21 11:29:55', 1),
(282, 294, 'Test Deepu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-26 06:14:06', NULL, 1),
(283, 295, 'Test Deepu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-26 06:15:05', NULL, 1),
(284, 296, 'Geethu', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-06-26 06:22:10', NULL, 1),
(285, 297, 'athira', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-09-10 06:29:16', NULL, 1),
(286, 298, 'priya', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-05 07:22:12', NULL, 1),
(287, 299, 'Test Coach', 0, NULL, NULL, NULL, NULL, '26920', NULL, NULL, NULL, NULL, NULL, '2020-10-06 12:49:35', NULL, 1),
(288, 300, 'Deepu', 0, NULL, 'WEST', NULL, NULL, '48370', NULL, NULL, NULL, NULL, NULL, '2020-10-13 10:21:25', NULL, 1),
(289, 301, 'p', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-15 14:15:22', NULL, 1),
(290, 302, 'anuroop', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-20 05:44:41', NULL, 1),
(291, 303, 'Lekshmi', 0, NULL, 'Nest', NULL, NULL, '26920', NULL, NULL, NULL, NULL, NULL, '2020-10-21 14:09:46', '2020-10-21 08:49:18', 1),
(292, 304, 'lekshmi r', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-21 08:51:43', NULL, 1),
(293, 305, 'Athira', 3, NULL, NULL, NULL, NULL, '48366', NULL, NULL, NULL, NULL, NULL, '2020-10-21 09:09:10', NULL, 1),
(294, 306, 'Ram', 0, NULL, NULL, NULL, NULL, '26920', NULL, NULL, NULL, NULL, NULL, '2020-10-21 15:25:31', NULL, 1),
(295, 307, 'dev', 5, NULL, NULL, NULL, NULL, '26920', NULL, NULL, NULL, NULL, NULL, '2020-10-21 10:58:41', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_user_types`
--

CREATE TABLE `sw_user_types` (
  `id` int(11) NOT NULL,
  `type` varchar(55) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_user_types`
--

INSERT INTO `sw_user_types` (`id`, `type`, `status`) VALUES
(1, 'Coach', 1),
(2, 'Student', 1),
(3, 'Parent', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sw_widgets`
--

CREATE TABLE `sw_widgets` (
  `id` int(11) NOT NULL,
  `identifier` varchar(25) NOT NULL,
  `title` varchar(150) NOT NULL,
  `content` longtext NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `sort` int(11) NOT NULL DEFAULT '0',
  `active` tinyint(2) NOT NULL DEFAULT '1',
  `status` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sw_widgets`
--

INSERT INTO `sw_widgets` (`id`, `identifier`, `title`, `content`, `created_on`, `modified_on`, `sort`, `active`, `status`) VALUES
(1, 'join_over', 'Join Over', '<section id=\"booking\" class=\" pt-5 pb-5\">\r\n<div class=\"container\">\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"txtdn col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<h2 class=\"txtred mb-4\">WHAT CAN MAKE YOU FASTER &quest;</h2>\r\n<p>Find the best answer for you by browsing through our thousands of swim-technique videos, learning more about swimming.<br> <br>Take the images and ideas with you to the pool.  </p>\r\n</div>\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12 treat\">\r\n<div class=\"imgbx imgshadow\"><img src=\"http://estrradoweb.com/swimming/public/images/00.jpg\" alt=\"\" width=\"496\" height=\"290\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n</section>\r\n', '2019-02-01 18:17:45', '2020-10-05 06:04:42', 2, 1, 1),
(2, 'book_appointment', 'Book Appointment', '<section id=\"aptbook\" class=\"section graybg pt-5 pb-5 mt-5 mb-5\">\r\n<div class=\"container\">\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<div class=\"imgbx imgshadow\"><img src=\"https://bizzsalon.com/public/images/aptbookbg.jpg\" alt=\"\" width=\"592\" height=\"396\"></div>\r\n</div>\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<h2 class=\"txtred mb-4\">Simple and intuitive appointment book</h2>\r\n<p>Put an end to manual booking errors – it’s time for a hip and modern online calendar! Manage the workload in the salon well and increase productivity. Wherever you are and whatever device you’re using – your appointments can be made in a breeze.</p>\r\n<ul class=\"list\">\r\n<li>Instant scheduling and editing of appointments</li>\r\n<li>Drag and drop rescheduling</li>\r\n<li>Multiple, customisable payment methods</li>\r\n<li>Remote access to the calendar (for employees and managers)</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-01 18:17:45', '2019-11-22 05:34:28', 9, 1, 0),
(5, 'employee_management', 'Employee Management', '<section id=\"management\" class=\"graybg pt-5 pb-5 mt-5 mb-5\">\r\n<div class=\"container\">\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<div class=\"imgbx imgshadow\"><img src=\"http://estrradoweb.com/swimming/public/images/01.jpg\" alt=\"\" width=\"592\" height=\"290\"></div>\r\n</div>\r\n<div class=\"txtdn col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<h2 class=\"txtred mb-4\">LEARN A SKILL WITH ONE OF <br> OUR COURSES </h2>\r\n<p  class=\"wt_clr\">Dig deeper into specific skills, or learning progressions, with any of our hundreds of short courses. <br> <br> You can binge-watch the entire course, or have individual lessons automatically delivered to you each day... the choice is yours.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-01 19:14:45', '2020-10-05 06:05:25', 3, 1, 1),
(6, 'real_time_booking', 'Real Time Booking', '<section id=\"booking\" class=\" pt-5 pb-5 mt-5 mb-5\">\r\n<div class=\"container\">\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"txtdn col-lg-6 col-md-6 col-sm-12 col-12\">\r\n<h2 class=\"txtred mb-4\">KEEP LEARNING DAILY WITH <br>OUR AUTO-DELIVERY FEATURE </h2>\r\n<p>Find the best answer for you by browsing through our thousands of swim-technique videos, learning more about swimming.<br> <br>Take the images and ideas with you to the pool.  </p>\r\n</div>\r\n<div class=\"col-lg-6 col-md-6 col-sm-12 col-12 treat\">\r\n<div class=\"imgbx imgshadow\"><img  src=\"http://estrradoweb.com/swimming/public/images/02.jpg\" alt=\"\" width=\"625\" height=\"290\"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>\r\n', '2019-02-01 19:14:45', '2020-10-05 06:05:45', 4, 1, 1),
(7, 'make_perfection', 'Make Perfection', '<section id=\"management\" class=\"graybg pt-5 pb-5\">\r\n<div class=\"container\">\r\n<div class=\"text mb-5\">\r\n<h2 class=\"mb-2\">Details make perfection</h2>\r\n<p>Looking for more? Good. You will find both simple and most advanced tools in Bizzsalon</p>\r\n</div>\r\n<div class=\"col-12\">\r\n<div class=\"row whitebg\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-user\"></i>\r\n<h5 class=\"mb-3\">Sign Up For Free</h5>\r\n<p>Sign up for a free account today with Bizzsalon. Get started with your telephone number&amp; email, no credit card required.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-plus\"></i>\r\n<h5 class=\"mb-3\">Add Your Account Info</h5>\r\n<p>Add business details, create staff profiles, create Product services and assign them to your staff.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-calendar\"></i>\r\n<h5 class=\"mb-3\">Schedule Appointments</h5>\r\n<p>Click on your calendar to start a booking, then add a staff member, service, and customer.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-check-square-o\"></i>\r\n<h5 class=\"mb-3\">Accept Customer Bookings</h5>\r\n<p>Add a Booking Page to your website and let customers book their next appointment Anywhere.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-facebook-square\"></i>\r\n<h5 class=\"mb-3\">Integrate Social Media</h5>\r\n<p>Promote your services on Facebook and Instagram and link to your Bizzsalon Booking Page.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-calendar-check-o\"></i>\r\n<h5 class=\"mb-3\">Stay on Schedule</h5>\r\n<p>Intuitive and easy to use, you’ll always know when your next appointment is, and you can track client appointment history.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-envelope-o\"></i>\r\n<h5 class=\"mb-3\">Fewer No-Shows</h5>\r\n<p>Enable automatic email and text message reminders for every appointment and prevent no-shows from cutting into your growth.</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-clock-o\"></i>\r\n<h5 class=\"mb-3\">Manage Time Better</h5>\r\n<p>By using bizzsalon, you can spend less time on the phone and more time where it matters most, with your clients!</p>\r\n</div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"textbx\"><i class=\"fa fa-thumbs-o-up\"></i>\r\n<h5 class=\"mb-3\">Get Help 24/7</h5>\r\n<p>We hire real people to support you 24/7. Catch us via chat, email or phone anytime.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-01 19:15:41', '2019-11-18 08:44:11', 10, 1, 0),
(8, 'footer_links', 'Footer Links', '<ul class=\"menufoot\">\r\n<li><a href=\"{{ url(\'/\') }}\">Home</a></li>\r\n<li><a href=\"{{ url(\'/\') }}/support\">Support Center</a></li>\r\n<li><a href=\"#\">Careers</a></li>\r\n<li><a href=\"{{ url(\'/\') }}/contact\">Contact Us</a></li>\r\n</ul>', '2019-02-04 10:54:10', '2019-11-18 08:44:15', 6, 1, 1),
(9, 'copy_rights', 'Copy Rights', '<p class=\"mb-0\">&copy; 2019 Swimming. Privacy, Terms & Merchant Agreement</p>', '2019-02-04 10:54:10', '2019-11-18 09:19:05', 7, 1, 1),
(10, 'social_links', 'Social Links', '<ul class=\"social\">\r\n   <li class=\"fb\"><a href=\"\" ><i class=\"fa fa-facebook\"></i></a> </li> \r\n   <li class=\"twt\"><a href=\"\"><i class=\"fa fa-twitter\"></i></a></li>\r\n  <li class=\"insta\"><a href=\"\"><i class=\"fa fa-instagram\"></i></a></li>\r\n                            </ul>', '2019-02-04 10:54:33', '2019-11-22 09:29:10', 8, 1, 1),
(11, 'appointment_management', 'Appointment Management', '<section id=\"appsec\" class=\"\">\r\n<div class=\"container\">\r\n<div class=\"col-12\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"imgbx\"><img src=\"http://estrradoweb.com/swimming/public/images/mbl.png\" alt=\"\" width=\"260\" height=\"525\"></div>\r\n</div>\r\n<div class=\"col-lg-8 col-md-8 col-sm-12 col-12\">\r\n<div class=\"txt txt-white\">\r\n<h3 class=\"mb-4 lh-42\">App for Swim Workout and Training</h3>\r\n<p>The Coach can shape the technique education to their athletes and seasonal plan. When the coaches shares technique videos with the athletes BEFORE pratice, the coach can spend less time ex-planning a skill, and more time praticing that skill.</p>\r\n<p><a><img src=\"http://estrradoweb.com/swimming/public/images/apple.png\" alt=\"\" width=\"269\" height=\"78\"></a> <a><img src=\"http://estrradoweb.com/swimming/public/images/android.png\" alt=\"\" width=\"269\" height=\"78\"></a></p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-04 10:54:33', '2020-10-05 06:06:56', 5, 1, 1),
(12, 'who_usses', 'Who Usses', '<section id=\"uses\" class=\"pt-5 pb-5 blu\">\r\n<div class=\"container\">\r\n<h3 class=\"text-center mb-4\">Course Locations<strong></h3>\r\n<div class=\"galimg\">\r\n<div class=\"row\">\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal1.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Malaysia</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal2.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Singapore</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal3.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Indonesia</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal4.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">philippines</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal5.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Thailand</span></div>\r\n</div>\r\n<div class=\"col-lg-4 col-md-4 col-sm-12 col-12\">\r\n<div class=\"item\"><img class=\"img-thumbnail\" src=\"http://estrradoweb.com/swimming/public/images/gal6.jpg\" alt=\"\" width=\"269\" height=\"167\"> <span class=\"desc\">Taiwan</span></div>\r\n</div>\r\n<div class=\"btn btn-clr col-lg-2 col-md-2 col-sm-12 col-12\"\r\n<button> view more </button> </div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', '2019-02-04 10:54:33', '2020-10-05 06:07:28', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sw_admins`
--
ALTER TABLE `sw_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_admin_password_resets`
--
ALTER TABLE `sw_admin_password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_admin_role`
--
ALTER TABLE `sw_admin_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_badges`
--
ALTER TABLE `sw_badges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_banner`
--
ALTER TABLE `sw_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_chat`
--
ALTER TABLE `sw_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_chat_members`
--
ALTER TABLE `sw_chat_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_chat_messages`
--
ALTER TABLE `sw_chat_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_cities`
--
ALTER TABLE `sw_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_contacts`
--
ALTER TABLE `sw_contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_contact_reply`
--
ALTER TABLE `sw_contact_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_countries`
--
ALTER TABLE `sw_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_courses`
--
ALTER TABLE `sw_courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_code`);

--
-- Indexes for table `sw_course_acivities`
--
ALTER TABLE `sw_course_acivities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activity_code` (`activity_code`);

--
-- Indexes for table `sw_course_acivity_media`
--
ALTER TABLE `sw_course_acivity_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_course_activity_groups`
--
ALTER TABLE `sw_course_activity_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_course_media`
--
ALTER TABLE `sw_course_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_course_milestones`
--
ALTER TABLE `sw_course_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_email_template`
--
ALTER TABLE `sw_email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_faqs`
--
ALTER TABLE `sw_faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_licences`
--
ALTER TABLE `sw_licences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_location_notify_log`
--
ALTER TABLE `sw_location_notify_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_notifications`
--
ALTER TABLE `sw_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_pages`
--
ALTER TABLE `sw_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_password_resets`
--
ALTER TABLE `sw_password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `sw_registered_courses`
--
ALTER TABLE `sw_registered_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_registered_course_activities`
--
ALTER TABLE `sw_registered_course_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_relationships`
--
ALTER TABLE `sw_relationships`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_request_extra_activity_session`
--
ALTER TABLE `sw_request_extra_activity_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_settings`
--
ALTER TABLE `sw_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_states`
--
ALTER TABLE `sw_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_status_list`
--
ALTER TABLE `sw_status_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_submited_activities`
--
ALTER TABLE `sw_submited_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_submited_activity_media`
--
ALTER TABLE `sw_submited_activity_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_temp_users`
--
ALTER TABLE `sw_temp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_temp_user_details`
--
ALTER TABLE `sw_temp_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_test`
--
ALTER TABLE `sw_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_users`
--
ALTER TABLE `sw_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_user_details`
--
ALTER TABLE `sw_user_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_user_types`
--
ALTER TABLE `sw_user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sw_widgets`
--
ALTER TABLE `sw_widgets`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sw_admins`
--
ALTER TABLE `sw_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sw_admin_password_resets`
--
ALTER TABLE `sw_admin_password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sw_admin_role`
--
ALTER TABLE `sw_admin_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sw_badges`
--
ALTER TABLE `sw_badges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sw_banner`
--
ALTER TABLE `sw_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_chat`
--
ALTER TABLE `sw_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sw_chat_members`
--
ALTER TABLE `sw_chat_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sw_chat_messages`
--
ALTER TABLE `sw_chat_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `sw_cities`
--
ALTER TABLE `sw_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48375;

--
-- AUTO_INCREMENT for table `sw_contacts`
--
ALTER TABLE `sw_contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_contact_reply`
--
ALTER TABLE `sw_contact_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_countries`
--
ALTER TABLE `sw_countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `sw_courses`
--
ALTER TABLE `sw_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `sw_course_acivities`
--
ALTER TABLE `sw_course_acivities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `sw_course_acivity_media`
--
ALTER TABLE `sw_course_acivity_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `sw_course_activity_groups`
--
ALTER TABLE `sw_course_activity_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sw_course_media`
--
ALTER TABLE `sw_course_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `sw_course_milestones`
--
ALTER TABLE `sw_course_milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `sw_email_template`
--
ALTER TABLE `sw_email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sw_faqs`
--
ALTER TABLE `sw_faqs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sw_licences`
--
ALTER TABLE `sw_licences`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sw_location_notify_log`
--
ALTER TABLE `sw_location_notify_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sw_notifications`
--
ALTER TABLE `sw_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `sw_pages`
--
ALTER TABLE `sw_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sw_password_resets`
--
ALTER TABLE `sw_password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sw_registered_courses`
--
ALTER TABLE `sw_registered_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `sw_registered_course_activities`
--
ALTER TABLE `sw_registered_course_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=347;

--
-- AUTO_INCREMENT for table `sw_relationships`
--
ALTER TABLE `sw_relationships`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_request_extra_activity_session`
--
ALTER TABLE `sw_request_extra_activity_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sw_settings`
--
ALTER TABLE `sw_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sw_states`
--
ALTER TABLE `sw_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2325;

--
-- AUTO_INCREMENT for table `sw_submited_activities`
--
ALTER TABLE `sw_submited_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `sw_submited_activity_media`
--
ALTER TABLE `sw_submited_activity_media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=352;

--
-- AUTO_INCREMENT for table `sw_temp_users`
--
ALTER TABLE `sw_temp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `sw_temp_user_details`
--
ALTER TABLE `sw_temp_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `sw_test`
--
ALTER TABLE `sw_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sw_users`
--
ALTER TABLE `sw_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `sw_user_details`
--
ALTER TABLE `sw_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=296;

--
-- AUTO_INCREMENT for table `sw_user_types`
--
ALTER TABLE `sw_user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sw_widgets`
--
ALTER TABLE `sw_widgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
