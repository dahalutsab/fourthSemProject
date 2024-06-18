<?php

namespace app\controllers;

use app\response\APIResponse;
use app\service\implementation\SocialMediaLinkService;

class SocialMediaLinkController
{

    protected SocialMediaLinkService $socialMediaLinkService;

    public function __construct()
    {
        $this->socialMediaLinkService = new SocialMediaLinkService();
    }

    public function getAllSocialMediaPlatforms(): void {
        $socialMediaPlatforms = $this->socialMediaLinkService->getAllSocialMediaPlatforms();
        APIResponse::success($socialMediaPlatforms);
    }

    public function create(): void
    {
        $inputJSON = file_get_contents('php://input');
        $data = json_decode($inputJSON, true);

        if (json_last_error() !== JSON_ERROR_NONE || !isset($data['social_media_links'])) {
            APIResponse::error('Invalid JSON data or missing social_media_links key');
            return;
        }

        $artistId = $_SESSION[SESSION_USER_ID];
        if (!$artistId) {
            APIResponse::error('User not logged in');
            return;
        }

        $this->socialMediaLinkService->deleteByArtistId($artistId);

        foreach ($data['social_media_links'] as $socialMediaLink) {
            $data = [
                'artist_id' => $artistId,
                'platform_id' => $socialMediaLink['platform_id'],
                'url' => $socialMediaLink['url']
            ];
            if (!$this->socialMediaLinkService->create($data)) {
                APIResponse::error('Error creating social media link');
                return;
            }
        }

        APIResponse::success('Social media links updated successfully');
    }

    public function getSocialMediaLinksByUserId(): void
    {
        $userId = $_SESSION[SESSION_USER_ID];
        if (!$userId) {
            APIResponse::error('User not logged in');
            return;
        }
        $socialMediaLinks = $this->socialMediaLinkService->getSocialMediaLinksByUserId($userId);
        APIResponse::success($socialMediaLinks);
    }

}