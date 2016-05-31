<?php

// classe utilisée pour gérer les utilisateurs
class Utilisateurs 
{

    /**
     * Méthode qui charge une liste des utilisateurs   
     * @param $mode : le type de résultat
     *                  0 == tableau associatif
     *                  1 == tableau "objet"
     * @return un tableau de type "mode"
    */
    static public function chargerUtilisateur($mode) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();


        // requête
        $strSQL = "SELECT ID as ID,
        nom as Nom,
        prenom as Prenom
        FROM proprietaire
        ORDER BY nom";
        // test d'execution 
        try 
        {
            // execution de la requpête
            $res = $cnx->getRows($strSQL, array(), $mode);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $res;
    }
    
    /**
     * Méthode qui crée un objet de la classe Utilisateur à partir de son ID      
     * @param $id : l'identifiant du utilisateur
     * @return un objet de la classe Utilisateur
    */
    static public function chargerUtilisateurParID($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        genre as Genre, 
        nom AS Nom, 
        prenom AS Prenom, 
        collectivites AS Collectivites, 
        tel AS Tel, 
        fix AS Fix, 
        fax AS Fax, 
        email AS Email, 
        mdp AS Mdp, 
        rue_voie AS RueVoie, 
        num_rue_voie AS NumRueVoie, 
        ville AS Ville,
        pays AS Pays,
        code_postal AS CodePostal,
        complem_adr AS ComplemAdr,
        complem_info AS ComplemInfo,
        date_naissance AS DateNaissance,
        droit AS Droit
        FROM proprietaire 
        WHERE ID = ?";
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($id), 1);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        // test de l'existance de l'utilisateur 
        if ($res != -1) 
        {
            // l'utilisateur existe
            $genre = $res[0]->Genre;
            $nom = $res[0]->Nom;
            $prenom = $res[0]->Prenom;
            $collectivites = $res[0]->Collectivites;
            $tel = $res[0]->Tel;
            $fix = $res[0]->Fix;
            $fax = $res[0]->Fax;
            $email = $res[0]->Email;
            $mdp = $res[0]->Mdp;
            $rue_voie = $res[0]->RueVoie;
            $num_rue_voie = $res[0]->NumRueVoie;
            $ville = $res[0]->Ville;
            $pays = $res[0]->Pays;
            $code_postal = $res[0]->CodePostal;
            $complem_adr = $res[0]->ComplemAdr;
            $complem_info = $res[0]->ComplemInfo;
            $date_naissance = $res[0]->DateNaissance;
            $droit = $res[0]->Droit;
            return new Utilisateur
            (
                $id,
                $genre,
                $nom,
                $prenom,
                $collectivites,
                $tel,
                $fix,
                $fax,
                $email,
                $mdp,
                $rue_voie,
                $num_rue_voie,
                $ville,
                $pays,
                $code_postal,
                $complem_adr,
                $complem_info,
                $date_naissance,
                $droit 
                );
        }
        else 
        {
            return NULL;
        }
    }


    /**
     * Méthode qui crée un objet de la classe Utilisateur à partir de son email et de son mdp      
     * @param $email : email de l'utilisateur
     * @param $mdp : mdp de l'utilisateur
     * @return un objet de la classe Utilisateur
    */
    static public function chargerUtilisateurParEmailEtParMdp($email, $mdp) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        genre as Genre, 
        nom AS Nom, 
        prenom AS Prenom, 
        collectivites AS Collectivites, 
        tel AS Tel, 
        fix AS Fix, 
        fax AS Fax, 
        email AS Email, 
        mdp AS Mdp, 
        rue_voie AS RueVoie, 
        num_rue_voie AS NumRueVoie, 
        ville AS Ville,
        pays AS Pays,
        code_postal AS CodePostal,
        complem_adr AS ComplemAdr,
        complem_info AS ComplemInfo,
        date_naissance AS DateNaissance,
        droit AS Droit
        FROM proprietaire 
        WHERE email = ? 
        AND mdp = ?";
        
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($email, $mdp), 1);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }

        // test de l'existance de l'utilisateur 
        if ($res != -1) 
        {
            // l'utilisateur existe
            $id = $res[0]->ID;
            $genre = $res[0]->Genre;
            $nom = $res[0]->Nom;
            $prenom = $res[0]->Prenom;
            $collectivites = $res[0]->Collectivites;
            $tel = $res[0]->Tel;
            $fix = $res[0]->Fix;
            $fax = $res[0]->Fax;
            $rue_voie = $res[0]->RueVoie;
            $num_rue_voie = $res[0]->NumRueVoie;
            $ville = $res[0]->Ville;
            $pays = $res[0]->Pays;
            $code_postal = $res[0]->CodePostal;
            $complem_adr = $res[0]->ComplemAdr;
            $complem_info = $res[0]->ComplemInfo;
            $date_naissance = $res[0]->DateNaissance;
            $droit = $res[0]->Droit;
            return new Utilisateur
            (
                $id,
                $genre,
                $nom,
                $prenom,
                $collectivites,
                $tel,
                $fix,
                $fax,
                $email,
                $mdp,
                $rue_voie,
                $num_rue_voie,
                $ville,
                $pays,
                $code_postal,
                $complem_adr,
                $complem_info,
                $date_naissance,
                $droit 
                );
        }
        else 
        {
            return NULL;
        }
    }



    /**
     * Méthode qui crée un tableau contenant les informations de l'admin à partir de son email et de son mdp      
     * @param $email : email de l'utilisateur
     * @param $mdp : mdp de l'utilisateur
     * @return un tableau
    */
    static public function chargerAdminParEmailEtParMdp($email, $mdp) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        nom AS Nom, 
        prenom AS Prenom, 
        email AS Email, 
        mdp AS Mdp, 
        droit AS Droit
        FROM proprietaire 
        WHERE email = ? 
        AND mdp = ?
        AND droit = 1";
        
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($email, $mdp), 1);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }

        // test de l'existance de l'utilisateur 
        if ($res != -1) 
        {
            // l'utilisateur existe
            $id = $res[0]->ID;
            $nom = $res[0]->Nom;
            $prenom = $res[0]->Prenom;
            $droit = $res[0]->Droit;

            return $admin = array(
                'id' => $id,
                'nom' => $nom,
                'prenom' => $prenom,
                'droit' => $droit);  


        }
        else 
        {
            return NULL;
        }
    }

    /**
     * Méthode qui ajoute un utilisateur dans la base      
     * @param   $params : tableau contenant les valeurs
     * @return  un objet de la classe Utilisateur
    */
    static public function ajouterUtilisateur($params) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "INSERT INTO proprietaire 
                    (
                        genre,
                        nom,
                        prenom,
                        collectivites,
                        tel,
                        fix,
                        fax,
                        email,
                        mdp,
                        rue_voie,
                        num_rue_voie,
                        ville,
                        pays,
                        code_postal,
                        complem_adr,
                        complem_info,
                        date_naissance,
                        droit
                    )
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        // test d'execution                    
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL, $params);

            /**
             * Pour retourner l'utilisateur créé
             * il faut récupérer l'id du dernier utilisateur créé
            */
            // requête
            $strSQL = "SELECT MAX(ID) FROM proprietaire";
            
            // execution de la requête
            $id = $cnx->getValue($strSQL, array());

            // instanciation de l'objet
            $utilisateur = self::chargerUtilisateurParID($id);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $utilisateur;
    }        
    
    /**
     * Méthode qui modifie un utilisateur dans la base      
     * @param   $utilisateur : un objet de la classe Utilisateur
     * @return  un entier qui vaut 1 si la maj a été effectuée
    */
    static public function modifierUtilisateur($utilisateur) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "UPDATE proprietaire 
                SET genre = ?, 
                    nom = ?,
                    prenom = ?,
                    collectivites = ?,
                    tel = ?,
                    fix = ?,
                    fax = ?,
                    email = ?,
                    mdp = ?,
                    rue_voie = ?,
                    num_rue_voie = ?,
                    ville = ?,
                    pays = ?,
                    code_postal = ?,
                    complem_adr = ?,
                    complem_info = ?,
                    date_naissance = ?,
                    droit = ?
                WHERE ID = ?";

        // test d'execution
        try 
        {
            // recupére les valeurs
            $values = array($utilisateur->getGenre(),
                $utilisateur->getNom(),
                $utilisateur->getPrenom(),
                $utilisateur->getCollectivites(),
                $utilisateur->getTel(),
                $utilisateur->getFix(),
                $utilisateur->getFax(),
                $utilisateur->getEmail(),
                $utilisateur->getMdp(),
                $utilisateur->getRueVoie(),
                $utilisateur->getNumRueVoie(),
                $utilisateur->getVille(),
                $utilisateur->getPays(),
                $utilisateur->getCodePostal(),
                $utilisateur->getComplemAdr(),
                $utilisateur->getComplemInfo(),
                $utilisateur->getDateNaissance(),
                $utilisateur->getDroit(),
                $utilisateur->getID());
            // execution de la requête
            $res = $cnx->execSQL($strSQL, $values);
        }
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $res;
    }        
    
    /**
     * supprime un utilisateur de la base
     * @param   $utilisateur : un objet utilisateur
     * @return  un entier qui contient 1 si la mise à jour a été effectuées
    */
    static public function supprimerUtilisateur($utilisateur) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        /**
         * Pour supprimer un utilisateur
         * il faut d'abord vérifier qu'il n'a pas effectuer de réservation
        */
        // requête
        $a = "SELECT COUNT(*) FROM reservation WHERE ID_proprietaire = ?";
        // execution de la requête
        $nbReservation = $cnx->getValue($a, array($utilisateur->getID()));

        // test de l'existance de réservation pour cet utilisteur
        if($nbReservation == 0)
        {
            // il n'existe pas de réservation donc on effectue la suppression
            // requête
            $strSQL = "DELETE FROM proprietaire WHERE ID = ?";
            // on récupére l'id de  l'utilisateur
            $values = array($utilisateur->getID());
            // test de la suppression
            try 
            {
                // execution de la requête
                $cnx->execSQL($strSQL,$values);

                // suppression de l'objet en mémoire
                $utilisateur = NULL;
            }
            catch (PDOException $e) 
            {
                die($e->getMessage());
            }
            return $utilisateur;
            
        }
        else
        {
            return $utilisateur;
        }

    } 
}
?>