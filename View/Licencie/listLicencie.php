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
    <title>Liste des Licenciés</title>
</head>
<body>
    <h1>Liste des Licenciés</h1>

    <ul>
        <?php foreach ($licencies as $licencie): ?>
            <li>
                <?= $licencie->getPrenom() ?> <?= $licencie->getNom() ?> (<?= $licencie->getNumeroLicence() ?>)
                <a href="?action=modifier&id=<?= $licencie->getId() ?>">Modifier</a>
                <a href="?action=supprimer&id=<?= $licencie->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce licencié ?')">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <a href="createLicencie">Créer un Licencié</a>
</body>
</html>
