<?php

namespace app\models;

class Media {
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


    // Getters and setters for each property

    public function getMediaId(): int {
        return $this->media_id;
    }

    public function setMediaId(int $media_id): void {
        $this->media_id = $media_id;
    }

    public function getUserId(): int {
        return $this->user_id;
    }

    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    public function getMediaType(): string {
        return $this->media_type;
    }

    public function setMediaType(string $media_type): void {
        $this->media_type = $media_type;
    }

    public function getMediaUrl(): string {
        return $this->media_url;
    }

    public function setMediaUrl(string $media_url): void {
        $this->media_url = $media_url;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getCreatedAt(): string {
        return $this->created_at;
    }

    public function setCreatedAt(string $created_at): void {
        $this->created_at = $created_at;
    }

}