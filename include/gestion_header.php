<?php 

// inclure la bibliothèque de classes
require_once 'include/_bll.lib.php';
require_once 'include/_reference.lib.php';

include'include/session.php';($_SESSION);

// nombre de réservations payées de l'utilisateur
$nbReservationsUtilisateurPayees = Reservations::nbReservationsParEtatEtParId('P',$_SESSION['user_id']);

// nombre de réservations non payées de l'utilisateur
$nbReservationsUtilisateurNonPayees = Reservations::nbReservationsParEtatEtParId('NP',$_SESSION['user_id']);

// nombre de réservations en cours de l'utilisateur
$nbReservationsUtilisateurEnCours = Reservations::nbReservationsParEtatEtParId('E',$_SESSION['user_id']);

// nombre de réservations terminées de l'utilisateur
$nbReservationsUtilisateurTerminées = Reservations::nbReservationsParEtatEtParId('T',$_SESSION['user_id']);

include 'vues/_v_header.php';

 ?>
