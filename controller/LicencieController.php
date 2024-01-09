<?php

namespace Controller;

use Model\LicencieDAO;
use Model\Licencie;
use Twig\Environment;

include_once('Model/LicencieDAO.php');
    
class LicencieController {
    private $licencieDAO;

    public function __construct($db) {
        $this->licencieDAO = new LicencieDAO($db);
    }
    

    public function createLicencie($nom, $prenom, $numeroLicence, $contactId, $categorieId) {
        // Créer un nouveau licencié
        $licencie = new Licencie(null, $nom, $prenom, $numeroLicence, $contactId, $categorieId);
        $this->licencieDAO->create($licencie);
    }

    public function updateLicencie($id, $nom, $prenom, $numeroLicence, $contactId, $categorieId) {
        // Mettre à jour un licencié existant
        $licencie = $this->licencieDAO->getById($id);
        $licencie->setNom($nom);
        $licencie->setPrenom($prenom);
        $licencie->setNumeroLicence($numeroLicence);
        $licencie->setContactId($contactId);
        $licencie->setCategorieId($categorieId);
        $this->licencieDAO->update($licencie);
    }

    public function deleteLicencie($id) {
        // Supprimer un licencié
        $this->licencieDAO->delete($id);
    }

    public function listLicencie() {
        // Afficher la liste des licenciés
        $licencies = $this->licencieDAO->getAll();
        // Appeler une vue pour afficher les licenciés
        include('view/Licencie/listLicencie.php');
    }

    public function displayFormUpdate(){
        // Afficher le formulaire de mise à jour d'un licencié
        $licencie = $this->licencieDAO->getById($_GET['id']);
        include('view/Licencie/updateLicencie.php');
    }

    public function displayFormCreate(){
        // Afficher le formulaire de création d'un licencié
        include('view/Licencie/createLicencie.php');
    }

    public function displayList(){
        // Afficher la liste des licenciés
        $licencies = $this->licencieDAO->getAll();
        include('view/Licencie/listLicencie.php');
    }
    
}
