-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 20 2019 г., 16:22
-- Версия сервера: 10.1.37-MariaDB
-- Версия PHP: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test.lc`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carriers`
--

DROP TABLE IF EXISTS `carriers`;
CREATE TABLE `carriers` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Первичный ключ',
  `name` varchar(200) NOT NULL COMMENT 'Имя перевозчика',
  `active` int(11) NOT NULL DEFAULT '1' COMMENT 'Активность записи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список перевозчиков';

--
-- Очистить таблицу перед добавлением данных `carriers`
--

TRUNCATE TABLE `carriers`;
-- --------------------------------------------------------

--
-- Структура таблицы `schedules`
--

DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Первичный ключ',
  `start_station_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Станция отправления',
  `end_station_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Станция прибытия',
  `carrier_id` bigint(20) UNSIGNED NOT NULL COMMENT 'Перевозчик',
  `start_time` datetime NOT NULL COMMENT 'Время отправления',
  `end_time` datetime NOT NULL COMMENT 'Время прибытия',
  `price` float NOT NULL COMMENT 'Цена проезда',
  `days` int(11) NOT NULL COMMENT 'График движения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Расписание';

--
-- Очистить таблицу перед добавлением данных `schedules`
--

TRUNCATE TABLE `schedules`;
-- --------------------------------------------------------

--
-- Структура таблицы `stations`
--

DROP TABLE IF EXISTS `stations`;
CREATE TABLE `stations` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Первичный ключ',
  `name` varchar(200) DEFAULT NULL COMMENT 'Имя станции',
  `active` int(11) DEFAULT '1' COMMENT 'Активность записи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список станций';

--
-- Очистить таблицу перед добавлением данных `stations`
--

TRUNCATE TABLE `stations`;
--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carriers`
--
ALTER TABLE `carriers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `start_station_id` (`start_station_id`),
  ADD KEY `carrier_id` (`carrier_id`),
  ADD KEY `schedules_end_station_id_IDX` (`end_station_id`) USING BTREE;

--
-- Индексы таблицы `stations`
--
ALTER TABLE `stations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carriers`
--
ALTER TABLE `carriers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ';

--
-- AUTO_INCREMENT для таблицы `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ';

--
-- AUTO_INCREMENT для таблицы `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ';

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_carriers_FK` FOREIGN KEY (`carrier_id`) REFERENCES `carriers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_stations_FK` FOREIGN KEY (`start_station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_stations_FK_1` FOREIGN KEY (`end_station_id`) REFERENCES `stations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
