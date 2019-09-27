-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2019 at 07:03 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Bootstrap'),
(2, 'Javascript'),
(5, 'php'),
(7, 'Java'),
(8, 'html 2');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(1, 10, 'Edwin Diaz', 'Edwindiaz@gmail.com', 'this is just an example', 'approved', '2019-09-06'),
(5, 10, 'Sandra', 'sandra@gmail.com', 'Wow, i want test the functionality of this section.', 'unapproved', '2019-09-09'),
(8, 9, 'Sandra', 'edwin@edwindiaz.com', 'hey', 'approved', '2019-09-09'),
(12, 9, 'Oguns', 'oguns@gmail.com', 'Hi, this is Oguns', 'unapproved', '2019-09-09'),
(15, 12, 'Sandra', 'edwin@edwindiaz.com', 'testng', 'approved', '2019-09-09'),
(16, 9, '', '', '', 'unapproved', '2019-09-19'),
(17, 14, 'Sheriff', 'sheriff@gmail.com', 'hey', 'approved', '2019-09-27');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'drafts',
  `post_views_count` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(14, 7, 'Javascript course classes', 'jAAH', '2019-09-18', 'image_1.jpg', '<p>this is some content</p>', '  javascript 2', 1, 'published', 3),
(15, 5, 'Javascript course classes', 'Belindaa', '2019-09-18', 'image_2.jpg', '<p>hello</p>', 'javascript, course', 0, 'published', 0),
(17, 5, 'Javascript course classes', 'Belindaa', '2019-09-18', 'image_2.jpg', '<p>hello</p>', 'javascript, course', 0, 'published', 0),
(18, 5, 'Javascript course classes', 'Belindaa', '2019-09-18', 'image_2.jpg', '<p>hello</p>', 'javascript, course', 0, 'published', 0),
(19, 2, 'Javascript course classes', 'Edwin Diaz', '2019-09-18', 'image_4.jpg', '<p>hey</p>', 'php, edwin, lawal', 0, 'published', 0),
(22, 1, 'php 2', 'Edwin Diaz', '2019-09-19', 'image_2.jpg', '', 'javascript, course', 0, 'published', 0),
(23, 1, 'example category', 'Lawal Jamiu', '2019-09-19', 'image_3.jpg', '', 'php, edwin, lawal', 0, 'published', 0),
(24, 1, 'php 2', 'Edwin Diaz', '2019-09-19', 'image_2.jpg', '', 'javascript, course', 0, 'published', 0),
(25, 1, 'example category', 'Lawal Jamiu', '2019-09-19', 'image_3.jpg', '', 'php, edwin, lawal', 0, 'published', 0),
(26, 1, 'example category', 'Lawal Jamiu', '2019-09-25', 'image_3.jpg', '', 'php, edwin, lawal', 0, 'published', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `user_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `user_date`) VALUES
(1, 'Jaah', '1234', 'Lawal', 'Jamiu', 'lawal5@gmail.com', 'image_3.jpg', 'admin', '', '2019-09-15'),
(3, 'Adej', '12345', 'Adetoro', 'Emmanuel', 'adej@gmail.com', 'image_2.jpg', 'admin', 'wait', '2019-09-12'),
(4, 'Moh', '123', 'Mohammed', 'Lawal', 'moh@gmail.com', 'image_2.jpg', 'subscriber', 'wait', '2019-09-18'),
(5, 'Fat', '123', 'FAtay', 'aje', 'fat@gmail.com', 'image_4.jpg', 'subscriber', 'wait', '2019-09-18'),
(6, 'ero', '1233', 'ERRO', 'KUTUBE', 'ero@gmail.com', 'image_2.jpg', 'subscriber', '$2y$10$iusesomecrazystring22', '2019-09-19'),
(7, '', '', '', '', '', '', 'subscriber ', '$2y$10$iusesomecrazystring22', '2019-09-19'),
(35, 'jaah2', '123', 'FAtay', 'KUTUBE', 'wet@gmail.com', 'image_2.jpg', 'subscriber', '$2y$10$iusesomecrazystring22', '2019-09-19'),
(44, 'adio', '123', '', '', 'adio@gmail.com', '', 'subsriber', '$2y$10$iusesomecrazystring22', '2019-09-19');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(1, '195m8ke83a6dc37j92lpm6cvm5', 1569591215),
(2, 'njgca74skks236ord59r8a9mek', 1569591210);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
