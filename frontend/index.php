<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Mic Hub</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/navbar.css">
    <link rel="stylesheet" href="assets/css/login_signup.css">
    <link rel="stylesheet" href="assets/css/home.css">
    <link rel="stylesheet" href="assets/css/artists.css">
    <link rel="stylesheet" href="assets/css/artist-card.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $GLOBALS['page'] = $_REQUEST['page'] ?? '';


        include 'html/navbar.php';

        switch ($GLOBALS['page']) {
            case 'signin':
                include 'html/login_signup.php';
                break;
            case 'create-user':
                include 'html/otp.php';
                break;
            case 'artist_details':
                include 'html/artist_details.php';
                break;
            default:
                include 'html/home.php';
                include 'html/artists.php';
                break;
        }
        include 'html/footer.php';

    ?>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/navbar.js"></script>
</body>
</html>
