<?php

namespace App\service\implementation;

use App\dto\request\ArtistDetailsRequest;
use App\dto\request\UserDetailsRequest;
use App\dto\response\ArtistDetailsResponse;
use App\dto\response\UserDetailsResponse;
use App\models\UserDetails;
use App\repository\implementation\UserDetailsRepository;
use App\repository\UserDetailsRepositoryInterface;
use App\service\UserDetailsServiceInterface;
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

    public function saveProfilePicture(string $picturePath)
    {
        try {
            // Call the repository method to save or update the profile picture path
            $this->userDetailsRepository->saveProfilePicture($picturePath);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving profile picture: ' . $exception->getMessage());
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