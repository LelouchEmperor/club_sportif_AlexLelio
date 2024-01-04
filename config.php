<?php
// config.php

// Configuration de la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "club_sportif";

// Création de la connexion à la base de données
$db = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion à la base de données
if ($db->connect_error) {
    die("La connexion à la base de données a échoué : " . $db->connect_error);
}

// Chargement automatique des classes avec une fonction d'autoloading
function autoloadClasses($class) {
    // Assurez-vous que le fichier existe avant de l'inclure
    $file = "modele/$class.php";
    if (file_exists($file)) {
        require_once($file);
    }
}
spl_autoload_register('autoloadClasses');


?>
