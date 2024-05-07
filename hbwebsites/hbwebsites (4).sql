-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 11:26 PM
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
-- Database: `hbwebsites`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `password` int(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `phonenum`, `password`, `status`, `removed`) VALUES
(24, 'Billy Garduce', '', '09654864069', 12345, 0, 0),
(25, 'vlad', '', '09654864069', 12345, 1, 0),
(26, 'vladi', '', '0923433424', 0, 1, 0),
(27, 'bry', '', '31434', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_cred`
--

CREATE TABLE `admin_cred` (
  `id` int(11) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_pass` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phonenum` varchar(150) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `removed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_cred`
--

INSERT INTO `admin_cred` (`id`, `admin_name`, `admin_pass`, `email`, `phonenum`, `status`, `removed`) VALUES
(1, 'billy', '12345', '', '0', 1, 0),
(2, 'vladi', '67890', '', '0', 1, 0),
(19, 'Precious Garduce', '11111111', '1111111', '09555766152', 0, 0),
(20, 'Precious Garduce', 'gard', 'manager@com', '09555766152', 1, 0),
(21, 'Precious Garduce', '0', '0', '09555766152', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `booking_details`
--

CREATE TABLE `booking_details` (
  `sr_no` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price` int(150) NOT NULL,
  `total_pay` int(11) NOT NULL,
  `room_no` int(11) DEFAULT NULL,
  `user_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking_order`
--

CREATE TABLE `booking_order` (
  `booking_id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `refund` int(11) DEFAULT NULL,
  `checkin` date NOT NULL,
  `in` time NOT NULL DEFAULT current_timestamp(),
  `checkout` date NOT NULL,
  `out` time NOT NULL DEFAULT current_timestamp(),
  `amount` int(11) NOT NULL,
  `booking_status` varchar(100) NOT NULL DEFAULT 'pending',
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking_order`
--

INSERT INTO `booking_order` (`booking_id`, `name`, `room_name`, `phonenum`, `email`, `address`, `refund`, `checkin`, `in`, `checkout`, `out`, `amount`, `booking_status`, `datentime`) VALUES
(122, 'Precious Garduce', 'Deluxe', '09555766152', 'minejas815@gmail.com', '', 0, '2024-04-30', '09:37:00', '2024-04-30', '21:37:00', 0, 'cancelled', '2024-04-30 09:37:11'),
(123, 'Precious Garduce', 'Deluxe', '09555766152', 'bilmendoza18@gmail.com', '', NULL, '2024-05-01', '03:14:00', '2024-05-01', '15:14:00', 0, 'booking', '2024-05-01 03:14:27'),
(124, 'Precious Garduce', 'Deluxe', '09555766152', 'preciousgarduce28@gmail.com', '', 0, '2024-05-01', '03:23:00', '2024-05-01', '15:23:00', 0, 'cancelled', '2024-05-01 03:23:23');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(18, 'IMG_91620.jpg'),
(28, 'IMG_28947.jpg'),
(29, 'IMG_97735.jpg'),
(32, 'IMG_93048.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(100) NOT NULL,
  `pn1` bigint(20) NOT NULL,
  `pn2` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `insta`, `tw`, `iframe`) VALUES
(1, '4XG7 CC Tagaytay, Cavite', 'https://goo.gl/maps/zSHLbEGvwz8BMqGPA', 9970857762, 9051065499, 'joyleynes@gmail.com', 'https://www.facebook.com/svdfarmtagaytay', 'https://www.instagram.com/explore/locations/101228665291951/svd-laudato-si-farm/', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3869.1708963303795!2d120.9635095!3d14.1260453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33bd7976568b2c11:0xa265752dda78058f!2sSVD Farm!5e0!3m2!1sen!2sph!4v1694049785625!5m2!1sen!2sph');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(10, 'fdffd');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `area` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `adult` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `profile` varchar(150) NOT NULL,
  `description` varchar(350) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `removed` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `area`, `price`, `quantity`, `adult`, `children`, `profile`, `description`, `status`, `removed`) VALUES
(15, 'Deluxe Room', 300, 500, 10, 4, 2, '', '*Being mindful of others his respect indeed. Noise should be kept to its minimum\r\n*Manage your garbage. The Trash bin is there for that reason. \r\n* Please fix your beddings before leaving your room', 1, 0),
(16, 'Luxury Room', 600, 600, 7, 3, 4, '', 'TONIGHT', 1, 0),
(18, 'Simple room', 123, 300, 5, 0, 0, '', 'woderful', 1, 0),
(28, 'Deluxe Room', 300, 500, 10, 0, 0, '', 'dsdsd', 1, 1),
(30, 'Deluxe Room', 300, 500, 10, 0, 0, '', 'ddsd', 1, 1),
(40, 'Deluxe Room', 300, 1, 1, 11, 12, '', 'dsd', 1, 1),
(41, 'Deluxe Room', 300, 1, 1, 11, 12, '', 'sfdfdf', 1, 1),
(42, 'Deluxe Room', 300, 1, 1, 11, 12, '', 'sfsf', 1, 1),
(43, 'Deluxe Room', 300, 1, 1, 11, 12, '', 'scsf', 1, 1),
(59, '1', 300, 12, 11, 0, 0, '', 'dssdsd', 1, 1),
(60, '1', 300, 233, 2323, 0, 0, '', 'sdsdsd', 1, 1),
(61, '1', 300, 1, 1, 0, 0, '', 'ass', 1, 1),
(62, '1', 300, 1, 1, 0, 0, '', 'scscx', 1, 1),
(63, '1', 300, 1, 1, 0, 0, '', '1', 1, 1),
(64, '1', 1, 1, 1, 0, 0, '', 'zxzxzx', 1, 1),
(65, '1', 1, 1, 1, 0, 0, '', 'dsdsd', 1, 1),
(66, 'PRECIOUS MENDOZA GARDUCE', 223, 2, 2, 0, 0, '', 'sdsdsd', 1, 1),
(67, 'ssd', 22, 232, 2332, 0, 0, '', 'dsddsds', 1, 1),
(68, 'ssd', 22, 1, 1, 0, 0, '', 'ssdsd', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_facilities`
--

CREATE TABLE `room_facilities` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `facilities_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_facilities`
--

INSERT INTO `room_facilities` (`sr_no`, `room_id`, `facilities_id`) VALUES
(1, 28, 10),
(16, 18, 0),
(17, 18, 0),
(18, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_features`
--

CREATE TABLE `room_features` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `features_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_features`
--

INSERT INTO `room_features` (`sr_no`, `room_id`, `features_id`) VALUES
(1, 30, 8),
(8, 18, 0),
(9, 18, 0),
(10, 18, 0);

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room_images`
--

INSERT INTO `room_images` (`sr_no`, `room_id`, `image`, `thumb`) VALUES
(15, 15, 'IMG_30132.jpg', 1),
(16, 16, 'IMG_33511.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` varchar(250) NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'Eco Spirituality Center', 'The SVD Laudato Si’ Farm, now known better as SVD FARM for short, is a six-hectare eco-agricultural farm begun by SVD Tagaytay Community at the outbreak and in response to the global COVID-19 pandemic.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `system_cred`
--

CREATE TABLE `system_cred` (
  `id` int(11) NOT NULL,
  `system_name` varchar(150) NOT NULL,
  `user` varchar(100) NOT NULL,
  `system_pass` varchar(150) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `removed` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_cred`
--

INSERT INTO `system_cred` (`id`, `system_name`, `user`, `system_pass`, `phonenum`, `removed`, `status`) VALUES
(4, 'bill', '', '123', '12345', 0, 0),
(14, 'Macky', '', '123', '3434434', 0, 0),
(15, 'bill', '', '11111', '93565323332', 0, 0),
(16, 'garducebilly18@gmail.com', '', 'garduce18', '9654864069', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `team_details`
--

CREATE TABLE `team_details` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `picture` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_details`
--

INSERT INTO `team_details` (`sr_no`, `name`, `picture`) VALUES
(50, 'billy', 'IMG_30838.jpg'),
(55, 'Vladimir', 'IMG_84082.jpg'),
(58, 'Bryan', 'IMG_94141.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `role` enum('system admin','manager admin') NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `role`, `username`, `password`, `name`) VALUES
(1, 'system admin', 'billy', '81dc9bdb52d04dc20036dbd8313ed055', 'billy garduce'),
(2, 'manager admin', 'vlad', 'e2fc714c4727ee9395f324cd2e7f331f', 'vladimir padilla');

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `address` varchar(120) NOT NULL,
  `phonenum` varchar(100) NOT NULL,
  `pincode` int(11) NOT NULL,
  `dob` date NOT NULL,
  `profile` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `is_verified` int(11) NOT NULL DEFAULT 0,
  `token` varchar(200) DEFAULT NULL,
  `t_expire` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `address`, `phonenum`, `pincode`, `dob`, `profile`, `password`, `is_verified`, `token`, `t_expire`, `status`, `datentime`) VALUES
(25, 'Precious Garduce', 'garducebilly18@gmail.com', 'PUROK 31 BARANGAY FRANCISCO TAGAYTAY CITY', '09555761111', 4120, '2024-04-30', 'IMG_85533.jpeg', '$2y$10$bJpeLD54yFcBez59nP4CSeGKi2EJDxYnkCk660R/BgtCohtigTVdG', 0, NULL, NULL, 1, '2024-04-30 03:35:57'),
(29, 'Precious Garduce', 'minejas815@gmail.com', 'PUROK 31 BARANGAY FRANCISCO TAGAYTAY CITY', '09555766152', 4120, '2024-05-05', 'IMG_43040.jpeg', '$2y$10$YbJBNW51YwGNl1/H3cZVw.H0NHb0yIc77dhCaaa4XYlh1MFwvJcMq', 1, 'c9161ca0550316befa4cccac25483ef7', NULL, 1, '2024-05-05 02:54:56'),
(30, 'Bill', 'bilmendoza18@gmail.com', 'PUROK 31 BARANGAY FRANCISCO TAGAYTAY CITY', '09555766111', 4120, '2024-05-06', 'IMG_91404.jpeg', '$2y$10$n9CXtYOX8GcNGmg5qtC3zeFx5r0FnXKwfcBsf1EuTxDpdu3V2K6t2', 1, 'fcc509249cf580cf1ca1e3812a1149fb', NULL, 1, '2024-05-06 03:10:59');

-- --------------------------------------------------------

--
-- Table structure for table `user_queries`
--

CREATE TABLE `user_queries` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` varchar(500) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_cred`
--
ALTER TABLE `admin_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_details`
--
ALTER TABLE `booking_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `booking_order`
--
ALTER TABLE `booking_order`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `carousel`
--
ALTER TABLE `carousel`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room id` (`room_id`);

--
-- Indexes for table `room_features`
--
ALTER TABLE `room_features`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `rm id` (`room_id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `system_cred`
--
ALTER TABLE `system_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_details`
--
ALTER TABLE `team_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_queries`
--
ALTER TABLE `user_queries`
  ADD PRIMARY KEY (`sr_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `admin_cred`
--
ALTER TABLE `admin_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `booking_details`
--
ALTER TABLE `booking_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `booking_order`
--
ALTER TABLE `booking_order`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- AUTO_INCREMENT for table `carousel`
--
ALTER TABLE `carousel`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `room_facilities`
--
ALTER TABLE `room_facilities`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `room_features`
--
ALTER TABLE `room_features`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_cred`
--
ALTER TABLE `system_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `team_details`
--
ALTER TABLE `team_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_queries`
--
ALTER TABLE `user_queries`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_facilities`
--
ALTER TABLE `room_facilities`
  ADD CONSTRAINT `room id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);

--
-- Constraints for table `room_features`
--
ALTER TABLE `room_features`
  ADD CONSTRAINT `rm id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON UPDATE NO ACTION;

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
