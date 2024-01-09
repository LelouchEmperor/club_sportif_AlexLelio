<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php

    if (isset($_GET['erreur'])) {
        $erreur = $_GET['erreur'];
        switch ($erreur) {
            case 1:
                echo "<p style='color: red;'>Identifiants incorrects.</p>";
                break;
            case 2:
                echo "<p style='color: red;'>Vous n'avez pas les droits d'administration.</p>";
                break;
            default:
                echo "<p style='color: red;'>Une erreur inconnue s'est produite.</p>";
                break;
        }
    }
    ?>

    <form action="authentification.php" method="post">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="mot_de_passe">Mot de Passe:</label>
        <input type="password" id="mot_de_passe" name="mot_de_passe" required>

        <button type="submit">Se Connecter</button>
    </form>
</body>
</html>
