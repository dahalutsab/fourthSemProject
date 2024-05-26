<?php

namespace App\payment;

use App\Response\ApiResponse;
use App\service\implementation\EsewaIntegrationService;
use Exception;

class EsewaIntegration
{
    private EsewaIntegrationService $esewaIntegrationService;

    public function __construct()
    {
        $this->esewaIntegrationService = new EsewaIntegrationService();
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
                 ApiResponse::success($hashed, "Signature generated successfully");
            } else {
                 ApiResponse::error("Invalid request method");
            }
        } catch (\Exception $e) {
             ApiResponse::error($e->getMessage());
        }
    }

    public function response() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $requestData = json_decode(file_get_contents('php://input'), true);
                if (!isset($requestData['oid']) || !isset($requestData['amt']) || !isset($requestData['refId']) || !isset($requestData['scd'])) {
                    throw new Exception("Missing required fields in request body");
                }
                $oid = $requestData['oid'];
                $amt = $requestData['amt'];
                $refId = $requestData['refId'];
                $scd = $requestData['scd'];
                $message = $oid . $amt . $refId . $scd;
                $secretKey = "8gBm/:&EnhH.1/q";
                $hash = hash_hmac('sha256', $message, $secretKey, true);
                $hashed = base64_encode($hash);
                if ($requestData['scd'] === 'epay_payment') {
                    if ($requestData['mac'] === $hashed) {
                        ApiResponse::success("Payment successful", "Payment successful");
                    } else {
                        ApiResponse::error("Payment failed");
                    }
                } else {
                    ApiResponse::error("Invalid service code");
                }
            } else {
                ApiResponse::error("Invalid request method");
            }
        } catch (\Exception $e) {
            ApiResponse::error($e->getMessage());
        }
    }



}