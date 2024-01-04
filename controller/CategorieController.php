<?php

class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function create($nom, $codeRaccourci) {
        // Créer une nouvelle catégorie
        $categorie = new Categorie(null, $nom, $codeRaccourci);
        $this->categorieDAO->create($categorie);
    }

    public function update($id, $nom, $codeRaccourci) {
        // Mettre à jour une catégorie existante
        $categorie = $this->categorieDAO->getById($id);
        $categorie->setNom($nom);
        $categorie->setCodeRaccourci($codeRaccourci);
        $this->categorieDAO->update($categorie);
    }

    public function delete($id) {
        // Supprimer une catégorie
        $this->categorieDAO->delete($id);
    }

    public function list() {
        // Afficher la liste des catégories
        $categories = $this->categorieDAO->getAll();
        // Appeler une vue pour afficher les catégories
        include('view/liste_categories.php');
    }
}
