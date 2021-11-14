-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 10, 2019 at 09:05 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prescription_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `M_id` int(10) NOT NULL,
  `M_name` varchar(50) NOT NULL,
  `T_time` varchar(50) NOT NULL,
  `Days` int(3) NOT NULL,
  `id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`M_id`, `M_name`, `T_time`, `Days`, `id`) VALUES
(1, 'Newtek', 'morning,Night,Before eating', 7, 13),
(2, 'napa', 'morning,Noon,Night,After eating', 3, 13),
(3, 'gfg', 'morning,Noon,Night,After eating', 9, 0),
(9, 'Seclo ', 'morning,Noon,Night,Before eating', 8, 14),
(11, 'Seclo', 'morning,Noon,Night,Before eating', 16, 14),
(12, 'napa', 'morning,Noon,Night,After eating', 7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `Id` int(10) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Phone` varchar(13) NOT NULL,
  `Age` varchar(3) NOT NULL,
  `Gender` varchar(15) NOT NULL,
  `Problem` varchar(150) NOT NULL,
  `Tests` varchar(500) DEFAULT NULL,
  `Next_Visit_Date` date NOT NULL,
  `Suggestions` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`Id`, `Name`, `Phone`, `Age`, `Gender`, `Problem`, `Tests`, `Next_Visit_Date`, `Suggestions`) VALUES
(13, 'Rashed Karim', '01711605286', '50', 'Male', 'mentally stressed', 'Blood test', '2019-04-08', 'avoid eating cold water'),
(14, 'Maksud', '01621195705', '23', 'Male', 'mentally stressed', 'Blood test', '2019-12-24', 'no suggestion'),
(15, 'Piash', '01681388892', '22', 'Male', 'Urine problem', NULL, '0000-00-00', NULL),
(16, 'samiul', '01734567338', '23', 'Male', 'dengu', NULL, '0000-00-00', NULL),
(17, 'samiul', '01734567338', '23', 'Male', 'dengu', NULL, '0000-00-00', NULL),
(18, 'test', '01928732665', '23', 'Male', 'dengu', NULL, '0000-00-00', NULL),
(19, 'test2', '01928732665', '50', 'Male', 'd', NULL, '0000-00-00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `R_id` int(11) NOT NULL,
  `U_date` varchar(50) NOT NULL,
  `Path` varchar(400) NOT NULL,
  `id` int(11) NOT NULL,
  `Test_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`R_id`, `U_date`, `Path`, `id`, `Test_name`) VALUES
(1, '0001-01-11', 'document/Traffic_Light.c', 13, 'Blood Test'),
(2, '0001-11-11', 'document/Three tiles.c', 14, 'Urine Test'),
(3, '0001-11-11', 'document/Three tiles.c', 14, 'Blood Test'),
(4, 'blood test', '2019-09-03', 0, '13'),
(5, '2019-08-28', 'document/163-35-1778(AI).pdf', 13, 'blood test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Name` varchar(30) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Phone` varchar(12) NOT NULL,
  `Status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Name`, `Username`, `Password`, `Phone`, `Status`) VALUES
('Al-amin', 'alamin01', 'alamin', '01935217478', 'Lab_Stuff'),
('Karim', 'karim01', 'karim', '01724582097', 'Counter_Stuff'),
('Khalid', 'khalid01', 'khalid', '01775452138', 'Counter_Stuff'),
('Md. Maksudur Rahman', 'maksud01', 'maksud', '01521320857', 'Doctor'),
('Mubashir Reza Komol', 'mubashir01', 'mubashir', '01625451971', 'Doctor'),
('Shakhawat Hossain Piash', 'Piash01', 'piash', '01681388892', 'Doctor'),
('Rahim', 'rahim01', 'rahim', '01934562138', 'Counter_Stuff'),
('Selim Ahmed', 'selim01', 'selim', '01922981732', 'Lab_Stuff');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`M_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`R_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `M_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `R_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
