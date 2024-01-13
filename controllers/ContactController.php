<?php

class ContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function display() {
        // Afficher la liste des contacts
        $contacts = $this->contactDAO->getAllContacts();
        include('view/Contact/listContact.php'); 

    }
    public function createContact() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['nom'];
            $surname = $_POST['prenom'];
            $email = $_POST['email'];
            $phone = $_POST['numeroTel'];

            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $surname)) {
                $surnameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format d'email invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $phone)) {
                $phoneErr = "Format de numéro de téléphone invalide";
            }

            // Pas de chaine vide autorisée
            if (empty($name) && empty($surname) && empty($email) && empty($phone)) {
                $nameErr = "Le nom, le prénom, l'email et le numéro de téléphone sont requis";
            }

            $newContact = new Contact(0, $name, $surname, $email, $phone);
            if ($this->contactDAO->createContact($newContact)) {
                $path = "index.php?page=contact&action=display";
                header('Location:'. $path);
                exit();
            } else {
                echo "Problème rencontré lors de la création du contact";
            }
        }

        include('view/Contact/createContact.php');
    }


    

    public function updateContact($contactId) {
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            echo "Le contact n'a pas été trouvé.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numeroTel'];

            // Valider les données du formulaire, le nom et le prénom ne doivent pas être des chiffres, l'email doit être un email valide et le phone doit être un numéro de téléphone valide
            if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
                $nameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
                $surnameErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format d'email invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $numeroTel)) {
                $phoneErr = "Format de numéro de téléphone invalide";
            }

            // Pas de chaine vide autorisée
            if (empty($name) && empty($surname) && empty($email) && empty($phone)) {
                $nameErr = "Le nom, le prénom, l'email et le numéro de téléphone sont requis";
            }

            // Mettre à jour les détails du contact
            $contact->setNom($nom);
            $contact->setPrenom($prenom);
            $contact->setEmail($email);
            $contact->setNumeroTel($numeroTel);

            if ($this->contactDAO->updateContact($contact)) {
                header('Location:index.php?page=contact&action=display');
                exit();
            } else {
                echo "Problème rencontré lors de la mise à jour du contact";
            }
        }
        include('view/Contact/updateContact.php');
}

    public function deleteContact($contactId) {
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            echo "Aucun contact n'a été trouvé avec l'identifiant $contactId";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->contactDAO->deleteContact($contactId)) {
                $path = "index.php?page=contact&action=display";
                header('Location:'. $path);
                exit();
            } else {
                echo "Erreur lors de la suppression du contact.";
            }
        }
    }
}
