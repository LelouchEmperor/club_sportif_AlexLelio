<?php

namespace App\Model;

use App\Model\Contact;
use App\Model\Categorie;

class LicencieDAO {
    private $db;  // La connexion à la base de données

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Licencie $licencie) {
        $nom = $licencie->getNom();
        $prenom = $licencie->getPrenom();
        $numeroLicence = $licencie->getNumeroLicence();
        $contactId = $licencie->getContactId();
        $categorieId = $licencie->getCategorieId();

        $query = "INSERT INTO licencie (nom, prenom, numero_licence, contact_id, categorie_id) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
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
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssiiii", $nom, $prenom, $numeroLicence, $contactId, $categorieId, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM licencie WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM licencie WHERE id=?";
        $stmt = $this->db->prepare($query);
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
        $query = "SELECT * FROM licencie";
        $result = $this->db->query($query);

        $licencies = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $licencies[] = new Licencie($row['id'], $row['nom'], $row['prenom'], $row['numero_licence'], $row['contact_id'], $row['categorie_id']);
            }
        }

        return $licencies;
    }
}
