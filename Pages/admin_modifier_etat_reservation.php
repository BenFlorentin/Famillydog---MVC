<?php 
include'include/session.php';

include'include/connexion_bdd.php';


$a = $bdd->prepare('UPDATE reservation
					SET etat = ?
					WHERE ID = ?');
$a->execute(array($_POST['etat'], $_POST['ID_reservation']));


$_SESSION['V_ETAT'] = true;
header('Location: admin_reservations.php');




?>