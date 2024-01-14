<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Mails</title>
</head>
<body>
    <h1>Liste des Mails</h1>

    <ul>
        <?php foreach ($mails as $mail): ?>
            <li>
                <strong>Date d'envoi:</strong> <?php echo $mail->getDateEnvoi(); ?>,
                <strong>Objet:</strong> <?php echo $mail->getObjet(); ?>,
                <strong>Message:</strong> <?php echo $mail->getMessage(); ?>
                <a href="index.php?page=mailedu&action=deleteMail&id=<?php echo $mail->getId(); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce mail ?')">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
