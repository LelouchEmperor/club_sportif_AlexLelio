<?php

class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function createLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO licencie (numeroLicence, nom, prenom, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$licencie->getNumeroLicence(),$licencie->getNom(), $licencie->getPrenom(), $licencie->getContactID(), $licencie->getCategorieID()]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function updateLicencie(Licencie $licencie) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE licencie SET numeroLicence = ?, nom = ?, prenom = ?, contact_id = ?, categorie_id = ? WHERE id = ?");
            $stmt->execute([$licencie->getNumeroLicence(),$licencie->getNom(), $licencie->getPrenom(), $licencie->getContactID(), $licencie->getCategorieID(), $licencie->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteLicencie($licencieId) {
        try {
            $stmt = $this->connexion->pdo->prepare("DELETE FROM licencie WHERE id = ?");
            $stmt->execute([$licencieId]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getById($id) {
        try {
            $stmt = $this->connexion->pdo->prepare("SELECT * FROM licencie WHERE id = ?");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                return new Licencie($row['id'], $row['numLicence'], $row['nom'], $row['prenom'], $row['contact_id'], $row['categorie_id']);
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            return null;
        }
    }

    public function getAllLicencies() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencie");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $licencies[] = new Licencie($row['id'], $row['numeroLicence'],$row['nom'], $row['prenom'], $row['categorie_id'], $row['contact_id']);
            }

            return $licencies;
        } catch (PDOException $e) {
            return [];
        }
}


    public function getAllLicencieBis() {
        
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencie WHERE id NOT IN (SELECT id FROM educateur)");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $licencies[] = new Licencie($row['id'], $row['numeroLicence'],$row['nom'], $row['prenom'], $row['categorie_id'], $row['contact_id']);
            }

            return $licencies;
        } catch (PDOException $e) {
            return [];
        }

}
}