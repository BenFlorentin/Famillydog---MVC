<?php 
include'include/session.php';
include'include/connexion_bdd.php';

$u = $bdd->prepare('SELECT * FROM proprietaire WHERE ID = ?');

if($_SESSION['user_id'] == 2)
{
	$_SESSION['MOD'] = true;
}
else
{
	unset($_SESSION['MOD']);
}


if(isset($_POST['admin']))
{
	$u->execute(array($_POST['ID_user']));
}
else
{
	if(!isset($_POST['ID_user']))
	{
		$u->execute(array($_SESSION['user_id']));
	}
	else
	{
		$u->execute(array($_POST['ID_user']));
	}
}
$user = $u->fetch();
	
include'include/header.php';
 ?>

 <!-- DATEPICKER : sur chaque fichier où il y a un datepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<div class="container">
		<fieldset>
			 <h1 class="text-center"><?php echo strtoupper($user['nom']).' '. ucfirst($user['prenom']); ?></h1>
			<?php 
				if(isset($_POST['compte_php']))
				{
					echo'<a href="compte.php">Précèdent</a>';	
				}
				else
				{
					echo'<a href="compte_infos.php">Précèdent</a>';
				}
			 ?>
		&nbsp;
			<form method="post" action="compte_modifier_post.php" class="form-horizontal">
				<div class="col-md-6">
					<div class="form-group">
						<label for="genre" class="col-sm-2 control-label" >Genre</label>
						<div class="col-sm-10">
							<input type="radio" name="genre" id="M." value="M." <?php if($user['genre'] == 'M.') echo 'checked' ?>> M.
							<input type="radio" name="genre" id="Mme" value="Mme" <?php if($user['genre'] == 'Mme') echo 'checked' ?>> Mme
							<input type="radio" name="genre" id="Mlle" value="Mlle" <?php if($user['genre'] == 'Mlle') echo 'checked' ?>> Mlle
						</div>
					</div>
					<div class="form-group">
						<label for="nom" class="col-sm-2 control-label" name="nom">Nom</label>
						<div class="col-sm-10">
							<input type="nom" class="form-control" id="nom" placeholder="Nom" name="nom" value="<?php echo $user['nom']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="prenom" class="col-sm-2 control-label" name="prenom">Prénom</label>
						<div class="col-sm-10">
							<input type="prenom" class="form-control" id="prenom" placeholder="Prénom" name="prenom" value="<?php echo $user['prenom']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="date_naissance" class="col-sm-2 control-label" name="date_naissance">Date de naissance</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="datepicker" placeholder="ex :dd/mm/aaaa" name="date_naissance" value="<?php echo date('d/m/Y', strtotime($user['date_naissance']))?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="collectivites" class="col-sm-2 control-label" name="collectivites">Collectivites</label>
						<div class="col-sm-10">
							<input type="collectivites" class="form-control" id="collectivites" placeholder="Collectivités" name="collectivites" value="<?php echo $user['collectivites']?>">
						</div>
					</div>
					<div class="form-group">
						<label for="tel" class="col-sm-2 control-label" name="tel">Tél</label>
						<div class="col-sm-10">
							<input type="tel" class="form-control" id="tel"  size="10" placeholder="ex : 0123456789" name="tel" value="<?php echo $user['tel']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="fix" class="col-sm-2 control-label" name="fix">Fix</label>
						<div class="col-sm-10">
							<input type="fix" class="form-control" id="fix"  size="10" placeholder="ex : 0123456789" name="fix" value="<?php echo $user['fix']?>">
						</div>
					</div>
					<div class="form-group">
						<label for="fax" class="col-sm-2 control-label" name="fax">Fax</label>
						<div class="col-sm-10">
							<input type="fax" class="form-control" id="fax"  size="10" placeholder="ex : 0123456789" name="fax" value="<?php echo $user['fax']?>">
						</div>
					</div>
					<div class="form-group">
						<label for="complem_info" class="col-sm-2 control-label" name="complem_info">Complément d'information </label>
						<div class="col-sm-10">
							<textarea class="form-control"  rows="4" cols="50" name="complem_info" id="complem_info" maxlength="500"><?php echo $user['complem_info']?></textarea>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="email" class="col-sm-2 control-label" name="email">E-mail</label>
						<div class="col-sm-10">
							<input type="email" class="form-control" id="email"  size="10" placeholder="ex : 0123456789" name="email" value="<?php echo $user['email']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="mdp" class="col-sm-2 control-label" name="mdp">Mot de passe</label>
						<div class="col-sm-10">
							<input type="password" class="form-control" id="mdp"  placeholder="Mot de passe" name="mdp" value="<?php echo $user['mdp']?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="num_rue_voie" class="col-sm-2 control-label" name="num_rue_voie">Numéro de rue/voie</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="num_rue_voie"  placeholder="Numéro de rue_voie" name="num_rue_voie" value="<?php echo $user['num_rue_voie']?>"required>
						</div>
					</div>
					<div class="form-group">
						<label for="rue_voie" class="col-sm-2 control-label" name="rue_voie">Rue/voie</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="rue_voie"  placeholder="Rue/Voie/Route/Chemin/etc..." name="rue_voie" value="<?php echo $user['rue_voie']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="ville" class="col-sm-2 control-label" name="ville">Ville</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="ville"  placeholder="Ville" name="ville" value="<?php echo $user['ville']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="code_postal" class="col-sm-2 control-label" name="code_postal">Code postal</label>
						<div class="col-sm-10">
							<input type="int" class="form-control" id="code_postal"  max="5" placeholder="ex : 57000" name="code_postal" value="<?php echo $user['code_postal']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="pays" class="col-sm-2 control-label" name="pays">Pays</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="pays"  placeholder="ex : France" name="pays" value="<?php echo $user['pays']?>" required>
						</div>
					</div>
					<div class="form-group">
						<label for="complem_adr" class="col-sm-2 control-label" name="complem_adr">Complément d'adresse</label>
						<div class="col-sm-10">
							<textarea class="form-control" rows="4" cols="50" name="complem_adr" id="complem_adr" maxlength="500"><?php echo $user['complem_adr']?></textarea>
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
						<input type="hidden" value="<?php echo $user['ID'] ?>" name="ID">
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