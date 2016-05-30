<?php

	include'include/session.php';
	session_destroy();
	setcookie('auth', '', time() - 3600, '/', 'localhost', true, true);
	header('Location:connexion.php');
?>