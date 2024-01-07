<?php
// Détruire la session et rediriger vers la page de connexion
session_start();
session_destroy();
header('Location: login.php');
exit();
?>
