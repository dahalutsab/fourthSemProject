<?php

namespace app\controllers;


use config\Database;
use JetBrains\PhpStorm\NoReturn;

class DashboardViewController
{
    private Database $database;
    public function __construct()
    {
        $this->database = new Database();
    }

    public function dashboard(): void
    {
        $pageTitle = 'Dashboard';
        $content = 'dashboard';
        $this->render(compact('pageTitle', 'content'));
    }

    public function profile(): void
    {
        $pageTitle = 'Profile';
        $content = 'dashboard_profile';
        $this->render(compact('pageTitle', 'content'));
    }

    public function addMedia(): void
    {
        $pageTitle = 'admin_media/Artist Media';
        $content = 'admin_media/add_artist_media';
        $this->render(compact('pageTitle', 'content'));
    }

    public function manageMedia(): void
    {
        $pageTitle = 'Manage Media';
        $content = 'admin_media/artist-media-management';
        $this->render(compact('pageTitle', 'content'));
    }

    public function addPerformance(): void
    {
        $pageTitle = 'Add Performance';
        $content = 'artist_performance/add_artist_performance_types';
        $this->render(compact('pageTitle', 'content'));
    }

    public function managePerformance(): void
    {
        $pageTitle = 'Manage Performance';
        $content = 'artist_performance/view_all_artist_performance_types';
        $this->render(compact('pageTitle', 'content'));
    }

    public function bookArtist(): void
    {
        $pageTitle = 'Book Artist';
        $content = 'artist_booking/artist_booking_form';
        $this->render(compact('pageTitle', 'content'));
    }

    public function paymentPage(): void
    {
        $pageTitle = 'Payment';
        $content = 'payment/payment_page';
        $this->render(compact('pageTitle', 'content'));
    }

    public function paymentSuccess(): void
    {
        $pageTitle = 'Payment Success';
        $content = 'payment/payment_success';
        $this->render(compact('pageTitle', 'content'));
    }

    public function paymentFailure(): void
    {
        $pageTitle = 'Payment Failed';
        $content = 'payment/payment_failure';
        $this->render(compact('pageTitle', 'content'));
    }

    public function userBookings(): void
    {
        $pageTitle = 'User Bookings';
        $content = 'user_bookings/user_bookings';
        $this->render(compact('pageTitle', 'content'));
    }

    public function messages(): void
    {
        $pageTitle = 'Messages';
        $content = 'message';
        $this->render(compact('pageTitle', 'content'));
    }

    public function comments(): void
    {
        $pageTitle = 'Comments';
        $content = 'ratings_and_review';
        $this->render(compact('pageTitle', 'content'));
    }


    public function addUser(): void
    {
        $pageTitle = 'Add User';
        $content = 'user_management/add_user';
        $this->render(compact('pageTitle', 'content'));
    }

    public function manageUser(): void
    {
        $pageTitle = 'Manage User';
        $content = 'user_management/manage_user';
        $this->render(compact('pageTitle', 'content'));
    }

    public function artistBookingsList(): void
    {
        $pageTitle = 'Artist Bookings';
        $content = 'artist_booking/artist_booking_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function artistPaymentsList(): void
    {
        $pageTitle = 'Artist Payments';
        $content = 'artist_booking/artist_payment_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function userBookingsList(): void
    {
        $pageTitle = 'User Bookings';
        $content = 'artist_booking/user_bookings_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function userPaymentsList(): void
    {
        $pageTitle = 'User Payments';
        $content = 'artist_booking/user_payment_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function viewAllBookings(): void
    {
        $pageTitle = 'All Bookings';
        $content = 'artist_booking/admin_all_booking_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function viewBookingDetails(): void
    {
        $pageTitle = 'Booking Details';
        $content = 'artist_booking/view_booking_details';
        $this->render(compact('pageTitle', 'content'));
    }

    public function viewAllUsers(): void
    {
        $pageTitle = ' All Users';
        $content = 'admin/users_list';
        $this->render(compact('pageTitle', 'content'));
    }

    public function viewContactUsMessages(): void
    {
        $pageTitle = 'Contact Us Messages';
        $content = 'admin/contact_us_messages';
        $this->render(compact('pageTitle', 'content'));
    }

    public function userInfo(): void
    {
        $pageTitle = 'User Info';
        $content = '../components/user_info';
        $this->render(compact('pageTitle', 'content'));
    }

    private function render(array $data): void
    {
        extract($data);
        require_once __DIR__ . '/../views/layouts/dashboard_main.php';
    }


    #[NoReturn] public function deleteAllTables(): void
    {
        $connection = $this->database->getConnection();
        $result = $connection->query("SHOW TABLES");

        if ($result) {
            while ($row = $result->fetch_array()) {
                $table = $row[0];
                $connection->query("DROP TABLE IF EXISTS $table CASCADE");
            }
        }

        header("Location: /login");
        exit();
    }

}
