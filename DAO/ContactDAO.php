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
                $contacts[] = new Contact($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['numero_tel']);
            }

            return $contacts;
        } catch (PDOException $e) {
            return [];
        }
    }

    public function createContact(Contact $contact) {
        $nom = $contact->getNom();
        $prenom = $contact->getPrenom();
        $email = $contact->getEmail();
        $numeroTel = $contact->getNumeroTel();

        $query = "INSERT INTO contact (nom, prenom, email, numero_tel) VALUES (:nom, :prenom, :email, :numero_tel)";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":numero_tel", $numeroTel, PDO::PARAM_STR);

        return $stmt->execute();
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
            return new Contact($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['numero_tel']);
        }

        return null;
    }

    
}
