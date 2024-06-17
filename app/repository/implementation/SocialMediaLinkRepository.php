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
        $sql = "INSERT INTO socialmedialinks (user_id, name, link) VALUES (?, ?, ?)";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("iss", $data['user_id'], $data['name'], $data['link']);
        return $stmt->execute();
    }

    public function update(array $data): bool
    {
        $sql = "UPDATE socialmedialinks SET name = ?, link = ? WHERE id = ?";
        $stmt = $this->db->getConnection()->prepare($sql);
        $stmt->bind_param("ssi", $data['name'], $data['link'], $data['id']);
        return $stmt->execute();
    }

    public function getSocialMediaLinksByUserId(int $userId): array
    {
        $sql = "SELECT * FROM socialmedialinks WHERE user_id = ?";
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
}