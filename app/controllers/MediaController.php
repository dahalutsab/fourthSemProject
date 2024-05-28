<?php

namespace app\controllers;

use app\dto\request\MediaRequest;
use app\dto\response\MediaResponse;
use app\response\APIResponse;
use app\service\implementation\MediaService;
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
            return APIResponse::success($mediaResponse->toArray(), ['message' => $mediaResponse->getType() .' saved successfully.']);
        } catch (Exception $e) {
            return APIResponse::error($e->getMessage(), 500);
        }
    }

    public function getMedia(int $mediaId): ?MediaResponse
    {
        return $this->mediaService->getMedia($mediaId);
    }

    public function getMediaByUser(): ?MediaResponse
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 0;
            $mediaResponse = $this->mediaService->getMediaByUser($userId);
            return APIResponse::success($mediaResponse, ['message' => 'Media fetched successfully.']);
        } catch (Exception $e) {
            return APIResponse::error($e->getMessage(), 500);
        }

    }
    public function getMediaByArtistId(): null
    {
        try {
            $requestUri = $_SERVER['REQUEST_URI'];
            $uriPath = parse_url($requestUri, PHP_URL_PATH);
            $pathSegments = explode('/', $uriPath);

            $id = end($pathSegments);
            if (!is_numeric($id)) {
                throw new Exception("Invalid artist ID: $id");
            }
            $mediaResponse = $this->mediaService->getMediaByArtistId($id);
            return APIResponse::success($mediaResponse, ['message' => 'Media fetched successfully.']);
        } catch (Exception $e) {
            return APIResponse::error($e->getMessage(), 500);
        }
    }

}