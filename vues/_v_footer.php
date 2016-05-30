<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="css/back_to_top.css" rel="stylesheet">
			</div>
		</div>
	</div>
</div>
<footer style="background-color: white">
	<div class="container">
				<div class="col-xs-offset-2 col-xs-4" style="margin-top: 20px;">
					<ul class="list-unstyled">
						<li><a href="index.php"><i class="fa fa-home"></i> Accueil</a></li>
						<li><a href="reserver.php"><i class="fa fa-calendar"></i> Réserver</a></li>
						<li><a href="tarifs.php"><i class="fa fa-eur"></i> Tarifs</a></li>
						<?php 
						if(isset($_SESSION['user_id']))
						{	?>
							<li><a href="compte.php"><i class="fa fa-user"></i> Mon compte</a></li>
						<?php 
						}
						?>
					</ul>
				</div>

				<div class="col-xs-6">
					<h3><i class="fa fa-envelope"></i> Contact</h3>
					<ul class="list-unstyled">
						<li><a href="contact.php"><i class="fa fa-envelope"></i> Nous contacter</a></li>
						<li><a href="https://www.facebook.com/Famillydog"><img src="img/logo_facebook.png">acebook</a></li>
					</ul>
				</div>
		</div>
	</footer>

	<!-- back to top -->
	<script>
	$(document).ready(function(){
		$('body').append('<div id="toTop" class="btn btn-info"><span class="fa fa-arrow-up"></span></div>');
		$(window).scroll(function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		}); 
		$('#toTop').click(function(){
			$("html, body").animate({ scrollTop: 0 }, 600);
			return false;
		});
	});
	</script>

