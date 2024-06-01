<?php
namespace app\service\implementation;

use app\repository\implementation\MessageRepository;
use app\response\APIResponse;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class WebSocketService implements MessageComponentInterface
{
    private MessageRepository $messageRepository;
    private array $clients;

    public function __construct()
    {
        $this->messageRepository = new MessageRepository;
        $this->clients = [];
    }

    function onOpen(ConnectionInterface $conn): void
    {
        // Store the new connection in the $clients array
        $this->clients[$conn->resourceId] = $conn;
        echo "New connection! ({$conn->resourceId})\n";
    }

    function onClose(ConnectionInterface $conn): void
    {
        // Remove the connection from the $clients array
        unset($this->clients[$conn->resourceId]);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    function onError(ConnectionInterface $conn, \Exception $e): void
{
    $conn->send(json_encode(['error' => $e->getMessage()]));
    $conn->close();
}

    function onMessage(ConnectionInterface $from, $msg): void
    {
        var_dump($msg);
        $data = json_decode($msg, true);
        if (!isset($data['sender_id']) || !isset($data['receiver_id']) || !isset($data['content'])) {
            // Invalid message format
            $from->send(json_encode(['error' => 'Invalid message format']));
            return;
        }

        $sender_id = $data['sender_id'];
        $receiver_id = $data['receiver_id'];
        $message = $data['content'];

        // Save the message to the database
        $messageId = $this->messageRepository->saveMessage($sender_id, $receiver_id, $message);

        // Broadcast the message to the receiver
        foreach ($this->clients as $client) {
            if ($client->resourceId != $from->resourceId) {
                $client->send(json_encode([
                    'sender_id' => $sender_id,
                    'receiver_id' => $receiver_id,
                    'content' => $message,
                    'timestamp' => date('Y-m-d H:i:s')
                ]));

//                update the delivered, sent etc status
                $this->messageRepository->updateMessageStatus($messageId, 'delivered');
                echo "Message {$messageId} delivered to {$receiver_id}\n";
            }

        }
    }


}
