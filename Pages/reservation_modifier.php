<?php 
include'include/session.php';
include'include/connexion_bdd.php';

if($_SESSION['user_id'] == 2)
{
	$_SESSION['MOD'] = true;
}
else
{
	unset($_SESSION['MOD']);
}

if(!isset($_SESSION['user_id'])) 
{
	$_SESSION['E_CONNEXION_REQUIS'] = true;
	header('Location:connexion.php');
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}

$u = $bdd->prepare('SELECT * FROM reservation WHERE ID = ?');

/*if(!isset($_POST['ID_user']))
{
	$u->execute(array($_SESSION['user_id']));
}
else
{*/
	$u->execute(array($_SESSION['ID_reservation']));
//}

	$user = $u->fetch();

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


				if($_SESSION['user_droit'] == 1)
				{
					echo'<a href="admin_reservations.php">Précèdent</a>';	
					
				}
				else
				{
					echo'<a href="compte.php">Précèdent</a>';	
				}

				?>

				<h1 class="text-center"><i class="fa fa-calendar"></i> Réservation</h1>

				<h2 class="text-center"> Dates </h2>
				<form method="post" action="reservation_modifier_post.php" class="form-horizontal">
					<div class="col-md-6">
						<div class="form-group">
							<label for="from" class="col-sm-2 control-label" name="from">Début </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="from" placeholder="ex :dd/mm/aaaa" name="from" value="<?php echo date('d/m/Y', strtotime($user['date_debut']))?>"required>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="to" class="col-sm-2 control-label" name="to">Fin </label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="to" placeholder="ex :dd/mm/aaaa" name="to" value="<?php echo date('d/m/Y', strtotime($user['date_fin']))?>" required>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-1 col-sm-10">
							<button type="submit" class="btn btn-success"> Suite</button>
						</div>
					</div>
				</form>
			</fieldset>
		</div>

		<!-- Script datepicker -->
		<script>
		$(function() {
			$( "#from" ).datepicker({
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
				minDate: 0,
				onClose: function( selectedDate ) {
					$( "#to" ).datepicker( "option", "minDate", selectedDate );
				}
			});
			$( "#to" ).datepicker({
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
					$( "#from" ).datepicker( "option", "maxDate", selectedDate );
				}
			});
		});
</script>
</body>
<!-- footer -->
<?php 
include'include/footer.php'; ?>
</html>




