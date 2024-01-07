<?php

namespace App\Model;

class Educateur {
    private $id = 0;
    private $email = "";
    private $motDePasse = "";
    private $isAdmin = false;
    private $licencie; // Objet de type Licencie

    public function __construct($id, $email, $motDePasse, $isAdmin, Licencie $licencie) {
        $this->id = $id;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->isAdmin = $isAdmin;
        $this->licencie = $licencie;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getIsAdmin() {
        return $this->isAdmin;
    }

    public function getLicencie() {
        return $this->licencie;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function setIsAdmin($isAdmin) {
        $this->isAdmin = $isAdmin;
    }

    public function setLicencie(Licencie $licencie) {
        $this->licencie = $licencie;
    }

    
}
