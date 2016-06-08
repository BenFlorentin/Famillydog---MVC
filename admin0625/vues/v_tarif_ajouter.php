<?php 

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
		<?php 

		include'../erreur/gestion_erreurs.php';
		include'../validation/gestion_validation.php';
		include'../include/unset.php';

		?>
		<h1 class="text-center"><i class="fa fa-eur"></i> Nouveau tarif <i class="fa fa-eur"></i></h1> 
		<a href="index.php?uc=gererTarifs"><i class="fa fa-reply"></i> Précèdent</a>

		<br/><br/>

		<form method="post" action="index.php?uc=gererTarifs&action=ajouter&option=valider" class="form-horizontal">
			<div class="col-md-10">
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Période</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="debut_periode" placeholder="ex :dd/mm/aaaa" name="debut_periode" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="fin_periode" placeholder="ex :dd/mm/aaaa" name="fin_periode" required>
					</div>
				</div>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée par chien (€)</label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_chien" placeholder="ex: 5" required>
					</div>
				</div>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée par chat (€)</label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_chat" placeholder="ex: 5" required>
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
					<button type="submit" class="btn btn-success">Ajouter</button>
				</div>
			</div>
		</form>
	</fieldset>

	<!-- Script datepicker -->
	<script>
	$(function() {
		$( "#debut_periode" ).datepicker({
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
			onClose: function( selectedDate ) {
				$( "#fin_periode" ).datepicker( "option", "minDate", selectedDate );
			}
		});
		$( "#fin_periode" ).datepicker({
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
			onClose: function( selectedDate ) {
				$( "#debut_periode" ).datepicker( "option", "maxDate", selectedDate );
			}
		});
	});
</script>
</body>
