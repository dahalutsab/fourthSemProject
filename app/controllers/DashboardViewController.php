<?php

namespace App\controllers;


class DashboardViewController
{
    public function dashboard(): void
    {
        $pageTitle = 'Dashboard';
        $content = 'dashboard';
        $this->render(compact('pageTitle', 'content'));
    }

    public function profile(): void
    {
        $pageTitle = 'Profile';
        $content = 'dashboard_profile';
        $this->render(compact('pageTitle', 'content'));
    }

    public function media(): void
    {
        $pageTitle = 'Artist Media';
        $content = 'artist-media-management'; // Assuming you have a dashboard view file
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard_main.php';
    }
}
