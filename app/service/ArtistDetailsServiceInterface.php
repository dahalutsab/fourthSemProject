<?php

namespace app\service;

use app\dto\request\ArtistDetailsRequest;
use app\dto\response\ArtistDetailsResponse;

interface ArtistDetailsServiceInterface
{
    function saveUserProfile(ArtistDetailsRequest $artistDetailsRequest): ArtistDetailsResponse;

    function saveProfilePicture($userId, $tmpFilePath): ?ArtistDetailsResponse;

    public function getUserProfile(string $userId): ArtistDetailsResponse;

    public function getAllArtistsByCategory($userId): array;

    public function getAllArtists(): array;

    public function getArtistById($id): ArtistDetailsResponse;


    public function getArtistRating($id): float;
}