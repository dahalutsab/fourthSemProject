<?php

namespace App\Controllers;


use App\dto\request\UserRequest;
use App\Response\ApiResponse;
use App\Response\ErrorResponse;
use App\service\implementation\MailerService;
use App\service\implementation\OtpService;
use App\service\implementation\UserService;
use App\service\MailerServiceInterface;
use App\service\OtpServiceInterface;
use App\service\UserServiceInterface;
use App\validator\UserRequestValidator;
use Exception;

class UserController
{
    protected UserServiceInterface $userService;
    protected OtpServiceInterface $otpService;
    protected MailerServiceInterface $mailerService;

    public function __construct(
    ) {
        $this->userService = new UserService();
        $this->otpService = new OtpService();
        $this->mailerService = new MailerService();
    }

    /**
     * @throws Exception
     */
    public function signup()
    {
        // Retrieve form data sent by the router
        $formData = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'password' => $_POST['password'] ?? '',
            'role' => $_POST['role'] ?? '',
        ];


        // Validate the form data
        $errors = UserRequestValidator::validateSignupData($formData);

        if (!empty($errors)) {
            return ApiResponse::error($errors);
        }

        // Create a UserRequest object
        $userRequest = new UserRequest(
            $formData['username'],
            $formData['email'],
            $formData['password'],
            $formData['role']
        );

        // Create the user using the UserService
        $user = $this->userService->createUser($userRequest);

        if ($user) {
            // User creation successful
            $_SESSION[SESSION_EMAIL] = $formData['email'];
            $this->otpService->sendOtp($formData['email'], $formData['username']);
            return ApiResponse::success(['message' => 'User created successfully. OTP sent to your email.']);
        } else {
            // Handle user creation error
            return ErrorResponse::badRequest('Error creating user.');
        }
    }

    /**
     * @throws Exception
     */
    public function verifyOtp()
    {
        // Retrieve form data sent by the router
        $otp1 = $_POST['otp_1'] ?? '';
        $otp2 = $_POST['otp_2'] ?? '';
        $otp3 = $_POST['otp_3'] ?? '';
        $otp4 = $_POST['otp_4'] ?? '';
        $otp5 = $_POST['otp_5'] ?? '';
        $otp6 = $_POST['otp_6'] ?? '';
        $email = $_SESSION[SESSION_EMAIL] ?? '';

        $otp = $otp1 . $otp2 . $otp3 . $otp4 . $otp5 . $otp6;

        // Perform basic validation
        if (empty($otp)) {
            return ErrorResponse::badRequest('OTP is required.');
        }

        // Get userId from email from user table
        $userId = $this->userService->getUserId($email);

        // Verify OTP
        if ($this->otpService->verifyOtp($userId, $otp)) {
            return ApiResponse::success(['message' => 'OTP verified successfully.']);
        } else {
            return ErrorResponse::badRequest('Invalid OTP.');
        }
    }
}