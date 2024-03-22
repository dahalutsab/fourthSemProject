<?php

namespace App\Controllers;

use App\dto\request\UserDetailsRequest;
use App\dto\response\UserDetailsResponse;
use App\Response\ApiResponse;
use App\Response\ErrorResponse;
use App\service\implementation\UserDetailsService;
use App\service\UserDetailsServiceInterface;
use Exception;

class UserDetailsController
{
    protected UserDetailsServiceInterface $userDetailsService;

    public function __construct()
    {
        $this->userDetailsService = new UserDetailsService();
    }

    public function editProfile()
    {
        try {
            // Retrieve form data sent by the router
            $formData = [
                'fullName' => $_POST['fullName'] ?? '',
                'stageName' => $_POST['stageName'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'categoryID' => $_POST['categoryID'] ?? '',
                'bio' => $_POST['bio'] ?? '',
                'description' => $_POST['description'] ?? '',
                'userId' => $_SESSION[SESSION_USER_ID] ?? ''
            ];

            var_dump($formData);


            // Create a UserDetailsRequest object
            $userProfileRequest = new UserDetailsRequest(
                $formData['fullName'],
                $formData['stageName'],
                $formData['phone'],
                $formData['address'],
                $formData['categoryID'],
                $formData['bio'],
                $formData['description'],
                $formData['userId']
            );

            // Call the service method to save the user profile
            $this->userDetailsService->saveUserProfile($userProfileRequest);

            // Return success response
            ApiResponse::success(['message' => 'User profile saved successfully.']);
            header('Location: /dashboard');
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            return ErrorResponse::badRequest($exception->getMessage());
        }
    }

    public function saveProfilePicture()
    {
        try {
            // Handle profile picture upload here
            // Save the profile picture to a folder and get its path

            // Call the service method to save or update the profile picture path
            $this->userDetailsService->saveProfilePicture($picturePath);

            // Return success response
            return ApiResponse::success(['message' => 'Profile picture saved successfully.']);
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            return ErrorResponse::badRequest($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getUserProfile (): UserDetailsResponse{
        $userId = $_SESSION[SESSION_USER_ID];
        return $this->userDetailsService->getUserProfile($userId);
    }
}
