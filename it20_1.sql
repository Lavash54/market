-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 07 2022 г., 14:57
-- Версия сервера: 8.0.24
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `it20_1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `all_photo`
--

CREATE TABLE `all_photo` (
  `product_id` int NOT NULL,
  `photo_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `all_photo`
--

INSERT INTO `all_photo` (`product_id`, `photo_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `category_name` varchar(100) NOT NULL,
  `category_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`) VALUES
(1, 'Рубашки', 'Рубашки'),
(2, 'Мужское', 'Для мужиков'),
(3, 'Женское', 'Непонятно что');

-- --------------------------------------------------------

--
-- Структура таблицы `photo`
--

CREATE TABLE `photo` (
  `photo_id` int NOT NULL,
  `alt_img` varchar(50) NOT NULL,
  `src_photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `photo`
--

INSERT INTO `photo` (`photo_id`, `alt_img`, `src_photo`) VALUES
(1, 'Рубашка medicine', '\\img\\1.png'),
(2, 'Рубашка medicine', '\\img\\2.png'),
(3, 'Рубашка medicine', '\\img\\3.png'),
(4, 'Рубашка medicine', '\\img\\4.png'),
(5, 'Футболка', '\\img\\11.png');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `product_price` int NOT NULL,
  `product_price_old` int DEFAULT NULL,
  `product_description` text NOT NULL,
  `photo_id` int NOT NULL,
  `promo_id` int DEFAULT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_count` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `product_price`, `product_price_old`, `product_description`, `photo_id`, `promo_id`, `product_name`, `product_count`) VALUES
(1, 1, 2499, 2699, 'Рубашка Medicine выполнена из вискозной ткани с клетчатым узором. Детали: прямой край, отложной воротник; планка и манжеты на пуговицах; карман на груди.', 1, 1, 'РУБАШКА MEDICINE', 10),
(2, 2, 1655, 651651, 'футболка', 5, 59, 'Футболка', 56156),
(3, 3, 5151, 15631356, 'платье', 3, 35, 'Платье', 531);

-- --------------------------------------------------------

--
-- Структура таблицы `promo`
--

CREATE TABLE `promo` (
  `promo_id` int NOT NULL,
  `category_id` int NOT NULL,
  `promo_sale` int NOT NULL,
  `promo_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `promo`
--

INSERT INTO `promo` (`promo_id`, `category_id`, `promo_sale`, `promo_name`) VALUES
(1, 1, 15, 'first');

-- --------------------------------------------------------

--
-- Структура таблицы `sub_category`
--

CREATE TABLE `sub_category` (
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `sc_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `sub_category`
--

INSERT INTO `sub_category` (`product_id`, `category_id`, `sc_id`) VALUES
(1, 1, 1),
(1, 2, 2),
(2, 2, 3),
(3, 3, 5);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Индексы таблицы `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photo_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Индексы таблицы `promo`
--
ALTER TABLE `promo`
  ADD PRIMARY KEY (`promo_id`);

--
-- Индексы таблицы `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sc_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `photo`
--
ALTER TABLE `photo`
  MODIFY `photo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `promo`
--
ALTER TABLE `promo`
  MODIFY `promo_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
