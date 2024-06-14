<?php
namespace app\response;

class APIResponse
{
    public static function success($data, $message = null, $code = 200): void
    {
        $response = [
            'success' => true,
            'data' => $data,
        ];

        if ($message !== null) {
            $response['message'] = $message;
        }

         self::sendResponse($response, $code);
    }

    public static function error($error, $code = 400): void
    {
        $response = [
            'success' => false,
            'error' => $error,
        ];

         self::sendResponse($response, $code);
         exit();
    }

    private static function sendResponse($response, $code): void
    {
        http_response_code($code);

        header('Content-Type: application/json');
        // Encode the response data to JSON
        echo json_encode($response);
    }
}
