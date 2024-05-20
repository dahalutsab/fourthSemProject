<?php
namespace App\Service\Implementation;

use App\Dto\Request\MediaRequest;
use App\Dto\Response\MediaResponse;
use App\Models\Media;
use App\Repository\Implementation\MediaRepository;
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
}
