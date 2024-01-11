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
    <!-- Ajouter le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        /* Ajouter un peu d'espace autour du formulaire */
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Créer Catégorie</h1>

        <form action="index.php?action=createCategorie" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="codeRaccourci">Code Raccourci :</label>
                <input type="text" class="form-control" id="codeRaccourci" name="codeRaccourci" required>
            </div>

            <div class="form-group">
                <button type="submit" href="listCategorie" class="btn btn-primary">Créer</button>
                <a href="listCategorie" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

