<?php
declare(strict_types=1);

use App\controllers\BookingController;
use App\controllers\ErrorViewController;
use App\controllers\EsewaIntegration;
use App\controllers\LocationController;
use App\controllers\PerformanceTypesController;
use App\Interceptor\Interceptor;
use App\payment\KhaltiIntegration;
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


//$loginRequiredPaths = [
//    '/dashboard',
//    '/dashboard/media/add',
//    '/dashboard/media/manage',
//    '/api/media/get-media-by-user',
//    '/dashboard/profile',
//    '/profile',
//    '/api/artistDetails/updateProfile',
//    '/api/artistDetails/updateProfilePicture'
//];
$loginRequiredPaths = [
    '/dashboard',
    '/dashboard/.*' // This pattern matches all paths starting with '/dashboard/'
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
$router->get('/api/artistDetails/getAllArtistsByCategory/{categoryId}', [ArtistDetailsController::class, 'getAllArtistsByCategory']);

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

$router->get('/dashboard/performance/add', [DashboardViewController::class, 'addPerformance']);
$router->get('/dashboard/performance/manage', [DashboardViewController::class, 'managePerformance']);
$router->post('/api/artistPerformance/save-artist-performance', [PerformanceTypesController::class, 'saveArtistPerformance']);
$router->get('/api/artistPerformance/get-artist-performance/{artistId}', [PerformanceTypesController::class, 'getArtistPerformance']);
$router->post('/api/artistPerformance/update-artist-performance/{id}', [PerformanceTypesController::class, 'updateArtistPerformance']);
$router->post('/api/artistPerformance/delete-artist-performance/{id}', [PerformanceTypesController::class, 'deleteArtistPerformance']);

$router->get('/dashboard/book-artist/{booking_type_id}', [DashboardViewController::class, 'bookArtist']);
$router->post('/api/artistPerformance/calculate-cost/{performance_type_id}', [PerformanceTypesController::class, 'getCostPerHour']);

//locations
$router->get('/api/getProvinces', [LocationController::class, 'getAllProvinces']);
$router->get('/api/getDistricts/{provinceId}', [LocationController::class, 'getDistrictsByProvinceId']);
$router->get('/api/getMunicipalities/{districtId}', [LocationController::class, 'getMunicipalitiesByDistrictId']);

//bookings
$router->post('/api/artistPerformance/book/{performanceTypeId}', [BookingController::class, 'saveBooking']);
$router->get('/dashboard/payment/{bookingId}', [DashboardViewController::class, 'paymentPage']);
$router->get('/api/booking/get-booking/{bookingId}', [BookingController::class, 'getBookingById']);

//esewa
$router->post('/api/generate-signature', [EsewaIntegration::class, 'generateSignature']);
//payment success/failure
$router->get('/dashboard/payment/success', [DashboardViewController::class, 'paymentSuccess']);
$router->get('/dashboard/payment/failure', [DashboardViewController::class, 'paymentFailure']);

$router->post('/payment/khalti', [KhaltiIntegration::class, 'initiate']);
$router->get('/payment/khalti-response', [KhaltiIntegration::class, 'response']);
// route to access denied
$router->get('/access-denied', [ErrorViewController::class, 'accessDenied']);
// route to 404 if any error
$router->addNotFoundHandler(function () {
    $title = '404 - Not Found';
    require_once __DIR__ . '/../app/views/error/404.php';
});



$router->run();
