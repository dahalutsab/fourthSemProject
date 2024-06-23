<?php

namespace app\controllers;

use app\repository\implementation\BookingRepository;
use app\response\APIResponse;
use app\service\implementation\BookingService;
use app\service\implementation\MailerService;
use Exception;

class BookingController
{
    private BookingService $bookingService;

    public function __construct()
    {
        $bookingRepository = new BookingRepository();
        $this->bookingService = new BookingService($bookingRepository);
    }

    public function saveBooking(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $requestUri = $_SERVER['REQUEST_URI'];
                $uriPath = parse_url($requestUri, PHP_URL_PATH);
                $pathSegments = explode('/', $uriPath);
                $performanceTypeId = end($pathSegments);

                if (!is_numeric($performanceTypeId)) {
                    throw new Exception("Invalid performance type ID: $performanceTypeId");
                }

                // Read the raw input
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON data');
                }

                $data['performance_type_id'] = $performanceTypeId;
                $data['status'] = 'pending';
                $userId = $_SESSION[SESSION_USER_ID];
                $data['user_id'] = $userId;

                $booking = $this->bookingService->createBooking($data);

                 APIResponse::success($booking->toArray(),'Booking created successfully');

            } else {
                 APIResponse::error('Invalid request method');
            }
        } catch (\Exception $e) {
             APIResponse::error($e->getMessage());
        }
    }


    public function getBookingById(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $requestUri = $_SERVER['REQUEST_URI'];
                $uriPath = parse_url($requestUri, PHP_URL_PATH);
                $pathSegments = explode('/', $uriPath);

                $id = end($pathSegments);
                if (!is_numeric($id)) {
                    throw new Exception("Invalid performance type ID: $id");
                }
                $booking = $this->bookingService->getBookingById($id);
                if ($booking) {
                    APIResponse::success($booking->toArray(), 'Booking fetched successfully');
                } else {
                    APIResponse::error('Booking not found');
                }
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }


    public function updateStatus(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $updated = $this->bookingService->updateBookingStatus($id, $status);
                if ($updated) {
                    APIResponse::success($updated, 'Booking status updated successfully');
                } else {
                    APIResponse::error('Booking status update failed');
                }
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function userBookingsList(): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID];
            $bookings = $this->bookingService->getUserBookings($userId);
            APIResponse::success($bookings, 'User bookings fetched successfully');
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function artistBookingsList(): void
    {
        try {
            $artistId = $_SESSION[SESSION_USER_ID];
            $bookings = $this->bookingService->getArtistBookings($artistId);
            APIResponse::success($bookings, 'Artist bookings fetched successfully');
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function artistPaymentsList(): void
    {
        try {
            $artistId = $_SESSION[SESSION_USER_ID];
            $payments = $this->bookingService->getArtistPayments($artistId);
            APIResponse::success($payments, 'Artist payments fetched successfully');
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function userPaymentsList(): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID];
            $payments = $this->bookingService->getUserPayments($userId);
            APIResponse::success($payments, 'User payments fetched successfully');
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function getBookingDetails(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $bookingId = $_GET['id'];
                $booking = $this->bookingService->getBookingDetails($bookingId);
                if ($booking) {
                    APIResponse::success($booking, 'Booking details fetched successfully');
                } else {
                    APIResponse::error('Booking not found');
                }
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function rejectBooking(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON data');
                }

                $bookingId = $data['booking_id'];
                $this->bookingService->rejectBooking($bookingId);
                APIResponse::success("rejected", 'Booking rejected successfully');
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function acceptBooking(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON data');
                }

                $bookingId = $data['booking_id'];
                $this->bookingService->acceptBooking($bookingId);
                APIResponse::success("Accepted", 'Booking accepted successfully');
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function cancelBooking(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $input = file_get_contents('php://input');
                $data = json_decode($input, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Invalid JSON data');
                }

                $bookingId = $data['booking_id'];
                $this->bookingService->cancelBooking($bookingId);
                APIResponse::success("Cancelled", 'Booking cancelled successfully');
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    public function getAllBookings(): void
    {
        try {
            $bookings = $this->bookingService->getAllBookings();
            APIResponse::success($bookings, 'All bookings fetched successfully');
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

}
