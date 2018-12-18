-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2018 at 04:43 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.2.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crudgen`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_credential`
--

CREATE TABLE `db_credential` (
  `id` int(10) UNSIGNED NOT NULL,
  `host` varchar(255) DEFAULT NULL,
  `database` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `db_credential`
--

INSERT INTO `db_credential` (`id`, `host`, `database`, `username`, `password`, `project_id`) VALUES
(1, 'localhost', 'crudgen', 'homestead', 'secret', 1),
(2, 'localhost', 'larabid', 'homestead', 'secret', 4),
(3, 'localhost', 'ticketbeast', 'homestead', 'secret', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `directory` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `directory`) VALUES
(1, 'crudgen', 'crudgen'),
(4, 'larabid', 'larabid'),
(5, 'ticketbeast', 'ticketbeast'),
(6, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `relationship`
--

CREATE TABLE `relationship` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_table` varchar(255) DEFAULT NULL,
  `relationship_type` varchar(255) DEFAULT NULL,
  `related_table` varchar(255) DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `version`
--

CREATE TABLE `version` (
  `id` int(10) UNSIGNED NOT NULL,
  `version_number` varchar(255) DEFAULT NULL,
  `version_folder_name` varchar(255) DEFAULT NULL,
  `project_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_credential`
--
ALTER TABLE `db_credential`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_db_credential_project1_idx` (`project_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`);

--
-- Indexes for table `relationship`
--
ALTER TABLE `relationship`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_relationship_project1_idx` (`project_id`);

--
-- Indexes for table `version`
--
ALTER TABLE `version`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_UNIQUE` (`id`),
  ADD KEY `fk_version_project1_idx` (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_credential`
--
ALTER TABLE `db_credential`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `relationship`
--
ALTER TABLE `relationship`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `version`
--
ALTER TABLE `version`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `db_credential`
--
ALTER TABLE `db_credential`
  ADD CONSTRAINT `fk_db_credential_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `relationship`
--
ALTER TABLE `relationship`
  ADD CONSTRAINT `fk_relationship_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `version`
--
ALTER TABLE `version`
  ADD CONSTRAINT `fk_version_project1` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
