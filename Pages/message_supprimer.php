<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$a = $bdd->prepare('DELETE FROM messagerie WHERE ID = ?');
$a->execute(array($_POST['ID']));
$a->closeCursor();

$_SESSION['V_SUPP_MESSAGE'] = true;


header('Location:admin_messages.php');
?>