<?php

namespace app\controllers;

use app\dto\request\CommentRequest;
use app\repository\implementation\CommentRepository;
use app\response\APIResponse;
use app\service\implementation\CommentService;
use app\validator\CommentValidator;
use Exception;


class CommentController {
    private CommentService $commentService;

    public function __construct() {
        	$this->commentService = new CommentService(new CommentRepository());
    }

    public function getComments(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uriPath = parse_url($requestUri, PHP_URL_PATH);
        $pathSegments = explode('/', $uriPath);
        $artistId = end($pathSegments);

        if ($artistId === null) {
            APIResponse::error("Artist ID is required");
            return;
        }
        $comments = $this->commentService->getCommentsByArtist($artistId);
        APIResponse::success($comments, "Comments retrieved successfully");
    }

    public function postComment(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $validator = new CommentValidator();
        $errors = $validator->validate($data);

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['errors' => $errors]);
            return;
        }

        $commentRequest = new CommentRequest($_SESSION[SESSION_USER_ID], $data['artistId'], $data['text'], $data['rating'] ?? null, $data['parent_id'] ?? null);
        $this->commentService->addComment($commentRequest);
        APIResponse::success("Comment added successfully");
    }

    public function postReply(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $commentId = $data['commentId'];
        $text = $data['text'];
        $userId = $_SESSION[SESSION_USER_ID];
        $artistId = $data['artistId'];

        if ($userId === null) {
            APIResponse::error("You must be logged in to reply to a comment");
            exit();
        }
        if ($commentId === null || $text === null || $userId === null || $artistId === null) {
            APIResponse::error("Comment ID and text are required");
            exit();
        }
        $this->commentService->addReply($commentId, $artistId, $text, $userId);
    }


    public function upvoteComment(): void
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $uriPath = parse_url($requestUri, PHP_URL_PATH);
        $pathSegments = explode('/', $uriPath);
        $commentId = end($pathSegments);

        if ($commentId === null) {
            // Handle the case where artistId is not provided
            APIResponse::error("Artist ID is required");
            return;
        }
        $this->commentService->upvoteComment($commentId);
        APIResponse::success("Comment upvoted successfully");
    }
}