<?php

namespace Controller;

use Model\CategorieDAO;
use Model\Categorie;

include_once('Model/CategorieDAO.php');
include_once('Model/Categorie.php');

class CategorieController {
    private $categorieDAO;

    public function __construct($db) {
        $this->categorieDAO = new CategorieDAO($db);
    }

    public function createCategorie($nom, $codeRaccourci) {
        // Utiliser le DAO pour créer une nouvelle catégorie
        $categorie = new Categorie(null, $nom, $codeRaccourci);
        $this->categorieDAO->create($categorie);
    }

    public function updateCategorie($id, $nom, $codeRaccourci) {
        // Mettre à jour une catégorie existante
        $categorie = $this->categorieDAO->getById($id);
        $categorie->setNom($nom);
        $categorie->setCodeRaccourci($codeRaccourci);
        $this->categorieDAO->update($categorie);
    }

    public function deleteCategorie($id) {
        // Supprimer une catégorie
        $this->categorieDAO->delete($id);
    }

    public function listCategorie() {
        $categories = $this->categorieDAO->getAll();
        echo $twig->render('view/Categorie/listCategorie.php', ['categories' => $categories]);
        include('view/Categorie/listCategorie.php');
    }

    public function displayFormUpdate(){
        // Afficher le formulaire de mise à jour d'une catégorie
        $categorie = $this->categorieDAO->getById($_GET['id']);
        include('view/Categorie/updateCategorie.php');
    }

    public function displayFormCreate(){
        // Afficher le formulaire de création d'une catégorie
        include('view/Categorie/createCategorie.php');
    }

    public function displayList(){
        // Afficher la liste des catégories
        $categories = $this->categorieDAO->getAll();
        include('view/Categorie/listCategorie.php');
    }
}
