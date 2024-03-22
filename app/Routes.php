<?php
declare(strict_types=1);

use App\controllers\AuthController;
use App\controllers\DashboardViewController;
use App\controllers\UserController;
use App\Controllers\UserDetailsController;
use App\controllers\ViewController;
use App\Router;
use App\service\implementation\MailerService;
use App\service\implementation\OtpService;
use App\service\implementation\UserService;

$router = new Router();

$userService = new UserService();
$otpService = new OtpService();
$mailerService = new MailerService();

// Create an instance of UserController with the required dependencies
$userController = new UserController($userService, $otpService, $mailerService);
//route to home
$router->get('/', ViewController::class . '::index');
$router->get('/home', ViewController::class . '::index');


//route to signup
$router->get('/signup', ViewController::class . '::signup');
$router->post('/signup', $userController::class . '::signup');


//route to log in
$router->get('/login', ViewController::class . '::login');
$router->post('/login', AuthController::class . '::login');

//route to log out
$router->get('/logout', AuthController::class . '::logout');


//route to otp verification
$router->get('/verify-otp', ViewController::class . '::verifyOtp', '/signup');
$router->post('/verify-otp', $userController::class . '::verifyOtp');


//route to artist details
$router->get('/artist-details', ViewController::class . '::artistDetails');
$router->post('/artist-details', $userController::class . '::artistDetails');


$router->get('/dashboard', DashboardViewController::class . '::dashboard', '/login');

$router->get('/profile', DashboardViewController::class . '::profile', '/login');
$router->post('/dashboard/updateProfile', UserDetailsController::class . '::editProfile', '/login');

// Route for fetching user details
$router->get('/user-details', function($request, $response) {
    return UserDetailsController::class->getUserDetails(); // Replace with your actual method
});


//route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.phtml';
});

$router->run();
