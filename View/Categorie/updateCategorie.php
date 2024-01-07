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
    <title>Modifier Catégorie</title>
</head>
<body>
    <h1>Modifier Catégorie</h1>

    <form action="index.php?action=updateCategorie" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="codeRaccourci">Code Raccourci:</label>
        <input type="text" id="codeRaccourci" name="codeRaccourci" required>

        <button type="submit">Sauvegarder</button>
        <a href="listCategorie">Annuler</a>
    </form>
</body>
</html>
