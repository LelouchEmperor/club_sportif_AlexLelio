<?php
namespace App\Controller;

use App\Model\CategorieDAO;
use App\Model\Categorie;
use Twig\Environment;

class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function createCategorie($nom, $codeRaccourci) {
        // Créer une nouvelle catégorie
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
        // Afficher la liste des catégories
        $categories = $this->categorieDAO->getAll();
        // Appeler une vue pour afficher les catégories
        include('view/Categorie/listCategorie.html.twig');
    }
}
