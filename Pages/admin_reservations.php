<?php
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';



$u = $bdd->query('SELECT * FROM reservation');
?>

<body>
	<div class="container">
		 <h1 class="text-center"><i class="fa fa-calendar"></i> Les réservations </h1>
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

			
			// afficher les réservations non payées
			?>
			<h3 class="text-left" style="color:red">Non payées</h3>
			<?php 


			$u = $bdd->prepare('SELECT * FROM reservation
				WHERE etat = ?
				ORDER BY date_debut');
			$u->execute(array('NP'));

			if($an = $u->fetch())
			{
				$u->closeCursor();

				?>
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
							<th>Mettre à jour</th>
						</tr>

						<?php 

						$u = $bdd->prepare('SELECT * FROM reservation
							WHERE etat = ?
							ORDER BY date_debut');
						$u->execute(array('NP'));

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
										<td>
											<div class="col-sm-9">
												<form method="post" action="admin_modifier_etat_reservation.php" class="form-horizontal">
													<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
													<input type="hidden" value="admin" name="admin"/>
													<select name="etat" class="form-control">
														<option name="etat" value="E" <?php if($reservation['etat'] == 'E') echo'selected'?>>En cours</option>
														<option name="etat" value="P" <?php if($reservation['etat'] == 'P') echo'selected'?>>Payée</option>
														<option name="etat" value="NP" <?php if($reservation['etat'] == 'NP') echo'selected'?>>Non payée</option>
														<option name="etat" value="T" <?php if($reservation['etat'] == 'T') echo'selected'?>>Terminée</option>
														?>
													</select>
												</div>
												<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
												<input type="hidden" value="admin" name="admin"/>
												<button type="submit" class="btn btn-success">Ok</button>
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
				<?php
			}
			else
			{
				echo'<h4>Toutes les réservations sont payées !</h4>';
				echo'<br/><br/>';
			}


				// afficher les réservations payées
			echo'<h3 class="text-left" style="color:green">Payées</h3>';


			$u = $bdd->prepare('SELECT * FROM reservation
				WHERE etat = ?
				ORDER BY date_debut');
			$u->execute(array('P'));

			if($an = $u->fetch())
			{
				$u->closeCursor();

				
				?>

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
							<th>Mettre à jour</th>
						</tr>

						<?php 

						$u = $bdd->prepare('SELECT * FROM reservation
							WHERE etat = ?
							ORDER BY date_debut');
						$u->execute(array('P'));

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
										<td>
											<div class="col-sm-9">
												<form method="post" action="admin_modifier_etat_reservation.php" class="form-horizontal">
													<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
													<input type="hidden" value="admin" name="admin"/>
													<select name="etat" class="form-control">
														<option name="etat" value="E" <?php if($reservation['etat'] == 'E') echo'selected'?>>En cours</option>
														<option name="etat" value="P" <?php if($reservation['etat'] == 'P') echo'selected'?>>Payée</option>
														<option name="etat" value="NP" <?php if($reservation['etat'] == 'NP') echo'selected'?>>Non payée</option>
														<option name="etat" value="T" <?php if($reservation['etat'] == 'T') echo'selected'?>>Terminée</option>
														?>
													</select>
												</div>
												<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
												<input type="hidden" value="admin" name="admin"/>
												<button type="submit" class="btn btn-success">Ok</button>
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
				<?php
			}
			else
			{
				echo'<h4>Aucune réservation n\'est payée !</h4>';
				echo'<br/><br/>';
			}


				// afficher les réservations en cours
			echo'<h3 class="text-left" style="color:blue">En cours</h3>';

			$u = $bdd->prepare('SELECT * FROM reservation
				WHERE etat = ?
				ORDER BY date_debut');
			$u->execute(array('E'));


			if($an = $u->fetch())
			{
				$u->closeCursor();

				?>
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
							<th>Mettre à jour</th>
						</tr>

						<?php 

						$u = $bdd->prepare('SELECT * FROM reservation
							WHERE etat = ?
							ORDER BY date_debut');
						$u->execute(array('E'));

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
										<td>
											<div class="col-sm-9">
												<form method="post" action="admin_modifier_etat_reservation.php" class="form-horizontal">
													<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
													<input type="hidden" value="admin" name="admin"/>
													<select name="etat" class="form-control">
														<option name="etat" value="E" <?php if($reservation['etat'] == 'E') echo'selected'?>>En cours</option>
														<option name="etat" value="P" <?php if($reservation['etat'] == 'P') echo'selected'?>>Payée</option>
														<option name="etat" value="NP" <?php if($reservation['etat'] == 'NP') echo'selected'?>>Non payée</option>
														<option name="etat" value="T" <?php if($reservation['etat'] == 'T') echo'selected'?>>Terminée</option>
														?>
													</select>
												</div>
												<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
												<input type="hidden" value="admin" name="admin"/>
												<button type="submit" class="btn btn-success">Ok</button>
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
				<?php
			}
			else
			{
				echo'<h4>Aucune réservation n\'est en cours !</h4>';
				echo'<br/><br/>';
			}


				// afficher les réservations terminées
			echo'<h3 class="text-left" style="color:Purple">Terminées</h3>';
			$u = $bdd->prepare('SELECT * FROM reservation
				WHERE etat = ?
				ORDER BY date_debut');
			$u->execute(array('T'));

			if($an = $u->fetch())
			{
				$u->closeCursor();

				?>
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
							<th>Mettre à jour</th>
						</tr>

						<?php 

						$u = $bdd->prepare('SELECT * FROM reservation
							WHERE etat = ?
							ORDER BY date_debut');
						$u->execute(array('T'));

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
										<td>
											<div class="col-sm-9">
												<form method="post" action="admin_modifier_etat_reservation.php" class="form-horizontal">
													<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
													<input type="hidden" value="admin" name="admin"/>
													<select name="etat" class="form-control">
														<option name="etat" value="E" <?php if($reservation['etat'] == 'E') echo'selected'?>>En cours</option>
														<option name="etat" value="P" <?php if($reservation['etat'] == 'P') echo'selected'?>>Payée</option>
														<option name="etat" value="NP" <?php if($reservation['etat'] == 'NP') echo'selected'?>>Non payée</option>
														<option name="etat" value="T" <?php if($reservation['etat'] == 'T') echo'selected'?>>Terminée</option>
														?>
													</select>
												</div>
												<input type="hidden" value="<?php echo $reservation['ID'];?>" name="ID_reservation"/>
												<input type="hidden" value="admin" name="admin"/>
												<button type="submit" class="btn btn-success">Ok</button>
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
				<?php
			}
			else
			{
				echo'<h4>Aucune réservation n\'a été effectuée !</h4>';
				echo'<br/><br/>';
			}
		}
		else
		{
			echo '<h3>Aucune réservation enregistrée !</h3>';
			echo'<br/><br/>';
		}
		?>
	</fieldset>
</div>
</body>
<!-- footer-->
<?php include'include/footer.php'; ?>

