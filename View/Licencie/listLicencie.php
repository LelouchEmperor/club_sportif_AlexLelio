<?php


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Contacts</title>
    <!-- Ajouter le lien vers Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
            padding: 10px;
        }

        li a {
            margin-left: 10px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-3">Liste des Licenciés</h1>

        <ul>
            <?php foreach ($licencies as $licencie): ?>
                <li>
                    <strong><?php echo htmlspecialchars($licencie->getNom()); ?></strong>
                    (<?php echo htmlspecialchars($licencie->getPrenom()); ?>)
                    <a href="index.php?action=displayFormUpdateLicencie&id=<?php echo $licencie->getId(); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="index.php?action=deleteLicencie&id=<?php echo $licencie->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette licencie ?')">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="createLicencie" class="btn btn-primary">Créer un Licencié</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
