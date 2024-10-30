<?php

require 'vendor/autoload.php';

use app\service\implementation\WebSocketService;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

echo "Starting WebSocket server...\n";

$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new WebSocketService()
        )
    ),
    8909
);

echo "WebSocket server is running at ws://localhost:8080\n";

$server->run();

echo "WebSocket server has stopped.\n";