<?php 

include'include/session.php';

include'include/connexion_bdd.php';


$a = $bdd->prepare('INSERT INTO messagerie (nom,prenom,email,sujet,message,tel,etat, date_msg)
                    VALUES(?,?,?,?,?,?,?,?)');
$a->execute(array($_POST['nom'],
					$_POST['prenom'],
					$_POST['email'],
					$_POST['sujet'],
					$_POST['message'],
					$_POST['tel'],
					'E',
					date('Y-m-d',time())));

  $_SESSION['V_MESSAGE'] = true;
  header('Location: contact.php');
?>