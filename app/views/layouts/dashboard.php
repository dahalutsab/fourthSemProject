<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Open Mic Hub'; ?></title>
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_navbar.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_sidebar.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_breadcrumb.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_component.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_footer.css">
    <link rel="stylesheet" href="/public/assets/css/dashboard_main.css">
    <script src="https://kit.fontawesome.com/3ab31dc8a0.js" crossorigin="anonymous"></script>

</head>
<body>
<?php include __DIR__ . '/../components/dashboard_navbar.php'; ?>
<?php include __DIR__ . '/../components/dashboard_sidebar.php'; ?>

<main class="main" id="main">
    <?php include __DIR__ . '/../components/dashboard_breadcrumb.php'; ?>

    <?php include __DIR__ . '/../pages/dashboard_profile.php'; ?>

</main>

<?php include __DIR__ . '/../components/dashboard_footer.php'; ?>

<script src="/public/assets/js/dashboard.js"></script>

<script src="/public/assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>