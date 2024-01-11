<?php

class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }


    public function getAllCategories() {
        
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM categorie");
            $categories = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Categorie($row['id'],$row['nom'], $row['code_raccourci']);
            }
            return $categories;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function createCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie (nom, code_raccourci) VALUES (:nom, :code_raccourci)");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":code_raccourci", $categorie->getCodeRaccourci(), PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur de la fonction createCategorie : " . $e->getMessage());
        }
    }

    public function updateCategorie(Categorie $categorie) {
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $codeRaccourci = $categorie->getCodeRaccourci();


        // requete preparee pour la mise a jour de la categorie
        $query = "UPDATE categorie SET nom=:nom, code_raccourci=:code_raccourci WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":code_raccourci", $codeRaccourci, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteCategorie($id) {
        // requete preparee pour la suppression de la categorie
        $query = "DELETE FROM categorie WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM categorie WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Categorie($result['id'], $result['nom'], $result['code_raccourci']);
        }

        return null;
    }

 
}
