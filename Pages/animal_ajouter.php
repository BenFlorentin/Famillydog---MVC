<?php 
	include'include/session.php';
	include'include/connexion_bdd.php';

	include'include/session.php';($_SESSION);

if(!isset($_SESSION['user_id'])) 
{
	$_SESSION['E_CONNEXION_REQUIS'] = true;
	header('Location:connexion.php');
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}

	include'include/header.php';


	?>

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

				<h1 class="text-center"> Nouvel animal</h1>
				&nbsp;
				<form method="post" action="animal_ajouter_post.php" class="form-horizontal">
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
								<input type="nom" class="form-control" id="nom" placeholder="Nom" name="nom" required>
							</div>
						</div>
						<div class="form-group">
							<label for="type" class="col-sm-2 control-label" name="type">Type</label>
							<div class="col-sm-10">
								<select type="text" class="form-control" name="type" required>
									<option name="type" value="Chien" selected>Chien</option>
									<option name="type" value="Chat">Chat</option>
									<option name="type" value="Rongeur">Rongeur</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="race" class="col-sm-2 control-label" name="race">Race</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="race" placeholder="Race" name="race" required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="datepicker" placeholder="ex :dd/mm/aaaa" name="date_naissance" required>
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
								<textarea class="form-control"  rows="2" cols="50" name="complem_info" id="complem_info" maxlength="500"></textarea>
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
			</fieldset>

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
					defaultDate: "-1",
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
		