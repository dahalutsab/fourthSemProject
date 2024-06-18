<?php

namespace app\service\implementation;

use app\repository\implementation\SocialMediaLinkRepository;

class SocialMediaLinkService
{

    protected SocialMediaLinkRepository $socialMediaLinkRepository;

    public function __construct()
    {
        $this->socialMediaLinkRepository = new SocialMediaLinkRepository();
    }

    public function create(array $data): bool
    {
        return $this->socialMediaLinkRepository->create($data);
    }

    public function update(array $data): bool
    {
        return $this->socialMediaLinkRepository->update($data);
    }

    public function getSocialMediaLinksByUserId(int $userId): array
    {
        return $this->socialMediaLinkRepository->getSocialMediaLinksByUserId($userId);
    }

    public function getAllSocialMediaPlatforms(): array
    {
        return $this->socialMediaLinkRepository->getAllSocialMediaPlatforms();
    }

    public function deleteByArtistId(mixed $artistId): null
    {
        return $this->socialMediaLinkRepository->deleteByArtistId($artistId);
    }
}