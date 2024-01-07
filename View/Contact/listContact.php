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
    <title>Liste des Contacts</title>
</head>
<body>
    <h1>Liste des Contacts</h1>

    <ul>
        <?php foreach ($contacts as $contact): ?>
            <li>
                <?= $contact->getPrenom() ?> <?= $contact->getNom() ?> (<?= $contact->getEmail() ?>)
                <a href="?action=modifier&id=<?= $contact->getId() ?>">Modifier</a>
                <a href="?action=supprimer&id=<?= $contact->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="createContact">Créer un Contact</a>
</body>
</html>