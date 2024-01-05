<?php 

namespace App\Model;

class Licencie {
    private $id;
    private $numeroLicence;
    private $nom;
    private $prenom;
    private $contact; // Objet de type Contact

    public function __construct($id, $numeroLicence, $nom, $prenom, Contact $contact) {
        $this->id = $id;
        $this->numeroLicence = $numeroLicence;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->contact = $contact;
    }

    public function getId() {
        return $this->id;
    }

    public function getNumeroLicence() {
        return $this->numeroLicence;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setNumeroLicence($numeroLicence) {
        $this->numeroLicence = $numeroLicence;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setContact(Contact $contact) {
        $this->contact = $contact;
    }

}
