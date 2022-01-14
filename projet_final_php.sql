-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2022 at 02:45 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet_final_php`
--

-- --------------------------------------------------------

--
-- Table structure for table `anneeAcademique`
--

CREATE TABLE `anneeAcademique` (
  `id` int(10) UNSIGNED NOT NULL,
  `annee_debut` int(10) UNSIGNED NOT NULL,
  `annee_fin` int(10) UNSIGNED NOT NULL,
  `date_debut` varchar(15) NOT NULL,
  `date_fin` varchar(15) NOT NULL,
  `etat` varchar(2) DEFAULT NULL CHECK (`etat` like 'F' or `etat` like 'O'),
  `annee_academique` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anneeAcademique`
--

INSERT INTO `anneeAcademique` (`id`, `annee_debut`, `annee_fin`, `date_debut`, `date_fin`, `etat`, `annee_academique`) VALUES
(1, 2012, 2013, '2012-11-20', '2013-02-08', 'O', '2012-2013'),
(29, 2013, 2014, '2013-11-20', '2014-02-08', 'F', '2013-2014');

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(30) NOT NULL,
  `code` varchar(15) NOT NULL,
  `filiere` varchar(30) NOT NULL,
  `niveau` varchar(10) NOT NULL,
  `session` varchar(10) NOT NULL,
  `etat` varchar(10) NOT NULL,
  `prof_sup_id` int(10) UNSIGNED DEFAULT NULL,
  `coefficient` int(10) UNSIGNED NOT NULL,
  `prof_id` int(10) UNSIGNED NOT NULL,
  `jours` varchar(100) NOT NULL,
  `heure_debut` varchar(255) NOT NULL,
  `heure_fin` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `nom`, `code`, `filiere`, `niveau`, `session`, `etat`, `prof_sup_id`, `coefficient`, `prof_id`, `jours`, `heure_debut`, `heure_fin`) VALUES
(6, 'Algo', 'Al-000-000', 'Informatique', 'L1', 'S1', 'E', 4, 4, 4, 'Lundi', '8:30 AM', '11:00 AM'),
(7, 'CSS', 'CS-000-001', 'Informatique', 'L1', 'S1', 'E', 4, 4, 4, 'Lundi', '8:00 AM', '11:00 AM');

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `code` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `lieu_de_naissance` varchar(200) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `date_de_naissance` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `niveau` varchar(15) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `etat` varchar(10) NOT NULL,
  `nif_or_cin` varchar(20) NOT NULL,
  `personne_de_reference` varchar(100) NOT NULL,
  `tel_personne_de_ref` varchar(15) NOT NULL,
  `id_annee_academique` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `etudiant`
--

INSERT INTO `etudiant` (`id`, `photo`, `code`, `nom`, `prenom`, `sexe`, `lieu_de_naissance`, `adresse`, `telephone`, `date_de_naissance`, `email`, `niveau`, `filiere`, `memo`, `etat`, `nif_or_cin`, `personne_de_reference`, `tel_personne_de_ref`, `id_annee_academique`) VALUES
(2, NULL, 'CSM-000-000', 'Saintil', 'Claudin', 'M', 'Pilate', '65, rue egalite, gonaives, Haiti', '3467-9023', '1995-05-03', 'claudinsaintil@gmail.com', 'L2', 'Informatique', '', 'A', '456-084-984-2', 'Dieufait Saintil', '3720-0378', 29);

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(10) UNSIGNED NOT NULL,
  `session` varchar(10) NOT NULL,
  `id_cours` int(10) UNSIGNED NOT NULL,
  `id_etudiant` int(10) UNSIGNED NOT NULL,
  `id_annee_academique` int(10) UNSIGNED NOT NULL,
  `note` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `session`, `id_cours`, `id_etudiant`, `id_annee_academique`, `note`) VALUES
(2, 'S1', 6, 2, 1, 80),
(3, 'S1', 7, 2, 1, 70);

