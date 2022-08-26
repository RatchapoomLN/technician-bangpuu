-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 03:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bangpu`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `work` text COLLATE utf8_unicode_ci NOT NULL,
  `profile` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `pre`, `fullname`, `work`, `profile`, `username`, `password`, `role`) VALUES
(42, 'นาย', 'AdminMain', 'Accounting', 'none.png', '1234', '1234', 'admin'),
(69, 'นาย', 'นาย รัชภูมิ แซ่ลี้', 'โปรแกรมเมอร์', 'ratchapoom.jpg', 'ratchapoom', '123456', 'admin'),
(70, 'นาย', 'อนันพร สมบูรณ์ทรัพย์', 'โปรแกรมเมอร์', 'annporn.jpg', 'annporn', '123456', 'admin'),
(71, 'นาย', 'Employee', 'พนักงานทั่วไป', '', 'emp', '123456', 'employee'),
(72, 'นาย', 'Employee', 'พนักงานธุรการ', '', 'emp-acc', '123456', 'employee');

-- --------------------------------------------------------

--
-- Table structure for table `bangpuu`
--

CREATE TABLE `bangpuu` (
  `pro_id` int(100) UNSIGNED NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bangpuu`
--

INSERT INTO `bangpuu` (`pro_id`, `pre`, `fullname`, `role`, `moo`, `district`, `detail`, `picture`) VALUES
(1, 'นาย', 'อุดมสุขสำราญ', 'ช่างโยธา', '1', 'บางปู', 'ซอยเทศบาลบางปู119', ''),
(2, 'นาย', 'สมพงษ์คงศาล', 'นายช่างโยธา', '10', 'บางปู', 'ซอยเทศบาลบางปู108', '');

-- --------------------------------------------------------

--
-- Table structure for table `bangpuumai`
--

CREATE TABLE `bangpuumai` (
  `pro_id` int(100) UNSIGNED NOT NULL,
  `pre` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bangpuumai`
--

INSERT INTO `bangpuumai` (`pro_id`, `pre`, `fullname`, `role`, `moo`, `district`, `detail`, `picture`) VALUES
(1, 'นางสาว', 'ขวัญไกลเกล้า', 'ช่างโยธา', '4', 'บางปูใหม่', 'ซอยเทศบาลบางปู79', ''),
(2, 'นาย', 'บุญใจสมเกียรติ', 'วิศวกรโยธา', '5', 'บางปูใหม่', 'ซอยเทศบาลบางปู77', '');

-- --------------------------------------------------------

--
-- Table structure for table `construct`
--

CREATE TABLE `construct` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `inform` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture1` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `picture2` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `head` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `construct`
--

INSERT INTO `construct` (`user_id`, `inform`, `pre`, `fullname`, `address`, `details`, `phone`, `email`, `picture1`, `picture2`, `video`, `time`, `status`, `head`) VALUES
(1, 'ก่อสร้างอาคาร', 'นาย', 'สุวิชัย สิทธิ์ประเสริฐ', '154/2 หมู่ 6 ตำบลบางปู อำเภอ ท้ายบ้าน', 'ได้ทำการเดินเรื่องเอกสารไปแล้วแต่ยังไม่ได้รับการตอบกลับ เป็นเวลา 4-5 วันแล้ว อยากทราบว่าถึงไหนแล้วครับ', '0892157461', 'longnight2543@gmail.com', '59665642_333068454063297_3683941823719407616_n.jpg', '', '', '2022-08-01', 0, 'ขออนุญาตก่อนสร้างอาคารพาณิชย์ KC-4'),
(2, 'รื้ถอนอาคาร', 'นาย', 'เสริมพร สมบูรณ์', 'ซอยเทศบาลบางปู 119 บริเวณกลางซอย', 'ยื่นเอกสารนานแล้วยังไม่ได้เอกสารรับรอง ตอนนี้ รื้อไปก่อนแล้วอยากทราบว่า เอกสารจะได้รับวันไหน และ สามารถรื้อต่อ', '0803447154', 'godliony@gmail.com', '01_resize26.jpg', '', '', '2022-08-01', 0, 'สอบถามรื้อถอน ');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`user_id`, `pre`, `fullname`, `code`, `detail`, `address`, `phone`, `email`, `time`, `status`) VALUES
(1, 'นาย', 'ภูลือ เรือนทอง', '420591', 'สอบถามกำหนดรับแบบเอกสาร', '517 หมู่ 10 ต.บางปู', '0812001472', 'qmall2565@gmail.com', '2022-08-01', 0),
(2, 'นาย', 'เหล่าซื่อ แซ่โค้ง', '397538', 'สอบถามแบบเอกสารที่จะได้รับ', '214 หมู่10 ตำบลบางปู เมืองสมุทรปราการ', '09021158387', 'fukklongtom2546@gmail.com', '2022-08-01', 0);

-- --------------------------------------------------------

--
-- Table structure for table `problem`
--

