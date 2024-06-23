<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>Access denied</title>
    <link type="text/css" rel="stylesheet" href="<?= BASE_URL ?>assets/css/404.css" />


</head>

<body>

<div id="notfound">
    <div class="notfound">
        <div class="notfound-404"></div>
        <h1>403</h1>
        <h2>Access Denied</h2>
        <p>Sorry but the page you are looking for is restricted based on role.</p>
        <a id="backButton" >Back to homepage</a>
    </div>
</div>

</body>
<script>
    document.getElementById("backButton").addEventListener("click", goBack);
    function goBack() {
        window.history.back();
    }
</script>
</html>
