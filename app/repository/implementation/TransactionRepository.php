<?php

namespace app\repository\implementation;

use app\models\Transaction;
use config\Database;

class TransactionRepository
{
    protected Database $database;

    public function __construct() {
        $this->database = new Database;
    }

    public function savePayment(int $bookingId, string $status, string $transactionUUID, string $paymentService): Transaction
    {
        $sql = "INSERT INTO transactions (booking_id, status, transaction_uuid, payment_service) VALUES (?, ?, ?, ?)";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("isss", $bookingId, $status, $transactionUUID, $paymentService);
        $stmt->execute();
        $stmt->close();

        $transactionId = $this->database->getConnection()->insert_id;
        return new Transaction($transactionId, $bookingId, $transactionUUID, $status, $paymentService);
    }

    public function getUserPaymentInfoForMail($bookingId): array
    {
        $sql = "SELECT bookings.*, transactions.*,
            user.email as userEmail, user.username as userName,
            artist.email as artistEmail, artist.username as artistName
            FROM bookings
            JOIN transactions ON bookings.booking_id = transactions.booking_id
            JOIN users AS user ON bookings.user_id = user.id
            JOIN users AS artist ON bookings.artist_id = artist.id
            WHERE bookings.booking_id = ?";

        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $bookingId);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }

    public function getUserInfo($user_id): false|array|null
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->database->getConnection()->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();

        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        $stmt->close();

        return $data;
    }
}