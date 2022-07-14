-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 14 juil. 2022 à 15:09
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `exam_system`
--

-- --------------------------------------------------------

--
-- Structure de la table `departement`
--

CREATE TABLE `departement` (
  `id_faculty` int(20) NOT NULL,
  `id_departement` int(20) NOT NULL,
  `name_departement` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `departement`
--

INSERT INTO `departement` (`id_faculty`, `id_departement`, `name_departement`) VALUES
(1, 1, 'Computer science'),
(1, 2, 'Mathematics'),
(3, 3, 'Chimistry'),
(3, 4, 'Physics');

-- --------------------------------------------------------

--
-- Structure de la table `exams`
--

CREATE TABLE `exams` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `exam_title` varchar(250) NOT NULL,
  `exam_datetime` datetime NOT NULL,
  `endtime` datetime NOT NULL DEFAULT current_timestamp(),
  `id_specility` int(50) NOT NULL DEFAULT 1,
  `duration` varchar(30) NOT NULL,
  `total_question` int(5) NOT NULL,
  `marks_per_right_answer` varchar(30) NOT NULL,
  `marks_per_wrong_answer` varchar(30) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` enum('Pending','Created','Started','Completed') NOT NULL,
  `exam_code` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exams`
--

INSERT INTO `exams` (`id`, `user_id`, `exam_title`, `exam_datetime`, `endtime`, `id_specility`, `duration`, `total_question`, `marks_per_right_answer`, `marks_per_wrong_answer`, `created_on`, `status`, `exam_code`) VALUES
(1, 1, 'PHP Test', '2022-01-20 23:31:07', '2022-02-26 03:09:00', 1, '1', 2, '1', '1', '2021-12-09 12:51:11', 'Created', ''),
(3, 1, 'JavaScript Test', '2021-12-25 15:03:00', '2022-07-30 14:37:00', 2, '2', 1, '1', '1', '2021-12-08 08:26:41', 'Created', ''),
(57, 1, 'first exams gla', '0000-00-00 00:00:00', '2022-02-13 18:16:00', 1, '1', 3, '5', '0.5', '2022-02-09 15:12:00', 'Created', ''),
(58, 1, 'math1', '0000-00-00 00:00:00', '2022-07-17 10:11:00', 2, '2', 2, '1', '0.5', '2022-02-10 10:57:21', 'Created', '');

-- --------------------------------------------------------

--
-- Structure de la table `exam_enroll`
--

CREATE TABLE `exam_enroll` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `exam_id` int(255) NOT NULL,
  `attendance_status` enum('Absent','Present') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam_enroll`
--

INSERT INTO `exam_enroll` (`id`, `user_id`, `exam_id`, `attendance_status`) VALUES
(42, 4, 1, 'Absent'),
(43, 4, 57, 'Absent'),
(44, 4, 57, 'Absent'),
(45, 47, 58, 'Absent'),
(46, 47, 58, 'Absent'),
(47, 3, 3, 'Absent'),
(48, 3, 3, 'Absent'),
(49, 3, 3, 'Absent'),
(50, 3, 58, 'Absent');

-- --------------------------------------------------------

--
-- Structure de la table `exam_option`
--

CREATE TABLE `exam_option` (
  `id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `option` int(2) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam_option`
--

INSERT INTO `exam_option` (`id`, `question_id`, `option`, `title`) VALUES
(157, 44, 1, '1'),
(158, 44, 2, '0'),
(159, 44, 3, 'null'),
(160, 44, 4, '$i'),
(161, 45, 1, 'c++'),
(162, 45, 2, 'python'),
(163, 45, 3, 'visual basic'),
(164, 45, 4, 'java'),
(165, 46, 1, '<js>'),
(166, 46, 2, '<script>'),
(167, 46, 3, '<p>'),
(168, 46, 4, '<head>'),
(177, 49, 1, 'a'),
(178, 49, 2, 'b'),
(179, 49, 3, 'c'),
(180, 49, 4, 'd'),
(181, 50, 1, 'b'),
(182, 50, 2, 'a'),
(183, 50, 3, 'c'),
(184, 50, 4, 'd'),
(185, 51, 1, 'a'),
(186, 51, 2, 'b'),
(187, 51, 3, 'c'),
(188, 51, 4, 'd'),
(189, 52, 1, '0'),
(190, 52, 2, '1'),
(191, 52, 3, '5'),
(192, 52, 4, '-5'),
(193, 53, 1, '81'),
(194, 53, 2, '73'),
(195, 53, 3, '90'),
(196, 53, 4, '9');

-- --------------------------------------------------------

--
-- Structure de la table `exam_process`
--

CREATE TABLE `exam_process` (
  `id` int(255) NOT NULL,
  `userid` int(255) NOT NULL,
  `examid` int(255) NOT NULL,
  `start_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `exam_process`
--

INSERT INTO `exam_process` (`id`, `userid`, `examid`, `start_time`) VALUES
(49, 4, 1, '2022-02-08 23:38:07'),
(50, 4, 57, '2022-02-09 15:16:03'),
(51, 47, 58, '2022-02-10 11:07:57'),
(52, 3, 3, '2022-07-14 15:01:35'),
(53, 3, 58, '2022-07-14 15:05:43');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question`
--

CREATE TABLE `exam_question` (
  `id` int(255) NOT NULL,
  `exam_id` int(255) NOT NULL,
  `question` text NOT NULL,
  `answer` enum('1','2','3','4') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam_question`
--

INSERT INTO `exam_question` (`id`, `exam_id`, `question`, `answer`) VALUES
(44, 1, 'what is the output of this code $i=1;  echo $i;', '1'),
(45, 1, 'what is closest language when it comes to syntax?', '2'),
(46, 3, 'html element we put in javascript code', '2'),
(49, 57, 'quelle est la reponse ', '1'),
(50, 57, 'quelee est la reponse de sqt 2', '2'),
(51, 57, 'quelle est la reponse 3', '1'),
(52, 58, '5-5+1', '2'),
(53, 58, '9*9=', '1');

-- --------------------------------------------------------

--
-- Structure de la table `exam_question_answer`
--

CREATE TABLE `exam_question_answer` (
  `id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `exam_id` int(255) NOT NULL,
  `question_id` int(255) NOT NULL,
  `user_answer_option` enum('0','1','2','3','4') NOT NULL,
  `marks` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `exam_question_answer`
--

INSERT INTO `exam_question_answer` (`id`, `user_id`, `exam_id`, `question_id`, `user_answer_option`, `marks`) VALUES
(141, 4, 1, 44, '1', '1'),
(142, 4, 1, 45, '3', '-1'),
(143, 4, 57, 49, '1', '5'),
(144, 4, 57, 50, '3', '0'),
(145, 4, 57, 51, '2', '0'),
(146, 47, 58, 52, '2', '1'),
(147, 47, 58, 53, '1', '1'),
(148, 3, 3, 46, '1', '-1'),
(149, 3, 58, 52, '2', '1'),
(150, 3, 58, 53, '1', '1');

-- --------------------------------------------------------

--
-- Structure de la table `faculty`
--

CREATE TABLE `faculty` (
  `id_faculty` int(20) NOT NULL,
  `name_faculty` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `faculty`
--

INSERT INTO `faculty` (`id_faculty`, `name_faculty`) VALUES
(1, 'Exact science'),
(2, 'Natural Science'),
(3, 'Technology  Science'),
(4, 'Langueges & Literature'),
(5, 'Commercials'),
(7, 'Humain Science');

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id_msg` int(50) NOT NULL,
  `sender_id` int(50) NOT NULL,
  `reciever_id` int(50) NOT NULL,
  `content` varchar(500) CHARACTER SET latin1 NOT NULL,
  `title` varchar(500) CHARACTER SET latin1 NOT NULL,
  `vue` int(2) NOT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`id_msg`, `sender_id`, `reciever_id`, `content`, `title`, `vue`, `datetime`) VALUES
(43, 9, 4, 'how are you', 'hello', 0, '2022-02-09 14:02:59'),
(45, 1, 47, 'zyri rohek', 'cv mala', 1, '2022-02-10 11:02:11');

-- --------------------------------------------------------

--
-- Structure de la table `specility`
--

CREATE TABLE `specility` (
  `id_departement` int(20) NOT NULL,
  `id_specility` int(20) NOT NULL,
  `name_specility` varchar(50) NOT NULL,
  `option_spec` enum('L1','L2','L3','M1','M2') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `specility`
--

INSERT INTO `specility` (`id_departement`, `id_specility`, `name_specility`, `option_spec`) VALUES
(1, 1, 'Computer engeneering', 'L1'),
(1, 2, 'Computer engeneering', 'L2'),
(1, 3, 'computer engeneering', 'L3'),
(1, 4, 'ISI', 'M1'),
(1, 5, 'ISI', 'M2'),
(1, 7, 'NDS', 'M2'),
(1, 8, 'SITW', 'M1'),
(1, 9, 'SITW', 'M2'),
(1, 11, 'machine learning', 'M1'),
(1, 12, 'machine learning', 'M2'),
(1, 13, 'Data science', 'M1'),
(2, 15, 'Mathematics', 'L1'),
(2, 16, 'Mathematics', 'L2'),
(2, 18, 'Geometrics & Application', 'M1'),
(2, 19, 'Geometrics & Applications', 'M2');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL,
  `id_student` int(50) NOT NULL,
  `id_spec1` int(50) NOT NULL,
  `id_spec2` int(50) NOT NULL,
  `id_spec3` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`id`, `id_student`, `id_spec1`, `id_spec2`, `id_spec3`) VALUES
(4, 1, 1, 7, 0),
(3, 2, 2, 0, 0),
(47, 15, 1, 5, 0);

-- --------------------------------------------------------

--
-- Structure de la table `teacher`
--

CREATE TABLE `teacher` (
  `id_teacher` int(50) NOT NULL,
  `id` int(50) NOT NULL,
  `id_spec1` int(50) NOT NULL,
  `id_spec2` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `teacher`
--

INSERT INTO `teacher` (`id_teacher`, `id`, `id_spec1`, `id_spec2`) VALUES
(1, 1, 1, 5),
(7, 47, 1, 5),
(9, 49, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(50) NOT NULL,
  `first_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `last_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `gender` enum('Male','Female') CHARACTER SET latin1 NOT NULL DEFAULT 'Male',
  `email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(64) CHARACTER SET latin1 NOT NULL,
  `mobile` varchar(12) CHARACTER SET latin1 NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `role` enum('admin','student','teacher','user') CHARACTER SET latin1 NOT NULL,
  `img_src` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT 'img/student.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `first_name`, `last_name`, `gender`, `email`, `password`, `mobile`, `address`, `created`, `role`, `img_src`) VALUES
(1, 'sidou', 'mohamed', 'Male', 'teacher@yahoo.com', '202cb962ac59075b964b07152d234b70', '5555555555', '08 rue mascara ville', '2021-12-20 16:23:32', 'teacher', '../../img/teacher_male.png'),
(3, 'abdelkader', 'ahmed', 'Male', 'student@yahoo.com', '202cb962ac59075b964b07152d234b70', '1234555789', 'aaaaaaa', '2020-11-28 22:45:58', 'student', 'img/male_avatar.svg'),
(4, 'emil', 'martin', 'Male', 'emil@yahoo.com', '202cb962ac59075b964b07152d234b70', '123456789', 'aaaaaaaaaaaaa', '2020-11-28 22:45:58', 'student', 'img/male_avatar.svg'),
(9, 'ADMIN', 'ADMIN', 'Male', 'admin@yahoo.com', '202cb962ac59075b964b07152d234b70', '05554488977', '', '2022-01-06 22:18:15', 'admin', 'img/setting.png'),
(47, 'noor ', 'el houda', 'Female', 'nour@yahoo.com', '202cb962ac59075b964b07152d234b70', '111111111111', 'aaaaaaaaaaa', '2022-02-09 15:08:23', 'student', 'img/female_avatar.svg'),
(49, 'mohamed', 'mohamed', 'Male', 'mohamed@yahoo.com', '123', '111111111111', 'aaaaaaaaaaa', '2022-02-09 15:08:56', 'teacher', 'img/male_avatar.svg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id_departement`),
  ADD KEY `id_faculty` (`id_faculty`);

--
-- Index pour la table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_specility` (`id_specility`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `exam_enroll`
--
ALTER TABLE `exam_enroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_enroll_ibfk_1` (`exam_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `exam_option`
--
ALTER TABLE `exam_option`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `exam_process`
--
ALTER TABLE `exam_process`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examid` (`examid`),
  ADD KEY `userid` (`userid`);

--
-- Index pour la table `exam_question`
--
ALTER TABLE `exam_question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`);

--
-- Index pour la table `exam_question_answer`
--
ALTER TABLE `exam_question_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `exam_id` (`exam_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Index pour la table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id_faculty`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id_msg`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `reciever_id` (`reciever_id`);

--
-- Index pour la table `specility`
--
ALTER TABLE `specility`
  ADD PRIMARY KEY (`id_specility`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id` (`id`),
  ADD KEY `student_ibfk_2` (`id_spec1`);

--
-- Index pour la table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id_teacher`),
  ADD KEY `id` (`id`),
  ADD KEY `id_spec1` (`id_spec1`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `departement`
--
ALTER TABLE `departement`
  MODIFY `id_departement` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT pour la table `exam_enroll`
--
ALTER TABLE `exam_enroll`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `exam_option`
--
ALTER TABLE `exam_option`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT pour la table `exam_process`
--
ALTER TABLE `exam_process`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `exam_question`
--
ALTER TABLE `exam_question`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT pour la table `exam_question_answer`
--
ALTER TABLE `exam_question_answer`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT pour la table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id_faculty` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id_msg` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `specility`
--
ALTER TABLE `specility`
  MODIFY `id_specility` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id_student` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT pour la table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id_teacher` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `departement`
--
ALTER TABLE `departement`
  ADD CONSTRAINT `departement_ibfk_1` FOREIGN KEY (`id_faculty`) REFERENCES `faculty` (`id_faculty`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exams`
--
ALTER TABLE `exams`
  ADD CONSTRAINT `exams_ibfk_1` FOREIGN KEY (`id_specility`) REFERENCES `specility` (`id_specility`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exams_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exam_enroll`
--
ALTER TABLE `exam_enroll`
  ADD CONSTRAINT `exam_enroll_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_enroll_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exam_option`
--
ALTER TABLE `exam_option`
  ADD CONSTRAINT `exam_option_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `exam_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exam_process`
--
ALTER TABLE `exam_process`
  ADD CONSTRAINT `exam_process_ibfk_1` FOREIGN KEY (`examid`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_process_ibfk_2` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exam_question`
--
ALTER TABLE `exam_question`
  ADD CONSTRAINT `exam_question_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `exam_question_answer`
--
ALTER TABLE `exam_question_answer`
  ADD CONSTRAINT `exam_question_answer_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `exam_question_answer_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `exam_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`reciever_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `specility`
--
ALTER TABLE `specility`
  ADD CONSTRAINT `specility_ibfk_1` FOREIGN KEY (`id_departement`) REFERENCES `departement` (`id_departement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`id_spec1`) REFERENCES `specility` (`id_specility`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`id_spec1`) REFERENCES `specility` (`id_specility`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
