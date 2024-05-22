<?php

namespace App\controllers;

use App\Response\ApiResponse;
use App\service\implementation\EsewaIntegrationService;

class EsewaIntegration
{
    private EsewaIntegrationService $esewaIntegrationService;

    public function __construct()
    {
        $this->esewaIntegrationService = new EsewaIntegrationService();
    }
    public function generateSignature(): null
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $requestData = json_decode(file_get_contents('php://input'), true);
                $totalAmount = $requestData['totalAmount'];
                $transactionUuid = $requestData['transactionUuid'];
                $productCode = $requestData['productCode'];
                $signature = $this->esewaIntegrationService-> generateSignature($totalAmount, $transactionUuid, $productCode);
                return ApiResponse::success($signature, "Signature generated successfully");
            } else {
                return ApiResponse::error("Invalid request method");
            }
        } catch (\Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

}