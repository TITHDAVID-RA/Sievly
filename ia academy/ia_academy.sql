-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2026 at 09:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ia_academy`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `status` enum('Present','Absent') NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `status`, `date`) VALUES
(1, 2, 'Present', '2026-02-03'),
(3, 1, 'Present', '2026-02-03');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `nation` varchar(50) DEFAULT NULL,
  `studentPhone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `parentName` varchar(100) DEFAULT NULL,
  `relationship` varchar(50) DEFAULT NULL,
  `parentContact` varchar(20) DEFAULT NULL,
  `parentEmail` varchar(100) DEFAULT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `prevSchool` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `firstName`, `lastName`, `nation`, `studentPhone`, `address`, `parentName`, `relationship`, `parentContact`, `parentEmail`, `grade`, `prevSchool`, `created_at`) VALUES
(1, 'Sovansatya', 'Ra', NULL, '123456789', NULL, NULL, NULL, NULL, NULL, '02', NULL, '2026-02-02 09:50:36'),
(2, 'Tithdewid', 'Ra', 'Cambodian', '089912457', '187', 'john', 'Mather', '121345678', 'rtithdavid@gmail.com', '10', '', '2026-02-03 07:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationalId` varchar(50) DEFAULT NULL,
  `subject` varchar(50) DEFAULT NULL,
  `class` varchar(10) DEFAULT NULL,
  `joiningDate` date DEFAULT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `assigned_class` varchar(10) DEFAULT NULL,
  `status` enum('Pending','Approved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `fullName`, `email`, `phone`, `nationalId`, `subject`, `class`, `joiningDate`, `qualification`, `assigned_class`, `status`) VALUES
(1, 'john2', NULL, '', NULL, 'Science', '02', NULL, NULL, NULL, 'Pending'),
(2, 'john', NULL, '', NULL, 'Math', '02', NULL, NULL, NULL, 'Pending'),
(3, 'Tithdewid Ra', 'rtithdavid@gmail.com', '1234567', '12223344', 'English', '10', '2026-02-26', '', NULL, 'Pending'),
(4, 'Sovansatya Ra', 'test@gmail.com', '1234567', '12223344', 'Computer Science', '07', '2026-03-14', '', NULL, 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher','admin') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(1, 'Ra Tithdavid', 'rtithdavid@gmail.com', '$2y$10$.ZJ5qTo1YWhG7QR3./ncOO5a1NSkAtrin2uRsS08JYR6l2m3/rSAK', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`date`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
