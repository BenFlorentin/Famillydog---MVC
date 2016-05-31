<?php

// classe utilisée pour gérer les réservations
class Reservations 
{

    /**
     * Méthode qui charge une liste des réservations   
     * @param $mode : le type de résultat
     *                  0 == tableau associatif
     *                  1 == tableau "objet"
     * @return un tableau de type "mode"
    */
    static public function chargerReservations($mode) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();


        // requête
        $strSQL = "SELECT ID as ID,
        ID_proprietaire as IDProprietaire,
        ID_animal as IDAnimal,
        date_debut as DateDebut,
        date_fin as DateFin,
        nb_jours_tot as NbJoursTot, 
        nb_jours_bla as NbJoursBla,
        nb_jours_ble as NbJoursBle,
        nb_jours_rou as NbJoursRou,
        prix as Prix,
        etat as Etat
        FROM reservation
        ORDER BY date_debut DESC";

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
     * Méthode qui crée un objet de la classe Reservation à partir de son ID      
     * @param $id : l'identifiant de la réservation
     * @return un objet de la classe Reservation
    */
    static public function chargerReservationParID($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        ID_proprietaire as IDProprietaire,
        ID_animal as IDAnimal,
        date_debut as DateDebut,
        date_fin as DateFin,
        nb_jours_tot as NbJoursTot, 
        nb_jours_bla as NbJoursBla,
        nb_jours_ble as NbJoursBle,
        nb_jours_rou as NbJoursRou,
        prix as Prix,
        etat as Etat
        FROM reservation
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
            $id_proprietaire = $res[0]->IDProprietaire;
            $id_animal = $res[0]->IDAnimal;
            $date_debut = $res[0]->DateDebut;
            $date_fin = $res[0]->DateFin;
            $nb_jours_tot = $res[0]->NbJoursTot;
            $nb_jours_bla = $res[0]->NbJoursBla;
            $nb_jours_ble = $res[0]->NbJoursBle;
            $nb_jours_rou = $res[0]->NbJoursRou;
            $prix = $res[0]->Prix;
            $etat = $res[0]->Etat;
            return new Reservation
            (
                $id,
                $id_proprietaire,
                $id_animal,
                $date_debut,
                $date_fin,
                $nb_jours_tot,
                $nb_jours_bla,
                $nb_jours_ble,
                $nb_jours_rou,
                $prix,
                $etat);
        }
        else 
        {
            return NULL;
        }
    }

    /**
     * retourne le nombre de réservations en fonction de son etat
     * @param $etat : etat de la réservation
     * @return un entier
    */
    static public function nbReservations($etat) 
    {
        // connexion
        $cnx = new PdoDao();

        // requête
        $strSQL = 'SELECT COUNT(*) AS nb_reservations FROM reservation WHERE etat = ?';

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
     * retourne le nombre de réservations de l'utilisateur en fonction de son etat
     * @param   $etat : etat de la réservation
     * @param   $id : id de l'utilisateur
     * @return un entier 
    */
   static public function nbReservationsParEtatEtParId($etat,$id) 
    {
        // ouvre une connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = 'SELECT COUNT(*) AS nb_reservations FROM reservation WHERE etat = ? AND ID_proprietaire = ?';
        
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getValue($strSQL, array($etat,$id));
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $res;
    }

    /**
     * Méthode qui ajoute une réservation dans la base      
     * @param   $params : tableau contenant les valeurs
     * @return  un objet de la classe Reservation
    */
    static public function ajouterReservation($params) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "INSERT INTO reservation(ID_proprietaire,
                    ID_animal,
                    date_debut,
                    date_fin,
                    nb_jours_tot,
                    nb_jours_bla,
                    nb_jours_ble,
                    nb_jours_rou,
                    prix,
                    etat)
            VALUES (?,?,?,?,?,?,?,?,?,?)";
        // test d'execution                    
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL, $params);

            /**
             * Pour retourner la reservation créé
             * il faut récupérer l'id de la derniere reservation créée
            */
            // requête
            $req = "SELECT MAX(ID) FROM reservation";
                    
            // execution de la requête
            $id = $cnx->getValue($req, array());

            // instanciation de l'objet
            $reservation = self::chargerReservationParID($id);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $reservation;
    }        
    
    /**
     * Méthode qui modifie une reservation dans la base      
     * @param   $tarif : un objet de la classe Reservation
     * @return  un entier qui vaut 1 si la maj a été effectuée
    */
    static public function modifierReservation($reservation) 
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
    }        
    
    /**
     * supprime une reservation de la base
     * @param   $reservation : un objet reservation
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
    static public function supprimerReservation($reservation) 
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
    } 
}
?>