<?php 

class Animal
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_id_proprietaire;
    private $_type;
    private $_nom;
    private $_date_naissance;
    private $_genre;
    private $_complem_info;
    private $_vaccine;
    private $_puce;
    private $_race;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_id_proprietaire,
        $p_type,
        $p_nom,
        $p_date_naissance,
        $p_genre,
        $p_complem_info,
        $p_vaccine,
        $p_puce,
        $p_race
    ) 
    {
        $this->setID($p_id);
        $this->setIDProprietaire($p_id_proprietaire);
        $this->setType($p_type);
        $this->setNom($p_nom);
        $this->setDateNaissance($p_date_naissance);
        $this->setGenre($p_genre);
        $this->setComplemInfo($p_complem_info);
        $this->setVaccine($p_vaccine);
        $this->setPuce($p_puce);
        $this->setRace($p_race);
    }

    /**
     * Accesseurs en lecture
    */

    public function getID() 
    {
        return $this->_id;
    } 
    public function getIDProprietaire() 
    {
        return $this->_id_proprietaire;
    }
    public function getType() 
    {
        return $this->_type;
    }
    public function getNom() 
    {
        return $this->_nom;
    }
    public function getDateNaissance() 
    {
        return $this->_date_naissance;
    } 
    public function getGenre() 
    {
        return $this->_genre;
    }
    public function getComplemInfo() 
    {
        return $this->_complem_info;
    }
    public function getVaccine() 
    {
        return $this->_vaccine;
    }
    public function getPuce() 
    {
        return $this->_puce;
    }
    public function getRace() 
    {
        return $this->_race;
    }

    /**
     * Mutateurs (accesseurs en écriture)
    */
    
    public function setID($p_id) 
    {
        $this->_id = $p_id;
    } 
    public function setIDProprietaire($p_id_proprietaire) 
    {
        $this->_id_proprietaire = $p_id_proprietaire;
    }
    public function setType($p_type) 
    {
        $this->_type = $p_type;
    }
    public function setNom($p_nom) 
    {
        $this->_nom = $p_nom;
    }
    public function setDateNaissance($p_date_naissance) 
    {
        $this->_date_naissance = $p_date_naissance;
    }
    public function setGenre($p_genre) 
    {
        $this->_genre = $p_genre;
    }
    public function setComplemInfo($p_complem_info) 
    {
        $this->_complem_info = $p_complem_info;
    }
    public function setVaccine($p_vaccine) 
    {
        $this->_vaccine = $p_vaccine;
    }
    public function setPuce($p_puce) 
    {
        $this->_puce = $p_puce;
    }
    public function setRace($p_race) 
    {
        $this->_race = $p_race;
    }
}
?>