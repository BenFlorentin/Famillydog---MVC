<?php 
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';
?>

<!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<body>
	<div class="container">
		<fieldset>
			 <h1 class="text-center">Nouvel utilisateur</h1>
			<form method="post" action="admin_compte_add_post.php" class="form-horizontal">
				<div class="col-md-6">
					<div class="form-group">
						<label for="genre" class="col-sm-2 control-label" >Genre*</label>
						<div class="col-sm-10">
							<input type="radio" name="genre" id="M." value="M." checked> M.
							<input type="radio" name="genre" id="Mme" value="Mme"> Mme
							<input type="radio" name="genre" id="Mlle" value="Mlle"> Mlle
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label" name="nom">Nom*</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="nom" placeholder="Nom" size="5" maxlength="50"  name="nom" required>
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label" name="prenom">Prénom*</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="prenom" placeholder="Prénom" name="prenom" size="5" maxlength="50" required>
						</div>
					</div>
					<div class="form-group">
						<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance*</label>
						<div class="col-sm-10">
							<input type="date" class="form-control" id="datepicker" placeholder="ex :dd/mm/aaaa" name="date_naissance" size="5" maxlength="10"required>
						</div>
					</div>
					<div class="form-group">
						<label for="collectivites" class="col-sm-2 control-label" name="collectivites">Collectivites</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="collectivites" placeholder="Collectivités" size="5" maxlength="500" name="collectivites">
						</div>
					</div>
					<div class="form-group">
						<label for="tel" class="col-sm-2 control-label" name="tel">Tél*</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="tel"  size="10" placeholder="ex : 0123456789" size="5" maxlength="10"name="tel" required>
						</div>
					</div>
					<div class="form-group">
						<label for="fix" class="col-sm-2 control-label" name="fix">Fix</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="fix"  size="10" placeholder="ex : 0123456789" size="5" maxlength="10" name="fix">
						</div>
					</div>
					<div class="form-group">
						<label for="fax" class="col-sm-2 control-label" name="fax">Fax</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="fax"  size="10" placeholder="ex : 0123456789" size="5" maxlength="10" name="fax">
						</div>
					</div>
					<div class="form-group">
						<label for="complem_info" class="col-sm-2 control-label" name="complem_info">Complément d'information </label>
						<div class="col-sm-10">
							<textarea class="form-control"  rows="4" cols="50" name="complem_info" id="complem_info"></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label" name="email">E-mail*</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email"  size="5" maxlength="50" placeholder="ex : 0123456789" name="email" required>
						</div>
					</div>
					<div class="form-group">
						<label for="mdp" class="col-sm-2 control-label" name="mdp">Mot de passe*</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="mdp" size="5" maxlength="50" placeholder="Mot de passe" name="mdp" required>
						</div>
					</div>
					<div class="form-group">
						<label for="num_rue_voie" class="col-sm-2 control-label" name="num_rue_voie">Numéro de rue/voie*</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="num_rue_voie"  size="3" maxlength="3" placeholder="Numéro de rue_voie" name="num_rue_voie" required>
						</div>
					</div>
					<div class="form-group">
						<label for="rue_voie" class="col-sm-2 control-label" name="rue_voie">Rue/voie*</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="rue_voie" size="5" maxlength="50" placeholder="Rue/Voie/Route/Chemin/etc..." name="rue_voie" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label" name="ville">Ville*</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ville" size="5" maxlength="50" placeholder="Ville" name="ville" required>
						</div>
					</div>
					<div class="form-group">
						<label for="code_postal" class="col-sm-2 control-label" name="code_postal">Code postal*</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="code_postal"  size="5" maxlength="5" max="5" placeholder="ex : 57000" name="code_postal" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pays" class="col-sm-2 control-label" name="pays">Pays*</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="pays"  size="5" maxlength="50" placeholder="ex : France" name="pays" required>
						</div>
					</div>
					<div class="form-group">
						<label for="complem_adr" class="col-sm-2 control-label" name="complem_adr">Complément d'adresse</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" cols="50" name="complem_adr" id="complem_adr" ></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember" required> J'accepte les termes du contrats*
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-success">S'inscrire</button>
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
				maxDate: 0
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