-- --------------------------------------------------------

--
-- Table structure for table `professeur`
--

CREATE TABLE `professeur` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `code` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `sexe` varchar(10) NOT NULL,
  `lieu_de_naissance` varchar(200) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `date_de_naissance` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `niveau` varchar(15) NOT NULL,
  `filiere` varchar(255) NOT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `etat` varchar(10) NOT NULL,
  `nif_or_cin` varchar(20) NOT NULL,
  `cours_a_enseigner` varchar(100) NOT NULL,
  `poste` varchar(30) DEFAULT NULL,
  `statut` varchar(15) NOT NULL,
  `salaire` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `professeur`
--

INSERT INTO `professeur` (`id`, `photo`, `code`, `nom`, `prenom`, `sexe`, `lieu_de_naissance`, `adresse`, `telephone`, `date_de_naissance`, `email`, `niveau`, `filiere`, `memo`, `etat`, `nif_or_cin`, `cours_a_enseigner`, `poste`, `statut`, `salaire`) VALUES
(4, NULL, 'WTM-000-000', 'Toussaint', 'Wesly', 'M', 'Cap-Haitien', '65, rue egalite, gonaives, Haiti', '4481-6660', '1996-01-28', 'wesly@gmail.com', 'M2', 'Informatique', '', 'A', '345-968-094-1', 'Algo', '', 'Celibataire', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(10) UNSIGNED NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `pseudo` varchar(15) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(40) NOT NULL,
  `etat` varchar(10) NOT NULL,
  `poste` varchar(30) DEFAULT NULL,
  `modules` varchar(255) NOT NULL,
  `passWord` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `photo`, `pseudo`, `nom`, `prenom`, `etat`, `poste`, `modules`, `passWord`) VALUES
(1, 'c1e8dc1146b51294d41643ea2f9e0248.jpg', 'root', 'Saintil', 'Claudin', 'Actif', '', 'annee,professeur,etudiant,cours,note,palmares,utilisateur', '$2y$10$V98VL8zJWlA49PlPisUgYemWmm1NdVuDGkotSZU669kqY21ieVhtC'),
(2, '', 'admin', 'Toussaint', 'Wesly', 'Actif', '', 'annee,professeur,etudiant,utilisateur', '$2y$10$BdHY07lG68uVxcymskxhvu8QOnfd/rvSPhY0j2Fp3pfXJixLgimsy'),
(3, NULL, 'isha', 'Louis', 'Nakisha', 'Actif', '', 'palmares,utilisateur', '$2y$10$XwUfz5.Saf7qURMy1PVSa.QrrJN75IZmsxGwuw7QU0ZQvmGOCRG2m');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anneeAcademique`
--
ALTER TABLE `anneeAcademique`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `annee_academique` (`annee_academique`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prof` (`prof_id`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `nif_or_cin` (`nif_or_cin`),
  ADD KEY `fk_anne` (`id_annee_academique`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cours` (`id_cours`),
  ADD KEY `fk_etudiant` (`id_etudiant`),
  ADD KEY `fk_annee` (`id_annee_academique`);

--
-- Indexes for table `professeur`
--
ALTER TABLE `professeur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD UNIQUE KEY `nif_or_cin` (`nif_or_cin`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anneeAcademique`
--
ALTER TABLE `anneeAcademique`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professeur`
--
ALTER TABLE `professeur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `fk_prof` FOREIGN KEY (`prof_id`) REFERENCES `professeur` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `fk_anne` FOREIGN KEY (`id_annee_academique`) REFERENCES `anneeAcademique` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `note`
--
ALTER TABLE `note`
  ADD CONSTRAINT `fk_annee` FOREIGN KEY (`id_annee_academique`) REFERENCES `anneeAcademique` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cours` FOREIGN KEY (`id_cours`) REFERENCES `cours` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_etudiant` FOREIGN KEY (`id_etudiant`) REFERENCES `etudiant` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
