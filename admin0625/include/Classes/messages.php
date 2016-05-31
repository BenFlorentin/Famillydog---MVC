<?php

// classe utilisée pour gérer les messages
class Messages
{

    /**
     * Méthode qui charge une liste des messages   
     * @param $mode : le type de résultat
     *                  0 == tableau associatif
     *                  1 == tableau "objet"
     * @return un tableau de type "mode"
    */
    static public function chargerMessages($mode) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();


        // requête
        $strSQL = "SELECT ID as ID,
        nom as Nom,
        prenom as Prenom,
        email as Email,
        sujet as Sujet,
        message as Message, 
        tel as Tel,
        etat as Etat,
        date_msg as DateMsg
        FROM messagerie
        ORDER BY date_msg DESC";

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
     * Méthode qui crée un objet de la classe Message à partir de son ID      
     * @param $id : l'identifiant de la message
     * @return un objet de la classe Message
    */
    static public function chargerMessageParID($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        nom as Nom,
        prenom as Prenom,
        email as Email,
        sujet as Sujet,
        message as Message, 
        tel as Tel,
        etat as Etat,
        date_msg as DateMsg
        FROM messagerie
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
        // test de l'existance du message 
        if ($res != -1) 
        {
            return $res;
        }
        else 
        {
            return NULL;
        }
    }

    /**
     * Méthode qui crée un objet de la classe Message à partir de son etat      
     * @param $etat : etat du message
     * @return un objet de la classe Message
    */
    static public function chargerMessagesParEtat($etat) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        nom as Nom,
        prenom as Prenom,
        email as Email,
        sujet as Sujet,
        message as Message, 
        tel as Tel,
        etat as Etat,
        date_msg as DateMsg
        FROM messagerie
        WHERE etat = ?
        ORDER BY date_msg DESC";
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($etat), 1);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        // test de l'existance du message 
        if ($res != -1) 
        {
            return $res;
        }
        else 
        {
            return NULL;
        }
    }



    /**
     * Méthode qui ajoute un Message dans la base      
     * @param   $params : tableau contenant les valeurs
     * @return  un objet de la classe Message
    */
    static public function ajouterMessage($params) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "INSERT INTO messagerie(nom,
        prenom,
        email,
        sujet,
        message,
        tel,
        etat,
        date_msg
        FROM messagerie)
            VALUES (?,?,?,?,?,?,?,?)";
        // test d'execution                    
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL, $params);

            /**
             * Pour retourner le message créé
             * il faut récupérer l'id du dernier message créé
            */
            // requête
            $req = "SELECT MAX(ID) FROM messagerie";
                    
            // execution de la requête
            $id = $cnx->getValue($req, array());

            // instanciation de l'objet
            $message = self::chargerMessageParID($id);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $message;
    }


    
    /**
     * supprime un message de la base
     * @param   $id : id du message
     * @return  un entier qui contient 1 si la mise à jour a été effectuées
    */
    static public function supprimerMessageParID($id) 
    {
        // accés à la base de données
        $cnx = new PdoDao();        

        // requête
        $strSQL = "DELETE FROM messagerie WHERE ID = ?";

        // test d'execution de la requete
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL,array($id));

            // suppression de l'objet en mémoire
            $msg = NULL;
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $msg;
    }


    /**
     * modifie un message de la base
     * @param   $id : id du message
     * @param   $etat : etat du message
     * @return  un entier qui contient 1 si la mise à jour a été effectuées
    */
    static public function modifierMessage($id, $etat) 
    {
        // accés à la base de données
        $cnx = new PdoDao();        

        // requête
        $strSQL = "UPDATE messagerie
                    SET etat = ?
                    WHERE ID = ?";

        // test d'execution de la requete
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL,array($etat, $id));

            // modification de l'objet en mémoire
            $msg = NULL;
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $msg;
    }  

    /**
     * retourne le nombre de messages en fonction de son etat
     * @param $etat : etat du message
     * @return un entier
    */
    static public function nbMessages($etat) 
    {
        // connexion
        $cnx = new PdoDao();

        // requête
        $strSQL = 'SELECT COUNT(*) AS nb_messages FROM messagerie WHERE etat = ?';

        // test d'execution
        try 
        {
            //execution
            $res = $cnx->getValue($strSQL, array($etat));
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $res;
    }      
    
    /**
     * Méthode qui modifie une reservation dans la base      
     * @param   $tarif : un objet de la classe Reservation
     * @return  un entier qui vaut 1 si la maj a été effectuée
    */
   /* static public function modifierReservation($reservation) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "UPDATE reservation 
        SET date_debut = ?,
            date_fin = ?,
            nb_jours_tot = ?,
            nb_jours_bla = ?,
            nb_jours_ble = ?,
            nb_jours_rou = ?,
            prix = ?,
            etat = ?
        WHERE ID = ?";

        // test d'execution
        try 
        {
            // recupére les valeurs
            $values = array($reservation->getDateDebut(),
                $reservation->getDateFin(),
                $reservation->getNbJoursTot(),
                $reservation->getNbJoursBla(),
                $reservation->getNbJoursBle(),
                $reservation->getNbJoursRou(),
                $reservation->getPrix(),
                $reservation->getEtat(),
                $reservation->getID());
            // execution de la requête
            $res = $cnx->execSQL($strSQL, $values);
        }
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $res;
    } */       
    
    /**
     * supprime une reservation de la base
     * @param   $reservation : un objet reservation
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
   /* static public function supprimerReservation($reservation) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

           $strSQL = "DELETE FROM reservation WHERE ID = ?";
            // on récupére l'id de la reservation
            $values = array($reservation->getID());
            // test de la suppression
            try 
            {
                // execution de la requête
                $cnx->execSQL($strSQL,$values);

                // suppression de l'objet en mémoire
                $reservation = NULL;
            }
            catch (PDOException $e) 
            {
                die($e->getMessage());
            }
            return $reservation;
    } */
}
?>