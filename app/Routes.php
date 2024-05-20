<?php
declare(strict_types=1);

use App\controllers\AuthController;
use App\controllers\CategoryController;
use App\controllers\DashboardViewController;
use App\controllers\MediaController;
use App\controllers\RoleController;
use App\controllers\UserController;
use App\Controllers\ArtistDetailsController;
use App\controllers\UserDetailsController;
use App\controllers\ViewController;
use App\Router;
use App\service\implementation\MailerService;
use App\service\implementation\OtpService;
use App\service\implementation\UserService;

$router = new Router();

$userService = new UserService();
$otpService = new OtpService();
$mailerService = new MailerService();

//route to home
$router->get('/', ViewController::class . '::index');
$router->get('/home', ViewController::class . '::index');
$router->get('api/v1/home', ViewController::class . '::index');


//route to signup
$router->get('/signup', ViewController::class . '::signup');
$router->post('/api/user/create-user', UserController::class . '::signup');
$router->get('/api/user/get-user', UserController::class . '::getUser');

//route to log in
$router->get('/login', ViewController::class . '::login');
$router->post('/login', AuthController::class . '::login');

//route to log out
$router->get('/logout', AuthController::class . '::logout');


//route to otp verification
$router->get('/verify-otp', ViewController::class . '::verifyOtp');
$router->post('/api/user/verify-otp', UserController::class . '::verifyOtp');


//route to artist details
$router->get('/artist-details', ViewController::class . '::artistDetails');
$router->post('/artist-details', UserController::class . '::artistDetails');
$router->post('/api/artistDetails/updateProfilePicture', ArtistDetailsController::class . '::saveProfilePicture');

$router->get('/api/userDetails/getUserDetails', UserDetailsController::class . '::getUserProfile');
$router->post('/api/userDetails/updateProfile', UserDetailsController::class . '::editProfile');
$router->post('/api/userDetails/updateProfilePicture', UserDetailsController::class . '::saveProfilePicture');

$router->get('/dashboard', DashboardViewController::class . '::dashboard', '/login');
$router->get('/dashboard/media/add', DashboardViewController::class . '::addMedia', '/login');
$router->get('/dashboard/media/manage', DashboardViewController::class . '::manageMedia', '/login');
$router->get('/dashboard/profile', DashboardViewController::class . '::profile', '/login');

$router->get('/profile', DashboardViewController::class . '::profile', '/login');
$router->get('/api/artistDetails/getUserDetails', ArtistDetailsController::class . '::getUserProfile');
$router->post('/api/artistDetails/updateProfile', ArtistDetailsController::class . '::editProfile', '/login');

$router->get('/api/categories/getAllCategories', CategoryController::class . '::getAllCategories');
$router->get('/api/categories/getCategoryById', CategoryController::class . '::getCategoryById');


//media management routes
$router->post('/api/media/save-media', MediaController::class . '::saveMedia');
$router->get('/api/media/get-media', MediaController::class . '::getMedia');
$router->get('/api/media/get-all-media', MediaController::class . '::getAllMedia');
$router->get('/api/media/get-media-by-user', MediaController::class . '::getMediaByUser');
$router->post('/api/media/delete-media', MediaController::class . '::deleteMedia');

$router->get('/api/roles/get-roles', RoleController::class . '::getRolesForUsers');


//route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.php';
});

$router->run();
