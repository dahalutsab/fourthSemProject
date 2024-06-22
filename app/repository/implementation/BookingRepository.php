<?php

namespace app\repository\implementation;

use app\models\Booking;
use app\repository\BookingRepositoryInterface;
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
            $totalCost = (float) str_replace(',', '', $data['total_cost']); // Remove commas from numeric values
            $advanceAmount = (float) str_replace(',', '', $data['advance_amount']); // Remove commas from numeric values
            $remainingAmount = (float) str_replace(',', '', $data['remaining_amount']);
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

            $booking->setId($stmt->insert_id);
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

    public function getUserBookings(mixed $userId): array
    {
        $sql = "SELECT bookings.booking_id,
                   (SELECT performance_type FROM performance_types WHERE performance_type_id = bookings.performance_type_id) as performance_type,
                   bookings.event_date,
                   bookings.status,
                   bookings.total_cost,
                   bookings.advance_amount,
                   COALESCE((SELECT transactions.status FROM transactions WHERE transactions.booking_id = bookings.booking_id ORDER BY transactions.created_at DESC LIMIT 1), 'not_paid') as payment_status
            FROM bookings
            WHERE bookings.user_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArtistBookings(mixed $artistId): array
    {
        $sql = "SELECT bookings.booking_id,
                       (SELECT performance_type FROM performance_types WHERE performance_type_id = bookings.performance_type_id) as performance_type,
                       bookings.event_date,
                       bookings.status,
                       bookings.total_cost,
                        bookings.advance_amount,
                       COALESCE((SELECT transactions.status FROM transactions WHERE transactions.booking_id = bookings.booking_id ORDER BY transactions.created_at DESC LIMIT 1), 'not_paid') as payment_status
                FROM bookings
                WHERE bookings.artist_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getArtistPayments(mixed $artistId): array
    {
        $sql = "SELECT users.username as user,
                       transactions.created_at as payment_date,
                       bookings.advance_amount as amount,
                       transactions.status,
                        transactions.payment_service as payment_method
                FROM bookings
                INNER JOIN users ON bookings.user_id = users.id
                INNER JOIN transactions ON bookings.booking_id = transactions.booking_id
                WHERE bookings.artist_id = ?
                ORDER BY transactions.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $artistId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserPayments(mixed $userId): array
    {
        $sql = "SELECT users.username as artist,
                       transactions.created_at as payment_date,
                       bookings.advance_amount as amount,
                       transactions.status,
                    transactions.payment_service as payment_method
                FROM bookings
                INNER JOIN users ON bookings.artist_id = users.id
                INNER JOIN transactions ON bookings.booking_id = transactions.booking_id
                WHERE bookings.user_id = ?
                ORDER BY transactions.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);

    }

    public function getBookingDetails(mixed $bookingId): false|array|null
    {
//        get artist fullname from artistdetails, get user fullname from userdetails, artist and user email from users table, booking date, start and end time, total cost, advance amount, remaining amount, status, local area, province, district, municipality from bookings table
        $sql = "SELECT bookings.booking_id,
                       (SELECT performance_type FROM performance_types WHERE performance_type_id = bookings.performance_type_id) as performance_type,
                       bookings.event_date,
                       bookings.event_start_time,
                       bookings.event_end_time,
                       bookings.total_cost,
                       bookings.advance_amount,
                       bookings.remaining_amount,
                       bookings.status,
                       bookings.local_area,
                       provinces.province_name,
                       districts.district_name,
                       municipalities.municipality_name,
                       users.username as user,
                       users.email as user_email,
                       artist.username as artist,
                       artist.email as artist_email,
                       transactions.status as payment_status
                FROM bookings
                INNER JOIN users ON bookings.user_id = users.id
                INNER JOIN users as artist ON bookings.artist_id = artist.id
                INNER JOIN provinces ON bookings.province_id = provinces.province_id
                INNER JOIN districts ON bookings.district_id = districts.district_id
                INNER JOIN municipalities ON bookings.municipality_id = municipalities.municipality_id
                INNER JOIN transactions ON bookings.booking_id = transactions.booking_id
                WHERE bookings.booking_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function cancelBooking(mixed $bookingId): bool
    {
        $sql = "UPDATE bookings SET status = 'cancelled' WHERE booking_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function acceptBooking(mixed $bookingId): bool
    {
        $sql = "UPDATE bookings SET status = 'approved' WHERE booking_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function rejectBooking(mixed $bookingId): bool
    {
        $sql = "UPDATE bookings SET status = 'declined' WHERE booking_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    public function getMailData($bookingId): false|array|null
    {
        $sql = "SELECT users.username as username, users.email as email
                FROM bookings
                INNER JOIN users ON bookings.user_id = users.id
                WHERE bookings.booking_id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}

