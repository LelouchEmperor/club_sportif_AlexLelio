<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue sur le site d'Alex et Lelio</h1>
    <p>Vous êtes connecté en tant que <?php echo $_SESSION['email']; ?></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>