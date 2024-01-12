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
                $licencie = $lic->getById($row['licencieID']);
                $cat = new CategorieDAO(new Connexion);
                $categorie = $cat->getById($licencie->getCategorieID());

                $cont = new ContactDAO(new Connexion);
                $contact = $cont->getById($licencie->getContactID());

                $educ = new Educateur($row['id'], $row['licencieID'],$row['email'], $row['mot_de_passe'], $row['est_admin']);

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

    public function createEducateur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $licencieId = strtoupper(uniqid($_POST['email'], false));
            
            $email = $_POST['email'];
            $password = password_hash($_POST['email'], PASSWORD_DEFAULT);
            $admin = ($_POST['admin'] == 'Oui') ? true : false ;

            // Valider les données du formulaire 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format d'email invalide";
            }

            // Pas de chaine vide autorisée
            if (empty($email)) {
                $emailErr = "L'email est requis";
            }
            $newEducateur = new Educateur(0, $licencieId ,$email ,$password, $admin);
            if ($this->educateurDAO->addEducateur($newEducateur)) {
                header('Location:index.php?page=educateur&action=display');
                exit();
            } else {
                echo "Problème rencontré lors de l'ajout de l'éducateur";
            }
        }

        // Inclure la vue pour afficher le formulaire d'ajout de contact
        include('view/Educateur/createEducateur.php');
    }

    public function updateEducateur($educateurId) {
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
