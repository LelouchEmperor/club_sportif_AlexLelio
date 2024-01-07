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
    <title>Créer Licencié</title>
</head>
<body>
    <h1>Créer Licencié</h1>

    <form action="index.php?action=createLicencie" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="numero_licence">Numéro de Licence :</label>
        <input type="text" id="numero_licence" name="numero_licence" required>

        <button type="submit">Créer</button>
        <a href="listLicencie">Annuler</a>
    </form>
</body>
</html>
