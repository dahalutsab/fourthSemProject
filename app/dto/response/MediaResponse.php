<?php

namespace app\dto\response;

class MediaResponse {
    private int $media_id;
    private int $user_id;
    private string $media_type;
    private string $media_url;
    private string $title;
    private string $description;
    private string $created_at;

    public function __construct(int $media_id, int $user_id, string $media_type, string $media_url, string $title, string $description, string $created_at) {
        $this->media_id = $media_id;
        $this->user_id = $user_id;
        $this->media_type = $media_type;
        $this->media_url = $media_url;
        $this->title = $title;
        $this->description = $description;
        $this->created_at = $created_at;
    }

    // return as an array
    public function toArray(): array {
        return [
            'media_id' => $this->media_id,
            'user_id' => $this->user_id,
            'media_type' => $this->media_type,
            'media_url' => $this->media_url,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at
        ];
    }

    public function getType(): string
    {
        return $this->media_type;
    }
}