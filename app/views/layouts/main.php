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
    <link rel="stylesheet" href="/public/assets/css/contactUs.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
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

<script src="/public/assets/js/script.js"></script>
<script src="/public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>