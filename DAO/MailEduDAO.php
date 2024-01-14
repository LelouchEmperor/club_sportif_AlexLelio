<?php
require_once('models/MailEdu.php');

class MailEduDAO {
    private $connexion;

    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getAllMails() {
        try {
            $stmt = $this->connexion->pdo->query("SELECT * FROM mailEdu");
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
    public function insertMail(MailEdu $mail) {
        try {
            $query = "INSERT INTO mailedu (date_envoi, objet, message, destinataires, auteur_id) VALUES (:date_envoi, :objet, :message, :destinataires, :auteur_id)";
            $stmt = $this->connexion->pdo->query($query);
    
            
            $destinataire = $mail->getDestinataires(); // Remplacez ceci
            $auteurId = $mail->getAuteurId(); // Remplacez ceci
    
            $stmt->bindValue(":date_envoi", $mail->getDateEnvoi());
            $stmt->bindValue(":objet", $mail->getObjet());
            $stmt->bindValue(":message", $mail->getMessage());
            $stmt->bindValue(":destinataires", $destinataire); // Utilisez la variable correcte ici
            $stmt->bindValue(":auteur_id", 2); // Utilisez la variable correcte ici
    
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    
    
    public function getMailById($mailId) {
        try {
            $query = "SELECT * FROM mailedu WHERE id = :id";
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
        $query = "DELETE FROM mailedu WHERE id=:id";
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