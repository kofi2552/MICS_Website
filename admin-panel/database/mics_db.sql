-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 13, 2024 at 12:43 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mics_db`
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `mypassword`, `created_at`, `roles`) VALUES
(1, 'justice@gmail.com', '1234', '2024-04-11 14:18:09', 'admin'),
(2, 'frankduah@gmail.com', '$2y$10$Xr.1ReYjWdP.6PQGhvuJfugoNDx8XyNRlFztbogSS6320507tjOIi', '2024-04-11 14:31:07', ''),
(3, 'user@gmail.com', '$2y$10$HrUtYs7SCQnA5SmzVGxEH.sOvC3pO9jIanS1DUmDA4H8UJJwswNwi', '2024-04-11 14:53:07', 'admin'),
(4, 'kundee@gmail.com', '$2y$10$PcuiVw7NoN5V9kK6BWdzk.s/r7mojB/Bx6DuJWiTXKyrGby699BrW', '2024-04-11 16:33:10', 'director'),
(5, 'admin@gmail.com', '$2y$10$urcyO2j9DyD1aQk.CuKhuO31wJDWwHQvGbVZMPbPRp9.Xwi5e59H2', '2024-04-11 16:41:16', 'director'),
(6, 'a@b.com', '$2y$10$Zk.Pqt4kPTM7vjy2E6IXq.7eG2ZF73UxN4Ta0fk9uM9Nj9ULndIia', '2024-04-11 16:50:58', 'director'),
(7, 'b@g.com', '$2y$10$x3TCRgLAsnxkKiB9mhpemeWefECQyeMYzsKEIXcNx/7/JXXxsMHQO', '2024-04-11 21:18:51', 'admin'),
(8, 'c@c.com', '$2y$10$GaDEJFC20cBFUG3yqs5ytuGJXDeNZW8KOwhYnKiC1CHm2bpN/7IEC', '2024-04-11 21:22:38', 'director'),
(9, 'd@d.com', '$2y$10$0MnRbz76jEWa.Q0F4hhKU.6FPFmSJddE.O5XKuKQ.F2W26R8jxG8a', '2024-04-12 20:24:47', 'admin');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_date`) VALUES
(1, 'Articles', '2024-04-13 01:25:17'),
(2, 'Newsletter', '2024-04-13 02:17:23');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE IF NOT EXISTS `blog_posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `content` text NOT NULL,
  `category_id` int NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `is_published` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'review',
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `img`, `content`, `category_id`, `created_date`, `updated_date`, `is_published`) VALUES
(1, 'The aim of this experiment', 'gggg.jpg', 'gsfghfdghsfdghsfdgsfdsahdf', 0, '2024-04-13 01:32:46', '2024-04-13 01:32:46', '0'),
(2, 'The aim of this experiment', 'gggg.jpg', 'gsfghfdghsfdghsfdgsfdsahdf', 0, '2024-04-13 01:34:18', '2024-04-13 01:34:18', '0'),
(4, 'whwhjegrhjwegrhwe', 'g', 'rhwgrhjwegrghwerewhgrg', 1, '2024-04-13 02:16:56', '2024-04-13 02:16:56', '0'),
(6, 'the bookdd    limpsonn', 'Screenshot 2023-10-19 130633.png', 'sjnsnfsdfndsfnsdjf', 1, '2024-04-13 08:28:15', '2024-04-13 10:34:10', 'review'),
(7, 'justice', 'HP ZBook Studio G7 15.6- Full HD - 1920 x 1080 - Intel Core i7 6 cores.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam finibus laoreet placerat. Mauris velit mi, porta non rutrum sed, vehicula sit amet elit. Nam rutrum odio in eleifend dignissim. Vivamus lacinia, felis et gravida eleifend, sem massa sagittis erat, sollicitudin eleifend est lorem quis enim. Nullam vel urna vitae neque auctor auctor sollicitudin at eros. Aenean id felis at dolor elementum sagittis. Vestibulum vestibulum bibendum sem quis vulputate. Duis libero nunc, tincidunt at tortor sit amet, lobortis consectetur tellus. Fusce viverra, augue vestibulum volutpat luctus, tortor libero condimentum est, nec dictum ligula libero vitae tellus. Nunc eget dolor non mauris elementum ultricies a eu enim. Aliquam ut varius nibh, ut auctor sapien. Donec vel felis maximus, egestas dui convallis, auctor felis. Curabitur sit amet bibendum lorem. Proin consequat finibus magna et luctus. Suspendisse enim risus, molestie vel vestibulum in, feugiat ut justo. Suspendisse suscipit orci velit, at fermentum neque rhoncus sed.\r\n\r\n<p>Vivamus ex eros, facilisis sit amet pretium auctor, dictum non arcu. Vivamus commodo semper risus, vitae ultricies erat blandit id. Quisque </P>\r\negetipsum a libero mollis laoreet. Nullam eget sagittis leo. Donec nibh diam, egestas at neque quis, congue tristique nunc. Donec viverra est dolor, ullamcorper euismod nisi laoreet sed. Nunc gravida risus mollis eros dapibus convallis. In id lacus non diam lobortis pretium. Mauris posuere, purus a mattis viverra, ante dolor ornare quam, ut scelerisque urna risus non diam. Praesent maximus ante in tincidunt porttitor. Aliquam tempor rutrum lacinia.', 2, '2024-04-13 08:38:17', '2024-04-13 10:52:20', 'review'),
(8, 'kunde', 'Screenshot 2023-10-12 115734.png', 'dhfjdgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 2, '2024-04-13 10:05:24', '2024-04-13 10:05:24', '0'),
(9, 'kunde justice', 'Screenshot 2023-10-12 115734.png', 'dhfjdgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', 1, '2024-04-13 10:06:43', '2024-04-13 10:06:43', '0'),
(10, 'Default', 'Screenshot 2023-09-02 051543.png', 'djkhkjshhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 1, '2024-04-13 10:33:13', '2024-04-13 10:33:13', 'review');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
