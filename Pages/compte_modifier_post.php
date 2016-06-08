<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$date = explode('/', $_POST['date_naissance']);
$jourTeste = $date[0];
$moisTeste = $date[1];
$anneeTeste = $date[2];

$dateToday = explode('/', date('d/m/Y',time()));
$dayToday = $dateToday[0];
$monthToday = $dateToday[1];
$yearToday = $dateToday[2];

$newDate = DateTime::createFromFormat('j/m/Y', $_POST['date_naissance']);

$_SESSION['ID_USER_TEMP'] = $_POST['ID'];

include'include/session.php';($newDate);


if(checkdate($moisTeste, $jourTeste, $anneeTeste))
{
	if($anneeTeste <= $yearToday)
	{

		if($anneeTeste == $yearToday && $moisTeste <= $monthToday)
		{
			if($jourTeste <= $dayToday)
			{
				unset($_SESSION['E_JOUR']);
				unset($_SESSION['E_MOIS']);
				unset($_SESSION['E_ANNEE']);
				unset($_SESSION['E_JOUR_MOIS_ANNEE']);
				unset($_SESSION['V_USER']);

				


				$u = $bdd->prepare('UPDATE proprietaire
									SET genre = ?,
										nom = ?,
										prenom = ?,
										collectivites = ?,
										tel = ?,
										fix = ?,
										fax = ?,
										email = ?,
										mdp = ?,
										rue_voie = ?,
										num_rue_voie = ?,
										ville = ?,
										pays = ?,
										code_postal = ?,
										complem_adr = ?,
										complem_info = ?,
										date_naissance = ?
									 WHERE ID = ?');
				$u->execute(array($_POST['genre'],
								$_POST['nom'],
								$_POST['prenom'],
								$_POST['collectivites'],
								$_POST['tel'],
								$_POST['fix'],
								$_POST['fax'],
								$_POST['email'],
								$_POST['mdp'],
								$_POST['rue_voie'],
								$_POST['num_rue_voie'],
								$_POST['ville'],
								$_POST['pays'],
								$_POST['code_postal'],
								$_POST['complem_adr'],
								$_POST['complem_info'],
								$newDate->format('Y-m-d'),
								$_POST['ID']));

				if($u)
				{
					$u->closeCursor();

					unset($_SESSION['E_USER']);
					$_SESSION['V_USER'] = true;

					header('Location:compte_infos.php');
				}
				else
				{
					$_SESSION['E_USER'] = true;

					header('Location:compte_infos.php');	
				}


			}
			else
			{
				$_SESSION['E_JOUR'] = true;

				unset($_SESSION['E_MOIS']);
				unset($_SESSION['E_ANNEE']);
				unset($_SESSION['E_JOUR_MOIS_ANNEE']);
				unset($_SESSION['E_USER']);
				unset($_SESSION['V_USER']);

				header('Location:compte_infos.php');
			}
		}
		else
		{
			unset($_SESSION['E_JOUR']);
			unset($_SESSION['E_MOIS']);
			unset($_SESSION['E_ANNEE']);
			unset($_SESSION['E_JOUR_MOIS_ANNEE']);
			unset($_SESSION['V_USER']);
			

			$u = $bdd->prepare('UPDATE proprietaire
									SET genre = ?,
										nom = ?,
										prenom = ?,
										collectivites = ?,
										tel = ?,
										fix = ?,
										fax = ?,
										email = ?,
										mdp = ?,
										rue_voie = ?,
										num_rue_voie = ?,
										ville = ?,
										pays = ?,
										code_postal = ?,
										complem_adr = ?,
										complem_info = ?,
										date_naissance = ?
									 WHERE ID = ?');
				$u->execute(array($_POST['genre'],
								$_POST['nom'],
								$_POST['prenom'],
								$_POST['collectivites'],
								$_POST['tel'],
								$_POST['fix'],
								$_POST['fax'],
								$_POST['email'],
								$_POST['mdp'],
								$_POST['rue_voie'],
								$_POST['num_rue_voie'],
								$_POST['ville'],
								$_POST['pays'],
								$_POST['code_postal'],
								$_POST['complem_adr'],
								$_POST['complem_info'],
								$newDate->format('Y-m-d'),
								$_POST['ID']));

			if($u)
			{
				$u->closeCursor();

				unset($_SESSION['E_USER']);
				$_SESSION['V_USER'] = true;

				header('Location:compte_infos.php');
			}
			else
			{
				$u->closeCursor();
				$_SESSION['E_USER'] = true;


				header('Location:compte_infos.php');	
			}

		}
	}
	else
	{

		$_SESSION['E_ANNEE'] = true;

		unset($_SESSION['E_JOUR']);
		unset($_SESSION['E_MOIS']);
		unset($_SESSION['E_JOUR_MOIS_ANNEE']);
		unset($_SESSION['E_USER']);
		unset($_SESSION['V_USER']);

		header('Location:compte_infos.php');
	}
}
else
{
	$_SESSION['E_JOUR_MOIS_ANNEE'] = true;

	unset($_SESSION['E_JOUR']);
	unset($_SESSION['E_MOIS']);
	unset($_SESSION['E_ANNEE']);
	unset($_SESSION['E_USER']);
	unset($_SESSION['V_USER']);
	header('Location:compte_infos.php');
}
?>