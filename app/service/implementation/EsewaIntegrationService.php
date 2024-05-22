<?php

namespace App\service\implementation;

class EsewaIntegrationService
{

    public function generateSignature(mixed $totalAmount, mixed $transactionUuid, mixed $productCode): string
    {
        $secretKey = "8gBm/:&EnhH.1/q";
        $signedString = $totalAmount . "," . $transactionUuid . "," . $productCode;
        $hash = hash_hmac('sha256', $signedString, $secretKey, true);
        return base64_encode($hash);
//        echo base64_encode($s);
    }
}