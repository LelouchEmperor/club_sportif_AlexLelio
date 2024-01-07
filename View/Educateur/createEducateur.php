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
    <title>Créer Éducateur</title>
</head>
<body>
    <h1>Créer Éducateur</h1>

    <form action="index.php?action=createEducateur" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" required>

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="numero_tel">Numéro de Téléphone :</label>
        <input type="tel" id="numero_tel" name="numero_tel" required>

        <label for="mot_de_passe">Mot de Passe :</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <label for="is_admin">Administrateur :</label>
        <input type="checkbox" id="is_admin" name="is_admin">

        <button type="submit">Créer</button>
        <a href="listeEducateurs">Annuler</a>
    </form>
</body>
</html>
