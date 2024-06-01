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
}