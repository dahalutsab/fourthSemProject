<?php
class GlobalApiResponse {
    public static function success($message, $data = null): array
    {
        return array(
            'status' => 'success',
            'message' => $message,
            'data' => $data
        );
    }

    public static function error($message, $data = null): array
    {
        return array(
            'status' => 'error',
            'message' => $message,
            'data' => $data
        );
    }
}
