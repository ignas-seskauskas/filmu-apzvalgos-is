-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 02:22 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktorius`
--

CREATE TABLE `aktorius` (
  `vardas` varchar(255) NOT NULL,
  `pavarde` varchar(255) NOT NULL,
  `gimimo_metai` int(11) NOT NULL,
  `id_Aktorius` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `apsilankymas`
--

CREATE TABLE `apsilankymas` (
  `ip` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `id_Apsilankymas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `channel`
--

CREATE TABLE `channel` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `max_users` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `last_active_time` datetime NOT NULL,
  `creator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `channel`
--

INSERT INTO `channel` (`id`, `name`, `description`, `max_users`, `create_time`, `last_active_time`, `creator`) VALUES
(4, 'Test', 'Test', 3, '2022-12-13 22:14:54', '2022-12-13 22:14:54', 3),
(5, 'Test2', 'asd', 5, '2022-12-13 22:21:26', '2022-12-13 22:21:26', 3);

-- --------------------------------------------------------

--
-- Table structure for table `channel_blocking`
--

CREATE TABLE `channel_blocking` (
  `length_min` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `user_blocker` int(11) NOT NULL,
  `user_blocked` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `channel_message`
--

CREATE TABLE `channel_message` (
  `id` int(11) NOT NULL,
  `send_time` datetime NOT NULL,
  `text` text NOT NULL,
  `channel` int(11) NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dizaino_tema`
--

