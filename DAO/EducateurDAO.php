<?php

class EducateurDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function getAllEducateurs() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM educateur");
            $educateurs = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $lic = new LicencieDAO(new Connexion);
                $licencie = $lic->getById($row['licencie_id']);
                $cat = new CategorieDAO(new Connexion);
                $categorie = $cat->getById($licencie->getCategorieID());

                $cont = new ContactDAO(new Connexion);
                $contact = $cont->getById($licencie->getContactID());

                $educ = new Educateur($row['id'], $row['licencie_id'],$row['email'], $row['motDePasse'], $row['estAdmin']);

                $educateurs[] = [
                    'educ' => $educ,
                    'contact' => $contact,
                    'licencie' => $licencie,
                    'categorie' => $categorie,
                ];
            }
            return $educateurs;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createEducateur(Educateur $educateur) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO educateur (licencie_id, email, motDePasse, estAdmin) VALUES (?, ?, ?, ?)");
            $stmt->execute([$educateur->getLicencieID(), $educateur->getEmail(), $educateur->getMotDePasse(), $educateur->getEstAdmin()]);
            return true;
        } catch (PDOException $e) {
            echo $e;
            return false;
        }
    }

    public function updateEducateur(Educateur $educateur) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE educateur SET licencieID = ?, email = ?, estAdmin = ? WHERE id = ?");
            $stmt->execute([$educateur->getLicencieID(), $educateur->getEmail(), $educateur->getEstAdmin() ,$educateur->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
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
            return new Educateur($row['id'], $row['licencieID'],$row['email'], $row['mot_de_passe'], $row['estAdmin']);
        }

        return null;
    }


    public function getByEmail($email) {
        $query = "SELECT * FROM educateur WHERE email=:email";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return null;
    }
}
