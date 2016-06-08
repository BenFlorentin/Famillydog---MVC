<?php
require_once 'include/_bll.lib.php';

if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "connexion";
}

include'include/session.php';($action);

// diriger vers les bonnes vues
switch ($action) 
{
	// se connecter
	case 'connecter' :
	{
		include'vues/v_connexion.php';
	};break;

	// vérification des informations entrées pour la connexion
	case 'connexion' : 
	{
		
		 // initialisation des variables
		$ajoutOK = true;
		$email = '';
		$mdp = '';

        // traitement de l'option : saisie ou validation ?
		if(isset($_GET["option"]))
		{
			$option = htmlentities($_GET["option"]);
		}
		else
		{
			$option = 'existant';
		}

		switch($option)
		{
			case 'inscription' : 
			{

				// initialisation des variables
				$date = '';
				$jourTeste = '';
				$moisTeste = '';
				$anneeTeste = '';

				$dateToday = explode('/', date('d/m/Y',time()));
				$dayToday = $dateToday[0];
				$monthToday = $dateToday[1];
				$yearToday = $dateToday[2];
				
				// tests de gestion du formulaire
				if (isset($_POST["inscription"])) 
				{
					$date = explode('/', htmlentities($_POST['date_naissance']));
					$jourTeste = $date[0];
					$moisTeste = $date[1];
					$anneeTeste = $date[2];

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

									$newDate = DateTime::createFromFormat('j/m/Y', htmlentities($_POST['date_naissance']));

									$values = array();

									$values[0] = htmlentities($_POST['genre']); 
									$values[1] = htmlentities($_POST['nom']); 
									$values[2] = htmlentities($_POST['prenom']); 
									$values[3] = htmlentities($_POST['collectivites']); 
									$values[4] = htmlentities($_POST['tel']); 
									$values[5] = htmlentities($_POST['fix']); 
									$values[6] = htmlentities($_POST['fax']); 
									$values[7] = htmlentities($_POST['email']); 
									$values[8] = htmlentities($_POST['mdp']); 
									$values[9] = htmlentities($_POST['rue_voie']); 
									$values[10] = htmlentities($_POST['num_rue_voie']); 
									$values[11] = htmlentities($_POST['ville']); 
									$values[12] = htmlentities($_POST['pays']); 
									$values[13] = htmlentities($_POST['code_postal']); 
									$values[14] = htmlentities($_POST['complem_adr']); 
									$values[15] = htmlentities($_POST['complem_info']); 
									$values[16] = htmlentities($newDate->format('Y-m-d')); 
									$values[17] = ''; 

									/*$u = $bdd->prepare("INSERT INTO `proprietaire`(`genre`, `nom`, `prenom`, `collectivites`, `tel`, `fix`, `fax`, `email`, `mdp`, `rue_voie`, `num_rue_voie`, `ville`, `pays`, `code_postal`, `complem_adr`, `complem_info`, `date_naissance`, `droit`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
										''));*/
									$leProprietaire = Proprietaires::ajouterProprietaire($values);

									if($leProprietaire)
									{
										unset($_SESSION['E_ADD_USER']);

										/*$u = $bdd->query('SELECT * FROM proprietaire WHERE ID = (SELECT MAX(ID) FROM proprietaire)');
										$add = $u->fetch();*/

										$unProprietaire = Proprietaires::chargerProprietaireParID($leProprietaire->getID());

										$_SESSION['user_id'] = $unProprietaire->getID();
										$_SESSION['user_nom'] = $unProprietaire->getNom();
										$_SESSION['user_prenom'] = $unProprietaire->getPrenom();
										$_SESSION['user_droit'] = $unProprietaire->getDroit;

										$_SESSION['V_ADD_USER'] = true;


										header('Location: index.php?uc=gererProprietaire&action=infos');
									}
									else
									{
										$_SESSION['E_ADD_USER'] = true;
										unset($_SESSION['V_ADD_USER']);


										include'vues/v_connexion.php';	
									}


								}
								else
								{
									$_SESSION['E_JOUR'] = true;

									unset($_SESSION['E_MOIS']);
									unset($_SESSION['E_ANNEE']);
									unset($_SESSION['E_JOUR_MOIS_ANNEE']);
									unset($_SESSION['E_ADD_USER']);



									include'vues/v_connexion.php';
								}
							}
							else
							{

								unset($_SESSION['E_JOUR']);
								unset($_SESSION['E_MOIS']);
								unset($_SESSION['E_ANNEE']);
								unset($_SESSION['E_JOUR_MOIS_ANNEE']);



								$newDate = DateTime::createFromFormat('j/m/Y', htmlentities($_POST['date_naissance']));

								$values = array();

								$values[0] = htmlentities($_POST['genre']); 
								$values[1] = htmlentities($_POST['nom']); 
								$values[2] = htmlentities($_POST['prenom']); 
								$values[3] = htmlentities($_POST['collectivites']); 
								$values[4] = htmlentities($_POST['tel']); 
								$values[5] = htmlentities($_POST['fix']); 
								$values[6] = htmlentities($_POST['fax']); 
								$values[7] = htmlentities($_POST['email']); 
								$values[8] = htmlentities($_POST['mdp']); 
								$values[9] = htmlentities($_POST['rue_voie']); 
								$values[10] = htmlentities($_POST['num_rue_voie']); 
								$values[11] = htmlentities($_POST['ville']); 
								$values[12] = htmlentities($_POST['pays']); 
								$values[13] = htmlentities($_POST['code_postal']); 
								$values[14] = htmlentities($_POST['complem_adr']); 
								$values[15] = htmlentities($_POST['complem_info']); 
								$values[16] = htmlentities($newDate->format('Y-m-d')); 
								$values[17] = ''; 


								/*$u = $bdd->prepare("INSERT INTO `proprietaire`(`genre`, `nom`, `prenom`, `collectivites`, `tel`, `fix`, `fax`, `email`, `mdp`, `rue_voie`, `num_rue_voie`, `ville`, `pays`, `code_postal`, `complem_adr`, `complem_info`, `date_naissance`, `droit`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
									''));*/


									$leProprietaire = Proprietaires::ajouterProprietaire($values);


									if($leProprietaire)
									{
										
										/*$u->closeCursor();*/

										unset($_SESSION['E_ADD_USER']);

									/*$u = $bdd->query('SELECT * FROM proprietaire WHERE ID = (SELECT MAX(ID) FROM proprietaire)');
									$add = $u->fetch();*/

									$unProprietaire = Proprietaires::chargerProprietaireParID($leProprietaire->getID());

									$_SESSION['user_id'] = $unProprietaire->getID();
									$_SESSION['user_nom'] = $unProprietaire->getNom();
									$_SESSION['user_prenom'] = $unProprietaire->getPrenom();
									$_SESSION['user_droit'] = $unProprietaire->getDroit();

									$_SESSION['V_ADD_USER'] = true;



									header('Location: index.php?uc=gererProprietaire&action=infos');
								}
								else
								{

									$_SESSION['E_ADD_USER'] = true;
									unset($_SESSION['V_ADD_USER']);


									include'vues/v_connexion.php';	
								}
							}
						}
						else
						{

							$_SESSION['E_ANNEE'] = true;

							unset($_SESSION['E_JOUR']);
							unset($_SESSION['E_MOIS']);
							unset($_SESSION['E_JOUR_MOIS_ANNEE']);
							unset($_SESSION['E_ADD_USER']);

							include'vues/v_connexion.php';
						}
					}
					else
					{
						$_SESSION['E_JOUR_MOIS_ANNEE'] = true;

						unset($_SESSION['E_JOUR']);
						unset($_SESSION['E_MOIS']);
						unset($_SESSION['E_ANNEE']);
						unset($_SESSION['E_ADD_USER']);

						include'vues/v_connexion.php';
					}
				}
			};break;
		
			case 'existant' : 
			{
		        // récupération des valeurs saisies
				$email = htmlentities($_POST["email"]);
				$mdp = htmlentities($_POST["mdp"]);
				unset($_SESSION['E_CONNEXION']);


				if($ajoutOK)
				{

					//charger le proprietaire
					$utilisateur = Utilisateurs::chargerUtilisateurParEmailEtParMdp($email,$mdp);

					if($utilisateur)
					{
						if(isset($_POST['remember']))
						{
							setcookie('auth', $utilisateur->getID(). '-----' . sha1($utilisateur->getEmail(). $utilisateur->getMdp()), time() + 3600 * 24 * 3, '/', 'localhost', true, true);
						}

						$_SESSION['user_id'] = $utilisateur->getID();
						$_SESSION['user_nom'] = $utilisateur->getNom();
						$_SESSION['user_prenom'] = $utilisateur->getPrenom();
						$_SESSION['user_droit'] = $utilisateur->getDroit();

						unset($_SESSION['E_CONNEXION']);
						$_SESSION['V_CONNEXION'] = true;

						include'vues/v_home.php';
					}
					else
					{

						$_SESSION['E_CONNEXION'] = true;
						unset($_SESSION['V_CONNEXION']);
						include'vues/v_connexion.php';
					}
				}
				else
				{
					//Afficher les erreurs et on refait la saisie 
					$_SESSION['E_CONNEXION'] = true;
					unset($_SESSION['V_CONNEXION']);
					include'vues/v_connexion.php';
				}
			};break;		
		}
	};break;

	case 'deconnexion' : 
	{
		setcookie('auth', '', time() - 3600, '/', 'localhost', true, true);
		session_destroy();
		session_start();
		$_SESSION['V_DECONNEXION'] = true;

		include'vues/v_home.php';
	};break;
}
?>