<?php
/** 
 * Page d'accueil de l'application Famillydog
 * côté administrateur

 * Point d'entrée de l'application
 * @author 
 * @package default
 */

session_start(); // ouvre une session


// inclure les bibliothèques de fonctions
require_once '../include/_config.inc.php';
require_once 'include/_data.lib.php';
require_once 'include/_forms.lib.php';

    // inclure la gestion de cookie
require_once '../include/cookie.php';

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
    $uc = 'connexion';
}

// l'affchage de l'entête ainsi que sa gestion ne se fait que si l'administrateur est connecté
if (isset($_GET['uc']) && $_GET['uc'] != "gererConnexion") 
{
    // gestion de l'entête
        require_once 'include/gestion_header.php';
        // inclure l'entête
        require_once 'vues/_v_header.php';
}

// charger la uc selon son identifiant
switch ($uc) 
{
    case 'gererConnexion' : 
        include 'controleurs/c_gerer_connexion.php'; break;

    case 'gererMessages' : 
        include 'controleurs/c_gerer_messages.php'; break;

    case 'gererTarifs' : 
        include 'controleurs/c_gerer_tarifs.php'; break;

    case 'home' : 
        include 'vues/v_home.php'; break;

    default : include 'controleurs/c_gerer_connexion.php'; break;
}

// l'affichage de pied de page ne se fait que si l'administrateur est connecté
if (isset($_GET['uc']) && $_GET['uc'] != "gererConnexion") 
{
    require_once'../vues/_v_footer.php';
}


