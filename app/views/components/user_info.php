<?php

use config\Database;

if (!isset($_GET['id'])) {
    $error = 'User not found';
}
$userId = $_GET['id'] ?? 1;
$database = new Database();

$userName = null;
$email = null;
$roleName = null;
$picture = null;
$fullName = null;
$role = 1;
$query = "SELECT * FROM users WHERE id = $userId";
$user = $database->getConnection()->query($query)->fetch_assoc();

if (!$user) {
    $error = 'User not found';
    $user = [];
}else
{
    $userName = $user['username'];
    $email = $user['email'];
    $role = $user['role_id'];
}
$sql = "SELECT role_name FROM roles WHERE role_id = $role";
$role = $database->getConnection()->query($sql)->fetch_assoc();
$roleName = $role['role_name'];

if ($roleName == "USER") {
    $query = "SELECT * FROM userdetails WHERE user_id = $userId";
    $userDetails = $database->getConnection()->query($query)->fetch_assoc();
    if ($userDetails) {
        $picture = $userDetails['profilePicture'];
        $fullName = $userDetails['fullName'];
    }
} elseif ($roleName == "ARTIST") {
    $query = "SELECT * FROM artist_details WHERE id = $userId";
    $artistDetails = $database->getConnection()->query($query)->fetch_assoc();
    if ($artistDetails) {
        $picture = $artistDetails['profilePicture'];
        $fullName = $artistDetails['fullName'];
    }
}
if (!$picture) {
    $picture = '/../assets/images/default-profile.png';
} else {
    $picture = '/../' . $picture;
}

if (!$fullName) {
    $fullName = 'Anonymous';
}

?>

<style>
    body {
        margin: 3em;
    }
    .card-img-top {
        width: 60%;
        border-radius: 50%;
        margin: 0 auto;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }
    .card {
        padding: 1.5em 0.5em 0.5em;
        text-align: center;
        border-radius: 2em;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    .card-title {
        font-weight: bold;
        font-size: 1.5em;
        color: var(--button-color);
    }
    .btn-primary {
        border-radius: 2em;
        padding: 0.5em 1.5em;
    }

    .user-div {
        background: transparent;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
</style>

<div class="user-div">
    <div class="card" style="width: 18rem">
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error ?>
            </div>
        <?php endif; ?>
        <img
            src="<?php echo $picture ?>"
            class="card-img-top"
            alt="..."
        />
        <div class="card-body">
            <h5 class="card-title"><?php echo $fullName ?></h5>
            <div class="card-text">
                <p>User Name: <?php echo $userName ?></p>
                <p>Email: <?php echo $email ?></p>
                <p>Role: <?php echo $roleName ?></p>
            </div>
            <a href="/dashboard/messages?user_id=<?php echo $userId?>" class="btn btn-primary">Message</a>
        </div>
    </div>
</div>
