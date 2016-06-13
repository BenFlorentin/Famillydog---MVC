<div class="container">
	<fieldset>
		 <h1 class="text-center">Période : <?php echo date('d/m/Y', strtotime($leTarif->getDebutPeriode())).' - '.date('d/m/Y', strtotime($leTarif->getFinPeriode())) ?></h1>
		<a href="index.php?uc=gererTarifs">Précèdent</a>
		&nbsp;
		<form method="post" action="index.php?uc=gererTarifs&action=modifier&option=valider" class="form-horizontal">
			<div class="col-md-6">
				<div class="form-group">
					<label for="to" class="col-md-6 control-label" name="to">Prix/journée par chien (€)</label>
					<div class="col-md-6">
						<input type="int" class="form-control" name="prix_jour_chien" placeholder="ex: 5" value="<?php echo $leTarif->getTarifJourChien() ?>" required>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="to" class="col-md-6 control-label" name="to">Prix/journée par chat (€)</label>
					<div class="col-md-6">
						<input type="int" class="form-control" name="prix_jour_chat" placeholder="ex: 5" value="<?php echo $leTarif->getTarifJourChat() ?>" required>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<div class="checkbox">
						<label>
							<input type="checkbox" name="remember" required> J'accepte les termes du contrats...
						</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="hidden" value="<?php echo $leTarif->getID() ?>" name="ID_tarifs">
					<input type="hidden" name="debut_periode" value="<?php echo date('d/m/Y', strtotime($leTarif->getDebutPeriode()))?>">
					<input type="hidden" name="fin_periode" value="<?php echo date('d/m/Y', strtotime($leTarif->getFinPeriode()))?>">
					<button type="submit" class="btn btn-success">Modifier</button>
				</div>
			</div>
		</form>
	</fieldset>
</body>