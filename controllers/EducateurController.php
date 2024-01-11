<?php

class EducateurController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
    }

    public function display() {
        $educateurs = $this->educateurDAO->getAll();
        include('View/Educateur/list.php');
    }

    public function createEducateur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Valider les données du formulaire, name et surname ne doivent pas être des chiffres, email doit être un email valide, phone doit être un numéro de téléphone valide
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
            if ($this->contactDAO->addContact($newContact)) {
                $path = "index.php?page=listContact&action=index";
                header('Location:'. $path);
                exit();
            } else {
                echo "Problème rencontré lors de l'ajout du contact";
            }
        }

        // Inclure la vue pour afficher le formulaire d'ajout de contact
        include('view/Contact/createContact.php');;
    }

    public function updateEducateur($contactId) {
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            echo "Aucun contact n'a été trouvé avec l'identifiant $contactId";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            // Valider les données du formulaire, name et surname ne doivent pas être des chiffres, email doit être un email valide, phone doit être un numéro de téléphone valide
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

            $contact->setName($name);
            $contact->setSurname($surname);
            $contact->setEmail($email);
            $contact->setPhone($phone);

            if ($this->contactDAO->updateContact($contact)) {
                header('Location:index.php?page=listContact&action=index');
                exit();
            } else {
                // Gérer les erreurs de mise à jour du contact
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
                header('Location:index.php?page=listContact&action=index');
                exit();
            } else {
                // Gérer les erreurs de suppression du contact
                echo "Problème rencontré lors de la suppression du contact";
            }
        }
    }

    
}
