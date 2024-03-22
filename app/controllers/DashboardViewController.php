<?php

namespace App\controllers;

class DashboardViewController
{
    public function dashboard(): void
    {
        $pageTitle = 'Dashboard';
        $content = ['pages/contactUs']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard.php';
    }
}