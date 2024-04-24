<?php

namespace App\service;

use App\dto\request\UserDetailsRequest;
use App\dto\response\UserDetailsResponse;

interface UserDetailsServiceInterface
{
    public function saveUserProfile(UserDetailsRequest $userDetailsRequest): UserDetailsResponse;

//    public function saveProfilePicture();

    public function getUserProfile(int $userId): UserDetailsResponse;
}