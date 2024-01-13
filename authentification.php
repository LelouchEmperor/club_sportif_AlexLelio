<?php
session_start();

// Inclure la classe Connexion et les classes nécessaires
require_once 'config.php';
require_once 'Model/Connexion.php';
require_once 'Model/EducateurDAO.php';
require_once 'Controller/AuthentificationController.php';

// Créer une instance de la classe Connexion
$connexion = new \Model\Connexion();

// Créer une instance du contrôleur d'authentification en utilisant la classe Connexion
$authentificationController = new \Controller\AuthentificationController($connexion);

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'Formulaire soumis';
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Authentifier l'éducateur
    $authentificationController->authentifierEducateur($email, $motDePasse);
}
?>
