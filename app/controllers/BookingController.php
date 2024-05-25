<?php

namespace App\controllers;

use App\repository\implementation\BookingRepository;
use App\Response\ApiResponse;
use App\service\implementation\BookingService;
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
                 ApiResponse::success($booking->toArray(), 'Booking created successfully');
            } else {
                 ApiResponse::error('Invalid request method');
            }
        } catch (\Exception $e) {
             ApiResponse::error($e->getMessage());
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
                    ApiResponse::success($booking->toArray(), 'Booking fetched successfully');
                } else {
                    ApiResponse::error('Booking not found');
                }
            }
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }


    public function updateStatus()
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'];
                $status = $_POST['status'];

                $updated = $this->bookingService->updateBookingStatus($id, $status);
                if ($updated) {
                    ApiResponse::success($updated, 'Booking status updated successfully');
                } else {
                    ApiResponse::error('Booking status update failed');
                }
            }
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }
}
