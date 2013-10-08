-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Време на генериране: 
-- Версия на сървъра: 5.5.27
-- Версия на PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- БД: `homework-03`
--

-- --------------------------------------------------------

--
-- Структура на таблица `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `summary` text NOT NULL,
  `message` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `message_id` (`message_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Ссхема на данните от таблица `messages`
--

INSERT INTO `messages` (`message_id`, `summary`, `message`, `creation_date`, `user_id`) VALUES
(3, 'Summary', 'test', '2013-10-07 23:01:03', 1),
(4, 'Test', 'test', '2013-10-07 23:01:20', 1),
(5, 'Ð½Ð¾Ð²Ð¾ ÑÑŠÐ¾Ð±Ñ‰ÐµÐ½Ð¸Ðµ', 'Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚', '2013-10-08 20:12:08', 1),
(6, 'Ñ‚ÐµÐºÑÑ‚', 'Ñ‚ÐµÐºÑÑ‚, Ñ‚ÐµÐºÑÑ‚', '2013-10-08 22:52:53', 1);

-- --------------------------------------------------------

--
-- Структура на таблица `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Ссхема на данните от таблица `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '12345'),
(2, 'student', 'student');

--
-- Ограничения за дъмпнати таблици
--

--
-- Ограничения за таблица `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
