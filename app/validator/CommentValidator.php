<?php

namespace app\validator;
class CommentValidator {

    public function validate($data): array
    {
        $errors = [];

        if (!isset($_SESSION[SESSION_USER_ID]) || !is_int((int)$_SESSION[SESSION_USER_ID])) {
            $errors[] = 'Invalid user ID';
        }

        if (!isset($data['artistId']) || !is_int((int)$data['artistId'])) {
            $errors[] = 'Invalid artist ID';
        }

        if (!isset($data['text']) || empty(trim($data['text']))) {
            $errors[] = 'Comment text is required';
        }

        $data['rating'] = (int)$data['rating'] ?? null;
        if (isset($data['rating']) && (!is_int($data['rating']) || $data['rating'] < 1 || $data['rating'] > 5)) {
            $errors[] = 'Invalid rating';
        }

        return $errors;
    }
}
