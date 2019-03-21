-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 21 2019 г., 18:32
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
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'Активность записи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список перевозчиков';

--
-- Дамп данных таблицы `carriers`
--

INSERT INTO `carriers` VALUES(1, 'ОдессаТранс', 1);
INSERT INTO `carriers` VALUES(2, 'КиевТранс', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `days`
--

DROP TABLE IF EXISTS `days`;
CREATE TABLE `days` (
  `id` bigint(20) UNSIGNED NOT NULL COMMENT 'Первичный ключ',
  `id_schedule` bigint(20) UNSIGNED NOT NULL COMMENT 'Расписание',
  `day_of_week` int(11) NOT NULL COMMENT 'День недели'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список станций';

--
-- Дамп данных таблицы `days`
--

INSERT INTO `days` VALUES(2, 1, 2);
INSERT INTO `days` VALUES(3, 1, 3);
INSERT INTO `days` VALUES(4, 1, 4);
INSERT INTO `days` VALUES(5, 1, 5);
INSERT INTO `days` VALUES(6, 1, 6);
INSERT INTO `days` VALUES(7, 1, 7);
INSERT INTO `days` VALUES(8, 2, 3);

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
  `start_time` time NOT NULL COMMENT 'Время отправления',
  `end_time` time NOT NULL COMMENT 'Время прибытия',
  `price` float NOT NULL COMMENT 'Цена проезда'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Расписание';

--
-- Дамп данных таблицы `schedules`
--

INSERT INTO `schedules` VALUES(1, 1, 2, 1, '13:12:00', '12:23:00', 11111);
INSERT INTO `schedules` VALUES(2, 3, 1, 2, '23:12:00', '12:23:00', 111);

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
-- Дамп данных таблицы `stations`
--

INSERT INTO `stations` VALUES(1, 'Киев', 1);
INSERT INTO `stations` VALUES(2, 'Одесса', 1);
INSERT INTO `stations` VALUES(3, 'Москва', 1);

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
-- Индексы таблицы `days`
--
ALTER TABLE `days`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `start_station_id` (`id_schedule`) USING BTREE;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `days`
--
ALTER TABLE `days`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `stations`
--
ALTER TABLE `stations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Первичный ключ', AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `days`
--
ALTER TABLE `days`
  ADD CONSTRAINT `days_schedules_FK` FOREIGN KEY (`id_schedule`) REFERENCES `schedules` (`id`);

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
