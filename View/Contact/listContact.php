

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
        <h1 class="mb-3">Liste des Contacts</h1>

        <table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Numéro de Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($contacts as $contact): ?>
            <tr>
                <td><?php echo $contact->getNom(); ?></td>
                <td><?php echo $contact->getPrenom(); ?></td>
                <td><?php echo $contact->getEmail(); ?></td>
                <td><?php echo $contact->getNumeroTel(); ?></td>
                <td>
                    <a href="index.php?page=contact&action=editContact&id=<?php echo $contact->getId(); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="index.php?page=contact&action=deleteContact&id=<?php echo $contact->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


        <a href="Contact/createContact.php" class="btn btn-primary">Créer un Contact</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>