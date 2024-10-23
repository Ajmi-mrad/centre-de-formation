CREATE TABLE `eleve` (
  `id_eleve` int(11) NOT NULL AUTO_INCREMENT,
  `type_eleve` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `tel` varchar(12) NOT NULL,
  `date_naiss` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `num_id` int(11) NOT NULL,
  `nat_id` varchar(40) NOT NULL,
  PRIMARY KEY (`id_eleve`),
  KEY `type_eleve` (`type_eleve`),
  KEY `eleve_ibfk_1` (`num_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

INSERT INTO eleve VALUES("17","0","ajmi","mrad","5382155","0000-00-00","","13","");





CREATE TABLE `eleve_paiement` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant_paye` float NOT NULL,
  `montant_modifier` float NOT NULL,
  PRIMARY KEY (`id_formation`,`id_session`,`id_eleve`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO eleve_paiement VALUES("1","1","13","2023-01-29 14:22:16","1000","0");
INSERT INTO eleve_paiement VALUES("1","1","14","2023-01-29 00:00:00","1000","0");
INSERT INTO eleve_paiement VALUES("1","1","14","2023-01-29 13:39:12","5200","0");
INSERT INTO eleve_paiement VALUES("1","1","14","2023-01-29 14:17:31","200","0");
INSERT INTO eleve_paiement VALUES("10","4","13","2023-01-29 14:48:38","200","0");
INSERT INTO eleve_paiement VALUES("10","4","13","2023-01-29 14:49:13","500","0");
INSERT INTO eleve_paiement VALUES("10","4","14","2023-01-29 14:50:56","700","0");





CREATE TABLE `eleve_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `id_eleve` int(11) NOT NULL,
  PRIMARY KEY (`id_formation`,`id_session`,`id_eleve`),
  KEY `id_eleve` (`id_eleve`),
  CONSTRAINT `eleve_session_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formateur_session` (`id_formation`),
  CONSTRAINT `eleve_session_ibfk_2` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `formateur` (
  `id_formateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `date_naiss` date NOT NULL,
  `num_id` int(11) NOT NULL,
  `nat_id` varchar(20) NOT NULL,
  `cv` longtext NOT NULL,
  `id_specialite` int(11) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id_formateur`),
  KEY `formateur_ibfk_1` (`num_id`),
  KEY `formateur_ibfk_2` (`id_specialite`),
  CONSTRAINT `formateur_ibfk_1` FOREIGN KEY (`num_id`) REFERENCES `idt` (`num_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `formateur_ibfk_2` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4;






CREATE TABLE `formateur_paiement` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `montant_paye` float NOT NULL,
  `montant_modifier` float NOT NULL,
  PRIMARY KEY (`id_formation`,`id_session`,`id_formateur`,`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO formateur_paiement VALUES("1","1","31","2023-01-29 01:36:43","1000","0");
INSERT INTO formateur_paiement VALUES("1","1","31","2023-01-29 01:39:32","1000","0");
INSERT INTO formateur_paiement VALUES("1","1","31","2023-01-29 01:48:32","1000","100");
INSERT INTO formateur_paiement VALUES("10","4","32","2023-01-29 11:40:12","300","0");
INSERT INTO formateur_paiement VALUES("10","4","32","2023-01-30 17:30:26","0","100");
INSERT INTO formateur_paiement VALUES("10","4","32","2023-01-31 14:58:57","200","0");





CREATE TABLE `formateur_session` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  `id_paiement` int(11) NOT NULL,
  `montant_total` float NOT NULL,
  PRIMARY KEY (`id_formation`,`id_session`,`id_formateur`),
  KEY `formateur_session_ibfk_1` (`id_formateur`),
  KEY `formateur_session_ibfk_3` (`id_paiement`),
  CONSTRAINT `formateur_session_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `formateur_session_ibfk_3` FOREIGN KEY (`id_paiement`) REFERENCES `modalite_paiement` (`id_paiement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `formateur_session_ibfk_4` FOREIGN KEY (`id_formation`) REFERENCES `session_formation` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `formateur_specialite` (
  `id_specialite` int(11) NOT NULL,
  `id_formateur` int(11) NOT NULL,
  PRIMARY KEY (`id_specialite`,`id_formateur`),
  KEY `formateur_specialite_ibfk_1` (`id_formateur`),
  CONSTRAINT `formateur_specialite_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `formateur_specialite_ibfk_2` FOREIGN KEY (`id_specialite`) REFERENCES `specialite` (`id_specialite`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(40) NOT NULL,
  `description` longtext NOT NULL,
  `type_formation` int(11) NOT NULL,
  PRIMARY KEY (`id_formation`),
  KEY `type_formation` (`type_formation`),
  CONSTRAINT `formation_ibfk_1` FOREIGN KEY (`type_formation`) REFERENCES `type_formation` (`type_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

INSERT INTO formation VALUES("10","english","cette azeze","1");





CREATE TABLE `idt` (
  `num_id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`num_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

INSERT INTO idt VALUES("13","cin");





CREATE TABLE `idt_eleve` (
  `id_eleve` int(11) NOT NULL,
  `num_id` int(11) NOT NULL,
  PRIMARY KEY (`id_eleve`,`num_id`),
  KEY `num_id` (`num_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO idt_eleve VALUES("6","2");
INSERT INTO idt_eleve VALUES("8","1");
INSERT INTO idt_eleve VALUES("9","2");
INSERT INTO idt_eleve VALUES("10","1");
INSERT INTO idt_eleve VALUES("11","1");
INSERT INTO idt_eleve VALUES("12","2");
INSERT INTO idt_eleve VALUES("13","9");
INSERT INTO idt_eleve VALUES("14","9");
INSERT INTO idt_eleve VALUES("15","8");
INSERT INTO idt_eleve VALUES("16","10");
INSERT INTO idt_eleve VALUES("17","13");





CREATE TABLE `idt_formateur` (
  `id_formateur` int(11) NOT NULL,
  `num_id` int(11) NOT NULL,
  PRIMARY KEY (`id_formateur`,`num_id`),
  KEY `idt_formateur_ibfk_2` (`num_id`),
  CONSTRAINT `idt_formateur_ibfk_1` FOREIGN KEY (`id_formateur`) REFERENCES `formateur` (`id_formateur`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `idt_formateur_ibfk_2` FOREIGN KEY (`num_id`) REFERENCES `idt` (`num_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;






CREATE TABLE `login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(40) NOT NULL,
  `mp` varchar(40) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `type_user` int(11) NOT NULL,
  PRIMARY KEY (`id_login`),
  KEY `type_user` (`type_user`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;






CREATE TABLE `modalite_paiement` (
  `id_paiement` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`id_paiement`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO modalite_paiement VALUES("2","espece");





CREATE TABLE `nv_scolaire` (
  `id_scolaire` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`id_scolaire`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO nv_scolaire VALUES("2","3 eme");
INSERT INTO nv_scolaire VALUES("4","bac");





CREATE TABLE `session_formation` (
  `id_formation` int(11) NOT NULL,
  `id_session` int(11) NOT NULL,
  `nom_session` varchar(50) NOT NULL,
  `date_deb` date NOT NULL,
  `date_fin` date NOT NULL,
  `dure` varchar(20) NOT NULL,
  `prix` float NOT NULL,
  PRIMARY KEY (`id_formation`,`id_session`),
  CONSTRAINT `session_formation_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO session_formation VALUES("10","4","siif","2022-11-11","2023-02-26","11h","1000");





CREATE TABLE `societe` (
  `id_societe` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id_societe`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

INSERT INTO societe VALUES("8","epi","poly@gmail.com");





CREATE TABLE `specialite` (
  `id_specialite` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id_specialite`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO specialite VALUES("2","math");





CREATE TABLE `tp_eleve` (
  `id_eleve` int(11) NOT NULL,
  `id_societe` int(11) NOT NULL,
  `id_scolaire` int(11) NOT NULL,
  PRIMARY KEY (`id_eleve`),
  KEY `id_scolaire` (`id_scolaire`),
  KEY `id_societe` (`id_societe`),
  CONSTRAINT `tp_eleve_ibfk_1` FOREIGN KEY (`id_eleve`) REFERENCES `eleve` (`id_eleve`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tp_eleve VALUES("17","0","0");





CREATE TABLE `tp_formation` (
  `id_formation` int(11) NOT NULL,
  `type_formation` int(11) NOT NULL,
  PRIMARY KEY (`id_formation`,`type_formation`),
  KEY `tp_formation_ibfk_2` (`type_formation`),
  CONSTRAINT `tp_formation_ibfk_1` FOREIGN KEY (`id_formation`) REFERENCES `formation` (`id_formation`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tp_formation_ibfk_2` FOREIGN KEY (`type_formation`) REFERENCES `type_formation` (`type_formation`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tp_formation VALUES("10","1");





CREATE TABLE `type_eleve` (
  `type_eleve` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`type_eleve`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;






CREATE TABLE `type_formation` (
  `type_formation` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`type_formation`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

INSERT INTO type_formation VALUES("1","langue");



CREATE TABLE `type_user` (
  `type_user` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) NOT NULL,
  PRIMARY KEY (`type_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

INSERT INTO type_user VALUES("1","secretaire");
INSERT INTO type_user VALUES("4","directeur");



