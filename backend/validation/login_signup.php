<?php
//    validating the login/signup
//    if the forms are empty, the user will be prompted to fill in the forms
//    if the forms are not empty, the user will be redirected the routes page where the user will be able to login or sign up

    if (isset($_POST[''])) {
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $user = new User();
        $user->setEmail($email);
        $user->setPassword($password);

        $userController = new UserController();
        $user = $userController->getUserByEmail($user);

        if ($user != null) {
            if ($user->getPassword() == $password) {
                $_SESSION['user'] = $user;
                header('Location: routes.php');
            } else {
                echo "<script>alert('Invalid password')</script>";
            }
        } else {
            echo "<script>alert('Invalid email')</script>";
        }
    }

    if (isset($_REQUEST['username']) && isset($_REQUEST['email']) && isset($_REQUEST['password'])) {
        $username = $_REQUEST['username'];
        $email = $_REQUEST['email'];
        $password = $_REQUEST['password'];

        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword($password);

        $userController = new UserController();
        $userController->createUser($user);
        header('Location: routes.php');
    }