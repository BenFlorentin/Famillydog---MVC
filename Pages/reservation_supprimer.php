<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$a = $bdd->prepare('DELETE FROM reservation WHERE ID = ?');
$a->execute(array($_POST['ID_reservation']));
$a->closeCursor();

$_SESSION['V_SUPP_RESERVATION'] = true;


if(isset($_POST['admin']))
{
	header('Location:admin_reservations.php');
}
else
{
	header('Location:compte.php');
}

?>