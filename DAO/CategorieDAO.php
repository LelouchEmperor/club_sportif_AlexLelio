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
   
    public function getLicenciesByCategorie($categorieId) {
        $query = "SELECT * FROM licencie WHERE categorie_id = :categorieId";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":categorieId", $categorieId, PDO::PARAM_INT);
    
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $licencies = [];
    
        foreach ($results as $result) {
            $licencies[] = new Licencie(
                $result['id'],
                $result['numLicence'],
                $result['nom'],
                $result['prenom'],
                $result['categorie_id'],
                $result['contact_id']
            );
        }
    
        return $licencies;
    }
    public function getContactsByCategorie($categorieId) {
        $query = "SELECT * FROM contact WHERE id = :categorieId";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":categorieId", $categorieId, PDO::PARAM_INT);
    
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $contacts = [];
    
        foreach ($results as $result) {
            $contacts[] = new Contact(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['numeroTel']
            );
        }
    
        return $contacts;
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
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE categorie SET nom = ?, codeRaccourci = ? WHERE id = ?");
            $stmt->execute([$categorie->getNom(), $categorie->getCodeRaccourci(), $categorie->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        } 
    }

    public function deleteCategorie($id) {
        try {
            $query = "DELETE FROM categorie WHERE id = ?";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$id]);

            $updateLicencies = "UPDATE licencie SET categorie_id = '' WHERE categorie_id = :id";
            $stmtUpdateLicencies = $this->pdo->prepare($updateLicencies);
            $stmtUpdateLicencies->bindParam(':id', $id);
            $stmtUpdateLicencies->execute();
            return true;
        } catch (PDOException $e) {

            return false;
        }
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
