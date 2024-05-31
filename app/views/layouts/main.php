<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Open Mic Hub'; ?></title>

    <link rel="icon" href="<?= BASE_IMAGE_PATH ?>openMicLogo.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>navbar.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>login_signup.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>home.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>artists.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>artist-card.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>artist-details.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>footer.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>contactUs.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>error_message.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>style.css">
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>
</head>
<body>
<?php include __DIR__ . '/../components/loader.html' ?>

<?php include __DIR__ . '/../components/navbar.php'; ?>
<div class="container">

    <div class="container">
        <?php
        // Loop through the content array and include each content file
        $content = $content ?? [];
        foreach ($content as $page) {
            require_once __DIR__ . "/../$page.php";
        }
        ?>
    </div>
</div>
<?php include __DIR__ . '/../components/footer.php'; ?>
<script src="<?= BASE_JS_PATH ?>script.js"></script>
<script src="<?= BASE_JS_PATH ?>bootstrap.bundle.min.js"></script>
<script src="<?= BASE_JS_PATH ?>loader.js"></script>
<script src="<?= BASE_JS_PATH ?>socket.js"></script>

</body>
</html>