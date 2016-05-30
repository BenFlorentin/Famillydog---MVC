<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$dateDebutSaison = explode('/', $_POST['saison_debut']);
$DebutJourSaison = $dateDebutSaison[0];
$DebutMoisSaison = $dateDebutSaison[1];
$DebutAnneeSaison = $dateDebutSaison[2];


$dateFinSaison = explode('/', $_POST['saison_fin']);
$FinJourSaison = $dateFinSaison[0];
$FinMoisSaison = $dateFinSaison[1];
$FinAnneeSaison = $dateFinSaison[2];

$dateDebutBla = explode('/', $_POST['date_debut_bla']);
$DebutJourBla = $dateDebutBla[0];
$DebutMoisBla = $dateDebutBla[1];
$DebutAnneeBla = $dateDebutBla[2];

$dateFinBla = explode('/', $_POST['date_fin_bla']);
$FinJourBla = $dateFinBla[0];
$FinMoisBla = $dateFinBla[1];
$FinAnneeBla = $dateFinBla[2];

$dateDebutBle = explode('/', $_POST['date_debut_ble']);
$DebutJourBle = $dateDebutBle[0];
$DebutMoisBle = $dateDebutBle[1];
$DebutAnneeBle = $dateDebutBle[2];

$dateFinBle = explode('/', $_POST['date_fin_ble']);
$FinJourBle = $dateFinBle[0];
$FinMoisBle = $dateFinBle[1];
$FinAnneeBle = $dateFinBle[2];

$dateDebutRou = explode('/', $_POST['date_debut_rou']);
$DebutJourRou = $dateDebutRou[0];
$DebutMoisRou = $dateDebutRou[1];
$DebutAnneeRou = $dateDebutRou[2];

$dateFinRou = explode('/', $_POST['date_fin_rou']);
$FinJourRou = $dateFinRou[0];
$FinMoisRou = $dateFinRou[1];
$FinAnneeRou = $dateFinRou[2];


if(checkdate($DebutMoisSaison, $DebutJourSaison, $DebutAnneeSaison))
{
	unset($_SESSION['E_DATE_DEBUT_SAISON']);

	if(checkdate($FinMoisSaison, $FinJourSaison, $FinAnneeSaison))
	{
		unset($_SESSION['E_DATE_FIN_SAISON']);

		if(checkdate($DebutMoisBla, $DebutJourBla, $DebutAnneeBla))
		{
			unset($_SESSION['E_DATE_DEBUT_BLA']);

			if(checkdate($FinMoisBla, $FinJourBla, $FinAnneeBla))
			{
				unset($_SESSION['E_DATE_FIN_BLA']);

				if(checkdate($DebutMoisBle, $DebutJourBle, $DebutAnneeBle))
				{
					unset($_SESSION['E_DATE_DEBUT_BLE']);

					if(checkdate($FinMoisBle, $FinJourBle, $FinAnneeBle))
					{
						unset($_SESSION['E_DATE_FIN_BLE']);

						if(checkdate($DebutMoisRou, $DebutJourRou, $DebutAnneeRou))
						{
							unset($_SESSION['E_DATE_DEBUT_ROU']);

							if(checkdate($FinMoisRou, $FinJourRou, $FinAnneeRou))
							{
								unset($_SESSION['E_DATE_FIN_ROU']);

								if($_POST['prix_jour_bla'] >= 0 )
								{
									unset($_SESSION['E_PRIX_BLA']);

									if($_POST['prix_jour_ble'] >= 0)
									{
										unset($_SESSION['E_PRIX_BLE']);

										if($_POST['prix_jour_rou'] >= 0)
										{
											unset($_SESSION['E_PRIX_ROU']);

											$newDateDebutSaison = DateTime::createFromFormat('j/m/Y', $_POST['saison_debut']);
											$newDateFinSaison = DateTime::createFromFormat('j/m/Y', $_POST['saison_fin']);
											$newDateDebutBla = DateTime::createFromFormat('j/m/Y', $_POST['date_debut_bla']);
											$newDateFinBla = DateTime::createFromFormat('j/m/Y', $_POST['date_fin_bla']);
											$newDateDebutBle = DateTime::createFromFormat('j/m/Y', $_POST['date_debut_ble']);
											$newDateFinBle = DateTime::createFromFormat('j/m/Y', $_POST['date_fin_ble']);
											$newDateDebutRou = DateTime::createFromFormat('j/m/Y', $_POST['date_debut_rou']);
											$newDateFinRou = DateTime::createFromFormat('j/m/Y', $_POST['date_fin_rou']);

											$u = $bdd->prepare('UPDATE tarifs
												SET date_debut_bla = ?,
												date_fin_bla = ?,
												date_debut_ble = ?,
												date_fin_ble = ?,
												date_debut_rou = ?,
												date_fin_rou = ?,
												prix_jour_bla = ?,
												prix_jour_ble = ?,
												prix_jour_rou = ?,
												saison_debut = ?,
												saison_fin = ?
												WHERE ID = ?');
					

											$u->execute(array($newDateDebutBla->format('Y-m-d'),
												$newDateFinBla->format('Y-m-d'),
												$newDateDebutBle->format('Y-m-d'),
												$newDateFinBle->format('Y-m-d'),
												$newDateDebutRou->format('Y-m-d'),
												$newDateFinRou->format('Y-m-d'),
												$_POST['prix_jour_bla'],
												$_POST['prix_jour_ble'],
												$_POST['prix_jour_rou'],
												$newDateDebutSaison->format('Y-m-d'),
												$newDateFinSaison->format('Y-m-d'),
												$_POST['ID_tarifs']));



											if($u)
											{
												$u->closeCursor();

												unset($_SESSION['E_TARIFS']);
												$_SESSION['V_TARIFS'] = true;

												header('Location:admin_tarifs.php');
											}
											else
											{
												$_SESSION['E_TARIFS'] = true;
												unset($_SESSION['V_TARIFS']);

												header('Location:admin_tarifs.php');	
											}
										}
										else
										{
											$_SESSION['E_PRIX_ROU'] = true;
											

											header('Location:admin_tarifs.php');
										}
									}
									else
									{
										$_SESSION['E_PRIX_BLE'] = true;

										header('Location:admin_tarifs.php');
									}

								}
								else
								{
									$_SESSION['E_PRIX_BLA'] = true;

									header('Location:admin_tarifs.php');
								}
							}
							else
							{
								$_SESSION['E_DATE_FIN_ROU'] = true;
								header('Location: admin_tarifs.php');
							}
						}
						else
						{
							$_SESSION['E_DATE_DEBUT_ROU'] = true;
							header('Location: admin_tarifs.php');
						}
					}
					else
					{
						$_SESSION['E_DATE_FIN_BLE'] = true;
						header('Location: admin_tarifs.php');
					}
				}
				else
				{
					$_SESSION['E_DATE_DEBUT_BLE'] = true;
					header('Location: admin_tarifs.php');
				}
			}
			else
			{
				$_SESSION['E_DATE_FIN_BLA'] = true;
				header('Location: admin_tarifs.php');
			}
		}
		else
		{
			$_SESSION['E_DATE_FIN_BLA'] = true;
			header('Location: admin_tarifs.php');
		}
	}
	else
	{
		$_SESSION['E_DATE_FIN_SAISON'] = true;
		header('Location: admin_tarifs.php');
	}
}
else
{
	$_SESSION['E_DATE_DEBUT_SAISON'] = true;

	header('Location:admin_tarifs.php');
}
?>