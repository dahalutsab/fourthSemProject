<?php

namespace App\repository;

use App\models\UserDetails;

interface UserDetailsRepositoryInterface
{
    public function getUserDetails(int $id);

    public function createUserDetails(UserDetails $userDetails);
}