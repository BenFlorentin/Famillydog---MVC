<?php
include'include/session.php';
include'include/connexion_bdd.php';

if(isset($_SESSION['ID_USER_TEMP']))
{
	$id = $_SESSION['ID_USER_TEMP'];
}
else
{
	$id = $_SESSION['user_id'];
}

$u = $bdd->prepare('SELECT * FROM proprietaire WHERE ID = ?');
$u->execute(array($id));
$user = $u->fetch();
include'include/header.php';

?>

<body>
	<div class="container">
		 <h1 class="text-center"> <?php echo strtoupper($user['nom']).' '. ucfirst($user['prenom']); ?></h1>
		<fieldset>
			<?php 
			if($_SESSION['user_droit'] == 1)
			{
				echo'<a href="admin_comptes.php"> Les comptes </a><br/><br/>';
			}
			
			 include'erreur/gestion_erreurs.php';
      include'validation/gestion_validation.php';
      include'include/unset.php';

      ?>

			<div class="col-md-6">
				<div class="table-responsive ">
					<table class="table table-striped table-condensed">
						<tr>
							<th>Genre</th>
							<td><?php echo $user['genre'] ?></td>
						</tr>
						<tr>
							<th>Nom</th>
							<td><?php echo $user['nom'] ?></td>
						</tr>
						<tr>
							<th>Prénom</th>
							<td><?php echo $user['prenom'] ?></td>
						</tr>
						<tr>
							<th>Date de naissance</th>
							<td><?php echo date('d/m/Y', strtotime($user['date_naissance'])) ?></td>
						</tr>
						<tr>
							<th>Tél</th>
							<td><?php echo $user['tel'] ?></td>
						</tr>
						<tr>
							<th>Fix</th>
							<td><?php echo $user['fix'] ?></td>
						</tr>
						<tr>
							<th>Fax</th>
							<td><?php echo $user['fax'] ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="table-responsive">
					<table class="table table-striped table-condensed">
						<tr>
							<th>E-mail</th>
							<td><?php echo $user['email'] ?></td>
						</tr>
						<tr>
							<th>Mot de passe</th>
							<td><?php echo $user['mdp'] ?></td>
						</tr>
						<tr>
							<th>Collectivites </th>
							<td><?php echo $user['collectivites'] ?></td>
						</tr>
						<tr>
							<th>Rue/Voie</th>
							<td><?php echo $user['rue_voie'] ?></td>
						</tr>
						<tr>
							<th>Numéro de rue/voie</th>
							<td><?php echo $user['num_rue_voie'] ?></td>
						</tr>
						<tr>
							<th>Ville</th>
							<td><?php echo $user['ville'] ?></td>
						</tr>
						<tr>
							<th>Pays</th>
							<td><?php echo $user['pays'] ?></td>
						</tr>
						<tr>
							<th>Code postal</th>
							<td><?php echo $user['code_postal'] ?></td>
						</tr>
					</table>
				</div> 
			</div>
		</div>
	</div>
	<div class="container">
		<div class="table-responsive ">
			<table class="table table-striped table-condensed">
				<tr>
					<th>Complément d'adresse</th>
					<td><?php echo '<textarea cols="100" rows="2" disabled="disabled">'.$user['complem_adr'].'</textarea>' ?></td>
				</tr>
				<tr>
					<th>Complément d'informations</th>
					<td><?php echo '<textarea cols="100" rows="2" disabled="disabled">'.$user['complem_info'].'</textarea>' ?></td>
				</tr>
			</table>
		</div> 
	</div>
</fieldset>
</body>

<!-- footer-->
<?php include'include/footer.php'; ?>

