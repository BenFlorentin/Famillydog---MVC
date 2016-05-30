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


var_dump($id);
var_dump($action);
die;
// diriger vers les bonnes vues
switch ($action) 
{
	case 'connexion' : 
	{ 
		include 'vues/v_connexion.php'; 
	}	break;

	case 'reserver' : 
	{ 
        // appel de la méthode du modèle
		$lesProprietaires = Proprietaires::chargerProprietaires($id);
		$leProprietaire = Proprietaires::chargerProprietaireParNomEtPrenom($nom, $prenom);
		$lesAnimaux = Animaux::chargerAnimalParIDProprietaire($id);
		
		include 'vues/v_reserver.php'; 
	}	break;


	case 'ajouterNegociant' : {
		 // initialisation des variables
		$strNom = '';
		$strAdresse = '';
        // variables pour la gestion des erreurs
		$tabErreurs = array(); 
		$hasErrors = false;
		$ajoutOK = false;
		$msg = '';
        // traitement de l'option : saisie ou validation ?
		if(isset($_GET["option"]))
		{
			$option = htmlentities($_GET["option"]);
		}
		else
		{
			$option = 'saisirNegociant';
		}
		switch($option)
		{
			case 'saisirNegociant' : {
				include'vues/v_ajouter_negociant.php';
			};break;
			case 'validerNegociant' : {
				$values = array();
        		// tests de gestion du formulaire
				if (isset($_POST["cmdFonction"])) 
				{
            		// test zones obligatoires
					if (!empty($_POST["txtNom"])) 
					{
                		// récupération des valeurs saisies
						$values[0] = htmlentities($_POST["txtNom"]);
						$ajoutOK = true;
					}
					else 
					{
						$tabErreurs["txtNom"] = "Le nom doit être renseigné !";
						$hasErrors = true;
					}
					if (!empty($_POST["txtAdresse"])) {
						$values[1] = htmlentities($_POST["txtAdresse"]);
					}
					else
					{
						$values[1] = NULL;
					}
				}
				if($ajoutOK)
				{
					//appel de la méthode d'ajout
					$leNegociant = Negociants::ajouterNegociant($values);
					$msg = '<span class="info">Le négociant à été ajouté !</span>';
					include'vues/v_recap_ajout_negociant.php';
				}
				else
				{
					//Afficher les erreurs et on refait la saisie 
					$msg = '<span class="erreur">Des erreurs sont apparues lors de la saisie : </span>';
					include'vues/v_ajouter_negociant.php';
				}
			};break;

		}
	}break;
	case 'modifierNegociant' : {
		// récup de l'id dans l'url
		$intNoNegociant = intval($_GET['id']);
           // appel de la méthode du modèle
		$leNegociant = Negociants::chargerNegociantsParID($intNoNegociant);
		if($leNegociant == NULL )
		{
			$msg = '<br /><span class="erreur">Ce négociant n\'existe pas !</span>';
			include'vues/v_modifier_negociant.php';
		}
		else
		{
			$msg = '';

        // variables pour la gestion des erreurs
			$tabErreurs = array(); 
			$hasErrors = false;
			$ajoutOK = false;

        // traitement de l'option : saisie ou validation ?
			if(isset($_GET["option"]))
			{
				$option = htmlentities($_GET["option"]);
			}
			else
			{
				$option = 'saisirNegociant';
			}
			switch($option)
			{	
				case 'saisirNegociant' : {
					include'vues/v_modifier_negociant.php';
				};break;
				case 'validerNegociant' : {
        		// tests de gestion du formulaire
					if (isset($_POST["cmdFonction"])) 
					{
            		// test zones obligatoires
						if (!empty($_POST["txtNom"])) 
						{
                		// récupération des valeurs saisies
							$leNegociant->setNom(htmlentities($_POST["txtNom"]));
							$ajoutOK = true;
						}
						else 
						{
							$tabErreurs["txtNom"] = "Le nom doit être renseigné !";
							$hasErrors = true;
						}
						if (!empty($_POST["txtAdresse"])) {
							$leNegociant->setAdresse(htmlentities($_POST["txtAdresse"]));
						}
						else
						{
							$leNegociant->setAdresse(NULL);
						}
					}
					if($ajoutOK)
					{
						//appel de la méthode d'ajout
						Negociants::modifierNegociant($leNegociant);
						$msg = '<span class="info">Le négociant à été ajouté !</span>';
						include'vues/v_consulter_negociant.php';
					}
					else
					{
						//Afficher les erreurs et on refait la saisie 
						$msg = '<span class="erreur">Des erreurs sont apparues lors de la saisie : </span>';
						include'vues/v_modifier_negociant.php';
					}
				};break;
			}
		}
	}break;
	case 'supprimerNegociant' : { 
		// récupération de l'identifiant du négociant passé dans l'URL
		$intNoNegociant = intval($_GET["id"]);    
           // appel de la méthode du modèle
		$leNegociant = Negociants::chargerNegociantsParID($intNoNegociant);
		$msg = '';
		if($leNegociant == NULL )
		{
			$msg = '<br /><span class="erreur">Ce négociant n\'existe pas !</span>';
		}
		else
		{
			if($leNegociant->nbContrats() == 0)
			{
				$leNegociant = Negociants::supprimerNegociant($leNegociant);
				$msg = '<span class="info">Le négociant a été supprimé !</span>';
			}
			else
			{
				$msg = '<span class="erreur">Le négociant ne peut pas être supprimé !</span>';	
			}
		}
		include 'vues/v_consulter_negociant.php';
	}	break;
	case 'listerNegociants' : { 
		$lesNegociants = Negociants::chargerNegociants(1);
		include 'vues/v_liste_negociants.php'; 
	}	break;
}
?>