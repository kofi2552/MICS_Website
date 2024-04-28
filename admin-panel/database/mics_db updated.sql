-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 26, 2024 at 08:59 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS `mics_db`;

-- Switch to the newly created database
USE `mics_db`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `micstest`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  `mypassword` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roles` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `mypassword`, `created_at`, `roles`) VALUES
(15, 'cephasdanquah@mics.edu.gh', '$2y$10$R9WO6PEXjnIFUzfieNhoJesn7nLYg/GI7ri2/lrNFA/8.rjCV5RwW', '2024-04-16 21:01:49', 'director'),
(3, 'user@gmail.com', '$2y$10$DMcEliVNLs2dwzrF7y9ttefLI2MKrxk5Lb4NzbfolxFvWU.IfR8au', '2024-04-11 14:53:07', 'director'),
(4, 'kundee@gmail.com', '$2y$10$PcuiVw7NoN5V9kK6BWdzk.s/r7mojB/Bx6DuJWiTXKyrGby699BrW', '2024-04-11 16:33:10', 'director'),
(6, 'a@b.com', '$2y$10$Zk.Pqt4kPTM7vjy2E6IXq.7eG2ZF73UxN4Ta0fk9uM9Nj9ULndIia', '2024-04-11 16:50:58', 'director'),
(7, 'b@g.com', '$2y$10$x3TCRgLAsnxkKiB9mhpemeWefECQyeMYzsKEIXcNx/7/JXXxsMHQO', '2024-04-11 21:18:51', 'admin'),
(8, 'c@c.com', '$2y$10$GaDEJFC20cBFUG3yqs5ytuGJXDeNZW8KOwhYnKiC1CHm2bpN/7IEC', '2024-04-11 21:22:38', 'director'),
(9, 'd@d.com', '$2y$10$0MnRbz76jEWa.Q0F4hhKU.6FPFmSJddE.O5XKuKQ.F2W26R8jxG8a', '2024-04-12 20:24:47', 'admin'),
(10, 'd@g.com', '$2y$10$uajXX3Vr.6b9F/uWmB2WoOlrR5hF2L0Gm3DeqNcEtHwiLVcSGppJy', '2024-04-16 16:29:34', 'admin'),
(11, 'kofi@g.com', '$2y$10$BuGo1wP1xiQtTJI1jR3WMO6tnGwXb9YNYS653FhOWw3cvL4S7uo0O', '2024-04-16 19:27:24', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

DROP TABLE IF EXISTS `blog_categories`;
CREATE TABLE IF NOT EXISTS `blog_categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_date`) VALUES
(1, 'Articles', '2024-04-13 01:25:17'),
(2, 'Newsletter', '2024-04-13 02:17:23'),
(4, 'Football', '2024-04-14 21:35:37'),
(5, 'feeds', '2024-04-16 19:43:43');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

-- Drop the table if it exists to start fresh (optional)
DROP TABLE IF EXISTS `blog_posts`;

-- Create the blog_posts table
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,  
  `content` text NOT NULL,
  `category_id` int NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_published` tinyint(1) NOT NULL DEFAULT '1',
  `updated_by` varchar(200) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),           
  KEY `category_id` (`category_id`)  
);

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `img`, `content`, `category_id`, `created_date`, `updated_date`, `is_published`, `updated_by`, `created_by`) VALUES
(1, 'The aim of this experiment', 'gggg.jpg', 'gsfghfdghsfdghsfdgsfdsahdf', 0, '2024-04-13 01:32:46', '2024-04-13 01:32:46', 0, '', ''),
(2, 'The aim of this experiment', 'gggg.jpg', 'gsfghfdghsfdghsfdgsfdsahdf', 0, '2024-04-13 01:34:18', '2024-04-13 01:34:18', 0, '', ''),
(4, 'whwhjegrhjwegrhwe', 'g', 'rhwgrhjwegrghwerewhgrg', 1, '2024-04-13 02:16:56', '2024-04-14 21:06:29', 0, '', ''),
(6, 'the bookdd    limpsonn', 'Screenshot 2023-10-19 130633.png', 'sjnsnfsdfndsfnsdjf', 1, '2024-04-13 08:28:15', '2024-04-25 16:31:57', 1, 'a@b.com', ''),
(7, 'MORGAN FUN SHOW DAY - SHOWING THE REAL VIEW', 'HP ZBook Studio G7 15.6- Full HD - 1920 x 1080 - Intel Core i7 6 cores.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus laoreet placerat. Mauris velit mi, porta non rutrum sed, vehicula sit amet elit. Nam rutrum odio in eleifend dignissim. Vivamus lacinia, felis et gravida eleifend, sem massa sagittis erat, sollicitudin eleifend est lorem quis enim. Nullam vel urna vitae neque auctor auctor sollicitudin at eros. Aenean id felis at dolor elementum sagittis. Vestibulum vestibulum bibendum sem quis vulputate. Duis libero nunc, tincidunt at tortor sit amet, lobortis consectetur tellus. Fusce viverra, augue vestibulum volutpat luctus, tortor libero condimentum est, nec dictum ligula libero vitae tellus. Nunc eget dolor non mauris elementum ultricies a eu enim. Aliquam ut varius nibh, ut auctor sapien. Donec vel felis maximus, egestas dui convallis, auctor felis. Curabitur sit amet bibendum lorem. Proin consequat finibus magna et luctus. Suspendisse enim risus, molestie vel vestibulum in, feugiat ut justo. Suspendisse suscipit orci velit, at fermentum neque rhoncus sed.\r\n\r\n<p>Vivamus ex eros, facilisis sit amet pretium auctor, dictum non arcu. Vivamus commodo semper risus, vitae ultricies erat blandit id. Quisque </P>\r\negetipsum a libero mollis laoreet. Nullam eget sagittis leo. Donec nibh diam, egestas at neque quis, congue tristique nunc. Donec viverra est dolor, ullamcorper euismod nisi laoreet sed. Nunc gravida risus mollis eros dapibus convallis. In id lacus non diam lobortis pretium. Mauris posuere, purus a mattis viverra, ante dolor ornare quam, ut scelerisque urna risus non diam. Praesent maximus ante in tincidunt porttitor. Aliquam tempor rutrum lacinia.<i>the Boy</i>', 1, '2024-04-13 08:38:17', '2024-04-25 15:31:49', 1, 'a@b.com', ''),
(8, 'kunde', 'Screenshot 2023-10-12 115734.png', 'dhfjdgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 1, '2024-04-13 10:05:24', '2024-04-25 15:32:23', 1, 'a@b.com', ''),
(9, 'kunde justice', 'Screenshot 2023-10-12 115734.png', 'dhfjdgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 1, '2024-04-13 10:06:43', '2024-04-16 15:40:36', 0, 'a@b.com', ''),
(10, 'Default', 'Screenshot 2023-09-02 051543.png', 'djkhkjshhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh ddddsd', 1, '2024-04-13 10:33:13', '2024-04-14 23:05:31', 0, 'a@b.com', '')
-- --------------------------------------------------------

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
CREATE TABLE IF NOT EXISTS `events` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_date` date NOT NULL,
  `event_title` varchar(255) NOT NULL,
  `event_description` text,
  `event_color` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` varchar(200) NOT NULL,
  `updated_by` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `event_title`, `event_description`, `event_color`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(6, '2024-06-04', 'GRADUATION DAY', 'fdfgdfgdfdf', 'light', '2024-04-20 02:50:25', '2024-04-20 22:22:09', '', ''),
(7, '2024-04-11', 'DANCING DAY', 'gdfgdfgdgf', 'green', '2024-04-20 02:52:47', '2024-04-22 18:40:18', '', ''),
(9, '2024-05-21', 'BOOKING DAY', 'this is short test', 'green', '2024-04-20 08:52:15', '2024-04-20 22:03:58', '', ''),
(10, '2024-06-07', 'HOLIDAY', 'This is a holiday', 'orange', '2024-04-20 22:40:22', '2024-04-20 22:41:28', '', ''),
(11, '2024-06-21', 'HOLIDAY FOR STAFF', 'dgggdg', 'light', '2024-04-20 22:43:58', '2024-04-26 08:45:22', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `events_year`
--

DROP TABLE IF EXISTS `events_year`;
CREATE TABLE IF NOT EXISTS `events_year` (
  `id` int NOT NULL AUTO_INCREMENT,
  `event_year` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `events_year`
--

INSERT INTO `events_year` (`id`, `event_year`, `created_at`, `updated_at`) VALUES
(1, '2024/2026', '2024-04-20 09:29:00', '2024-04-26 08:48:27');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
