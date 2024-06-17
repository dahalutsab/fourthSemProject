<?php

namespace app\controllers;

use app\dto\request\ArtistDetailsRequest;
use app\dto\response\ArtistDetailsResponse;
use app\response\APIResponse;
use app\response\errorResponse;
use app\service\implementation\ArtistDetailsService;
use app\service\ArtistDetailsServiceInterface;
use Exception;

class ArtistDetailsController
{
    protected ArtistDetailsServiceInterface $artistDetailsService;

    public function __construct()
    {
        $this->artistDetailsService = new ArtistDetailsService();
    }


    public function editProfile(): void
    {
        try {
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
                $profilePicturePath = $this->artistDetailsService->saveProfilePicture($userId, $tmpFilePath);
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
            $userDetails = $this->artistDetailsService->getUserProfile($userId);
             APIResponse::success($userDetails->getData());
        } catch (Exception $exception) {
             APIResponse::error($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getAllArtists(): void
    {
        try {
            $artists = $this->artistDetailsService->getAllArtists();

            // Create an ArtistDetailsResponse object for each ArtistDetails object
            $artistResponses = array_map(function ($artist) {
                return new ArtistDetailsResponse($artist);
            }, $artists);

            // Get the data from each ArtistDetailsResponse object
            $artistData = array_map(function ($artistResponse) {
                return $artistResponse->getData();
            }, $artistResponses);

             APIResponse::success($artistData);
        } catch (Exception $exception) {
             ErrorResponse::badRequest($exception->getMessage());
        }
    }


    public function getAllArtistsByCategory(): void
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $category = end($pathSegments);
            if (!is_numeric($category)) {
                throw new Exception("Invalid category ID: $category");
            }
            $artists = $this->artistDetailsService->getAllArtistsByCategory($category);
            $artistResponses = array_map(function ($artist) {
                return new ArtistDetailsResponse($artist);
            }, $artists);

            // Get the data from each ArtistDetailsResponse object
            $artistData = array_map(function ($artistResponse) {
                return $artistResponse->getData();
            }, $artistResponses);

             APIResponse::success($artistData);
//            return ApiResponse::success($artists);
        } catch (Exception $exception) {
             ErrorResponse::badRequest($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function getArtistById(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uriPath = parse_url($requestUri, PHP_URL_PATH);
        $pathSegments = explode('/', $uriPath);

        $id = end($pathSegments);
        if (!is_numeric($id)) {
            throw new Exception("Invalid artist ID: $id");
        }
        try {
             APIResponse::success( $this->artistDetailsService->getArtistById($id)->getData());
        } catch (Exception $exception) {
            ErrorResponse::badRequest($exception->getMessage());
        }
    }
}
