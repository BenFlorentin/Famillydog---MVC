<?php 

include'include/session.php';

include'include/connexion_bdd.php';



$a = $bdd->prepare('SELECT COUNT(*) FROM reservation WHERE ID_proprietaire = ?');
$a->execute(array($_POST['ID_user']));
$r = $a->fetch();



if(isset($_POST['user'])) // utilisateur
{
	if($r[0] == 0)
	{
		$a->closeCursor();

		$a = $bdd->prepare('DELETE FROM animal WHERE ID_proprietaire = ?');
		$a->execute(array($_POST['ID_user']));
		$a->closeCursor();

		$a = $bdd->prepare('DELETE FROM proprietaire WHERE ID = ?');
		$a->execute(array($_POST['ID_user']));
		$a->closeCursor();

		unset($_SESSION['E_USER_SUPP']);
		$_SESSION['V_USER_SUPP'] = true;

		header('Location:compte.php');
	}
	else
	{
		$_SESSION['E_USER_SUPP'] = true;
		unset($_SESSION['V_USER_SUPP']);

		header('Location:compte.php');
	}
}
else // admin
{

	if($r[0] == 0)
	{
		$a->closeCursor();

		$a = $bdd->prepare('DELETE FROM animal WHERE ID_proprietaire = ?');
		$a->execute(array($_POST['ID_user']));
		$a->closeCursor();

		$a = $bdd->prepare('DELETE FROM proprietaire WHERE ID = ?');
		$a->execute(array($_POST['ID_user']));
		$a->closeCursor();

		unset($_SESSION['E_USER_SUPP']);
		$_SESSION['V_USER_SUPP'] = true;

		header('Location:admin_comptes.php');
	}
	else
	{
		$_SESSION['E_USER_SUPP'] = true;
		unset($_SESSION['V_USER_SUPP']);

		header('Location:admin_comptes.php');
	}
}
?>