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

        $query = "INSERT INTO educateur (nom, prenom, email, numero_tel, mot_de_passe, is_admin) VALUES (:nom, :prenom, :email, :numero_tel, :mot_de_passe, :is_admin)";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":numero_tel", $numeroTel, PDO::PARAM_STR);
        $stmt->bindValue(":mot_de_passe", $motDePasse, PDO::PARAM_STR);
        $stmt->bindValue(":is_admin", $isAdmin, PDO::PARAM_INT);

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

        $query = "UPDATE educateur SET nom=:nom, prenom=:prenom, email=:email, numero_tel=:numero_tel, mot_de_passe=:mot_de_passe, is_admin=:is_admin WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":numero_tel", $numeroTel, PDO::PARAM_STR);
        $stmt->bindValue(":mot_de_passe", $motDePasse, PDO::PARAM_STR);
        $stmt->bindValue(":is_admin", $isAdmin, PDO::PARAM_INT);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM educateur WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getById($id) {
        $query = "SELECT * FROM educateur WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Educateur($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['numero_tel'], $result['mot_de_passe'], $result['is_admin']);
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
        $query = "SELECT * FROM educateur WHERE email=:email";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Educateur($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['mot_de_passe'], $result['is_admin']);
        }

        return null;
    }
}
