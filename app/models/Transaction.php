<?php

namespace App\models;

class Transaction
{
    private int $transactionId;
    private int $bookingId;

    private string $transactionUUID;
    private string $status;

    private string $paymentService;

    public function __construct(int $transactionId, int $bookingId, string $transactionUUID, string $status, string $paymentService)
    {
        $this->transactionId = $transactionId;
        $this->bookingId = $bookingId;
        $this->transactionUUID = $transactionUUID;
        $this->status = $status;
        $this->paymentService = $paymentService;
    }

    public function getTransactionId(): int
    {
        return $this->transactionId;
    }

    public function getBookingId(): int
    {
        return $this->bookingId;
    }

    public function getTransactionUUID(): string
    {
        return $this->transactionUUID;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getPaymentService(): string
    {
        return $this->paymentService;
    }

    public function setTransactionId(int $transactionId): void
    {
        $this->transactionId = $transactionId;
    }

    public function setBookingId(int $bookingId): void
    {
        $this->bookingId = $bookingId;
    }

    public function setTransactionUUID(string $transactionUUID): void
    {
        $this->transactionUUID = $transactionUUID;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setPaymentService(string $paymentService): void
    {
        $this->paymentService = $paymentService;
    }

    public function toArray(): array
    {
        return [
            'transaction_id' => $this->transactionId,
            'booking_id' => $this->bookingId,
            'transaction_uuid' => $this->transactionUUID,
            'status' => $this->status,
            'payment_service' => $this->paymentService,
        ];
    }

    public static function fromArray(array $data): Transaction
    {
        return new Transaction(
            $data['transaction_id'],
            $data['booking_id'],
            $data['transaction_uuid'],
            $data['status'],
            $data['payment_service']
        );
    }
}