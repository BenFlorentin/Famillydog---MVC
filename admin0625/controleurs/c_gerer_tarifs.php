<?php
require_once 'include/_bll.lib.php';

if (isset($_GET["action"])) 
{
	$action = $_GET["action"];
}
else
{
	$action = "listeTarifs";
}


// diriger vers les bonnes vues
switch ($action) 
{
	// liste des tarifs
	case 'listeTarifs' :
	{
		$lesTarifs = Tarifs::chargerTarifs(1);

		include'vues/v_tarifs.php';
	};break;

	// modifier un tarif
	case 'modifier' : 
	{
		if(isset($_GET['option']))
		{
			$option = $_GET['option'];
		}
		else
		{
			$option = "saisir";
		}


		switch ($option) 
		{
			// formulaire récupérant le tarif 
			case 'saisir':
			{
				// on récupere l'id du tarif dans l'url
				$id = intval($_GET['id']);

				$leTarif = Tarifs::chargerTarifParID($id);

				include'vues/v_tarif_modifier.php';
			}break;
			
			case 'valider':
			{
				// on récupère les données du formulaire reçu par la méthode POST
				$id = intval($_POST['ID_tarifs']);
				$prix_jour_chien = intval($_POST['prix_jour_chien']);
				$prix_jour_chat = intval($_POST['prix_jour_chat']);

					// on récuère debut_periode pour le formater pour l'insérer dans la base de données
				$debut_periode = explode('/', htmlentities($_POST['debut_periode']));
				
					// on récuère fin_periode pour le formater pour l'insérer dans la base de données
				$fin_periode = explode('/', htmlentities($_POST['fin_periode']));

				if(checkdate($debut_periode[1],$debut_periode[0],$debut_periode[2]))
				{
					unset($_SESSION['E_DATE_DEBUT_SAISON']);

					if(checkdate($fin_periode[1],$fin_periode[0],$fin_periode[2]))
					{		
						unset($_SESSION['E_DATE_FIN_SAISON']);

						// on créer un tableau contenant les informations récupérées
						$values = array();
						$values[] = $id;
						$values[] = $prix_jour_chien;
						$values[] = $prix_jour_chat;
						$values[] = $debut_periode[2].'-'.$debut_periode[1].'-'.$debut_periode[0];
						$values[] = $fin_periode[2].'-'.$fin_periode[1].'-'.$fin_periode[0];

						// on instancie un Tarif
						$leTarif = new Tarif($values[0],$values[1],$values[2],$values[3],$values[4]);

						// on modifie le tarif
						$TarifModifier = Tarifs::modifierTarif($leTarif);
						
						// on test si la modification a été effectué
						if($TarifModifier)
						{
							// modification effectuée

							unset($_SESSION['E_TARIFS']);
							$_SESSION['V_TARIFS'] = true;

							// on charge tout les tarifs pour les afficher
							$lesTarifs = Tarifs::chargerTarifs(1);

							include'vues/v_tarifs.php';
						}
						else
						{
							// modification echouée

							unset($_SESSION['V_TARIFS']);
							$_SESSION['E_TARIFS'] = true;

							// on charge tout les tarifs pour les afficher
							$lesTarifs = Tarifs::chargerTarifs(1);

							include'vues/v_tarifs.php';
						}

					}
					else
					{
						// fin_periode est invalide
						$_SESSION['E_DATE_FIN_SAISON'] = true;
						
						// on charge tout les tarifs pour les afficher
						$lesTarifs = Tarifs::chargerTarifs(1);

						include'vues/v_tarifs.php';
					}
				}
				else
				{
					// debut_periode est invalide
					$_SESSION['E_DATE_DEBUT_SAISON'] = true;

					// on charge tout les tarifs pour les afficher
					$lesTarifs = Tarifs::chargerTarifs(1);

					include'vues/v_tarifs.php';
				}

			};break;
		}
	};break;		

	// supprimer un message
	case 'supprimer' : 
	{
		// récupère l'id du message à supprimer
		$id = intval($_GET['id']);

		// suppression du message
		$tarif = Tarifs::supprimerTarif($id);

		$_SESSION['V_TARIFS_SUPP'] = true;

		// on charge tout les tarifs pour les afficher
		$lesTarifs = Tarifs::chargerTarifs(1);

		include'vues/v_tarifs.php';

	};break;
}
?>
