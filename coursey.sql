-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Окт 13 2014 г., 19:21
-- Версия сервера: 5.6.15-log
-- Версия PHP: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `coursey`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `passHash` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `admin`
--

INSERT INTO `admin` (`id`, `email`, `passHash`, `name`) VALUES
(1, 'admin@example.com', '21232f297a57a5a743894a0e4a801fc3', 'Admin Awesome');

-- --------------------------------------------------------

--
-- Структура таблицы `attachment`
--

CREATE TABLE IF NOT EXISTS `attachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  `resource` text CHARACTER SET utf32 NOT NULL,
  `idLesson` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLesson` (`idLesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `idLecturer` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLecturer` (`idLecturer`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Department1'),
(5, 'Department2');

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(1, 'Group 1');

-- --------------------------------------------------------

--
-- Структура таблицы `lecturer`
--

CREATE TABLE IF NOT EXISTS `lecturer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `active` tinyint(1) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `email` varchar(255) CHARACTER SET utf32 NOT NULL,
  `passHash` varchar(255) CHARACTER SET utf32 NOT NULL,
  `idDepartment` int(11) NOT NULL,
  `degree` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idDepartment` (`idDepartment`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `lecturer`
--

INSERT INTO `lecturer` (`id`, `active`, `name`, `email`, `passHash`, `idDepartment`, `degree`) VALUES
(1, 1, 'Lecturer1', 'lecturer@example.com', '21161a38ef6b4998cb719ffddb3e226b', 1, 'Bachelor');

-- --------------------------------------------------------

--
-- Структура таблицы `lesson`
--

CREATE TABLE IF NOT EXISTS `lesson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCourse` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `published` tinyint(1) NOT NULL,
  `lessonNumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCourse` (`idCourse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idLesson` int(11) NOT NULL,
  `text` varchar(255) CHARACTER SET utf32 NOT NULL,
  `answer` varchar(255) CHARACTER SET utf32 NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLesson` (`idLesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `idStudent` int(11) NOT NULL,
  `idLesson` int(11) NOT NULL,
  `points` int(3) DEFAULT NULL,
  `passed` tinyint(1) DEFAULT NULL,
  `tryNumber` int(11) NOT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idStudent`,`idLesson`),
  KEY `idLesson` (`idLesson`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `email` varchar(255) CHARACTER SET utf32 NOT NULL,
  `passHash` varchar(255) CHARACTER SET utf32 NOT NULL,
  `idGroup` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idGroup` (`idGroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`id`, `name`, `email`, `passHash`, `idGroup`, `active`) VALUES
(2, 'Regular Student', 'student@example.com', 'af37d08ae228a87dc6b265fd1019c97d', 1, 1),
(3, 'John Doe', 'john@example.com', 'cd73502828457d15655bbd7a63fb0bc8', 1, 1),
(4, 'Sarah Konnor', 'sarah@example.com', 'cd73502828457d15655bbd7a63fb0bc8', 1, 1),
(5, 'Dude Lebowski', 'dude@example.com', 'cd73502828457d15655bbd7a63fb0bc8', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `studentanswer`
--

CREATE TABLE IF NOT EXISTS `studentanswer` (
  `idQuestion` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `answer` varchar(255) CHARACTER SET utf32 DEFAULT NULL,
  PRIMARY KEY (`idQuestion`,`idStudent`),
  KEY `StudentAnswer_fk2` (`idStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCourse` int(11) NOT NULL,
  `idStudent` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idCourse` (`idCourse`),
  KEY `idStudent` (`idStudent`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attachment`
--
ALTER TABLE `attachment`
  ADD CONSTRAINT `attachment_ibfk_1` FOREIGN KEY (`idLesson`) REFERENCES `lesson` (`id`);

--
-- Ограничения внешнего ключа таблицы `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`idLecturer`) REFERENCES `lecturer` (`id`);

--
-- Ограничения внешнего ключа таблицы `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `lecturer_ibfk_1` FOREIGN KEY (`idDepartment`) REFERENCES `department` (`id`);

--
-- Ограничения внешнего ключа таблицы `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `lesson_ibfk_1` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`);

--
-- Ограничения внешнего ключа таблицы `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`idLesson`) REFERENCES `lesson` (`id`);

--
-- Ограничения внешнего ключа таблицы `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`idStudent`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`idLesson`) REFERENCES `lesson` (`id`);

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`idGroup`) REFERENCES `group` (`id`);

--
-- Ограничения внешнего ключа таблицы `studentanswer`
--
ALTER TABLE `studentanswer`
  ADD CONSTRAINT `StudentAnswer_fk1` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`id`),
  ADD CONSTRAINT `StudentAnswer_fk2` FOREIGN KEY (`idStudent`) REFERENCES `student` (`id`);

--
-- Ограничения внешнего ключа таблицы `subscription`
--
ALTER TABLE `subscription`
  ADD CONSTRAINT `subscription_ibfk_1` FOREIGN KEY (`idCourse`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `subscription_ibfk_2` FOREIGN KEY (`idStudent`) REFERENCES `student` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
