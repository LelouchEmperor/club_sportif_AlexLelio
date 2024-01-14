<?php
class MailContact {
    private $id;
    private $dateEnvoi;
    private $objet;
    private $message;
    private $destinataires;  // Nom de la colonne pour les destinataires
    private $auteurId;  // Nom de la colonne pour l'auteur (peut être éducateur ou contact)

    public function __construct($id, $dateEnvoi, $objet, $message, $destinataires, $auteurId) {
        $this->id = $id;
        $this->dateEnvoi = $dateEnvoi;
        $this->objet = $objet;
        $this->message = $message;
        $this->destinataires = $destinataires;
        $this->auteurId = $auteurId;
    }

    public function getId() {
        return $this->id;
    }

    public function getDateEnvoi() {
        return $this->dateEnvoi;
    }

    public function getObjet() {
        return $this->objet;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getDestinataires() {
        return $this->destinataires;
    }

    public function getAuteurId() {
        return $this->auteurId;
    }
}
