<?php

namespace app\service\implementation;

use app\dto\request\UserDetailsRequest;
use app\dto\response\UserDetailsResponse;
use app\repository\implementation\UserDetailsRepository;
use app\repository\UserDetailsRepositoryInterface;
use app\service\UserDetailsServiceInterface;
use Exception;


class UserDetailsService implements UserDetailsServiceInterface
{
    private UserDetailsRepositoryInterface $userDetailsRepository;

    public function __construct( )
    {
       $this->userDetailsRepository = new UserDetailsRepository();
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userDetailsRequest): UserDetailsResponse
    {
        try {
            // Call the repository method to save the user profile details
            $userDetails = $this->userDetailsRepository->saveUserProfile($userDetailsRequest);
            return new UserDetailsResponse($userDetails);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving user profile: ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function saveProfilePicture($userId, $tmpFilePath): ?UserDetailsResponse
    {
        try {
            // Check if file exists
            if (!file_exists($tmpFilePath)) {
                throw new Exception("File does not exist: $tmpFilePath");
            }

            // Check if file is an image
            $file_type = mime_content_type($tmpFilePath);
            if (!str_starts_with($file_type, 'image/')) {
                throw new Exception("Uploaded file is not an image: $tmpFilePath");
            }

            // Get the original filename
            $originalFileName = $_FILES['profile_picture']['name']; // Assuming 'profile_picture' is the name attribute of your file input

            // Define the uploads path
            $upload_dir = "uploads/profile_pictures/";

            // Extract the file extension from the original filename
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Generate a unique filename based on user ID and timestamp, with the original file extension
            $file_name = $userId . '_' . time() . '_' . uniqid() . '.' . $extension;

            $file_path = $upload_dir . $file_name;

            // Convert $userId to integer
            $userId = intval($userId);

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($tmpFilePath, $file_path)) {
                // Call the repository method to save the profile picture
                return new UserDetailsResponse($this->userDetailsRepository->saveProfilePicture($file_path, $userId));
            } else {
                throw new Exception("Error moving uploaded file: $tmpFilePath");
            }
        } catch (Exception $exception) {
            // Return error response if an exception occurs
            throw new Exception($exception->getMessage());
        }
    }


    /**
     * @throws Exception
     */
    public function getUserProfile(int $userId): UserDetailsResponse
    {
        try {
            $userDetails = $this->userDetailsRepository->getUserProfile($userId);
            return new UserDetailsResponse($userDetails);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

}