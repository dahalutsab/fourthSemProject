<?php

namespace App\repository\implementation;

use App\models\Booking;
use App\repository\BookingRepositoryInterface;
use config\Database;
use Exception;
use mysqli;

class BookingRepository implements BookingRepositoryInterface
{
    private mysqli $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    /**
     * @throws Exception
     */
    public function create(array $data): Booking
    {
        try {
            $booking = new Booking($data);

            $sql = "INSERT INTO bookings (province_id, user_id, artist_id, district_id, municipality_id, local_area, event_date, event_start_time, event_end_time, total_cost, advance_amount, remaining_amount, performance_type_id, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->db->prepare($sql);
            $userId = $booking->getUserId();
            $artistId = $booking->getArtistId();
            $provinceId = $booking->getProvinceId();
            $districtId = $booking->getDistrictId();
            $municipalityId = $booking->getMunicipalityId();
            $localArea = $booking->getLocalArea();
            $eventDate = $booking->getEventDate();
            $eventStartTime = $booking->getEventStartTime();
            $eventEndTime = $booking->getEventEndTime();
            $totalCost = $booking->getTotalCost();
            $advanceAmount = $booking->getAdvanceAmount();
            $remainingAmount = $booking->getRemainingAmount();
            $performanceTypeId = $booking->getPerformanceTypeId();
            $status = $booking->getStatus();
            $stmt->bind_param(
                "iiiiisssssssis",
                $provinceId,
                $userId,
                $artistId,
                $districtId,
                $municipalityId,
                $localArea,
                $eventDate,
                $eventStartTime,
                $eventEndTime,
                $totalCost,
                $advanceAmount,
                $remainingAmount,
                $performanceTypeId,
                $status
            );

            $stmt->execute();

            $booking->setId($this->db->insert_id);

            return $booking;
        } catch (Exception $e) {
            throw new Exception("Error creating booking: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getBookingById(int $id): ?Booking
    {
        try {
            $sql = "SELECT * FROM bookings WHERE booking_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $booking = $result->fetch_assoc();
            if ($booking) {
                $booking_obj = new Booking($booking);
                $booking_obj->setId($id);
                return $booking_obj;
            }
            return null;
        } catch (Exception $e) {
            throw new Exception("Error getting booking by ID: " . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function updateStatus(int $id, string $status): int
    {
        $sql = "UPDATE bookings SET status = ? WHERE booking_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("si", $status, $id);

        $stmt->execute();
        return $stmt->affected_rows;
    }

    /**
     * @throws Exception
     */
    public function getArtistIdByPerformanceId(mixed $performance_type_id)
    {
        try {
            $sql = "SELECT artist_id FROM performance_types WHERE performance_type_id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bind_param("i", $performance_type_id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc()['artist_id'];
        } catch (Exception $e) {
            throw new Exception("Error getting artist ID by performance ID: " . $e->getMessage());
        }
    }
}