CREATE TABLE `problem` (
  `user_id` int(100) UNSIGNED NOT NULL,
  `inform` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `picture1` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `picture2` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL,
  `head` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `problem`
--

INSERT INTO `problem` (`user_id`, `inform`, `pre`, `fullname`, `address`, `details`, `phone`, `email`, `picture1`, `picture2`, `video`, `time`, `status`, `head`) VALUES
(1, 'แจ้งปัญหาทั่วไป', 'นาย', 'เกษมชัย ทรัชไท', 'บริเวณใกล้กับซอยเทศบาลบางปู19', 'สันจรไปมายากลำบากอยากให้แก้เร็วๆและแก้ให้ดีกว่านี้', '0815142284', 'rockthedoor2561@gmail.com', 'ถนนทรุด.jpg', '', '', '2022-07-27', 0, 'ถนนทรุด'),
(2, 'แจ้งปัญหาทั่วไป', 'นางสาว', 'สมฤดี พรบุญ', 'บ้านไทรงามซอย1', 'ฟุตบาทยกระดับเวลาฝนตกทำให้น้ำเข้าบ้าน ข้าวของเสียหาย รบกวนแก้หรือยื่นเสนอหาแนวทางด่วน!', '0873256412', 'ratchapoom10022@gmail.com', '110921.jpg', '', '72f8cc45-e62b-45d6-b0df-bcdf8ab4012c.mp4', '2022-08-01', 0, 'น้ำฝนจากฟุตบาทไหลเข้าบ้าน'),
(3, 'แจ้งปัญหาไฟฟ้า', 'นาย', 'ทรีมจักร พันฤดู', 'ริมถนน ใกล้กับซอยเทศบาลบางปู 19', 'อยากให้ปรับปรุงแก้ไข อาจจะทำให้เกิดอุบัติเหตุได้', '0924480850', 'ratchapoom10022@gmail.com', 'DSC00014.jpg', '', '', '2022-07-31', 0, 'สายไฟห้อยลงบนทางเท้า'),
(4, 'แจ้งปัญหาประปา', 'นาย', 'สั่งสม ก่อกำเนิด', 'ริมถนน ซอยเทศบาลบางปู 120', 'ไม่มีการจัดการให้เรียบร้อย อาจจะทำให้เกิดอุบัติเหตุได้', '0872413624', 'rockthedoor2561@gmail.com', '562000004687601.jpg', '', '', '2022-08-01', 0, 'ท่อประปาโผล่ทางเท้า'),
(5, 'แจ้งปัญหาประปา', 'นาย', 'ทักษิต ฆาราช', 'ซอยเทศบาลบางปู 126/1', 'เนื่องจากฝนตกหลายวัน น้ำเอ่อล้น ระบายออกไม่ทัน และน่าจะมีอะไรอุดตันที่ท่อ', '0827432240', 'rockthedoor2561@gmail.com', 'images107211.jpg', '', '', '2022-08-01', 0, 'น้ำท่วมขัง ระบายไม่ได้'),
(6, 'แจ้งปัญหาทั่วไป', 'นาย', 'ทรัพย์ลาย ทรายทอง', 'ซอยเทศบาลบางปู 124', 'เป็นหลุมและมีน้ำขัง อาจจะเกิดอันตรายกับมอเตอไซค์ได้ และ รถยนต์', '0832411104', 'qmall2565@gmail.com', 'Danger-road-05.jpg', '', '', '2022-08-01', 0, 'ถนนเป็นหลุมเป็นบ่อ');

-- --------------------------------------------------------

--
-- Table structure for table `taiban`
--

CREATE TABLE `taiban` (
  `pro_id` int(100) NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taiban`
--

INSERT INTO `taiban` (`pro_id`, `pre`, `fullname`, `role`, `moo`, `district`, `detail`, `picture`) VALUES
(1, 'นาย', 'ศักดิ์สมเลิศ', 'ช่างโยธา', '1', 'ท้ายบ้าน', 'ซอยเทศบาลบางปู1-8 ซอยเทศบาลบางปู13-14', ''),
(2, 'นาง', 'รัตนาเกล้าแก้ว', 'ช่างโยธา', '2', 'ท้ายบ้าน', 'ซอยเทศบาลบางปู9-12', ''),
(3, 'นาย', 'บุญสมสัตย์', 'วิศวกร', '1', 'ท้ายบ้าน', 'เทศบาลบางปูซอย39', '');

-- --------------------------------------------------------

--
-- Table structure for table `taibanmai`
--

CREATE TABLE `taibanmai` (
  `pro_id` int(100) UNSIGNED NOT NULL,
  `pre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `district` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(1000) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `taibanmai`
--

INSERT INTO `taibanmai` (`pro_id`, `pre`, `fullname`, `role`, `moo`, `district`, `detail`, `picture`) VALUES
(1, 'นาย', 'นายบุญสมสัตย์', 'ช่างโยธา', '8', 'ท้ายบ้านใหม่', 'ซอยเทศบาลบางปู39', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `bangpuu`
--
ALTER TABLE `bangpuu`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `bangpuumai`
--
ALTER TABLE `bangpuumai`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `construct`
--
ALTER TABLE `construct`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `problem`
--
ALTER TABLE `problem`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `taiban`
--
ALTER TABLE `taiban`
  ADD PRIMARY KEY (`pro_id`);

--
-- Indexes for table `taibanmai`
--
ALTER TABLE `taibanmai`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `bangpuu`
--
ALTER TABLE `bangpuu`
  MODIFY `pro_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bangpuumai`
--
ALTER TABLE `bangpuumai`
  MODIFY `pro_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `construct`
--
ALTER TABLE `construct`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `problem`
--
ALTER TABLE `problem`
  MODIFY `user_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `taiban`
--
ALTER TABLE `taiban`
  MODIFY `pro_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taibanmai`
--
ALTER TABLE `taibanmai`
  MODIFY `pro_id` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
