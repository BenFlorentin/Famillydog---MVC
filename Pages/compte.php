<?php
include'include/session.php';
include'include/connexion_bdd.php';

$u = $bdd->prepare('SELECT * FROM proprietaire WHERE ID = ?');

if(!isset($_POST['ID_user']))
{
	if(isset($_SESSION['MOD']))
	{
		if(isset($_SESSION['ID_USER_TEMP']))
		{
			$id = $_SESSION['ID_USER_TEMP'];
		}
	}
	else
	{
		$id = $_SESSION['user_id'];
		unset($_SESSION['MOD']);
	}
}
else
{
	$id = $_POST['ID_user'];
	$_SESSION['ID_USER_TEMP'] = $id;
}
unset($_SESSION['MOD']);


$u->execute(array($id));
$user = $u->fetch();

include'include/header.php';


?>

<body>
	<div class="container">
		 <h1 class="text-center"> <?php echo htmlentities(strtoupper($user['nom'])).' '. htmlentities(ucfirst($user['prenom'])); ?></h1>
		<fieldset>
			<?php 

			if($_SESSION['user_droit'] == 1)
			{
				echo'<a href="admin_comptes.php"> Prècedent</a><br/><br/>';
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
							<td><?php echo htmlentities($user['genre']) ?></td>
						</tr>
						<tr>
							<th>Nom</th>
							<td><?php echo htmlentities($user['nom']) ?></td>
						</tr>
						<tr>
							<th>Prénom</th>
							<td><?php echo htmlentities($user['prenom']) ?></td>
						</tr>
						<tr>
							<th>Date de naissance</th>
							<td><?php echo htmlentities(date('d/m/Y', strtotime($user['date_naissance']))) ?></td>
						</tr>
						<tr>
							<th>Tél</th>
							<td><?php echo htmlentities($user['tel']) ?></td>
						</tr>
						<tr>
							<th>Fix</th>
							<td><?php echo htmlentities($user['fix']) ?></td>
						</tr>
						<tr>
							<th>Fax</th>
							<td><?php echo htmlentities($user['fax']) ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="table-responsive">
					<table class="table table-striped table-condensed">
						<tr>
							<th>E-mail</th>
							<td><?php echo htmlentities($user['email']) ?></td>
						</tr>
						<tr>
							<th>Mot de passe</th>
							<td><?php echo htmlentities($user['mdp']) ?></td>
						</tr>
						<tr>
							<th>Collectivites </th>
							<td><?php echo htmlentities($user['collectivites']) ?></td>
						</tr>
						<tr>
							<th>Rue/Voie</th>
							<td><?php echo htmlentities($user['rue_voie']) ?></td>
						</tr>
						<tr>
							<th>Numéro de rue/voie</th>
							<td><?php echo htmlentities($user['num_rue_voie']) ?></td>
						</tr>
						<tr>
							<th>Ville</th>
							<td><?php echo htmlentities($user['ville']) ?></td>
						</tr>
						<tr>
							<th>Pays</th>
							<td><?php echo htmlentities($user['pays']) ?></td>
						</tr>
						<tr>
							<th>Code postal</th>
							<td><?php echo htmlentities($user['code_postal']) ?></td>
						</tr>
					</tr>
				</table>
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
	<div class="container">
		<div class="col-md-3">
			<div class="table-responsive">
				<table class="table-condensed">
					<tr>
						<th>
							<form method="post" action="compte_modifier.php" class="form-horizontal">
								<input type="hidden" value="<?php echo htmlentities($user['ID']);?>" name="ID_user"/>
								<input type="hidden" value="compte.php" name="compte.php"/>
								<?php 
								if(isset($_POST['admin']))
								{
									echo'<input type="hidden" value="admin" name="admin"/>';
								}

								?>
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
							</form>
						</th>
						<td>
							<form method="post" action="admin_compte_supprimer.php" class="form-horizontal">
								<input type="hidden" value="<?php echo htmlentities($user['ID']);?>" name="ID_user"/>
								<input type="hidden" value="user" name="user"/>
								<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Supprimer</button>
							</form>
						</td>
					</tr>
				</table>
			</div> 
		</div>
	</div>
</fieldset>
&nbsp;
&nbsp;
<div class="container">
	 <h1 class="text-center"><i class="fa fa-paw"></i> Mes animaux </h1>
	<fieldset>
		<?php 
		echo'<a href="animal_ajouter.php"><i class="fa fa-plus"></i> Ajouter un animal</a>';
		echo'<br/><br/>';
		$u->closeCursor();
		$u = $bdd->prepare('SELECT * FROM animal WHERE ID_proprietaire = ?');
		$u->execute(array($id));

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
						<td><?php echo htmlentities($animal['nom']) ?></td>
						<td><?php echo htmlentities($animal['type']) ?></td>
						<td><?php echo htmlentities(date('d/m/Y', strtotime($animal['date_naissance']))) ?></td>
						<td><?php echo htmlentities($animal['genre']) ?></td>
						<td><?php echo htmlentities($animal['vaccine']) ?></td>
						<td><?php echo htmlentities($animal['puce']) ?></td>
						<td><?php echo htmlentities($animal['race']) ?></td>
						<td><?php echo htmlentities($animal['complem_info']) ?></td>
						<td>
							<form method="post" action="animaux_modifier.php" class="form-horizontal">
								<input type="hidden" value="<?php echo htmlentities($animal['ID']);?>" name="ID_animal"/>
								<input type="hidden" value="compte.php" name="compte.php"/>
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
							</form>
						</td>
						<td>
							<form method="post" action="animal_supprimer.php" class="form-horizontal">
								<input type="hidden" value="<?php echo htmlentities($animal['ID']);?>" name="ID_animal"/>
								<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Supprimer</button>
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
&nbsp;
&nbsp;
<div class="container">
	 <h1 class="text-center"> Mes réservations </h1>
	<fieldset>
		<?php 
		echo'<a href="reserver.php"><i class="fa fa-plus"></i> Ajouter une réservation</a>';
		echo'<br/><br/>';
		$u->closeCursor();
		$u = $bdd->prepare('SELECT * FROM reservation WHERE ID_proprietaire = ?');
		$u->execute(array($id));

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
					</tr>

					<?php 

					$u = $bdd->prepare('SELECT * FROM reservation r
						WHERE r.ID_proprietaire = ?
						ORDER BY date_debut');
					$u->execute(array($id));

					while($reservation = $u->fetch())
					{
						$m = $bdd->prepare('SELECT nom FROM animal WHERE ID = ?');
						$m->execute(array($reservation['ID_animal']));
						while($lm = $m->fetch())
						{
							?>
							<tr>
								<td><?php echo htmlentities(date('d/m/Y', strtotime($reservation['date_debut']))) ?></td>
								<td><?php echo htmlentities(date('d/m/Y', strtotime($reservation['date_fin']))) ?></td>
								<td><?php echo htmlentities($lm['nom']) ?></td>
								<td><?php echo htmlentities($reservation['prix']).' €' ?></td>
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
										echo'<i class="fa fa-calendar-check-o"></i> Payée';
									}
									if($reservation['etat'] == 'T')
									{
										echo'<i class="fa fa-calendar-check-o"></i> Terminée';
									}
									?>
								</td>
								<td>
									<form method="post" action="reservation_infos.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation['ID']);?>" name="ID_reservation"/>
										<input type="hidden" value="compte.php" name="compte.php"/>
										<button type="submit" class="btn btn-info">Infos</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_animal_modifier.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation['ID']);?>" name="ID_reservation"/>
										<input type="hidden" value="<?php echo htmlentities($reservation['ID_animal']);?>" name="ID_animal"/>
										<input type="hidden" value="compte.php" name="compte.php"/>
										<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_supprimer.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation['ID']);?>" name="ID_reservation"/>
										<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Supprimer</button>
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
			}?>
		</fieldset>
	</div>
</body>

<!-- footer-->
<?php include'include/footer.php'; ?>

