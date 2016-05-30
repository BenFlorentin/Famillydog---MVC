<?php 

class Message
{
    /**
     * attributs privés
    */				    
    private $_id;
    private $_nom;
    private $_prenom;
    private $_email;
    private $_sujet;
    private $_message;
    private $_tel;
    private $_etat;
    private $_date;
    
    /**
     * Constructeur 
    */				
    public function __construct
    (
        $p_id,
        $p_nom,
        $p_prenom,
        $p_email,
        $p_sujet,
        $p_message,
        $p_tel,
        $p_etat,
        $p_date
    ) 
    {
        $this->setID($p_id);
        $this->setNom($p_nom);
        $this->setPrenom($p_prenom);
        $this->setEmail($p_email);
        $this->setSujet($p_sujet);
        $this->setMessage($p_message);
        $this->setTel($p_tel);
        $this->setEtat($p_etat);
        $this->setDate($p_date);
    }

    /**
     * Accesseurs en lecture
    */

    public function getID() 
    {
        return $this->_id;
    } 
    public function getNom() 
    {
        return $this->_nom;
    }
    public function getPrenom() 
    {
        return $this->_prenom;
    }
    public function getEmail() 
    {
        return $this->_email;
    }
    public function getSujet() 
    {
        return $this->_sujet;
    } 
    public function getMessage() 
    {
        return $this->_message;
    }
    public function getTel() 
    {
        return $this->_tel;
    }
    public function getEtat() 
    {
        return $this->_etat;
    }
    public function getDate() 
    {
        return $this->_date;
    }

    /**
     * Mutateurs (accesseurs en écriture)
    */
    
    public function setID($p_id) 
    {
        $this->_id = $p_id;
    } 
    public function setNom($p_nom) 
    {
        $this->_nom = $p_nom;
    }
    public function setPrenom($p_prenom) 
    {
        $this->_prenom = $p_prenom;
    }
    public function setEmail($p_email) 
    {
        $this->_email = $p_email;
    }
    public function setSujet($p_sujet) 
    {
        $this->_sujet = $p_sujet;
    }
    public function setMessage($p_message) 
    {
        $this->_message = $p_message;
    }
    public function setTel($p_tel) 
    {
        $this->_tel = $p_tel;
    }
    public function setEtat($p_etat) 
    {
        $this->_etat = $p_etat;
    }
    public function setDate($p_date) 
    {
        $this->_date = $p_date;
    }

    /**
     * Méthodes
    */       
}
?>