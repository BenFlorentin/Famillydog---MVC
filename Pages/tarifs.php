<?php 
include'include/session.php';
include'include/connexion_bdd.php';	

if(!isset($_SESSION['user_id'])) 
{
	$_SESSION['E_CONNEXION_REQUIS'] = true;
	header('Location:connexion.php');
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}


$u = $bdd->query('SELECT * FROM tarifs');


include'include/header.php';
?>


	<div class="container">
		 <h1 class="text-center"><i class="fa fa-eur"></i> Les tarifs</h1>
		<fieldset>
			<?php 
			if($an = $u->fetch())
			{
				$u->closeCursor();
				?>
				<div class="table-responsive col-md-8 col-md-offset-2">
					<table class="table table-striped table-condensed">
						<?php 
						$u = $bdd->query('SELECT * FROM tarifs');
							while($tarifs = $u->fetch())
							{?>
								<tr>
									<th>Saison</th>
									<td><?php echo date('d/m/Y', strtotime($tarifs['saison_debut'])).' - '.date('d/m/Y', strtotime($tarifs['saison_fin']))?></td>
								</tr>
								<tr>
									<th>Période blanche</th>
									<td><?php echo date('d/m/Y', strtotime($tarifs['date_debut_bla'])).' - '.date('d/m/Y', strtotime($tarifs['date_fin_bla']))?></td>
								</tr>
								<tr>
									<th>Prix/journée blanche</th>
									<td><?php echo $tarifs['prix_jour_bla'].' €' ?></td>
								</tr>
								<tr>
									<th>Période rouge</th>
									<td><?php echo date('d/m/Y', strtotime($tarifs['date_debut_rou'])).' - '.date('d/m/Y', strtotime($tarifs['date_fin_rou']))?></td>
								</tr>
								<tr>
									<th>Prix/journée rouge</th>
									<td><?php echo $tarifs['prix_jour_rou'].' €' ?></td>
								</tr>
								<tr>
									<th>Période bleue</th>
									<td><?php echo date('d/m/Y', strtotime($tarifs['date_debut_ble'])).' - '.date('d/m/Y', strtotime($tarifs['date_fin_ble']))?></td>
								</tr>
								<tr>
									<th>Prix/journée bleue</th>
									<td><?php echo $tarifs['prix_jour_ble'].' €' ?></td>
								</tr>
								<?php
								if($_SESSION['user_droit'] == 2)
								{?>
									<tr>
										<td>
											<form method="post" action="admin_tarifs_modifier.php" class="form-horizontal">
												<input type="hidden" value="<?php echo $tarifs['ID'];?>" name="ID_tarifs"/>
												<button type="submit" class="btn btn-success">Modifier</button>
											</form>
										</td>
										<td>
											<form method="post" action="#" class="form-horizontal">
												<input type="hidden" value="<?php echo $tarifs['ID'];?>" name="ID_tarifs"/>
												<button type="submit" class="btn btn-danger">Supprimer</button>
											</form>
										</td>
									</tr>
									<?php
								}
								else
								{
									echo'<tr>
											<td><br/><br/></td>
										</tr>';
								}
							}
						 ?>
					</table>
				</div>
	<?php 	}
			else
			{
				echo '<h3>Aucun tarifs !</h3>';
			}
			?>
		</fieldset>
	</div>

<!-- footer-->
<?php include'include/footer.php'; ?>


