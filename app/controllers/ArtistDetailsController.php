<?php

namespace App\Controllers;

use App\dto\request\ArtistDetailsRequest;
use App\Response\ApiResponse;
use App\Response\ErrorResponse;
use App\service\implementation\ArtistDetailsService;
use App\service\ArtistDetailsServiceInterface;
use Exception;

class ArtistDetailsController
{
    protected ArtistDetailsServiceInterface $artistDetailsService;

    public function __construct()
    {
        $this->artistDetailsService = new ArtistDetailsService();
    }


    public function editProfile(): null
    {
        try {
            // Retrieve form data sent by the router
            $formData = [
                'fullName' => $_POST['full_name'] ?? '',
                'stageName' => $_POST['stage_name'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'categoryID' => $_POST['category'] ?? '',
                'bio' => $_POST['bio'] ?? '',
                'description' => $_POST['description'] ?? '',
                'userId' => $_SESSION[SESSION_USER_ID] ?? ''
            ];

            // Create a ArtistDetailsRequest object
            $artistDetailsRequest = new ArtistDetailsRequest(
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
            $updatedDetails = $this->artistDetailsService->saveUserProfile($artistDetailsRequest);

            // Return success response
            return ApiResponse::success($updatedDetails->getData(),['message' => 'User profile saved successfully.']);
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            return ErrorResponse::badRequest($exception->getMessage());
        }
    }


    public function saveProfilePicture()
    {
        try {
            // Handle profile picture uploads here
            // Save the profile picture to a folder and get its path

            // Call the service method to save or update the profile picture path
            $this->artistDetailsService->saveProfilePicture($picturePath);

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
    public function getUserProfile (): null
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID];
            $userDetails = $this->artistDetailsService->getUserProfile($userId);
            return ApiResponse::success($userDetails->getData());
        } catch (Exception $exception) {
            return ApiResponse::error($exception->getMessage());
        }
    }
}
