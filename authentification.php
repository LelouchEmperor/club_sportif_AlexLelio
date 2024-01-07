<?php
session_start();

// Inclure la configuration de la base de données et les classes nécessaires
require_once 'config.php';
require_once 'Model/EducateurDAO.php';
require_once 'Controller/AuthentificationController.php';

// Créer une connexion à la base de données (remplacez ces valeurs par les vôtres)
$db = new mysqli("localhost", "root", "", "club_sportif");

// Créer une instance du contrôleur d'authentification
$authentificationController = new AuthentificationController(new EducateurDAO($db));

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $motDePasse = $_POST['mot_de_passe'];

    // Authentifier l'éducateur
    $authentificationController->authentifierEducateur($email, $motDePasse);
}
?>
