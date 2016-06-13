<?php
require_once 'include/_bll.lib.php';

if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "listeUtilisateurs";
}


// diriger vers les bonnes vues
switch ($action) 
{
	// liste des utilisateurs
	case 'listeUtilisateurs' :
	{
		$lesUtilisateurs = utilisateurs::chargerUtilisateur(1);

		include'vues/v_utilisateurs.php';
	};break;

	// ajouter
	case 'ajouter' :
	{
		if(isset($_GET['option']))
		{
			$option = $_GET['option'];
		}
		else
		{
			$option = "saisir";
		}

		switch ($option) 
		{
			// formulaire ajoutant un tarif 
			case 'saisir':
			{
				include'vues/v_ajouter_utilisateur.php';
			}break;
			
			case 'valider':
			{	

				$date = explode('/', $_POST['date_naissance']);
				$jourTeste = $date[0];
				$moisTeste = $date[1];
				$anneeTeste = $date[2];

				$dateToday = explode('/', date('d/m/Y',time()));
				$dayToday = $dateToday[0];
				$monthToday = $dateToday[1];
				$yearToday = $dateToday[2];

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

								$newDate = DateTime::createFromFormat('j/m/Y', $_POST['date_naissance']);

								$values = array();
								$values[] = $_POST['genre'];
								$values[] = $_POST['nom'];
								$values[] = $_POST['prenom'];
								$values[] = $_POST['collectivites'];
								$values[] = $_POST['tel'];
								$values[] = $_POST['fix'];
								$values[] = $_POST['fax'];
								$values[] = $_POST['email'];
								$values[] = $_POST['mdp'];
								$values[] = $_POST['rue_voie'];
								$values[] = $_POST['num_rue_voie'];
								$values[] = $_POST['ville'];
								$values[] = $_POST['pays'];
								$values[] = $_POST['code_postal'];
								$values[] = $_POST['complem_adr'];
								$values[] = $_POST['complem_info'];
								$values[] = $newDate->format('Y-m-d');
								$values[] = 0;

								$ajouterUtilisateur = utilisateurs::ajouterUtilisateur($values);

								if($ajouterUtilisateur)
								{
									unset($_SESSION['E_USER']);

									$_SESSION['V_ADD_USER'] = true;

								// on charge l'utilisateur pour l'afficher
									$user = utilisateurs::chargerUtilisateurParID($ajouterUtilisateur->getID());

								// on charge les animaux de l'utilisateur
									$animaux = $user->animaux(1);

								// on charge les réservations de l'utilisateur
									$reservations = $user->reservations(1);



									include'vues/v_utilisateur.php';
								}
								else
								{
									$_SESSION['E_USER'] = true;
									unset($_SESSION['V_ADD_USER']);

									include'vues/v_ajouter_utilisateur.php';
								}
							}
							else
							{
								$_SESSION['E_JOUR'] = true;

								unset($_SESSION['E_MOIS']);
								unset($_SESSION['E_ANNEE']);
								unset($_SESSION['E_JOUR_MOIS_ANNEE']);
								unset($_SESSION['E_USER']);

								include'vues/v_ajouter_utilisateur.php';
							}
						}
						else
						{
							unset($_SESSION['E_JOUR']);
							unset($_SESSION['E_MOIS']);
							unset($_SESSION['E_ANNEE']);
							unset($_SESSION['E_JOUR_MOIS_ANNEE']);



							$newDate = DateTime::createFromFormat('j/m/Y', $_POST['date_naissance']);

							$values = array();
							$values[] = $_POST['genre'];
							$values[] = $_POST['nom'];
							$values[] = $_POST['prenom'];
							$values[] = $_POST['collectivites'];
							$values[] = $_POST['tel'];
							$values[] = $_POST['fix'];
							$values[] = $_POST['fax'];
							$values[] = $_POST['email'];
							$values[] = $_POST['mdp'];
							$values[] = $_POST['rue_voie'];
							$values[] = $_POST['num_rue_voie'];
							$values[] = $_POST['ville'];
							$values[] = $_POST['pays'];
							$values[] = $_POST['code_postal'];
							$values[] = $_POST['complem_adr'];
							$values[] = $_POST['complem_info'];
							$values[] = $newDate->format('Y-m-d');
							$values[] = 0;

							$ajouterUtilisateur = utilisateurs::ajouterUtilisateur($values);
							
							if($ajouterUtilisateur)
							{
								unset($_SESSION['E_USER']);

								$_SESSION['V_ADD_USER'] = true;

								// on charge l'utilisateur pour l'afficher
								$user = utilisateurs::chargerUtilisateurParID($ajouterUtilisateur->getID());

								// on charge les animaux de l'utilisateur
								$animaux = $user->animaux(1);

								// on charge les réservations de l'utilisateur
								$reservations = $user->reservations(1);



								include'vues/v_utilisateur.php';
							}
							else
							{
								$_SESSION['E_USER'] = true;
								unset($_SESSION['V_ADD_USER']);

								include'vues/v_ajouter_utilisateur.php';
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
						
						include'vues/v_ajouter_utilisateur.php';
					}
				}
				else
				{
					$_SESSION['E_JOUR_MOIS_ANNEE'] = true;

					unset($_SESSION['E_JOUR']);
					unset($_SESSION['E_MOIS']);
					unset($_SESSION['E_ANNEE']);
					unset($_SESSION['E_USER']);
					
					include'vues/v_ajouter_utilisateur.php';
				}
			}break;
		}
	};break;

	// modifier un tarif
	case 'modifier' : 
	{
		if(isset($_GET['option']))
		{
			$option = $_GET['option'];
		}
		else
		{
			$option = "saisir";
		}


		switch ($option) 
		{
			// formulaire récupérant l'utilisateur
			case 'saisir':
			{
				// on récupere l'id de l'utilisateur dans l'url
				$id = intval($_GET['id']);

				$user = utilisateurs::chargerUtilisateurParID($id);

				include'vues/v_modifier_utilisateur.php';
			}break;
			
			case 'valider':
			{

				$date = explode('/', $_POST['date_naissance']);
				$jourTeste = $date[0];
				$moisTeste = $date[1];
				$anneeTeste = $date[2];

				$dateToday = explode('/', date('d/m/Y',time()));
				$dayToday = $dateToday[0];
				$monthToday = $dateToday[1];
				$yearToday = $dateToday[2];

				$newDate = DateTime::createFromFormat('j/m/Y', htmlentities($_POST['date_naissance']));

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

								// on récupère les données dans le formulaire passées via la méthode POST
								$values = array();
								$values[] = htmlentities($_POST['genre']);
								$values[] = htmlentities($_POST['nom']);
								$values[] = htmlentities($_POST['prenom']);
								$values[] = htmlentities($_POST['collectivites']);
								$values[] = htmlentities($_POST['tel']);
								$values[] = htmlentities($_POST['fix']);
								$values[] = htmlentities($_POST['fax']);
								$values[] = htmlentities($_POST['email']);
								$values[] = htmlentities($_POST['mdp']);
								$values[] = htmlentities($_POST['rue_voie']);
								$values[] = intval($_POST['num_rue_voie']);
								$values[] = htmlentities($_POST['ville']);
								$values[] = htmlentities($_POST['pays']);
								$values[] = intval($_POST['code_postal']);
								$values[] = htmlentities($_POST['complem_adr']);
								$values[] = htmlentities($_POST['complem_info']);
								$values[] = $newDate->format('Y-m-d');
								$values[] = 0;
								$values[] = intval($_POST['ID']);


								// on met à jour l'utilisateur
								$updateUser = utilisateurs::modifierUtilisateur($values);

								if($updateUser != -1)
								{

									unset($_SESSION['E_USER']);
									$_SESSION['V_USER'] = true;

									// on charge l'utilisateur pour l'afficher
									$user = utilisateurs::chargerUtilisateurParID($values[18]);

									// on charge les animaux de l'utilisateur
									$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
									$reservations = $user->reservations(1);
									include'vues/v_utilisateur.php';
								}
								else
								{
									$_SESSION['E_USER'] = true;

									// on charge l'utilisateur pour l'afficher
									$user = utilisateurs::chargerUtilisateurParID(intval($_POST['ID']));

									// on charge les animaux de l'utilisateur
									$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
									$reservations = $user->reservations(1);
									include'vues/v_utilisateur.php';
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

								// on charge l'utilisateur pour l'afficher
								$user = utilisateurs::chargerUtilisateurParID(intval($_POST['ID']));

									// on charge les animaux de l'utilisateur
								$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
								$reservations = $user->reservations(1);
								include'vues/v_utilisateur.php';
							}
						}
						else
						{
							unset($_SESSION['E_JOUR']);
							unset($_SESSION['E_MOIS']);
							unset($_SESSION['E_ANNEE']);
							unset($_SESSION['E_JOUR_MOIS_ANNEE']);
							unset($_SESSION['V_USER']);


							// on récupère les données dans le formulaire passées via la méthode POST
							$values = array();
							$values[] = htmlentities($_POST['genre']);
							$values[] = htmlentities($_POST['nom']);
							$values[] = htmlentities($_POST['prenom']);
							$values[] = htmlentities($_POST['collectivites']);
							$values[] = htmlentities($_POST['tel']);
							$values[] = htmlentities($_POST['fix']);
							$values[] = htmlentities($_POST['fax']);
							$values[] = htmlentities($_POST['email']);
							$values[] = htmlentities($_POST['mdp']);
							$values[] = htmlentities($_POST['rue_voie']);
							$values[] = intval($_POST['num_rue_voie']);
							$values[] = htmlentities($_POST['ville']);
							$values[] = htmlentities($_POST['pays']);
							$values[] = intval($_POST['code_postal']);
							$values[] = htmlentities($_POST['complem_adr']);
							$values[] = htmlentities($_POST['complem_info']);
							$values[] = $newDate->format('Y-m-d');
							$values[] = 0;
							$values[] = intval($_POST['ID']);


								// on met à jour l'utilisateur
							$updateUser = utilisateurs::modifierUtilisateur($values);

							if($updateUser != -1)
							{

								unset($_SESSION['E_USER']);
								$_SESSION['V_USER'] = true;

									// on charge l'utilisateur pour l'afficher
								$user = utilisateurs::chargerUtilisateurParID($values[18]);

									// on charge les animaux de l'utilisateur
								$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
								$reservations = $user->reservations(1);
								include'vues/v_utilisateur.php';
							}
							else
							{
								$_SESSION['E_USER'] = true;

									// on charge l'utilisateur pour l'afficher
								$user = utilisateurs::chargerUtilisateurParID(intval($_POST['ID']));

									// on charge les animaux de l'utilisateur
								$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
								$reservations = $user->reservations(1);
								include'vues/v_utilisateur.php';
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

							// on charge l'utilisateur pour l'afficher
						$user = utilisateurs::chargerUtilisateurParID(intval($_POST['ID']));

									// on charge les animaux de l'utilisateur
						$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
						$reservations = $user->reservations(1);
						include'vues/v_utilisateur.php';
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

						// on charge l'utilisateur pour l'afficher
					$user = utilisateurs::chargerUtilisateurParID(intval($_POST['ID']));

									// on charge les animaux de l'utilisateur
					$animaux = $user->animaux(1);

									// on charge les réservations de l'utilisateur
					$reservations = $user->reservations(1);
					include'vues/v_utilisateur.php';
				}
			};break;
		}
	};break;		

