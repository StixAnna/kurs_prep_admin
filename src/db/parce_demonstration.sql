-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               8.0.35 - MySQL Community Server - GPL
-- Операционная система:         Win64
-- HeidiSQL Версия:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Дамп структуры для таблица test.grouppa
DROP TABLE IF EXISTS `grouppa`;
CREATE TABLE IF NOT EXISTS `grouppa` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test.grouppa: ~3 rows (приблизительно)
REPLACE INTO `grouppa` (`id`, `grname`) VALUES
	(1, '1.a07m'),
	(2, '2.a08n'),
	(3, '3.a09z');

-- Дамп структуры для таблица test.student
DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id_student` int NOT NULL AUTO_INCREMENT,
  `id_group` int NOT NULL,
  `num_in_grp` int DEFAULT NULL,
  `stname` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_student`),
  KEY `id_group` (`id_group`),
  CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `grouppa` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='wq';

-- Дамп данных таблицы test.student: ~9 rows (приблизительно)
REPLACE INTO `student` (`id_student`, `id_group`, `num_in_grp`, `stname`) VALUES
	(1, 1, 1, 'Petrov'),
	(2, 1, 2, 'Ivanov'),
	(3, 1, 3, 'Skala'),
	(4, 2, 1, 'Johnson'),
	(5, 3, 1, 'Abobix'),
	(6, 3, 2, 'Nurlan'),
	(7, 3, 3, 'Drugsunduk'),
	(8, 1, 4, 'Stixanna'),
	(9, 3, 4, 'Petya');

-- Дамп структуры для таблица test.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Дамп данных таблицы test.users: ~4 rows (приблизительно)
REPLACE INTO `users` (`id`, `name`, `email`, `avatar`, `password`, `admin`) VALUES
	(1, 'administrator', 'sobnaka@mail.ru', 'uploads/avatar_1703675963.jpg', '$2y$10$gyoZ9HsJNIXcAlcGXyHLUOA5u7vhKhU/ZM/.VZ5o8hx3ULRzBavQm', 1),
	(5, 'vasya', 'sss@sss.ru', 'uploads/avatar_1703695597.jpg', '$2y$10$GybokoZSHRiWEnd3YtND6OcxaVhXpZu/30Gx4PLkgtut34MJWBEG.', 0),
	(6, 'petya', 'ssssss@sss.ru', 'uploads/avatar_1703695807.jpg', '$2y$10$YvMxQ3ea.cQYXej7pAw8GudzpH50Si9JUUtWurcNLLVurZgVX2HT2', 0),
	(7, '123', '123@123.ru', 'uploads/avatar_1703850829.jpg', '$2y$10$97SQ8oh4w7pv0Nv8uPLsw.94/09135SPx/ly4oeagO.1JRYgKTo.G', 0);

-- Дамп структуры для таблица test.zadania
DROP TABLE IF EXISTS `zadania`;
CREATE TABLE IF NOT EXISTS `zadania` (
  `id_zadaniya` int NOT NULL AUTO_INCREMENT,
  `zadlevel` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `zadanie` varchar(1024) DEFAULT NULL,
  `zadShortDescr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `predmName` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_zadaniya`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test.zadania: ~12 rows (приблизительно)
REPLACE INTO `zadania` (`id_zadaniya`, `zadlevel`, `zadanie`, `zadShortDescr`, `predmName`) VALUES
	(1, 'Сверхразум', 'quest1quest1quest1quest1', 'Посчитать много всячины', 'Математика'),
	(2, 'Человек', 'quest1quest1quest1quest1', 'Посчитать всячины', 'Математика'),
	(3, 'Глупец', 'quest1quest1quest1quest1', 'Посчитать чуть-чуть всячины', 'Математика'),
	(4, 'Сверхразум', 'quest2quest2quest2quest2', 'Написать программу на C', 'Информатика'),
	(5, 'Человек', 'quest2quest2quest2quest2', 'Написать программу на C#', 'Информатика'),
	(6, 'Глупец', 'quest2quest2quest2quest2', 'Написать программу на Python', 'Информатика'),
	(7, 'Сверхразум', 'quest3quest3quest3quest3', 'Сделать сложную деталь', 'Труд'),
	(8, 'Человек', 'quest3quest3quest3quest3', 'Сделать деталь', 'Труд'),
	(9, 'Глупец', 'quest3quest3quest3quest3', 'Заточить резец', 'Труд'),
	(10, 'notchosen', NULL, NULL, 'Математика'),
	(11, 'notchosen', NULL, NULL, 'Информатика'),
	(12, 'notchosen', NULL, NULL, 'Труд');

-- Дамп структуры для таблица test.zadania_link_to_student
DROP TABLE IF EXISTS `zadania_link_to_student`;
CREATE TABLE IF NOT EXISTS `zadania_link_to_student` (
  `linkId` int NOT NULL AUTO_INCREMENT,
  `id_student` int NOT NULL,
  `id_zadania` int DEFAULT NULL,
  PRIMARY KEY (`linkId`),
  KEY `st_id_student` (`id_student`) USING BTREE,
  KEY `zadania_id_zadania` (`id_zadania`) USING BTREE,
  CONSTRAINT `zadania_link_to_student_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`id_student`),
  CONSTRAINT `zadania_link_to_student_ibfk_2` FOREIGN KEY (`id_zadania`) REFERENCES `zadania` (`id_zadaniya`)
) ENGINE=InnoDB AUTO_INCREMENT=131 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Дамп данных таблицы test.zadania_link_to_student: ~19 rows (приблизительно)
REPLACE INTO `zadania_link_to_student` (`linkId`, `id_student`, `id_zadania`) VALUES
	(104, 1, 4),
	(105, 2, 4),
	(106, 3, 4),
	(107, 1, 1),
	(108, 2, 1),
	(109, 3, 1),
	(110, 4, 8),
	(115, 5, 1),
	(116, 6, 1),
	(117, 7, 1),
	(118, 8, 1),
	(123, 5, 10),
	(124, 6, 10),
	(125, 7, 10),
	(126, 8, 4),
	(127, 1, 6),
	(128, 2, 6),
	(129, 3, 6),
	(130, 8, 6);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
