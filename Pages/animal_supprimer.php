<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$a = $bdd->prepare('SELECT COUNT(*) FROM reservation WHERE ID_animal = ?');
$a->execute(array($_POST['ID_animal']));
$r = $a->fetch();


if($r[0] == 0)
{
	$a->closeCursor();

	$a = $bdd->prepare('DELETE FROM animal WHERE ID = ?');
	$a->execute(array($_POST['ID_animal']));
	$a->closeCursor();

	unset($_SESSION['E_RESERVATION']);
	$_SESSION['V_SUPP_ANIMAL'] = true;

	header('Location:compte.php');
}
else
{
	$_SESSION['E_RESERVATION'] = true;
	unset($_SESSION['V_SUPP_ANIMAL']);

	header('Location: compte.php');
}
?>