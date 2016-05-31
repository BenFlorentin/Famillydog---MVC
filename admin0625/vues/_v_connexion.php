<?php 
// inclure les scipts et les css
include'include/css_script.html';
?>

<body>
	<div class="row" style="border-radius: 20px;background-color: white;opacity: 0.90; position: absolute;top: 25%;left: 10%;right: 10%;">
		<div class="col-xs-6 col-xs-offset-3 col-md-6 col-md-offset-3" >
			<fieldset>

				<h1 class="text-center"><i class="fa fa-sign-in"></i> Se connecter </h1>
				<form method="post" action="index.php?uc=gererConnexion&action=connexion" class="form-horizontal" 
				style="border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;margin-top: -10px;padding: 10px 5px 0px;border: 2px solid rgb(169, 226, 243);">
				<?php 

      			// inclure la gestion des erreurs
				require_once '../erreur/gestion_erreurs.php';
				require_once '../validation/gestion_validation.php';
				require_once '../include/unset.php';

				?>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label" name="email">E-mail*</label>
					<div class="col-sm-10">
						<input type="email" class="form-control" id="email" size="5" maxlength="50" placeholder="Email" name="email" required>
					</div>
				</div>
				<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label" name="mdp">Mot de passe*</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" id="mdp" size="5" maxlength="50" placeholder="Mot de passe" name="mdp" required>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Se souvenir de moi*
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-success"><i class="fa fa-sign-in"></i> Se connecter</button>
					</div>
				</div>
			</form>
		</div>
	</fieldset>
</div>
</body>