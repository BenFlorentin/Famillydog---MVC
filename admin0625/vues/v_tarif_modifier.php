<!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<div class="container">
	<fieldset>
		 <h1 class="text-center">Période : <?php echo date('d/m/Y', strtotime($leTarif->getDebutPeriode())).' - '.date('d/m/Y', strtotime($leTarif->getFinPeriode())) ?></h1>
		<a href="#">Précèdent</a>
		&nbsp;
		<form method="post" action="index.php?uc=gererTarifs&action=modifier&option=valider" class="form-horizontal">
			<div class="col-md-10">
				<div class="form-group">
					<label for="from" class="col-sm-2 control-label" name="from">Période</label>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="debut_periode" placeholder="ex :dd/mm/aaaa" name="debut_periode" value="<?php echo date('d/m/Y', strtotime($leTarif->getDebutPeriode()))?>" required>
					</div>
					<div class="col-sm-5">
						<input type="date" class="form-control" id="fin_periode" placeholder="ex :dd/mm/aaaa" name="fin_periode" value="<?php echo date('d/m/Y', strtotime($leTarif->getFinPeriode()))?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée par chien (€)</label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_chien" placeholder="ex: 5" value="<?php echo $leTarif->getTarifJourChien() ?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="to" class="col-sm-2 control-label" name="to">Prix/journée par chat (€)</label>
					<div class="col-sm-5">
						<input type="int" class="form-control" name="prix_jour_chat" placeholder="ex: 5" value="<?php echo $leTarif->getTarifJourChat() ?>" required>
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
					<input type="hidden" value="<?php echo $leTarif->getID() ?>" name="ID_tarifs">
					<button type="submit" class="btn btn-success">Modifier</button>
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