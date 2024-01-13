<!-- view/Categorie/showCategorie.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afficher Catégorie</title>
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
        <h1 class="mt-5 mb-4">Afficher Catégorie</h1>

        <div class="form-group">
            <label for="nom">Nom de la Catégorie :</label>
            <p class="form-control-static"><?php echo $categorie->getNom(); ?></p>
        </div>

        <div class="form-group">
            <label for="codeRaccourci">Code Raccourci :</label>
            <p class="form-control-static"><?php echo $categorie->getCodeRaccourci(); ?></p>
        </div>
        <!-- view/Categorie/showCategorie.php -->

        <!-- ... Ton code HTML existant ... -->

        <h2>Licenciés de la Catégorie</h2>

        <?php if (!empty($licencies)): ?>
            <ul>
                <?php foreach ($licencies as $licencie): ?>
                    <li><?php echo $licencie->getNom(); ?> - <?php echo $licencie->getPrenom(); ?></li>
                    <!-- Ajoute d'autres champs ou ajuste la structure selon les besoins -->
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun licencié trouvé pour cette catégorie.</p>
        <?php endif; ?>

        <!-- ... Ton code HTML existant ... -->


        <!-- Ajoute ici les liens pour supprimer et afficher la catégorie -->
        <a href="index.php?page=categorie&action=deleteCategorie&id=<?php echo $categorie->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette catégorie ?')">Supprimer</a>

        <div class="form-group">
            <a href="index.php?page=categorie&action=display" class="btn btn-secondary">Retour à la Liste</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
