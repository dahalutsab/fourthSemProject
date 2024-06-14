<?php

namespace app\service\implementation;

use app\repository\CommentRepositoryInterface;
use app\service\CommentServiceInterface;

class CommentService implements CommentServiceInterface {
    private CommentRepositoryInterface $commentRepository;

    public function __construct(CommentRepositoryInterface $commentRepository) {
        $this->commentRepository = $commentRepository;
    }

    public function getCommentsByArtist($artistId) {
        return $this->commentRepository->findByArtist($artistId);
    }

    public function addComment($commentRequest): void
    {
        $this->commentRepository->save($commentRequest);
    }

    public function upvoteComment($commentId) {
        $this->commentRepository->incrementUpvotes($commentId);
    }

    public function addReply(mixed $commentId, mixed $artistId, mixed $text, mixed $userId): void
    {
        $artistId = $this->commentRepository->getArtistIdByArtistDetailsId((int)$artistId);
        $this->commentRepository->saveReply($commentId, $artistId, $text, $userId);
    }
}