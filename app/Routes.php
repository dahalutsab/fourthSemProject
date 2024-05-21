<?php
declare(strict_types=1);

use App\controllers\ErrorViewController;
use App\Interceptor\Interceptor;
use App\Router;
use App\controllers\AuthController;
use App\controllers\CategoryController;
use App\controllers\DashboardViewController;
use App\controllers\MediaController;
use App\controllers\RoleController;
use App\controllers\UserController;
use App\Controllers\ArtistDetailsController;
use App\controllers\UserDetailsController;
use App\controllers\ViewController;

require_once __DIR__ . '/../vendor/autoload.php';
$admin = 'ADMIN';
$artist = 'ARTIST';
$user = 'USER';

$roleRestrictedPaths = [
    '/api/admin' => [$admin],
    '/api/artist' => [$artist, $admin],
    '/api/user' => [$user, $artist, $admin],
    '/api/media/delete-media' => [$admin],
    '/api/media/save-media' => [$artist, $admin],
    '/api/artistDetails/updateProfile' => [$artist, $admin],
    '/api/artistDetails/updateProfilePicture' => [$artist, $admin],
    '/api/userDetails/updateProfile' => [$user, $artist, $admin],
    '/api/userDetails/updateProfilePicture' => [$user, $artist, $admin],
    '/api/media/get-media-by-user' => [$artist],
];


$loginRequiredPaths = [
    '/dashboard',
    '/dashboard/media/add',
    '/dashboard/media/manage',
    '/api/media/get-media-by-user',
    '/dashboard/profile',
    '/profile',
    '/api/artistDetails/updateProfile',
    '/api/artistDetails/updateProfilePicture'
];
// Instantiate the Interceptor
$interceptor = new Interceptor($roleRestrictedPaths, $loginRequiredPaths);

// Instantiate the Router with the Interceptor
$router = new Router($interceptor);


// Define your routes
// route to home
$router->get('/', [ViewController::class, 'index']);
$router->get('/home', [ViewController::class, 'index']);
$router->get('api/v1/home', [ViewController::class, 'index']);

// route to signup
$router->get('/signup', [ViewController::class, 'signup']);
$router->post('/api/user/create-user', [UserController::class, 'signup']);
$router->get('/api/user/get-user', [UserController::class, 'getUser']);

// route to log in
$router->get('/login', [ViewController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);

// route to log out
$router->get('/logout', [AuthController::class, 'logout']);

// route to otp verification
$router->get('/verify-otp', [ViewController::class, 'verifyOtp']);
$router->post('/api/user/verify-otp', [UserController::class, 'verifyOtp']);

// route to artist details
$router->get('/artist-details', [ViewController::class, 'artistDetails']);
$router->post('/artist-details', [UserController::class, 'artistDetails']);


// route to user details
$router->get('/api/userDetails/getUserDetails', [UserDetailsController::class, 'getUserProfile']);
$router->post('/api/userDetails/updateProfile', [UserDetailsController::class, 'editProfile']);
$router->post('/api/userDetails/updateProfilePicture', [UserDetailsController::class, 'saveProfilePicture']);

// route to dashboard
$router->get('/dashboard', [DashboardViewController::class, 'dashboard'], [], '/login');
$router->get('/dashboard/media/add', [DashboardViewController::class, 'addMedia']);
$router->get('/dashboard/media/manage', [DashboardViewController::class, 'manageMedia']);
$router->get('/dashboard/profile', [DashboardViewController::class, 'profile']);

// route to profile
$router->get('/profile', [DashboardViewController::class, 'profile'], [], '/login');
$router->get('/api/artistDetails/getUserDetails', [ArtistDetailsController::class, 'getUserProfile']);
$router->post('/api/artistDetails/updateProfile', [ArtistDetailsController::class, 'editProfile']);
$router->get('/api/artistDetails/getAllArtists', [ArtistDetailsController::class, 'getAllArtists']);
$router->post('/api/artistDetails/updateProfilePicture', [ArtistDetailsController::class, 'saveProfilePicture']);
$router->get('/api/artistDetails/{id}', [ArtistDetailsController::class, 'getArtistById']);

// route to categories
$router->get('/api/categories/getAllCategories', [CategoryController::class, 'getAllCategories']);
$router->get('/api/categories/getCategoryById', [CategoryController::class, 'getCategoryById']);

// media management routes
$router->post('/api/media/save-media', [MediaController::class, 'saveMedia'], [$artist]);
$router->get('/api/media/get-media', [MediaController::class, 'getMedia'], [$artist]);
$router->get('/api/media/get-all-media', [MediaController::class, 'getAllMedia']);
$router->post('/api/media/delete-media', [MediaController::class, 'deleteMedia'], ['admin']);
$router->get('/api/media/get-media-by-user', [MediaController::class, 'getMediaByUser'], [$artist], '/access-denied');
$router->get('/api/media/get-media-by-artist-id/{artistId}', [MediaController::class, 'getMediaByArtistId']);

// roles management routes
$router->get('/api/roles/get-roles', [RoleController::class, 'getRolesForUsers']);


// route to access denied
$router->get('/access-denied', [ErrorViewController::class, 'accessDenied']);
// route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.php';
});



$router->run();
