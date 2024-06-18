<?php

namespace app\controllers;

use app\response\APIResponse;
use config\Database;

class ContactUsController
{

    function saveContactUS(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize and validate the form data
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_STRING);
            $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

            // Check if form data is valid
            if ($name && $email && $subject && $message) {
                // Form data is valid, insert it into the database
                $database = new Database();
                $connection = $database->getConnection();

                $stmt = $connection->prepare("INSERT INTO contact_us (name, email, subject, message) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $subject, $message);

                if ($stmt->execute()) {
                    APIResponse::success("Message sent successfully");
                } else {
                    APIResponse::error("Failed to send message");
                }
            } else {
                APIResponse::error("Invalid form data");
            }
        }

    }


    function getContactUsMessages(): void
    {
        $database = new Database();
        $connection = $database->getConnection();

        $stmt = $connection->prepare("SELECT * FROM contact_us");
        $stmt->execute();
        $result = $stmt->get_result();

        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }

        APIResponse::success($messages);
    }
}