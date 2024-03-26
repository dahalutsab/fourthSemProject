<?php
namespace App\Response;

class ApiResponse
{
    public static function success($data, $message = null, $code = 200): null
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

        return self::sendResponse($response, $code);
    }

    public static function error($error, $code = 400): null
    {
        $response = [
            'success' => false,
            'error' => $error,
        ];

        return self::sendResponse($response, $code);
    }

    private static function sendResponse($response, $code): void
    {
        http_response_code($code);

        header('Content-Type: application/json');
        // Encode the response data to JSON
        echo json_encode($response);
    }
}
