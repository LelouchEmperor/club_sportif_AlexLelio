<?php

namespace App\Controller;

use Twig\Environment;


class DashboardController {
    private $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function showDashboard() {
        // Vous pouvez ajouter des logiques supplémentaires ici si nécessaire
        echo $this->twig->render('dashboard.html.twig');
    }
}
