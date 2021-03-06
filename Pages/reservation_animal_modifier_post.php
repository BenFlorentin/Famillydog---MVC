<?php 

include'include/session.php';

include'include/connexion_bdd.php';



if(isset($_POST['ID_proprietaire']))
{
	$_SESSION['ID_USER_TEMP'] = $_POST['ID_proprietaire'];
}

if(isset($_POST['new_animal']))
{
	$date = explode('/', $_POST['date_naissance']);
	$jourTeste = $date[0];
	$moisTeste = $date[1];
	$anneeTeste = $date[2];

	$dateToday = explode('/', date('d/m/Y',time()));
	$dayToday = $dateToday[0];
	$monthToday = $dateToday[1];
	$yearToday = $dateToday[2];
	$newDate = DateTime::createFromFormat('j/m/Y', $_POST['date_naissance']);

	if(checkdate($moisTeste, $jourTeste, $anneeTeste))
	{
		if($anneeTeste == $yearToday)
		{
			if($moisTeste <= $monthToday)
			{
				if($jourTeste <= $dayToday)
				{
					unset($_SESSION['E_JOUR']);
					unset($_SESSION['E_MOIS']);
					unset($_SESSION['E_ANNEE']);
					unset($_SESSION['E_JOUR_MOIS_ANNEE']);
					unset($_SESSION['V_ADD_ANIMAL']);


					$u = $bdd->prepare("INSERT INTO `animal`(`ID_proprietaire`, `type`, `nom`, `date_naissance`, `genre`, `complem_info`, `vaccine`, `puce`, `race`) 
						VALUES(?,?,?,?,?,?,?,?,?)");
					$u->execute(array($_SESSION['ID_USER_TEMP'],
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
						unset($_SESSION['E_ANIMAL']);
						$_SESSION['V_ADD_ANIMAL'] = true;

						$u->closeCursor();

						header('Location:animaux.php');
					}
					else
					{
						$_SESSION['E_ANIMAL'] = true;

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
					unset($_SESSION['E_ANIMAL']);
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
				unset($_SESSION['E_ANIMAL']);
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
			$u->execute(array($_SESSION['ID_USER_TEMP'],
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
				unset($_SESSION['E_ANIMAL']);
				$_SESSION['V_ADD_ANIMAL'] = true;

				$u->closeCursor();

				header('Location:animaux.php');
			}
			else
			{
				$_SESSION['E_ANIMAL'] = true;

				unset($_SESSION['ID_animal']);

				header('Location:animal_ajouter.php');	
			}

		}
		else
		{
			$_SESSION['E_ANNEE'] = true;
			unset($_SESSION['E_JOUR']);
			unset($_SESSION['E_MOIS']);
			unset($_SESSION['E_JOUR_MOIS_ANNEE']);
			unset($_SESSION['E_ANIMAL']);
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
}
else
{

		$u = $bdd->prepare('SELECT * FROM animal WHERE nom = ? AND ID_proprietaire = ?');
		$u->execute(array($_POST['nom'], $_SESSION['ID_USER_TEMP']));
		$add = $u->fetch();

		if($add)
		{
			
			$_SESSION['ID_animal'] = $add['ID'];
			unset($_SESSION['E_ANIMAL']);

			header('Location:reservation_modifier.php');
		}
		else
		{
			$u->closeCursor();
			$_SESSION['E_ANIMAL'] = true;

			header('Location:reservation_animal_modifier.php');	
		}
}
?>