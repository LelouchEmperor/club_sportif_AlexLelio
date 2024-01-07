<?php
// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['utilisateur_connecte'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Catégories</title>
</head>
<body>
    <h1>Liste des Catégories</h1>

    <ul>
        <?php foreach ($categories as $categorie): ?>
            <li>
                <?php echo $categorie->getNom(); ?> (<?php echo $categorie->getCodeRaccourci(); ?>)
                <a href="?action=update&id=<?php echo $categorie->getId(); ?>">Modifier</a>
                <a href="?action=delete&id=<?php echo $categorie->getId(); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="createCategorie">Créer une Catégorie</a>
</body>
</html>
