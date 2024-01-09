<?php

namespace Model;
use Model\Contact;

use PDO;
use PDOException;

include_once("Model/Contact.php");


class ContactDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Contact $contact) {
        $nom = $contact->getNom();
        $prenom = $contact->getPrenom();
        $email = $contact->getEmail();
        $numeroTel = $contact->getNumeroTel();

        $query = "INSERT INTO contact (nom, prenom, email, numero_tel) VALUES (?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("ssss", $nom, $prenom, $email, $numeroTel);

        return $stmt->execute();
    }

    public function update(Contact $contact) {
        $id = $contact->getId();
        $nom = $contact->getNom();
        $prenom = $contact->getPrenom();
        $email = $contact->getEmail();
        $numeroTel = $contact->getNumeroTel();

        $query = "UPDATE contact SET nom=?, prenom=?, email=?, numero_tel=? WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("ssssi", $nom, $prenom, $email, $numeroTel, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM contact WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM contact WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
        }

        return null;
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM contact");
            $contacts = [];
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            }
    
            return $contacts;
        } catch (PDOException $e) {
            return [];
        }
    }
    
}
