<?php

namespace app\repository;

use app\dto\request\UserDetailsRequest;
use app\models\UserDetails;

interface UserDetailsRepositoryInterface
{
    public function saveUserProfile(UserDetailsRequest $userDetails): UserDetails;

    public function getUserProfile(int $userId): ?UserDetails;

    public function saveProfilePicture( string $tmpFilePath, int $userId,): ?UserDetails;


}