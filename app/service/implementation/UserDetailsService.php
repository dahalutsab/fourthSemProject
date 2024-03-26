<?php

namespace App\service\implementation;

use App\dto\request\UserDetailsRequest;
use App\dto\response\UserDetailsResponse;
use App\repository\implementation\UserDetailsRepository;
use App\service\UserDetailsServiceInterface;
use Exception;

class UserDetailsService implements UserDetailsServiceInterface
{
    protected UserDetailsRepository $userProfileRepository;

    public function __construct()
    {
        $this->userProfileRepository = new UserDetailsRepository();
    }

    /**
     * @throws Exception
     */
    public function saveUserProfile(UserDetailsRequest $userProfileRequest): UserDetailsResponse
    {
        try {
            // Call the repository method to save the user profile details
            $userDetails = $this->userProfileRepository->saveUserProfile($userProfileRequest);
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
            $this->userProfileRepository->saveProfilePicture($picturePath);
        } catch (Exception $exception) {
            // Throw an exception if an error occurs
            throw new Exception('Error saving profile picture: ' . $exception->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function getUserProfile(string $userId): UserDetailsResponse {

        try {
            $userDetails = $this->userProfileRepository->getUserProfile($userId);
            if ($userDetails!=null) {
                return new UserDetailsResponse($userDetails);
            } else throw new Exception("User doesnt exist");
        }catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
