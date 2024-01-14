<form action="index.php?page=mailedu&action=sendMail" method="post">
    <?php if (!empty($otherEducateurs)): ?>
        <?php foreach ($otherEducateurs as $educateur): ?>
            <label>
                <input type="checkbox" name="selected_educateurs[]" value="<?= $educateur['educ']->getId(); ?>">
                <?= $educateur['educ']->getEmail(); ?>
            </label><br>
        <?php endforeach; ?>
        <label>
            Objet:
            <input type="text" name="objet">
        </label><br>
        <label>
            Message:
            <textarea name="message" rows="4" cols="50"></textarea>
        </label><br>
        <input type="submit" value="Envoyer">
    </form>
<?php else: ?>
    <p>Aucun éducateur trouvé.</p>
<?php endif; ?>
