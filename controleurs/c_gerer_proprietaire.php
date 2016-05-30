<?php
require_once 'include/_bll.lib.php';
require_once 'include/_reference.lib.php';


if(isset($_SESSION['ID_USER_TEMP']))
{
	$id = $_SESSION['ID_USER_TEMP'];
}
else
{
	$id = $_SESSION['user_id'];
}

//connecté ?
if(!isset($_SESSION['user_id'])) 
{

	$_SESSION['E_CONNEXION_REQUIS'] = true;
	include'vues/v_connexion.php';
}
else
{
	unset($_SESSION['E_CONNEXION_REQUIS']);
}


if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "connexion";
}

// diriger vers les bonnes vues
switch ($action) 
{
	case 'connexion' : 
	{ 
		include 'vues/v_connexion.php'; 
	}	break;

	case 'infos' : 
	{ 
		// appel de la méthode du modèle
		$leProprietaire = Proprietaires::chargerProprietaireParID($id);

		include 'vues/v_compte_infos.php'; 
	}	break;
}
?>