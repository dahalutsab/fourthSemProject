<?php

namespace App\Controllers;

class HomeController
{
    public function index(): void
    {
        $pageTitle = 'Homepage';
        require_once __DIR__ . '/../views/layouts/main.php'; // Include main layout
    }

    public function signup(): void
    {
        $pageTitle = 'Signup';
        require_once __DIR__ . '/../views/layouts/main.php'; // Include main layout
    }

    public function artistDetails(): void
    {
        $pageTitle = 'Artist Details'; // Set page title for template

        $artistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT); // Sanitize artist ID

        require_once __DIR__ . '/../views/layouts/main.php'; // Include main layout
    }

}
