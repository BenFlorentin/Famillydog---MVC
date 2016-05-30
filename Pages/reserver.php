<?php 
include'include/session.php';
include'include/connexion_bdd.php';


if(!isset($_SESSION['user_id'])) 
{
	$_SESSION['E_CONNEXION_REQUIS'] = true;

	header('Location: connexion.php');
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}

if(isset($_SESSION['ID_USER_TEMP']))
{
	$id = $_SESSION['ID_USER_TEMP'];
}
else
{
	$id = $_SESSION['user_id'];
}

include'include/header.php';

?>

<html>
<!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<body>
	<div class="container">
		<fieldset>
			<?php 
			include'erreur/gestion_erreurs.php';
			include'validation/gestion_validation.php';
			include'include/unset.php';

			?>

			<h1 class="text-center"><i class="fa fa-calendar"></i> Réservation</h1>
			<h2 class="text-center"> Animal </h2>

			<?php 
			if($_SESSION['user_droit'] == 1)
			{
				if(!isset($_POST['nom_user']) AND !(isset($_POST['prenom'])))
				{
					?>
					<form method="post" action="reserver.php" class="form-horizontal">
						<div class="form-group">
							<label for="nom_user" class="col-sm-2 control-label" name="nom_user">Nom </label>
							<div class="col-sm-10">
								<select type="text" class="form-control" name="nom_user" required>
									<?php 
									$lo = $bdd->query('SELECT DISTINCT nom FROM proprietaire');
									while ($ak = $lo->fetch()) 
									{
										?>
										<option name="nom_user" class="form-control" id="nom_user" placeholder="Nom de l'utilisateur" value="<?php echo htmlentities($ak['nom']) ?>"><?php echo htmlentities(strtoupper($ak['nom'])) ?></option>
										<?php 
									}
									$lo->closeCursor();
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
							</div>
						</div>
					</form>
					<?php 
				}

				if(!isset($_POST['prenom']) && isset($_POST['nom_user']))
				{
					?>
					<form method="post" action="reserver.php" class="form-horizontal">
						<div class="form-group">
							<label for="nom_user" class="col-sm-2 control-label" name="nom_user">Nom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nom_user" placeholder="Nom" name="nom_user" value="<?php echo htmlentities(strtoupper($_POST['nom_user'])) ?>" disabled="disabled">
							</div>
						</div>
						<div class="form-group">
							<label for="prenom" class="col-sm-2 control-label" name="prenom">Prénom </label>
							<div class="col-sm-10">
								<select type="text" class="form-control" name="prenom" required>
									<?php 
									$lo = $bdd->prepare('SELECT DISTINCT prenom FROM proprietaire WHERE nom = ?');
									$lo ->execute(array(htmlentities($_POST['nom_user'])));
									while ($ak = $lo->fetch()) 
									{
										?>
										<option name="prenom" class="form-control" id="prenom" placeholder="Prénom de l'utilisateur" value="<?php echo htmlentities($ak['prenom']) ?>"><?php echo htmlentities(ucfirst($ak['prenom'])) ?></option>
										<?php 
									}
									$lo->closeCursor();
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="hidden" value="<?php echo htmlentities($_POST['nom_user']) ?>" name="nom_user">
								<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
							</div>
						</div>
					</form>
					<?php 
				}

				if(isset($_POST['prenom']) AND isset($_POST['nom_user']))
				{
					?>
					<form method="post" action="reserver_post.php" class="form-horizontal">
						<div class="form-group">
							<label for="nom_user" class="col-sm-2 control-label" name="nom_user">Nom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nom_user" placeholder="Nom" name="nom_user" value="<?php echo htmlentities($_POST['nom_user']) ?>" disabled="disabled"  required>
							</div>
						</div>
						<div class="form-group">
							<label for="prenom" class="col-sm-2 control-label" name="prenom">Prénom</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="nom" placeholder="Prénom" name="prenom" value="<?php echo htmlentities($_POST['prenom']) ?>" disabled="disabled"  required>
							</div>
						</div>
						<div class="form-group">
							<label for="nom" class="col-sm-2 control-label" name="nom">Animal</label>
							<div class="col-sm-10">
								<select type="text" class="form-control" name="nom" required>
									<?php 

									$ml = $bdd->prepare('SELECT ID FROM proprietaire WHERE nom = ? AND prenom = ?');
									$ml->execute(array(htmlentities($_POST['nom_user']), htmlentities($_POST['prenom'])));
									$mp = $ml->fetch();

									$lo = $bdd->prepare('SELECT DISTINCT nom FROM animal WHERE ID_proprietaire = ?');
									$lo->execute(array(htmlentities($mp['ID'])));

									while ($ak = $lo->fetch()) 
									{
										?>
										<option name="nom" class="form-control" id="nom" placeholder="Nom de l'animal" value="<?php echo htmlentities($ak['nom']) ?>"><?php echo htmlentities(ucfirst($ak['nom'])) ?></option>
										<?php 
									}
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<input type="hidden" value="<?php echo htmlentities($mp['ID']) ?>" name="ID_user">
								<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
							</div>
						</div>
					</form>
					<?php 
					$ml->closeCursor();
					$lo->closeCursor();
				}
			}
			else
			{
				?>
				<form method="post" action="reserver_post.php" class="form-horizontal">
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label" name="nom">Animal</label>
						<div class="col-sm-10">
							<select type="text" class="form-control" name="nom" required>
								<?php 
								$lo = $bdd->prepare('SELECT DISTINCT nom FROM animal WHERE ID_proprietaire = ?');
								$lo->execute(array($id));
								while ($ak = $lo->fetch()) 
								{
									?>
									<option name="nom" class="form-control" id="nom" placeholder="Nom de l'animal" value="<?php echo htmlentities($ak['nom']) ?>"><?php echo htmlentities(ucfirst($ak['nom'])) ?></option>
									<?php 
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
						</div>
					</div>
				</form>
				<?php
				$lo->closeCursor();
			} ?>
		</fieldset>
	</div>
	&nbsp;
	<div class="container">
		<fieldset>
			<h2 class="text-center"> Nouvel animal</h2>
			<?php

			if($_SESSION['user_droit'] == 1)
			{
				if(!isset($_POST['nom_user_new']) AND !(isset($_POST['prenom_new'])))
				{
					?>
					<form method="post" action="reserver.php" class="form-horizontal">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nom_user_new" class="col-sm-2 control-label" name="nom_user_new">Nom </label>
								<div class="col-sm-10">
									<select type="text" class="form-control" name="nom_user_new" required>
										<?php 
										$lo = $bdd->query('SELECT DISTINCT nom FROM proprietaire');
										while ($ak = $lo->fetch()) 
										{
											?>
											<option name="nom_user_new" class="form-control" id="nom_user_new" placeholder="Nom de l'utilisateur" value="<?php echo htmlentities($ak['nom']) ?>"><?php echo htmlentities(ucfirst($ak['nom'])) ?></option>
											<?php 
										}
										$lo->closeCursor();
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
								</div>
							</div>
						</div>
					</form>
					<?php 
				}

				if(!isset($_POST['prenom_new']) && isset($_POST['nom_user_new']))
				{
					?>
					<form method="post" action="reserver.php" class="form-horizontal">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nom_user_new" class="col-sm-2 control-label" name="nom_user_new">Nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nom_user_new" placeholder="Nom" name="nom_user_new" value="<?php echo htmlentities(strtoupper($_POST['nom_user_new'])) ?>" disabled="disabled">
								</div>
							</div>
							<div class="form-group">
								<label for="prenom_new" class="col-sm-2 control-label" name="prenom_new">Prénom </label>
								<div class="col-sm-10">
									<select type="text" class="form-control" name="prenom_new" required>
										<?php 
										$lo = $bdd->prepare('SELECT DISTINCT prenom FROM proprietaire WHERE nom = ?');
										$lo ->execute(array(htmlentities($_POST['nom_user_new'])));
										while ($ak = $lo->fetch()) 
										{
											?>
											<option name="prenom_new" class="form-control" id="prenom_new" placeholder="Prénom de l'utilisateur" value="<?php echo htmlentities($ak['prenom']) ?>"><?php echo htmlentities(ucfirst($ak['prenom'])) ?></option>
											<?php 
										}
										$lo->closeCursor();
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="hidden" value="<?php echo htmlentities($_POST['nom_user_new']) ?>" name="nom_user_new">
									<button type="submit" class="btn btn-success" name="animal_existant"> Suite</button>
								</div>
							</div>
						</div>
					</form>
					<?php 
				}

				if(isset($_POST['prenom_new']) AND isset($_POST['nom_user_new']))
				{
					?>
					<form method="post" action="reserver_post.php" class="form-horizontal">
						<div class="col-md-6">
							<div class="form-group">
								<label for="nom_user_new" class="col-sm-2 control-label" name="nom_user_new">Nom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nom_user_new" placeholder="Nom" name="nom_user_new" value="<?php echo htmlentities(strtoupper($_POST['nom_user_new'])) ?>" disabled="disabled"  required>
								</div>
							</div>
							<div class="form-group">
								<label for="prenom_new" class="col-sm-2 control-label" name="prenom_new">Prénom</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="nom" placeholder="Prénom" name="prenom_new" value="<?php echo htmlentities(ucfirst($_POST['prenom_new'])) ?>" disabled="disabled"  required>
								</div>
							</div>
							<div class="form-group">
								<label for="genre" class="col-sm-2 control-label" >Genre</label>
								<div class="col-sm-10	">
									<input type="radio" name="genre" id="M" value="M" checked> M
									&nbsp;
									<input type="radio" name="genre" id="F" value="F"> F
								</div>
							</div>
							<div class="form-group">
								<label for="nom" class="col-sm-2 control-label" name="nom">Nom</label>
								<div class="col-sm-10">
									<input type="nom" class="form-control" id="nom" size="10" maxlength="50" placeholder="Nom" name="nom" required>
								</div>
							</div>
							<div class="form-group">
								<label for="type" class="col-sm-2 control-label" name="type">Type</label>
								<div class="col-sm-10">
									<select type="text" class="form-control" name="type" required>
										<option name="type" class="form-control"value="Chien" selected>Chien</option>
										<option name="type" class="form-control"value="Chat">Chat</option>
										<option name="type" class="form-control" value="Rongeur">Rongeur</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="race" class="col-sm-2 control-label" name="race">Race</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" size="10" maxlength="50" id="race" placeholder="Race" name="race" required>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="datepicker" size="10" maxlength="10" placeholder="ex :dd/mm/aaaa" name="date_naissance" required>
								</div>
							</div>
							<div class="form-group">
								<label for="vaccine" class="col-sm-2 control-label" >Vacciné(e)</label>
								<div class="col-sm-10	">
									<input type="radio" name="vaccine" id="Oui" value="Oui" checked> Oui
									&nbsp;
									<input type="radio" name="vaccine" id="Non" value="Non"> Non
								</div>
							</div>
							<div class="form-group">
								<label for="puce" class="col-sm-2 control-label" >Pucé(e)</label>
								<div class="col-sm-10	">
									<input type="radio" name="puce" id="Oui" value="Oui" checked> Oui
									&nbsp;
									<input type="radio" name="puce" id="Non" value="Non"> Non
								</div>
							</div>
							<div class="form-group">
								<label for="complem_info" class="col-sm-2 control-label" name="complem_info">Complément d'information </label>
								<div class="col-sm-10">
									<textarea class="form-control"  rows="2" cols="50" name="complem_info" id="complem_info"></textarea>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-2 col-sm-10">
								<?php 

								$m = $bdd->prepare('SELECT ID FROM proprietaire WHERE nom = ? AND prenom = ?');
								$m->execute(array(htmlentities($_POST['nom_user_new']), htmlentities($_POST['prenom_new'])));
								$mp = $m->fetch();

								?>
								<input type="hidden" value="<?php echo htmlentities($mp['ID']) ?>" name="ID_user">
								<button type="submit" class="btn btn-success" name="new_animal"> Suite</button>
							</div>
						</div>
					</div>
				</form>
				<?php 
				$m->closeCursor();
			}
		}
		else
		{
			?>
			&nbsp;
			<form method="post" action="reserver_post.php" class="form-horizontal">
				<div class="col-md-6">
					<div class="form-group">
						<label for="genre" class="col-sm-2 control-label" >Genre</label>
						<div class="col-sm-10	">
							<input type="radio" name="genre" id="M" value="M" checked> M
							&nbsp;
							<input type="radio" name="genre" id="F" value="F"> F
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label" name="nom">Nom</label>
						<div class="col-sm-10">
							<input type="nom" class="form-control" id="nom" size="10" maxlength="50" placeholder="Nom" name="nom" required>
						</div>
					</div>
					<div class="form-group">
						<label for="type" class="col-sm-2 control-label" name="type">Type</label>
						<div class="col-sm-10">
							<select type="text" class="form-control" name="type" required>
								<option name="type" class="form-control"value="Chien" selected>Chien</option>
								<option name="type" class="form-control"value="Chat">Chat</option>
								<option name="type" class="form-control" value="Rongeur">Rongeur</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="race" class="col-sm-2 control-label" name="race">Race</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="race" size="10" maxlength="50" placeholder="Race" name="race" required>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="datepicker" size="10" maxlength="10" placeholder="ex :dd/mm/aaaa" name="date_naissance" required>
						</div>
					</div>
					<div class="form-group">
						<label for="vaccine" class="col-sm-2 control-label" >Vacciné(e)</label>
						<div class="col-sm-10	">
							<input type="radio" name="vaccine" id="Oui" value="Oui" checked> Oui
							&nbsp;
							<input type="radio" name="vaccine" id="Non" value="Non"> Non
						</div>
					</div>
					<div class="form-group">
						<label for="puce" class="col-sm-2 control-label" >Pucé(e)</label>
						<div class="col-sm-10	">
							<input type="radio" name="puce" id="Oui" value="Oui" checked> Oui
							&nbsp;
							<input type="radio" name="puce" id="Non" value="Non"> Non
						</div>
					</div>
					<div class="form-group">
						<label for="complem_info" class="col-sm-2 control-label" name="complem_info">Complément d'information </label>
						<div class="col-sm-10">
							<textarea class="form-control"  rows="2" cols="50" name="complem_info" id="complem_info"></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember" required> J'accepte les termes du contrats...
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-success" name="new_animal"> Suite </button>
					</div>
				</div>
			</form>
			<?php 
		} ?>
	</fieldset>
</div>

<!-- Script datepicker -->
<script>
$(function() {
	$( "#datepicker" ).datepicker({
		dateFormat : 'dd/mm/yy',
		changeMonth: true,
		changeYear: true,
		dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
		dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
		monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
		monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
		monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
		firstDay: 1,
		maxDate: -1
				//showOn: "both",
      			//buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
      		});
});

$( ".selector" ).datepicker({
	dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ]
});
</script>
</body>
<!-- footer -->
<?php 
include'include/footer.php'; ?>
</html>