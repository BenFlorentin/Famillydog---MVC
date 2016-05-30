<?php 
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';

?>

<div class="container">
	<h1 class="test-center"><i class="fa fa-calendar"></i> Réservations -  En cours</h1>
	<fieldset>
		<div class="table-responsive ">
			<table class="table table-striped table-condensed">
				<tr>
					<th>Début</th>
					<th>Fin</th>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Animal</th>
					<th>Prix</th>
					<th>Etat</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>

				<?php 

				$u = $bdd->prepare('SELECT * FROM reservation
					WHERE etat = ?
					AND ID_proprietaire = ?
					ORDER BY date_debut');
				$u->execute(array('E', $_SESSION['user_id']));

				while($reservation = $u->fetch())
				{
					$m = $bdd->prepare('SELECT nom FROM animal WHERE ID = ?');
					$m->execute(array($reservation['ID_animal']));
					while($lm = $m->fetch())
					{
						$y = $bdd->prepare('SELECT nom, prenom FROM proprietaire WHERE ID = ?');
						$y->execute(array($reservation['ID_proprietaire']));
						while($ly = $y->fetch())
						{
							?>
							<tr>
								<td><?php echo date('d/m/Y', strtotime($reservation['date_debut'])) ?></td>
								<td><?php echo date('d/m/Y', strtotime($reservation['date_fin'])) ?></td>
								<td><?php echo strtoupper($ly['nom']) ?></td>
								<td><?php echo ucfirst($ly['prenom']) ?></td>
								<td><?php echo $lm['nom'] ?></td>
								<td><?php echo $reservation['prix'].' €' ?></td>
								<td>En cours</td>
								<td>
									<form method="post" action="reservation_infos.php" class="form-horizontal">
										<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
										<input type="hidden" value="admin" name="admin"/>
										<button type="submit" class="btn btn-info">Infos</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_animal_modifier.php" class="form-horizontal">
										<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
										<input type="hidden" value="<?php echo $reservation['ID_animal'];?>" name="ID_animal"/>
										<input type="hidden" value="<?php echo $reservation['ID_proprietaire'];?>" name="ID_proprietaire"/>
										<input type="hidden" value="admin" name="admin"/>
										<button type="submit" class="btn btn-success">Modifier</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_supprimer.php" class="form-horizontal">
										<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
										<input type="hidden" value="admin" name="admin"/>
										<button type="submit" class="btn btn-danger">Supprimer</button>
									</form>
								</td>
							</tr>

							<?php
						}
					}
				}
				?>
			</table>
		</div>
	</fieldset>
</div>
<?php 
include'include/footer.php';
 ?>