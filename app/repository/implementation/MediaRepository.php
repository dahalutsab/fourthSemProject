<?php
namespace app\repository\implementation;

use app\models\Media;
use config\Database;

class MediaRepository
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function save(Media $media): ?Media
    {
        $stmt = $this->db->getConnection()->prepare(
            "INSERT INTO media (user_id, media_type, media_url, title, description, created_at) VALUES (?, ?, ?, ?, ?, ?)"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $userId = $media->getUserId();
        $mediaType = $media->getMediaType();
        $mediaUrl = $media->getMediaUrl();
        $title = $media->getTitle();
        $description = $media->getDescription();
        $createdAt = $media->getCreatedAt();

        $stmt->bind_param("isssss", $userId, $mediaType, $mediaUrl, $title, $description, $createdAt);

        if ($stmt->execute()) {
            $media->setMediaId($this->db->getInsertId());
            return $media;
        }

        return null;
    }

    public function getMedia(int $mediaId): ?Media
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT media_id, user_id, media_type, media_url, title, description, created_at FROM media WHERE media_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $mediaId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return new Media(
                $row['media_id'],
                $row['user_id'],
                $row['media_type'],
                $row['media_url'],
                $row['title'],
                $row['description'],
                $row['created_at']
            );
        }

        return null;
    }

    public function getMediaByUser(mixed $userId)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT media_id, user_id, media_type, media_url, title, description, created_at FROM media WHERE user_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $media = [];

        while ($row = $result->fetch_assoc()) {
            $media[] = new Media(
                $row['media_id'],
                $row['user_id'],
                $row['media_type'],
                $row['media_url'],
                $row['title'],
                $row['description'],
                $row['created_at']
            );
        }

        return $media;
    }

    public function getMediaByArtistId(float|int|string $id)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT media_id, user_id, media_type, media_url, title, description, created_at FROM media WHERE user_id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $media = [];

        while ($row = $result->fetch_assoc()) {
            $media[] = new Media(
                $row['media_id'],
                $row['user_id'],
                $row['media_type'],
                $row['media_url'],
                $row['title'],
                $row['description'],
                $row['created_at']
            );
        }

        return $media;
    }
}
