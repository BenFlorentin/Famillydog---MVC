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

$u = $bdd->prepare('SELECT * FROM animal WHERE ID = ?');
$u->execute(array($_POST['ID_animal']));
$animal = $u->fetch();

include'include/header.php';
?>

<!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<div class="container">
	<fieldset>
		 <h1 class="text-center"><?php echo ucfirst($animal['nom']); ?></h1>
		<?php 
		if(isset($_POST['compte_php']))
		{
			echo'<a href="compte.php">Précèdent</a>';	
		}
		else
		{
			echo'<a href="animaux.php">Précèdent</a>';
		}
		?>
		&nbsp;
		<form method="post" action="animaux_modifier_post.php" class="form-horizontal">
			<div class="col-md-6">
				<div class="form-group">
					<label for="genre" class="col-sm-2 control-label" >Genre</label>
					<div class="col-sm-10">
						<input type="radio" name="genre" id="M" value="M" <?php if($animal['genre'] == 'M') echo 'checked' ?>> M
						<input type="radio" name="genre" id="F" value="F" <?php if($animal['genre'] == 'F') echo 'checked' ?>> F
					</div>
				</div>
				<div class="form-group">
					<label for="nom" class="col-sm-2 control-label" name="nom">Nom</label>
					<div class="col-sm-10">
						<input type="nom" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php echo $animal['nom']?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="type" class="col-sm-2 control-label" name="type">Type</label>
					<div class="col-sm-10">
						<select type="text" class="form-control" name="type" required>
							<option name="type" value="Chien" <?php if($animal['type'] == 'Chien') echo 'selected' ?>>Chien</option>
							<option name="type" value="Chat" <?php if($animal['type'] == 'Chat') echo 'selected' ?>>Chat</option>
							<option name="type" value="Rongeur" <?php if($animal['type'] == 'Rongeur') echo 'selected' ?>>Rongeur</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="race" class="col-sm-2 control-label" name="race">Race</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="race"  size="10" placeholder="ex : Berger Allemand" name="race" value="<?php echo $animal['race']?>">
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="datepicker" placeholder="ex :dd/mm/aaaa" name="date_naissance" value="<?php echo date('d/m/Y', strtotime($animal['date_naissance']))?>" required>
					</div>
				</div>
				<div class="form-group">
					<label for="vaccine" class="col-sm-2 control-label" >Vacciné(e)</label>
					<div class="col-sm-10">
						<input type="radio" name="vaccine" id="Oui" value="Oui" <?php if($animal['vaccine'] == 'Oui') echo 'checked' ?>> Oui
						<input type="radio" name="vaccine" id="Non" value="Non" <?php if($animal['vaccine'] == 'Non') echo 'checked' ?>> Non
					</div>
				</div>
				<div class="form-group">
					<label for="puce" class="col-sm-2 control-label" >Pucé(e)</label>
					<div class="col-sm-10">
						<input type="radio" name="puce" id="Oui" value="Oui" <?php if($animal['puce'] == 'Oui') echo 'checked' ?>> Oui
						<input type="radio" name="puce" id="Non" value="Non" <?php if($animal['puce'] == 'Non') echo 'checked' ?>> Non
					</div>
				</div>
				<div class="form-group">
					<label for="complem_info" class="col-sm-2 control-label" name="complem_info">Complément d'information </label>
					<div class="col-sm-10">
						<textarea class="form-control"  rows="4" cols="50" name="complem_info" id="complem_info" maxlength="500"><?php echo $animal['complem_info']?></textarea>
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
					<input type="hidden" value="<?php echo $animal['ID'] ?>" name="ID_animal">
					<button type="submit" class="btn btn-success">Modifier</button>
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
			firstDay: 1
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