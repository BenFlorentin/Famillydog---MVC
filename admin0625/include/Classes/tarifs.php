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
        tarif_jour_chien as TarifJourChien,
        tarif_jour_chat as TarifJourChat,
        debut_periode as DebutPeriode,
        fin_periode as FinPeriode
        FROM tarifs
        ORDER BY debut_periode DESC";

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
        tarif_jour_chien as TarifJourChien,
        tarif_jour_chat as TarifJourChat,
        debut_periode as DebutPeriode,
        fin_periode as FinPeriode
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
            $tarif_jour_chien = $res[0]->TarifJourChien;
            $tarif_jour_chat = $res[0]->TarifJourChat;
            $debut_periode = $res[0]->DebutPeriode;
            $fin_periode = $res[0]->FinPeriode;
            return new Tarif
            (
                $id,
                $tarif_jour_chien,
                $tarif_jour_chat,
                $debut_periode,
                $fin_periode);
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
        $strSQL = "INSERT INTO tarifs(tarif_jour_chien,
                tarif_jour_chat,
                debut_periode,
                fin_periode)
            VALUES (?,?,?,?)";
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
        SET tarif_jour_chien = ?,
            tarif_jour_chat = ?,
            debut_periode = ?,
            fin_periode = ?
        WHERE ID = ?";

        // test d'execution
        try 
        {
            // recupére les valeurs
            $values = array($tarif->getTarifJourChien(),
                $tarif->getTarifJourChat(),
                $tarif->getDebutPeriode(),
                $tarif->getFinPeriode(),
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
     * @param   $id : id du tarif
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
    static public function supprimerTarif($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

           $strSQL = "DELETE FROM tarifs WHERE ID = ?";

            // test de la suppression
            try 
            {
                // execution de la requête
                $res = $cnx->execSQL($strSQL,array($id));
            }
            catch (PDOException $e) 
            {
                die($e->getMessage());
            }
            return $res;
    } 


    /**
     * vérifie l'existance d'une tarif pour une période donnée
     * @param   $debut_periode : debut de la période teste
     * @param   $fin_periode : fin de la période teste
     * @param   $debut : debut de la période dans la base de données
     * @param   $fin : fin de la période dans la base de données
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
    static public function verifierTarifs($debut_periode,$fin_periode,$debut,$fin) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = $cnx->prepare("SELECT f_dateVerifTarifs(?,?,?,?)");

        // test de l'execution de la requête
        try 
        {
            // execution de la requête
            $strSQL->execute(array($debut_periode, $fin_periode, $debut, $fin));

        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $strSQL;
    } 
}
?>