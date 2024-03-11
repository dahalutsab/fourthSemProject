<?php

const DB_HOST = 'localhost';
const DB_NAME = 'open_mic_hub';
const DB_USER = 'root';
const DB_PASSWORD = '';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    exit();
}
