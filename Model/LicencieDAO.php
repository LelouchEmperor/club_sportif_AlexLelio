<?php

namespace Model;

use Model\Connexion;
use Model\Licencie;
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

        $query = "INSERT INTO licencie (nom, prenom, numero_licence, contact_id, categorie_id) VALUES (:nom, :prenom, :numero_licence, :contact_id, :categorie_id)";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":numero_licence", $numeroLicence, PDO::PARAM_STR);
        $stmt->bindValue(":contact_id", $contactId, PDO::PARAM_INT);
        $stmt->bindValue(":categorie_id", $categorieId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(Licencie $licencie) {
        $id = $licencie->getId();
        $nom = $licencie->getNom();
        $prenom = $licencie->getPrenom();
        $numeroLicence = $licencie->getNumeroLicence();
        $contactId = $licencie->getContactId();
        $categorieId = $licencie->getCategorieId();

        $query = "UPDATE licencie SET nom=:nom, prenom=:prenom, numero_licence=:numero_licence, contact_id=:contact_id, categorie_id=:categorie_id WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":numero_licence", $numeroLicence, PDO::PARAM_STR);
        $stmt->bindValue(":contact_id", $contactId, PDO::PARAM_INT);
        $stmt->bindValue(":categorie_id", $categorieId, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM licencie WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM licencie WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Licencie($result['id'], $result['nom'], $result['prenom'], $result['numero_licence'], $result['contact_id'], $result['categorie_id']);
        }

        return null;
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM licencie");
            $licencies = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $licencies[] = new Licencie($row['id'], $row['nom'], $row['prenom'], $row['numero_licence'], $row['contact_id'], $row['categorie_id']);
            }

            return $licencies;
        } catch (PDOException $e) {
            return [];
        }
    }
}
