<?php 

class ContactDAO {
    private $connexion;

    public function __construct(Connexion $connexion) {
        $this->connexion = $connexion;
    }

    public function getAllContacts() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM contact");
            $contacts = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $contacts[] = new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numeroTel']);
            }

            return $contacts;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("INSERT INTO contact (nom, prenom, email, numeroTel) VALUES (?, ?, ?, ?)");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel()]);
            return true;
        } catch (PDOException $e) {
            // Gestion des erreurs d'insertion
            echo $e;
            return false;
        }
    }
    

    public function updateContact(Contact $contact) {
        $id = $contact->getId();
        $nom = $contact->getNom();
        $prenom = $contact->getPrenom();
        $email = $contact->getEmail();
        $numeroTel = $contact->getNumeroTel();

        $query = "UPDATE contact SET nom=:nom, prenom=:prenom, email=:email, numero_tel=:numero_tel WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":numero_tel", $numeroTel, PDO::PARAM_STR);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function deleteContact($contactId) {
        $query = "DELETE FROM contact WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $contactId, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getById($contactId) {
        $query = "SELECT * FROM contact WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $contactId, PDO::PARAM_INT);

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new Contact($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['numeroTel']);
        }

        return null;
    }

    
}
