<?php
session_start();
require_once 'config.php';

include("View/Structure/entete.php");

// Récupère le chemin après le nom de domaine (par exemple, localhost/club_sportif/connexion)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Utilise la première partie du chemin comme paramètre de page
$page = !empty($parts[0]) ? $parts[0] : 'accueil';

switch ($page) {
    case 'accueil':
        include("View/dashboard.html.twig");
        break;

    case 'connexion':
        include("View/Licencie/listLicencie.html.twig");
        break;

    case 'inscription':
        include("View/Structure/inscription.php");
        break;

    default:
        include("View/Structure/accueil.php");
        break;
}

include("View/Structure/basDePage.php");
?>
