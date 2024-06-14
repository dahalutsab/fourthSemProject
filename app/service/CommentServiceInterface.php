<?php

namespace app\service;

interface CommentServiceInterface
{

    public function getCommentsByArtist($artistId);
    public function addComment($commentRequest);
    public function upvoteComment($commentId);
}