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
        try {
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
                $_SESSION[SESSION_SIGNUP_ERRORS] = $errors;
                // Redirect back to signup page to display errors
                header('Location: /signup');
                exit;
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
                header('Location: /verify-otp');
                exit; // Redirect and exit immediately after sending header
            } else {
                // Handle user creation error
                $_SESSION[SESSION_SIGNUP_ERRORS] = ['Error creating user.']; // Store error message in session
                header('Location: /signup'); // Redirect back to signup page
                exit; // Exit immediately after sending header
            }
        } catch (Exception $exception) {
            $_SESSION[SESSION_SIGNUP_ERRORS] = [$exception->getMessage()]; // Store exception message in session
            header('Location: /signup'); // Redirect back to signup page
            exit; // Exit immediately after sending header
        }
    }


    /**
     * @throws Exception
     */
    public function verifyOtp()
    {
        try {
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
                $_SESSION[SESSION_VERIFY_OTP_ERRORS] = ['OTP is required.'];
                header('Location: /verify-otp');
                exit;
            }

            // Get userId from email from user table
            $userId = $this->userService->getUserId($email);

            // Verify OTP
            if ($this->otpService->verifyOtp($userId, $otp)) {
                // OTP verification successful
                header('Location: /dashboard');
                exit;
            } else {
                // OTP verification failed
                $_SESSION[SESSION_VERIFY_OTP_ERRORS] = ['Invalid OTP.'];
                header('Location: /verify-otp');
                exit;
            }
        } catch (Exception $exception) {
            // Handle exceptions
            $_SESSION[SESSION_VERIFY_OTP_ERRORS] = [$exception->getMessage()];
            header('Location: /verify-otp');
            exit;
        }
    }
}