-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 09 2024 г., 18:25
-- Версия сервера: 8.0.30
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `kanban`
--

-- --------------------------------------------------------

--
-- Структура таблицы `card`
--

CREATE TABLE `card` (
  `id` int NOT NULL,
  `card_head` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `card`
--

INSERT INTO `card` (`id`, `card_head`) VALUES
(1, 'Задачи'),
(19, 'Анализ'),
(20, 'Дизайн'),
(21, 'Разработка'),
(22, 'Тестирование'),
(23, 'Завершено');

-- --------------------------------------------------------

--
-- Структура таблицы `importance`
--

CREATE TABLE `importance` (
  `id` int NOT NULL,
  `importance` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `importance`
--

INSERT INTO `importance` (`id`, `importance`, `color`) VALUES
(1, 'Супер-Важно', '#FFC300'),
(2, 'Важно', '#FF7624'),
(3, 'Обычно', '#56B87A');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int NOT NULL,
  `rol` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `rol`) VALUES
(1, 'Пользователь'),
(3, 'Админ');

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int NOT NULL,
  `task_from` int NOT NULL,
  `task_head` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `task_body` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `id_card` int DEFAULT NULL,
  `id_importance` int DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `responsible` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `task_from`, `task_head`, `task_body`, `id_card`, `id_importance`, `deadline`, `responsible`) VALUES
(167, 2, 'Проект', 'Составить паспорт проекта', 23, 2, '2025-05-30', 2),
(168, 2, 'Проект', 'Составить блок схему алгоритма пикселизации', 21, 3, '2025-11-25', 3),
(176, 2, 'Проект', 'Анализ рынка потенциальных потребителей', 19, 2, '2024-06-02', 3),
(177, 2, 'Проект', 'Составить макет дизайна главного окна нового приложения', 20, 3, '2024-06-02', 2),
(178, 2, 'Учеба', 'Завершить работу над собственной оболочкой для OC Linux', 21, 1, '2024-06-30', 1),
(179, 2, 'Учеба', 'Найти 5 конкурентов для анализа рынка с помощью метода tam sam som', 19, 2, '2024-06-25', 1),
(180, 2, 'Проект', 'Получить отзыв о новом сайте от тестировщиков в виде excel отчета', 22, 3, '2024-06-21', 2),
(181, 2, 'Учеба', 'Разработать приложение для налоговой службы', 21, 1, '2024-06-15', 2),
(185, 1, 'Проект!', 'Подготовить отчет за месяц', 1, 2, '1412-04-12', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `login` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `role` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `login`, `pass`, `role`) VALUES
(1, 'Alex', '8d45bfb0f03e64f7a6751e6a18788cfa', 1),
(2, 'MikhailOoO', '8d45bfb0f03e64f7a6751e6a18788cfa', 3),
(3, 'Knight_Oleg', '8d45bfb0f03e64f7a6751e6a18788cfa', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `importance`
--
ALTER TABLE `importance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_from` (`task_from`),
  ADD KEY `id_card` (`id_card`),
  ADD KEY `id_importance` (`id_importance`),
  ADD KEY `responsible` (`responsible`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role` (`role`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `card`
--
ALTER TABLE `card`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `importance`
--
ALTER TABLE `importance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`task_from`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_2` FOREIGN KEY (`id_card`) REFERENCES `card` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`id_importance`) REFERENCES `importance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_4` FOREIGN KEY (`responsible`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
