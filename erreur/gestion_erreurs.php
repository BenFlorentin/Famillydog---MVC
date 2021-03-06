<?php 

//date naissance
	//jour
if(isset($_SESSION['E_JOUR']) && $_SESSION['E_JOUR'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de naissance n'est pas valide : jour ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php 
	/*echo '<div class="alert alert-danger">La date de naissance n\'est pas valide : jour ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_JOUR']);
}
	//mois
if(isset($_SESSION['E_MOIS']) && $_SESSION['E_MOIS'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de naissance n'est pas valide : mois ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php 
	/*echo '<div class="alert alert-danger">La date de naissance n\'est pas valide : mois ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_MOIS']);
}
	//année
if(isset($_SESSION['E_ANNEE']) && $_SESSION['E_ANNEE'] == true)
{?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de naissance n'est pas valide : année ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php 
	/*echo '<div class="alert alert-danger">La date de naissance n\'est pas valide : année ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_ANNEE']);
}
	//jour, mois et année
if(isset($_SESSION['E_JOUR_MOIS_ANNEE']) && $_SESSION['E_JOUR_MOIS_ANNEE'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de naissance n'est pas valide : jour, mois, année ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php 
	/*echo '<div class="alert alert-danger">La date de naissance n\'est pas valide : jour, mois, année ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_JOUR_MOIS_ANNEE']);
}


//animal
	// non existant
if(isset($_SESSION['E_ANIMAL']) && $_SESSION['E_ANIMAL'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! L'animal n'existe pas ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php 
	/*echo '<div class="alert alert-danger">L\'animal n\'existe pas ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_ANIMAL']);
}


// user
	// données saisies incorrectes
if(isset($_SESSION['E_USER']) && $_SESSION['E_USER'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Les données saisies sont incorrectes ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Les données saisies sont incorrectes ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_USER']);
}
	// données incorrectes (inscription)
if(isset($_SESSION['E_ADD_USER']) && $_SESSION['E_ADD_USER'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Les données saisies lors de l'inscription d'un utilisateur ne sont pas valides ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Les données saisies lors de l\'inscription d\'un utilisateur ne sont pas valides ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_ADD_USER']);
}
	//suppression utilisateur impossible(possède reservation)
if(isset($_SESSION['E_USER_SUPP']) && $_SESSION['E_USER_SUPP'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Cet utilisateur ne peut pas être supprimé car il possède une réservation ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Cet utilisateur ne peut pas être supprimé car il possède une réservation! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_USER_SUPP']);
}




//animal
	//suppression reservation pour un animal
if(isset($_SESSION['E_RESERVATION']) && $_SESSION['E_RESERVATION'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Cet animal possède une réservation ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-success">Cet animal possède déjà une réservation ! <br/>
	Opération annulée !</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_RESERVATION']);
}
	//données saisies incorrectes
if(isset($_SESSION['E_ANIMAL']) && $_SESSION['E_ANIMAL'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Les données saisies sont incorrectes ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Les données saisies sont incorrectes ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_ANIMAL']);
} 	
//animal non existant
if(isset($_SESSION['E_ANIMAL_EXIST']) && $_SESSION['E_ANIMAL_EXIST'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! L'animal n'existe pas ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">L\'animal n\'existe pas ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_ANIMAL_EXIST']);
} 




//connexion
	//se connecter
if(isset($_SESSION['E_CONNEXION']) && $_SESSION['E_CONNEXION'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Les données saisies sont incorrectes ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Les données saisies sont incorrectes ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_CONNEXION']);
}
	// connexion requise (accès à une page)
if(isset($_SESSION['E_CONNEXION_REQUIS']) && $_SESSION['E_CONNEXION_REQUIS'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Vous devez être connecté pour pouvoir accéder à cette page ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Vous devez être connecté pour pouvoir accéder à cette page ! </div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}






//réservation
	//modifier reseravtion
if(isset($_SESSION['E_RESERVATION_MODIFIER']) && $_SESSION['E_RESERVATION_MODIFIER'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Les données saisies sont incorrectes ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Les données saisies sont incorrectes ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_RESERVATION_MODIFIER']);
}

	//date fin
if(isset($_SESSION['E_DATE_FIN']) && $_SESSION['E_DATE_FIN'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de fin de la réservation n'est pas valide ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">La date de fin de la réservation n\'est pas valide ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_DATE_FIN']);
}
	//date debut
if(isset($_SESSION['E_DATE_DEBUT']) && $_SESSION['E_DATE_DEBUT'] == true)
{?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de début de la réservation n'est pas valide  ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">La date de début de la réservation n\'est pas valide ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_DATE_DEBUT']);
}
	//date debut de la période 
if(isset($_SESSION['E_DATE_DEBUT_PERIODE']) && $_SESSION['E_DATE_DEBUT_PERIODE'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de début de la période n'est pas valide ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">La date de début de saison n\'est pas valide  ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_DATE_DEBUT_PERIODE']);
}
	//date fin de la période
if(isset($_SESSION['E_DATE_FIN_PERIODE']) && $_SESSION['E_DATE_FIN_PERIODE'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! La date de fin de la période n'est pas valide ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">La date de fin de saison n\'est pas valide  ! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_DATE_FIN_PERIODE']);
}
// prix  jour chien
if(isset($_SESSION['E_PRIX_JOUR_CHIEN']) && $_SESSION['E_PRIX_JOUR_CHIEN'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Le prix saisie pour la journée par chien est incorrect ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Le prix saisie pour la période blanche est incorrect! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_PRIX_JOUR_CHIEN']);
}
//prix jour chat
if(isset($_SESSION['E_PRIX_JOUR_CHAT']) && $_SESSION['E_PRIX_JOUR_CHAT'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Le prix saisie pour la journée par chat est incorrect ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Le prix saisie pour la période bleue est incorrect! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_PRIX_JOUR_CHAT']);
}

// tarifs
if(isset($_SESSION['E_TARIFS']) && $_SESSION['E_TARIFS'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Il y a une erreur dans la saisie des données ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Le prix saisis pour la période rouge est incorrect! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_TARIFS']);
}

// tarifs existant
if(isset($_SESSION['E_TARIFS_EXISTANTS']) && $_SESSION['E_TARIFS_EXISTANTS'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-danger alert-dismissable fade in">
		<i class="fa fa-times" aria-hidden="true"></i>


		<strong>Echec ! Il existe déjà une période comportant les dates saisies ! Opération annulée !</strong>
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*echo '<div class="alert alert-danger">Le prix saisis pour la période rouge est incorrect! <br/>
	Opération annulée</div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['E_TARIFS_EXISTANTS']);
}

?>