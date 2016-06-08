delimiter $

/*
Vérifie l'existence d'un tarifs pour la période saisie */

DROP function IF EXISTS f_dateVerifTarifs
$

CREATE FUNCTION f_dateVerifTarifs
(
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutSaison date, 
    p_dateFinSaison date
)
RETURNS INT
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
END ;
$

/*
Retourne le nombre de jours */

DROP function IF EXISTS f_nbJoursTotals
$

CREATE FUNCTION f_nbJoursTotals (
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutSaison date, 
    p_dateFinSaison date
)
RETURNS int
READS SQL DATA
BEGIN
	DECLARE v_nb INT;
    -- tester l'existence du négociant
    IF p_dateDebut >= p_dateDebutSaison AND p_dateDebut <= p_dateFinSaison THEN
		IF p_dateFin <= p_dateFinSaison THEN
				SELECT DATEDIFF(p_dateFin, p_dateDebut) +1 INTO v_nb;
		else
				SELECT DATEDIFF(p_dateFinSaison, p_dateDebut) +1 INTO v_nb;
		END IF;
	else
		IF p_dateFin >= p_dateDebutSaison AND p_dateFin <= p_dateFinSaison THEN
			SELECT DATEDIFF(p_dateFin, p_dateDebutSaison) + 1 INTO v_nb;
		ELSE
			SET v_nb := 0;
		END IF;
	end if;
    RETURN v_nb;
END ;
$