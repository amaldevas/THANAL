-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2018 at 05:53 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `senile`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `password_reset` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`, `fullname`, `password_reset`) VALUES
(1000, 'amaldevastvm@gmail.com', 'amaldev', 'Amal Dev', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `duty_assigned`
--

CREATE TABLE `duty_assigned` (
  `date` date NOT NULL,
  `assigned` int(11) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `duty_assigned`
--

INSERT INTO `duty_assigned` (`date`, `assigned`, `id`) VALUES
('2018-06-21', 1, 30053),
('2018-06-22', 1, 30054),
('2018-06-23', 1, 30055),
('2018-07-12', 1, 30056);

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `id` int(10) NOT NULL,
  `guardian_name` varchar(200) NOT NULL,
  `inmate_id` int(10) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `password_hash` varchar(200) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `date_of_birth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`id`, `guardian_name`, `inmate_id`, `permanent_address`, `present_address`, `email`, `password_hash`, `mobile`, `gender`, `date_of_birth`) VALUES
(2000, 'Akhil P S', 3000, 'Akhil Villa', 'Akhil', 'akhilps@gmail.com', 'akhil', 9446401131, 'M', '1997-05-21'),
(2001, 'Sreejishnu', 3003, 'Jishnu Villa', 'Jishnu', 'jishnu@gmail.com', 'hai', 9567801196, 'M', '2018-06-22'),
(2002, 'Vishakh', 3002, 'Vish Villa', 'Vish Villa', 'vishakh@gmail.com', 'Vishakh', 8289955366, 'M', '2018-06-06'),
(2003, 'Kavya', 3001, 'Kavya Villa', 'Kavya Villa', 'kavya@gmail.com', 'kavya', 9446401131, 'M', '2018-06-04');

-- --------------------------------------------------------

--
-- Table structure for table `inmate`
--

CREATE TABLE `inmate` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `emergency_contact_person` varchar(200) NOT NULL,
  `emergency_contact_number` bigint(20) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `photo_filename` varchar(200) NOT NULL,
  `payment_per_month` int(10) NOT NULL,
  `staff_notes` text NOT NULL,
  `gender` varchar(500) NOT NULL,
  `date_of_birth` date NOT NULL,
  `date_of_joining` date NOT NULL,
  `password_hash` varchar(500) NOT NULL,
  `password_reset` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inmate`
--

INSERT INTO `inmate` (`id`, `name`, `email`, `mobile`, `emergency_contact_person`, `emergency_contact_number`, `permanent_address`, `present_address`, `photo_filename`, `payment_per_month`, `staff_notes`, `gender`, `date_of_birth`, `date_of_joining`, `password_hash`, `password_reset`) VALUES
(3000, 'Anjay Renjan', 'anjay@gmail.com', 9747801196, 'Sharukh', 7012087236, 'Permanent Address', 'Present Address', '', 7000, '', 'M', '2018-06-16', '2018-06-28', 'anjay', ''),
(3001, 'Vijay', 'vijay@gmail.com', 8089262320, 'Arun', 8089100353, 'Vijay Villa', 'Vijay Villa', '', 8000, '', 'M', '1953-07-02', '2018-06-13', '', ''),
(3002, 'Surya', 'surya@gmail.com', 8289955366, 'Vishnu', 8089100353, 'Surya Villa', 'Surya Villa', '', 7500, '', 'M', '1945-05-23', '2018-06-12', 'surya', ''),
(3003, 'Priyanka', 'priya@gmail.com', 9696969696, 'Anugraha', 9494949494, 'Priya Villa', 'Priya Villa', '', 6900, '', 'F', '1967-06-22', '2018-06-14', 'priya', '');

-- --------------------------------------------------------

--
-- Table structure for table `inmate_medicines`
--

CREATE TABLE `inmate_medicines` (
  `id` int(10) NOT NULL,
  `inmate_id` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inmate_medicines`
--

