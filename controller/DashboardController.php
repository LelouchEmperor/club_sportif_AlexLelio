<?php

namespace Controller;

class DashboardController {
   
    public function display() {
        include("View/dashboard.php");
    }

    public function displayFormLogin(){
        if (isset($_SESSION['educateur_id'])) {
            header('Location: dashboard.php'); 
        }
        // Afficher le formulaire de création d'un éducateur
        include('View/Authentification/login.php');
    }
}
