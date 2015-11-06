-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 06 Novembre 2015 à 15:36
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `nao`
--
CREATE DATABASE IF NOT EXISTS `nao` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `nao`;

-- --------------------------------------------------------

--
-- Structure de la table `niveau`
--

CREATE TABLE IF NOT EXISTS `niveau` (
  `idniveau` int(2) NOT NULL,
  `libelle_niveau` varchar(30) NOT NULL,
  PRIMARY KEY (`idniveau`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `niveau`
--

INSERT INTO `niveau` (`idniveau`, `libelle_niveau`) VALUES
(1, 'CP'),
(2, 'CM1'),
(3, '6eme');

-- --------------------------------------------------------

--
-- Structure de la table `texte`
--

CREATE TABLE IF NOT EXISTS `texte` (
  `idtexte` int(5) NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `corps` text NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `niveau` int(2) NOT NULL,
  PRIMARY KEY (`idtexte`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `texte`
--

INSERT INTO `texte` (`idtexte`, `titre`, `corps`, `auteur`, `niveau`) VALUES
(1, 'les joujous', 'les bijoux de benny', 'moi', 1),
(7, 'Le corbeau et le renard', 'Maître corbeau tenez en son bec un fromage...', 'La Fontaine', 2),
(3, 'blanche neige et les 7 mains', 'simplet, grincheux et toute la bande ', 'Walt Disney', 2);

-- --------------------------------------------------------

--
-- Structure de la table `typecompte`
--

CREATE TABLE IF NOT EXISTS `typecompte` (
  `idtype` int(1) NOT NULL,
  `libelle` varchar(15) NOT NULL,
  PRIMARY KEY (`idtype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `typecompte`
--

INSERT INTO `typecompte` (`idtype`, `libelle`) VALUES
(0, 'Administrateur'),
(1, 'particulier'),
(2, 'enseignant ');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `motdepasse` varchar(16) NOT NULL,
  `typecompte` int(1) NOT NULL,
  `datecreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`nom`, `prenom`, `email`, `motdepasse`, `typecompte`, `datecreation`) VALUES
('MOKNINE', 'Bastien', 'b.moknine@gmail.com', '0000', 3, '2015-10-21 15:33:21'),
('DAVID', 'Benjamin', 'bhhbhhb@jjjoj.fr', '2302', 0, '2015-10-21 15:34:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
