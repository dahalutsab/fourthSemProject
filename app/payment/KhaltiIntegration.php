<?php

namespace App\payment;

class KhaltiIntegration
{
    private string $publicKey = 'test_public_key_bdc75e5c1f1540388177d5309653d339';
    private string $secretKey = 'test_secret_key_69a6232c11164ebd89ee438cb68e6a4f';

    public function initiate(): void
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $amount = $_POST['amount'] * 100; // Convert to paisa
            $purchase_order_id = $_POST['purchase_order_id'];
            $purchase_order_name = $_POST['purchase_order_name'];

            $postFields = [
                "return_url" => "http://openmichub.com/payment/khalti-response",
                "website_url" => "http://openmichub.com",
                "amount" => $amount,
                "purchase_order_id" => $purchase_order_id,
                "purchase_order_name" => $purchase_order_name,

            ];

            $this->initiatePayment($postFields);
        }
        else {
            echo 'Invalid request method';
        }
    }

    private function initiatePayment(array $postFields): void
    {
        $jsonData = json_encode($postFields);

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/initiate/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonData,
            CURLOPT_HTTPHEADER => array(
                'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
                'Content-Type: application/json',
            ),
        ]);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo 'Error:' . curl_error($curl);
        } else {
            $responseArray = json_decode($response, true);

            if (isset($responseArray['error'])) {
                echo 'Error: ' . $responseArray['error'];
            } elseif (isset($responseArray['payment_url'])) {
                // Redirect the user to the payment page
                header('Location: ' . $responseArray['payment_url']);
                exit();
            } else {
                echo 'Unexpected response: ' . $response;
            }
        }

        curl_close($curl);
    }

    public function response(): void
    {
        if (isset($_GET['pidx'])) {
            $pidx = $_GET['pidx'];

            $postFields = ['pidx' => $pidx];

            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL => 'https://a.khalti.com/api/v2/epayment/lookup/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($postFields), // JSON encode the post fields
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key live_secret_key_68791341fdd94846a146f0457ff7b455',
                    'Content-Type: application/json',
                ),
            ]);

            $response = curl_exec($ch);
            curl_close($ch);

            $responseData = json_decode($response, true);
            if ($responseData['status'] === 'Completed') {
                echo "Payment successful!";
                // Redirect to the success page
            } else {
                echo "Payment failed: " . $responseData['detail'];
                // Redirect to the failure page
            }
        }
    }
}
