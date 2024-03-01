<?php

// Database configuration
const DB_HOST = 'localhost';
const DB_NAME = 'open_mic_hub';
const DB_USER = '';
const DB_PASS = '';

// Database connection
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
