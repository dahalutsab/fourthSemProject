<?php

namespace App\service\implementation;

use App\dto\request\ArtistDetailsRequest;
use App\dto\response\ArtistDetailsResponse;
use App\repository\implementation\ArtistDetailsRepository;
use App\service\ArtistDetailsServiceInterface;
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
            // Call the repository method to save the user profile details
            $artistDetails = $this->artistDetailsRepository->saveUserProfile($artistDetailsRequest);
            return new ArtistDetailsResponse($artistDetails);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving user profile: ' . $exception->getMessage());
        }
    }

    public function saveProfilePicture(string $picturePath)
    {
        try {
            // Call the repository method to save or update the profile picture path
            $this->artistDetailsRepository->saveProfilePicture($picturePath);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving profile picture: ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getUserProfile(string $userId): ArtistDetailsResponse {

        try {
            $artistDetails = $this->artistDetailsRepository->getUserProfile($userId);
            if ($artistDetails!=null) {
                return new ArtistDetailsResponse($artistDetails);
            } else throw new Exception("User doesnt exist");
        }catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
