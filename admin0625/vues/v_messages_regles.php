<body>
	<div class="container">
		<?php 
		include'../erreur/gestion_erreurs.php';
		include'../validation/gestion_validation.php';
		include'../include/unset.php';
		?>

		<h1 class="text-center"><i class="fa fa-envelope"></i> Messages - reglés </h1>
		<fieldset>
			<div class="table-responsive ">
				<table class="table table-striped table-condensed">
					<tr>
						<th>Date</th>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Email</th>
						<th>Sujet</th>
						<th>Tel</th>
						<th>Etat</th>
						<th></th>
						<th></th>
						<th>Mettre à jour</th>
					</tr>
				<?php 
				foreach ($msgRegles as $message) 
				{
					?>
					<tr>
						<td><?php echo date('d/m/Y', strtotime($message->DateMsg)) ?></td>
						<td><?php echo strtoupper($message->Nom) ?></td>
						<td><?php echo ucfirst($message->Prenom) ?></td>
						<td><?php echo $message->Email ?></td>
						<td><?php echo $message->Sujet ?></td>
						<td><?php echo $message->Tel ?></td>
						<td>En cours</td>
						<td>
							<form method="post" action="index.php?uc=gererMessages&action=regarder&id= <?php echo $message->ID; ?>" class="form-horizontal">
								<!-- <input type="hidden" value="<?php echo $message->ID;?>" name="ID"/> -->
								<!-- <input type="hidden" value="encours" name="en_cours"/> -->
								<button type="submit" class="btn btn-info">Regarder</button>
							</form>
						</td>
						<td>
							<form method="post" action="index.php?uc=gererMessages&action=supprimer&id= <?php echo $message->ID; ?>" class="form-horizontal">
								<!-- <input type="hidden" value="<?php echo $message->ID;?>" name="ID"/> -->
								<button type="submit" class="btn btn-danger">Supprimer</button>
							</form>
						</td>
						<td>
							<div class="col-sm-9">
								<form method="post" action="index.php?uc=gererMessages&action=modifier&id=<?php echo $message->ID; ?>" class="form-horizontal">
									<!-- <input type="hidden" value="<?php echo $message->ID;?>" name="ID"/> -->
									<select name="etat" class="form-control">
										<option name="etat" value="E" <?php if($message->Etat == 'E') echo'selected'?>>En cours</option>
										<option name="etat" value="R" <?php if($message->Etat == 'R') echo'selected'?>>Réglé</option>
										?>
									</select>
								</div>
								<!-- <input type="hidden" value="<?php echo $message->ID;?>" name="ID"/> -->
								<button type="submit" class="btn btn-success">Ok</button>
							</form>
						</td>
					</tr>
				<?php
				}
				?>
				</table>
			</div>
		</fieldset>
	</div>
</body>

