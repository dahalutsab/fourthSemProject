<?php

namespace app\repository\implementation;

use app\repository\CommentRepositoryInterface;
use config\Database;
use Exception;
use mysqli;

class CommentRepository implements CommentRepositoryInterface
{
    private mysqli $mysqli;

    public function __construct() {
        $database = new Database();
        $this->mysqli = $database->getConnection();
    }

    /**
     * @throws Exception
     */
    public function findByArtist($artistId): array
    {
        $artist_id = $this->getArtistIdByDetailsId($artistId);
        $stmt = $this->mysqli->prepare("
            SELECT
                c.id AS comment_id,
                c.user_id,
                c.artist_id,
                c.rating,
                c.text,
                c.upvotes,
                c.parent_id,
                c.created_at,
                u.username AS userName,
                ud.profilePicture AS userProfileImage
            FROM 
                comments c
            LEFT JOIN
                users u ON c.user_id = u.id
            LEFT JOIN
                userdetails ud ON c.user_id = ud.user_id
            WHERE artist_id = ?
            ORDER BY
                c.created_at DESC;
        ");
        $stmt->bind_param('i', $artist_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = [];

        while ($row = $result->fetch_assoc()) {
            $comments[$row['comment_id']] = $row;
        }

        foreach ($comments as $id => $comment) {
            if ($comment['parent_id'] !== null) {
                $comments[$comment['parent_id']]['replies'][] = $comment;
                unset($comments[$id]);
            }
        }

        return array_values($comments); // Re-index array keys
    }

    /**
     * @throws Exception
     */
    public function save($commentRequest): void
    {
        try {
            $artist_id = $this->getArtistIdByDetailsId($commentRequest->artistId);
        }
        catch (Exception $e) {
            throw new Exception('Invalid artist ID');
        }
        $stmt = $this->mysqli->prepare("INSERT INTO Comments (user_id, artist_id, rating, text, parent_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param('iiisi', $commentRequest->userId, $artist_id, $commentRequest->rating, $commentRequest->text, $commentRequest->parentId);
        $stmt->execute();
    }

    public function getArtistIdByDetailsId($detailsId): int
    {
        $stmt = $this->mysqli->prepare("SELECT user_id FROM artist_details WHERE id = ?");
        $stmt->bind_param('i', $detailsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['user_id'];
    }

    public function incrementUpvotes($commentId): void
    {
        $stmt = $this->mysqli->prepare("UPDATE Comments SET upvotes = upvotes + 1 WHERE id = ?");
        $stmt->bind_param('i', $commentId);
        $stmt->execute();
    }

    public function saveReply(mixed $commentId,mixed $artistId, mixed $text, mixed $userId): void
    {
        $stmt = $this->mysqli->prepare("INSERT INTO Comments (user_id, artist_id, text, parent_id) VALUES ( ?, ?, ?, ?)");
        $stmt->bind_param('iisi', $userId, $artistId, $text, $commentId);
        $stmt->execute();
    }

    /**
     * @throws Exception
     */
    public function getArtistIdByArtistDetailsId($artistDetailsId): int
    {
        $stmt = $this->mysqli->prepare("SELECT user_id FROM artist_details WHERE id = ?");
        $stmt->bind_param('i', $artistDetailsId);
        $stmt->execute();
        $result = $stmt->get_result();
        $artistId = $result->fetch_assoc()['user_id'];
        if ($artistId === null) {
            throw new Exception('Invalid artist details ID');
        }
        return $artistId;
    }
}