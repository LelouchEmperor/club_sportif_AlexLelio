<?php

namespace App\Controller;

use App\Model\LicencieDAO;
use App\Model\Licencie;
use Twig\Environment;

class LicencieController {
    private $licencieDAO;

    public function __construct(LicencieDAO $licencieDAO) {
        $this->licencieDAO = $licencieDAO;
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
        include('view/Licencie/listLicencie.html.twig');
    }
}
