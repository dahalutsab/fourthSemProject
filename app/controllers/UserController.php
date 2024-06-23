<?php

namespace app\controllers;


use app\dto\request\UserRequest;
use app\response\APIResponse;
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
    public function signup(): void
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
             APIResponse::success($user->toArray(), ['message' => 'User created successfully.']);
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function sendOtp(): void
    {
        try {
            // Retrieve form data sent by the router
            $email = $_SESSION[SESSION_EMAIL] ?? '';

            // Perform basic validation
            if (empty($email)) {
                 APIResponse::error('Email is required.');
            }

            // Get username from email from user table
            $userResponse = $this->userService->getUserByEmail($email);
            $username = $userResponse->getUsername();

            // Send OTP
            if ($this->otpService->sendOtp($email, $username)) {
                 APIResponse::success([], ['message' => 'OTP sent successfully.']);
            } else {
                 APIResponse::error('Failed to send OTP.');
            }
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function verifyOtp(): void
    {
        try {
            // Retrieve form data sent by the router
            $otp = $_POST['otp'] ?? '';
            $email = $_SESSION[SESSION_EMAIL] ?? '';

            // Perform basic validation
            if (empty($otp)) {
                 APIResponse::error('OTP is required.');
            }

            // Get userId from email from user table
            $userId = $this->userService->getUserId($email);

            // Verify OTP
            if ($this->otpService->verifyOtp($userId, $otp)) {
                 APIResponse::success([], ['message' => 'OTP verification successful.']);
            } else {
                 APIResponse::error('OTP verification failed.');
            }
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }

    public function getUser(): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 1;
             APIResponse::success($this->userService->getUserById($userId)->toArray());
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }


    public function getAllUsers(): void
    {
        try {
            APIResponse::success($this->userService->getAllUsers());
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }

    public function getNavbarDetails () : void {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 1;
            APIResponse::success($this->userService->getNavbarDetails($userId));
        } catch (Exception $exception) {
            APIResponse::error($exception->getMessage());
        }
    }

    public function changePassword(): void
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            $formData = [
                'oldPassword' => $data['current_password'] ?? '',
                'newPassword' => $data['new_password'] ?? '',
                'confirmPassword' => $data['confirm_password'] ?? '',
            ];

            $this->userService->changePassword($formData);

            // Password change successful
             APIResponse::success([], ['message' => 'Password changed successfully.']);
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }
}