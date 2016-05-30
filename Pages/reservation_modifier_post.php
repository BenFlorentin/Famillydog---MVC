<?php 

include'include/session.php';

include'include/connexion_bdd.php';

include'functions.sql';
include'procedure_stockees.sql';

$dateDebut = explode('/', $_POST['from']);
$DebutJourTeste = $dateDebut[0];
$DebutMoisTeste = $dateDebut[1];
$DebutAnneeTeste = $dateDebut[2];

$dateFin = explode('/', $_POST['to']);
$FinJourTeste = $dateFin[0];
$FinMoisTeste = $dateFin[1];
$FinAnneeTeste = $dateFin[2];


if(checkdate($DebutMoisTeste, $DebutJourTeste, $DebutAnneeTeste))
{
	unset($_SESSION['E_DATE_DEBUT']);

	if(checkdate($FinMoisTeste, $FinJourTeste, $FinAnneeTeste))
	{
		unset($_SESSION['E_DATE_FIN']);

		$newDateDebut = DateTime::createFromFormat('j/m/Y', $_POST['from']);
		$newDateFin = DateTime::createFromFormat('j/m/Y', $_POST['to']);


		$oi = $bdd->query('SELECT YEAR(saison_debut) FROM tarifs');
		$oip = $oi->fetch();

		$u = $bdd->prepare("SELECT * FROM tarifs WHERE ? = ?");
		$u->execute(array($DebutAnneeTeste, $oip['0']));
		$tir = $u->fetch();
			
		$prixBla = $tir['prix_jour_bla'];
		$prixBle = $tir['prix_jour_ble'];
		$prixRou = $tir['prix_jour_rou'];

		$oi->closeCursor();

		$nbJoursBla = 0;
		$nbJoursBle = 0;
		$nbJoursRou = 0;

		$u = $bdd->query("SELECT * FROM tarifs");	
		while($tarifs = $u ->fetch())
		{
			// nombre de jours dans la période blanche
			$p = $bdd->prepare("SELECT f_dateVerifBla(?,?,?,?)");
			$p->execute(array($newDateDebut->format('Y-m-d'),
								$newDateFin->format('Y-m-d'),
								$tarifs['date_debut_bla'],
								$tarifs['date_fin_bla']));
			$po = $p->fetch();
			$nbJoursBla += $po['0'];

			$p->closeCursor();


			// nombre de jours dans la période bleue
			$p = $bdd->prepare("SELECT f_dateVerifBle(?,?,?,?)");
			$p->execute(array($newDateDebut->format('Y-m-d'),
								$newDateFin->format('Y-m-d'),
								$tarifs['date_debut_ble'],
								$tarifs['date_fin_ble']));
			$po = $p->fetch();
			$nbJoursBle += $po['0'];
			$p->closeCursor();


			// nombre de jours dans la période rouge
			$p = $bdd->prepare("SELECT f_dateVerifRou(?,?,?,?)");
			$p->execute(array($newDateDebut->format('Y-m-d'),
								$newDateFin->format('Y-m-d'),
								$tarifs['date_debut_rou'],
								$tarifs['date_fin_rou']));
			$po = $p->fetch();
			$nbJoursRou += $po['0'];
			$p->closeCursor();

		}
			$prixJoursBla = $nbJoursBla * $prixBla;
			$prixJoursBle = $nbJoursBle * $prixBle;
			$prixJoursRou = $nbJoursRou * $prixRou;



			// nombre de jours total !
			$p = $bdd->prepare("SELECT ?+?+?");
			$p->execute(array($nbJoursBla,$nbJoursBle,$nbJoursRou));
			$po=$p->fetch();

			$nbJoursTotal = $po['0'];
			$p->closeCursor();	

			// prix total !
			$p = $bdd->prepare("SELECT ?+?+?");
			$p->execute(array($prixJoursBla,$prixJoursBle,$prixJoursRou));
			$po=$p->fetch();

			$prixTotal = $po['0'];
			$p->closeCursor();	


			if($u)
			{
				$u->closeCursor();

				unset($_SESSION['E_RESERVATION_MODIFIER']);

				$u = $bdd->prepare('UPDATE reservation
									SET ID_animal = ?,
										date_debut = ?,
										date_fin = ?,
										nb_jours_tot = ?,
										nb_jours_bla = ?,
										nb_jours_ble = ?,
										nb_jours_rou = ?,
										prix = ?
									WHERE ID = ?');
				$u->execute(array($_SESSION['ID_animal'],
									$newDateDebut->format('Y-m-d'),
									$newDateFin->format('Y-m-d'), 
									$nbJoursTotal, 
									$nbJoursBla, 
									$nbJoursBle, 
									$nbJoursRou, 
									$prixTotal, 
									$_SESSION['ID_reservation']));

				$_SESSION['V_RESERVATION_MODIFIER'] = true;

				header('Location: compte.php');
			}
			else
			{
				unset($_SESSION['V_RESERVATION_MODIFIER']);
				$_SESSION['E_RESERVATION_MODIFIER'] = true;

				header('Location:reservation_modifier.php');	
			}
		

		/*$a = $bdd->prepare("CALL sp_nbJoursTotal(?,?,?,?,?,?,?,?,?,?,?,?)");
		$a-> execute(array($newDateDebut->format('Y-m-d'),
							$newDateFin->format('Y-m-d'),
							$tarifs['date_debut_bla'],
							$tarifs['date_fin_bla'],
							$tarifs['date_debut_ble'],
							$tarifs['date_fin_ble'],
							$tarifs['date_debut_rou'],
							$tarifs['date_fin_rou'],
							$nbJoursTotal,
							$nbJoursBla,
							$nbJoursBle,
							$nbJoursRou));*/


	}
	else
	{
		unset($_SESSION['V_RESERVATION_MODIFIER']);
		$_SESSION['E_DATE_FIN'] = true;
		header('Location: reservation_modifier.php');
	}
}
else
{
	unset($_SESSION['V_RESERVATION_MODIFIER']);
	$_SESSION['E_DATE_DEBUT'] = true;

	header('Location:reservation_modifier.php');
}
?>