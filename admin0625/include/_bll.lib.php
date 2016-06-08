<?php

// ----------------------------------------------------------------------------
/* Projet Famillydog
 * 
 * 
 * Utilise les services de la classe PdoDao
 * Utilise les services de la bibliothèque _reference.lib.php
 *
 * @package 	default
 * @author
 * @version    	1.0
 * @link       	http://www.php.net/manual/fr/book.pdo.php
 */
// ----------------------------------------------------------------------------

require_once 'include/_data.lib.php';
require_once 'include/_reference.lib.php';


// classe utilisée pour gérer les utilisateurs
require_once 'include/Classes/utilisateurs.php';

// classe utilisée pour gérer les tarifs
require_once 'include/Classes/tarifs.php';

// classe utilisée pour gérer les animaux
require_once 'include/Classes/animals.php';

// classe utilisée pour gérer les réservations
require_once 'include/Classes/reservations.php';

// classe utilisée pour gérer les messages
require_once 'include/Classes/messages.php';
