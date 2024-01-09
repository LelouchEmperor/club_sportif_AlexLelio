<?php
// // Vérifier si l'utilisateur est connecté
// session_start();
// if (!isset($_SESSION['utilisateur_id'])) {
//     // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
//     header('Location: login');
//     exit();
// }
// ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Catégorie</title>
</head>
<body>
    <h1>Créer Catégorie</h1>

    <form action="index.php?action=createCategorie" method="post">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom" required>

        <label for="code_raccourci">Code Raccourci:</label>
        <input type="text" id="code_raccourci" name="code_raccourci" required>

        <button type="submit">Créer</button>
        <a href="listCategorie">Annuler</a>
    </form>
</body>
</html>
