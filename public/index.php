<?php

// Include the Composer autoloader
use migrations\admin_insert;

require_once __DIR__ . '/../vendor/autoload.php';

// Include the session configuration file
require_once __DIR__ . '/../config/session.php';

require_once __DIR__ . '/../config/config.php';

// Include the routes file
require_once __DIR__ . '/../app/Routes.php';

// Run the admin_insert migration
$migration = new admin_insert();
$migration->up();

//start the web socket server
use app\service\implementation\WebSocketService;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

function isWebSocketServerRunning($host, $port): bool
{
    $connection = @fsockopen($host, $port, $errno, $errstr, 2);
    if ($connection) {
        fclose($connection);
        return true;
    }
    return false;
}

$host = 'openmichub.onrender.com';
$port = 8909;

if (!isWebSocketServerRunning($host, $port)) {
    echo "Starting WebSocket server...\n";

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new WebSocketService()
            )
        ),
        $port
    );

    echo "WebSocket server is running at ws://$host:$port\n";

    $server->run();

    echo "WebSocket server has stopped.\n";
}