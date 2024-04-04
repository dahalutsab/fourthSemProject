<?php

namespace App\service\implementation;

use App\dto\request\UserDetailsRequest;
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
    public function getUserDetails(int $id): UserDetailsResponse
    {
        $user_details = $this->userDetailsRepository->getUserDetails($id);
        return new UserDetailsResponse(
            $user_details
        );
    }

    /**
     * @throws Exception
     */
    public function createUserDetails(UserDetailsRequest $userDetails): UserDetailsResponse
    {
        $userDetail = new UserDetails(
            null,
            $userDetails->getFullName(),
            $userDetails->getPhone(),
            $userDetails->getAddress(),
            $userDetails->getProfilePicture(),
            $userDetails->getSocialMedia(),
            $userDetails->getBio(),
            null,
            null
        );
        return new UserDetailsResponse(
            $this->userDetailsRepository->createUserDetails($userDetail)
        );
    }
}