<?php
session_start();

spl_autoload_register(function ($class) {
    // Convertir les antislashes en slashes dans le nom de la classe
    $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Construire le chemin du fichier de classe
    $classPath = __DIR__ . DIRECTORY_SEPARATOR . $class . '.php';

    // Inclure la classe si elle existe
    if (file_exists($classPath)) {
        include $classPath;
    } else {
        echo "Fichier non trouvé : $classPath";
    }
});




require_once 'config.php';
require_once 'Model/Connexion.php';
require_once 'Model/CategorieDAO.php';
require_once 'Model/EducateurDAO.php';
require_once 'Model/ContactDAO.php';
require_once 'Model/LicencieDAO.php';
require_once 'Controller/CategorieController.php';
require_once 'Controller/EducateurController.php';
require_once 'Controller/ContactController.php';
require_once 'Controller/LicencieController.php';
require_once 'Controller/AuthentificationController.php';


$connexion = new Model\Connexion();

$categorieDAO = new \Model\CategorieDAO($connexion);
$categorieController = new \Controller\CategorieController($categorieDAO);

$educateurDAO = new \Model\EducateurDAO($connexion);
$educateurController = new \Controller\EducateurController($educateurDAO);

$contactDAO = new \Model\ContactDAO($connexion);
$contactController = new \Controller\ContactController($contactDAO);

$licencieDAO = new \Model\LicencieDAO($connexion);
$licencieController = new \Controller\LicencieController($licencieDAO);

include("View/Structure/entete.php");


 // Récupère le chemin après le nom de domaine (par exemple, localhost/club_sportif/connexion)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Utilise la première partie du chemin comme paramètre de page
$page = !empty($parts[0]) ? $parts[0] : 'accueil';

$authentificationController = new \Controller\AuthentificationController($connexion);

// Définir un tableau de correspondance entre les pages et les contrôleurs
$controllerMapping = [
    'listLicencie' => 'LicencieController',
    'listContact' => 'ContactController',
    'listCategorie' => 'CategorieController',
    'listEducateur' => 'EducateurController',
    'createLicencie' => 'LicencieController',
    'createContact' => 'ContactController',
    'createCategorie' => 'CategorieController',
    'createEducateur' => 'EducateurController',
    'updateLicencie' => 'LicencieController',
    'updateContact' => 'ContactController',
    'updateCategorie' => 'CategorieController',
    'updateEducateur' => 'EducateurController',
    'login' => 'AuthentificationController',
];


$controllerToDAO = [
    'CategorieController' => 'CategorieDAO',
    'EducateurController' => 'EducateurDAO',
    'LicencieController' => 'LicencieDAO',
    'ContactController' => 'ContactDAO',
    'AuthentificationController' => 'EducateurDAO',
    
];


// Vérifier si la page demandée est définie dans le mapping
if (array_key_exists($page, $controllerMapping)) {
    $controllerClassName = "Controller\\" . $controllerMapping[$page];

    // Décider quelle méthode appeler en fonction de l'action de l'URL
    $action = decideActionFromPage($page);

    if ($page === 'login') {
        // Instanciez le DAO avec la connexion
        $daoClassName = 'Model\\' . $controllerToDAO[$controllerMapping[$page]];
        $dao = new $daoClassName($connexion);
    
        // Instanciez le contrôleur avec le DAO
        $controller = new $controllerClassName($connexion, $dao);
    } else {
        $daoClassName = 'Model\\' . $controllerToDAO[$controllerMapping[$page]];
        $dao = new $daoClassName($connexion);
        $controller = new $controllerClassName($dao);
    }

    // condition pour voir si l'action est displayFormUpdate, si oui on passe l'id en paramètre
    if ($action === 'displayFormUpdate') {
        //verifier si l'id est présent dans l'url, sinon afficher une erreur "id manquant dans l'url"
        if (isset($parts[1])) {
            $id = $parts[1];
            $controller->{$action}($id);
        } else {
            echo 'id manquant dans l\'url';
        }
    } else {
        $controller->{$action}();
    }
}

function decideActionFromPage($page) {
    if (stripos($page, 'create') !== false || stripos($page, 'creer') !== false) {
        return 'displayFormCreate';
    } elseif (stripos($page, 'update') !== false || stripos($page, 'modifier') !== false) {
        return 'displayFormUpdate';
    } elseif (stripos($page, 'list') !== false || stripos($page, 'liste') !== false) {
        return 'displayList';
    } elseif ($page === 'login' || $page === 'accueil') {  
        return 'displayFormLogin';
    } else {
        return 'display';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'createCategorie':
            echo 'Formulaire soumis';
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $categorieController->createCategorie($nom, $codeRaccourci);
            header('Location: listCategorie');
            break;

        case 'createEducateur':
            $educateurController->createEducateur(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['numero_tel'],
                $_POST['mot_de_passe'],
                isset($_POST['is_admin']));
                header('Location: listEducateur');
        break;
        case 'createContact':
            $contactController->createContact(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['numero_tel']);
                header('Location: listContact');
        break;

        case 'createLicencie':
            $licencieController->createLicencie(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['numero_licence']);
                header('Location: listLicencie');
        break;

        case 'updateCategorie':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $categorieController->updateCategorie($id, $nom, $codeRaccourci);
            break;
        
        case 'updateEducateur':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $motDePasse = $_POST['mot_de_passe'];
            $isAdmin = isset($_POST['is_admin']);
            $controllerEducateur->updateEducateur($id, $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin);
            break;
        
        case 'updateContact':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $contactController->updateContact($id, $nom, $prenom, $email, $numeroTel);
            break;
        
        case 'updateLicencie':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroLicence = $_POST['numero_licence'];
            $licencieController->updateLicencie($id, $nom, $prenom, $numeroLicence);
            break;

        case 'login':
            $email = $_POST['email'];
            $motDePasse = $_POST['mot_de_passe'];
            $authentificationController->login($email, $motDePasse);
            break;

        case 'default':
            echo 'nothing to do';
            break;
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'deleteCategorie':
            $id = $_GET['id'];
            $categorieController->deleteCategorie($id);
            break;
        
        case 'deleteEducateur':
            $id = $_GET['id'];
            $educateurController->deleteEducateur($id);
            break;
        
        case 'deleteContact':
            $id = $_GET['id'];
            $contactController->deleteContact($id);
            break;
        
        case 'deleteLicencie':
            $id = $_GET['id'];
            $licencieController->deleteLicencie($id);
            break;

        case 'displayFormUpdateCategorie':
                $id = $_GET['id'];
                $categorieController->displayFormUpdate($id);
                break;

        case 'displayFormUpdateLicencie':
                $id = $_GET['id'];
                $licencieController->displayFormUpdate($id);
                break;
        
         case 'displayFormUpdateEducateur':
                $id = $_GET['id'];
                $educateurController->displayFormUpdate($id);
                break;

        case 'displayFormUpdateContact':
                $id = $_GET['id'];
                $contactController->displayFormUpdate($id);
                break;
        
        case 'logout':
            $authentificationController->logout();
            break;
        }
}

echo "<br>";
include("View/Structure/basDePage.php");
?>
