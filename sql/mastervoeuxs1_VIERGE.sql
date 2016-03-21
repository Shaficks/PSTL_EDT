-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 13 Mars 2016 à 20:47
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mastervoeuxs1`
--

-- --------------------------------------------------------

--
-- Structure de la table `androide`
--

CREATE TABLE `androide` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bim`
--

CREATE TABLE `bim` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `dac`
--

CREATE TABLE `dac` (
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
-- Structure de la table `ima`
--

CREATE TABLE `ima` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `listeetudiants`
--

CREATE TABLE `listeetudiants` (
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
-- Structure de la table `master`
--

CREATE TABLE `master` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `res`
--

CREATE TABLE `res` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sar`
--

CREATE TABLE `sar` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sesi`
--

CREATE TABLE `sesi` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sfpn`
--

CREATE TABLE `sfpn` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stl`
--

CREATE TABLE `stl` (
  `numetu` int(11) NOT NULL,
  `rang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `uegroupes`
--

CREATE TABLE `uegroupes` (
  `groupe` varchar(10) NOT NULL,
  `effectif` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `androide`
--
ALTER TABLE `androide`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `bim`
--
ALTER TABLE `bim`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `dac`
--
ALTER TABLE `dac`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `edt_ideal`
--
ALTER TABLE `edt_ideal`
  ADD PRIMARY KEY (`numetu`);

--
-- Index pour la table `ima`
--
ALTER TABLE `ima`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `listeetudiants`
--
ALTER TABLE `listeetudiants`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `res`
--
ALTER TABLE `res`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `sar`
--
ALTER TABLE `sar`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `sesi`
--
ALTER TABLE `sesi`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `sfpn`
--
ALTER TABLE `sfpn`
  ADD PRIMARY KEY (`rang`);

--
-- Index pour la table `stl`
--
ALTER TABLE `stl`
  ADD PRIMARY KEY (`rang`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `androide`
--
ALTER TABLE `androide`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bim`
--
ALTER TABLE `bim`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `dac`
--
ALTER TABLE `dac`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `ima`
--
ALTER TABLE `ima`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `listeetudiants`
--
ALTER TABLE `listeetudiants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `master`
--
ALTER TABLE `master`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `res`
--
ALTER TABLE `res`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sar`
--
ALTER TABLE `sar`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sesi`
--
ALTER TABLE `sesi`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sfpn`
--
ALTER TABLE `sfpn`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `stl`
--
ALTER TABLE `stl`
  MODIFY `rang` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
