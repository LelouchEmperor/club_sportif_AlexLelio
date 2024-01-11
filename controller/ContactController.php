<?php

namespace Controller;

use Model\ContactDAO;
use Model\Contact;
use Twig\Environment;

include_once('Model/ContactDAO.php');

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
        include('view/Contact/listContact.php');
    }

    public function displayFormUpdate($id){
        // Afficher le formulaire de mise à jour d'un contact
        $contact = $this->contactDAO->getById($id);
        include('view/Contact/updateContact.php');
    }

    public function displayFormCreate(){
        // Afficher le formulaire de création d'un contact
        include('view/Contact/createContact.php');
    }

    public function displayList(){
        // Afficher la liste des contacts
        $contacts = $this->contactDAO->getAll();
        include('view/Contact/listContact.php');
    }
}
