-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Май 21 2016 г., 10:26
-- Версия сервера: 5.7.12-log
-- Версия PHP: 5.6.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `prorders`
--

-- --------------------------------------------------------

--
-- Структура таблицы `departaments`
--

CREATE TABLE `departaments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `departaments`
--

INSERT INTO `departaments` (`id`, `name`) VALUES
(1, 'Каркасный участок'),
(2, 'Поролоновый участок'),
(3, 'Поклеечный участок'),
(4, 'Раскроечный участок'),
(5, 'Швейный участок'),
(6, 'Обивочный участок');

-- --------------------------------------------------------

--
-- Структура таблицы `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `departamentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `employees`
--

INSERT INTO `employees` (`id`, `name`, `departamentId`) VALUES
(1, 'Павленко Н.', 1),
(2, 'Шахунов О.', 1),
(3, 'Хворостенко А.', 1),
(4, 'Шаповал Б.', 1),
(5, 'Горбенко А.', 1),
(6, 'Ефимов Е.', 2),
(7, 'Беседин В.', 2),
(8, 'Фидяев В.', 2),
(9, 'Беседин В.', 3),
(10, 'Фидяев В.', 3),
(11, 'Сухоруков В.', 4),
(12, 'Дуброва Н.', 5),
(13, 'Хаустова Е.', 5),
(14, 'Тимошенко Т.', 5),
(15, 'Булавин А.', 6),
(16, 'Гаврюшенко И.', 6),
(17, 'Стрельцов И.', 6),
(18, 'Цибенко Ю.', 6),
(19, 'Бондаренко Д.', 6),
(20, 'Калашник А.', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1463491767),
('m160517_080459_create_tables', 1463494867);

-- --------------------------------------------------------

--
-- Структура таблицы `operations`
--

CREATE TABLE `operations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `departamentId` int(11) NOT NULL,
  `defaultOp` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `operations`
--

INSERT INTO `operations` (`id`, `name`, `departamentId`, `defaultOp`) VALUES
(1, 'Каркас', 1, 1),
(2, 'Поролон', 2, 1),
(3, 'Поклейка', 3, 1),
(4, 'Поклейка доп', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `operationId` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `sum` decimal(15,2) NOT NULL,
  `executionDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `invoiceNo` varchar(255) NOT NULL,
  `beginDate` date NOT NULL,
  `endDate` date NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `price` decimal(15,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `code`, `price`) VALUES
(1, 'АДЕЛЬ ЛЕВЫЙ УГОЛ (7) (2500 х 1650 х 750)', '000007604', '9739.00');

-- --------------------------------------------------------

--
-- Структура таблицы `specifications`
--

CREATE TABLE `specifications` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `operationId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `rate` decimal(15,2) NOT NULL,
  `sequence` int(11) NOT NULL,
  `duration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `departaments`
--
ALTER TABLE `departaments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_departamentEmpl` (`departamentId`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `operations`
--
ALTER TABLE `operations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_departamentOper` (`departamentId`);

--
-- Индексы таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_orderDetailsOrder` (`orderId`),
  ADD KEY `FK_orderDetailsOper` (`operationId`),
  ADD KEY `FK_orderDetailsEmpl` (`employeeId`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ordersProd` (`productId`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `specifications`
--
ALTER TABLE `specifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_specificationsOper` (`operationId`),
  ADD KEY `FK_specificationsProd` (`productId`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `departaments`
--
ALTER TABLE `departaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT для таблицы `operations`
--
ALTER TABLE `operations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `specifications`
--
ALTER TABLE `specifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `FK_departamentEmpl` FOREIGN KEY (`departamentId`) REFERENCES `departaments` (`id`);

--
-- Ограничения внешнего ключа таблицы `operations`
--
ALTER TABLE `operations`
  ADD CONSTRAINT `FK_departamentOper` FOREIGN KEY (`departamentId`) REFERENCES `departaments` (`id`);

--
-- Ограничения внешнего ключа таблицы `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FK_orderDetailsEmpl` FOREIGN KEY (`employeeId`) REFERENCES `employees` (`id`),
  ADD CONSTRAINT `FK_orderDetailsOper` FOREIGN KEY (`operationId`) REFERENCES `operations` (`id`),
  ADD CONSTRAINT `FK_orderDetailsOrder` FOREIGN KEY (`orderId`) REFERENCES `orders` (`id`);

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_ordersProd` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

--
-- Ограничения внешнего ключа таблицы `specifications`
--
ALTER TABLE `specifications`
  ADD CONSTRAINT `FK_specificationsOper` FOREIGN KEY (`operationId`) REFERENCES `operations` (`id`),
  ADD CONSTRAINT `FK_specificationsProd` FOREIGN KEY (`productId`) REFERENCES `products` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
