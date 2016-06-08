<body>
	<div class="container">
		
		<?php 
		      include'../erreur/gestion_erreurs.php';
		      include'../validation/gestion_validation.php';
		      include'../include/unset.php';
		?>

		 <h1 class="text-center"><i class="fa fa-eur"></i> Les tarifs <i class="fa fa-eur"></i> </h1>
		<fieldset>
				
			<a href="#"><i class="fa fa-plus"></i> Ajouter des tarifs</a><br/>
			<a href="#">Les infos</a>
			<br/><br/>
				
			<?php
			if($lesTarifs)
			{
				?>
				<div class="table-responsive col-md-8 col-md-offset-2">
					<table class="table table-striped table-condensed">
						<?php 
						foreach ($lesTarifs as $tarif)
						{
							?>
							<tr>
								<th>Periode</th>
								<td><?php echo date('d/m/Y', strtotime($tarif->DebutPeriode)).' - '.date('d/m/Y', strtotime($tarif->FinPeriode))?></td>
							</tr>
							<tr>
								<th>Tarif par jour par chien</th>
								<td><?php echo $tarif->TarifJourChien.' €';?></td>
							</tr>
							<tr>
								<th>Tarif par jour par chat</th>
								<td><?php echo $tarif->TarifJourChat.' €';?></td>
							</tr>
							<tr>
								<td>
									<ul class="list-inline">
										<li>
											<form method="post" action="index.php?uc=gererTarifs&action=modifier&option=saisir&id=<?php echo $tarif->ID ?>" class="form-horizontal">
												<button type="submit" class="btn btn-success">Modifier</button>
											</form>
										</li>
										<li>
											<form method="post" action="index.php?uc=gererTarifs&action=supprimer&id=<?php echo $tarif->ID ?>" class="form-horizontal">
												<button type="submit" class="btn btn-danger">Supprimer</button>
											</form>
										</li>
									</ul>
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
			echo '<h3>Aucun tarifs !</h3>';
		}
		?>
		</fieldset>
	</div>
</body>


