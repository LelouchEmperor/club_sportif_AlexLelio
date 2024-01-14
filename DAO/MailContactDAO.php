<?php
require_once('models/MailEdu.php');

class MailContactDAO {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAllMails() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM mailcontact");
            $mails = [];

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $mailEdu = new MailEdu($row['id'], $row['date_envoi'], $row['objet'], $row['message'], $row['destinataires'], $row['auteur_id']);
                $mails[] = $mailEdu;
            }

            return $mails;
        } catch (PDOException $e) {
            return [];
        }
    }
    public function getMailById($mailId) {
        try {
            $query = "SELECT * FROM mailcontact WHERE id = :id";
            $stmt = $this->connexion->pdo->prepare($query);
            $stmt->bindValue(":id", $mailId, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Gérer l'erreur si nécessaire
            return false;
        }
    }
    public function delete($id) {
        $query = "DELETE FROM mailcontact WHERE id=:id";
        $stmt = $this->connexion->pdo->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    
        if (!$stmt->execute()) {
            // Affichez les erreurs en cas de problème
            print_r($stmt->errorInfo());
            return false;
        }
    
        return true;
    }
}