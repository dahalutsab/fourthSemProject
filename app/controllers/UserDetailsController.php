<?php

namespace App\Controllers;

use App\dto\request\UserDetailsRequest;
use App\Response\ApiResponse;
use App\Response\ErrorResponse;
use App\Service\UserDetailsService;
use App\validator\UserRequestValidator;
use Exception;

class UserDetailsController
{
    protected UserDetailsService $userProfileService;

    public function __construct()
    {
        $this->userProfileService = new UserDetailsService();
    }

    public function saveArtistProfile()
    {
        try {
            // Retrieve form data sent by the router
            $formData = [
                'fullName' => $_POST['fullName'] ?? '',
                'stageName' => $_POST['stageName'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'talentType' => $_POST['talentType'] ?? '',
                'bio' => $_POST['bio'] ?? '',
                'description' => $_POST['description'] ?? '',
            ];


            // Create a UserDetailsRequest object
            $userProfileRequest = new UserDetailsRequest(
                $formData['fullName'],
                $formData['stageName'],
                $formData['phone'],
                $formData['address'],
                $formData['talentType'],
                $formData['bio'],
                $formData['description']
            );

            // Call the service method to save the user profile
            $this->userProfileService->saveUserProfile($userProfileRequest);

            // Return success response
            return ApiResponse::success(['message' => 'User profile saved successfully.']);
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
            $this->userProfileService->saveProfilePicture($picturePath);

            // Return success response
            return ApiResponse::success(['message' => 'Profile picture saved successfully.']);
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            return ErrorResponse::error($exception->getMessage());
        }
    }
}
