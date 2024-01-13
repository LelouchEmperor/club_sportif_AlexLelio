<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/login.css">
</head>
<body>
    

<form action="../../index.php?page=educateur&action=login" method="post">
            <h1>Connexion</h1>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="motDePasse">Mot de Passe:</label>
                <input type="password" id="motDePasse" name="motDePasse" class="form-control" required>
            </div>
            <?php

            if (isset($_GET['erreur'])) {
                $err = $_GET['erreur'];
                if ($err == 'loginORmdp')
                    echo "<p class='error'>Utilisateur ou mot de passe incorrect</p>";
            }
            ?>
            <button type="submit" href='' class="btn btn-primary">Se Connecter</button>
        </form>
    </div>
    <!-- Bootstrap JavaScript et scripts additionnels -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
