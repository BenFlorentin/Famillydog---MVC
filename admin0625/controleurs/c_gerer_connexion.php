<?php
require_once 'include/_bll.lib.php';

if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "connecter";
}


// diriger vers les bonnes vues
switch ($action) 
{
	// se connecter
	case 'connecter' :
	{
		include'vues/_v_connexion.php';
	};break;

	// vérification des informations entrées pour la connexion
	case 'connexion' : 
	{
		
		 // initialisation des variables
		$ajoutOK = true;
		$email = '';
		$mdp = '';

		        // récupération des valeurs saisies
		$email = htmlentities($_POST["email"]);
		$mdp = htmlentities($_POST["mdp"]);
		unset($_SESSION['E_CONNEXION']);


		if($ajoutOK)
		{

			//charger l'administrateur
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

				header('Location: index.php?uc=home');
			}
			else
			{

				$_SESSION['E_CONNEXION'] = true;
				unset($_SESSION['V_CONNEXION']);
				include'vues/_v_connexion.php';
			}
		}
		else
		{
			//Afficher les erreurs et on refait la saisie 
			$_SESSION['E_CONNEXION'] = true;
			unset($_SESSION['V_CONNEXION']);
			include'vues/_v_connexion.php';
		}
	};break;		

	case 'deconnexion' : 
	{
		setcookie('auth', '', time() - 3600, '/', 'localhost', true, true);
		session_destroy();

		header('Location: index.php');
	};break;
}
?>