delimiter $

DROP procedure IF EXISTS sp_nbJoursTotal $

CREATE procedure sp_nbJoursTotal (
	IN p_dateDebut date,
    IN p_dateFin date,
    IN p_dateDebutSaison date,
    IN p_dateFinSaison date,
    OUT p_nbJoursTot int
    )
READS SQL DATA
BEGIN
    select f_nbJoursTotals(p_dateDebut, p_dateFin, p_dateDebutSaison, p_dateFinSaison) INTO p_nbJoursTot;
END
$

-- tests
set @nbJoursTot = 0 $
-- négociant inexistant
call sp_nbJoursTotal('2016-01-08','2016-01-15', 
					 '2016-01-01','2016-12-30',
                     @nbJoursTot) $
-- négociant existant
select @nbJoursTot $