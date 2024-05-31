<?php
namespace app\controllers;

use app\repository\implementation\MessageRepository;
use app\response\APIResponse;

class MessageController
{
    private MessageRepository $messageRepository;

    public function __construct()
    {
        $this->messageRepository = new MessageRepository;
    }

    public function getMessagesBetweenUsers(): void
    {
        $user1_id = $_GET['user1_id'];
        $user2_id = $_GET['user2_id'];
        $mrssage = $this->messageRepository->getMessagesBetweenUsers($user1_id, $user2_id);
//        convert to array
        $messages = [];
        foreach ($mrssage as $msg) {
            $messages[] = [
                'sender_id' => $msg['sender_id'],
                'receiver_id' => $msg['receiver_id'],
                'content' => $msg['content'],
            ];
        }
        APIResponse::success($messages);
    }
}