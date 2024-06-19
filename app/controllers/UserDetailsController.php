<?php

namespace app\controllers;

use app\dto\request\UserDetailsRequest;
use app\response\APIResponse;
use app\response\ErrorResponse;
use app\service\implementation\UserDetailsService;
use app\service\UserDetailsServiceInterface;
use Exception;

class UserDetailsController
{
    protected UserDetailsServiceInterface $userDetailsService;
    public function __construct()
    {
        $this->userDetailsService = new UserDetailsService();
    }


    public function editProfile(): void
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
             APIResponse::success($updatedDetails->getData(),['message' => 'User profile saved successfully.']);
        } catch (Exception $exception) {
            // Return error response if an exception occurs
             ErrorResponse::badRequest($exception->getMessage());
        }
    }


    public function saveProfilePicture(): void
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
                 APIResponse::success(['message' => 'Profile picture saved successfully.'], $profilePicturePath);
            } else {
                // Return error response if no file is uploaded
                 ErrorResponse::badRequest('No profile picture uploaded.');
            }
        } catch (Exception $exception) {
            // Return error response if an exception occurs
             ErrorResponse::badRequest($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function getUserProfile (): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID];
            $userDetails = $this->userDetailsService->getUserProfile($userId);
             APIResponse::success($userDetails->getData());
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }

}