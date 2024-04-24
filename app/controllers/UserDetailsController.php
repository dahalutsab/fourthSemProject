<?php

namespace App\controllers;

use App\dto\request\UserDetailsRequest;
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


    public function editProfile(): null
    {
        try {
            // Retrieve form data sent by the router
            $formData = [
                'fullName' => $_POST['full_name'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'bio' => $_POST['bio'] ?? '',
                'userId' => $_SESSION[SESSION_USER_ID] ?? ''
            ];

            // Create a UserDetailsRequest object
            $userDetailsRequest = new UserDetailsRequest(
                $formData['userId'],
                $formData['fullName'],
                $formData['phone'],
                $formData['address'],
                $formData['bio'],
            );


            // Call the service method to save the user profile
            $updatedDetails = $this->userDetailsService->saveUserProfile($userDetailsRequest);

            // Return success response
            return ApiResponse::success($updatedDetails->getData(),['message' => 'User profile saved successfully.']);
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            return ErrorResponse::badRequest($exception->getMessage());
        }
    }


    public function saveProfilePicture(): null
{
    try {
        // Check if the image file has been uploaded
        if(isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            // Get the temporary file path
            $tmpFilePath = $_FILES['profile_picture']['tmp_name'];

            // Get the user ID from session
            $userId = $_SESSION[SESSION_USER_ID];

            // Call the service method to save the profile picture
            $profilePicturePath = $this->userDetailsService->saveProfilePicture($userId, $tmpFilePath);
            // Return success response
            return ApiResponse::success(['message' => 'Profile picture saved successfully.'], $profilePicturePath);
        } else {
            // Return error response if no file is uploaded
            return ErrorResponse::badRequest('No profile picture uploaded.');
        }
    } catch (Exception $exception) {
        // Return error response if an exception occurs
        return ErrorResponse::badRequest($exception->getMessage());
    }
}


    /**
     * @throws Exception
     */
    public function getUserProfile (): null
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID];
            $userDetails = $this->userDetailsService->getUserProfile($userId);
            return ApiResponse::success($userDetails->getData());
        } catch (Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
    }

}