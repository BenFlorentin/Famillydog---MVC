-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 11 Février 2016 à 10:12
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `famillydog`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_nbJoursTotal`(
	IN p_dateDebut date,
    IN p_dateFin date,
    IN p_dateDebutBla date,
    IN p_dateFinBla date,
    IN p_dateDebutBle date,
    IN p_dateFinBle date,
    IN p_dateDebutRou date,
    IN p_dateFinRou date,
    OUT p_nbJoursTot int,
    OUT p_nbJoursBla int,
    OUT p_nbJoursBle int,
    OUT p_nbJoursRou int
    )
    READS SQL DATA
BEGIN
	
	select f_dateVerifBla(p_dateDebut, p_dateFin, p_dateDebutBla, p_dateFinBla) INTO p_nbJoursBla;
    select f_dateVerifBle(p_dateDebut, p_dateFin, p_dateDebutBle, p_dateFinBle) INTO p_nbJoursBle;
    select f_dateVerifRou(p_dateDebut, p_dateFin, p_dateDebutRou, p_dateFinRou) INTO p_nbJoursRou;
    
	select (p_nbJoursBla + p_nbJoursBle + p_nbJoursRou) INTO p_nbJoursTot;
END$$

--
-- Fonctions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_dateVerifBla`(
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutBla date, 
    p_dateFinBla date
) RETURNS int(11)
    READS SQL DATA
BEGIN
	DECLARE v_nb INT;
    -- tester l'existence du négociant
    IF p_dateDebut >= p_dateDebutBla AND p_dateDebut <= p_dateFinBla THEN
		IF p_dateFin <= p_dateFinBla THEN
				SELECT DATEDIFF(p_dateFin, p_dateDebut) +1 INTO v_nb;
		else
				SELECT DATEDIFF(p_dateFinBla, p_dateDebut) +1 INTO v_nb;
		END IF;
	else
		IF p_dateFin >= p_dateDebutBla AND p_dateFin <= p_dateFinBla THEN
			SELECT DATEDIFF(p_dateFin, p_dateDebutBla) + 1 INTO v_nb;
		ELSE
			SET v_nb := 0;
		END IF;
	end if;
    RETURN v_nb;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_dateVerifBle`(
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutBle date, 
    p_dateFinBle date
) RETURNS int(11)
    READS SQL DATA
BEGIN
	DECLARE v_nb INT;
    -- tester l'existence du négociant
    IF p_dateDebut >= p_dateDebutBle AND p_dateDebut <= p_dateFinBle THEN
		IF p_dateFin <= p_dateFinBle THEN
				SELECT DATEDIFF(p_dateFin, p_dateDebut) +1 INTO v_nb;
		else
				SELECT DATEDIFF(p_dateFinBle, p_dateDebut) +1 INTO v_nb;
		END IF;
	else
		IF p_dateFin >= p_dateDebutBle AND p_dateFin <= p_dateFinBle THEN
			SELECT DATEDIFF(p_dateFin, p_dateDebutBle) + 1 INTO v_nb;
		ELSE
			SET v_nb := 0;
		END IF;
	end if;
    RETURN v_nb;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_dateVerifRou`(
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutRou date, 
    p_dateFinRou date
) RETURNS int(11)
    READS SQL DATA
BEGIN
    DECLARE v_nb INT;
    -- tester l'existence du négociant
    IF p_dateDebut >= p_dateDebutRou AND p_dateDebut <= p_dateFinRou THEN
		IF p_dateFin <= p_dateFinRou THEN
				SELECT DATEDIFF(p_dateFin, p_dateDebut) +1 INTO v_nb;
		else
				SELECT DATEDIFF(p_dateFinRou, p_dateDebut) +1 INTO v_nb;
		END IF;
	else
		IF p_dateFin >= p_dateDebutRou AND p_dateFin <= p_dateFinRou THEN
			SELECT DATEDIFF(p_dateFin, p_dateDebutRou) + 1 INTO v_nb;
		ELSE
			SET v_nb := 0;
		END IF;
	end if;
    RETURN v_nb;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_dateVerifTarifs`(
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutSaison date, 
    p_dateFinSaison date
) RETURNS int(11)
    READS SQL DATA
BEGIN
    DECLARE v_verif INT;
    -- tester l'existence du tarifs
    IF p_dateDebut >= p_dateDebutSaison AND p_dateDebut <= p_dateFinSaison THEN
		SET v_verif := -1;
	ELSE
		IF p_dateFin >= p_dateDebutSaison AND p_dateFin <= p_dateFinSaison THEN
			SET v_verif := -2;
		ELSE
			IF p_dateDebut <= p_dateDebutSaison AND p_dateFin >= p_dateFinSaison THEN
				SET v_verif := -3;
			ELSE
				SET v_verif := 1;
			END IF;
		END IF;
	END IF;
    RETURN v_verif;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

CREATE TABLE IF NOT EXISTS `animal` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_proprietaire` int(11) NOT NULL,
  `type` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `date_naissance` date NOT NULL,
  `genre` varchar(10) NOT NULL,
  `complem_info` text,
  `vaccine` varchar(5) NOT NULL,
  `puce` varchar(5) NOT NULL,
  `race` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `animal`
--

