

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
        <h1 class="mt-5 mb-4">Créer un Éducateur</h1>

        <form action="../../index.php?action=updateEducateur&page=educateur&id=<?php echo $educateur->getId(); ?>" method="post">
    <?php if (!empty($licencies) && is_array($licencies)): ?>
        <label for="nom_categorie" class="form-label">Licencié:</label>
        <select class="selectpicker form-control" required name="licencieID">
            <option>Choisissez le licencié</option>
            <?php foreach ($licencies as $licencie): ?>
                <option value="<?php echo $licencie->getId(); ?>"><?php echo $licencie->getNom() . " " . $licencie->getPrenom(); ?></option>
            <?php endforeach; ?> 
        </select>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" required name="email" placeholder="Entrez l'email">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe:</label>
            <input type="password" class="form-control" required name="password" placeholder="Entrez le mot de passe">
        <div class="form-group">

            <label for="admin">Administrateur:</label>
            <select class="selectpicker form-control" required name="admin">
                <option>Voulez-vous que cette personne soit admin ?</option>
                <option value="Oui">Oui</option>
                <option value="Non">Non</option>
            </select>

        </div>

        <button type="submit" class="btn btn-primary" name="action">Créer</button>
        <button type="reset" class="btn btn-secondary">Annuler</button>
            </form>
    <?php else: ?>
        <p>Aucun licencié disponible.</p>
    <?php endif; ?>
</form>
    </div>

    <!-- Ajouter le lien vers Bootstrap JS et jQuery pour les fonctionnalités avancées -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
