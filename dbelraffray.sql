-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 29, 2017 at 04:17 PM
-- Server version: 5.5.58-0+deb8u1-log
-- PHP Version: 7.0.26-1~dotdeb+8.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbelraffray`
--

-- --------------------------------------------------------

--
-- Table structure for table `Liste`
--

CREATE TABLE `Liste` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Liste`
--

INSERT INTO `Liste` (`id`, `nom`) VALUES
(1, 'test');

-- --------------------------------------------------------

--
-- Table structure for table `Tache`
--

CREATE TABLE `Tache` (
  `id` int(11) NOT NULL,
  `idListe` int(11) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `dateAjout` datetime NOT NULL,
  `dateFin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Tache`
--

INSERT INTO `Tache` (`id`, `idListe`, `nom`, `description`, `dateAjout`, `dateFin`) VALUES
(1, 1, 'a', 'a', '2017-11-22 17:23:41', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Liste`
--
ALTER TABLE `Liste`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Tache`
--
ALTER TABLE `Tache`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idListe` (`idListe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Liste`
--
ALTER TABLE `Liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Tache`
--
ALTER TABLE `Tache`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Tache`
--
ALTER TABLE `Tache`
  ADD CONSTRAINT `Tache_ibfk_1` FOREIGN KEY (`idListe`) REFERENCES `Liste` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
