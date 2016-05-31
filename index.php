<?php
/** 
 * Page d'accueil de l'application Famillydog
 * côté client

 * Point d'entrée de l'application
 * @author 
 * @package default
 */

session_start(); // ouvre une session


// inclure les bibliothèques de fonctions
require_once 'include/_config.inc.php';
require_once 'include/_data.lib.php';
require_once 'include/_forms.lib.php';

// gestion de l'entête
require_once 'include/gestion_header.php';


// inclure l'entête
require_once 'vues/_v_header.php';

// inclure la gestion de cookie
require_once 'include/cookie.php'; 

// inclure la gestion des erreurs
require_once 'erreur/gestion_erreurs.php';
require_once 'validation/gestion_validation.php';
require_once 'include/unset.php';

/*
  Récupère l'identifiant de la page passée par l'URL.
  Si non défini, on considère que la page demandée est la page d'accueil
 */
if (isset($_GET["uc"])) 
{
    $uc = $_GET["uc"];
}
else 
{
    $uc = 'home';
}

// charger la uc selon son identifiant
switch ($uc) 
{
    case 'gererConnexion' : 
        include 'controleurs/c_gerer_connexion.php'; break;
    case 'gererContrats' : 
        include 'controleurs/c_gerer_contrats.php'; break;
    case 'gererLivraisons' : 
        include 'controleurs/c_gerer_livraisons.php'; break;
    default : include 'vues/v_home.php'; break;
}

// inclure le pied de page
require_once 'vues/_v_footer.php';


