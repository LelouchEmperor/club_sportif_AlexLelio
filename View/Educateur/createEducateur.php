

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Éducateur</title>
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
        <h1 class="mt-5 mb-4">Créer Éducateur</h1>

        <form action="../../index.php?page=educateur&action=createEducateur" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="numero_tel">Numéro de Téléphone :</label>
                <input type="tel" class="form-control" id="numeroTel" name="numeroTel" required>
            </div>

            <div class="form-group">
                <label for="motDePasse">Mot de Passe :</label>
                <input type="password" class="form-control" id="motDePasse" name="motDePasse" required>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="admin" name="admin">
                    <label class="form-check-label" for="admin">Administrateur</label>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Créer</button>
                <a href="../../index.php?page=educateur&action=display" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>

    <!-- Ajouter le lien vers Bootstrap JS et jQuery pour les fonctionnalités avancées -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
