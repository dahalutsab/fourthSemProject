<?php

namespace app\payment;

use app\Response\APIResponse;
use app\service\implementation\EsewaIntegrationService;
use app\service\implementation\TransactionService;
use Exception;

class EsewaIntegration
{
    private TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    public function generateSignature(): void
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $requestData = json_decode(file_get_contents('php://input'), true);
                if (!isset($requestData['message'])) {
                    throw new Exception("Missing 'message' field in request body");
                }
                $message = $requestData['message'];
                $secretKey = "8gBm/:&EnhH.1/q";
                $hash = hash_hmac('sha256', $message, $secretKey, true);
                $hashed = base64_encode($hash);
                APIResponse::success($hashed, "Signature generated successfully");
            } else {
                APIResponse::error("Invalid request method");
            }
        } catch (\Exception $e) {
            APIResponse::error($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function decodeSuccessResponse(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $url = $_SERVER['REQUEST_URI'];
            $path = parse_url($url, PHP_URL_PATH);
            $pathFragments = explode('/', $path);
            $bookingId = end($pathFragments);
            if (isset($_GET['data'])) {
                $data = $_GET['data'];
                $decodedData = base64_decode($data);
                $jsonDecodedData = json_decode($decodedData, true);

                if (json_last_error() === JSON_ERROR_NONE) {
                    $status = $jsonDecodedData['status'];
                    if ($status === 'COMPLETE') {
                        $status = 'success';
                    } else if ($status === 'PENDING') {
                        $status = 'pending';
                    } else if ($status === 'CANCELED') {
                        $status = 'cancelled';
                    } else {
                        $status = 'failure';
                    }
                    $this->transactionService->savePayment($bookingId, $status, $jsonDecodedData['transaction_uuid'], 'ESEWA');
                    if ($status === 'success') {
                        header("Location: /dashboard/bookings");
                    } else {
                        header("Location: /payment/failure");
                    }
                } else {
                    echo "Error decoding JSON data: " . json_last_error_msg();
                }
            } else {
                echo "No data received in the request.";
            }
        } else {
            echo "Invalid request method";
        }
    }
}