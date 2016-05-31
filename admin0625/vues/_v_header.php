<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Famillydog - pension canine et féline</title>

	<meta charset="UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Famillydog est une pension canine et féline situé entre Uckange et Richemont. Elle acceuille toutes races de chiens et de chats.
	Vos compagnons sont entre de bonnes mains à Famillydog." />
	<meta name="author" content="">
	<meta name="keywords" content="famillydog, pension canine, Famillydog, pension féline, famildog, pension pour animaux, Familydog, pension pour animaux famillydog, pension pour chiens, 
	pension pour chats, pension pour chat, pension pour chien" />


	<?php 
	// inclure les scripts et css
	include'include/css_script.html';
	 ?>

	<nav class="navbar navbar-default navbar-static-top" >
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header" style="margin-bottom: 25px;">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php"><img src="../img/logo_famillydog.png" style="height: 300%;margin-top: -10px;"></a>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >			
				<ul class="nav navbar-nav navbar-right">
					<?php 
					if(isset($_SESSION['user_id']))
					{
						?>
						<!-- deconnexion.php -->
						<li><a href="index.php?uc=gererConnexion&action=deconnexion" style="top: 10px;"><i class="fa fa-power-off"></i> Se déconnecter</a></li>
					<?php 
					}
					?>
				</ul>
				<ul class="nav navbar-nav navbar-left">
				<?php 

				// côté administrateur
				if(isset($_SESSION['user_id']) && $_SESSION['user_droit'] == 1)
				{
					// gestion des messages


					// nb message en cours

					/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_messages FROM messagerie WHERE etat = ?');
					$me ->execute(array('E'));
					$message = $me->fetch();*/


					if($nbMessagesEnCours == 0)
					{
						echo'<li style="margin-right: 10px;">
						<form method="post" action="admin_messages.php" style="margin-top: 18px;">
						<button type="submit" class="btn btn-success"><i class="fa fa-envelope"></i> Message <span class="badge">0</span></button>
						</form>
						</li>';	
					}
					if($nbMessagesEnCours == 1)
					{
						echo'<li style="margin-right: 10px;">
						<form method="post" action="admin_messages.php" style="margin-top: 18px;">
						<button type="submit" class="btn btn-danger"><i class="fa fa-envelope"></i> Message <span class="badge">1</span></button>
						</form>
						</li>';	 	
					}
					if($nbMessagesEnCours > 1)
					{
						echo'<li style="margin-right: 10px;">
						<form method="post" action="admin_messages.php" style="margin-top: 18px;">
						<button type="submit" class="btn btn-danger"><i class="fa fa-envelope"></i> Messages <span class="badge">'.$nbMessagesEnCours.'</span></button>
						</form>
						</li>';	 	
					}

					/*$me->closeCursor();*/
					?>
					<li class="dropdown">
						<!-- administrateur -->
						<div class="dropdown" style="top: 20px; margin-right: 10px;">
							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
								<i class="fa fa-cogs"></i> Ad.Infos <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="admin_tarifs.php"><i class="fa fa-eur"></i> Gestion des tarifs</a></li>
								<li><a href="admin_comptes.php"><i class="fa fa-user"></i> Gestion des comptes et animaux <i class="fa fa-paw"></i></a></li>
								<li class="dropdown">
									<!-- gestion des réservations -->
									<a tabindex="-1" href="#"><i class="fa fa-calendar"></i> Gestion des réservations</a>
									<ul class="dropdown-menu">
										<li>
											<?php 
											// réservations non payées
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_non_payees FROM reservation WHERE etat = ?');
											$me->execute(array('NP'));
											$message = $me->fetch();*/

											if($nbReservationsNonPayees == 0)
											{
												echo'<li><a href="#" disabled="disabled">Non payée <span class="badge" style="background-color:green">0</span></a></li>';	 	
											}
											if($nbReservationsNonPayees == 1)
											{
												echo'<li><a href="admin_reservations_non_payees.php">Non payée <span class="badge" style="background-color:red">1</span></a></li>';	 	
											}
											if($nbReservationsNonPayees > 1)
											{
												echo'<li><a href="admin_reservations_non_payees.php">Non payées <span class="badge" style="background-color:red">'.$nbReservationsNonPayees.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>
										<li>
											<?php 

											// réservations payées
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_payees FROM reservation WHERE etat = ?');
											$me->execute(array('P'));
											$message = $me->fetch();*/

											if($nbReservationsPayees == 0)
											{
												echo'<li><a href="#" disabled="disabled">Payée <span class="badge" style="background-color: green">0</span></a></li>';	 	
											}
											if($nbReservationsPayees == 1)
											{
												echo'<li><a href="admin_reservations_payees.php">Payée <span class="badge" style="background-color: red">1</span></a></li>';	 	
											}
											if($nbReservationsPayees > 1)
											{
												echo'<li><a href="admin_reservations_payees.php">Payées <span class="badge" style="background-color: red">'.$nbReservationsPayees.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>
										<li>
											<?php 

											// réservation en cours
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_en_cours FROM reservation WHERE etat = ?');
											$me->execute(array('E'));
											$message = $me->fetch();*/

											if($nbReservationsEnCours == 0)
											{
												echo'<li><a href="#" disabled="disabled">En cours <span class="badge" style="background-color: green">0</span></a></li>';	 	
											}
											if($nbReservationsEnCours == 1)
											{
												echo'<li><a href="admin_reservations_en_cours.php">En cours <span class="badge" style="background-color: red">1</span></a></li>';	 	
											}
											if($nbReservationsEnCours > 1)
											{
												echo'<li><a href="admin_reservations_en_cours.php">En cours <span class="badge" style="background-color: red">'.$nbReservationsEnCours.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>
										<li>
											<?php 

											// réservations terminées
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_terminees FROM reservation WHERE etat = ?');
											$me->execute(array('T'));
											$message = $me->fetch();*/

											if($nbReservationsTerminees == 0)
											{
												echo'<li><a href="#" disabled="disabled">Terminée <span class="badge" style="background-color: green">0</span></a></li>';	 	
											}
											if($nbReservationsTerminees == 1)
											{
												echo'<li><a href="admin_reservations_terminees.php">Terminée <span class="badge" style="background-color: red">1</span></a></li>';	 	
											}
											if($nbReservationsTerminees > 1)
											{
												echo'<li><a href="admin_reservations_terminees.php">Terminées <span class="badge" style="background-color: red">'.$nbReservationsTerminees.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>

										<li role="separator" class="divider"></li>
										<li><a href="admin_reservations.php"><i class="fa fa-calendar"></i> Gestion des réservations</a></li>
									</ul>
								</li>
								<li class="dropdown">
									<!-- gestion des messages -->
									<a tabindex="-1" href="#"><i class="fa fa-envelope"></i> Messagerie </a>
									<ul class="dropdown-menu">
										<li>
											<?php 

											// messages réglés
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_regle FROM messagerie WHERE etat = ?');
											$me->execute(array('R'));
											$message = $me->fetch();*/

											if($nbMessagesRegles == 0)
											{
												echo'<li><a href="#" disabled="disabled">Réglé <span class="badge" style="background-color: green">0</span></a></li>';	 	
											}
											if($nbMessagesRegles == 1)
											{
												echo'<li><a href="admin_messages_regles.php">Réglé <span class="badge" style="background-color: red">1</span></a></li>';	 	
											}
											if($nbMessagesRegles > 1)
											{
												echo'<li><a href="admin_messages_regles.php">Réglés <span class="badge" style="background-color: red">'.$nbMessagesRegles.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>
										<li>
											<?php 
											// messages en cours
											/*$me = $bdd->prepare('SELECT COUNT(*) AS nb_en_cours FROM messagerie WHERE etat = ?');
											$me->execute(array('E'));
											$message = $me->fetch();*/

											if($nbMessagesEnCours == 0)
											{
												echo'<li><a href="#" disabled="disabled">En cours <span class="badge" style="background-color: green">0</span></a></li>';	 	
											}
											if($nbMessagesEnCours == 1)
											{
												echo'<li><a href="admin_messages_en_cours.php">En cours <span class="badge" style="background-color: red">1</span></a></li>';	 	
											}
											if($nbMessagesEnCours > 1)
											{
												echo'<li><a href="admin_messages_en_cours.php">En cours <span class="badge" style="background-color: red">'.$nbMessagesEnCours.'</span></a></li>';	 	
											}

											/*$me->closeCursor();*/
											?>
										</li>
										<li role="separator" class="divider"></li>
										<li><a href="admin_messages.php"><i class="fa fa-envelope"></i> Messagerie</a></li>
									</ul>
								</li>
								<li role="separator" class="divider"></li>
								<li><a href="admin_infos.php"><i class="fa fa-info"></i> Gestion des informations</a></li>
							</ul>
						</div>
					</li>
					<?php 
				}
				else
				{
					?>
					<li><a href="index.php?uc=gererConnexion&action=connecter" style="top: 10px;"><i class="fa fa-sign-in"></i> Se connecter</a></li>
					<?php 
				} ?>
				<li><div class="fb-like" data-layout="button" style="top: 25px;"></div></li>
			</ul>
		</ul>
	</div>
</div>
</nav>
<div class="container-fluid main-container">
	<div class="col-xs-12 col-md-2 sidebar">
		<ul class="nav nav-pills nav-stacked">
			<li><a href="index.php" style="top: 10px;"><i class="fa fa-home"></i> Accueil</a></li>
			<li><a href="reserver.php" style="top: 10px;"><i class="fa fa-calendar"></i> Réserver</a></li>
			<li><a href="tarifs.php" style="top: 10px;"><i class="fa fa-eur"></i>  Tarifs</a></li>
			<li><a href="contact.php" style="top: 10px;"><i class="fa fa-envelope"></i> Contact</a></li>
			<li>&nbsp;</li>
		</ul>
	</div>
	<div class="panel-body col-xs-12 col-md-10">
</nav>
<div id="fb-root"></div>
<script>
$(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
</head>
<div style="margin:0;padding:0;background: url(img/background.jpg) no-repeat center fixed; -webkit-background-size: cover; background-size: cover;">