<?php

namespace Model;

class Educateur
{
    private $id;
    private $licencieID;
    private $email;
    private $motDePasse;
    private $estAdministrateur;

    public function __construct($id, $licencieID, $email, $motDePasse, $estAdministrateur)
    {
        $this->id = $id;
        $this->licencieID = $licencieID;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->estAdministrateur = $estAdministrateur;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLicencieID()
    {
        return $this->licencieID;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function getEstAdministrateur()
    {
        return $this->estAdministrateur;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setLicencieID($licencieID)
    {
        $this->licencieID = $licencieID;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function setEstAdministrateur($estAdministrateur)
    {
        $this->estAdministrateur = $estAdministrateur;
    }
}
?>