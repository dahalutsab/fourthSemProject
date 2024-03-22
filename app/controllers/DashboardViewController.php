<?php

namespace App\controllers;

use App\controllers\UserDetailsController;
use Exception;

class DashboardViewController
{
    public function dashboard(): void
    {
        try {
            // Instantiate UserDetailsController to access the getUserProfile method
            $userDetailsController = new UserDetailsController();

            // Call getUserProfile to fetch the user's profile data
            $userProfile = $userDetailsController->getUserProfile();

            // Pass the user profile data to the view
            $pageTitle = 'Dashboard';
            $content = ['pages/dashboard']; // Assuming you have a dashboard view file
            $this->render(compact('pageTitle', 'content', 'userProfile'));
        } catch (Exception $exception) {
            // Handle exceptions, e.g., log or display error message
            echo "Error: " . $exception->getMessage();
        }
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard.php';
    }
}
