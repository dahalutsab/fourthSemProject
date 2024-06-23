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
    public function saveMedia(): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 0;
            $media = $_FILES['media'];
            $title = $_POST['title'];
            $description = $_POST['description'];

            $mediaRequest = new MediaRequest($userId, $media, $title, $description);
            $mediaResponse = $this->mediaService->saveMedia($mediaRequest);
             APIResponse::success($mediaResponse->toArray(), ['message' => $mediaResponse->getType() .' saved successfully.']);
        } catch (Exception $e) {
             APIResponse::error($e->getMessage(), 500);
        }
    }

    public function getMedia(int $mediaId): ?MediaResponse
    {
        return $this->mediaService->getMedia($mediaId);
    }

    public function getMediaByUser(): void
    {
        try {
            $userId = $_SESSION[SESSION_USER_ID] ?? 0;
            $mediaResponse = $this->mediaService->getMediaByUser($userId);
             APIResponse::success($mediaResponse, ['message' => 'Media fetched successfully.']);
        } catch (Exception $e) {
             APIResponse::error($e->getMessage(), 500);
        }

    }
    public function getMediaByArtistId(): void
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
             APIResponse::success($mediaResponse, ['message' => 'Media fetched successfully.']);
        } catch (Exception $e) {
             APIResponse::error($e->getMessage(), 500);
        }

    }

    public function deleteMedia(): void
    {
        try {
            $data = json_decode(file_get_contents("php://input"));
            $mediaId = $data->mediaId;
            if (!is_numeric($mediaId)) {
                throw new Exception("Invalid media ID: $mediaId");
            }
            if ($this->mediaService->deleteMedia($mediaId)) {
                APIResponse::success([], ['message' => 'Media deleted successfully.']);
            } else {
                APIResponse::error('Failed to delete media.', 500);
            }
        } catch (Exception $e) {
             APIResponse::error($e->getMessage(), 500);
        }
    }

}