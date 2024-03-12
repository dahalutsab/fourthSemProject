<?php
declare(strict_types=1);

use App\Controllers\UserController;
use App\Controllers\ViewController;
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
$router->post('/login', UserController::class . '::login');


//route to otp verification
$router->get('/verify-otp', ViewController::class . '::verifyOtp');
$router->post('/verify-otp', UserController::class . '::verifyOtp');


//route to artist details
$router->get('/profile', ViewController::class . '::profile');
$router->post('/profile', UserController::class . '::profile');


$router->get('/contact', Contact::class . '::execute');
$router->post('/contact', function () {
    UserController::class . '::contact';
    var_dump($_POST);
});


//route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.phtml';
});

$router->run();
