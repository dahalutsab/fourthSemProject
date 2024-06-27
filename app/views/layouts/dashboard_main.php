<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Open Mic Hub'; ?></title>

    <link rel="icon" href="<?= BASE_IMAGE_PATH ?>openMicLogo.png" type="image/x-icon">

    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_main.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_navbar.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_sidebar.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_breadcrumb.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_component.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>artist-media-management.css">
    <link rel="stylesheet" href="<?= BASE_CSS_PATH ?>dashboard_footer.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="<?= BASE_JS_PATH?>toastr.js"></script>
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

</head>
<body>
<?php include __DIR__ . '/../components/loader.html' ?>
<?php include __DIR__ . '/../components/dashboard_navbar.php'; ?>
<?php include __DIR__ . '/../components/dashboard_sidebar.php'; ?>

<main class="main" id="main">
    <?php include __DIR__ . '/../components/dashboard_breadcrumb.php'; ?>
<!---->

    <?php
    $content = $content ?? "";
    require_once __DIR__ . "/../pages/$content.php";    ?>
</main>

<?php include __DIR__ . '/../components/dashboard_footer.php'; ?>
<script src="<?= BASE_JS_PATH ?>loader.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= BASE_URL ?>assets/js/ajaxHandler.js"></script>
<script src="<?= BASE_URL ?>assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>