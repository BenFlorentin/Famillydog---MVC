<?php

// classe utilisée pour gérer les animaux
class Animals
{

    /**
     * Méthode qui charge une liste des animaux
     * @param $mode : le type de résultat
     *                  0 == tableau associatif
     *                  1 == tableau "objet"
     * @return un tableau de type "mode"
    */
    static public function chargerAnimals($mode) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();


        // requête
        $strSQL = "SELECT ID as ID,
        ID_proprietaire as IDProprietaire,
        type as Type,
        nom as Nom,
        date_naissance as DateNaissance,
        genre as Genre, 
        complem_info as ComplemInfo,
        vaccine as Vaccine,
        puce as Puce,
        race as Race
        FROM tarifs
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
     * Méthode qui crée un objet de la classe Animal à partir de son ID      
     * @param $id : l'identifiant de l'animal
     * @return un objet de la classe Animal
    */
    static public function chargerAnimalParID($id) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // créer la requête
        $strSQL = "SELECT ID as ID, 
        ID_proprietaire as IDProprietaire,
        type as Type,
        nom as Nom,
        date_naissance as DateNaissance,
        genre as Genre, 
        complem_info as ComplemInfo,
        vaccine as Vaccine,
        puce as Puce,
        race as Race
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
        // test de l'existance de l'animal 
        if ($res != -1) 
        {
            // l'utilisateur existe
            $ID_proprietaire = $res[0]->IDProprietaire;
            $Type = $res[0]->Type;
            $nom = $res[0]->Nom;
            $date_naissance = $res[0]->DateNaissance;
            $genre = $res[0]->Genre; 
            $complem_info = $res[0]->ComplemInfo;
            $vaccince = $res[0]->Vaccine;
            $puce = $res[0]->Puce;
            $race = $res[0]->Race;
            return new Tarif
            (
                $id,
                $ID_proprietaire,
                $Type,
                $nom,
                $date_naissance,
                $genre,
                $complem_info,
                $vaccine,
                $puce,
                $race);
        }
        else 
        {
            return NULL;
        }
    }



    /**
     * Méthode qui ajoute un animal dans la base      
     * @param   $params : tableau contenant les valeurs
     * @return  un objet de la classe Animal
    */
    static public function ajouterAnimal($params) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "INSERT INTO animal(ID_proprietaire,
                    type,
                    nom,
                    date_naissance,
                    genre,
                    complem_info,
                    vaccine,
                    puce,
                    race)
                    VALUES (?,?,?,?,?,?,?,?,?)";
                            // test d'execution                    
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL, $params);

            /**
             * Pour retourner l'animal créé
             * il faut récupérer l'id du dernier animal créé
            */
            // requête
            $req = "SELECT MAX(ID) FROM animal";

            // execution de la requête
            $id = $cnx->getValue($req, array());

            // instanciation de l'objet
            $animal = self::chargerAnimalParID($id);
        } 
        catch (Exception $ex) 
        {
            die ($ex->getMessage());
        }
        return $animal;
    }        
    
    /**
     * Méthode qui modifie un animal dans la base      
     * @param   $animal : un objet de la classe Animal
     * @return  un entier qui vaut 1 si la maj a été effectuée
    */
    static public function modifierAnimal($animal) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "UPDATE animal 
        SET type = ?,
        nom = ?,
        date_naissance = ?,
        genre = ?,
        complem_info = ?,
        vaccine = ?,
        puce = ?,
        race = ?
        WHERE ID = ?";

        // test d'execution
        try 
        {
            // recupére les valeurs
            $values = array($animal->getType(),
                $animal->getNom(),
                $animal->getDateNaissance(),
                $animal->getGenre(),
                $animal->getComplemInfo(),
                $animal->getVaccine(),
                $animal->getPuce(),
                $animal->getRace(),
                $animal->getID());
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
     * supprime un animal de la base
     * @param   $animal : un objet animal
     * @return  un entier qui contient 1 si la suppression a été effectuée
    */
    static public function supprimerAnimal($animal) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        $strSQL = "DELETE FROM animal WHERE ID = ?";
            // on récupére l'id de l'animal
        $values = array($animal->getID());
        // test de la suppression
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL,$values);

            // suppression de l'objet en mémoire
            $animal = NULL;
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $animal;
    }

    /**
     * supprime les animaux de l'utilisateur
     * @return  un entier qui contient 1 si la mise à jour a été effectuées
    */
    static public function supprimerAnimaux($utilisateur) 
    {
        // créer une nouvelle connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "DELETE FROM animal WHERE ID_proprietaire = ?";

        // test de la suppression
        try 
        {
            // execution de la requête
            $cnx->execSQL($strSQL,array($utilisateur->getID()));

            // suppression de l'objet en mémoire
            $utilisateur = null;
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        
        return $utilisateur;
    } 
}
?>