<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/welcome.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Bienvenue</h1>
        <p class="text-center">Que voulez-vous faire ?</p>

        <!-- Liste améliorée avec des éléments stylisés -->
        <ul class="list-group">
            <li class="list-group-item">
                <a href="index.php?page=educateur&action=display" class="btn btn-primary btn-block">Liste des Educateurs</a>
            </li>
            <li class="list-group-item">
                <a href="index.php?page=categorie&action=display" class="btn btn-success btn-block">Liste des Catégories</a>
            </li>
            <li class="list-group-item">
                <a href="index.php?page=contact&action=display" class="btn btn-warning btn-block">Liste des Contacts</a>
            </li>
            <li class="list-group-item">
                <a href="index.php?page=licencie&action=display" class="btn btn-danger btn-block">Liste des Licenciés</a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap JavaScript et scripts additionnels -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>