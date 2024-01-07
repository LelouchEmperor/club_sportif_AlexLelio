<?php
session_start();
require_once 'config.php';

include("View/Structure/entete.php");

// Créer une connexion à la base de données (remplacez ces valeurs par les vôtres)
$db = new mysqli("localhost", "root", "", "club_sportif");

// Récupère le chemin après le nom de domaine (par exemple, localhost/club_sportif/connexion)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Utilise la première partie du chemin comme paramètre de page
$page = !empty($parts[0]) ? $parts[0] : 'accueil';

// Définir un tableau de correspondance entre les pages et les contrôleurs
$controllerMapping = [
    'accueil' => 'DashboardController',
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

// Vérifier si la page demandée est définie dans le mapping
if (array_key_exists($page, $controllerMapping)) {
    $controllerClassName = "App\\Controller\\" . $controllerMapping[$page];
    $daoClassName = "App\\Model\\" . str_replace('Controller', '', $controllerMapping[$page]) . "DAO";

    // Inclure le fichier du contrôleur et créer une instance
    include("Controller/{$controllerMapping[$page]}.php");
    $controller = new $controllerClassName(new $daoClassName($db));

    // Décider quelle méthode appeler en fonction de l'action de l'URL
    $action = decideActionFromPage($page);
    $controller->{$action}();
} 

function decideActionFromPage($page) {

    if (stripos($page, 'create') !== false) {
        return 'displayFormCreate';
    } elseif (stripos($page, 'update') !== false || stripos($page, 'modifier') !== false) {
        return 'displayFormUpdate';
    } elseif (stripos($page, 'list') !== false) {
        return 'displayList';
    } else {
        return 'displayFormLogin';  // Par défaut, si aucune correspondance n'est trouvée
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'createCategorie':
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $controller = new CategorieController();
            $controller->createCategorie($nom, $codeRaccourci);
            break;

        case 'createEducateur':
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $motDePasse = $_POST['mot_de_passe'];
            $isAdmin = isset($_POST['is_admin']);
            $controller = new EducateurController();
            $controller->createEducateur($nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin);
            break;

        case 'createContact':
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $controller = new ContactController();
            $controller->createContact($nom, $prenom, $email, $numeroTel);
            break;

        case 'createLicencie':
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroLicence = $_POST['numero_licence'];
            $controller = new LicencieController();
            $controller->createLicencie($nom, $prenom, $numeroLicence);
            break;

        case 'updateCategorie':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $controller = new CategorieController();
            $controller->updateCategorie($id, $nom, $codeRaccourci);
            break;
        
        case 'updateEducateur':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $motDePasse = $_POST['mot_de_passe'];
            $isAdmin = isset($_POST['is_admin']);
            $controller = new EducateurController();
            $controller->updateEducateur($id, $nom, $prenom, $email, $numeroTel, $motDePasse, $isAdmin);
            break;
        
        case 'updateContact':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $numeroTel = $_POST['numero_tel'];
            $controller = new ContactController();
            $controller->updateContact($id, $nom, $prenom, $email, $numeroTel);
            break;
        
        case 'updateLicencie':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $numeroLicence = $_POST['numero_licence'];
            $controller = new LicencieController();
            $controller->updateLicencie($id, $nom, $prenom, $numeroLicence);
            break;
    }
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'deleteCategorie':
            $id = $_GET['id'];
            $controller = new CategorieController();
            $controller->deleteCategorie($id);
            break;
        
        case 'deleteEducateur':
            $id = $_GET['id'];
            $controller = new EducateurController();
            $controller->deleteEducateur($id);
            break;
        
        case 'deleteContact':
            $id = $_GET['id'];
            $controller = new ContactController();
            $controller->deleteContact($id);
            break;
        
        case 'deleteLicencie':
            $id = $_GET['id'];
            $controller = new LicencieController();
            $controller->deleteLicencie($id);
            break;
    }
}



echo "<br>";
include("View/Structure/basDePage.php");
?>
