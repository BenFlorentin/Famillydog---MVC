<?php 
/*$u = $bdd->prepare('SELECT * FROM proprietaire WHERE ID = ?');*/

/*if(!isset($_POST['ID_user']))
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
unset($_SESSION['MOD']);*/


/*$u->execute(array($id));
$user = $u->fetch();*/

?>

<body>
	<?php 
		include'../erreur/gestion_erreurs.php';
		include'../validation/gestion_validation.php';
		include'../include/unset.php';
	?>
	<div class="container">
		 <h1 class="text-center"> <?php echo htmlentities(strtoupper($user->getNom())).' '. htmlentities(ucfirst($user->getPrenom())); ?></h1>
		<fieldset>

			<a href="index.php?uc=gererComptes&action=listeUtilisateurs"> Prècedent</a><br/><br/>
			

			<div class="col-md-6">
				<div class="table-responsive ">
					<table class="table table-striped table-condensed">
						<tr>
							<th>Genre</th>
							<td><?php echo htmlentities($user->getGenre()) ?></td>
						</tr>
						<tr>
							<th>Nom</th>
							<td><?php echo htmlentities($user->getNom()) ?></td>
						</tr>
						<tr>
							<th>Prénom</th>
							<td><?php echo htmlentities($user->getPrenom()) ?></td>
						</tr>
						<tr>
							<th>Date de naissance</th>
							<td><?php echo htmlentities(date('d/m/Y', strtotime($user->getDateNaissance()))) ?></td>
						</tr>
						<tr>
							<th>Tél</th>
							<td><?php echo htmlentities($user->getTel()) ?></td>
						</tr>
						<tr>
							<th>Fix</th>
							<td><?php echo htmlentities($user->getFix()) ?></td>
						</tr>
						<tr>
							<th>Fax</th>
							<td><?php echo htmlentities($user->getFax()) ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<div class="table-responsive">
					<table class="table table-striped table-condensed">
						<tr>
							<th>E-mail</th>
							<td><?php echo htmlentities($user->getEmail()) ?></td>
						</tr>
						<tr>
							<th>Mot de passe</th>
							<td><?php echo htmlentities($user->getMdp()) ?></td>
						</tr>
						<tr>
							<th>Collectivites </th>
							<td><?php echo htmlentities($user->getCollectivites()) ?></td>
						</tr>
						<tr>
							<th>Rue/Voie</th>
							<td><?php echo htmlentities($user->getRueVoie()) ?></td>
						</tr>
						<tr>
							<th>Numéro de rue/voie</th>
							<td><?php echo htmlentities($user->getNumRueVoie()) ?></td>
						</tr>
						<tr>
							<th>Ville</th>
							<td><?php echo htmlentities($user->getVille()) ?></td>
						</tr>
						<tr>
							<th>Pays</th>
							<td><?php echo htmlentities($user->getPays()) ?></td>
						</tr>
						<tr>
							<th>Code postal</th>
							<td><?php echo htmlentities($user->getCodePostal()) ?></td>
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
					<td><?php echo '<textarea cols="100" rows="2" disabled="disabled">'.$user->getComplemAdr().'</textarea>' ?></td>
				</tr>
				<tr>
					<th>Complément d'informations</th>
					<td><?php echo '<textarea cols="100" rows="2" disabled="disabled">'.$user->getComplemInfo().'</textarea>' ?></td>
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
								<input type="hidden" value="<?php echo htmlentities($user->getID());?>" name="ID_user"/>
								<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
							</form>
						</th>
						<td>
							<form method="post" action="admin_compte_supprimer.php" class="form-horizontal">
								<input type="hidden" value="<?php echo htmlentities($user->getID());?>" name="ID_user"/>
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
		<a href="animal_ajouter.php"><i class="fa fa-plus"></i> Ajouter un animal</a>
		<br/><br/>

		<?php 

		if($animaux != -1)
		{
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

					foreach($animaux as $animal)
					{
						?>
						<tr>
							<td><?php echo htmlentities($animal->Nom) ?></td>
							<td><?php echo htmlentities($animal->Type) ?></td>
							<td><?php echo htmlentities($animal->Date_naissance) ?></td>
							<td><?php echo htmlentities($animal->Genre) ?></td>
							<td><?php echo htmlentities($animal->Vaccine) ?></td>
							<td><?php echo htmlentities($animal->Puce) ?></td>
							<td><?php echo htmlentities($animal->Race) ?></td>
							<td><?php echo htmlentities($animal->Complem_info) ?></td>
							<td>
								<form method="post" action="animaux_modifier.php" class="form-horizontal">
									<input type="hidden" value="<?php echo htmlentities($animal->ID);?>" name="ID_animal"/>
									<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
								</form>
							</td>
							<td>
								<form method="post" action="animal_supprimer.php" class="form-horizontal">
									<input type="hidden" value="<?php echo htmlentities($animal->ID);?>" name="ID_animal"/>
									<button type="submit" class="btn btn-danger"><i class="fa fa-times"></i> Supprimer</button>
								</form>
							</td>
						</tr>
					<?php
					}
					?>
				</table>
			</div>
		<?php 
		}
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
		<a href="reserver.php"><i class="fa fa-plus"></i> Ajouter une réservation</a>
		<br/><br/>
		
		<?php 
		
		if($reservations != -1)
		{
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


					foreach($reservations as $reservation)
					{

						/*
						$m = $bdd->prepare('SELECT nom FROM animal WHERE ID = ?');
						$m->execute(array($reservation['ID_animal']));*/
						foreach($animaux as $animal)
						{
							?>
							<tr>
								<td><?php echo htmlentities($reservation->Date_debut) ?></td>
								<td><?php echo htmlentities($reservation->Date_fin) ?></td>
								<td><?php echo htmlentities($animal->Nom) ?></td>
								<td><?php echo htmlentities($reservation->Prix).' €' ?></td>
								<td>
									<?php
									if($reservation->Etat == 'NP')
									{
										echo 'Non payée';
									}
									if($reservation->Etat == 'E')
									{
										echo'En cours';
									}
									if($reservation->Etat == 'P')
									{
										echo'<i class="fa fa-calendar-check-o"></i> Payée';
									}
									if($reservation->Etat == 'T')
									{
										echo'<i class="fa fa-calendar-check-o"></i> Terminée';
									}
									?>
								</td>
								<td>
									<form method="post" action="reservation_infos.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation->ID);?>" name="ID_reservation"/>
										<button type="submit" class="btn btn-info">Infos</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_animal_modifier.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation->ID);?>" name="ID_reservation"/>
										<input type="hidden" value="<?php echo htmlentities($reservation->ID_animal);?>" name="ID_animal"/>
										<button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Modifier</button>
									</form>
								</td>
								<td>
									<form method="post" action="reservation_supprimer.php" class="form-horizontal">
										<input type="hidden" value="<?php echo htmlentities($reservation->ID);?>" name="ID_reservation"/>
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