<?php

class MailEduController {
    private $mailEduDAO;

    public function __construct(MailEduDAO $mailEduDAO) {
        $this->mailEduDAO = $mailEduDAO;
    }

    public function display() {
        // Logique pour récupérer les mails éducateur
        $mails = $this->mailEduDAO->getAllMails();
        include('view/MailEdu/mailEducateur.php');
    }
    public function sendMailForm() {
        // Récupérer tous les éducateurs
        $otherEducateurs = $this->mailEduDAO->getAllEducateurs();
    
        // Charger la vue avec la liste des éducateurs
        include('view/MailEdu/sendMailForm.php');
    }
    public function sendMail() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedEducateurs = isset($_POST['selected_educateurs[]']) ? $_POST['selected_educateurs[]'] : [];
            $objet = isset($_POST['objet']) ? $_POST['objet'] : '';
            $message = isset($_POST['message']) ? $_POST['message'] : '';
    
            // L'id de l'auteur (par exemple, 1)
            $auteurId = 2;
    
            
                // Récupérez l'éducateur correspondant à l'ID $educateurId
                // Notez que vous devrez obtenir le destinataire à partir de l'éducateur
    
                // Construisez l'objet MailEdu
                $mailEdu = new MailEdu(6,date('Y-m-d H:i:s'), $objet, $message, $selectedEducateurs, $auteurId);
    
                // Enregistrez l'objet MailEdu dans la base de données
                $this->mailEduDAO->insertMail($mailEdu);
            
    
            // Redirection ou traitement après l'envoi du mail
        }
    }
    
    
    

    public function deleteMail($mailId) {
        // Vérifiez l'existence de l'e-mail avant la suppression
        $mail = $this->mailEduDAO->getMailById($mailId);
    
        if ($mail) {
            // L'e-mail existe, procédez à la suppression
            if ($this->mailEduDAO->delete($mailId)) {
                // Redirection ou traitement après suppression réussie
                header('Location: index.php?page=mailedu&action=display');
                exit();
            } else {
                echo "Erreur lors de la suppression du mail.";
            }
        } else {
            echo "L'e-mail avec l'ID spécifié n'existe pas.";
        }
    
}
}