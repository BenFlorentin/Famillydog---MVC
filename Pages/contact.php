<?php 
include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';

?>

<body>
	<div class="row" style="border-radius: 20px;background-color: white;opacity: 0.90;">
		<div class="col-xs-12 col-md-10">
			<h1 class="text-center"><i class="fa fa-envelope"></i> Contact</h1>
			<?php 
			include'erreur/gestion_erreurs.php';
			include'validation/gestion_validation.php';
			include'include/unset.php';


			?>
			<div class="row">
				<div class="col-xs-12 col-md-6" >
					<h2 class="text-center"><i class="fa fa-envelope"></i> Nous contacter</h2>
					<form method="post" action="contact_form.php" class="form-horizontal">
						<div class="form-group" style="margin-left:0;">
							<label for="nom" class="control-label" >Nom*</label> 
							<input type="text" class="form-control" name="nom" id="nom" size="20" maxlength="50" placeholder="Nom" tabindex="10" required/>
						</div>
						<div class="form-group" style="margin-left:0;">
							<label for="prenom" class="control-label" >Prénom*</label> 
							<input type="text" class="form-control" name="prenom" id="prenom" size="20" maxlength="50" placeholder="Prénom" tabindex="10" required/>
						</div>
						<div class="form-group" style="margin-left:0;">
							<label name="email" for="mail">E-mail*</label>
							<input class="form-control" type="email" name="email" id="email" size="20" placeholder="Email" maxlength="50" tabindex="10" required/>
						</div>
						<div class="form-group" style="margin-left:0;">
							<label name="tel" for="mail">Tél*</label>
							<input class="form-control" type="int" name="tel" id="tel" size="10" placeholder="Téléphone" maxlength="10" tabindex="10" required/>
						</div>
						<div class="form-group" style="margin-left:0;">
							<label for="sujet" class="control-label">Sujet de la requête*</label>
							<select name="sujet" class="form-control" tabindex="30">
								<option value="proposition">Demande / Proposition</option>
								<option value="amelioration">Amélioration, changement du site/blog</option>
								<option value="signalement">Signaler une erreur, ou un contenu inapproprié</option>
								<option value="autre" selected="selected">Autre raison...</option>
							</select> 
						</div>
						<div class="form-group" style="margin-left:0;">
							<label class="control-label"for="message" name="message">Contenu de votre requête*</label><br />
							<textarea class="form-control" name="message" id="message" tabindex="50" required></textarea>  
						</div>
						<div class="form-group" style="margin-left:0;">
							<button type="submit" class="btn btn-success">Envoyer</button>
						</div>
					</form>
				</div>
				<div class="col-xs-12 col-md-6">
					<h2 class="text-center"><i class="fa fa-map-marker"></i> Carte</h2>
					<iframe class="col-xs-12 col-md-12"src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2601.91403952828!2d6.163263315556036!3d49.296971477679286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47952430a58aeabd%3A0x56267824ba0e4ace!2sFamillydog!5e0!3m2!1sfr!2sus!4v1452244220779" width="620" height="520" frameborder="0" style="border-radius:20px;" allowfullscreen></iframe>
				</div>
			</div>
				<!-- <br/>
				<br/>
				<br/>
				<br/> -->
				<div class="row">
					<div class="col-md-2">
						<address>
							<strong>Disponibilités</strong><br>
							7j/7<br>
							24h/24<br>
						</address>
					</div>
					<div class="col-md-4">
						<address>
							<strong>Famillydog</strong><br>
							14 route Nationale le Marabout<br>
							Richemont, FR 57270<br>
							<i class="fa fa-phone"></i> <abbr title="Phone">Tél:</abbr> (123) 456-7890 <br>
							<a href="mailto:#">famillydog@gmail.com</a>
						</address>
					</div>
					<div>
						<img src="">Image de la maison</img>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php 
	include'include/footer.php';
	?>
