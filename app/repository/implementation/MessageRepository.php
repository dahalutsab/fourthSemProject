<?php

namespace app\repository\implementation;

use config\Database;

class MessageRepository
{
    protected Database $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function saveMessage($sender_id, $receiver_id, $content)
    {
        $stmt = $this->db->getConnection()->prepare(
            "INSERT INTO messages (sender_id, receiver_id, content) VALUES (?, ?, ?)"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }


        $stmt->bind_param("iis", $sender_id, $receiver_id, $content);

        $stmt->execute();
        return $stmt->insert_id;
    }

    public function getMessagesBetweenUsers($user1_id, $user2_id)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT * FROM messages WHERE (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?) ORDER BY created_at ASC"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("iiii", $user1_id, $user2_id, $user2_id, $user1_id);

        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateMessageStatus(mixed $messageId, mixed $status)
    {
        $stmt = $this->db->getConnection()->prepare(
            "UPDATE messages SET status = ? WHERE id = ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("ii", $status, $messageId);

        $stmt->execute();
    }

    public function getAllUsersForChat(mixed $user_id)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT 
        u.id, 
        u.username, 
        CASE WHEN r.role_name = 'ARTIST' THEN ad.full_name ELSE ud.fullName END as full_name,
        CASE WHEN r.role_name = 'ARTIST' THEN ad.profile_picture ELSE ud.profilePicture END as profile_picture
    FROM users u
    LEFT JOIN artist_details ad ON u.id = ad.user_id
    LEFT JOIN userdetails ud ON u.id = ud.user_id
    INNER JOIN roles r ON u.role_id = r.role_id
    WHERE u.id != ?"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("i", $user_id);

        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMyChats(mixed $user_id)
    {
        $stmt = $this->db->getConnection()->prepare(
            "SELECT 
        u.id, 
        u.username, 
        CASE WHEN r.role_name = 'ARTIST' THEN ad.full_name ELSE ud.fullName END as full_name,
        CASE WHEN r.role_name = 'ARTIST' THEN ad.profile_picture ELSE ud.profilePicture END as profile_picture
    FROM users u
    LEFT JOIN artist_details ad ON u.id = ad.user_id
    LEFT JOIN userdetails ud ON u.id = ud.user_id
    INNER JOIN roles r ON u.role_id = r.role_id
    WHERE u.id IN (
        SELECT DISTINCT sender_id FROM messages WHERE receiver_id = ?
        UNION
        SELECT DISTINCT receiver_id FROM messages WHERE sender_id = ?
    )"
        );

        if ($stmt === false) {
            die('Prepare failed: ' . $this->db->getConnection()->error);
        }

        $stmt->bind_param("ii", $user_id, $user_id);

        if (!$stmt->execute()) {
            die('Execute failed: ' . $stmt->error);
        }

        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

}