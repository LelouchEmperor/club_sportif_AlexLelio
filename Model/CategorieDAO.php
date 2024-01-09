<?php

namespace Model;

use PDO;
use PDOException;

class CategorieDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function create(Categorie $categorie) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO categorie (nom, code_raccourci) VALUES (:nom, :code_raccourci)");
            $stmt->bindValue(":nom", $categorie->getNom(), PDO::PARAM_STR);
            $stmt->bindValue(":code_raccourci", $categorie->getCoderaccourci(), PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            throw new PDOException("Erreur de la fonction createCategorie : " . $e->getMessage());
        }
    }
    

    public function update(Categorie $categorie) {
        $id = $categorie->getId();
        $nom = $categorie->getNom();
        $codeRaccourci = $categorie->getCodeRaccourci();

        $query = "UPDATE categorie SET nom=?, code_raccourci=? WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("ssi", $nom, $codeRaccourci, $id);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM categorie WHERE id=?";
        $stmt = $this->connexion->prepare($query);
        $stmt->bind_param("i", $id);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM categorie WHERE id=?";
        $stmt = $this->connexion->prepare($query);
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
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM categorie");
            $categories = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Categorie($row['id'], $row['nom'], $row['code_raccourci']);
            }

            return $categories;
        } catch (PDOException $e) {
            return [];
        }
    }
}