INSERT INTO `inmate_medicines` (`id`, `inmate_id`, `medicine_id`, `quantity`, `start_date`, `time`) VALUES
(5008, 3000, 8000, 1, '2018-06-19', '09:00:00'),
(5009, 3000, 8005, 1, '2018-06-19', '20:00:00'),
(5010, 3001, 8004, 1, '2018-06-19', '08:00:00'),
(5011, 3001, 8003, 1, '2018-06-19', '21:00:00'),
(5012, 3002, 8002, 1, '2018-06-19', '07:00:00'),
(5013, 3002, 8003, 1, '2018-06-19', '20:00:00'),
(5014, 3003, 8000, 1, '2018-06-19', '12:00:00'),
(5015, 3003, 8000, 1, '2018-06-19', '16:00:00'),
(5017, 3000, 8004, 1, '2018-06-20', '23:30:00'),
(5018, 3000, 8006, 1, '2018-02-10', '12:00:00'),
(5019, 3001, 8005, 2, '2018-06-22', '09:00:00'),
(5020, 3001, 8005, 2, '2018-06-22', '21:00:00'),
(5021, 3002, 8006, 1, '2018-06-22', '09:00:00'),
(5022, 3002, 8006, 1, '2018-06-22', '21:00:00'),
(5023, 3003, 8003, 1, '2018-06-22', '08:00:00'),
(5024, 3003, 8003, 1, '2018-06-22', '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int(10) NOT NULL,
  `medicine_name` varchar(200) NOT NULL,
  `available_medicine_stock_count` int(10) NOT NULL,
  `medical_rep_name` varchar(200) NOT NULL,
  `medical_rep_mobile` int(10) NOT NULL,
  `rep_email` varchar(500) NOT NULL DEFAULT 'amaldevastvm@gmail.com',
  `total_quantity` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `medicine_name`, `available_medicine_stock_count`, `medical_rep_name`, `medical_rep_mobile`, `rep_email`, `total_quantity`) VALUES
