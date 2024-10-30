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