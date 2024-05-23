<?php

namespace App\controllers;

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
    public function generateSignature(): ?string
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
//                $signature = $this->esewaIntegrationService->generateSignature($totalAmount, $transactionUuid, $productCode);
                return ApiResponse::success($hashed, "Signature generated successfully");
            } else {
                return ApiResponse::error("Invalid request method");
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

}