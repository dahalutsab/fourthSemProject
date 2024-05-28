<?php
namespace app\service\implementation;

use app\dto\request\MediaRequest;
use app\dto\response\MediaResponse;
use app\models\Media;
use app\repository\implementation\MediaRepository;
use Exception;

class MediaService
{
    protected MediaRepository $mediaRepository;

    public function __construct()
    {
    $this->mediaRepository = new MediaRepository();
    }

    /**
     * @throws Exception
     */
    public function saveMedia(MediaRequest $mediaRequest): ?MediaResponse
    {
        $media = $mediaRequest->getMedia();
        $mediaType = $this->determineMediaType($media);

        if (!$this->isValidMediaType($mediaType)) {
            throw new Exception("Invalid media type.");
        }

        $mediaPath = $this->saveMediaToStorage($media, $mediaType);

        $media = new Media(
            (int)null,
            $mediaRequest->getUserId(),
            $mediaType,
            $mediaPath,
            $mediaRequest->getTitle(),
            $mediaRequest->getDescription(),
            date('Y-m-d H:i:s') // createdAt
        );

        $savedMedia = $this->mediaRepository->save($media);

        if ($savedMedia) {
            return new MediaResponse(
            $savedMedia->getMediaId(),
            $savedMedia->getUserId(),
            $savedMedia->getMediaType(),
            $savedMedia->getMediaUrl(),
            $savedMedia->getTitle(),
            $savedMedia->getDescription(),
            $savedMedia->getCreatedAt()
        );
    }
    return null;
    }

    public function getMedia(int $mediaId): ?MediaResponse
    {
        $media = $this->mediaRepository->getMedia($mediaId);
        if ($media) {
            return new MediaResponse(
            $media->getMediaId(),
            $media->getUserId(),
            $media->getMediaType(),
            $media->getMediaUrl(),
            $media->getTitle(),
            $media->getDescription(),
            $media->getCreatedAt()
            );
        }

        return null;
    }

    private function saveMediaToStorage(array $media, string $mediaType): string
    {
        $mediaPath = 'uploads/' . $mediaType . '/' . $media['name'];
        if (!file_exists('uploads/' . $mediaType)) {
            mkdir('uploads/' . $mediaType, 0777, true);
        }
        move_uploaded_file($media['tmp_name'], $mediaPath);
        return $mediaPath;
    }

    private function determineMediaType(array $media): string
    {
        $mimeType = $media['type'];
        if (str_starts_with($mimeType, 'image/')) {
            return 'photo';
        } elseif (str_starts_with($mimeType, 'video/')) {
            return 'video';
        } elseif (str_starts_with($mimeType, 'audio/')) {
            return 'audio';
        } else {
            return 'unknown';
        }
    }

    private function isValidMediaType(string $mediaType): bool
    {
        return in_array($mediaType, ['photo', 'video', 'audio']);
    }

    public function getMediaByUser(mixed $userId): array
    {
        $mediaItems = $this->mediaRepository->getMediaByUser($userId);
        $mediaResponse = [];
        foreach ($mediaItems as $mediaItem) {
            $mediaResponse[] = (new MediaResponse(
                $mediaItem->getMediaId(),
                $mediaItem->getUserId(),
                $mediaItem->getMediaType(),
                $mediaItem->getMediaUrl(),
                $mediaItem->getTitle(),
                $mediaItem->getDescription(),
                $mediaItem->getCreatedAt()
            ))->toArray();
        }
        return $mediaResponse;
    }

    public function getMediaByArtistId(float|int|string $id): array
    {
        $mediaItems = $this->mediaRepository->getMediaByArtistId($id);
        $mediaResponse = [];
        foreach ($mediaItems as $mediaItem) {
            $mediaResponse[] = (new MediaResponse(
                $mediaItem->getMediaId(),
                $mediaItem->getUserId(),
                $mediaItem->getMediaType(),
                $mediaItem->getMediaUrl(),
                $mediaItem->getTitle(),
                $mediaItem->getDescription(),
                $mediaItem->getCreatedAt()
            ))->toArray();
        }
        return $mediaResponse;
    }
}
