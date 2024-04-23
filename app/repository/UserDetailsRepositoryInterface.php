<?php

namespace App\repository;

use App\dto\request\UserDetailsRequest;
use App\models\UserDetails;

interface UserDetailsRepositoryInterface
{
    public function saveUserProfile(UserDetailsRequest $userDetails): UserDetails;

    public function getUserProfile(int $userId): ?UserDetails;

    public function updateUserProfile(UserDetailsRequest $userDetails): UserDetails;
}