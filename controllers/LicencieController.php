<?php

class LicencieController {
    private $licencieDAO;

    public function __construct(LicencieDAO $licencieDAO) {
        $this->licencieDAO = $licencieDAO;
    }

    public function display(){
        $licencies = $this->licencieDAO->getAllLicencies();
        include('View/Licencie/listLicencie.php'); 
    }
    
    public function createLicencie() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroLicence = $_POST['numeroLicence'];
            $contactId = $_POST['contactId'];
            $categorieId = $_POST['categorieId'];

            // Valider les données du formulaire, name et surname ne doivent pas être des chiffres, numeroLicence doit être un numeroLicence valide, contactId doit être un contactId valide, categorieId doit être un categorieId valide
            if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
                $nomErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
                $prenomErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[0-9]{10}$/", $numeroLicence)) {
                $numeroLicenceErr = "Format de numeroLicence invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $contactId)) {
                $contactIdErr = "Format de contactId invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $categorieId)) {
                $categorieIdErr = "Format de categorieId invalide";
            }

            // Pas de chaine vide autorisée
            if (empty($nom) && empty($prenom) && empty($numeroLicence) && empty($contactId) && empty($categorieId)) {
                $nomErr = "Le nom, le prenom, le numeroLicence, le contactId et le categorieId sont requis";
            }

            $newLicencie = new Licencie(0, $nom, $prenom, $numeroLicence, $contactId, $categorieId);
            if ($this->licencieDAO->createLicencie($newLicencie)) {
                $path = "index.php?page=listLicencie&action=index";
                header('Location:'. $path);
                exit();
            } else {
                echo "Problème rencontré lors de l'ajout du licencie";
            }
        }
        include('View/Licencie/createLicencie.php');
    }

    public function updateLicencie($licencieId) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroLicence = $_POST['numeroLicence'];
            $contactId = $_POST['contactId'];
            $categorieId = $_POST['categorieId'];

            // Valider les données du formulaire, name et surname ne doivent pas être des chiffres, numeroLicence doit être un numeroLicence valide, contactId doit être un contactId valide, categorieId doit être un categorieId valide
            if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
                $nomErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
                $prenomErr = "Seuls les lettres et les espaces sont autorisés";
            }

            if (!preg_match("/^[0-9]{10}$/", $numeroLicence)) {
                $numeroLicenceErr = "Format de numeroLicence invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $contactId)) {
                $contactIdErr = "Format de contactId invalide";
            }

            if (!preg_match("/^[0-9]{10}$/", $categorieId)) {
                $categorieIdErr = "Format de categorieId invalide";
            }

            // Pas de chaine vide autorisée
            if (empty($nom) && empty($prenom) && empty($numeroLicence) && empty($contactId) && empty($categorieId)) {
                $nomErr = "Le nom, le prenom, le numeroLicence, le contactId et le categorieId sont requis";
            }

            $newLicencie = new Licencie($id, $nom, $prenom, $numeroLicence, $contactId, $categorieId);
            if ($this->licencieDAO->updateLicencie($newLicencie)) {
                $path = "index.php?page=listLicencie&action=index";
                header('Location:'. $path);
                exit();
            } else {
                echo "Problème rencontré lors de l'ajout du licencie";
            }
        }
        include('View/Licencie/updateLicencie.php');

    }


    public function deleteLicencie($licencieId) {
        $licencie = $this->licencieDAO->getById($licencieId);

        if (!$licencie) {
            echo "Aucun licencie n'a été trouvé avec l'identifiant $licencieId";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->licencieDAO->deleteLicencie($licencieId)) {
                $path = "index.php?page=listLicencie&action=index";
                header('Location:'. $path);
                exit();
            } else {
                echo "Problème rencontré lors de la suppression du licencie";
            }
        }
    }
}


