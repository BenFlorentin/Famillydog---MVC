<?php

// ----------------------------------------------------------------------------
/* Projet CAG
 * 
 * Data Access Object
 * Classe technique d'accès aux données 
 * 
 * Utilise les services de la classe PDO
 *
 * @package 	default
 * @author
 * @version    	1.0
 * @link       	http://www.php.net/manual/fr/book.pdo.php
 */

class PdoDao extends PDO 
{
    /**
     * Constructeur hérité de PDO
     */
    public function __construct()
     {
        parent::__construct(
                DSN, DB_USER, DB_PWD, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        try
        {
            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            parent::setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
        } 
        catch (Exception $e) 
        {
            die(print_r($e->getMessage()));
        }
    }

    /**
     * Fonction qui renvoie un tableau de valeurs correspondant au résultat
     * de l'exécution d'une requête préparée SQL avec des paramètres anonymes
     * @param $cnx (un objet PDO)
     * @param $sql (la requête SQL à exécuter)
     * @param $params : un tableau de paramètres contenant 
     * les valeurs à substituer dans la requête
     * @param $style : 0 == both, 1 == objet
     * @return un tableau "objet"
     */
    function getRows($sql, $params, $style) 
    {
        try 
        {
            $res = $this->prepare($sql);
            $res->execute($params);
        } 
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        if ($res->rowCount() > 0) 
        {
            if ($style) 
            {
                return $res->fetchAll(PDO::FETCH_CLASS, 'ArrayObject');
            } 
            else 
            {
                return $res->fetchAll();
            }
        } 
        else
        {
            return -1;
        }
    }

    /**
     * Fonction qui exécute une requête action préparée 
     * avec des paramètres anonymes
     * @param $sql : la requête SQL à exécuter
     * @param $params : un tableau de paramètres contenant les valeurs 
     * à substituer dans la requête
     * @return un entier désignant le nombre de lignes affectées par
     * l'exécution de la requête
     */
    function execSQL($sql, $params) 
    {
        try 
        {
            $res = $this->prepare($sql);
            $res->execute($params);
            $nb = $res->rowCount();
        } 
        catch (PDOException $e) 
        {
            $nb = -1;
            die($e->getMessage());
        }
        return $nb;
    }

    /**
     * Fonction qui exécute une requête préparée 
     * avec des paramètres anonymes et qui récupère une seule valeur
     * @param $sql : la requête SQL à exécuter
     * La requête ne doit renvoyer qu'une colonne et une ligne
     * @param $params : un tableau de paramètres contenant les valeurs 
     * à substituer dans la requête
     * @return la valeur récupérée par l'exécution de la requête
     */
    function getValue($sql, $params) 
    {
        try
        {
            $res = $this->prepare($sql);
            $res->execute($params);
            if ($res) 
            {
                $ligne = $res->fetchAll(PDO::FETCH_COLUMN, 0);
                $value = $ligne[0];
                $res->closeCursor();
            }
        } 
        catch (PDOException $e) 
        {
            $value = -1;
            die($e->getMessage());
        }
        return $value;
    }
}
