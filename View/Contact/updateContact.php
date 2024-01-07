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
    <title>Modifier Contact</title>
</head>
<body>
    <h1>Modifier Contact</h1>

    <form action="index.php?action=updateContact" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="numero_tel">Numéro de Téléphone :</label>
        <input type="tel" id="numero_tel" name="numero_tel" required>

        <!-- Ajoutez un champ masqué pour l'ID -->
        <input type="hidden" name="id" value="">

        <button type="submit">Sauvegarder</button>
        <a href="listeContacts">Annuler</a>
    </form>
</body>
</html>
