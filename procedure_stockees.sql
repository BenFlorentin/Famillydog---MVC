delimiter $

DROP procedure IF EXISTS sp_nbJoursTotal $

CREATE procedure sp_nbJoursTotal (
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
END
$

-- tests
set @nbJoursTot = 0 $
set @nbJoursBla = 0 $
set @nbJoursBle = 0 $
set @nbJoursRou = 0 $
-- négociant inexistant
call sp_nbJoursTotal('2016-01-08','2016-01-15', 
					 '2016-01-01','2016-01-10',
                     '2016-01-11','2016-01-20',
                     '2016-01-21','2016-01-30',
                     @nbJoursTot, @nbJoursBla, @nbJoursBle, @nbJoursRou) $
-- négociant existant
select @nbJoursTot $
select @nbJoursBla $
select @nbJoursBle $
select @nbJoursRou $