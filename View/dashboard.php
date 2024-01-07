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
    <title>Dashboard</title>
</head>
<body>
    <h1>Tableau de Bord</h1>

    <ul>
        <li><a href="listCategorie">Liste des Catégories</a></li>
        <li><a href="listContact">Liste des Contacts</a></li>
        <li><a href="listEducateur">Liste des Éducateurs</a></li>
        <li><a href="listLicencie">Liste des Licenciés</a></li>
    </ul>
</body>
</html>
