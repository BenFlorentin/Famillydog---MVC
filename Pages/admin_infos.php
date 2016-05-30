<?php 

include'include/session.php';
include'include/connexion_bdd.php';
include'include/header.php';

?>
<body>
	<div class="container">
		 <h1 class="text-center"> Informations </h1>
		<fieldset>
			<ul class="list-unstyled list-inline">
				<li class="col-md-3 text-center	"><a href="admin_tarifs.php">Gerer les tarifs</a></li>
				<li class="col-md-3 col-md-offset-1 text-center	"><a href="admin_comptes.php">Gerer les comptes et les animaux</a></li>
				<li class="col-md-3 text-center col-md-offset-1	"><a href="admin_reservations.php"><i class="fa fa-calendar"></i> Gerer les réservations</a></li>
			</ul>
		</fieldset>
	</div>
</body>
<?php 
include'include/footer.php'; ?>