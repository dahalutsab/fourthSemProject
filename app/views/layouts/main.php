<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Open Mic Hub'; $baseUrl = '/'?></title>

    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/navbar.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/login_signup.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/home.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/artists.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/artist-card.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/artist-details.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/footer.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/contactUs.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>assets/css/style.css">
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include __DIR__ . '/../components/navbar.php'; ?>
<div class="container">
    <div class="container">
        <?php
        // Loop through the content array and include each content file
        $content = $content ?? [];
        foreach ($content as $page) {
            require_once __DIR__ . "/../{$page}.php";
        }
        ?>
    </div>
</div>
<?php include __DIR__ . '/../components/footer.php'; ?>
<script src="<?= $baseUrl ?>assets/js/script.js"></script>
<script src="<?= $baseUrl ?>assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>