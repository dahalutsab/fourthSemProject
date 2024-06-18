<?php

namespace app\service\implementation;

// BookingService.php
use app\dto\response\BookingResponse;
use app\repository\BookingRepositoryInterface;
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
        if (!$booking) {
            return null;
        }
        return new BookingResponse($booking);
    }

    public function updateBookingStatus(int $id, string $status): int
    {
        // Business logic, validation, etc.
        return $this->bookingRepository->updateStatus($id, $status);
    }

    public function getUserBookings(mixed $userId)
    {
        return $this->bookingRepository->getUserBookings($userId);
    }

    public function getArtistBookings(mixed $artistId)
    {
         return $this->bookingRepository->getArtistBookings($artistId);
    }

    public function getArtistPayments(mixed $artistId)
    {
        return $this->bookingRepository->getArtistPayments($artistId);
    }

    public function getUserPayments(mixed $userId)
    {
        return $this->bookingRepository->getUserPayments($userId);
    }

    public function getBookingDetails(mixed $bookingId)
    {
        return $this->bookingRepository->getBookingDetails($bookingId);
    }

    public function cancelBooking(mixed $bookingId)
    {
        return $this->bookingRepository->cancelBooking($bookingId);
    }

    public function acceptBooking(mixed $bookingId)
    {
        return $this->bookingRepository->acceptBooking($bookingId);
    }

    public function rejectBooking(mixed $bookingId)
    {
        return $this->bookingRepository->rejectBooking($bookingId);
    }




}
