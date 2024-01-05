<?php

namespace App\Model;
use App\Model\Categorie;


class CategorieDAO {
    private $db;  // La connexion à la base de données

    public function __construct($db) {
        $this->db = $db;
    }

    public function create(Categorie $categorie) {
        $nom = $categorie->getNom();
        $codeRaccourci = $categorie->getCodeRaccourci();

        $query = "INSERT INTO categories (nom, code_raccourci) VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $nom, $codeRaccourci);

        return $stmt->execute();
    }

    public function update(Categorie $categorie) {
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $codeRaccourci = $categorie->getCodeRaccourci();

        $query = "UPDATE categories SET nom=?, code_raccourci=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssi", $nom, $codeRaccourci, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM categories WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM categories WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id);

        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
        }

        return null;
    }

    public function getAll() {
        $query = "SELECT * FROM categories";
        $result = $this->db->query($query);

        $categories = array();

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            }
        }

        return $categories;
    }
}
