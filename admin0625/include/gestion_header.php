<?php 

// inclure la bibliothèque de classes
require_once '../include/_bll.lib.php';
require_once '../include/_reference.lib.php';

var_dump($_SESSION);

// nombre de message en cours
$nbMessagesEnCours = Messages::nbMessages('E');

// nombre de message réglés
$nbMessagesRegles = Messages::nbMessages('R');

// nombre de réservations non payées
$nbReservationsNonPayees = Reservations::nbReservations('NP');

// nombre de réservations payées
$nbReservationsPayees = Reservations::nbReservations('P');

// nombre de réservations en cours
$nbReservationsEnCours = Reservations::nbReservations('E');

// nombre de réservations terminées
$nbReservationsTerminees = Reservations::nbReservations('T');

include 'vues/_v_header.php';

 ?>
