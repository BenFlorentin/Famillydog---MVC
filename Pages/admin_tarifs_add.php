<!-- header -->
<?php 
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';


/*$u = $bdd->prepare('SELECT * FROM tarifs WHERE ID = ?');
$u->execute(array($_POST['ID_tarifs']));
$tarifs = $u->fetch();*/
?>

<!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<div class="container">
	<fieldset>
		 <h1 class="text-center"><i class="fa fa-eur"></i> Nouveaux tarifs <i class="fa fa-eur"></i></h1> 
		<?php 

      include'erreur/gestion_erreurs.php';
      include'validation/gestion_validation.php';
      include'include/unset.php';
       ?>
		<a href="admin_tarifs.php"><i class="fa fa-reply"></i> Précèdent</a>
		&nbsp;
		<form method="post" action="admin_tarifs_add_post.php" class="form-horizontal">
			<div class="col-md-6">
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Saison </label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="saison_debut" placeholder="ex :dd/mm/aaaa" name="saison_debut" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="saison_fin" placeholder="ex :dd/mm/aaaa" name="saison_fin" required>
					</div>
				</div>
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Période blanche </label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_debut_bla" placeholder="ex :dd/mm/aaaa" name="date_debut_bla" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_fin_bla" placeholder="ex :dd/mm/aaaa" name="date_fin_bla" required>
					</div>
				</div>
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Période rouge </label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_debut_rou" placeholder="ex :dd/mm/aaaa" name="date_debut_rou" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_fin_rou" placeholder="ex :dd/mm/aaaa" name="date_fin_rou" required>
					</div>
				</div>
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Période bleue </label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_debut_ble" placeholder="ex :dd/mm/aaaa" name="date_debut_ble" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="date_fin_ble" placeholder="ex :dd/mm/aaaa" name="date_fin_ble" required>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<br/>
				<br/>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée </label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_bla" placeholder="ex: 5" required>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée </label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_rou" placeholder="ex: 5" required>
					</div>
				</div>
				<br>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée </label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_ble" placeholder="ex: 5" required>
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
					<button type="submit" class="btn btn-success">Modifier</button>
				</div>
			</div>
		</form>
	</fieldset>

	<!-- Script datepicker -->

	<script>
	$(function() {
		$( "#saison_debut" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#saison_fin" ).datepicker( "option", "minDate", selectedDate );

				// date minimum des périodes limitée à la date de debut de la saison
				/*$( "#date_debut_bla" ).datepicker( "option", "minDate", selectedDate );
				$( "#date_debut_ble" ).datepicker( "option", "minDate", selectedDate );
				$( "#date_debut_rou" ).datepicker( "option", "minDate", selectedDate );	*/
			}
		});
		$( "#saison_fin" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) {
				$( "#saison_debut" ).datepicker( "option", "maxDate", selectedDate );

				// date max des périodes limitées à la date de fin de la saison
				/*$( "#date_fin_bla" ).datepicker( "option", "maxDate", selectedDate );
				$( "#date_fin_ble" ).datepicker( "option", "maxDate", selectedDate );
				$( "#date_fin_rou" ).datepicker( "option", "maxDate", selectedDate );*/
			}
		});
	});
	$(function() {
		$( "#date_debut_bla" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_fin_bla" ).datepicker( "option", "minDate", selectedDate );
			}
			
		});
		$( "#date_fin_bla" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_debut_bla" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
	$(function() {
		$( "#date_debut_ble" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_fin_ble" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#date_fin_ble" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_debut_ble" ).datepicker( "option", "maxDate", selectedDate );
			}
			
		});
	});
	$(function() {
		$( "#date_debut_rou" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_fin_rou" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#date_fin_rou" ).datepicker({
			defaultDate: "+1w",
			dateFormat : 'dd/mm/yy',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 1,
			dayNamesShort: [ "Dim", "Lun", "Mar", "Mer", "Jeu", "Ven", "Sam" ],
			dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
			monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jun", "Jul", "Aou", "Sep", "Oct", "Nov", "Dec" ],
			monthNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
			monthNames: [ "Janvier", "Fevrier", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ],
			firstDay: 1,
			prevText: 'Précédent',
			nextText: 'Suivant',
			onClose: function( selectedDate ) 
			{
				$( "#date_debut_rou" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
	</script>
</body>
<!-- footer -->
<?php 
include'include/footer.php'; ?>
</html>