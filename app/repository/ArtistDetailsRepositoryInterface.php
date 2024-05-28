<?php

namespace app\repository;

use app\dto\request\ArtistDetailsRequest;
use app\models\ArtistDetails;

interface ArtistDetailsRepositoryInterface
{

    function saveUserProfile(ArtistDetailsRequest $userProfileRequest): ArtistDetails;

    function getUserProfile(string $userId): ?ArtistDetails;

    function saveProfilePicture(string $userId, string $profilePicture): ?ArtistDetails;
}