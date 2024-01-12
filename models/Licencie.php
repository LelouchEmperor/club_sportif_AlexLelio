<?php

class Licencie
{
    private $id;
    private $nom;
    private $num;
    private $prenom;
    private $categorie_id;
    private $contact_id;


    public function __construct($id, $num, $nom, $prenom, $categorie_id, $contact_id)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->num = $num;
        $this->prenom = $prenom;
        $this->categorie_id = $categorie_id;
        $this->contact_id = $contact_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNumeroLicence()
    {
        return $this->num;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getContactID()
    {
        return $this->contact_id;
    }

    public function getCategorieID()
    {
        return $this->categorie_id;
    }

    public function setNumeroLicence($numeroLicence)
    {
        $this->num = $numeroLicence;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setContactID($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    public function setCategorieID($categorie_id)
    {
        $this->categorie_id = $categorie_id;
    }
}
?>