-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2019 at 11:38 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_kerjasama`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_company`
--

CREATE TABLE `tb_company` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_company`
--

INSERT INTO `tb_company` (`id`, `name`, `address`) VALUES
(1, 'a', '1'),
(4, 'b', '2'),
(5, 'aaaa', '1'),
(6, 'bdasdad', '2asdas'),
(7, 'aaa', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_coop`
--

CREATE TABLE `tb_coop` (
  `id` int(11) NOT NULL,
  `fk_company` int(11) NOT NULL,
  `coop_number` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `fk_coop_type` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_coop`
--

INSERT INTO `tb_coop` (`id`, `fk_company`, `coop_number`, `description`, `start_date`, `end_date`, `fk_coop_type`, `created_by`, `created_date`) VALUES
(1, 4, '3', '3', '2019-09-09', '2019-09-20', 3, 3, '2019-09-01 16:08:11'),
(2, 4, '4', '4', '2019-09-13', '2019-09-20', 3, 3, '2019-09-01 16:08:39'),
(3, 1, '111', '111', '2019-09-13', '2019-09-20', 3, 3, '2019-09-01 16:21:21'),
(4, 4, '2123123', '2123123', '2019-09-26', '2019-09-28', 3, 3, '2019-09-01 16:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `tb_coop_type`
--

CREATE TABLE `tb_coop_type` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_coop_type`
--

INSERT INTO `tb_coop_type` (`id`, `name`) VALUES
(3, 'SPK');

-- --------------------------------------------------------

--
-- Table structure for table `tb_role`
--

CREATE TABLE `tb_role` (
  `id` int(11) NOT NULL,
  `type` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_role`
--

INSERT INTO `tb_role` (`id`, `type`) VALUES
(1, 'r1');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `address` varchar(64) NOT NULL,
  `phone` varchar(16) NOT NULL,
  `email` varchar(64) NOT NULL,
  `username` varchar(16) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `name`, `address`, `phone`, `email`, `username`, `password`) VALUES
(3, 'Aldhan Biuzar Yahya', 'Jl Jend Hariyono no 161 Lumajang', '0811111111', 'aby@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(19, 'Aldhan Biuzar Yahya', '1', '2', '1', '1', 'c4ca4238a0b923820dcc509a6f75849b');

-- --------------------------------------------------------

--
-- Table structure for table `_user_ci`
--

CREATE TABLE `_user_ci` (
  `fk_user` int(11) NOT NULL,
  `ci_session_id` varchar(64) DEFAULT NULL,
  `ci_session_ts` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_user_ci`
--

INSERT INTO `_user_ci` (`fk_user`, `ci_session_id`, `ci_session_ts`) VALUES
(3, 'u2m0rad1llhr2nafl6ert638kbqvtvs6', '2019-09-01 09:26:01'),
(19, NULL, '2019-08-30 17:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `_user_role`
--

CREATE TABLE `_user_role` (
  `fk_user` int(11) NOT NULL,
  `fk_role` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_company`
--
ALTER TABLE `tb_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_coop`
--
ALTER TABLE `tb_coop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `tb_coop_type` (`fk_coop_type`),
  ADD KEY `fk_company` (`fk_company`);

--
-- Indexes for table `tb_coop_type`
--
ALTER TABLE `tb_coop_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_role`
--
ALTER TABLE `tb_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `_user_ci`
--
ALTER TABLE `_user_ci`
  ADD KEY `fk_user` (`fk_user`);

--
-- Indexes for table `_user_role`
--
ALTER TABLE `_user_role`
  ADD KEY `fk_role` (`fk_role`),
  ADD KEY `fk_user` (`fk_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_company`
--
ALTER TABLE `tb_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_coop`
--
ALTER TABLE `tb_coop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_coop_type`
--
ALTER TABLE `tb_coop_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_role`
--
ALTER TABLE `tb_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_coop`
--
ALTER TABLE `tb_coop`
  ADD CONSTRAINT `tb_coop_ibfk_1` FOREIGN KEY (`fk_company`) REFERENCES `tb_company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_coop_ibfk_2` FOREIGN KEY (`fk_coop_type`) REFERENCES `tb_coop_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_user_ci`
--
ALTER TABLE `_user_ci`
  ADD CONSTRAINT `_user_ci_ibfk_1` FOREIGN KEY (`fk_user`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `_user_role`
--
ALTER TABLE `_user_role`
  ADD CONSTRAINT `_user_role_ibfk_1` FOREIGN KEY (`fk_role`) REFERENCES `tb_role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `_user_role_ibfk_2` FOREIGN KEY (`fk_user`) REFERENCES `tb_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
