<?php

namespace app\dto\response;

class CommentResponse
{

    public mixed $id;
    public $userId;
    public $username;
    public $userImage;
    public $artistId;
    public $rating;
    public $text;
    public $upvotes;
    public $parentId;
    public $createdAt;
    public $replies;

    public function __construct($comment) {
        $this->id = $comment['id'];
        $this->userId = $comment['user_id'];
        $this->username = $comment['username'];
        $this->userImage = $comment['user_image'];
        $this->artistId = $comment['artist_id'];
        $this->rating = $comment['rating'];
        $this->text = $comment['text'];
        $this->upvotes = $comment['upvotes'];
        $this->parentId = $comment['parent_id'];
        $this->createdAt = $comment['created_at'];
        $this->replies = [];
    }
}