<?php 

class Tarif
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_tarif_jour_chien;
    private $_tarif_jour_chat;
    private $_debut_periode;
    private $_fin_periode;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_tarif_jour_chien,
        $p_tarif_jour_chat,
        $p_debut_periode,
        $p_fin_periode
    ) 
    {
        $this->setID($p_id);
        $this->setTarifJourChien($p_tarif_jour_chien);
        $this->setTarifJourChat($p_tarif_jour_chat);
        $this->setDebutPeriode($p_debut_periode);
        $this->setFinPeriode($p_fin_periode);
    }

    /**
     * Accesseurs en lecture
    */

    public function getID() 
    {
        return $this->_id;
    } 
    public function getTarifJourChien() 
    {
        return $this->_tarif_jour_chien;
    }
    public function getTarifJourChat() 
    {
        return $this->_tarif_jour_chat;
    }
    public function getDebutPeriode() 
    {
        return $this->_debut_periode;
    }
    public function getFinPeriode() 
    {
        return $this->_fin_periode;
    } 
    

    /**
     * Mutateurs (accesseurs en écriture)
    */
    
    public function setID($p_id) 
    {
        $this->_id = $p_id;
    } 
    public function setTarifJourChien($p_tarif_jour_chien) 
    {
        $this->_tarif_jour_chien = $p_tarif_jour_chien;
    }
    public function setTarifJourChat($p_tarif_jour_chat) 
    {
        $this->_tarif_jour_chat = $p_tarif_jour_chat;
    }
    public function setDebutPeriode($p_debut_periode) 
    {
        $this->_debut_periode = $p_debut_periode;
    }
    public function setFinPeriode($p_fin_periode) 
    {
        $this->_fin_periode = $p_fin_periode;
    }
}
?>