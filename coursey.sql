-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Ноя 08 2014 г., 17:19
-- Версия сервера: 5.5.25
-- Версия PHP: 5.4.34

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `attachment`
--

INSERT INTO `attachment` (`id`, `name`, `resource`, `idLesson`) VALUES
(1, 'Фото', 'files/7678_user-green.png', 1),
(2, 'Logo', 'files/1728_6X5J0y1LE58.jpg', 2),
(3, 'Фото', 'files/7678_user-green.png', 6),
(4, 'Фото', 'files/7678_user-green.png', 6),
(5, 'Фото', 'files/7678_user-green.png', 6),
(6, 'Фото', 'files/7678_user-green.png', 6),
(7, 'Фото', 'files/7678_user-green.png', 6),
(9, 'Logo', 'files/1728_6X5J0y1LE58.jpg', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf32 NOT NULL,
  `description` text CHARACTER SET utf32 NOT NULL,
  `image` varchar(255) CHARACTER SET utf32 NOT NULL,
  `idLecturer` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idLecturer` (`idLecturer`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `image`, `idLecturer`, `published`) VALUES
(1, 'Новый очень интересный курс', 'Целью этого курса является снабжение консультирующих профессионалов знаниями, навыками и умениями для достижения возможности проектирования решений, разработки виртуальной инфраструктуры VMware vSphere 569', '', 1, 1),
(2, 'ОЧЕНЬ ВАЖНЫЙ КУРС! НЕ МОГУ ВЫКЛЮЧИТЬ КАПС', 'ПОМОГИТЕ!', '', 2, 0),
(3, 'Все в порядке, я разобрался', 'Уже не нужно помогать\r\nКак будто вы смогли бы что-то сделать', '', 2, 0),
(4, 'Мой курс', 'Данный курс разработан в целях обучения основным принципам программирования с помощью Revit API, представленного в программных продуктах Autodesk Revit Architecture, Autodesk Revit Structure и Autodesk Revit MEP.', '', 1, 1),
(9, 'Курс по поеданию творжных запеканок', 'В рамках данного курса слушатели научатся поедать творожные запеканки всех форм и размеров.', '', 1, 1),
(11, 'Тестовый курс', 'Тестовое описание. Всего лишь набор слов, объединенных в предложения. Чтение этого описания только отнимает у вас время.', '', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Безопасность информационно-комуникационных систем зимой'),
(5, 'Радиотехника и сливовые пироги'),
(6, 'Программная инженерия и разведение страусов'),
(7, 'Прикладная математика и декоративное садоводство'),
(8, 'Искусственный интеллект и бисероплетение'),
(9, 'Телекоммуникационные системы и коллекционирование марок');

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
(1, 'ПИ-12-2');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `lecturer`
--

INSERT INTO `lecturer` (`id`, `active`, `name`, `email`, `passHash`, `idDepartment`, `degree`) VALUES
(1, 1, 'Николай Степанцев', 'lecturer@example.com', 'b06febcfbc00db4f67aed9234e3e52b0', 5, 'Кандидат наук'),
(2, 1, 'Николай Деревянко', 'lect@example.com', 'b06febcfbc00db4f67aed9234e3e52b0', 5, 'Доктор наук');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `lesson`
--

INSERT INTO `lesson` (`id`, `idCourse`, `name`, `description`, `published`, `lessonNumber`) VALUES
(1, 2, 'Урок', 'Описание', 1, 1),
(2, 2, 'Урок', 'aaaaa', 1, 1),
(6, 1, 'Вводная лекция (вторая версия)', 'Текст. Обычный текст. Ну, не совсем обычный. Это описание лекции.', 1, 1),
(8, 9, 'Введение. Почему я люблю творог?', 'Общая информация.', 1, 1),
(10, 9, 'Сложная запеканочная структура', 'Описание строения запеканки как кулинарного шедевра.', 1, 2),
(12, 1, 'Вводная лекция. Продолжение.', 'Окончание описания общей структуры', 1, 2),
(13, 1, 'Основы построения', 'Начало анализа.', 0, 3),
(14, 11, 'Лекция 1', 'Лекция', 1, 1),
(15, 11, 'sfsd', 'fsdfsdfsdf', 1, 2),
(16, 9, 'Картофельная запеканка - миф или реальность?', '<b>Картофельная запеканка - общие принципы и способы приготовления</b>\r\n\r\nЛюбая национальная кухня имеет в арсенале сытные, экономичные и простые запеканки – сладкие, соленые, острые. В их основе могут быть макаронные изделия, крупы и конечно, картофель. Достоинств запеканок не перечесть: доступные продукты, быстрое приготовление, несложные рецепты. Картофельные запеканки к тому же очень разнообразны - в основе может лежать отварной или сырой картофель, пюре.\r\n\r\nНейтральный вкус картофеля позволяет сочетать его с любым мясом, грибами, печенью, овощами, молочными продуктами. Запеканки можно готовить сытные или калорийные, постные или мясные и жирные – угодить можно любому человеку. Балуйте домашних хоть каждый день, заменяя один наполнитель другим и подбирая приправы. Достаточно выложить продукты в сковороду или форму и отправить в духовку – и через некоторое времени ароматное и вкусно блюдо с румяной корочкой можно подавать к столу.\r\n\r\n<b>Картофельная запеканка - подготовка продуктов</b>\r\n\r\nУ картофельной запеканки есть одно прекрасное свойство – можно использовать остатки продуктов, и тем самым экономить. Например, если остается отварной картофель или пюре, запеканка – это настоящее спасение. Начинку сварить и обжарить также можно заранее. Мясной фарш или грибы, тушеная капуста, ветчина, кусочки куриной грудки – выбор просто огромен. Между двумя слоями картофеля уложить начинку, и смазать сверху сметаной для образования румяной корочки – этого достаточно, чтобы получить красивое и вкусное блюдо.\r\n\r\nОтварной картофель также нарезается слоями, между которыми располагается начинка. Блюдо должно держаться целой формой, поэтому чтобы оно не рассыпалось, используется заливка из яиц, смешанных со сливками и сметаной. Сырой картофель натирается на терке или выкладывается тонкими пластинками. Дополнительный пикантный вкус и возможность сохранить форму придает тертый сыр, однако можно его и не использовать, если вы хотите получить менее калорийное блюдо.\r\n\r\n<b>Картофельная запеканка - полезные советы опытных кулинаров</b>\r\n\r\nКартофельную запеканку можно облагородить пряностями. Подбирать их нужно в зависимости от вида начинки. Прекрасное дополнение к основе - зеленый лук, чеснок, тмин, мускатный орех, перец. Готовые приправы для овощей и картофеля продаются в любом гастрономе, однако содержание консервантов и усилителей вкуса делают эти приправы стандартными.\r\n\r\nСоставить букет пряностей самостоятельно гораздо интереснее. Так блюдо никогда не приедается, имеет немного другой вкус. В мясную запеканку можно добавлять имбирь, майоран, тимьян. Восточный колорит придают кориандр и куркума, Францию напоминает смесь прованских трав. Итальянцы не мыслят свой стол без базилика и орегано. Ну, а на русский вкус - укроп, петрушка, лук. Создайте свой вкус картофельной запеканки, и пусть ваше блюдо будет вкусным!\r\n\r\n<b>Немного о картофеле</b>\r\n\r\n2008 год ООН объявила Международным годом картофеля. Эксперты считают и сегодня, что эта высокоурожайная культура – продукт будущего. Именно картофель помог прекратить в Европе эпидемии цинги. Главной причиной заболевания является дефицит витамина С. При систематическом употреблении блюд из картошки, организм в полной мере насыщается не только витаминами С и крахмалом, но и еще огромным количеством органических и неорганических соединений.', 1, 3),
(17, 4, 'New lection', '123', 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `idLesson`, `text`, `answer`) VALUES
(1, 8, 'Какие приборы используются для компенсации потерь при передаче сигналов на большие расстояния?', 'Усилители'),
(2, 8, 'Как можно управлять током в цепи анода в электровакуумном триоде? ', 'Меняя напряжение в сетке'),
(3, 8, 'Как называется усилитель, предназначенный для обеспечения заданной мощности нагрузки при заданном сопротивлении нагрузки? ', 'Усилитель мощности'),
(5, 8, 'Почему вы любите запеканки?', 'Запеканки - моя жизнь, жить без них не могу'),
(7, 16, 'Можно ли есть картофельную запеканку на завтрак?', 'Категорически - нет.'),
(8, 16, 'Необходима ли картошка для приготовления классической запеканки?', 'Нет.'),
(9, 16, 'Можно ли использовать мясо в картофельной запеканке?', 'Да, в исключительных случаях.'),
(10, 16, 'Можно ли использовать сметану для смазки слоев?', 'Да, можно.');

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

--
-- Дамп данных таблицы `result`
--

INSERT INTO `result` (`idStudent`, `idLesson`, `points`, `passed`, `tryNumber`, `approved`) VALUES
(3, 8, 90, 1, 2, 1),
(3, 10, 80, 1, 1, 1),
(3, 16, 100, 1, 1, 1),
(4, 16, 75, 1, 2, 1),
(5, 8, 75, 1, 2, 1),
(5, 10, 60, 1, 3, 1);

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
(3, 'Иван Сергеенко', 'john@example.com', 'cd73502828457d15655bbd7a63fb0bc8', 1, 1),
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

--
-- Дамп данных таблицы `studentanswer`
--

INSERT INTO `studentanswer` (`idQuestion`, `idStudent`, `answer`) VALUES
(1, 3, 'Ответ'),
(2, 3, '123'),
(3, 3, 'Ответ'),
(5, 3, 'Потому что это моя жизнь');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `subscription`
--

INSERT INTO `subscription` (`id`, `idCourse`, `idStudent`, `active`) VALUES
(1, 9, 3, 1),
(2, 11, 3, 1),
(5, 1, 3, 0),
(6, 4, 3, 0),
(7, 9, 5, 1),
(8, 11, 5, 1),
(9, 9, 4, 1),
(10, 4, 4, 1);

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
