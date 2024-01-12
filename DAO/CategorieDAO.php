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
                $categories[] = new Categorie($row['id'],$row['nom'], $row['codeRaccourci']);
            }
            return $categories;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function createCategorie(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie (nom, codeRaccourci) VALUES (?, ?)");
            $stmt->execute([$categorie->getNom(), $categorie->getCodeRaccourci()]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function updateCategorie(Categorie $categorie) {
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $codeRaccourci = $categorie->getCodeRaccourci();


        // requete preparee pour la mise a jour de la categorie
        $query = "UPDATE categorie SET nom=:nom, codeRaccourci=:codeRaccourci WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":codeRaccourci", $codeRaccourci, PDO::PARAM_STR);
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
            return new Categorie($result['id'], $result['nom'], $result['codeRaccourci']);
        }

        return null;
    }

 
}
