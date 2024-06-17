<?php

namespace app\service\implementation;

use app\dto\request\ArtistDetailsRequest;
use app\dto\response\ArtistDetailsResponse;
use app\repository\implementation\ArtistDetailsRepository;
use app\service\ArtistDetailsServiceInterface;
use Exception;

class ArtistDetailsService implements ArtistDetailsServiceInterface
{
    protected ArtistDetailsRepository $artistDetailsRepository;

    public function __construct()
    {
        $this->artistDetailsRepository = new ArtistDetailsRepository();
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(ArtistDetailsRequest $artistDetailsRequest): ArtistDetailsResponse
    {
        try {
            $artistDetails = $this->artistDetailsRepository->saveUserProfile($artistDetailsRequest);
            return new ArtistDetailsResponse($artistDetails);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving user profile: ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function saveProfilePicture($userId, $tmpFilePath): ?ArtistDetailsResponse
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
                return new ArtistDetailsResponse($this->artistDetailsRepository->saveProfilePicture($file_path, $userId));
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
    public function getUserProfile(string $userId): ArtistDetailsResponse
    {

        try {
            $artistDetails = $this->artistDetailsRepository->getUserProfile($userId);
            if ($artistDetails != null) {
                return new ArtistDetailsResponse($artistDetails);
            } else throw new Exception("User doesnt exist");
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getAllArtistsByCategory($category): array
    {
        try {
            return $this->artistDetailsRepository->getAllArtistsByCategory($category);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getAllArtists(): array
    {
        try {
            return $this->artistDetailsRepository->getAllArtists();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getArtistById($id): ArtistDetailsResponse
    {

        try {
             return new ArtistDetailsResponse($this->artistDetailsRepository->getArtistById($id));
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}