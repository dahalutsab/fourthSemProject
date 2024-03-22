<?php

namespace App\controllers;

use App\controllers\UserDetailsController;
use Exception;

class DashboardViewController
{
    public function dashboard(): void
    {
        $pageTitle = 'Dashboard';
        $content = ['pages/dashboard']; // Assuming you have a dashboard view file
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard.php';
    }
}
