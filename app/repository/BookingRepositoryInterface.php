<?php

namespace app\repository;

use app\models\Booking;

interface BookingRepositoryInterface
{

    public function create(array $data): Booking;

    public function getBookingById(int $id): ?Booking;
    public function updateStatus(int $id, string $status): int;

    public function getArtistIdByPerformanceId(mixed $performance_type_id);

    public function getUserBookings(mixed $userId);

    public function getArtistBookings(mixed $artistId);

    public function getArtistPayments(mixed $artistId);

    public function getUserPayments(mixed $userId);

    public function getBookingDetails(mixed $bookingId);

    public function cancelBooking(mixed $bookingId);

    public function acceptBooking(mixed $bookingId);

    public function rejectBooking(mixed $bookingId);


}