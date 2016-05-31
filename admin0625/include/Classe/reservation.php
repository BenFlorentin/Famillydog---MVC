<?php 

class Reservation
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_id_proprietaire;
    private $_id_animal;
    private $_date_debut;
    private $_date_fin;
    private $_nb_jours_tot;
    private $_nb_jours_bla;
    private $_nb_jours_ble;
    private $_nb_jours_rou;
    private $_prix;
    private $_etat;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_id_proprietaire,
        $p_id_animal,
        $p_date_debut,
        $p_date_fin,
        $p_nb_jours_tot,
        $p_nb_jours_bla,
        $p_nb_jours_ble,
        $p_nb_jours_rou,
        $p_prix,
        $p_etat
    ) 
    {
        $this->setID($p_id);
        $this->setIDProprietaire($p_id_proprietaire);
        $this->setIDAnimal($p_id_animal);
        $this->setDateDebut($p_date_debut);
        $this->setDateFin($p_date_fin);
        $this->setNbJoursTot($p_nb_jours_tot);
        $this->setNbJoursBla($p_nb_jours_bla);
        $this->setNbJoursBle($p_nb_jours_ble);
        $this->setNbJoursRou($p_nb_jours_rou);
        $this->setPrix($p_prix);
        $this->setEtat($p_etat);
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
    public function getIDAnimal() 
    {
        return $this->_id_animal;
    }
    public function getDateDebut() 
    {
        return $this->_date_debut;
    }
    public function getDateFin() 
    {
        return $this->_date_fin;
    } 
    public function getNbJoursTot() 
    {
        return $this->_nb_jours_tot;
    }
    public function getNbJoursBla() 
    {
        return $this->_nb_jours_bla;
    }
    public function getNbJoursBle() 
    {
        return $this->_nb_jours_ble;
    }
    public function getNbJoursRou() 
    {
        return $this->_nb_jours_rou;
    }
    public function getPrix() 
    {
        return $this->_prix;
    }
    public function getEtat() 
    {
        return $this->_etat;
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
    public function setIDAnimal($p_id_animal) 
    {
        $this->_id_animal = $p_id_animal;
    }
    public function setDateDebut($p_date_debut) 
    {
        $this->_date_debut = $p_date_debut;
    }
    public function setDateFin($p_date_fin) 
    {
        $this->_date_fin = $p_date_fin;
    }
    public function setNbJoursTot($p_nb_jours_tot) 
    {
        $this->_nb_jours_tot = $p_nb_jours_tot;
    }
    public function setNbJoursBla($p_nb_jours_bla) 
    {
        $this->_nb_jours_bla = $p_nb_jours_bla;
    }
    public function setNbJoursBle($p_nb_jours_ble) 
    {
        $this->_nb_jours_ble = $p_nb_jours_ble;
    }
    public function setNbJoursRou($p_nb_jours_rou) 
    {
        $this->_nb_jours_rou = $p_nb_jours_rou;
    }
    public function setPrix($p_prix) 
    {
        $this->_prix = $p_prix;
    }
    public function setEtat($p_etat) 
    {
        $this->_etat = $p_etat;
    }

    /**
     * Méthodes
    */              
    
    
}
?>