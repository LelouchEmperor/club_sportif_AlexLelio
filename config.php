<?php
// config.php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$database = "club_sportif";

$db = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion à la base de données
if ($db->connect_error) {
    die("La connexion à la base de données a échoué : " . $db->connect_error);
}

// Chargement automatique des classes
function autoloadClasses($class) {
    require_once("modele/$class.php");
}
spl_autoload_register('autoloadClasses');

// Charger le Front Controller
require_once("front_controller.php");
?>
