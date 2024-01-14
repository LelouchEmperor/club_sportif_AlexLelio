<?php

require_once("config/config.php");
require_once("models/Connexion.php");
require_once("models/Categorie.php");
require_once("DAO/CategorieDAO.php");
require_once("models/Contact.php");
require_once("DAO/ContactDAO.php");
require_once("models/Licencie.php");
require_once("DAO/LicencieDAO.php");
require_once("models/Educateur.php");
require_once("DAO/EducateurDAO.php");
require_once("models/MailEdu.php");
require_once("DAO/MailEduDAO.php");
require_once("models/MailContact.php");
require_once("DAO/MailContactDAO.php");

// création des instances de connexion et des DAO
$categorieDAO = new CategorieDAO(new Connexion());
$contactDAO = new ContactDAO(new Connexion());
$educateurDAO = new EducateurDAO(new Connexion());
$licenceDAO = new LicencieDAO(new Connexion());
$mailEduDAO = new MailEduDAO(new Connexion());
$mailContactDAO = new MailContactDAO(new Connexion());

// définition des controllers
$controllers = [
    'licencie' => 'LicencieController',
    'contact' => 'ContactController',
    'educateur' => 'EducateurController',
    'mailedu' => 'MailEduController',  
    'mailcontact' => 'MailContactController',
    'categorie' => 'CategorieController',
    'welcome' => 'WelcomeController',
];

// Le routage se passe ici
// On récupère les paramètres de l'url et on les affecte aux variables $page et $action
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'pageDaccueil'; 
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'display';
}

if (array_key_exists($page, $controllers)) {
    $controllerName = $controllers[$page];
    require_once('controllers/' . $controllerName . '.php');

    switch ($controllerName) {
        case 'ContactController':
            $controller = new $controllerName($contactDAO);
            break;
        case 'CategorieController':
            $controller = new $controllerName($categorieDAO);
            break;
        case 'LicencieController':
            $controller = new $controllerName($licenceDAO);
            break;
        case 'EducateurController':
            $controller = new $controllerName($educateurDAO);
            break;
        case 'MailEduController':
            $controller = new $controllerName($mailEduDAO);
            break;
        case 'MailContactController':
            $controller = new $controllerName($mailContactDAO);
            break;
        case 'WelcomeController':
            $controller = new $controllerName($educateurDAO);
            break;
    }
    $controller->$action(isset($_GET['id']) ? $_GET['id'] : null);
} else {
    include('pageDaccueil.php');
}
