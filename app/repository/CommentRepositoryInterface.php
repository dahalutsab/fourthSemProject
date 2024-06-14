<?php

namespace app\repository;

interface CommentRepositoryInterface {
    public function findByArtist($artistId);
    public function save($commentRequest);
    public function incrementUpvotes($commentId);

    public function saveReply(mixed $commentId, mixed $artistId, mixed $text, mixed $userId);

    public function getArtistIdByArtistDetailsId($artistDetailsId): int;
}