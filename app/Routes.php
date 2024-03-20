<?php
declare(strict_types=1);

use App\controllers\AuthController;
use App\controllers\UserController;
use App\controllers\ViewController;
use App\Handler\Contact;
use App\Router;

$router = new Router();

//route to home
$router->get('/', ViewController::class . '::index');
$router->get('/home', ViewController::class . '::index');


//route to signup
$router->get('/signup', ViewController::class . '::signup');
$router->post('/signup', UserController::class . '::signup');


//route to log in
$router->get('/login', ViewController::class . '::login');
$router->post('/login', AuthController::class . '::login');

//route to log out
$router->get('/logout', AuthController::class . '::logout');


//route to otp verification
$router->get('/verify-otp', ViewController::class . '::verifyOtp', '/signup');
$router->post('/verify-otp', UserController::class . '::verifyOtp');


//route to artist details
$router->get('/artist-details', ViewController::class . '::artistDetails');
$router->post('/artist-details', UserController::class . '::artistDetails');


$router->get('/try', UserController::class . '::tryMail');

//route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.phtml';
});

$router->run();
