<?php

namespace Controller;

use Model\EducateurDAO;
use Model\Educateur;
use Twig\Environment;

require_once('Model/EducateurDAO.php');

class EducateurController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
    }

    public function createEducateur($nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin) {
        // Créer un nouvel éducateur
        $educateur = new Educateur(null, $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin);
        $this->educateurDAO->create($educateur);
    }

    public function updateEducateur($id, $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin) {
        // Mettre à jour un éducateur existant
        $educateur = $this->educateurDAO->getById($id);
        $educateur->setNom($nom);
        $educateur->setPrenom($prenom);
        $educateur->setEmail($email);
        $educateur->setNumeroTel($numeroTel);
        $educateur->setMotDePasse($motDePasse);
        $educateur->setIsAdmin($isAdmin);
        $this->educateurDAO->update($educateur);
    }

    public function deleteEducateur($id) {
        // Supprimer un éducateur
        $this->educateurDAO->delete($id);
    }

    public function listEducateur() {
        // Afficher la liste des éducateurs
        $educateurs = $this->educateurDAO->getAll();
        // Appeler une vue pour afficher les éducateurs
        include('view/Educateur/listEducateur.php');
    }

    public function displayFormUpdate(){
        // Afficher le formulaire de mise à jour d'un éducateur
        $educateur = $this->educateurDAO->getById($_GET['id']);
        include('view/Educateur/updateEducateur.php');
    }

    public function displayFormCreate(){
        // Afficher le formulaire de création d'un éducateur
        include('view/Educateur/createEducateur.php');
    }

    public function displayList(){
        // Afficher la liste des éducateurs
        $educateurs = $this->educateurDAO->getAll();
        include('view/Educateur/listEducateur.php');
    }
    
}
