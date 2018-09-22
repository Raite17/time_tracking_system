-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 22 2018 г., 12:57
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `time_tracking`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `login`, `password`, `email`, `role`, `active`, `created_at`) VALUES
(14, 'Dima', 'Dima', '$2y$08$aXNPQjJ0YlBXdldFRUMwa.aMOjJfuUGSO7Psu1hd4K/PL1WecANnS', 'dima@gmail.com', 'user', 1, '2018-09-06 15:58:46'),
(15, 'Stas', 'Star', '$2y$08$cUEwK3FMK1hsZ25lSUd3bOYZS9hrK/d1KIm2yaFTqF9dN3S4/nvEm', 'stas@gmail.com', 'user', 1, '2018-09-06 15:59:46'),
(16, 'Ilzat', 'Raite', '$2y$08$Q3JWdUJ4UXZMZDR1aVhsW.HLrF5Cu4lS4jvFFVd6/2Ofht.otsvoS', 'survivarian@gmail.com', 'user', 1, '2018-09-06 16:06:07'),
(17, 'Ulan', 'Ulan', '$2y$08$TFAwNEU3c2ZWa3pMQjZwKuWWZ1x0QY5w.C0Q8m0wW.lP91Z6XdGU2', 'ulan@gmail.com', 'user', 1, '2018-09-06 16:12:43'),
(18, 'Oleg', 'Oleg', '$2y$08$MDFlWkNlOUV3b2VjUkZvZOMgbTsAZXuRAewjdDwkQdt0N5ZJmC7e.', 'oleg@gmail.com', 'user', 1, '2018-09-06 16:16:24'),
(19, 'TIlek', 'tilek', '$2y$08$YkUrNjRRMmFScEI4UXRNTeOdyGu.IQZo4576gGN8Gh7HtoV2f6iX2', 'ipman@gmail.com', 'user', 1, '2018-09-22 16:49:20');

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

CREATE TABLE `works` (
  `id` int(11) NOT NULL,
  `start` datetime NOT NULL,
  `stop` datetime DEFAULT NULL,
  `total` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`id`, `start`, `stop`, `total`, `user_id`) VALUES
(85, '2018-09-17 08:00:00', '2018-09-17 19:00:00', '25200', 16),
(86, '2018-09-22 15:56:34', '2018-09-22 16:24:38', '1684', 16);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `works`
--
ALTER TABLE `works`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
