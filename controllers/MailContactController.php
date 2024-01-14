<?php

class MailContactController {
    private $mailContactDAO;

    public function __construct(mailContactDAO $mailContactDAO) {
        $this->mailContactDAO = $mailContactDAO;
    }

    public function display() {
        // Logique pour récupérer les mails éducateur
        $mails = $this->mailContactDAO->getAllMails();
        include('view/MailEdu/mailEducateur.php');
    }
    

    public function deleteMail($mailId) {
        // Vérifiez l'existence de l'e-mail avant la suppression
        $mail = $this->mailContactDAO->getMailById($mailId);
    
        if ($mail) {
            // L'e-mail mailContactDAO, procédez à la suppression
            if ($this->mailContactDAO->delete($mailId)) {
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