// regarder les informations d'un utilisateur
	case 'info' : 
	{
	// récupère l'id du message à supprimer
		$id = intval($_GET['id']);



	// on charge l'utilisateur pour l'afficher
		$user = utilisateurs::chargerUtilisateurParID($id);

	// on charge les animaux de l'utilisateur
		$animaux = $user->animaux(1);

	// on charge les réservations de l'utilisateur
		$reservations = $user->reservations(1);



		include'vues/v_utilisateur.php';

	};break;

// supprimer un utilisateur
	case 'supprimer' : 
	{
	// récupère l'id de l'utilisateur à supprimer
		$id = intval($_GET['id']);

	// on charge l'utilisateur à supprimer
		$user = utilisateurs::chargerUtilisateurParID($id);

	// on regarde si l'utilisateur possède des reservations
		$nbReservations = $user->nbReservations();


		if($nbReservations == 0)
		{
	// supprimer les animaux de l'utilisateur
			$animaux = animals::supprimerAnimaux($user);

	// suppression de l'utilisateur
			$supprimerUtilisateur = utilisateurs::supprimerUtilisateur($user);

			unset($_SESSION['E_USER_SUPP']);
			$_SESSION['V_USER_SUPP'] = true;

	// on charge les utilisateur pour les afficher
			$lesUtilisateurs = utilisateurs::chargerUtilisateur(1);

			include'vues/v_utilisateurs.php';
		}
		else
		{
			$_SESSION['E_USER_SUPP'] = true;
			unset($_SESSION['V_USER_SUPP']);

	// on charge les utilisateur pour les afficher
			$lesUtilisateurs = utilisateurs::chargerUtilisateur(1);

			include'vues/v_utilisateurs.php';
		}

	};break;
}
?>
