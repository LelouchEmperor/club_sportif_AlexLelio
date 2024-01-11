<?php
// Récupérer le nom du script actuel (nom de la page)
$currentPage = basename($_SERVER['SCRIPT_NAME'], '.php');

// Initialiser $pageActive avec une valeur par défaut (par exemple, 'Categorie')
$pageActive = 'Categorie';

// Vérifier si "categorie" est présent dans l'URL
if (stripos($_SERVER['REQUEST_URI'], 'categorie') !== false) {
    $pageActive = 'Categorie';
} elseif (stripos($_SERVER['REQUEST_URI'], 'licencie') !== false) {
    $pageActive = 'Licencie';
} elseif (stripos($_SERVER['REQUEST_URI'], 'contact') !== false) {
    $pageActive = 'Contact';
} elseif (stripos($_SERVER['REQUEST_URI'], 'educateur') !== false) {
    $pageActive = 'Educateur';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Titre</title>
    <!-- Ajouter le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Ajouter un peu d'espace autour des liens pour une meilleure apparence */
        .navbar-nav {
            margin: auto;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Club sportif</a>
    <!-- Utiliser la classe 'navbar-nav' pour centrer les éléments -->
    <ul class="navbar-nav">
        <li class="nav-item <?php echo ($pageActive === 'Categorie') ? 'active' : ''; ?>">
            <a class="nav-link <?php echo ($pageActive === 'Categorie') ? 'font-weight-bold' : ''; ?>" href="listCategorie">Categorie</a>
        </li>
        <li class="nav-item <?php echo ($pageActive === 'Licencie') ? 'active' : ''; ?>">
            <a class="nav-link <?php echo ($pageActive === 'Licencie') ? 'font-weight-bold' : ''; ?>" href="listLicencie">Licencie</a>
        </li>
        <li class="nav-item <?php echo ($pageActive === 'Contact') ? 'active' : ''; ?>">
            <a class="nav-link <?php echo ($pageActive === 'Contact') ? 'font-weight-bold' : ''; ?>" href="listContact">Contact</a>
        </li>
        <li class="nav-item <?php echo ($pageActive === 'Educateur') ? 'active' : ''; ?>">
            <a class="nav-link <?php echo ($pageActive === 'Educateur') ? 'font-weight-bold' : ''; ?>" href="listEducateur">Educateur</a>
        </li>
    </ul>

    <?php
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['utilisateur_id'])) {
    ?>
   <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="index.php?action=logout">Déconnexion</a>
        </li>
    </ul> 
    <?php
    }
    ?>
</nav>


<!-- Ajouter le lien vers Bootstrap JS et jQuery pour les fonctionnalités avancées -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
