-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 28 2018 г., 03:29
-- Версия сервера: 5.7.16-log
-- Версия PHP: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `panel`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` bigint(11) UNSIGNED NOT NULL,
  `dateBirth` date NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `patronymic`, `email`, `phone`, `dateBirth`, `avatar`) VALUES
(1, 'olike', '$2y$10$85K2bW2k9qZndMwYu7DRdeaDjw5uGNEETMUeIuZy45pg9APL8BsKS', 'Олег', 'Горбунов', 'Николаевич', 'gorbux_olike@mail.ru', 89002521370, '1997-03-02', 'olikeOleg.jpg'),
(2, 'admin', '$2y$10$3mI1j78US6CEu0vDQrOWZ.o0b8eG.prMe9cWkmxOON0.xwVW5njoi', 'Ирина', 'Василькова', 'Ивановна', 'rdupdfmq@yomail.info', 89002521379, '1950-12-21', 'admin1.png'),
(3, 'VVhite', '$2y$10$ii3oe69GtT5faSnL.1EOm.GyCftRDwQmImRBNCyr594MNxz3bQnoy', 'Максим', 'Бутов', 'Николаевич', 'gorbux_olken@mail.ru', 89002154213, '1995-12-19', 'VVhiteШуст1.jpg'),
(4, 'xBest', '$2y$10$CSfTKQh.gfd7dgB5/cYML.8bwloJFdGw5kJ7oWeYtEIOrkKaN/ey.', 'Ольга', 'Песна', 'Олеговна', 'rdfmq@mail.info', 89002451370, '1970-11-07', 'xBeststeik2.jpg'),
(5, 'gorbux', '$2y$10$l9a2zwW7iK9Uzoc8UOC/uudZs8rJPaEkGDnneGjqzXUw0Zw4P3pQO', 'Олег', 'Терек', 'Иванович', 'gorbux_ol@mail.ru', 89002521375, '1993-11-14', 'gorbuxdark.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
