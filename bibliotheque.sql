-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2022 at 01:02 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(7, 'J.K Rowling'),
(9, 'Kévin Niel'),
(10, 'Hugo Decrypt'),
(11, 'Voltaire'),
(13, 'Jean Michel Dupuis'),
(14, 'Dumas'),
(15, 'Brandon Mull');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `name`, `genre_id`, `author_id`) VALUES
(76, 'Autobiographie', 7, 7),
(77, 'Harry Potter et les chaussettes du mépris', 8, 7),
(78, 'Le petit chaperon rouge', 11, 9),
(79, 'Harry Potter et les chaussettes du mépris', 12, 11),
(80, 'Star trek', 8, 10),
(81, 'Le petit chaperon rouge', 8, 7),
(82, 'Le roi sans culotte', 11, 10),
(83, 'Star trek', 12, 10),
(84, 'Le petit chaperon rouge', 13, 11),
(85, 'Le petit chaperon rouge', 14, 13),
(86, 'Le petit chaperon rouge', 14, 13),
(87, 'Le PHP pour les nuls', 13, 13),
(88, 'Le PHP pour les nuls', 13, 10),
(89, 'Le petit chaperon rouge', 14, 13),
(90, 'Le petit chaperon rouge', 15, 9),
(91, 'Star trek', 15, 15),
(92, 'Harry Potter et les chaussettes du mépris', 8, 13),
(93, 'Le PHP pour les nuls', 13, 13),
(94, 'Autobiographie', 13, 11),
(95, 'Harry Potter et les chaussettes du mépris', 14, 9),
(96, 'Le roi sans culotte', 13, 11),
(97, 'Le roi sans culotte', 14, 13),
(98, 'Autobiographie', 13, 13),
(99, 'Le roi sans culotte', 13, 13),
(100, 'Le PHP pour les nuls', 14, 15);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id`, `name`) VALUES
(7, 'Fantasy'),
(8, 'Poésie'),
(11, 'I.T'),
(12, 'Documentaire'),
(13, 'S.F'),
(14, 'Policier'),
(15, 'Thriller');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_ibfk_1` (`genre_id`),
  ADD KEY `book_ibfk_2` (`author_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`genre_id`) REFERENCES `genre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
