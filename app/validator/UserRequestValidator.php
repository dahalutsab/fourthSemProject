<?php

namespace App\validator;
use InvalidArgumentException;

class UserRequestValidator
{
    public static function validateSignupData(array $data): array
    {
        $errors = [];

        // Validate username
        if (empty($data['full_name'])) {
            throw new InvalidArgumentException('Full Name is required.');
        } elseif (!self::isValidFullName($data['username'])) {
            throw new InvalidArgumentException('Invalid Full Name format. Minimum 4 characters required.');
        }
        if (empty($data['username'])) {
            throw new InvalidArgumentException("Username is required.");
//            $errors[] = 'Username is required.';
        } elseif (!self::isValidUsername($data['username'])) {
            throw new InvalidArgumentException("Invalid username format.");
//            $errors[] = 'Invalid username format.';
        }

        // Validate email
        if (empty($data['email'])) {
            throw new InvalidArgumentException("Email is required.");
//            $errors[] = 'Email is required.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Invalid email format.");
//            $errors[] = 'Invalid email format.';
        }

        // Validate password
        if (empty($data['password'])) {
            throw new InvalidArgumentException("Password is required.");
//            $errors[] = 'Password is required.';
        } elseif (!self::isValidPassword($data['password'])) {
            throw new InvalidArgumentException("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.");
//            $errors[] = 'Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.';
        }

        // Validate role
        if (empty($data['role'])) {
            throw new InvalidArgumentException("Role is required.");
//            $errors[] = 'Role is required.';
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

    public static function validateArtistDetails(array $formData)
    {

    }

    private static function isValidFullName(mixed $username)
    {
        $pattern = '/^\w{4,}$/';
        return preg_match($pattern, $username) === 1;
    }
}