<?php 

include'include/session.php';

include'include/connexion_bdd.php';

$a = $bdd->prepare('DELETE FROM tarifs WHERE ID = ?');
$a->execute(array($_POST['ID_tarifs']));
$a->closeCursor();

$_SESSION['V_TARIFS_SUPP'] = true;

header('Location:admin_tarifs.php');
?>