<?php

namespace App\Controllers;


use App\dto\request\UserRequest;
use App\Response\ApiResponse;
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
        try {
            // Retrieve form data sent by the router
            $formData = [
                'username' => $_POST['username'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'role' => $_POST['role'] ?? '',
            ];

            // Validate the form data
            UserRequestValidator::validateSignupData($formData);

            // Create a UserRequest object
            $userRequest = new UserRequest($formData);

            // Create the user using the UserService
            $user =  $this->userService->createUser($userRequest);

            // User creation successful
            $_SESSION[SESSION_EMAIL] = $formData['email'];
            $this->otpService->sendOtp($formData['email'], $formData['username']);
            return ApiResponse::success($user->toArray(), ['message' => 'User created successfully.']);
        } catch (Exception $exception) {
            echo ApiResponse::error($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function verifyOtp()
    {
        try {
            // Retrieve form data sent by the router
            $otp = $_POST['otp'] ?? '';
            $email = $_SESSION[SESSION_EMAIL] ?? '';

            // Perform basic validation
            if (empty($otp)) {
                return ApiResponse::error('OTP is required.');
            }

            // Get userId from email from user table
            $userId = $this->userService->getUserId($email);

            // Verify OTP
            if ($this->otpService->verifyOtp($userId, $otp)) {
                return ApiResponse::success([], ['message' => 'OTP verification successful.']);
            } else {
                return ApiResponse::error('OTP verification failed.');
            }
        } catch (Exception $exception) {
            echo ApiResponse::error($exception->getMessage());
        }
    }}