<?php
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';


$u = $bdd->query('SELECT * FROM proprietaire');
?>

<body>
	<div class="container">
		 <h1 class="text-center"> Les comptes </h1>
		<fieldset>
			<a href="admin_compte_add.php"><i class="fa fa-user-plus"></i> Ajouter un compte</a><br/>
			<a href="admin_infos.php">Les infos</a>
			<br/><br/>
			 <?php 

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
									<th>Prénom</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
						<?php 
						$u = $bdd->query('SELECT * FROM proprietaire');

						
							while($user = $u->fetch())
							{?>
								<tr>
									<td><?php echo $user['nom'] ?></td>
									<td><?php echo $user['prenom'] ?></td>
									<td>
										<form method="post" action="compte.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $user['ID'];?>" name="ID_user"/>
											<input type="hidden" value="admin" name="admin"/>
											<button type="submit" class="btn btn-info">Infos</button>
										</form>
									</td>
									<td>
										<form method="post" action="compte_modifier.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $user['ID'];?>" name="ID_user"/>
											<input type="hidden" value="admin" name="admin"/>
											<button type="submit" class="btn btn-success">Modifier</button>
										</form>
									</td>
									<td>
										<form method="post" action="admin_compte_supprimer.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $user['ID'];?>" name="ID_user"/>
											<input type="hidden" value="admin" name="admin"/>
											<button type="submit" class="btn btn-danger"><i class="fa fa-user-times"></i> Supprimer</button>
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
		echo'<a href="#">Ajouter un compte</a>';
		echo'<br/><br/>';
		echo '<h3>Aucun compte enregistré ! !</h3>';
	}?>
		</fieldset>
	</div>
</body>

<!-- footer-->
<?php include'include/footer.php'; ?>

