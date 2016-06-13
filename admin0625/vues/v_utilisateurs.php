<body>
	<?php 

    	include'../erreur/gestion_erreurs.php';
      	include'../validation/gestion_validation.php';
      	include'../include/unset.php';
    
    ?>
	<div class="container">
		 <h1 class="text-center"> Les comptes </h1>
		<fieldset>
			
			<ul class="list-inline">
				<li><a href="index.php?uc=gererComptes&action=ajouter"><i class="fa fa-plus"></i> Ajouter un compte</a></li>
				<li><a href="index.php?uc=infos">Les infos</a></li>
			</ul>
			<br/><br/>

			<?php 
			if($lesUtilisateurs)
			{
				?>
				<div class="table-responsive ">
					<table class="table table-striped table-condensed">
								<tr>
									<th>Nom</th>
									<th>Prénom</th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
						<?php 
							foreach($lesUtilisateurs AS $user)
							{
								?>
								<tr>
									<td><?php echo $user->Nom ?></td>
									<td><?php echo $user->Prenom ?></td>
									<td>
										<form method="post" action="index.php?uc=gererComptes&action=info&id=<?php echo $user->ID; ?>" class="form-horizontal">
											<button type="submit" class="btn btn-info">Infos</button>
										</form>
									</td>
									<td>
										<form method="post" action="index.php?uc=gererComptes&action=modifier&id=<?php echo $user->ID; ?>" class="form-horizontal">
											<input type="hidden" value="<?php echo $user->ID;?>" name="ID_user"/>
											<input type="hidden" value="admin" name="admin"/>
											<button type="submit" class="btn btn-success">Modifier</button>
										</form>
									</td>
									<td>
										<form method="post" action="index.php?uc=gererComptes&action=supprimer&id=<?php echo $user->ID; ?>" class="form-horizontal">
											<button type="submit" class="btn btn-danger"><i class="fa fa-user-times"></i> Supprimer</button>
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
		echo'<a href="index.php?uc=gererComptes&action=ajouter">Ajouter un compte</a>';
		echo'<br/><br/>';
		echo '<h3>Aucun compte enregistré ! !</h3>';
	}?>
		</fieldset>
	</div>
</body>