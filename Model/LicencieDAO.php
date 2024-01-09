<?php

namespace Model;
use Model\Contact;
use Model\Categorie;
use PDO;
use PDOException;
class LicencieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Licencie $licencie) {
        $nom = $licencie->getNom();
        $prenom = $licencie->getPrenom();
        $numeroLicence = $licencie->getNumeroLicence();
        $contactId = $licencie->getContactId();
        $categorieId = $licencie->getCategorieId();

        $query = "INSERT INTO licencie (nom, prenom, numero_licence, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->connexion
->prepare($query);
        $stmt->bind_param("ssiii", $nom, $prenom, $numeroLicence, $contactId, $categorieId);

        return $stmt->execute();
    }

    public function update(Licencie $licencie) {
        $id = $licencie->getId();
        $nom = $licencie->getNom();
        $prenom = $licencie->getPrenom();
        $numeroLicence = $licencie->getNumeroLicence();
        $contactId = $licencie->getContactId();
        $categorieId = $licencie->getCategorieId();

        $query = "UPDATE licencie SET nom=?, prenom=?, numero_licence=?, contact_id=?, categorie_id=? WHERE id=?";
        $stmt = $this->connexion
->prepare($query);
        $stmt->bind_param("ssiiii", $nom, $prenom, $numeroLicence, $contactId, $categorieId, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM licencie WHERE id=?";
        $stmt = $this->connexion
->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM licencie WHERE id=?";
        $stmt = $this->connexion
->prepare($query);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Licencie($row['id'], $row['nom'], $row['prenom'], $row['numero_licence'], $row['contact_id'], $row['categorie_id']);
        }

        return null;
    }


        public function getAll() {
            try {
                $stmt = $this->connexion->pdo->query("SELECT * FROM licencie");
                $licencies = [];
        
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $licencies[] = new Licencie($row['id'], $row['nom'], $row['prenom'], $row['numero_licence']);
                }
        
                return $licencies;
            } catch (PDOException $e) {
                return [];
            }
        }
        
}
