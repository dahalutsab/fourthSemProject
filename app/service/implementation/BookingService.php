<?php

namespace App\service\implementation;

// BookingService.php
use App\dto\response\BookingResponse;
use App\models\Booking;
use App\repository\BookingRepositoryInterface;
use InvalidArgumentException;

class BookingService
{
    private BookingRepositoryInterface $bookingRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function createBooking(array $data): BookingResponse
    {
        if (empty($data['province_id']) || empty($data['district_id']) || empty($data['municipality_id']) || empty($data['local_area']) || empty($data['event_date']) || empty($data['event_start_time']) || empty($data['event_end_time']) || empty($data['total_cost']) || empty($data['advance_amount']) || empty($data['remaining_amount']) || empty($data['performance_type_id'])) {
            throw new InvalidArgumentException('Missing required fields');
        }
//        if date is in the past
        $today = date("Y-m-d");
        if ($data['event_date'] < $today) {
            throw new InvalidArgumentException('Event date cannot be in the past');
        }
//        get artist id by performance id
        $artistId = $this->bookingRepository->getArtistIdByPerformanceId($data['performance_type_id']);
        $data['artist_id'] = $artistId;
        $booking = $this->bookingRepository->create($data);
        return  new BookingResponse($booking);
    }


    public function getBookingById($id): ?BookingResponse
    {
        $booking = $this->bookingRepository->getBookingById($id);
        return new BookingResponse($booking);
    }

    public function updateBookingStatus(int $id, string $status): int
    {
        // Business logic, validation, etc.
        return $this->bookingRepository->updateStatus($id, $status);
    }
}
