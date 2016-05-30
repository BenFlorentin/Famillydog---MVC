<?php 

if(isset($_COOKIE['auth']) && isset($_SESSION['user_id']))
{
	$auth = $_COOKIE['auth'];
	$auth = explode('-----', $auth);
	$us = $bdd-> prepare('SELECT * FROM proprietaire WHERE ID = ?');
	$us -> execute(array($auth[0]));
	$user = $us->fetch();

	$key = sha1($user['email'].$user['mdp']);
	if($key == $auth[1])
	{
		$_SESSION['user_id'] = $user['ID'];
		$_SESSION['user_nom'] = $user['nom'];
		$_SESSION['user_prenom'] = $user['prenom'];
		$_SESSION['user_droit'] = $user['droit'];
		setcookie('auth', $user['ID']. '-----' . sha1($user['email']. $user['mdp']), time() + 3600 * 24 * 3, '/', 'localhost', true, true);
		header('Location: index.php');
	}
	else
	{
		setcookie('auth', '', time() - 3600, '/', 'localhost', true, true);
	}
}

?>