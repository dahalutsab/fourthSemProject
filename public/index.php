<?php

require __DIR__ . '/../vendor/autoload.php';
$routes = require_once '../app/Routes.php'; // Optional: Load routes from separate file (or define them directly in the constructor of Router)

$router = new App\Router($routes); // Inject routes if they are loaded from a file

$router->run();