(8000, 'Paracetamol', 45, 'Amal', 94949494, 'amaldevastvm@gmail.com', 110),
(8001, 'Coldrun', 28, 'Akash', 9595959, 'amaldevastvm@gmail.com', 100),
(8002, 'Acetaminophen', 25, 'Jithin', 56, 'amaldevastvm@gmail.com', 102),
(8003, 'Azor', 23, 'Jithin', 9595959, 'amaldevastvm@gmail.com', 100),
(8004, 'Aggrenox', 23, 'Jithin', 89898989, 'amaldevastvm@gmail.com', 100),
(8005, ' INDAPAMIDE-ORAL', 35, 'Karun', 9659659, 'amaldevastvm@gmail.com', 100),
(8006, 'Nacfil', 65, 'Abhishek', 2147483647, 'abhisheksr4117@gmail.com', 100);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_schedule_history`
--

CREATE TABLE `medicine_schedule_history` (
  `id` int(10) NOT NULL,
  `inmate_id` int(10) NOT NULL,
  `staff_id` int(10) DEFAULT NULL,
  `medicine_id` int(10) NOT NULL,
  `medicine_date` date NOT NULL,
  `inmate_medicine_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine_schedule_history`
--

INSERT INTO `medicine_schedule_history` (`id`, `inmate_id`, `staff_id`, `medicine_id`, `medicine_date`, `inmate_medicine_id`) VALUES
(50185, 3000, 9007, 8000, '2018-06-21', 5008),
(50186, 3000, 9008, 8005, '2018-06-21', 5009),
(50187, 3001, 9004, 8004, '2018-06-21', 5010),
(50188, 3001, 9005, 8003, '2018-06-21', 5011),
(50189, 3002, 9007, 8002, '2018-06-21', 5012),
(50190, 3002, 9008, 8003, '2018-06-21', 5013),
(50191, 3003, 9004, 8000, '2018-06-21', 5014),
(50192, 3003, 9005, 8000, '2018-06-21', 5015),
(50193, 3000, NULL, 8004, '2018-06-21', 5017),
(50194, 3000, 9007, 8006, '2018-06-21', 5018),
(50195, 3000, 9007, 8000, '2018-06-22', 5008),
(50196, 3000, 9008, 8005, '2018-06-22', 5009),
(50197, 3001, 9004, 8004, '2018-06-22', 5010),
(50198, 3001, 9005, 8003, '2018-06-22', 5011),
(50199, 3002, 9007, 8002, '2018-06-22', 5012),
(50200, 3002, 9008, 8003, '2018-06-22', 5013),
(50201, 3003, 9004, 8000, '2018-06-22', 5014),
(50202, 3003, 9005, 8000, '2018-06-22', 5015),
(50203, 3000, NULL, 8004, '2018-06-22', 5017),
(50204, 3000, 9007, 8006, '2018-06-22', 5018),
(50205, 3001, 9004, 8005, '2018-06-22', 5019),
(50206, 3001, 9008, 8005, '2018-06-22', 5020),
(50207, 3002, 9007, 8006, '2018-06-22', 5021),
(50208, 3002, 9005, 8006, '2018-06-22', 5022),
(50209, 3003, 9004, 8003, '2018-06-22', 5023),
(50210, 3003, 9008, 8003, '2018-06-22', 5024),
(50211, 3000, 9004, 8000, '2018-06-23', 5008),
(50212, 3000, 9005, 8005, '2018-06-23', 5009),
(50213, 3001, 9007, 8004, '2018-06-23', 5010),
(50214, 3001, 9008, 8003, '2018-06-23', 5011),
(50215, 3002, 9004, 8002, '2018-06-23', 5012),
(50216, 3002, 9005, 8003, '2018-06-23', 5013),
(50217, 3003, 9007, 8000, '2018-06-23', 5014),
(50218, 3003, 9008, 8000, '2018-06-23', 5015),
(50219, 3000, NULL, 8004, '2018-06-23', 5017),
(50220, 3000, 9004, 8006, '2018-06-23', 5018),
(50221, 3001, 9007, 8005, '2018-06-23', 5019),
(50222, 3001, 9005, 8005, '2018-06-23', 5020),
(50223, 3002, 9004, 8006, '2018-06-23', 5021),
(50224, 3002, 9008, 8006, '2018-06-23', 5022),
(50225, 3003, 9007, 8003, '2018-06-23', 5023),
(50226, 3003, 9005, 8003, '2018-06-23', 5024),
(50227, 3000, 9006, 8000, '2018-07-12', 5008),
(50228, 3000, 9008, 8005, '2018-07-12', 5009),
(50229, 3001, 9007, 8004, '2018-07-12', 5010),
(50230, 3001, 9005, 8003, '2018-07-12', 5011),
(50231, 3002, 9004, 8002, '2018-07-12', 5012),
(50232, 3002, 9008, 8003, '2018-07-12', 5013),
(50233, 3003, 9006, 8000, '2018-07-12', 5014),
(50234, 3003, 9005, 8000, '2018-07-12', 5015),
(50235, 3000, NULL, 8004, '2018-07-12', 5017),
(50236, 3000, 9007, 8006, '2018-07-12', 5018),
(50237, 3001, 9004, 8005, '2018-07-12', 5019),
(50238, 3001, 9008, 8005, '2018-07-12', 5020),
(50239, 3002, 9006, 8006, '2018-07-12', 5021),
(50240, 3002, 9005, 8006, '2018-07-12', 5022),
(50241, 3003, 9007, 8003, '2018-07-12', 5023),
(50242, 3003, 9008, 8003, '2018-07-12', 5024);

-- --------------------------------------------------------

--
-- Table structure for table `message_table`
--

CREATE TABLE `message_table` (
  `id` int(11) NOT NULL,
  `from_type` varchar(500) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_type` varchar(500) NOT NULL,
  `to_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(500) NOT NULL,
  `date_created` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_table`
