<?php
session_start();

// Include database connection
include_once('includes/dbconnection.php');

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Get user ID from the session
$userId = $_SESSION['user_id'];

// Fetch past created venues
$createdVenuesQuery = "SELECT * FROM venues WHERE user_id = $userId";
$createdVenuesResult = $conn->query($createdVenuesQuery);

if (!$createdVenuesResult) {
    die("Query failed: " . $conn->error);
}

$createdVenues = ($createdVenuesResult->num_rows > 0) ? $createdVenuesResult->fetch_all(MYSQLI_ASSOC) : [];

// Fetch registered venues with user information
$registeredVenuesQuery = "SELECT v.*, vr.registration_date, u.username
                        FROM venues v
                        JOIN venue_registrations vr ON v.venue_id = vr.venue_id
                        JOIN users u ON vr.user_id = u.user_id
                        WHERE vr.user_id = $userId";

$registeredVenuesResult = $conn->query($registeredVenuesQuery);

if (!$registeredVenuesResult) {
    die("Query failed: " . $conn->error);
}

$registeredVenues = ($registeredVenuesResult->num_rows > 0) ? $registeredVenuesResult->fetch_all(MYSQLI_ASSOC) : [];

// Include header
include_once('includes/header.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add your styles here -->
</head>
<body>
    <h1>User Profile</h1>

    <h2>Created Venues:</h2>
    <?php
    if (!empty($createdVenues)) {
        foreach ($createdVenues as $venue) {
            // Fetch the corresponding venue details from the "venues" table
            $venueId = $venue['venue_id'];
            //$venueDetailsQuery = "SELECT * FROM venues WHERE venue_id = $venueId";
            //$venueDetailsResult = $conn->query($venueDetailsQuery);

            //if (!$venueDetailsResult) {
            //    die("Query failed: " . $conn->error);
            //}

            //$venueDetails = ($venueDetailsResult->num_rows > 0) ? $venueDetailsResult->fetch_assoc() : [];

            echo '<p>Venue Name: ' . $venue['venue_name'] . '</p>';
            echo '<p>Venue Capacity: ' . $venue['venue_capacity'] . '</p>';
            // Add more details as needed
            echo '<hr>';
        }
    } else {
        echo '<p>No venues created.</p>';
    }
    ?>

    <h2>Registered Venues:</h2>
    <?php
    if (!empty($registeredVenues)) {
        foreach ($registeredVenues as $venue) {
            echo '<p>Venue Name: ' . $venue['venue_name'] . '</p>';
            echo '<p>Venue Capacity: ' . $venue['venue_capacity'] . '</p>';
            echo '<p>Registration Date: ' . $venue['registration_date'] . '</p>';
            echo '<p>Booked by: ' . $venue['username'] . '</p>';
            // Add more details as needed
            echo '<hr>';
        }
    } else {
        echo '<p>No venues registered.</p>';
    }
    ?>
</body>
</html>
