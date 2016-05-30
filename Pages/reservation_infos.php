<?php
include'include/session.php';
include'include/connexion_bdd.php';

if($_SESSION['user_id'] == 2)
{
	$_SESSION['MOD'] = true;
}
else
{
	unset($_SESSION['MOD']);
}

$u = $bdd->prepare('SELECT * FROM reservation r
	INNER JOIN animal a ON r.ID_proprietaire = a.ID_proprietaire
	WHERE r.ID = ?');
$u->execute(array($_POST['ID_reservation']));
$user = $u->fetch();


$dateDebut = explode('-', $user['date_debut']);
$DebutJourTeste = $dateDebut[2];
$DebutMoisTeste = $dateDebut[1];
$DebutAnneeTeste = $dateDebut[0];

include'include/header.php';
?>

<body>
	<div class="container">
		 <h1 class="text-center"><i class="fa fa-calendar"></i> Réservation </h1>
		<fieldset>
			<?php 
			include'erreur/gestion_erreurs.php';
      include'validation/gestion_validation.php';
      include'include/unset.php';

 		

			$oi = $bdd->query('SELECT YEAR(saison_debut) FROM tarifs');
			$oip = $oi->fetch();

			$u = $bdd->prepare("SELECT * FROM tarifs WHERE ? = ?");
			$u->execute(array($DebutAnneeTeste, $oip['0']));
			$tir = $u->fetch();
			
			$prixBla = $tir['prix_jour_bla'];
			$prixBle = $tir['prix_jour_ble'];
			$prixRou = $tir['prix_jour_rou'];

			?>

			<div class="col-md-4">
				<?php 
				if(isset($_POST['compte_php']))
				{
					echo'<a href="compte.php">Précèdent</a>';
					echo'<br/><br/>';
				}
				if(isset($_POST['admin']))
				{
					echo'<a href="admin_reservations.php">Précèdent</a>';
					echo'<br/><br/>';
				}
				?>
				<div class="table-responsive">
					<table class="table table-striped table-condensed">
						<tr>
							<th>Début</th>
							<td><?php echo date('d/m/Y', strtotime($user['date_debut'])) ?></td>
						</tr>
					</table>

					<table class="table table-striped table-condensed">
						<tr>
							<th>Jour(s) en période blanche</th>
							<td><?php echo $user['nb_jours_bla'] ?></td>
						</tr>
						<tr>
							<th>Prix/jour </th>
							<td><?php echo $prixBla.' €' ?></td>
						</tr>
					</table>

					<table class="table table-striped table-condensed">
						<tr>
							<th>Jour(s) en période rouge</th>
							<td><?php echo $user['nb_jours_rou'] ?></td>
						</tr>
						<tr>
							<th>Prix/jour </th>
							<td><?php echo $prixRou.' €' ?></td>
						</tr>
					</table>

					<table class="table table-striped table-condensed">
						<tr>
							<th>Jour(s) en période bleue</th>
							<td><?php echo $user['nb_jours_ble'] ?></td>
						</tr>
						<tr>
							<th>Prix/jour </th>
							<td><?php echo $prixBle.' €' ?></td>
						</tr>
					</table>

					<table class="table table-striped table-condensed">
						<tr>
							<th>Nombre de jour(s) total</th>
							<td><?php echo $user['nb_jours_tot'] ?></td>
						</tr>
						<tr>
							<th>Prix total</th>
							<td><?php echo $user['prix'].' €' ?></td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-4">
				<?php 
				if(isset($_POST['compte_php']))
				{
					echo'<br/><br/>';
				}
				if(isset($_POST['admin']))
				{
					echo'<br/><br/>';
				}
				?>
				<div class="table-responsive">
					<table class="table table-striped table-condensed">
						<tr>
							<th>Fin</th>
							<td><?php echo date('d/m/Y', strtotime($user['date_fin'])) ?></td>
						</tr>
					</table>


					&nbsp;

					<table class="table table-striped table-condensed">
						<tr>
							<th>Prix </th>
							<td><?php echo ($prixBla *  $user['nb_jours_bla']).' €' ?></td>
						</tr>
					</table>

					&nbsp;

					<table class="table table-striped table-condensed">
						<tr>
							<th>Prix </th>
							<td><?php echo ($prixRou *  $user['nb_jours_rou']).' €' ?></td>
						</tr>
					</table>

					&nbsp;

					<table class="table table-striped table-condensed">
						<tr>
							<th>Prix </th>
							<td><?php echo ($prixBle *  $user['nb_jours_ble']).' €' ?></td>
						</tr>
					</table>
				</div> 
			</div>
		</fieldset>
	</div>
</body>

<!-- footer-->
<?php include'include/footer.php'; ?>

