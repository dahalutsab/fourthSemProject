<?php

namespace App\repository;

use App\models\Booking;

interface BookingRepositoryInterface
{

    public function create(array $data): Booking;

    public function getBookingById(int $id): ?Booking;
    public function updateStatus(int $id, string $status): int;

    public function getArtistIdByPerformanceId(mixed $performance_type_id);
}