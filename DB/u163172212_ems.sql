-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2022 at 09:48 AM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u163172212_ems`
--

-- --------------------------------------------------------

--
-- Table structure for table `ems_attendance`
--

CREATE TABLE `ems_attendance` (
  `id` int(11) NOT NULL,
  `attendance_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `late_hours` float NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_attendance`
--

INSERT INTO `ems_attendance` (`id`, `attendance_id`, `employee_id`, `status`, `late_hours`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1, 6, 1, 0, '', '2022-07-13 07:08:04', '2022-07-13 07:08:04'),
(2, 1, 7, 1, 0, '', '2022-07-13 07:08:04', '2022-07-13 07:08:04'),
(3, 1, 8, 1, 0, '', '2022-07-13 07:08:04', '2022-07-13 09:57:25'),
(4, 1, 9, 1, 0, '', '2022-07-13 07:08:04', '2022-07-13 07:08:04'),
(5, 1, 10, 0, 0, 'Got sick during lecture.', '2022-07-13 07:08:04', '2022-07-13 07:08:04'),
(6, 2, 2, 1, 0, '', '2022-07-13 17:16:48', '2022-07-13 17:21:54'),
(7, 2, 3, 1, 0, '', '2022-07-13 17:16:48', '2022-07-13 18:11:38'),
(8, 2, 5, 1, 0, 'Sick leave', '2022-07-13 17:16:48', '2022-07-13 18:11:38'),
(9, 3, 6, 1, 0, '', '2022-07-14 07:10:17', '2022-07-14 07:10:17'),
(10, 3, 7, 2, 0, 'sick', '2022-07-14 07:10:17', '2022-07-14 07:10:17'),
(11, 3, 8, 3, 2, '', '2022-07-14 07:10:17', '2022-07-14 08:34:40'),
(12, 3, 9, 1, 0, '', '2022-07-14 07:10:17', '2022-07-14 07:10:17'),
(13, 3, 10, 1, 0, '', '2022-07-14 07:10:17', '2022-07-14 07:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `ems_attendances`
--

CREATE TABLE `ems_attendances` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `attendance_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_attendances`
--

INSERT INTO `ems_attendances` (`id`, `user_id`, `company_id`, `shift_id`, `attendance_date`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2022-07-13 07:08:04', '2022-07-13 07:08:04', '2022-07-13 07:08:04'),
(2, 1, 2, 3, '2022-07-13 17:16:48', '2022-07-13 17:16:48', '2022-07-13 17:16:48'),
(3, 1, 3, 1, '2022-07-14 12:10:17', '2022-07-14 07:10:17', '2022-07-14 07:10:17');

-- --------------------------------------------------------

--
-- Table structure for table `ems_companies`
--

CREATE TABLE `ems_companies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_companies`
--

INSERT INTO `ems_companies` (`id`, `user_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 0, 'AAA Associates', '2022-07-12 07:12:03', '2022-07-12 10:50:43'),
(2, 1, 'Microsoft', '2022-07-12 07:12:35', '2022-07-12 07:12:35'),
(3, 1, 'World Education System &#40;WES&#41;', '2022-07-12 07:12:49', '2022-07-13 08:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `ems_company_shifts`
--

CREATE TABLE `ems_company_shifts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_company_shifts`
--

INSERT INTO `ems_company_shifts` (`id`, `user_id`, `company_id`, `shift_id`, `created_at`) VALUES
(3, 1, 2, 1, '2022-07-12 07:12:35'),
(4, 1, 2, 3, '2022-07-12 07:12:35'),
(7, 0, 1, 1, '2022-07-12 10:50:43'),
(8, 0, 1, 2, '2022-07-12 10:50:43'),
(9, 0, 1, 3, '2022-07-12 10:50:43'),
(10, 1, 3, 1, '2022-07-13 08:36:36'),
(11, 1, 3, 2, '2022-07-13 08:36:36');

-- --------------------------------------------------------

--
-- Table structure for table `ems_employees`
--

CREATE TABLE `ems_employees` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_employees`
--

INSERT INTO `ems_employees` (`id`, `user_id`, `first_name`, `last_name`, `email`, `contact_no`, `address`, `created_at`, `updated_at`) VALUES
(1, 1, 'John C', 'Kroger', 'james@mail.com', '0300-1234567', '', '2022-07-12 13:32:25', '2022-07-12 14:00:20'),
(2, 0, 'John C', 'Kroger', '', '', '', '2022-07-12 13:33:32', '2022-07-12 13:33:32'),
(3, 0, 'Lola J', 'Scott', 'chadd2012@hotmail.com', '252-327-3854', '', '2022-07-12 13:35:23', '2022-07-12 13:35:23'),
(5, 1, 'Felicia E', 'Lee', '', '', '', '2022-07-13 06:41:37', '2022-07-13 06:41:37'),
(6, 1, 'Ralph R', 'Harris', '', '', '', '2022-07-13 06:41:53', '2022-07-13 06:41:53'),
(7, 1, 'Andrea P', 'Swenson', '', '', '', '2022-07-13 06:42:12', '2022-07-13 06:42:12'),
(8, 1, 'Alfonso F', 'Dixon', '', '', '', '2022-07-13 06:42:30', '2022-07-13 06:42:30'),
(9, 1, 'Fredrick D', 'Fiorini', '', '', '', '2022-07-13 06:43:21', '2022-07-13 06:43:21'),
(10, 1, 'Lynn G', 'Ford', '', '', '', '2022-07-13 06:43:37', '2022-07-13 06:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `ems_employee_companies`
--

CREATE TABLE `ems_employee_companies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `salary` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_employee_companies`
--

INSERT INTO `ems_employee_companies` (`id`, `user_id`, `employee_id`, `company_id`, `shift_id`, `salary`, `created_at`) VALUES
(1, 0, 2, 1, 1, 50000, '2022-07-12 13:33:32'),
(2, 0, 2, 2, 3, 80000, '2022-07-12 13:33:32'),
(3, 0, 3, 2, 3, 150000, '2022-07-12 13:35:23'),
(4, 1, 4, 3, 1, 15000, '2022-07-12 13:46:33'),
(6, 1, 1, 1, 2, 10000, '2022-07-12 14:00:20'),
(7, 1, 5, 1, 1, 10000, '2022-07-13 06:41:37'),
(8, 1, 5, 2, 3, 25000, '2022-07-13 06:41:37'),
(9, 1, 6, 3, 1, 25000, '2022-07-13 06:41:53'),
(10, 1, 7, 3, 1, 15000, '2022-07-13 06:42:12'),
(11, 1, 8, 3, 1, 50000, '2022-07-13 06:42:30'),
(12, 1, 9, 3, 1, 50000, '2022-07-13 06:43:21'),
(13, 1, 10, 3, 1, 150000, '2022-07-13 06:43:37');

-- --------------------------------------------------------

--
-- Table structure for table `ems_employee_leaves`
--

CREATE TABLE `ems_employee_leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text DEFAULT NULL,
  `approved` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_employee_leaves`
--

INSERT INTO `ems_employee_leaves` (`id`, `user_id`, `employee_id`, `company_id`, `shift_id`, `start_date`, `end_date`, `description`, `approved`, `created_at`, `updated_at`) VALUES
(2, 1, 7, 3, 1, '2022-07-14', '2022-07-15', 'sick', 1, '2022-07-13 19:41:13', '2022-07-14 07:07:48');

-- --------------------------------------------------------

--
-- Table structure for table `ems_leaves`
--

CREATE TABLE `ems_leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_leaves`
--

INSERT INTO `ems_leaves` (`id`, `user_id`, `title`, `created_at`, `updated_at`) VALUES
(1, 0, 'Sick Leave', '2022-07-12 10:34:25', '2022-07-12 10:34:25'),
(2, 0, 'Emergency Leave', '2022-07-12 10:34:35', '2022-07-12 10:34:35'),
(4, 0, 'Holiday Leaves', '2022-07-12 10:34:45', '2022-07-12 10:34:45'),
(5, 0, 'Official Leaves', '2022-07-12 10:34:50', '2022-07-12 10:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `ems_salaries`
--

CREATE TABLE `ems_salaries` (
  `id` int(11) NOT NULL,
  `salary_sheet_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `net_salary` float NOT NULL,
  `total_hours` float NOT NULL,
  `days_present` int(11) NOT NULL,
  `days_absent` int(11) NOT NULL,
  `days_leave` int(11) NOT NULL,
  `late_arrivals` int(11) NOT NULL,
  `late_arrival_hours` float NOT NULL,
  `hours_worked` float NOT NULL,
  `gross_salary` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ems_salaries`
--

INSERT INTO `ems_salaries` (`id`, `salary_sheet_id`, `employee_id`, `net_salary`, `total_hours`, `days_present`, `days_absent`, `days_leave`, `late_arrivals`, `late_arrival_hours`, `hours_worked`, `gross_salary`, `created_at`, `updated_at`) VALUES
(6, 2, 2, 50000, 168, 1, 0, 0, 0, 0, 8, 2380.95, '2022-07-14 09:24:31', '2022-07-14 09:24:31'),
(7, 2, 5, 10000, 168, 1, 0, 0, 0, 0, 8, 476.19, '2022-07-14 09:24:31', '2022-07-14 09:24:31'),
(8, 1, 6, 25000, 168, 2, 0, 0, 0, 0, 16, 2380.95, '2022-07-14 09:36:56', '2022-07-14 09:36:56'),
(9, 1, 7, 15000, 168, 1, 0, 1, 0, 0, 8, 714.286, '2022-07-14 09:36:56', '2022-07-14 09:36:56'),
(10, 1, 8, 50000, 168, 1, 0, 0, 1, 2, 14, 4166.67, '2022-07-14 09:36:56', '2022-07-14 09:36:56'),
(11, 1, 9, 50000, 168, 2, 0, 0, 0, 0, 16, 4761.9, '2022-07-14 09:36:56', '2022-07-14 09:36:56'),
(12, 1, 10, 150000, 168, 1, 1, 0, 0, 0, 8, 7142.86, '2022-07-14 09:36:56', '2022-07-14 09:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `ems_salary_sheets`
--

CREATE TABLE `ems_salary_sheets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `salary_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ems_salary_sheets`
--

INSERT INTO `ems_salary_sheets` (`id`, `user_id`, `company_id`, `shift_id`, `salary_date`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, '2022-07-01', '2022-07-14 09:11:54', '2022-07-14 09:11:54');

-- --------------------------------------------------------

--
-- Table structure for table `ems_shifts`
--

CREATE TABLE `ems_shifts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_shifts`
--

INSERT INTO `ems_shifts` (`id`, `user_id`, `title`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 'Morning', '07:00:00', '15:00:00', '2022-07-11 18:49:41', '2022-07-11 18:49:41'),
(2, 1, 'Evening', '15:00:00', '22:00:00', '2022-07-11 18:49:56', '2022-07-11 19:12:05'),
(3, 1, 'Night', '22:00:00', '07:00:00', '2022-07-11 18:50:08', '2022-07-11 18:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `ems_users`
--

CREATE TABLE `ems_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ems_users`
--

INSERT INTO `ems_users` (`id`, `first_name`, `last_name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Waleed', 'Ikhlaq', 'waleedikhlaq2@gmail.com', '$2y$10$YdkhMvcszjBNNdlyybgZNeovMl3lZ4NdL86YQvRtitO.addHLpSuq', '2022-07-12 07:09:14', '2022-07-12 07:09:14'),
(2, 'World Education', 'System', 'wes@mail.com', '$2y$10$2qNAViFwxnHugoP/IVbYg.4FZZIEFICrkTe2WHTJKUbZZCIh.60Ey', '2022-07-14 09:38:20', '2022-07-14 09:38:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ems_attendance`
--
ALTER TABLE `ems_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `attendance_id` (`attendance_id`);

--
-- Indexes for table `ems_attendances`
--
ALTER TABLE `ems_attendances`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `ems_companies`
--
ALTER TABLE `ems_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ems_company_shifts`
--
ALTER TABLE `ems_company_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `ems_employees`
--
ALTER TABLE `ems_employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ems_employee_companies`
--
ALTER TABLE `ems_employee_companies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `ems_employee_leaves`
--
ALTER TABLE `ems_employee_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `ems_leaves`
--
ALTER TABLE `ems_leaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ems_salaries`
--
ALTER TABLE `ems_salaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salary_sheet_id` (`salary_sheet_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `ems_salary_sheets`
--
ALTER TABLE `ems_salary_sheets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `company_id` (`company_id`),
  ADD KEY `shift_id` (`shift_id`);

--
-- Indexes for table `ems_shifts`
--
ALTER TABLE `ems_shifts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `ems_users`
--
ALTER TABLE `ems_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ems_attendance`
--
ALTER TABLE `ems_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ems_attendances`
--
ALTER TABLE `ems_attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ems_companies`
--
ALTER TABLE `ems_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ems_company_shifts`
--
ALTER TABLE `ems_company_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ems_employees`
--
ALTER TABLE `ems_employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ems_employee_companies`
--
ALTER TABLE `ems_employee_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ems_employee_leaves`
--
ALTER TABLE `ems_employee_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ems_leaves`
--
ALTER TABLE `ems_leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ems_salaries`
--
ALTER TABLE `ems_salaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `ems_salary_sheets`
--
ALTER TABLE `ems_salary_sheets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ems_shifts`
--
ALTER TABLE `ems_shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ems_users`
--
ALTER TABLE `ems_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
