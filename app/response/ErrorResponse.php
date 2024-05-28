<?php

namespace app\response;


class ErrorResponse
{
    public static function badRequest($message): void
    {
         APIResponse::error($message, 400);
    }

    public static function unauthorized($message): void
    {
         APIResponse::error($message, 401);
    }

    public static function forbidden($message): void
    {
         APIResponse::error($message, 403);
    }

    public static function notFound($message): void
    {
         APIResponse::error($message, 404);
    }

    // Add more methods for different error scenarios as needed
}