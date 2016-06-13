<?php 


// user
	// modifier
if(isset($_SESSION['V_USER']) && $_SESSION['V_USER'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La modification a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
		/*echo '<div class="alert alert-success"> La modification a été effectuée ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_USER']);
	}
	//ajouter
	if(isset($_SESSION['V_ADD_USER']) && $_SESSION['V_ADD_USER'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
			<i class="fa fa-check-circle" aria-hidden="true"></i>

			<strong>Succès</strong> L'ajout a été effectuée !
			<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
		<?php
		/*echo '<div class="alert alert-success"> Bienvenue '.htmlentities(strtoupper($_SESSION['user_nom'])).' '. htmlentities(ucfirst($_SESSION['user_prenom'])).' ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_ADD_USER']);
	}
	//supprimer
	if(isset($_SESSION['V_USER_SUPP']) && $_SESSION['V_USER_SUPP'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La suppression a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
/*		echo '<div class="alert alert-success"> La suppréssion a été effectuée ! </div>';
echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['V_USER_SUPP']);
}



// animal
	// modifier
if(isset($_SESSION['V_ANIMAL']) && $_SESSION['V_ANIMAL'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La modification a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
/*		echo '<div class="alert alert-success"> La modification a été effectuée ! </div>';
echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['V_ANIMAL']);
}
	//supprimer
if(isset($_SESSION['V_SUPP_ANIMAL']) && $_SESSION['V_SUPP_ANIMAL'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La suppession a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
		/*echo '<div class="alert alert-success"> La suppréssion de l\'animal a été effectuée ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_SUPP_ANIMAL']);
	}
	//ajouter
	if(isset($_SESSION['V_ADD_ANIMAL']) && $_SESSION['V_ADD_ANIMAL'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> L'animal a été ajouté !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
/*		echo '<div class="alert alert-success"> L\'animal a été ajouté ! </div>';
echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['V_ADD_ANIMAL']);
}





// réservation
	//modifier
if(isset($_SESSION['V_RESERVATION_MODIFIER']) && $_SESSION['V_RESERVATION_MODIFIER'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La modification a été modifiée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
		/*echo '<div class="alert alert-success"> La modification de la réservation a été effectuée ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_RESERVATION_MODIFIER']);
	}
	// modifier etat reservation
	if(isset($_SESSION['V_ETAT']) && $_SESSION['V_ETAT'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> L'état a été modifié !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
		/*echo '<div class="alert alert-success"> L\'etat a été modifié ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_ETAT']);
	}

	if(isset($_SESSION['V_SUPP_RESERVATION']) && $_SESSION['V_SUPP_RESERVATION'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La suppression a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
		/*echo '<div class="alert alert-success"> La suppression a été effectuée ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_SUPP_RESERVATION']);
	}

	if(isset($_SESSION['V_ADD_RESERVATION']) && $_SESSION['V_ADD_RESERVATION'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> L'ajout a été effectué !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
		/*echo '<div class="alert alert-success"> L'ajout a été effectué ! </div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_ADD_RESERVATION']);
	}



// connexion
	if(isset($_SESSION['V_CONNEXION']) && $_SESSION['V_CONNEXION'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
			<i class="fa fa-check-circle" aria-hidden="true"></i>

			<strong>Bienvenue</strong> <?php echo ucfirst($_SESSION['user_prenom']).' '.strtoupper($_SESSION['user_nom']); ?>
			<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
		<?php
	/*echo '<div class="alert alert-success"> Bienvenue '.htmlentities(strtoupper($_SESSION['user_nom'])).' '. htmlentities(ucfirst($_SESSION['user_prenom'])).' ! </div>';
	echo'<br/><br/>	';*/
}
else
{
	unset($_SESSION['V_CONNEXION']);
}








// tarifs
	// modification
if(isset($_SESSION['V_TARIFS']) && $_SESSION['V_TARIFS'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La modification a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
		/*echo '<div class="alert alert-success">La modification a été effectuée !</div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_TARIFS']);
	}
	//suppression
	if(isset($_SESSION['V_TARIFS_SUPP']) && $_SESSION['V_TARIFS_SUPP'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La suppression a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
		/*echo '<div class="alert alert-success">La suppréssion a été effectuée !</div>';
		echo'<br/><br/>	';*/
	}
	else
	{
		unset($_SESSION['V_TARIFS_SUPP']);
	}




// Contact
	//envoie
	if(isset($_SESSION['V_MESSAGE']) AND $_SESSION['V_MESSAGE'] == true)
	{
		?>
		<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> Votre message a été envoyé !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
		<?php
	/*	echo'<div class="alert alert-success"> Votre message à bien été envoyée !</div>';
	echo'<br/><br/>';*/
}
else
{
	unset($_SESSION['V_MESSAGE']);
}
	//suppression
if(isset($_SESSION['V_SUPP_MESSAGE']) AND $_SESSION['V_SUPP_MESSAGE'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> Le message a été supprimé !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*	echo'<div class="alert alert-success"> Votre message à bien été envoyée !</div>';
	echo'<br/><br/>';*/
}
else
{
	unset($_SESSION['V_SUPP_MESSAGE']);
}
	//modifier
if(isset($_SESSION['V_MODIFIER_MESSAGE']) AND $_SESSION['V_MODIFIER_MESSAGE'] == true)
{
	?>
	<div style="border-radius: 20px;"class="alert alert-success alert-dismissable fade in">
		<i class="fa fa-check-circle" aria-hidden="true"></i>

		<strong>Succès</strong> La modification a été effectuée !
		<!-- Générer par le plugin quand la classe alert-dismissable est ajoutée -->
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	</div>
	<?php
	/*	echo'<div class="alert alert-success"> Votre message à bien été envoyée !</div>';
	echo'<br/><br/>';*/
}
else
{
	unset($_SESSION['V_MODIFIER_MESSAGE']);
}





?>