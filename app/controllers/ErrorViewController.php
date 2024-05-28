<?php

namespace app\controllers;

class ErrorViewController
{
    public function notFound(): void
    {
        $pageTitle = '404 Not Found';
        $content = ['pages/404'];
    }

    public function accessDenied(): void
    {
        $pageTitle = 'Access Denied';
        $content = ['pages/accessDenied'];
        require_once __DIR__ . '/../views/error/accessDenied.php';
   }

}