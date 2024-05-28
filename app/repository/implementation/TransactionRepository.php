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
}