INSERT INTO `animal` (`ID`, `ID_proprietaire`, `type`, `nom`, `date_naissance`, `genre`, `complem_info`, `vaccine`, `puce`, `race`) VALUES
(1, 3, 'Chat', 'unAnimal', '2013-10-25', 'F', '', 'Oui', 'Non', 'uneRace'),
(2, 3, 'Chien', 'zhrhreh', '2012-08-25', 'F', 'Je m''appelle Manon !', 'Non', 'Oui', 'erherherher');

-- --------------------------------------------------------

--
-- Structure de la table `messagerie`
--

CREATE TABLE IF NOT EXISTS `messagerie` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `sujet` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `tel` varchar(10) NOT NULL,
  `etat` varchar(1) NOT NULL DEFAULT 'E',
  `date_msg` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `messagerie`
--

INSERT INTO `messagerie` (`ID`, `nom`, `prenom`, `email`, `sujet`, `message`, `tel`, `etat`, `date_msg`) VALUES
(2, 'Florentin', 'Ben', 'florentin.ben@gmail.com', 'amelioration', 'Salut !', '0610343243', 'E', '2016-01-16'),
(5, 'egezg', 'ezgezgez', 'ezgezgezgz@gezopgze.com', 'ezoghezoh', 'ezegpjze)gjezrghergherhgeràààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààààà TEST', '0649786594', 'R', '2016-01-16');

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `genre` varchar(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `collectivites` varchar(500) DEFAULT NULL,
  `tel` varchar(10) NOT NULL,
  `fix` varchar(10) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `mdp` varchar(50) NOT NULL,
  `rue_voie` varchar(50) NOT NULL,
  `num_rue_voie` int(3) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `pays` varchar(50) NOT NULL,
  `code_postal` int(5) NOT NULL,
  `complem_adr` text,
  `complem_info` text,
  `date_naissance` date NOT NULL,
  `droit` int(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=61 ;

--
-- Contenu de la table `proprietaire`
--

INSERT INTO `proprietaire` (`ID`, `genre`, `nom`, `prenom`, `collectivites`, `tel`, `fix`, `fax`, `email`, `mdp`, `rue_voie`, `num_rue_voie`, `ville`, `pays`, `code_postal`, `complem_adr`, `complem_info`, `date_naissance`, `droit`) VALUES
(2, 'M.', 'admin', 'admin', '', '0698745698', '', '', 'admin@admin.com', 'admin', 'route nationale', 14, 'Richemont', 'France', 57270, 'le Marabout', '', '1995-09-14', 1),
(3, 'M.', 'test', 'test', '', '0365461654', '', '', 'test@gmail.com', 'test', 'rue', 161, 'ville', 'Pays', 21564, '', '', '1991-07-18', 0),
(30, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(31, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(32, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(33, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(34, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(35, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(36, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(37, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(38, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(39, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(40, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(41, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(42, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(43, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(44, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(45, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(46, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(47, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(48, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(49, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(50, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(51, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(52, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(53, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(54, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(55, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(56, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(57, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(58, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(59, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0),
(60, 'Mlle', 'toto', 'tutu', '', '0641034648', '', '', 'toto@gmail.com', 'toto', 'erepjhyoperjhop', 654, 'trjhpo', 'eriohyioerhyoier', 84848, '', '', '2012-03-24', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_proprietaire` int(11) NOT NULL,
  `ID_animal` int(11) NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `nb_jours_tot` int(11) NOT NULL,
  `nb_jours_bla` int(11) DEFAULT NULL,
  `nb_jours_ble` int(11) DEFAULT NULL,
  `nb_jours_rou` int(11) DEFAULT NULL,
  `prix` decimal(10,0) NOT NULL,
  `etat` varchar(2) NOT NULL DEFAULT 'NP',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `reservation`
--

INSERT INTO `reservation` (`ID`, `ID_proprietaire`, `ID_animal`, `date_debut`, `date_fin`, `nb_jours_tot`, `nb_jours_bla`, `nb_jours_ble`, `nb_jours_rou`, `prix`, `etat`) VALUES
(1, 3, 1, '2016-09-23', '2016-10-02', 10, 0, 2, 8, '94', 'E');

-- --------------------------------------------------------

--
-- Structure de la table `tarifs`
--

CREATE TABLE IF NOT EXISTS `tarifs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `date_debut_bla` date NOT NULL,
  `date_fin_bla` date NOT NULL,
  `date_debut_ble` date NOT NULL,
  `date_fin_ble` date NOT NULL,
  `date_debut_rou` date NOT NULL,
  `date_fin_rou` date NOT NULL,
  `prix_jour_bla` decimal(7,2) NOT NULL,
  `prix_jour_ble` decimal(7,2) NOT NULL,
  `prix_jour_rou` decimal(7,2) NOT NULL,
  `saison_debut` date NOT NULL,
  `saison_fin` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tarifs`
--

INSERT INTO `tarifs` (`ID`, `date_debut_bla`, `date_fin_bla`, `date_debut_ble`, `date_fin_ble`, `date_debut_rou`, `date_fin_rou`, `prix_jour_bla`, `prix_jour_ble`, `prix_jour_rou`, `saison_debut`, `saison_fin`) VALUES
(1, '2016-01-01', '2016-04-30', '2016-10-01', '2016-12-31', '2016-05-01', '2016-09-30', '5.00', '7.00', '10.00', '2016-01-01', '2016-12-31'),
(2, '2017-01-01', '2017-05-31', '2017-10-01', '2017-12-31', '2017-06-01', '2017-09-30', '5.30', '13.60', '7.90', '2017-01-01', '2017-12-31');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
