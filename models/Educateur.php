<?php

class Educateur
{
    private $id;
    private $licencie_id;
    private $email;
    private $motDePasse;
    private $estAdmin;

    public function __construct($id, $licencie_id, $email, $motDePasse, $estAdmin)
    {
        $this->id = $id;
        $this->licencie_id = $licencie_id;
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
        return $this->licencie_id;
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
    public function setLicencieID($licencie_id)
    {
        $this->licencie_id = $licencie_id;
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