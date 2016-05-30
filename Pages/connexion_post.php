<?php

include'include/session.php';

include'include/connexion_bdd.php';

	$user = $bdd->prepare("SELECT * FROM proprietaire WHERE email = ? AND mdp = ?");
	$user-> execute(array($_POST['email'], $_POST['mdp']));
	$use = $user->fetch();


	if(isset($_POST['remember']))
	{
		setcookie('auth', $use['ID']. '-----' . sha1($use['email']. $use['mdp']), time() + 3600 * 24 * 3, '/', 'localhost', true, true);
	}

	if($use)
	{
		$_SESSION['user_id'] = $use['ID'];
		$_SESSION['user_nom'] = $use['nom'];
		$_SESSION['user_prenom'] = $use['prenom'];
		$_SESSION['user_droit'] = $use['droit'];

		unset($_SESSION['E_CONNEXION']);
		$_SESSION['V_CONNEXION'] = true;
		header('Location: index.php');
	}
	else 
	{
		$_SESSION['E_CONNEXION'] = true;
		unset($_SESSION['V_CONNEXION']);
		header('Location:connexion.php');
	}

/*}*/
?>