--

INSERT INTO `message_table` (`id`, `from_type`, `from_id`, `to_type`, `to_id`, `status`, `subject`, `date_created`, `message`) VALUES
(2, 'admin', 3000, 'inmate', 3000, 1, 'asas', '2018-06-21 09:27:21', 'assa'),
(3, 'admin', 3000, 'inmate', 3000, 1, 'sas', '2018-06-21 09:27:38', 'fgfdgfg'),
(4, 'inmate', 3000, 'inmate', 3000, 1, '222', '2018-06-21 09:29:28', '222'),
(5, 'admin', 1000, 'inmate', 3000, 1, 'Hai', '2018-06-21 12:45:39', 'Hello'),
(6, 'staff', 9005, 'staff', 9004, 1, 'hai', '2018-06-22 15:22:13', 'hai'),
(7, 'staff', 9004, 'staff', 9004, 1, 'hai', '2018-06-22 15:59:27', 'hai'),
(9, 'inmate', 2001, 'staff', 9004, 1, 'Hai', '2018-06-23 01:12:49', 'Hai'),
(10, 'guardian', 2001, 'admin', 1000, 1, 'Hai', '2018-06-23 00:00:00', 'How Are You?'),
(12, 'admin', 1000, 'guardian', 2001, 1, 'hii', '2018-06-23 07:54:08', 'weee'),
(13, 'admin', 1000, 'guardian', 2001, 1, 'Chumma', '2018-07-11 15:47:25', 'sdsdghsdg..'),
(14, 'admin', 1000, 'guardian', 2001, 1, 'Hello', '2018-07-12 07:59:58', 'fgdsfgsdfj');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(10) NOT NULL,
  `inmate_id` int(10) NOT NULL,
  `payment_amount` int(10) NOT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(10) NOT NULL,
  `shift_start_time` time NOT NULL,
  `shift_end_time` time NOT NULL,
  `shift_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `shift_start_time`, `shift_end_time`, `shift_name`) VALUES
(4000, '07:00:00', '15:00:00', 'Day Shift'),
(4001, '15:00:00', '23:00:00', 'Swing Shift'),
(4003, '23:00:00', '07:00:00', 'Night Shift');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `staff_type_id` int(10) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  `permanent_address` text NOT NULL,
  `present_address` text NOT NULL,
  `date_of_joining` date NOT NULL,
  `status_id` tinyint(10) NOT NULL,
  `can_view_inmate_medicine_schedule` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `email`, `mobile`, `gender`, `date_of_birth`, `staff_type_id`, `password_hash`, `permanent_address`, `present_address`, `date_of_joining`, `status_id`, `can_view_inmate_medicine_schedule`) VALUES
(9002, 'Latha', 'latha@gmail.com', 8089100353, 'F', '0000-00-00', 10006, 'latha', 'Latha Villa', 'Latha Villa', '2018-06-20', 0, 1),
(9004, 'Varsha', 'varshaannabraham4@gmail.com', 9447170386, 'F', '1997-07-05', 10000, 'varsha', 'Permanent Address', 'Present Address', '2018-06-20', 0, 1),
(9005, 'Anju', 'anjuss@gmail.com', 8111813556, 'F', '2018-06-30', 10000, 'anju', 'Permanent Address', 'Present Addresshh', '2018-06-21', 0, 0),
(9006, 'Reshma', 'reshma@gmail.com', 9292929292, 'F', '2018-06-05', 10000, 'reshma', 'Permanent Address', 'Present Address', '2018-06-19', 0, 0),
(9007, 'Amith', 'amith@gmail.com', 9446401131, 'M', '2018-06-04', 10000, 'amith', 'Permanent Address', 'Present Address', '2018-06-21', 0, 0),
(9008, 'Vishnu', 'vishnu@gmail.com', 8089100353, 'M', '2018-06-01', 10000, 'vishnu', 'Permanent Address', 'Present Address', '2018-06-21', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staff_type`
--

