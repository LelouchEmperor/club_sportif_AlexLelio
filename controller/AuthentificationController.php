<?php
namespace Controller;

use Model\EducateurDAO;

require_once("Model/EducateurDAO.php");

class AuthentificationController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO = null) {
        $this->educateurDAO = $educateurDAO ?: new EducateurDAO(); 
    }
    

    public function authentifierEducateur($email, $motDePasse) {
        // Vérifier si l'éducateur existe et si le mot de passe correspond
        $educateur = $this->educateurDAO->getByEmail($email);
    
        var_dump($educateur); // Ajouter cette ligne pour déboguer

        if ($educateur && password_verify($motDePasse, $educateur->getMotDePasse())) {
            // Vérifier si l'éducateur est un administrateur
            if ($educateur->isAdmin()) {
                // Connexion réussie pour un administrateur
                $_SESSION['educateur_id'] = $educateur->getId();
                header('Location: /');
                exit();
            } else {
                // Mauvais rôle d'utilisateur, rediriger vers la page d'accueil avec erreur
                header('Location: login?erreur=2'); 
                exit();
            }
        } else {
            // Mauvaises informations d'identification, rediriger vers la page de connexion avec erreur
            header('Location: login?erreur=1');
            exit();
        }
    }
    
    

    public function displayFormLogin(){
        if (isset($_SESSION['educateur_id'])) {
            header('Location: Welcome.php'); 
        }
        // Afficher le formulaire de création d'un éducateur
        include('View/Authentification/login.php');
    }
}
?>
