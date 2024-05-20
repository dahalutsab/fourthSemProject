<?php

namespace App\controllers;

use App\Dto\Request\MediaRequest;
use app\dto\response\MediaResponse;
use App\Response\ApiResponse;
use App\service\implementation\MediaService;
use Exception;


class MediaController
{
    protected MediaService $mediaService;

    public function __construct()
    {
        $this->mediaService = new MediaService;
    }

    /**
     * @throws Exception
     */
    public function saveMedia(): ?MediaResponse
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 0;
            $media = $_FILES['media'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $mediaRequest = new MediaRequest($userId, $media, $title, $description);
            $mediaResponse = $this->mediaService->saveMedia($mediaRequest);
            return ApiResponse::success($mediaResponse->toArray(), ['message' => $mediaResponse->getType() .' saved successfully.']);
        } catch (Exception $e) {
            return ApiResponse::error($e->getMessage(), 500);
        }
    }

    public function getMedia(int $mediaId): ?MediaResponse
    {
        return $this->mediaService->getMedia($mediaId);
    }

}