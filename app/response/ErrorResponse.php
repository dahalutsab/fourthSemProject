<?php

namespace App\Response;


class ErrorResponse
{
    public static function badRequest($message)
    {
        return ApiResponse::error($message, 400);
    }

    public static function unauthorized($message)
    {
        return ApiResponse::error($message, 401);
    }

    public static function forbidden($message)
    {
        return ApiResponse::error($message, 403);
    }

    public static function notFound($message)
    {
        return ApiResponse::error($message, 404);
    }

    // Add more methods for different error scenarios as needed
}