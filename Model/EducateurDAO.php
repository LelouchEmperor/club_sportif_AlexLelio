<?php

namespace App\Model;

use App\Model\Educateur;

class EducateurDAO {
    private $db;  // La connexion à la base de données

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Educateur $educateur) {
        $nom = $educateur->getNom();
        $prenom = $educateur->getPrenom();
        $email = $educateur->getEmail();
        $numeroTel = $educateur->getNumeroTel();
        $motDePasse = $educateur->getMotDePasse();
        $isAdmin = $educateur->getIsAdmin();

        $query = "INSERT INTO educateur (nom, prenom, email, numero_tel, mot_de_passe, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
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
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("sssssi", $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM educateur WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM educateur WHERE id=?";
        $stmt = $this->db->prepare($query);
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
        $query = "SELECT * FROM educateur";
        $result = $this->db->query($query);

        $educateurs = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $educateurs[] = new Educateur($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel'], $row['mot_de_passe'], $row['is_admin']);
            }
        }

        return $educateurs;
    }
}
