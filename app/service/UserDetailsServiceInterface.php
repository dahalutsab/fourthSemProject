<?php

namespace app\service;

use app\dto\request\UserDetailsRequest;
use app\dto\response\UserDetailsResponse;

interface UserDetailsServiceInterface
{
    public function saveUserProfile(UserDetailsRequest $userDetailsRequest): UserDetailsResponse;

//    public function saveProfilePicture();

    public function getUserProfile(int $userId): UserDetailsResponse;
}