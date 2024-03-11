<?php

namespace App\Repository;

use App\Models\User;

interface UserRepository
{
    public function save(User $user);
    public function saveWithOtp(User $user);
}