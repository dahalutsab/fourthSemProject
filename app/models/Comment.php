<?php

namespace app\models;

class Comment {
    public $id;
    public $userId;
    public $artistId;
    public $rating;
    public $text;
    public $upvotes;
    public $parentId;
    public $createdAt;
}