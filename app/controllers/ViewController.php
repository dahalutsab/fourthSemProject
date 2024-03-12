<?php

namespace App\Controllers;

class ViewController
{
    public function index(): void
    {
        $pageTitle = 'Homepage';
        $content = ['components/home', 'components/artists', 'components/contactUs']; // Add 'artists' to the content array
        $this->render(compact('pageTitle', 'content'));
    }

    public function signup(): void
    {
        $pageTitle = 'Signup';
        $content = ['pages/signup']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }

    public function login(): void
    {
        $pageTitle = 'Login';
        $content = ['pages/login']; // Make $content an array
        $this->render(compact('pageTitle', 'content'));
    }

    public function aboutUs(): void
    {
        $pageTitle = 'About Us';
        $content = ['pages/aboutUs'];
        $this->render(compact('pageTitle', 'content'));
    }

    public function profile(): void
    {
        $pageTitle = 'Artist Details';
        $content = ['pages/artist_details']; // Make $content an array
        $artistId = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $this->render(compact('pageTitle', 'content', 'artistId'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/main.php';
    }
}