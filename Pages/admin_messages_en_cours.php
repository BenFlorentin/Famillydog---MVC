<?php 
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';

?>

<div class="container">
	<h1 class="test-center"><i class="fa fa-envelope"></i> Messages -  En cours</h1>
	<fieldset>

		<a href="admin_messages.php">Messagerie</a>
		<br/><br/>

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

				$u = $bdd->prepare('SELECT * FROM messagerie
					WHERE etat = ?
					ORDER BY date_msg DESC');
				$u->execute(array('E'));

				while($message = $u->fetch())
				{
					?>
					<tr>
						<td><?php echo date('d/m/Y', strtotime($message['date_msg'])) ?></td>
						<td><?php echo strtoupper($message['nom']) ?></td>
						<td><?php echo ucfirst($message['prenom']) ?></td>
						<td><?php echo $message['email'] ?></td>
						<td><?php echo $message['sujet'] ?></td>
						<td><?php echo $message['tel'] ?></td>
						<td>En cours</td>
						<td>
							<form method="post" action="message_infos.php" class="form-horizontal">
								<input type="hidden" value="<?php echo $message['ID'];?>" name="ID"/>
								<input type="hidden" value="encours" name="en_cours"/>
								<button type="submit" class="btn btn-info">Regarder</button>
							</form>
						</td>
						<td>
							<form method="post" action="message_supprimer.php" class="form-horizontal">
								<input type="hidden" value="<?php echo $message['ID'];?>" name="ID"/>
								<button type="submit" class="btn btn-danger">Supprimer</button>
							</form>
						</td>
						<td>
							<div class="col-sm-9">
								<form method="post" action="admin_modifier_etat_message.php" class="form-horizontal">
									<input type="hidden" value="<?php echo $message['ID'];?>" name="ID"/>
									<select name="etat" class="form-control">
										<option name="etat" value="E" <?php if($message['etat'] == 'E') echo'selected'?>>En cours</option>
										<option name="etat" value="R" <?php if($message['etat'] == 'R') echo'selected'?>>Réglé</option>
										?>
									</select>
								</div>
								<input type="hidden" value="<?php echo $message['ID'];?>" name="ID"/>
								<button type="submit" class="btn btn-success">Ok</button>
							</form>
						</td>
					</tr>

					<?php
				}
				$u->closeCursor();
				?>
			</table>
		</div>
	</fieldset>
</div>
<?php 
include'include/footer.php';
?>