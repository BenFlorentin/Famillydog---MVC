delimiter $


/*
Retourne le nombre de jours qu'il y a dans la période blanche */

DROP function IF EXISTS f_dateVerifBla
$

CREATE FUNCTION f_dateVerifBla (
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutBla date, 
    p_dateFinBla date
)
RETURNS int
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
END ;
$

SELECT f_dateVerifBla('2016-01-01', '2016-01-10', '2016-01-01', '2016-01-10') $
SELECT f_dateVerifBla('2015-01-01', '2016-01-10', '2016-01-01', '2016-05-31') $
SELECT f_dateVerifBla('2016-01-01', '2016-06-10', '2016-01-01', '2016-01-31') $
SELECT f_dateVerifBla('2016-06-31', '2016-01-10', '2016-01-01', '2016-05-31') $
SELECT f_dateVerifBla('2016-01-01', '2016-01-10', '2016-01-01', '2016-05-31') $




/*
Retourne le nombre de jours qu'il y a dans la période bleue */

DROP function IF EXISTS f_dateVerifBle
$

CREATE FUNCTION f_dateVerifBle (
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutBle date, 
    p_dateFinBle date
)
RETURNS int
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
END ;
$

/*
Retourne le nombre de jours qu'il y a dans la période rouge */

DROP function IF EXISTS f_dateVerifRou
$

CREATE FUNCTION f_dateVerifRou (
	p_dateDebut date,
    p_dateFin date,
    p_dateDebutRou date, 
    p_dateFinRou date
)
RETURNS int
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
END ;
$