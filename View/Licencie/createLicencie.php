
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Licencié</title>
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
<body>
    <div class="container">
        <h1 class="mt-5 mb-4">Créer Licencié</h1>

        <form action="../../index.php?page=licencie&action=createLicencie" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" class="form-control" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" class="form-control" id="prenom" name="prenom" required>
            </div>

            <div class="form-group">
                <label for="numeroLicence">Numéro de Licence :</label>
                <input type="text" class="form-control" id="numeroLicence" name="numeroLicence" required>
            </div>

            <div class="form-group">
                <label for="contactId">ID du Contact :</label>
                <input type="text" class="form-control" id="contactId" name="contactId" required>
            </div>

            <div class="form-group">
                <label for="categorieId">ID de la Catégorie :</label>
                <input type="text" class="form-control" id="categorieId" name="categorieId" required>
            </div>

            <div class="form-group">
                <button type="submit" name="action" class="btn btn-primary">Créer</button>
                <a href="../../index.php?page=licencie&action=display" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    <!-- Ajouter le lien vers Bootstrap JS et jQuery pour les fonctionnalités avancées -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