CREATE TABLE `staff_type` (
  `id` int(10) NOT NULL,
  `staff_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_type`
--

INSERT INTO `staff_type` (`id`, `staff_type`) VALUES
(10000, 'Care Taker'),
(10002, 'Kitchen'),
(10003, 'Security'),
(10004, 'Gardener'),
(10005, 'Driver');

-- --------------------------------------------------------

--
-- Table structure for table `staff_work_shift`
--

CREATE TABLE `staff_work_shift` (
  `id` int(10) NOT NULL,
  `staff_id` int(10) NOT NULL,
  `shift_id` int(10) NOT NULL,
  `date` date NOT NULL,
  `status` int(10) NOT NULL,
  `no_duty` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_work_shift`
--

INSERT INTO `staff_work_shift` (`id`, `staff_id`, `shift_id`, `date`, `status`, `no_duty`) VALUES
(218, 9004, 4000, '2018-06-21', -1, 2),
(219, 9005, 4001, '2018-06-21', -1, 2),
(220, 9006, 4003, '2018-06-21', -1, 0),
(221, 9007, 4000, '2018-06-21', -1, 3),
(222, 9008, 4001, '2018-06-21', -1, 2),
(223, 9003, 4000, '2018-06-21', -1, 0),
(224, 9004, 4000, '2018-06-22', -1, 4),
(225, 9005, 4001, '2018-06-22', -1, 3),
(226, 9006, 4003, '2018-06-22', -1, 0),
(227, 9007, 4000, '2018-06-22', -1, 4),
(228, 9008, 4001, '2018-06-22', -1, 4),
(229, 9003, 4001, '2018-06-22', -1, 0),
(230, 9004, 4000, '2018-06-23', -1, 4),
(231, 9005, 4001, '2018-06-23', -1, 4),
(232, 9006, 4003, '2018-06-23', -1, 0),
(233, 9007, 4000, '2018-06-23', -1, 4),
(234, 9008, 4001, '2018-06-23', -1, 3),
(235, 9003, 4000, '2018-06-23', -1, 0),
(236, 9004, 4000, '2018-07-12', 1, 2),
(237, 9005, 4001, '2018-07-12', 1, 3),
(238, 9006, 4000, '2018-07-12', 1, 3),
(239, 9007, 4000, '2018-07-12', 1, 3),
(240, 9008, 4001, '2018-07-12', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id` int(10) NOT NULL,
  `status` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `id` int(10) NOT NULL,
  `inmate_id` int(10) NOT NULL,
  `result_filename` varchar(200) NOT NULL,
  `result_added_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `duty_assigned`
--
ALTER TABLE `duty_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmate`
--
ALTER TABLE `inmate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inmate_medicines`
--
ALTER TABLE `inmate_medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicine_schedule_history`
--
ALTER TABLE `medicine_schedule_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_table`
--
ALTER TABLE `message_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `staff_type`
--
ALTER TABLE `staff_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_work_shift`
--
ALTER TABLE `staff_work_shift`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `duty_assigned`
--
ALTER TABLE `duty_assigned`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30057;

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;

--
-- AUTO_INCREMENT for table `inmate`
--
ALTER TABLE `inmate`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3004;

--
-- AUTO_INCREMENT for table `inmate_medicines`
--
ALTER TABLE `inmate_medicines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5025;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8007;

--
-- AUTO_INCREMENT for table `medicine_schedule_history`
--
ALTER TABLE `medicine_schedule_history`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50243;

--
-- AUTO_INCREMENT for table `message_table`
--
ALTER TABLE `message_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4004;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9009;

--
-- AUTO_INCREMENT for table `staff_type`
--
ALTER TABLE `staff_type`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10006;

--
-- AUTO_INCREMENT for table `staff_work_shift`
--
ALTER TABLE `staff_work_shift`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
