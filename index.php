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

include("View/Structure/entete.php");

// Créer une connexion à la base de données (remplacez ces valeurs par les vôtres)
$db = new mysqli("localhost", "root", "", "club_sportif");

$categorieController = new \Controller\CategorieController(new \Model\CategorieDAO($db));
$contactController = new \Controller\ContactController(new \Model\ContactDAO($db));
$educateurController = new \Controller\EducateurController(new \Model\EducateurDAO($db));
$licencieController = new \Controller\LicencieController(new \Model\LicencieDAO($db));


// Récupère le chemin après le nom de domaine (par exemple, localhost/club_sportif/connexion)
$path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
$parts = explode('/', $path);

// Utilise la première partie du chemin comme paramètre de page
$page = !empty($parts[0]) ? $parts[0] : 'accueil';

$authentificationController = new \Controller\AuthentificationController(new \Model\EducateurDAO($db));

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

// Vérifier si la page demandée est définie dans le mapping
if (array_key_exists($page, $controllerMapping)) {
    $controllerClassName = "Controller\\" . $controllerMapping[$page];
    
    // Décider quelle méthode appeler en fonction de l'action de l'URL
    $action = decideActionFromPage($page);

    if ($page === 'login') {
        // Si la page est 'login', instanciez le contrôleur avec EducateurDAO
        $controller = new \Controller\AuthentificationController(new \Model\EducateurDAO($db));
    } else {
        // Sinon, instanciez le contrôleur sans EducateurDAO (ou avec d'autres paramètres nécessaires)
        $controller = new $controllerClassName($db);
    }

    // Appeler la méthode
    $controller->{$action}();
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
        return 'display';  // Par défaut, si aucune correspondance n'est trouvée
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'createCategorie':
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $categorieController->createCategorie($nom, $codeRaccourci);
            break;

        case 'createEducateur':
            $educateurController->createEducateur(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['numero_tel'],
                $_POST['mot_de_passe'],
                isset($_POST['is_admin'])
);
    break;
        case 'createContact':
            $contactController->createContact(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['email'],
                $_POST['numero_tel']
    );
    break;

        case 'createLicencie':
            $licencieController->createLicencie(
                $_POST['nom'],
                $_POST['prenom'],
                $_POST['numero_licence']);
    break;


        case 'updateCategorie':
            $id = $_POST['id'];
            $nom = $_POST['nom'];
            $codeRaccourci = $_POST['codeRaccourci'];
            $categorieControllerr->updateCategorie($id, $nom, $codeRaccourci);
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

        // ajouter les cas pour deletes
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
            $deleteController->deleteEducateur($id);
            break;
        
        case 'deleteContact':
            $id = $_GET['id'];
            $contactController->deleteContact($id);
            break;
        
        case 'deleteLicencie':
            $id = $_GET['id'];
            $LicencieController->deleteLicencie($id);
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
        }
}



echo "<br>";
include("View/Structure/basDePage.php");
?>
