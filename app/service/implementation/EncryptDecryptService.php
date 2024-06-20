<?php

namespace app\service\implementation;

class EncryptDecryptService
{

    function encryptData($data): string
    {
        $cipher = "aes-256-cbc";
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $encrypted = openssl_encrypt($data, $cipher, ENCRYPTION_KEY, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }

    function decryptData($encrypted): false|string
    {
        $cipher = "aes-256-cbc";
        $encrypted = base64_decode($encrypted);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($encrypted, 0, $ivlen);
        return openssl_decrypt(substr($encrypted, $ivlen), $cipher, ENCRYPTION_KEY, OPENSSL_RAW_DATA, $iv);
    }


}