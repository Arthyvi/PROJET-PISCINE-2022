-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : sam. 28 mai 2022 à 01:38
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
  `Password1` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`IDpersonne`, `Nom`, `Prenom`, `Password1`) VALUES
('AD-00001', 'Louis', 'Philipo', '12'),
('AD-00002', 'izekjfe', 'qrzes', '14');

-- --------------------------------------------------------

--
-- Structure de la table `chat-clientmedecin`
--

DROP TABLE IF EXISTS `chat-clientmedecin`;
CREATE TABLE IF NOT EXISTS `chat-clientmedecin` (
  `IDmessage` text NOT NULL,
  `IDmedecin` text NOT NULL,
  `message` text NOT NULL,
  `IDclient` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `chat-clientmedecin`
--

INSERT INTO `chat-clientmedecin` (`IDmessage`, `IDmedecin`, `message`, `IDclient`) VALUES
('CL-00001', 'MD-00002', 'Bonjour', 'CL-00001');

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
  `Password1` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`IDpersonne`, `Nom`, `Prenom`, `AdresseLigne1`, `AdresseLigne2`, `Ville`, `CodePostal`, `Pays`, `NumTelephone`, `NumCarteVital`, `Password1`) VALUES
('CL-00001', 'Tutur', 'el diablo', 'dubai', 'The Moon', 'Paris', 12344, 'France', 698829102, 1023032131, '12345'),
('CL-00002', 'Lulu', 'el maxooo', 'Paris Plage', 'Mars', 'Nice', 23423, 'Espagne', 627839185, 131231313, 'azerty'),
('CL-00003', 'Keke', 'cece', 'Panam', ';jhh,', 'Paris', 8370, 'Belgique', 88769332, 23431, '11'),
('CL-00004', 'The KEKE', 'CV', '57 Avenue de Buzenvale', '!kjjlk', 'Rueil-Malmaison', 92500, 'Suede', 695681056, 123123, '13'),
('CL-00005', 'Cerceau', 'CV', '57 Avenue de Buzenvale', '!kjjlk', 'Rueil-Malmaison', 92500, 'Marseille', 695681056, 123123, '1'),
('CL-00006', 'Cerceau', 'CV', '57 Avenue de Buzenvale', '!kjjlk', 'Rueil-Malmaison', 92500, 'Marseille', 695681056, 123123, '22'),
('CL-00007', 'Cerceau', 'CV', '57 Avenue de Buzenvale', '!kjjlk', 'Rueil-Malmaison', 92500, 'jhdjqsk', 995681056, 13123, '1');

-- --------------------------------------------------------

--
-- Structure de la table `identifiant`
--

DROP TABLE IF EXISTS `identifiant`;
CREATE TABLE IF NOT EXISTS `identifiant` (
  `Identifiant` text NOT NULL,
  `IDpersonne` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `identifiant`
--

INSERT INTO `identifiant` (`Identifiant`, `IDpersonne`) VALUES
('1@gmail.com', 'CL-00001'),
('2', 'CL-00002'),
('11', 'AD-00001'),
('4@edu.ece.fr', 'AD-00002'),
('19@1', 'MD-00001'),
('00@7', 'MD-00002'),
('01', 'CL-00003'),
('AAA', 'CL-00004'),
('eleo@edu.ece.fr', 'MD-00009'),
('lucas.fevre@edu.ece.fr', 'MD-00008'),
('kevin.cerceau@edu.ece.fr', 'MD-00007'),
('mister.v@yahoo.fr', 'MD-00006'),
('jeff.tuche@hotmail.fr', 'MD-00005'),
('docteur.maboul@free.fr', 'MD-00004'),
('docteur.juiphe@gmail.com', 'MD-00003'),
('kevin.cerceau@zez', 'CL-00006'),
('kevin.cerceau@zeze', 'CL-00005'),
('kevin.cerceau@Testo', 'CL-00007'),
('kevin.cerceau@edu.ece', 'CL-00007');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `laboratoire`
--

INSERT INTO `laboratoire` (`IDlabo`, `NomLab`, `Salle`, `Mail`, `NumTelephone`, `ServicesProposer`) VALUES
(1, 'Pfizer3', 'C3153', 'pfizer@mail.com3', 12312323, 63),
(2, 'Moderna', 'P430', 'moderna@orange.fr', 13123123, 0),
(3, 'Doliprane', 'G004', 'kze@zedzed', 123123, 1),
(4, 'Academics', 'EM001', 'kzjefdd@qdsdz', 131231, 1),
(5, 'Aerius', 'P316', 'kzedj@qzed', 123123, 20),
(6, 'TestoPharma', 'SC119', 'qzfsqsd@ZEFZE', 12312, 20);

-- --------------------------------------------------------

--
-- Structure de la table `medecin`
--

DROP TABLE IF EXISTS `medecin`;
CREATE TABLE IF NOT EXISTS `medecin` (
  `IDpersonne` text NOT NULL,
  `Nom` text NOT NULL,
  `Prenom` text NOT NULL,
  `Password1` text NOT NULL,
  `NumTelephone` int(11) NOT NULL,
  `Specialisation` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `medecin`
--

INSERT INTO `medecin` (`IDpersonne`, `Nom`, `Prenom`, `Password1`, `NumTelephone`, `Specialisation`) VALUES
('MD-00001', 'Sins', 'Jonhhy', '23', 687872189, 'Gynecologue'),
('MD-00002', 'Vinhas', 'Arthur', '12345', 4444499, 'Generaliste'),
('MD-00004', 'Maboul', 'Didier', '0000', 1234567890, 'Cardiologue'),
('MD-00005', 'Tuche', 'Jeff', '1111', 611223344, 'Gastro-Hepatho-Enterologue'),
('MD-00003', 'Juiphe', 'Pierre', '1234', 612345678, 'Addictologue'),
('MD-00006', 'V', 'Yvick', '9999', 999999999, 'Andrologue'),
('MD-00007', 'Cerceau', 'Kevin', '5678', 666666666, 'Generaliste'),
('MD-00008', 'Fevre', 'Lucas', '9012', 777777777, 'Generaliste'),
('MD-00009', 'DOS SANTOS RIBALONGA BASSIRI', 'Eleonore', '2345', 111111111, 'Generaliste');

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
