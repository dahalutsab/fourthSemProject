<?php

namespace app\controllers;

class ViewController
{
    public function index(): void
    {
        $pageTitle = 'Homepage';
        $content = ['components/home', 'components/artists', 'components/contactUs']; // Add 'artists' to the content array
        $this->render(compact('pageTitle', 'content'));
    }

    public function login(): void
    {
        $pageTitle = 'Login';
        $content = ['pages/auth/login']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }
    public function signup(): void
    {
        $pageTitle = 'Signup';
        $content = ['pages/auth/signup']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }

    public function verifyOtp(): void
    {
        $pageTitle = 'Verify OTP';
        $content = ['pages/auth/otp']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }



    public function aboutUs(): void
    {
        $pageTitle = 'About Us';
        $content = ['pages/aboutUs'];
        $this->render(compact('pageTitle', 'content'));
    }

    public function artistDetails(): void
    {
        $pageTitle = 'Artist Details';
        $content = ['pages/artist_details']; // Make $content an array
        $artistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->render(compact('pageTitle', 'content', 'artistId'));
    }


    public function accessDenied(): void
    {
        $pageTitle = 'Access Denied';
        $content = ['error/accessDenied']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
//        require_once __DIR__ . '/../views/layouts/dashboard_main.php';
    }
}