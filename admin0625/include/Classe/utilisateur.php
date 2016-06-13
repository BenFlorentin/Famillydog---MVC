<?php 

class Utilisateur
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_genre;
    private $_nom;
    private $_prenom;
    private $_collectivites;
    private $_tel;
    private $_fix;
    private $_fax;
    private $_email;
    private $_mdp;
    private $_rue_voie;
    private $_num_rue_voie;
    private $_ville;
    private $_pays;
    private $_code_postal;
    private $_complem_adr;
    private $_complem_info;
    private $_date_naissance;
    private $_droit;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_genre,
        $p_nom,
        $p_prenom,
        $p_collectivites,
        $p_tel,
        $p_fix,
        $p_fax,
        $p_email,
        $p_mdp,
        $p_rue_voie,
        $p_num_rue_voie,
        $p_ville,
        $p_pays,
        $p_code_postal,
        $p_complem_adr,
        $p_complem_info,
        $p_date_naissance,
        $p_droit
        ) 
    {
        $this->setID($p_id);
        $this->setGenre($p_genre);
        $this->setNom($p_nom);
        $this->setPrenom($p_prenom);
        $this->setCollectivites($p_collectivites);
        $this->setTel($p_tel);
        $this->setFix($p_fix);
        $this->setFax($p_fax);
        $this->setEmail($p_email);
        $this->setMdp($p_mdp);
        $this->setRueVoie($p_rue_voie);
        $this->setNumRueVoie($p_num_rue_voie);
        $this->setVille($p_ville);
        $this->setPays($p_pays);
        $this->setCodePostal($p_code_postal);
        $this->setComplemAdr($p_complem_info);
        $this->setComplemInfo($p_complem_info);
        $this->setDateNaissance($p_date_naissance);
        $this->setDroit($p_droit);
    }

    /**
     * Accesseurs en lecture
    */

    public function getID() 
    {
        return $this->_id;
    } 
    public function getGenre() 
    {
        return $this->_genre;
    }
    public function getNom() 
    {
        return $this->_nom;
    }
    public function getPrenom() 
    {
        return $this->_prenom;
    }
    public function getCollectivites() 
    {
        return $this->_collectivites;
    }
    public function getTel() 
    {
        return $this->_tel;
    }
    public function getFix() 
    {
        return $this->_fix;
    }
    public function getFax() 
    {
        return $this->_fax;
    } 
    public function getEmail() 
    {
        return $this->_email;
    }
    public function getMdp() 
    {
        return $this->_mdp;
    }
    public function getRueVoie() 
    {
        return $this->_rue_voie;
    }
    public function getNumRueVoie() 
    {
        return $this->_num_rue_voie;
    }
    public function getVille() 
    {
        return $this->_ville;
    }  
    public function getPays() 
    {
        return $this->_pays;
    }
    public function getCodePostal() 
    {
        return $this->_code_postal;
    }
    public function getComplemAdr() 
    {
        return $this->_complem_adr;
    }
    public function getComplemInfo() 
    {
        return $this->_complem_info;
    }
    public function getDateNaissance() 
    {
        return $this->_date_naissance;
    }
    public function getDroit() 
    {
        return $this->_droit;
    }
    

    /**
     * Mutateurs (accesseurs en écriture)
    */
    
     public function setID($p_id) 
    {
        $this->_id = $p_id;
    } 
    public function setGenre($p_genre) 
    {
        $this->_genre = $p_genre;
    }
    public function setNom($p_nom) 
    {
        $this->_nom = $p_nom;
    }
    public function setPrenom($p_prenom) 
    {
        $this->_prenom = $p_prenom;
    }
    public function setCollectivites($p_collectivites) 
    {
        $this->_collectivites = $p_collectivites;
    }
    public function setTel($p_tel) 
    {
        $this->_tel = $p_tel;
    }
    public function setFix($p_fix) 
    {
        $this->_fix = $p_fix;
    }
    public function setFax($p_fax) 
    {
        $this->_fax = $p_fax;
    } 
    public function setEmail($p_email) 
    {
        $this->_email = $p_email;
    }
    public function setMdp($p_mdp) 
    {
        $this->_mdp = $p_mdp;
    }
    public function setRueVoie($p_rue_voie) 
    {
        $this->_rue_voie = $p_rue_voie;
    }
    public function setNumRueVoie($p_num_rue_voie) 
    {
        $this->_num_rue_voie = $p_num_rue_voie;
    }
    public function setVille($p_ville) 
    {
        $this->_ville = $p_ville;
    }  
    public function setPays($p_pays) 
    {
        $this->_pays = $p_pays;
    }
    public function setCodePostal($p_code_postal) 
    {
        $this->_code_postal = $p_code_postal;
    }
    public function setComplemAdr($p_complem_adr) 
    {
        $this->_complem_adr = $p_complem_adr;
    }
    public function setComplemInfo($p_complem_info) 
    {
        $this->_complem_info = $p_complem_info;
    }
    public function setDateNaissance($p_date_naissance) 
    {
        $this->_date_naissance = $p_date_naissance;
    }
    public function setDroit($p_droit) 
    {
        $this->_droit = $p_droit;
    }    
    
    /**
     * Méthodes
    */				
    
    /**
     * retourne la liste des aniamux de l'utilisateur
     * @param   $mode : 0 == associatif, 1 == objet
     * @return un tableau de type $mode
    */
    public function animaux($mode) 
    {
        // ouvre une connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // création de la requête
        $strSQL = "SELECT ID AS ID,
                    ID_proprietaire AS ID_proprietaire, 
                    type AS Type, 
                    nom AS Nom, 
                    date_format(date_naissance, '%d/%m/%Y') AS Date_naissance, 
                    genre AS Genre, 
                    complem_info AS Complem_info,
                    vaccine AS Vaccine,
                    puce AS Puce,
                    race AS Race
                    FROM animal 
                    WHERE ID_proprietaire = ? 
                    ORDER BY nom";
        
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($this->getID()),$mode);
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $res;
    }
    
    /**
     * retourne la liste des réservations de l'utilisateur
     * @param   $mode : 0 == associatif, 1 == objet
     * @return un tableau de type $mode
    */
    public function reservations($mode) 
    {
        // ouvre une connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "SELECT ID AS ID, 
                    ID_proprietaire AS ID_proprietaire, 
                    ID_animal AS ID_animal, 
                    date_format(date_debut,'%d/%m/%Y') AS Date_debut, 
                    date_format(date_fin,'%d/%m/%Y') AS Date_fin, 
                    nb_jours_tot AS Nb_jours_tot, 
                    nb_jours_bla AS Nb_jours_bla, 
                    nb_jours_ble AS Nb_jours_ble, 
                    nb_jours_rou AS Nb_jours_rou,
                    prix AS Prix,
                    etat AS Etat
                    FROM reservation
                    WHERE ID_proprietaire = ? 
                    ORDER BY date_debut";
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getRows($strSQL, array($this->getID()),$mode);
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $res;
    }


    /**
     * retourne le nombre des réservations de l'utilisateur
     * @return un entier
    */
    public function nbReservations() 
    {
        // ouvre une connexion pour accéder à la base de données
        $cnx = new PdoDao();

        // requête
        $strSQL = "SELECT COUNT(*) FROM reservation WHERE ID_proprietaire = ?";
        
        // test d'execution
        try 
        {
            // execution de la requête
            $res = $cnx->getValue($strSQL, array($this->getID()));
        }
        catch (PDOException $e) 
        {
            die($e->getMessage());
        }
        return $res;
    }
}
?>