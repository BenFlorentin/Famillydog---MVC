<?php

// classe utilisée pour gérer les tarifs
class Tarifs 
{

    /**
     * Méthode qui charge une liste des tarifs   
     * @param $mode : le type de résultat
     *                  0 == tableau associatif
     *                  1 == tableau "objet"
     * @return un tableau de type "mode"
    */
    static public function chargerTarifs($mode) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();


        // requête
        $strSQL = "SELECT ID as ID,
        date_debut_bla as DateDebutBla,
        date_fin_bla as DateFinBla,
        date_debut_ble as DateDebutBle,
        date_fin_ble as DateFinBle,
        date_debut_rou as DateDebutRou, 
        date_fin_rou as DateFinRou,
        prix_jour_bla as PrixJourBla,
        prix_jour_ble as PrixJourBle,
        prix_jour_rou as PrixJourRou,
        saison_debut as SaisonDebut,
        saison_fin as SaisonFin
        FROM tarifs
        ORDER BY saison_debut DESC";

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
     * Méthode qui crée un objet de la classe Tarif à partir de son ID      
     * @param $id : l'identifiant du Tarif
     * @return un objet de la classe Tarif
    */
    static public function chargerTarifParID($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        date_debut_bla as DateDebutBla,
        date_fin_bla as DateFinBla,
        date_debut_ble as DateDebutBle,
        date_fin_ble as DateFinBle,
        date_debut_rou as DateDebutRou, 
        date_fin_rou as DateFinRou,
        prix_jour_bla as PrixJourBla,
        prix_jour_ble as PrixJourBle,
        prix_jour_rou as PrixJourRou,
        saison_debut as SaisonDebut,
        saison_fin as SaisonFin
        FROM tarifs 
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
            $date_debut_bla = $res[0]->DateDebutBla;
            $date_fin_bla = $res[0]->DateFinBla;
            $date_debut_ble = $res[0]->DateDebutBle;
            $date_fin_ble = $res[0]->DateFinBle;
            $date_debut_rou = $res[0]->DateDebutRou;
            $date_fin_rou = $res[0]->DateFinRou;
            $prix_jour_bla = $res[0]->PrixJourBla;
            $prix_jour_ble = $res[0]->PrixJourBle;
            $prix_jour_rou = $res[0]->PrixJourRou;
            $saison_debut = $res[0]->SaisonDebut;
            $saison_fin = $res[0]->SaisonFin;
            return new Tarif
            (
                $id,
                $date_debut_bla,
                $date_fin_bla,
                $date_debut_ble,
                $date_fin_ble,
                $date_debut_rou,
                $date_fin_rou,
                $prix_jour_bla,
                $prix_jour_ble,
                $prix_jour_rou,
                $saison_debut,
                $saison_fin);
        }
        else 
        {
            return NULL;
        }
    }



    /**
     * Méthode qui ajoute un tarif dans la base      
     * @param   $params : tableau contenant les valeurs
     * @return  un objet de la classe Tarif
    */
    static public function ajouterTarif($params) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "INSERT INTO tarifs(date_debut_bla,
            date_fin_bla,
            date_debut_ble,
            date_fin_ble,
            date_debut_rou,
            date_fin_rou,
            prix_jour_bla,
            prix_jour_ble,
            prix_jour_rou,
            saison_debut,
            saison_fin)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        // test d'execution                    
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL, $params);

            /**
             * Pour retourner le tarif créé
             * il faut récupérer l'id du dernier tarif créé
            */
            // requête
            $req = "SELECT MAX(ID) FROM tarifs";
                    
            // execution de la requête
            $id = $cnx->getValue($req, array());

            // instanciation de l'objet
            $tarif = self::chargerTarifParID($id);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $tarif;
    }        
    
    /**
     * Méthode qui modifie un tarif dans la base      
     * @param   $tarif : un objet de la classe Tarif
     * @return  un entier qui vaut 1 si la maj a été effectuée
    */
    static public function modifierTarif($tarif) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "UPDATE tarifs 
        SET date_debut_bla = ?,
            date_fin_bla = ?,
            date_debut_ble = ?,
            date_fin_ble = ?,
            date_debut_rou = ?,
            date_fin_rou = ?,
            prix_jour_bla = ?,
            prix_jour_ble = ?,
            prix_jour_rou = ?,
            saison_debut = ?,
            saison_fin = ?
        WHERE ID = ?";

        // test d'execution
        try 
        {
            // recupére les valeurs
            $values = array($tarif->getDateDebutBla(),
                $tarif->getDateFinBla(),
                $tarif->getDateDebutBle(),
                $tarif->getDateFinBle(),
                $tarif->getDateDebutRou(),
                $tarif->getDateFinRou(),
                $tarif->getPrixJourBla(),
                $tarif->getPrixJourBle(),
                $tarif->getPrixJourRou(),
                $tarif->getSaisonDebut(),
                $tarif->getSaisonFin(),
                $tarif->getID());
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
     * supprime un tarif de la base
     * @param   $tarif : un objet tarif
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
    static public function supprimerTarif($tarif) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

           $strSQL = "DELETE FROM tarifs WHERE ID = ?";
            // on récupére l'id du tarif
            $values = array($tarif->getID());
            // test de la suppression
            try 
            {
                // execution de la requête
                $cnx->execSQL($strSQL,$values);

                // suppression de l'objet en mémoire
                $tarif = NULL;
            }
            catch (PDOException $e) 
            {
                die($e->getMessage());
            }
            return $tarif;
    } 
}
?>