CREATE TABLE `dizaino_tema` (
  `fono_spalva` varchar(255) NOT NULL,
  `teksto_spalva` varchar(255) NOT NULL,
  `antrastes_spalva` varchar(255) NOT NULL,
  `porastes_spalva` varchar(255) NOT NULL,
  `pagrindine_spalva` varchar(255) NOT NULL,
  `antraeile_spalva` varchar(255) NOT NULL,
  `pavadinimas` varchar(255) NOT NULL,
  `srifto_dydis` int(11) NOT NULL,
  `sekmes_spalva` varchar(255) NOT NULL,
  `klaidos_spalva` varchar(255) NOT NULL,
  `id_Dizaino_tema` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filmas`
--

CREATE TABLE `filmas` (
  `pavadinimas` varchar(255) NOT NULL,
  `metai` int(11) NOT NULL,
  `rezisierius` varchar(255) NOT NULL,
  `trukme` int(11) NOT NULL,
  `siuzetas` varchar(255) NOT NULL,
  `rasytojas` varchar(255) NOT NULL,
  `ivertinimas` int(11) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `filmas`
--

INSERT INTO `filmas` (`pavadinimas`, `metai`, `rezisierius`, `trukme`, `siuzetas`, `rasytojas`, `ivertinimas`, `id`) VALUES
('Van Helsing', 2004, 'Stephen Sommers', 191, 'The famed monster hunter is sent to Transylvania to stop Count Dracula, who is using Dr. Frankenstein\'s research and a werewolf for nefarious purposes.', 'Stephen Sommers', 6, 1),
('Perfect Blue', 1997, 'Satoshi Kon', 120, 'Test', 'Sadayuki Murai', 6, 2),
('TTest', 2004, 'testt', 200, 'testt', 'test', 2, 3),
('tetstet', 2222, 'testtsets', 232, 'testtsett', 'testsetset', 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `filmo_zanras`
--

CREATE TABLE `filmo_zanras` (
  `zanras` enum('Siaubo','Veiksmo','Komedija','Romantinis','Dokumentika','Detektyvinis') NOT NULL,
  `id_Filmo_zanras` int(11) NOT NULL,
  `fk_Filmasid_Filmas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `filmu_sarasas`
--

CREATE TABLE `filmu_sarasas` (
  `filmu_kiekis` int(11) NOT NULL,
  `perziuretas` tinyint(1) NOT NULL,
  `ivertintas` tinyint(1) NOT NULL,
  `id_Filmu_sarasas` int(11) NOT NULL,
  `fk_Filmasid_Filmas` int(11) NOT NULL,
  `fk_userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ip_blacklist`
--

CREATE TABLE `ip_blacklist` (
  `IP_adresas` varchar(255) NOT NULL,
  `komentaras` varchar(255),
  `nuo` datetime NOT NULL,
  `id_IP_blacklist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `komentaras`
--

CREATE TABLE `komentaras` (
  `vartotojo_vardas` varchar(255) DEFAULT NULL,
  `tekstas` varchar(255) NOT NULL,
  `data` datetime NOT NULL,
  `reitingas` int(11) NOT NULL,
  `antraste` varchar(255) NOT NULL,
  `id` int(11) NOT NULL,
  `fk_Filmas` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentaras`
--

INSERT INTO `komentaras` (`vartotojo_vardas`, `tekstas`, `data`, `reitingas`, `antraste`, `id`, `fk_Filmas`, `fk_user`) VALUES
('simbab', 'testt', '2022-12-13 23:30:52', 2, '2', 1, 3, 4),
('simbab', 'test', '2022-12-13 23:47:51', 10, 'test', 3, 2, 4),
('simbab', 'test', '2022-12-14 00:35:52', 2, 'ttest', 4, 1, 4),
('simbab', 'ttetst', '2022-12-14 00:36:06', 6, 'testt', 5, 4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `komentaro_ivertinimas`
--

CREATE TABLE `komentaro_ivertinimas` (
  `patiko` tinyint(1) NOT NULL,
  `id` int(11) NOT NULL,
  `fk_Komentaras` int(11) NOT NULL,
  `fk_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `komentaro_ivertinimas`
--

INSERT INTO `komentaro_ivertinimas` (`patiko`, `id`, `fk_Komentaras`, `fk_user`) VALUES
(1, 1, 1, 4),
(1, 3, 3, 4),
(0, 4, 4, 4),
(0, 5, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `saitai_iki_nuotrauku`
--

CREATE TABLE `saitai_iki_nuotrauku` (
  `pavadinimas` varchar(255) NOT NULL,
  `saitas` varchar(255) NOT NULL,
  `id_Saitai_iki_nuotrauku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(128) NOT NULL,
  `username` varchar(50) NOT NULL,
  `type` enum('Moderator','Critic','Default') NOT NULL,
  `register_time` datetime NOT NULL,
  `ip` varchar(15) NOT NULL,
  `last_visit_time` datetime NOT NULL,
  `avatar_src` varchar(300) NOT NULL,
  `channel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `username`, `type`, `register_time`, `ip`, `last_visit_time`, `avatar_src`, `channel`) VALUES
(3, 'Admin', 'Admin', 'admin@admin.com', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', 'admin', 'Moderator', '2022-12-13 21:02:40', '111.111.111.111', '2022-12-13 21:02:40', 'https://i.gifer.com/origin/f8/f8903ad1904347df9561656bcfa8918e.gif', NULL),
(4, 'simbab', 'baba', 'babarskas.simonas@gmail.com', 'simbab', 'simbab', 'Moderator', '2022-12-13 21:57:33', '111.111.111.112', '2022-12-13 21:57:33', 'https://images.unsplash.com/photo-1471879832106-c7ab9e0cee23?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8Mnx8fGVufDB8fHx8&w=1000&q=80', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vaidina`
--

CREATE TABLE `vaidina` (
  `fk_Aktoriusid_Aktorius` int(11) NOT NULL,
  `fk_Filmasid_Filmas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktorius`
--
ALTER TABLE `aktorius`
  ADD PRIMARY KEY (`id_Aktorius`);

--
-- Indexes for table `apsilankymas`
--
ALTER TABLE `apsilankymas`
  ADD PRIMARY KEY (`id_Apsilankymas`);

--
-- Indexes for table `channel`
--
ALTER TABLE `channel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CHANNEL_CREATOR` (`creator`);

--
-- Indexes for table `channel_blocking`
--
ALTER TABLE `channel_blocking`
  ADD PRIMARY KEY (`user_blocker`,`user_blocked`),
  ADD KEY `FK_BLOCKING_BLOCKED` (`user_blocked`);

--
-- Indexes for table `channel_message`
--
ALTER TABLE `channel_message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_CMESSAGE_CHANNEL` (`channel`),
  ADD KEY `FK_CMESSAGE_SENDER` (`sender`);

--
-- Indexes for table `dizaino_tema`
--
ALTER TABLE `dizaino_tema`
  ADD PRIMARY KEY (`id_Dizaino_tema`);

--
-- Indexes for table `filmas`
--
ALTER TABLE `filmas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filmo_zanras`
--
ALTER TABLE `filmo_zanras`
  ADD PRIMARY KEY (`id_Filmo_zanras`),
  ADD KEY `yra` (`fk_Filmasid_Filmas`);

--
-- Indexes for table `filmu_sarasas`
--
ALTER TABLE `filmu_sarasas`
  ADD PRIMARY KEY (`id_Filmu_sarasas`),
  ADD KEY `priskiriamas` (`fk_Filmasid_Filmas`),
  ADD KEY `turi_filma` (`fk_userid`);

--
-- Indexes for table `ip_blacklist`
--
ALTER TABLE `ip_blacklist`
  ADD PRIMARY KEY (`id_IP_blacklist`);

--
-- Indexes for table `komentaras`
--
ALTER TABLE `komentaras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turi_komentara` (`fk_Filmas`),
  ADD KEY `raso` (`fk_user`);

--
-- Indexes for table `komentaro_ivertinimas`
--
ALTER TABLE `komentaro_ivertinimas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turi_ivertinima` (`fk_Komentaras`);

--
-- Indexes for table `saitai_iki_nuotrauku`
--
ALTER TABLE `saitai_iki_nuotrauku`
  ADD PRIMARY KEY (`id_Saitai_iki_nuotrauku`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USER_CHANNEL` (`channel`);

--
-- Indexes for table `vaidina`
--
ALTER TABLE `vaidina`
  ADD PRIMARY KEY (`fk_Aktoriusid_Aktorius`,`fk_Filmasid_Filmas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `channel`
--
ALTER TABLE `channel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `channel_message`
--
ALTER TABLE `channel_message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filmas`
--
ALTER TABLE `filmas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `komentaras`
--
ALTER TABLE `komentaras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `komentaro_ivertinimas`
--
ALTER TABLE `komentaro_ivertinimas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `channel`
--
ALTER TABLE `channel`
  ADD CONSTRAINT `FK_CHANNEL_CREATOR` FOREIGN KEY (`creator`) REFERENCES `user` (`id`);

--
-- Constraints for table `channel_blocking`
--
ALTER TABLE `channel_blocking`
  ADD CONSTRAINT `FK_BLOCKING_BLOCKED` FOREIGN KEY (`user_blocked`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_BLOCKING_BLOCKER` FOREIGN KEY (`user_blocker`) REFERENCES `user` (`id`);

--
-- Constraints for table `channel_message`
--
ALTER TABLE `channel_message`
  ADD CONSTRAINT `FK_CMESSAGE_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`),
  ADD CONSTRAINT `FK_CMESSAGE_SENDER` FOREIGN KEY (`sender`) REFERENCES `user` (`id`);

--
-- Constraints for table `filmo_zanras`
--
ALTER TABLE `filmo_zanras`
  ADD CONSTRAINT `yra` FOREIGN KEY (`fk_Filmasid_Filmas`) REFERENCES `filmas` (`id`);

--
-- Constraints for table `filmu_sarasas`
--
ALTER TABLE `filmu_sarasas`
  ADD CONSTRAINT `priskiriamas` FOREIGN KEY (`fk_Filmasid_Filmas`) REFERENCES `filmas` (`id`),
  ADD CONSTRAINT `turi_filma` FOREIGN KEY (`fk_userid`) REFERENCES `user` (`id`);

--
-- Constraints for table `komentaras`
--
ALTER TABLE `komentaras`
  ADD CONSTRAINT `raso` FOREIGN KEY (`fk_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `turi_komentara` FOREIGN KEY (`fk_Filmas`) REFERENCES `filmas` (`id`);

--
-- Constraints for table `komentaro_ivertinimas`
--
ALTER TABLE `komentaro_ivertinimas`
  ADD CONSTRAINT `turi_ivertinima` FOREIGN KEY (`fk_Komentaras`) REFERENCES `komentaras` (`id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_CHANNEL` FOREIGN KEY (`channel`) REFERENCES `channel` (`id`);

--
-- Constraints for table `vaidina`
--
ALTER TABLE `vaidina`
  ADD CONSTRAINT `vaidina` FOREIGN KEY (`fk_Aktoriusid_Aktorius`) REFERENCES `aktorius` (`id_Aktorius`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
