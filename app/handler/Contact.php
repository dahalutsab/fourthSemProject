<?php

declare(strict_types=1);
namespace App\Handler;

class Contact
{
    public function execute(): void
    {
        require_once __DIR__ . '/../views/error/contact.phtml';
    }
}