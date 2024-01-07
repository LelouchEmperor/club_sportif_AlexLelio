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
    <title>Liste des Éducateurs</title>
</head>
<body>
    <h1>Liste des Éducateurs</h1>

    <ul>
        <?php foreach ($educateurs as $educateur): ?>
            <li>
                <?= $educateur->getPrenom() ?> <?= $educateur->getNom() ?> (<?= $educateur->getEmail() ?>)
                <a href="?action=modifier&id=<?= $educateur->getId() ?>">Modifier</a>
                <a href="?action=supprimer&id=<?= $educateur->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet éducateur ?')">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="createEducateur">Créer un Éducateur</a>
</body>
</html>