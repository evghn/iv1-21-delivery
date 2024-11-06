-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:33061
-- Время создания: Ноя 06 2024 г., 16:27
-- Версия сервера: 10.6.9-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `delivery_21`
--

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(2, 'Продукты'),
(3, 'Обувь'),
(4, 'Куртки'),
(5, 'животные');

-- --------------------------------------------------------

--
-- Структура таблицы `favourite`
--

CREATE TABLE `favourite` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `favourite`
--

INSERT INTO `favourite` (`id`, `product_id`, `user_id`, `status`) VALUES
(1, 1, 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type_pay_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(255) NOT NULL,
  `outpost_id` int(10) UNSIGNED NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `comment_admin` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `product_id`, `date`, `time`, `type_pay_id`, `address`, `outpost_id`, `comment`, `status_id`, `user_id`, `comment_admin`, `created_at`) VALUES
(1, 1, '2024-11-06', '18:00:00', 1, 'адрес ', 1, '', 1, 5, NULL, '2024-11-06 12:08:23');

-- --------------------------------------------------------

--
-- Структура таблицы `outpost`
--

CREATE TABLE `outpost` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `outpost`
--

INSERT INTO `outpost` (`id`, `title`) VALUES
(1, 'пункт 1'),
(2, 'пункт 2'),
(3, 'пункт 3'),
(4, 'пункт 4');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `price` float UNSIGNED NOT NULL,
  `count` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `like` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `dislike` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `weight` float UNSIGNED DEFAULT 0,
  `kilocalories` float UNSIGNED DEFAULT 0,
  `shelf_life` varchar(255) DEFAULT NULL,
  `description` mediumtext NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `photo`, `price`, `count`, `like`, `dislike`, `weight`, `kilocalories`, `shelf_life`, `description`, `category_id`) VALUES
(1, 'Молоко', '7_1729680152_k0EsyvbjPzC9c3p4Z7SYTnZpFddKpn7T.jpg', 50, 100, 19, 17, 1000, 200, '1 месяц', 'молоко от коровки :)', 2),
(2, 'Молоко2', '7_1729680152_k0EsyvbjPzC9c3p4Z7SYTnZpFddKpn7T.jpg', 100, 100, 19, 17, 1000, 200, '1 месяц', 'молоко от коровки :)', 2),
(3, 'Молоко 3', '7_1729680152_k0EsyvbjPzC9c3p4Z7SYTnZpFddKpn7T.jpg', 50, 100, 19, 17, 1000, 200, '1 месяц', 'молоко от коровки :)', 2),
(4, 'Молоко 4', '7_1729680152_k0EsyvbjPzC9c3p4Z7SYTnZpFddKpn7T.jpg', 100, 100, 19, 17, 1000, 200, '1 месяц', 'молоко от коровки :)', 2),
(9, 'Хомяк', 'home.jpeg', 100, 10, 0, 0, 100, 0, NULL, 'Хомяк пушистый', 5),
(10, 'Хомяк 2', 'home.jpeg', 100, 10, 0, 0, 100, 0, NULL, 'Хомяк пушистый', 5),
(11, 'Хомяк 3', 'home.jpeg', 100, 10, 0, 0, 100, 0, NULL, 'Хомяк пушистый', 5),
(12, 'Хомяк 4', 'home.jpeg', 100, 10, 0, 0, 100, 0, NULL, 'Хомяк пушистый', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'Новый'),
(2, 'Сборка'),
(3, 'Отмена'),
(4, 'Готовый к выдаче');

-- --------------------------------------------------------

--
-- Структура таблицы `type_pay`
--

CREATE TABLE `type_pay` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `type_pay`
--

INSERT INTO `type_pay` (`id`, `title`) VALUES
(1, 'наличные'),
(2, 'Банковская карта'),
(3, 'По QR-коду'),
(4, 'Электронные деньги');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) DEFAULT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role_id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `phone`, `password`, `photo`, `created_at`, `role_id`, `auth_key`) VALUES
(5, 'user', 'user', '', 'user', 'u@u.u', '123', '$2y$13$xutU560xWlnY1zKgoiFdfuE6wCtdpXi0/0qjV5qf21kdZpZa3Lwia', NULL, '2024-10-12 10:39:09', 2, 'TUPTBjLJ2Un3uRhd7CyIsCppJJMDI43A'),
(6, 'йй', 'йй', '', 'q2', 'q2@q.q', '+7(999)-999-99-99', '$2y$13$a.Iqx/aK.O5cYpdO2qz1gOXOKOyulFOWpacnXyUatldcVO4FAHdVi', NULL, '2024-10-19 08:00:31', 2, 'K2s586xOLowB7z_-19SEl_W0vWvjyQrX'),
(7, 'админ', 'админ', '', 'admin', 'a@a.a', '+7(999)-999-99-99', '$2y$13$xutU560xWlnY1zKgoiFdfuE6wCtdpXi0/0qjV5qf21kdZpZa3Lwia', NULL, '2024-10-19 08:51:25', 1, 'x8TJjRltn7lM8F8SAkZBbFbFvv4iQa4t');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `status_id` (`status_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `type_pay_id` (`type_pay_id`),
  ADD KEY `outpost_id` (`outpost_id`);

--
-- Индексы таблицы `outpost`
--
ALTER TABLE `outpost`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `type_pay`
--
ALTER TABLE `type_pay`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_login` (`login`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `outpost`
--
ALTER TABLE `outpost`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `type_pay`
--
ALTER TABLE `type_pay`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`type_pay_id`) REFERENCES `type_pay` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_5` FOREIGN KEY (`outpost_id`) REFERENCES `outpost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
