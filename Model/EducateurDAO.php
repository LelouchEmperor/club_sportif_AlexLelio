<?php

namespace Model;

use Model\Educateur;
use PDO;
use PDOException;

class EducateurDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Educateur $educateur) {
        $nom = $educateur->getNom();
        $prenom = $educateur->getPrenom();
        $email = $educateur->getEmail();
        $numeroTel = $educateur->getNumeroTel();
        $motDePasse = $educateur->getMotDePasse();
        $isAdmin = $educateur->getIsAdmin();

        $query = "INSERT INTO educateur (nom, prenom, email, numero_tel, mot_de_passe, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("sssssi", $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin);

        return $stmt->execute();
    }

    public function update(Educateur $educateur) {
        $id = $educateur->getId();
        $nom = $educateur->getNom();
        $prenom = $educateur->getPrenom();
        $email = $educateur->getEmail();
        $numeroTel = $educateur->getNumeroTel();
        $motDePasse = $educateur->getMotDePasse();
        $isAdmin = $educateur->getIsAdmin();

        $query = "UPDATE educateur SET nom=?, prenom=?, email=?, numero_tel=?, mot_de_passe=?, is_admin=? WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("sssssi", $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM educateur WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM educateur WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Educateur($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel'], $row['mot_de_passe'], $row['is_admin']);
        }

        return null;
    }

    public function getAll() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM educateur");
            $educateurs = [];
    
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $educateurs[] = new Educateur($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel'], $row['mot_de_passe'], $row['is_admin']);
            }
    
            return $educateurs;
        } catch (PDOException $e) {
            return [];
        }
    }
    
    public function getByEmail($email) {
        $query = "SELECT * FROM educateur WHERE email=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("s", $email);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Educateur($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['mot_de_passe'], $row['is_admin']);        }

        return null;
    }
}
