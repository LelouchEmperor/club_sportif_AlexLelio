<?php

class Educateur
{
    private $id;
    private $licencieID;
    private $email;
    private $motDePasse;
    private $estAdmin;

    public function __construct($id, $licencieID, $email, $motDePasse, $estAdmin)
    {
        $this->id = $id;
        $this->licencieID = $licencieID;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->estAdmin = $estAdmin;
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

    public function getEstAdmin()
    {
        return $this->estAdmin;
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

    public function setEstAdmin($estAdmin)
    {
        $this->estAdmin = $estAdmin;
    }
}
?>