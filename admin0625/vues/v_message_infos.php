<!-- $u = $bdd->prepare('SELECT * FROM messagerie WHERE ID = ?');
$u->execute(array($_POST['ID']));
$message = $u->fetch(); -->

<body>
	<div class="container">
		 <h1 class="text-center"><i class="fa fa-envelope"></i> Message </h1>
		<fieldset>
			<?php 

			include'../erreur/gestion_erreurs.php';
			include'../validation/gestion_validation.php';
			include'../include/unset.php';

			?>

			<?php

			if(isset($_POST['en_cours']))
			{
				echo'<a href="admin_messages_en_cours.php">Précèdent</a>';
			}
			else if(isset($_POST['regle']))
			{
				echo'<a href="admin_messages_regles.php">Précèdent</a>';
			}
			else
			{
				echo'<a href="index.php?uc=gererMessages">Précèdent</a>';
			}
			echo'<br/><br/>';
			?>

			<div class="table-responsive">
				<table class="table table-striped table-condensed">
					<tr>
						<th>Date</th>
						<td><?php echo date('d/m/Y', strtotime($message[0]->DateMsg)) ?></td>
					</tr>
					<tr>
						<th>Nom</th>
						<td><?php echo $message[0]->Nom ?></td>
					</tr>
					<tr>
						<th>Prénom</th>
						<td><?php echo $message[0]->Prenom ?></td>
					</tr>
					<tr>
						<th>E-mail</th>
						<td><?php echo $message[0]->Email ?></td>
					</tr>
					<tr>
						<th>Sujet</th>
						<td><?php echo $message[0]->Sujet ?></td>
					</tr>
					<tr>
						<th>Message</th>
						<td><?php echo $message[0]->Message ?></td>
					</tr>
				</table>
			</div>
		</fieldset>
	</div>
</body>
