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

    public function create(): void
    {
        $userId = $_POST['user_id'];
        $socialMediaLinks = $_POST['social_media_links'];

        foreach ($socialMediaLinks as $socialMediaLink) {
            $data = [
                'user_id' => $userId,
                'name' => $socialMediaLink['name'],
                'link' => $socialMediaLink['link']
            ];
            if (!$this->socialMediaLinkService->create($data)) {
                APIResponse::error('Error creating social media link');
            } else {
                APIResponse::success('Social media link created successfully');
            }
        }

    }

    public function update(): void
    {
        $socialMediaLinks = $_POST['social_media_links'];

        foreach ($socialMediaLinks as $socialMediaLink) {
            $data = [
                'id' => $socialMediaLink['id'],
                'name' => $socialMediaLink['name'],
                'link' => $socialMediaLink['link']
            ];
            if (!$this->socialMediaLinkService->update($data)) {
                APIResponse::error('Error updating social media link');
            } else {
                APIResponse::success('Social media link updated successfully');
            }
        }
    }

    public function getSocialMediaLinksByUserId(): array
    {
        $userId = $_GET['user_id'];
        return $this->socialMediaLinkService->getSocialMediaLinksByUserId($userId);
    }
}