-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 15 Mai 2015 à 14:41
-- Version du serveur :  5.6.24
-- Version de PHP :  5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `MasterVoeuxS1`
-- Les Groupes sont automatiquement crees si ils n'existaient pas
--

-- --------------------------------------------------------

--
-- Structure de la table `ANDROIDE`
--

CREATE TABLE IF NOT EXISTS `ANDROIDE` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `BIM`
--

CREATE TABLE IF NOT EXISTS `BIM` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `DAC`
--

CREATE TABLE IF NOT EXISTS `DAC` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `IMA`
--

CREATE TABLE IF NOT EXISTS `IMA` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------


--
-- Structure de la table `edt_ideal`
--

CREATE TABLE `edt_ideal` (
  `numetu` int(11) NOT NULL,
  `voeux` int(11) NOT NULL,
  `ue1` varchar(10) NOT NULL,
  `ue2` varchar(10) NOT NULL,
  `ue3` varchar(10) NOT NULL,
  `ue4` varchar(10) NOT NULL,
  `ue5` varchar(10) NOT NULL,
  `ue6` varchar(10) NOT NULL,
  `ue1gpe` int(11) NOT NULL,
  `ue2gpe` int(11) NOT NULL,
  `ue3gpe` int(11) NOT NULL,
  `ue4gpe` int(11) NOT NULL,
  `ue5gpe` int(11) NOT NULL,
  `ue6gpe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ListeEtudiants`
--

CREATE TABLE IF NOT EXISTS `ListeEtudiants` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `mail` text NOT NULL,
  `spe` text NOT NULL,
  `voeux` int(11) NOT NULL DEFAULT '0',
  `ue1` text NOT NULL,
  `ue2` text NOT NULL,
  `ue3` text NOT NULL,
  `ue4` text NOT NULL,
  `ue5` text NOT NULL,
  `ue6` text NOT NULL,
  `ue1gpe` int(11) NOT NULL,
  `ue2gpe` int(11) NOT NULL,
  `ue3gpe` int(11) NOT NULL,
  `ue4gpe` int(11) NOT NULL,
  `ue5gpe` int(11) NOT NULL,
  `ue6gpe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Master`
--

CREATE TABLE IF NOT EXISTS `Master` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `RES`
--

CREATE TABLE IF NOT EXISTS `RES` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SAR`
--

CREATE TABLE IF NOT EXISTS `SAR` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SESI`
--

CREATE TABLE IF NOT EXISTS `SESI` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `SFPN`
--

CREATE TABLE IF NOT EXISTS `SFPN` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `STL`
--

CREATE TABLE IF NOT EXISTS `STL` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `UEGroupes`
--

CREATE TABLE IF NOT EXISTS `UEGroupes` (
  `groupe` varchar(10) NOT NULL,
  `effectif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `ANDROIDE`
--
ALTER TABLE `ANDROIDE`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `BIM`
--
ALTER TABLE `BIM`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `DAC`
--
ALTER TABLE `DAC`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `IMA`
--
ALTER TABLE `IMA`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `ListeEtudiants`
--
ALTER TABLE `ListeEtudiants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Master`
--
ALTER TABLE `Master`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `RES`
--
ALTER TABLE `RES`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `SAR`
--
ALTER TABLE `SAR`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `SESI`
--
ALTER TABLE `SESI`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `SFPN`
--
ALTER TABLE `SFPN`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `STL`
--
ALTER TABLE `STL`
  ADD PRIMARY KEY (`rang`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `ANDROIDE`
--
ALTER TABLE `ANDROIDE`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `BIM`
--
ALTER TABLE `BIM`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `DAC`
--
ALTER TABLE `DAC`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `IMA`
--
ALTER TABLE `IMA`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ListeEtudiants`
--
ALTER TABLE `ListeEtudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Master`
--
ALTER TABLE `Master`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `RES`
--
ALTER TABLE `RES`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `SAR`
--
ALTER TABLE `SAR`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `SESI`
--
ALTER TABLE `SESI`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `SFPN`
--
ALTER TABLE `SFPN`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `STL`
--
ALTER TABLE `STL`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
