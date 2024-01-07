<?php
namespace App\Controller;

use App\Model\EducateurDAO;

class AuthentificationController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO = null) {
        $this->educateurDAO = $educateurDAO ?: new EducateurDAO($db);
    }

    public function authentifierEducateur($email, $motDePasse) {
        // Vérifier si l'éducateur existe et si le mot de passe correspond
        $educateur = $this->educateurDAO->getByEmail($email);

        if ($educateur && password_verify($motDePasse, $educateur->getMotDePasse())) {
            // Connexion réussie
            $_SESSION['educateur_id'] = $educateur->getId();

            if ($educateur->isAdmin()) {
                // Rediriger vers la page d'administration
                header('Location: dashboard.php');
                exit();
            } else {
                // Rediriger vers la page utilisateur normale
                header('Location: login.php');
                exit();
            }
        } else {
            // Mauvaises informations d'identification, rediriger vers la page de connexion
            header('Location: login.php?erreur=1');
            exit();
        }
    }

    public function displayFormLogin(){
        // Afficher le formulaire de création d'un éducateur
        include('view/Authentification/login.php');
    }
}
?>
