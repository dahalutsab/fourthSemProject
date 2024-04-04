<?php

namespace App\controllers;

use App\dto\request\UserDetailsRequest;
use App\http\Request;
use App\models\SocialMediaLink;
use App\Response\ApiResponse;
use App\service\implementation\UserDetailsService;
use Exception;

class UserDetailsController
{
    private UserDetailsService $userDetailsService;
    public function __construct()
    {
        $this->userDetailsService = new UserDetailsService();
    }

    public function getUserDetails(): null
    {
        try {
            $id = $_SESSION[SESSION_USER_ID]?? 1;
            return ApiResponse::success($this->userDetailsService->getUserDetails($id)->getData());
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }

    public function createUserDetails(): null
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 1;
            $data = json_decode(file_get_contents('php://input'), true);
            $socialMediaLinksData = $data['social_media'] ?? [];
            $socialMediaLinks = [];
            foreach ($socialMediaLinksData as $socialMediaLinkData) {
                $socialMediaLinks[] = new SocialMediaLink(
                    null,
                    $userId,
                    $socialMediaLinkData['name'],
                    $socialMediaLinkData['link']
                );
            }
            $userDetails = [
                'fullName' => $data['full_name'] ?? null,
                'phone' => $data['phone'] ?? null,
                'address' => $data['address'] ?? null,
                'profilePicture' => $data['profile_picture'] ?? null,
                'socialMedia' => $socialMediaLinks,
                'bio' => $data['bio'] ?? null
            ];
            $userDetailsRequest = new UserDetailsRequest(
                $userDetails['fullName'],
                $userDetails['phone'],
                $userDetails['address'],
                $userDetails['profilePicture'],
                $userDetails['socialMedia'],
                $userDetails['bio']
            );
            return ApiResponse::success($this->userDetailsService->createUserDetails($userDetailsRequest)->getData());
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage());
        }
    }
}