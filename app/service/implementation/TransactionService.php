<?php

namespace App\service\implementation;

use App\repository\implementation\TransactionRepository;
use Exception;

class TransactionService
{
    private TransactionRepository $transactionRepository;

    public function __construct()
    {
        $this->transactionRepository = new TransactionRepository();
    }

    /**
     * @throws Exception
     */
    public function savePayment(int $bookingId, string $status, string $transactionId, string $paymentService): void
    {
        if (empty($bookingId) || empty($status) || empty($paymentService)) {
            throw new Exception("Invalid data provided");
        }
        $this->transactionRepository->savePayment($bookingId, $status, $transactionId, $paymentService);

    }
}