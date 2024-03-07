<?php

use controllers\UserController;

require_once '../controllers/UserController.php';
//require_once '../controllers/AnotherController.php';
if (isset($_POST['submit-signup'])) {
    $userController = new UserController();
    $userController->createUser($_POST);
} else if (isset($_POST['submit-contact'])) {
    $anotherController = new AnotherController();
    $anotherController->handleContactForm($_POST);
} else {
    // Handle other cases (e.g., display forms)
}
