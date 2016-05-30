<?php
include'include/session.php';
include'include/connexion_bdd.php';


$u = $bdd->prepare('SELECT * FROM animal WHERE ID_proprietaire = ?');

if(isset($_SESSION['ID_USER_TEMP']))
{
	$id = $_SESSION['ID_USER_TEMP'];
}
else
{
	$id = $_SESSION['user_id'];
}
$u->execute(array($id));

include'include/header.php';
?>

<body>
	<div class="container">
		 <h1 class="text-center"><i class="fa fa-paw"></i> Mes animaux </h1>
		<fieldset>
			<?php 
			echo'<a href="animal_ajouter.php">Ajouter un animal</a><br/>';

			if($_SESSION['user_droit'] == 1)
			{
				echo'<a href="admin_comptes.php">Les comptes</a>';
			}
			echo'<br/><br/>';

			 include'erreur/gestion_erreurs.php';
      include'validation/gestion_validation.php';
      include'include/unset.php';

			if($an = $u->fetch())
			{
				$u->closeCursor();
				?>
				<div class="table-responsive ">
					<table class="table table-striped table-condensed">
						<tr>
							<th>Nom</th>
							<th>Type</th>
							<th>Date de naissance</th>
							<th>Genre</th>
							<th>Vacciné(e)</th>
							<th>Pucé(e)</th>
							<th>Race</th>
							<th>Complément d'informations</th>
							<th></th>
							<th></th>
						</tr>
						<?php 
						$u = $bdd->prepare('SELECT * FROM animal WHERE ID_proprietaire = ?');
						$u->execute(array($id));
						while($animal = $u->fetch())
							{?>
						<tr>
							<td><?php echo $animal['nom'] ?></td>
							<td><?php echo $animal['type'] ?></td>
							<td><?php echo date('d/m/Y', strtotime($animal['date_naissance'])) ?></td>
							<td><?php echo $animal['genre'] ?></td>
							<td><?php echo $animal['vaccine'] ?></td>
							<td><?php echo $animal['puce'] ?></td>
							<td><?php echo $animal['race'] ?></td>
							<td><?php echo $animal['complem_info'] ?></td>
							<td>
								<form method="post" action="animaux_modifier.php" class="form-horizontal">
									<input type="hidden" value="<?php echo $animal['ID'];?>" name="ID_animal"/>
									<button type="submit" class="btn btn-success">Modifier</button>
								</form>
							</td>
							<td>
								<form method="post" action="animal_supprimer.php" class="form-horizontal">
									<input type="hidden" value="<?php echo $animal['ID'];?>" name="ID_animal"/>
									<button type="submit" class="btn btn-danger">Supprimer</button>
								</form>
							</td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
			<?php }
			else
			{
				echo '<h3>Aucun animal enregistré !</h3>';
			}?>
		</fieldset>
	</div>
</body>

<!-- footer-->
<?php include'include/footer.php'; ?>

