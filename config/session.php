<?php

// Include session constants file
require_once 'session_constants.php';


// **Session Name:** Set a random and unpredictable name
const SESSION_NAME = 'app_session_open_mic_hub';

// **Session Lifetime:** Set a reasonable expiration time in seconds (e.g., 3600 for 1 hour)
const SESSION_LIFETIME = 3600;

// **Session Flags:**
const SESSION_COOKIE_HTTPONLY = true;  // Prevent JavaScript access
const SESSION_COOKIE_SECURE = false;     // Only transmit over HTTPS (if enabled)

// Set session name
session_name(SESSION_NAME);

// Set session cookie parameters
session_set_cookie_params([
    'lifetime' => SESSION_LIFETIME,
    'path' => '/',
    'domain' => '',
    'secure' => SESSION_COOKIE_SECURE,
    'httponly' => SESSION_COOKIE_HTTPONLY,
]);

// Regenerate session ID after login to prevent session fixation attacks
if (isset($_SESSION[SESSION_USER_ID])) {
    session_regenerate_id();
}

// Start the session
session_start();

