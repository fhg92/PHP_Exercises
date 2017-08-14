-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 14 aug 2017 om 20:58
-- Serverversie: 10.1.22-MariaDB
-- PHP-versie: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Week_7`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gender`
--

CREATE TABLE `gender` (
  `gender_id` int(11) NOT NULL,
  `label` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gender`
--

INSERT INTO `gender` (`gender_id`, `label`) VALUES
(1, 'Female'),
(2, 'Male'),
(3, 'Agender'),
(4, 'Androgyne'),
(5, 'Androgynous'),
(6, 'Bigender'),
(7, 'Cis'),
(8, 'Cisgender'),
(9, 'Cis Female'),
(10, 'Cis Male'),
(11, 'Cis Man'),
(12, 'Cis Woman'),
(13, 'Cisgender Female'),
(14, 'Cisgender Male'),
(15, 'Cisgender Man'),
(16, 'Cisgender Woman'),
(17, 'Female to Male'),
(18, 'FTM'),
(19, 'Gender Fluid'),
(20, 'Gender Nonconfirming'),
(21, 'Gender Questioning'),
(22, 'Gender Variant'),
(23, 'Genderqueer'),
(24, 'Intersex'),
(25, 'Male to Female'),
(26, 'MTF'),
(27, 'Neither'),
(28, 'Neutrois'),
(29, 'Non-binary'),
(30, 'Other'),
(31, 'Pangender'),
(32, 'Trans'),
(33, 'Trans*'),
(34, 'Trans Female'),
(35, 'Trans* Female'),
(36, 'Trans Male'),
(37, 'Trans* Male'),
(38, 'Trans Man'),
(39, 'Trans* Man'),
(40, 'Trans Person'),
(41, 'Trans* Person'),
(42, 'Trans Woman'),
(43, 'Trans* Woman'),
(44, 'Transfeminine'),
(45, 'Transgender'),
(46, 'Transgender Female'),
(47, 'Transgender Male'),
(48, 'Transgender Man'),
(49, 'Transgender Person'),
(50, 'Transgender Woman'),
(51, 'Transmasculine'),
(52, 'Transsexual'),
(53, 'Transsexual Female'),
(54, 'Transsexual Male'),
(55, 'Transsexual Man'),
(56, 'Transsexual Person'),
(57, 'Transsexual Woman'),
(58, 'Two-Spirit');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `groups`
--

CREATE TABLE `groups` (
  `group_id` int(12) NOT NULL,
  `group_name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`) VALUES
(13, 'Assembly language'),
(3, 'C'),
(5, 'C#'),
(4, 'C++'),
(9, 'Delphi'),
(14, 'Go'),
(2, 'Java'),
(7, 'Javascript'),
(17, 'MATLAB'),
(19, 'Objective-C'),
(10, 'Perl'),
(1, 'PHP'),
(18, 'PL/SQL'),
(6, 'Python'),
(15, 'R'),
(11, 'Ruby'),
(20, 'Scratch'),
(12, 'Swift'),
(8, 'VB.NET'),
(16, 'Visual Basic');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `group_user`
--

CREATE TABLE `group_user` (
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `group_user`
--

INSERT INTO `group_user` (`group_id`, `user_id`, `status`) VALUES
(1, 5, 1),
(2, 2, 0),
(2, 4, 2),
(3, 2, 2),
(4, 1, 1),
(4, 9, 2),
(5, 2, 0),
(5, 3, 2),
(5, 7, 0),
(6, 4, 1),
(7, 1, 0),
(8, 4, 1),
(8, 7, 2),
(10, 2, 0),
(10, 4, 2),
(11, 3, 2),
(13, 1, 1),
(13, 2, 0),
(13, 4, 0),
(14, 2, 0),
(15, 4, 1),
(15, 5, 0),
(15, 9, 2),
(16, 10, 2),
(17, 5, 0),
(18, 10, 0),
(19, 4, 1),
(19, 8, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `relation`
--

CREATE TABLE `relation` (
  `user_one_id` int(11) NOT NULL,
  `user_two_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `relation`
--

INSERT INTO `relation` (`user_one_id`, `user_two_id`, `status`) VALUES
(1, 2, 0),
(1, 3, 0),
(2, 3, 1),
(2, 4, 1),
(3, 4, 0),
(3, 5, 0),
(4, 5, 1),
(4, 6, 1),
(5, 6, 0),
(5, 7, 0),
(6, 8, 1),
(7, 8, 1),
(7, 9, 0),
(8, 9, 0),
(9, 2, 1),
(9, 10, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`) VALUES
(1, 'travis@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(2, 'reed@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(3, 'carlos@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(4, 'fransesca@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(5, 'sonya@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(6, 'charles@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(7, 'lareina@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(8, 'tasha@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(9, 'moana@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.'),
(10, 'burton@example.com', '$2y$10$3ZfERV/uJSa/NVKBFeE4aO5uaPKWSGJ/19Wc.8/W.6TNbGoPsmnA.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user_personal`
--

CREATE TABLE `user_personal` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(35) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `city` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender_id` int(3) NOT NULL,
  `date_registered` date NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `user_personal`
--

INSERT INTO `user_personal` (`user_id`, `first_name`, `last_name`, `city`, `date_of_birth`, `gender_id`, `date_registered`, `last_login`) VALUES
(1, 'Travis', 'Abbott', 'Saint John', '1996-04-15', 2, '2017-08-05', '2017-08-14 16:00:29'),
(2, 'Reed', 'Luna', 'Stirling', '1981-10-20', 18, '2017-08-08', '2017-08-13 00:12:33'),
(3, 'Carlos', 'David', 'Velletri', '1962-01-03', 2, '2017-08-02', '2017-08-14 05:24:45'),
(4, 'Francesca', 'Gillespie', 'Cedar Rapids', '1981-12-29', 31, '2017-08-05', '2017-08-11 20:38:53'),
(5, 'Sonya', 'Whitehead', 'Milestone', '1964-08-18', 1, '2017-08-06', '2017-08-13 23:15:16'),
(6, 'Charles', 'Carroll', 'Pelago', '1997-12-11', 2, '2017-08-08', '2017-08-14 17:35:06'),
(7, 'Lareina', 'Mercado', 'Ghislarengo', '1982-12-25', 3, '2017-08-07', '2017-08-13 20:00:08'),
(8, 'Tasha', 'Benton', 'Fogliano Redipuglia', '1985-01-13', 1, '2017-08-03', '2017-08-12 17:41:24'),
(9, 'Moana', 'Garner', 'Lions Bay', '1966-12-27', 45, '2017-08-08', '2017-08-12 04:31:04'),
(10, 'Burton', 'Weaver', 'Carbonear', '1977-09-01', 2, '2017-08-06', '2017-08-12 06:36:45');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`gender_id`);

--
-- Indexen voor tabel `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexen voor tabel `group_user`
--
ALTER TABLE `group_user`
  ADD UNIQUE KEY `group_id` (`group_id`,`user_id`);

--
-- Indexen voor tabel `relation`
--
ALTER TABLE `relation`
  ADD UNIQUE KEY `unique_index` (`user_one_id`,`user_two_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`email`);

--
-- Indexen voor tabel `user_personal`
--
ALTER TABLE `user_personal`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gender`
--
ALTER TABLE `gender`
  MODIFY `gender_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT voor een tabel `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT voor een tabel `user_personal`
--
ALTER TABLE `user_personal`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
