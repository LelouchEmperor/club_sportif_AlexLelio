<?php

    // FICHIER CENTRALE DE L'APPLICATION
    // Il gere le routage et l'instanciation des classes

 
    require_once("config/config.php");
    require_once("models/Connexion.php");

    //catalogue des classes DAO et modeles
    require_once("models/Categorie.php");
    require_once("DAO/CategorieDAO.php");
    require_once("models/Contact.php");
    require_once("DAO/ContactDAO.php");
    require_once("models/Licencie.php");
    require_once("DAO/LicencieDAO.php");
    require_once("models/Educateur.php");
    require_once("DAO/EducateurDAO.php");

 // Le routage se passe ici
 // On recupere les parametres de l'url et on les affecte aux variables $page et $action
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

    //creation des instances de connexion et des DAO
    $categorieDAO= new CategorieDAO(new Connexion());
    $contactDAO= new ContactDAO(new Connexion());
    $educateurDAO= new EducateurDAO(new Connexion());
    $licenceDAO= new LicencieDAO(new Connexion());

    // definition des controllers
    $controllers = [
        'licencie' => 'LicencieController',
        'contact' => 'ContactController',
        'educateur' => 'EducateurController',
        'categorie' => 'CategorieController',
        'accueil' => 'AccueilController',
    ];

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
        }

         $controller->$action(isset($_GET['id'])?$_GET['id']:null); 
    } else {
        include('pageDaccueil.php');
    }


?>
