<?php
require_once 'include/_bll.lib.php';
require_once '../functions.sql';

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
		
		// récupération des valeurs saisies
		$email = htmlentities($_POST["email"]);
		$mdp = htmlentities($_POST["mdp"]);
		unset($_SESSION['E_CONNEXION']);



			//charger l'administrateur
		$admin = Utilisateurs::chargerAdminParEmailEtParMdp($email,$mdp);

		if($admin)
		{
			if(isset($_POST['remember']))
			{
				setcookie('auth', $admin['id']. '-----' . sha1($email. $mdp), time() + 3600 * 24 * 3, '/', 'localhost', true, true);
			}

			$_SESSION['user_id'] = $admin['id'];
			$_SESSION['user_nom'] = $admin['nom'];
			$_SESSION['user_prenom'] = $admin['prenom'];
			$_SESSION['user_droit'] = $admin['droit'];

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
	};break;		

	case 'deconnexion' : 
	{
		setcookie('auth', '', time() - 3600, '/', 'localhost', true, true);
		session_destroy();

		header('Location: index.php');
	};break;
}
?>