-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 24 mai 2022 à 09:08
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet piscine 2022`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `IDpersonne` text NOT NULL,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `Password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`IDpersonne`, `Nom`, `Prenom`, `Password`) VALUES
('AD-00001', 'Louis', 'Philipo', '12'),
('AD-00002', 'izekjfe', 'qrzes', '14');

-- --------------------------------------------------------

--
-- Structure de la table `chat-clientmedecin`
--

DROP TABLE IF EXISTS `chat-clientmedecin`;
CREATE TABLE IF NOT EXISTS `chat-clientmedecin` (
  `IDmessage` int(11) NOT NULL AUTO_INCREMENT,
  `IDmedecin` text NOT NULL,
  `message` text NOT NULL,
  `IDclient` text NOT NULL,
  `NumMessageConv` int(11) NOT NULL,
  PRIMARY KEY (`IDmessage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `IDpersonne` text NOT NULL,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `AdresseLigne1` text NOT NULL,
  `AdresseLigne2` text NOT NULL,
  `Ville` text NOT NULL,
  `CodePostal` int(11) NOT NULL,
  `Pays` text NOT NULL,
  `NumTelephone` int(11) NOT NULL,
  `NumCarteVital` int(11) NOT NULL,
  `Password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IDpersonne`, `Nom`, `Prenom`, `AdresseLigne1`, `AdresseLigne2`, `Ville`, `CodePostal`, `Pays`, `NumTelephone`, `NumCarteVital`, `Password`) VALUES
('CL-00001', 'Tutur', 'el diablo', 'dubai', 'The Moon', 'Paris', 12344, 'France', 698829102, 1023032131, '12345'),
('CL-00002', 'Lulu', 'el maxooo', 'Paris Plage', 'Mars', 'Nice', 23423, 'Espagne', 627839185, 131231313, 'azerty'),
('CL-00003', 'Keke', 'cece', 'Panam', ';jhh,', 'Paris', 8370, 'Belgique', 88769332, 23431, '11'),
('CL-00004', 'The KEKE', 'CV', '57 Avenue de Buzenvale', '!kjjlk', 'Rueil-Malmaison', 92500, 'Suede', 695681056, 123123, '13');

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

DROP TABLE IF EXISTS `identifiant`;
CREATE TABLE IF NOT EXISTS `identifiant` (
  `Identifiant(mail)` text NOT NULL,
  `IDpersonne` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `identifiant`
--

INSERT INTO `identifiant` (`Identifiant(mail)`, `IDpersonne`) VALUES
('1@gmail.com', 'CL-00001'),
('2', 'CL-00002'),
('11', 'AD-00001'),
('4@edu.ece.fr', 'AD-00002'),
('19', 'MD-00001'),
('00', 'MD-00002'),
('01', 'CL-00003'),
('AAA', 'CL-00004');

-- --------------------------------------------------------

--
-- Structure de la table `laboratoire`
--

DROP TABLE IF EXISTS `laboratoire`;
CREATE TABLE IF NOT EXISTS `laboratoire` (
  `IDlabo` int(11) NOT NULL AUTO_INCREMENT,
  `NomLab` text NOT NULL,
  `Salle` text NOT NULL,
  `Mail` text NOT NULL,
  `NumTelephone` int(11) NOT NULL,
  `ServicesProposer` int(11) NOT NULL,
  PRIMARY KEY (`IDlabo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `IDpersonne` text NOT NULL,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `Password` text NOT NULL,
  `NumTelephone` int(11) NOT NULL,
  `Specialisation` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`IDpersonne`, `Nom`, `Prenom`, `Password`, `NumTelephone`, `Specialisation`) VALUES
('MD-00001', 'Johnny', 'Sins', '23', 687872189, 'Gynecologue'),
('MD-00002', 'Arthur', 'VINHAS OAKJNDOLZQKJ', '12345', 68928912, 'Specialiste I.S.T');

-- --------------------------------------------------------

--
-- Structure de la table `rdvlabo-client`
--

DROP TABLE IF EXISTS `rdvlabo-client`;
CREATE TABLE IF NOT EXISTS `rdvlabo-client` (
  `IDrdv` int(11) NOT NULL AUTO_INCREMENT,
  `IDlabo` int(11) NOT NULL,
  `Jour` text NOT NULL,
  `Horaire` text NOT NULL,
  `ServiceSelectionner` text NOT NULL,
  `IDclient` text NOT NULL,
  PRIMARY KEY (`IDrdv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rdvmedecin-client`
--

DROP TABLE IF EXISTS `rdvmedecin-client`;
CREATE TABLE IF NOT EXISTS `rdvmedecin-client` (
  `IDrdv` int(11) NOT NULL AUTO_INCREMENT,
  `IDmedecin` text NOT NULL,
  `Jour` text NOT NULL,
  `horaire` text NOT NULL,
  `IDclient` text NOT NULL,
  PRIMARY KEY (`IDrdv`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
