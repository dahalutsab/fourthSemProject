<?php

namespace App\validator;
class UserRequestValidator
{
    public static function validateSignupData(array $data): array
    {
        $errors = [];

        // Validate username
        if (empty($data['username'])) {
            $errors[] = 'Username is required.';
        } elseif (!self::isValidUsername($data['username'])) {
            $errors[] = 'Invalid username format.';
        }

        // Validate email
        if (empty($data['email'])) {
            $errors[] = 'Email is required.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format.';
        }

        // Validate password
        if (empty($data['password'])) {
            $errors[] = 'Password is required.';
        } elseif (!self::isValidPassword($data['password'])) {
            $errors[] = 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.';
        }

        // Validate role
        if (empty($data['role'])) {
            $errors[] = 'Role is required.';
        }
        return $errors;
    }

    private static function isValidUsername(string $username): bool
    {
        // Define your username validation rules here
        // For example, only allow alphanumeric characters and underscores, with a minimum length of 4 characters
        $pattern = '/^[\w]{4,}$/';
        return preg_match($pattern, $username) === 1;
    }

    private static function isValidPassword(string $password): bool
    {
        // Define your password validation rules here
        // For example, require at least 8 characters, one uppercase letter, one lowercase letter, and one number
        $pattern = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/';
        return preg_match($pattern, $password) === 1;
    }
}