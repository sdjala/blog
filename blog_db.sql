-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2018 at 09:56 AM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(5) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT 'no title',
  `summary` varchar(350) DEFAULT 'no summary',
  `tags` varchar(100) DEFAULT 'no tags',
  `body` varchar(2000) DEFAULT 'no body',
  `author` varchar(50) DEFAULT 'no author',
  `image` varchar(100) DEFAULT 'no image',
  `category` varchar(50) DEFAULT 'no categ',
  `date` date NOT NULL,
  `is_feature` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `position` int(3) UNSIGNED NOT NULL,
  `seo_url` varchar(100) DEFAULT NULL,
  `uid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `summary`, `tags`, `body`, `author`, `image`, `category`, `date`, `is_feature`, `status`, `position`, `seo_url`, `uid`) VALUES
(3, 'How to Write an Awesome Blog Post in 5 Steps', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate.', 'blog,sport,game play', '<p style=\"text-align: left;\">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.</p><p style=\"text-align: left;\">Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue.</p><p style=\"text-align: left;\">Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo.</p><p style=\"text-align: left;\">Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis Nam pretium turpis et arcu. &nbsp;DuisDuisDuisDuisDuisDuis. &nbsp; &nbsp;&nbsp;</p>', 'Sokol', 'greatroom-yellowstone.jpg', 'Technology', '2018-12-12', 1, 1, 0, 'how-to-write-an-awesome-blog', 1),
(15, 'What best blogs have in common?', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate.', 'blog', '<p style=\"text-align: left;\"><strong>There are thousands</strong> of blogs on the web, but how did the truly successful bloggers manage to cut through the noise of competition and push their blogs to the top? They provided content that offered real value to their readers. They had a unique voice that their readers wanted to hear and that is exactly what made them different. That makes for some stiff competition for new entrants to the blogosphere trying to make their name.</p><p style=\"text-align: left;\">Even if a topic that you want to tackle includes an idea that has been told thousand times over, you can still make a twist and tell your story. You can create compelling content that will have a unique personality that your readers can relate to and truly fall in love with every single word you write.</p><p style=\"text-align: left;\">Quality content is exactly what all the favorite blogs have in common. Of course, there&rsquo;s the number of followers, but the content is the only element that attracts people.</p>', 'Admin', 'blog.jpg', 'Lifestyle', '2018-12-19', 1, 1, 2, 'what-best-blogs-have-in-common', 1),
(18, 'Stephen Curry Doubts Moon Landings.', 'injury and rejoined the Golden State Warriors in their quest for a third consecutive championship, was a guest on a podcast called &amp;ldquo;Winging It,&amp;rdquo; which is hosted by the N.B.A. players Vince Carter and Kent Bazemo', 'tech', '<p style=\"text-align: left;\"><strong>There are thousands</strong> of blogs on the web, but how did the truly successful bloggers manage to cut through the noise of competition and push their blogs to the top? They provided content that offered real value to their readers. They had a unique voice that their readers wanted to hear and that is exactly what made them different. That makes for some stiff competition for new entrants to the blogosphere trying to make their name.</p><p style=\"text-align: left;\">Even if a topic that you want to tackle includes an idea that has been told thousand times over, you can still make a twist and tell your story. You can create compelling content that will have a unique personality that your readers can relate to and truly fall in love with every single word you write.</p><p style=\"text-align: left;\">Quality content is exactly what all the favorite blogs have in common. Of course, there&rsquo;s the number of followers, but the content is the only element that attracts people.</p>', 'Admin', 'ship.jpg', 'Technology', '2018-12-19', 0, 1, 1, 'stephen-curry-doubts-moon-landings', 1),
(26, 'Doubts Moon Landings.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate.', 'tech', '<p style=\"text-align: left;\"><strong>There are thousands</strong> of blogs on the web, but how did the truly successful bloggers manage to cut through the noise of competition and push their blogs to the top? They provided content that offered real value to their readers. They had a unique voice that their readers wanted to hear and that is exactly what made them different. That makes for some stiff competition for new entrants to the blogosphere trying to make their name.</p><p style=\"text-align: left;\">Even if a topic that you want to tackle includes an idea that has been told thousand times over, you can still make a twist and tell your story. You can create compelling content that will have a unique personality that your readers can relate to and truly fall in love with every single word you write.</p><p style=\"text-align: left;\">Quality content is exactly what all the favorite blogs have in common. Of course, there&rsquo;s the number of followers, but the content is the only element that attracts people.</p>', 'Admin', 'blog.jpg', 'Technology', '2018-12-25', 0, 0, 0, 'doubts-moon-landings', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'Technology', 'Articles about technology.'),
(2, 'Music', 'Articles about music.'),
(3, 'Art', 'Articles about art.\r\n'),
(4, 'Lifestyle', 'Articles about lifestylesss');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(255) UNSIGNED NOT NULL,
  `comment` varchar(150) NOT NULL,
  `postID` int(5) NOT NULL,
  `uid` int(5) NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `postID`, `uid`, `status`, `created_at`, `updated_at`) VALUES
(19, 'You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!', 3, 3, 1, '2018-12-14 14:19:43', '0000-00-00 00:00:00'),
(35, 'You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!', 15, 3, 1, '2018-12-14 14:19:43', '2018-12-14 14:17:56'),
(38, 'You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers! \r\n', 3, 1, 1, '2018-12-14 14:19:43', '0000-00-00 00:00:00'),
(41, 'Quality content is exactly what all the favorite blogs have in common.', 15, 2, 0, '2018-12-14 14:19:43', '2018-12-14 14:18:10'),
(42, 'Of course, there&amp;rsquo;s the number of followers, but the content is the only element that attracts people.', 18, 2, 0, '2018-12-14 14:19:43', '2018-12-14 14:18:20'),
(43, 'Quality content is exactly what all the favorite blogs have in common. Of course, thereâ€™s the number of followers, but the content is the only eleme', 18, 2, 1, '2018-12-14 14:19:43', '0000-00-00 00:00:00'),
(45, 'Of course, there&amp;rsquo;s the number of followers, but the content is the only element that attracts people.', 18, 1, 0, '2018-12-14 14:19:43', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_id`
--

CREATE TABLE `role_id` (
  `id` int(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_id`
--

INSERT INTO `role_id` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Editor'),
(3, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(3) UNSIGNED NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role_id` int(1) NOT NULL DEFAULT '3',
  `status` int(1) UNSIGNED NOT NULL DEFAULT '1',
  `isEmailConfirmed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`, `status`, `isEmailConfirmed`, `token`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$9e8rFKizAREbnsuTcoW1O.qnn4Io6OL7VIDPCzUIA/5Lh7XDF01qW', 1, 1, 1, ''),
(2, 'Editor', 'editor@gmail.com', '$2y$10$TMQuKyW1niGKYzqHlxxlXub0JRGmQGMBPJM9u6MpCP5SdRBxVUfku', 2, 1, 1, ''),
(3, 'User', 'user@gmail.com', '$2y$10$iP1dA/wBZyhxxkzWlwUu8OIv0RsAf2p81L2VJW62..bxynCjUcqPq', 3, 1, 1, ''),
(4, 'User1', 'user1@gmail.com', '$2y$10$LedHjBFcf7BUZANfWWt4G.qZrpsfCg4oK2SDaYwuCWh.cdZg/gx3q', 3, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_id`
--
ALTER TABLE `role_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(255) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `role_id`
--
ALTER TABLE `role_id`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
