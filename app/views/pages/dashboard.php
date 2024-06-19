<?php

use app\repository\implementation\RequiredFieldsForArtists;
use config\Database;

$role = $_SESSION[SESSION_ROLE];
$database = new Database();
$connection = $database->getConnection();

if ($role === 'ADMIN') {

    $query = "SELECT COUNT(*) as total_users FROM users";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $totalUsers = $stmt->get_result()->fetch_assoc()['total_users'];

    $query = "SELECT COUNT(*) as total_artists FROM users WHERE role_id = 2";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $totalArtists = $stmt->get_result()->fetch_assoc()['total_artists'];

    $query = "SELECT COUNT(*) as total_users FROM users WHERE role_id = 3";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $totalClients = $stmt->get_result()->fetch_assoc()['total_users'];

    $query = "SELECT COUNT(*) as total_active_users FROM users WHERE role_id = 3 AND is_verified != 1";
    $stmt = $connection->prepare($query);
    $stmt->execute();
    $totalActiveUsers = $stmt->get_result()->fetch_assoc()['total_active_users'];

}
elseif ($role === 'ARTIST') {
    $query = "SELECT COUNT(*) as total_media FROM media WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalMedia = $stmt->get_result()->fetch_assoc()['total_media'];

    $query = "SELECT COUNT(*) as total_messages FROM messages WHERE receiver_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalMessages = $stmt->get_result()->fetch_assoc()['total_messages'];

    $query = "SELECT COUNT(*) as total_bookings FROM bookings WHERE artist_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalBookings = $stmt->get_result()->fetch_assoc()['total_bookings'];

    $query = "SELECT SUM(total_cost) as total_payment FROM bookings WHERE artist_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalPayment = $stmt->get_result()->fetch_assoc()['total_payment'];


    $requiredFields = new RequiredFieldsForArtists();
    $artistDetailsMessage = $requiredFields->getRequiredFieldsForArtistDetails();
    $mediaMessage = $requiredFields->getRequiredFieldsForMedia();
    $performanceTypeMessage = $requiredFields->getRequiredFieldsForPerformanceType();
    $allMessages = array_merge($artistDetailsMessage, $mediaMessage, $performanceTypeMessage);
}
else {
    $query = "SELECT COUNT(*) as total_bookings FROM bookings WHERE user_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalBookings = $stmt->get_result()->fetch_assoc()['total_bookings'];

    $query = "SELECT COUNT(*) as total_messages FROM messages WHERE sender_id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalMessages = $stmt->get_result()->fetch_assoc()['total_messages'];

//    $query = "SELECT COUNT(*) as total_reported_users FROM reports WHERE reporter_id = ?";
//    $stmt = $connection->prepare($query);
//    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
//    $stmt->execute();
//    $totalReportedUsers = $stmt->get_result()->fetch_assoc()['total_reported_users'];

    $query = "SELECT COUNT(*) as total_ratings FROM comments WHERE user_id = ? and rating IS NOT NULL";
    $stmt = $connection->prepare($query);
    $stmt->bind_param('i', $_SESSION[SESSION_USER_ID]);
    $stmt->execute();
    $totalRatings = $stmt->get_result()->fetch_assoc()['total_ratings'];

}



?>
<style>
    .dashboard-cards {
        margin-top: 20px;
    }
    .card {
        margin-bottom: 20px;
    }
    .card-title {
        font-size: 20px;
        font-weight: bold;
    }
    .card-text {
        font-size: 18px;
    }

    .card-body {
        padding: 20px;
    }

    .dashboard-cards .card-title {
        color: var(--button-color);
    }


</style>
<div class="container dashboard-cards">
    <div class="row">
        <?php if ($role === 'ADMIN') : ?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text">
                            <i class="fas fa-users"></i>
                            <?php echo $totalUsers; ?>
                        </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ARTISTS</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalArtists; ?>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalClients; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Active Users</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalActiveUsers; ?>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Reports</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        100</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total User Contacts</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        100</p>
                </div>
            </div>
        </div>

        <?php elseif ($role === 'ARTIST') : ?>

<!--        display error and on click * close the error div-->
        <?php if (!empty($allMessages)) : ?>
                <div class="alert alert-warning" role="alert">
                    <strong>Warning!</strong> Fill the following fields to complete your profile:
                    <ul>
                        <?php foreach ($allMessages as $message) : ?>
                            <li><?php echo $message; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"
                    >Total Media</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalMedia; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"
                    >Total Messages</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalMessages; ?>
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"
                    >Total Bookings</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalBookings; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"
                    >Total Payment Received</h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalPayment; ?>
                    </p>
                </div>
            </div>
        </div>

        <?php else: ?>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" >
                        Total Bookings
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalBookings; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" >
                        Total Messages
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalMessages; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" >
                        Rating Given
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        <?php echo $totalRatings; ?>
                    </p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" >
                        Total Reported Users
                    </h5>
                    <p class="card-text">
                        <i class="fas fa-users"></i>
                        10
                    </p>
                </div>
            </div>
        </div>

        <?php endif; ?>
    </div>

</div>
