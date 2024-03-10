<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Open Mic Hub'; ?></title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/navbar.css">
    <link rel="stylesheet" href="/public/assets/css/login_signup.css">
    <link rel="stylesheet" href="/public/assets/css/home.css">
    <link rel="stylesheet" href="/public/assets/css/artists.css">
    <link rel="stylesheet" href="/public/assets/css/artist-card.css">
    <link rel="stylesheet" href="/public/assets/css/footer.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include __DIR__ . '/../components/navbar.php'; ?>

<div class="container">

    <?php
    // Determine which content to include based on route or controller action
    // (Replace this logic with your routing system to identify the appropriate content)
    $content = trim($_SERVER['REQUEST_URI'], '/') ?? 'home';

    switch ($content) {
        case 'home':
            require_once __DIR__ . '/../components/home.php'; // Include home component
            require_once __DIR__ . '/../components/artists.php'; // Include artists component
            break;
        case 'signup':
            require_once __DIR__ . '/../pages/login_signup.php'; // Include signup view
            break;
        case 'artist-details':
            require_once __DIR__ . '/../pages/artist_details.php'; // Include artist details view
            break;
        // ... (Add cases for other functionalities) ...
        default:
            // Handle cases where content cannot be determined
    }
    ?>

</div>

<?php include __DIR__ . '/../components/footer.php'; ?>

<script src="/public/assets/js/script.js"></script>
<script src="/public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
