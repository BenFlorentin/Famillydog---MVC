<?php
include'include/session.php';
include'include/connexion_bdd.php';



$u = $bdd->prepare('SELECT * FROM reservation WHERE ID_proprietaire = ?');

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
		 <h1 class="text-center"><i class="fa fa-calendar"></i> Mes réservations </h1>
		<fieldset>
			<?php 
			echo'<a href="reserver.php">Ajouter une réservation</a><br/>';
			echo'<a href="compte.php">Mes infos</a>';
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
							<th>Début</th>
							<th>Fin</th>
							<th>Animal</th>
							<th>Prix</th>
							<th>Etat</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>

						<?php 

						$u = $bdd->prepare('SELECT * FROM reservation r
							WHERE r.ID_proprietaire = ?
							ORDER BY date_debut');
						
						if(!isset($_POST['ID_user']))
						{
							$u->execute(array($id));
						}
						else
						{
							$u->execute(array($_POST['ID_user']));
						}
						while($reservation = $u->fetch())
						{
							$m = $bdd->prepare('SELECT nom FROM animal WHERE ID = ?');
							$m->execute(array($reservation['ID_animal']));
							while($lm = $m->fetch())
							{
								?>
								<tr>
									<td><?php echo date('d/m/Y', strtotime($reservation['date_debut'])) ?></td>
									<td><?php echo date('d/m/Y', strtotime($reservation['date_fin'])) ?></td>
									<td><?php echo $lm['nom'] ?></td>
									<td><?php echo $reservation['prix'].' €' ?></td>
									<td>
										<?php
										if($reservation['etat'] == 'NP')
										{
											echo 'Non payée';
										}
										if($reservation['etat'] == 'E')
										{
											echo'En cours';
										}
										if($reservation['etat'] == 'P')
										{
											echo'Payée';
										}
										if($reservation['etat'] == 'T')
										{
											echo'Terminée';
										}
										?>
									</td>
									<td>
										<form method="post" action="reservation_infos.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
											<input type="hidden" value="compte.php" name="compte.php"/>
											<button type="submit" class="btn btn-info">Infos</button>
										</form>
									</td>
									<td>
										<form method="post" action="reservation_animal_modifier.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
											<input type="hidden" value="<?php echo $reservation['ID_animal'];?>" name="ID_animal"/>
											<input type="hidden" value="compte.php" name="compte.php"/>
											<button type="submit" class="btn btn-success">Modifier</button>
										</form>
									</td>
									<td>
										<form method="post" action="reservation_supprimer.php" class="form-horizontal">
											<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
											<button type="submit" class="btn btn-danger">Supprimer</button>
										</form>
									</td>
								</tr>

								<?php
							}
						}
						?>
					</table>
				</div>
				<?php }
				else
				{
					echo '<h3>Aucune réservation enregistrée !</h3>';
				}
				?>
			</fieldset>
		</div>
	</body>

	<!-- footer-->
	<?php include'include/footer.php'; ?>

