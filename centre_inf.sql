-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 08:57 PM
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
  `num_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `eleve_session`
--

CREATE TABLE `eleve_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `montant_total` float NOT NULL,
  `montant_paye` float NOT NULL
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
  `cv` longtext NOT NULL,
  `id_specialite` int(11) NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formateur_session`
--

CREATE TABLE `formateur_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  `montant_total` float NOT NULL,
  `montant_paye` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `description` longtext NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `idt_eleve`
--

CREATE TABLE `idt_eleve` (
  `num_id` int(11) NOT NULL,
  `type_id` varchar(40) NOT NULL,
  `nat_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `idt_formateur`
--

CREATE TABLE `idt_formateur` (
  `num_id` int(11) NOT NULL,
  `type_id` varchar(40) NOT NULL,
  `nat_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `modalite_paiement`
--

CREATE TABLE `modalite_paiement` (
  `id_paiement` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `nv_scolaire`
--

CREATE TABLE `nv_scolaire` (
  `id_scolaire` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `session_formation`
--

CREATE TABLE `session_formation` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `dure` varchar(20) NOT NULL,
  `prix` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `societe`
--

CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `specialite`
--

CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tp_eleve`
--

CREATE TABLE `tp_eleve` (
  `id_eleve` int(11) NOT NULL,
  `type_eleve` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id_scolaire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `type_id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

CREATE TABLE `type_user` (
  `type_id` int(11) NOT NULL,
  `libelle` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id_eleve`),
  ADD KEY `type_eleve` (`type_eleve`),
  ADD KEY `num_id` (`num_id`);

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
  ADD KEY `num_id` (`num_id`),
  ADD KEY `id_specialite` (`id_specialite`);

--
-- Indexes for table `formateur_session`
--
ALTER TABLE `formateur_session`
  ADD PRIMARY KEY (`id_formation`,`id_session`,`id_formateur`),
  ADD KEY `id_formateur` (`id_formateur`),
  ADD KEY `id_paiement` (`id_paiement`);

--
-- Indexes for table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `idt_eleve`
--
ALTER TABLE `idt_eleve`
  ADD PRIMARY KEY (`num_id`);

--
-- Indexes for table `idt_formateur`
--
ALTER TABLE `idt_formateur`
  ADD PRIMARY KEY (`num_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`),
  ADD KEY `type_id` (`type_id`);

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
  ADD KEY `id_societe` (`id_societe`),
  ADD KEY `type_eleve` (`type_eleve`);

--
-- Indexes for table `type_eleve`
--
ALTER TABLE `type_eleve`
  ADD PRIMARY KEY (`type_eleve`);

--
-- Indexes for table `type_formation`
--
ALTER TABLE `type_formation`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id_eleve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id_formateur` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `idt_eleve`
--
ALTER TABLE `idt_eleve`
  MODIFY `num_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `idt_formateur`
--
ALTER TABLE `idt_formateur`
  MODIFY `num_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modalite_paiement`
--
ALTER TABLE `modalite_paiement`
  MODIFY `id_paiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `nv_scolaire`
--
ALTER TABLE `nv_scolaire`
  MODIFY `id_scolaire` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `societe`
--
ALTER TABLE `societe`
  MODIFY `id_societe` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `specialite`
--
ALTER TABLE `specialite`
  MODIFY `id_specialite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_eleve`
--
ALTER TABLE `type_eleve`
  MODIFY `type_eleve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_formation`
--
ALTER TABLE `type_formation`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `eleve_ibfk_1` FOREIGN KEY (`type_eleve`) REFERENCES `type_eleve` (`type_eleve`),
  ADD CONSTRAINT `eleve_ibfk_2` FOREIGN KEY (`num_id`) REFERENCES `idt_eleve` (`num_id`);

--
-- Constraints for table `eleve_session`
--
ALTER TABLE `eleve_session`
  ADD CONSTRAINT `eleve_session_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formateur_session` (`id_formation`),
  ADD CONSTRAINT `eleve_session_ibfk_2` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`);

--
-- Constraints for table `formateur`
--
ALTER TABLE `formateur`
  ADD CONSTRAINT `formateur_ibfk_1` FOREIGN KEY (`num_id`) REFERENCES `idt_formateur` (`num_id`),
  ADD CONSTRAINT `formateur_ibfk_2` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`);

--
-- Constraints for table `formateur_session`
--
ALTER TABLE `formateur_session`
  ADD CONSTRAINT `formateur_session_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`),
  ADD CONSTRAINT `formateur_session_ibfk_3` FOREIGN KEY (`id_paiement`) REFERENCES `modalite_paiement` (`id_paiement`),
  ADD CONSTRAINT `formateur_session_ibfk_4` FOREIGN KEY (`id_formation`) REFERENCES `session_formation` (`id_formation`);

--
-- Constraints for table `formation`
--
ALTER TABLE `formation`
  ADD CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_formation` (`type_id`);

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `type_user` (`type_id`);

--
-- Constraints for table `session_formation`
--
ALTER TABLE `session_formation`
  ADD CONSTRAINT `session_formation_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`);

--
-- Constraints for table `tp_eleve`
--
ALTER TABLE `tp_eleve`
  ADD CONSTRAINT `tp_eleve_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`),
  ADD CONSTRAINT `tp_eleve_ibfk_2` FOREIGN KEY (`id_scolaire`) REFERENCES `nv_scolaire` (`id_scolaire`),
  ADD CONSTRAINT `tp_eleve_ibfk_3` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`),
  ADD CONSTRAINT `tp_eleve_ibfk_4` FOREIGN KEY (`type_eleve`) REFERENCES `type_eleve` (`type_eleve`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
