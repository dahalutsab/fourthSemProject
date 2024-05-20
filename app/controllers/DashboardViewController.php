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

    public function addMedia(): void
    {
        $pageTitle = 'Artist Media';
        $content = 'add-media';
        $this->render(compact('pageTitle', 'content'));
    }

    public function manageMedia(): void
    {
        $pageTitle = 'Manage Media';
        $content = 'artist-media-management';
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard_main.php';
    }
}
