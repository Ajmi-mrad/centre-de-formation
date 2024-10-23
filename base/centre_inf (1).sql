-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2023 at 03:01 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `centre_inf`
--

-- --------------------------------------------------------

--
-- Table structure for table `eleve`
--

CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL,
  `type_eleve` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `date_naiss` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `num_id` int(11) NOT NULL,
  `nat_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eleve`
--

INSERT INTO `eleve` (`id_eleve`, `type_eleve`, `nom`, `prenom`, `tel`, `date_naiss`, `email`, `num_id`, `nat_id`) VALUES
(17, 0, 'ajmi', 'mrad', '5382155', '0000-00-00', '', 13, ''),
(18, 0, 'ali', 'ali', '8452212', '0000-00-00', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `eleve_paiement`
--

CREATE TABLE `eleve_paiement` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant_paye` float NOT NULL,
  `montant_modifier` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eleve_paiement`
--

INSERT INTO `eleve_paiement` (`id_formation`, `id_session`, `id_eleve`, `date`, `montant_paye`, `montant_modifier`) VALUES
(1, 1, 13, '2023-01-29 14:22:16', 1000, 0),
(1, 1, 14, '2023-01-29 00:00:00', 1000, 0),
(1, 1, 14, '2023-01-29 13:39:12', 5200, 0),
(1, 1, 14, '2023-01-29 14:17:31', 200, 0),
(10, 4, 13, '2023-01-29 14:48:38', 200, 0),
(10, 4, 13, '2023-01-29 14:49:13', 500, 0),
(10, 4, 14, '2023-01-29 14:50:56', 700, 0);

-- --------------------------------------------------------

--
-- Table structure for table `eleve_session`
--

CREATE TABLE `eleve_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formateur`
--

CREATE TABLE `formateur` (
  `id_formateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `date_naiss` date NOT NULL,
  `num_id` int(11) NOT NULL,
  `nat_id` varchar(20) NOT NULL,
  `cv` longtext NOT NULL,
  `id_specialite` int(11) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formateur`
--

INSERT INTO `formateur` (`id_formateur`, `nom`, `prenom`, `tel`, `date_naiss`, `num_id`, `nat_id`, `cv`, `id_specialite`, `email`) VALUES
(46, 'ajmi', 'mrad', '516516', '0000-00-00', 13, '155651', 'C:\\xampp\\htdocs\\centre de formation\\cv\\rapport.docx', 2, 'ajmimrad02@gmail.com'),
(48, 'ahmed', 'mansour', '5646', '0000-00-00', 13, '', 'C:\\xampp\\htdocs\\centre de formation\\cv\\', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `formateur_paiement`
--

CREATE TABLE `formateur_paiement` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant_paye` float NOT NULL,
  `montant_modifier` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formateur_paiement`
--

INSERT INTO `formateur_paiement` (`id_formation`, `id_session`, `id_formateur`, `date`, `montant_paye`, `montant_modifier`) VALUES
(1, 1, 31, '2023-01-29 01:36:43', 1000, 0),
(1, 1, 31, '2023-01-29 01:39:32', 1000, 0),
(1, 1, 31, '2023-01-29 01:48:32', 1000, 100),
(10, 4, 32, '2023-01-29 11:40:12', 300, 0),
(10, 4, 32, '2023-01-30 17:30:26', 0, 100),
(10, 4, 32, '2023-01-31 14:58:57', 200, 0);

-- --------------------------------------------------------

--
-- Table structure for table `formateur_session`
--

CREATE TABLE `formateur_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  `montant_total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formateur_specialite`
--

CREATE TABLE `formateur_specialite` (
  `id_specialite` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formateur_specialite`
--

INSERT INTO `formateur_specialite` (`id_specialite`, `id_formateur`) VALUES
(2, 46),
(2, 48);

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` longtext NOT NULL,
  `type_formation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `formation`
--

INSERT INTO `formation` (`id_formation`, `nom`, `description`, `type_formation`) VALUES
(10, 'english', 'cette azeze', 1),
(12, 'turkie', 'azejazirz!arazra', 1),
(17, 'rbi', '', 0),
(18, 'rbi3', '', 0),
(19, '', '', 0),
(20, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `idt`
--

CREATE TABLE `idt` (
  `num_id` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idt`
--

INSERT INTO `idt` (`num_id`, `libelle`) VALUES
(13, 'cin');

-- --------------------------------------------------------

--
-- Table structure for table `idt_eleve`
--

CREATE TABLE `idt_eleve` (
  `id_eleve` int(11) NOT NULL,
  `num_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idt_eleve`
--

INSERT INTO `idt_eleve` (`id_eleve`, `num_id`) VALUES
(6, 2),
(8, 1),
(9, 2),
(10, 1),
(11, 1),
(12, 2),
(13, 9),
(14, 9),
(15, 8),
(16, 10),
(17, 13),
(18, 0),
(19, 0),
(20, 13);

-- --------------------------------------------------------

--
-- Table structure for table `idt_formateur`
--

CREATE TABLE `idt_formateur` (
  `id_formateur` int(11) NOT NULL,
  `num_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `idt_formateur`
--

INSERT INTO `idt_formateur` (`id_formateur`, `num_id`) VALUES
(46, 13),
(48, 13);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `pseudo` varchar(40) NOT NULL,
  `mp` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `type_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id_login`, `pseudo`, `mp`, `nom`, `prenom`, `type_user`) VALUES
(1, 'asma', 'asma', 'asma', 'ben ali', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modalite_paiement`
--

CREATE TABLE `modalite_paiement` (
  `id_paiement` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modalite_paiement`
--

INSERT INTO `modalite_paiement` (`id_paiement`, `libelle`) VALUES
(2, 'espece');

-- --------------------------------------------------------

--
-- Table structure for table `nv_scolaire`
--

CREATE TABLE `nv_scolaire` (
  `id_scolaire` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nv_scolaire`
--

INSERT INTO `nv_scolaire` (`id_scolaire`, `libelle`) VALUES
(2, '3 eme'),
(4, 'bac');

-- --------------------------------------------------------

--
-- Table structure for table `session_formation`
--

CREATE TABLE `session_formation` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `nom_session` varchar(50) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `dure` varchar(20) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session_formation`
--

INSERT INTO `session_formation` (`id_formation`, `id_session`, `nom_session`, `date_deb`, `date_fin`, `dure`, `prix`) VALUES
(10, 4, 'siif', '2022-11-11', '2023-02-26', '11h', 1000),
(12, 1, 'rbi3', '2023-02-01', '2023-02-23', '22h', 1520);

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `societe`
--

INSERT INTO `societe` (`id_societe`, `libelle`, `email`) VALUES
(8, 'epi', 'poly@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialite`
--

INSERT INTO `specialite` (`id_specialite`, `libelle`) VALUES
(2, 'math');

-- --------------------------------------------------------

--
-- Table structure for table `tp_eleve`
--

CREATE TABLE `tp_eleve` (
  `id_eleve` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id_scolaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tp_eleve`
--

INSERT INTO `tp_eleve` (`id_eleve`, `id_societe`, `id_scolaire`) VALUES
(17, 0, 2),
(18, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tp_formation`
--

CREATE TABLE `tp_formation` (
  `id_formation` int(11) NOT NULL,
  `type_formation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tp_formation`
--

INSERT INTO `tp_formation` (`id_formation`, `type_formation`) VALUES
(10, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Table structure for table `type_eleve`
--

CREATE TABLE `type_eleve` (
  `type_eleve` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_formation`
--

CREATE TABLE `type_formation` (
  `type_formation` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_formation`
--

INSERT INTO `type_formation` (`type_formation`, `libelle`) VALUES
(1, 'langue');

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

CREATE TABLE `type_user` (
  `type_user` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type_user`
--

INSERT INTO `type_user` (`type_user`, `libelle`) VALUES
(1, 'secretaire'),
(4, 'directeur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `type_eleve` (`type_eleve`),
  ADD KEY `eleve_ibfk_1` (`num_id`);

--
-- Indexes for table `eleve_paiement`
--
ALTER TABLE `eleve_paiement`
  ADD PRIMARY KEY (`id_formation`,`id_session`,`id_eleve`,`date`);

--
-- Indexes for table `eleve_session`
--
ALTER TABLE `eleve_session`
  ADD PRIMARY KEY (`id_formation`,`id_session`,`id_eleve`),
  ADD KEY `id_eleve` (`id_eleve`);

--
-- Indexes for table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id_formateur`),
  ADD KEY `formateur_ibfk_1` (`num_id`),
  ADD KEY `formateur_ibfk_2` (`id_specialite`);

--
-- Indexes for table `formateur_paiement`
--
ALTER TABLE `formateur_paiement`
  ADD PRIMARY KEY (`id_formation`,`id_session`,`id_formateur`,`date`);

--
-- Indexes for table `formateur_session`
--
ALTER TABLE `formateur_session`
  ADD PRIMARY KEY (`id_formation`,`id_session`,`id_formateur`),
  ADD KEY `formateur_session_ibfk_1` (`id_formateur`),
  ADD KEY `formateur_session_ibfk_3` (`id_paiement`);

--
-- Indexes for table `formateur_specialite`
--
ALTER TABLE `formateur_specialite`
  ADD PRIMARY KEY (`id_specialite`,`id_formateur`),
  ADD KEY `formateur_specialite_ibfk_1` (`id_formateur`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `formation_ibfk_1` (`type_formation`);

--
-- Indexes for table `idt`
--
ALTER TABLE `idt`
  ADD PRIMARY KEY (`num_id`);

--
-- Indexes for table `idt_eleve`
--
ALTER TABLE `idt_eleve`
  ADD PRIMARY KEY (`id_eleve`,`num_id`),
  ADD KEY `num_id` (`num_id`);

--
-- Indexes for table `idt_formateur`
--
ALTER TABLE `idt_formateur`
  ADD PRIMARY KEY (`id_formateur`,`num_id`),
  ADD KEY `idt_formateur_ibfk_2` (`num_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `type_user` (`type_user`);

--
-- Indexes for table `modalite_paiement`
--
ALTER TABLE `modalite_paiement`
  ADD PRIMARY KEY (`id_paiement`);

--
-- Indexes for table `nv_scolaire`
--
ALTER TABLE `nv_scolaire`
  ADD PRIMARY KEY (`id_scolaire`);

--
-- Indexes for table `session_formation`
--
ALTER TABLE `session_formation`
  ADD PRIMARY KEY (`id_formation`,`id_session`);

--
-- Indexes for table `societe`
--
ALTER TABLE `societe`
  ADD PRIMARY KEY (`id_societe`);

--
-- Indexes for table `specialite`
--
ALTER TABLE `specialite`
  ADD PRIMARY KEY (`id_specialite`);

--
-- Indexes for table `tp_eleve`
--
ALTER TABLE `tp_eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `id_scolaire` (`id_scolaire`),
  ADD KEY `id_societe` (`id_societe`);

--
-- Indexes for table `tp_formation`
--
ALTER TABLE `tp_formation`
  ADD PRIMARY KEY (`id_formation`,`type_formation`),
  ADD KEY `tp_formation_ibfk_2` (`type_formation`);

--
-- Indexes for table `type_eleve`
--
ALTER TABLE `type_eleve`
  ADD PRIMARY KEY (`type_eleve`);

--
-- Indexes for table `type_formation`
--
ALTER TABLE `type_formation`
  ADD PRIMARY KEY (`type_formation`);

--
-- Indexes for table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`type_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id_formateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `idt`
--
ALTER TABLE `idt`
  MODIFY `num_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `modalite_paiement`
--
ALTER TABLE `modalite_paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `nv_scolaire`
--
ALTER TABLE `nv_scolaire`
  MODIFY `id_scolaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_eleve`
--
ALTER TABLE `type_eleve`
  MODIFY `type_eleve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_formation`
--
ALTER TABLE `type_formation`
  MODIFY `type_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_user`
--
ALTER TABLE `type_user`
  MODIFY `type_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formateur_specialite`
--
ALTER TABLE `formateur_specialite`
  ADD CONSTRAINT `formateur_specialite_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `formateur_specialite_ibfk_2` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tp_eleve`
--
ALTER TABLE `tp_eleve`
  ADD CONSTRAINT `tp_eleve_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tp_formation`
--
ALTER TABLE `tp_formation`
  ADD CONSTRAINT `tp_formation_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tp_formation_ibfk_2` FOREIGN KEY (`type_formation`) REFERENCES `type_formation` (`type_formation`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
