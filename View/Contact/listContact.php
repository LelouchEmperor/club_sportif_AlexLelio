<?php
// Vérifier si l'utilisateur est connecté
// session_start();
// if (!isset($_SESSION['utilisateur_id'])) {
//     // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
//     header('Location: login');
//     exit();
// }
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
        <h1 class="mb-3">Liste des Contacts</h1>

        <ul>
            <?php foreach ($contacts as $contact): ?>
                <li>
                    <strong><?php echo htmlspecialchars($contact->getNom()); ?></strong>
                    (<?php echo htmlspecialchars($contact->getPrenom()); ?>)
                    (<?php echo htmlspecialchars($contact->getEmail()); ?>)
                    <a href="index.php?action=displayFormUpdateContact&id=<?php echo $contact->getId(); ?>" class="btn btn-warning btn-sm">Modifier</a>
                    <a href="index.php?action=deleteContact&id=<?php echo $contact->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette contact ?')">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="createContact" class="btn btn-primary">Créer un Contact</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>