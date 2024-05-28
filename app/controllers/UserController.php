<?php

namespace app\controllers;


use app\dto\request\UserRequest;
use app\Response\APIResponse;
use app\service\implementation\MailerService;
use app\service\implementation\OtpService;
use app\service\implementation\UserService;
use app\service\MailerServiceInterface;
use app\service\OtpServiceInterface;
use app\service\UserServiceInterface;
use app\validator\UserRequestValidator;
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
            return APIResponse::success($user->toArray(), ['message' => 'User created successfully.']);
        } catch (Exception $exception) {
            return APIResponse::error($exception->getMessage());
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
                return APIResponse::error('OTP is required.');
            }

            // Get userId from email from user table
            $userId = $this->userService->getUserId($email);

            // Verify OTP
            if ($this->otpService->verifyOtp($userId, $otp)) {
                return APIResponse::success([], ['message' => 'OTP verification successful.']);
            } else {
                return APIResponse::error('OTP verification failed.');
            }
        } catch (Exception $exception) {
            return APIResponse::error($exception->getMessage());
        }
    }

    public function getUser(): null
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 1;
            return APIResponse::success($this->userService->getUserById($userId)->toArray());
        } catch (Exception $exception) {
            return APIResponse::error($exception->getMessage());
        }
    }
}