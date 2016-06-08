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

unset($_SESSION['ID_USER_TEMP']);

unset($_SESSION['E_JOUR']);
unset($_SESSION['E_MOIS']);
unset($_SESSION['E_ANNEE']);
unset($_SESSION['E_JOUR_MOIS_ANNEE']);
unset($_SESSION['V_ADD_ANIMAL']);

if(checkdate($moisTeste, $jourTeste, $anneeTeste))
{
	if($anneeTeste == $yearToday)
	{
		if($moisTeste <= $monthToday)
		{
			if($jourTeste <= $dayToday)
			{
				

				include'include/session.php';($_SESSION);


				$u = $bdd->prepare("INSERT INTO `animal`(`ID_proprietaire`, `type`, `nom`, `date_naissance`, `genre`, `complem_info`, `vaccine`, `puce`, `race`) 
					VALUES(?,?,?,?,?,?,?,?,?)");
				$u->execute(array($_SESSION['user_id'],
					$_POST['type'],
					$_POST['nom'],
					$newDate->format('Y-m-d'),
					$_POST['genre'],
					$_POST['complem_info'],
					$_POST['vaccine'],
					$_POST['puce'],
					$_POST['race']));

				if($u)
				{
					$u->closeCursor();


					$u = $bdd->query('SELECT * FROM animal WHERE ID = (SELECT MAX(ID) FROM animal)');
					$add = $u->fetch();


					$_SESSION['ID_animal'] = $add['ID'];
					$_SESSION['V_ADD_ANIMAL'] = true;
					
					unset($_SESSION['E_ANIMAL_EXIST']);

					$u->closeCursor();

					header('Location:animaux.php');
				}
				else
				{
					$_SESSION['E_ANIMAL_EXIST'] = true;

					unset($_SESSION['V_ADD_ANIMAL']);
					unset($_SESSION['ID_animal']);


					header('Location:animal_ajouter.php');	
				}
			}
			else
			{
				$_SESSION['E_JOUR'] = true;

				unset($_SESSION['E_MOIS']);
				unset($_SESSION['E_ANNEE']);
				unset($_SESSION['E_JOUR_MOIS_ANNEE']);
				unset($_SESSION['E_ANIMAL_EXIST']);
				unset($_SESSION['V_ADD_ANIMAL']);
				header('Location:animal_ajouter.php');
			}
		}
		else
		{
			$_SESSION['E_MOIS'] = true;

			unset($_SESSION['E_JOUR']);
			unset($_SESSION['E_ANNEE']);
			unset($_SESSION['E_JOUR_MOIS_ANNEE']);
			unset($_SESSION['E_ANIMAL_EXIST']);
			unset($_SESSION['V_ADD_ANIMAL']);
			header('Location:animal_ajouter.php');
		}
	}

	if($anneeTeste < $yearToday)
	{
		unset($_SESSION['E_JOUR']);
		unset($_SESSION['E_MOIS']);
		unset($_SESSION['E_ANNEE']);
		unset($_SESSION['E_JOUR_MOIS_ANNEE']);
		unset($_SESSION['V_ADD_ANIMAL']);



		$u = $bdd->prepare("INSERT INTO `animal`(`ID_proprietaire`, `type`, `nom`, `date_naissance`, `genre`, `complem_info`, `vaccine`, `puce`, `race`) 
			VALUES(?,?,?,?,?,?,?,?,?)");
		$u->execute(array($_SESSION['user_id'],
			$_POST['type'],
			$_POST['nom'],
			$newDate->format('Y-m-d'),
			$_POST['genre'],
			$_POST['complem_info'],
			$_POST['vaccine'],
			$_POST['puce'],
			$_POST['race']));

		if($u)
		{
			$u->closeCursor();

			$u = $bdd->query('SELECT * FROM animal WHERE ID = (SELECT MAX(ID) FROM animal)');
			$add = $u->fetch();

			$_SESSION['ID_animal'] = $add['ID'];
			unset($_SESSION['E_ANIMAL_EXIST']);
			$_SESSION['V_ADD_ANIMAL'] = true;

			$u->closeCursor();

			header('Location:animaux.php');
		}
		else
		{
			$_SESSION['E_ANIMAL_EXIST'] = true;

			unset($_SESSION['ID_animal']);

			header('Location:animal_ajouter.php');	
		}

	}
	else
	{
		echo'ici';
		die;
		$_SESSION['E_ANNEE'] = true;

		unset($_SESSION['E_JOUR']);
		unset($_SESSION['E_MOIS']);
		unset($_SESSION['E_JOUR_MOIS_ANNEE']);
		unset($_SESSION['E_ANIMAL_EXIST']);
		unset($_SESSION['V_ADD_ANIMAL']);
		header('Location:animal_ajouter.php');
	}

}
else
{
	$_SESSION['E_JOUR_MOIS_ANNEE'] = true;

	unset($_SESSION['E_JOUR']);
	unset($_SESSION['E_MOIS']);
	unset($_SESSION['E_ANNEE']);
	unset($_SESSION['V_ADD_ANIMAL']);

	header('Location:animal_ajouter.php');
}