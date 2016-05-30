<?php 

class Tarif
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_date_debut_bla;
    private $_date_fin_bla;
    private $_date_debut_ble;
    private $_date_fin_ble;
    private $_date_debut_rou;
    private $_date_fin_rou;
    private $_prix_jour_bla;
    private $_prix_jour_ble;
    private $_prix_jour_rou;
    private $_saison_debut;
    private $_saison_fin;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_date_debut_bla,
        $p_date_fin_bla,
        $p_date_debut_ble,
        $p_date_fin_ble,
        $p_date_debut_rou,
        $p_date_fin_rou,
        $p_prix_jour_bla,
        $p_prix_jour_ble,
        $p_prix_jour_rou,
        $p_saison_debut,
        $p_saison_fin
    ) 
    {
        $this->setID($p_id);
        $this->setDateDebutBla($p_date_debut_bla);
        $this->setDateFinBla($p_date_fin_bla);
        $this->setDateDebutBle($p_date_debut_ble);
        $this->setDateFinBle($p_date_fin_ble);
        $this->setDateDebutRou($p_date_debut_rou);
        $this->setDateFinRou($p_date_fin_rou);
        $this->setPrixJourBla($p_prix_jour_bla);
        $this->setPrixJourBle($p_prix_jour_ble);
        $this->setPrixJourRou($p_prix_jour_rou);
        $this->setSaisonDebut($p_saison_debut);
        $this->setSaisonFin($p_saison_fin);
    }

    /**
     * Accesseurs en lecture
    */

    public function getID() 
    {
        return $this->_id;
    } 
    public function getDateDebutBla() 
    {
        return $this->_date_debut_bla;
    }
    public function getDateFinBla() 
    {
        return $this->_date_fin_bla;
    }
    public function getDateDebutBle() 
    {
        return $this->_date_debut_ble;
    }
    public function getDateFinBle() 
    {
        return $this->_date_fin_ble;
    } 
    public function getDateDebutRou() 
    {
        return $this->_date_debut_rou;
    }
    public function getDateFinRou() 
    {
        return $this->_date_fin_rou;
    }
    public function getPrixJourBla() 
    {
        return $this->_prix_jour_bla;
    }
    public function getPrixJourBle() 
    {
        return $this->_prix_jour_ble;
    }
    public function getPrixJourRou() 
    {
        return $this->_prix_jour_rou;
    }
    public function getSaisonDebut() 
    {
        return $this->_saison_debut;
    }
    public function getSaisonFin() 
    {
        return $this->_saison_fin;
    }
    

    /**
     * Mutateurs (accesseurs en écriture)
    */
    
    public function setID($p_id) 
    {
        $this->_id = $p_id;
    } 
    public function setDateDebutBla($p_date_debut_bla) 
    {
        $this->_date_debut_bla = $p_date_debut_bla;
    }
    public function setDateFinBla($p_date_fin_bla) 
    {
        $this->_date_fin_bla = $p_date_fin_bla;
    }
    public function setDateDebutBle($p_date_debut_ble) 
    {
        $this->_date_debut_ble = $p_date_debut_ble;
    }
    public function setDateFinBle($p_date_fin_ble) 
    {
        $this->_date_fin_ble = $p_date_fin_ble;
    }
    public function setDateDebutRou($p_date_debut_rou) 
    {
        $this->_date_debut_rou = $p_date_debut_rou;
    }
    public function setDateFinRou($p_date_fin_rou) 
    {
        $this->_date_fin_rou = $p_date_fin_rou;
    }
    public function setPrixJourBla($p_prix_jour_bla) 
    {
        $this->_prix_jour_bla = $p_prix_jour_bla;
    }
    public function setPrixJourBle($p_prix_jour_ble) 
    {
        $this->_prix_jour_ble = $p_prix_jour_ble;
    }
    public function setPrixJourRou($p_prix_jour_rou) 
    {
        $this->_prix_jour_rou = $p_prix_jour_rou;
    }
    public function setSaisonDebut($p_saison_debut) 
    {
        $this->_saison_debut = $p_saison_debut;
    }
    public function setSaisonFin($p_saison_fin) 
    {
        $this->_saison_fin = $p_saison_fin;
    }    
}
?>