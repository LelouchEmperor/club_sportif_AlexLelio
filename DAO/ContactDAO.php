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
            echo $e;
            return false;
        }
    }
    

    public function updateContact(Contact $contact) {
        try {
            $stmt = $this->connexion->pdo->prepare("UPDATE contact SET nom = ?, prenom = ?, email = ?, numeroTel = ? WHERE id = ?");
            $stmt->execute([$contact->getNom(), $contact->getPrenom(), $contact->getEmail(), $contact->getNumeroTel(), $contact->getId()]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
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
