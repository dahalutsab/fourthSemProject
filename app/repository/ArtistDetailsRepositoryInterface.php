<?php

namespace App\repository;

use App\dto\request\ArtistDetailsRequest;
use App\models\ArtistDetails;

interface ArtistDetailsRepositoryInterface
{

    function saveUserProfile(ArtistDetailsRequest $userProfileRequest): ArtistDetails;

    function getUserProfile(string $userId): ?ArtistDetails;

    function saveProfilePicture(string $userId, string $profilePicture): ?ArtistDetails;
}