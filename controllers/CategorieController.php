<?php

class CategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function display() {
        // Afficher la liste des catégories
        $categories = $this->categorieDAO->getAllCategories();
        include('view/Categorie/listCategorie.php');
    }

    public function createCategorie() {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $code = $_POST['codeRaccourci'];

            // validation des données récupérées, cela ne doit pas être des chiffres
            if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
                $nameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $code)) {
                $codeErr = "Seuls les lettres et les espaces sont autorisés";
            }

            // pas de chaine vide autorisée
            if (empty($nom) && empty($code)) {
                $nameErr = "Le nom et le code de la catégorie sont requis";
            }

            $newCategorie = new Categorie(0, $nom, $code);

            if ($this->categorieDAO->createCategorie($newCategorie)) {
                $path = "index.php?page=categorie&action=display";
                header('Location:'. $path);
                exit();
            } else {
                echo "Probleme rencontré lors de la création de la catégorie";
            }
        }
        include('view/Categorie/createCategorie.php');
    }



    public function updateCategorie($categorieId) {

        $categorie = $this->categorieDAO->getById($categorieId);

        if (!$categorie) {
            echo "Aucun contact n'a été trouvée avec l'identifiant $categorieId";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom_categorie'];
            $code = $_POST['code_categorie'];

            // validation des données récupérées, cela ne doit pas être des chiffres
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $code)) {
                $codeErr = "Seuls les lettres et les espaces sont autorisés";
            }

            // pas de chaine vide autorisée
            if (empty($name) && empty($code)) {
                $nameErr = "Le nom et le code de la catégorie sont requis";
            }

            // Mise a jour des données pour ceux du formulaire
            $categorie->setName($nom);
            $categorie->setCode($code);

            if ($this->categorieDAO->updateCategorie($categorie)) {
                header('Location:index.php?page=listCategorie&action=index');
                exit();
            } else {
                echo "Probleme rencontré lors de la modification de la catégorie";
            }
        }
        include('view/Categorie/updateCategorie.php');
    }


    public function deleteCategorie($categorieId) {
        $categorie = $this->categorieDAO->getById($categorieId);

        if (!$categorie) {
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->categorieDAO->deleteCategorie($categorieId)) {
                $path = "index.php?page=listCategorie&action=index";
                header('Location:'. $path);
                exit();
            } else {
                echo "Probleme rencontré lors de la suppression de la catégorie";
            }
        }
    }
    
}
