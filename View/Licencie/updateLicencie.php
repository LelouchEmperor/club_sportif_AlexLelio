

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Licencié</title>
</head>
<body>
    <h1>Modifier Licencié</h1>

    <form action="index.php?action=updateLicencie&page=licencie&id=<?php echo $licencie->getId(); ?>" method="post">

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" value="<?php echo $licencie->getNom(); ?>" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" value="<?php echo $licencie->getPrenom(); ?>" required>

    <label for="numeroLicence">Numéro de Licence :</label>
    <input type="text" id="numeroLicence" name="numeroLicence" value="<?php echo $licencie->getNumeroLicence(); ?>" required>

    <label for="contactId">ID du Contact :</label>
    <input type="text" id="contactId" name="contactId" value="<?php echo $licencie->getContactID(); ?>" required>

    <label for="categorieId">ID de la Catégorie :</label>
    <input type="text" id="categorieId" name="categorieId" value="<?php echo $licencie->getCategorieID(); ?>" required>

    <button type="submit" name="action">Sauvegarder</button>
    <a href="listLicencie">Annuler</a>
</form>
</body>
</html>
