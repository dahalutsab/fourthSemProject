<?php

namespace app\service\implementation;

class EsewaIntegrationService
{

    public function generateSignature(string $totalAmount, string $transactionUuid, $productCode): string
    {
        $secretKey = "8gBm/:&EnhH.1/q";
        $signedString = $totalAmount . "," . $transactionUuid . "," . $productCode;
        $hash = hash_hmac('sha256', $signedString, $secretKey, true);
        return base64_encode($hash);
    }
}