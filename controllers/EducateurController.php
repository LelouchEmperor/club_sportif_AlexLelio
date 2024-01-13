<?php
class EducateurController {
    private $educateurDAO;

    public function __construct(EducateurDAO $educateurDAO) {
        $this->educateurDAO = $educateurDAO;
    }

    public function display() {
        $educateurs = $this->educateurDAO->getAllEducateurs();
        include('View/Educateur/listEducateur.php');
    }

    public function createEducateur() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $licencieId = strtoupper(uniqid($_POST['email'], false));
            $password = password_hash($_POST['email'], PASSWORD_DEFAULT);
            $admin = ($_POST['admin'] == 'Oui') ? true : false ;
            $email = $_POST['email'];
            // Valider les données du formulaire 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format d'email invalide";
            }
            // Pas de chaine vide autorisée
            if (empty($email)) {
                $emailErr = "L'email est requis";
            }
            // Ajouter le contact

            $newEducateur = new Educateur(0, $licencieId ,$email ,$password, $admin);
            if ($this->educateurDAO->createEducateur($newEducateur)) {
                header('Location: index.php?page=educateur&action=display');
                exit();
            } else {
                echo "Problème rencontré lors de l'ajout de l'éducateur";
            }
        }

        include('view/Educateur/createEducateur.php');;
    }

    public function updateEducateur($educateurId) {
        $educateur = $this->educateurDAO->getById($educateurId);

        $recupLicencie = new LicencieDAO(new Connexion);
        $licencie = $recupLicencie->getById($educateur->getLicencieID());
        $licencies = $recupLicencie->getAllLicencies();
        if (!$educateur) {
            echo "Le contact n'a pas été trouvé.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $licencieId = strtoupper(uniqid($_POST['email'], false));
            $email = $_POST['email'];
            $admin = ($_POST['admin'] == 'Oui') ? true : false ;
            // Valider les données du formulaire 
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Format d'email invalide";
            }
            // Pas de chaine vide autorisée
            if (empty($email)) {
                $emailErr = "L'email est requis";
            }
            $educateur->setLicencieID($licencieId);
            $educateur->setEmail($email);
            $educateur->setEstAdmin($admin);
            if ($this->educateurDAO->updateEducateur($educateur)) {
                header('Location:index.php?page=educateur&action=display');
                exit();
            } else {
                // Gérer les erreurs de mise à jour du contact
                echo "Problème rencontré lors de la mise à jour du contact";
            }
        }
        include('view/Educateur/updateEducateur.php');
    }

    public function deleteContact($educateurId) {
        $educateur = $this->educateurDAO->getById($educateurId);

        if (!$educateur) {
            echo "Aucun contact n'a été trouvée avec l'identifiant $educateurId";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->educateurDAO->deleteEducateur($educateurId)) {
                $path = "index.php?page=educateur&action=display";
                header('Location:'. $path);
                exit();
            } else {
                // Gérer les erreurs de suppression du contact
                echo "Problème rencontré lors de la suppression du contact";
            }
        }
    }
    

    public function login(){
        if (isset($_POST['email']) && isset($_POST['motDePasse'])) {
            $login = $_POST['email'];
            $password = $_POST['motDePasse'];
            $user = $this->educateurDAO->getByEmail($login);

            if ($user && password_verify($password, $user['motDePasse']) && $user['isAdmin']) {
                // si soit le login soit le mot de passe est incorrect, on redirige vers la page de login avec un message d'erreur
                header('Location: view/Authentification/login.php?erreur=loginORmdp');
                exit();
            } else {

//Génération d'un token pour la session
                $token = bin2hex(random_bytes(32));
                $_SESSION['connected'] = $login;
                $_SESSION['token'] = $token;

                // Appel de header avant tout affichage de contenu
                header('Location: index.php?page=welcome&action=display');
                exit();
            }
        }
            header('Location: view/Autentification/login.php');
        exit();
    }
    
        
    //fonction permettant de se déconnecter de la session en cours et d'ainsi supprimer les droits d'accès à l'application
    public function logout(){
        session_start();
        session_destroy();
        header('Location:pageDaccueil.php');
        exit();
    }

    public function displayChoiseLicencie(){
        $recupLicencie = new LicencieDAO(new Connexion);
        $licencies = $recupLicencie->getAllLicencieBis();
        include('view/Educateur/createEducateur.php');
    }
    
}
