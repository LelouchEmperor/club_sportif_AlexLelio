<?php

namespace App\Model;

class Educateur {
    private $id;
    private $email;
    private $motDePasse;
    private $estAdministrateur;
    private $licencie; // Objet de type Licencie

    public function __construct($id, $email, $motDePasse, $estAdministrateur, Licencie $licencie) {
        $this->id = $id;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
        $this->estAdministrateur = $estAdministrateur;
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

    public function getEstAdministrateur() {
        return $this->estAdministrateur;
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

    public function setEstAdministrateur($estAdministrateur) {
        $this->estAdministrateur = $estAdministrateur;
    }

    public function setLicencie(Licencie $licencie) {
        $this->licencie = $licencie;
    }

    
}
