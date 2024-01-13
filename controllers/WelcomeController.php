<?php
class WelcomeController {

    public function display() {
        header('Location: view/Welcome.php');
        exit();
    }
}


?>

