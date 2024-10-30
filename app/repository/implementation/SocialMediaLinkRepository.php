<?php

namespace app\repository\implementation;

use config\Database;

class SocialMediaLinkRepository
{

    protected  Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function create(array $data): bool
    {
        $sql = "INSERT INTO artistsocialmedia (artist_id, platform_id,  url) VALUES (?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("iis", $artistId, $platformId, $url);
        $artistId = $data['artist_id'];
        $platformId = $data['platform_id'];
        $url = $data['url'];
        $stmt->execute();
        return true;
    }

    public function update(array $data): bool
    {
        $sql = "UPDATE  artistsocialmedia SET url = ? WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("si", $data['url'], $data['id']);
        $stmt->execute();
        return true;
    }

    public function getSocialMediaLinksByUserId(int $userId): array
    {
        $sql = "SELECT DISTINCT asm.id, asm.artist_id, smp.platform_name as platform, asm.url 
            FROM artistsocialmedia asm 
            INNER JOIN socialmediaplatforms smp ON asm.platform_id = smp.platform_id 
            WHERE asm.artist_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $socialMediaLinks = [];
        while ($row = $result->fetch_assoc()) {
            $socialMediaLinks[] = $row;
        }
        return $socialMediaLinks;
    }

    public function getAllSocialMediaPlatforms(): array
    {
        $sql = "SELECT * FROM socialmediaplatforms";
        $result = $this->db->getConnection()->query($sql);
        $socialMediaPlatforms = [];
        while ($row = $result->fetch_assoc()) {
            $socialMediaPlatforms[] = $row;
        }
        return $socialMediaPlatforms;
    }

    public function deleteByArtistId(mixed $artistId): void
    {
        $sql = "DELETE FROM artistsocialmedia WHERE artist_id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $artistId);
        $stmt->execute();
    }
}