<?php 

namespace App\Model;

class Contact {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $numeroTel;

    public function __construct($id, $nom, $prenom, $email, $numeroTel) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->numeroTel = $numeroTel;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNumeroTel() {
        return $this->numeroTel;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setNumeroTel($numeroTel) {
        $this->numeroTel = $numeroTel;
    }


}
