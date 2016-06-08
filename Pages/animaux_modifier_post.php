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

include'include/session.php';($anneeTeste);
include'include/session.php';($yearToday);
include'include/session.php';($_POST);
include'include/session.php';($_SESSION);
$newDate = DateTime::createFromFormat('j/m/Y', $_POST['date_naissance']);


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
				unset($_SESSION['V_ANIMAL']);

				


				$u = $bdd->prepare('UPDATE animal
					SET type = ?,
					nom = ?,
					date_naissance = ?,
					genre = ?,
					complem_info = ?,
					vaccine = ?,
					puce = ?,
					race = ?
					WHERE ID = ?');
				$u->execute(array($_POST['type'],
					$_POST['nom'],
					$newDate->format('Y-m-d'),
					$_POST['genre'],
					$_POST['complem_info'],
					$_POST['vaccine'],
					$_POST['puce'],
					$_POST['race'],
					$_POST['ID_animal']));

				if($u)
				{
					$u->closeCursor();

					unset($_SESSION['E_ANIMAL']);
					$_SESSION['V_ANIMAL'] = true;

					header('Location:animaux.php');
				}
				else
				{
					$_SESSION['E_ANIMAL'] = true;

					header('Location:animaux.php');	
				}


			}
			else
			{
				$_SESSION['E_JOUR'] = true;

				unset($_SESSION['E_MOIS']);
				unset($_SESSION['E_ANNEE']);
				unset($_SESSION['E_JOUR_MOIS_ANNEE']);
				unset($_SESSION['E_ANIMAL']);
				unset($_SESSION['V_ANIMAL']);

				header('Location:animaux.php');
			}
		}
		else
		{
			unset($_SESSION['E_JOUR']);
			unset($_SESSION['E_MOIS']);
			unset($_SESSION['E_ANNEE']);
			unset($_SESSION['E_JOUR_MOIS_ANNEE']);
			unset($_SESSION['V_ANIMAL']);
			
			$u = $bdd->prepare('UPDATE animal
				SET type = ?,
				nom = ?,
				date_naissance = ?,
				genre = ?,
				complem_info = ?,
				vaccine = ?,
				puce = ?,
				race = ?
				WHERE ID = ?');
			$u->execute(array($_POST['type'],
				$_POST['nom'],
				$newDate->format('Y-m-d'),
				$_POST['genre'],
				$_POST['complem_info'],
				$_POST['vaccine'],
				$_POST['puce'],
				$_POST['race'],
				$_POST['ID_animal']));


			if($u)
			{
				$u->closeCursor();

				unset($_SESSION['E_ANIMAL']);
				$_SESSION['V_ANIMAL'] = true;

				header('Location:animaux.php');
			}
			else
			{
				$u->closeCursor();
				$_SESSION['E_ANIMAL'] = true;


				header('Location:animaux.php');	
			}

		}
	}
	else
	{

		$_SESSION['E_ANNEE'] = true;

		unset($_SESSION['E_JOUR']);
		unset($_SESSION['E_MOIS']);
		unset($_SESSION['E_JOUR_MOIS_ANNEE']);
		unset($_SESSION['E_ANIMAL']);
		unset($_SESSION['V_ANIMAL']);

		header('Location:animaux.php');
	}
}
else
{
	$_SESSION['E_JOUR_MOIS_ANNEE'] = true;

	unset($_SESSION['E_JOUR']);
	unset($_SESSION['E_MOIS']);
	unset($_SESSION['E_ANNEE']);
	unset($_SESSION['E_ANIMAL']);
	unset($_SESSION['V_ANIMAL']);
	header('Location:animaux.php');
}
?>