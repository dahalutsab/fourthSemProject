<?php

namespace app\dto\request;

class CommentRequest
{
    public $userId;
    public $artistId;
    public $rating;
    public $text;
    public $parentId;

    public function __construct($userId, $artistId, $text, $rating = null, $parentId = null) {
        $this->userId = $userId;
        $this->artistId = $artistId;
        $this->rating = $rating;
        $this->text = $text;
        $this->parentId = $parentId;
    }
}