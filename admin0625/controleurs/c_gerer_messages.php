<?php
require_once 'include/_bll.lib.php';

if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "listeMessages";
}

if(isset($_SESSION['action']))
{
	$action = $_SESSION['action'];
}

unset($_SESSION['action']);

// diriger vers les bonnes vues
switch ($action) 
{
	// liste des messages
	case 'listeMessages' :
	{
		$lesMessages = Messages::chargerMessages(1);
		$msgEnCours = Messages::chargerMessagesParEtat('E');
		$msgRegles = Messages::chargerMessagesParEtat('R');

		include'vues/v_messages.php';
	};break;

	// liste des messages en cours
	case 'listeMessagesEnCours' :
	{
		$msgEnCours = Messages::chargerMessagesParEtat('E');

		include'vues/v_messages_en_cours.php';
	};break;

	// liste des messages reglés
	case 'listeMessagesRegles' :
	{
		$msgRegles = Messages::chargerMessagesParEtat('R');

		include'vues/v_messages_regles.php';
	};break;

	// regarder un message
	case 'regarder' : 
	{
		
		// on récupere l'id du message dans l'url
		$id = intval($_GET['id']);

		//charger l'administrateur
		$message = Messages::chargerMessageParID($id);

		include'vues/v_message_infos.php';
	};break;

	// modifier un message
	case 'modifier' : 
	{
		
		// on récupere l'id du message dans l'url
		$id = intval($_GET['id']);
		$etat = htmlentities($_POST['etat']);

		//charger l'administrateur
		$message = Messages::modifierMessage($id, $etat);

		$_SESSION['V_ETAT'] = true;

		$_SESSION['action'] = "listeMessages";
		include'c_gerer_messages.php';
	};break;		

	// supprimer un message
	case 'supprimer' : 
	{
		// récupère l'id du message à supprimer
		$id = intval($_GET['id']);

		// suppression du message
		$message = Messages::supprimerMessageParID($id);

		$_SESSION['V_SUPP_MESSAGE'] = true;

		header('Location: index.php?uc=gererMessages');
		exit();
	};break;
}
?>