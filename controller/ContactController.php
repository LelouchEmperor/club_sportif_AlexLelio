<?php

namespace App\Controller;

use App\Model\ContactDAO;
use App\Model\Contact;
use Twig\Environment;

class ContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function createContact($nom, $prenom, $email, $numeroTel) {
        // Créer un nouveau contact
        $contact = new Contact(null, $nom, $prenom, $email, $numeroTel);
        $this->contactDAO->create($contact);
    }

    public function updateContact($id, $nom, $prenom, $email, $numeroTel) {
        // Mettre à jour un contact existant
        $contact = $this->contactDAO->getById($id);
        $contact->setNom($nom);
        $contact->setPrenom($prenom);
        $contact->setEmail($email);
        $contact->setNumeroTel($numeroTel);
        $this->contactDAO->update($contact);
    }

    public function deleteContact($id) {
        // Supprimer un contact
        $this->contactDAO->delete($id);
    }

    public function listContact() {
        // Afficher la liste des contacts
        $contacts = $this->contactDAO->getAll();
        // Appeler une vue pour afficher les contacts
        include('view/Contact/listContact.html.twig');
    }
}
