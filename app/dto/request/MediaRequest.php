<?php
namespace app\dto\request;
class MediaRequest
{
    private int $userId;
    private array $media;
    private string $title;
    private ?string $description;

    public function __construct(int $userId, array $media, string $title, ?string $description)
    {
        $this->userId = $userId;
        $this->media = $media;
        $this->title = $title;
        $this->description = $description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getMedia(): array
    {
        return $this->media;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }
}
